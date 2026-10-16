<?php
// Purchase Edit Detail Template - Smart School UI Upgrade
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
    #purchaseTable {
        width: 100%;
        margin-bottom: 0;
    }
    #purchaseTable th {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 10px 6px;
        text-align: center;
        background: #f8fafc;
        border-bottom: 2px solid var(--ss-border);
        white-space: nowrap;
    }
    #purchaseTable td {
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
</style>

<div id="history" style="position: fixed; width: 96%; top: 10px; background: #ffffff; border: 1px solid var(--ss-border); border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.15); left: 2%; font-size: 12px; z-index: 99999;"></div>

<?php if (isset($status)): ?>
    <div class="alert alert-<?= $status ?>" style="border-radius: 8px; margin-bottom: 20px;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="" enctype="multipart/form-data">
    <!-- Supplier & Invoice Details Card -->
    <div class="ss-card" style="margin-bottom: 20px;" onmouseover="hide_history()">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-truck" style="color: var(--ss-primary);"></i> Edit Purchase Entry
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto; display: flex; gap: 12px; align-items: center;">
                <div style="background: rgba(99, 102, 241, 0.08); padding: 6px 14px; border-radius: 9999px; border: 1px solid rgba(99, 102, 241, 0.2); font-size: 13px; font-weight: 700; color: var(--ss-primary);">
                    Entry No: <input readonly="readonly" required="required" value="<?= $data[0]['purchase_entry_number'] ?>" type="text" name="purchase_entry_number" style="background: transparent; border: none; font-weight: 800; color: var(--ss-primary); width: 100px;" />
                </div>
                <div style="background: var(--ss-bg); padding: 6px 14px; border-radius: 9999px; border: 1px solid var(--ss-border); font-size: 12px; font-weight: 600; color: var(--ss-text-muted);">
                    Date: <input type="text" value="<?= date('m/d/Y', strtotime($data[0]['purchase_date'])) ?>" required="required" autocomplete="off" name="purchase_date" style="background: transparent; border: none; font-weight: 600; width: 110px; color: var(--ss-text-main);" />
                </div>
            </div>
        </div>

        <div style="padding: 20px;">
            <div class="pos-section-title">
                <i class="fa fa-building-o"></i> Supplier Information
            </div>
            <div class="row-fluid" style="display: flex; gap: 14px; flex-wrap: wrap;">
                <div style="flex: 1.2; min-width: 170px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Invoice No *</label>
                    <input value="<?= $data[0]['purchase_invoice'] ?>" required="required" type="text" autocomplete="off" name="purchase_invoice" class="pos-input" style="font-weight: 700;" />
                </div>
                <div style="flex: 1.5; min-width: 190px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Supplier Name *</label>
                    <input required="required" value="<?= $data[0]['supplier_name'] ?>" type="text" autocomplete="off" name="supplier_name" class="pos-input" style="font-weight: 600;" />
                </div>
                <div style="flex: 1.2; min-width: 170px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Contact Number *</label>
                    <input value="<?= $data[0]['supplier_contact'] ?>" required="required" type="text" autocomplete="off" name="supplier_contact" class="pos-input" />
                </div>
                <div style="flex: 1.2; min-width: 160px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Supplier GSTIN *</label>
                    <input type="text" value="<?= $data[0]['supplier_gst'] ?>" required="required" autocomplete="off" name="supplier_gst" class="pos-input" />
                </div>
                <div style="flex: 2; min-width: 220px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--ss-text-muted); margin-bottom: 5px; display: block;">Supplier Address *</label>
                    <input required="required" value="<?= $data[0]['supplier_address'] ?>" type="text" autocomplete="off" name="supplier_address" class="pos-input" />
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table Card -->
    <div class="ss-card" style="margin-bottom: 20px;" onmouseover="hide_history()">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-cubes"></i> Purchased Items
            </div>
            <div class="ss-actions-toolbar" style="margin-left: auto;">
                <a href="javascript:void(0)" onclick="addmore()" class="btn ss-btn-primary" style="border-radius: 9999px; padding: 6px 18px; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa fa-plus-circle"></i> Add Item Row
                </a>
            </div>
        </div>

        <div style="padding: 10px 15px 15px 15px;">
            <div class="table-responsive" style="overflow-x: auto; border: 1px solid var(--ss-border); border-radius: 10px;">
                <table id="purchaseTable" class="table">
                    <thead>
                        <tr>
                            <th style="width: 45px;">Sr</th>
                            <th style="min-width: 190px;">Product Name</th>
                            <th style="width: 50px;">HSN</th>
                            <th style="width: 60px;">Storage</th>
                            <th style="width: 50px;">Cat</th>
                            <th style="width: 50px;">Sch</th>
                            <th style="width: 80px;">Mfg</th>
                            <th style="width: 45px;">Qty</th>
                            <th style="width: 45px;">Free</th>
                            <th style="width: 45px;">Unit</th>
                            <th style="width: 90px;">Batch</th>
                            <th style="width: 65px;">Exp (MM/YY)</th>
                            <th style="width: 55px;">MRP</th>
                            <th style="width: 55px;">Rate</th>
                            <th style="width: 35px;">Disc %</th>
                            <th style="width: 50px;">Bonus %</th>
                            <th style="width: 60px;">Taxable</th>
                            <th style="width: 35px;">CGST %</th>
                            <th style="width: 55px;">CGST</th>
                            <th style="width: 35px;">SGST %</th>
                            <th style="width: 55px;">SGST</th>
                            <th style="width: 70px;">Total</th>
                        </tr>
                    </thead>
                    <tbody class="appendHere">
                        <?php foreach ($data as $k => $value) { ?>
                            <tr class="rowline" onkeyup="get_history(this)" onfocus="get_history(this)" onclick="get_history(this)" onmouseout="hide_history()">
                                <td>
                                    <span style="font-weight: 700; color: var(--ss-text-muted);"><?= $k + 1 ?></span>
                                    <a href="javascript:void(0)" onclick="removeRow(this);" style="color: var(--ss-danger); margin-left: 4px;"> <i class="fa fa-minus-circle"></i> </a>
                                </td>
                                <td><input required="required" type="text" value="<?= $value['medicine_name'] ?>" name="medicine_name[]" style="width: 170px; font-weight: 600;"></td>
                                <td><input required="required" type="text" value="<?= $value['medicine_hsn'] ?>" name="medicine_hsn[]" style="width: 45px; background: #f8fafc;"></td>
                                <td><input required="required" type="text" value="<?= $value['medicine_storage'] ?>" name="medicine_storage[]" style="width: 55px;"></td>
                                <td><input type="text" value="<?= $value['medicine_category'] ?>" name="medicine_category[]" style="width: 45px;"></td>
                                <td><input type="text" value="<?= $value['medicine_schedule'] ?>" name="medicine_schedule[]" style="width: 45px;"></td>
                                <td><input required="required" type="text" value="<?= $value['medicine_manufacturer'] ?>" name="medicine_manufacturer[]" style="width: 75px;"></td>
                                <td><input required="required" type="number" value="<?= $value['purchase_quantity'] ?>" onkeyup="gst_calculation(this)" name="purchase_quantity[]" style="width: 45px; font-weight: 600;"></td>
                                <td><input required="required" type="number" value="<?= $value['purchase_free_quantity'] ?>" name="purchase_free_quantity[]" style="width: 40px;"></td>
                                <td><input required="required" type="number" value="<?= $value['purchase_unit'] ?>" name="purchase_unit[]" style="width: 40px;"></td>
                                <td><input required="required" type="text" value="<?= $value['purchase_batch'] ?>" name="purchase_batch[]" style="width: 85px; font-family: monospace;"></td>
                                <td>
                                    <input required="required" type="text" value="<?= $value['purchase_expire_month'] ?>" name="purchase_expire_month[]" style="width: 22px; margin: 0; padding: 2px; float: left;">
                                    <span style="margin: 0; padding: 2px; float: left;">/</span>
                                    <input required="required" type="text" value="<?= $value['purchase_expire_year'] ?>" name="purchase_expire_year[]" style="width: 22px; margin: 0; padding: 2px; float: left;">
                                </td>
                                <td><input required="required" type="text" value="<?= $value['purchase_mrp'] ?>" name="purchase_mrp[]" style="width: 55px;"></td>
                                <td><input required="required" type="text" value="<?= $value['purchase_rate'] ?>" name="purchase_rate[]" onkeyup="gst_calculation(this)" style="width: 55px; font-weight: 600;"></td>
                                <td><input required="required" type="text" value="<?= $value['purchase_discount_percent'] ?>" onkeyup="gst_calculation(this)" name="purchase_discount_percent[]" style="width: 32px;"></td>
                                <td><input required="required" type="text" value="<?= $value['purchase_bonus'] ?>" name="purchase_bonus[]" style="width: 45px;"></td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['purchase_taxable'] ?>" name="purchase_taxable[]" style="width: 55px; background: #f8fafc;"></td>
                                <td><input required="required" type="text" value="<?= $value['purchase_cgst_percent'] ?>" onkeyup="gst_calculation(this)" name="purchase_cgst_percent[]" style="width: 30px;"></td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['purchase_cgst'] ?>" name="purchase_cgst[]" style="width: 50px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['purchase_sgst_percent'] ?>" name="purchase_sgst_percent[]" style="width: 30px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['purchase_sgst'] ?>" name="purchase_sgst[]" style="width: 50px; background: #f8fafc;"></td>
                                <td><input required="required" readonly="readonly" type="text" value="<?= $value['purchase_total'] ?>" name="purchase_total[]" style="width: 65px; font-weight: 700; color: var(--ss-success); background: #f8fafc;"></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Settlement Card -->
    <div class="ss-card" style="margin-bottom: 25px;" onmouseover="hide_history()">
        <div class="ss-card-header">
            <div class="ss-card-title">
                <i class="fa fa-calculator"></i> Purchase Valuation Summary
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
                    <div class="totalCgst" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1; min-width: 140px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">SGST Total</div>
                    <div class="totalSgst" style="font-size: 18px; font-weight: 800; color: var(--ss-text-main); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1; min-width: 140px; background: var(--ss-bg); border: 1px solid var(--ss-border); border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-text-muted); text-transform: uppercase;">Total GST</div>
                    <div class="totalgst" style="font-size: 18px; font-weight: 800; color: var(--ss-primary); margin-top: 4px;">0.00</div>
                </div>
                <div style="flex: 1.5; min-width: 180px; background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.25); border-radius: 10px; padding: 14px; text-align: center;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--ss-success); text-transform: uppercase;">Grand Total</div>
                    <div class="totalAmount" style="font-size: 22px; font-weight: 800; color: var(--ss-success); margin-top: 4px;">0.00</div>
                </div>
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 12px; padding-top: 18px; border-top: 1px solid var(--ss-border);">
                <button type="button" class="btn ss-btn-secondary" onclick="goBack()" style="border-radius: 9999px; padding: 10px 24px; font-weight: 600;">
                    Cancel
                </button>
                <button type="submit" class="btn ss-btn-primary" style="border-radius: 9999px; padding: 10px 32px; font-weight: 700; font-size: 14px;">
                    <i class="fa fa-save"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    var rowcount = <?= count($data) ?>;

    function addmore() {
        rowcount++;
        var therow = " <tr class=\"rowline\" onkeyup=\"get_history(this)\" onfocus=\"get_history(this)\" onclick=\"get_history(this)\" onmouseout=\"hide_history()\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\" style=\"color:var(--ss-danger);margin-left:4px;\"> <i class=\"fa fa-minus-circle\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"medicine_name[]\" placeholder=\"Search medicine...\" style=\"width:170px;font-weight:600;\"><\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" name=\"medicine_hsn[]\" style=\"width:45px;background:#f8fafc;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"medicine_storage[]\" style=\"width:55px;\"><\/td>\r\n      \n\
      <td><input type=\"text\" name=\"medicine_category[]\" style=\"width:45px;\"><\/td>\r\n      \n\
      <td><input type=\"text\" name=\"medicine_schedule[]\" style=\"width:45px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"medicine_manufacturer[]\" style=\"width:75px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"number\" name=\"purchase_quantity[]\" onkeyup=\"gst_calculation(this)\" value=\"1\" style=\"width:45px;font-weight:600;\"><\/td>\r\n    \n\
      <td><input required=\"required\" type=\"number\" name=\"purchase_free_quantity[]\" value=\"0\" style=\"width:40px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"number\" name=\"purchase_unit[]\" style=\"width:40px;\"><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"purchase_batch[]\" style=\"width: 85px;font-family:monospace;\"><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"purchase_expire_month[]\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\">\n\
    <span style=\"margin: 0;padding: 2px;float: left;\">/<\/span><input required=\"required\" type=\"text\" name=\"purchase_expire_year[]\" style=\"width: 22px;margin: 0;padding: 2px;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" name=\"purchase_mrp[]\" value=\"0.00\" style=\"width: 55px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" name=\"purchase_rate[]\" onkeyup=\"gst_calculation(this)\" value=\"0.00\" style=\"width: 55px;font-weight:600;\"><\/td>\r\n      \n\
  <td><input required=\"required\" type=\"text\" name=\"purchase_discount_percent[]\" onkeyup=\"gst_calculation(this)\" value=\"0\" style=\"width: 32px;\"><\/td>\r\n     \n\
   <td><input required=\"required\" type=\"text\" name=\"purchase_bonus[]\" style=\"width:45px;\"><\/td>\r\n      \n\
    <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_taxable[]\" style=\"width: 55px;background:#f8fafc;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\" type=\"text\" name=\"purchase_cgst_percent[]\" value=\"0\" onkeyup=\"gst_calculation(this)\" style=\"width: 30px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_cgst[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
   <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_sgst_percent[]\" value=\"0\" onkeyup=\"gst_calculation(this)\" style=\"width: 30px;background:#f8fafc;\"><\/td>\r\n    \n\
   <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_sgst[]\" style=\"width: 50px;background:#f8fafc;\"><\/td>\r\n    \n\
    <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_total[]\" style=\"width: 65px;font-weight:700;color:var(--ss-success);background:#f8fafc;\"><\/td>\r\n    <\/tr>";
        $('.appendHere').append(therow);

        <?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    $('.rowline').find('[name^="' + targetField + '[]"]').autocomplete({
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        select: function (event, ui) {
                            targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function (populate_field, populate_value) {
                                $(targetRow).find('[name^="' + populate_field + '"]').val(populate_value);
                            });
                        }
                    });
                });
            });
        <?php endif; ?>

        $("[name^='purchase_total[]']").focus(function () {
            addmore();
        });
        $(".rowline:last").find('[name^="medicine_name[]"]').focus();
    }

    $("[name^='purchase_total[]']").focus(function () {
        addmore();
    });
    $(".rowline:last").find('[name^="medicine_name[]"]').focus();

    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        calculateTotal();
    }

    function gst_calculation(targetObject) {
        var cgst = parseFloat($(targetObject).parent().parent().find('[name^="purchase_cgst_percent[]"]').val()) || 0;
        $(targetObject).parent().parent().find('[name^="purchase_sgst_percent[]"]').val(cgst);
        var sgst = parseFloat($(targetObject).parent().parent().find('[name^="purchase_sgst_percent[]"]').val()) || 0;
        var rate = parseFloat($(targetObject).parent().parent().find('[name^="purchase_rate[]"]').val()) || 0;
        var qty = parseFloat($(targetObject).parent().parent().find('[name^="purchase_quantity[]"]').val()) || 0;
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="purchase_discount_percent[]"]').val()) || 0;
        var purchase_bonus = parseFloat($(targetObject).parent().parent().find('[name^="purchase_bonus[]"]').val()) || 0;
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

    function get_history(targetObj) {
        $.post('/console/purchase/get_history', {
            medicine: $(targetObj).find('[name^="medicine_name[]"]').val()
        }, function (resp) {
            $('#history').html(resp);
        });
    }

    function hide_history() {
        $('#history').html('');
    }

    $(document).ready(function () {
        calculateTotal();
    });
</script>