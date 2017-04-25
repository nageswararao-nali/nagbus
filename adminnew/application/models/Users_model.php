<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Channel partners list model
class Users_model extends CI_Model {

    var $_table = 'users';

    public function __construct() {
        parent::__construct();
    }
	
	
	
	public function get_comm_by_id($id = NULL) {
        $query = $this->db->query("select * from va_commissions_all where id = $id");
        //echo $query;exit;
        return $query->result_array();
    }
	
	public function get_offer_comm_by_id($id = NULL) {
        $query = $this->db->query("SELECT * from limited_offers a LEFT JOIN va_commissions_all b on b.subcategory_id = a.id and b.category_id =9999 where is_active=1 and category_id =9999 and subcategory_id=$id");
        //echo $query;exit;
		if($query->result_array() )
		{
			return $query->result_array();
		}
		else
		{
			$array[0] = array("our_comm_type"=>"","our_comm_value"=>"");
			
			return $array;
		}
        
    }

    public function all_users($role) {
        $query = $this->db->query("SELECT user_id, (select tmpusers.`name` from users tmpusers where tmpusers.user_id = users.agent_id) as aname,(select tmpusers.`name` from users tmpusers where tmpusers.user_id = users.chp_id) as cname, agent_id, name,customer_id, mobile, email_id, pincode, status, wallet, country_name, state_name, district_name, city_name from users where role_id = '$role' order by lupdate desc");
        return $query->result_array();
    }
	
	public function all_users_wallet($role='') {
        $query = $this->db->query("SELECT user_id, (select tmpusers.`name` from users tmpusers where tmpusers.user_id = users.agent_id) as aname,(select tmpusers.`name` from users tmpusers where tmpusers.user_id = users.chp_id) as cname, agent_id, name,customer_id, mobile, email_id, pincode, status, wallet, country_name, state_name, district_name, city_name from users where 1 order by lupdate desc");
        return $query->result_array();
    }

    public function get_user_details($condition = NULL) {
        $query = $this->db->query("SELECT user_id, name, mobile, email_id, pincode, status, wallet, country_name, state_name, district_name, city_name, role_id  from users $condition ");
        //echo $query;exit;
        return $query->result_array();
    }
	
	public function get_user_kyc_details($condition = NULL) {
        $query = $this->db->query("SELECT * from profile_kyc $condition ");
        //echo $query;exit;
        return $query->result_array();
    }
	
	public function get_tot_dash_wallet($condition = NULL) {
        //$query = $this->db->query("select sum(wallet) as totwallet from users  ");
        //echo $query;exit;
		$query = $this->db->query("select sum(laabus_comm) as totwallet from transaction  where `transaction_status` = '1'  ");
        return $query->result_array();
    }
	public function get_today_dash_wallet($condition = NULL) {
		$today  = date("Y-m-d");
        //$query = $this->db->query("select sum(amount) as totwallet from wallet_history  where credit_debit = 2 and  payment_status =2 and  date(create_dt) = $today ");
		$query = $this->db->query("select sum(laabus_comm) as totwallet from transaction  where `transaction_status` = '1' and  date(order_date) = '$today' ");
		
       /* echo "select sum(laabus_comm) as totwallet from transaction  where `transaction_status` = '1' and  date(order_date) = '$today' ";exit;*/
	  // print_r($query->result_array());die;
        return $query->result_array();
    }
	
	public function get_today_dash_wallet_users($condition = NULL) {
		$today  = date("Y-m-d");
        $query = $this->db->query("select sum(amount) as totwallet from wallet_history  where role_id=4 and (credit_debit = 1 or payment_mode =2 ) and  payment_status =2 and  date(create_dt) = '$today' ");
		//$query = $this->db->query("select sum(laabus_comm) as totwallet from transaction  where `transaction_status` = '1' and  date(order_date) = '$today' ");
		
       /* echo "select sum(laabus_comm) as totwallet from transaction  where `transaction_status` = '1' and  date(order_date) = '$today' ";exit;*/
	  // print_r($query->result_array());die;
        return $query->result_array();
    }
	public function get_today_dash_wallet_agents($condition = NULL) {
		$today  = date("Y-m-d");
        $query = $this->db->query("select sum(amount) as totwallet from wallet_history  where role_id=6 and (credit_debit = 1 or payment_mode =2 ) and  payment_status =2 and  date(create_dt) = '$today' ");
		/*$query = $this->db->query("select sum(amount) as totwallet from wallet_history  where role_id=6 and (credit_debit = 2 or payment_mode =2 ) and  payment_status =2 and  date(create_dt) = '$today' ");*/
		//$query = $this->db->query("select sum(laabus_comm) as totwallet from transaction  where `transaction_status` = '1' and  date(order_date) = '$today' ");
		
       /* echo "select sum(laabus_comm) as totwallet from transaction  where `transaction_status` = '1' and  date(order_date) = '$today' ";exit;*/
	  // print_r($query->result_array());die;
        return $query->result_array();
    }
	
	
	public function get_month_dash_wallet($condition = NULL) {
		
        //$query = $this->db->query("select sum(amount) as totwallet from wallet_history  where credit_debit = 2 and  payment_status =2 and  MONTH(CURDATE()) = MONTH(create_dt) AND YEAR(CURDATE()) = YEAR(create_dt) ");
        //echo $query;exit;
		$query = $this->db->query("select sum(laabus_comm) as totwallet from transaction  where `transaction_status` = '1' and  MONTH(CURDATE()) = MONTH(order_date) AND YEAR(CURDATE()) = YEAR(order_date) ");
        return $query->result_array();
    }
	
	public function get_agent_dash_wallet($condition = NULL) {
		
        $query = $this->db->query("select sum(amount) as totwallet from wallet_history  where credit_debit = 2 and  payment_status =2 and  role_id=6 ");
        //echo $query;exit;
        return $query->result_array();
    }
	public function get_users_lists_cnt($condition = NULL) {
        $query = $this->db->query("select count(*) as cnt, role_id from users where role_id in(2,4,6) group by role_id ");
        //echo $query;exit;
        return $query->result_array();
    }
	
	public function get_users_lists_cnt_today($condition = NULL) {
		$date = date("Y-m-d");
        $query = $this->db->query("select count(*) as cnt, role_id from users where date(created_at)='".$date."' and	 role_id in(2,4,6) group by role_id ");
        //echo $query;exit;
        return $query->result_array();
    }

    public function insert($userData) {
        if ($this->db->insert($this->_table, $userData)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
	
	

    public function user_update($user_data, $user_id) {
        $this->db->where('user_id', $user_id);
        $return = $this->db->update('users', $user_data);
    }

    public function get_admin_user($condition = NULL) {
        //where role_id='1'
        $query = $this->db->query("SELECT a_id, admin_name, lupdate, login_status, role_id FROM admin $condition");
        echo "SELECT a_id, admin_name, lupdate, login_status, role_id FROM admin $condition";
        return $query->result_array();
    }

    public function admin_update($user_data, $user_id) {
        $this->db->where('a_id', $user_id);
        $return = $this->db->update('admin', $user_data);
    }

}
