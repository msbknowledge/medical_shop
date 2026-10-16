<?php
// Stock Sales AJAX Statement Result - Smart School UI Upgrade
?>
<div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 12px;">
    <table class="table ss-modern-table" style="margin-bottom: 0;">
        <thead>
            <tr>
                <th style="width: 60px; text-align: center;">SL NO.</th>
                <th>MEDICINE</th>
                <th>MANUFACTURER</th>
                <th>BATCH</th>
                <th style="text-align: center;">OPENING STOCK</th>
                <th style="text-align: right;">MRP (₹)</th>
                <th style="text-align: right;">TOTAL (₹)</th>
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
                    <td style="font-family: monospace; font-weight: 600;"><?= htmlspecialchars($value['purchase_batch']) ?></td>
                    <td style="text-align: center; font-weight: 700; color: var(--ss-primary);"><?= htmlspecialchars($value['left_strip']) ?></td>
                    <td style="text-align: right;"><?= htmlspecialchars($value['purchase_mrp']) ?></td>
                    <td style="text-align: right; font-weight: 700; color: var(--ss-success);"><?= htmlspecialchars($value['purchase_total']) ?></td>
                </tr>
            <?php 
                endforeach;
            else:
            ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px; color: var(--ss-text-muted);">
                        No statement records found for the selected period.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
