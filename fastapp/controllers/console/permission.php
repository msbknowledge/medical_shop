<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Permission
 *
 * @author Kallol
 */
class Permission extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->targetModel = 'permissions_model';

        $this->page_config['tablePrimaryKey'] = $this->permissions_model->get_primary_key(); //pk
        /** page_config* */
        $this->page_config['title'] = 'Access Permissions'; //search title bar
        $this->page_config['searchFields'] = 'permission_controller,permission_type'; //search box,
        $this->page_config['use_dropdown_columns'] = 'permission_type,permission_controller,permission_user_type_id';
        $this->page_config['use_dropdown_columns_options']['permission_type'] = array(
            'default'     => 'default',
            'add_detail'  => 'add (create record)',
            'edit_detail' => 'edit (modify record)',
            'delete'      => 'delete (remove record)',
            'view_detail' => 'view (details modal)',
            'index'       => 'show list (table index)',
            'quick_edit'  => 'Quick Edit (inline edit)',
            'capability_list' => 'capability_list (matrix view)'
        );
        $this->page_config['use_dropdown_columns_options']['permission_user_type_id'] = $this->user_types_model->get_list_for_dropdown('user_type_name');

        $controllers = $this->get_controllers();
        $this->page_config['use_dropdown_columns_options']['permission_controller'] = $controllers;
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
