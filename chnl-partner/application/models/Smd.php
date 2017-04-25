<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Channel partners list model
/**
 * 
 */
class smd extends CI_Model {

    var $_table = 'smd';

    public function __construct() {
        parent::__construct();
    }

    public function insert($_data) {
        if ($this->db->insert($this->_table, $_data)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function get_smds_select_box() {
        $query = $this->db->query("select a.name, a.email_id, a.smd_id from users as a where a.role_id = '5'");
        $result = $query->result_array();
        $smds = array();
        foreach ($result as $key => $val) {
            $smds [$val['smd_id']] = $val['name'].' ('.$val['email_id'].')';
        }
        return array("" => "Select SMDs") + $smds;
    }
    
    public function smd_chp_insert($_data) {
        if ($this->db->insert('smd_channel_partner', $_data)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    

}
