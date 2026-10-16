<?php
$purchase_taxable = floatval($purchase_data[0]['purchase_taxable'] ?? 0);
$purchase_total = floatval($purchase_data[0]['purchase_total'] ?? 0);
$purchase_gst = $purchase_total - $purchase_taxable;

$sale_taxable = floatval($sales_data[0]['sale_taxable'] ?? 0);
$sale_total = floatval($sales_data[0]['sale_total'] ?? 0);
$sale_gst = $sale_total - $sale_taxable;
$grand_dis = floatval(round($sale_grand_dis[0]['sale_grand_discount'] ?? 0, 2));

$payable_govt_gst = $sale_gst - $purchase_gst;
$total_purchase_all_gst = $purchase_total + $payable_govt_gst;
$total_sale_net = $sale_total - $grand_dis;

$amount = $sale_total - $grand_dis - ($purchase_total + $payable_govt_gst);
$is_profit = ($amount >= 0);
?>

<div class="row" style="margin-bottom: 24px;">
    <!-- Stat Summary Badges -->
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="ss-card" style="border-left: 4px solid #ef4444; padding: 20px;">
            <div style="font-size: 12px; font-weight: 700; color: #ef4444; text-transform: uppercase; letter-spacing: 0.5px;">
                <i class="fa fa-arrow-down"></i> Total Expenses
            </div>
            <div style="font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 8px;">
                ₹<?= number_format($total_purchase_all_gst, 2) ?>
            </div>
            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                Purchases + Net Payable Govt GST
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="ss-card" style="border-left: 4px solid #10b981; padding: 20px;">
            <div style="font-size: 12px; font-weight: 700; color: #10b981; text-transform: uppercase; letter-spacing: 0.5px;">
                <i class="fa fa-arrow-up"></i> Total Revenue / Income
            </div>
            <div style="font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 8px;">
                ₹<?= number_format($total_sale_net, 2) ?>
            </div>
            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                Gross Sales less Discounts (₹<?= number_format($grand_dis, 2) ?>)
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12 mb-3">
        <div class="ss-card" style="border-left: 4px solid <?= $is_profit ? '#059669' : '#dc2626' ?>; padding: 20px; background: <?= $is_profit ? '#ecfdf5' : '#fef2f2' ?>;">
            <div style="font-size: 12px; font-weight: 700; color: <?= $is_profit ? '#059669' : '#dc2626' ?>; text-transform: uppercase; letter-spacing: 0.5px;">
                <i class="fa <?= $is_profit ? 'fa-chart-line' : 'fa-exclamation-triangle' ?>"></i> <?= $is_profit ? 'Net Profit' : 'Net Loss' ?>
            </div>
            <div style="font-size: 26px; font-weight: 800; color: <?= $is_profit ? '#065f46' : '#991b1b' ?>; margin-top: 8px;">
                <?= $is_profit ? '+' : '' ?>₹<?= number_format($amount, 2) ?>
            </div>
            <div style="font-size: 12px; font-weight: 600; color: <?= $is_profit ? '#047857' : '#b91c1c' ?>; margin-top: 4px;">
                Status: <?= $is_profit ? 'Profitable Trading' : 'Loss Trading' ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Expenses Breakdown Card -->
    <div class="col-md-6 mb-4">
        <div class="ss-card" style="height: 100%;">
            <div class="ss-card-header" style="background: #fff; border-bottom: 1px solid #e2e8f0; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between;">
                <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #b91c1c; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-receipt text-danger"></i> Expenses Breakdown
                </h4>
                <span class="ss-badge ss-badge-danger">Expenditure</span>
            </div>
            <div class="table-responsive">
                <table class="ss-modern-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Statement</th>
                            <th style="text-align: right; width: 140px;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #334155;">Total Purchase (Excluding GST)</div>
                                <small style="color: #64748b;">Taxable purchase value</small>
                            </td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($purchase_taxable, 2) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #334155;">Total Purchase GST</div>
                                <small style="color: #64748b;">Input tax credit</small>
                            </td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($purchase_gst, 2) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #334155;">Payable Govt GST</div>
                                <small style="color: #64748b;">Output GST minus Input GST</small>
                            </td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($payable_govt_gst, 2) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="background: #fef2f2; font-weight: 700; border-top: 2px solid #fecdd3;">
                            <td style="color: #991b1b;">Total Purchase & Tax Expense</td>
                            <td style="text-align: right; color: #991b1b; font-size: 15px;">₹<?= number_format($total_purchase_all_gst, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Income Breakdown Card -->
    <div class="col-md-6 mb-4">
        <div class="ss-card" style="height: 100%;">
            <div class="ss-card-header" style="background: #fff; border-bottom: 1px solid #e2e8f0; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between;">
                <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #047857; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-hand-holding-usd text-success"></i> Income Breakdown
                </h4>
                <span class="ss-badge ss-badge-success">Revenue</span>
            </div>
            <div class="table-responsive">
                <table class="ss-modern-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Statement</th>
                            <th style="text-align: right; width: 140px;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #334155;">Total Sale (Excluding GST)</div>
                                <small style="color: #64748b;">Taxable sale turnover</small>
                            </td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($sale_taxable, 2) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #334155;">Total Sale GST</div>
                                <small style="color: #64748b;">Collected tax from customers</small>
                            </td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($sale_gst, 2) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #334155;">Discount Deduction</div>
                                <small style="color: #64748b;">Total customer discounts</small>
                            </td>
                            <td style="text-align: right; color: #dc2626; font-weight: 600;">-₹<?= number_format($grand_dis, 2) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="background: #ecfdf5; font-weight: 700; border-top: 2px solid #a7f3d0;">
                            <td style="color: #065f46;">Total Realized Revenue</td>
                            <td style="text-align: right; color: #065f46; font-size: 15px;">₹<?= number_format($total_sale_net, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Net Profit / Loss Card -->
<div class="ss-card" style="border: 2px solid <?= $is_profit ? '#10b981' : '#ef4444' ?>; padding: 24px; text-align: center; background: <?= $is_profit ? '#f0fdf4' : '#fef2f2' ?>;">
    <div style="font-size: 14px; font-weight: 700; text-transform: uppercase; color: <?= $is_profit ? '#047857' : '#b91c1c' ?>; letter-spacing: 0.5px;">
        Final Financial Position for Period
    </div>
    <div style="font-size: 36px; font-weight: 900; color: <?= $is_profit ? '#065f46' : '#991b1b' ?>; margin: 8px 0;">
        <?= $is_profit ? 'Net Profit: ₹' . number_format($amount, 2) : 'Net Loss: -₹' . number_format(abs($amount), 2) ?>
    </div>
    <p style="margin: 0; color: #475569; font-size: 13px;">
        Calculated as [Total Net Sales (₹<?= number_format($total_sale_net, 2) ?>)] minus [Total Purchase (₹<?= number_format($purchase_total, 2) ?>) + Net Govt GST (₹<?= number_format($payable_govt_gst, 2) ?>)].
    </p>
</div>