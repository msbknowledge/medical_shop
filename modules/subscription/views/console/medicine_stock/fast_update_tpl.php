<style>
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==')
        right center no-repeat;
    }
    .medicine_chooser {
        background: var(--ss-bg-soft, #f8fafc);
        border: 1px solid var(--ss-border, #e2e8f0);
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }
    .ss-med-field {
        flex: 1 1 calc(33.333% - 16px);
        min-width: 200px;
        box-sizing: border-box;
    }
    .ss-med-field label {
        display: block;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--ss-text-muted, #64748b);
        margin-bottom: 4px;
    }
    .ss-med-field input {
        width: 100% !important;
        box-sizing: border-box !important;
        border: 1px solid var(--ss-border, #cbd5e1) !important;
        border-radius: 8px !important;
        padding: 7px 12px !important;
        font-size: 13.5px !important;
        color: var(--ss-text-main, #0f172a) !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background: #ffffff !important;
    }
    .ss-med-field input:focus {
        border-color: var(--ss-primary, #6366f1) !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12) !important;
        outline: none !important;
    }
</style>

<div class="alert alert-success" id="svmsg" style="display:none; border-radius: 10px;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <span><i class="fa fa-check-circle"></i> Stock Updated Successfully!</span>
</div>

<div class="row-fluid sortable ui-sortable">
    <div class="box span12 ss-card">
        <div class="box-header well ss-card-header" data-original-title="">
            <h2><i class="fa fa-refresh"></i> <span>Fast Stock Update</span></h2>
        </div>
        <div class="box-content ss-card-body">
            <div class="scrollgard" style="overflow: auto">
                <form method="post" action="" id="medicine_update" onsubmit="return false"> 
                    <div class="medicine_chooser">  
                        <div class="ss-med-field">
                            <label>Medicine Name <span style="color:var(--ss-primary); font-size:10px;">(Auto-suggest)</span></label>
                            <input type="text" name="medicine_name" value="<?= html_escape($medicine_name) ?>" required="required" placeholder="Search medicine name...">
                        </div>
                        <div class="ss-med-field">
                            <label>Manufacturer</label>
                            <input type="text" name="medicine_manufacturer" value="<?= html_escape($medicine_manufacturer) ?>">
                        </div>
                        <div class="ss-med-field">
                            <label>Category</label>
                            <input type="text" name="medicine_category" value="<?= html_escape($medicine_category) ?>">
                        </div>
                        <div class="ss-med-field">
                            <label>HSN Code</label>
                            <input type="text" name="medicine_hsn" value="<?= html_escape($medicine_hsn) ?>">
                        </div>
                        <div class="ss-med-field">
                            <label>Unit</label>
                            <input type="text" name="medicine_unit" value="<?= html_escape($medicine_unit) ?>">
                        </div>
                        <div class="ss-med-field">
                            <label>Storage / Rack</label>
                            <input type="text" name="medicine_storage" value="<?= html_escape($medicine_storage) ?>">
                        </div>
                        <input type="hidden" readonly="true" name="medicine_id" value="<?= html_escape($medicine_id) ?>">
                    </div>

                    <div style="margin: 16px 0 12px 0;">
                        <h3 style="font-size: 15px; font-weight: 700; color: var(--ss-text-main, #0f172a); margin: 0 0 4px 0;">
                            <i class="fa fa-cubes" style="color: var(--ss-primary, #6366f1);"></i> Batch Stock Information
                        </h3>
                        <p style="font-size: 12.5px; color: var(--ss-text-muted, #64748b); margin: 0;">
                            Only medicines that have real purchase entries appear here.
                        </p>
                    </div>

                    <table class="table table-bordered table-striped table-condensed ss-modern-table">
                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Count Actual</th>
                                <th>Count Balance</th>
                                <th>Loose Actual</th>
                                <th>Loose Balance</th>
                                <th style="display:none">Update date</th>
                                <th>Expire Month</th>
                                <th>Expire Year</th>
                                <th>MRP</th>
                            </tr>
                        </thead> 
                        <tbody class="rowadd">
                        </tbody>
                    </table>   

                    <div class="form-actions ss-form-actions" style="margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--ss-border, #e2e8f0); display: flex; gap: 10px; justify-content: flex-end;">
                        <button type="submit" class="btn btn-primary ss-btn-primary">
                            <i class="fa fa-check"></i> Save Changes
                        </button>
                        <button type="button" class="btn btn-default" onclick="goBack()" style="border-radius: 8px;">
                            <i class="fa fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/span-->
</div>

<script>
    function removeRow(targetObj) {
        $(targetObj).parents('tr').remove();
    }
    function addrow() {
        var rowAdd = "<tr>\r\n" +
            "<td class=\"center\"><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"medicine_stock_batch[]\"></td>\r\n" +
            "<td class=\"center\"><input required=\"true\" type=\"number\" class=\"medicine_strip_stock\" readonly=\"true\"></td>\r\n" +
            "<td class=\"center\"><input type=\"number\" value=\"\" name=\"medicine_strip_stock[]\"></td>\r\n" +
            "<td class=\"center\"><input type=\"number\" readonly=\"true\" class=\"medicine_loose_stock\"></td>\r\n" +
            "<td class=\"center\"><input type=\"number\" value=\"\" name=\"medicine_loose_stock[]\"></td>\r\n" +
            "<td class=\"center\"><input required=\"true\" readonly=\"true\" type=\"number\" name=\"medicine_expire_month[]\"></td>\r\n" +
            "<td class=\"center\"><input required=\"true\" readonly=\"true\" type=\"number\" name=\"medicine_expire_year[]\"></td>\r\n" +
            "<td class=\"center\"><input required=\"true\" type=\"text\" readonly=\"true\" name=\"medicine_mrp[]\"></td>\r\n" +
            "</tr>";
        $('.rowadd').append(rowAdd);
    }
    $(document).ready(function () {
        $(document).find('[name^="medicine_name"]').autocomplete({
            source: '/search.php?table=medicines&fieldToSearch=medicine_name',
            search: function (event, ui) {
                $('.medicine_chooser').find('input').not('[name^="medicine_name"]').val('');
                $('.rowadd').html("");
            },
            select: function (event, ui) {
                $.each(ui.item.complete, function (populate_field, populate_value) {
                    $('[name^="' + populate_field + '"]').val(populate_value);
                });
                var medicine_id = ui.item.complete.medicine_id;
                $.post("/console/medicine_stock/get_info", {medicine_id: medicine_id}, function (resp) {
                    $('.rowadd').html(resp);
                });
            }
        });
        
        $('#medicine_update').submit(function () {
            $.post('/console/medicine_stock/fast_update', $(this).serialize(), function (res) {
                if (typeof toastr !== 'undefined') {
                    toastr.success("Stock updated successfully!");
                }
                $("#svmsg").show();
                setTimeout(function () {
                    $("#svmsg").hide();
                    location.reload();
                }, 1500);
            });
        });
    });
</script>
