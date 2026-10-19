<?php
/**
 * Smart School Flow UI - Top Navbar Reminder Bell & Automated Alert Notification
 */
if ($current_user_session):
?>
<!-- Reminder Bell Dropdown Widget -->
<div class="btn-group pull-right reminder-bell-wrapper" style="margin: 10px 10px 10px 0;">
    <a class="btn dropdown-toggle reminder-bell-btn" data-toggle="dropdown" href="#" id="reminderBellBtn" title="Automatic Reminders & Alerts">
        <span class="bell-icon-container">
            <i class="fa fa-bell" style="font-size: 16px; color: #475569;"></i>
            <span class="reminder-badge-count" id="reminderNavBadge" style="display: none;">0</span>
        </span>
    </a>
    
    <div class="dropdown-menu pull-right reminder-dropdown-popover" style="width: 330px; padding: 0; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); border: 1px solid #e2e8f0; overflow: hidden; margin-top: 8px;">
        <!-- Header -->
        <div style="padding: 12px 16px; background: #0f172a; color: #ffffff; display: flex; justify-content: space-between; align-items: center;">
            <div style="font-weight: 800; font-size: 13.5px; display: flex; align-items: center; gap: 8px;">
                <i class="fa fa-bell-o" style="color: #ef4444;"></i> Automatic Reminders
            </div>
            <button type="button" class="btn btn-mini" onclick="pollReminderSummary(event)" title="Refresh Reminders" style="background: rgba(255, 255, 255, 0.15); border: none; color: #ffffff; border-radius: 6px; padding: 2px 8px; font-size: 11px;">
                <i class="fa fa-refresh"></i> Check
            </button>
        </div>

        <!-- Alert Items List -->
        <div style="max-height: 340px; overflow-y: auto; padding: 8px 0;" id="reminderBellContent">
            <!-- Item 1: Expired Medicines -->
            <a href="<?= console_url('reminder') ?>" class="reminder-popover-item" id="reminder_item_expired">
                <div class="reminder-popover-icon" style="background: #fee2e2; color: #ef4444;">
                    <i class="fa fa-ban"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div style="font-weight: 700; font-size: 13px; color: #0f172a;">Expired Medicines</div>
                    <div style="font-size: 11.5px; color: #64748b;" id="reminder_nav_exp_text">Checking stock...</div>
                </div>
                <span class="badge badge-important" id="reminder_nav_exp_badge" style="font-size: 11px;">0</span>
            </a>

            <!-- Item 2: Near Expiry Stock -->
            <a href="<?= console_url('reminder') ?>" class="reminder-popover-item" id="reminder_item_near">
                <div class="reminder-popover-icon" style="background: #fef3c7; color: #d97706;">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div style="font-weight: 700; font-size: 13px; color: #0f172a;">Near Expiry Batches</div>
                    <div style="font-size: 11.5px; color: #64748b;" id="reminder_nav_near_text">Expiring in 90 days</div>
                </div>
                <span class="badge badge-warning" id="reminder_nav_near_badge" style="font-size: 11px;">0</span>
            </a>

            <!-- Item 3: Customer Payment Dues -->
            <a href="<?= console_url('reminder') ?>" class="reminder-popover-item" id="reminder_item_cust">
                <div class="reminder-popover-icon" style="background: #e0f2fe; color: #0284c7;">
                    <i class="fa fa-users"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div style="font-weight: 700; font-size: 13px; color: #0f172a;">Customer Payment Dues</div>
                    <div style="font-size: 11.5px; color: #64748b;" id="reminder_nav_cust_text">Outstanding credit</div>
                </div>
                <span class="badge badge-info" id="reminder_nav_cust_badge" style="font-size: 11px;">0</span>
            </a>

            <!-- Item 4: Supplier Dues -->
            <a href="<?= console_url('reminder') ?>" class="reminder-popover-item" id="reminder_item_sup">
                <div class="reminder-popover-icon" style="background: #ede9fe; color: #7c3aed;">
                    <i class="fa fa-truck"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div style="font-weight: 700; font-size: 13px; color: #0f172a;">Supplier Outstanding</div>
                    <div style="font-size: 11.5px; color: #64748b;" id="reminder_nav_sup_text">Pending payments</div>
                </div>
                <span class="badge" id="reminder_nav_sup_badge" style="font-size: 11px;">0</span>
            </a>
        </div>

        <!-- Footer -->
        <div style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 10px 16px; text-align: center;">
            <a href="<?= console_url('reminder') ?>" style="font-weight: 700; font-size: 12.5px; color: #6366f1; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                Open Full Reminders Dashboard <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Automated Toast Notification Box (Bottom-Right) -->
<div id="reminderToastBox" style="position: fixed; bottom: 24px; right: 24px; z-index: 99999; display: none; max-width: 360px; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.18); border-left: 5px solid #ef4444; border: 1px solid #cbd5e1; border-left-width: 5px; padding: 14px 16px; transition: all 0.3s ease;">
    <div style="display: flex; align-items: flex-start; gap: 12px;">
        <span style="display: inline-flex; width: 34px; height: 34px; border-radius: 8px; background: #fee2e2; color: #ef4444; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
            <i class="fa fa-bell"></i>
        </span>
        <div style="flex: 1; min-width: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <strong style="font-size: 13px; color: #0f172a;">Automatic Reminder Alert</strong>
                <button type="button" onclick="dismissReminderToast()" style="background: none; border: none; color: #94a3b8; font-size: 16px; cursor: pointer; padding: 0 4px; line-height: 1;">&times;</button>
            </div>
            <div id="reminderToastMsg" style="font-size: 12px; color: #475569; margin: 4px 0 8px 0; line-height: 1.4;">
                Checking reminders...
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="<?= console_url('reminder') ?>" class="btn btn-mini btn-danger" style="border-radius: 6px; font-weight: 700; font-size: 11px; padding: 3px 10px;">
                    View Reminders
                </a>
                <button type="button" class="btn btn-mini btn-default" onclick="dismissReminderToast()" style="border-radius: 6px; font-size: 11px; padding: 3px 8px;">
                    Dismiss
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.reminder-bell-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 9999px !important;
    padding: 6px 12px !important;
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
    transition: all 0.2s ease !important;
    position: relative !important;
}
.reminder-bell-btn:hover {
    background: #f8fafc !important;
    border-color: #cbd5e1 !important;
}
.bell-icon-container {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.reminder-badge-count {
    position: absolute;
    top: -8px;
    right: -10px;
    background: #ef4444;
    color: #ffffff;
    font-size: 10px;
    font-weight: 800;
    line-height: 1;
    padding: 3px 6px;
    border-radius: 9999px;
    box-shadow: 0 2px 4px rgba(239, 68, 68, 0.4);
    animation: bellPulse 2s infinite;
}
@keyframes bellPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.15); }
    100% { transform: scale(1); }
}
.reminder-popover-item {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 10px 16px !important;
    text-decoration: none !important;
    transition: background 0.15s ease !important;
    border-bottom: 1px solid #f1f5f9 !important;
}
.reminder-popover-item:last-child {
    border-bottom: none !important;
}
.reminder-popover-item:hover {
    background: #f8fafc !important;
}
.reminder-popover-icon {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
}
</style>

<script>
function pollReminderSummary(e) {
    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }
    $.post('<?= console_url("reminder/get_summary") ?>', {}, function(res) {
        if (res.status === 'success' && res.data) {
            updateReminderNavUI(res.data);
        }
    }, 'json');
}

function updateReminderNavUI(data) {
    var totalCritical = parseInt(data.total_critical) || 0;
    var totalAlerts = totalCritical + (parseInt(data.near_expiry_count) || 0) + (parseInt(data.supplier_dues_count) || 0);

    var badge = $('#reminderNavBadge');
    if (totalAlerts > 0) {
        badge.text(totalAlerts).show();
        if (totalCritical > 0) {
            badge.css('background', '#ef4444');
        } else {
            badge.css('background', '#f59e0b');
        }
    } else {
        badge.hide();
    }

    // Update Popover Badges and Texts
    $('#reminder_nav_exp_badge').text(data.expired_count);
    if (data.expired_count > 0) {
        $('#reminder_nav_exp_text').html('<strong style="color: #ef4444;">' + data.expired_count + ' batches expired</strong> (Loss: Rs. ' + data.expired_value + ')');
    } else {
        $('#reminder_nav_exp_text').text('No expired medicines in stock');
    }

    $('#reminder_nav_near_badge').text(data.near_expiry_count);
    if (data.near_expiry_count > 0) {
        $('#reminder_nav_near_text').html('<span style="color: #d97706;">' + data.near_expiry_count + ' batches expiring in 90d</span>');
    } else {
        $('#reminder_nav_near_text').text('No batches near expiry');
    }

    $('#reminder_nav_cust_badge').text(data.customer_dues_count);
    if (data.customer_dues_count > 0) {
        $('#reminder_nav_cust_text').html('<strong style="color: #0284c7;">' + data.customer_dues_count + ' patients</strong> (Total: Rs. ' + data.customer_dues_total + ')');
    } else {
        $('#reminder_nav_cust_text').text('All customer balances cleared');
    }

    $('#reminder_nav_sup_badge').text(data.supplier_dues_count);
    if (data.supplier_dues_count > 0) {
        $('#reminder_nav_sup_text').html('<span style="color: #7c3aed;">' + data.supplier_dues_count + ' suppliers</span> (Rs. ' + data.supplier_dues_total + ')');
    } else {
        $('#reminder_nav_sup_text').text('No outstanding supplier dues');
    }

    // Check if Toast should pop up for critical items
    if (totalAlerts > 0 && !sessionStorage.getItem('reminder_toast_dismissed')) {
        var parts = [];
        if (data.expired_count > 0) parts.push(data.expired_count + ' medicine(s) expired in stock');
        if (data.customer_dues_count > 0) parts.push(data.customer_dues_count + ' customer payment dues (Rs. ' + data.customer_dues_total + ')');
        if (data.near_expiry_count > 0 && parts.length === 0) parts.push(data.near_expiry_count + ' batches near expiry');
        
        if (parts.length > 0) {
            $('#reminderToastMsg').html(parts.join('<br>') + '.');
            $('#reminderToastBox').fadeIn(300);
        }
    }
}

function dismissReminderToast() {
    $('#reminderToastBox').fadeOut(200);
    sessionStorage.setItem('reminder_toast_dismissed', 'true');
}

$(document).ready(function() {
    // Initial poll
    pollReminderSummary();
    // Background polling every 3 minutes
    setInterval(pollReminderSummary, 180000);
});
</script>
<?php endif; ?>
