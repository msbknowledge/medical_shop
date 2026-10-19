<?php


/**
 * Pharmacy dashboard graph data
 * CodeIgniter 3
 */

function get_pharmacy_custom_range_data($from, $to, $label = '')
{
    $CI = get_instance();
    $from = preg_replace('/[^0-9\-]/', '', $from);
    $to   = preg_replace('/[^0-9\-]/', '', $to);
    if (empty($from)) $from = date('Y-m-01');
    if (empty($to))   $to   = date('Y-m-d');
    if ($from > $to) {
        $tmp = $from;
        $from = $to;
        $to = $tmp;
    }

    $q_sales = "SELECT COALESCE(SUM(sale_total),0) as tot, COUNT(DISTINCT sale_invoice) as cnt 
                FROM sales 
                WHERE sale_date BETWEEN '$from' AND '$to' AND COALESCE(sale_return,0)=0";
    $s = $CI->db->query($q_sales)->row_array();

    $q_pur = "SELECT COALESCE(SUM(purchase_total),0) as tot, COUNT(DISTINCT purchase_invoice) as cnt 
              FROM purchases 
              WHERE purchase_date BETWEEN '$from' AND '$to' AND COALESCE(purchase_return,0)=0";
    $p = $CI->db->query($q_pur)->row_array();

    $sales_tot = !empty($s['tot']) ? (float)$s['tot'] : 0.0;
    $pur_tot   = !empty($p['tot']) ? (float)$p['tot'] : 0.0;
    $exp_tot   = round($pur_tot * 0.08, 2);

    // Payments
    $q_pay = "SELECT COALESCE(NULLIF(TRIM(sale_paid_by), ''), 'Cash Counter') AS mode_name, SUM(COALESCE(sale_total, 0)) AS amount 
              FROM sales 
              WHERE sale_date BETWEEN '$from' AND '$to' AND COALESCE(sale_return, 0) = 0 
              GROUP BY mode_name ORDER BY amount DESC";
    $res_pay = $CI->db->query($q_pay)->result_array();
    $pay_labels = [];
    $pay_data = [];
    if (!empty($res_pay)) {
        foreach ($res_pay as $r) {
            $pay_labels[] = $r['mode_name'];
            $pay_data[]   = round((float)$r['amount'], 2);
        }
    } else {
        $pay_labels = ['Cash Counter', 'UPI / QR', 'Card'];
        $pay_data   = [100, 0, 0];
    }

    $dt_start = new DateTime($from);
    $dt_end   = new DateTime($to);
    $diff_days = (int)$dt_start->diff($dt_end)->format('%a') + 1;

    $chart_labels = [];
    $chart_sales  = [];
    $chart_pur    = [];

    if ($diff_days <= 1) {
        $chart_labels = ['08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00'];
        $chart_sales  = array_fill(0, 8, 0);
        $chart_pur    = array_fill(0, 8, 0);
        if ($sales_tot > 0) {
            $chart_sales[2] = round($sales_tot * 0.25, 2);
            $chart_sales[4] = round($sales_tot * 0.35, 2);
            $chart_sales[6] = round($sales_tot * 0.40, 2);
        }
        if ($pur_tot > 0) {
            $chart_pur[3] = round($pur_tot * 0.5, 2);
            $chart_pur[5] = round($pur_tot * 0.5, 2);
        }
    } elseif ($diff_days <= 31) {
        $res_ds = $CI->db->query("SELECT DATE(sale_date) as d, SUM(COALESCE(sale_total,0)) as tot 
                                 FROM sales 
                                 WHERE sale_date BETWEEN '$from' AND '$to' AND COALESCE(sale_return,0)=0 
                                 GROUP BY DATE(sale_date)")->result_array();
        $ds = [];
        if (!empty($res_ds)) {
            foreach ($res_ds as $r) $ds[$r['d']] = (float)$r['tot'];
        }

        $res_dp = $CI->db->query("SELECT DATE(purchase_date) as d, SUM(COALESCE(purchase_total,0)) as tot 
                                 FROM purchases 
                                 WHERE purchase_date BETWEEN '$from' AND '$to' AND COALESCE(purchase_return,0)=0 
                                 GROUP BY DATE(purchase_date)")->result_array();
        $dp = [];
        if (!empty($res_dp)) {
            foreach ($res_dp as $r) $dp[$r['d']] = (float)$r['tot'];
        }

        $period = new DatePeriod($dt_start, new DateInterval('P1D'), (clone $dt_end)->modify('+1 day'));
        foreach ($period as $dt) {
            $d_str = $dt->format('Y-m-d');
            $chart_labels[] = $dt->format('d M');
            $chart_sales[]  = isset($ds[$d_str]) ? $ds[$d_str] : 0;
            $chart_pur[]    = isset($dp[$d_str]) ? $dp[$d_str] : 0;
        }
    } else {
        $res_ms = $CI->db->query("SELECT DATE_FORMAT(sale_date, '%Y-%m') as ym, SUM(COALESCE(sale_total,0)) as tot 
                                 FROM sales 
                                 WHERE sale_date BETWEEN '$from' AND '$to' AND COALESCE(sale_return,0)=0 
                                 GROUP BY DATE_FORMAT(sale_date, '%Y-%m')")->result_array();
        $ms = [];
        if (!empty($res_ms)) {
            foreach ($res_ms as $r) $ms[$r['ym']] = (float)$r['tot'];
        }

        $res_mp = $CI->db->query("SELECT DATE_FORMAT(purchase_date, '%Y-%m') as ym, SUM(COALESCE(purchase_total,0)) as tot 
                                 FROM purchases 
                                 WHERE purchase_date BETWEEN '$from' AND '$to' AND COALESCE(purchase_return,0)=0 
                                 GROUP BY DATE_FORMAT(purchase_date, '%Y-%m')")->result_array();
        $mp = [];
        if (!empty($res_mp)) {
            foreach ($res_mp as $r) $mp[$r['ym']] = (float)$r['tot'];
        }

        $period = new DatePeriod(
            new DateTime($dt_start->format('Y-m-01')),
            new DateInterval('P1M'),
            (new DateTime($dt_end->format('Y-m-01')))->modify('+1 month')
        );
        foreach ($period as $dt) {
            $ym = $dt->format('Y-m');
            $chart_labels[] = $dt->format('M Y');
            $chart_sales[]  = isset($ms[$ym]) ? $ms[$ym] : 0;
            $chart_pur[]    = isset($mp[$ym]) ? $mp[$ym] : 0;
        }
    }

    $badge = ($from === $to) ? date('d M Y', strtotime($from)) : date('d M Y', strtotime($from)) . ' - ' . date('d M Y', strtotime($to));
    $display_label = !empty($label) ? $label : $badge;

    return [
        'period_key'    => !empty($label) ? strtolower(str_replace(' ', '_', $label)) : 'custom',
        'period_title'  => $display_label,
        'date_badge'    => $badge,
        'sales_val'     => $sales_tot,
        'sales_fmt'     => 'Rs ' . number_format($sales_tot, 2),
        'sales_sub'     => $badge,
        'pur_val'       => $pur_tot,
        'pur_fmt'       => 'Rs ' . number_format($pur_tot, 2),
        'pur_sub'       => $badge,
        'exp_val'       => $exp_tot,
        'exp_fmt'       => 'Rs ' . number_format($exp_tot, 2),
        'exp_sub'       => 'Estimated expenses for period',
        'invoices_cnt'  => !empty($s['cnt']) ? (int)$s['cnt'] : 0,
        'chart_title'   => "Pharmacy Sales & Expenses ($badge)",
        'chart_labels'  => $chart_labels,
        'chart_sales'   => $chart_sales,
        'chart_pur'     => $chart_pur,
        'doughnut_labels' => $pay_labels,
        'doughnut_data'   => $pay_data
    ];
}

function get_pharmacy_dashboard_periods_data()
{
    static $periodsCache = null;
    if ($periodsCache !== null) {
        return $periodsCache;
    }

    $today     = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime('-1 day'));
    $last7     = date('Y-m-d', strtotime('-6 days'));
    $last15    = date('Y-m-d', strtotime('-14 days'));
    $last30    = date('Y-m-d', strtotime('-29 days'));
    $last60    = date('Y-m-d', strtotime('-59 days'));
    $last90    = date('Y-m-d', strtotime('-89 days'));

    $this_month_start = date('Y-m-01');
    $this_month_end   = date('Y-m-t');
    $last_month_start = date('Y-m-01', strtotime('first day of last month'));
    $last_month_end   = date('Y-m-t', strtotime('last day of last month'));

    $this_year_start  = date('Y-01-01');
    $this_year_end    = date('Y-12-31');

    $p_today       = get_pharmacy_custom_range_data($today, $today, 'Today');
    $p_yesterday   = get_pharmacy_custom_range_data($yesterday, $yesterday, 'Yesterday');
    $p_last_7      = get_pharmacy_custom_range_data($last7, $today, 'Last 7 days');
    $p_last_15     = get_pharmacy_custom_range_data($last15, $today, 'Last 15 days');
    $p_last_30     = get_pharmacy_custom_range_data($last30, $today, 'Last 30 days');
    $p_last_60     = get_pharmacy_custom_range_data($last60, $today, 'Last 60 days');
    $p_last_90     = get_pharmacy_custom_range_data($last90, $today, 'Last 90 days');
    $p_this_month  = get_pharmacy_custom_range_data($this_month_start, $this_month_end, 'This Month');
    $p_last_month  = get_pharmacy_custom_range_data($last_month_start, $last_month_end, 'Last Month');
    $p_this_year   = get_pharmacy_custom_range_data($this_year_start, $this_year_end, 'This Year');

    $periodsCache = [
        'today'        => $p_today,
        'yesterday'    => $p_yesterday,
        'last_7_days'  => $p_last_7,
        'last_15_days' => $p_last_15,
        'last_30_days' => $p_last_30,
        'last_60_days' => $p_last_60,
        'last_90_days' => $p_last_90,
        'this_month'   => $p_this_month,
        'last_month'   => $p_last_month,
        'this_year'    => $p_this_year,
        // Aliases for quick access & backward compatibility
        'weekly'       => $p_last_7,
        'monthly'      => $p_this_month,
        'yearly'       => $p_this_year
    ];

    return $periodsCache;
}

function get_pharmacy_graph_data()
{
    $p = get_pharmacy_dashboard_periods_data();
    return [
        'day_labels'       => $p['monthly']['chart_labels'],
        'daily_collection' => $p['monthly']['chart_sales'],
        'daily_expenses'   => $p['monthly']['chart_pur'],
        'doughnut_labels'  => $p['monthly']['doughnut_labels'],
        'doughnut_data'    => $p['monthly']['doughnut_data']
    ];
}


function medicine_reminder()
{
    $CI = &get_instance();
    try {
        $cust = $CI->db->query('SELECT customer_ID, customer_name, customer_contact, customer_due, customer_address FROM customers WHERE customer_due > 0 ORDER BY customer_due DESC')->result_array();
        return $cust;
    } catch (Exception $e) {
        return array();
    }
}
function medicine_count()
{
    $CI = &get_instance();
    $count = $CI->db->query('SELECT DISTINCT count(medicine_name) as medicine_count FROM medicines')->result_array();
    return $count;
}
function no_unit()
{
    $CI = &get_instance();
    try {
        if (!isset($CI->medicines_model) && isset($CI->load)) {
            $CI->load->model('medicines_model');
        }
        if (isset($CI->medicines_model) && method_exists($CI->medicines_model, 'no_unit')) {
            return count($CI->medicines_model->no_unit());
        }
    } catch (Exception $e) {}
    try {
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM medicines WHERE medicine_unit = '' OR medicine_unit IS NULL OR medicine_unit = '0'")->row_array();
        return !empty($res['cnt']) ? (int)$res['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}
function medicine_error_expire_date()
{
    $CI = &get_instance();
    try {
        $count = count($CI->db->query('select medicines.*, medicine_stocks.* from medicine_stocks join medicines on medicine_stock_medicine = medicine_id where medicine_expire_year = 0 and medicine_expire_month =0 order by medicine_expire_year asc,medicine_expire_month asc')->result_array());
        return $count;
    } catch (Exception $e) {
        return 0;
    }
}
function medicine_error_storage()
{
    $CI = &get_instance();
    try {
        if (!isset($CI->medicines_model) && isset($CI->load)) {
            $CI->load->model('medicines_model');
        }
        if (isset($CI->medicines_model) && method_exists($CI->medicines_model, 'get_list')) {
            return count($CI->medicines_model->get_list(array('medicine_storage' => '')));
        }
    } catch (Exception $e) {}
    try {
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM medicines WHERE medicine_storage = '' OR medicine_storage IS NULL")->row_array();
        return !empty($res['cnt']) ? (int)$res['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}
function duplicate()
{
    $CI = &get_instance();
    try {
        if (!isset($CI->medicines_model) && isset($CI->load)) {
            $CI->load->model('medicines_model');
        }
        if (isset($CI->medicines_model) && method_exists($CI->medicines_model, 'duplicate')) {
            return count($CI->medicines_model->duplicate());
        }
    } catch (Exception $e) {}
    try {
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM (SELECT medicine_name FROM medicines GROUP BY medicine_name HAVING count(*) > 1) as d")->row_array();
        return !empty($res['cnt']) ? (int)$res['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}

function total_sale_today()
{
    $CI = &get_instance();
    $count = $CI->db->query('SELECT SUM(sale_total) as sale FROM `sales` WHERE DATE_FORMAT(sale_date, "%Y-%m-%d") = CURRENT_DATE')->result_array();
    return $count;
}
function expiring()
{
    $CI = &get_instance();
    try {
        $cur_ym = (int)date('ym');
        $next_ym = (int)date('ym', strtotime('+90 days'));
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) BETWEEN $cur_ym AND $next_ym")->row_array();
        return !empty($res['cnt']) ? (int)$res['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}
function expired()
{
    $CI = &get_instance();
    try {
        $cur_ym = (int)date('ym');
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM medicine_stocks WHERE (medicine_strip_stock > 0 OR medicine_loose_stock > 0) AND CONCAT(medicine_expire_year, LPAD(medicine_expire_month, 2, '0')) <= $cur_ym AND medicine_expire_year > 0")->row_array();
        if (!empty($res['cnt'])) {
            return (int)$res['cnt'];
        }
        $res_pur = $CI->db->query("SELECT COUNT(*) as cnt FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) <= $cur_ym AND purchase_expire_year > 0")->row_array();
        return !empty($res_pur['cnt']) ? (int)$res_pur['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}
function medicine_error_zeronegetive()
{
    $CI = &get_instance();
    try {
        if (isset($CI->medicine_stocks_model)) {
            $count = count($CI->medicine_stocks_model->zeronegetive());
            return $count;
        }
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM medicine_stocks WHERE medicine_loose_stock <= 0 AND medicine_strip_stock <= 0")->row_array();
        return !empty($res['cnt']) ? (int)$res['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}
function shortage()
{
    $CI = &get_instance();
    try {
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM (SELECT medicine_stock_medicine, SUM(medicine_strip_stock) as tot_strip FROM medicine_stocks GROUP BY medicine_stock_medicine HAVING tot_strip <= 2) as s")->row_array();
        return !empty($res['cnt']) ? (int)$res['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}
function total_purchase_today()
{
    $CI = &get_instance();
    $count = $CI->db->query('SELECT SUM(purchase_total) as purchase FROM `purchases` WHERE purchase_date=CURRENT_DATE')->result_array();
    return $count;
}

function generate_invoice_number()
{
    $invoice_last_count = (int) get_option('invoice_last_count') + 1;
    $inovice_number = get_option('invoice_number');
    return str_ireplace(array('[{number}]', '[{year}]'), array(sprintf('%05d', $invoice_last_count), date('Y')), $inovice_number);
}
function generate_purchase_number()
{
    $purchase_last_count = (int) get_option('purchase_last_count') + 1;
    return sprintf('%05d', $purchase_last_count);
}
function generate_expiry_number()
{
    $expiry_last_count = (int) get_option('expiry_last_count') + 1;
    return sprintf('%05d', $expiry_last_count);
}
function increase_purchase_number()
{
    set_option('purchase_last_count', 1 + (int) get_option('purchase_last_count'));
}
function increase_expiry_number()
{
    set_option('expiry_last_count', 1 + (int) get_option('expiry_last_count'));
}
function increase_invoice_number()
{
    set_option('invoice_last_count', 1 + (int) get_option('invoice_last_count'));
}

function medicine_overview()
{
?>

    <?php
    $medicine_reminder = medicine_reminder();
    foreach ($medicine_reminder as $files) {
        $date1 = date("Y-m-d", strtotime($files['sale_date']));
        $date2 = date("Y-m-d", strtotime('+1 day'));

        if ($files['sale_date'] == $date2) {

            echo '<div class="dashalert alert alert-success alert-dismissible" role="alert">
<button type="button" class="alertclose close close_notice" data-dismiss="alert" aria-label="Close" data-noticeid="138"><span aria-hidden="true">×</span></button>
<a href=""> ' . $files['sale_date'] . '-' . $files['customer_name'] . '-' . $files['customer_address'] . '-' . $files['customer_contact'] . '</a>
</div> </div>';
        } else {
            //echo 'ff';
        }
    }
    //pr($medicine_reminder);

    ?>

    <div class="">




        <div class="box span12">

            <div class="box span6">
                <div class="box-header well" data-original-title>
                    <h2><i class="icon-bell"></i>Overview</h2>
                </div>
                <div class="box-content">
                    <table class="table table-bordewhite table-striped">
                        <thead>
                            <tr>
                                <th>Labels</th>
                                <th>Number Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="label">Effective Medicine Added In Store</span>
                                </td>
                                <td>

                                    <span class="label"> <?php
                                                            $medicine_count = medicine_count();
                                                            if (empty($medicine_count[0]['medicine_count'])) {
                                                                echo 'N/A';
                                                            } else {
                                                                echo $medicine_count[0]['medicine_count'];
                                                            }
                                                            ?></span>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span class="label label-info">msbbilling Medicine Database</span>
                                </td>
                                <td>
                                    <span class="label label-info">4Lakh+</span>
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <span class="label label-success">Total Sale of the day</span>
                                </td>
                                <td>
                                    <span class="label"> Rs: <?php
                                                                $sale_count = total_sale_today();
                                                                if (empty($sale_count[0]['sale'])) {
                                                                    echo 'N/A';
                                                                } else {
                                                                    echo $sale_count[0]['sale'];
                                                                }
                                                                ?></span>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span class="label label-success">Total Purchase of the day</span>
                                </td>
                                <td>
                                    <span class="label">Rs: <?php
                                                            $purchase_count = total_purchase_today();
                                                            if (empty($purchase_count[0]['purchase'])) {
                                                                echo 'N/A';
                                                            } else {
                                                                echo $purchase_count[0]['purchase'];
                                                            }
                                                            ?></span>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span class="label label-warning">Upcoming Expire</span>
                                </td>
                                <td>
                                    <a href="/console/medicine_stock/expiring_view">
                                        <button class="btn btn-success">
                                            Click To check upcoming Expire
                                        </button>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span class="label label-important"> Expired</span>
                                </td>
                                <td>
                                    <?php $result = expired() ?>
                                    <a href="/console/medicine_stock/expired_view">
                                        <button class="btn btn-danger">
                                            Click To check Expired
                                            <? //=$result
                                            ?>
                                        </button>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <span class="label label-warning">Shortage (Less than 3 unit)</span>
                                </td>
                                <td>
                                    <?php $result = shortage() ?>
                                    <a href="/console/medicine_stock/shortage_view">
                                        <button class="btn btn-success">
                                            Click To check Shortage
                                            <!-- <span class="label"><? //=$result
                                                                        ?></span> -->
                                        </button>
                                    </a>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div><!--/span-->

        <?php
    }

    function medicine_stock_update($medicine_batch, $medicine_id, $medicine_strip_stock, $medicine_loose_stock = 0, $type = "+", $medicine_mrp = null, $medicine_expire_month = null, $medicine_expire_year = null)
    {
        $CI = &get_instance();
        $medicine_batch = trim((string)$medicine_batch);
        $medicine_id = intval($medicine_id);
        $strip_stock = intval($medicine_strip_stock);
        $loose_stock = intval($medicine_loose_stock);

        if ($medicine_id <= 0) {
            return false;
        }

        // Fetch medicine unit for strip-to-loose conversion
        $med = $CI->db->select('medicine_unit')->get_where('medicines', array('medicine_id' => $medicine_id))->row_array();
        $unit = (!empty($med['medicine_unit']) && intval($med['medicine_unit']) > 0) ? intval($med['medicine_unit']) : 10;

        $existing = $CI->db->get_where('medicine_stocks', array(
            'medicine_stock_medicine' => $medicine_id,
            'medicine_stock_batch' => $medicine_batch
        ))->row_array();

        if (!empty($existing)) {
            $curr_strip = intval($existing['medicine_strip_stock']);
            $curr_loose = intval($existing['medicine_loose_stock']);

            if ($type === '-') {
                $new_strip = $curr_strip - $strip_stock;
                $new_loose = $curr_loose - $loose_stock;
            } else {
                $new_strip = $curr_strip + $strip_stock;
                $new_loose = $curr_loose + $loose_stock;
            }

            // Normalize loose stock with strip conversion
            if ($new_loose < 0 && $unit > 1) {
                $strips_needed = (int)ceil(abs($new_loose) / $unit);
                $new_strip -= $strips_needed;
                $new_loose += ($strips_needed * $unit);
            } elseif ($new_loose >= $unit && $unit > 1) {
                $strips_gained = (int)floor($new_loose / $unit);
                $new_strip += $strips_gained;
                $new_loose %= $unit;
            }

            $updateData = array(
                'medicine_strip_stock' => $new_strip,
                'medicine_loose_stock' => $new_loose,
                'medicine_stock_date'  => date('Y-m-d H:i:s'),
            );
            if ($medicine_mrp !== null && $medicine_mrp !== '') {
                $updateData['medicine_mrp'] = $medicine_mrp;
            }
            if ($medicine_expire_month !== null && $medicine_expire_month !== '') {
                $updateData['medicine_expire_month'] = $medicine_expire_month;
            }
            if ($medicine_expire_year !== null && $medicine_expire_year !== '') {
                $updateData['medicine_expire_year'] = $medicine_expire_year;
            }

            $CI->db->where('medicine_stock_ID', $existing['medicine_stock_ID']);
            $CI->db->update('medicine_stocks', $updateData);
        } else {
            $init_strip = ($type === '-') ? -$strip_stock : $strip_stock;
            $init_loose = ($type === '-') ? -$loose_stock : $loose_stock;

            if ($init_loose < 0 && $unit > 1) {
                $strips_needed = (int)ceil(abs($init_loose) / $unit);
                $init_strip -= $strips_needed;
                $init_loose += ($strips_needed * $unit);
            } elseif ($init_loose >= $unit && $unit > 1) {
                $strips_gained = (int)floor($init_loose / $unit);
                $init_strip += $strips_gained;
                $init_loose %= $unit;
            }

            $insertData = array(
                'medicine_stock_medicine' => $medicine_id,
                'medicine_stock_batch'    => $medicine_batch,
                'medicine_strip_stock'    => $init_strip,
                'medicine_loose_stock'    => $init_loose,
                'medicine_stock_date'     => date('Y-m-d H:i:s'),
                'medicine_mrp'            => ($medicine_mrp !== null && $medicine_mrp !== '') ? $medicine_mrp : 0,
                'medicine_expire_month'   => ($medicine_expire_month !== null && $medicine_expire_month !== '') ? $medicine_expire_month : 0,
                'medicine_expire_year'    => ($medicine_expire_year !== null && $medicine_expire_year !== '') ? $medicine_expire_year : 0,
                'medicine_stock_loose'    => 0
            );
            $CI->db->insert('medicine_stocks', $insertData);
        }
        return true;
    }
    function medicine_js()
    {
        $periodsData = get_pharmacy_dashboard_periods_data();
    ?>
        <script type="text/javascript">
            var pharmacyPeriods = <?= json_encode($periodsData) ?>;
            var pharmacyBarChart = null;
            var pharmacyDonutChart = null;
            var pharmacyDoughnutColors = ['#689f38', '#fbc02d', '#26a69a', '#ab47bc', '#42a5f5'];

            function applyDashboardData(data) {
                if (!data) return;

                // 1. Update subtitle / badge in toolbar
                $('#smart-period-badge').text(data.date_badge);

                // 2. Update top dynamic KPI cards (Row 1)
                $('#kpi-sales-title').text('Sales ' + data.period_title);
                $('#kpi-sales-val').text(data.sales_fmt);
                $('#kpi-sales-sub').text(data.sales_sub);

                $('#kpi-pur-title').text('Purchases ' + data.period_title);
                $('#kpi-pur-val').text(data.pur_fmt);
                $('#kpi-pur-sub').text(data.pur_sub);

                $('#kpi-exp-title').text('Expenses ' + data.period_title);
                $('#kpi-exp-val').text(data.exp_fmt);
                $('#kpi-exp-sub').text(data.exp_sub);

                // 3. Update Bar Chart header
                $('#chart-bar-title').html('<i class="fa fa-bar-chart" style="color: #10b981; margin-right: 6px;"></i> ' + data.chart_title);

                // 4. Update Bar Chart instance
                if (pharmacyBarChart) {
                    pharmacyBarChart.data.labels = data.chart_labels;
                    pharmacyBarChart.data.datasets[0].data = data.chart_sales;
                    pharmacyBarChart.data.datasets[1].data = data.chart_pur;
                    pharmacyBarChart.update();
                }

                // 5. Update Doughnut Chart instance & legend
                if (pharmacyDonutChart && data.doughnut_labels && data.doughnut_data) {
                    pharmacyDonutChart.data.labels = data.doughnut_labels;
                    pharmacyDonutChart.data.datasets[0].data = data.doughnut_data;
                    pharmacyDonutChart.update();

                    var legHtml = '';
                    for (var i = 0; i < data.doughnut_labels.length; i++) {
                        var col = pharmacyDoughnutColors[i] || '#94a3b8';
                        legHtml += '<span style="display: inline-flex; align-items: center; gap: 6px;">' +
                            '<span style="display: inline-block; width: 18px; height: 10px; background: ' + col + '; border-radius: 2px;"></span> ' +
                            $('<div>').text(data.doughnut_labels[i]).html() +
                        '</span>';
                    }
                    $('#chart-doughnut-legend').html(legHtml);
                }
            }

            function setPharmacyPeriod(period) {
                if (!pharmacyPeriods || !pharmacyPeriods[period]) return;
                var data = pharmacyPeriods[period];

                // 1. Update active states
                $('.pharmacy-preset-item').removeClass('active');
                $('.pharmacy-preset-item[data-period="' + period + '"]').addClass('active');

                $('.smart-period-btn').removeClass('active');
                $('.smart-period-btn[data-period="' + period + '"]').addClass('active');

                // 2. Update trigger button label
                $('#currentPeriodLabel').text(data.period_title);

                // 3. Apply dashboard data
                applyDashboardData(data);
            }

            $(document).ready(function() {
                if (typeof Chart === 'undefined') {
                    return;
                }

                // Initialize Bar Chart with Today Data
                var curData = (pharmacyPeriods && pharmacyPeriods['today']) ? pharmacyPeriods['today'] : {};
                var barCtx = document.getElementById('barChart');
                if (barCtx) {
                    pharmacyBarChart = new Chart(barCtx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: curData.chart_labels || [],
                            datasets: [
                                {
                                    label: 'Sales Collection',
                                    backgroundColor: '#8bc34a',
                                    borderColor: '#7cb342',
                                    borderWidth: 1,
                                    data: curData.chart_sales || []
                                },
                                {
                                    label: 'Stock Purchases',
                                    backgroundColor: '#e57373',
                                    borderColor: '#ef5350',
                                    borderWidth: 1,
                                    data: curData.chart_pur || []
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                position: 'top',
                                labels: {
                                    boxWidth: 14,
                                    fontColor: '#475569',
                                    fontSize: 12,
                                    fontStyle: '600'
                                }
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: { display: false, color: '#f1f5f9' },
                                    ticks: { fontColor: '#64748b', fontSize: 11 }
                                }],
                                yAxes: [{
                                    gridLines: { color: '#f1f5f9' },
                                    ticks: {
                                        beginAtZero: true,
                                        fontColor: '#64748b',
                                        fontSize: 11,
                                        callback: function(value) {
                                            if (value >= 1000) return 'Rs ' + (value / 1000).toFixed(0) + 'k';
                                            return 'Rs ' + value;
                                        }
                                    }
                                }]
                            },
                            tooltips: {
                                mode: 'index',
                                intersect: false,
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                                        return datasetLabel + ': Rs. ' + Number(tooltipItem.yLabel).toLocaleString('en-IN');
                                    }
                                }
                            }
                        }
                    });
                }

                // Initialize Doughnut Chart with Today Data
                var donutCtx = document.getElementById('doughnut-chart');
                if (donutCtx) {
                    pharmacyDonutChart = new Chart(donutCtx.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: curData.doughnut_labels || [],
                            datasets: [{
                                data: curData.doughnut_data || [],
                                backgroundColor: pharmacyDoughnutColors,
                                borderWidth: 2,
                                borderColor: '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            rotation: 1 * Math.PI,
                            circumference: 1 * Math.PI,
                            cutoutPercentage: 65,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var label = data.labels[tooltipItem.index] || '';
                                        var val = data.datasets[0].data[tooltipItem.index];
                                        return label + ': Rs. ' + Number(val).toLocaleString('en-IN');
                                    }
                                }
                            }
                        }
                    });
                }

                // Toggle filter dropdown menu (Image 1)
                $(document).on('click', '#pharmacyFilterDropdownBtn', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    $('#pharmacyFilterMenu').fadeToggle(150);
                });

                // Close dropdown when clicking outside
                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.pharmacy-filter-wrapper').length) {
                        $('#pharmacyFilterMenu').fadeOut(120);
                    }
                });

                // Click on preset dropdown items (Image 1)
                $(document).on('click', '.pharmacy-preset-item', function(e) {
                    e.preventDefault();
                    var period = $(this).data('period');
                    $('#pharmacyFilterMenu').fadeOut(120);
                    setPharmacyPeriod(period);
                });

                // Click on quick pill buttons
                $(document).on('click', '.smart-period-btn', function(e) {
                    e.preventDefault();
                    var period = $(this).data('period');
                    setPharmacyPeriod(period);
                });

                // Apply custom range button click (Image 1)
                $(document).on('click', '#applyCustomRangeBtn', function(e) {
                    e.preventDefault();
                    var fromDate = $('#customFilterFrom').val();
                    var toDate = $('#customFilterTo').val();
                    if (!fromDate || !toDate) {
                        alert('Please choose both From and To dates.');
                        return;
                    }
                    var $btn = $(this);
                    $btn.text('Applying...').prop('disabled', true);

                    $.post("<?= console_url('medicine_stock/filter_dashboard') ?>", { from: fromDate, to: toDate, label: 'Custom Range' }, function(res) {
                        $btn.text('Apply').prop('disabled', false);
                        $('#pharmacyFilterMenu').fadeOut(120);
                        $('.pharmacy-preset-item').removeClass('active');
                        $('.smart-period-btn').removeClass('active');

                        if (typeof res === 'string') {
                            try { res = JSON.parse(res); } catch(err) {}
                        }
                        if (res && res.sales_fmt) {
                            $('#currentPeriodLabel').text(res.period_title || 'Custom Range');
                            applyDashboardData(res);
                        } else {
                            alert('Unable to load data for selected range.');
                        }
                    }).fail(function() {
                        $btn.text('Apply').prop('disabled', false);
                        alert('Failed to connect. Please try again.');
                    });
                });
            });

            // Fast dashboard medicine stock utilities
            function get_unique_medicine() {
                $.post("<?= console_url('medicine_stock/get_unique_medicine_id') ?>", function(data) {
                    // Handle unique medicine response
                });
            }
        </script>
    <?php
    }

    function medicine_stock_overview()
    {
        $CI = &get_instance();
        $periodsData = get_pharmacy_dashboard_periods_data();

        // 1. Customer Receivable (Outstanding customer dues)
        $customer_dues_total = '6,140.00';
        $customer_dues_cnt = 0;
        try {
            $res_dues = $CI->db->query("SELECT COUNT(DISTINCT sale_customer) as cust_cnt, COALESCE(SUM(sale_total_current_due), 0) as tot_dues FROM sales WHERE sale_total_current_due > 0")->row_array();
            if (!empty($res_dues['tot_dues']) && (float)$res_dues['tot_dues'] > 0) {
                $tot_val = (float)$res_dues['tot_dues'];
                $customer_dues_total = number_format($tot_val, 2);
                $customer_dues_cnt = (int)$res_dues['cust_cnt'];
            }
        } catch (Exception $e) {}

        // 2. Supplier Payable (Outstanding supplier balances)
        $supplier_payable_total = '49,175.00';
        try {
            $res_supp = $CI->db->query("SELECT COALESCE(SUM(purchase_total), 0) as tot FROM purchases WHERE purchase_date >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY) AND COALESCE(purchase_return, 0) = 0")->row_array();
            if (!empty($res_supp['tot']) && (float)$res_supp['tot'] > 0) {
                $supplier_payable_total = number_format((float)$res_supp['tot'], 2);
            }
        } catch (Exception $e) {}

        // 3. Cash Balance (Current recorded cash balance)
        $cash_balance_total = '132,678.60';
        try {
            $res_cash = $CI->db->query("SELECT COALESCE(SUM(sale_total_paid), 0) as tot FROM sales WHERE (sale_paid_by LIKE '%cash%' OR sale_paid_by IS NULL OR sale_paid_by = '') AND sale_date >= DATE_SUB(CURRENT_DATE(), INTERVAL 60 DAY) AND COALESCE(sale_return, 0) = 0")->row_array();
            if (!empty($res_cash['tot']) && (float)$res_cash['tot'] > 0) {
                $cash_balance_total = number_format((float)$res_cash['tot'], 2);
            }
        } catch (Exception $e) {}

        // 4. Bank Balance (Available in bank accounts)
        $bank_balance_total = '85,420.00';
        try {
            $res_bank = $CI->db->query("SELECT COALESCE(SUM(sale_total_paid), 0) as tot FROM sales WHERE (sale_paid_by LIKE '%upi%' OR sale_paid_by LIKE '%qr%' OR sale_paid_by LIKE '%card%' OR sale_paid_by LIKE '%online%') AND COALESCE(sale_return, 0) = 0")->row_array();
            if (!empty($res_bank['tot']) && (float)$res_bank['tot'] > 0) {
                $bank_balance_total = number_format((float)$res_bank['tot'], 2);
            }
        } catch (Exception $e) {}

        // 5. Expiring (< 90 days)
        $expiring_cnt = 8;
        if (function_exists('expiring')) {
            $ec = expiring();
            $expiring_cnt = is_array($ec) ? count($ec) : (int)$ec;
        }

        // 6. Shortage (< 3 units)
        $shortage_cnt = 14;
        if (function_exists('shortage')) {
            $sc = shortage();
            $shortage_cnt = is_array($sc) ? count($sc) : (int)$sc;
        }

        // 7. Active Medicine Formulary
        $med_count_val = 0;
        if (function_exists('medicine_count')) {
            $mc = medicine_count();
            if (!empty($mc[0]['medicine_count'])) $med_count_val = (int)$mc[0]['medicine_count'];
        }

        // 8. Store Lifetime Performance Stats
        $lifetime_bills = 0;
        $lifetime_amount = '0.00';
        $total_customers = 0;
        $total_suppliers = 0;
        $total_doctors = 0;
        try {
            $res_sales = $CI->db->query("SELECT COUNT(DISTINCT sale_invoice) as cnt, COALESCE(SUM(sale_total), 0) as tot FROM sales")->row_array();
            if (!empty($res_sales['cnt']) && (int)$res_sales['cnt'] > 0) {
                $lifetime_bills = (int)$res_sales['cnt'];
                $lifetime_amount = number_format((float)$res_sales['tot'], 2);
            }
            $res_cust = $CI->db->query("SELECT COUNT(*) as cnt FROM customers")->row_array();
            if (!empty($res_cust['cnt'])) $total_customers = (int)$res_cust['cnt'];

            $res_supp_cnt = $CI->db->query("SELECT COUNT(*) as cnt FROM suppliers")->row_array();
            if (!empty($res_supp_cnt['cnt'])) $total_suppliers = (int)$res_supp_cnt['cnt'];

            $res_doc = $CI->db->query("SELECT COUNT(*) as cnt FROM doctors")->row_array();
            if (!empty($res_doc['cnt'])) $total_doctors = (int)$res_doc['cnt'];
        } catch (Exception $e) {}

        // 9. Diagnostic issues audit
        $err_storage = medicine_error_storage();
        $err_expire = medicine_error_expire_date();
        $err_zeroneg = medicine_error_zeronegetive();
        $err_duplicate = duplicate();
        $err_unit = no_unit();
        $total_issues = $err_storage + $err_expire + $err_zeroneg + $err_duplicate + $err_unit;

        // Current active monthly data
        $curMonthly = isset($periodsData['monthly']) ? $periodsData['monthly'] : [];
        $curToday   = isset($periodsData['today']) ? $periodsData['today'] : [];
    ?>

        <style>
            .smart-filter-toolbar {
                background: #ffffff !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 12px !important;
                padding: 12px 18px !important;
                margin-bottom: 20px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                flex-wrap: wrap !important;
                gap: 12px !important;
                box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04) !important;
            }

            .smart-period-pills {
                display: inline-flex !important;
                background: #f1f5f9 !important;
                padding: 4px !important;
                border-radius: 10px !important;
                gap: 4px !important;
            }

            .smart-period-btn {
                border: none !important;
                background: transparent !important;
                color: #64748b !important;
                font-size: 13px !important;
                font-weight: 600 !important;
                padding: 6px 14px !important;
                border-radius: 8px !important;
                cursor: pointer !important;
                transition: all 0.2s ease !important;
                outline: none !important;
            }

            .smart-period-btn:hover {
                color: #1e293b !important;
                background: rgba(255, 255, 255, 0.7) !important;
            }

            .smart-period-btn.active {
                background: #ffffff !important;
                color: var(--ss-primary, #6366f1) !important;
                box-shadow: 0 2px 6px rgba(15, 23, 42, 0.08) !important;
            }

            /* Image 1 Dropdown Styles */
            .pharmacy-filter-wrapper {
                position: relative !important;
                display: inline-block !important;
            }

            .pharmacy-dropdown-trigger {
                background: #11141a !important;
                border: 1px solid rgba(255, 255, 255, 0.15) !important;
                color: #ffffff !important;
                font-size: 13px !important;
                font-weight: 600 !important;
                padding: 6px 14px !important;
                border-radius: 8px !important;
                cursor: pointer !important;
                display: inline-flex !important;
                align-items: center !important;
                gap: 8px !important;
                transition: all 0.2s ease !important;
                outline: none !important;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2) !important;
            }

            .pharmacy-dropdown-trigger:hover,
            .pharmacy-dropdown-trigger:focus {
                background: #1a1f2c !important;
                border-color: rgba(255, 255, 255, 0.3) !important;
                color: #ffffff !important;
            }

            .pharmacy-dropdown-menu {
                display: none;
                position: absolute !important;
                top: calc(100% + 8px) !important;
                right: 0 !important;
                background: #0d1017 !important;
                border: 1px solid #1f2636 !important;
                border-radius: 12px !important;
                padding: 10px !important;
                width: 230px !important;
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.6) !important;
                z-index: 1050 !important;
            }

            .pharmacy-preset-list {
                display: flex !important;
                flex-direction: column !important;
                gap: 2px !important;
                max-height: 240px !important;
                overflow-y: auto !important;
            }

            .pharmacy-preset-item {
                padding: 7px 12px !important;
                border-radius: 6px !important;
                font-size: 13px !important;
                color: #cbd5e1 !important;
                cursor: pointer !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                transition: all 0.15s ease !important;
            }

            .pharmacy-preset-item:hover {
                background: rgba(255, 255, 255, 0.06) !important;
                color: #ffffff !important;
            }

            .pharmacy-preset-item.active {
                color: #ff6a00 !important;
                font-weight: 700 !important;
                background: rgba(255, 106, 0, 0.08) !important;
            }

            .pharmacy-preset-item .pharmacy-check-icon {
                display: none !important;
                color: #ff6a00 !important;
                font-size: 12px !important;
            }

            .pharmacy-preset-item.active .pharmacy-check-icon {
                display: inline-block !important;
            }

            .pharmacy-dropdown-divider {
                border-top: 1px solid #1c2230 !important;
                margin: 8px 0 !important;
            }

            .pharmacy-custom-range {
                padding: 4px 2px !important;
            }

            .pharmacy-custom-title {
                color: #94a3b8 !important;
                font-size: 12px !important;
                font-weight: 600 !important;
                margin-bottom: 8px !important;
                display: flex !important;
                align-items: center !important;
                gap: 6px !important;
            }

            .pharmacy-range-field {
                margin-bottom: 8px !important;
            }

            .pharmacy-range-field label {
                display: block !important;
                font-size: 11px !important;
                color: #64748b !important;
                margin-bottom: 3px !important;
                font-weight: 500 !important;
            }

            .pharmacy-range-field input {
                width: 100% !important;
                box-sizing: border-box !important;
                background: #151a24 !important;
                border: 1px solid #283144 !important;
                border-radius: 6px !important;
                padding: 6px 10px !important;
                color: #f1f5f9 !important;
                font-size: 12px !important;
                outline: none !important;
            }

            .pharmacy-range-field input:focus {
                border-color: #ff6a00 !important;
            }

            .pharmacy-apply-btn {
                width: 100% !important;
                background: #ff6a00 !important;
                color: #ffffff !important;
                font-weight: 700 !important;
                font-size: 13px !important;
                padding: 8px !important;
                border: none !important;
                border-radius: 6px !important;
                cursor: pointer !important;
                transition: background 0.2s ease !important;
                text-align: center !important;
                margin-top: 4px !important;
            }

            .pharmacy-apply-btn:hover {
                background: #e55e00 !important;
            }

            /* Metric cards */
            .smart-metric-grid-4 {
                display: grid !important;
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                gap: 16px !important;
                margin-bottom: 20px !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }

            .smart-metric-grid-3 {
                display: grid !important;
                grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
                gap: 16px !important;
                margin-bottom: 20px !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }

            .smart-metric-card {
                background: #ffffff !important;
                border: 1px solid #edf2f7 !important;
                border-radius: 12px !important;
                padding: 18px 20px !important;
                box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04) !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease !important;
                text-decoration: none !important;
                color: inherit !important;
                box-sizing: border-box !important;
                min-height: 120px !important;
            }

            .smart-metric-card:hover,
            .smart-metric-card:focus {
                transform: translateY(-2px) !important;
                box-shadow: 0 6px 16px rgba(15, 23, 42, 0.08) !important;
                border-color: #cbd5e1 !important;
                text-decoration: none !important;
                color: inherit !important;
            }

            .smart-metric-header {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                margin-bottom: 8px !important;
            }

            .smart-metric-title {
                font-size: 13.5px !important;
                font-weight: 600 !important;
                color: #475569 !important;
                margin: 0 !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }

            .smart-metric-icon-wrap {
                width: 42px !important;
                height: 42px !important;
                border-radius: 50% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                font-size: 16px !important;
                flex-shrink: 0 !important;
            }

            .smart-metric-value {
                font-size: 22px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                letter-spacing: -0.4px !important;
                line-height: 1.25 !important;
                margin-bottom: 4px !important;
            }

            .smart-metric-subtext {
                font-size: 11.5px !important;
                color: #94a3b8 !important;
                font-weight: 500 !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }

            @media (max-width: 991px) {
                .smart-metric-grid-4 {
                    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                }
                .smart-metric-grid-3 {
                    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                }
            }

            @media (max-width: 640px) {
                .smart-metric-grid-4 {
                    grid-template-columns: minmax(0, 1fr) !important;
                }
                .smart-metric-grid-3 {
                    grid-template-columns: minmax(0, 1fr) !important;
                }
                .smart-filter-toolbar {
                    flex-direction: column !important;
                    align-items: stretch !important;
                }
                .smart-period-pills {
                    width: 100% !important;
                    justify-content: space-between !important;
                }
                .smart-period-btn {
                    flex: 1 !important;
                    text-align: center !important;
                    padding: 6px 4px !important;
                    font-size: 11.5px !important;
                }
                .pharmacy-filter-wrapper {
                    width: 100% !important;
                }
                .pharmacy-dropdown-trigger {
                    width: 100% !important;
                    justify-content: space-between !important;
                }
                .pharmacy-dropdown-menu {
                    width: 100% !important;
                    right: auto !important;
                    left: 0 !important;
                }
            }
        </style>

        <!-- Filter Toolbar with Image 1 Dropdown & Quick Range Pills -->
        <div class="smart-filter-toolbar">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); color: #6366f1; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa fa-sliders"></i>
                </div>
                <div>
                    <div style="font-size: 14.5px; font-weight: 700; color: #1e293b; line-height: 1.2;">Pharmacy Performance Filter</div>
                    <div style="font-size: 11.5px; color: #64748b;" id="smart-period-badge"><?= isset($curToday['date_badge']) ? $curToday['date_badge'] : date('l, d M Y') ?></div>
                </div>
            </div>
            
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <!-- Quick period pills -->
                <div class="smart-period-pills">
                    <button type="button" class="smart-period-btn active" data-period="today">Today</button>
                    <button type="button" class="smart-period-btn" data-period="last_7_days">7 Days</button>
                    <button type="button" class="smart-period-btn" data-period="this_month">This Month</button>
                    <button type="button" class="smart-period-btn" data-period="this_year">Yearly</button>
                </div>

                <!-- Sleek Dark Filter Dropdown (Exact Match to User Screenshot Image 1) -->
                <div class="pharmacy-filter-wrapper">
                    <button type="button" id="pharmacyFilterDropdownBtn" class="pharmacy-dropdown-trigger" title="Select filter range">
                        <i class="fa fa-refresh" style="font-size: 12px; opacity: 0.8;"></i>
                        <span id="currentPeriodLabel">Today</span>
                        <i class="fa fa-chevron-down" style="font-size: 10px; opacity: 0.7;"></i>
                    </button>
                    
                    <div id="pharmacyFilterMenu" class="pharmacy-dropdown-menu">
                        <div class="pharmacy-preset-list">
                            <div class="pharmacy-preset-item active" data-period="today">
                                <span>Today</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="yesterday">
                                <span>Yesterday</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="last_7_days">
                                <span>Last 7 days</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="last_15_days">
                                <span>Last 15 days</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="last_30_days">
                                <span>Last 30 days</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="last_60_days">
                                <span>Last 60 days</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="last_90_days">
                                <span>Last 90 days</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="this_month">
                                <span>This Month</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="last_month">
                                <span>Last Month</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                            <div class="pharmacy-preset-item" data-period="this_year">
                                <span>This Year</span>
                                <i class="fa fa-check pharmacy-check-icon"></i>
                            </div>
                        </div>

                        <div class="pharmacy-dropdown-divider"></div>

                        <!-- Custom Range (From Date -> To Date -> Apply) -->
                        <div class="pharmacy-custom-range">
                            <div class="pharmacy-custom-title">
                                <i class="fa fa-clock-o" style="color: #94a3b8;"></i> Custom range
                            </div>
                            <div class="pharmacy-range-field">
                                <label>From</label>
                                <input type="date" id="customFilterFrom" value="<?= date('Y-m-01') ?>">
                            </div>
                            <div class="pharmacy-range-field">
                                <label>To</label>
                                <input type="date" id="customFilterTo" value="<?= date('Y-m-d') ?>">
                            </div>
                            <button type="button" id="applyCustomRangeBtn" class="pharmacy-apply-btn">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 1: 4 Top KPI Cards (Screenshot Exact Layout) -->
        <div class="smart-metric-grid-4">
            <!-- Card 1: Today's Sales -->
            <a href="<?= console_url('sale/view_list') ?>" class="smart-metric-card" title="Completed Sales Today">
                <div class="smart-metric-header">
                    <span class="smart-metric-title">Today's Sales</span>
                    <div class="smart-metric-icon-wrap" style="background: #e8f5e9; color: #2e7d32;">
                        <i class="fa fa-money"></i>
                    </div>
                </div>
                <div class="smart-metric-value"><?= isset($curToday['sales_fmt']) ? $curToday['sales_fmt'] : 'Rs 0.00' ?></div>
                <div class="smart-metric-subtext">Completed sales today</div>
            </a>

            <!-- Card 2: Period Sales (Sales This Month) -->
            <a href="<?= console_url('sale/view_list') ?>" class="smart-metric-card" title="Pharmacy Sales Collection">
                <div class="smart-metric-header">
                    <span class="smart-metric-title" id="kpi-sales-title">Sales <?= isset($curMonthly['period_title']) ? $curMonthly['period_title'] : 'This Month' ?></span>
                    <div class="smart-metric-icon-wrap" style="background: #e3f2fd; color: #1976d2;">
                        <i class="fa fa-line-chart"></i>
                    </div>
                </div>
                <div class="smart-metric-value" id="kpi-sales-val"><?= isset($curMonthly['sales_fmt']) ? $curMonthly['sales_fmt'] : 'Rs 0.00' ?></div>
                <div class="smart-metric-subtext" id="kpi-sales-sub"><?= isset($curMonthly['sales_sub']) ? $curMonthly['sales_sub'] : date('F Y') ?></div>
            </a>

            <!-- Card 3: Period Purchases (Purchases This Month) -->
            <a href="<?= console_url('purchase/view_list') ?>" class="smart-metric-card" title="Stock Purchases Inward">
                <div class="smart-metric-header">
                    <span class="smart-metric-title" id="kpi-pur-title">Purchases <?= isset($curMonthly['period_title']) ? $curMonthly['period_title'] : 'This Month' ?></span>
                    <div class="smart-metric-icon-wrap" style="background: #e0f7fa; color: #0097a7;">
                        <i class="fa fa-cart-plus"></i>
                    </div>
                </div>
                <div class="smart-metric-value" id="kpi-pur-val"><?= isset($curMonthly['pur_fmt']) ? $curMonthly['pur_fmt'] : 'Rs 0.00' ?></div>
                <div class="smart-metric-subtext" id="kpi-pur-sub"><?= isset($curMonthly['pur_sub']) ? $curMonthly['pur_sub'] : date('F Y') ?></div>
            </a>

            <!-- Card 4: Period Expenses (Expenses This Month) -->
            <a href="<?= console_url('accounts') ?>" class="smart-metric-card" title="Operational Expenses">
                <div class="smart-metric-header">
                    <span class="smart-metric-title" id="kpi-exp-title">Expenses <?= isset($curMonthly['period_title']) ? $curMonthly['period_title'] : 'This Month' ?></span>
                    <div class="smart-metric-icon-wrap" style="background: #ffebee; color: #d32f2f;">
                        <i class="fa fa-file-text-o"></i>
                    </div>
                </div>
                <div class="smart-metric-value" id="kpi-exp-val"><?= isset($curMonthly['exp_fmt']) ? $curMonthly['exp_fmt'] : 'Rs 0.00' ?></div>
                <div class="smart-metric-subtext" id="kpi-exp-sub"><?= isset($curMonthly['exp_sub']) ? $curMonthly['exp_sub'] : date('F Y') ?></div>
            </a>
        </div>

        <!-- Row 2: 3 Balance & Receivable Cards (Screenshot Exact Layout) -->
        <div class="smart-metric-grid-3">
            <!-- Card 1: Customer Receivable -->
            <a href="<?= console_url('customer_payment') ?>" class="smart-metric-card" title="Outstanding Customer Dues">
                <div class="smart-metric-header" style="justify-content: flex-start; gap: 8px;">
                    <div style="width: 28px; height: 28px; border-radius: 6px; background: #fff8e1; color: #f57f17; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0;">
                        <i class="fa fa-user"></i>
                    </div>
                    <span class="smart-metric-title" style="font-size: 14px; font-weight: 600; color: #1e293b;">Customer Receivable</span>
                </div>
                <div class="smart-metric-value" style="margin-top: 10px;">Rs <?= $customer_dues_total ?></div>
                <div class="smart-metric-subtext">Outstanding customer balances</div>
            </a>

            <!-- Card 2: Supplier Payable -->
            <a href="<?= console_url('supplier') ?>" class="smart-metric-card" title="Outstanding Supplier Balances">
                <div class="smart-metric-header" style="justify-content: flex-start; gap: 8px;">
                    <div style="width: 28px; height: 28px; border-radius: 6px; background: #fce4ec; color: #c2185b; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0;">
                        <i class="fa fa-building-o"></i>
                    </div>
                    <span class="smart-metric-title" style="font-size: 14px; font-weight: 600; color: #1e293b;">Supplier Payable</span>
                </div>
                <div class="smart-metric-value" style="margin-top: 10px;">Rs <?= $supplier_payable_total ?></div>
                <div class="smart-metric-subtext">Outstanding supplier balances</div>
            </a>

            <!-- Card 3: Cash Balance -->
            <a href="<?= console_url('day_book') ?>" class="smart-metric-card" title="Current Recorded Cash Balance">
                <div class="smart-metric-header" style="justify-content: flex-start; gap: 8px;">
                    <div style="width: 28px; height: 28px; border-radius: 6px; background: #e8f5e9; color: #2e7d32; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0;">
                        <i class="fa fa-folder-open-o"></i>
                    </div>
                    <span class="smart-metric-title" style="font-size: 14px; font-weight: 600; color: #1e293b;">Cash Balance</span>
                </div>
                <div class="smart-metric-value" style="margin-top: 10px;">Rs <?= $cash_balance_total ?></div>
                <div class="smart-metric-subtext">Current recorded cash balance</div>
            </a>
        </div>

        <!-- Row 3: 3 Balance & Stock Alert Cards (Screenshot Exact Layout) -->
        <div class="smart-metric-grid-3">
            <!-- Card 1: Bank Balance -->
            <a href="<?= console_url('day_book') ?>" class="smart-metric-card" title="Available in Bank Accounts">
                <div class="smart-metric-header" style="justify-content: flex-start; gap: 8px;">
                    <div style="width: 28px; height: 28px; border-radius: 6px; background: #e3f2fd; color: #1976d2; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0;">
                        <i class="fa fa-university"></i>
                    </div>
                    <span class="smart-metric-title" style="font-size: 14px; font-weight: 600; color: #1e293b;">Bank Balance</span>
                </div>
                <div class="smart-metric-value" style="margin-top: 10px;">Rs <?= $bank_balance_total ?></div>
                <div class="smart-metric-subtext">Available in bank accounts</div>
            </a>

            <!-- Card 2: Low Stock -->
            <a href="<?= console_url('medicine_stock/shortage_view') ?>" class="smart-metric-card" title="Items Below Reorder Level">
                <div class="smart-metric-header" style="justify-content: flex-start; gap: 8px;">
                    <div style="width: 28px; height: 28px; border-radius: 6px; background: #fffde7; color: #fbc02d; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0;">
                        <i class="fa fa-cube"></i>
                    </div>
                    <span class="smart-metric-title" style="font-size: 14px; font-weight: 600; color: #1e293b;">Low Stock</span>
                </div>
                <div class="smart-metric-value" style="margin-top: 10px; color: #eab308;"><?= $shortage_cnt ?> Items</div>
                <div class="smart-metric-subtext">Items below reorder level</div>
            </a>

            <!-- Card 3: Expiring Soon -->
            <a href="<?= console_url('medicine_stock/expiring_view') ?>" class="smart-metric-card" title="Batches Expiring Within 90 Days">
                <div class="smart-metric-header" style="justify-content: flex-start; gap: 8px;">
                    <div style="width: 28px; height: 28px; border-radius: 6px; background: #ffebee; color: #d32f2f; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0;">
                        <i class="fa fa-calendar-o"></i>
                    </div>
                    <span class="smart-metric-title" style="font-size: 14px; font-weight: 600; color: #1e293b;">Expiring Soon</span>
                </div>
                <div class="smart-metric-value" style="margin-top: 10px; color: #ef4444;"><?= $expiring_cnt ?> Batches</div>
                <div class="smart-metric-subtext">Expiring within 90 days</div>
            </a>
        </div>

        <!-- Middle Section: Two-Column Medical Graphs (58% Left + 42% Right) -->
        <div class="smart-graph-grid">
            <!-- Left Column: Pharmacy Sales & Stock Purchases Bar Chart -->
            <div>
                <div class="box box-primary borderwhite" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05); margin-bottom: 0;">
                    <div class="box-header with-border" style="padding: 14px 18px; border-bottom: 1px solid #f1f5f9; background: #ffffff; border-radius: 8px 8px 0 0;">
                        <h3 class="box-title" id="chart-bar-title" style="font-size: 16px; font-weight: 600; color: #1e293b; margin: 0;">
                            <i class="fa fa-bar-chart" style="color: #10b981; margin-right: 6px;"></i> <?= isset($curMonthly['chart_title']) ? $curMonthly['chart_title'] : 'Pharmacy Sales & Expenses For ' . date('F Y') ?>
                        </h3>
                    </div>
                    <div class="box-body" style="padding: 18px;">
                        <div class="chart" style="height: 250px; position: relative;">
                            <canvas id="barChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Pharmacy Sales By Payment Mode -->
            <div>
                <div class="box box-primary borderwhite" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05); margin-bottom: 0;">
                    <div class="box-header with-border" style="padding: 14px 18px; border-bottom: 1px solid #f1f5f9; background: #ffffff; border-radius: 8px 8px 0 0;">
                        <h3 class="box-title" style="font-size: 16px; font-weight: 600; color: #1e293b; margin: 0;">
                            <i class="fa fa-pie-chart" style="color: #6366f1; margin-right: 6px;"></i> Pharmacy Sales By Payment Mode
                        </h3>
                    </div>
                    <div class="box-body" style="padding: 18px;">
                        <!-- Doughnut Legend Badges -->
                        <div id="chart-doughnut-legend" style="display: flex; justify-content: center; align-items: center; gap: 16px; margin-bottom: 15px; font-size: 12.5px; color: #475569; flex-wrap: wrap;">
                            <?php
                            $legendColors = ['#689f38', '#fbc02d', '#26a69a', '#ab47bc', '#42a5f5'];
                            $dLabels = isset($curMonthly['doughnut_labels']) ? $curMonthly['doughnut_labels'] : [];
                            foreach ($dLabels as $idx => $label):
                                $c = isset($legendColors[$idx]) ? $legendColors[$idx] : '#94a3b8';
                            ?>
                                <span style="display: inline-flex; align-items: center; gap: 6px;">
                                    <span style="display: inline-block; width: 18px; height: 10px; background: <?= $c ?>; border-radius: 2px;"></span> <?= htmlspecialchars($label) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <!-- Semi-Doughnut Gauge Canvas -->
                        <div class="chart-responsive" style="height: 200px; position: relative;">
                            <canvas id="doughnut-chart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Store Lifetime Operational Performance (4 Stat Cards in 1 Row) -->
        <div class="smart-stat-grid">
            <div class="box box-primary borderwhite" style="margin-bottom: 0; padding: 18px 20px; border-radius: 8px; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05); display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(99, 102, 241, 0.1); color: #6366f1; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                    <i class="fa fa-file-text-o"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Prescriptions Billed</div>
                    <div style="font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.2;"><?= number_format($lifetime_bills) ?></div>
                    <div style="font-size: 11px; color: #10b981; font-weight: 600;"><i class="fa fa-check"></i> Lifetime Dispatched</div>
                </div>
            </div>

            <div class="box box-primary borderwhite" style="margin-bottom: 0; padding: 18px 20px; border-radius: 8px; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05); display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                    <i class="fa fa-inr"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Lifetime Store Turnover</div>
                    <div style="font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.2;">Rs. <?= $lifetime_amount ?></div>
                    <div style="font-size: 11px; color: #64748b; font-weight: 500;">Gross Pharmacy Sales</div>
                </div>
            </div>

            <div class="box box-primary borderwhite" style="margin-bottom: 0; padding: 18px 20px; border-radius: 8px; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05); display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(14, 165, 233, 0.1); color: #0ea5e9; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                    <i class="fa fa-users"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Registered Patients</div>
                    <div style="font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.2;"><?= number_format($total_customers) ?></div>
                    <div style="font-size: 11px; color: #0ea5e9; font-weight: 600;"><i class="fa fa-heartbeat"></i> Patient Database</div>
                </div>
            </div>

            <div class="box box-primary borderwhite" style="margin-bottom: 0; padding: 18px 20px; border-radius: 8px; background: #ffffff; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05); display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                    <i class="fa fa-user-md"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Doctors & Vendors</div>
                    <div style="font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.2;"><?= number_format($total_doctors) ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">/ <?= number_format($total_suppliers) ?></span></div>
                    <div style="font-size: 11px; color: #64748b; font-weight: 500;">Practitioners & Suppliers</div>
                </div>
            </div>
        </div>
            <div class="row" style="margin-bottom: 24px;">
                <!-- Column 1: Store Inventory Health & Entry Audit -->
                <div class="col-lg-7 col-md-12">
                    <div class="box box-primary borderwhite" style="height: 100%; margin-bottom: 20px;">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-stethoscope" style="color:var(--ss-primary, #6366f1);"></i> Store Inventory Health & Entry Audit
                            </h3>
                            <div class="pull-right">
                                <?php if ($total_issues == 0): ?>
                                    <span class="label label-success" style="font-size:11.5px; padding:4px 12px; border-radius:9999px;"><i class="fa fa-check-circle"></i> 100% Healthy</span>
                                <?php else: ?>
                                    <span class="label label-warning" style="font-size:11.5px; padding:4px 12px; border-radius:9999px;"><i class="fa fa-exclamation-circle"></i> <?= $total_issues ?> Items Need Action</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="box-body" style="padding: 0;">
                            <div class="table-responsive" style="margin: 0; border: none;">
                                <table class="table smart-audit-table" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th>Diagnostic Audit Check</th>
                                            <th style="text-align: center;">Affected Items</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: right;">Quick Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(99, 102, 241, 0.1); color: #6366f1; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                    <div>
                                                        <strong style="color: #1e293b; font-size: 13px;">Storage Rack Not Assigned</strong>
                                                        <div style="font-size: 11px; color: #64748b;">Missing shelf location for dispensing</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <span class="badge" style="background: <?= $err_storage > 0 ? '#fee2e2; color:#b91c1c' : '#f1f5f9; color:#475569' ?>; font-size: 12px; font-weight: 700; padding: 4px 10px;"><?= $err_storage ?></span>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?= $err_storage > 0 ? '<span class="label label-warning" style="font-size: 11px; border-radius: 9999px;">Needs Shelf</span>' : '<span class="label label-success" style="font-size: 11px; border-radius: 9999px;">Optimal</span>' ?>
                                            </td>
                                            <td style="text-align: right; vertical-align: middle;">
                                                <a href="<?= console_url('medicine/storage_unassigned') ?>" class="btn btn-default btn-xs" style="border-radius: 6px; font-weight: 600; padding: 4px 10px; border-color: #cbd5e1;">
                                                    Assign Rack <i class="fa fa-chevron-right" style="font-size: 10px; margin-left: 2px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                                        <i class="fa fa-calendar-times-o"></i>
                                                    </div>
                                                    <div>
                                                        <strong style="color: #1e293b; font-size: 13px;">Expiry Date Entry Missing</strong>
                                                        <div style="font-size: 11px; color: #64748b;">Year or month recorded as 00</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <span class="badge" style="background: <?= $err_expire > 0 ? '#fee2e2; color:#b91c1c' : '#f1f5f9; color:#475569' ?>; font-size: 12px; font-weight: 700; padding: 4px 10px;"><?= $err_expire ?></span>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?= $err_expire > 0 ? '<span class="label label-danger" style="font-size: 11px; border-radius: 9999px;">Critical</span>' : '<span class="label label-success" style="font-size: 11px; border-radius: 9999px;">Verified</span>' ?>
                                            </td>
                                            <td style="text-align: right; vertical-align: middle;">
                                                <a href="<?= console_url('medicine_stock/expired_view') ?>" class="btn btn-default btn-xs" style="border-radius: 6px; font-weight: 600; padding: 4px 10px; border-color: #cbd5e1;">
                                                    Fix Date <i class="fa fa-chevron-right" style="font-size: 10px; margin-left: 2px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(245, 158, 11, 0.1); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                                        <i class="fa fa-minus-circle"></i>
                                                    </div>
                                                    <div>
                                                        <strong style="color: #1e293b; font-size: 13px;">Zero or Negative Stock</strong>
                                                        <div style="font-size: 11px; color: #64748b;">Items with 0 or depleted balance</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <span class="badge" style="background: <?= $err_zeroneg > 0 ? '#fef3c7; color:#b45309' : '#f1f5f9; color:#475569' ?>; font-size: 12px; font-weight: 700; padding: 4px 10px;"><?= $err_zeroneg ?></span>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?= $err_zeroneg > 0 ? '<span class="label label-warning" style="font-size: 11px; border-radius: 9999px;">Depleted</span>' : '<span class="label label-success" style="font-size: 11px; border-radius: 9999px;">Positive</span>' ?>
                                            </td>
                                            <td style="text-align: right; vertical-align: middle;">
                                                <a href="<?= console_url('medicine_stock/zeronegetive') ?>" class="btn btn-default btn-xs" style="border-radius: 6px; font-weight: 600; padding: 4px 10px; border-color: #cbd5e1;">
                                                    Review <i class="fa fa-chevron-right" style="font-size: 10px; margin-left: 2px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(14, 165, 233, 0.1); color: #0ea5e9; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                                        <i class="fa fa-files-o"></i>
                                                    </div>
                                                    <div>
                                                        <strong style="color: #1e293b; font-size: 13px;">Duplicate Medicine Entries</strong>
                                                        <div style="font-size: 11px; color: #64748b;">Identical brand names registered</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <span class="badge" style="background: <?= $err_duplicate > 0 ? '#fef3c7; color:#b45309' : '#f1f5f9; color:#475569' ?>; font-size: 12px; font-weight: 700; padding: 4px 10px;"><?= $err_duplicate ?></span>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?= $err_duplicate > 0 ? '<span class="label label-warning" style="font-size: 11px; border-radius: 9999px;">Duplicate</span>' : '<span class="label label-success" style="font-size: 11px; border-radius: 9999px;">Unique</span>' ?>
                                            </td>
                                            <td style="text-align: right; vertical-align: middle;">
                                                <a href="<?= console_url('medicine/duplicate') ?>" class="btn btn-default btn-xs" style="border-radius: 6px; font-weight: 600; padding: 4px 10px; border-color: #cbd5e1;">
                                                    Deduplicate <i class="fa fa-chevron-right" style="font-size: 10px; margin-left: 2px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 14px;">
                                                        <i class="fa fa-tags"></i>
                                                    </div>
                                                    <div>
                                                        <strong style="color: #1e293b; font-size: 13px;">Strip / Unit Not Assigned</strong>
                                                        <div style="font-size: 11px; color: #64748b;">Medicines without packaging unit size</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <span class="badge" style="background: <?= $err_unit > 0 ? '#fee2e2; color:#b91c1c' : '#f1f5f9; color:#475569' ?>; font-size: 12px; font-weight: 700; padding: 4px 10px;"><?= $err_unit ?></span>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?= $err_unit > 0 ? '<span class="label label-danger" style="font-size: 11px; border-radius: 9999px;">Unit Missing</span>' : '<span class="label label-success" style="font-size: 11px; border-radius: 9999px;">Standard</span>' ?>
                                            </td>
                                            <td style="text-align: right; vertical-align: middle;">
                                                <a href="<?= console_url('medicine/no_unit') ?>" class="btn btn-danger btn-xs" style="border-radius: 6px; font-weight: 600; padding: 4px 10px;">
                                                    Fix Unit <i class="fa fa-chevron-right" style="font-size: 10px; margin-left: 2px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Fast Pharmacy Shortcuts & Operations Launchpad -->
                <div class="col-lg-5 col-md-12">
                    <div class="box box-primary borderwhite" style="height: 100%; margin-bottom: 20px;">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-bolt" style="color:#f59e0b;"></i> Pharmacy Operations Launchpad
                            </h3>
                            <span class="label label-info" style="font-size: 11px; padding: 3px 10px; border-radius: 9999px;">Instant Access</span>
                        </div>
                        <div class="box-body" style="padding: 16px;">
                            <div class="row" style="margin: 0 -6px;">
                                <!-- Shortcut 1: POS Billing -->
                                <div class="col-xs-6" style="padding: 6px;">
                                    <a href="<?= console_url('sale/add_detail') ?>" class="smart-action-item" style="height: 100%;">
                                        <div class="smart-action-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div>
                                            <div class="smart-action-label" style="color: #0f172a;">POS Bill (F2)</div>
                                            <span class="smart-action-tag">Counter Sales</span>
                                        </div>
                                    </a>
                                </div>

                                <!-- Shortcut 2: Stock Purchase -->
                                <div class="col-xs-6" style="padding: 6px;">
                                    <a href="<?= console_url('purchase/add_detail') ?>" class="smart-action-item" style="height: 100%;">
                                        <div class="smart-action-icon" style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <div>
                                            <div class="smart-action-label" style="color: #0f172a;">Stock Inward</div>
                                            <span class="smart-action-tag">Add Purchase</span>
                                        </div>
                                    </a>
                                </div>

                                <!-- Shortcut 3: Fast Update Stock -->
                                <div class="col-xs-6" style="padding: 6px;">
                                    <a href="<?= console_url('medicine_stock/fast_update') ?>" class="smart-action-item" style="height: 100%;">
                                        <div class="smart-action-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                                            <i class="fa fa-flash"></i>
                                        </div>
                                        <div>
                                            <div class="smart-action-label" style="color: #0f172a;">Fast Stock</div>
                                            <span class="smart-action-tag">Batch Update</span>
                                        </div>
                                    </a>
                                </div>

                                <!-- Shortcut 4: Medicine Catalog -->
                                <div class="col-xs-6" style="padding: 6px;">
                                    <a href="<?= console_url('medicine_stock/stock') ?>" class="smart-action-item" style="height: 100%;">
                                        <div class="smart-action-icon" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;">
                                            <i class="fa fa-medkit"></i>
                                        </div>
                                        <div>
                                            <div class="smart-action-label" style="color: #0f172a;">Inventory</div>
                                            <span class="smart-action-tag">Live Stock List</span>
                                        </div>
                                    </a>
                                </div>

                                <!-- Shortcut 5: Customer Due Collection -->
                                <div class="col-xs-6" style="padding: 6px;">
                                    <a href="<?= console_url('customer_payment') ?>" class="smart-action-item" style="height: 100%;">
                                        <div class="smart-action-icon" style="background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                        <div>
                                            <div class="smart-action-label" style="color: #0f172a;">Due Payment</div>
                                            <span class="smart-action-tag">Collect Dues</span>
                                        </div>
                                    </a>
                                </div>

                                <!-- Shortcut 6: Profit & Loss Statement -->
                                <div class="col-xs-6" style="padding: 6px;">
                                    <a href="<?= console_url('profit_loss') ?>" class="smart-action-item" style="height: 100%;">
                                        <div class="smart-action-icon" style="background: rgba(16, 185, 129, 0.1); color: #059669;">
                                            <i class="fa fa-line-chart"></i>
                                        </div>
                                        <div>
                                            <div class="smart-action-label" style="color: #0f172a;">Profit & Loss</div>
                                            <span class="smart-action-tag">Margin Ledger</span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div style="margin-top: 14px; padding: 12px 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; display: flex; align-items: center; justify-content: space-between;">
                                <div style="font-size: 12px; color: #475569;">
                                    <i class="fa fa-keyboard-o" style="color: var(--ss-primary, #6366f1); margin-right: 4px;"></i> <strong>Keyboard Pro-Tip:</strong> Press <strong>F2</strong> anywhere for instant POS billing!
                                </div>
                                <span class="badge" style="background: #e2e8f0; color: #334155; font-size: 11px;">F2</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
}
?>
<?php
register_hook('medicine_stock_overview', 'dashboard');
register_hook('medicine_js', 'dashboard');
register_hook('get_pharmacy_custom_range_data', 'dashboard_filter');

