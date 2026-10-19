<?php
// Stock Amount Sheet - Smart School UI Upgrade
?>
<div class="index-wrapper">
    <div class="ss-card">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-money" style="color: var(--ss-success);"></i> Stock Value & Amount Sheet
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <span class="ss-badge ss-badge-primary" style="font-size: 12px; padding: 5px 12px;">
                    <i class="fa fa-calculator"></i> Valuation by Manufacturer
                </span>
            </div>
        </div>

        <div style="padding: 20px;">
            <form method="post" onsubmit="return false">
                <div class="row-fluid" style="display: flex; gap: 12px; align-items: center; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px; position: relative;">
                        <i class="fa fa-industry" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--ss-text-muted);"></i>
                        <input type="text" name="medicine_manufacturer" id="medicine_manufacturer" placeholder="Enter medicine manufacturer name..." class="form-control" style="width: 100%; padding-left: 38px; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px;" />
                    </div>
                    <div>
                        <button type="button" id="report_sub" class="btn ss-btn-primary" style="height: 40px; padding: 0 20px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-search"></i> Generate Valuation
                        </button>
                    </div>
                </div>
            </form>

            <div id="wait_message" style="display: none; padding: 15px; text-align: center; color: var(--ss-primary); font-weight: 600; background: rgba(99, 102, 241, 0.05); border-radius: 8px; margin-bottom: 15px;">
                <i class="fa fa-spinner fa-spin fa-lg"></i> Calculating valuation, please wait...
            </div>

            <div class="ajax_resp">
                <div style="text-align: center; padding: 40px; color: var(--ss-text-muted); border: 1px dashed var(--ss-border); border-radius: 12px;">
                    <i class="fa fa-filter fa-2x" style="opacity: 0.5;"></i>
                    <p style="margin-top: 10px; font-weight: 600;">Enter a manufacturer name or click Generate Valuation to view stock amount data</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var reqst = null;
    $(document).ready(function() {
        $('#report_sub').click(function() {
            $('#wait_message').show();
            reqst = $.post("<?= base_url() ?>console/medicine_stock/stock_amount", $('form').serialize(), function(resp) {
                $(".ajax_resp").html(resp);
                $('#wait_message').hide();
            });
        });
    });
</script>