<?php
$counter = 1;
$taxable = 0;
$total_CGST = 0;
$total_SGST = 0;
$total_totaled = 0;

if (!empty($customer_data)) {
    foreach ($customer_data as $v) {
        $taxable += floatval($v['sale_taxable'] ?? 0);
        $total_CGST += floatval($v['sale_cgst'] ?? 0);
        $total_SGST += floatval($v['sale_sgst'] ?? 0);
        $total_totaled += floatval($v['sale_total'] ?? 0);
    }
}

$total_grand_discount = !empty($sale_grand_dis_data[0]['sale_grand_discount']) ? round(floatval($sale_grand_dis_data[0]['sale_grand_discount']), 2) : 0;
$grand_total = $total_totaled - $total_grand_discount;
?>

<div class="ss-card" style="margin-bottom: 24px;">
    <!-- Action Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0;">
        <div>
            <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">
                <i class="fa fa-receipt text-primary"></i> Customer GSTIN-Wise Summary Records
            </h4>
            <span style="font-size: 13px; color: #64748b;">
                Showing GST-registered sales from <?= $start ?> to <?= $end ?>
            </span>
        </div>
        <div>
            <a href="<?= console_url('sale/report_gstin_wise_export'); ?>?start=<?= $start ?>&end=<?= $end ?>" class="ss-btn ss-btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                <i class="fa fa-file-excel"></i> Export GSTIN Report
            </a>
        </div>
    </div>

    <!-- Main Table -->
    <div class="table-responsive">
        <table class="ss-modern-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">#</th>
                    <th>Customer Name</th>
                    <th>Customer GSTIN</th>
                    <th>Sale Date</th>
                    <th style="text-align: right;">Taxable</th>
                    <th style="text-align: right;">CGST</th>
                    <th style="text-align: right;">SGST</th>
                    <th style="text-align: right;">Gross Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customer_data)) { ?>
                    <?php foreach ($customer_data as $key => $value) { 
                        $val_taxable = floatval($value['sale_taxable'] ?? 0);
                        $val_cgst = floatval($value['sale_cgst'] ?? 0);
                        $val_sgst = floatval($value['sale_sgst'] ?? 0);
                        $val_tot = floatval($value['sale_total'] ?? 0);
                    ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td style="font-weight: 600; color: #0f172a;">
                                <?= htmlspecialchars($value['customer_name'] ?? 'Walk-in Customer') ?>
                            </td>
                            <td style="font-family: monospace; font-size: 12px; color: #475569;">
                                <?= !empty($value['customer_gst']) ? '<span class="ss-badge ss-badge-info">' . htmlspecialchars($value['customer_gst']) . '</span>' : '<span style="color:#94a3b8;">N/A</span>' ?>
                            </td>
                            <td style="white-space: nowrap;"><?= date('d M Y', strtotime($value['sale_date'])) ?></td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($val_taxable, 2) ?></td>
                            <td style="text-align: right; color: #6366f1; font-weight: 600;">₹<?= number_format($val_cgst, 2) ?></td>
                            <td style="text-align: right; color: #06b6d4; font-weight: 600;">₹<?= number_format($val_sgst, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #0f172a;">₹<?= number_format($val_tot, 2) ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #94a3b8;">
                            <i class="fa fa-info-circle" style="font-size: 28px; margin-bottom: 8px;"></i>
                            <p style="margin: 0; font-size: 14px;">No GSTIN sales records found for the chosen date filters.</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <?php if (!empty($customer_data)) { ?>
                <tfoot>
                    <tr style="background: #f8fafc; font-weight: 700; border-top: 2px solid #cbd5e1;">
                        <td colspan="4" style="text-align: right; padding-right: 16px; font-size: 14px;">Sub-Total:</td>
                        <td style="text-align: right; font-size: 14px;">₹<?= number_format($taxable, 2) ?></td>
                        <td style="text-align: right; font-size: 14px; color: #6366f1;">₹<?= number_format($total_CGST, 2) ?></td>
                        <td style="text-align: right; font-size: 14px; color: #06b6d4;">₹<?= number_format($total_SGST, 2) ?></td>
                        <td style="text-align: right; font-size: 14px;">₹<?= number_format($total_totaled, 2) ?></td>
                    </tr>
                    <?php if ($total_grand_discount > 0) { ?>
                        <tr style="background: #fff1f2; font-weight: 700;">
                            <td colspan="7" style="text-align: right; color: #be123c; padding-right: 16px;">Less Overall Discount:</td>
                            <td style="text-align: right; color: #be123c;">-₹<?= number_format($total_grand_discount, 2) ?></td>
                        </tr>
                    <?php } ?>
                    <tr style="background: #ecfdf5; font-weight: 800; border-top: 2px solid #a7f3d0;">
                        <td colspan="7" style="text-align: right; color: #065f46; padding-right: 16px; font-size: 15px;">Net Grand Total:</td>
                        <td style="text-align: right; color: #047857; font-size: 16px;">₹<?= number_format($grand_total, 2) ?></td>
                    </tr>
                </tfoot>
            <?php } ?>
        </table>
    </div>
</div>

<!-- Secondary Tax Breakdown Cards -->
<div class="row">
    <!-- Tax Slab Breakdown -->
    <div class="col-md-6 mb-4">
        <div class="ss-card" style="height: 100%;">
            <div class="ss-card-header" style="background: #fff; border-bottom: 1px solid #e2e8f0; padding: 14px 18px;">
                <h5 style="margin: 0; font-size: 15px; font-weight: 700; color: #0f172a;">
                    <i class="fa fa-percentage text-primary"></i> GST Slab Reconciliations
                </h5>
            </div>
            <div class="table-responsive">
                <table class="ss-modern-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>CGST %</th>
                            <th style="text-align: right;">Total CGST</th>
                            <th>SGST %</th>
                            <th style="text-align: right;">Total SGST</th>
                            <th style="text-align: right;">Taxable Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_d_cgst = 0;
                        $total_d_sgst = 0;
                        $total_d_taxable = 0;
                        if (!empty($daily_gst_data)) {
                            foreach ($daily_gst_data as $val) {
                                $cg = floatval($val['sale_cgst'] ?? 0);
                                $sg = floatval($val['sale_sgst'] ?? 0);
                                $tx = floatval($val['sale_taxable'] ?? 0);
                                $total_d_cgst += $cg;
                                $total_d_sgst += $sg;
                                $total_d_taxable += $tx;
                        ?>
                            <tr>
                                <td><span class="ss-badge ss-badge-info"><?= $val['sale_cgst_percent'] ?>%</span></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($cg, 2) ?></td>
                                <td><span class="ss-badge ss-badge-info"><?= $val['sale_sgst_percent'] ?? $val['sale_cgst_percent'] ?>%</span></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($sg, 2) ?></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($tx, 2) ?></td>
                            </tr>
                        <?php } } else { ?>
                            <tr><td colspan="5" style="text-align: center; color: #94a3b8;">No slab data available</td></tr>
                        <?php } ?>
                    </tbody>
                    <?php if (!empty($daily_gst_data)) { ?>
                        <tfoot>
                            <tr style="background: #f8fafc; font-weight: 700;">
                                <td>Total</td>
                                <td style="text-align: right; color: #6366f1;">₹<?= number_format($total_d_cgst, 2) ?></td>
                                <td>Total</td>
                                <td style="text-align: right; color: #06b6d4;">₹<?= number_format($total_d_sgst, 2) ?></td>
                                <td style="text-align: right; color: #059669;">₹<?= number_format($total_d_taxable, 2) ?></td>
                            </tr>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <!-- HSN Summary -->
    <div class="col-md-6 mb-4">
        <div class="ss-card" style="height: 100%;">
            <div class="ss-card-header" style="background: #fff; border-bottom: 1px solid #e2e8f0; padding: 14px 18px;">
                <h5 style="margin: 0; font-size: 15px; font-weight: 700; color: #0f172a;">
                    <i class="fa fa-boxes text-primary"></i> HSN Quantity & Tax Distribution
                </h5>
            </div>
            <div class="table-responsive">
                <table class="ss-modern-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>HSN Code</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Taxable</th>
                            <th style="text-align: right;">CGST</th>
                            <th style="text-align: right;">SGST</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_h_qty = 0;
                        $total_h_tax = 0;
                        $total_h_cg = 0;
                        $total_h_sg = 0;
                        if (!empty($hsn_daily_gst_data)) {
                            foreach ($hsn_daily_gst_data as $val) {
                                $qty = intval($val['sale_strip_quantity'] ?? 0);
                                $tx = floatval($val['sale_taxable'] ?? 0);
                                $cg = floatval($val['sale_cgst'] ?? 0);
                                $sg = floatval($val['sale_sgst'] ?? 0);
                                $total_h_qty += $qty;
                                $total_h_tax += $tx;
                                $total_h_cg += $cg;
                                $total_h_sg += $sg;
                        ?>
                            <tr>
                                <td>
                                    <span class="ss-badge ss-badge-secondary" style="font-family: monospace;">
                                        <?= htmlspecialchars($val['medicine_hsn'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td style="text-align: center; font-weight: 600;"><?= $qty ?></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($tx, 2) ?></td>
                                <td style="text-align: right; color: #6366f1;">₹<?= number_format($cg, 2) ?></td>
                                <td style="text-align: right; color: #06b6d4;">₹<?= number_format($sg, 2) ?></td>
                            </tr>
                        <?php } } else { ?>
                            <tr><td colspan="5" style="text-align: center; color: #94a3b8;">No HSN records found</td></tr>
                        <?php } ?>
                    </tbody>
                    <?php if (!empty($hsn_daily_gst_data)) { ?>
                        <tfoot>
                            <tr style="background: #f8fafc; font-weight: 700;">
                                <td>Total</td>
                                <td style="text-align: center;"><?= $total_h_qty ?></td>
                                <td style="text-align: right; color: #059669;">₹<?= number_format($total_h_tax, 2) ?></td>
                                <td style="text-align: right; color: #6366f1;">₹<?= number_format($total_h_cg, 2) ?></td>
                                <td style="text-align: right; color: #06b6d4;">₹<?= number_format($total_h_sg, 2) ?></td>
                            </tr>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
