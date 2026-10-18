<style>
    .search-table-form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 14px;
        align-items: flex-end;
        margin-bottom: 0;
        padding: 0;
    }
    .search-filter-item {
        flex: 1 1 180px;
        min-width: 160px;
        max-width: 240px;
    }
    .search-filter-item label {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #475569 !important;
        margin-bottom: 3px !important;
        display: block;
        letter-spacing: 0.1px;
        line-height: 1.2;
    }
    .search-filter-item .input-prepend {
        display: flex;
        align-items: stretch;
        width: 100%;
        height: 28px !important;
        border-radius: 5px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        transition: all 0.15s ease-in-out;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        margin-bottom: 0 !important;
    }
    .search-filter-item .input-prepend:focus-within {
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.15);
    }
    .search-filter-item .add-on {
        background: #f8fafc;
        border: none;
        border-right: 1px solid #e2e8f0;
        color: #94a3b8;
        padding: 0 8px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 28px !important;
        width: 28px !important;
        height: 26px !important;
        font-size: 11px !important;
        box-sizing: border-box;
    }
    .search-filter-item .add-on i {
        font-size: 11px !important;
    }
    .search-filter-item input[type="text"] {
        border: none !important;
        box-shadow: none !important;
        padding: 2px 8px !important;
        height: 26px !important;
        min-height: 26px !important;
        line-height: 22px !important;
        font-size: 11.5px !important;
        color: #1e293b !important;
        width: 100% !important;
        margin: 0 !important;
        background: transparent !important;
        outline: none !important;
        box-sizing: border-box !important;
    }
    .search-filter-item input[type="text"]::placeholder {
        color: #94a3b8 !important;
        font-size: 11px !important;
    }
    .search-filter-item select {
        width: 100% !important;
        height: 28px !important;
        min-height: 28px !important;
        border-radius: 5px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 2px 6px !important;
        font-size: 11.5px !important;
        line-height: 24px !important;
        color: #334155 !important;
        background: #ffffff !important;
        outline: none !important;
        box-sizing: border-box !important;
    }
    .search-filter-item .select2-container {
        width: 100% !important;
        font-size: 11.5px !important;
    }
    .search-filter-item .select2-container .select2-choice {
        height: 28px !important;
        line-height: 26px !important;
        font-size: 11.5px !important;
        border-radius: 5px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 0 8px !important;
    }
    .search-filter-item .select2-container .select2-choice .select2-arrow {
        width: 20px !important;
        border-left: 1px solid #e2e8f0 !important;
    }
    .search-filter-item .iphone-toggle {
        transform: scale(0.85);
        transform-origin: left center;
    }
</style>
<?php if (isset($searchFields) && is_array($searchFields)) : ?>
    <div class="row-fluid sortable search_box" style="margin-bottom: 14px;">
        <div class="box span12" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.03); overflow: hidden;">
            <div class="box-header well" data-original-title style="background: #ffffff; border-bottom: 1px solid #f1f5f9; padding: 8px 16px; display: flex; align-items: center; justify-content: space-between;">
                <h2 style="font-size: 12.5px; font-weight: 700; color: #1e293b; margin: 0; display: inline-flex; align-items: center; gap: 6px; font-family: 'Plus Jakarta Sans', sans-serif;">
                    <i class="fa fa-filter" style="color: #6366f1; font-size: 11.5px;"></i> Filter & Search Records
                </h2>
                <div class="box-icon" style="display: flex; gap: 5px;">
                    <a href="#" class="btn btn-minimize btn-round" style="width: 22px; height: 22px; border-radius: 9999px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; background: #fff; color: #64748b; padding: 0;"><i class="fa fa-chevron-up" style="font-size: 9px;"></i></a>
                    <a href="#" class="btn btn-close btn-round" style="width: 22px; height: 22px; border-radius: 9999px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; background: #fff; color: #64748b; padding: 0;"><i class="fa fa-times" style="font-size: 9px;"></i></a>
                </div>
            </div>
            <div class="box-content" style="padding: 10px 16px;">
                <form class="search-table-form" method="post" onsubmit="return false;">

                    <?php foreach ($searchFields as $searchField) : ?>
                        <div class="search-filter-item">
                            <label><?= ucwords(str_replace('_', ' ', str_replace(array_keys(isset($this->page_config['replace_text']) ? $this->page_config['replace_text'] : array()), array_values(isset($this->page_config['replace_text']) ? $this->page_config['replace_text'] : array()), $searchField))) ?></label>
                            
                            <?php
                            if (isset($table_meta['config']['use_status_columns']) && is_array($table_meta['config']['use_status_columns'])) {
                                $arr_index = array_search($searchField, $table_meta['config']['use_status_columns']);
                                if ($arr_index !== FALSE) {
                            ?>
                                    <div style="padding-top: 2px;">
                                        <input name="<?= $searchField ?>" data-no-uniform="true" type="checkbox" class="iphone-toggle" value="0">
                                    </div>
                        </div> <?php
                                    continue;
                                }
                            }
                            ?>

                            <?php
                            if (isset($table_meta['config']['use_dropdown_columns_options'])) {
                                $arr_index = array_key_exists($searchField, $table_meta['config']['use_dropdown_columns_options']);
                                if ($arr_index !== FALSE) {
                                    $choosenValue = isset($default_search_value[$searchField]) ? $default_search_value[$searchField] : null;
                            ?>
                                    <select name="<?= $searchField ?>" data-placeholder="Choose option..." class="form-control select2" style="width: 100%;">
                                        <option value="">-- All --</option>
                                        <?php
                                            $optionList = (isset($table_meta['config']['use_dropdown_columns_options'][$searchField]) ? $table_meta['config']['use_dropdown_columns_options'][$searchField] : $table_meta['config']['use_dropdown_columns_options']);
                                            foreach ($optionList as $optkey => $optvalue) :
                                        ?>
                                            <option <?php if ($optkey === $choosenValue) { echo 'selected="selected"'; } ?> value="<?= $optkey ?>"><?= $optvalue ?></option>
                                        <?php endforeach; ?>
                                    </select>
                        </div> <?php
                                    continue;
                                }
                            }
                            ?>

                            <?php
                            if (isset($table_meta['config']['datepicker_columns']) && is_array($table_meta['config']['datepicker_columns'])) {
                                $arr_index = array_search($searchField, $table_meta['config']['datepicker_columns']);
                                if ($arr_index !== FALSE) {
                            ?>
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="datepicker" name="<?= $searchField ?>" placeholder="Select date...">
                                    </div>
                        </div> <?php
                                    continue;
                                }
                            }
                            ?>

                            <?php
                            if (isset($table_meta['config']['datetimepicker_columns']) && is_array($table_meta['config']['datetimepicker_columns'])) {
                                $arr_index = array_search($searchField, $table_meta['config']['datetimepicker_columns']);
                                if ($arr_index !== FALSE) {
                            ?>
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="fa fa-clock-o"></i></span>
                                        <input type="text" class="datepicker" name="<?= $searchField ?>" placeholder="Select date/time...">
                                    </div>
                        </div> <?php
                                    continue;
                                }
                            }
                            ?>

                            <div class="input-prepend">
                                <span class="add-on"><i class="fa fa-search"></i></span>
                                <input id="inputIcon" type="text" name="<?= $searchField ?>" placeholder="Type to search...">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
        </div>
    </div>
    <script>
    (function () {
        var sbTimer = null;
        $(document).off('input.sbAuto keyup.sbAuto search.sbAuto', '.search_box input, .search-table-form input')
            .on('input.sbAuto keyup.sbAuto search.sbAuto', '.search_box input, .search-table-form input', function (e) {
                if (e.which === 13 || e.keyCode === 13) {
                    e.preventDefault();
                    clearTimeout(sbTimer);
                    if (typeof initSearch === 'function') initSearch();
                    return false;
                }
                if ((e.which >= 37 && e.which <= 40) || e.which === 16 || e.which === 17 || e.which === 18 || e.which === 9 || e.which === 20 || e.which === 27) {
                    return;
                }
                clearTimeout(sbTimer);
                sbTimer = setTimeout(function () {
                    if (typeof initSearch === 'function') {
                        initSearch();
                    }
                }, 250);
            });

        $(document).off('change.sbAuto select2:select.sbAuto select2:clear.sbAuto select2:unselect.sbAuto dp.change.sbAuto', '.search_box select, .search_box input[type="checkbox"], .search-table-form select, .search-table-form input[type="checkbox"], .search_box .datepicker, .search-table-form .datepicker')
            .on('change.sbAuto select2:select.sbAuto select2:clear.sbAuto select2:unselect.sbAuto dp.change.sbAuto', '.search_box select, .search_box input[type="checkbox"], .search-table-form select, .search-table-form input[type="checkbox"], .search_box .datepicker, .search-table-form .datepicker', function () {
                clearTimeout(sbTimer);
                if (typeof initSearch === 'function') initSearch();
            });
    })();
    </script>
<?php endif; ?>