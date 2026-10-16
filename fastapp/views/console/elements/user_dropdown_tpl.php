<?php if ($current_user_session): ?>
<div class="btn-group pull-right" style="margin: 10px 0;">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="display:inline-flex; align-items:center; gap:8px; border-radius: 9999px; padding: 6px 16px; background:#ffffff; border: 1px solid var(--ss-border, #e2e8f0); box-shadow: var(--ss-shadow-xs, 0 1px 2px rgba(0,0,0,0.05)); transition: all 0.2s ease;">
        <i class="fa fa-user-circle-o" style="font-size:18px; color:var(--ss-primary, #6366f1);"></i>
        <span class="hidden-phone" style="font-weight:700; font-size:13px; color:var(--ss-text-main, #0f172a);"> <?= html_escape($current_user_session['user_firstname'].' '.$current_user_session['user_lastname']) ?></span>
        <span class="caret" style="margin-left:4px;"></span>
    </a>
    <ul class="dropdown-menu pull-right" style="min-width: 200px; padding: 8px; border-radius: 14px; box-shadow: var(--ss-shadow-lg, 0 10px 25px rgba(0,0,0,0.1)); border: 1px solid var(--ss-border, #e2e8f0); margin-top: 8px;">
        <li style="padding: 10px 14px 12px 14px; border-bottom: 1px solid var(--ss-border, #e2e8f0); margin-bottom: 6px;">
            <div style="font-weight:700; font-size:13.5px; color:var(--ss-text-main, #0f172a);"><?= html_escape($current_user_session['user_firstname'].' '.$current_user_session['user_lastname']) ?></div>
            <div style="font-size:11px; color:var(--ss-primary, #6366f1); font-weight:700; text-transform:uppercase; letter-spacing:0.04em; margin-top:2px;">Active Staff</div>
        </li>
        <li><a href="<?= console_url() ?>user/profile" style="padding: 8px 12px; border-radius: 8px; display:flex; align-items:center; gap:8px; font-weight: 500; font-size: 13px;"><i class="fa fa-user-o" style="color:var(--ss-text-muted, #64748b);"></i> My Profile</a></li>
        <li class="divider" style="margin: 6px 0;"></li>
        <li><a href="<?= console_url() ?>user/logout" style="color:var(--ss-danger, #ef4444) !important; padding: 8px 12px; border-radius: 8px; display:flex; align-items:center; gap:8px; font-weight: 600; font-size: 13px;"><i class="fa fa-sign-out" style="color:var(--ss-danger, #ef4444);"></i> Sign Out</a></li>
    </ul>
</div>
<?php endif; ?>