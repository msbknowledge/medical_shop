<?php
// POS Add Sale Invoice Template - Smart School UI Upgrade
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
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==') right center no-repeat;
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

<div id="med_information" style="position: fixed; width: 96%; top: 10px; background: #ffffff; border: 1px solid var(--ss-border); border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.15); left: 2%; font-size: 12px; z-index: 99999;"></div>

<form method="post" action="" onmouseover="hide_info()">
    <!-- Top Header & Party Information Card -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-shopping-cart" style="color: var(--ss-primary);"></i> Point of Sale / New Sale Invoice
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto; display: flex; gap: 12px; align-items: center;">
                <div style="background: rgba(99, 102, 241, 0.08); padding: 6px 14px; border-radius: 9999px; border: 1px solid rgba(99, 102, 241, 0.2); font-size: 13px; font-weight: 700; color: var(--ss-primary);">
                    Invoice: <input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= generate_invoice_number() ?>" name="sale_invoice" style="background: transparent; border: none; font-weight: 800; color: var(--ss-primary); width: 140px;" />
                </div>
                <div style="background: var(--ss-bg); padding: 6px 14px; border-radius: 9999px; border: 1px solid var(--ss-border); font-size: 12px; font-weight: 600; color: var(--ss-text-muted);">
                    Date: <input type="text" required="required" autocomplete="off" value="<?= date('d-M-Y H:i:s', time()) ?>" name="sale_date" style="background: transparent; border: none; font-weight: 600; width: 150px; color: var(--ss-text-main);" />
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
                    <input type="text" autocomplete="off" name="customer_contact" placeholder="Customer Mobile..." class="pos-input" />
                </div>
                <div style="flex: 1.5; min-width: 190px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Customer Name *</label>
                    <input required="required" type="text" autocomplete="off" name="customer_name" placeholder="Customer Full Name..." class="pos-input" style="font-weight: 600;" />
                </div>
                <div style="flex: 1.2; min-width: 170px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Email Address *</label>
                    <input required="required" type="text" autocomplete="off" name="email" placeholder="customer@mail.com" class="pos-input" />
                </div>
                <div style="flex: 1.5; min-width: 190px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Address</label>
                    <input type="text" autocomplete="off" name="customer_address" placeholder="Customer Address..." class="pos-input" />
                </div>
                <div style="flex: 1; min-width: 140px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">GSTIN</label>
                    <input type="text" value="N/A" autocomplete="off" name="customer_gst" class="pos-input" />
                </div>
                <div style="flex: 1.2; min-width: 170px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Prescribing Doctor *</label>
                    <input required="required" type="text" value="N/A" autocomplete="off" name="doctor_name" placeholder="Dr. Name..." class="pos-input" />
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table Card -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-cubes"></i> Billed Items List
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <a class="addm btn ss-btn-primary" href="javascript:void(0)" onclick="addmore()" onmouseover="hide_info()" style="border-radius: 9999px; padding: 6px 18px; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa fa-plus-circle"></i> Add Item Row
                </a>
            </div>
        </div>

        <div style="padding: 10px 15px 15px 15px;">
            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 10px;">
                <table id="tableData" class="table" onmouseover="hide_info()">
                    <thead>
                        <tr>
                            <th style="width: 45px;">Sr</th>
                            <th style="min-width: 200px;">Product Name (In-Stock)</th>
                            <th style="width: 50px;">HSN</th>
                            <th style="width: 50px;">Cat</th>
                            <th style="width: 50px;">Sch</th>
                            <th style="width: 45px;">Strip</th>
                            <th style="width: 45px;">Loose</th>
                            <th style="width: 45px;">Unit</th>
                            <th style="width: 100px;">Batch</th>
                            <th style="width: 65px;">Exp (MM/YY)</th>
                            <th colspan="2" style="width: 110px;">MRP / New MRP</th>
                            <th style="width: 120px;">
                                Disc(%)<br />
                                <select id="discount" name="discount">
                                    <option value="1">Individual</option>
                                    <option value="2">Grand</option>
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
                    <tbody class="appendHere">
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 10px; display: flex; justify-content: flex-end;">
                <a class="addm btn btn-sm ss-btn-secondary" href="javascript:void(0)" onclick="addmore()" onmouseover="hide_info()" style="border-radius: 9999px; font-weight: 600;">
                    <i class="fa fa-plus"></i> Add Another Row
                </a>
            </div>
        </div>
    </div>

    <!-- Settlement & Payment Summary Card -->
    <div class="ss-card" style="margin-bottom: 25px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-calculator"></i> Billing Summary & Settlement
            </div>
        </div>

        <div style="padding: 20px;">
            <div class="row-fluid" style="display: flex; gap: 16px; margin-bottom: 20px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Total Items</div>
                    <div class="totalItem" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0</div>
                </div>
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">MRP Total</div>
                    <div class="mrptotal" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Discount Total</div>
                    <div class="discounttotal" style="font-size: 18px; font-weight: 800; color: var(--ss-danger); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">CGST Total</div>
                    <div class="totalCgst" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1; min-width: 130px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 12px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">SGST Total</div>
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

            <!-- Settlement Row -->
            <div class="row-fluid" style="display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-start; background: #fafbfc; border: 1px solid var(--ss-border); border-radius: 12px; padding: 18px;">
                <div style="flex: 1; min-width: 130px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Previous Due</label>
                    <div class="customer_due" onkeyup="calculateTotal()">
                        <input type="text" name="sale_total_previous_due" value="0.00" class="pos-input" style="text-align: right; font-weight: 600;" />
                    </div>
                </div>
                <div style="flex: 1.2; min-width: 160px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Total Payable (₹)</label>
                    <div class="customer_payable" style="font-size: 18px; font-weight: 800; color: var(--ss-primary); padding-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1.2; min-width: 150px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Amount Paid (₹)</label>
                    <div class="paid">
                        <input onkeyup="currentdue()" class="sale_total_paid pos-input" type="text" autocomplete="off" name="sale_total_paid" value="" style="text-align: right; font-weight: 700; color: var(--ss-success);" />
                    </div>
                </div>
                <div style="flex: 1.2; min-width: 150px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Current Due (₹)</label>
                    <div class="currentdue">
                        <input type="text" name="sale_total_current_due" readonly="readonly" class="pos-input" style="text-align: right; font-weight: 700; color: var(--ss-danger); background: #ffffff;" />
                    </div>
                </div>
                <div style="flex: 1.2; min-width: 150px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Paid By</label>
                    <div class="method">
                        <select name="sale_paid_by" class="pos-input" style="font-weight: 600;">
                            <option value="Cash">Cash</option>
                            <option value="Paytm">Paytm</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Mobikwik">Mobikwik</option>
                            <option value="Bank Deposit">Bank Deposit</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div style="flex: 2; min-width: 220px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Payment Note / Remarks</label>
                    <div class="paymentnote">
                        <textarea name="sale_note" class="pos-input" style="height: 38px !important; resize: none;" placeholder="Optional payment remarks..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 25px; padding-top: 18px; border-top: 1px solid var(--ss-border);">
                <label style="display: inline-flex; align-items: center; gap: 8px; font-weight: 600; font-size: 13px; cursor: pointer; color: var(--ss-text-body); margin: 0;">
                    <input type="checkbox" name="print" checked='checked' style="width: 16px; height: 16px; accent-color: var(--ss-primary);" /> 
                    <span>Print Invoice immediately after generate</span>
                </label>
                <div style="display: flex; gap: 12px;">
                    <button type="button" class="btn ss-btn-secondary" onclick="goBack()" style="border-radius: 9999px; padding: 10px 24px; font-weight: 600;">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" id="submit-btn" class="btn ss-btn-primary" style="border-radius: 9999px; padding: 10px 32px; font-weight: 700; font-size: 14px; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);">
                        <i class="fa fa-check-circle"></i> Generate Bill
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var rowcount = 0;

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
        var therow = " <tr id='deleterow' class=\"rowline\">\r\n<td><span style=\"font-weight:700;color:var(--ss-text-muted);\">" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\" title=\"Delete Row\" style=\"color:var(--ss-danger);margin-left:4px;\"> <i class=\"fa fa-minus-circle\" style=\"font-size:16px;\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"hidden\" name=\"medicine_id[]\"> <input onkeyup=\"get_info(this)\" onfocus=\"get_info(this)\" onclick=\"get_info(this)\"  onmouseout=\"hide_info()\" required=\"required\" type=\"text\" name=\"medicine_name[]\" placeholder=\"Search medicine...\" style=\"width:190px;font-weight:600;\"> \n\
<\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"medicine_hsn[]\" style=\"width:45px;background:#f8fafc;\"><\/td>\r\n      \n\
       <td><input readonly=\"readonly\" type=\"text\" name=\"medicine_category[]\" style=\"width:45px;background:#f8fafc;\"><\/td>\r\n      \n\
        <td><input readonly=\"readonly\" type=\"text\" name=\"medicine_schedule[]\" style=\"width:45px;background:#f8fafc;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_strip_quantity[]\" value=\"1\" oninput=\"calculate_the_sale(this)\" style=\"width:35px;font-weight:600;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"number\" name=\"sale_loose_quantity[]\" min=\"0\" max=\"\" oninput=\"calculate_the_sale(this)\" value=\"0\" style=\"width:35px;\"><\/td>\r\n    \n\
      <td><input required=\"required\" type=\"text\" name=\"medicine_unit[]\" onkeyup=\"calculate_the_sale(this)\" style=\"width:35px;\"><\/td>\r\n    \n\
          <td><input type=\"text\" onchange=\"calculate_the_sale(this)\" autocomplete=\"off\" name=\"sale_batch[]\" pattern=\"^\\S+$\" style=\"width: 90px;font-family:monospace;\"><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"sale_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" pattern=\"^[0-9]+$\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\">\n\
    <span style=\"margin: 0;padding: 2px;float: left;\">/<\/span><input required=\"required\" type=\"text\" name=\"sale_expire_year[]\" onfocusout=\"focusvalidation(this)\" min=\"17\" maxlength=\"99\" maxlength=\"2\" pattern=\"^[0-9]+$\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"sale_new_mrp[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 48px;font-weight:700;\"><input required=\"required\" type=\"text\" name=\"sale_mrp[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 48px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"hidden\" readonly=\"readonly\" name=\"sale_rate[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 45px;\"><\/td>\r\n   \n\
   <td><input required=\"required\" class=\"sale_grand_dis\" type=\"text\" name=\"sale_discount_percent[]\" onkeyup=\"calculate_the_sale(this),calculate_grand_dis()\" value=\"0\" style=\"width: 32px;\"><\/td>\r\n     \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_taxable[]\" style=\"width: 55px;background:#f8fafc;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\" type=\"text\" name=\"sale_cgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_cgst[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" name=\"sale_sgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_sgst[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_total[]\" style=\"width: 65px;font-weight:800;color:var(--ss-success);background:#f8fafc;\"><\/td>\r\n    <\/tr>";

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
                                            var batchchooser = $('<select class="batchchooser" onchange="chooseBatch(this)" id="list_' + ui.item.complete.medicine_id + '" style="border-radius:6px;font-size:11px;"></select>');
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

        $('.date-picker').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });
        $('[name^="medicine_manufacturer[]"]').focus(function() {
            $(this).parent('.rowline').find('[name^="sale_strip_quantity[]"]').focus();
        });
        $("[name^='medicine_name[]']").focus();
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

        $('.totalItem').html(totalItem);
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
        var total_cur_amount = price_in_words(Math.round(totalPayableAmount));
        $('.customer_payable').html(Math.round(totalPayableAmount) + " /- <br><small style='font-size:11px;font-weight:600;color:var(--ss-text-muted);'>" + total_cur_amount + "</small>");
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
        }, 4000);
        $('[name="customer_contact"]').focus();
        $('.addm').focus(function() {
            $(this).click();
        });
        if ($.fn.datetimepicker) {
            $("[name='sale_date']").datetimepicker({format: 'd-M-Y H:i:s'});
        }

        <?php if (isset($this->page_config['autocomplete'])) : ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function(targetField, value) {
                $.each(value, function(model, fieldToSearch) {
                    $('[name="' + targetField + '"]').autocomplete({
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        select: function(event, ui) {
                            $.each(ui.item.complete, function(populate_field, populate_value) {
                                $('[name="' + populate_field + '"]').val(populate_value);
                                calculateTotal();
                            });
                        }
                    });
                });
            });
        <?php endif; ?>

        // Automatically start with one item row
        addmore();
    });

    function calculate_grand_dis() {
        var select_dis_val = $('#discount').val();
        if (select_dis_val == 2) {
            var first_enter_value = $(".sale_grand_dis").val();
            $('.sale_grand_dis').val(first_enter_value);
        }
    }

    function saveTheData(targetObj) {
        $.post(page_url + 'add_detail', $(targetObj).serialize(), function(resp) {
            return false;
        });
        return false;
    }

    function calculate_the_sale(targetObject) {
        const $row = $(targetObject).closest('tr');
        let old_mrp = parseFloat($row.find('[name="sale_mrp[]"]').val()) || 0;
        let old_gst = parseFloat($row.find('[name="sale_cgst_percent[]"]').val()) * 2 || 0;
        let new_mrp = parseFloat($row.find('[name="sale_new_mrp[]"]').val()) || 0;

        if (old_mrp && (!new_mrp || new_mrp === old_mrp)) {
            if (old_gst === 12) {
                new_mrp = (old_mrp * 0.9375).toFixed(2);
            } else if (old_gst === 18) {
                new_mrp = (old_mrp * 0.8898).toFixed(2);
            } else {
                new_mrp = old_mrp.toFixed(2);
            }
            $row.find('[name="sale_new_mrp[]"]').val(new_mrp);
        }

        const cgst_percent = 2.5;
        const sgst_percent = 2.5;
        $row.find('[name="sale_cgst_percent[]"]').val(cgst_percent);
        $row.find('[name="sale_sgst_percent[]"]').val(sgst_percent);

        let rate = parseFloat(new_mrp).toFixed(2);
        $row.find('[name="sale_rate[]"]').val(rate);

        const unit = parseFloat($row.find('[name="medicine_unit[]"]').val()) || 1;
        const strip_qty = parseFloat($row.find('[name="sale_strip_quantity[]"]').val()) || 0;
        const loose_qty = parseFloat($row.find('[name="sale_loose_quantity[]"]').val()) || 0;
        const discount_percent = parseFloat($row.find('[name="sale_discount_percent[]"]').val()) || 0;
        const qty = (strip_qty * unit) + loose_qty;

        const total = (rate * qty / unit);
        const total_discount = total * discount_percent / 100;
        const taxable = total - total_discount;
        const cgst_amt = taxable * cgst_percent / 100;
        const sgst_amt = taxable * sgst_percent / 100;
        const grand_total = taxable + cgst_amt + sgst_amt;

        $row.find('[name="sale_taxable[]"]').val(taxable.toFixed(2));
        $row.find('[name="sale_cgst[]"]').val(cgst_amt.toFixed(2));
        $row.find('[name="sale_sgst[]"]').val(sgst_amt.toFixed(2));
        $row.find('[name="sale_total[]"]').val(grand_total.toFixed(2));

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
        $.each($('.rowline td input[name="sale_new_mrp[]"]'), function(index, value) {
            total_mrp = parseFloat($(this).val()) || 0 + total_mrp;
        });

        $.each($('.rowline td input[name="sale_total[]"]'), function(index, value) {
            total = parseFloat($(this).val()) || 0 + total;
        });
        final = (total_mrp - total);
        $('div.discounttotal').html(final.toFixed(2));
        $('div.mrptotal').html(total_mrp.toFixed(2));
    }

    function fullCalculation() {
        $('.rowline').each(function() {
            var cgst = parseFloat($(this).find('[name="sale_cgst_percent[]"]').val()) || 0;
            var mrp = parseFloat($(this).find('[name="sale_new_mrp[]"]').val()) || 0;
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

    function get_info(targetObj) {
        $.post('/console/medicine_stock/get_info', {
            medicine: $(targetObj).parents('.rowline').find('[name^="medicine_name[]"]').val()
        }, function(resp) {
            $('#med_information').html(resp);
        });
    }

    function hide_info() {
        $('#med_information').html('');
    }

    function get_stock_info(targetObj) {
        $.post('/console/medicine_stock/get_stock_info', {
            medicine: $(targetObj).parents('.rowline').find('[name^="medicine_name[]"]').val()
        }, function(resp) {
            var current_val = $(targetObj).val();
            if (current_val > resp.left_strip) {
                alert("You have enter more than stock quantity");
                $(targetObj).val(resp.left_strip);
            }
        });
    }

    function price_in_words(price) {
        var sglDigit = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"],
            dblDigit = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"],
            tensPlace = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"],
            handle_tens = function(dgt, prevDgt) {
                return 0 == dgt ? "" : " " + (1 == dgt ? dblDigit[prevDgt] : tensPlace[dgt]);
            },
            handle_utlc = function(dgt, nxtDgt, denom) {
                return (0 != dgt && 1 != nxtDgt ? " " + sglDigit[dgt] : "") + (0 != nxtDgt || dgt > 0 ? " " + denom : "");
            };

        var str = "",
            digitIdx = 0,
            digit = 0,
            nxtDigit = 0,
            words = [];
        if (price += "", isNaN(parseInt(price))) str = "";
        else if (parseInt(price) > 0 && price.length <= 10) {
            for (digitIdx = price.length - 1; digitIdx >= 0; digitIdx--) switch (digit = price[digitIdx] - 0, nxtDigit = digitIdx > 0 ? price[digitIdx - 1] - 0 : 0, price.length - digitIdx - 1) {
                case 0:
                    words.push(handle_utlc(digit, nxtDigit, ""));
                    break;
                case 1:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 2:
                    words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] && 0 != price[digitIdx + 2] ? " and" : "") : "");
                    break;
                case 3:
                    words.push(handle_utlc(digit, nxtDigit, "Thousand"));
                    break;
                case 4:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 5:
                    words.push(handle_utlc(digit, nxtDigit, "Lakh"));
                    break;
                case 6:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 7:
                    words.push(handle_utlc(digit, nxtDigit, "Crore"));
                    break;
                case 8:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 9:
                    words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] || 0 != price[digitIdx + 2] ? " and" : " Crore") : "");
            }
            str = words.reverse().join("") + " Rupees Only";
        } else str = "";
        return str;
    }
</script>