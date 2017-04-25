<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sayan
 * Date: 20/9/16
 * Time: 11:36 PM
 */
class WalletTransferModel extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }
    public function getUserDetailsByMobile($mobile){
		$this->db->select('*');
		$this->db->from("users");
		$this->db->where('mobile', $mobile);
		$query = $this->db->get()->row();
		return $query;
    }

	public function getWalletTransferDetails($wallet_transfer_id){
		$this->db->select('*');
		$this->db->from("wallet_transfer");
		$this->db->where('wallet_transfer_id', $wallet_transfer_id);
		$query = $this->db->get()->row();
		return $query;
    }    
	
	public function insertWalletTransfer($data){
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->insert('wallet_transfer', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
    }
	
	public function getInboxMessages($user_id){
		$this->db->select(['a.wallet_transfer_id', 'a.type', 'a.amount', 'a.comments', 'a.created_at', 'b.name as sender_name', 'b.mobile as sender_mobile']);
		$this->db->from("wallet_transfer as a");
		$this->db->join('users as b', 'a.user_id = b.user_id', 'left');
		$this->db->where("(a.type='send' OR a.type='request')", NULL, FALSE);
		$this->db->where('a.mobile_user_id', $user_id);
		$this->db->where('a.action', 0);
		$this->db->order_by('wallet_transfer_id', 'DESC');
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function getRequestedAmounts($user_id){
		$this->db->select(['a.amount', 'a.comments', 'a.created_at', 'b.name as request_name', 'b.mobile as request_mobile']);
		$this->db->from("wallet_transfer as a");
		$this->db->join('users as b', 'a.mobile_user_id = b.user_id', 'left');
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.type', 'request');
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function getApprovedAmounts($user_id){
		$rawQuery = "select * from (SELECT a.amount, a.comments,  a.action, a.created_at, b.name as reciver_name, b.mobile as reciver_mobile, a.updated_at FROM `wallet_transfer` as a
			left join users as b on b.user_id  = a.mobile_user_id
			where a.type='send' and a.user_id=".$user_id."
			union 
			SELECT a.amount, a.comments,  a.action, a.created_at, b.name as reciver_name, b.mobile as reciver_mobile, a.updated_at FROM `wallet_transfer` as a
			left join users as b on b.user_id  = a.user_id
			where a.action=2 and a.mobile_user_id=".$user_id.") as c
			order by c.updated_at desc";
		$query = $this->db->query($rawQuery);
		$result = $query->result_array($query);
		return $result;
	}
	
	public function update_wallet_bus($amount,$user_id)
	{
		$lastUpdate = date('Y-m-d H:i:s');
		$result = $this->db->query("update `users` SET wallet = wallet+$amount, lupdate = '$lastUpdate'  WHERE `user_id`= $user_id");
	}
	
	public function updateWalletAction($wallet_transfer_id,$action)
	{
		$lastUpdate = date('Y-m-d H:i:s');
		$result = $this->db->query("update `wallet_transfer` SET action = $action, updated_at = '$lastUpdate'  WHERE `wallet_transfer_id`= $wallet_transfer_id");
	}
}
