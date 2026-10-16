<div class="row-fluid sortable">
    <div class="box span12 ss-card">
        <div class="box-header well ss-card-header" data-original-title>
            <h2><i class="fa fa-user-circle"></i> <span>Staff User Profile</span></h2>
            <div class="box-icon">
                <button class="btn btn-primary ss-btn-primary" onclick="editProfile()" style="font-size: 12.5px; padding: 5px 14px;">
                    <i class="fa fa-pencil"></i> Edit Profile
                </button>
            </div>
        </div>
        <div class="box-content ss-card-body" style="padding: 24px;">
            <div class="row-fluid" style="display:flex; flex-wrap:wrap; gap:20px;">
                <!-- Profile Avatar Card -->
                <div class="span4" style="margin-left: 0; min-width: 260px;">
                    <div style="background: var(--ss-bg-soft, #f8fafc); border: 1px solid var(--ss-border, #e2e8f0); border-radius: 14px; padding: 24px; text-align: center;">
                        <div style="width: 120px; height: 120px; margin: 0 auto 16px auto; position: relative;">
                            <img style="width: 100%; height: 100%; object-fit: cover; border-radius: 9999px; border: 3px solid #ffffff; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" 
                                 src='<?= !empty($table_meta['data']['user_image']) ? ($table_meta['config']['use_image_columns_path'][0] ? $table_meta['config']['use_image_columns_path'][0] : '' ) . $table_meta['data']['user_image'] : cdn_url() . 'uploads/noImage.jpg'; ?>' 
                                 alt="<?= html_escape($table_meta['data']['user_firstname']) ?>"/>
                            <span style="position: absolute; bottom: 4px; right: 8px; width: 14px; height: 14px; background: var(--ss-success, #10b981); border: 2.5px solid #ffffff; border-radius: 9999px;"></span>
                        </div>

                        <h3 style="font-size: 18px; font-weight: 800; color: var(--ss-text-main, #0f172a); margin: 0 0 4px 0;">
                            <?= html_escape($table_meta['data']['user_firstname'].' '.$table_meta['data']['user_lastname']) ?>
                        </h3>
                        <div style="display: inline-block; background: rgba(99, 102, 241, 0.1); color: var(--ss-primary, #6366f1); font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 3px 12px; border-radius: 9999px; margin-bottom: 16px;">
                            Active Staff
                        </div>

                        <div style="text-align: left; border-top: 1px solid var(--ss-border, #e2e8f0); padding-top: 14px; margin-top: 4px; font-size: 13px; color: var(--ss-text-body, #4b5563);">
                            <div style="margin-bottom: 8px; display:flex; align-items:center; gap:8px;">
                                <i class="fa fa-envelope-o" style="color: var(--ss-primary, #6366f1); width: 16px;"></i>
                                <span style="word-break: break-all;"><?= html_escape($table_meta['data']['user_email']) ?></span>
                            </div>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <i class="fa fa-map-marker" style="color: var(--ss-danger, #ef4444); width: 16px;"></i>
                                <span><?= !empty($table_meta['data']['user_address']) ? html_escape($table_meta['data']['user_address']) : 'Location not set' ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Details Table Card -->
                <div class="span8" style="margin-left: 0; flex: 1; min-width: 320px;">
                    <div style="background: #ffffff; border: 1px solid var(--ss-border, #e2e8f0); border-radius: 14px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                        <div style="padding: 14px 20px; background: var(--ss-bg-soft, #f8fafc); border-bottom: 1px solid var(--ss-border, #e2e8f0); display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-weight: 700; font-size: 13.5px; color: var(--ss-text-main, #0f172a); text-transform: uppercase; letter-spacing: 0.03em;">
                                <i class="fa fa-id-card-o" style="color: var(--ss-primary, #6366f1); margin-right: 6px;"></i> Detailed Credentials
                            </span>
                        </div>
                        <table class="table table-bordered table-striped ss-modern-table" style="margin-bottom: 0;">
                            <tbody>
                                <tr>    
                                    <td style="width: 30%; font-weight: 600; color: var(--ss-text-muted, #64748b);">Full Name</td>                    
                                    <td style="font-weight: 700; color: var(--ss-text-main, #0f172a);"><?= html_escape($table_meta['data']['user_firstname'].' '.$table_meta['data']['user_lastname']) ?></td>
                                </tr>
                                <tr>    
                                    <td style="font-weight: 600; color: var(--ss-text-muted, #64748b);">E-mail Address</td>                    
                                    <td style="color: var(--ss-text-body, #334155);"><?= html_escape($table_meta['data']['user_email']) ?></td>
                                </tr>
                                <tr>    
                                    <td style="font-weight: 600; color: var(--ss-text-muted, #64748b);">Primary Address</td>                    
                                    <td style="color: var(--ss-text-body, #334155);"><?= html_escape($table_meta['data']['user_address']) ?></td>
                                </tr>
                                <tr>    
                                    <td style="font-weight: 600; color: var(--ss-text-muted, #64748b);">Role & Notes</td>                    
                                    <td style="color: var(--ss-text-body, #334155);"><?= !empty($table_meta['data']['user_description']) ? html_escape($table_meta['data']['user_description']) : 'System Administrator / Medical Store Manager' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var saveOperation = function(method) {
        if (validate_form($('#addEditForm'), {
            beforeValidation: function(targetObject) {
                $(targetObject).parent().parent('.control-group').removeClass('error');
                $(targetObject).parent().parent('.control-group').find('.help-inline').html('');
            },
            onValidationError: function(targetObject, validationType) {
                $(targetObject).parent().parent('.control-group').addClass('error');
                switch (validationType) {
                    case 'required':
                        $(targetObject).parent().parent('.control-group').find('.help-inline').html('This is Required!');
                        break;
                    default:
                        $(targetObject).parent().parent('.control-group').find('.help-inline').html('Please enter valid data');
                }
            },
            captchaValidator: function(targetObject) {
                return validate_captcha(targetObject);
            },
            duplicateValidator: function(targetObject) {
                return duplicate_check(targetObject);
            }
        })) {
            currentPostRequest = $.post(page_url + 'edit_profile', $('#addEditForm').serialize(), function(respData) {
                if (respData.status == 'success') {
                    if (typeof toastr !== 'undefined') {
                        toastr.success(respData.message);
                    }
                    setTimeout(function() {
                        goBack();
                    }, 800);
                } else {
                    if (typeof toastr !== 'undefined') {
                        toastr.error(respData.message || 'Error saving profile');
                    } else {
                        alert(respData.message);
                    }
                }
            }, 'json');
        }
    }

    editProfile = function(targetItem) {
        currentPostRequest = $.post(page_url + 'edit_profile', {
            'load_edit_entry': ''
        }, function(respData) {
            if (respData != '') {
                $('.index-wrapper').html(respData);
                $('.breadcrumb').append('<li><span class="divider">></span></li><li><a href="javascript:void(0);">Edit Detail</a></li>');
                if (typeof $('.form-actions button.btn-primary').attr('onclick') == 'undefined') {
                    $('.form-actions button.btn-primary').attr('onclick', "saveOperation('edit')");
                }
                setTimeout(function() {
                    $('.iphone-toggle').iphoneStyle();
                    if (typeof $.fn.chosen !== 'undefined') {
                        $('[data-rel="chosen"],[rel="chosen"]').chosen();
                    }
                    $('.datepicker').each(function() {
                        var dateVal = $(this).val();
                        $(this).datepicker();
                        $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                        $(this).datepicker("setDate", dateVal);
                    });
                }, 300);
            }
        }, 'html');
    }
</script>