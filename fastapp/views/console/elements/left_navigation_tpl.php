<?php 
/**
 * Smart School Flow UI Left Sidebar Navigation
 * 100% Medical & Pharmacy Shop Menus matching User Screenshots & System Hierarchy
 */
$current_controller = $this->uri->segment(2);
$current_action = $this->uri->segment(3);
$current_path = $this->uri->uri_string();

// Helper to determine active state
$is_entry_active = in_array($current_controller, array('medicine', 'medicine_category', 'manufacturer', 'supplier', 'doctor', 'customer')) || ($current_controller == 'medicine_stock' && $current_action == 'fast_update');

$is_billing_active = in_array($current_controller, array('purchase', 'sale', 'payments', 'customer_payments', 'return_sale', 'return_purchase')) && !in_array($current_action, array('purchases_report', 'report_gstin_wise', 'report_daily_wise', 'daily_purchase_medicine', 'supplier_medicine_details', 'sale_report', 'daily_sale_medicine', 'due_report', 'customer_payment_report'));

$is_purchase_reports_active = ($current_controller == 'return_purchase' && $current_action == 'purchases_report') ||
    ($current_controller == 'purchase' && in_array($current_action, array('report_gstin_wise', 'report_daily_wise', 'daily_purchase_medicine'))) ||
    ($current_controller == 'sale' && $current_action == 'supplier_medicine_details');

$is_sale_reports_active = ($current_controller == 'return_sale' && $current_action == 'sale_report') ||
    ($current_controller == 'sale' && in_array($current_action, array('report_gstin_wise', 'report_daily_wise', 'daily_sale_medicine', 'customer_payment_report'))) ||
    ($current_controller == 'payments' && $current_action == 'due_report');

$is_reports_active = $is_purchase_reports_active || $is_sale_reports_active ||
    ($current_controller == 'profit_loss') ||
    ($current_controller == 'medicine_stock' && in_array($current_action, array('shortage_view', 'stock_view', 'stock', 'stock_amount', 'medicine_history', 'expiring_view', 'expired_view')));

$is_help_active = ($current_controller == 'help');
$is_mgmt_active = in_array($current_controller, array('user', 'user_type', 'option', 'activity_log'));
$is_dash_active = ($current_controller == 'dashboard' || empty($current_controller));
?>
<aside class="main-sidebar" id="alert2">
    <!-- Search Form (Mobile & Small screens) -->
    <form class="navbar-form navbar-left search-form2 hidden-md hidden-lg" role="search" action="<?= console_url('sale/search') ?>" method="POST" style="padding:10px 14px; margin:0; border-bottom:1px solid #e2e8f0;">
        <div class="input-group" style="width:100%;">
            <input type="text" name="search_text" class="form-control search-form" placeholder="Search medicines, bills..." style="height:32px; font-size:12px; border-radius:15px 0 0 15px !important;">
            <span class="input-group-btn">
                <button type="submit" name="search" class="btn btn-flat search-btn-sm" style="height:32px; padding:4px 12px; border-radius:0 15px 15px 0 !important; background:#f1f5f9; border:1px solid #cbd5e1; border-left:none;"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>

    <section class="sidebar" id="sibe-box">
        <!-- Session banner matching user screenshot -->
        <ul class="sessionul fixedmenu">
            <li class="removehover accurrent">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#sessionModal" title="Current Financial / Accounting Year">
                    <span>Financial Session: <?= date('Y') ?>-<?= date('y', strtotime('+1 year')) ?></span>
                    <i class="fa fa-pencil pull-right"></i>
                </a>
            </li>
            <li class="dropdown mega-dropdown">
                <a class="dropdown-toggle drop5" data-toggle="dropdown" href="#" aria-expanded="false" title="Quick Actions">
                    <span>Quick Links</span>
                    <i class="fa fa-th pull-right"></i>
                </a>
                <ul class="dropdown-menu quick-links-dropdown">
                    <li><a href="<?= console_url('sale/add_detail') ?>"><i class="fa fa-shopping-cart" style="color:var(--ss-primary);"></i> <span>New POS Bill</span></a></li>
                    <li><a href="<?= console_url('purchase/edit_detail') ?>"><i class="fa fa-truck" style="color:var(--ss-info);"></i> <span>Add Purchase Stock</span></a></li>
                    <li><a href="<?= console_url('medicine/add') ?>"><i class="fa fa-plus-square" style="color:var(--ss-success);"></i> <span>Add New Medicine</span></a></li>
                    <li><a href="<?= console_url('medicine_stock/stock_view') ?>"><i class="fa fa-database" style="color:var(--ss-warning);"></i> <span>Current Inventory</span></a></li>
                    <li><a href="<?= console_url('profit_loss') ?>"><i class="fa fa-line-chart" style="color:#10b981;"></i> <span>Profit & Loss Statement</span></a></li>
                </ul>
            </li>
        </ul>

        <!-- Main Medical Shop Treeview Navigation Menu -->
        <ul class="sidebar-menu verttop">
            <!-- 1. Dashboard -->
            <li class="treeview <?= $is_dash_active ? 'active' : '' ?>">
                <a href="<?= console_url('dashboard') ?>">
                    <i class="fa fa-tachometer ftlayer" style="color:var(--ss-primary, #6366f1);"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- 2. Billing (Primary Operations) -->
            <li class="treeview <?= $is_billing_active ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-file-text-o ftlayer" style="color:#10b981;"></i>
                    <span>Billing</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu" style="<?= $is_billing_active ? 'display:block;' : '' ?>">
                    <li class="<?= ($current_controller == 'purchase' && !$is_purchase_reports_active) ? 'active' : '' ?>">
                        <a href="<?= console_url('purchase') ?>"><i class="fa fa-file-text-o"></i> Purchase</a>
                    </li>
                    <li class="<?= ($current_controller == 'sale' && !$is_sale_reports_active) ? 'active' : '' ?>">
                        <a href="<?= console_url('sale') ?>"><i class="fa fa-file-text-o"></i> Sale</a>
                    </li>
                    <li class="<?= ($current_controller == 'payments' && $current_action != 'due_report') ? 'active' : '' ?>">
                        <a href="<?= console_url('payments') ?>"><i class="fa fa-file-text-o"></i> Payment</a>
                    </li>
                    <li class="<?= ($current_controller == 'customer_payments') ? 'active' : '' ?>">
                        <a href="<?= console_url('customer_payments') ?>"><i class="fa fa-file-text-o"></i> Customer Payment</a>
                    </li>
                    <li class="<?= ($current_controller == 'return_sale' && $current_action != 'sale_report') ? 'active' : '' ?>">
                        <a href="<?= console_url('return_sale') ?>"><i class="fa fa-file-text-o"></i> Sale Return</a>
                    </li>
                    <li class="<?= ($current_controller == 'return_purchase' && $current_action != 'purchases_report') ? 'active' : '' ?>">
                        <a href="<?= console_url('return_purchase') ?>"><i class="fa fa-file-text-o"></i> Purchase Return</a>
                    </li>
                </ul>
            </li>

            <!-- 3. Entry (Screenshot 1) -->
            <li class="treeview <?= $is_entry_active ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-pencil ftlayer" style="color:#0ea5e9;"></i>
                    <span>Entry</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu" style="<?= $is_entry_active ? 'display:block;' : '' ?>">
                    <li class="<?= ($current_controller == 'medicine' && $current_action != 'fast_update') ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine') ?>"><i class="fa fa-pencil"></i> Medicine</a>
                    </li>
                    <li class="<?= ($current_controller == 'medicine_category') ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine_category') ?>"><i class="fa fa-pencil"></i> Medicine Categories</a>
                    </li>
                    <li class="<?= ($current_controller == 'manufacturer') ? 'active' : '' ?>">
                        <a href="<?= console_url('manufacturer') ?>"><i class="fa fa-pencil"></i> Manufacturer</a>
                    </li>
                    <li class="<?= ($current_controller == 'supplier') ? 'active' : '' ?>">
                        <a href="<?= console_url('supplier') ?>"><i class="fa fa-pencil"></i> Supplier</a>
                    </li>
                    <li class="<?= ($current_controller == 'doctor') ? 'active' : '' ?>">
                        <a href="<?= console_url('doctor') ?>"><i class="fa fa-pencil"></i> Doctor</a>
                    </li>
                    <li class="<?= ($current_controller == 'customer') ? 'active' : '' ?>">
                        <a href="<?= console_url('customer') ?>"><i class="fa fa-pencil"></i> Customer</a>
                    </li>
                    <li class="<?= ($current_controller == 'medicine_stock' && $current_action == 'fast_update') ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine_stock/fast_update') ?>"><i class="fa fa-pencil"></i> Fast Stock Update</a>
                    </li>
                </ul>
            </li>

            <!-- 4. Medicine Reports (Screenshot 3, 4, 5) -->
            <li class="treeview <?= $is_reports_active ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-calendar ftlayer" style="color:#8b5cf6;"></i>
                    <span>Medicine Reports</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu" style="<?= $is_reports_active ? 'display:block;' : '' ?>">
                    <!-- Nested: Purchase Reports (Screenshot 4) -->
                    <li class="treeview-sub <?= $is_purchase_reports_active ? 'sub-open' : '' ?>">
                        <a href="javascript:void(0);" class="sub-toggle">
                            <i class="fa fa-calendar"></i>
                            <span>Purchase Reports</span>
                            <i class="fa fa-angle-right pull-right sub-caret"></i>
                        </a>
                        <ul class="treeview-menu-sub" style="<?= $is_purchase_reports_active ? 'display:block;' : '' ?>">
                            <li class="<?= ($current_controller == 'return_purchase' && $current_action == 'purchases_report') ? 'active' : '' ?>">
                                <a href="<?= console_url('return_purchase/purchases_report') ?>"><i class="fa fa-calendar"></i> Return Purchase</a>
                            </li>
                            <li class="<?= ($current_controller == 'purchase' && $current_action == 'report_gstin_wise') ? 'active' : '' ?>">
                                <a href="<?= console_url('purchase/report_gstin_wise') ?>"><i class="fa fa-calendar"></i> Purchase Report GSTIN Wise</a>
                            </li>
                            <li class="<?= ($current_controller == 'purchase' && $current_action == 'report_daily_wise') ? 'active' : '' ?>">
                                <a href="<?= console_url('purchase/report_daily_wise') ?>"><i class="fa fa-calendar"></i> Purchase Report Daywise</a>
                            </li>
                            <li class="<?= ($current_controller == 'purchase' && $current_action == 'daily_purchase_medicine') ? 'active' : '' ?>">
                                <a href="<?= console_url('purchase/daily_purchase_medicine') ?>"><i class="fa fa-calendar"></i> Purchase Medicine Report Daywise</a>
                            </li>
                            <li class="<?= ($current_controller == 'sale' && $current_action == 'supplier_medicine_details') ? 'active' : '' ?>">
                                <a href="<?= console_url('sale/supplier_medicine_details') ?>"><i class="fa fa-calendar"></i> Supplier Balance Sheet</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Nested: Sale Reports (Screenshot 5) -->
                    <li class="treeview-sub <?= $is_sale_reports_active ? 'sub-open' : '' ?>">
                        <a href="javascript:void(0);" class="sub-toggle">
                            <i class="fa fa-calendar"></i>
                            <span>Sale Reports</span>
                            <i class="fa fa-angle-right pull-right sub-caret"></i>
                        </a>
                        <ul class="treeview-menu-sub" style="<?= $is_sale_reports_active ? 'display:block;' : '' ?>">
                            <li class="<?= ($current_controller == 'return_sale' && $current_action == 'sale_report') ? 'active' : '' ?>">
                                <a href="<?= console_url('return_sale/sale_report') ?>"><i class="fa fa-calendar"></i> Return Sale</a>
                            </li>
                            <li class="<?= ($current_controller == 'sale' && $current_action == 'report_gstin_wise') ? 'active' : '' ?>">
                                <a href="<?= console_url('sale/report_gstin_wise') ?>"><i class="fa fa-calendar"></i> Sale Report GSTIN Wise</a>
                            </li>
                            <li class="<?= ($current_controller == 'sale' && $current_action == 'report_daily_wise') ? 'active' : '' ?>">
                                <a href="<?= console_url('sale/report_daily_wise') ?>"><i class="fa fa-calendar"></i> Sale Report Daywise</a>
                            </li>
                            <li class="<?= ($current_controller == 'sale' && $current_action == 'daily_sale_medicine') ? 'active' : '' ?>">
                                <a href="<?= console_url('sale/daily_sale_medicine') ?>"><i class="fa fa-calendar"></i> Sale Medicine Report Daywise</a>
                            </li>
                            <li class="<?= ($current_controller == 'payments' && $current_action == 'due_report') ? 'active' : '' ?>">
                                <a href="<?= console_url('payments/due_report') ?>"><i class="fa fa-calendar"></i> Due Report Sheet</a>
                            </li>
                            <li class="<?= ($current_controller == 'sale' && $current_action == 'customer_payment_report') ? 'active' : '' ?>">
                                <a href="<?= console_url('sale/customer_payment_report') ?>"><i class="fa fa-calendar"></i> Customer Payment Report</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Direct Reports under Medicine Reports (Screenshot 3) -->
                    <li class="<?= ($current_controller == 'profit_loss') ? 'active' : '' ?>">
                        <a href="<?= console_url('profit_loss') ?>"><i class="fa fa-calendar"></i> Profit Loss Report</a>
                    </li>
                    <li class="<?= ($current_controller == 'medicine_stock' && $current_action == 'shortage_view') ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine_stock/shortage_view') ?>"><i class="fa fa-calendar"></i> Shortage Report</a>
                    </li>
                    <li class="<?= ($current_controller == 'medicine_stock' && in_array($current_action, array('stock_view', 'stock'))) ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine_stock/stock_view') ?>"><i class="fa fa-calendar"></i> Stock Report</a>
                    </li>
                    <li class="<?= ($current_controller == 'medicine_stock' && $current_action == 'stock_amount') ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine_stock/stock_amount') ?>"><i class="fa fa-calendar"></i> Stock MRP Amount Report</a>
                    </li>
                    <li class="<?= ($current_controller == 'medicine_stock' && $current_action == 'medicine_history') ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine_stock/medicine_history') ?>"><i class="fa fa-calendar"></i> Medicine History</a>
                    </li>
                    <li class="<?= ($current_controller == 'medicine_stock' && $current_action == 'expiring_view') ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine_stock/expiring_view') ?>"><i class="fa fa-calendar"></i> Upcomming Expire Report</a>
                    </li>
                    <li class="<?= ($current_controller == 'medicine_stock' && $current_action == 'expired_view') ? 'active' : '' ?>">
                        <a href="<?= console_url('medicine_stock/expired_view') ?>"><i class="fa fa-calendar"></i> Expired</a>
                    </li>
                </ul>
            </li>

            <!-- 5. Help (Screenshot 2) -->
            <li class="treeview <?= $is_help_active ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-pencil ftlayer" style="color:#f59e0b;"></i>
                    <span>Help</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu" style="<?= $is_help_active ? 'display:block;' : '' ?>">
                    <li class="<?= ($current_controller == 'help') ? 'active' : '' ?>">
                        <a href="<?= console_url('help') ?>"><i class="fa fa-pencil"></i> Help Panel</a>
                    </li>
                </ul>
            </li>

            <!-- 6. Management -->
            <li class="treeview <?= $is_mgmt_active ? 'active menu-open' : '' ?>">
                <a href="#">
                    <i class="fa fa-briefcase ftlayer" style="color:#ec4899;"></i>
                    <span>Management</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu" style="<?= $is_mgmt_active ? 'display:block;' : '' ?>">
                    <li class="<?= ($current_controller == 'user') ? 'active' : '' ?>">
                        <a href="<?= console_url('user') ?>"><i class="fa fa-user"></i> Users</a>
                    </li>
                    <li class="<?= ($current_controller == 'user_type') ? 'active' : '' ?>">
                        <a href="<?= console_url('user_type') ?>"><i class="fa fa-users"></i> User Type</a>
                    </li>
                    <li class="<?= ($current_controller == 'activity_log') ? 'active' : '' ?>">
                        <a href="<?= console_url('activity_log') ?>"><i class="fa fa-history" style="color:#6366f1;"></i> Activity Logs</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>

<style>
/* Smart School Sub-accordion styles */
.treeview-sub {
    position: relative;
    list-style: none;
}
.treeview-sub > a {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    padding: 8px 15px 8px 30px !important;
    font-size: 13px !important;
    color: #4b5563 !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    transition: all 0.15s ease !important;
}
.treeview-sub > a:hover,
.treeview-sub.sub-open > a {
    color: var(--ss-primary, #6366f1) !important;
    background: rgba(99, 102, 241, 0.05) !important;
}
.treeview-sub > a .sub-caret {
    font-size: 12px !important;
    transition: transform 0.2s ease !important;
}
.treeview-sub.sub-open > a .sub-caret {
    transform: rotate(90deg) !important;
}
.treeview-menu-sub {
    display: none;
    list-style: none;
    padding: 2px 0 4px 18px !important;
    margin: 0 !important;
    background: #f8fafc;
    border-left: 2px solid var(--ss-primary, #6366f1);
    margin-left: 30px !important;
    border-radius: 0 0 6px 6px;
}
.treeview-menu-sub > li > a {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    padding: 6px 12px !important;
    font-size: 12.5px !important;
    color: #64748b !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    transition: all 0.15s ease !important;
}
.treeview-menu-sub > li > a:hover,
.treeview-menu-sub > li.active > a {
    color: var(--ss-primary, #6366f1) !important;
    background: rgba(99, 102, 241, 0.08) !important;
    border-radius: 4px;
    padding-left: 16px !important;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    // Top-level treeview accordion toggle
    $('.sidebar-menu > li.treeview > a').on('click', function(e) {
        var $menu = $(this).next('.treeview-menu');
        if ($menu.length > 0) {
            e.preventDefault();
            var $li = $(this).parent('li');
            if ($li.hasClass('menu-open')) {
                $li.removeClass('menu-open active');
                $menu.slideUp(200);
            } else {
                $('.sidebar-menu > li.treeview.menu-open').not($li).removeClass('menu-open active').find('> .treeview-menu').slideUp(200);
                $li.addClass('menu-open active');
                $menu.slideDown(200);
            }
        }
    });

    // Sub-level accordion toggle (Purchase Reports & Sale Reports in sidebar)
    $('.sidebar-menu .treeview-sub > a.sub-toggle').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $subLi = $(this).parent('.treeview-sub');
        var $subUl = $subLi.find('> .treeview-menu-sub');
        if ($subLi.hasClass('sub-open')) {
            $subLi.removeClass('sub-open');
            $subUl.slideUp(180);
        } else {
            $subLi.addClass('sub-open');
            $subUl.slideDown(180);
        }
    });
});
</script>
