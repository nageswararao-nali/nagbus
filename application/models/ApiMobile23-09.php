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
            $query = $this->db->get_where('profile_kyc', array('User_id' => $user_id), 1);
            return $query->result();
        }
    }
}