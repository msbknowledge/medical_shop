<?php
// Choose Return Invoice Template - Smart School UI Upgrade
?>
<div style="padding: 10px 0;">
    <div style="background: #ffffff; border: 1px solid var(--ss-border); border-radius: 12px; padding: 16px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
        <div>
            <span class="ss-badge ss-badge-primary" style="font-size: 13px; font-weight: 700; margin-bottom: 6px;">
                <i class="fa fa-file-text-o"></i> Invoice: <?= htmlspecialchars($data[0]['sale_invoice']) ?>
            </span>
            <div style="font-size: 15px; font-weight: 700; color: var(--ss-text-main); margin-top: 4px;">
                Customer: <?= htmlspecialchars($data[0]['customer_name']) ?>
            </div>
            <div style="font-size: 12px; color: var(--ss-text-muted);">
                <i class="fa fa-map-marker"></i> <?= htmlspecialchars($data[0]['customer_address'] ?? 'N/A') ?>
            </div>
        </div>
        <div style="text-align: right; font-size: 12.5px;">
            <div><span style="color: var(--ss-text-muted);">Date:</span> <b><?= date('d-M-Y', strtotime($data[0]['sale_date'])) ?></b></div>
            <div><span style="color: var(--ss-text-muted);">Contact:</span> <b><?= htmlspecialchars($data[0]['customer_contact'] ?? 'N/A') ?></b></div>
            <div><span style="color: var(--ss-text-muted);">GSTIN:</span> <b><?= htmlspecialchars($data[0]['customer_gst'] ?? 'N/A') ?></b></div>
        </div>
    </div>

    <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 12px;">
        <table class="table ss-modern-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">Sr</th>
                    <th style="width: 60px; text-align: center;">Choose</th>
                    <th>Product Name & Manufacturer</th>
                    <th style="text-align: center;">Loose Qty</th>
                    <th>Batch</th>
                    <th style="text-align: center;">Expiry</th>
                    <th style="text-align: right;">MRP (₹)</th>
                    <th style="text-align: right;">Billed Total (₹)</th>
                    <th style="width: 110px; text-align: center;">Return Qty</th>
                </tr>
            </thead>
            <tbody class="appendHere">
                <?php
                $counter = 0;
                $total = 0;
                foreach ($data as $k => $value) {
                    $total += (float)$value['sale_total'];
                ?>    
                    <tr class="rowline">
                        <td style="text-align: center; font-weight: 600; color: var(--ss-text-muted);"><?= ++$counter; ?></td>
                        <td style="text-align: center;">
                            <input type="checkbox" name="return_sale_ID[][<?= $value['sale_ID'] ?>]" style="width: 18px; height: 18px; accent-color: var(--ss-primary); cursor: pointer;" />
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--ss-text-main);"><?= htmlspecialchars($value['medicine_name']) ?></div>
                            <div style="font-size: 11.5px; color: var(--ss-text-muted);">Mfg: <?= htmlspecialchars($value['medicine_manufacturer'] ?? '-') ?></div>
                        </td>
                        <td style="text-align: center; font-weight: 600;"><?= htmlspecialchars($value['sale_loose_quantity']) ?></td>
                        <td style="font-family: monospace; font-weight: 600;"><?= htmlspecialchars($value['sale_batch']) ?></td>
                        <td style="text-align: center;">
                            <span class="ss-badge ss-badge-warning"><?= htmlspecialchars($value['sale_expire_month']) ?>/<?= htmlspecialchars($value['sale_expire_year']) ?></span>
                        </td>
                        <td style="text-align: right;"><?= htmlspecialchars($value['sale_mrp']) ?></td>
                        <td style="text-align: right; font-weight: 700; color: var(--ss-success);"><?= htmlspecialchars($value['sale_total']) ?></td>
                        <td style="text-align: center;">
                            <?php if ($value['sale_strip_quantity'] > 0) { ?>
                                <input name="return_qty" type="number" max="<?= $value['sale_strip_quantity'] ?>" min="0" value="<?= $value['sale_strip_quantity'] ?>" class="form-control" style="width: 75px; text-align: center; border-radius: 6px; padding: 4px; height: 32px; display: inline-block;" />
                            <?php } else { echo "-"; } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>