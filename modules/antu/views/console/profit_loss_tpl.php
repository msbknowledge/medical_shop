<div class="ss-dashboard" style="padding: 20px 0;">
    <!-- Header with Breadcrumbs & Action -->
    <div class="ss-card" style="margin-bottom: 24px; padding: 20px 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h3 style="margin: 0; font-size: 22px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 12px;">
                    <i class="fa fa-chart-pie" style="color: var(--ss-primary, #6366f1);"></i> Profit & Loss Financial Statement
                </h3>
                <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                    Review total store revenues, input/output GST reconciliation, purchases, and net trading margins.
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" onclick="window.print()" class="ss-btn ss-btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa fa-print"></i> Print Statement
                </button>
            </div>
        </div>
    </div>

    <!-- Date Range Filter Card -->
    <div class="ss-card no-print" style="margin-bottom: 24px; padding: 20px 24px;">
        <form method="post" id="pl_filter_form" onsubmit="return false">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)) auto; gap: 20px; align-items: flex-end;">
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">
                        <i class="fa fa-calendar-alt"></i> Start Date
                    </label>
                    <input type="date" value="<?= !empty($start) ? $start : date('Y-m-d', strtotime('-1 month')) ?>" id="start_date" name="start" class="form-control" style="border-radius: 8px; height: 42px; border: 1.5px solid #cbd5e1;" />
                </div>
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 6px;">
                        <i class="fa fa-calendar-check"></i> End Date
                    </label>
                    <input type="date" value="<?= !empty($end) ? $end : date('Y-m-d') ?>" id="end_date" name="end" class="form-control" style="border-radius: 8px; height: 42px; border: 1.5px solid #cbd5e1;" />
                </div>
                <div>
                    <button type="button" id="btn_refresh_pl" class="ss-btn ss-btn-primary" style="height: 42px; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fa fa-sync-alt"></i> Update Calculation
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Loading Spinner Indicator -->
    <div id="loading_spinner" style="display: none; text-align: center; padding: 24px;">
        <i class="fa fa-circle-notch fa-spin" style="font-size: 32px; color: var(--ss-primary, #6366f1);"></i>
        <div style="margin-top: 10px; font-size: 14px; font-weight: 600; color: #475569;">Computing statement figures...</div>
    </div>

    <!-- AJAX Container for Profit/Loss Tables -->
    <div class="ajax_resp">
        <?php $this->load->view('console/profit_loss_table_tpl', array(
            'purchase_data' => $purchase_data,
            'sales_data'    => $sales_data,
            'sale_grand_dis'=> $sale_grand_dis,
            'start'         => $start,
            'end'           => $end
        )); ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        function triggerProfitLossUpdate() {
            $('#loading_spinner').show();
            $.post("", {
                start: $('#start_date').val(),
                end: $('#end_date').val(),
                key: 'ajax_resp'
            }, function (resp) {
                $(".ajax_resp").html(resp);
                $('#loading_spinner').hide();
            }).fail(function() {
                $('#loading_spinner').hide();
            });
        }

        $('#start_date, #end_date').on("change", function () {
            triggerProfitLossUpdate();
        });

        $('#btn_refresh_pl').on("click", function() {
            triggerProfitLossUpdate();
        });
    });
</script>