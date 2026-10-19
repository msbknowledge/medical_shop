<?php
/**
 * Smart School Flow UI - Automatic Reminders Dashboard
 * Medicine Expired Reminders & Customer/Supplier Payment Dues Reminders
 */
?>
<div class="index-wrapper" style="padding: 10px 0;">
    <!-- Page Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                <span style="display: inline-flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: #ffffff; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);">
                    <i class="fa fa-bell" style="font-size: 20px;"></i>
                </span>
                Automatic Reminders Center
            </h1>
            <p style="margin: 4px 0 0 0; font-size: 13.5px; color: #64748b;">
                Automated alerts for expired medicines, near-expiry batches, customer credit dues & supplier payments.
            </p>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <button type="button" class="btn btn-default" onclick="refreshSummary(true)" id="refreshBtn" style="border-radius: 8px; font-weight: 600; padding: 8px 16px; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fa fa-refresh"></i> Refresh Data
            </button>
            <button type="button" class="btn btn-primary ss-btn-primary" onclick="runAutomatedScan()" id="cronRunBtn" style="border-radius: 8px; font-weight: 700; padding: 8px 18px; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa fa-bolt"></i> Run Auto-Scan
            </button>
        </div>
    </div>

    <!-- Quick Stat Cards -->
    <div class="row-fluid" style="margin-bottom: 24px;">
        <!-- Card 1: Expired in Stock -->
        <div class="span3" style="cursor: pointer;" onclick="switchReminderTab('expired')">
            <div class="ss-card" style="border-left: 4px solid #ef4444; border-radius: 12px; padding: 18px 20px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #ef4444;">Expired Medicines</div>
                        <div id="stat_expired_count" style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 4px 0 2px 0;">
                            <?= $summary['expired_count'] ?>
                        </div>
                        <div style="font-size: 12px; color: #64748b;">
                            Est. Loss: <strong style="color: #ef4444;" id="stat_expired_val">Rs. <?= number_format($summary['expired_value'], 2) ?></strong>
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa fa-calendar-times-o"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Upcoming Expiry -->
        <div class="span3" style="cursor: pointer;" onclick="switchReminderTab('near_expiry')">
            <div class="ss-card" style="border-left: 4px solid #f59e0b; border-radius: 12px; padding: 18px 20px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #d97706;">Near Expiry (90 Days)</div>
                        <div id="stat_near_count" style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 4px 0 2px 0;">
                            <?= $summary['near_expiry_count'] ?>
                        </div>
                        <div style="font-size: 12px; color: #64748b;">
                            Stock Val: <strong style="color: #d97706;" id="stat_near_val">Rs. <?= number_format($summary['near_expiry_value'], 2) ?></strong>
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Customer Payment Dues -->
        <div class="span3" style="cursor: pointer;" onclick="switchReminderTab('customer_dues')">
            <div class="ss-card" style="border-left: 4px solid #0284c7; border-radius: 12px; padding: 18px 20px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #0284c7;">Customer Due Amount</div>
                        <div id="stat_cust_count" style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 4px 0 2px 0;">
                            <?= $summary['customer_dues_count'] ?> <span style="font-size: 14px; font-weight: 600; color: #64748b;">patients</span>
                        </div>
                        <div style="font-size: 12px; color: #64748b;">
                            Total Due: <strong style="color: #0284c7;" id="stat_cust_due">Rs. <?= number_format($summary['customer_dues_total'], 2) ?></strong>
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: Supplier Dues -->
        <div class="span3" style="cursor: pointer;" onclick="switchReminderTab('supplier_dues')">
            <div class="ss-card" style="border-left: 4px solid #8b5cf6; border-radius: 12px; padding: 18px 20px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #7c3aed;">Supplier Outstanding</div>
                        <div id="stat_sup_count" style="font-size: 28px; font-weight: 800; color: #0f172a; margin: 4px 0 2px 0;">
                            <?= $summary['supplier_dues_count'] ?> <span style="font-size: 14px; font-weight: 600; color: #64748b;">suppliers</span>
                        </div>
                        <div style="font-size: 12px; color: #64748b;">
                            Pending: <strong style="color: #7c3aed;" id="stat_sup_due">Rs. <?= number_format($summary['supplier_dues_total'], 2) ?></strong>
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #ede9fe; color: #7c3aed; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa fa-truck"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card with Navigation Tabs -->
    <div class="ss-card" style="border-radius: 14px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04); background: #ffffff;">
        <!-- Tab Navigation Bar -->
        <div class="ss-card-header" style="padding: 6px 16px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
            <ul class="nav nav-pills" style="margin: 0; display: flex; gap: 6px;">
                <li class="active" id="tab_nav_expired">
                    <a href="javascript:void(0);" onclick="switchReminderTab('expired')" style="font-weight: 700; font-size: 13.5px; border-radius: 8px; padding: 8px 16px;">
                        <i class="fa fa-ban" style="color: #ef4444; margin-right: 4px;"></i> Expired Stock 
                        <span class="badge badge-important" id="tab_badge_expired" style="margin-left: 4px;"><?= $summary['expired_count'] ?></span>
                    </a>
                </li>
                <li id="tab_nav_near_expiry">
                    <a href="javascript:void(0);" onclick="switchReminderTab('near_expiry')" style="font-weight: 700; font-size: 13.5px; border-radius: 8px; padding: 8px 16px;">
                        <i class="fa fa-clock-o" style="color: #f59e0b; margin-right: 4px;"></i> Near Expiry
                        <span class="badge badge-warning" id="tab_badge_near" style="margin-left: 4px;"><?= $summary['near_expiry_count'] ?></span>
                    </a>
                </li>
                <li id="tab_nav_customer_dues">
                    <a href="javascript:void(0);" onclick="switchReminderTab('customer_dues')" style="font-weight: 700; font-size: 13.5px; border-radius: 8px; padding: 8px 16px;">
                        <i class="fa fa-comments" style="color: #25d366; margin-right: 4px;"></i> Customer Payment Reminders
                        <span class="badge badge-info" id="tab_badge_cust" style="margin-left: 4px;"><?= $summary['customer_dues_count'] ?></span>
                    </a>
                </li>
                <li id="tab_nav_supplier_dues">
                    <a href="javascript:void(0);" onclick="switchReminderTab('supplier_dues')" style="font-weight: 700; font-size: 13.5px; border-radius: 8px; padding: 8px 16px;">
                        <i class="fa fa-truck" style="color: #8b5cf6; margin-right: 4px;"></i> Supplier Dues
                        <span class="badge" id="tab_badge_sup" style="margin-left: 4px;"><?= $summary['supplier_dues_count'] ?></span>
                    </a>
                </li>
                <li id="tab_nav_settings">
                    <a href="javascript:void(0);" onclick="switchReminderTab('settings')" style="font-weight: 700; font-size: 13.5px; border-radius: 8px; padding: 8px 16px;">
                        <i class="fa fa-cogs" style="margin-right: 4px;"></i> Settings & Automation
                    </a>
                </li>
            </ul>

            <div style="font-size: 12px; color: #64748b;">
                <i class="fa fa-clock-o"></i> Last Scan: <strong id="last_cron_label"><?= !empty($last_cron_time) ? $last_cron_time : 'Not yet executed' ?></strong>
            </div>
        </div>

        <div style="padding: 24px;">
            <!-- ============================================== -->
            <!-- TAB 1: EXPIRED MEDICINES IN STOCK -->
            <!-- ============================================== -->
            <div id="tab_content_expired" class="reminder-tab-pane">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
                    <div style="position: relative; width: 340px; max-width: 100%;">
                        <i class="fa fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="text" id="search_expired" class="form-control" placeholder="Search expired medicine name / batch..." style="width: 100%; padding-left: 34px; border-radius: 8px; border: 1px solid #cbd5e1; height: 38px;" oninput="filterExpiredTable()" />
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <a href="<?= console_url('expiry_return/add_detail') ?>" class="btn btn-danger" style="border-radius: 8px; font-weight: 700;">
                            <i class="fa fa-reply"></i> Create Expiry Return
                        </a>
                        <a href="<?= console_url('medicine_stock/expired_view') ?>" class="btn btn-default" style="border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-external-link"></i> Full Expired Sheet
                        </a>
                    </div>
                </div>

                <div class="table-responsive" style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <table class="table ss-modern-table" style="margin: 0;" id="table_expired">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 50px; text-align: center;">Sl.</th>
                                <th>Medicine Name</th>
                                <th>Batch No.</th>
                                <th style="text-align: center;">Expiry Date</th>
                                <th style="text-align: center;">Strip Stock</th>
                                <th style="text-align: center;">Loose Stock</th>
                                <th style="text-align: right;">MRP</th>
                                <th>Manufacturer</th>
                                <th>Storage</th>
                                <th style="text-align: center; width: 140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_expired">
                            <tr><td colspan="10" style="text-align: center; padding: 24px; color: #64748b;"><i class="fa fa-spinner fa-spin"></i> Loading Expired Medicines...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- TAB 2: NEAR EXPIRY MEDICINES (UPCOMING 30-90 DAYS) -->
            <!-- ============================================== -->
            <div id="tab_content_near_expiry" class="reminder-tab-pane" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                        <div style="position: relative; width: 300px; max-width: 100%;">
                            <i class="fa fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                            <input type="text" id="search_near" class="form-control" placeholder="Search near-expiry medicine..." style="width: 100%; padding-left: 34px; border-radius: 8px; border: 1px solid #cbd5e1; height: 38px;" oninput="filterNearTable()" />
                        </div>
                        <div>
                            <select id="near_days_filter" class="form-control" style="border-radius: 8px; height: 38px; font-weight: 600;" onchange="loadNearExpiryMedicines()">
                                <option value="30">Expiring in Next 30 Days (Urgent)</option>
                                <option value="60" selected>Expiring in Next 60 Days</option>
                                <option value="90">Expiring in Next 90 Days</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <a href="<?= console_url('medicine_stock/expiring_view') ?>" class="btn btn-default" style="border-radius: 8px; font-weight: 600;">
                            <i class="fa fa-external-link"></i> Full Upcoming Sheet
                        </a>
                    </div>
                </div>

                <div class="table-responsive" style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <table class="table ss-modern-table" style="margin: 0;" id="table_near">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 50px; text-align: center;">Sl.</th>
                                <th>Medicine Name</th>
                                <th>Batch No.</th>
                                <th style="text-align: center;">Expiry Date</th>
                                <th style="text-align: center;">Urgency</th>
                                <th style="text-align: center;">Strip Stock</th>
                                <th style="text-align: center;">Loose Stock</th>
                                <th style="text-align: right;">MRP</th>
                                <th>Manufacturer</th>
                                <th style="text-align: center; width: 140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_near">
                            <tr><td colspan="10" style="text-align: center; padding: 24px; color: #64748b;"><i class="fa fa-spinner fa-spin"></i> Loading Upcoming Expiring Medicines...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- TAB 3: CUSTOMER PAYMENT REMINDERS -->
            <!-- ============================================== -->
            <div id="tab_content_customer_dues" class="reminder-tab-pane" style="display: none;">
                <div style="background: rgba(37, 211, 102, 0.08); border: 1px solid rgba(37, 211, 102, 0.25); border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="display: inline-flex; width: 36px; height: 36px; border-radius: 50%; background: #25d366; color: #fff; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="fa fa-whatsapp"></i>
                        </span>
                        <div>
                            <div style="font-weight: 700; color: #166534; font-size: 14px;">Instant WhatsApp & SMS Payment Reminders</div>
                            <div style="font-size: 12.5px; color: #15803d;">Click the WhatsApp button next to any customer to instantly open a personalized payment reminder message with total due amount.</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" onclick="openBulkWhatsAppReminder()" style="background: #25d366; border-color: #22c55e; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa fa-paper-plane"></i> Quick Blast Reminders
                    </button>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                        <div style="position: relative; width: 300px; max-width: 100%;">
                            <i class="fa fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                            <input type="text" id="search_customer" class="form-control" placeholder="Search patient name, mobile, address..." style="width: 100%; padding-left: 34px; border-radius: 8px; border: 1px solid #cbd5e1; height: 38px;" oninput="filterCustomerTable()" />
                        </div>
                        <div>
                            <select id="cust_filter_days" class="form-control" style="border-radius: 8px; height: 38px; font-weight: 600;" onchange="loadCustomerDues()">
                                <option value="all">All Pending Dues</option>
                                <option value="15">> 15 Days Overdue</option>
                                <option value="30">> 30 Days Overdue (Critical)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <a href="<?= console_url('customer_payments/add_detail') ?>" class="btn btn-primary ss-btn-primary" style="border-radius: 8px; font-weight: 700;">
                            <i class="fa fa-plus-circle"></i> Record Customer Payment
                        </a>
                    </div>
                </div>

                <div class="table-responsive" style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <table class="table ss-modern-table" style="margin: 0;" id="table_customer">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 50px; text-align: center;">Sl.</th>
                                <th>Customer / Patient</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th style="text-align: right;">Total Due Amount</th>
                                <th style="text-align: center;">Days Overdue</th>
                                <th style="text-align: center;">Last Billing Date</th>
                                <th style="text-align: center; width: 220px;">Send Reminder</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_customer">
                            <tr><td colspan="8" style="text-align: center; padding: 24px; color: #64748b;"><i class="fa fa-spinner fa-spin"></i> Loading Customer Payment Dues...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- TAB 4: SUPPLIER DUES -->
            <!-- ============================================== -->
            <div id="tab_content_supplier_dues" class="reminder-tab-pane" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 12px;">
                    <div style="position: relative; width: 340px; max-width: 100%;">
                        <i class="fa fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                        <input type="text" id="search_supplier" class="form-control" placeholder="Search supplier name / phone..." style="width: 100%; padding-left: 34px; border-radius: 8px; border: 1px solid #cbd5e1; height: 38px;" oninput="filterSupplierTable()" />
                    </div>
                    <div>
                        <a href="<?= console_url('payments/add_detail') ?>" class="btn btn-primary ss-btn-primary" style="border-radius: 8px; font-weight: 700;">
                            <i class="fa fa-plus-circle"></i> Pay Supplier
                        </a>
                    </div>
                </div>

                <div class="table-responsive" style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <table class="table ss-modern-table" style="margin: 0;" id="table_supplier">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 50px; text-align: center;">Sl.</th>
                                <th>Supplier Name</th>
                                <th>Contact No.</th>
                                <th>Address</th>
                                <th style="text-align: right;">Total Purchases</th>
                                <th style="text-align: right;">Total Paid</th>
                                <th style="text-align: right; color: #8b5cf6;">Outstanding Balance</th>
                                <th style="text-align: center; width: 140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_supplier">
                            <tr><td colspan="8" style="text-align: center; padding: 24px; color: #64748b;"><i class="fa fa-spinner fa-spin"></i> Loading Supplier Outstanding Dues...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- TAB 5: SETTINGS & AUTOMATION -->
            <!-- ============================================== -->
            <div id="tab_content_settings" class="reminder-tab-pane" style="display: none;">
                <div class="row-fluid">
                    <div class="span7">
                        <div style="background: #fafafa; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 20px;">
                            <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                <i class="fa fa-whatsapp" style="color: #25d366;"></i> WhatsApp / SMS Reminder Template
                            </h3>
                            <form id="reminderSettingsForm" onsubmit="saveReminderSettings(event)">
                                <div style="margin-bottom: 16px;">
                                    <label style="font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px; display: block;">Custom Message Template</label>
                                    <textarea id="whatsapp_template_input" class="form-control" rows="6" style="width: 100%; border-radius: 8px; font-family: monospace; font-size: 13px; padding: 10px; border: 1px solid #cbd5e1;"><?= htmlspecialchars($whatsapp_template) ?></textarea>
                                    <div style="font-size: 11.5px; color: #64748b; margin-top: 6px;">
                                        Supported Placeholders: 
                                        <code>{customer_name}</code>, <code>{due_amount}</code>, <code>{store_name}</code>, <code>{phone}</code>, <code>{upi_info}</code>, <code>{date}</code>
                                    </div>
                                </div>

                                <div class="row-fluid" style="margin-bottom: 16px;">
                                    <div class="span6">
                                        <label style="font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px; display: block;">Near Expiry Alert Threshold (Days)</label>
                                        <input type="number" id="near_expiry_days_input" class="form-control" value="<?= $near_expiry_days ?>" min="15" max="365" style="width: 100%; border-radius: 8px; height: 38px; border: 1px solid #cbd5e1;" />
                                    </div>
                                    <div class="span6">
                                        <label style="font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px; display: block;">Min. Due Amount for Alert (Rs.)</label>
                                        <input type="number" id="min_due_input" class="form-control" value="<?= $min_due ?>" min="0" step="1" style="width: 100%; border-radius: 8px; height: 38px; border: 1px solid #cbd5e1;" />
                                    </div>
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label style="font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px; display: block;">Store UPI ID (For fast digital payment links)</label>
                                    <input type="text" id="provider_upi_input" class="form-control" placeholder="e.g. mobile@upi or merchant@okaxis" value="<?= htmlspecialchars($store_upi ?? '') ?>" style="width: 100%; border-radius: 8px; height: 38px; border: 1px solid #cbd5e1;" />
                                </div>

                                <button type="submit" class="btn btn-primary ss-btn-primary" id="saveSettingsBtn" style="padding: 10px 24px; font-weight: 700; border-radius: 8px;">
                                    <i class="fa fa-save"></i> Save Settings
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="span5">
                        <!-- Automation / Windows Task Scheduler Guide -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px;">
                            <h4 style="font-size: 15px; font-weight: 800; color: #0f172a; margin-top: 0; display: flex; align-items: center; gap: 8px;">
                                <i class="fa fa-clock-o" style="color: #6366f1;"></i> Automated Background Scheduler
                            </h4>
                            <p style="font-size: 12.5px; color: #475569; line-height: 1.5;">
                                The system includes an automated background cron runner that scans stock and customer payments daily without requiring manual checks.
                            </p>

                            <div style="margin-bottom: 14px;">
                                <div style="font-weight: 700; font-size: 12px; color: #1e293b; margin-bottom: 4px;">Command Line / Windows Task Scheduler:</div>
                                <div style="background: #0f172a; color: #38bdf8; padding: 10px 12px; border-radius: 6px; font-family: monospace; font-size: 11px; word-break: break-all;">
                                    c:\xampp\php\php.exe c:\xampp\htdocs\medical_shop\reminder_cron.php
                                </div>
                            </div>

                            <div style="margin-bottom: 14px;">
                                <div style="font-weight: 700; font-size: 12px; color: #1e293b; margin-bottom: 4px;">Webhook / Web URL Cron:</div>
                                <div style="background: #0f172a; color: #34d399; padding: 10px 12px; border-radius: 6px; font-family: monospace; font-size: 11px; word-break: break-all;">
                                    <?= console_url('reminder/cron') ?>
                                </div>
                            </div>

                            <div style="border-top: 1px solid #e2e8f0; padding-top: 12px; margin-top: 12px; font-size: 12px; color: #64748b;">
                                <strong>Auto-Check Status:</strong> Daily background auto-check is active. Activity logs are recorded every morning.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- WHATSAPP MESSAGE PREVIEW MODAL -->
<!-- ============================================== -->
<div id="waPreviewModal" class="modal hide fade" tabindex="-1" role="dialog" style="border-radius: 14px; overflow: hidden; width: 560px; margin-left: -280px;">
    <div class="modal-header" style="background: #25d366; color: #ffffff; padding: 14px 20px;">
        <button type="button" class="close" data-dismiss="modal" style="color: #ffffff; opacity: 0.8;">&times;</button>
        <h4 style="margin: 0; font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 8px;">
            <i class="fa fa-whatsapp"></i> Send WhatsApp Payment Reminder
        </h4>
    </div>
    <div class="modal-body" style="padding: 20px;">
        <div style="margin-bottom: 12px;">
            <label style="font-weight: 700; font-size: 12.5px; color: #475569; margin-bottom: 4px; display: block;">Recipient:</label>
            <div id="modal_cust_info" style="font-weight: 800; font-size: 15px; color: #0f172a;"></div>
        </div>
        <div style="margin-bottom: 16px;">
            <label style="font-weight: 700; font-size: 12.5px; color: #475569; margin-bottom: 4px; display: block;">Message Preview (Editable):</label>
            <textarea id="modal_wa_text" class="form-control" rows="7" style="width: 100%; border-radius: 8px; font-size: 13px; padding: 10px; border: 1px solid #cbd5e1;"></textarea>
        </div>
    </div>
    <div class="modal-footer" style="padding: 12px 20px; background: #f8fafc; display: flex; justify-content: space-between; align-items: center;">
        <button type="button" class="btn btn-default" onclick="copyModalWaText()" style="border-radius: 8px; font-weight: 600;">
            <i class="fa fa-copy"></i> Copy Text
        </button>
        <div style="display: flex; gap: 8px;">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px;">Cancel</button>
            <button type="button" class="btn btn-success" onclick="openWhatsAppDirect()" style="background: #25d366; border-color: #22c55e; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fa fa-whatsapp"></i> Open WhatsApp Web
            </button>
        </div>
    </div>
</div>

<!-- ============================================== -->
<!-- JAVASCRIPT LOGIC FOR REMINDERS DASHBOARD -->
<!-- ============================================== -->
<script>
var reminderData = {
    expired: [],
    near: [],
    customers: [],
    suppliers: []
};
var currentModalPhone = '';

function switchReminderTab(tabName) {
    $('.reminder-tab-pane').hide();
    $('.ss-card-header .nav-pills li').removeClass('active');
    
    $('#tab_content_' + tabName).show();
    $('#tab_nav_' + tabName).addClass('active');

    if (tabName === 'expired' && reminderData.expired.length === 0) {
        loadExpiredMedicines();
    } else if (tabName === 'near_expiry' && reminderData.near.length === 0) {
        loadNearExpiryMedicines();
    } else if (tabName === 'customer_dues' && reminderData.customers.length === 0) {
        loadCustomerDues();
    } else if (tabName === 'supplier_dues' && reminderData.suppliers.length === 0) {
        loadSupplierDues();
    }
}

// 1. Load Expired Medicines
function loadExpiredMedicines() {
    $('#tbody_expired').html('<tr><td colspan="10" style="text-align: center; padding: 24px; color: #64748b;"><i class="fa fa-spinner fa-spin"></i> Scanning Expired Stock...</td></tr>');
    $.post('<?= console_url("reminder/ajax_expired") ?>', { search: $('#search_expired').val() }, function(res) {
        if (res.status === 'success') {
            reminderData.expired = res.items || [];
            renderExpiredTable(reminderData.expired);
            $('#tab_badge_expired').text(res.count);
            $('#stat_expired_count').text(res.count);
        } else {
            $('#tbody_expired').html('<tr><td colspan="10" style="text-align: center; padding: 20px; color: #ef4444;">Failed to load expired medicines.</td></tr>');
        }
    }, 'json').fail(function() {
        $('#tbody_expired').html('<tr><td colspan="10" style="text-align: center; padding: 20px; color: #ef4444;">Error connecting to server.</td></tr>');
    });
}

function renderExpiredTable(items) {
    if (!items || items.length === 0) {
        $('#tbody_expired').html('<tr><td colspan="10" style="text-align: center; padding: 30px; color: #10b981;"><i class="fa fa-check-circle" style="font-size: 24px; display: block; margin-bottom: 6px;"></i> Great news! No expired medicines currently in stock.</td></tr>');
        return;
    }
    var html = '';
    $.each(items, function(i, item) {
        var strips = parseInt(item.medicine_strip_stock) || 0;
        var loose = parseInt(item.medicine_loose_stock) || 0;
        var mrp = parseFloat(item.medicine_mrp) || 0;
        var estLoss = (strips * mrp) + (loose * (mrp / 10));

        html += '<tr>';
        html += '<td style="text-align: center; font-weight: 700; color: #94a3b8;">' + (i + 1) + '</td>';
        html += '<td style="font-weight: 800; color: #0f172a;">' + (item.medicine_name || 'N/A') + '</td>';
        html += '<td><span class="label label-important" style="font-size: 11px; padding: 3px 8px; border-radius: 4px;">' + (item.medicine_stock_batch || item.purchase_batch || 'N/A') + '</span></td>';
        html += '<td style="text-align: center; font-weight: 700; color: #ef4444;">' + (item.medicine_expire_month || item.purchase_expire_month) + '/20' + (item.medicine_expire_year || item.purchase_expire_year) + '</td>';
        html += '<td style="text-align: center; font-weight: 700;">' + strips + '</td>';
        html += '<td style="text-align: center; font-weight: 700;">' + loose + '</td>';
        html += '<td style="text-align: right; font-weight: 600;">Rs. ' + mrp.toFixed(2) + '</td>';
        html += '<td style="color: #64748b; font-size: 12.5px;">' + (item.medicine_manufacturer || 'N/A') + '</td>';
        html += '<td style="color: #64748b; font-size: 12.5px;">' + (item.medicine_storage || 'N/A') + '</td>';
        html += '<td style="text-align: center;">';
        html += '  <a href="<?= console_url("expiry_return/add_detail") ?>" class="btn btn-mini btn-danger" style="border-radius: 6px; font-weight: 700; padding: 4px 10px;" title="Create Expiry Return to Supplier">';
        html += '    <i class="fa fa-reply"></i> Return';
        html += '  </a>';
        html += '</td>';
        html += '</tr>';
    });
    $('#tbody_expired').html(html);
}

function filterExpiredTable() {
    var q = $('#search_expired').val().toLowerCase();
    var filtered = reminderData.expired.filter(function(x) {
        return (x.medicine_name && x.medicine_name.toLowerCase().indexOf(q) !== -1) ||
               (x.medicine_stock_batch && x.medicine_stock_batch.toLowerCase().indexOf(q) !== -1);
    });
    renderExpiredTable(filtered);
}

// 2. Load Near Expiry Medicines
function loadNearExpiryMedicines() {
    var days = $('#near_days_filter').val() || 60;
    $('#tbody_near').html('<tr><td colspan="10" style="text-align: center; padding: 24px; color: #64748b;"><i class="fa fa-spinner fa-spin"></i> Scanning Upcoming Expiries...</td></tr>');
    $.post('<?= console_url("reminder/ajax_near_expiry") ?>', { days: days, search: $('#search_near').val() }, function(res) {
        if (res.status === 'success') {
            reminderData.near = res.items || [];
            renderNearTable(reminderData.near);
            $('#tab_badge_near').text(res.count);
            $('#stat_near_count').text(res.count);
        } else {
            $('#tbody_near').html('<tr><td colspan="10" style="text-align: center; padding: 20px; color: #ef4444;">Failed to load upcoming expiries.</td></tr>');
        }
    }, 'json');
}

function renderNearTable(items) {
    if (!items || items.length === 0) {
        $('#tbody_near').html('<tr><td colspan="10" style="text-align: center; padding: 30px; color: #10b981;"><i class="fa fa-check-circle" style="font-size: 24px; display: block; margin-bottom: 6px;"></i> No medicines expiring in the selected time range.</td></tr>');
        return;
    }
    var html = '';
    $.each(items, function(i, item) {
        var strips = parseInt(item.medicine_strip_stock) || 0;
        var loose = parseInt(item.medicine_loose_stock) || 0;
        var mrp = parseFloat(item.medicine_mrp) || 0;
        var month = parseInt(item.medicine_expire_month || item.purchase_expire_month) || 1;
        var year = parseInt(item.medicine_expire_year || item.purchase_expire_year) || 26;

        html += '<tr>';
        html += '<td style="text-align: center; font-weight: 700; color: #94a3b8;">' + (i + 1) + '</td>';
        html += '<td style="font-weight: 800; color: #0f172a;">' + (item.medicine_name || 'N/A') + '</td>';
        html += '<td><span class="label label-warning" style="font-size: 11px; padding: 3px 8px; border-radius: 4px;">' + (item.medicine_stock_batch || item.purchase_batch || 'N/A') + '</span></td>';
        html += '<td style="text-align: center; font-weight: 700; color: #d97706;">' + month + '/20' + year + '</td>';
        html += '<td style="text-align: center;"><span class="label label-warning" style="font-size: 11px;">Expires Soon</span></td>';
        html += '<td style="text-align: center; font-weight: 700;">' + strips + '</td>';
        html += '<td style="text-align: center; font-weight: 700;">' + loose + '</td>';
        html += '<td style="text-align: right; font-weight: 600;">Rs. ' + mrp.toFixed(2) + '</td>';
        html += '<td style="color: #64748b; font-size: 12.5px;">' + (item.medicine_manufacturer || 'N/A') + '</td>';
        html += '<td style="text-align: center;">';
        html += '  <a href="<?= console_url("expiry_return/add_detail") ?>" class="btn btn-mini btn-warning" style="border-radius: 6px; font-weight: 700; padding: 4px 10px;" title="Return to Supplier">';
        html += '    <i class="fa fa-reply"></i> Return';
        html += '  </a>';
        html += '</td>';
        html += '</tr>';
    });
    $('#tbody_near').html(html);
}

function filterNearTable() {
    var q = $('#search_near').val().toLowerCase();
    var filtered = reminderData.near.filter(function(x) {
        return (x.medicine_name && x.medicine_name.toLowerCase().indexOf(q) !== -1) ||
               (x.medicine_stock_batch && x.medicine_stock_batch.toLowerCase().indexOf(q) !== -1);
    });
    renderNearTable(filtered);
}

// 3. Load Customer Payment Dues
function loadCustomerDues() {
    var filterDays = $('#cust_filter_days').val() || 'all';
    $('#tbody_customer').html('<tr><td colspan="8" style="text-align: center; padding: 24px; color: #64748b;"><i class="fa fa-spinner fa-spin"></i> Loading Customer Payment Dues...</td></tr>');
    $.post('<?= console_url("reminder/ajax_customer_dues") ?>', { filter_days: filterDays, search: $('#search_customer').val() }, function(res) {
        if (res.status === 'success') {
            reminderData.customers = res.items || [];
            renderCustomerTable(reminderData.customers);
            $('#tab_badge_cust').text(res.count);
            $('#stat_cust_count').text(res.count + ' patients');
        } else {
            $('#tbody_customer').html('<tr><td colspan="8" style="text-align: center; padding: 20px; color: #ef4444;">Failed to load customer dues.</td></tr>');
        }
    }, 'json');
}

function renderCustomerTable(items) {
    if (!items || items.length === 0) {
        $('#tbody_customer').html('<tr><td colspan="8" style="text-align: center; padding: 30px; color: #10b981;"><i class="fa fa-check-circle" style="font-size: 24px; display: block; margin-bottom: 6px;"></i> All customer accounts are fully paid! No pending dues.</td></tr>');
        return;
    }
    var html = '';
    $.each(items, function(i, c) {
        var dueVal = parseFloat(c.due_amount) || 0;
        var overdueBadge = '';
        if (c.days_overdue > 30) {
            overdueBadge = '<span class="label label-important">' + c.days_overdue + ' days (Critical)</span>';
        } else if (c.days_overdue > 15) {
            overdueBadge = '<span class="label label-warning">' + c.days_overdue + ' days</span>';
        } else {
            overdueBadge = '<span class="label label-info">' + (c.days_overdue > 0 ? c.days_overdue + ' days' : 'Recent') + '</span>';
        }

        html += '<tr>';
        html += '<td style="text-align: center; font-weight: 700; color: #94a3b8;">' + (i + 1) + '</td>';
        html += '<td><strong style="color: #0f172a; font-size: 14px;">' + c.customer_name + '</strong>';
        if (c.doctor_name) html += '<br><small style="color: #64748b;">Dr: ' + c.doctor_name + '</small>';
        html += '</td>';
        html += '<td>';
        if (c.customer_contact) {
            html += '<a href="tel:' + c.customer_contact + '" style="font-weight: 700; color: #0284c7;"><i class="fa fa-phone"></i> ' + c.customer_contact + '</a>';
        } else {
            html += '<span style="color: #94a3b8; font-style: italic;">No Phone</span>';
        }
        html += '</td>';
        html += '<td style="font-size: 12.5px; color: #64748b;">' + (c.customer_address || 'N/A') + '</td>';
        html += '<td style="text-align: right; font-weight: 800; font-size: 14.5px; color: #dc2626;">Rs. ' + dueVal.toFixed(2) + '</td>';
        html += '<td style="text-align: center;">' + overdueBadge + '</td>';
        html += '<td style="text-align: center; font-size: 12px; color: #64748b;">' + (c.last_sale_date || 'N/A') + '</td>';
        html += '<td style="text-align: center; white-space: nowrap;">';
        
        if (c.whatsapp_url) {
            html += '  <button type="button" class="btn btn-mini btn-success" onclick="openWhatsAppModal(' + i + ')" style="background: #25d366; border-color: #22c55e; border-radius: 6px; font-weight: 700; padding: 4px 10px; margin-right: 4px;" title="Send WhatsApp Payment Reminder">';
            html += '    <i class="fa fa-whatsapp"></i> WhatsApp';
            html += '  </button>';
        }

        html += '  <a href="<?= console_url("customer_payments/add_detail") ?>" class="btn btn-mini btn-primary" style="border-radius: 6px; font-weight: 600; padding: 4px 8px;" title="Record Payment">';
        html += '    <i class="fa fa-money"></i> Pay';
        html += '  </a>';
        html += '</td>';
        html += '</tr>';
    });
    $('#tbody_customer').html(html);
}

function filterCustomerTable() {
    var q = $('#search_customer').val().toLowerCase();
    var filtered = reminderData.customers.filter(function(x) {
        return (x.customer_name && x.customer_name.toLowerCase().indexOf(q) !== -1) ||
               (x.customer_contact && x.customer_contact.toLowerCase().indexOf(q) !== -1) ||
               (x.customer_address && x.customer_address.toLowerCase().indexOf(q) !== -1);
    });
    renderCustomerTable(filtered);
}

function openWhatsAppModal(idx) {
    var c = reminderData.customers[idx];
    if (!c) return;
    currentModalPhone = c.customer_contact ? c.customer_contact.replace(/[^0-9]/g, '') : '';
    if (currentModalPhone.length === 10) currentModalPhone = '91' + currentModalPhone;

    $('#modal_cust_info').html(c.customer_name + ' &bull; <span style="color: #25d366;"><i class="fa fa-phone"></i> ' + (c.customer_contact || 'N/A') + '</span> &bull; <strong style="color: #ef4444;">Due: Rs. ' + c.due_amount + '</strong>');
    $('#modal_wa_text').val(c.whatsapp_msg);
    $('#waPreviewModal').modal('show');
}

function openWhatsAppDirect() {
    var text = encodeURIComponent($('#modal_wa_text').val());
    if (!currentModalPhone) {
        alert('Customer mobile number is missing.');
        return;
    }
    var url = 'https://wa.me/' + currentModalPhone + '?text=' + text;
    window.open(url, '_blank');
}

function copyModalWaText() {
    var copyText = document.getElementById("modal_wa_text");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    alert("Reminder message copied to clipboard!");
}

function openBulkWhatsAppReminder() {
    var count = reminderData.customers.length;
    if (count === 0) {
        alert("No customers with pending dues found.");
        return;
    }
    if (confirm("Found " + count + " customers with pending dues. Do you want to review and send reminders starting with the highest overdue customer?")) {
        openWhatsAppModal(0);
    }
}

// 4. Load Supplier Dues
function loadSupplierDues() {
    $('#tbody_supplier').html('<tr><td colspan="8" style="text-align: center; padding: 24px; color: #64748b;"><i class="fa fa-spinner fa-spin"></i> Loading Supplier Outstanding Dues...</td></tr>');
    $.post('<?= console_url("reminder/ajax_supplier_dues") ?>', { search: $('#search_supplier').val() }, function(res) {
        if (res.status === 'success') {
            reminderData.suppliers = res.items || [];
            renderSupplierTable(reminderData.suppliers);
            $('#tab_badge_sup').text(res.count);
            $('#stat_sup_count').text(res.count + ' suppliers');
        } else {
            $('#tbody_supplier').html('<tr><td colspan="8" style="text-align: center; padding: 20px; color: #ef4444;">Failed to load supplier dues.</td></tr>');
        }
    }, 'json');
}

function renderSupplierTable(items) {
    if (!items || items.length === 0) {
        $('#tbody_supplier').html('<tr><td colspan="8" style="text-align: center; padding: 30px; color: #10b981;"><i class="fa fa-check-circle" style="font-size: 24px; display: block; margin-bottom: 6px;"></i> All supplier accounts are cleared! No pending dues.</td></tr>');
        return;
    }
    var html = '';
    $.each(items, function(i, s) {
        html += '<tr>';
        html += '<td style="text-align: center; font-weight: 700; color: #94a3b8;">' + (i + 1) + '</td>';
        html += '<td style="font-weight: 800; color: #0f172a;">' + s.supplier_name + '</td>';
        html += '<td><a href="tel:' + s.supplier_contact + '" style="color: #6366f1; font-weight: 600;"><i class="fa fa-phone"></i> ' + (s.supplier_contact || 'N/A') + '</a></td>';
        html += '<td style="color: #64748b; font-size: 12.5px;">' + (s.supplier_address || 'N/A') + '</td>';
        html += '<td style="text-align: right; font-weight: 600;">Rs. ' + s.total_purchases + '</td>';
        html += '<td style="text-align: right; font-weight: 600; color: #10b981;">Rs. ' + s.total_payments + '</td>';
        html += '<td style="text-align: right; font-weight: 800; color: #8b5cf6; font-size: 14px;">Rs. ' + s.pending_balance + '</td>';
        html += '<td style="text-align: center;">';
        html += '  <a href="<?= console_url("payments/add_detail") ?>" class="btn btn-mini btn-primary" style="border-radius: 6px; font-weight: 700; padding: 4px 10px;">';
        html += '    <i class="fa fa-money"></i> Pay Supplier';
        html += '  </a>';
        html += '</td>';
        html += '</tr>';
    });
    $('#tbody_supplier').html(html);
}

function filterSupplierTable() {
    var q = $('#search_supplier').val().toLowerCase();
    var filtered = reminderData.suppliers.filter(function(x) {
        return (x.supplier_name && x.supplier_name.toLowerCase().indexOf(q) !== -1) ||
               (x.supplier_contact && x.supplier_contact.toLowerCase().indexOf(q) !== -1);
    });
    renderSupplierTable(filtered);
}

// 5. Save Reminder Settings
function saveReminderSettings(e) {
    e.preventDefault();
    var btn = $('#saveSettingsBtn');
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

    var postData = {
        whatsapp_template: $('#whatsapp_template_input').val(),
        near_expiry_days: $('#near_expiry_days_input').val(),
        min_due_amount: $('#min_due_input').val(),
        provider_upi: $('#provider_upi_input').val()
    };

    $.post('<?= console_url("reminder/settings") ?>', postData, function(res) {
        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Save Settings');
        if (res.status === 'success') {
            alert('Settings saved successfully!');
        } else {
            alert(res.message || 'Error saving settings.');
        }
    }, 'json');
}

// 6. Run Automated Scan / Cron
function runAutomatedScan() {
    var btn = $('#cronRunBtn');
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Scanning DB...');

    $.post('<?= console_url("reminder/cron") ?>', {}, function(res) {
        btn.prop('disabled', false).html('<i class="fa fa-bolt"></i> Run Auto-Scan');
        if (res.status === 'success') {
            $('#last_cron_label').text(res.timestamp);
            refreshSummary(true);
            alert('Automated scan completed!\n' + res.message);
        } else {
            alert('Failed to execute scan.');
        }
    }, 'json');
}

function refreshSummary(refreshCurrentTab) {
    $.post('<?= console_url("reminder/get_summary") ?>', {}, function(res) {
        if (res.status === 'success') {
            var d = res.data;
            $('#stat_expired_count').text(d.expired_count);
            $('#stat_expired_val').text('Rs. ' + parseFloat(d.expired_value).toFixed(2));
            $('#stat_near_count').text(d.near_expiry_count);
            $('#stat_near_val').text('Rs. ' + parseFloat(d.near_expiry_value).toFixed(2));
            $('#stat_cust_count').html(d.customer_dues_count + ' <span style="font-size: 14px; font-weight: 600; color: #64748b;">patients</span>');
            $('#stat_cust_due').text('Rs. ' + parseFloat(d.customer_dues_total).toFixed(2));
            $('#stat_sup_count').html(d.supplier_dues_count + ' <span style="font-size: 14px; font-weight: 600; color: #64748b;">suppliers</span>');
            $('#stat_sup_due').text('Rs. ' + parseFloat(d.supplier_dues_total).toFixed(2));

            $('#tab_badge_expired').text(d.expired_count);
            $('#tab_badge_near').text(d.near_expiry_count);
            $('#tab_badge_cust').text(d.customer_dues_count);
            $('#tab_badge_sup').text(d.supplier_dues_count);

            if (refreshCurrentTab) {
                var activeTab = $('.ss-card-header .nav-pills li.active').attr('id').replace('tab_nav_', '');
                if (activeTab === 'expired') loadExpiredMedicines();
                else if (activeTab === 'near_expiry') loadNearExpiryMedicines();
                else if (activeTab === 'customer_dues') loadCustomerDues();
                else if (activeTab === 'supplier_dues') loadSupplierDues();
            }
        }
    }, 'json');
}

// Initial load
$(document).ready(function() {
    loadExpiredMedicines();
});
</script>
