<div class="top-nav nav-collapse">
<?php 
$nav = null;
if (!function_exists('buildTree')) {
    function buildTree(array $elements, $parentId = "") {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['menu_parent_id'] == $parentId) {
                $children = buildTree($elements, $element['menu_ID']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}
$nav = buildTree($site_menu);

if (!function_exists('generate_html_menus')) {
    function generate_html_menus($nav){
?>
<?php if (is_array($nav)){ ?>
<ul class="<?php echo (isset($nav[0]['menu_parent_id']) && $nav[0]['menu_parent_id'] == "") ? 'nav navbar-nav ss-top-menu' : 'dropdown-menu ss-dropdown-menu'; ?>">
	<?php foreach ($nav as $value){ ?>
		<?php if (empty($value['children'])){ ?>
			<li class="ss-nav-item">
				<a class="ss-nav-link" title="<?= isset($value['menu_hint']) ? $value['menu_hint'] : '' ?>" href="<?= console_url($value['menu_link']) ?>"> 
				    <i class="<?= !empty($value['menu_icon_class']) ? $value['menu_icon_class'] : 'fa fa-folder-o' ?>"></i> 
				    <span><?= $value['menu_name'] ?></span>
				</a>
			</li>
		<?php } else { ?>
			<li class="dropdown ss-nav-item">
                <a class="ajax-link dropdown-toggle ss-nav-link" data-toggle="dropdown" href="#" title="<?= isset($value['menu_hint']) ? $value['menu_hint'] : '' ?>"> 
                    <i class="<?= !empty($value['menu_icon_class']) ? $value['menu_icon_class'] : 'fa fa-folder' ?>"></i> 
                    <span><?= $value['menu_name'] ?></span>
                    <i class="fa fa-angle-down ss-caret-icon"></i>
                </a>
				<?php generate_html_menus($value['children']); ?>
			</li>
		<?php } ?>
	<?php } ?>
</ul>
<?php } ?>
<?php
    }
}

if ($current_user_session): ?>
<?php generate_html_menus($nav); ?>
<?php endif; ?>
</div>

<style>
/* Modern Smart School Flow UI Top Navigation */
.ss-top-menu {
    display: flex !important;
    align-items: center;
    gap: 4px;
    margin: 0;
    padding: 0;
    list-style: none;
}
.ss-top-menu > li.ss-nav-item > a.ss-nav-link {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    color: var(--ss-text-body, #4b5563) !important;
    padding: 8px 14px !important;
    border-radius: 9999px !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    text-shadow: none !important;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
    text-decoration: none !important;
    background: transparent !important;
    border: 1px solid transparent !important;
}
.ss-top-menu > li.ss-nav-item > a.ss-nav-link:hover,
.ss-top-menu > li.ss-nav-item.open > a.ss-nav-link {
    color: var(--ss-primary, #6366f1) !important;
    background: rgba(99, 102, 241, 0.08) !important;
    border-color: rgba(99, 102, 241, 0.15) !important;
}
.ss-caret-icon {
    font-size: 11px !important;
    margin-left: 2px;
    transition: transform 0.2s ease;
}
.ss-nav-item.open > a .ss-caret-icon {
    transform: rotate(180deg);
}

/* Dropdown Menu */
.ss-dropdown-menu {
    border-radius: 12px !important;
    border: 1px solid var(--ss-border, #e2e8f0) !important;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04) !important;
    padding: 6px !important;
    min-width: 200px !important;
    background: #ffffff !important;
    margin-top: 6px !important;
}
.ss-dropdown-menu > li > a {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    color: var(--ss-text-body, #334155) !important;
    padding: 8px 12px !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    transition: all 0.15s ease !important;
    text-shadow: none !important;
}
.ss-dropdown-menu > li > a:hover {
    background: var(--ss-bg-soft, #f8fafc) !important;
    color: var(--ss-primary, #6366f1) !important;
    padding-left: 16px !important;
}
.dropdown-submenu { position: relative; }
.dropdown-submenu > .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: 4px;
    border-radius: 12px !important;
}
.dropdown-submenu:hover > .dropdown-menu {
    display: block;
}
.navbar .dropdown-menu:before,
.navbar .dropdown-menu:after {
    display: none !important;
}
</style>
<script>
$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
    event.preventDefault(); 
    event.stopPropagation(); 
    $('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
    $(this).parent().addClass('open');

    var menu = $(this).parent().find("ul");
    var menupos = menu.offset();
  
    if (menupos && (menupos.left + menu.width()) + 30 > $(window).width()) {
        var newpos = - menu.width();      
    } else {
        var newpos = $(this).parent().width();
    }
    menu.css({ left: newpos });
});
</script>
