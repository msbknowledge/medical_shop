<style>
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==')
        right center no-repeat;
    }
    .ss-form-row {
        display: flex;
        flex-wrap: wrap;
        margin: -8px;
    }
    .ss-form-col {
        padding: 8px;
        box-sizing: border-box;
    }
    .ss-form-col.col-4 {
        width: 33.3333%;
    }
    .ss-form-col.col-8 {
        width: 66.6666%;
    }
    .ss-form-col.col-12 {
        width: 100%;
    }
    @media (max-width: 768px) {
        .ss-form-col.col-4,
        .ss-form-col.col-8 {
            width: 100%;
        }
    }
    .ss-field-card {
        background: #ffffff;
        border: 1px solid var(--ss-border, #e2e8f0);
        border-radius: 10px;
        padding: 12px 14px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        height: 100%;
        box-sizing: border-box;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .ss-field-card:focus-within {
        border-color: var(--ss-primary, #6366f1);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
    }
    .ss-field-label {
        display: block;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--ss-text-muted, #64748b);
        margin-bottom: 6px;
    }
    .ss-field-card input[type="text"],
    .ss-field-card select,
    .ss-field-card textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid var(--ss-border, #cbd5e1);
        border-radius: 6px;
        padding: 7px 10px;
        font-size: 13.5px;
        color: var(--ss-text-main, #0f172a);
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #fff;
    }
    .ss-field-card input[type="text"]:focus,
    .ss-field-card select:focus,
    .ss-field-card textarea:focus {
        outline: none;
        border-color: var(--ss-primary, #6366f1);
    }
    .ss-field-card .input-prepend {
        display: flex;
        width: 100%;
    }
    .ss-field-card .input-prepend .add-on {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        background: var(--ss-bg-soft, #f8fafc);
        border: 1px solid var(--ss-border, #cbd5e1);
        border-right: none;
        border-radius: 6px 0 0 6px;
        color: var(--ss-text-muted, #64748b);
    }
    .ss-field-card .input-prepend input {
        border-radius: 0 6px 6px 0;
        flex: 1;
    }
</style>
<?php
error_reporting(4);

/**
 * add_edit view helper functions
 */
if (!function_exists('field_datepicker')) {
    function field_datepicker($t_key = NULL, $table_meta, $table_td) {
        if (is_array($table_meta['config']['datepicker_columns'])) {
            $arr_index = array_search($t_key, $table_meta['config']['datepicker_columns']);
            if ($arr_index !== FALSE) {
                ?> 
                <div class="ss-form-col col-4">
                    <div class="ss-field-card">
                        <label class="ss-field-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                        <div class="input-prepend">
                            <span class="add-on"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="datepicker" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                        </div>
                    </div>
                </div>
                <?php
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('field_date_time_picker')) {
    function field_date_time_picker($t_key = NULL, $table_meta, $table_td) {
        if (is_array($table_meta['config']['datetimepicker_columns'])) {
            $arr_index = array_search($t_key, $table_meta['config']['datetimepicker_columns']);
            if ($arr_index !== FALSE) {
                ?>
                <div class="ss-form-col col-4">
                    <div class="ss-field-card">
                        <label class="ss-field-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                        <div class="input-prepend">
                            <span class="add-on"><i class="fa fa-clock-o"></i></span>
                            <input type="text" class="datetimepicker" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                        </div>
                    </div>
                </div>
                <?php
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('field_status')) {
    function field_status($t_key, $table_meta, $table_td) {
        if (is_array($table_meta['config']['use_status_columns'])) {
            if (in_array($t_key, $table_meta['config']['use_status_columns']) === TRUE) {
                ?>
                <div class="ss-form-col col-4">
                    <div class="ss-field-card">
                        <label class="ss-field-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                        <div style="display:flex; align-items:center; gap:10px; margin-top:4px;">
                            <?php
                            switch (intval($table_td)) {
                                case 1 :
                                    echo '<span class="ss-badge ss-badge-success"><i class="fa fa-check-circle"></i> Enabled</span>';
                                    break;
                                default :
                                    echo '<span class="ss-badge ss-badge-danger"><i class="fa fa-times-circle"></i> Disabled</span>';
                            }
                            ?>
                            <input name="<?= $t_key ?>" data-no-uniform="true" type="checkbox" class="iphone-toggle" <?php
                            if (intval($table_td)) {
                                echo 'checked="checked"';
                            }
                            ?> value="1">
                        </div>
                    </div>
                </div>
                <?php
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('field_textarea')) {
    function field_textarea($t_key = NULL, $table_meta, $table_td) {
        if (is_array($table_meta['config']['textarea_columns'])) {
            $arr_index = array_search($t_key, $table_meta['config']['textarea_columns']);
            if ($arr_index !== FALSE) {
                ?>
                <div class="ss-form-col col-8">
                    <div class="ss-field-card">
                        <label class="ss-field-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                        <textarea class="cleditorx" name="<?= $t_key ?>" id="textarea2" rows="3" style="width:100%"><?= $table_td ?></textarea>
                    </div>
                </div>
                <?php
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('is_primry_key')) {
    function is_primry_key($t_key = NULL, $table_meta) {
        if ($table_meta['config']['tablePrimaryKey'] == $t_key)
            return TRUE;
        else
            return FALSE;
    }
}

if (!function_exists('field_image')) {
    function field_image($t_key = NULL, $table_meta, $table_td) {
        if (is_array($table_meta['config']['use_image_columns'])) {
            $arr_index = array_search($t_key, $table_meta['config']['use_image_columns']);
            if ($arr_index !== FALSE) {
                ?>
                <div class="ss-form-col col-4">
                    <div class="ss-field-card">
                        <label class="ss-field-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                        <div style="display:flex; gap:10px; align-items:center;">
                            <img id="file_uploader_image<?= $t_key ?>" class="file_uploaded_img" style="width:54px; height:54px; object-fit:cover; border-radius:8px; border:1px solid var(--ss-border, #e2e8f0);" src='<?= $table_td ? ($table_meta['config']['use_image_columns_path'][0] ? $table_meta['config']['use_image_columns_path'][0] : '' ) . $table_td : cdn_url() . 'uploads/noImage.jpg'; ?>' alt="<?= $table_td ?>"/>
                            <div style="flex:1;">
                                <input type="hidden" id="file_uploader_field<?= $t_key ?>" name="<?= $t_key ?>" value="<?= $table_td ?>"/>
                                <input type="file" data-no-uniform="true" id="file_uploader<?= $t_key ?>" />
                            </div>
                        </div>
                    </div>

                    <script>
                        $('#file_uploader<?= $t_key ?>').uploadify({
                            'swf': '<?= cdn_url() ?>js/uploadify.swf',
                            'uploader': '<?= cdn_url() ?>uploader/',
                            'multi': <?= $table_meta['config']['multi_upload'] ?>,
                            'onUploadSuccess': function (file, data, response) {
                                $('#file_uploader_image<?= $t_key ?>').attr('src', '<?= $table_meta['config']['use_image_columns_path'][0] ?>' + $.trim(data));
                                $('#file_uploader_field<?= $t_key ?>').val($.trim(data));
                            }
                        });
                    </script>
                </div>
                <?php
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('field_dropdown')) {
    function field_dropdown($t_key = NULL, $table_meta, $table_td) {
        if (is_array($table_meta['config']['use_dropdown_columns_options'])) {
            $arr_index = array_key_exists($t_key, $table_meta['config']['use_dropdown_columns_options']);
            if ($arr_index !== FALSE) {
                ?>
                <div class="ss-form-col col-4">
                    <div class="ss-field-card">
                        <label class="ss-field-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                        <select <?= is_readonly($t_key, $table_meta['config']['readonly_columns']) ? 'disabled = "disabled"' : '' ?>
                            <?= isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key]) ? " multiple name='" . $t_key . "[]'" : " name='$t_key'" ?> data-placeholder="Choose option" data-rel="chosen" class="ss-select">
                            <option value="">-- Choose Option --</option>
                            <?php
                            $optionList = (isset($table_meta['config']['use_dropdown_columns_options'][$t_key]) ? $table_meta['config']['use_dropdown_columns_options'][$t_key] : $table_meta['config']['use_dropdown_columns_options']);
                            foreach ($optionList as $optkey => $optvalue):
                                ?>
                                <option value="<?= $optkey ?>" <?php
                                if (isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key])) {
                                    if (!empty($table_td) && array_search($optkey, json_decode($table_td, TRUE)) !== FALSE) {
                                        ?>selected="selected"<?php
                                    }
                                } else {
                                    if ($optkey == $table_td) {
                                        ?>selected="selected"<?php
                                    }
                                }
                                ?>><?= $optvalue ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('field_text')) {
    function field_text($t_key = NULL, $table_meta, $table_td) {
        if (is_readonly($t_key, $table_meta) || is_primry_key($t_key, $table_meta)) {
            ?>
            <div class="ss-form-col col-4">
                <div class="ss-field-card" style="background: var(--ss-bg-soft, #f8fafc);">
                    <label class="ss-field-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?> <span style="font-size:10px; color:var(--ss-text-muted);">(Read Only)</span></label>
                    <input type="text" readonly="readonly" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>" autocomplete="off" style="background: transparent; border-style: dashed;">
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="ss-form-col col-4">
                <div class="ss-field-card">
                    <label class="ss-field-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <input type="text" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                </div>
            </div>
            <?php
        }
    }
}
?>

<form id="addEditForm" method="post" action="save_details" onsubmit="return false">
    <div class="ss-form-row">
        <?php foreach ($table_meta['data'] as $t_key => $table_td): ?>
            <?php
            if (!is_array($table_td))
                $field_value = $table_td;

            if (field_status($t_key, $table_meta, $field_value))
                continue;
            if (field_image($t_key, $table_meta, $field_value))
                continue;
            if (field_dropdown($t_key, $table_meta, $field_value))
                continue;
            if (field_textarea($t_key, $table_meta, $field_value))
                continue;
            if (field_datepicker($t_key, $table_meta, $field_value))
                continue;
            if (field_date_time_picker($t_key, $table_meta, $field_value))
                continue;
            field_text($t_key, $table_meta, $field_value);
            ?>
        <?php endforeach; ?> 
    </div>
    
    <div class="form-actions ss-form-actions" style="margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--ss-border, #e2e8f0); display: flex; gap: 10px; justify-content: flex-end;">
        <button type="submit" class="btn btn-primary ss-btn-primary" style="font-weight: 700; padding: 8px 20px;">
            <i class="fa fa-check"></i> Save Changes
        </button>
        <button type="button" class="btn btn-default" onclick="goBack()" style="font-weight: 600; padding: 8px 16px; border-radius: 8px;">
            <i class="fa fa-times"></i> Cancel
        </button>
    </div>    
</form>

<script>
    var validationMeta = $.parseJSON('<?= json_encode($table_meta['config']['validation']); ?>');
    
    $.each(validationMeta, function (key, value) {
        $('#addEditForm').find('[name=' + key + ']').attr('from-validation', value);
    });

    $(document).ready(function() {
        setTimeout(function() {
            $('.iphone-togglex').iphoneStyle();
            if (typeof $.fn.uploadify !== 'undefined' && $('.file_uploader<?= isset($t_key) ? $t_key : '' ?>').length) {
                $('.file_uploader<?= isset($t_key) ? $t_key : '' ?>').uploadify({
                    'swf': '<?= cdn_url() ?>js/uploadify.swf',
                    'uploader': '<?= cdn_url() ?>uploader/',
                    'multi': <?= $table_meta['config']['multi_upload'] ?>,
                    'onUploadSuccess': function(file, data, response) {
                        $('.file_uploaded_img').attr('src', '<?= $table_meta['config']['use_image_columns_path'][0] ?>' + $.trim(data));
                        $('#file_uploader_field<?= isset($t_key) ? $t_key : '' ?>').val($.trim(data));
                    }
                });
            }
        }, 200);
    });

    if (typeof $.fn.cleditor !== 'undefined') {
        $('.cleditor').cleditor();
    }

    <?php if (isset($this->page_config['autocomplete'])): ?>
        var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
        $.each(autoComplete, function (targetField, value) {
            $.each(value, function (model, fieldToSearch) {
                $('[name="' + targetField + '"]').autocomplete({
                    source: page_url + "autocomplete/" + model + '/' + fieldToSearch,
                    minLength: 1
                });
            });
        });
    <?php endif; ?>

    $(function () {
        if ($('[name="payment_invoice"]').length) {
            $('[name="payment_invoice"]').val('<?= generate_invoice_number() ?>').prop('readonly', true);
        }
    });
</script>
