<?php
$counter = 1;
$taxable = 0;
$total_CGST = 0;
$total_SGST = 0;
$total_totaled = 0;

if (!empty($customer_data)) {
    foreach ($customer_data as $v) {
        $taxable += floatval($v['purchase_taxable'] ?? 0);
        $total_CGST += floatval($v['purchase_cgst'] ?? 0);
        $total_SGST += floatval($v['purchase_sgst'] ?? 0);
        $total_totaled += floatval($v['purchase_total'] ?? 0);
    }
}
?>

<div class="ss-card" style="margin-bottom: 24px;">
    <!-- Action Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0;">
        <div>
            <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">
                <i class="fa fa-receipt text-primary"></i> Supplier GSTIN-Wise Summary Records
            </h4>
            <span style="font-size: 13px; color: #64748b;">
                Showing supplier GST purchases from <?= $start ?> to <?= $end ?>
            </span>
        </div>
    </div>

    <!-- Main Table -->
    <div class="table-responsive">
        <table class="ss-modern-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">#</th>
                    <th>Supplier Name</th>
                    <th>Supplier GSTIN</th>
                    <th>Purchase Date</th>
                    <th style="text-align: right;">Taxable Amount</th>
                    <th style="text-align: right;">CGST</th>
                    <th style="text-align: right;">SGST</th>
                    <th style="text-align: right;">Total Net</th>
                    <th style="text-align: center; width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customer_data)) { ?>
                    <?php foreach ($customer_data as $key => $value) { 
                        $val_taxable = floatval($value['purchase_taxable'] ?? 0);
                        $val_cgst = floatval($value['purchase_cgst'] ?? 0);
                        $val_sgst = floatval($value['purchase_sgst'] ?? 0);
                        $val_tot = floatval($value['purchase_total'] ?? 0);
                    ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td style="font-weight: 600; color: #0f172a;">
                                <?= htmlspecialchars($value['supplier_name'] ?? 'Supplier') ?>
                            </td>
                            <td style="font-family: monospace; font-size: 12px; color: #475569;">
                                <?= !empty($value['supplier_gst']) ? '<span class="ss-badge ss-badge-info">' . htmlspecialchars($value['supplier_gst']) . '</span>' : '<span style="color:#94a3b8;">N/A</span>' ?>
                            </td>
                            <td style="white-space: nowrap;"><?= date('d M Y', strtotime($value['purchase_date'])) ?></td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($val_taxable, 2) ?></td>
                            <td style="text-align: right; color: #6366f1; font-weight: 600;">₹<?= number_format($val_cgst, 2) ?></td>
                            <td style="text-align: right; color: #06b6d4; font-weight: 600;">₹<?= number_format($val_sgst, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #0f172a;">₹<?= number_format($val_tot, 2) ?></td>
                            <td style="text-align: center;">
                                <a href="<?= console_url('purchase/report_gstin_wise_export'); ?>?gst=<?= $value['supplier_gst'] ?>&start=<?= $start ?>&end=<?= $end ?>" class="ss-btn ss-btn-secondary" style="font-size: 11px; padding: 4px 8px; text-decoration: none;" title="Export Supplier Data">
                                    <i class="fa fa-download"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 40px; color: #94a3b8;">
                            <i class="fa fa-info-circle" style="font-size: 28px; margin-bottom: 8px;"></i>
                            <p style="margin: 0; font-size: 14px;">No GSTIN purchase records found for the chosen filters.</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <?php if (!empty($customer_data)) { ?>
                <tfoot>
                    <tr style="background: #f8fafc; font-weight: 700; border-top: 2px solid #cbd5e1;">
                        <td colspan="4" style="text-align: right; padding-right: 16px; font-size: 14px;">Total Summary:</td>
                        <td style="text-align: right; font-size: 14px;">₹<?= number_format($taxable, 2) ?></td>
                        <td style="text-align: right; font-size: 14px; color: #6366f1;">₹<?= number_format($total_CGST, 2) ?></td>
                        <td style="text-align: right; font-size: 14px; color: #06b6d4;">₹<?= number_format($total_SGST, 2) ?></td>
                        <td style="text-align: right; font-size: 15px; color: #059669;">₹<?= number_format($total_totaled, 2) ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            <?php } ?>
        </table>
    </div>
</div>

<!-- Secondary Tax Breakdown Cards -->
<div class="row">
    <!-- Purchase Tax Slab Breakdown -->
    <div class="col-md-6 mb-4">
        <div class="ss-card" style="height: 100%;">
            <div class="ss-card-header" style="background: #fff; border-bottom: 1px solid #e2e8f0; padding: 14px 18px;">
                <h5 style="margin: 0; font-size: 15px; font-weight: 700; color: #0f172a;">
                    <i class="fa fa-percentage text-primary"></i> Input Tax Slab Reconciliations
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_p_cgst = 0;
                        $total_p_sgst = 0;
                        if (!empty($daily_gst_data)) {
                            foreach ($daily_gst_data as $val) {
                                $cg = floatval($val['purchase_cgst'] ?? 0);
                                $sg = floatval($val['purchase_sgst'] ?? $val['purchase_cgst'] ?? 0);
                                $total_p_cgst += $cg;
                                $total_p_sgst += $sg;
                        ?>
                            <tr>
                                <td><span class="ss-badge ss-badge-info"><?= $val['purchase_cgst_percent'] ?>%</span></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($cg, 2) ?></td>
                                <td><span class="ss-badge ss-badge-info"><?= $val['purchase_sgst_percent'] ?? $val['purchase_cgst_percent'] ?>%</span></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($sg, 2) ?></td>
                            </tr>
                        <?php } } else { ?>
                            <tr><td colspan="4" style="text-align: center; color: #94a3b8;">No input tax slab data available</td></tr>
                        <?php } ?>
                    </tbody>
                    <?php if (!empty($daily_gst_data)) { ?>
                        <tfoot>
                            <tr style="background: #f8fafc; font-weight: 700;">
                                <td>Total</td>
                                <td style="text-align: right; color: #6366f1;">₹<?= number_format($total_p_cgst, 2) ?></td>
                                <td>Total</td>
                                <td style="text-align: right; color: #06b6d4;">₹<?= number_format($total_p_sgst, 2) ?></td>
                            </tr>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <!-- HSN Code Breakdown -->
    <div class="col-md-6 mb-4">
        <div class="ss-card" style="height: 100%;">
            <div class="ss-card-header" style="background: #fff; border-bottom: 1px solid #e2e8f0; padding: 14px 18px;">
                <h5 style="margin: 0; font-size: 15px; font-weight: 700; color: #0f172a;">
                    <i class="fa fa-barcode text-primary"></i> HSN Code Input Tax Breakdown
                </h5>
            </div>
            <div class="table-responsive">
                <table class="ss-modern-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>HSN Code</th>
                            <th style="text-align: right;">Total Input CGST</th>
                            <th style="text-align: right;">Total Input SGST</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_h_c = 0;
                        $total_h_s = 0;
                        if (!empty($hsn_daily_gst_data)) {
                            foreach ($hsn_daily_gst_data as $val) {
                                $cg = floatval($val['purchase_cgst'] ?? 0);
                                $sg = floatval($val['purchase_sgst'] ?? $val['purchase_cgst'] ?? 0);
                                $total_h_c += $cg;
                                $total_h_s += $sg;
                        ?>
                            <tr>
                                <td>
                                    <span class="ss-badge ss-badge-secondary" style="font-family: monospace;">
                                        <?= htmlspecialchars($val['medicine_hsn'] ?? 'N/A') ?>
                                    </span>
                                </td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($cg, 2) ?></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($sg, 2) ?></td>
                            </tr>
                        <?php } } else { ?>
                            <tr><td colspan="3" style="text-align: center; color: #94a3b8;">No HSN breakdown available</td></tr>
                        <?php } ?>
                    </tbody>
                    <?php if (!empty($hsn_daily_gst_data)) { ?>
                        <tfoot>
                            <tr style="background: #f8fafc; font-weight: 700;">
                                <td>Total</td>
                                <td style="text-align: right; color: #6366f1;">₹<?= number_format($total_h_c, 2) ?></td>
                                <td style="text-align: right; color: #06b6d4;">₹<?= number_format($total_h_s, 2) ?></td>
                            </tr>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
