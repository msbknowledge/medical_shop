/**
 * FastApp Core Console Scripts (Modernized for AdminLTE 3 / Bootstrap 3)
 * Supports Add, Edit, View, Delete, Modal Popups, Validation, AJAX Tables & Charts
 */

var current_language = null;
var currentPostRequest = null;
var currentPageinationLink = '';
var widgetArray = [];

// Fallback cookie helper if jQuery cookie plugin is absent
if (typeof $.cookie !== 'function') {
    $.cookie = function(name, value, options) {
        if (typeof value !== 'undefined') {
            options = options || {};
            if (value === null) {
                value = '';
                options.expires = -1;
            }
            var expires = '';
            if (options.expires && (typeof options.expires === 'number' || options.expires.toUTCString)) {
                var date;
                if (typeof options.expires === 'number') {
                    date = new Date();
                    date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
                } else {
                    date = options.expires;
                }
                expires = '; expires=' + date.toUTCString();
            }
            var path = options.path ? '; path=' + (options.path) : '; path=/';
            var domain = options.domain ? '; domain=' + (options.domain) : '';
            var secure = options.secure ? '; secure' : '';
            document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
        } else {
            var cookieValue = null;
            if (document.cookie && document.cookie !== '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = jQuery.trim(cookies[i]);
                    if (cookie.substring(0, name.length + 1) === (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
    };
}

/*
|--------------------------------------------------------------------------
| Document Ready Handlers
|--------------------------------------------------------------------------
*/
$(document).ready(function () {
    // 1. Language Handling
    if (typeof $.cookie === 'function') {
        current_language = $.cookie('current_language') == null ? '1' : $.cookie('current_language');
    } else {
        current_language = '1';
    }

    $('#language a[data-value="' + current_language + '"]').find('i').addClass('fa fa-check');
    $('#language a').on('click', function (e) {
        e.preventDefault();
        current_language = $(this).attr('data-value');
        if (typeof $.cookie === 'function') {
            $.cookie('current_language', current_language, { expires: 365, path: '/' });
        }
        $('#language i').removeClass('fa-check icon-ok');
        $(this).find('i').addClass('fa-check');
        window.location.reload();
    });

    // 2. Foldable Nav / Accordion
    $(document).on('click', '.accordion > a', function (e) {
        e.preventDefault();
        var $ul = $(this).siblings('ul');
        var $li = $(this).parent();
        if ($ul.is(':visible')) {
            $li.removeClass('active').parent('ul').parent('li').find('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
        } else {
            $li.addClass('active').parent('ul').parent('li').find('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
        }
        $ul.slideToggle();
    });

    $('.accordion li.active:first').parents('ul').slideDown();
    $('.accordion li.active:first').parent('ul').parent('li').addClass('active');
    $('.accordion li.active:first').parent('ul').parent('li').find('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');

    // 3. Table Select / Deselect All
    $(document).on('click', '.btn_select_all, #btn_select_all', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        form.find('.selectedItem').prop('checked', true).trigger('change');
        form.find('#selectAll').prop('checked', true);
    });

    $(document).on('click', '.btn_deselect_all, #btn_deselect_all', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        form.find('.selectedItem').prop('checked', false).trigger('change');
        form.find('#selectAll').prop('checked', false);
    });

    // 4. Global Datepicker & Datetimepicker
    initDatePickers();

    // 5. Ordering / Sorting & Pagination
    if ($(".orderable").length) {
        reorderTable();
    }
    setSorting();
    ajaxPagination();

    // 6. Tree View if present
    if ($("#viewport").length && typeof initTree === 'function') {
        initTree($("#viewport"));
    }

    // 7. Initialize Widgets
    initWidgetLoad();
});

/*
|--------------------------------------------------------------------------
| Plugin Initializers
|--------------------------------------------------------------------------
*/
function initDatePickers(context) {
    var $ctx = context ? $(context) : $(document);
    if ($.fn.datepicker) {
        $ctx.find('.datepicker').each(function () {
            var dateVal = $(this).val();
            if (!$(this).data('datepicker-initialized')) {
                $(this).datepicker({ format: 'yyyy-mm-dd', autoclose: true });
                $(this).data('datepicker-initialized', true);
            }
            if (dateVal) $(this).val(dateVal);
        });
    }
    if ($.fn.datetimepicker) {
        $ctx.find('.datetimepicker').each(function () {
            if (!$(this).data('datetimepicker-initialized')) {
                $(this).datetimepicker({ format: 'YYYY-MM-DD HH:mm:ss' });
                $(this).data('datetimepicker-initialized', true);
            }
        });
    }
    if ($.fn.select2) {
        $ctx.find('[data-rel="chosen"], [rel="chosen"], .select2').not('.select2-hidden-accessible').select2({
            width: '100%'
        });
    }
}

/*
|--------------------------------------------------------------------------
| AJAX Pagination
|--------------------------------------------------------------------------
*/
var ajaxPagination = function () {
    $(document).off('click', '.pagination a, .pagination-wrapper a').on('click', '.pagination a, .pagination-wrapper a', function (e) {
        e.preventDefault();
        var targetUrl = $(this).attr('href');
        if (!targetUrl || targetUrl === '#' || targetUrl.indexOf('javascript') === 0) {
            return;
        }
        currentPageinationLink = targetUrl;
        var targetObj = $(this);
        var searchData = $('.search-table-form').length ? $('.search-table-form').serialize() : '';
        if (!searchData || searchData.trim() === '') {
            searchData = { 'search': '1' };
        }

        currentPostRequest = $.post(targetUrl, searchData, function (resData) {
            var $wrapper = targetObj.closest('.table_view_wrapper');
            if ($wrapper.length) {
                $wrapper.replaceWith(resData);
            } else if ($('.table_view_wrapper').length) {
                $('.table_view_wrapper').first().replaceWith(resData);
            } else {
                $('.index-wrapper').html(resData);
            }
            postTableGeneration();
        }, 'html');
    });
};

/*
|--------------------------------------------------------------------------
| Search Box & Real-Time Auto-Search
|--------------------------------------------------------------------------
*/
var searchTimer = null;

// Real-time debounced auto-search on input/typing
$(document).off('input.fastappSearch keyup.fastappSearch search.fastappSearch')
    .on('input.fastappSearch keyup.fastappSearch search.fastappSearch', '.search_box input, .search-table-form input', function (e) {
        if (e.which === 13 || e.keyCode === 13) {
            e.preventDefault();
            clearTimeout(searchTimer);
            initSearch();
            return false;
        }
        if ((e.which >= 37 && e.which <= 40) || e.which === 16 || e.which === 17 || e.which === 18 || e.which === 9 || e.which === 20 || e.which === 27) {
            return;
        }
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function () {
            initSearch();
        }, 250);
    });

// Immediate auto-search on change (dropdowns, checkboxes, datepickers)
$(document).off('change.fastappSearch select2:select.fastappSearch select2:clear.fastappSearch select2:unselect.fastappSearch dp.change.fastappSearch')
    .on('change.fastappSearch select2:select.fastappSearch select2:clear.fastappSearch select2:unselect.fastappSearch dp.change.fastappSearch', '.search_box select, .search_box input[type="checkbox"], .search-table-form select, .search-table-form input[type="checkbox"], .search_box .datepicker, .search-table-form .datepicker', function () {
        clearTimeout(searchTimer);
        initSearch();
    });

var initSearch = function () {
    if (typeof currentPostRequest !== 'undefined' && currentPostRequest && typeof currentPostRequest.abort === 'function') {
        currentPostRequest.abort();
    }

    var $form = $('.search-table-form');
    var dataToPost = $form.length ? $form.serialize() : '';
    if (!dataToPost || dataToPost.trim() === '') {
        dataToPost = { 'search': '1' };
    }

    var formAction = $form.attr('action');
    var baseUrl = (typeof page_url !== 'undefined' && page_url) ? page_url : window.location.pathname;
    var targetUrl = baseUrl;
    if (formAction && formAction.trim() !== '' && formAction !== '#' && formAction !== 'javascript:void(0);') {
        if (formAction.indexOf('http://') === 0 || formAction.indexOf('https://') === 0 || formAction.indexOf('/') === 0) {
            targetUrl = formAction;
        } else {
            targetUrl = baseUrl.replace(/\/+$/, '') + '/' + formAction.replace(/^\/+/, '');
        }
    }

    var $searchIcons = $('.search_box .add-on i.fa-search, .search-table-form .add-on i.fa-search');
    $searchIcons.removeClass('fa-search').addClass('fa-spinner fa-spin');

    currentPostRequest = $.post(targetUrl, dataToPost, function (resData) {
        $searchIcons.removeClass('fa-spinner fa-spin').addClass('fa-search');
        if ($('.table_view_wrapper').length) {
            $('.table_view_wrapper').first().replaceWith(resData);
        } else if ($('.index-wrapper').length) {
            $('.index-wrapper').html(resData);
        }
        postTableGeneration();
    }, 'html').fail(function (xhr, status, error) {
        $searchIcons.removeClass('fa-spinner fa-spin').addClass('fa-search');
        if (status !== 'abort') {
            console.error('Search request failed:', error);
        }
    });
    currentPageinationLink = "";
};

function postTableGeneration() {
    initDatePickers();
    if (typeof docReady === 'function') docReady();
    if ($(".orderable").length) {
        reorderTable();
    }
    setSorting();
    ajaxPagination();
}

var postDetailLoad = function () {};

/*
|--------------------------------------------------------------------------
| Delete Operations (Single & Bulk)
|--------------------------------------------------------------------------
*/
var popupDeleteAll = function () {
    var selectedIDs = [];
    $('.selectedItem:checked').each(function () {
        selectedIDs.push($(this).val());
    });

    if (selectedIDs.length === 0) {
        if (typeof toastr !== 'undefined') {
            toastr.warning('Please select at least one record.');
        } else {
            alert('Please select at least one record.');
        }
        return;
    }

    if (confirm("Are you sure you want to delete the selected " + selectedIDs.length + " item(s)?")) {
        deleteAllOperation();
    }
};

var deleteAllOperation = function () {
    var baseUrl = (typeof page_url !== 'undefined') ? page_url : '';
    var selectedData = $('.choose_entry_form').length ? $('.choose_entry_form').serialize() : '';
    if (!selectedData) {
        var ids = [];
        $('.selectedItem:checked').each(function () { ids.push($(this).val()); });
        selectedData = { selectedItem: ids };
    }

    currentPostRequest = $.post(baseUrl + 'delete_multiple', selectedData, function (respData) {
        if (respData && (respData.status === 'success' || respData.success)) {
            if (typeof toastr !== 'undefined') {
                toastr.success(respData.message || 'Selected records deleted successfully.');
            }
            $('#myModal, #formModal').modal('hide');
            initSearch();
        } else {
            var msg = (respData && respData.message) ? respData.message : 'Delete failed.';
            if (typeof toastr !== 'undefined') { toastr.error(msg); } else { alert(msg); }
        }
    }, 'json').fail(function () {
        // Fallback to delete endpoint
        $.post(baseUrl + 'delete', selectedData, function (respData) {
            if (typeof toastr !== 'undefined') toastr.success('Deleted successfully.');
            initSearch();
        }, 'json');
    });
};

var popupDeleteSingle = function (targetItem) {
    if (confirm("Are you sure you want to delete this entry?")) {
        deleteSingleOperation(targetItem);
    }
};

var popupDeleteSingle = function (e, targetItem) {
    if (e && typeof e.preventDefault === 'function') {
        e.preventDefault();
    } else if (typeof targetItem === 'undefined') {
        targetItem = e;
    }
    if (!targetItem || typeof targetItem === 'object') return;
    if (!confirm('Are you sure you want to delete this record?')) return;
    deleteSingleOperation(targetItem);
};

var deleteSingleOperation = function (targetItem) {
    if (!targetItem || typeof targetItem === 'object') return;
    var baseUrl = (typeof page_url !== 'undefined') ? page_url : '';
    if (!baseUrl.endsWith('/')) baseUrl += '/';
    currentPostRequest = $.post(baseUrl + 'delete', { entry: targetItem }, function (respData) {
        if (respData && (respData.status === 'success' || respData.success)) {
            $('#row_' + targetItem).fadeOut(300, function () { $(this).remove(); });
            if (typeof toastr !== 'undefined') {
                toastr.success(respData.message || 'Record deleted successfully.');
            }
            $('#myModal, #formModal, #formAddEditModal, #viewDetailModal').modal('hide');
        } else {
            var msg = (respData && respData.message) ? respData.message : 'Delete failed.';
            if (typeof toastr !== 'undefined') { toastr.error(msg); } else { alert(msg); }
        }
    }, 'json').fail(function () {
        if (typeof toastr !== 'undefined') toastr.error('An error occurred during deletion.');
    });
};

/*
|--------------------------------------------------------------------------
| View Detail Operation
|--------------------------------------------------------------------------
*/
var popupViewSingle = function (e, targetItem) {
    if (e && typeof e.preventDefault === 'function') {
        e.preventDefault();
    } else if (typeof targetItem === 'undefined') {
        targetItem = e;
    }
    if (!targetItem || typeof targetItem === 'object') return;
    var modal = $('#viewDetailModal').length ? $('#viewDetailModal') : ($('#formModal').length ? $('#formModal') : $('#myModal'));
    modal.find('.modal-title, .modal-header h3').html('<i class="fa fa-info-circle"></i> Details');
    modal.find('.modal-body p, .modal-body').html('<div class="text-center p-4"><i class="fa fa-spinner fa-spin fa-2x"></i><p class="mt-2">Loading details...</p></div>');
    modal.modal('show');
    viewSingleOperation(targetItem);
};

var viewSingleOperation = function (targetItem) {
    if (!targetItem || typeof targetItem === 'object') return;
    var baseUrl = (typeof page_url !== 'undefined') ? page_url : '';
    if (!baseUrl.endsWith('/')) baseUrl += '/';
    var modal = $('#viewDetailModal').length ? $('#viewDetailModal') : ($('#formModal').length ? $('#formModal') : $('#myModal'));

    currentPostRequest = $.post(baseUrl + 'view_detail', { entry: targetItem }, function (respData) {
        if (respData) {
            modal.find('.modal-body p, .modal-body').html(respData);
            if (typeof postDetailLoad === 'function') postDetailLoad();
        }
    }, 'html');
};

var generateDetailedView = function (targetItem) {
    popupViewSingle(targetItem);
};

/*
|--------------------------------------------------------------------------
| Edit Operation
|--------------------------------------------------------------------------
*/
var popupEditSingle = function (e, targetItem) {
    if (e && typeof e.preventDefault === 'function') {
        e.preventDefault();
    } else if (typeof targetItem === 'undefined') {
        targetItem = e;
    }
    if (!targetItem || typeof targetItem === 'object') return;
    var modal = $('#formAddEditModal').length ? $('#formAddEditModal') : $('#formModal');
    modal.find('.modal-title, .modal-header h3').html('<i class="fa fa-pencil-square-o"></i> Edit Record');
    modal.find('.modal-body p, .modal-body').html('<div class="text-center p-4"><i class="fa fa-spinner fa-spin fa-2x"></i><p class="mt-2">Loading form...</p></div>');
    modal.modal('show');
    loadEditForm(targetItem);
};

var loadEditForm = function (targetItem) {
    if (!targetItem || typeof targetItem === 'object') return;
    var baseUrl = (typeof page_url !== 'undefined') ? page_url : '';
    if (!baseUrl.endsWith('/')) baseUrl += '/';
    var modal = $('#formAddEditModal').length ? $('#formAddEditModal') : $('#formModal');

    currentPostRequest = $.post(baseUrl + 'edit_detail', { 'load_edit_entry': targetItem }, function (respData) {
        if (respData) {
            modal.find('.modal-body p, .modal-body').html(respData);
            initDatePickers(modal);
            if ($.fn.select2) {
                modal.find('.select2, [data-rel="chosen"]').each(function() {
                    var opts = { width: '100%' };
                    if ($(this).attr('multiple')) {
                        opts.tags = true;
                    }
                    $(this).select2(opts);
                });
            }
            modal.find('input:visible:first').focus();
        }
    }, 'html');
};

var generateEditView = function (targetItem) {
    popupEditSingle(targetItem);
};

/*
|--------------------------------------------------------------------------
| Add Operation
|--------------------------------------------------------------------------
*/
var popupAddNew = function (e, targetItem) {
    if (e && typeof e.preventDefault === 'function') {
        e.preventDefault();
    }
    var modal = $('#formAddEditModal').length ? $('#formAddEditModal') : $('#formModal');
    modal.find('.modal-title, .modal-header h3').html('<i class="fa fa-plus-circle"></i> Add New Record');
    modal.find('.modal-body p, .modal-body').html('<div class="text-center p-4"><i class="fa fa-spinner fa-spin fa-2x"></i><p class="mt-2">Loading form...</p></div>');
    modal.modal('show');
    loadAddForm();
};

var loadAddForm = function () {
    var baseUrl = (typeof page_url !== 'undefined') ? page_url : '';
    if (!baseUrl.endsWith('/')) baseUrl += '/';
    var modal = $('#formAddEditModal').length ? $('#formAddEditModal') : $('#formModal');

    currentPostRequest = $.post(baseUrl + 'add_detail', { 'load_add_entry': 'yes' }, function (respData) {
        if (respData) {
            modal.find('.modal-body p, .modal-body').html(respData);
            initDatePickers(modal);
            if ($.fn.select2) {
                modal.find('.select2, [data-rel="chosen"]').each(function() {
                    var opts = { width: '100%' };
                    if ($(this).attr('multiple')) {
                        opts.tags = true;
                    }
                    $(this).select2(opts);
                });
            }
            modal.find('input:visible:first').focus();
        }
    }, 'html');
};

var generateAddView = function (targetItem) {
    popupAddNew(targetItem);
};

/*
|--------------------------------------------------------------------------
| Save Operations
|--------------------------------------------------------------------------
*/
var saveSingleOperation = function () {
    var $form = $('#addEditForm');
    if (!$form.length) return;
    $form.trigger('submit');
};

var saveOperation = function (method) {
    var $form = $('#addEditForm');
    if (!$form.length) return;
    $form.trigger('submit');
};

$(document).on('submit', '#addEditForm', function (e) {
    e.preventDefault();
    var $form = $(this);
    if (typeof validate_form === 'function' && !validate_form($form, {
        beforeValidation: function (targetObject) {
            var $card = $(targetObject).closest('.ss-field-card, .form-group, .control-group');
            $card.removeClass('has-error error');
            $card.find('.help-block-error, .help-block, .help-inline').hide().html('');
            $(targetObject).css({ 'border-color': '', 'background-color': '', 'box-shadow': '' });
        },
        onValidationError: function (targetObject, validationType, customMsg) {
            var $card = $(targetObject).closest('.ss-field-card, .form-group, .control-group');
            $card.addClass('has-error error');
            
            var fieldLabel = $card.find('.ss-field-label, label').first().text().replace('*', '').replace('(Read Only)', '').trim() || 'This field';
            var msg = customMsg;
            if (!msg) {
                if (validationType === 'required') {
                    msg = fieldLabel + ' is required.';
                } else if (validationType === 'email') {
                    msg = 'Please enter a valid email address.';
                } else if (validationType === 'phone' || validationType === 'mobile') {
                    msg = 'Please enter a valid 10-digit mobile number.';
                } else if (validationType === 'gst') {
                    msg = 'Please enter a valid 15-character GSTIN or N/A.';
                } else if (validationType === 'numeric') {
                    msg = fieldLabel + ' must be a valid non-negative number.';
                } else {
                    msg = 'Please enter valid data for ' + fieldLabel.toLowerCase() + '.';
                }
            }

            var $err = $card.find('.help-block-error, .help-block, .help-inline');
            if (!$err.length) {
                $err = $('<div class="help-block-error" style="color:#ef4444; font-size:11.5px; font-weight:600; margin-top:4px;"></div>').appendTo($card);
            }
            $err.html('<i class="fa fa-exclamation-circle"></i> ' + msg).show();
            $(targetObject).css({ 'border-color': '#ef4444', 'background-color': '#fff5f5', 'box-shadow': '0 0 0 3px rgba(239, 68, 68, 0.15)' });
        }
    })) {
        return false;
    }

    var baseUrl = (typeof page_url !== 'undefined') ? page_url : '';
    if (!baseUrl.endsWith('/')) baseUrl += '/';

    var pkField = $form.find('input[name$="_ID"], input[name$="_id"], input[name="id"]').first();
    var isEdit = (pkField.length && pkField.val() && pkField.val() !== '0' && pkField.val() !== '');
    var postUrl = isEdit ? baseUrl + 'edit_detail' : baseUrl + 'add_detail';

    var $submitBtn = $form.find('button[type="submit"]');
    var originalBtnHtml = $submitBtn.html();
    $submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

    $.post(postUrl, $form.serialize(), function (respData) {
        $submitBtn.prop('disabled', false).html(originalBtnHtml);
        if (typeof respData === 'string') {
            try { respData = JSON.parse(respData); } catch (ex) {}
        }
        if (respData && respData.status === 'success') {
            if (typeof toastr !== 'undefined') {
                toastr.success(respData.message || 'Saved successfully!');
            } else {
                alert(respData.message || 'Saved successfully!');
            }
            var modal = $('#formAddEditModal').length ? $('#formAddEditModal') : $('#formModal');
            modal.modal('hide');
            setTimeout(function () {
                window.location.reload();
            }, 800);
        } else {
            var err = (respData && respData.message) ? respData.message : 'Error saving record.';
            if (typeof toastr !== 'undefined') {
                toastr.error(err);
            } else {
                alert(err);
            }
        }
    }, 'json').fail(function (xhr) {
        $submitBtn.prop('disabled', false).html(originalBtnHtml);
        if (typeof toastr !== 'undefined') {
            toastr.error('Failed to save data. Status: ' + xhr.status);
        } else {
            alert('Failed to save data.');
        }
    });
});

/*
|--------------------------------------------------------------------------
| Form Validation
|--------------------------------------------------------------------------
*/
function validate_form(targetForm, settings) {
    settings = settings || {};
    var formInputs = $(targetForm).find('input, textarea, select').not('[type="hidden"], [readonly]');
    var passWords = {};
    var isValid = true;
    var firstInvalid = null;

    function beforeValidation(targetObject) {
        if (typeof settings.beforeValidation === 'function') {
            settings.beforeValidation(targetObject);
        } else {
            var $card = $(targetObject).closest('.ss-field-card, .form-group, .control-group');
            $card.removeClass('has-error error');
            $card.find('.help-block-error, .help-block, .help-inline').hide().html('');
            $(targetObject).css({ 'border-color': '', 'background-color': '', 'box-shadow': '' });
        }
    }

    function onValidationError(targetObject, validationType, customMsg) {
        if (typeof settings.onValidationError === 'function') {
            settings.onValidationError(targetObject, validationType, customMsg);
        } else {
            var $card = $(targetObject).closest('.ss-field-card, .form-group, .control-group');
            $card.addClass('has-error error');
            var msg = customMsg || ((validationType === 'required') ? 'This field is required.' : 'Please enter valid data.');
            var $err = $card.find('.help-block-error, .help-block, .help-inline');
            if (!$err.length) {
                $err = $('<div class="help-block-error" style="color:#ef4444; font-size:11.5px; font-weight:600; margin-top:4px;"></div>').appendTo($card);
            }
            $err.html('<i class="fa fa-exclamation-circle"></i> ' + msg).show();
            $(targetObject).css({ 'border-color': '#ef4444', 'background-color': '#fff5f5', 'box-shadow': '0 0 0 3px rgba(239, 68, 68, 0.15)' });
        }
    }

    $(formInputs).each(function () {
        var $input = $(this);
        beforeValidation($input);
        var fromvalidation = $input.attr('from-validation') || $input.attr('data-validation') || '';
        var inputName = $input.attr('name') || '';
        var inputType = $input.attr('type') || '';
        var val = $.trim($input.val());

        var validationArray = fromvalidation ? fromvalidation.split('|') : [];

        // Auto-detect rules for customer fields if not explicitly configured
        if (inputName === 'customer_name' && $.inArray('required', validationArray) === -1) {
            validationArray.push('required');
        }
        if (inputName === 'customer_contact' && $.inArray('phone', validationArray) === -1) {
            validationArray.push('required');
            validationArray.push('phone');
        }

        // 1. Required Check
        if ($.inArray('required', validationArray) !== -1) {
            if (val === '') {
                onValidationError($input, 'required');
                isValid = false;
                if (!firstInvalid) firstInvalid = $input;
                return;
            }
        }

        // 2. Phone / Mobile Number Check (10 digits)
        if ($.inArray('phone', validationArray) !== -1 || $.inArray('mobile', validationArray) !== -1 || inputName === 'customer_contact') {
            if (val !== '') {
                var cleaned = val.replace(/[^0-9]/g, '');
                if (cleaned.length === 12 && cleaned.startsWith('91')) {
                    cleaned = cleaned.substring(2);
                } else if (cleaned.length === 11 && cleaned.startsWith('0')) {
                    cleaned = cleaned.substring(1);
                }
                if (cleaned.length !== 10) {
                    onValidationError($input, 'phone', 'Please enter a valid 10-digit mobile number.');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = $input;
                    return;
                }
            }
        }

        // 3. Email Check
        if ($.inArray('email', validationArray) !== -1 || inputType === 'email' || inputName === 'email') {
            if (val !== '') {
                var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;
                if (!emailRegex.test(val)) {
                    onValidationError($input, 'email', 'Please enter a valid email address.');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = $input;
                    return;
                }
            }
        }

        // 4. Numeric / Amount Check
        if ($.inArray('numeric', validationArray) !== -1 || inputName === 'customer_due') {
            if (val !== '') {
                if (isNaN(val) || parseFloat(val) < 0) {
                    onValidationError($input, 'numeric', 'Please enter a valid non-negative number.');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = $input;
                    return;
                }
            }
        }

        // 5. GSTIN Check
        if ($.inArray('gst', validationArray) !== -1 || inputName === 'customer_gst') {
            if (val !== '' && val.toUpperCase() !== 'N/A') {
                var gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/i;
                if (!gstRegex.test(val)) {
                    onValidationError($input, 'gst', 'Invalid GSTIN format (15 characters alphanumeric) or N/A.');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = $input;
                    return;
                }
            }
        }

        // 6. Password Check
        if ($.inArray('password', validationArray) !== -1) {
            if ($.inArray('confirm', validationArray) !== -1) {
                passWords[1] = $input;
                if ($(passWords[0]).val() !== $(passWords[1]).val()) {
                    onValidationError($input, 'password', 'Passwords do not match.');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = $input;
                    return;
                }
            } else {
                passWords[0] = $input;
            }
        }
    });

    if (!isValid && firstInvalid) {
        firstInvalid.focus();
        if (typeof toastr !== 'undefined') {
            toastr.warning('Please fix the highlighted required fields.');
        }
    } else if (isValid && typeof settings.onValidationSuccess === 'function') {
        settings.onValidationSuccess();
    }

    return isValid;
}

/*
|--------------------------------------------------------------------------
| Quick Edit
|--------------------------------------------------------------------------
*/
var quickEdit = function (targetItem) {
    var $target = $(targetItem);
    if ($target.data('editing')) return;
    $target.data('editing', true);

    var oldValue = $.trim($target.text());
    var $input = $('<input>', {
        type: 'text',
        class: 'form-control form-control-sm d-inline-block',
        style: 'width: auto; min-width: 80px;'
    }).val(oldValue);

    $target.hide().after($input);
    $input.focus();

    var finished = false;
    function finishEdit(saveValue) {
        if (finished) return;
        finished = true;

        if (saveValue) {
            var newValue = $input.val();
            if (newValue === oldValue) {
                $input.remove();
                $target.show().removeData('editing');
                return;
            }

            var baseUrl = (typeof page_url !== 'undefined') ? page_url : '';
            $.post(baseUrl + 'quick_edit', {
                targetItem: $target.attr('relfield') + '-' + $target.attr('relId'),
                targetValue: newValue
            }, function (respData) {
                if (respData && respData.status === 'error') {
                    if (typeof toastr !== 'undefined') toastr.error(respData.message || 'Update failed.');
                    $target.text(oldValue);
                } else {
                    $target.text(newValue);
                    if (typeof toastr !== 'undefined') toastr.success('Updated successfully.');
                }
            }, 'json').fail(function () {
                $target.text(oldValue);
            });
        } else {
            $target.text(oldValue);
        }

        $input.remove();
        $target.show().removeData('editing');
    }

    $input.on('blur', function () { finishEdit(true); });
    $input.on('keydown', function (e) {
        if (e.keyCode === 13) { e.preventDefault(); finishEdit(true); }
        if (e.keyCode === 27) { e.preventDefault(); finishEdit(false); }
    });
};

/*
|--------------------------------------------------------------------------
| Table Reordering & Sorting
|--------------------------------------------------------------------------
*/
var reorderTable = function () {
    if (typeof $.fn.sortable !== 'function') return;
    $(".orderable").sortable({
        handle: '.drag-handle',
        update: function (event, ui) {
            var orderElements = [];
            $(".orderable").children().each(function () {
                var id = $(this).attr('id');
                if (id && id.indexOf('row_') === 0) {
                    orderElements.push(id.substring(4));
                }
            });

            var baseUrl = (typeof page_url !== 'undefined') ? page_url : '';
            currentPostRequest = $.post(baseUrl + 'order_table', {
                orderElements: orderElements
            }, function (response) {
                if (typeof toastr !== 'undefined') toastr.success('Order updated.');
            }, 'json');
        }
    });
};

var setSorting = function () {
    // 1. Resolve current model/section name
    var resolveSection = function () {
        var sec = (typeof section !== 'undefined' && section) ? section : '';
        if (!sec) {
            var path = window.location.pathname;
            if (typeof page_url !== 'undefined' && page_url) path = page_url;
            var parts = path.split('/').filter(function(p) { return p && p !== 'index.php'; });
            var consoleIdx = parts.indexOf('console');
            if (consoleIdx !== -1 && parts[consoleIdx + 1]) {
                var ctrl = parts[consoleIdx + 1];
                if (ctrl.slice(-1) === 's') {
                    sec = ctrl + '_model';
                } else {
                    sec = ctrl + 's_model';
                }
            }
        }
        return sec;
    };

    var currentSection = resolveSection();

    // 2. Reflect current cookie sorting state on table headers
    if (typeof $.cookie === 'function' && currentSection) {
        var currentCookie = $.cookie('orderBy_' + currentSection);
        if (currentCookie) {
            var cookieParts = currentCookie.split(':');
            var sortField = cookieParts[0];
            var sortDir = cookieParts[1] ? cookieParts[1].toLowerCase() : 'asc';

            $('.shorter').each(function () {
                var field = $(this).attr('data-rel');
                if (field === sortField) {
                    if (sortDir === 'desc') {
                        $(this).removeClass('fa-sort fa-sort-asc fa-sort-up text-muted')
                               .addClass('fa-sort-desc text-primary');
                    } else {
                        $(this).removeClass('fa-sort fa-sort-desc fa-sort-down text-muted')
                               .addClass('fa-sort-asc text-primary');
                    }
                } else {
                    $(this).removeClass('fa-sort-asc fa-sort-desc fa-sort-up fa-sort-down text-primary')
                           .addClass('fa-sort text-muted');
                }
            });
        }
    }

    // 3. Click handler for sort headers & icons
    $(document).off('click', '.shorter, th.sortable_th, th:has(.shorter)').on('click', '.shorter, th.sortable_th, th:has(.shorter)', function (e) {
        if ($(e.target).is('input, select, a, button')) return;
        e.preventDefault();

        var $icon = $(this).is('.shorter') ? $(this) : $(this).find('.shorter');
        if (!$icon.length) return;

        var sortingField = $icon.attr('data-rel');
        if (!sortingField) return;

        var sortingOrder = 'asc';
        if ($icon.hasClass('fa-sort-asc') || $icon.hasClass('fa-sort-up')) {
            sortingOrder = 'desc';
        } else if ($icon.hasClass('fa-sort-desc') || $icon.hasClass('fa-sort-down')) {
            sortingOrder = 'asc';
        }

        var activeSec = resolveSection();
        if (typeof $.cookie === 'function' && activeSec) {
            $.cookie('orderBy_' + activeSec, sortingField + ':' + sortingOrder, { expires: 365, path: '/' });
        }

        if (typeof initSearch === 'function') {
            initSearch();
        }
    });
};

/*
|--------------------------------------------------------------------------
| Widgets Loader
|--------------------------------------------------------------------------
*/
var initWidgetLoad = function () {
    if (typeof widgetArray !== 'undefined' && widgetArray.length) {
        var baseUrl = (typeof console_url !== 'undefined') ? console_url : '';
        $(widgetArray).each(function (key, widgetElement) {
            $.post(baseUrl + widgetElement + '/widget', { bla: 'bla' }, function (respData) {
                $('.widget-area').append(respData);
                if (typeof docReady === 'function') docReady();
            }, 'html');
        });
    }
};

var loadWidget = function (targetFunction) {
    widgetArray.push(targetFunction);
};

// Global backward compatibility
window.popupAddNew = popupAddNew;
window.popupViewSingle = popupViewSingle;
window.popupEditSingle = popupEditSingle;
window.popupDeleteSingle = popupDeleteSingle;
window.popupDeleteAll = popupDeleteAll;
window.generateAddView = generateAddView;
window.generateDetailedView = generateDetailedView;
window.generateEditView = generateEditView;
window.quickEdit = quickEdit;
window.validate_form = validate_form;
window.saveOperation = saveOperation;
window.saveSingleOperation = saveSingleOperation;