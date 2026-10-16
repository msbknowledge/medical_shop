<?php
// Sale Return / Exchange POS Template - Smart School UI Upgrade
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
    .posTable {
        width: 100%;
        margin-bottom: 0;
    }
    .posTable th {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 10px 6px;
        text-align: center;
        background: #f8fafc;
        border-bottom: 2px solid var(--ss-border);
        white-space: nowrap;
    }
    .posTable td {
        padding: 6px 4px;
        vertical-align: middle;
        text-align: center;
        font-size: 12px;
        border-bottom: 1px solid var(--ss-border);
    }
    .rowline input, .rowline_R input {
        border-radius: 6px;
        border: 1px solid var(--ss-border);
        padding: 4px 6px;
        font-size: 12px;
        text-align: center;
    }
    .rowline input:focus, .rowline_R input:focus {
        border-color: var(--ss-primary);
        outline: none;
    }
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==') right center no-repeat;
    }
</style>

<?php if (isset($status)): ?>
    <div class="alert alert-<?= $status ?>" style="border-radius: 8px; margin-bottom: 20px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="">
    <!-- Header & Customer Details Card -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-refresh" style="color: var(--ss-warning);"></i> Sale Return / Exchange Invoice
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto; display: flex; gap: 12px; align-items: center;">
                <div style="background: rgba(99, 102, 241, 0.08); padding: 6px 14px; border-radius: 9999px; border: 1px solid rgba(99, 102, 241, 0.2); font-size: 13px; font-weight: 700; color: var(--ss-primary);">
                    Invoice: <input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= generate_invoice_number() ?>" name="sale_invoice" style="background: transparent; border: none; font-weight: 800; color: var(--ss-primary); width: 140px;" />
                </div>
                <div style="background: var(--ss-bg); padding: 6px 14px; border-radius: 9999px; border: 1px solid var(--ss-border); font-size: 12px; font-weight: 600; color: var(--ss-text-muted);">
                    Date: <input type="text" required="required" autocomplete="off" value="<?= date('m/d/Y', time()) ?>" name="sale_date" style="background: transparent; border: none; font-weight: 600; width: 110px; color: var(--ss-text-main);" />
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
                    <input required="required" type="text" autocomplete="off" name="customer_name" placeholder="Customer Name..." class="pos-input" style="font-weight: 600;" />
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
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Doctor *</label>
                    <input required="required" value="N/A" type="text" autocomplete="off" name="doctor_name" class="pos-input" />
                </div>
            </div>
        </div>
    </div>

    <!-- New Items (Exchange) Card -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-cubes"></i> New Items (In Stock)
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <a class="addm btn ss-btn-primary" href="javascript:void(0)" onclick="addmore()" style="border-radius: 9999px; padding: 6px 18px; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa fa-plus-circle"></i> Add Item Row
                </a>
            </div>
        </div>

        <div style="padding: 10px 15px 15px 15px;">
            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 10px;">
                <table class="table posTable">
                    <thead>
                        <tr>
                            <th style="width: 45px;">Sr</th>
                            <th style="min-width: 200px;">Product Name</th>
                            <th style="width: 50px;">HSN</th>
                            <th style="width: 45px;">Strip</th>
                            <th style="width: 45px;">Loose</th>
                            <th style="width: 45px;">Unit</th>
                            <th style="width: 95px;">Batch</th>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Return Items Card -->
    <div class="ss-card" style="margin-bottom: 20px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-reply" style="color: var(--ss-danger);"></i> Return Items
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <a class="addm_R btn ss-btn-secondary" href="javascript:void(0)" onclick="addmore_R()" style="border-radius: 9999px; padding: 6px 18px; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa fa-plus-circle"></i> Add Return Item
                </a>
            </div>
        </div>

        <div style="padding: 10px 15px 15px 15px;">
            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 10px;">
                <table class="table posTable">
                    <thead>
                        <tr>
                            <th style="width: 45px;">Sr</th>
                            <th style="min-width: 200px;">Product Name</th>
                            <th style="width: 50px;">HSN</th>
                            <th style="width: 45px;">Strip</th>
                            <th style="width: 45px;">Loose</th>
                            <th style="width: 45px;">Unit</th>
                            <th style="width: 95px;">Batch</th>
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
                    <tbody class="appendHere_R">
                    </tbody>
                </table>
            </div>
            <input type="hidden" value="0" name="total_return" />
        </div>
    </div>

    <!-- Financial Settlement Card -->
    <div class="ss-card" style="margin-bottom: 25px;">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-calculator"></i> Billing Totals & Settlement
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
                        <input type="text" name="sale_total_previous_due" value="0.00" class="pos-input" style="text-align: right; font-weight: 600;" />
                    </div>
                </div>
                <div style="flex: 1.2; min-width: 160px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Payable Amount</label>
                    <div class="customer_payable" style="font-size: 18px; font-weight: 800; color: var(--ss-primary); padding-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1.2; min-width: 150px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Amount Paid</label>
                    <div class="paid">
                        <input onkeyup="currentdue()" class="sale_total_paid pos-input" type="text" autocomplete="off" name="sale_total_paid" value="" style="text-align: right; font-weight: 700; color: var(--ss-success);" />
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
                            <option value="Cash">Cash</option>
                            <option value="Paytm">Paytm</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Mobikwik">Mobikwik</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div style="flex: 2; min-width: 220px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Payment Remarks</label>
                    <div class="paymentnote">
                        <textarea name="sale_note" class="pos-input" style="height: 38px !important; resize: none;"></textarea>
                    </div>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 25px; padding-top: 18px; border-top: 1px solid var(--ss-border);">
                <label style="display: inline-flex; align-items: center; gap: 8px; font-weight: 600; font-size: 13px; cursor: pointer; color: var(--ss-text-body); margin: 0;">
                    <input type="checkbox" name="print" checked='checked' style="width: 16px; height: 16px; accent-color: var(--ss-primary);" /> 
                    <span>Print Invoice after generate</span>
                </label>
                <div style="display: flex; gap: 12px;">
                    <button type="button" class="btn ss-btn-secondary" onclick="goBack()" style="border-radius: 9999px; padding: 10px 24px; font-weight: 600;">
                        Cancel
                    </button>
                    <button type="submit" class="btn ss-btn-primary" style="border-radius: 9999px; padding: 10px 32px; font-weight: 700; font-size: 14px;">
                        <i class="fa fa-check-circle"></i> Generate Return Bill
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var rowcount = 0;
    function addmore() {
        rowcount++;
        var therow = " <tr class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\" style=\"color:var(--ss-danger);margin-left:4px;\"> <i class=\"fa fa-minus-circle\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"hidden\" name=\"medicine_id[]\"> <input required=\"required\" type=\"text\" name=\"medicine_name[]\" placeholder=\"Search medicine...\" style=\"width:160px;font-weight:600;\"> \n\
<input readonly=\"readonly\" type=\"text\" name=\"medicine_storage[]\" style=\"width:40px;font-size:11px;background:#f8fafc;\"><\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"medicine_hsn[]\" style=\"width:45px;background:#f8fafc;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_strip_quantity[]\" value=\"1\" onkeyup=\"calculate_the_sale(this)\" style=\"width:35px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_loose_quantity[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0\" style=\"width:35px;\"><\/td>\r\n    \n\
      <td><input required=\"required\" type=\"text\" name=\"medicine_unit[]\" onkeyup=\"calculate_the_sale(this)\" style=\"width:35px;\"><\/td>\r\n    \n\
          <td><input type=\"text\" onchange=\"calculate_the_sale(this)\" name=\"sale_batch[]\" style=\"width: 90px;font-family:monospace;\"><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"sale_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\">\n\
    <span style=\"margin: 0;padding: 2px;float: left;\">/<\/span><input required=\"required\" type=\"text\" name=\"sale_expire_year[]\" onfocusout=\"focusvalidation(this)\" min=\"17\" maxlength=\"99\" maxlength=\"2\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_mrp[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 55px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_rate[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n      \n\
  <td><input required=\"required\" type=\"text\" name=\"sale_discount_percent[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0\" style=\"width: 30px;\"><\/td>\r\n     \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_taxable[]\" style=\"width: 55px;background:#f8fafc;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\" type=\"text\" name=\"sale_cgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_cgst[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" name=\"sale_sgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_sgst[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_total[]\" style=\"width: 65px;font-weight:700;color:var(--ss-success);background:#f8fafc;\"><\/td>\r\n    <\/tr>";
        $('.appendHere').append(therow);
        bindAutocomplete();
    }

    var rowcount_R = 0;
    function addmore_R() {
        rowcount_R++;
        var therow = " <tr class=\"rowline_R\">\r\n<td><span>" + rowcount_R + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow_R(this);\" style=\"color:var(--ss-danger);margin-left:4px;\"> <i class=\"fa fa-minus-circle\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"hidden\" name=\"medicine_id_R[]\"> <input required=\"required\" type=\"text\" name=\"medicine_name_R[]\" placeholder=\"Search medicine...\" style=\"width:160px;font-weight:600;\"> \n\
<input readonly=\"readonly\" type=\"text\" name=\"medicine_storage_R[]\" style=\"width:40px;font-size:11px;background:#f8fafc;\"><\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"medicine_hsn_R[]\" style=\"width:45px;background:#f8fafc;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_strip_quantity_R[]\" value=\"1\" onkeyup=\"calculate_the_sale_R(this)\" style=\"width:35px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_loose_quantity_R[]\" onkeyup=\"calculate_the_sale_R(this)\" value=\"0\" style=\"width:35px;\"><\/td>\r\n    \n\
      <td><input required=\"required\" type=\"text\" name=\"medicine_unit_R[]\" onkeyup=\"calculate_the_sale_R(this)\" style=\"width:35px;\"><\/td>\r\n    \n\
          <td><input type=\"text\" onchange=\"calculate_the_sale_R(this)\" name=\"sale_batch_R[]\" style=\"width: 90px;font-family:monospace;\"><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"sale_expire_month_R[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\">\n\
    <span style=\"margin: 0;padding: 2px;float: left;\">/<\/span><input required=\"required\" type=\"text\" name=\"sale_expire_year_R[]\" onfocusout=\"focusvalidation(this)\" min=\"17\" maxlength=\"99\" maxlength=\"2\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_mrp_R[]\" onkeyup=\"calculate_the_sale_R(this)\" value=\"0.00\" style=\"width: 55px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_rate_R[]\" onkeyup=\"calculate_the_sale_R(this)\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n      \n\
  <td><input required=\"required\" type=\"text\" name=\"sale_discount_percent_R[]\" onkeyup=\"calculate_the_sale_R(this)\" value=\"0\" style=\"width: 30px;\"><\/td>\r\n     \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_taxable_R[]\" style=\"width: 55px;background:#f8fafc;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\" type=\"text\" name=\"sale_cgst_percent_R[]\" value=\"0\" onkeyup=\"calculate_the_sale_R(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_cgst_R[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" name=\"sale_sgst_percent_R[]\" value=\"0\" onkeyup=\"calculate_the_sale_R(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_sgst_R[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_total_R[]\" style=\"width: 65px;font-weight:700;color:var(--ss-danger);background:#f8fafc;\"><\/td>\r\n    <\/tr>";
        $('.appendHere_R').append(therow);
        bindAutocomplete_R();
    }

    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        calculateTotal();
        disp_calc();
    }

    function removeRow_R(targetObj) {
        $(targetObj).parents('.rowline_R').remove();
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
        var totalReturn = 0;
        var previousDue = 0;

        $('.rowline').each(function () {
            totalCgst += parseFloat($(this).find('[name="sale_cgst[]"]').val()) || 0;
            totalSgst += parseFloat($(this).find('[name="sale_sgst[]"]').val()) || 0;
            totalTotal += parseFloat($(this).find('[name="sale_total[]"]').val()) || 0;
        });

        $('.rowline_R').each(function () {
            totalReturn += parseFloat($(this).find('[name="sale_total_R[]"]').val()) || 0;
        });
        $('[name="total_return"]').val(totalReturn.toFixed(2));

        previousDue = parseFloat($(document).find('[name="sale_total_previous_due"]').val()) || 0;
        var totalPayableAmount = (previousDue + totalTotal) - totalReturn;

        $('.totalItem').html(totalItem);
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
        $('.customer_payable').html(Math.round(totalPayableAmount) + " /-");
        $('.sale_total_paid').val(Math.round(totalPayableAmount));
    }

    function bindAutocomplete() {
        <?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    $('.rowline').find('[name^="' + targetField + '[]"]').autocomplete({
                        source: '/search.php?location=sale&table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        select: function (event, ui) {
                            var targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function (populate_field, populate_value) {
                                $(targetRow).find('[name^="' + populate_field + '[]"]').val(populate_value);
                            });
                            calculate_the_sale($(targetRow).find('[name^="' + targetField + '[]"]'));
                        }
                    });
                });
            });
        <?php endif; ?>
    }

    function bindAutocomplete_R() {
        <?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    $('.rowline_R').find('[name^="' + targetField + '_R[]"]').autocomplete({
                        source: '/search.php?location=sale&table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        select: function (event, ui) {
                            var targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function (populate_field, populate_value) {
                                $(targetRow).find('[name^="' + populate_field + '_R[]"]').val(populate_value);
                            });
                            calculate_the_sale_R($(targetRow).find('[name^="' + targetField + '_R[]"]'));
                        }
                    });
                });
            });
        <?php endif; ?>
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

    function calculate_the_sale_R(targetObject) {
        var cgst = parseFloat($(targetObject).parents('tr').find('[name="sale_cgst_percent_R[]"]').val()) || 0;
        var mrp = parseFloat($(targetObject).parents('tr').find('[name="sale_mrp_R[]"]').val()) || 0;
        var unit = parseFloat($(targetObject).parents('tr').find('[name="medicine_unit_R[]"]').val()) || 1;
        var rate = mrp2rate(mrp, cgst);
        $(targetObject).parents('tr').find('[name="sale_rate_R[]"]').val(rate.toFixed(3));
        $(targetObject).parent().parent().find('[name^="sale_sgst_percent_R[]"]').val(cgst);
        var sgst = parseFloat($(targetObject).parents('tr').find('[name="sale_sgst_percent_R[]"]').val()) || 0;
        var sale_strip_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_strip_quantity_R[]"]').val()) || 0;
        var sale_loose_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_loose_quantity_R[]"]').val()) || 0;

        var qty = (sale_strip_quantity * unit) + sale_loose_quantity;
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="sale_discount_percent_R[]"]').val()) || 0;

        var total = (rate * qty / unit);
        var total_discount = (total * discount_percent / 100);
        var taxable_cost = (total - total_discount);
        var total_cgst = (taxable_cost * cgst / 100);
        var total_sgst = (taxable_cost * sgst / 100);
        var grandtotal = total_sgst + total_cgst + taxable_cost;

        $(targetObject).parent().parent().find('[name^="sale_taxable_R[]"]').val(taxable_cost.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_cgst_R[]"]').val(total_cgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_sgst_R[]"]').val(total_sgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_total_R[]"]').val(grandtotal.toFixed(2));

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

    $(document).ready(function() {
        addmore();
        addmore_R();
    });
</script>