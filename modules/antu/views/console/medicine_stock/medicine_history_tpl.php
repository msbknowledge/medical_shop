<?php
// Medicine History - Smart School UI Upgrade
?>
<div class="index-wrapper">
    <div class="ss-card">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-history" style="color: var(--ss-primary);"></i> Medicine Purchase & Sale History
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <span class="ss-badge ss-badge-primary" style="font-size: 12px; padding: 5px 12px;">
                    <i class="fa fa-search"></i> Interactive Audit Trail
                </span>
            </div>
        </div>

        <div style="padding: 20px;">
            <?php if (isset($status)): ?>
                <div class="alert alert-<?= $status ?>" style="border-radius: 8px;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="medicine_chooser" style="background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 12px; padding: 20px; margin-bottom: 25px;">
                    <h5 style="font-size: 13px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase; margin-top: 0; margin-bottom: 16px;">
                        <i class="fa fa-medkit"></i> Choose Medicine
                    </h5>
                    <div class="row-fluid" style="display: flex; gap: 14px; flex-wrap: wrap;">
                        <div style="flex: 2; min-width: 220px;">
                            <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 6px; display: block;">Medicine Name *</label>
                            <input type="text" name="medicine_name" required="required" placeholder="Type to search medicine..." class="form-control" style="width: 100%; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px; font-weight: 600;" />
                        </div>
                        <div style="flex: 1.5; min-width: 180px;">
                            <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 6px; display: block;">Manufacturer</label>
                            <input type="text" name="medicine_manufacturer" readonly class="form-control" style="width: 100%; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px; background: #fff;" />
                        </div>
                        <div style="flex: 1; min-width: 140px;">
                            <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 6px; display: block;">Category</label>
                            <input type="text" name="medicine_category" readonly class="form-control" style="width: 100%; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px; background: #fff;" />
                        </div>
                        <div style="flex: 1; min-width: 110px;">
                            <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 6px; display: block;">HSN</label>
                            <input type="text" name="medicine_hsn" readonly class="form-control" style="width: 100%; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px; background: #fff;" />
                        </div>
                        <div style="flex: 1; min-width: 110px;">
                            <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 6px; display: block;">Unit</label>
                            <input type="text" name="medicine_unit" readonly class="form-control" style="width: 100%; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px; background: #fff;" />
                        </div>
                        <div style="flex: 1; min-width: 140px;">
                            <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 6px; display: block;">Storage</label>
                            <input type="text" name="medicine_storage" readonly class="form-control" style="width: 100%; border-radius: 8px; border: 1px solid var(--ss-border); height: 40px; background: #fff;" />
                        </div>
                        <input type="hidden" readonly="true" name="medicine_id" />
                    </div>
                </div>

                <div class="form-actions" style="background: transparent; border: none; padding: 0; margin: 0;">
                    <div style="text-align: center; padding: 40px; color: var(--ss-text-muted); border: 1px dashed var(--ss-border); border-radius: 12px;">
                        <i class="fa fa-history fa-2x" style="opacity: 0.5;"></i>
                        <p style="margin-top: 10px; font-weight: 600;">Type and select a medicine above to load its complete purchase and sale history.</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).find('[name^="medicine_name"]').autocomplete({
            source: '/search.php?table=medicines&fieldToSearch=medicine_name',
            search: function(event, ui) {
                $('.medicine_chooser').find('input').not('[name^="medicine_name"]').val('');
            },
            minLength: 1,
            select: function(event, ui) {
                var targetRow = $(this).parents('.medicine_chooser');
                $.each(ui.item.complete, function(populate_field, populate_value) {
                    $(targetRow).find('[name^="' + populate_field + '"]').val(populate_value);
                });
                $('.form-actions').html("<div style='text-align:center; padding:30px; color:var(--ss-primary); font-weight:600;'><i class='fa fa-spinner fa-spin fa-2x'></i><br><br>Loading history records...</div>");
                $.get('/purchase_sale_medicine_search.php?table_purchase=purchases&table_sale=sales&table_medicine_stock=medicine_stocks&table_return_sale=returns_sales&table_return_purchase=return_purchases', {
                    term: $(document).find('[name^="medicine_id"]').val()
                }, function(resp) {
                    $('.form-actions').html(resp);
                });
            }
        });
    });
</script>