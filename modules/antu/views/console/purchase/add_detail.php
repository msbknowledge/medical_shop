<style>
    /* ==========================================================================
       PURCHASE ADD DETAIL MODERN DESIGN SYSTEM - COMPACT ERP GRID
       ========================================================================== */
    :root {
        --pur-primary: #4f46e5;
        --pur-primary-hover: #4338ca;
        --pur-success: #10b981;
        --pur-success-hover: #059669;
        --pur-danger: #ef4444;
        --pur-warning: #f59e0b;
        --pur-bg: #f8fafc;
        --pur-card: #ffffff;
        --pur-border: #e2e8f0;
        --pur-border-focus: #4f46e5;
        --pur-text: #1e293b;
        --pur-text-muted: #64748b;
        --pur-font: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .purchase-wrapper {
        font-family: var(--pur-font);
        color: var(--pur-text);
        padding-bottom: 90px;
    }

    /* Page Header */
    .purchase-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 16px;
        padding: 4px 0;
    }
    .purchase-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .purchase-title-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }
    .purchase-title {
        font-size: 19px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }
    .purchase-subtitle {
        font-size: 12px;
        color: var(--pur-text-muted);
        margin: 2px 0 0 0;
    }

    /* Cards */
    .pur-card {
        background: var(--pur-card);
        border: 1px solid var(--pur-border);
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        margin-bottom: 16px;
        overflow: hidden;
    }
    .pur-card-header {
        background: #ffffff;
        padding: 10px 16px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .pur-card-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }
    .pur-card-title i {
        color: var(--pur-primary);
        font-size: 13px;
    }
    .pur-card-body {
        padding: 14px 16px;
    }

    /* Top Form Grid */
    .pur-form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px 16px;
    }
    .pur-form-group {
        display: flex;
        flex-direction: column;
    }
    .pur-form-group.col-span-2 {
        grid-column: span 2;
    }
    .pur-form-label {
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
    .pur-form-label .req {
        color: var(--pur-danger);
    }
    .pur-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .pur-input-icon {
        position: absolute !important;
        left: 11px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        color: #94a3b8 !important;
        font-size: 13px !important;
        pointer-events: none !important;
        z-index: 5 !important;
    }
    .pur-input-wrap input,
    .pur-input-wrap input[type="text"],
    .pur-input-wrap .pur-control {
        padding-left: 36px !important;
    }
    .pur-control {
        width: 100% !important;
        height: 32px !important;
        min-height: 32px !important;
        padding: 4px 10px 4px 10px !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        color: #1e293b !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 5px !important;
        outline: none !important;
        box-shadow: none !important;
        box-sizing: border-box !important;
        transition: border-color 0.15s ease !important;
    }
    .pur-control:focus {
        border-color: var(--pur-border-focus) !important;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.15) !important;
    }
    .pur-control[readonly] {
        background: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
    }

    /* Items Table Container */
    .pur-table-container {
        border: 1px solid var(--pur-border);
        border-radius: 6px;
        overflow-x: auto;
        background: #ffffff;
    }
    .pur-items-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11.5px;
        margin-bottom: 0;
    }
    .pur-items-table thead th {
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
    .pur-items-table tbody td {
        padding: 2px 2px !important;
        border: 1px solid #e2e8f0 !important;
        vertical-align: middle !important;
        background: #ffffff;
    }
    .pur-items-table tbody tr.rowline:hover td {
        background: #faf5ff !important;
    }
    .pur-items-table tbody tr.rowline:focus-within td {
        background: #f0fdf4 !important;
    }
    .pur-items-table tbody tr.expiry-warning td {
        background: #fff1f2 !important;
    }
    .pur-items-table tbody tr.expiry-warning td:first-child {
        border-left: 3px solid #ef4444 !important;
    }

    /* COMPACT Table Cell Inputs - ZERO EXTRA PADDING */
    .pur-items-table input.pur-cell-input,
    .pur-items-table input[type="text"],
    .pur-items-table input[type="number"] {
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
    .pur-items-table input.pur-cell-input:focus,
    .pur-items-table input[type="text"]:focus,
    .pur-items-table input[type="number"]:focus {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 1px #4f46e5 !important;
        background: #ffffff !important;
    }
    .pur-cell-input.text-right {
        text-align: right !important;
    }
    .pur-cell-input.text-center {
        text-align: center !important;
    }
    .pur-cell-input[readonly] {
        background: #f8fafc !important;
        color: #475569 !important;
        border-color: #e2e8f0 !important;
        font-weight: 600 !important;
    }
    .pur-cell-input.highlight-total {
        background: #ecfdf5 !important;
        color: #065f46 !important;
        border-color: #a7f3d0 !important;
        font-weight: 700 !important;
    }

    /* COMPACT Expiry Split Container */
    .pur-exp-wrap {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 2px !important;
        padding: 0 !important;
        height: 25px !important;
        min-height: 25px !important;
        max-height: 25px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        margin: 0 !important;
    }
    .pur-exp-wrap:focus-within {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 1px #4f46e5 !important;
    }
    .pur-exp-wrap input.pur-exp-input {
        width: 22px !important;
        min-width: 22px !important;
        max-width: 22px !important;
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
    .pur-exp-sep {
        color: #94a3b8 !important;
        font-weight: 700 !important;
        font-size: 11px !important;
        padding: 0 1px !important;
        line-height: 1 !important;
        user-select: none !important;
    }

    /* Row Actions */
    .pur-row-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 3px;
        padding: 0 2px;
    }
    .pur-row-idx {
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
    .pur-kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 12px;
        margin-top: 16px;
    }
    .pur-kpi-card {
        background: #ffffff;
        border: 1px solid var(--pur-border);
        border-radius: 8px;
        padding: 12px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .pur-kpi-info {
        display: flex;
        flex-direction: column;
    }
    .pur-kpi-label {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #64748b;
        margin-bottom: 2px;
    }
    .pur-kpi-value {
        font-size: 17px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.1;
    }
    .pur-kpi-icon {
        width: 34px;
        height: 34px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    .pur-kpi-grand {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        border: none;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
    .pur-kpi-grand .pur-kpi-label {
        color: rgba(255, 255, 255, 0.85);
    }
    .pur-kpi-grand .pur-kpi-value {
        color: #ffffff;
        font-size: 20px;
    }

    /* Sticky Bottom Action Bar */
    .pur-sticky-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-top: 1px solid #e2e8f0;
        padding: 10px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        box-shadow: 0 -3px 12px rgba(15, 23, 42, 0.04);
        z-index: 999;
    }
    .pur-sticky-left {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .pur-sticky-badge {
        background: #f1f5f9;
        color: #334155;
        font-size: 11.5px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .pur-sticky-badge strong {
        color: #0f172a;
    }
    .pur-sticky-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Buttons */
    .btn-pur-primary {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 12.5px !important;
        padding: 8px 20px !important;
        border-radius: 6px !important;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.25) !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        cursor: pointer !important;
        text-shadow: none !important;
    }
    .btn-pur-primary:hover {
        background: #059669 !important;
        color: #ffffff !important;
    }
    .btn-pur-secondary {
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        padding: 7px 16px !important;
        border-radius: 6px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
        cursor: pointer !important;
        text-shadow: none !important;
    }
    .btn-pur-secondary:hover {
        background: #f8fafc !important;
        color: #1e293b !important;
    }
    .btn-pur-add {
        background: rgba(99, 102, 241, 0.08) !important;
        border: 1px solid rgba(99, 102, 241, 0.25) !important;
        color: #4f46e5 !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        padding: 5px 12px !important;
        border-radius: 5px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
        cursor: pointer !important;
    }
    .btn-pur-add:hover {
        background: #4f46e5 !important;
        color: #ffffff !important;
    }

    /* Autocomplete Styling - Always on Top */
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
        font-family: var(--pur-font) !important;
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
    .ui-autocomplete .ui-menu-item .ui-menu-item-wrapper {
        display: block !important;
        padding: 6px 12px !important;
        color: #1e293b !important;
        text-decoration: none !important;
        cursor: pointer !important;
        line-height: 1.35 !important;
        font-size: 12px !important;
        transition: background 0.1s ease !important;
        border: none !important;
    }
    .ui-autocomplete .ui-menu-item a.ui-state-focus,
    .ui-autocomplete .ui-menu-item a.ui-state-hover,
    .ui-autocomplete .ui-menu-item .ui-menu-item-wrapper.ui-state-active,
    .ui-autocomplete .ui-menu-item:hover {
        background: #4f46e5 !important;
        color: #ffffff !important;
    }
</style>

<div class="purchase-wrapper">

    <?php if (isset($status)): ?>
        <div class="alert alert-<?= $status ?> alert-dismissible" style="border-radius: 6px; font-weight: 600; margin-bottom: 14px;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <i class="fa fa-info-circle"></i> <?= $message ?>
        </div>
    <?php endif; ?>

    <!-- Page Header -->
    <div class="purchase-header">
        <div class="purchase-title-wrap">
            <div class="purchase-title-icon">
                <i class="fa fa-truck"></i>
            </div>
            <div>
                <h1 class="purchase-title">New Purchase Entry</h1>
                <p class="purchase-subtitle">Record supplier invoice and add medicine inward stock</p>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
            <span class="pur-sticky-badge" style="background: #eef2ff; color: #4338ca; border: 1px solid #c7d2fe;">
                <i class="fa fa-hashtag"></i> Entry: <strong><?= generate_purchase_number() ?></strong>
            </span>
            <button type="button" onclick="addmore()" class="btn-pur-add">
                <i class="fa fa-plus-circle"></i> Add Item
            </button>
            <a href="<?= console_url() ?>purchase" class="btn-pur-secondary">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Floating Medicine Purchase History Modal -->
    <div id="history_modal" style="display:none; position:fixed; top:75px; right:25px; z-index:99999; max-width:620px; width:92%; background:#ffffff; border-radius:10px; box-shadow:0 20px 45px rgba(15,23,42,0.18); border:1px solid #e2e8f0; overflow:hidden;">
        <div style="background:#f8fafc; border-bottom:1px solid #e2e8f0; padding:10px 16px; display:flex; align-items:center; justify-content:space-between;">
            <span style="font-weight:700; font-size:13px; color:#1e293b; display:inline-flex; align-items:center; gap:8px;">
                <i class="fa fa-history" style="color:#6366f1;"></i> Previous Purchase History
            </span>
            <button type="button" onclick="hide_history()" style="background:none; border:none; font-size:16px; color:#94a3b8; cursor:pointer; padding:0 4px; line-height:1;">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div id="history_content" style="max-height:360px; overflow-y:auto; padding:12px;"></div>
    </div>

    <form method="post" action="" id="purchaseForm" enctype="multipart/form-data">

        <!-- Top Information Cards Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 16px; margin-bottom: 16px;">
            
            <!-- Card 1: Supplier Details -->
            <div class="pur-card" style="margin-bottom: 0;">
                <div class="pur-card-header">
                    <h3 class="pur-card-title">
                        <i class="fa fa-user-circle"></i> Supplier Information
                    </h3>
                    <span style="font-size: 11px; color: var(--pur-text-muted);">Auto-fills on name selection</span>
                </div>
                <div class="pur-card-body">
                    <div class="pur-form-grid" style="grid-template-columns: 1fr 1fr;">
                        <div class="pur-form-group col-span-2">
                            <label class="pur-form-label">Supplier Name <span class="req">*</span></label>
                            <div class="pur-input-wrap">
                                <i class="fa fa-building pur-input-icon"></i>
                                <input required="required" type="text" autocomplete="off" name="supplier_name" class="pur-control" placeholder="Search supplier name..." style="padding-left: 36px !important;" />
                            </div>
                        </div>

                        <div class="pur-form-group col-span-2">
                            <label class="pur-form-label">Supplier Address <span class="req">*</span></label>
                            <div class="pur-input-wrap">
                                <i class="fa fa-map-marker pur-input-icon"></i>
                                <input required="required" type="text" autocomplete="off" name="supplier_address" class="pur-control" placeholder="Supplier business address" style="padding-left: 36px !important;" />
                            </div>
                        </div>

                        <div class="pur-form-group">
                            <label class="pur-form-label">Supplier GSTIN</label>
                            <div class="pur-input-wrap">
                                <i class="fa fa-id-card pur-input-icon"></i>
                                <input type="text" autocomplete="off" name="supplier_gst" class="pur-control" placeholder="15-digit GSTIN" style="padding-left: 36px !important;" />
                            </div>
                        </div>

                        <div class="pur-form-group">
                            <label class="pur-form-label">Contact Number <span class="req">*</span></label>
                            <div class="pur-input-wrap">
                                <i class="fa fa-phone pur-input-icon"></i>
                                <input required="required" type="text" autocomplete="off" name="supplier_contact" class="pur-control" placeholder="Phone or mobile number" style="padding-left: 36px !important;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Invoice Details -->
            <div class="pur-card" style="margin-bottom: 0;">
                <div class="pur-card-header">
                    <h3 class="pur-card-title">
                        <i class="fa fa-file-text-o"></i> Invoice & Entry Details
                    </h3>
                    <span id="invoice_status_badge" style="display:none; font-size: 11px; padding: 2px 8px; border-radius: 4px; font-weight: 600;"></span>
                </div>
                <div class="pur-card-body">
                    <div class="pur-form-grid" style="grid-template-columns: 1fr 1fr;">
                        <div class="pur-form-group">
                            <label class="pur-form-label">Invoice Number <span class="req">*</span></label>
                            <div class="pur-input-wrap">
                                <i class="fa fa-tag pur-input-icon"></i>
                                <input required="required" onkeyup="check_invoice()" onchange="check_invoice()" type="text" autocomplete="off" name="purchase_invoice" class="pur-control" placeholder="e.g. INV-2024-89" style="padding-left: 36px !important;" />
                            </div>
                            <span id="invoice_warning" style="display:none; color:#ef4444; font-size:11px; font-weight:600; margin-top:3px;">
                                <i class="fa fa-exclamation-triangle"></i> Duplicate invoice detected!
                            </span>
                        </div>

                        <div class="pur-form-group">
                            <label class="pur-form-label">Purchase Date <span class="req">*</span></label>
                            <div class="pur-input-wrap">
                                <i class="fa fa-calendar pur-input-icon"></i>
                                <input required="required" type="text" autocomplete="off" name="purchase_date" value="<?= date('d-M-Y') ?>" class="pur-control" placeholder="Select purchase date" style="padding-left: 36px !important;" />
                            </div>
                        </div>

                        <div class="pur-form-group col-span-2">
                            <label class="pur-form-label">Purchase Entry Number <span class="req">*</span></label>
                            <div class="pur-input-wrap">
                                <i class="fa fa-hashtag pur-input-icon"></i>
                                <input required="required" readonly="readonly" value="<?= generate_purchase_number() ?>" type="text" name="purchase_entry_number" class="pur-control" style="padding-left: 36px !important;" />
                            </div>
                        </div>

                        <div class="pur-form-group col-span-2" style="background:#f8fafc; border:1px dashed #cbd5e1; border-radius:6px; padding:6px 10px; margin-top:2px;">
                            <div style="font-size:11.5px; color:#64748b;">
                                <i class="fa fa-keyboard-o" style="color:#6366f1;"></i> <strong>Tip:</strong> Press <kbd style="background:#e2e8f0; color:#334155; padding:1px 4px; border-radius:3px;">Tab</kbd> to move across fields. At row end, a new row is added automatically.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Purchased Items Card -->
        <div class="pur-card">
            <div class="pur-card-header">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <h3 class="pur-card-title">
                        <i class="fa fa-list-alt"></i> Purchased Items
                    </h3>
                    <span class="pur-sticky-badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 11px;">
                        <span class="totalItem">0</span> item(s) listed
                    </span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button type="button" onclick="addmore()" class="btn-pur-add">
                        <i class="fa fa-plus-circle"></i> Add Row
                    </button>
                </div>
            </div>

            <div class="pur-card-body" style="padding: 10px;">
                <div class="pur-table-container">
                    <table class="pur-items-table">
                        <thead>
                            <tr>
                                <th style="width: 40px; min-width: 40px;">#</th>
                                <th style="min-width: 220px; width: 220px; text-align: left !important;">Product Name</th>
                                <th style="width: 65px; min-width: 65px;">HSN</th>
                                <th style="width: 70px; min-width: 70px;">Storage</th>
                                <th style="width: 75px; min-width: 75px;">Category</th>
                                <th style="width: 55px; min-width: 55px;">Schedule</th>
                                <th style="width: 110px; min-width: 110px;">Manufacturer</th>
                                <th style="width: 50px; min-width: 50px;">Qty</th>
                                <th style="width: 46px; min-width: 46px;">Free</th>
                                <th style="width: 48px; min-width: 48px;">Unit</th>
                                <th style="width: 75px; min-width: 75px;">Batch</th>
                                <th style="width: 70px; min-width: 70px;">Exp (MM/YY)</th>
                                <th style="width: 62px; min-width: 62px;">MRP (₹)</th>
                                <th style="width: 65px; min-width: 65px;">Rate (₹)</th>
                                <th style="width: 48px; min-width: 48px;">Disc %</th>
                                <th style="width: 50px; min-width: 50px;">Bonus %</th>
                                <th style="width: 72px; min-width: 72px;">Taxable</th>
                                <th style="width: 48px; min-width: 48px;">CGST %</th>
                                <th style="width: 62px; min-width: 62px;">CGST</th>
                                <th style="width: 48px; min-width: 48px;">SGST %</th>
                                <th style="width: 62px; min-width: 62px;">SGST</th>
                                <th style="width: 82px; min-width: 82px;">Total (₹)</th>
                            </tr>
                        </thead>
                        <tbody class="appendHere">
                            <!-- Dynamic Rows Added by JS -->
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 8px; display: flex; align-items: center; justify-content: space-between;">
                    <button type="button" onclick="addmore()" class="btn-pur-add">
                        <i class="fa fa-plus-circle"></i> Add Another Medicine Row
                    </button>
                    <span style="font-size: 11px; color: var(--pur-text-muted);">
                        <i class="fa fa-info-circle text-primary"></i> Expiring items (< 30 days) are highlighted in soft red.
                    </span>
                </div>
            </div>
        </div>

        <!-- Live Financial Summary KPI Grid -->
        <div class="pur-kpi-grid">
            <div class="pur-kpi-card">
                <div class="pur-kpi-info">
                    <span class="pur-kpi-label">Total Items</span>
                    <span class="pur-kpi-value totalItem">0</span>
                </div>
                <div class="pur-kpi-icon" style="background:#eef2ff; color:#6366f1;">
                    <i class="fa fa-cubes"></i>
                </div>
            </div>

            <div class="pur-kpi-card">
                <div class="pur-kpi-info">
                    <span class="pur-kpi-label">Taxable Amount</span>
                    <span class="pur-kpi-value">₹<span class="totalTaxable">0.00</span></span>
                </div>
                <div class="pur-kpi-icon" style="background:#f0fdf4; color:#10b981;">
                    <i class="fa fa-calculator"></i>
                </div>
            </div>

            <div class="pur-kpi-card">
                <div class="pur-kpi-info">
                    <span class="pur-kpi-label">CGST Total</span>
                    <span class="pur-kpi-value">₹<span class="totalCgst">0.00</span></span>
                </div>
                <div class="pur-kpi-icon" style="background:#fef3c7; color:#d97706;">
                    <i class="fa fa-percent"></i>
                </div>
            </div>

            <div class="pur-kpi-card">
                <div class="pur-kpi-info">
                    <span class="pur-kpi-label">SGST Total</span>
                    <span class="pur-kpi-value">₹<span class="totalSgst">0.00</span></span>
                </div>
                <div class="pur-kpi-icon" style="background:#fef3c7; color:#d97706;">
                    <i class="fa fa-percent"></i>
                </div>
            </div>

            <div class="pur-kpi-card">
                <div class="pur-kpi-info">
                    <span class="pur-kpi-label">Total GST Tax</span>
                    <span class="pur-kpi-value">₹<span class="totalgst">0.00</span></span>
                </div>
                <div class="pur-kpi-icon" style="background:#ede9fe; color:#8b5cf6;">
                    <i class="fa fa-bank"></i>
                </div>
            </div>

            <div class="pur-kpi-card pur-kpi-grand">
                <div class="pur-kpi-info">
                    <span class="pur-kpi-label">Grand Total Payable</span>
                    <span class="pur-kpi-value">₹<span class="totalAmount">0.00</span></span>
                </div>
                <div class="pur-kpi-icon" style="background:rgba(255,255,255,0.2); color:#ffffff;">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
        </div>

        <!-- Sticky Floating Action Bar at Bottom -->
        <div class="pur-sticky-bar">
            <div class="pur-sticky-left">
                <span class="pur-sticky-badge">
                    <i class="fa fa-shopping-basket text-primary"></i> Items: <strong class="totalItem">0</strong>
                </span>
                <span class="pur-sticky-badge">
                    <i class="fa fa-percent text-warning"></i> GST: ₹<strong class="totalgst">0.00</strong>
                </span>
                <span class="pur-sticky-badge" style="background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0;">
                    <i class="fa fa-money text-success"></i> Payable: ₹<strong class="totalAmount">0.00</strong>
                </span>
            </div>

            <div class="pur-sticky-actions">
                <button type="button" onclick="addmore()" class="btn-pur-secondary">
                    <i class="fa fa-plus"></i> Add Row
                </button>
                <button type="button" onclick="goBack()" class="btn-pur-secondary">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn-pur-primary" onclick="return validateBeforeSubmit();">
                    <i class="fa fa-check-circle"></i> Save Purchase Entry
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    var rowcount = 0;
    var baseAppUrl = '<?= base_url() ?>';
    var searchUrl = baseAppUrl + 'search.php';

    function goBack() {
        if (confirm("Are you sure you want to discard this purchase entry?")) {
            window.location.href = '<?= console_url() ?>purchase';
        }
    }

    function reindexRows() {
        var idx = 1;
        $('.rowline').each(function () {
            $(this).find('.pur-row-idx').text(idx);
            idx++;
        });
        calculateTotal();
    }

    function removeRow(targetObj) {
        if ($('.rowline').length <= 1) {
            if (typeof toastr !== 'undefined') {
                toastr.warning('At least one item row is required in the purchase entry.');
            } else {
                alert('At least one item row is required.');
            }
            return;
        }
        $(targetObj).closest('.rowline').remove();
        reindexRows();
    }

    function addmore() {
        rowcount++;
        var therow = '<tr class="rowline">' +
            '<td><div class="pur-row-actions">' +
                '<span class="pur-row-idx">' + rowcount + '</span>' +
                '<button type="button" class="btn-remove-row" onclick="removeRow(this);" title="Remove Row"><i class="fa fa-trash"></i></button>' +
            '</div></td>' +
            '<td><input required="required" type="text" name="medicine_name[]" class="pur-cell-input med-name-input" placeholder="Type medicine..." onfocus="get_history(this)" autocomplete="off"></td>' +
            '<td><input required="required" type="text" name="medicine_hsn[]" class="pur-cell-input text-center"></td>' +
            '<td><input required="required" type="text" name="medicine_storage[]" class="pur-cell-input text-center"></td>' +
            '<td><input type="text" name="medicine_category[]" class="pur-cell-input text-center"></td>' +
            '<td><input type="text" name="medicine_schedule[]" class="pur-cell-input text-center"></td>' +
            '<td><input required="required" type="text" name="medicine_manufacturer[]" class="pur-cell-input"></td>' +
            '<td><input required="required" type="number" name="purchase_quantity[]" step="0.01" min="0.01" oninput="gst_calculation(this)" value="1" class="pur-cell-input text-right" style="font-weight:700;"></td>' +
            '<td><input required="required" type="number" name="purchase_free_quantity[]" step="0.01" value="0" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" type="number" name="medicine_unit[]" class="pur-cell-input text-center" value="10"></td>' +
            '<td><input required="required" type="text" name="purchase_batch[]" pattern="^\\S+$" class="pur-cell-input text-center"></td>' +
            '<td>' +
                '<div class="pur-exp-wrap">' +
                    '<input required="required" type="text" name="purchase_expire_month[]" maxlength="2" placeholder="MM" class="pur-exp-input exp-m" oninput="handleExpMonth(this)">' +
                    '<span class="pur-exp-sep">/</span>' +
                    '<input required="required" type="text" name="purchase_expire_year[]" maxlength="2" placeholder="YY" class="pur-exp-input exp-y" oninput="handleExpYear(this)">' +
                '</div>' +
            '</td>' +
            '<td><input required="required" type="text" name="purchase_mrp[]" value="0.00" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" type="text" name="purchase_rate[]" oninput="gst_calculation(this)" value="0.00" class="pur-cell-input text-right" style="font-weight:700; color:#4338ca;"></td>' +
            '<td><input required="required" type="text" name="purchase_discount_percent[]" oninput="gst_calculation(this)" value="0" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" type="number" name="purchase_bonus[]" oninput="gst_calculation(this)" value="0.00" step="0.01" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" readonly="readonly" type="text" name="purchase_taxable[]" value="0.00" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" type="text" name="purchase_cgst_percent[]" value="0" oninput="gst_calculation(this)" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" readonly="readonly" type="text" name="purchase_cgst[]" value="0.00" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" readonly="readonly" type="text" name="purchase_sgst_percent[]" value="0" oninput="gst_calculation(this)" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" readonly="readonly" type="text" name="purchase_sgst[]" value="0.00" class="pur-cell-input text-right"></td>' +
            '<td><input required="required" readonly="readonly" type="text" name="purchase_total[]" value="0.00" class="pur-cell-input text-right highlight-total"></td>' +
        '</tr>';

        $('.appendHere').append(therow);
        var $newRow = $('.rowline:last');

        // Auto-add new row when pressing Tab on the total field
        $newRow.find('input[name="purchase_total[]"]').on('keydown', function (e) {
            if (e.which === 9 && !e.shiftKey) { // Tab key
                e.preventDefault();
                addmore();
            }
        });

        reindexRows();
        bindMedicineAutocomplete($newRow.find('.med-name-input'));
        $newRow.find('input[name="medicine_name[]"]').focus();
    }

    // Centralized Autocomplete Delegation for Medicines (Always works on all rows)
    function bindMedicineAutocomplete($el) {
        if ($el.data('autocomplete-bound')) return;
        $el.data('autocomplete-bound', true);

        var ac = $el.autocomplete({
            source: searchUrl + '?table=medicines&fieldToSearch=medicine_name',
            minLength: 1,
            select: function (event, ui) {
                var targetRow = $(this).closest('tr');
                if (ui.item && ui.item.complete) {
                    var c = ui.item.complete;
                    targetRow.find('input[name="medicine_name[]"]').val(ui.item.value || c.medicine_name);
                    targetRow.find('input[name="medicine_hsn[]"]').val(c.medicine_hsn || '');
                    targetRow.find('input[name="medicine_storage[]"]').val(c.medicine_storage || '');
                    targetRow.find('input[name="medicine_category[]"]').val(c.medicine_category || '');
                    targetRow.find('input[name="medicine_schedule[]"]').val(c.medicine_schedule || '');
                    targetRow.find('input[name="medicine_manufacturer[]"]').val(c.medicine_manufacturer || '');
                    targetRow.find('input[name="medicine_unit[]"]').val(c.medicine_unit || '10');
                    if (c.medicine_gst && parseFloat(c.medicine_gst) > 0) {
                        var halfGst = (parseFloat(c.medicine_gst) / 2).toFixed(2);
                        targetRow.find('input[name="purchase_cgst_percent[]"]').val(halfGst);
                        targetRow.find('input[name="purchase_sgst_percent[]"]').val(halfGst);
                    }
                    gst_calculation(targetRow.find('input[name="purchase_rate[]"]'));
                    setTimeout(function() {
                        targetRow.find('input[name="purchase_quantity[]"]').focus().select();
                    }, 50);
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
        bindMedicineAutocomplete($(this));
    });

    // Manufacturer Autocomplete
    $(document).on('focus', 'input[name="medicine_manufacturer[]"]', function () {
        if ($(this).data('autocomplete-bound')) return;
        $(this).data('autocomplete-bound', true);
        $(this).autocomplete({
            source: searchUrl + '?table=medicines&fieldToSearch=medicine_manufacturer',
            minLength: 1
        });
    });

    // Batch Autocomplete
    $(document).on('focus', 'input[name="purchase_batch[]"]', function () {
        if ($(this).data('autocomplete-bound')) return;
        $(this).data('autocomplete-bound', true);
        $(this).autocomplete({
            source: searchUrl + '?table=purchases&fieldToSearch=purchase_batch',
            minLength: 1
        });
    });

    function handleExpMonth(elem) {
        var val = $(elem).val().replace(/[^0-9]/g, '');
        $(elem).val(val);
        if (parseInt(val, 10) > 12) {
            $(elem).val('12');
            val = '12';
        }
        if (val.length === 2) {
            $(elem).closest('.pur-exp-wrap').find('.exp-y').focus().select();
        }
        checkRowExpiry($(elem).closest('tr'));
    }

    function handleExpYear(elem) {
        var val = $(elem).val().replace(/[^0-9]/g, '');
        $(elem).val(val);
        checkRowExpiry($(elem).closest('tr'));
    }

    function checkRowExpiry($row) {
        var m = $row.find('.exp-m').val();
        var y = $row.find('.exp-y').val();
        if (m && y && m.length > 0 && y.length > 0) {
            if (isExpiryLessThan30Days(m, y)) {
                $row.addClass('expiry-warning');
            } else {
                $row.removeClass('expiry-warning');
            }
        } else {
            $row.removeClass('expiry-warning');
        }
    }

    function isExpiryLessThan30Days(monthStr, yearStr) {
        var month = parseInt(monthStr, 10);
        var year = parseInt(yearStr, 10);
        if (!month || !year) return false;
        if (year < 100) year += 2000;
        var expiryDate = new Date(year, month, 0); // last day of that month
        var today = new Date();
        var diffDays = (expiryDate - today) / (1000 * 60 * 60 * 24);
        return diffDays < 30;
    }

    function gst_calculation(targetObject) {
        var $row = $(targetObject).closest('tr');
        var cgst = parseFloat($row.find('input[name="purchase_cgst_percent[]"]').val()) || 0;
        $row.find('input[name="purchase_sgst_percent[]"]').val(cgst); // SGST matches CGST
        var sgst = cgst;
        var rate = parseFloat($row.find('input[name="purchase_rate[]"]').val()) || 0;
        var qty = parseFloat($row.find('input[name="purchase_quantity[]"]').val()) || 0;
        var discount_percent = parseFloat($row.find('input[name="purchase_discount_percent[]"]').val()) || 0;
        var purchase_bonus = parseFloat($row.find('input[name="purchase_bonus[]"]').val()) || 0;

        var total = (rate * qty);
        var total_discount = (total * discount_percent / 100);
        var taxable_cost = (total - total_discount);
        var total_cgst = (taxable_cost * cgst / 100);
        var total_sgst = (taxable_cost * sgst / 100);
        var bonus_total = (total_sgst + total_cgst + taxable_cost) * (purchase_bonus / 100);
        var grandtotal = (total_sgst + total_cgst + taxable_cost) - bonus_total;

        $row.find('input[name="purchase_taxable[]"]').val(taxable_cost.toFixed(2));
        $row.find('input[name="purchase_cgst[]"]').val(total_cgst.toFixed(2));
        $row.find('input[name="purchase_sgst[]"]').val(total_sgst.toFixed(2));
        $row.find('input[name="purchase_total[]"]').val(grandtotal.toFixed(2));

        calculateTotal();
    }

    function calculateTotal() {
        var totalItem = $('.rowline').length;
        var totalTaxable = 0;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;

        $('.rowline').each(function () {
            totalTaxable += parseFloat($(this).find('input[name="purchase_taxable[]"]').val()) || 0;
            totalCgst += parseFloat($(this).find('input[name="purchase_cgst[]"]').val()) || 0;
            totalSgst += parseFloat($(this).find('input[name="purchase_sgst[]"]').val()) || 0;
            totalTotal += parseFloat($(this).find('input[name="purchase_total[]"]').val()) || 0;
        });

        $('.totalItem').html(totalItem);
        $('.totalTaxable').html(totalTaxable.toFixed(2));
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
    }

    function check_invoice() {
        var inv = $('input[name="purchase_invoice"]').val();
        var supp = $('input[name="supplier_name"]').val();
        if (!inv || inv.trim() === '') {
            $('#invoice_warning').hide();
            return;
        }
        var targetUrl = (typeof page_url !== 'undefined' ? page_url : '<?= console_url() ?>purchase/') + 'check_duplicate_invoice';
        $.post(targetUrl, {
            purchase_invoice: inv,
            supplier_name: supp
        }, function (resp) {
            if (resp && resp.invoice_count > 0) {
                $('#invoice_warning').fadeIn(150);
            } else {
                $('#invoice_warning').fadeOut(150);
            }
        }, 'json');
    }

    function get_history(targetObj) {
        var medName = $(targetObj).val();
        if (!medName || medName.trim().length < 2) return;
        $.post('<?= console_url() ?>purchase/purchase_history', { medicine: medName }, function (resp) {
            if (resp && resp.trim() !== '') {
                $('#history_content').html(resp);
                $('#history_modal').fadeIn(200);
            }
        });
    }

    function hide_history() {
        $('#history_modal').fadeOut(150);
    }

    $(document).keyup(function(e) {
        if (e.keyCode === 27) { // Escape key closes history
            hide_history();
        }
    });

    function validateBeforeSubmit() {
        if ($('.rowline').length === 0) {
            if (typeof toastr !== 'undefined') {
                toastr.error('Please add at least one medicine item before saving.');
            } else {
                alert('Please add at least one medicine item before saving.');
            }
            return false;
        }
        return true;
    }

    $(document).ready(function () {
        // Initialize Datepicker
        if ($.fn.datepicker) {
            $("[name='purchase_date']").datepicker({
                dateFormat: 'dd-M-yy',
                changeMonth: true,
                changeYear: true
            });
        }

        // Supplier Autocomplete
        var suppAc = $('input[name="supplier_name"]').autocomplete({
            source: searchUrl + '?table=suppliers&fieldToSearch=supplier_name',
            minLength: 1,
            select: function (event, ui) {
                if (ui.item && ui.item.complete) {
                    var c = ui.item.complete;
                    $('input[name="supplier_name"]').val(ui.item.value || c.supplier_name);
                    if (c.supplier_address) $('input[name="supplier_address"]').val(c.supplier_address);
                    if (c.supplier_gst) $('input[name="supplier_gst"]').val(c.supplier_gst);
                    if (c.supplier_contact) $('input[name="supplier_contact"]').val(c.supplier_contact);
                    check_invoice();
                    setTimeout(function() {
                        $('input[name="purchase_invoice"]').focus();
                    }, 50);
                }
                return false;
            }
        });

        var suppWidget = suppAc.data("ui-autocomplete") || suppAc.data("autocomplete");
        if (suppWidget) {
            suppWidget._renderItem = function(ul, item) {
                var c = item.complete || {};
                var subParts = [];
                if (c.supplier_contact) subParts.push('Tel: ' + c.supplier_contact);
                if (c.supplier_gst) subParts.push('GST: ' + c.supplier_gst);
                var subHtml = subParts.length > 0 ? '<div style="font-size: 11px; color: #64748b; margin-top: 2px;">' + subParts.join(' &bull; ') + '</div>' : '';
                return $("<li>")
                    .append('<div style="padding: 6px 12px; cursor: pointer; border-bottom: 1px solid #f1f5f9;"><div style="font-weight: 700; color: #0f172a; font-size: 12px;">' + item.label + '</div>' + subHtml + '</div>')
                    .appendTo(ul);
            };
        }

        // Add first row
        addmore();
    });
</script>