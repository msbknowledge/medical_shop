<?php 
/**
 * Smart School Flow UI - Top Navigation Bar
 * 100% Exact match to user screenshots:
 * Entry, Billing, Medicine Reports (with flyouts for Purchase Reports & Sale Reports), Help, Management
 */

if (!isset($site_menu) || empty($site_menu)) {
    if (file_exists(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/menu_cache.txt')) {
        $site_menu = json_decode(file_get_contents(ROOTPATH . 'fastapp/cachefiles/' . NODE . '/menu_cache.txt'), true);
    }
}

if (!function_exists('buildTopTree')) {
    function buildTopTree(array $elements, $parentId = "") {
        $branch = array();
        foreach ($elements as $element) {
            if (!is_array($element)) continue;
            $elemParent = isset($element['menu_parent_id']) ? strval($element['menu_parent_id']) : '';
            if ($elemParent === '0') $elemParent = '';
            
            if ($elemParent === strval($parentId)) {
                $children = buildTopTree($elements, $element['menu_ID']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}

if (!function_exists('getMenuFAIcon')) {
    function getMenuFAIcon($icon_class, $parent_id = '') {
        if ($parent_id === 'entry' || strpos($icon_class, 'edit') !== false) {
            return 'fa fa-pencil';
        }
        if ($parent_id === 'medicine_report' || $parent_id === 'report_purchase' || $parent_id === 'report_sale' || strpos($icon_class, 'calendar') !== false) {
            return 'fa fa-calendar';
        }
        if ($parent_id === 'billing' || strpos($icon_class, 'document') !== false) {
            return 'fa fa-file-text-o';
        }
        if (strpos($icon_class, 'briefcase') !== false) return 'fa fa-briefcase';
        if (strpos($icon_class, 'users') !== false) return 'fa fa-users';
        if (strpos($icon_class, 'user') !== false) return 'fa fa-user';
        return 'fa fa-folder-o';
    }
}

$topNavTree = array();
if (!empty($site_menu) && is_array($site_menu)) {
    $topNavTree = buildTopTree($site_menu, "");
}

// Order: Entry, Billing, Medicine Reports, Help, Management
$orderWeights = array(
    'entry'           => 1,
    'billing'         => 2,
    'medicine_report' => 3,
    'help'            => 4,
    '1'               => 5
);

usort($topNavTree, function($a, $b) use ($orderWeights) {
    $wA = isset($orderWeights[$a['menu_ID']]) ? $orderWeights[$a['menu_ID']] : 99;
    $wB = isset($orderWeights[$b['menu_ID']]) ? $orderWeights[$b['menu_ID']] : 99;
    return $wA - $wB;
});

$cur_seg2 = $this->uri->segment(2);
$cur_seg3 = $this->uri->segment(3);
?>
<div class="top-header-navigation-wrapper hidden-xs">
    <ul class="nav navbar-nav top-med-nav">
        <?php foreach ($topNavTree as $rootItem): 
            $rootIcon = getMenuFAIcon($rootItem['menu_icon_class'], $rootItem['menu_ID']);
            $hasChildren = !empty($rootItem['children']);
        ?>
            <li class="dropdown top-nav-item">
                <a href="<?= !empty($rootItem['menu_link']) ? console_url($rootItem['menu_link']) : '#' ?>" class="dropdown-toggle top-nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="<?= isset($rootItem['menu_hint']) ? $rootItem['menu_hint'] : '' ?>">
                    <i class="<?= $rootIcon ?> nav-main-icon"></i>
                    <span class="nav-text"><?= htmlspecialchars($rootItem['menu_name']) ?></span>
                    <?php if ($hasChildren): ?>
                        <i class="fa fa-caret-down nav-caret"></i>
                    <?php endif; ?>
                </a>

                <?php if ($hasChildren): ?>
                    <ul class="dropdown-menu top-med-dropdown">
                        <?php foreach ($rootItem['children'] as $childItem): 
                            $childIcon = getMenuFAIcon($childItem['menu_icon_class'], $rootItem['menu_ID']);
                            $hasGrandChildren = !empty($childItem['children']);
                        ?>
                            <?php if ($hasGrandChildren): ?>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);" class="submenu-toggle">
                                        <i class="<?= $childIcon ?>"></i>
                                        <span><?= htmlspecialchars($childItem['menu_name']) ?></span>
                                        <i class="fa fa-caret-down pull-right submenu-arrow"></i>
                                    </a>
                                    <ul class="dropdown-menu top-med-dropdown top-flyout-dropdown">
                                        <?php foreach ($childItem['children'] as $subChild): 
                                            $subIcon = getMenuFAIcon($subChild['menu_icon_class'], $childItem['menu_ID']);
                                        ?>
                                            <li>
                                                <a href="<?= console_url($subChild['menu_link']) ?>" title="<?= isset($subChild['menu_hint']) ? $subChild['menu_hint'] : '' ?>">
                                                    <i class="<?= $subIcon ?>"></i>
                                                    <span><?= htmlspecialchars($subChild['menu_name']) ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="<?= console_url($childItem['menu_link']) ?>" title="<?= isset($childItem['menu_hint']) ? $childItem['menu_hint'] : '' ?>">
                                        <i class="<?= $childIcon ?>"></i>
                                        <span><?= htmlspecialchars($childItem['menu_name']) ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<style>
/* Modern Medical Shop Top Navbar Menus */
.top-header-navigation-wrapper {
    display: inline-flex;
    align-items: center;
    vertical-align: middle;
    margin-left: 12px;
}
.top-med-nav {
    display: flex !important;
    align-items: center;
    margin: 0;
    padding: 0;
    list-style: none;
    gap: 4px;
}
.top-med-nav > li.top-nav-item {
    position: relative;
    float: none !important;
    display: inline-block;
}
.top-med-nav > li.top-nav-item > a.top-nav-link {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    color: #1e293b !important;
    padding: 7px 12px !important;
    border-radius: 6px !important;
    display: flex !important;
    align-items: center !important;
    gap: 6px !important;
    text-shadow: none !important;
    line-height: 1.4 !important;
    background: transparent !important;
    border: 1px solid transparent !important;
    transition: all 0.15s ease-in-out !important;
    text-decoration: none !important;
}
.top-med-nav > li.top-nav-item > a.top-nav-link:hover,
.top-med-nav > li.top-nav-item.open > a.top-nav-link {
    background: #f1f5f9 !important;
    color: #0284c7 !important;
    border-color: #e2e8f0 !important;
}
.top-med-nav > li.top-nav-item > a.top-nav-link .nav-main-icon {
    font-size: 13px !important;
    color: #475569 !important;
}
.top-med-nav > li.top-nav-item.open > a.top-nav-link .nav-main-icon,
.top-med-nav > li.top-nav-item > a.top-nav-link:hover .nav-main-icon {
    color: #0284c7 !important;
}
.top-med-nav > li.top-nav-item > a.top-nav-link .nav-caret {
    font-size: 12px !important;
    margin-left: 2px !important;
    color: #64748b !important;
    transition: transform 0.15s ease;
}
.top-med-nav > li.top-nav-item.open > a.top-nav-link .nav-caret {
    transform: rotate(180deg);
    color: #0284c7 !important;
}

/* Primary Dropdown Container matching User Screenshots */
.top-med-dropdown {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    min-width: 210px !important;
    background: #ffffff !important;
    border: 1px solid rgba(0, 0, 0, 0.15) !important;
    border-radius: 4px !important;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175) !important;
    padding: 5px 0 !important;
    margin-top: 2px !important;
    list-style: none !important;
    z-index: 1050 !important;
}
.top-med-dropdown > li {
    position: relative;
    padding: 0;
    margin: 0;
}
.top-med-dropdown > li > a {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    padding: 6px 16px !important;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    font-size: 13.5px !important;
    font-weight: 400 !important;
    color: #333333 !important;
    line-height: 1.42857143 !important;
    white-space: nowrap !important;
    text-decoration: none !important;
    transition: background-color 0.1s ease, color 0.1s ease;
}
.top-med-dropdown > li > a > i {
    width: 15px !important;
    text-align: center !important;
    font-size: 13px !important;
    color: #4b5563 !important;
    flex-shrink: 0;
}
/* Exact Blue Hover State from User Screenshots */
.top-med-dropdown > li > a:hover,
.top-med-dropdown > li.open > a,
.top-med-dropdown > li.active > a {
    background-color: #337ab7 !important;
    color: #ffffff !important;
}
.top-med-dropdown > li > a:hover > i,
.top-med-dropdown > li.open > a > i,
.top-med-dropdown > li.active > a > i {
    color: #ffffff !important;
}

/* Multi-level Dropdown Submenus (Purchase Reports & Sale Reports) */
.dropdown-submenu {
    position: relative !important;
}
.dropdown-submenu > a .submenu-arrow {
    font-size: 12px !important;
    margin-top: 3px !important;
    color: inherit;
}
.dropdown-submenu > .top-flyout-dropdown {
    top: 0 !important;
    left: 100% !important;
    margin-top: -5px !important;
    margin-left: 1px !important;
    display: none !important;
}
.dropdown-submenu:hover > .top-flyout-dropdown,
.dropdown-submenu.open > .top-flyout-dropdown {
    display: block !important;
}

/* Prevent menu caret artifacts */
.navbar .top-med-dropdown:before,
.navbar .top-med-dropdown:after {
    display: none !important;
}
</style>

<script>
$(document).ready(function() {
    // Dropdown hover & click interaction for submenus
    $('.top-header-navigation-wrapper .dropdown-submenu').hover(function() {
        $(this).children('.top-flyout-dropdown').stop(true, true).delay(50).fadeIn(150);
    }, function() {
        $(this).children('.top-flyout-dropdown').stop(true, true).delay(50).fadeOut(150);
    });

    // Touch support for submenus
    $('.top-header-navigation-wrapper .dropdown-submenu > a').on('click', function(e) {
        if ($(this).next('.top-flyout-dropdown').length > 0) {
            e.preventDefault();
            e.stopPropagation();
            var $parent = $(this).parent();
            $parent.siblings('.dropdown-submenu').removeClass('open').find('.top-flyout-dropdown').hide();
            $parent.toggleClass('open');
            if ($parent.hasClass('open')) {
                $(this).next('.top-flyout-dropdown').fadeIn(150);
            } else {
                $(this).next('.top-flyout-dropdown').fadeOut(150);
            }
        }
    });
});
</script>
