<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Channel partners list model
/**
 * 
 */
class Service_Provider extends CI_Model {

    var $_table = 'service_provider';

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
    
    public function all_service_providers() {
        $sql_query = "SELECT user_id, 
            (select tmpusers.`name` from users tmpusers where tmpusers.user_id = users.agent_id) as aname,
            (select tmpusers.`name` from users tmpusers where tmpusers.user_id = users.chp_id) as cname, 
            (select sc.`sub_cat_name` from service_provider as sp left join sub_categories as sc on sc.sub_cat_id = sp.sub_cat_id where sp.user_id = users.user_id) as sub_cat_name, 
            agent_id, name, mobile, email_id, pincode, status, wallet, country_name, state_name, district_name, city_name from users where role_id = 3 order by lupdate desc";
        $query = $this->db->query($sql_query);
        return $query->result_array();
    }
    
    public function get_service_provider_details($condition = NULL) {
        $sql_query = "SELECT a.user_id, b.sub_cat_id, name, mobile, email_id, pincode, status, a.wallet, country_name, state_name, district_name, city_name, role_id 
                from users as a
                left join service_provider as b on b.user_id = a.user_id  $condition ";
        $query = $this->db->query($sql_query);
        //echo $query;exit;
        return $query->result_array();
    }
    
    public function service_provider_update($_data, $user_id) {
        $this->db->where('user_id', $user_id);
        $return = $this->db->update($this->_table, $_data);
    }
}
