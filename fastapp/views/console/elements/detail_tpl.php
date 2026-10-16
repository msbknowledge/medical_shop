<div class="ss-detail-wrapper" style="background:#ffffff; border-radius:12px; border:1px solid var(--ss-border, #e2e8f0); overflow:hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
    <table class="table table-bordered table-striped table-condensed ss-modern-table" style="margin-bottom:0;">
        <thead>
            <tr style="background: var(--ss-bg-soft, #f8fafc);">
                <th style="width: 30%; font-weight: 700; color: var(--ss-text-muted, #64748b); text-transform: uppercase; font-size: 12px; letter-spacing: 0.04em;">Field Name</th>           
                <th style="font-weight: 700; color: var(--ss-text-muted, #64748b); text-transform: uppercase; font-size: 12px; letter-spacing: 0.04em;">Record Data</th> 
            </tr>
        </thead>   
        <tbody>
            <?php foreach ($table_meta['data'] as $t_key => $table_td): ?>
                <tr>    
                    <td style="font-weight: 600; color: var(--ss-text-main, #0f172a); font-size: 13px;">
                        <i class="fa fa-caret-right" style="color: var(--ss-primary, #6366f1); margin-right: 6px;"></i>
                        <?= ucfirst(str_replace('_', ' ', $t_key)) ?>
                    </td>                    
                    <?php
                    if (is_array($table_meta['config']['use_status_columns'])) {
                        if (in_array($t_key, $table_meta['config']['use_status_columns']) === TRUE) {
                            ?> 
                            <td>                                                                                          
                                <?php
                                switch (intval($table_td)) {
                                    case 1 :
                                        echo '<span class="ss-badge ss-badge-success"><i class="fa fa-check-circle"></i> On</span>';
                                        break;
                                    default :
                                        echo '<span class="ss-badge ss-badge-danger"><i class="fa fa-times-circle"></i> Off</span>';
                                }
                                ?>
                            </td>
                            <?php
                            continue;
                        }
                    }
                    if (is_array($table_meta['config']['use_dropdown_columns_options'])) {
                        if (array_key_exists($t_key, $table_meta['config']['use_dropdown_columns_options']) === TRUE) {
                            ?> 
                            <td style="color: var(--ss-text-body, #334155); font-size: 13px;">    
                                <?php 
                                if (isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key])) {
                                    $table_td = json_decode($table_td, TRUE);
                                    foreach ($table_td as $m_key => $m_value) {
                                        if ($m_key > 0) {
                                            echo ', ';
                                        }
                                        echo $table_meta['config']['use_dropdown_columns_options'][$t_key][$m_value];
                                    }
                                } else {
                                    echo isset($table_meta['config']['use_dropdown_columns_options'][$t_key][$table_td]) ? $table_meta['config']['use_dropdown_columns_options'][$t_key][$table_td] : '<span style="color:var(--ss-text-muted);">N/A</span>';
                                }
                                ?>
                            </td> 
                            <?php
                            continue;
                        }
                    }
                    
                    if (is_array($table_meta['config']['use_image_columns'])) {
                        $arr_index = array_search($t_key, $table_meta['config']['use_image_columns']);
                        if ($arr_index !== FALSE) {
                            ?> 
                            <td> 
                                <img style="max-width: 180px; max-height: 180px; border-radius: 8px; border: 1px solid var(--ss-border, #e2e8f0); object-fit: contain; background: #fafafa; padding: 4px;" src='<?= $table_td ? ($table_meta['config']['use_image_columns_path'][0] ? $table_meta['config']['use_image_columns_path'][0] : '' ) . $table_td : cdn_url() . 'uploads/noImage.jpg'; ?>' alt="<?= $table_td ?>"/>
                            </td> 
                            <?php
                            continue;
                        }
                    }
                    ?>
                    <td style="color: var(--ss-text-main, #0f172a); font-size: 13.5px;"><?= htmlspecialchars_decode($table_td) ?></td>
                </tr>
            <?php endforeach; ?>                          
        </tbody>
    </table>  
</div>
