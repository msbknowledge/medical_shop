<?php

/**
 *
 * @author kallol
 */
class Activity_logs_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'activity_logs';
    }

    /**
     * get the list of all data in table 
     */
   
}

?>
