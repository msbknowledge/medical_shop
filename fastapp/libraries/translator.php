<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Multi-Language Translator Library
 * Supports English (en), Hindi (hi), Bengali (bn)
 *
 * @author Medical Shop Team
 */
class translator
{
    protected $CI;
    protected $current_lang = 'en';

    protected $languages = array(
        'en' => array(
            'code'      => 'en',
            'name'      => 'English',
            'native'    => 'English',
            'flag'      => '🇬🇧',
            'direction' => 'ltr'
        ),
        'hi' => array(
            'code'      => 'hi',
            'name'      => 'Hindi',
            'native'    => 'हिन्दी',
            'flag'      => '🇮🇳',
            'direction' => 'ltr'
        ),
        'bn' => array(
            'code'      => 'bn',
            'name'      => 'Bengali',
            'native'    => 'বাংলা',
            'flag'      => '🇮🇳',
            'direction' => 'ltr'
        )
    );

    protected $dictionary = array(
        // Core Navigation & Sections
        'dashboard' => array('en' => 'Dashboard', 'hi' => 'डैशबोर्ड', 'bn' => 'ড্যাশবোর্ড'),
        'billing'   => array('en' => 'Billing', 'hi' => 'बिलिंग', 'bn' => 'বিলিং'),
        'entry'     => array('en' => 'Entry', 'hi' => 'प्रविष्टि', 'bn' => 'এন্ট্রি'),
        'reports'   => array('en' => 'Reports', 'hi' => 'रिपोर्ट्स', 'bn' => 'রিপোর্ট'),
        'help'      => array('en' => 'Help', 'hi' => 'मदद', 'bn' => 'সাহায্য'),
        'management'=> array('en' => 'Management', 'hi' => 'प्रबंधन', 'bn' => 'ম্যানেজমেন্ট'),

        // Transactions & Operations
        'sale'      => array('en' => 'Sale', 'hi' => 'बिक्री', 'bn' => 'বিক্রয়'),
        'purchase'  => array('en' => 'Purchase', 'hi' => 'खरीद', 'bn' => 'ক্রয়'),
        'payment'   => array('en' => 'Payment', 'hi' => 'भुगतान', 'bn' => 'পেমেন্ট'),
        'customer'  => array('en' => 'Customer', 'hi' => 'ग्राहक', 'bn' => 'গ্রাহক'),
        'supplier'  => array('en' => 'Supplier', 'hi' => 'आपूर्तिकर्ता', 'bn' => 'সরবরাহকারী'),
        'doctor'    => array('en' => 'Doctor', 'hi' => 'चिकित्सक (डॉक्टर)', 'bn' => 'ডাক্তার'),
        'medicine'  => array('en' => 'Medicine', 'hi' => 'दवा', 'bn' => 'ওষুধ'),
        'stock'     => array('en' => 'Stock', 'hi' => 'स्टॉक', 'bn' => 'স্টক'),

        // Reminders & Alerts
        'reminders'       => array('en' => 'Reminders', 'hi' => 'रिमाइंडर', 'bn' => 'রিমাইন্ডার'),
        'expired'         => array('en' => 'Expired Medicines', 'hi' => 'समाप्त दवाएं', 'bn' => 'মেয়াদোত্তীর্ণ ওষুধ'),
        'near_expiry'     => array('en' => 'Near Expiry', 'hi' => 'निकट समाप्ति', 'bn' => 'নিকট মেয়াদোত্তীর্ণ'),
        'due_amount'      => array('en' => 'Due Amount', 'hi' => 'बकाया राशि', 'bn' => 'বকেয়া টাকা'),
        'days_overdue'    => array('en' => 'Days Overdue', 'hi' => 'विलंब के दिन', 'bn' => 'বকেয়ার দিন'),
        'send_reminder'   => array('en' => 'Send Reminder', 'hi' => 'रिमाइंडर भेजें', 'bn' => 'রিমাইন্ডার পাঠান'),
        'whatsapp_reminder'=> array('en' => 'WhatsApp Reminder', 'hi' => 'व्हाट्सएप रिमाइंडर', 'bn' => 'হোয়াটসঅ্যাপ রিমাইন্ডার'),

        // Common UI Elements
        'search'          => array('en' => 'Search', 'hi' => 'खोजें', 'bn' => 'অনুসন্ধান'),
        'save'            => array('en' => 'Save', 'hi' => 'सहेजें', 'bn' => 'সংরক্ষণ করুন'),
        'cancel'          => array('en' => 'Cancel', 'hi' => 'रद्द करें', 'bn' => 'বাতিল'),
        'edit'            => array('en' => 'Edit', 'hi' => 'संपादित करें', 'bn' => 'সম্পাদনা'),
        'delete'          => array('en' => 'Delete', 'hi' => 'हटाएं', 'bn' => 'মুছুন'),
        'view'            => array('en' => 'View', 'hi' => 'देखें', 'bn' => 'দেখুন'),
        'print'           => array('en' => 'Print', 'hi' => 'प्रिंट', 'bn' => 'প্রিন্ট'),
        'total'           => array('en' => 'Total', 'hi' => 'कुल', 'bn' => 'মোট'),
        'paid'            => array('en' => 'Paid', 'hi' => 'भुगतान किया', 'bn' => 'পরিশোধিত'),
        'balance'         => array('en' => 'Balance', 'hi' => 'शेष', 'bn' => 'অবশিষ্ট')
    );

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->detect_language();
    }

    /**
     * Detect active language from session or cookie
     */
    public function detect_language()
    {
        $lang = 'en';

        // 1. Session check
        if (isset($this->CI->session) && $this->CI->session->userdata('app_language')) {
            $lang = $this->CI->session->userdata('app_language');
        }
        // 2. Cookie check (app_language or googtrans)
        elseif (isset($_COOKIE['app_language'])) {
            $lang = $_COOKIE['app_language'];
        } elseif (isset($_COOKIE['googtrans'])) {
            $parts = explode('/', trim($_COOKIE['googtrans'], '/'));
            $c_lang = end($parts);
            if (in_array($c_lang, array('en', 'hi', 'bn'))) {
                $lang = $c_lang;
            }
        }

        if (array_key_exists($lang, $this->languages)) {
            $this->current_lang = $lang;
        } else {
            $this->current_lang = 'en';
        }

        return $this->current_lang;
    }

    /**
     * Set active language
     */
    public function set_language($lang_code)
    {
        if (array_key_exists($lang_code, $this->languages)) {
            $this->current_lang = $lang_code;
            if (isset($this->CI->session)) {
                $this->CI->session->set_userdata('app_language', $lang_code);
            }
            if (!headers_sent()) {
                setcookie('app_language', $lang_code, time() + (86400 * 365), '/');
            }
            return true;
        }
        return false;
    }

    /**
     * Get active language code
     */
    public function get_language()
    {
        return $this->current_lang;
    }

    /**
     * Get details for current active language
     */
    public function get_current_language_meta()
    {
        return $this->languages[$this->current_lang];
    }

    /**
     * Get all supported languages
     */
    public function get_languages()
    {
        return $this->languages;
    }

    /**
     * Translate key using dictionary
     */
    public function t($key, $default = '')
    {
        $k = strtolower(trim($key));
        if (isset($this->dictionary[$k][$this->current_lang])) {
            return $this->dictionary[$k][$this->current_lang];
        }
        if (isset($this->dictionary[$k]['en'])) {
            return $this->dictionary[$k]['en'];
        }
        return !empty($default) ? $default : $key;
    }
}
