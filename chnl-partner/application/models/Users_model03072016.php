<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Channel partners list model
class Users_model extends CI_Model {

    var $_table = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function all_users($role) {
        $query = $this->db->query("SELECT user_id, (select tmpusers.`name` from users tmpusers where tmpusers.user_id = users.agent_id) as aname,(select tmpusers.`name` from users tmpusers where tmpusers.user_id = users.chp_id) as cname, agent_id, name,customer_id, mobile, email_id, pincode, status, wallet, country_name, state_name, district_name, city_name from users where role_id = '$role' order by lupdate desc");
        return $query->result_array();
    }

    public function get_user_details($condition = NULL) {
        $query = $this->db->query("SELECT user_id, name, mobile, email_id, pincode, status, wallet, country_name, state_name, district_name, city_name, role_id  from users $condition ");
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
        return $query->result_array();
    }

    public function admin_update($user_data, $user_id) {
        $this->db->where('a_id', $user_id);
        $return = $this->db->update('admin', $user_data);
    }

}
