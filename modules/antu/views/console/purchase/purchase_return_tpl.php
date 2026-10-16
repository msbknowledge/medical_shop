<?php
// Purchase Return Template - Smart School UI Upgrade
?>
<style>
    .pos-section-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--ss-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .pos-input {
        border-radius: 8px !important;
        border: 1px solid var(--ss-border) !important;
        font-size: 13px !important;
        padding: 6px 12px !important;
        height: 38px !important;
        box-sizing: border-box !important;
        width: 100% !important;
    }
    .pos-input:focus {
        border-color: var(--ss-primary) !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
    }
    .returnTable {
        width: 100%;
        margin-bottom: 0;
    }
    .returnTable th {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 10px 6px;
        text-align: center;
        background: #f8fafc;
        border-bottom: 2px solid var(--ss-border);
        white-space: nowrap;
    }
    .returnTable td {
        padding: 6px 4px;
        vertical-align: middle;
        text-align: center;
        font-size: 12px;
        border-bottom: 1px solid var(--ss-border);
    }
    .rowline input {
        border-radius: 6px;
        border: 1px solid var(--ss-border);
        padding: 4px 6px;
        font-size: 12px;
        text-align: center;
    }
    .rowline input:focus {
        border-color: var(--ss-primary);
        outline: none;
    }
</style>

<?php if (isset($status)): ?>
    <div class="alert alert-<?= $status ?>" style="border-radius: 8px; margin-bottom: 20px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="">
    <input type="hidden" name="invoice_number" value="<?= $data[0]['purchase_invoice'] ?>">

    <!-- Top Card: Supplier & Invoice Details -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-undo" style="color: var(--ss-danger);"></i> Process Purchase Return
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto; display: flex; gap: 12px; align-items: center;">
                <div style="background: rgba(99, 102, 241, 0.08); padding: 6px 14px; border-radius: 9999px; border: 1px solid rgba(99, 102, 241, 0.2); font-size: 13px; font-weight: 700; color: var(--ss-primary);">
                    Invoice: <input readonly="readonly" value="<?= $data[0]['purchase_invoice'] ?>" required="required" type="text" autocomplete="off" name="purchase_invoice" style="background: transparent; border: none; font-weight: 800; color: var(--ss-primary); width: 140px;" />
                </div>
                <div style="background: var(--ss-bg); padding: 6px 14px; border-radius: 9999px; border: 1px solid var(--ss-border); font-size: 12px; font-weight: 600; color: var(--ss-text-muted);">
                    Return Date: <input type="text" value="<?= date('m/d/Y', strtotime($data[0]['purchase_date'])) ?>" required="required" autocomplete="off" name="purchase_return_date" style="background: transparent; border: none; font-weight: 600; width: 110px; color: var(--ss-text-main);" />
                    <input type="hidden" value="<?= date('m/d/Y', strtotime($data[0]['purchase_date'])) ?>" name="purchase_date" />
                </div>
            </div>
        </div>

        <div style="padding: 20px;">
            <div class="pos-section-title">
                <i class="fa fa-building-o"></i> Supplier Information
            </div>
            <div class="row-fluid" style="display: flex; gap: 14px; flex-wrap: wrap;">
                <div style="flex: 1.5; min-width: 190px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Supplier Name</label>
                    <input readonly="readonly" required="required" value="<?= $data[0]['supplier_name'] ?>" type="text" autocomplete="off" name="supplier_name" class="pos-input" style="font-weight: 600; background: #f8fafc;" />
                </div>
                <div style="flex: 1.2; min-width: 170px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Contact Number</label>
                    <input readonly="readonly" value="<?= $data[0]['supplier_contact'] ?>" required="required" type="text" autocomplete="off" name="supplier_contact" class="pos-input" style="background: #f8fafc;" />
                </div>
                <div style="flex: 1.2; min-width: 160px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Supplier GSTIN</label>
                    <input readonly="readonly" type="text" value="<?= $data[0]['supplier_gst'] ?>" required="required" autocomplete="off" name="supplier_gst" class="pos-input" style="background: #f8fafc;" />
                </div>
                <div style="flex: 2; min-width: 220px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Address</label>
                    <input readonly="readonly" required="required" value="<?= $data[0]['supplier_address'] ?>" type="text" autocomplete="off" name="supplier_address" class="pos-input" style="background: #f8fafc;" />
                </div>
            </div>
        </div>
    </div>

    <!-- Items to be Returned -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-cubes"></i> Items Available for Return
            </div>
        </div>

        <div style="padding: 10px 15px 15px 15px;">
            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 10px;">
                <table class="table returnTable">
                    <thead>
                        <tr>
                            <th style="width: 45px;">Sr</th>
                            <th style="min-width: 180px;">Product Name</th>
                            <th style="width: 60px;">HSN</th>
                            <th style="width: 80px;">Mfg</th>
                            <th style="width: 50px;">Qty</th>
                            <th style="width: 45px;">Free</th>
                            <th style="width: 45px;">Unit</th>
                            <th style="width: 85px;">Batch</th>
                            <th style="width: 65px;">Exp (MM/YY)</th>
                            <th style="width: 55px;">MRP</th>
                            <th style="width: 55px;">Rate</th>
                            <th style="width: 35px;">Disc %</th>
                            <th style="width: 55px;">Taxable</th>
                            <th style="width: 35px;">CGST %</th>
                            <th style="width: 50px;">CGST</th>
                            <th style="width: 35px;">SGST %</th>
                            <th style="width: 50px;">SGST</th>
                            <th style="width: 65px;">Total</th>
                        </tr>
                    </thead>
                    <tbody class="appendHere">
                        <?php
                        $counter = 0;
                        foreach ($data as $k => $value) {
                            if ($value['purchase_return'] == true || $value['purchase_quantity'] < 1) {
                                continue;
                            }
                            $counter++;
                        ?>
                            <tr class="rowline">
                                <td>
                                    <span style="font-weight: 700; color: var(--ss-text-muted);"><?= $counter ?></span>
                                    <a href="javascript:void(0)" onclick="removeRow(this);" style="color: var(--ss-danger); margin-left: 4px;"> <i class="fa fa-minus-circle"></i> </a>
                                </td>
                                <td>
                                    <input type="hidden" value="false" name="purchase_returned[]">
                                    <input required="required" readonly="readonly" type="text" value="<?= $value['medicine_name'] ?>" name="medicine_name[]" style="width: 160px; font-weight: 600; background: #f8fafc;">
                                </td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['medicine_hsn'] ?>" name="medicine_hsn[]" style="width: 50px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['medicine_manufacturer'] ?>" name="medicine_manufacturer[]" style="width: 75px; background: #f8fafc;"></td>
                                <td><input required="required" type="text" value="<?= $value['purchase_quantity'] ?>" name="purchase_quantity[]" onkeyup="gst_calculation(this)" style="width: 40px; font-weight: 600;"></td>
                                <td><input required="required" type="text" value="<?= $value['purchase_free_quantity'] ?>" name="purchase_free_quantity[]" style="width: 35px;"></td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['purchase_unit'] ?>" name="purchase_unit[]" style="width: 35px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['purchase_batch'] ?>" name="purchase_batch[]" style="width: 80px; font-family: monospace; background: #f8fafc;"></td>
                                <td>
                                    <input required="required" readonly="readonly" type="text" value="<?= $value['purchase_expire_month'] ?>" name="purchase_expire_month[]" style="width: 22px; margin: 0; padding: 2px; float: left; background: #f8fafc;">
                                    <span style="margin: 0; padding: 2px; float: left;">/</span>
                                    <input required="required" readonly="readonly" value="<?= $value['purchase_expire_year'] ?>" type="text" name="purchase_expire_year[]" style="width: 22px; margin: 0; padding: 2px; float: left; background: #f8fafc;">
                                </td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_mrp'] ?>" type="text" name="purchase_mrp[]" style="width: 50px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_rate'] ?>" type="text" name="purchase_rate[]" onkeyup="gst_calculation(this)" style="width: 50px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_discount_percent'] ?>" type="text" name="purchase_discount_percent[]" onkeyup="gst_calculation(this)" style="width: 30px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_taxable'] ?>" type="text" name="purchase_taxable[]" style="width: 50px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_cgst_percent'] ?>" type="text" name="purchase_cgst_percent[]" onkeyup="gst_calculation(this)" style="width: 30px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_cgst'] ?>" type="text" name="purchase_cgst[]" style="width: 48px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_sgst_percent'] ?>" type="text" name="purchase_sgst_percent[]" onkeyup="gst_calculation(this)" style="width: 30px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_sgst'] ?>" type="text" name="purchase_sgst[]" style="width: 48px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" value="<?= $value['purchase_total'] ?>" type="text" name="purchase_total[]" style="width: 60px; font-weight: 700; color: var(--ss-success); background: #f8fafc;"></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Settlement Card -->
    <div class="ss-card" style="margin-bottom: 25px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-calculator"></i> Return Valuation Summary
            </div>
        </div>

        <div style="padding: 20px;">
            <div class="row-fluid" style="display: flex; gap: 16px; margin-bottom: 20px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 140px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Total Items</div>
                    <div class="totalItem" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0</div>
                </div>
                <div style="flex: 1; min-width: 140px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">CGST Total</div>
                    <div class="totalCgst" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0</div>
                </div>
                <div style="flex: 1; min-width: 140px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">SGST Total</div>
                    <div class="totalSgst" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0</div>
                </div>
                <div style="flex: 1; min-width: 140px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Total GST</div>
                    <div class="totalgst" style="font-size: 18px; font-weight: 800; color: var(--ss-primary); margin-top: 4px;">0</div>
                </div>
                <div style="flex: 1.5; min-width: 180px; background: rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.25); border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-danger); text-transform: uppercase;">Return Total</div>
                    <div class="totalAmount" style="font-size: 22px; font-weight: 800; color: var(--ss-danger); margin-top: 4px;">0.00</div>
                </div>
            </div>

            <!-- Returned Items Previously Processed -->
            <div style="margin-top: 25px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <h5 style="font-size: 13px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase; margin: 0;">
                        <i class="fa fa-history"></i> Already Returned Items
                    </h5>
                    <a href="javascript:void(0)" onclick="removeRowReturn();" class="btn btn-xs ss-btn-secondary" style="border-radius: 9999px;">
                        <i class="fa fa-trash"></i> Remove All Return
                    </a>
                </div>
                <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 10px;">
                    <table class="table returnTable">
                        <thead>
                            <tr>
                                <th style="width: 45px;">Sr</th>
                                <th>Product Name</th>
                                <th>HSN</th>
                                <th>Manufacturer</th>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: center;">Free Qty</th>
                                <th>Unit</th>
                                <th>Batch</th>
                                <th style="text-align: center;">Exp</th>
                                <th style="text-align: right;">MRP</th>
                                <th style="text-align: right;">Rate</th>
                                <th style="text-align: center;">Disc %</th>
                                <th style="text-align: right;">Taxable</th>
                                <th style="text-align: center;">CGST %</th>
                                <th style="text-align: right;">CGST</th>
                                <th style="text-align: center;">SGST %</th>
                                <th style="text-align: right;">SGST</th>
                                <th style="text-align: right;">Total</th>
                            </tr>
                        </thead>
                        <tbody class="appendHereReturn">
                            <?php
                            $counter = 0;
                            foreach ($data as $k => $value) {
                                if ($value['purchase_return'] == false) {
                                    continue;
                                }
                                $counter++;
                            ?>
                                <tr class="rowlineReturn">
                                    <td style="text-align: center; font-weight: 600; color: var(--ss-text-muted);">
                                        <span><?= $counter ?></span>
                                        <a href="javascript:void(0)" onclick="removeRow(this);" style="color: var(--ss-danger); margin-left: 4px;"> <i class="fa fa-minus-circle"></i> </a>
                                    </td>
                                    <td>
                                        <input type="hidden" value="true" name="purchase_returned[]">
                                        <input required="required" readonly="readonly" type="text" value="<?= $value['medicine_name'] ?>" name="medicine_name[]" style="width: 160px; font-weight: 600; background: #f8fafc;">
                                    </td>
                                    <td><input required="required" readonly="readonly" type="text" value="<?= $value['medicine_hsn'] ?>" name="medicine_hsn[]" style="width: 50px; background: #f8fafc;"></td>
                                    <td><input required="required" readonly="readonly" type="text" value="<?= $value['medicine_manufacturer'] ?>" name="medicine_manufacturer[]" style="width: 75px; background: #f8fafc;"></td>
                                    <td style="text-align: center; font-weight: 600; color: var(--ss-danger);"><?= $value['purchase_quantity'] ?></td>
                                    <td style="text-align: center;"><?= $value['purchase_free_quantity'] ?></td>
                                    <td style="text-align: center;"><?= $value['purchase_unit'] ?></td>
                                    <td style="font-family: monospace;"><?= $value['purchase_batch'] ?></td>
                                    <td style="text-align: center;"><?= $value['purchase_expire_month'] ?>/<?= $value['purchase_expire_year'] ?></td>
                                    <td style="text-align: right;"><?= $value['purchase_mrp'] ?></td>
                                    <td style="text-align: right;"><?= $value['purchase_rate'] ?></td>
                                    <td style="text-align: center;"><?= $value['purchase_discount_percent'] ?></td>
                                    <td style="text-align: right;"><?= $value['purchase_taxable'] ?></td>
                                    <td style="text-align: center;"><?= $value['purchase_cgst_percent'] ?></td>
                                    <td style="text-align: right;"><?= $value['purchase_cgst'] ?></td>
                                    <td style="text-align: center;"><?= $value['purchase_sgst_percent'] ?></td>
                                    <td style="text-align: right;"><?= $value['purchase_sgst'] ?></td>
                                    <td style="text-align: right; font-weight: 700; color: var(--ss-danger);"><?= $value['purchase_total'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: 25px; padding-top: 18px; border-top: 1px solid var(--ss-border);">
                <button type="button" class="btn ss-btn-secondary" onclick="goBack()" style="border-radius: 9999px; padding: 10px 24px; font-weight: 600;">
                    Cancel
                </button>
                <button type="submit" class="btn ss-btn-primary" style="border-radius: 9999px; padding: 10px 32px; font-weight: 700; font-size: 14px;">
                    <i class="fa fa-undo"></i> Save Purchase Return
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        calculateTotal();
    }

    function removeRowReturn() {
        $('.rowlineReturn').remove();
        calculateTotal();
    }

    function gst_calculation(targetObject) {
        var cgst = parseFloat($(targetObject).parent().parent().find('[name^="purchase_cgst_percent[]"]').val()) || 0;
        $(targetObject).parent().parent().find('[name^="purchase_sgst_percent[]"]').val(cgst);
        var sgst = parseFloat($(targetObject).parent().parent().find('[name^="purchase_sgst_percent[]"]').val()) || 0;
        var rate = parseFloat($(targetObject).parent().parent().find('[name^="purchase_rate[]"]').val()) || 0;
        var qty = parseFloat($(targetObject).parent().parent().find('[name^="purchase_quantity[]"]').val()) || 0;
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="purchase_discount_percent[]"]').val()) || 0;
        var total = (rate * qty);

        var total_discount = (total * discount_percent / 100);
        var taxable_cost = (total - total_discount);
        var total_cgst = (taxable_cost * cgst / 100);
        var total_sgst = (taxable_cost * sgst / 100);
        var grandtotal = total_sgst + total_cgst + taxable_cost;

        $(targetObject).parent().parent().find('[name^="purchase_taxable[]"]').val(taxable_cost.toFixed(2));
        $(targetObject).parent().parent().find('[name^="purchase_cgst[]"]').val(total_cgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="purchase_sgst[]"]').val(total_sgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="purchase_total[]"]').val(grandtotal.toFixed(2));

        calculateTotal();
    }

    function calculateTotal() {
        var totalItem = $('.rowline').length;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;

        $('.rowline').each(function () {
            totalCgst += parseFloat($(this).find('[name="purchase_cgst[]"]').val()) || 0;
            totalSgst += parseFloat($(this).find('[name="purchase_sgst[]"]').val()) || 0;
            totalTotal += parseFloat($(this).find('[name="purchase_total[]"]').val()) || 0;
        });

        $('.totalItem').html(totalItem);
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
    }

    $(document).ready(function () {
        calculateTotal();
    });
</script>