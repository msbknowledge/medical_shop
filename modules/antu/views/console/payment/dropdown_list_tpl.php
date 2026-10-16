<table class="table table-bordered table-striped ss-modern-table" style="margin-top: 10px;">
    <thead>
        <tr>
            <th style="width: 40px; text-align: center;">Choose</th>
            <th>Invoice Number</th>
            <th>Invoice Entry Number</th>
            <th>Date</th>
            <th style="text-align: right;">Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $key => $value): ?>
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="checkbox" value="<?= isset($value['purchase_invoice']) ? html_escape($value['purchase_invoice']) : '' ?>">
                    </td>
                    <td style="font-weight: 600;"><?= isset($value['purchase_invoice']) ? html_escape($value['purchase_invoice']) : '' ?></td>
                    <td><?= isset($value['purchase_entry_number']) ? html_escape($value['purchase_entry_number']) : '' ?></td>
                    <td><?= isset($value['purchase_date']) ? date('d/m/Y', strtotime($value['purchase_date'])) : '' ?></td>
                    <td style="text-align: right; font-weight: 700; color: var(--ss-primary, #6366f1);"><?= isset($value['total']) ? round($value['total'], 2) : '0.00' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; color: var(--ss-text-muted, #94a3b8); padding: 16px;">No entries available</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
