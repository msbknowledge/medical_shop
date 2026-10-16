<?php
// POS Edit Sales Invoice Template - Smart School UI Upgrade
?>
<style>
    .pos-billing-card {
        background: #ffffff;
        border: 1px solid var(--ss-border);
        border-radius: 14px;
        box-shadow: var(--ss-shadow-xs);
        margin-bottom: 20px;
    }
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
    #tableData {
        width: 100%;
        margin-bottom: 0;
    }
    #tableData th {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 10px 6px;
        text-align: center;
        background: #f8fafc;
        border-bottom: 2px solid var(--ss-border);
        white-space: nowrap;
    }
    #tableData td {
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
    #discount {
        min-width: 0px;
        max-width: 130px;
        border-radius: 6px;
        border: 1px solid var(--ss-border);
        font-size: 11px;
    }
</style>

<?php if (isset($status)) : ?>
    <div class="alert alert-<?= $status ?>" style="border-radius: 8px; margin-bottom: 20px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="">
    <input type="hidden" name="invoice_number" value="<?= $data[0]['sale_invoice'] ?>">

    <!-- Top Card: Header & Party Info -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-pencil-square-o" style="color: var(--ss-warning);"></i> Edit Sales Invoice
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto; display: flex; gap: 12px; align-items: center;">
                <div style="background: rgba(99, 102, 241, 0.08); padding: 6px 14px; border-radius: 9999px; border: 1px solid rgba(99, 102, 241, 0.2); font-size: 13px; font-weight: 700; color: var(--ss-primary);">
                    Invoice: <input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= $data[0]['sale_invoice'] ?>" name="sale_invoice" style="background: transparent; border: none; font-weight: 800; color: var(--ss-primary); width: 140px;" />
                </div>
                <div style="background: var(--ss-bg); padding: 6px 14px; border-radius: 9999px; border: 1px solid var(--ss-border); font-size: 12px; font-weight: 600; color: var(--ss-text-muted);">
                    Date: <input type="text" required="required" autocomplete="off" name="sale_date" class="form-control" value="<?= date('d-M-Y', strtotime($data[0]['sale_date'])) ?>" style="background: transparent; border: none; font-weight: 600; width: 120px; color: var(--ss-text-main);" />
                </div>
            </div>
        </div>

        <div style="padding: 20px;">
            <div class="pos-section-title">
                <i class="fa fa-user"></i> Customer & Doctor Details
            </div>
            <div class="row-fluid" style="display: flex; gap: 14px; flex-wrap: wrap;">
                <div style="flex: 1.2; min-width: 170px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Contact Number</label>
                    <input required="required" type="text" autocomplete="off" name="customer_contact" value="<?= $data[0]['customer_contact'] ?>" class="pos-input" />
                </div>
                <div style="flex: 1.5; min-width: 190px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Customer Name *</label>
                    <input onchange="calculateTotal()" value="<?= $data[0]['customer_name'] ?>" required="required" type="text" autocomplete="off" name="customer_name" class="pos-input" style="font-weight: 600;" />
                </div>
                <div style="flex: 1.5; min-width: 190px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Address</label>
                    <input type="text" autocomplete="off" name="customer_address" value="<?= $data[0]['customer_address'] ?>" class="pos-input" />
                </div>
                <div style="flex: 1; min-width: 140px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">GSTIN</label>
                    <input type="text" autocomplete="off" name="customer_gst" value="<?= $data[0]['customer_gst'] ?>" class="pos-input" />
                </div>
                <div style="flex: 1.2; min-width: 170px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Doctor *</label>
                    <input required="required" type="text" autocomplete="off" value="<?= $data[0]['doctor_name'] ?>" name="doctor_name" class="pos-input" />
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table Card -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-cubes"></i> Items List
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <a href="javascript:void(0)" onclick="addmore()" class="addm btn ss-btn-primary" style="border-radius: 9999px; padding: 6px 18px; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa fa-plus-circle"></i> Add More Item
                </a>
            </div>
        </div>

        <div style="padding: 10px 15px 15px 15px;">
            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 10px;">
                <table id="tableData" class="table">
                    <thead>
                        <tr>
                            <th style="width: 45px;">Sr</th>
                            <th style="min-width: 220px;">Product Name</th>
                            <th style="width: 50px;">HSN</th>
                            <th style="width: 45px;">Strip</th>
                            <th style="width: 45px;">Loose</th>
                            <th style="width: 45px;">Unit</th>
                            <th style="width: 100px;">Batch</th>
                            <th style="width: 65px;">Exp (MM/YY)</th>
                            <th style="width: 65px;">MRP</th>
                            <th style="width: 60px;">Rate</th>
                            <th style="width: 120px;">
                                Disc(%)<br />
                                <?php
                                $item_details = array();
                                foreach ($data as $a => $value) {
                                    $item_details[] = $value['sale_discount_percent'];
                                }
                                $result = count(array_unique($item_details));
                                ?>
                                <select id="discount" name="discount">
                                    <option value='2' <?= $result == 1 ? ' selected="selected"' : ''; ?>>Grand Disc</option>
                                    <option value='1' <?= $result > 1  ? ' selected="selected"' : ''; ?>>Individual Disc</option>
                                </select>
                            </th>
                            <th style="width: 65px;">Taxable</th>
                            <th style="width: 45px;">CGST %</th>
                            <th style="width: 60px;">CGST</th>
                            <th style="width: 45px;">SGST %</th>
                            <th style="width: 60px;">SGST</th>
                            <th style="width: 75px;">Total</th>
                        </tr>
                    </thead>
                    <tbody class="appendHere center">
                        <?php foreach ($data as $k => $value) { ?>
                            <tr class="rowline" style="text-align: center">
                                <td>
                                    <span style="font-weight: 700; color: var(--ss-text-muted);"><?= $k + 1 ?></span>
                                    <a href="javascript:void(0)" onclick="removeRow(this);" style="color: var(--ss-danger); margin-left: 4px;"> <i class="fa fa-minus-circle"></i> </a>
                                </td>
                                <td>
                                    <input required="required" type="hidden" name="medicine_id[]" value="<?= $value['medicine_id'] ?>">
                                    <input required="required" type="text" name="medicine_name[]" value="<?= $value['medicine_name'] ?>" class="ui-autocomplete-input" autocomplete="off" style="width: 160px; font-weight: 600;">
                                    <small style="color: var(--ss-text-muted); font-size: 11px;">Loc:</small>
                                    <input readonly="readonly" value="<?= $value['medicine_storage'] ?>" type="text" name="medicine_storage[]" style="width: 40px; font-size: 11px; background: #f8fafc;">
                                </td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['medicine_hsn'] ?>" name="medicine_hsn[]" style="width: 45px; background: #f8fafc;"></td>
                                <td><input required="required" type="text" value="<?= $value['sale_strip_quantity'] ?>" name="sale_strip_quantity[]" onkeyup="calculate_the_sale(this)" style="width: 35px; font-weight: 600;"></td>
                                <td><input required="required" type="text" value="<?= $value['sale_loose_quantity'] ?>" name="sale_loose_quantity[]" onkeyup="calculate_the_sale(this)" style="width: 35px;"></td>
                                <td><input required="required" type="text" value="<?= $value['medicine_unit'] ?>" name="medicine_unit[]" style="width: 35px;" onkeyup="calculate_the_sale(this)"></td>
                                <td><input required="required" type="text" value="<?= $value['sale_batch'] ?>" autocomplete="off" name="sale_batch[]" pattern="^\S+$" style="width: 90px; font-family: monospace;" onkeyup="calculate_the_sale(this)"></td>
                                <td>
                                    <input required="required" type="text" value="<?= $value['sale_expire_month'] ?>" name="sale_expire_month[]" onkeyup="calculate_the_sale(this)" pattern="^[0-9]+$" style="width: 22px; margin: 0; padding: 2px; float: left;">
                                    <span style="margin: 0; padding: 2px; float: left;">/</span>
                                    <input readonly="readonly" required="required" value="<?= $value['sale_expire_year'] ?>" type="text" onkeyup="calculate_the_sale(this)" name="sale_expire_year[]" pattern="^[0-9]+$" style="width: 22px; margin: 0; padding: 2px; float: left;">
                                </td>
                                <td><input required="required" readonly="readonly" value="<?= $value['sale_mrp'] ?>" type="text" onkeyup="calculate_the_sale(this)" name="sale_mrp[]" style="width: 55px;"></td>
                                <td><input required="required" value="<?= $value['sale_rate'] ?>" type="text" name="sale_rate[]" onkeyup="calculate_the_sale(this)" style="width: 50px;"></td>
                                <td><input required="required" value="<?= $value['sale_discount_percent'] ?>" class="sale_grand_dis" type="text" name="sale_discount_percent[]" onkeyup="calculate_the_sale(this),calculate_grand_dis()" style="width: 32px;"></td>
                                <td><input required="required" value="<?= $value['sale_taxable'] ?>" readonly="readonly" type="text" name="sale_taxable[]" style="width: 55px; background: #f8fafc;"></td>
                                <td><input required="required" value="<?= $value['sale_cgst_percent'] ?>" readonly="readonly" type="text" name="sale_cgst_percent[]" onkeyup="calculate_the_sale(this)" style="width: 30px;"></td>
                                <td><input required="required" value="<?= $value['sale_cgst'] ?>" readonly="readonly" type="text" name="sale_cgst[]" style="width: 50px; background: #f8fafc;"></td>
                                <td><input required="required" value="<?= $value['sale_sgst_percent'] ?>" readonly="readonly" type="text" name="sale_sgst_percent[]" onkeyup="calculate_the_sale(this)" style="width: 30px;"></td>
                                <td><input required="required" value="<?= $value['sale_sgst'] ?>" readonly="readonly" type="text" name="sale_sgst[]" style="width: 50px; background: #f8fafc;"></td>
                                <td><input required="required" value="<?= $value['sale_total'] ?>" readonly="readonly" type="text" name="sale_total[]" style="width: 65px; font-weight: 700; color: var(--ss-success); background: #f8fafc;"></td>
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
                <i class="fa fa-calculator"></i> Invoice Totals & Settlement
            </div>
        </div>

        <div style="padding: 20px;">
            <div class="row-fluid" style="display: flex; gap: 16px; margin-bottom: 20px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Total Items</div>
                    <div class="totalItem" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0</div>
                </div>
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Total CGST</div>
                    <div class="totalCgst" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Total SGST</div>
                    <div class="totalSgst" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Total GST</div>
                    <div class="totalgst" style="font-size: 18px; font-weight: 800; color: var(--ss-primary); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1.2; min-width: 160px; background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.25); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-success); text-transform: uppercase;">Grand Total</div>
                    <div class="totalAmount" style="font-size: 20px; font-weight: 800; color: var(--ss-success); margin-top: 4px;">0.00</div>
                </div>
            </div>

            <div class="row-fluid" style="display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-start; background: #fafbfc; border: 1px solid var(--ss-border); border-radius: 12px; padding: 18px;">
                <div style="flex: 1; min-width: 130px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Previous Due</label>
                    <div class="customer_due" onkeyup="calculateTotal()">
                        <input type="text" name="sale_total_previous_due" value="<?= $data[0]['sale_total_previous_due'] ?>" class="pos-input" style="text-align: right; font-weight: 600;" />
                    </div>
                </div>
                <div style="flex: 1.2; min-width: 160px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Payable Amount</label>
                    <div class="customer_payable" style="font-size: 18px; font-weight: 800; color: var(--ss-primary); padding-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1.2; min-width: 150px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Amount Paid</label>
                    <div class="paid">
                        <input onkeyup="currentdue()" class="sale_total_paid pos-input" type="text" autocomplete="off" name="sale_total_paid" value="<?= $data[0]['sale_total_paid'] ?>" style="text-align: right; font-weight: 700; color: var(--ss-success);" />
                    </div>
                </div>
                <div style="flex: 1.2; min-width: 150px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Current Due</label>
                    <div class="currentdue">
                        <input type="text" name="sale_total_current_due" readonly="readonly" class="pos-input" style="text-align: right; font-weight: 700; color: var(--ss-danger); background: #ffffff;" />
                    </div>
                </div>
                <div style="flex: 1.2; min-width: 150px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Payment Method</label>
                    <div class="method">
                        <select name="sale_paid_by" class="pos-input" style="font-weight: 600;">
                            <option value="Cash" <?= $data[0]['sale_paid_by'] == 'Cash' ? ' selected="selected"' : ''; ?>>Cash</option>
                            <option value="Paytm" <?= $data[0]['sale_paid_by'] == 'Paytm' ? ' selected="selected"' : ''; ?>>Paytm</option>
                            <option value="Cheque" <?= $data[0]['sale_paid_by'] == 'Cheque' ? ' selected="selected"' : ''; ?>>Cheque</option>
                            <option value="Mobikwik" <?= $data[0]['sale_paid_by'] == 'Mobikwik' ? ' selected="selected"' : ''; ?>>Mobikwik</option>
                            <option value="Bank Deposit" <?= $data[0]['sale_paid_by'] == 'Bank Deposit' ? ' selected="selected"' : ''; ?>>Bank Deposit</option>
                            <option value="Other" <?= $data[0]['sale_paid_by'] == 'Other' ? ' selected="selected"' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>
                <div style="flex: 2; min-width: 220px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Payment Remarks</label>
                    <div class="paymentnote">
                        <textarea name="sale_note" class="pos-input" style="height: 38px !important; resize: none;"><?= $data[0]['sale_note'] ?></textarea>
                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: 25px; padding-top: 18px; border-top: 1px solid var(--ss-border);">
                <button type="button" class="btn ss-btn-secondary" onclick="goBack()" style="border-radius: 9999px; padding: 10px 24px; font-weight: 600;">
                    Cancel
                </button>
                <button type="submit" id="submit-btn" class="btn ss-btn-primary" style="border-radius: 9999px; padding: 10px 32px; font-weight: 700; font-size: 14px;">
                    <i class="fa fa-save"></i> Update Invoice
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    var rowcount = <?= count($data) ?>;

    function chooseBatch(targetObj) {
        var theRow = $(targetObj).parent().parent();
        $(theRow).find("select").nextAll().val("");

        if ($(targetObj).val() != "addnew") {
            $(theRow).find("[name^='sale_batch[]']").val($(targetObj).val());
            $(theRow).find("[name^='sale_batch[]']").attr("readonly", "readonly");
            targetRow = theRow;

            $.post('<?= console_url("medicine_stock/stock_by_batch") ?>/?medicine_id=' + $(targetRow).find('[name^="medicine_id[]"').val() + '&term=' + $(targetObj).val(), function(resp) {
                $(targetRow).find('[name^="sale_strip_quantity[]"').attr({
                    "max": resp[0].complete.left_strip
                });
                $.each(resp[0].complete, function(populate_fieldx, populate_valuex) {
                    $(targetRow).find('[name^="' + populate_fieldx + '[]"').val('');
                    $(targetRow).find('[name^="' + populate_fieldx + '[]"').val(populate_valuex);
                    calculate_the_sale($(targetRow).find('[name^="' + populate_valuex + '[]"'));
                    $(targetRow).find('[name^="sale_discount_percent[]"]').focus().select();
                });
            }, 'json');
        } else {
            $(theRow).find("[name^='sale_batch[]']").removeAttr("readonly");
            $(theRow).find("[name^='sale_batch[]']").attr("placeholder", "Enter new batch");
            $(theRow).find("[name^='sale_batch[]']").val("");
        }
    }

    function addmore() {
        rowcount++;
        var therow = " <tr id='deleterow' class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\" style=\"color:var(--ss-danger);margin-left:4px;\"> <i class=\"fa fa-minus-circle\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"hidden\" name=\"medicine_id[]\"> <input required=\"required\" type=\"text\" name=\"medicine_name[]\" placeholder=\"Search medicine...\" style=\"width:160px;font-weight:600;\"> \n\
<input readonly=\"readonly\" type=\"text\" name=\"medicine_storage[]\" style=\"width:40px;font-size:11px;background:#f8fafc;\"><\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"medicine_hsn[]\" style=\"width:45px;background:#f8fafc;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_strip_quantity[]\" value=\"1\" oninput=\"calculate_the_sale(this)\" style=\"width:35px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"number\" name=\"sale_loose_quantity[]\" min=\"0\" max=\"\" oninput=\"calculate_the_sale(this)\" value=\"0\" style=\"width:35px;\"><\/td>\r\n    \n\
      <td><input required=\"required\" type=\"text\" name=\"medicine_unit[]\" onkeyup=\"calculate_the_sale(this)\" style=\"width:35px;\"><\/td>\r\n    \n\
          <td><input type=\"text\" onchange=\"calculate_the_sale(this)\" autocomplete=\"off\" name=\"sale_batch[]\" pattern=\"^\\S+$\" style=\"width: 90px;font-family:monospace;\"><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"sale_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" pattern=\"^[0-9]+$\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\">\n\
    <span style=\"margin: 0;padding: 2px;float: left;\">/<\/span><input required=\"required\" type=\"text\" name=\"sale_expire_year[]\" onfocusout=\"focusvalidation(this)\" min=\"17\" maxlength=\"99\" maxlength=\"2\" pattern=\"^[0-9]+$\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"sale_mrp[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 55px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" name=\"sale_rate[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n   \n\
   <td><input required=\"required\" class=\"sale_grand_dis\" type=\"text\" name=\"sale_discount_percent[]\" onkeyup=\"calculate_the_sale(this),calculate_grand_dis()\" value=\"0\" style=\"width: 32px;\"><\/td>\r\n     \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_taxable[]\" style=\"width: 55px;background:#f8fafc;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\" type=\"text\" name=\"sale_cgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_cgst[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" name=\"sale_sgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_sgst[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_total[]\" style=\"width: 65px;font-weight:700;color:var(--ss-success);background:#f8fafc;\"><\/td>\r\n    <\/tr>";

        $('.appendHere').append(therow);
        <?php if (isset($this->page_config['autocomplete'])) : ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function(targetField, value) {
                $.each(value, function(model, fieldToSearch) {
                    $('.rowline').find('[name^="' + targetField + '[]"]').autocomplete({
                        source: '/search.php?location=sale&table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        select: function(event, ui) {
                            targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function(populate_field, populate_value) {
                                $(targetRow).find('[name^="' + populate_field + '[]"').val('');

                                if (populate_field == 'medicine_name') {
                                    $.get('<?= console_url("medicine_stock/stock_by_batch") ?>/?medicine_id=' + ui.item.complete.medicine_id, function(resp) {
                                        if (resp !== null) {
                                            $(targetRow).find('.batchchooser').remove();
                                            var batchchooser = $('<select class="batchchooser" onchange="chooseBatch(this)" id="list_' + ui.item.complete.medicine_id + '"></select>');
                                            $(batchchooser).append($('<option value="-" >--CHOOSE BATCH--</option>'));

                                            $.each(resp, function(k, v) {
                                                $(batchchooser).append($('<option value="' + v.value + '" >' + v.label + '</option>'));
                                            });
                                            $(batchchooser).append($('<option value="addnew" >Add New (+)</option>'));

                                            $(targetRow).find('[name^="sale_batch[]"').removeAttr('list');
                                            $(targetRow).find('[name^="sale_batch[]"').val('');
                                            $(targetRow).find('[name^="sale_batch[]"').parent().find('datalist').remove();
                                            $(targetRow).find('[name^="sale_batch[]"').parent().append(batchchooser);
                                            $(targetRow).find('[name^="sale_batch[]"').attr('list', 'list_' + ui.item.complete.medicine_id);
                                        } else {
                                            alert("This medicine stock is zero, please purchase this medicine before sale");
                                            $(targetRow).remove();
                                            calculateTotal();
                                            disp_calc();
                                        }
                                    }, 'json');
                                }
                                $(targetRow).find('[name^="' + populate_field + '[]"').val(populate_value);
                                $(targetRow).find('[name^="medicine_manufacturer[]"]').focus(function() {
                                    $(targetRow).find('[name^="sale_strip_quantity[]"]').focus().select();
                                });

                                calculate_the_sale($(targetRow).find('[name^="' + populate_field + '[]"'));
                            });

                            $(targetRow).find('[name^="sale_batch[]"]').change(function() {
                                targetRow = $(this).parents('tr');
                                $.post('<?= console_url() ?>/medicine_stock/stock_by_batch/?medicine_id=' + $(targetRow).find('[name^="medicine_id[]"').val() + '&term=' + $(this).val(), function(resp) {
                                    $.each(resp[0].complete, function(populate_fieldx, populate_valuex) {
                                        $(targetRow).find('[name^="' + populate_fieldx + '[]"').val('');
                                        $(targetRow).find('[name^="' + populate_fieldx + '[]"').val(populate_valuex);
                                        calculate_the_sale($(targetRow).find('[name^="' + populate_valuex + '[]"'));
                                        $(targetRow).find('[name^="sale_discount_percent[]"]').focus().select();
                                    });
                                }, 'json');
                            });

                            $(targetRow).find('[name^="sale_discount_percent[]"]').keydown(function(e) {
                                var keyCode = e.keyCode || e.which;
                                if (keyCode == 9 && !(e.shiftKey)) {
                                    e.preventDefault();
                                    $('.addm').click();
                                }
                            });
                        }
                    });
                });
            });
        <?php endif; ?>
    }

    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        calculateTotal();
        disp_calc();
    }

    function currentdue() {
        var paid = parseFloat($(document).find('[name="sale_total_paid"]').val()) || 0;
        $('[name="sale_total_current_due"]').val(Math.round(parseFloat($('.customer_payable').html()) - paid));
    }

    function calculateTotal() {
        var totalItem = $('.rowline').length;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;
        var totalPayable = 0;
        var previousDue = 0;

        $('.rowline').each(function() {
            totalCgst += parseFloat($(this).find('[name="sale_cgst[]"]').val()) || 0;
            totalSgst += parseFloat($(this).find('[name="sale_sgst[]"]').val()) || 0;
            totalTotal += parseFloat($(this).find('[name="sale_total[]"]').val()) || 0;
        });
        previousDue = parseFloat($(document).find('[name="sale_total_previous_due"]').val()) || 0;
        var totalPayableAmount = (previousDue + totalTotal);

        $('.totalItem').html(totalItem.toFixed(2));
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
        $('.customer_payable').html(Math.round(totalPayableAmount) + " /-");
        $('.sale_total_paid').val(Math.round(totalPayableAmount));
    }

    $(document).ready(function() {
        $('#discount').change(function() {
            var select_dis = $('#discount').val();
            if (select_dis == 2) {
                var first_enter_value = $(".sale_grand_dis").val();
                $('.sale_grand_dis').val(first_enter_value);
            } else {
                $('.sale_grand_dis').val(0.00);
            }
        });

        setTimeout(function() {
            $('.alert').remove();
        }, 3000);
        $('[name="customer_contact"]').focus();
        $('.addm').focus(function() {
            $(this).click();
        });

        calculateTotal();
    });

    function calculate_grand_dis() {
        var select_dis_val = $('#discount').val();
        if (select_dis_val == 2) {
            var first_enter_value = $(".sale_grand_dis").val();
            $('.sale_grand_dis').val(first_enter_value);
        }
    }

    function calculate_the_sale(targetObject) {
        var cgst = parseFloat($(targetObject).parents('tr').find('[name="sale_cgst_percent[]"]').val()) || 0;
        var mrp = parseFloat($(targetObject).parents('tr').find('[name="sale_mrp[]"]').val()) || 0;
        var unit = parseFloat($(targetObject).parents('tr').find('[name="medicine_unit[]"]').val()) || 1;
        var rate = mrp2rate(mrp, cgst);
        $(targetObject).parents('tr').find('[name="sale_rate[]"]').val(rate.toFixed(3));
        $(targetObject).parent().parent().find('[name^="sale_sgst_percent[]"]').val(cgst);
        var sgst = parseFloat($(targetObject).parents('tr').find('[name="sale_sgst_percent[]"]').val()) || 0;
        var sale_strip_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_strip_quantity[]"]').val()) || 0;
        var sale_loose_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_loose_quantity[]"]').val()) || 0;

        var qty = (sale_strip_quantity * unit) + sale_loose_quantity;
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="sale_discount_percent[]"]').val()) || 0;

        var total = (rate * qty / unit);
        var total_discount = (total * discount_percent / 100);
        var taxable_cost = (total - total_discount);
        var total_cgst = (taxable_cost * cgst / 100);
        var total_sgst = (taxable_cost * sgst / 100);
        var grandtotal = total_sgst + total_cgst + taxable_cost;

        $(targetObject).parent().parent().find('[name^="sale_taxable[]"]').val(taxable_cost.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_cgst[]"]').val(total_cgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_sgst[]"]').val(total_sgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_total[]"]').val(grandtotal.toFixed(2));

        calculateTotal();
        disp_calc();
    }

    function mrp2rate(mrp, cgst) {
        return mrp * 50 / (50 + cgst);
    }

    function focusvalidation(obg) {
        if ($(obg).val() > 31) {
            alert('value is more than 31');
            $(obg).val('');
            $(obg).focus();
            return false;
        }
    }

    function disp_calc() {
        var total_mrp = 0;
        var total = 0;
        var final = 0;
        $.each($('.rowline td input[name="sale_mrp[]"]'), function(index, value) {
            total_mrp = (parseFloat($(this).val()) || 0) + total_mrp;
        });

        $.each($('.rowline td input[name="sale_total[]"]'), function(index, value) {
            total = (parseFloat($(this).val()) || 0) + total;
        });
        final = (total_mrp - total);
        $('div.discounttotal').html(final.toFixed(2));
        $('div.mrptotal').html(total_mrp.toFixed(2));
    }

    function fullCalculation() {
        $('.rowline').each(function() {
            var cgst = parseFloat($(this).find('[name="sale_cgst_percent[]"]').val()) || 0;
            var mrp = parseFloat($(this).find('[name="sale_mrp[]"]').val()) || 0;
            var unit = parseFloat($(this).find('[name="medicine_unit[]"]').val()) || 1;
            var rate = mrp2rate(mrp, cgst);
            $(this).find('[name="sale_rate[]"]').val(rate.toFixed(3));
            $(this).find('[name^="sale_sgst_percent[]"]').val(cgst);
            var sgst = parseFloat($(this).find('[name="sale_sgst_percent[]"]').val()) || 0;
            var sale_strip_quantity = parseFloat($(this).find('[name^="sale_strip_quantity[]"]').val()) || 0;
            var sale_loose_quantity = parseFloat($(this).find('[name^="sale_loose_quantity[]"]').val()) || 0;

            var qty = (sale_strip_quantity * unit) + sale_loose_quantity;
            var discount_percent = parseFloat($(this).find('[name^="sale_discount_percent[]"]').val()) || 0;

            var total = (rate * qty / unit);
            var total_discount = (total * discount_percent / 100);
            var taxable_cost = (total - total_discount);
            var total_cgst = (taxable_cost * cgst / 100);
            var total_sgst = (taxable_cost * sgst / 100);
            var grandtotal = total_sgst + total_cgst + taxable_cost;

            $(this).find('[name^="sale_taxable[]"]').val(taxable_cost.toFixed(2));
            $(this).find('[name^="sale_cgst[]"]').val(total_cgst.toFixed(2));
            $(this).find('[name^="sale_sgst[]"]').val(total_sgst.toFixed(2));
            $(this).find('[name^="sale_total[]"]').val(grandtotal.toFixed(2));
        });

        calculateTotal();
        disp_calc();
        currentdue();
    }

    setInterval(function() {
        fullCalculation();
    }, 100);
</script>