<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sayan
 * Date: 20/9/16
 * Time: 11:36 PM
 */
class ApiMobile extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }
    public function getRoles(){
        $this->db->select('role_id, role_name');
        $this->db->where('enable', 1);
	$this->db->where_in('role_id', array(4,6));
        $query = $this->db->get('roles');
        return $query->result();
    }
    public function agentEarnings($user_id = NULL, $datePicker = NULL){
        if($datePicker) {
            $result = $this->db->query("SELECT COALESCE(SUM(agent_comm+agent_ref_comm),0) as earnings FROM `transaction` WHERE   transaction_status = 1 AND (`end_user_id`= $user_id OR `agent_id` = $user_id) AND DATE(order_date) between date_sub(now(),INTERVAL 1 $datePicker) and now()")->result();
            return $result;
        }
    }
    public function profileKYC($user_id = NULL){
        if($user_id){
			$this->db->select([ 'a.*', 'b.organization_name', 'b.permanent_address', 'b.bussiness_type', 'b.pancard_number', 'b.resident_proof_number', 'b.pancard', 'b.resident_proof']);
			$this->db->from('users as a');
			$this->db->where('a.user_id', $user_id);
			$this->db->join('profile_kyc as b', 'b.user_id = a.user_id', 'left');
			$query = $this->db->get(); 
            return $query->row();
        }
    }
    public function userWalletDetails($user_id = NULL){
        if($user_id){
            $value = ['customer_id','name','mobile','email_id','pincode','country_name','state_name','district_name','city_name','wallet'];
            $this->db->select($value);
            $this->db->from('users');
            $this->db->where('user_id', $user_id);
            $this->db->where('(role_id = 6 OR role_id = 4)');
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function userProfile($user_id = NULL){
        if($user_id){
            $query = $this->db->get_where('profile', array('User_id' => $user_id), 1);
            return $query->result();
        }
    }
    public function usersAddedByAgents($agent_id = NULL){
        if($agent_id){
            $value = ['u.customer_id', 'u.name', 'u.mobile', 'u.email_id', 'u.pincode', 'u.created_at as join_date', 'pk.permanent_address', 'pk.communication_address'];
            $this->db->select($value);
            $this->db->from('users as u');
			$this->db->join('profile_kyc as pk', 'pk.user_id = u.user_id', 'left');
            //$this->db->join('va_agent_user', 'va_agent_user.user_user_id = u.user_id');
            //$this->db->where('va_agent_user.agent_user_id', $agent_id);
            //$this->db->where('va_agent_user.status_id', '1');
            $this->db->where('u.agent_id', $agent_id);
            $this->db->where('u.status', '1');
            //$this->db->group_by('va_agent_user.user_user_id');
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function offers($tableName = NULL){
        if($tableName) {
            $query = $this->db->get_where($tableName);
            return $query->result();
        }
    }
    public function getTxnDetails($txnId){
    	$query = $this->db->get_where('transaction', array('sales_id' => $txnId), 1);
    	return $query->row();
    }
}
