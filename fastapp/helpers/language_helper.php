<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Multi-Language Translation Helpers
 */

if (!function_exists('__t')) {
    function __t($key, $default = '') {
        $CI = &get_instance();
        if (!isset($CI->translator)) {
            $CI->load->library('translator');
        }
        return $CI->translator->t($key, $default);
    }
}

if (!function_exists('current_language')) {
    function current_language() {
        $CI = &get_instance();
        if (!isset($CI->translator)) {
            $CI->load->library('translator');
        }
        return $CI->translator->get_language();
    }
}

if (!function_exists('get_supported_languages')) {
    function get_supported_languages() {
        $CI = &get_instance();
        if (!isset($CI->translator)) {
            $CI->load->library('translator');
        }
        return $CI->translator->get_languages();
    }
}
