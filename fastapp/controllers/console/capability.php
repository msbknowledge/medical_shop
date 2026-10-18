<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Capability
 *
 * @author Kallol
 */
class Capability extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->targetModel = 'capabilities_model';

        $this->page_config['tablePrimaryKey'] = $this->capabilities_model->get_primary_key(); //pk
        /** page_config* */
        $this->page_config['title'] = 'Role Capabilities'; //search title bar
        $this->page_config['searchFields'] = 'capability_user_type,capability_controller'; //search box,
        $this->page_config['use_dropdown_columns'] = 'capability_controller,capability_user_type';

        $this->page_config['use_dropdown_columns_options']['capability_user_type'] = $this->user_types_model->get_list_for_dropdown('user_type_name');
        $this->page_config['use_dropdown_columns_options']['capability_controller'] = $this->get_controllers();
        $this->page_config['allowed_action'] = array('add_detail', 'edit_detail', 'delete', 'view_detail', 'index', 'quick_edit');
        /** end page_config* */
    }

    public function get_controllers()
    {
        $files = get_dir_file_info(APPPATH . 'controllers/console', FALSE) ?: array();
        $baseFiles = get_dir_file_info(APPPATH . 'controllers', FALSE) ?: array();
        $files = array_merge($files, $baseFiles);

        $modules = $this->get_modules();
        if (!empty($modules)) {
            foreach ($modules as $module) {
                if ($module != 'Default') {
                    $mConsole = get_dir_file_info(ROOTPATH . 'modules/' . $module . '/controllers/console', FALSE) ?: array();
                    $mRoot = get_dir_file_info(ROOTPATH . 'modules/' . $module . '/controllers', FALSE) ?: array();
                    $files = array_merge($files, $mConsole, $mRoot);
                }
            }
        }
        $controllers = array();
        if (!empty($files)) {
            foreach (array_keys($files) as $file) {
                if ($file != 'index.html' && strpos($file, '.php') !== false) {
                    $controller = str_replace('.php', '', $file);
                    $controllers[$controller] = ucwords(str_replace('_', ' ', $controller));
                }
            }
        }
        ksort($controllers);
        return $controllers;
    }

    public function get_modules()
    {
        $moduleMeta = $this->modules_model->get_list_for_dropdown('module_name', array('module_status' => 1));
        if (empty($moduleMeta) && defined('PLAN_PACKAGES')) {
            $planModules = json_decode(PLAN_PACKAGES, true);
            if (!is_array($planModules)) {
                $planModules = explode(',', PLAN_PACKAGES);
            }
            if (is_array($planModules)) {
                foreach ($planModules as $pm) {
                    $pm = trim($pm);
                    if (!empty($pm)) {
                        $moduleMeta[$pm] = $pm;
                    }
                }
            }
        }
        return $moduleMeta ?: [];
    }
}
