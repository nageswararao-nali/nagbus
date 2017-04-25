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
	
	
	public function getbrowseplan(){
		//$cnd = array('r.recharge_offer_circle_id'=>$this->getCircleId(), 'r.recharge_offer_operators_id'=>$this->getOperatorId(),
					//'t.recharge_category_id'=>$this->getPlanId());
		$cnd = array("1=1");
		$this->db->select('r.recharge_offer_id, r.creation_date, r.recharge_offer_circle_id, r.recharge_offer_operators_id, r.price, r.validity, r.talktime, r.benifits, c.category_name,d.circle_name,e.operator_name');
		$this->db->from('va_recharge_offers_test r');
		$this->db->join('va_recharge_offer_tags_test t','r.id = t.recharge_offer_id');
		
		$this->db->join('va_recharge_categories c','t.recharge_category_id = c.recharge_category_id');
		$this->db->join('va_recharge_offer_circles d','r.recharge_offer_circle_id = d.recharge_offer_circle_id');
		$this->db->join('va_recharge_offer_operators e','r.recharge_offer_operators_id = e.recharge_offer_operators_id');
		
		//$this->db->where($cnd);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->num_rows()>0 ? $query->result() : FALSE;
		
		
	}
	
	
	public function deletebrowseplan_previous_record($circle_id='',$operator_id='') 
	{
    //$sql = "delete from va_recharge_offer_tags_test where circle_id='".$circle_id."' AND operator_id = '".$operator_id."'";
	$sql = "delete from va_recharge_offer_tags_test where circle_id='".$circle_id."' ";
    $this->db->query($sql);
	$sql = "delete from va_recharge_offers_test where recharge_offer_circle_id='".$circle_id."'";
    $this->db->query($sql);
	}
	public function insertbrowseplan($walletData,$cat_id='') {
		
		
		
		$this->db->insert('va_recharge_offers_test', $walletData);
        $id =  $this->db->insert_id();
		$tag["recharge_offer_id"] = $id;
		$tag["creation_date"] = date("Y-m-d H:i:s");
		$tag["recharge_category_id"] = $cat_id;
		$tag["status_id"] = 1;
		$tag["approve_id"] = 2;
		$tag["circle_id"] = $walletData["recharge_offer_circle_id"];
		$tag["operator_id"] = $walletData["recharge_offer_operators_id"];
		$tag["recharge_category_id"] = $cat_id;
		
		$this->db->insert('va_recharge_offer_tags_test', $tag);
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
		
        //$this->db->where_in('payment_status', array(0, 1));
        $query = $this->db->get();
        return $query->result_array();
    }
	 public function get_wallet_receive_details($user_id=0) {
        $this->db->select('a.*, b.name, b.email_id, c.role_name');
        $this->db->from('wallet_history as a');
        $this->db->join('users as b', 'a.user_id = b.user_id', 'LEFT');
        $this->db->join('roles as c', 'a.role_id = c.role_id', 'LEFT');
        $this->db->where('payment_mode', 1);
		$this->db->where('b.user_id', $user_id);
        //$this->db->where_in('payment_status', array(0, 1));
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
            'credit_debit' => 1,
            'notes' => $this->input->post('notes')
        );
//        die('update users set wallet = wallet + ' . $wallet_info->amount . ' where user_id = ' . $wallet_info->user_id);
        $this->db->where('wallet_history_id', $id);
        $this->db->update('wallet_history', $_data);
		
		
		if ($payment_status != 2) {
			//SEND MAIL TO END USER SAYS THAT WALLET UPDATED.
			//---------------------------------
			$uid = "766172696e69696e666f"; //your uid
			$pin = "ccdb37d4de7737d75924ab4507e03303"; //your api pin
			$sender = "LAABUS"; // approved sender id
			$domain = "smsalertbox.com"; // connecting url 
			$route = "5"; // 0-Normal,1-Priority
			$method = "POST";
			//---------------------------------
			$res = $this->db->query('select * from users where user_id = ' . $wallet_info->user_id)->row_array();	
			$wallet = $res['wallet'];
			$mobile = $res['mobile'];
			$name = $res['name'];
			//$message = 'Dear '.$name.', Your deposit of INR '.$_POST['amount'].' is sent to Admin successfully,Waiting for Admin Approval.';
			$message ='Dear '.$name.',Your deposit of INR '.$wallet_info->amount.' is rejected by Admin. Your New Wallet Amount is INR. '.$wallet.'.thanks for using LAABUS.';
                    $message = urlencode($message);
                    //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

                    $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

                    $url = "http://$domain/api/sms.php";

                    $ch = curl_init($url);

                    if ($method == "POST") {
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                    } else {
                        $get_url = $url . "?" . $parameters;

                        curl_setopt($ch, CURLOPT_POST, 0);
                        curl_setopt($ch, CURLOPT_URL, $get_url);
                    }

                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS 
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
                    $return_val = curl_exec($ch);
			//END MAIL
		}
        if ($payment_status == 2) {
            $this->db->query('update users set wallet = wallet + ' . $wallet_info->amount . ' where user_id = ' . $wallet_info->user_id);			
			//check whether Agent has Subscribed or Not.
			 $result = $this->db->query("SELECT  `subscription_status` FROM `users` WHERE `user_id`=$wallet_info->user_id and `role_id`=6")->row_array();
            //echo $this->db->last_query();			
			//print_r($result);
			//SEND MAIL TO END USER SAYS THAT WALLET UPDATED.
			//---------------------------------
			$uid = "766172696e69696e666f"; //your uid
			$pin = "ccdb37d4de7737d75924ab4507e03303"; //your api pin
			$sender = "LAABUS"; // approved sender id
			$domain = "smsalertbox.com"; // connecting url 
			$route = "5"; // 0-Normal,1-Priority
			$method = "POST";
			//---------------------------------
			$res = $this->db->query('select * from users where user_id = ' . $wallet_info->user_id)->row_array();	
			$wallet = $res['wallet'];
			$mobile = $res['mobile'];
			$name = $res['name'];
			//$message = 'Dear '.$name.', Your deposit of INR '.$_POST['amount'].' is sent to Admin successfully,Waiting for Admin Approval.';
			$message ='Dear '.$name.',Your deposit of INR '.$wallet_info->amount.' is approved by Admin. Your New Wallet Amount is INR. '.$wallet.'.thanks for using LAABUS.';
                    $message = urlencode($message);
                    //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

                    $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

                    $url = "http://$domain/api/sms.php";

                    $ch = curl_init($url);

                    if ($method == "POST") {
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                    } else {
                        $get_url = $url . "?" . $parameters;

                        curl_setopt($ch, CURLOPT_POST, 0);
                        curl_setopt($ch, CURLOPT_URL, $get_url);
                    }

                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS 
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
                    $return_val = curl_exec($ch);
			//END MAIL
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
    
    public function  changewithdrawnstatus($id,$status)
    {
    	$sql = "update wallet_withdraw set paidstatus ='". $status."' where wallet_withdraw_id='".$id."'";
    	$this->db->query($sql);
    		
    }
    public function  deletewalletwithdrawnrecord($id)
    {
    	$sql = "delete from wallet_withdraw where wallet_withdraw_id='".$id."'";
    	$this->db->query($sql);
    		
    }
	public function  deletewallethistoryrecord($id)
    {
    	$sql = "delete from wallet_history where wallet_history_id='".$id."'";
    	$this->db->query($sql);
    		
    }

}
