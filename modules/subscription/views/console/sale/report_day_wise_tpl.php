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
        $total_totaled += floatval(($v['sale_total'] ?? 0) - ($v['sale_grand_discount'] ?? 0));
    }
}
?>

<div class="ss-card" style="margin-bottom: 24px;">
    <!-- Action Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0;">
        <div>
            <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #0f172a;">
                <i class="fa fa-list-alt text-primary"></i> Daily Sales GST Records
            </h4>
            <span style="font-size: 13px; color: #64748b;">
                Showing <?= !empty($customer_data) ? count($customer_data) : 0 ?> invoices from <?= $start ?> to <?= $end ?>
            </span>
        </div>
        <div>
            <a href="<?= console_url('sale/report_daily_wise_export'); ?>?start=<?= $start ?>&end=<?= $end ?>" class="ss-btn ss-btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                <i class="fa fa-file-excel"></i> Export to Excel
            </a>
        </div>
    </div>

    <!-- Main Table -->
    <div class="table-responsive">
        <table class="ss-modern-table" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">#</th>
                    <th>Invoice No</th>
                    <th>Customer Name</th>
                    <th>Mobile</th>
                    <th>GSTIN</th>
                    <th>Date</th>
                    <th style="text-align: right;">Taxable</th>
                    <th style="text-align: right;">CGST</th>
                    <th style="text-align: right;">SGST</th>
                    <th style="text-align: right;">Total Net</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customer_data)) { ?>
                    <?php foreach ($customer_data as $key => $value) { 
                        $val_taxable = floatval($value['sale_taxable'] ?? 0);
                        $val_cgst = floatval($value['sale_cgst'] ?? 0);
                        $val_sgst = floatval($value['sale_sgst'] ?? 0);
                        $val_net = floatval(($value['sale_total'] ?? 0) - ($value['sale_grand_discount'] ?? 0));
                    ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td>
                                <span class="ss-badge ss-badge-primary" style="font-family: monospace; font-size: 12px;">
                                    <?= htmlspecialchars($value['sale_invoice'] ?? '') ?>
                                </span>
                            </td>
                            <td style="font-weight: 600; color: #0f172a;">
                                <?= htmlspecialchars($value['customer_name'] ?? 'Walk-in Customer') ?>
                            </td>
                            <td style="color: #64748b;"><?= htmlspecialchars($value['customer_contact'] ?? '-') ?></td>
                            <td style="font-family: monospace; font-size: 12px; color: #475569;">
                                <?= !empty($value['customer_gst']) ? htmlspecialchars($value['customer_gst']) : '<span style="color:#94a3b8;">N/A</span>' ?>
                            </td>
                            <td style="white-space: nowrap;"><?= date('d M Y', strtotime($value['sale_date'])) ?></td>
                            <td style="text-align: right; font-weight: 600;">₹<?= number_format($val_taxable, 2) ?></td>
                            <td style="text-align: right; color: #6366f1; font-weight: 600;">₹<?= number_format($val_cgst, 2) ?></td>
                            <td style="text-align: right; color: #06b6d4; font-weight: 600;">₹<?= number_format($val_sgst, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #0f172a;">₹<?= number_format($val_net, 2) ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 40px; color: #94a3b8;">
                            <i class="fa fa-info-circle" style="font-size: 28px; margin-bottom: 8px;"></i>
                            <p style="margin: 0; font-size: 14px;">No sale records found matching the given date and customer filter.</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <?php if (!empty($customer_data)) { ?>
                <tfoot>
                    <tr style="background: #f8fafc; font-weight: 700; border-top: 2px solid #cbd5e1;">
                        <td colspan="6" style="text-align: right; padding-right: 16px; font-size: 14px;">Total GST Registers:</td>
                        <td style="text-align: right; font-size: 14px;">₹<?= number_format($taxable, 2) ?></td>
                        <td style="text-align: right; font-size: 14px; color: #6366f1;">₹<?= number_format($total_CGST, 2) ?></td>
                        <td style="text-align: right; font-size: 14px; color: #06b6d4;">₹<?= number_format($total_SGST, 2) ?></td>
                        <td style="text-align: right; font-size: 15px; color: #059669;">₹<?= number_format($total_totaled, 2) ?></td>
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
                    <i class="fa fa-percentage text-primary"></i> GST Tax Slab Breakdown
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
                        $total_slab_cgst = 0;
                        $total_slab_sgst = 0;
                        if (!empty($daily_gst_data)) {
                            foreach ($daily_gst_data as $val) {
                                $cg = floatval($val['sale_cgst'] ?? 0);
                                $sg = floatval($val['sale_sgst'] ?? 0);
                                $total_slab_cgst += $cg;
                                $total_slab_sgst += $sg;
                        ?>
                            <tr>
                                <td><span class="ss-badge ss-badge-info"><?= $val['sale_cgst_percent'] ?>%</span></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($cg, 2) ?></td>
                                <td><span class="ss-badge ss-badge-info"><?= $val['sale_sgst_percent'] ?? $val['sale_cgst_percent'] ?>%</span></td>
                                <td style="text-align: right; font-weight: 600;">₹<?= number_format($sg, 2) ?></td>
                            </tr>
                        <?php } } else { ?>
                            <tr><td colspan="4" style="text-align: center; color: #94a3b8;">No slab data available</td></tr>
                        <?php } ?>
                    </tbody>
                    <?php if (!empty($daily_gst_data)) { ?>
                        <tfoot>
                            <tr style="background: #f8fafc; font-weight: 700;">
                                <td>Total</td>
                                <td style="text-align: right; color: #6366f1;">₹<?= number_format($total_slab_cgst, 2) ?></td>
                                <td>Total</td>
                                <td style="text-align: right; color: #06b6d4;">₹<?= number_format($total_slab_sgst, 2) ?></td>
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
                    <i class="fa fa-barcode text-primary"></i> HSN Code Summary
                </h5>
            </div>
            <div class="table-responsive">
                <table class="ss-modern-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>HSN Code</th>
                            <th style="text-align: right;">Total CGST</th>
                            <th style="text-align: right;">Total SGST</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_hsn_c = 0;
                        $total_hsn_s = 0;
                        if (!empty($hsn_daily_gst_data)) {
                            foreach ($hsn_daily_gst_data as $val) {
                                $cg = floatval($val['sale_cgst'] ?? 0);
                                $sg = floatval($val['sale_sgst'] ?? 0);
                                $total_hsn_c += $cg;
                                $total_hsn_s += $sg;
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
                                <td style="text-align: right; color: #6366f1;">₹<?= number_format($total_hsn_c, 2) ?></td>
                                <td style="text-align: right; color: #06b6d4;">₹<?= number_format($total_hsn_s, 2) ?></td>
                            </tr>
                        </tfoot>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
