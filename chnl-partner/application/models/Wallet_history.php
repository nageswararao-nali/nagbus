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
			//check whether Agent has Subscribed or Not.
			 $result = $this->db->query("SELECT  `subscription_status` FROM `users` WHERE `user_id`=$wallet_info->user_id and `role_id`=6")->row_array();
            //echo $this->db->last_query();			
			//print_r($result);
			if(!empty($result) && $result["subscription_status"] == 0 )
			{
				//check total Wallet amount reached to subscription amount or not for Agent.
				$result2 = $this->db->query("SELECT  SUM(`original_amount`) as original_amount  FROM `wallet_history` WHERE `payment_status` = 2 and `user_id`=$wallet_info->user_id and `role_id`=6 group by user_id ")->row_array();
				//echo $this->db->last_query();exit;
				$total_wallet_amount = $result2['original_amount'];
				
				//check Standard/master Subscription Amount for Agent
				 $result3 = $this->db->query("SELECT  * FROM `users` WHERE `user_id`=$wallet_info->user_id and `role_id`=6")->row_array();
				//echo $this->db->last_query();exit;
				// print("<pre>");
				// print_r($result3);
				 $agent_subscription_amount = $result3["agent_subscription_amt"];
				 
				 if( $total_wallet_amount >= $agent_subscription_amount )
				 {
					 //now agent paid subscription amount. so refilled wallet if any only One time/First time.
					 $agent_subscription_wallet = $result3["subscription_wallet_amt"];					 
					 $this->db->query('update users set subscription_status =1 ,wallet = wallet + ' .  $agent_subscription_wallet . ' where user_id = ' . $wallet_info->user_id);				 
					 
				 }
			}
				//exit;
            //$result['subscription_status'];
			//end check whether Agent has Subscribed or Not. 
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
