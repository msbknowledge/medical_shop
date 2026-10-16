<?php
// Zero and Negative Stock List - Smart School UI Upgrade
?>
<div class="index-wrapper">
    <div class="ss-card">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-battery-empty" style="color: var(--ss-danger);"></i> Zero & Negative Stock Records
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <span class="ss-badge ss-badge-danger" style="font-size: 12px; padding: 5px 12px;">
                    <i class="fa fa-info-circle"></i> Out of Stock / Negative Alert
                </span>
            </div>
        </div>

        <div style="padding: 20px;">
            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 12px;">
                <table class="table ss-modern-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">Sl.</th>
                            <th>Medicine Name</th>
                            <th>Batch</th>
                            <th>Manufacturer</th>
                            <th style="text-align: center;">Month</th>
                            <th style="text-align: center;">Year</th>
                            <th style="text-align: center;">Strip Stock</th>
                            <th style="text-align: center;">Loose Stock</th>
                            <th>Storage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count = 1;
                        if (!empty($result)):
                            foreach ($result as $value): 
                        ?>
                            <tr>
                                <td style="text-align: center; font-weight: 600; color: var(--ss-text-muted);"><?= $count++ ?></td>
                                <td style="font-weight: 600; color: var(--ss-text-main);"><?= htmlspecialchars($value['medicine_name']) ?></td>
                                <td style="font-family: monospace; font-weight: 600;"><?= htmlspecialchars($value['medicine_stock_batch']) ?></td>
                                <td><?= htmlspecialchars($value['medicine_manufacturer']) ?></td>
                                <td style="text-align: center;">
                                    <span class="ss-badge ss-badge-warning"><?= date('F', mktime(0, 0, 0, (int)$value['medicine_expire_month'], 10)) ?></span>
                                </td>
                                <td style="text-align: center; font-weight: 600;"><?= htmlspecialchars($value['medicine_expire_year']) ?></td>
                                <td style="text-align: center;">
                                    <span class="ss-badge ss-badge-danger"><?= htmlspecialchars($value['medicine_strip_stock']) ?></span>
                                </td>
                                <td style="text-align: center; font-weight: 600;"><?= htmlspecialchars($value['medicine_loose_stock']) ?></td>
                                <td style="color: var(--ss-text-muted); font-size: 12px;">
                                    <?= !empty($value['medicine_storage']) ? "<i class='fa fa-map-marker'></i> " . htmlspecialchars($value['medicine_storage']) : "-" ?>
                                </td>
                            </tr>
                        <?php 
                            endforeach;
                        else:
                        ?>
                            <tr>
                                <td colspan="9" style="text-align: center; padding: 40px; color: var(--ss-text-muted);">
                                    <i class="fa fa-check-circle fa-2x" style="color: var(--ss-success); opacity: 0.7;"></i>
                                    <p style="margin-top: 10px; font-weight: 600;">No Zero or Negative Stock Medicines Found</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
