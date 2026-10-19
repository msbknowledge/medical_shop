<?php
/**
 * Smart School Flow UI - Multi-Language Switcher (English, Hindi, Bengali)
 */
$current_lang = 'en';
if (isset($_COOKIE['app_language']) && in_array($_COOKIE['app_language'], array('en', 'hi', 'bn'))) {
    $current_lang = $_COOKIE['app_language'];
} elseif (isset($_COOKIE['googtrans'])) {
    $parts = explode('/', trim($_COOKIE['googtrans'], '/'));
    $c_lang = end($parts);
    if (in_array($c_lang, array('en', 'hi', 'bn'))) {
        $current_lang = $c_lang;
    }
}

$lang_meta = array(
    'en' => array('code' => 'en', 'name' => 'English', 'native' => 'English', 'flag' => '🇬🇧', 'sub' => 'Default Language'),
    'hi' => array('code' => 'hi', 'name' => 'Hindi', 'native' => 'हिन्दी', 'flag' => '🇮🇳', 'sub' => 'हिंदी भाषा'),
    'bn' => array('code' => 'bn', 'name' => 'Bengali', 'native' => 'বাংলা', 'flag' => '🇮🇳', 'sub' => 'বাংলা ভাষা')
);

$active_meta = isset($lang_meta[$current_lang]) ? $lang_meta[$current_lang] : $lang_meta['en'];
?>

<!-- Language Switcher Dropdown (English, Hindi, Bengali) -->
<div class="btn-group pull-right lang-switcher-wrapper" style="margin: 10px 8px 10px 0;">
    <a class="btn dropdown-toggle lang-switcher-btn" data-toggle="dropdown" href="#" id="langSwitcherBtn" title="Change Language / भाषा बदलें / ভাষা পরিবর্তন">
        <i class="fa fa-globe" style="font-size: 15px; color: #475569;"></i>
        <span class="lang-flag" id="currentLangFlag" style="font-size: 14px; margin-left: 2px;"><?= $active_meta['flag'] ?></span>
        <span class="hidden-phone lang-label" id="currentLangLabel" style="font-weight: 700; font-size: 13px; color: #1e293b; margin-left: 4px;"><?= $active_meta['native'] ?></span>
        <span class="caret" style="margin-left: 4px;"></span>
    </a>

    <ul class="dropdown-menu pull-right lang-dropdown-menu" style="min-width: 230px; padding: 6px 0; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); border: 1px solid #e2e8f0; margin-top: 8px;">
        <li style="padding: 8px 16px; border-bottom: 1px solid #f1f5f9; margin-bottom: 4px;">
            <div style="font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                Select Language / भाषा चुनें
            </div>
        </li>

        <!-- Option 1: English -->
        <li>
            <a href="javascript:void(0);" onclick="switchSystemLanguage('en', 'English', '🇬🇧')" class="lang-option-link <?= $current_lang == 'en' ? 'active-lang' : '' ?>" id="lang_opt_en" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 16px; text-decoration: none;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 20px; line-height: 1;">🇬🇧</span>
                    <div>
                        <div style="font-weight: 700; font-size: 13.5px; color: #0f172a;">English</div>
                        <div style="font-size: 11px; color: #64748b;">Default System Language</div>
                    </div>
                </div>
                <i class="fa fa-check lang-check-icon" style="color: #6366f1; font-size: 14px; <?= $current_lang == 'en' ? '' : 'display: none;' ?>"></i>
            </a>
        </li>

        <!-- Option 2: Hindi -->
        <li>
            <a href="javascript:void(0);" onclick="switchSystemLanguage('hi', 'हिन्दी', '🇮🇳')" class="lang-option-link <?= $current_lang == 'hi' ? 'active-lang' : '' ?>" id="lang_opt_hi" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 16px; text-decoration: none;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 20px; line-height: 1;">🇮🇳</span>
                    <div>
                        <div style="font-weight: 700; font-size: 14px; color: #0f172a;">हिन्दी (Hindi)</div>
                        <div style="font-size: 11px; color: #64748b;">भारतीय राजभाषा</div>
                    </div>
                </div>
                <i class="fa fa-check lang-check-icon" style="color: #6366f1; font-size: 14px; <?= $current_lang == 'hi' ? '' : 'display: none;' ?>"></i>
            </a>
        </li>

        <!-- Option 3: Bengali -->
        <li>
            <a href="javascript:void(0);" onclick="switchSystemLanguage('bn', 'বাংলা', '🇮🇳')" class="lang-option-link <?= $current_lang == 'bn' ? 'active-lang' : '' ?>" id="lang_opt_bn" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 16px; text-decoration: none;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 20px; line-height: 1;">🇮🇳</span>
                    <div>
                        <div style="font-weight: 700; font-size: 14px; color: #0f172a;">বাংলা (Bengali)</div>
                        <div style="font-size: 11px; color: #64748b;">পশ্চিমবঙ্গ ও আঞ্চলিক ভাষা</div>
                    </div>
                </div>
                <i class="fa fa-check lang-check-icon" style="color: #6366f1; font-size: 14px; <?= $current_lang == 'bn' ? '' : 'display: none;' ?>"></i>
            </a>
        </li>
    </ul>
</div>

<!-- Invisible Google Translate Element -->
<div id="google_translate_element" style="display: none !important; visibility: hidden !important; position: absolute; left: -9999px;"></div>

<style>
/* Language Switcher Styling */
.lang-switcher-btn {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    border-radius: 9999px !important;
    padding: 6px 14px !important;
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
    transition: all 0.2s ease !important;
    cursor: pointer !important;
}
.lang-switcher-btn:hover {
    background: #f8fafc !important;
    border-color: #cbd5e1 !important;
}
.lang-option-link {
    transition: background-color 0.15s ease !important;
}
.lang-option-link:hover,
.lang-option-link.active-lang {
    background-color: #f1f5f9 !important;
}
.lang-option-link.active-lang {
    background-color: #eef2ff !important;
}

/* Suppress Google Translate top banner & toolbar artifacts */
.goog-te-banner-frame.skiptranslate,
.goog-te-banner-frame,
iframe.goog-te-banner-frame {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
}
body {
    top: 0px !important;
    position: static !important;
}
#goog-gt-tt,
.goog-te-balloon-frame {
    display: none !important;
}
.goog-text-highlight {
    background: none !important;
    box-shadow: none !important;
}
</style>

<script type="text/javascript">
/**
 * Multi-Language Translation Engine (English, Hindi, Bengali)
 */
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,hi,bn',
        autoDisplay: false,
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');

    // Sync UI with active language after Google Translate loads
    setTimeout(syncActiveLanguageUI, 500);
}

function switchSystemLanguage(langCode, nativeName, flag) {
    // 1. Update UI display immediately
    $('#currentLangFlag').text(flag);
    $('#currentLangLabel').text(nativeName);
    $('.lang-option-link').removeClass('active-lang');
    $('.lang-check-icon').hide();
    $('#lang_opt_' + langCode).addClass('active-lang').find('.lang-check-icon').show();

    // 2. Persist in storage & cookies
    localStorage.setItem('medical_app_language', langCode);
    
    var cookieVal = '/en/' + langCode;
    var domain = window.location.hostname;
    var expires = new Date(Date.now() + 365 * 864e5).toUTCString();

    // Set custom app_language cookie
    document.cookie = 'app_language=' + langCode + '; path=/; expires=' + expires;

    if (langCode === 'en') {
        // Clear googtrans cookie for English
        document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + domain + ';';
        document.cookie = 'googtrans=/en/en; path=/; expires=' + expires;
        document.cookie = 'googtrans=/en/en; path=/; domain=' + domain + '; expires=' + expires;
        if (domain.indexOf('.') !== -1) {
            var rootDomain = domain.split('.').slice(-2).join('.');
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=.' + rootDomain + ';';
            document.cookie = 'googtrans=/en/en; path=/; domain=.' + rootDomain + '; expires=' + expires;
        }
    } else {
        // Set googtrans cookie for Hindi (hi) or Bengali (bn)
        document.cookie = 'googtrans=' + cookieVal + '; path=/; expires=' + expires;
        document.cookie = 'googtrans=' + cookieVal + '; path=/; domain=' + domain + '; expires=' + expires;
        if (domain.indexOf('.') !== -1) {
            var rootDomain = domain.split('.').slice(-2).join('.');
            document.cookie = 'googtrans=' + cookieVal + '; path=/; domain=.' + rootDomain + '; expires=' + expires;
        }
    }

    // 3. Trigger translation via Google Translate combo box if present
    var select = document.querySelector('.goog-te-combo');
    if (select) {
        select.value = langCode;
        if (typeof select.onchange === 'function') {
            select.onchange();
        } else {
            var evt = document.createEvent('HTMLEvents');
            evt.initEvent('change', true, true);
            select.dispatchEvent(evt);
        }
    } else {
        // Reload to apply cookie globally
        window.location.reload();
    }
}

function syncActiveLanguageUI() {
    var stored = localStorage.getItem('medical_app_language');
    if (!stored) {
        // Check cookie
        var match = document.cookie.match(/(^|;)\s*googtrans\s*=\s*([^;]+)/);
        if (match) {
            var parts = match[2].split('/');
            stored = parts[parts.length - 1];
        }
    }

    if (stored === 'hi') {
        $('#currentLangFlag').text('🇮🇳');
        $('#currentLangLabel').text('हिन्दी');
        $('.lang-option-link').removeClass('active-lang');
        $('.lang-check-icon').hide();
        $('#lang_opt_hi').addClass('active-lang').find('.lang-check-icon').show();
    } else if (stored === 'bn') {
        $('#currentLangFlag').text('🇮🇳');
        $('#currentLangLabel').text('বাংলা');
        $('.lang-option-link').removeClass('active-lang');
        $('.lang-check-icon').hide();
        $('#lang_opt_bn').addClass('active-lang').find('.lang-check-icon').show();
    } else {
        $('#currentLangFlag').text('🇬🇧');
        $('#currentLangLabel').text('English');
        $('.lang-option-link').removeClass('active-lang');
        $('.lang-check-icon').hide();
        $('#lang_opt_en').addClass('active-lang').find('.lang-check-icon').show();
    }
}

$(document).ready(function() {
    syncActiveLanguageUI();
});
</script>

<!-- Asynchronous Google Translate Core Script -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
