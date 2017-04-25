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

    public function get_wallet_request_details() {
        $this->db->select('a.*, b.name, b.email_id, c.role_name');
        $this->db->from('wallet_history as a');
        $this->db->join('users as b', 'a.user_id = b.user_id', 'LEFT');
        $this->db->join('roles as c', 'a.role_id = c.role_id', 'LEFT');
        $this->db->where('payment_mode', 1);
        $this->db->where_in('payment_status', array(0, 1));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_wallet_info($id) {
        $this->db->select('a.*, b.name, b.email_id');
        $this->db->join('users as b', 'a.user_id = b.user_id', 'LEFT');
        $query = $this->db->get_where('wallet_history a', array('a.wallet_history_id' => $id));
        return $query->row();
    }

    public function update_wallet_info() {
        $id = $this->input->post('wallet_history_id');
        $wallet_info = $this->get_wallet_info($id);
        $payment_status = $this->input->post('status');
        $_data = array(
            'payment_status' => $payment_status,
            'notes' => $this->input->post('notes')
        );
//        die('update users set wallet = wallet + ' . $wallet_info->amount . ' where user_id = ' . $wallet_info->user_id);
        $this->db->where('wallet_history_id', $id);
        $this->db->update('wallet_history', $_data);
        if ($payment_status == 2) {
            $this->db->query('update users set wallet = wallet + ' . $wallet_info->amount . ' where user_id = ' . $wallet_info->user_id);
        }
        return true;
    }
    
    public function get_wallet_withdraw_details() {
        $this->db->select('a.*, b.name, b.email_id');
        $this->db->from('wallet_withdraw as a');
        $this->db->join('users as b', 'a.user_id = b.user_id', 'LEFT');
        $query = $this->db->get();
        return $query->result_array();
    }

}
