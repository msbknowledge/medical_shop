<?php
/**
 * Standalone Automated Reminder Background Runner (CLI / Task Scheduler)
 * 
 * Usage in Windows Task Scheduler or Command Prompt:
 * c:\xampp\php\php.exe c:\xampp\htdocs\medical_shop\reminder_cron.php
 * 
 * Automatically checks:
 * - Expired medicines in stock
 * - Near-expiry medicines (upcoming 60-90 days)
 * - Customer pending payment dues
 * - Supplier outstanding balances
 * - Records automated audit log in `activity_logs`
 */

date_default_timezone_set('Asia/Kolkata');

// Database configuration
if (!isset($_SERVER['SERVER_NAME']) || in_array($_SERVER['SERVER_NAME'], array('localhost', '127.0.0.1', ''))) {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'antu';
} else {
    $nodeSegment = explode('.', $_SERVER['SERVER_NAME']);
    $node = 'u404684354_' . $nodeSegment[0];
    $db_host = 'localhost';
    $db_user = $node;
    $db_pass = 'BR66MK55@msb';
    $db_name = $node;
}

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("[" . date('Y-m-d H:i:s') . "] CRON ERROR: Database connection failed - " . $conn->connect_error . "\n");
}

$timestamp = date('Y-m-d H:i:s');
echo "========================================================\n";
echo "[$timestamp] Starting Automatic Reminder Background Task\n";
echo "========================================================\n";

$cur_y = (int) date('y');
$cur_m = (int) date('m');
$cur_ym = (int) date('ym');
$next_ym = (int) date('ym', strtotime('+90 days'));

// 1. Check Expired Medicines in stock
$exp_sql = "SELECT COUNT(*) as cnt, COALESCE(SUM((medicine_strip_stock + (medicine_loose_stock / 10)) * medicine_mrp), 0) as total_value
            FROM medicine_stocks
            WHERE (medicine_strip_stock > 0 OR medicine_loose_stock > 0)
              AND CONCAT(medicine_expire_year, LPAD(medicine_expire_month, 2, '0')) <= $cur_ym
              AND medicine_expire_year > 0";
$exp_res = $conn->query($exp_sql)->fetch_assoc();
$expired_count = !empty($exp_res['cnt']) ? (int) $exp_res['cnt'] : 0;
$expired_value = !empty($exp_res['total_value']) ? round((float) $exp_res['total_value'], 2) : 0.0;

if ($expired_count === 0) {
    $pur_exp = $conn->query("SELECT COUNT(*) as cnt FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) <= $cur_ym AND purchase_expire_year > 0")->fetch_assoc();
    $expired_count = !empty($pur_exp['cnt']) ? (int) $pur_exp['cnt'] : 0;
}

// 2. Check Near Expiry Medicines in stock
$near_sql = "SELECT COUNT(*) as cnt, COALESCE(SUM((medicine_strip_stock + (medicine_loose_stock / 10)) * medicine_mrp), 0) as total_value
             FROM medicine_stocks
             WHERE (medicine_strip_stock > 0 OR medicine_loose_stock > 0)
               AND CONCAT(medicine_expire_year, LPAD(medicine_expire_month, 2, '0')) > $cur_ym
               AND CONCAT(medicine_expire_year, LPAD(medicine_expire_month, 2, '0')) <= $next_ym";
$near_res = $conn->query($near_sql)->fetch_assoc();
$near_count = !empty($near_res['cnt']) ? (int) $near_res['cnt'] : 0;
$near_value = !empty($near_res['total_value']) ? round((float) $near_res['total_value'], 2) : 0.0;

if ($near_count === 0) {
    $pur_near = $conn->query("SELECT COUNT(*) as cnt FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) > $cur_ym AND CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) <= $next_ym")->fetch_assoc();
    $near_count = !empty($pur_near['cnt']) ? (int) $pur_near['cnt'] : 0;
}

// 3. Check Customer Dues
$cust_sql = "SELECT COUNT(*) as cnt, COALESCE(SUM(customer_due), 0) as total_due 
             FROM customers 
             WHERE customer_due > 0";
$cust_res = $conn->query($cust_sql)->fetch_assoc();
$cust_count = !empty($cust_res['cnt']) ? (int) $cust_res['cnt'] : 0;
$cust_due = !empty($cust_res['total_due']) ? round((float) $cust_res['total_due'], 2) : 0.0;

$sales_due_sql = "SELECT COUNT(DISTINCT sale_customer) as cnt, COALESCE(SUM(sale_total_current_due), 0) as total_due
                  FROM sales 
                  WHERE sale_total_current_due > 0";
$sales_due_res = $conn->query($sales_due_sql)->fetch_assoc();
if (!empty($sales_due_res['cnt']) && (int) $sales_due_res['cnt'] > $cust_count) {
    $cust_count = (int) $sales_due_res['cnt'];
    $cust_due = max($cust_due, round((float) $sales_due_res['total_due'], 2));
}

// 4. Check Supplier Dues
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
$sup_res = $conn->query($sup_sql)->fetch_assoc();
$sup_count = !empty($sup_res['cnt']) ? (int) $sup_res['cnt'] : 0;
$sup_due = !empty($sup_res['total_due']) ? round((float) $sup_res['total_due'], 2) : 0.0;

// Print CLI summary
echo " 💊 Expired Medicines in Stock: $expired_count batches (Est. Loss: Rs. " . number_format($expired_value, 2) . ")\n";
echo " ⏳ Near Expiry Stock (<90d)  : $near_count batches (Val: Rs. " . number_format($near_value, 2) . ")\n";
echo " 👥 Customer Dues Pending     : $cust_count patients (Total: Rs. " . number_format($cust_due, 2) . ")\n";
echo " 🏭 Supplier Dues Pending     : $sup_count suppliers (Total: Rs. " . number_format($sup_due, 2) . ")\n";

// Update tracking in options
$summary_json = json_encode(array(
    'expired_count'       => $expired_count,
    'expired_value'       => $expired_value,
    'near_expiry_count'   => $near_count,
    'near_expiry_value'   => $near_value,
    'customer_dues_count' => $cust_count,
    'customer_dues_total' => $cust_due,
    'supplier_dues_count' => $sup_count,
    'supplier_dues_total' => $sup_due,
    'timestamp'           => $timestamp
));

// Update options table
$stmt = $conn->prepare("INSERT INTO `options` (`option_key`, `option_value`) VALUES ('reminder_last_cron_run', ?) ON DUPLICATE KEY UPDATE `option_value` = ?");
$stmt->bind_param('ss', $timestamp, $timestamp);
$stmt->execute();

$stmt2 = $conn->prepare("INSERT INTO `options` (`option_key`, `option_value`) VALUES ('reminder_last_cron_summary', ?) ON DUPLICATE KEY UPDATE `option_value` = ?");
$stmt2->bind_param('ss', $summary_json, $summary_json);
$stmt2->execute();

// Log to activity_logs
$log_msg = sprintf(
    "Automatic Reminder Scan (Cron): %d expired in stock (Rs. %.2f), %d near-expiry, %d customers with due payments (Rs. %.2f), %d supplier dues (Rs. %.2f).",
    $expired_count,
    $expired_value,
    $near_count,
    $cust_count,
    $cust_due,
    $sup_count,
    $sup_due
);

$stmt3 = $conn->prepare("INSERT INTO `activity_logs` (`activity`, `activity_data`, `activity_user`, `activity_url`, `activity_timestamp`) VALUES ('AUTOMATIC_REMINDER_CRON', ?, 1, 'reminder_cron.php', ?)");
$stmt3->bind_param('ss', $log_msg, $timestamp);
$stmt3->execute();

echo " ✅ Audit log created in activity_logs table.\n";
echo "[$timestamp] Automatic Reminder Task Completed Successfully.\n";
echo "========================================================\n";
