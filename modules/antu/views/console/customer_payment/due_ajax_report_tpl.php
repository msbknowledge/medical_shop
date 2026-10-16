<?php
$counter = 1;
$total_sale_sum = 0;
$total_paid_sum = 0;
$total_due_sum = 0;

if (!empty($alldata)) {
    foreach ($alldata as $v) {
        if (!empty($v)) {
            $total_sale_sum += floatval($v['sale_total'] ?? 0);
            $total_paid_sum += floatval($v['customer_payment_paid_amount'] ?? 0);
            $due = round(($v['sale_total'] ?? 0) - ($v['customer_payment_paid_amount'] ?? 0));
            $total_due_sum += $due;
        }
    }
}
?>

<div class="ss-card" style="margin-bottom: 24px;">
    <!-- Stat Summary Badges -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e2e8f0;">
        <div style="background: #f8fafc; padding: 14px 18px; border-radius: 10px; border: 1px solid #e2e8f0;">
            <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase;">Total Sales</div>
            <div style="font-size: 20px; font-weight: 700; color: #0f172a; margin-top: 4px;">₹<?= number_format($total_sale_sum, 2) ?></div>
        </div>
        <div style="background: #ecfdf5; padding: 14px 18px; border-radius: 10px; border: 1px solid #a7f3d0;">
            <div style="font-size: 12px; font-weight: 600; color: #059669; text-transform: uppercase;">Total Paid</div>
            <div style="font-size: 20px; font-weight: 700; color: #047857; margin-top: 4px;">₹<?= number_format($total_paid_sum, 2) ?></div>
        </div>
        <div style="background: #fff1f2; padding: 14px 18px; border-radius: 10px; border: 1px solid #fecdd3;">
            <div style="font-size: 12px; font-weight: 600; color: #e11d48; text-transform: uppercase;">Total Outstanding Due</div>
            <div style="font-size: 20px; font-weight: 700; color: #be123c; margin-top: 4px;">₹<?= number_format($total_due_sum, 2) ?></div>
        </div>
        <div style="background: #f1f5f9; padding: 14px 18px; border-radius: 10px; border: 1px solid #cbd5e1;">
            <div style="font-size: 12px; font-weight: 600; color: #475569; text-transform: uppercase;">Customer Count</div>
            <div style="font-size: 20px; font-weight: 700; color: #334155; margin-top: 4px;"><?= !empty($alldata) ? count($alldata) : 0 ?></div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-responsive">
        <table class="ss-modern-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">#</th>
                    <th>Customer Name</th>
                    <th style="text-align: right;">Total Sale</th>
                    <th style="text-align: right;">Paid Amount</th>
                    <th style="text-align: right;">Pending Due</th>
                    <th style="text-align: center; width: 120px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alldata)) { ?>
                    <?php foreach ($alldata as $value) {
                        if (empty($value)) continue;
                        $sale_val = floatval($value['sale_total'] ?? 0);
                        $paid_val = floatval($value['customer_payment_paid_amount'] ?? 0);
                        $due_val = round($sale_val - $paid_val);
                    ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td>
                                <div style="font-weight: 600; color: #0f172a;">
                                    <i class="fa fa-user" style="color: #94a3b8; margin-right: 6px;"></i>
                                    <?= htmlspecialchars($value['customer_name'] ?? 'Walk-in Customer') ?>
                                </div>
                            </td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($sale_val, 2) ?></td>
                            <td style="text-align: right; color: #059669; font-weight: 600;">₹<?= number_format($paid_val, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: <?= $due_val > 0 ? '#e11d48' : '#64748b' ?>;">
                                ₹<?= number_format($due_val, 2) ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if ($due_val > 0) { ?>
                                    <span class="ss-badge ss-badge-danger" style="font-size: 11px;">Due Pending</span>
                                <?php } else { ?>
                                    <span class="ss-badge ss-badge-success" style="font-size: 11px;">Clear</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 36px; color: #94a3b8;">
                            <i class="fa fa-info-circle" style="font-size: 24px; margin-bottom: 8px;"></i>
                            <p style="margin: 0; font-size: 14px;">No due records found for the selected period.</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <?php if (!empty($alldata)) { ?>
                <tfoot>
                    <tr style="background: #f8fafc; font-weight: 700; border-top: 2px solid #cbd5e1;">
                        <td colspan="2" style="text-align: right; padding-right: 16px; font-size: 14px;">Total Summary:</td>
                        <td style="text-align: right; font-size: 14px;">₹<?= number_format($total_sale_sum, 2) ?></td>
                        <td style="text-align: right; font-size: 14px; color: #059669;">₹<?= number_format($total_paid_sum, 2) ?></td>
                        <td style="text-align: right; font-size: 14px; color: #e11d48;">₹<?= number_format($total_due_sum, 2) ?></td>
                        <td style="text-align: center;">
                            <span class="ss-badge <?= $total_due_sum > 0 ? 'ss-badge-warning' : 'ss-badge-success' ?>">
                                <?= $total_due_sum > 0 ? 'Total Due' : 'All Clear' ?>
                            </span>
                        </td>
                    </tr>
                </tfoot>
            <?php } ?>
        </table>
    </div>
</div>
