<?php

/**
 *
 * @author kallol
 */
class Activity_logs_model extends MY_Model
{

    //put your code here

    public $table_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'activity_logs';
    }

    public function install()
    {
        $table = $this->table_name;
        $this->db->query("
            CREATE TABLE `activity_logs` (
            `activity_ID` int(11) NOT NULL,
            `activity_user` int(11) DEFAULT NULL,
            `activity_data` longtext DEFAULT NULL,
            `activity` varchar(255) DEFAULT NULL,
            `activity_url` text DEFAULT NULL,
            `activity_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            ;");
    }

    /**
     * get the list of all data in table 
     */
}
