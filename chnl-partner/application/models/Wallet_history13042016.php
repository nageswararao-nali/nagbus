<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Channel partners list model
class Wallet_history extends CI_Model {

    var $_table = 'wallet_history';

    public function __construct() {
        parent::__construct();
    }

    
    public function insert($walletData) {
        $this->db->insert($this->_table, $walletData);
        return $this->db->insert_id();
    }
	
	public function get_wallet_details() {
        $this->db->select('a.*, b.name, b.email_id, c.role_name');
        $this->db->from('wallet_history as a');
        $this->db->join('users as b', 'a.user_id = b.user_id', 'LEFT');
        $this->db->join('roles as c', 'a.role_id = c.role_id', 'LEFT');
        $this->db->where(array('operator_id' => 0, 'operator_type' => '1'));
        $query = $this->db->get();
        return $query->result_array();
    }
}
