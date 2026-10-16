<?php if (!empty($medicine['medicine_name'])) { ?>
<div style="background: #ffffff; border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px 16px; margin-bottom: 12px; box-shadow: var(--ss-shadow-xs);">
    <div style="font-size: 14px; font-weight: 700; color: var(--ss-primary); margin-bottom: 8px;">
        <i class="fa fa-medkit"></i> <?= htmlspecialchars($medicine['medicine_name']) ?>
    </div>
    <div style="display: flex; gap: 20px; flex-wrap: wrap; font-size: 12px;">
        <div><span style="color: var(--ss-text-muted);">Mfg By:</span> <b><?= htmlspecialchars($medicine['medicine_manufacturer'] ?? '-') ?></b></div>
        <div><span style="color: var(--ss-text-muted);">Unit:</span> <b><?= htmlspecialchars($medicine['medicine_unit'] ?? '-') ?></b></div>
        <div><span style="color: var(--ss-text-muted);">Stock Strip:</span> <b style="color: var(--ss-success);"><?= htmlspecialchars($stock['left_strip'] ?? '0') ?></b></div>
        <div><span style="color: var(--ss-text-muted);">Stock Loose:</span> <b><?= htmlspecialchars($stock['left_loose'] ?? '0') ?></b></div>
        <div><span style="color: var(--ss-text-muted);">Storage:</span> <b><?= htmlspecialchars($medicine['medicine_storage'] ?? '-') ?></b></div>
    </div>
</div>
<?php } ?>
