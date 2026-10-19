<?php
// Stock Sales Statement - Smart School UI Upgrade
?>
<div class="index-wrapper">
    <div class="ss-card">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-line-chart" style="color: var(--ss-primary);"></i> Medicine Stock & Sales Statement
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <span class="ss-badge ss-badge-primary" style="font-size: 12px; padding: 5px 12px;">
                    <i class="fa fa-calendar"></i> Movement Report
                </span>
            </div>
        </div>

        <div style="padding: 20px;">
            <form method="post" onsubmit="return false">
                <div class="row-fluid" style="display: flex; gap: 12px; align-items: flex-end; margin-bottom: 20px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 6px; display: block;">Start Date</label>
                        <input type="text" name="start_date" id="start_date" class="form-control datepicker" value="<?= date('Y-m-01') ?>" style="width: 100%; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px;" />
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 6px; display: block;">End Date</label>
                        <input type="text" name="end_date" id="end_date" class="form-control datepicker" value="<?= date('Y-m-d') ?>" style="width: 100%; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px;" />
                    </div>
                    <div>
                        <button type="button" id="report_sub" class="btn ss-btn-primary" style="height: 40px; padding: 0 20px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-bar-chart"></i> Generate Statement
                        </button>
                    </div>
                </div>
            </form>

            <div class="ajax_resp">
                <div style="text-align: center; padding: 40px; color: var(--ss-text-muted); border: 1px dashed var(--ss-border); border-radius: 12px;">
                    <i class="fa fa-bar-chart fa-2x" style="opacity: 0.5;"></i>
                    <p style="margin-top: 10px; font-weight: 600;">Choose a date range and click Generate Statement</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var reqst = null;
    $(document).ready(function() {
        if ($.fn.datepicker) {
            $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
        }
        $('#report_sub').click(function() {
            $(".ajax_resp").html("<div style='text-align:center; padding:30px; color:var(--ss-primary); font-weight:600;'><i class='fa fa-spinner fa-spin fa-2x'></i><br><br>Generating stock statement...</div>");
            reqst = $.post("<?= base_url() ?>console/medicine_stock/stock_sales_statement", $('form').serialize(), function(resp) {
                $(".ajax_resp").html(resp);
            });
        });
    });
</script>