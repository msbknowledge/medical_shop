<?php
// Stock AJAX Amount Result - Smart School UI Upgrade
$total_mrp = 0;
if (!empty($data)) {
    foreach ($data as $key => $value) {
        $total_mrp += (float)$value['purchase_total'];
    }
}
?>
<div style="margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(99, 102, 241, 0.08)); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 16px 20px;">
    <div>
        <div style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Stock Valuation Summary</div>
        <div style="font-size: 22px; font-weight: 800; color: var(--ss-success); margin-top: 4px;">
            Total Stock MRP: ₹ <?= number_format(round($total_mrp), 2) ?>
        </div>
    </div>
    <span class="ss-badge ss-badge-success" style="font-size: 13px; padding: 6px 14px;">
        <i class="fa fa-cubes"></i> <?= !empty($data) ? count($data) : 0 ?> Products
    </span>
</div>

<div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 12px;">
    <table class="table ss-modern-table" style="margin-bottom: 0;">
        <thead>
            <tr>
                <th style="width: 60px; text-align: center;">Sl No.</th>
                <th>Medicine Name</th>
                <th>Manufacturer</th>
                <th style="text-align: right;">Unit MRP (₹)</th>
                <th style="text-align: right;">Total Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            if (!empty($data)):
                foreach ($data as $key => $value):
            ?>
                <tr>
                    <td style="text-align: center; font-weight: 600; color: var(--ss-text-muted);"><?= $counter++ ?></td>
                    <td style="font-weight: 600; color: var(--ss-text-main);"><?= htmlspecialchars($value['medicine_name']) ?></td>
                    <td><?= htmlspecialchars($value['medicine_manufacturer'] ?? '-') ?></td>
                    <td style="text-align: right; font-weight: 600;"><?= htmlspecialchars($value['purchase_mrp']) ?></td>
                    <td style="text-align: right; font-weight: 700; color: var(--ss-success);"><?= htmlspecialchars($value['purchase_total']) ?></td>
                </tr>
            <?php 
                endforeach;
            else:
            ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: var(--ss-text-muted);">
                        No medicine stock valuation records found.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
