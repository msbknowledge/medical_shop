<?php
error_reporting(0);
ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');

if (isset($_SERVER['SERVER_NAME']) && in_array($_SERVER['SERVER_NAME'], array('localhost', '127.0.0.1'))) {
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'antu';
} else {
    $nodeSegment = explode('.', isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'antu.localhost');
    $node = 'u404684354_' . $nodeSegment[0];
    $db_user = $node;
    $db_pass = 'BR66MK55@msb';
    $db_name = $node;
}

define('DB_SERVER', 'localhost');
define('DB_USER', $db_user);
define('DB_PASSWORD', $db_pass);
define('DB_NAME', $db_name);

$responce = array();

if (isset($_GET['term']) && !empty($_REQUEST['table']) && !empty($_REQUEST['fieldToSearch'])) {
    $table = preg_replace('/[^a-zA-Z0-9_]/', '', $_REQUEST['table']);
    $field = preg_replace('/[^a-zA-Z0-9_]/', '', $_REQUEST['fieldToSearch']);
    $term = trim($_GET['term']);

    try {
        $conn = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM `{$table}` WHERE `{$field}` LIKE :term LIMIT 0, 30";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array('term' => '%' . $term . '%'));

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($row['medicine_discount'])) {
                $row['sale_discount_percent'] = $row['medicine_discount'];
            }
            if (isset($row['medicine_gst'])) {
                $row['sale_cgst_percent'] = (float)$row['medicine_gst'] / 2;
            }
            $val = isset($row[$field]) ? $row[$field] : '';
            $responce[] = array(
                'id' => isset($row[$table . '_id']) ? $row[$table . '_id'] : '',
                'label' => $val,
                'value' => $val,
                'complete' => $row
            );
        }
    } catch (PDOException $e) {
        // Log or silently ignore to keep JSON valid
    }

    // Optional external medicine search if local DB has few matches
    if ($table === "medicines" && !isset($_REQUEST['location']) && count($responce) < 5 && strlen($term) > 2) {
        $cached_file = 'search/' . str_ireplace(' ', '-', strtoupper($term));
        $data = null;
        if (file_exists($cached_file)) {
            $data = json_decode(@file_get_contents($cached_file), true);
        }
        if (!empty($data) && is_array($data)) {
            foreach ($data as $k => $d) {
                $mapped = array();
                $mapped['medicine_name'] = isset($d['name']) ? $d['name'] : '';
                $mapped['medicine_manufacturer'] = isset($d['companyName']) ? $d['companyName'] : '';
                $mapped['medicine_category'] = isset($d['type']) ? $d['type'] : '';
                $mapped['medicine_hsn'] = isset($d['hsnCode']) ? $d['hsnCode'] : '';
                $mapped['medicine_unit'] = isset($d['packing']) ? $d['packing'] : '';
                $mapped['purchase_unit'] = isset($d['packing']) ? $d['packing'] : '';
                $val = isset($mapped[$field]) ? $mapped[$field] : '';
                $responce[] = array(
                    'id' => '',
                    'label' => $val . '*',
                    'value' => $val,
                    'complete' => $mapped
                );
            }
        }
    }
}

echo json_encode($responce);
exit;
