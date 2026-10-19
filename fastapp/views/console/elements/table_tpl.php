<div class="table_view_wrapper">
<style>
    .table_view_wrapper .ss-card {
        border-radius: 10px !important;
        margin-bottom: 16px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 4px rgba(0,0,0,0.03) !important;
        overflow: hidden !important;
        background: #ffffff !important;
    }
    .table_view_wrapper .ss-card-header {
        padding: 8px 16px !important;
        background: #ffffff !important;
        border-bottom: 1px solid #f1f5f9 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }
    .table_view_wrapper .ss-card-header h2 {
        font-size: 12.5px !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    .table_view_wrapper .ss-card-header h2 i {
        color: #6366f1 !important;
        font-size: 12px !important;
    }
    .table_view_wrapper .ss-card-body {
        padding: 10px 16px !important;
    }
    .table_view_wrapper .ss-table-toolbar {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 8px !important;
        padding-bottom: 8px !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table_view_wrapper .ss-table-toolbar .btn {
        border-radius: 5px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        padding: 3px 8px !important;
        line-height: 1.4 !important;
    }
    .table_view_wrapper .ss-modern-table thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.04em !important;
        padding: 6px 10px !important;
        border-top: none !important;
        border-bottom: 1.5px solid #e2e8f0 !important;
        border-left: none !important;
        border-right: 1px solid #f1f5f9 !important;
        vertical-align: middle !important;
        white-space: nowrap !important;
        line-height: 1.3 !important;
    }
    .table_view_wrapper .ss-modern-table tbody td {
        padding: 5px 10px !important;
        border-top: 1px solid #f1f5f9 !important;
        border-left: none !important;
        border-right: 1px solid #f1f5f9 !important;
        border-bottom: none !important;
        font-size: 11.5px !important;
        color: #334155 !important;
        vertical-align: middle !important;
        background: #ffffff !important;
        line-height: 1.35 !important;
        transition: background 0.15s ease !important;
    }
    .table_view_wrapper .ss-modern-table tbody tr:hover td {
        background: rgba(99, 102, 241, 0.025) !important;
    }
    .table_view_wrapper .ss-btn-action {
        width: 24px !important;
        height: 24px !important;
        border-radius: 5px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03) !important;
        transition: all 0.15s ease !important;
        padding: 0 !important;
        font-size: 10.5px !important;
        color: #64748b !important;
    }
    .table_view_wrapper .ss-btn-action:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.06) !important;
    }
    .table_view_wrapper .ss-btn-action.view:hover {
        background: #f0fdf4 !important;
        border-color: #86efac !important;
        color: #16a34a !important;
    }
    .table_view_wrapper .ss-btn-action.edit:hover {
        background: #eff6ff !important;
        border-color: #93c5fd !important;
        color: #2563eb !important;
    }
    .table_view_wrapper .ss-btn-action.delete:hover {
        background: #fef2f2 !important;
        border-color: #fca5a5 !important;
        color: #dc2626 !important;
    }
    .table_view_wrapper .ss-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 3px !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        padding: 2px 7px !important;
        border-radius: 4px !important;
        letter-spacing: 0.02em !important;
        text-transform: uppercase !important;
    }
    .table_view_wrapper .selectedItem {
        margin: 0 !important;
        vertical-align: middle !important;
        transform: scale(0.9);
        cursor: pointer;
    }
    .table_view_wrapper .box-icon a.btn-round,
    .table_view_wrapper .btn-minimize,
    .table_view_wrapper .btn-close {
        display: none !important;
    }
    .table_view_wrapper .ss-pagination-wrap {
        margin-top: 10px !important;
        margin-bottom: 0 !important;
    }
    .table_view_wrapper .pagination ul > li > a,
    .table_view_wrapper .pagination ul > li > span {
        padding: 3px 8px !important;
        font-size: 11px !important;
        line-height: 16px !important;
        border-radius: 4px !important;
    }
</style>

    <?php
    $config['num_links'] = 2;
    $config['cur_tag_open'] = '<li class="active ss-page-item"><a href="javascript:void(0);" class="active">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li class="ss-page-item">';
    $config['num_tag_close'] = '</li>';
    $config['first_link'] = '<i class="fa fa-angle-double-left"></i> First';
    $config['first_tag_open'] = '<li class="ss-page-item first">';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '<i class="fa fa-angle-left"></i> Prev';
    $config['prev_tag_open'] = '<li class="ss-page-item prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = 'Next <i class="fa fa-angle-right"></i>';
    $config['next_tag_open'] = '<li class="ss-page-item next">';
    $config['next_tag_close'] = '</li>';
    $config['last_link'] = 'Last <i class="fa fa-angle-double-right"></i>';
    $config['last_tag_open'] = '<li class="ss-page-item last">';
    $config['last_tag_close'] = '</li>';
    $config['full_tag_open'] = '<ul class="pagination ss-pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['base_url'] = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/index/'; 
    $config = array_merge($config, $table_meta['config']);
    $this->pagination->initialize($config);
    if (count($table_meta['data'])) {
        $table_headers = array_keys($table_meta['data'][0]);
    }
    $table_allowed_header = is_array($config['list_columns']) ? 1000 : 6;
    ?>
    <div class="row-fluid sortable">	
        <div class="box span12 ss-card">
            <div class="box-header well ss-card-header" data-original-title>
                <h2><i class="fa fa-list-ul"></i> <span><?= $table_meta['config']['title'] ?></span></h2>
                <div class="box-icon" style="display:flex; align-items:center; gap:5px;">
                    <?php if (is_array($config['allowed_action']) && in_array('add_detail', $config['allowed_action']) !== FALSE): ?>
                        <a href="javascript:void(0);" onclick="popupAddNew()" class="btn btn-primary ss-btn-primary" style="margin-right: 4px; font-size: 11px; padding: 3px 9px; border-radius: 5px;">
                            <i class="fa fa-plus-circle"></i> Add New
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="box-content ss-card-body">
                <?php if (count($table_meta['data'])) { ?>
                    <form method="post" action="" class="choose_entry_form">
                        <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE) { ?>
                            <div class="ss-table-toolbar">
                                <div class="btn-group" style="display:flex; gap: 6px;">
                                    <button type="button" class="btn btn-default btn_select_all" title="Select the Entry of current list." data-rel="tooltip">
                                        <i class="fa fa-check-square-o"></i> Select All
                                    </button>
                                    <button type="button" class="btn btn-default btn_deselect_all" title="Clear the Selected Items." data-rel="tooltip">
                                        <i class="fa fa-square-o"></i> Clear Selected
                                    </button>
                                    <button type="button" onclick="popupDeleteAll()" class="btn btn-danger search_remove" title="Select and Delete Entry." data-rel="tooltip">
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
                                            <th style="width: 32px; text-align: center;">Order</th>
                                        <?php endif; ?>
                                        <?php $th_key = 0; ?>
                                        <?php if ($config['tablePrimaryKey']): ?>
                                            <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                                <th style="width: 30px; text-align: center;">
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
                                                <div style="display:inline-flex; align-items:center; gap:4px;">
                                                    <span><?= ucwords(str_replace('_', ' ', (str_replace(array_keys($this->page_config['replace_text']), array_values($this->page_config['replace_text']), $table_th)))) ?></span>
                                                    <i data-rel="<?= $table_th ?>" class="fa fa-sort shorter" style="cursor: pointer; opacity: 0.5; font-size: 9.5px;"></i>
                                                </div>
                                            </th>
                                        <?php endforeach; ?>
                                        <th style="text-align: right; min-width: 90px;">Actions</th> 
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
                                                <td class="center" style="text-align: center; vertical-align: middle;"><span class="fa fa-arrows" style="color: var(--ss-text-muted, #94a3b8); cursor: move; font-size: 11px;"></span></td>    
                                            <?php endif; ?>
                                            <?php $td_key = 0; ?>
                                            <?php if ($config['tablePrimaryKey']): ?>
                                                <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                                    <td class="center" style="text-align: center; vertical-align: middle; width: 30px;">
                                                        <input class="selectedItem" type="checkbox" value="<?= $table_tr[$config['tablePrimaryKey']] ?>" name="selectedItem[]">
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
                                                            <td class="center" style="vertical-align: middle; text-align: center;">                                                                                          
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
                                                            </td> 
                                                            <?php
                                                            continue;
                                                        }
                                                    }

                                                    if (is_array($config['use_image_columns'])) {
                                                        $arr_index = array_search($t_key, $config['use_image_columns']);
                                                        if ($arr_index !== FALSE) {
                                                            ?> 
                                                            <td class="center" style="vertical-align: middle; text-align: center;">                                                                                          
                                                                <img style="width:28px; height:28px; object-fit:cover; border-radius:4px; border:1px solid #e2e8f0;" src='<?= $table_td ? $table_meta['config']['use_image_columns_path'][0] . $table_td : cdn_url() . 'uploads/noImage.jpg' ?>' alt="<?= $table_td ?>" />
                                                            </td> <?php
                                                            continue;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <td class="center" style="vertical-align: middle;">
                                                    <?php
                                                    if (is_array($config['allowed_action']) && in_array('quick_edit', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <span class="ss-quick-edit" relId="<?= $table_tr[$config['tablePrimaryKey']]; ?>" relfield="<?= $t_key ?>" onclick="quickEdit(this)" id="<?= $t_key . '-' . $table_tr[$config['tablePrimaryKey']] ?>" title="Click To Quick Edit">
                                                            <?= strip_tags($table_td) ?>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span style="font-weight: 500;"><?= strip_tags($table_td); ?></span>
                                                    <?php } ?>
                                                </td>

                                            <?php endforeach; ?>

                                            <td class="center ss-actions-cell" style="vertical-align: middle; text-align: right; white-space: nowrap;">
                                                <div style="display:inline-flex; align-items:center; gap: 3px; justify-content: flex-end;">
                                                    <?php if (is_array($config['allowed_action']) && in_array('view_detail', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action view" title="View Details" data-rel="tooltip" href="#" onclick="popupViewSingle(<?= $table_tr[$config['tablePrimaryKey']] ?>)">
                                                            <i class="fa fa-eye"></i>  
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (is_array($config['allowed_action']) && in_array('edit_detail', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action edit" title="Edit" data-rel="tooltip" href="#" onclick="popupEditSingle(<?= $table_tr[$config['tablePrimaryKey']] ?>)">
                                                            <i class="fa fa-pencil"></i>  
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                                        <a class="btn btn-default btn-xs ss-btn-action delete" title="Delete" data-rel="tooltip" href="#" onclick="popupDeleteSingle(<?= $table_tr[$config['tablePrimaryKey']] ?>)">
                                                            <i class="fa fa-trash-o"></i> 
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
                    <div class="pagination pagination-centered ss-pagination-wrap">
                        <?= $this->pagination->create_links(); ?>
                    </div>  
                <?php } else { ?>
                    <div class="ss-empty-state" style="text-align: center; padding: 36px 16px; background: #f8fafc; border-radius: 8px; border: 1.5px dashed #e2e8f0; margin: 12px 0;">
                        <i class="fa fa-folder-open-o" style="font-size: 36px; color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                        <h4 style="font-size: 14px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">No Records Found</h4>
                        <p style="font-size: 12px; color: #64748b; margin: 0;">There are currently no entries to display in this list.</p>
                        <?php if (is_array($config['allowed_action']) && in_array('add_detail', $config['allowed_action']) !== FALSE): ?>
                            <a href="javascript:void(0);" onclick="popupAddNew()" class="btn btn-primary ss-btn-primary" style="margin-top: 10px; font-size: 11px; padding: 4px 10px; border-radius: 5px;">
                                <i class="fa fa-plus-circle"></i> Add First Record
                            </a>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->
    <script>
    // Set cookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    // Get cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    /**
     *for pagination
     **/
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

    /*sentMail*/
    var sentMail = function(targetObject){
        currentPostRequest = $.post(page_url + 'mailInvoice', {invoice_id:targetObject}, function (responce) {		
            if (typeof toastr !== 'undefined') {
                toastr.info(responce.status);
            } else {
                alert(responce.status);
            }
        },'json');
    }
    </script>
</div>
