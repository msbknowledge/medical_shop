<?php if (!empty($data)) { ?>
<div class="ss-card" style="box-shadow: none; border: 1px solid #e2e8f0; margin-top: 10px;">
    <div class="ss-card-header" style="background: #f8fafc; padding: 10px 16px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
        <span style="font-weight: 700; color: #0f172a; font-size: 13px;">
            <i class="fa fa-history text-primary"></i> <?= htmlspecialchars($medicine ?? 'Medicine Purchase History') ?>
        </span>
        <span class="ss-badge ss-badge-primary"><?= count($data) ?> Records</span>
    </div>
    <div class="table-responsive">
        <table class="ss-modern-table" style="width: 100%; font-size: 12px;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Supplier Name</th>
                    <th>Invoice No</th>
                    <th style="text-align: center;">Quantity</th>
                    <th style="text-align: right;">MRP</th>
                    <th style="text-align: right;">Purchase Rate</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $k => $value) { ?>
                    <tr>
                        <td style="white-space: nowrap;"><?= date('d M Y', strtotime($value['purchase_date'])) ?></td>
                        <td style="font-weight: 600; color: #0f172a;"><?= htmlspecialchars($value['supplier_name'] ?? 'Supplier') ?></td>
                        <td><span class="ss-badge ss-badge-secondary" style="font-family: monospace;"><?= htmlspecialchars($value['purchase_invoice'] ?? '') ?></span></td>
                        <td style="text-align: center; font-weight: 600;"><?= $value['purchase_quantity'] ?></td>
                        <td style="text-align: right;">₹<?= number_format(floatval($value['purchase_mrp'] ?? 0), 2) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #059669;">₹<?= number_format(floatval($value['purchase_rate'] ?? 0), 2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>