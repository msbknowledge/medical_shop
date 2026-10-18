<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activity_log extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->targetModel = 'activity_logs_model';
        $this->page_config['title'] = 'Activity & Audit Logs';
        $this->page_config['tablePrimaryKey'] = 'activity_ID';

        // Map user IDs to usernames in table & detail view
        $userList = [0 => 'System / Guest'];
        if (isset($this->users_model)) {
            $dbUsers = $this->users_model->get_list_for_dropdown('user_firstname');
            if (!empty($dbUsers)) {
                foreach ($dbUsers as $uid => $uname) {
                    $userList[$uid] = !empty($uname) ? $uname : 'User #' . $uid;
                }
            }
        }
        $this->page_config['use_dropdown_columns'] = 'activity_user';
        $this->page_config['use_dropdown_columns_options']['activity_user'] = $userList;

        $this->page_config['list_columns'] = 'activity_ID,activity_user,activity,activity_url,activity_timestamp';
        $this->page_config['searchFields'] = 'activity,activity_url,activity_user';
        $this->page_config['allowed_action'] = array('view_detail', 'index', 'delete');
    }

    protected function orderby_input_process()
    {
        $order = parent::orderby_input_process();
        if (empty($order)) {
            return 'activity_ID DESC';
        }
        return $order;
    }

    public function view_detail()
    {
        $entryID = trim($this->input->post('entry'));
        if (!empty($entryID)) {
            $pk = $this->activity_logs_model->get_primary_key();
            $entryData = $this->activity_logs_model->get_list(array($pk => $entryID));
            if (!empty($entryData[0])) {
                $row = $entryData[0];
                if (!empty($row['activity_data'])) {
                    $decoded = json_decode($row['activity_data'], true);
                    if ($decoded !== null) {
                        $row['activity_data'] = '<pre style="max-height: 250px; overflow-y: auto; font-size: 11.5px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px; color: #0f172a; margin: 0;">' . htmlspecialchars(json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) . '</pre>';
                    }
                }
                echo $this->generate_detail_view($row, $this->page_config);
                return;
            }
        }
        parent::view_detail();
    }
}
