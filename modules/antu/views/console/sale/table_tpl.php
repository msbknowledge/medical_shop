<div class="table_view_wrapper">
    <?php
    $config['num_links'] = 2;
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['prev_link'] = '&lsaquo; Previous';
    $config['next_link'] = 'Next &rsaquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_link'] = 'Last &raquo;';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['first_link'] = '&laquo; First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['full_tag_open'] = '<ul class="pagination ss-pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/index/'; 

    $config = array_merge($config, $table_meta['config']);
    $this->pagination->initialize($config);
    if (count($table_meta['data'])) {
        $table_headers = array_keys($table_meta['data'][0]);
    }
    $table_allowed_header = is_array($config['list_columns']) ? 1000 : 4;
    ?>
    <div class="row-fluid sortable">	
        <div class="box span12 ss-card">
            <div class="box-header well ss-card-header" data-original-title>
                <h2><i class="fa fa-shopping-cart"></i> <span><?= $table_meta['config']['title'] ?></span></h2>
                <div class="box-icon">
                    <?php if (is_array($config['allowed_action']) && in_array('add_detail', $config['allowed_action']) !== FALSE): ?>
                        <a href="<?= console_url('sale/add_detail'); ?>" class="btn btn-primary ss-btn-primary" style="margin-right: 8px; font-size: 12.5px; padding: 5px 14px;">
                            <i class="fa fa-plus-circle"></i> Create Sale
                        </a>
                    <?php endif; ?>
                    <a href="#" class="btn btn-minimize btn-round"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="fa fa-times"></i></a>
                </div>
            </div>

            <div class="box-content ss-card-body">
                <?php if (count($table_meta['data'])) { ?>
                    <form method="post" action="" class="choose_entry_form">
                        <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE) { ?>
                            <div class="ss-table-toolbar" style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--ss-border, #e2e8f0);">
                                <div class="btn-group" style="display:flex; gap: 8px;">
                                    <button type="button" class="btn btn-default btn_select_all" title="Select the Entry of current list." data-rel="tooltip" style="border-radius: 8px; font-size: 12.5px; font-weight: 600;">
                                        <i class="fa fa-check-square-o"></i> Select All
                                    </button>
                                    <button type="button" class="btn btn-default btn_deselect_all" title="Clear the Selected Items." data-rel="tooltip" style="border-radius: 8px; font-size: 12.5px; font-weight: 600;">
                                        <i class="fa fa-square-o"></i> Clear Selected
                                    </button>
                                    <button type="button" onclick="popupDeleteAll()" class="btn btn-danger search_remove" title="Select and Delete Entry." data-rel="tooltip" style="border-radius: 8px; font-size: 12.5px; font-weight: 600;">
                                        <i class="fa fa-trash"></i> Delete Selected
                                    </button>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="scrollgard table-responsive" style="overflow-x: auto; width: 100%;">
                            <table class="table table-bordered table-striped table-condensed ss-modern-table">
                                <thead>
                                    <tr>
                                        <?php if ($config['enable_ordering']): ?>
                                            <th style="width: 40px; text-align: center;">Order</th>
                                        <?php endif; ?>
                                        <?php $th_key = 0; ?>
                                        <?php if ($config['tablePrimaryKey']): ?>
                                            <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                                <th style="width: 36px; text-align: center;">
                                                    <i class="fa fa-check-square"></i>
                                                </th>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php foreach ($table_headers as $table_th): ?>
                                            <?php
                                            if ($table_allowed_header < ++$th_key) {
                                                break;
                                            } else {
                                                if (is_array($config['list_columns'])) {
                                                    if (in_array($table_th, $config['list_columns']) === FALSE) {
                                                        continue;
                                                    }
                                                }
                                            }
                                            ?>
                                            <th>
                                                <div style="display:inline-flex; align-items:center; gap:6px;">
                                                    <span><?= ucwords(str_replace('_', ' ', (str_replace(array_keys($this->page_config['replace_text']), array_values($this->page_config['replace_text']), $table_th)))) ?></span>
                                                    <i data-rel="<?= $table_th ?>" class="fa fa-sort shorter" style="cursor: pointer; opacity: 0.5;"></i>
                                                </div>
                                            </th>
                                        <?php endforeach; ?>
                                        <th style="text-align: right; min-width: 170px;">Actions</th> 
                                    </tr>
                                </thead> 
                                <?php if ($config['enable_ordering']): ?>
                                    <tbody class='orderable'>
                                <?php else: ?>
                                    <tbody>
                                <?php endif; ?>
                                    <?php foreach ($table_meta['data'] as $table_tr): ?>
                                        <?php if ($config['tablePrimaryKey']): ?>    
                                            <tr id='row_<?= $table_tr[$config['tablePrimaryKey']] ?>'>
                                        <?php else: ?>
                                            <tr>
                                        <?php endif; ?>
                                            <?php if ($config['enable_ordering']): ?>
                                                <td class="center" style="text-align: center; vertical-align: middle;"><span class="fa fa-arrows" style="color: var(--ss-text-muted, #94a3b8); cursor: move;"></span></td>    
                                            <?php endif; ?>
                                            <?php $td_key = 0; ?>
                                            <?php if ($config['tablePrimaryKey']): ?>
                                                <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                                    <td class="center" style="text-align: center; vertical-align: middle;">
                                                        <input class="selectedItem" type="checkbox" value="<?= base64_encode($table_tr['sale_invoice']); ?>" name="selectedItem[]">
                                                    </td> 
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php foreach ($table_tr as $t_key => $table_td): ?>
                                                <?php
                                                if ($table_allowed_header < ++$td_key) {
                                                    break;
                                                } else {
                                                    if (is_array($config['list_columns'])) {
                                                        if (in_array($t_key, $config['list_columns']) === FALSE) {
                                                            continue;
                                                        }
                                                    }

                                                    if (is_array($config['use_status_columns'])) {
                                                        if (in_array($t_key, $config['use_status_columns']) === TRUE) {
                                                            ?> 
                                                            <td class="center" style="vertical-align: middle;">                                                                                          
                                                                <?php
                                                                switch (intval($table_td)) {
                                                                    case 1 :
                                                                        echo '<span class="ss-badge ss-badge-success"><i class="fa fa-check-circle"></i> On</span>';
                                                                        break;
                                                                    default :
                                                                        echo '<span class="ss-badge ss-badge-danger"><i class="fa fa-times-circle"></i> Off</span>';
                                                                }
                                                                ?>
                                                            </td> <?php
                                                            continue;
                                                        }
                                                    }
                                                    if (is_array($config['use_dropdown_columns_options'])) {
                                                        if (array_key_exists($t_key, $config['use_dropdown_columns_options']) === TRUE) {
                                                            ?> 
                                                            <td class="center" style="vertical-align: middle;">                                                                                          
                                                                <?php
                                                                if (isset($config['use_dropdown_columns_options']['multi'][$t_key])) {
                                                                    $table_td = json_decode($table_td, TRUE);
                                                                    foreach ($table_td as $m_key => $m_value) {
                                                                        if ($m_key > 0) {
                                                                            echo ', ';
                                                                        }
                                                                        echo $config['use_dropdown_columns_options'][$t_key][$m_value];
                                                                    }
                                                                } else {
                                                                    echo isset($config['use_dropdown_columns_options'][$t_key][$table_td]) ? $config['use_dropdown_columns_options'][$t_key][$table_td] : 'N/A';
                                                                }
                                                                ?>                                                        
                                                            </td> <?php
                                                            continue;
                                                        }
                                                    }

                                                    if (is_array($config['use_image_columns'])) {
                                                        $arr_index = array_search($t_key, $config['use_image_columns']);
                                                        if ($arr_index !== FALSE) {
                                                            ?> 
                                                            <td class="center" style="vertical-align: middle; text-align: center;">                                                                                          
                                                                <img style="width:48px; height:48px; object-fit:cover; border-radius:8px; border:1px solid var(--ss-border, #e2e8f0);" src='<?= $table_td ? $table_meta['config']['use_image_columns_path'][0] . $table_td : cdn_url() . 'uploads/noImage.jpg' ?>' alt="<?= $table_td ?>" />
                                                            </td> <?php
                                                            continue;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <td class="center" style="vertical-align: middle;">
                                                    <?php if (is_array($config['allowed_action']) && in_array('quick_edit', $config['allowed_action']) !== FALSE) { ?>
                                                        <span class="ss-quick-edit" relId="<?= $table_tr[$config['tablePrimaryKey']]; ?>" relfield="<?= $t_key ?>" onclick="quickEdit(this)" id="<?= $t_key . '-' . $table_tr[$config['tablePrimaryKey']] ?>" title="Click To Quick Edit">
                                                            <?= strip_tags($table_td) ?>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span style="font-weight: 500;"><?= strip_tags($table_td); ?></span>
                                                    <?php } ?>
                                                </td>
                                            <?php endforeach; ?>

                                            <td class="center ss-actions-cell" style="vertical-align: middle; text-align: right; white-space: nowrap;">
                                                <div style="display:inline-flex; align-items:center; gap: 4px; justify-content: flex-end;">
                                                    <?php if (is_array($config['allowed_action']) && in_array('view_detail', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action view" title="View Invoice" data-rel="tooltip" target="_blank" href="<?= console_url('sale/view_detail/'.base64_encode($table_tr['sale_invoice'])); ?>">
                                                            <i class="fa fa-eye"></i>  
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (is_array($config['allowed_action']) && in_array('edit_detail', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action edit" title="Edit Sale" data-rel="tooltip" target="_blank" href="<?= console_url('sale/edit_detail/'. base64_encode($table_tr['sale_invoice'])); ?>">
                                                            <i class="fa fa-pencil"></i>  
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action delete" title="Delete" data-rel="tooltip" href="#" onclick="popupDeleteSingle('<?= base64_encode($table_tr['sale_invoice']) ?>')">
                                                            <i class="fa fa-trash-o"></i> 
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (is_array($config['allowed_action']) && in_array('sale_return', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action return" title="Sale Return" data-rel="tooltip" href="<?= console_url('sale/sale_return/'.base64_encode($table_tr['sale_invoice'])); ?>">
                                                            <i class="fa fa-undo"></i> 
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (is_array($config['allowed_action']) && in_array('mail', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action mail" title="Email Invoice" data-rel="tooltip" href="#" onclick="sentMail('<?= base64_encode($table_tr['sale_invoice']) ?>')">
                                                            <i class="fa fa-envelope-o"></i>  
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (is_array($config['allowed_action']) && in_array('download', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action download" title="Download PDF" data-rel="tooltip" href="<?= console_url('sale/downloadPdf/'.base64_encode($table_tr['sale_invoice'])); ?>">
                                                            <i class="fa fa-file-pdf-o"></i>  
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (is_array($config['allowed_action']) && in_array('print', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action print" title="Print Invoice" data-rel="tooltip" target="_blank" href="<?= console_url('sale/view_detail/'.base64_encode($table_tr['sale_invoice'])); ?>/print">
                                                            <i class="fa fa-print"></i> 
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>                          
                                </tbody>
                            </table>  
                        </div>
                    </form>    
                    <div class="pagination pagination-centered ss-pagination-wrap" style="margin-top: 20px;">
                        <?= $this->pagination->create_links(); ?>
                    </div>  
                <?php } else { ?>
                    <div class="ss-empty-state" style="text-align: center; padding: 48px 20px; background: var(--ss-bg-soft, #f8fafc); border-radius: 12px; border: 1.5px dashed var(--ss-border, #e2e8f0); margin: 20px 0;">
                        <i class="fa fa-shopping-cart" style="font-size: 42px; color: var(--ss-text-muted, #94a3b8); margin-bottom: 12px; display: block;"></i>
                        <h4 style="font-size: 16px; font-weight: 700; color: var(--ss-text-main, #0f172a); margin: 0 0 6px 0;">No Sales Records Found</h4>
                        <p style="font-size: 13px; color: var(--ss-text-muted, #64748b); margin: 0;">Start by creating your first sale invoice.</p>
                        <?php if (is_array($config['allowed_action']) && in_array('add_detail', $config['allowed_action']) !== FALSE): ?>
                            <a href="<?= console_url('sale/add_detail'); ?>" class="btn btn-primary ss-btn-primary" style="margin-top: 14px;">
                                <i class="fa fa-plus-circle"></i> Create Sale
                            </a>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->

    <script>
    generateDetailedView = function (targetItem) {
        var viewSingleOperation = function (targetItem) {
            currentPostRequest = $.post(page_url + 'view_detail', {
                entry: targetItem
            }, function (respData) {
                if (respData != '') {
                    $('.index-wrapper').html(respData);
                    if ($('.br_det').length == 0)
                        $('.breadcrumb').append('<li class="br_det"><a href="javascript:void(0);">Details</a></li>');
                    postDetailLoad();
                }
            }, 'html');
        }
        viewSingleOperation(targetItem);
    }

    generateEditView = function (targetItem) {
        var loadEditForm = function (targetItem) {
            currentPostRequest = $.post(page_url + 'edit_detail', {
                'load_edit_entry': targetItem
            }, function (respData) {
                if (respData != '') {
                    $('.index-wrapper').html(respData);
                    if ($('.br_edt').length == 0)
                        $('.breadcrumb').append('<li class="br_edt"><a href="javascript:void(0);">Edit Detail</a></li>');
                    if (typeof $('.form-actions button.btn-primary').attr('onclick') == 'undefined') {
                        $('.form-actions button.btn-primary').attr('onclick', "saveOperation('edit')");
                    }
                    setTimeout(function () {
                        $('.iphone-toggle').iphoneStyle();
                        $('[data-rel="chosen"],[rel="chosen"]').chosen();
                        $('.datepicker').each(function () {
                            dateVal = $(this).val();
                            $(this).datepicker();
                            $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                            $(this).datepicker("setDate", dateVal);
                        });
                        $('.datetimepicker').each(function () {
                            $(this).datetimepicker({format: 'Y-m-d H:i:s'});
                        });
                    }, 300);
                }
            }, 'html');
        }
        loadEditForm(targetItem);
    }

    generateAddView = function (targetItem) {
        var loadAddForm = function () {
            currentPostRequest = $.post(page_url + 'add_detail', {
                'load_add_entry': 'yes'
            }, function (respData) {
                if (respData != '') {
                    $('.index-wrapper').html(respData);
                    if ($('.br_add').length == 0)
                        $('.breadcrumb').append('<li class="br_add"><a href="javascript:void(0);">Add Detail</a></li>');
                    if (typeof $('.form-actions button.btn-primary').attr('onclick') == 'undefined') {
                        $('.form-actions button.btn-primary').attr('onclick', "saveOperation('add')");
                    }
                    setTimeout(function () {
                        $('.iphone-toggle').iphoneStyle();
                        $('.chosen-select-deselect').chosen({
                            allow_single_deselect: true
                        });
                        $('[data-rel="chosen"],[rel="chosen"]').chosen();
                        $('.datepicker').each(function () {
                            dateVal = $(this).val();
                            $(this).datepicker();
                            $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                            $(this).datepicker("setDate", dateVal);
                        });
                        $('.datetimepicker').each(function () {
                            $(this).datetimepicker({format: 'Y-m-d H:i:s'});
                        });
                    }, 300);
                }
            }, 'html');
        }
        loadAddForm(targetItem);
    }

    var saveOperation = function (method) {
        if (validate_form($('#addEditForm'), {
            beforeValidation: function (targetObject) {
                $(targetObject).parent().parent('.control-group').removeClass('error');
                $(targetObject).parent().parent('.control-group').find('.help-inline').html('');
            },
            onValidationError: function (targetObject, validationType) {
                $(targetObject).parent().parent('.control-group').addClass('error');
                switch (validationType) {
                    case 'required':
                        $(targetObject).parent().parent('.control-group').find('.help-inline').html('This is Required!!');
                        break;
                    default:
                        $(targetObject).parent().parent('.control-group').find('.help-inline').html('Please Enter A valid Data');
                }
            },
            captchaValidator: function (targetObject) {
                return validate_captcha(targetObject);
            },
            duplicateValidator: function (targetObject) {
                return duplicate_check(targetObject);
            }
        })) {
            var postUrl = '';
            if (method == 'add') {
                postUrl = page_url + 'add_detail';
            }
            if (method == 'edit') {
                postUrl = page_url + 'edit_detail';
            }
            currentPostRequest = $.post(postUrl, $('#addEditForm').serialize(), function (respData) {
                if (respData.status = 'success') {
                    if (typeof toastr !== 'undefined') {
                        toastr.success(respData.message);
                    }
                    setTimeout(function () {
                        goBack();
                    }, 1000);
                }
            }, 'json');
        }
    }

    <?php if ($config['is_ajax']): ?>
        var loadAjaxPagination = setInterval(function () {
            if (typeof ajaxPagination == 'function') {
                initAjaxPagination();
            }
        }, 100);
        initAjaxPagination = function () {
            ajaxPagination();
            clearInterval(loadAjaxPagination);
        }
    <?php endif; ?>

    var quickEdit = function (targetItem) {
        $(targetItem).hide();
        $(targetItem).parent().append('<input type="text" value="' + $.trim($(targetItem).html()) + '">');
        var targetElement = $(targetItem).parent().find('input');
        $(targetElement).blur(function () {
            $(targetItem).html($(targetElement).val());
            currentPostRequest = $.post(page_url + 'quick_edit', {
                targetItem: $(targetItem).attr('relfield')+'-'+$(targetItem).attr('relId'),
                targetValue: $(targetElement).val(),
            }, function (respData) {
               $(targetElement).remove();
               $(targetItem).show();
            }, 'json');
        });
    }

    function sentMail(invoiceId) {
        $.post(page_url + 'mailInvoice', { invoice_id: invoiceId }, function(response) {
            if (response.status === 'success') {
                if (typeof toastr !== 'undefined') {
                    toastr.success(response.message);
                } else {
                    alert(response.message);
                }
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error(response.message);
                } else {
                    alert(response.message);
                }
            }
        }, 'json')
        .fail(function(xhr, status, error) {
            if (typeof toastr !== 'undefined') {
                toastr.warning('Could not send the mail. Please try again later.');
            } else {
                alert('Could not send the mail.');
            }
        });
    }
    </script>
</div>
