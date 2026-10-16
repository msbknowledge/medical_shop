<style>
    .search-table-form {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: flex-end;
        margin-bottom: 0;
        padding: 4px 0;
    }
    .search-filter-item {
        flex: 1;
        min-width: 220px;
        max-width: 320px;
    }
    .search-filter-item label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
        display: block;
    }
    .search-filter-item .input-prepend {
        display: flex;
        align-items: stretch;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        border: 1.5px solid #cbd5e1;
        background: #ffffff;
        transition: all 0.2s ease;
    }
    .search-filter-item .input-prepend:focus-within {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }
    .search-filter-item .add-on {
        background: #f8fafc;
        border: none;
        border-right: 1px solid #e2e8f0;
        color: #94a3b8;
        padding: 0 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
    }
    .search-filter-item input[type="text"] {
        border: none !important;
        box-shadow: none !important;
        padding: 8px 12px !important;
        height: 38px !important;
        font-size: 13.5px !important;
        color: #1e293b !important;
        width: 100% !important;
        margin: 0 !important;
        background: transparent !important;
    }
    .search-filter-item select {
        width: 100% !important;
        height: 40px !important;
        border-radius: 8px !important;
        border: 1.5px solid #cbd5e1 !important;
        padding: 6px 12px !important;
        font-size: 13px !important;
        color: #334155 !important;
        background: #ffffff !important;
    }
</style>
<?php if (isset($searchFields) && is_array($searchFields)) : ?>
    <div class="row-fluid sortable search_box" style="margin-bottom: 20px;">
        <div class="box span12" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); overflow: hidden;">
            <div class="box-header well" data-original-title style="background: #ffffff; border-bottom: 1px solid #f1f5f9; padding: 14px 20px; display: flex; align-items: center; justify-content: space-between;">
                <h2 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0; display: inline-flex; align-items: center; gap: 8px; font-family: 'Plus Jakarta Sans', sans-serif;">
                    <i class="fa fa-filter" style="color: #6366f1;"></i> Filter & Search Records
                </h2>
                <div class="box-icon" style="display: flex; gap: 6px;">
                    <a href="#" class="btn btn-minimize btn-round" style="width: 28px; height: 28px; border-radius: 9999px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; background: #fff; color: #64748b;"><i class="fa fa-chevron-up" style="font-size: 11px;"></i></a>
                    <a href="#" class="btn btn-close btn-round" style="width: 28px; height: 28px; border-radius: 9999px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0; background: #fff; color: #64748b;"><i class="fa fa-times" style="font-size: 11px;"></i></a>
                </div>
            </div>
            <div class="box-content" style="padding: 18px 20px;">
                <form class="search-table-form" method="post" onsubmit="return false;">

                    <?php foreach ($searchFields as $searchField) : ?>
                        <div class="search-filter-item">
                            <label><?= ucwords(str_replace('_', ' ', str_replace(array_keys(isset($this->page_config['replace_text']) ? $this->page_config['replace_text'] : array()), array_values(isset($this->page_config['replace_text']) ? $this->page_config['replace_text'] : array()), $searchField))) ?></label>
                            
                            <?php
                            if (isset($table_meta['config']['use_status_columns']) && is_array($table_meta['config']['use_status_columns'])) {
                                $arr_index = array_search($searchField, $table_meta['config']['use_status_columns']);
                                if ($arr_index !== FALSE) {
                            ?>
                                    <div style="padding-top: 6px;">
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
<?php endif; ?>