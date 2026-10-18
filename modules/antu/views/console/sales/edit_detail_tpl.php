<?php
// POS Edit Sale Invoice Template - Compact ERP Grid & Smart School Upgrade
?>
<style>
    :root {
        --sale-primary: #4f46e5;
        --sale-primary-hover: #4338ca;
        --sale-success: #10b981;
        --sale-success-hover: #059669;
        --sale-danger: #ef4444;
        --sale-warning: #f59e0b;
        --sale-bg: #f8fafc;
        --sale-card: #ffffff;
        --sale-border: #e2e8f0;
        --sale-border-focus: #4f46e5;
        --sale-text: #1e293b;
        --sale-text-muted: #64748b;
        --sale-font: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .sale-wrapper {
        font-family: var(--sale-font);
        color: var(--sale-text);
        padding-bottom: 95px;
    }

    /* Page Header */
    .sale-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 16px;
        padding: 4px 0;
    }
    .sale-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .sale-title-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
    }
    .sale-title {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }
    .sale-subtitle {
        font-size: 12px;
        color: var(--sale-text-muted);
        margin: 2px 0 0 0;
    }

    /* Cards */
    .sale-card {
        background: var(--sale-card);
        border: 1px solid var(--sale-border);
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        margin-bottom: 16px;
        overflow: hidden;
    }
    .sale-card-header {
        background: #ffffff;
        padding: 10px 16px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .sale-card-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }
    .sale-card-title i {
        color: var(--sale-primary);
        font-size: 13px;
    }
    .sale-card-body {
        padding: 14px 16px;
    }

    /* Form Grid */
    .sale-form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 12px 14px;
    }
    .sale-form-group {
        display: flex;
        flex-direction: column;
    }
    .sale-form-group.col-span-2 {
        grid-column: span 2;
    }
    .sale-form-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #475569;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .sale-form-label .req {
        color: var(--sale-danger);
    }
    .sale-input-wrap {
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
    }
    .sale-input-icon {
        position: absolute !important;
        left: 11px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        color: #94a3b8 !important;
        font-size: 13px !important;
        line-height: 1 !important;
        pointer-events: none !important;
        z-index: 5 !important;
    }
    .sale-control,
    .sale-input-wrap input[type="text"],
    .sale-input-wrap input {
        width: 100% !important;
        height: 34px !important;
        font-size: 12.5px !important;
        font-weight: 500 !important;
        color: #1e293b !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 5px !important;
        outline: none !important;
        box-shadow: none !important;
        box-sizing: border-box !important;
        padding: 6px 12px 6px 36px !important;
        transition: border-color 0.15s ease !important;
    }
    .sale-control:focus,
    .sale-input-wrap input[type="text"]:focus,
    .sale-input-wrap input:focus {
        border-color: var(--sale-border-focus) !important;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.15) !important;
    }
    .sale-control[readonly],
    .sale-input-wrap input[readonly] {
        background: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
    }
    .sale-input-wrap input.text-right {
        padding-left: 36px !important;
        padding-right: 12px !important;
        text-align: right !important;
    }
    select.sale-control {
        padding-left: 10px !important;
    }

    /* Items Table */
    .sale-table-container {
        border: 1px solid var(--sale-border);
        border-radius: 6px;
        overflow-x: auto;
        background: #ffffff;
    }
    .sale-items-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11.5px;
        margin-bottom: 0;
    }
    .sale-items-table thead th {
        background: #f1f5f9 !important;
        color: #334155 !important;
        font-weight: 700 !important;
        font-size: 10.5px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.03em !important;
        padding: 6px 4px !important;
        border: 1px solid #cbd5e1 !important;
        white-space: nowrap !important;
        text-align: center !important;
        vertical-align: middle !important;
    }
    .sale-items-table tbody td {
        padding: 2px 2px !important;
        border: 1px solid #e2e8f0 !important;
        vertical-align: middle !important;
        background: #ffffff;
    }
    .sale-items-table tbody tr.rowline:hover td {
        background: #faf5ff !important;
    }
    .sale-items-table tbody tr.rowline:focus-within td {
        background: #f0fdf4 !important;
    }

    /* COMPACT Table Cell Inputs - ZERO EXTRA PADDING */
    .sale-items-table input.sale-cell-input,
    .sale-items-table input[type="text"],
    .sale-items-table input[type="number"] {
        border-radius: 2px !important;
        padding: 2px 4px !important;
        height: 25px !important;
        min-height: 25px !important;
        max-height: 25px !important;
        font-size: 11.5px !important;
        border: 1px solid #cbd5e1 !important;
        background: #ffffff !important;
        box-shadow: none !important;
        box-sizing: border-box !important;
        width: 100% !important;
        margin: 0 !important;
        outline: none !important;
        line-height: normal !important;
    }
    .sale-items-table input.sale-cell-input:focus,
    .sale-items-table input[type="text"]:focus,
    .sale-items-table input[type="number"]:focus {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 1px #4f46e5 !important;
        background: #ffffff !important;
    }
    .sale-cell-input.text-right {
        text-align: right !important;
    }
    .sale-cell-input.text-center {
        text-align: center !important;
    }
    .sale-cell-input[readonly] {
        background: #f8fafc !important;
        color: #475569 !important;
        border-color: #e2e8f0 !important;
        font-weight: 600 !important;
    }
    .sale-cell-input.highlight-total {
        background: #ecfdf5 !important;
        color: #065f46 !important;
        border-color: #a7f3d0 !important;
        font-weight: 700 !important;
    }

    /* Batch Chooser Dropdown */
    .batchchooser {
        height: 25px !important;
        min-height: 25px !important;
        padding: 1px 4px !important;
        font-size: 11px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 2px !important;
        background: #ffffff !important;
        color: #1e293b !important;
        outline: none !important;
        width: 100% !important;
        box-sizing: border-box !important;
        font-weight: 600 !important;
    }
    .batchchooser:focus {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 1px #4f46e5 !important;
    }

    /* COMPACT Expiry Split Container */
    .sale-exp-wrap {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 2px !important;
        padding: 0 !important;
        height: 25px !important;
        min-height: 25px !important;
        max-height: 25px !important;
        width: 60px !important;
        min-width: 60px !important;
        max-width: 60px !important;
        box-sizing: border-box !important;
        margin: 0 auto !important;
    }
    .sale-exp-wrap:focus-within {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 1px #4f46e5 !important;
    }
    .sale-exp-wrap input,
    .sale-exp-wrap input[type="text"] {
        width: 24px !important;
        min-width: 24px !important;
        max-width: 24px !important;
        height: 23px !important;
        min-height: 23px !important;
        max-height: 23px !important;
        border: none !important;
        border-radius: 0 !important;
        outline: none !important;
        padding: 0 !important;
        margin: 0 !important;
        text-align: center !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        background: transparent !important;
        box-shadow: none !important;
    }
    .sale-exp-sep {
        color: #94a3b8 !important;
        font-weight: 700 !important;
        font-size: 11px !important;
        padding: 0 1px !important;
        line-height: 1 !important;
        user-select: none !important;
    }

    /* Row Actions */
    .sale-row-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        padding: 0 2px;
    }
    .sale-row-idx {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        min-width: 14px;
        text-align: center;
    }
    .btn-remove-row {
        width: 20px !important;
        height: 20px !important;
        min-width: 20px !important;
        min-height: 20px !important;
        border-radius: 3px !important;
        background: #fef2f2 !important;
        border: 1px solid #fecaca !important;
        color: #ef4444 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        padding: 0 !important;
        font-size: 10px !important;
        line-height: 1 !important;
        transition: all 0.15s ease !important;
    }
    .btn-remove-row:hover {
        background: #ef4444 !important;
        color: #ffffff !important;
        border-color: #ef4444 !important;
    }

    /* Summary KPI Grid */
    .sale-kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
        margin-top: 16px;
    }
    .sale-kpi-card {
        background: #ffffff;
        border: 1px solid var(--sale-border);
        border-radius: 8px;
        padding: 10px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }
    .sale-kpi-info {
        display: flex;
        flex-direction: column;
    }
    .sale-kpi-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--sale-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .sale-kpi-value {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        margin-top: 2px;
    }
    .sale-kpi-grand {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border: none;
        color: #ffffff;
    }
    .sale-kpi-grand .sale-kpi-label {
        color: rgba(255, 255, 255, 0.85);
    }
    .sale-kpi-grand .sale-kpi-value {
        color: #ffffff;
        font-size: 18px;
    }

    /* Sticky Bottom Bar */
    .sale-sticky-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #ffffff;
        border-top: 1px solid #cbd5e1;
        box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.07);
        padding: 10px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 1000;
        flex-wrap: wrap;
        gap: 12px;
    }
    .sale-sticky-left {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .sale-sticky-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 5px;
        background: #f1f5f9;
        color: #334155;
    }
    .sale-sticky-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Buttons */
    .btn-sale-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff !important;
        border: none;
        font-weight: 700;
        font-size: 13px;
        padding: 8px 22px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        transition: all 0.15s ease;
    }
    .btn-sale-primary:hover {
        background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
        transform: translateY(-1px);
    }
    .btn-sale-secondary {
        background: #ffffff;
        color: #475569 !important;
        border: 1px solid #cbd5e1;
        font-weight: 600;
        font-size: 12.5px;
        padding: 7px 16px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
    }
    .btn-sale-secondary:hover {
        background: #f8fafc;
        border-color: #94a3b8;
        color: #1e293b !important;
    }
    .btn-sale-add {
        background: #eef2ff;
        color: #4338ca !important;
        border: 1px solid #c7d2fe;
        font-weight: 700;
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 5px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
    }
    .btn-sale-add:hover {
        background: #4f46e5;
        color: #ffffff !important;
        border-color: #4f46e5;
    }

    /* Autocomplete Dropdown - Always on top */
    .ui-autocomplete {
        z-index: 9999999 !important;
        position: absolute !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.18) !important;
        border-radius: 6px !important;
        max-height: 280px !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        font-size: 12px !important;
        font-family: var(--sale-font) !important;
        padding: 4px 0 !important;
        list-style: none !important;
        margin: 0 !important;
    }
    .ui-autocomplete .ui-menu-item {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    .ui-autocomplete .ui-menu-item a,
    .ui-autocomplete .ui-menu-item .ui-menu-item-wrapper,
    .ui-autocomplete .ui-menu-item > div {
        display: block !important;
        padding: 6px 12px !important;
        color: #1e293b !important;
        text-decoration: none !important;
        cursor: pointer !important;
        line-height: 1.35 !important;
        font-size: 12px !important;
        border: none !important;
    }
    .ui-autocomplete .ui-menu-item:hover,
    .ui-autocomplete .ui-menu-item .ui-state-focus,
    .ui-autocomplete .ui-menu-item .ui-state-active {
        background: #4f46e5 !important;
        color: #ffffff !important;
    }
</style>

<div class="sale-wrapper">

    <?php if (isset($status)): ?>
        <div class="alert alert-<?= $status ?> alert-dismissible" style="border-radius: 6px; font-weight: 600; margin-bottom: 14px;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="fa fa-info-circle"></i> <?= $message ?>
        </div>
    <?php endif; ?>

    <!-- Page Header -->
    <div class="sale-header">
        <div class="sale-title-wrap">
            <div class="sale-title-icon">
                <i class="fa fa-pencil-square-o"></i>
            </div>
            <div>
                <h1 class="sale-title">Edit Sale Invoice</h1>
                <p class="sale-subtitle">Point of Sale & Billing Counter - Update Invoice Records</p>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
            <span class="sale-sticky-badge" style="background: #eef2ff; color: #4338ca; border: 1px solid #c7d2fe;">
                <i class="fa fa-hashtag"></i> Invoice: <strong><?= htmlspecialchars($data[0]['sale_invoice'] ?? '') ?></strong>
            </span>
            <button type="button" onclick="addmore()" class="btn-sale-add">
                <i class="fa fa-plus-circle"></i> Add Item
            </button>
            <a href="<?= console_url() ?>sale" class="btn-sale-secondary">
                <i class="fa fa-arrow-left"></i> Invoices List
            </a>
        </div>
    </div>

    <!-- Floating Medicine Info Modal -->
    <div id="med_information" style="display:none; position:fixed; top:75px; right:25px; z-index:99999; max-width:620px; width:92%; background:#ffffff; border-radius:10px; box-shadow:0 20px 45px rgba(15,23,42,0.18); border:1px solid #e2e8f0; overflow:hidden;">
        <div style="background:#f8fafc; border-bottom:1px solid #e2e8f0; padding:10px 16px; display:flex; align-items:center; justify-content:space-between;">
            <span style="font-weight:700; font-size:13px; color:#1e293b; display:inline-flex; align-items:center; gap:8px;">
                <i class="fa fa-info-circle" style="color:#6366f1;"></i> Medicine Details & Stock
            </span>
            <button type="button" onclick="hide_info()" style="background:none; border:none; font-size:16px; color:#94a3b8; cursor:pointer; padding:0 4px; line-height:1;">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div id="med_info_content" style="max-height:360px; overflow-y:auto; padding:12px;"></div>
    </div>

    <form method="post" action="" id="saleEditForm" onmouseover="hide_info()" enctype="multipart/form-data">
        <input type="hidden" name="invoice_number" value="<?= htmlspecialchars($data[0]['sale_invoice'] ?? '') ?>">

        <!-- Top Information Card: Customer & Doctor Details -->
        <div class="sale-card">
            <div class="sale-card-header">
                <h3 class="sale-card-title">
                    <i class="fa fa-user-circle"></i> Customer & Doctor Information
                </h3>
                <span style="font-size: 11px; color: var(--sale-text-muted);">Type mobile or name for auto-fill</span>
            </div>
            <div class="sale-card-body">
                <div class="sale-form-grid">
                    <div class="sale-form-group">
                        <label class="sale-form-label">Contact Mobile <span class="req">*</span></label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-phone sale-input-icon"></i>
                            <input required="required" type="text" autocomplete="off" name="customer_contact" value="<?= htmlspecialchars($data[0]['customer_contact'] ?? '') ?>" class="sale-control" placeholder="10-digit mobile" style="padding-left: 36px !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Customer Name <span class="req">*</span></label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-user sale-input-icon"></i>
                            <input required="required" type="text" autocomplete="off" name="customer_name" value="<?= htmlspecialchars($data[0]['customer_name'] ?? '') ?>" class="sale-control" placeholder="Full name..." style="font-weight:600; padding-left: 36px !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Customer Email</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-envelope-o sale-input-icon"></i>
                            <input type="text" autocomplete="off" name="email" value="<?= htmlspecialchars($data[0]['email'] ?? '') ?>" class="sale-control" placeholder="email@domain.com" style="padding-left: 36px !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Doctor Name <span class="req">*</span></label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-user-md sale-input-icon"></i>
                            <input required="required" type="text" autocomplete="off" value="<?= htmlspecialchars($data[0]['doctor_name'] ?? 'SELF') ?>" name="doctor_name" class="sale-control" placeholder="Prescribing doctor" style="padding-left: 36px !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group col-span-2">
                        <label class="sale-form-label">Address</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-map-marker sale-input-icon"></i>
                            <input type="text" autocomplete="off" name="customer_address" value="<?= htmlspecialchars($data[0]['customer_address'] ?? '') ?>" class="sale-control" placeholder="Customer address..." style="padding-left: 36px !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Customer GSTIN</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-shield sale-input-icon"></i>
                            <input type="text" value="<?= htmlspecialchars($data[0]['customer_gst'] ?? 'N/A') ?>" autocomplete="off" name="customer_gst" class="sale-control" style="padding-left: 36px !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Invoice Number</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-hashtag sale-input-icon"></i>
                            <input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= htmlspecialchars($data[0]['sale_invoice'] ?? '') ?>" name="sale_invoice" class="sale-control" style="padding-left: 36px !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Billing Date & Time</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-calendar sale-input-icon"></i>
                            <input type="text" required="required" autocomplete="off" value="<?= date('d-M-Y H:i:s', strtotime($data[0]['sale_date'])) ?>" name="sale_date" class="sale-control" style="padding-left: 36px !important;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billed Items Table Card -->
        <div class="sale-card">
            <div class="sale-card-header">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <h3 class="sale-card-title">
                        <i class="fa fa-list-alt"></i> Billed Items List
                    </h3>
                    <span class="sale-sticky-badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;">
                        <span class="totalItem"><?= count($data) ?></span> item(s) listed
                    </span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 11.5px; font-weight: 600; color: #475569;">
                        <span>Disc Mode:</span>
                        <?php
                        $item_details = array();
                        foreach ($data as $a => $valx) {
                            $item_details[] = $valx['sale_discount_percent'];
                        }
                        $result = count(array_unique($item_details));
                        ?>
                        <select id="discount" name="discount" style="height: 25px; padding: 1px 6px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 11.5px; background: #ffffff;">
                            <option value="1" <?= $result > 1 ? ' selected="selected"' : ''; ?>>Individual Item</option>
                            <option value="2" <?= $result == 1 ? ' selected="selected"' : ''; ?>>Grand Sync</option>
                        </select>
                    </div>
                    <button type="button" onclick="addmore()" class="btn-sale-add">
                        <i class="fa fa-plus-circle"></i> Add Row
                    </button>
                </div>
            </div>

            <div class="sale-card-body" style="padding: 10px;">
                <div class="sale-table-container">
                    <table class="sale-items-table" id="tableData">
                        <thead>
                            <tr>
                                <th style="width: 38px; min-width: 38px;">#</th>
                                <th style="min-width: 210px; text-align: left !important;">Product Name (In-Stock)</th>
                                <th style="width: 55px; min-width: 55px;">HSN</th>
                                <th style="width: 55px; min-width: 55px;">Cat</th>
                                <th style="width: 50px; min-width: 50px;">Sch</th>
                                <th style="width: 50px; min-width: 50px;">Strip</th>
                                <th style="width: 50px; min-width: 50px;">Loose</th>
                                <th style="width: 45px; min-width: 45px;">Unit</th>
                                <th style="width: 130px; min-width: 130px;">Batch / Stock</th>
                                <th style="width: 66px; min-width: 66px;">Exp (MM/YY)</th>
                                <th style="width: 60px; min-width: 60px;">MRP (₹)</th>
                                <th style="width: 52px; min-width: 52px;">Disc %</th>
                                <th style="width: 68px; min-width: 68px;">Taxable</th>
                                <th style="width: 46px; min-width: 46px;">CGST %</th>
                                <th style="width: 58px; min-width: 58px;">CGST</th>
                                <th style="width: 46px; min-width: 46px;">SGST %</th>
                                <th style="width: 58px; min-width: 58px;">SGST</th>
                                <th style="width: 78px; min-width: 78px;">Total (₹)</th>
                            </tr>
                        </thead>
                        <tbody class="appendHere">
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $k => $val): ?>
                                    <tr class="rowline">
                                        <td>
                                            <div class="sale-row-actions">
                                                <span class="sale-row-idx"><?= $k + 1 ?></span>
                                                <button type="button" class="btn-remove-row" onclick="removeRow(this);" title="Delete Row"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <input required="required" type="hidden" name="medicine_id[]" value="<?= htmlspecialchars($val['medicine_id']) ?>">
                                            <input required="required" type="text" name="medicine_name[]" value="<?= htmlspecialchars($val['medicine_name']) ?>" class="sale-cell-input med-name-input" placeholder="Search medicine..." onfocus="get_info(this)" autocomplete="off">
                                        </td>
                                        <td><input required="required" readonly="readonly" type="text" name="medicine_hsn[]" value="<?= htmlspecialchars($val['medicine_hsn'] ?? '') ?>" class="sale-cell-input text-center"></td>
                                        <td><input readonly="readonly" type="text" name="medicine_category[]" value="<?= htmlspecialchars($val['medicine_category'] ?? '') ?>" class="sale-cell-input text-center"></td>
                                        <td><input readonly="readonly" type="text" name="medicine_schedule[]" value="<?= htmlspecialchars($val['medicine_schedule'] ?? '') ?>" class="sale-cell-input text-center"></td>
                                        <td><input required="required" type="text" name="sale_strip_quantity[]" value="<?= htmlspecialchars($val['sale_strip_quantity']) ?>" oninput="calculate_the_sale(this)" class="sale-cell-input text-right" style="font-weight:700;"></td>
                                        <td><input required="required" type="number" name="sale_loose_quantity[]" min="0" oninput="calculate_the_sale(this)" value="<?= htmlspecialchars($val['sale_loose_quantity']) ?>" class="sale-cell-input text-right"></td>
                                        <td><input required="required" type="text" name="medicine_unit[]" onkeyup="calculate_the_sale(this)" value="<?= htmlspecialchars($val['medicine_unit'] ?? '10') ?>" class="sale-cell-input text-center"></td>
                                        <td>
                                            <div style="display:flex; flex-direction:column; gap:2px;">
                                                <select class="batchchooser" onchange="chooseBatch(this)">
                                                    <option value="<?= htmlspecialchars($val['sale_batch']) ?>" selected="selected"><?= htmlspecialchars($val['sale_batch']) ?></option>
                                                    <option value="addnew">Add New (+)</option>
                                                </select>
                                                <input type="hidden" name="sale_batch[]" value="<?= htmlspecialchars($val['sale_batch']) ?>" autocomplete="off">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="sale-exp-wrap">
                                                <input required="required" type="text" name="sale_expire_month[]" maxlength="2" placeholder="MM" value="<?= htmlspecialchars($val['sale_expire_month']) ?>" class="exp-m" oninput="handleExpMonth(this)">
                                                <span class="sale-exp-sep">/</span>
                                                <input required="required" type="text" name="sale_expire_year[]" maxlength="2" placeholder="YY" value="<?= htmlspecialchars($val['sale_expire_year']) ?>" class="exp-y" oninput="handleExpYear(this)">
                                            </div>
                                        </td>
                                        <td>
                                            <input required="required" type="text" name="sale_mrp[]" onkeyup="calculate_the_sale(this)" oninput="calculate_the_sale(this)" value="<?= htmlspecialchars($val['sale_mrp']) ?>" class="sale-cell-input text-right" style="font-weight:700;">
                                            <input type="hidden" name="sale_new_mrp[]" value="<?= htmlspecialchars(!empty($val['sale_new_mrp']) ? $val['sale_new_mrp'] : $val['sale_mrp']) ?>">
                                            <input type="hidden" name="sale_rate[]" value="<?= htmlspecialchars($val['sale_rate']) ?>">
                                        </td>
                                        <td><input required="required" class="sale_grand_dis sale-cell-input text-right" type="text" name="sale_discount_percent[]" oninput="calculate_the_sale(this); calculate_grand_dis();" value="<?= htmlspecialchars($val['sale_discount_percent']) ?>"></td>
                                        <td><input required="required" type="text" readonly="readonly" name="sale_taxable[]" value="<?= htmlspecialchars($val['sale_taxable']) ?>" class="sale-cell-input text-right"></td>
                                        <td><input required="required" type="text" name="sale_cgst_percent[]" value="<?= htmlspecialchars($val['sale_cgst_percent']) ?>" oninput="calculate_the_sale(this)" class="sale-cell-input text-right"></td>
                                        <td><input required="required" type="text" readonly="readonly" name="sale_cgst[]" value="<?= htmlspecialchars($val['sale_cgst']) ?>" class="sale-cell-input text-right"></td>
                                        <td><input required="required" type="text" name="sale_sgst_percent[]" value="<?= htmlspecialchars($val['sale_sgst_percent']) ?>" oninput="calculate_the_sale(this)" class="sale-cell-input text-right"></td>
                                        <td><input required="required" type="text" readonly="readonly" name="sale_sgst[]" value="<?= htmlspecialchars($val['sale_sgst']) ?>" class="sale-cell-input text-right"></td>
                                        <td><input required="required" type="text" readonly="readonly" name="sale_total[]" value="<?= htmlspecialchars($val['sale_total']) ?>" class="sale-cell-input text-right highlight-total"></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between;">
                    <button type="button" onclick="addmore()" class="btn-sale-add">
                        <i class="fa fa-plus-circle"></i> Add Another Medicine Row
                    </button>
                    <span style="font-size: 11px; color: var(--sale-text-muted);">
                        <i class="fa fa-keyboard-o text-primary"></i> Press <kbd style="background:#e2e8f0; color:#334155; padding:1px 5px; border-radius:3px;">Tab</kbd> on Disc % or Total to append row.
                    </span>
                </div>
            </div>
        </div>

        <!-- Live Financial Summary KPI Grid -->
        <div class="sale-kpi-grid">
            <div class="sale-kpi-card">
                <div class="sale-kpi-info">
                    <span class="sale-kpi-label">Total Items</span>
                    <span class="sale-kpi-value totalItem">0</span>
                </div>
            </div>

            <div class="sale-kpi-card">
                <div class="sale-kpi-info">
                    <span class="sale-kpi-label">MRP Total</span>
                    <span class="sale-kpi-value">₹<span class="mrptotal">0.00</span></span>
                </div>
            </div>

            <div class="sale-kpi-card">
                <div class="sale-kpi-info">
                    <span class="sale-kpi-label">Discount Total</span>
                    <span class="sale-kpi-value" style="color: var(--sale-danger);">₹<span class="discounttotal">0.00</span></span>
                </div>
            </div>

            <div class="sale-kpi-card">
                <div class="sale-kpi-info">
                    <span class="sale-kpi-label">CGST Total</span>
                    <span class="sale-kpi-value">₹<span class="totalCgst">0.00</span></span>
                </div>
            </div>

            <div class="sale-kpi-card">
                <div class="sale-kpi-info">
                    <span class="sale-kpi-label">SGST Total</span>
                    <span class="sale-kpi-value">₹<span class="totalSgst">0.00</span></span>
                </div>
            </div>

            <div class="sale-kpi-card">
                <div class="sale-kpi-info">
                    <span class="sale-kpi-label">Total GST</span>
                    <span class="sale-kpi-value" style="color: var(--sale-primary);">₹<span class="totalgst">0.00</span></span>
                </div>
            </div>

            <div class="sale-kpi-card sale-kpi-grand">
                <div class="sale-kpi-info">
                    <span class="sale-kpi-label">Grand Total</span>
                    <span class="sale-kpi-value">₹<span class="totalAmount">0.00</span></span>
                </div>
            </div>
        </div>

        <!-- Settlement & Payment Details Card -->
        <div class="sale-card" style="margin-top: 16px;">
            <div class="sale-card-header">
                <h3 class="sale-card-title">
                    <i class="fa fa-calculator"></i> Payment Settlement & Balance
                </h3>
            </div>
            <div class="sale-card-body">
                <div class="sale-form-grid">
                    <div class="sale-form-group">
                        <label class="sale-form-label">Previous Due (₹)</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-history sale-input-icon"></i>
                            <input type="text" name="sale_total_previous_due" value="<?= htmlspecialchars($data[0]['sale_total_previous_due'] ?? '0.00') ?>" oninput="calculateTotal()" class="sale-control text-right" style="font-weight: 600; padding-left: 36px !important; text-align: right !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Total Payable (₹)</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-money sale-input-icon"></i>
                            <input type="text" readonly="readonly" class="sale-control text-right customer_payable_input" value="0.00" style="font-weight: 800; color: #4338ca; background: #eef2ff; padding-left: 36px !important; text-align: right !important;" />
                            <span class="customer_payable" style="display:none;">0.00</span>
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Amount Paid (₹) <span class="req">*</span></label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-check-circle sale-input-icon"></i>
                            <input onkeyup="currentdue()" oninput="currentdue()" class="sale_total_paid sale-control text-right" type="text" autocomplete="off" name="sale_total_paid" value="<?= htmlspecialchars($data[0]['sale_total_paid'] ?? '0.00') ?>" style="font-weight: 800; color: #059669; padding-left: 36px !important; text-align: right !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Current Due / Balance (₹)</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-exclamation-circle sale-input-icon"></i>
                            <input type="text" name="sale_total_current_due" readonly="readonly" class="sale-control text-right" value="<?= htmlspecialchars($data[0]['sale_total_current_due'] ?? '0.00') ?>" style="font-weight: 800; color: #dc2626; background: #fff1f2; padding-left: 36px !important; text-align: right !important;" />
                        </div>
                    </div>

                    <div class="sale-form-group">
                        <label class="sale-form-label">Payment Mode</label>
                        <?php $paid_by = $data[0]['sale_paid_by'] ?? 'Cash'; ?>
                        <select name="sale_paid_by" class="sale-control" style="font-weight: 600;">
                            <option value="Cash" <?= $paid_by == 'Cash' ? 'selected' : '' ?>>Cash</option>
                            <option value="Paytm" <?= $paid_by == 'Paytm' ? 'selected' : '' ?>>Paytm</option>
                            <option value="UPI / QR" <?= $paid_by == 'UPI / QR' ? 'selected' : '' ?>>UPI / QR</option>
                            <option value="Cheque" <?= $paid_by == 'Cheque' ? 'selected' : '' ?>>Cheque</option>
                            <option value="Mobikwik" <?= $paid_by == 'Mobikwik' ? 'selected' : '' ?>>Mobikwik</option>
                            <option value="Bank Deposit" <?= $paid_by == 'Bank Deposit' ? 'selected' : '' ?>>Bank Deposit</option>
                            <option value="Other" <?= $paid_by == 'Other' ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>

                    <div class="sale-form-group col-span-2">
                        <label class="sale-form-label">Payment Note / Remarks</label>
                        <div class="sale-input-wrap">
                            <i class="fa fa-comment-o sale-input-icon"></i>
                            <input type="text" name="sale_note" value="<?= htmlspecialchars($data[0]['sale_note'] ?? '') ?>" class="sale-control" placeholder="Optional payment note..." style="padding-left: 36px !important;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Floating Action Bar at Bottom -->
        <div class="sale-sticky-bar">
            <div class="sale-sticky-left">
                <span class="sale-sticky-badge">
                    <i class="fa fa-cubes text-primary"></i> Items: <strong class="totalItem"><?= count($data) ?></strong>
                </span>
                <span class="sale-sticky-badge">
                    <i class="fa fa-percent text-warning"></i> GST: ₹<strong class="totalgst">0.00</strong>
                </span>
                <span class="sale-sticky-badge" style="background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0;">
                    <i class="fa fa-money text-success"></i> Bill Total: ₹<strong class="totalAmount">0.00</strong>
                </span>
                <label style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; font-size: 12px; cursor: pointer; margin: 0; color: #334155;">
                    <input type="checkbox" name="print" checked='checked' style="width: 15px; height: 15px; accent-color: #4f46e5;" /> 
                    <span>Print Invoice</span>
                </label>
            </div>

            <div class="sale-sticky-actions">
                <button type="button" onclick="addmore()" class="btn-sale-secondary">
                    <i class="fa fa-plus"></i> Add Row
                </button>
                <button type="button" onclick="goBack()" class="btn-sale-secondary">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="submit" id="submit-btn" class="btn-sale-primary" onclick="return validateBeforeSubmit();">
                    <i class="fa fa-save"></i> Update Invoice
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    var rowcount = <?= count($data) ?>;
    var baseAppUrl = '<?= base_url() ?>';
    var searchUrl = baseAppUrl + 'search.php';

    function goBack() {
        if (confirm("Are you sure you want to discard your changes?")) {
            window.location.href = '<?= console_url() ?>sale';
        }
    }

    function reindexRows() {
        var idx = 1;
        $('.rowline').each(function () {
            $(this).find('.sale-row-idx').text(idx);
            idx++;
        });
        calculateTotal();
        disp_calc();
    }

    function removeRow(targetObj) {
        if ($('.rowline').length <= 1) {
            if (typeof toastr !== 'undefined') {
                toastr.warning('At least one item row is required in the invoice.');
            } else {
                alert('At least one item row is required.');
            }
            return;
        }
        $(targetObj).closest('.rowline').remove();
        reindexRows();
    }

    function chooseBatch(targetObj) {
        var theRow = $(targetObj).closest('tr');
        var batchVal = $(targetObj).val();

        if (batchVal !== "addnew" && batchVal !== "-") {
            theRow.find("[name^='sale_batch[]']").val(batchVal);

            var medId = theRow.find('[name^="medicine_id[]"]').val();
            if (medId) {
                $.post('<?= console_url("medicine_stock/stock_by_batch") ?>/?medicine_id=' + medId + '&term=' + encodeURIComponent(batchVal), function(resp) {
                    if (resp && resp[0] && resp[0].complete) {
                        var c = resp[0].complete;
                        theRow.find('[name^="sale_strip_quantity[]"]').attr("max", c.left_strip || 9999);
                        
                        if (c.sale_mrp) theRow.find('[name^="sale_mrp[]"]').val(c.sale_mrp);
                        if (c.sale_new_mrp) theRow.find('[name^="sale_new_mrp[]"]').val(c.sale_new_mrp);
                        if (c.sale_expire_month) theRow.find('[name^="sale_expire_month[]"]').val(c.sale_expire_month);
                        if (c.sale_expire_year) theRow.find('[name^="sale_expire_year[]"]').val(c.sale_expire_year);
                        if (c.medicine_unit) theRow.find('[name^="medicine_unit[]"]').val(c.medicine_unit);
                        
                        calculate_the_sale(theRow.find('[name^="sale_strip_quantity[]"]'));
                        theRow.find('[name^="sale_strip_quantity[]"]').focus().select();
                    }
                }, 'json');
            }
        } else if (batchVal === "addnew") {
            var manualBatch = prompt("Enter Batch Number:", theRow.find("[name^='sale_batch[]']").val() || "");
            if (manualBatch && manualBatch.trim() !== "") {
                manualBatch = manualBatch.trim().toUpperCase();
                theRow.find("[name^='sale_batch[]']").val(manualBatch);
                var $opt = $('<option></option>').val(manualBatch).text(manualBatch + ' (New)');
                $(targetObj).append($opt);
                $(targetObj).val(manualBatch);
                theRow.find('[name^="sale_strip_quantity[]"]').focus().select();
            } else {
                $(targetObj).val(theRow.find("[name^='sale_batch[]']").val() || "-");
            }
        }
    }

    function addmore() {
        rowcount++;
        var therow = '<tr class="rowline">' +
            '<td><div class="sale-row-actions">' +
                '<span class="sale-row-idx">' + rowcount + '</span>' +
                '<button type="button" class="btn-remove-row" onclick="removeRow(this);" title="Delete Row"><i class="fa fa-trash"></i></button>' +
            '</div></td>' +
            '<td>' +
                '<input required="required" type="hidden" name="medicine_id[]">' +
                '<input required="required" type="text" name="medicine_name[]" class="sale-cell-input med-name-input" placeholder="Search medicine..." onfocus="get_info(this)" autocomplete="off">' +
            '</td>' +
            '<td><input required="required" readonly="readonly" type="text" name="medicine_hsn[]" class="sale-cell-input text-center"></td>' +
            '<td><input readonly="readonly" type="text" name="medicine_category[]" class="sale-cell-input text-center"></td>' +
            '<td><input readonly="readonly" type="text" name="medicine_schedule[]" class="sale-cell-input text-center"></td>' +
            '<td><input required="required" type="text" name="sale_strip_quantity[]" value="1" oninput="calculate_the_sale(this)" class="sale-cell-input text-right" style="font-weight:700;"></td>' +
            '<td><input required="required" type="number" name="sale_loose_quantity[]" min="0" oninput="calculate_the_sale(this)" value="0" class="sale-cell-input text-right"></td>' +
            '<td><input required="required" type="text" name="medicine_unit[]" onkeyup="calculate_the_sale(this)" value="10" class="sale-cell-input text-center"></td>' +
            '<td>' +
                '<div style="display:flex; flex-direction:column; gap:2px;">' +
                    '<select class="batchchooser" onchange="chooseBatch(this)"><option value="-">--BATCH--</option></select>' +
                    '<input type="hidden" name="sale_batch[]" autocomplete="off">' +
                '</div>' +
            '</td>' +
            '<td>' +
                '<div class="sale-exp-wrap">' +
                    '<input required="required" type="text" name="sale_expire_month[]" maxlength="2" placeholder="MM" class="exp-m" oninput="handleExpMonth(this)">' +
                    '<span class="sale-exp-sep">/</span>' +
                    '<input required="required" type="text" name="sale_expire_year[]" maxlength="2" placeholder="YY" class="exp-y" oninput="handleExpYear(this)">' +
                '</div>' +
            '</td>' +
            '<td>' +
                '<input required="required" type="text" name="sale_mrp[]" onkeyup="calculate_the_sale(this)" oninput="calculate_the_sale(this)" value="0.00" class="sale-cell-input text-right" style="font-weight:700;">' +
                '<input type="hidden" name="sale_new_mrp[]" value="0.00">' +
                '<input type="hidden" name="sale_rate[]" value="0.00">' +
            '</td>' +
            '<td><input required="required" class="sale_grand_dis sale-cell-input text-right" type="text" name="sale_discount_percent[]" oninput="calculate_the_sale(this); calculate_grand_dis();" value="0"></td>' +
            '<td><input required="required" type="text" readonly="readonly" name="sale_taxable[]" value="0.00" class="sale-cell-input text-right"></td>' +
            '<td><input required="required" type="text" name="sale_cgst_percent[]" value="2.5" oninput="calculate_the_sale(this)" class="sale-cell-input text-right"></td>' +
            '<td><input required="required" type="text" readonly="readonly" name="sale_cgst[]" value="0.00" class="sale-cell-input text-right"></td>' +
            '<td><input required="required" type="text" name="sale_sgst_percent[]" value="2.5" oninput="calculate_the_sale(this)" class="sale-cell-input text-right"></td>' +
            '<td><input required="required" type="text" readonly="readonly" name="sale_sgst[]" value="0.00" class="sale-cell-input text-right"></td>' +
            '<td><input required="required" type="text" readonly="readonly" name="sale_total[]" value="0.00" class="sale-cell-input text-right highlight-total"></td>' +
        '</tr>';

        $('.appendHere').append(therow);
        var $newRow = $('.rowline:last');

        // Tab on total adds new row
        $newRow.find('input[name="sale_total[]"], input[name="sale_discount_percent[]"]').on('keydown', function(e) {
            if (e.which === 9 && !e.shiftKey) { // Tab key
                e.preventDefault();
                addmore();
            }
        });

        reindexRows();
        bindMedicineSaleAutocomplete($newRow.find('.med-name-input'));
        $newRow.find('.med-name-input').focus();
    }

    // Dynamic Medicine Autocomplete for Sales with Batch Loading
    function bindMedicineSaleAutocomplete($el) {
        if ($el.data('autocomplete-bound')) return;
        $el.data('autocomplete-bound', true);

        var ac = $el.autocomplete({
            source: searchUrl + '?location=sale&table=medicines&fieldToSearch=medicine_name',
            minLength: 1,
            select: function (event, ui) {
                var targetRow = $(this).closest('tr');
                if (ui.item && ui.item.complete) {
                    var c = ui.item.complete;
                    targetRow.find('[name^="medicine_id[]"]').val(c.medicine_id || '');
                    targetRow.find('[name^="medicine_name[]"]').val(ui.item.value || c.medicine_name);
                    targetRow.find('[name^="medicine_hsn[]"]').val(c.medicine_hsn || '');
                    targetRow.find('[name^="medicine_category[]"]').val(c.medicine_category || '');
                    targetRow.find('[name^="medicine_schedule[]"]').val(c.medicine_schedule || '');
                    targetRow.find('[name^="medicine_unit[]"]').val(c.medicine_unit || '10');

                    // Fetch Available Stock Batches
                    $.get('<?= console_url("medicine_stock/stock_by_batch") ?>/?medicine_id=' + c.medicine_id, function(resp) {
                        var $chooser = targetRow.find('.batchchooser');
                        $chooser.empty();

                        if (resp && resp.length > 0) {
                            $chooser.append('<option value="-">--CHOOSE BATCH--</option>');
                            $.each(resp, function(k, v) {
                                $chooser.append('<option value="' + v.value + '">' + v.label + '</option>');
                            });
                            $chooser.append('<option value="addnew">Add New (+)</option>');

                            // Auto-select first batch if available
                            if (resp[0] && resp[0].value) {
                                $chooser.val(resp[0].value);
                                chooseBatch($chooser);
                            }
                        } else {
                            if (typeof toastr !== 'undefined') {
                                toastr.warning('This medicine has zero stock in inventory.');
                            } else {
                                alert("This medicine stock is zero. Please purchase before billing.");
                            }
                            $chooser.append('<option value="addnew">Manual Entry (+)</option>');
                        }
                    }, 'json');

                    calculate_the_sale(targetRow.find('[name^="sale_strip_quantity[]"]'));
                }
                return false;
            }
        });

        var widget = ac.data("ui-autocomplete") || ac.data("autocomplete");
        if (widget) {
            widget._renderItem = function(ul, item) {
                var c = item.complete || {};
                var subParts = [];
                if (c.medicine_manufacturer) subParts.push(c.medicine_manufacturer);
                if (c.medicine_storage) subParts.push('Rack: ' + c.medicine_storage);
                if (c.medicine_unit) subParts.push('Pack: ' + c.medicine_unit);
                var subHtml = subParts.length > 0 ? '<div style="font-size: 11px; color: #64748b; margin-top: 2px;">' + subParts.join(' &bull; ') + '</div>' : '';
                return $("<li>")
                    .append('<div style="padding: 6px 12px; cursor: pointer; border-bottom: 1px solid #f1f5f9;"><div style="font-weight: 700; color: #0f172a; font-size: 12px;">' + item.label + '</div>' + subHtml + '</div>')
                    .appendTo(ul);
            };
        }
    }

    $(document).on('focus', '.med-name-input', function () {
        bindMedicineSaleAutocomplete($(this));
    });

    function handleExpMonth(elem) {
        var val = $(elem).val().replace(/[^0-9]/g, '');
        $(elem).val(val);
        if (parseInt(val, 10) > 12) {
            $(elem).val('12');
            val = '12';
        }
        if (val.length === 2) {
            $(elem).closest('.sale-exp-wrap').find('.exp-y').focus().select();
        }
    }

    function handleExpYear(elem) {
        var val = $(elem).val().replace(/[^0-9]/g, '');
        $(elem).val(val);
    }

    function calculate_grand_dis() {
        var select_dis_val = $('#discount').val();
        if (select_dis_val == 2) {
            var first_enter_value = $(".sale_grand_dis:first").val();
            $('.sale_grand_dis').val(first_enter_value);
            $('.rowline').each(function() {
                calculate_the_sale($(this).find('[name^="sale_strip_quantity[]"]'));
            });
        }
    }

    function mrp2rate(mrp, cgst) {
        if (!cgst || cgst <= 0) return mrp;
        return mrp * 50 / (50 + cgst);
    }

    function calculate_the_sale(targetObject) {
        var $row = $(targetObject).closest('tr');
        var mrp = parseFloat($row.find('[name="sale_mrp[]"]').val()) || parseFloat($row.find('[name="sale_new_mrp[]"]').val()) || 0;
        var cgst_percent = parseFloat($row.find('[name="sale_cgst_percent[]"]').val()) || 0;
        var sgst_percent = cgst_percent;
        $row.find('[name="sale_sgst_percent[]"]').val(sgst_percent);

        var rate = mrp2rate(mrp, cgst_percent);
        $row.find('[name="sale_rate[]"]').val(rate.toFixed(3));

        var unit = parseFloat($row.find('[name="medicine_unit[]"]').val()) || 1;
        var strip_qty = parseFloat($row.find('[name="sale_strip_quantity[]"]').val()) || 0;
        var loose_qty = parseFloat($row.find('[name="sale_loose_quantity[]"]').val()) || 0;
        var discount_percent = parseFloat($row.find('[name="sale_discount_percent[]"]').val()) || 0;
        var qty = (strip_qty * unit) + loose_qty;

        var total = (rate * qty / unit);
        var total_discount = total * discount_percent / 100;
        var taxable = total - total_discount;
        var cgst_amt = taxable * cgst_percent / 100;
        var sgst_amt = taxable * sgst_percent / 100;
        var grand_total = taxable + cgst_amt + sgst_amt;

        $row.find('[name="sale_taxable[]"]').val(taxable.toFixed(2));
        $row.find('[name="sale_cgst[]"]').val(cgst_amt.toFixed(2));
        $row.find('[name="sale_sgst[]"]').val(sgst_amt.toFixed(2));
        $row.find('[name="sale_total[]"]').val(grand_total.toFixed(2));

        calculateTotal();
        disp_calc();
    }

    function calculateTotal() {
        var totalItem = $('.rowline').length;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;

        $('.rowline').each(function () {
            totalCgst += parseFloat($(this).find('[name^="sale_cgst[]"]').val()) || 0;
            totalSgst += parseFloat($(this).find('[name^="sale_sgst[]"]').val()) || 0;
            totalTotal += parseFloat($(this).find('[name^="sale_total[]"]').val()) || 0;
        });

        $('.totalItem').html(totalItem);
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));

        var prevDue = parseFloat($('[name="sale_total_previous_due"]').val()) || 0;
        var netPayable = (totalTotal + prevDue).toFixed(2);
        $('.customer_payable').html(netPayable);
        $('.customer_payable_input').val(netPayable);

        currentdue();
    }

    function disp_calc() {
        var total_mrp = 0;
        var total = 0;
        $('.rowline').each(function () {
            var unit = parseFloat($(this).find('[name="medicine_unit[]"]').val()) || 1;
            var strip = parseFloat($(this).find('[name="sale_strip_quantity[]"]').val()) || 0;
            var loose = parseFloat($(this).find('[name="sale_loose_quantity[]"]').val()) || 0;
            var mrp = parseFloat($(this).find('[name="sale_mrp[]"]').val()) || parseFloat($(this).find('[name="sale_new_mrp[]"]').val()) || 0;
            var qty = (strip * unit) + loose;
            total_mrp += (mrp * qty / unit);
            total += parseFloat($(this).find('[name^="sale_total[]"]').val()) || 0;
        });
        var finalDisc = Math.max(0, total_mrp - total);
        $('.discounttotal').html(finalDisc.toFixed(2));
        $('.mrptotal').html(total_mrp.toFixed(2));
    }

    function currentdue() {
        var payable = parseFloat($('.customer_payable').html()) || 0;
        var paid = parseFloat($('[name="sale_total_paid"]').val()) || 0;
        var curDue = Math.max(0, payable - paid);
        $('[name="sale_total_current_due"]').val(curDue.toFixed(2));
    }

    function get_info(targetObj) {
        var medName = $(targetObj).val();
        if (!medName || medName.trim().length < 2) return;
        $.post('<?= console_url() ?>medicine_stock/get_info', {
            medicine: medName
        }, function(resp) {
            if (resp && resp.trim() !== '') {
                $('#med_info_content').html(resp);
                $('#med_information').fadeIn(200);
            }
        });
    }

    function hide_info() {
        $('#med_information').fadeOut(150);
    }

    function validateBeforeSubmit() {
        if ($('.rowline').length === 0) {
            if (typeof toastr !== 'undefined') {
                toastr.error('Please add at least one medicine item to update invoice.');
            } else {
                alert('Please add at least one medicine item.');
            }
            return false;
        }
        var totalPaid = parseFloat($('[name="sale_total_paid"]').val()) || 0;
        var grandTot = parseFloat($('.totalAmount').text()) || 0;
        if (totalPaid <= 0 && grandTot > 0) {
            $('[name="sale_total_paid"]').val(grandTot.toFixed(2));
            currentdue();
        }
        return true;
    }

    $(document).ready(function () {
        // Customer Autocomplete by Name
        var custAc = $('[name="customer_name"]').autocomplete({
            source: searchUrl + '?table=customers&fieldToSearch=customer_name',
            minLength: 1,
            select: function(event, ui) {
                if (ui.item && ui.item.complete) {
                    var c = ui.item.complete;
                    $('[name="customer_name"]').val(ui.item.value || c.customer_name);
                    if (c.customer_contact) $('[name="customer_contact"]').val(c.customer_contact);
                    if (c.customer_address) $('[name="customer_address"]').val(c.customer_address);
                    if (c.email) $('[name="email"]').val(c.email);
                    if (c.customer_gst) $('[name="customer_gst"]').val(c.customer_gst);
                    if (c.doctor_name) $('[name="doctor_name"]').val(c.doctor_name);
                    
                    // Fetch customer balance
                    if (c.customer_ID) {
                        $.post('<?= console_url("customer/customer_balance") ?>/' + c.customer_ID, function(balResp) {
                            if (balResp && balResp.balance) {
                                $('[name="sale_total_previous_due"]').val(parseFloat(balResp.balance).toFixed(2));
                                calculateTotal();
                            }
                        }, 'json');
                    }
                }
                return false;
            }
        });

        var custWidget = custAc.data("ui-autocomplete") || custAc.data("autocomplete");
        if (custWidget) {
            custWidget._renderItem = function(ul, item) {
                var c = item.complete || {};
                var sub = [];
                if (c.customer_contact) sub.push('Tel: ' + c.customer_contact);
                if (c.customer_address) sub.push(c.customer_address);
                var subHtml = sub.length > 0 ? '<div style="font-size: 11px; color: #64748b; margin-top: 2px;">' + sub.join(' &bull; ') + '</div>' : '';
                return $("<li>")
                    .append('<div style="padding: 6px 12px; cursor: pointer; border-bottom: 1px solid #f1f5f9;"><div style="font-weight: 700; color: #0f172a; font-size: 12px;">' + item.label + '</div>' + subHtml + '</div>')
                    .appendTo(ul);
            };
        }

        // Customer Contact Autocomplete
        $('[name="customer_contact"]').autocomplete({
            source: searchUrl + '?table=customers&fieldToSearch=customer_contact',
            minLength: 2,
            select: function(event, ui) {
                if (ui.item && ui.item.complete) {
                    var c = ui.item.complete;
                    $('[name="customer_contact"]').val(ui.item.value || c.customer_contact);
                    if (c.customer_name) $('[name="customer_name"]').val(c.customer_name);
                    if (c.customer_address) $('[name="customer_address"]').val(c.customer_address);
                    if (c.email) $('[name="email"]').val(c.email);
                    if (c.customer_gst) $('[name="customer_gst"]').val(c.customer_gst);
                    if (c.doctor_name) $('[name="doctor_name"]').val(c.doctor_name);
                }
                return false;
            }
        });

        // Doctor Autocomplete
        $('[name="doctor_name"]').autocomplete({
            source: searchUrl + '?table=doctors&fieldToSearch=doctor_name',
            minLength: 1
        });

        // Bind Autocomplete on all existing medicine rows
        $('.rowline').each(function () {
            bindMedicineSaleAutocomplete($(this).find('.med-name-input'));
            $(this).find('input[name="sale_total[]"], input[name="sale_discount_percent[]"]').on('keydown', function(e) {
                if (e.which === 9 && !e.shiftKey) { // Tab key
                    e.preventDefault();
                    addmore();
                }
            });
        });

        // Calculate initial totals
        calculateTotal();
        disp_calc();
    });
</script>