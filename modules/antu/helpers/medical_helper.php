<?php
function medicine_reminder() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT sale_date,customer_address,customer_name,customer_contact FROM sales join customers on customer_ID = sale_customer')->result_array();
    return $count;
}
function medicine_count() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT DISTINCT count(medicine_name) as medicine_count FROM medicines')->result_array();
    return $count;
}
function no_unit(){
	 $CI = &get_instance();
    return count($CI->medicines_model->no_unit());

}
function medicine_error_expire_date() {
    $CI = &get_instance();
    $count = count($CI->db->query('select medicines.*, medicine_stocks.* from medicine_stocks join medicines on medicine_stock_medicine = medicine_id where medicine_expire_year = 0 and medicine_expire_month =0 order by medicine_expire_year asc,medicine_expire_month asc')->result_array());
    return $count;
}
function medicine_error_storage() {
    $CI = &get_instance();
    return count($CI->medicines_model->get_list(array('medicine_storage'=>'')));;
}
function duplicate(){
	 $CI = &get_instance();
    return count( $CI->medicines_model->duplicate());
}

function total_sale_today() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT SUM(sale_total) as sale FROM `sales` WHERE DATE_FORMAT(sale_date, "%Y-%m-%d") = CURRENT_DATE')->result_array();
    return $count;
}
function expiring() {
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
function expired() {
    $CI = &get_instance();
    try {
        $cur_ym = (int)date('ym');
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month, 2, '0')) < $cur_ym AND purchase_expire_year > 0")->row_array();
        return !empty($res['cnt']) ? (int)$res['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}
function medicine_error_zeronegetive() {
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
function shortage() {
    $CI = &get_instance();
    try {
        $res = $CI->db->query("SELECT COUNT(*) as cnt FROM (SELECT medicine_stock_medicine, SUM(medicine_strip_stock) as tot_strip FROM medicine_stocks GROUP BY medicine_stock_medicine HAVING tot_strip <= 2) as s")->row_array();
        return !empty($res['cnt']) ? (int)$res['cnt'] : 0;
    } catch (Exception $e) {
        return 0;
    }
}
function total_purchase_today() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT SUM(purchase_total) as purchase FROM `purchases` WHERE purchase_date=CURRENT_DATE')->result_array();
    return $count;
}

function generate_invoice_number() {
    $invoice_last_count = (int) get_option('invoice_last_count') + 1;
    $inovice_number = get_option('invoice_number');
    return str_ireplace(array('[{number}]', '[{year}]'), array(sprintf('%05d', $invoice_last_count), date('Y')), $inovice_number);
}
function generate_purchase_number() {
    $purchase_last_count = (int) get_option('purchase_last_count') + 1;
    return sprintf('%05d', $purchase_last_count);
}
function generate_expiry_number() {
    $expiry_last_count = (int) get_option('expiry_last_count') + 1;
    return sprintf('%05d', $expiry_last_count);
}
function increase_purchase_number() {
    set_option('purchase_last_count', 1 + (int) get_option('purchase_last_count'));
}
function increase_expiry_number() {
    set_option('expiry_last_count', 1 + (int) get_option('expiry_last_count'));
}
function increase_invoice_number() {
    set_option('invoice_last_count', 1 + (int) get_option('invoice_last_count'));
}

function medicine_overview() {
    ?>
   	
   	 <?php
                                    $medicine_reminder = medicine_reminder();
                                    foreach($medicine_reminder as $files){
                                        $date1 = date("Y-m-d",strtotime($files['sale_date']));
                                        $date2 = date("Y-m-d",strtotime('+1 day'));
                                        
                                        if($files['sale_date']==$date2){
                                       
                                         echo'<div class="dashalert alert alert-success alert-dismissible" role="alert">
<button type="button" class="alertclose close close_notice" data-dismiss="alert" aria-label="Close" data-noticeid="138"><span aria-hidden="true">×</span></button>
<a href=""> '.$files['sale_date'].'-'. $files['customer_name'].'-'. $files['customer_address'].'-'. $files['customer_contact'].'</a>
</div> </div>';
          
                                        }else{
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
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
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
                            <span  class="label label-success">Total Sale of the day</span>
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
                            <span  class="label label-success">Total Purchase of the day</span>
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
                            <span  class="label label-warning">Upcoming Expire</span>
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
                            <span  class="label label-important"> Expired</span>
                        </td>
                        <td>
						<?php $result = expired()?>
                            <a href="/console/medicine_stock/expired_view">
							<button class="btn btn-danger">
                                Click To check Expired
                               <?//=$result?>
                            </button>
							</a>
                        </td>

                    </tr>
					<tr>
                        <td>
                            <span  class="label label-warning">Shortage (Less than 3 unit)</span>
                        </td>
                        <td>
						<?php $result = shortage()?>
                            <a href="/console/medicine_stock/shortage_view">
							<button class="btn btn-success">
                                Click To check Shortage
                                <!-- <span class="label"><?//=$result?></span> -->
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

function medicine_stock_update($medicine_batch, $medicine_id, $medicine_strip_stock,$medicine_loose_stock=0, $type = "+", $medicine_mrp = null, $medicine_expire_month = null, $medicine_expire_year = null) {
    /*$CI = &get_instance();
    $CI->db->set('medicine_strip_stock', "medicine_strip_stock $type $medicine_strip_stock", FALSE);
    $CI->db->set('medicine_loose_stock', "medicine_loose_stock $type $medicine_loose_stock", FALSE);
    if ($medicine_mrp != null) {
        $CI->db->set('medicine_mrp', $medicine_mrp);
    }
    if ($medicine_expire_month != null) {
        $CI->db->set('medicine_expire_month', $medicine_expire_month);
    }
    if ($medicine_expire_year != null) {
        $CI->db->set('medicine_expire_year', $medicine_expire_year);
    }
    $CI->db->where(array('medicine_stock_medicine' => $medicine_id, 'medicine_stock_batch' => $medicine_batch));
    $CI->db->update('medicine_stocks');
    if ($CI->db->affected_rows() == 0) {
        $CI->db->set('medicine_strip_stock', "medicine_strip_stock $type $medicine_strip_stock", FALSE);
        $CI->db->set('medicine_loose_stock', "medicine_loose_stock $type $medicine_loose_stock", FALSE);
        $CI->db->set('medicine_stock_medicine', $medicine_id);
        $CI->db->set('medicine_stock_batch', $medicine_batch);
        if ($medicine_mrp != null) {
            $CI->db->set('medicine_mrp', $medicine_mrp);
        }
        if ($medicine_expire_month != null) {
            $CI->db->set('medicine_expire_month', $medicine_expire_month);
        }
        if ($medicine_expire_year != null) {
            $CI->db->set('medicine_expire_year', $medicine_expire_year);
        }
        $CI->db->insert('medicine_stocks');
    }
    #$CI->db->query('delete from medicine_stocks where medicine_loose_stock <= 0 && medicine_strip_stock <= 0');
    */
}
function medicine_js() {
?>
<script>
// Fast dashboard medicine stock utilities
function get_unique_medicine() {
    $.post("<?= console_url('medicine_stock/get_unique_medicine_id') ?>", function(data) {
        // Handle unique medicine response
    });
}
</script>
<?php 
} 

function medicine_stock_overview() {
    $CI = &get_instance();
    $err_storage = medicine_error_storage();
    $err_expire = medicine_error_expire_date();
    $err_zeroneg = medicine_error_zeronegetive();
    $err_duplicate = duplicate();
    $err_unit = no_unit();
    $shortage_cnt = shortage();
    $total_issues = $err_storage + $err_expire + $err_zeroneg + $err_duplicate + $err_unit;
?>
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
} ?>
<?php
register_hook('medicine_stock_overview', 'dashboard');
register_hook('medicine_js', 'dashboard');

