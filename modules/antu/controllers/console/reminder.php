<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Automatic Reminder System Controller
 * Handles automatic notifications for:
 * 1. Medicine Expiration (Already Expired in Stock & Upcoming Expiry)
 * 2. Payment Dues (Customer Overdue Balances with WhatsApp/SMS Reminders & Supplier Dues)
 * 3. Daily Cron Job / Background Automation
 *
 * @author Medical Shop Team
 */
class Reminder extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->targetModel = 'medicine_stocks_model';
        $this->moduleMeta = array('medical' => 'Reminder');

        // Allow actions for authenticated console users
        $this->allowed_action = array(
            'index',
            'get_summary',
            'ajax_expired',
            'ajax_near_expiry',
            'ajax_customer_dues',
            'ajax_supplier_dues',
            'send_whatsapp_reminder',
            'settings',
            'cron',
            'mark_reminded'
        );

        // Load necessary models
        $this->load->model('medicines_model');
        $this->load->model('medicine_stocks_model');
        $this->load->model('customers_model');
        $this->load->model('purchases_model');
        $this->load->model('sales_model');
        $this->load->model('suppliers_model');
        $this->load->model('options_model');
    }

    /**
     * Main Reminders Dashboard
     */
    public function index()
    {
        $summary = $this->calculate_summary();

        $store_name = get_option('provider_name');
        if (empty($store_name)) {
            $store_name = 'Medical Shop';
        }
        $store_mobile = get_option('provider_mobile');
        $store_upi = get_option('provider_upi');

        $whatsapp_template = get_option('reminder_whatsapp_template');
        if (empty($whatsapp_template)) {
            $whatsapp_template = "Dear {customer_name},\n\nGreetings from {store_name}! This is a gentle reminder that an outstanding payment of Rs. {due_amount} is pending on your account.\n\nKindly clear the payment at your earliest convenience via Cash or UPI.\n\nThank you for your valued support!\n{store_name}";
        }

        $near_expiry_days = (int) get_option('reminder_near_expiry_days');
        if ($near_expiry_days <= 0) {
            $near_expiry_days = 60;
        }

        $min_due = (float) get_option('reminder_min_due_amount');
        if ($min_due <= 0) {
            $min_due = 10.00;
        }

        $last_cron_time = get_option('reminder_last_cron_run');
        $last_cron_summary = get_option('reminder_last_cron_summary');

        $data = array(
            'summary'           => $summary,
            'store_name'        => $store_name,
            'store_mobile'      => $store_mobile,
            'store_upi'         => $store_upi,
            'whatsapp_template' => $whatsapp_template,
            'near_expiry_days'  => $near_expiry_days,
            'min_due'           => $min_due,
            'last_cron_time'    => $last_cron_time,
            'last_cron_summary' => $last_cron_summary ? json_decode($last_cron_summary, true) : null
        );

        $this->render($data, 'reminder/index_tpl');
    }

    /**
     * Get JSON Summary for Top Navigation Bell Badge & Toast
     */
    public function get_summary()
    {
        $summary = $this->calculate_summary();
        header('Content-Type: application/json');
        echo json_encode(array(
            'status' => 'success',
            'data'   => $summary
        ));
    }

    /**
     * Calculate all reminder metrics across DB
     */
    private function calculate_summary()
    {
        $cur_y = (int) date('y');
        $cur_m = (int) date('m');
        $cur_ym = (int) date('ym');
        $next_ym = (int) date('ym', strtotime('+90 days'));

        // 1. Expired Medicines (In Stock)
        $exp_sql = "SELECT COUNT(*) as cnt, COALESCE(SUM((medicine_strip_stock + (medicine_loose_stock / 10)) * medicine_mrp), 0) as total_value
                    FROM medicine_stocks
                    WHERE (medicine_strip_stock > 0 OR medicine_loose_stock > 0)
                      AND CONCAT(medicine_expire_year, LPAD(medicine_expire_month, 2, '0')) <= $cur_ym
                      AND medicine_expire_year > 0";
        $exp_res = $this->db->query($exp_sql)->row_array();
        $expired_count = !empty($exp_res['cnt']) ? (int) $exp_res['cnt'] : 0;
        $expired_value = !empty($exp_res['total_value']) ? round((float) $exp_res['total_value'], 2) : 0.0;

        // If no stock record exists yet, check purchases as fallback
        if ($expired_count === 0) {
            $pur_exp = $this->db->query("SELECT COUNT(*) as cnt FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) <= $cur_ym AND purchase_expire_year > 0")->row_array();
            $expired_count = !empty($pur_exp['cnt']) ? (int) $pur_exp['cnt'] : 0;
        }

        // 2. Near Expiry (Expiring in Next 90 Days in stock)
        $near_sql = "SELECT COUNT(*) as cnt, COALESCE(SUM((medicine_strip_stock + (medicine_loose_stock / 10)) * medicine_mrp), 0) as total_value
                     FROM medicine_stocks
                     WHERE (medicine_strip_stock > 0 OR medicine_loose_stock > 0)
                       AND CONCAT(medicine_expire_year, LPAD(medicine_expire_month, 2, '0')) > $cur_ym
                       AND CONCAT(medicine_expire_year, LPAD(medicine_expire_month, 2, '0')) <= $next_ym";
        $near_res = $this->db->query($near_sql)->row_array();
        $near_count = !empty($near_res['cnt']) ? (int) $near_res['cnt'] : 0;
        $near_value = !empty($near_res['total_value']) ? round((float) $near_res['total_value'], 2) : 0.0;

        if ($near_count === 0) {
            $pur_near = $this->db->query("SELECT COUNT(*) as cnt FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) > $cur_ym AND CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) <= $next_ym")->row_array();
            $near_count = !empty($pur_near['cnt']) ? (int) $pur_near['cnt'] : 0;
        }

        // 3. Customer Dues
        $cust_sql = "SELECT COUNT(*) as cnt, COALESCE(SUM(customer_due), 0) as total_due 
                     FROM customers 
                     WHERE customer_due > 0";
        $cust_res = $this->db->query($cust_sql)->row_array();
        $cust_count = !empty($cust_res['cnt']) ? (int) $cust_res['cnt'] : 0;
        $cust_due = !empty($cust_res['total_due']) ? round((float) $cust_res['total_due'], 2) : 0.0;

        // Also check sales table for customers with pending unpaid sales
        $sales_due_sql = "SELECT COUNT(DISTINCT sale_customer) as cnt, COALESCE(SUM(sale_total_current_due), 0) as total_due
                          FROM sales 
                          WHERE sale_total_current_due > 0";
        $sales_due_res = $this->db->query($sales_due_sql)->row_array();
        if (!empty($sales_due_res['cnt']) && (int) $sales_due_res['cnt'] > $cust_count) {
            $cust_count = (int) $sales_due_res['cnt'];
            $cust_due = max($cust_due, round((float) $sales_due_res['total_due'], 2));
        }

        // 4. Supplier Outstanding Dues
        $sup_sql = "SELECT COUNT(*) as cnt, COALESCE(SUM(balance), 0) as total_due FROM (
                        SELECT p.purchase_supplier, (SUM(p.purchase_total) - COALESCE(pay.paid, 0)) as balance
                        FROM purchases p
                        LEFT JOIN (
                            SELECT payment_suppliers, SUM(payment_paid_amount) as paid 
                            FROM payments GROUP BY payment_suppliers
                        ) pay ON pay.payment_suppliers = p.purchase_supplier
                        GROUP BY p.purchase_supplier
                        HAVING balance > 5
                    ) as sup_dues";
        $sup_res = $this->db->query($sup_sql)->row_array();
        $sup_count = !empty($sup_res['cnt']) ? (int) $sup_res['cnt'] : 0;
        $sup_due = !empty($sup_res['total_due']) ? round((float) $sup_res['total_due'], 2) : 0.0;

        $total_critical = $expired_count + $cust_count;

        return array(
            'expired_count'       => $expired_count,
            'expired_value'       => $expired_value,
            'near_expiry_count'   => $near_count,
            'near_expiry_value'   => $near_value,
            'customer_dues_count' => $cust_count,
            'customer_dues_total' => $cust_due,
            'supplier_dues_count' => $sup_count,
            'supplier_dues_total' => $sup_due,
            'total_critical'      => $total_critical,
            'timestamp'           => date('Y-m-d H:i:s')
        );
    }

    /**
     * AJAX endpoint: Fetch Expired Medicines currently in stock
     */
    public function ajax_expired()
    {
        $cur_ym = (int) date('ym');
        $search = trim($this->input->post('search') ?? '');

        // Query medicine_stocks with medicines details
        $sql = "SELECT ms.*, m.medicine_name, m.medicine_manufacturer, m.medicine_storage, m.medicine_unit
                FROM medicine_stocks ms
                JOIN medicines m ON ms.medicine_stock_medicine = m.medicine_id
                WHERE (ms.medicine_strip_stock > 0 OR ms.medicine_loose_stock > 0)
                  AND CONCAT(ms.medicine_expire_year, LPAD(ms.medicine_expire_month, 2, '0')) <= $cur_ym
                  AND ms.medicine_expire_year > 0";

        if (!empty($search)) {
            $clean_search = $this->db->escape_like_str($search);
            $sql .= " AND (m.medicine_name LIKE '%$clean_search%' OR ms.medicine_stock_batch LIKE '%$clean_search%')";
        }

        $sql .= " ORDER BY ms.medicine_expire_year ASC, ms.medicine_expire_month ASC LIMIT 200";

        $items = $this->db->query($sql)->result_array();

        // If no rows found in medicine_stocks, also check purchases table
        if (empty($items)) {
            $pur_sql = "SELECT p.*, m.medicine_name, m.medicine_manufacturer, m.medicine_storage, m.medicine_unit,
                               p.purchase_batch as medicine_stock_batch,
                               p.purchase_expire_month as medicine_expire_month,
                               p.purchase_expire_year as medicine_expire_year,
                               p.purchase_mrp as medicine_mrp,
                               p.purchase_quantity as medicine_strip_stock,
                               0 as medicine_loose_stock
                        FROM purchases p
                        JOIN medicines m ON p.purchase_medicine_id = m.medicine_id
                        WHERE CONCAT(p.purchase_expire_year, LPAD(p.purchase_expire_month, 2, '0')) <= $cur_ym
                          AND p.purchase_expire_year > 0";
            if (!empty($search)) {
                $clean_search = $this->db->escape_like_str($search);
                $pur_sql .= " AND (m.medicine_name LIKE '%$clean_search%' OR p.purchase_batch LIKE '%$clean_search%')";
            }
            $pur_sql .= " ORDER BY p.purchase_expire_year ASC, p.purchase_expire_month ASC LIMIT 200";
            $items = $this->db->query($pur_sql)->result_array();
        }

        header('Content-Type: application/json');
        echo json_encode(array(
            'status' => 'success',
            'count'  => count($items),
            'items'  => $items
        ));
    }

    /**
     * AJAX endpoint: Fetch Near Expiry Medicines (Upcoming 30, 60, 90 days)
     */
    public function ajax_near_expiry()
    {
        $days = (int) ($this->input->post('days') ?: 60);
        if ($days <= 0) $days = 60;
        $search = trim($this->input->post('search') ?? '');

        $cur_ym = (int) date('ym');
        $target_ym = (int) date('ym', strtotime("+$days days"));

        $sql = "SELECT ms.*, m.medicine_name, m.medicine_manufacturer, m.medicine_storage, m.medicine_unit
                FROM medicine_stocks ms
                JOIN medicines m ON ms.medicine_stock_medicine = m.medicine_id
                WHERE (ms.medicine_strip_stock > 0 OR ms.medicine_loose_stock > 0)
                  AND CONCAT(ms.medicine_expire_year, LPAD(ms.medicine_expire_month, 2, '0')) > $cur_ym
                  AND CONCAT(ms.medicine_expire_year, LPAD(ms.medicine_expire_month, 2, '0')) <= $target_ym";

        if (!empty($search)) {
            $clean_search = $this->db->escape_like_str($search);
            $sql .= " AND (m.medicine_name LIKE '%$clean_search%' OR ms.medicine_stock_batch LIKE '%$clean_search%')";
        }

        $sql .= " ORDER BY ms.medicine_expire_year ASC, ms.medicine_expire_month ASC LIMIT 200";

        $items = $this->db->query($sql)->result_array();

        if (empty($items)) {
            $pur_sql = "SELECT p.*, m.medicine_name, m.medicine_manufacturer, m.medicine_storage, m.medicine_unit,
                               p.purchase_batch as medicine_stock_batch,
                               p.purchase_expire_month as medicine_expire_month,
                               p.purchase_expire_year as medicine_expire_year,
                               p.purchase_mrp as medicine_mrp,
                               p.purchase_quantity as medicine_strip_stock,
                               0 as medicine_loose_stock
                        FROM purchases p
                        JOIN medicines m ON p.purchase_medicine_id = m.medicine_id
                        WHERE CONCAT(p.purchase_expire_year, LPAD(p.purchase_expire_month, 2, '0')) > $cur_ym
                          AND CONCAT(p.purchase_expire_year, LPAD(p.purchase_expire_month, 2, '0')) <= $target_ym";
            if (!empty($search)) {
                $clean_search = $this->db->escape_like_str($search);
                $pur_sql .= " AND (m.medicine_name LIKE '%$clean_search%' OR p.purchase_batch LIKE '%$clean_search%')";
            }
            $pur_sql .= " ORDER BY p.purchase_expire_year ASC, p.purchase_expire_month ASC LIMIT 200";
            $items = $this->db->query($pur_sql)->result_array();
        }

        header('Content-Type: application/json');
        echo json_encode(array(
            'status' => 'success',
            'days'   => $days,
            'count'  => count($items),
            'items'  => $items
        ));
    }

    /**
     * AJAX endpoint: Fetch Customers with Payment Dues
     */
    public function ajax_customer_dues()
    {
        $search = trim($this->input->post('search') ?? '');
        $min_due = (float) ($this->input->post('min_due') ?: get_option('reminder_min_due_amount') ?: 0.0);
        $filter_days = trim($this->input->post('filter_days') ?? 'all'); // 'all', '15', '30'

        // Get customers with direct customer_due
        $sql = "SELECT c.*, 
                       COALESCE(s.last_sale_date, 'N/A') as last_sale_date,
                       COALESCE(s.unpaid_invoices_count, 0) as unpaid_invoices_count,
                       COALESCE(s.total_unpaid_sales, 0) as total_unpaid_sales
                FROM customers c
                LEFT JOIN (
                    SELECT sale_customer, 
                           MAX(sale_date) as last_sale_date, 
                           COUNT(DISTINCT sale_invoice) as unpaid_invoices_count,
                           SUM(sale_total_current_due) as total_unpaid_sales
                    FROM sales 
                    WHERE sale_total_current_due > 0 
                    GROUP BY sale_customer
                ) s ON s.sale_customer = c.customer_ID
                WHERE (c.customer_due >= $min_due OR s.total_unpaid_sales >= $min_due)";

        if (!empty($search)) {
            $clean_search = $this->db->escape_like_str($search);
            $sql .= " AND (c.customer_name LIKE '%$clean_search%' OR c.customer_contact LIKE '%$clean_search%' OR c.customer_address LIKE '%$clean_search%')";
        }

        $sql .= " ORDER BY c.customer_due DESC, s.total_unpaid_sales DESC LIMIT 200";

        $customers = $this->db->query($sql)->result_array();

        $store_name = get_option('provider_name') ?: 'Medical Shop';
        $store_upi  = get_option('provider_upi') ?: '';
        $custom_tpl = get_option('reminder_whatsapp_template');

        $result = array();
        $today = new DateTime();

        foreach ($customers as $c) {
            $due_amount = max((float)$c['customer_due'], (float)$c['total_unpaid_sales']);
            if ($due_amount < $min_due) continue;

            $days_overdue = 0;
            if (!empty($c['last_sale_date']) && $c['last_sale_date'] !== 'N/A') {
                try {
                    $sale_dt = new DateTime($c['last_sale_date']);
                    $days_overdue = (int)$today->diff($sale_dt)->format('%a');
                } catch (Exception $e) {
                    $days_overdue = 0;
                }
            }

            // Apply filter days
            if ($filter_days === '15' && $days_overdue < 15) continue;
            if ($filter_days === '30' && $days_overdue < 30) continue;

            // Generate personalized WhatsApp Message Text & Link
            $msg = $this->build_whatsapp_message(
                $c['customer_name'],
                $due_amount,
                $store_name,
                $c['customer_contact'],
                $store_upi,
                $custom_tpl
            );

            // Normalize mobile number for WhatsApp
            $clean_phone = preg_replace('/[^0-9]/', '', $c['customer_contact']);
            if (strlen($clean_phone) == 10) {
                $clean_phone = '91' . $clean_phone;
            }

            $wa_url = !empty($clean_phone) ? "https://wa.me/{$clean_phone}?text=" . urlencode($msg) : "";

            $result[] = array(
                'customer_id'     => $c['customer_ID'],
                'customer_name'   => $c['customer_name'],
                'customer_contact'=> $c['customer_contact'],
                'customer_address'=> $c['customer_address'],
                'doctor_name'     => $c['doctor_name'],
                'due_amount'      => number_format($due_amount, 2, '.', ''),
                'days_overdue'    => $days_overdue,
                'last_sale_date'  => $c['last_sale_date'],
                'whatsapp_msg'    => $msg,
                'whatsapp_url'    => $wa_url
            );
        }

        header('Content-Type: application/json');
        echo json_encode(array(
            'status' => 'success',
            'count'  => count($result),
            'items'  => $result
        ));
    }

    /**
     * AJAX endpoint: Fetch Supplier Outstanding Dues
     */
    public function ajax_supplier_dues()
    {
        $search = trim($this->input->post('search') ?? '');

        $sql = "SELECT s.supplier_id, s.supplier_name, s.supplier_contact, s.supplier_address,
                       COALESCE(p.total_purchase, 0) as total_purchases,
                       COALESCE(pay.total_paid, 0) as total_payments,
                       (COALESCE(p.total_purchase, 0) - COALESCE(pay.total_paid, 0)) as pending_balance
                FROM suppliers s
                JOIN (
                    SELECT purchase_supplier, SUM(purchase_total) as total_purchase 
                    FROM purchases 
                    GROUP BY purchase_supplier
                ) p ON p.purchase_supplier = s.supplier_id
                LEFT JOIN (
                    SELECT payment_suppliers, SUM(payment_paid_amount) as total_paid 
                    FROM payments 
                    GROUP BY payment_suppliers
                ) pay ON pay.payment_suppliers = s.supplier_id
                WHERE (COALESCE(p.total_purchase, 0) - COALESCE(pay.total_paid, 0)) > 1";

        if (!empty($search)) {
            $clean_search = $this->db->escape_like_str($search);
            $sql .= " AND (s.supplier_name LIKE '%$clean_search%' OR s.supplier_contact LIKE '%$clean_search%')";
        }

        $sql .= " ORDER BY pending_balance DESC LIMIT 200";

        $suppliers = $this->db->query($sql)->result_array();

        $result = array();
        foreach ($suppliers as $s) {
            $result[] = array(
                'supplier_id'      => $s['supplier_id'],
                'supplier_name'    => $s['supplier_name'],
                'supplier_contact' => $s['supplier_contact'],
                'supplier_address' => $s['supplier_address'],
                'total_purchases'  => number_format((float)$s['total_purchases'], 2, '.', ''),
                'total_payments'   => number_format((float)$s['total_payments'], 2, '.', ''),
                'pending_balance'  => number_format((float)$s['pending_balance'], 2, '.', '')
            );
        }

        header('Content-Type: application/json');
        echo json_encode(array(
            'status' => 'success',
            'count'  => count($result),
            'items'  => $result
        ));
    }

    /**
     * Build personalized WhatsApp reminder message
     */
    private function build_whatsapp_message($customer_name, $amount, $store_name, $phone, $upi = '', $template = null)
    {
        if (empty($template)) {
            $template = "Dear {customer_name},\n\nGreetings from {store_name}! This is a gentle reminder that an outstanding payment of Rs. {due_amount} is pending on your account.\n\nKindly clear the payment at your earliest convenience via Cash or UPI{upi_info}.\n\nThank you for choosing us!\n{store_name}";
        }

        $upi_info = !empty($upi) ? " (UPI: $upi)" : "";

        $replacements = array(
            '{customer_name}' => trim($customer_name),
            '{due_amount}'    => number_format((float)$amount, 2),
            '{store_name}'    => trim($store_name),
            '{phone}'         => trim($phone),
            '{upi_info}'      => $upi_info,
            '{date}'          => date('d-M-Y')
        );

        return str_replace(array_keys($replacements), array_values($replacements), $template);
    }

    /**
     * Save Reminder Settings
     */
    public function settings()
    {
        if ($this->input->post()) {
            $whatsapp_template = trim($this->input->post('whatsapp_template') ?? '');
            $near_expiry_days  = (int) $this->input->post('near_expiry_days');
            $min_due           = (float) $this->input->post('min_due_amount');
            $provider_upi      = trim($this->input->post('provider_upi') ?? '');

            if (!empty($whatsapp_template)) {
                set_option('reminder_whatsapp_template', $whatsapp_template);
            }
            if ($near_expiry_days > 0) {
                set_option('reminder_near_expiry_days', $near_expiry_days);
            }
            if ($min_due >= 0) {
                set_option('reminder_min_due_amount', $min_due);
            }
            if (!empty($provider_upi)) {
                set_option('provider_upi', $provider_upi);
            }

            header('Content-Type: application/json');
            echo json_encode(array(
                'status'  => 'success',
                'message' => 'Reminder settings updated successfully!'
            ));
            return;
        }

        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
    }

    /**
     * Automated Cron Job Check (Can be called via CLI or Web)
     */
    public function cron()
    {
        $summary = $this->calculate_summary();
        $timestamp = date('Y-m-d H:i:s');

        // Update option tracking
        set_option('reminder_last_cron_run', $timestamp);
        set_option('reminder_last_cron_summary', json_encode($summary));

        // Record in activity_logs
        $log_text = sprintf(
            "Automatic Reminder Check: %d expired medicines in stock (Rs. %.2f), %d near-expiry, %d customers with due payments (Rs. %.2f), %d supplier dues (Rs. %.2f).",
            $summary['expired_count'],
            $summary['expired_value'],
            $summary['near_expiry_count'],
            $summary['customer_dues_count'],
            $summary['customer_dues_total'],
            $summary['supplier_dues_count'],
            $summary['supplier_dues_total']
        );

        $activity_data = array(
            'activity'           => 'AUTOMATIC_REMINDER_CHECK',
            'activity_data'      => $log_text,
            'activity_user'      => isset($this->current_user_session['user_id']) ? $this->current_user_session['user_id'] : 1,
            'activity_url'       => 'console/reminder/cron',
            'activity_timestamp' => $timestamp
        );

        $this->db->insert('activity_logs', $activity_data);

        // If run from command line
        if (is_cli()) {
            echo "[$timestamp] Automatic Reminder Check Complete:\n";
            echo " - Expired Medicines in Stock: " . $summary['expired_count'] . " (Rs. " . $summary['expired_value'] . ")\n";
            echo " - Near Expiry Medicines: " . $summary['near_expiry_count'] . "\n";
            echo " - Customer Dues: " . $summary['customer_dues_count'] . " (Rs. " . $summary['customer_dues_total'] . ")\n";
            echo " - Supplier Dues: " . $summary['supplier_dues_count'] . " (Rs. " . $summary['supplier_dues_total'] . ")\n";
            echo " - Activity logged successfully.\n";
            return;
        }

        header('Content-Type: application/json');
        echo json_encode(array(
            'status'    => 'success',
            'message'   => 'Automated reminder scan completed and logged successfully.',
            'timestamp' => $timestamp,
            'summary'   => $summary
        ));
    }
}
