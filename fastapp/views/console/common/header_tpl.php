<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'Mount Carmel School' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?= isset($site_settings['site_setting_description']) ? $site_settings['site_setting_description'] : '' ?>">
    <meta name="author" content="Logic Mystery">
    <meta name="theme-color" content="#424242" />

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">

    <!-- CSS System -->
    <link href="<?= cdn_url(); ?>css.mini.php" rel="stylesheet">
    <link href="<?= cdn_url(); ?>assets/backend/dist/css/style-main.css" rel="stylesheet">
    <link href="<?= cdn_url(); ?>assets/backend/dist/themes/default/skins/_all-skins.min.css" rel="stylesheet">
    <link href="<?= cdn_url(); ?>assets/backend/dist/themes/default/ss-main.css" rel="stylesheet">
    <link href="<?= cdn_url(); ?>assets/dist/css/smart_school_ui.css?v=<?= time() ?>" rel="stylesheet">
    <link href="<?= cdn_url(); ?>assets/backend/toast-alert/toastr.css" rel="stylesheet">
    <link href="<?= cdn_url(); ?>assets/backend/plugins/select2/select2.min.css" rel="stylesheet">

    <!-- jQuery & Core FastApp Scripts -->
    <script src="<?= cdn_url(); ?>assets/custom/jquery.min.js"></script>
    <script src="<?= cdn_url(); ?>assets/custom/fastapp.js?v=<?= time() ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= cdn_url() ?>img/simplebillingsfav.png">
    
    <script>
        var console_url = '<?= console_url() ?>';
        var cdn_url = '<?= cdn_url() ?>';
        var page_url = '<?= base_url() . $this->uri->segment(1) ?>/<?= $this->uri->segment(2) ?>/';
        var section = '<?= isset($orderByModelData) ? $orderByModelData : '' ?>';
        
        function collapseSidebar() {
            $('body').toggleClass('sidebar-collapse');
            if ($('body').hasClass('sidebar-collapse')) {
                localStorage.setItem('sidebar-collapse', '1');
            } else {
                localStorage.setItem('sidebar-collapse', '0');
            }
        }

        $(document).ready(function() {
            if (localStorage.getItem('sidebar-collapse') === '1') {
                $('body').addClass('sidebar-collapse');
            }
            // Ensure only one topbar dropdown can be open at a time
            $(document).on('click', '.topbar-right-menu [data-toggle="dropdown"]', function(e) {
                var $parent = $(this).closest('.dropdown');
                $('.topbar-right-menu .dropdown.open').not($parent).removeClass('open');
            });
        });
        function switchLanguage(langId, flagClass, code) {
            if (document.getElementById('languageSwitcher')) {
                document.getElementById('languageSwitcher').value = langId;
            }
            var trigger = document.getElementById('langDropdownTrigger');
            if (trigger) {
                var flagBox = trigger.querySelector('.lang-flag-box');
                var codeSpan = trigger.querySelector('.current-lang-code');
                if (flagBox) flagBox.innerHTML = '<span class="flag-icon ' + flagClass + '"></span>';
                if (codeSpan) codeSpan.innerText = code;
            }
            if (typeof set_languages === 'function') {
                set_languages(langId);
            }
        }
    </script>

    <script language="Javascript" type="text/javascript" src="<?= cdn_url() ?>js/edit_area/edit_area_full.js"></script>
    <?php execute_hook('header'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="noty_bar noty_theme_default noty_layout_center" id="noty_xhr" style="background-color: ghostwhite; cursor: pointer; display: none; top:0px; width: 100%; z-index: 9999;">
        <div class="noty_message"><span class="noty_text">Loading.. Just a moment</span></div>
    </div>

    <?php if ($current_user_session) { ?>
    <div class="wrapper">
        <!-- Main Top Header -->
        <header class="main-header" id="alert">
            <!-- Medical Shop Logo with Smart School Style Badge -->
            <a href="<?= console_url() ?>" class="logo">
                <span class="logo-mini"><i class="fa fa-medkit"></i></span>
                <span class="logo-lg">
                    <span class="ss-logo-badge">
                        <i class="fa fa-plus-square"></i>
                        <span class="ss-logo-text">MEDICAL SHOP</span>
                    </span>
                </span>
            </a>

            <!-- Header Navigation -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Left: Toggle & Shop Title -->
                <div class="topbar-left-section">
                    <!-- Single Sidebar Toggle Hamburger Button -->
                    <button type="button" onclick="collapseSidebar()" class="topbar-toggle-btn" role="button" title="Toggle Navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Medical Shop Title -->
                    <div class="topbar-title-wrap hidden-xs">
                        <span class="topbar-shop-title">
                            <i class="fa fa-medkit text-success" style="font-size:16px;"></i>
                            <?= !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'Medical Shop & Pharmacy' ?>
                        </span>
                    </div>
                </div>

                <!-- Center: Quick Search Form (Pill Style) -->
                <div class="topbar-search-wrap hidden-xs">
                    <form id="header_search_form" class="topbar-search-form" role="search" action="<?= console_url('sale/search') ?>" method="POST" style="margin:0 !important; padding:0 !important; width:100% !important; display:flex !important; align-items:center !important;">
                        <div class="topbar-search-box" style="display:flex !important; align-items:center !important; background:#f8fafc !important; border:1px solid #cbd5e1 !important; border-radius:9999px !important; height:34px !important; max-height:34px !important; padding:0 6px 0 16px !important; width:100% !important; box-sizing:border-box !important; overflow:hidden !important; transition:all 0.2s ease !important;">
                            <input type="text" value="" name="search_text1" id="search_text1" class="topbar-search-input" placeholder="Search medicines, bills, patients..." autocomplete="off" style="border:none !important; border-width:0 !important; background:transparent !important; background-color:transparent !important; box-shadow:none !important; -webkit-box-shadow:none !important; outline:none !important; border-radius:0 !important; margin:0 !important; padding:0 !important; height:100% !important; min-height:30px !important; max-height:34px !important; line-height:30px !important; font-size:13px !important; color:#1e293b !important; flex:1 1 auto !important; min-width:0 !important; width:100% !important;">
                            <button type="submit" name="search" id="search-btn" class="topbar-search-btn" title="Search" style="border:none !important; border-width:0 !important; background:transparent !important; color:#64748b !important; width:26px !important; height:26px !important; padding:0 !important; margin:0 !important; border-radius:50% !important; display:inline-flex !important; align-items:center !important; justify-content:center !important; cursor:pointer !important; flex-shrink:0 !important;">
                                <i class="fa fa-search" style="font-size:13px !important; color:#64748b !important; line-height:1 !important;"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Utilities: STRICTLY Notification, Messages, Language, Profile ONLY -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav topbar-right-menu">
                        <!-- 1. Notification -->
                        <li class="dropdown topbar-item notification-dropdown">
                            <a href="#" class="dropdown-toggle topbar-icon-btn" data-toggle="dropdown" aria-expanded="false" title="Notifications">
                                <i class="fa fa-bell-o"></i>
                                <span class="topbar-badge badge-warning">0</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right topbar-dropdown noti-dropdown-card">
                                <li class="topbar-dropdown-header">
                                    <span>Notifications</span>
                                    <span class="label label-info" style="font-size:10px; border-radius:4px;">0 New</span>
                                </li>
                                <li class="topbar-dropdown-empty">
                                    <i class="fa fa-bell-slash-o"></i>
                                    <span>No new notifications</span>
                                </li>
                            </ul>
                        </li>

                        <!-- 2. Messages -->
                        <li class="topbar-item">
                            <a href="<?= console_url('dashboard') ?>" class="topbar-icon-btn" title="Messages">
                                <i class="fa fa-comment-o"></i>
                                <span class="topbar-badge badge-danger">0</span>
                            </a>
                        </li>

                        <!-- 3. Language -->
                        <li class="dropdown topbar-item language-dropdown">
                            <a href="#" class="dropdown-toggle topbar-lang-btn" data-toggle="dropdown" aria-expanded="false" id="langDropdownTrigger" title="Language">
                                <span class="lang-flag-box"><span class="flag-icon flag-icon-us"></span></span>
                                <span class="current-lang-code">EN</span>
                                <i class="fa fa-angle-down lang-chevron"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right topbar-dropdown lang-dropdown-card">
                                <li>
                                    <a href="javascript:void(0)" onclick="switchLanguage('4', 'flag-icon-us', 'EN')" class="lang-option-item">
                                        <span class="flag-icon flag-icon-us" style="margin-right:8px; border-radius:2px;"></span> English
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="switchLanguage('82', 'flag-icon-in', 'HI')" class="lang-option-item">
                                        <span class="flag-icon flag-icon-in" style="margin-right:8px; border-radius:2px;"></span> Hindi
                                    </a>
                                </li>
                            </ul>
                            <!-- Hidden native select for JS binding - class languageselectpicker omitted to prevent duplicate bootstrap-select widget -->
                            <select onchange="set_languages(this.value)" id="languageSwitcher" style="display:none !important;">
                                <option value="4" selected>English</option>
                                <option value="82">Hindi</option>
                            </select>
                        </li>

                        <!-- 4. Profile -->
                        <li class="dropdown user-menu topbar-item profile-dropdown">
                            <a href="#" class="dropdown-toggle topbar-profile-btn" data-toggle="dropdown" aria-expanded="false" title="Profile">
                                <img src="<?= cdn_url() ?>assets/backend/dist/img/avatar.png" class="topbar-user-avatar" alt="User Image">
                                <span class="topbar-username hidden-xs">
                                    <?= !empty($current_user_session['user_name']) ? $current_user_session['user_name'] : 'Admin' ?>
                                </span>
                                <i class="fa fa-angle-down topbar-profile-chevron"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user dropdown-menu-right topbar-dropdown profile-dropdown-card">
                                <li>
                                    <div class="sstopuser" style="padding:16px; background:linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%); text-align:center;">
                                        <img src="<?= cdn_url() ?>assets/backend/dist/img/avatar.png" alt="User Image" class="topbar-dropdown-avatar" style="width:54px; height:54px; border-radius:50%; border:3px solid #ffffff; box-shadow:0 2px 8px rgba(0,0,0,0.1); margin-bottom:8px;">
                                        <h4 style="margin:0; font-size:15px; font-weight:700; color:#1e293b;"><?= !empty($current_user_session['user_name']) ? $current_user_session['user_name'] : 'Admin' ?></h4>
                                        <h5 style="margin:3px 0 10px 0; font-size:12px; color:#64748b;"><?= !empty($current_user_session['user_role_name']) ? $current_user_session['user_role_name'] : 'Pharmacy Manager' ?></h5>
                                        <a href="<?= console_url('user/change_password') ?>" style="display:inline-flex; align-items:center; gap:6px; font-size:12px; font-weight:600; color:#7367f0; background:#ffffff; padding:5px 14px; border-radius:6px; border:1px solid #cbd5e1; text-decoration:none; box-shadow:0 1px 2px rgba(0,0,0,0.05);"><i class="fa fa-key"></i> Change Password</a>
                                    </div>
                                    <div class="sspass" style="display:flex; justify-content:space-between; align-items:center; padding:12px 16px; background:#ffffff; border-top:1px solid #e2e8f0;">
                                        <a href="<?= base_url() ?>" target="_blank" style="font-size:12.5px; color:#475569; font-weight:600; display:inline-flex; align-items:center; gap:6px; text-decoration:none;"><i class="fa fa-globe"></i> Front Site</a>
                                        <a href="<?= console_url('user/logout') ?>" style="font-size:12.5px; color:#ef4444; font-weight:600; display:inline-flex; align-items:center; gap:6px; text-decoration:none;"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left Navigation Sidebar -->
        <?php $this->load->view('console/elements/left_navigation_tpl'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Breadcrumbs Header -->
            <section class="content-header">
                <?php $this->load->view('console/elements/breadcrumb_tpl'); ?>
            </section>

            <!-- Main Page Content -->
            <section class="content" id="content">
                <noscript>
                    <div class="alert alert-block alert-danger">
                        <h4>Warning!</h4>
                        <p>You need to have JavaScript enabled to use this site.</p>
                    </div>
                </noscript>
    <?php } ?>