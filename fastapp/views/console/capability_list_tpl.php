<?php
/**
 * Modern Role Capabilities & Permissions Matrix
 */
$target_controller = !empty($target_controller) ? $target_controller : $this->uri->segment(2);
if (empty($target_controller)) {
    $target_controller = 'capability';
}

// Ensure the target controller class is loaded for reflection
if (!class_exists($target_controller)) {
    $cFile = APPPATH . 'controllers/console/' . $target_controller . '.php';
    if (file_exists($cFile)) {
        require_once $cFile;
    } else {
        $mFiles = glob(ROOTPATH . 'modules/*/controllers/console/' . $target_controller . '.php');
        if (!empty($mFiles[0]) && file_exists($mFiles[0])) {
            require_once $mFiles[0];
        }
    }
}

$controllers_list = !empty($available_controllers) ? $available_controllers : (!empty($this->page_config['use_dropdown_columns_options']['capability_controller']) ? $this->page_config['use_dropdown_columns_options']['capability_controller'] : []);
$user_types = !empty($this->page_config['use_dropdown_columns_options']['capability_user_type']) ? $this->page_config['use_dropdown_columns_options']['capability_user_type'] : [];

$methods = class_exists($target_controller) ? get_class_methods($target_controller) : [];
$valid_methods = [];
if (!empty($methods)) {
    foreach ($methods as $m) {
        try {
            $rc = new ReflectionMethod($target_controller, $m);
            if ($rc->isPublic() && $rc->isUserDefined() && $m !== '__construct' && $m !== 'get_instance') {
                $valid_methods[] = $m;
            }
        } catch (Exception $e) {
            continue;
        }
    }
}

// Sort common CRUD actions to top
$priority_order = ['index', 'add_detail', 'edit_detail', 'view_detail', 'delete', 'quick_edit', 'search', 'excel_convert', 'fast_update', 'capability_list'];
usort($valid_methods, function($a, $b) use ($priority_order) {
    $posA = array_search($a, $priority_order);
    $posB = array_search($b, $priority_order);
    if ($posA !== false && $posB !== false) return $posA - $posB;
    if ($posA !== false) return -1;
    if ($posB !== false) return 1;
    return strcmp($a, $b);
});
?>

<div class="ss-capability-container" style="padding: 10px 0 60px 0;">
    <!-- Top Header Card -->
    <div class="box box-primary ss-card" style="margin-bottom: 20px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);">
        <div class="box-body" style="padding: 20px;">
            <div class="row" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                <div class="col-md-7 col-xs-12">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(99, 102, 241, 0.1); color: #6366f1; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                            <i class="fa fa-shield"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; font-size: 18px; font-weight: 800; color: #0f172a;">
                                Role Capabilities &amp; Access Permissions
                            </h3>
                            <p style="margin: 4px 0 0 0; font-size: 13px; color: #64748b;">
                                Configure method permissions for Controller: 
                                <span class="badge" style="background: #eef2ff; color: #4f46e5; font-size: 12px; font-weight: 700; border: 1px solid #c7d2fe; padding: 4px 10px; border-radius: 6px;">
                                    <?= htmlspecialchars($target_controller) ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Controller Selector Dropdown -->
                <div class="col-md-5 col-xs-12" style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
                    <label for="selectTargetController" style="margin: 0; font-size: 13px; font-weight: 600; color: #475569; white-space: nowrap;">
                        <i class="fa fa-exchange" style="color: #6366f1;"></i> Switch Controller:
                    </label>
                    <select id="selectTargetController" class="form-control" style="height: 38px; border-radius: 8px; border: 1.5px solid #cbd5e1; font-weight: 600; color: #1e293b; max-width: 240px;" onchange="switchController(this.value)">
                        <?php foreach ($controllers_list as $cKey => $cVal): ?>
                            <option value="<?= htmlspecialchars($cKey) ?>" <?= ($cKey === $target_controller) ? 'selected' : '' ?>>
                                <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $cVal))) ?> (<?= htmlspecialchars($cKey) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Capability Matrix Form -->
    <form method="post" action="" id="capabilityMatrixForm">
        <?php if (empty($user_types)): ?>
            <div class="alert alert-warning" style="border-radius: 8px;">
                <i class="fa fa-exclamation-triangle"></i> No user roles found to configure.
            </div>
        <?php endif; ?>

        <?php foreach ($user_types as $user_type_ID => $user_type): ?>
            <div class="box box-default ss-card" style="margin-bottom: 24px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; box-shadow: 0 1px 4px rgba(15, 23, 42, 0.04); overflow: hidden;">
                <div class="box-header with-border" style="padding: 14px 20px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa fa-user-circle" style="color: #6366f1; font-size: 16px;"></i>
                        <h4 class="box-title" style="margin: 0; font-weight: 700; font-size: 15px; color: #0f172a;">
                            Role: <?= htmlspecialchars(ucwords($user_type)) ?>
                        </h4>
                        <?php if ($user_type_ID == 1): ?>
                            <span class="label label-success" style="font-size: 11px; padding: 3px 8px; border-radius: 9999px;">
                                <i class="fa fa-star"></i> Super Admin (Full Access by Default)
                            </span>
                        <?php else: ?>
                            <span class="label label-info" style="font-size: 11px; padding: 3px 8px; border-radius: 9999px;">
                                ID: #<?= $user_type_ID ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Role Quick Check Actions -->
                    <div class="btn-group" style="display: flex; gap: 6px;">
                        <button type="button" class="btn btn-default btn-xs" onclick="toggleRoleChecks('<?= $user_type_ID ?>', true)" style="border-radius: 6px; font-weight: 600; padding: 4px 10px; font-size: 11.5px;">
                            <i class="fa fa-check-square-o text-success"></i> Check All
                        </button>
                        <button type="button" class="btn btn-default btn-xs" onclick="toggleRoleChecks('<?= $user_type_ID ?>', false)" style="border-radius: 6px; font-weight: 600; padding: 4px 10px; font-size: 11.5px;">
                            <i class="fa fa-square-o text-danger"></i> Clear All
                        </button>
                    </div>
                </div>

                <div class="box-body no-padding table-responsive">
                    <table class="table table-hover table-striped" style="margin-bottom: 0;">
                        <thead>
                            <tr style="background: #ffffff; color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <th style="width: 25%; padding: 12px 20px;">Controller</th>
                                <th style="width: 45%; padding: 12px 16px;">Action / Method</th>
                                <th style="width: 30%; padding: 12px 20px; text-align: center;">Permission Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($valid_methods)): ?>
                                <tr>
                                    <td colspan="3" class="text-center" style="padding: 30px; color: #94a3b8;">
                                        <i class="fa fa-info-circle"></i> No user-defined methods found in controller <strong><?= htmlspecialchars($target_controller) ?></strong>.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($valid_methods as $method): ?>
                                    <?php 
                                        $isChecked = (!empty($choosenData['capability'][$target_controller][$user_type_ID][$method]) && $choosenData['capability'][$target_controller][$user_type_ID][$method] === "true");
                                        if ($user_type_ID == 1 && !isset($choosenData['capability'][$target_controller][$user_type_ID])) {
                                            $isChecked = true; // Admin defaults to true
                                        }
                                        $methodLabel = $method;
                                        switch ($method) {
                                            case 'index': $methodDesc = 'View & list records table'; break;
                                            case 'add_detail': $methodDesc = 'Add & save new entries'; break;
                                            case 'edit_detail': $methodDesc = 'Modify & update existing records'; break;
                                            case 'view_detail': $methodDesc = 'Open record detail modal'; break;
                                            case 'delete': $methodDesc = 'Delete records from system'; break;
                                            case 'quick_edit': $methodDesc = 'Quick in-place field updates'; break;
                                            case 'excel_convert': $methodDesc = 'Export data to Excel / CSV'; break;
                                            case 'capability_list': $methodDesc = 'Manage role capabilities'; break;
                                            case 'search': $methodDesc = 'Execute search queries'; break;
                                            default: $methodDesc = 'Controller action method'; break;
                                        }
                                    ?>
                                    <tr class="perm-row <?= $isChecked ? 'row-checked' : '' ?>">
                                        <td style="padding: 12px 20px; vertical-align: middle; font-weight: 600; color: #1e293b;">
                                            <i class="fa fa-folder-open-o" style="color: #6366f1; margin-right: 6px;"></i>
                                            <?= htmlspecialchars($target_controller) ?>
                                        </td>
                                        <td style="padding: 12px 16px; vertical-align: middle;">
                                            <div style="font-weight: 700; color: #0f172a; font-size: 13.5px;">
                                                <?= htmlspecialchars($method) ?>
                                            </div>
                                            <div style="font-size: 12px; color: #64748b;">
                                                <?= $methodDesc ?>
                                            </div>
                                        </td>
                                        <td style="padding: 12px 20px; vertical-align: middle; text-align: center;">
                                            <label class="switch-modern" style="margin: 0; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                                                <input type="checkbox" 
                                                       class="perm-checkbox role-<?= $user_type_ID ?>" 
                                                       name="capability[<?= htmlspecialchars($target_controller) ?>][<?= $user_type_ID ?>][<?= htmlspecialchars($method) ?>]" 
                                                       value="true" 
                                                       <?= $isChecked ? 'checked="checked"' : '' ?>
                                                       onchange="toggleRowHighlight(this)">
                                                <span class="status-indicator <?= $isChecked ? 'text-success' : 'text-muted' ?>" style="font-size: 12.5px; font-weight: 600;">
                                                    <?= $isChecked ? '<i class="fa fa-check-circle"></i> Allowed' : '<i class="fa fa-times-circle"></i> Denied' ?>
                                                </span>
                                            </label>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Floating Sticky Bottom Bar for Save -->
        <div class="ss-sticky-action-bar" style="position: sticky; bottom: 0; background: rgba(255, 255, 255, 0.94); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border-top: 1px solid #cbd5e1; padding: 14px 24px; box-shadow: 0 -4px 16px rgba(15, 23, 42, 0.08); display: flex; align-items: center; justify-content: space-between; z-index: 999; border-radius: 12px 12px 0 0; margin: 0 -15px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="<?= console_url('capability') ?>" class="btn btn-default" style="border-radius: 8px; font-weight: 600; padding: 8px 16px;">
                    <i class="fa fa-arrow-left"></i> Capabilities List
                </a>
                <a href="<?= console_url('permission') ?>" class="btn btn-default" style="border-radius: 8px; font-weight: 600; padding: 8px 16px;">
                    <i class="fa fa-key"></i> Permissions
                </a>
            </div>

            <div style="display: flex; align-items: center; gap: 12px;">
                <span id="saveNotice" style="display: none; font-size: 12.5px; color: #10b981; font-weight: 600;">
                    <i class="fa fa-check"></i> Changes pending save
                </span>
                <button type="submit" class="btn btn-primary" style="background: #10b981; border-color: #059669; padding: 9px 24px; font-size: 14px; font-weight: 700; border-radius: 8px; box-shadow: 0 2px 8px rgba(16, 185, 129, 0.35);">
                    <i class="fa fa-save" style="margin-right: 6px;"></i> Save Capabilities
                </button>
            </div>
        </div>
    </form>
</div>

<style>
.perm-row.row-checked {
    background-color: rgba(99, 102, 241, 0.02) !important;
}
.perm-checkbox {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #10b981;
}
</style>

<script type="text/javascript">
function switchController(ctrlName) {
    if (!ctrlName) return;
    window.location.href = '<?= console_url() ?>' + ctrlName + '/capability_list';
}

function toggleRoleChecks(roleId, state) {
    $('.role-' + roleId).each(function() {
        $(this).prop('checked', state);
        toggleRowHighlight(this);
    });
    $('#saveNotice').fadeIn(150);
}

function toggleRowHighlight(chk) {
    var $tr = $(chk).closest('tr');
    var $lbl = $(chk).siblings('.status-indicator');
    if ($(chk).is(':checked')) {
        $tr.addClass('row-checked');
        $lbl.removeClass('text-muted').addClass('text-success').html('<i class="fa fa-check-circle"></i> Allowed');
    } else {
        $tr.removeClass('row-checked');
        $lbl.removeClass('text-success').addClass('text-muted').html('<i class="fa fa-times-circle"></i> Denied');
    }
    $('#saveNotice').fadeIn(150);
}

$(document).ready(function() {
    $('#capabilityMatrixForm').on('submit', function() {
        var $btn = $(this).find('button[type="submit"]');
        $btn.html('<i class="fa fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
    });
});
</script>