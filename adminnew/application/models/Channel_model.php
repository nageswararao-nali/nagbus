<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Channel partners list model
/**
* 
*/
class Channel_Model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}

	public function get_channel_users($userrole) {
		$this->db->select('users.*,pincode.*');
		$this->db->from('users');
		$this->db->where('role_id', $userrole);
		$this->db->join('pincode','pincode.District_Name = users.pincode', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_agent_users($userrole) {
		$this->db->select('users.*,pincode.*');
		$this->db->from('users');
		$this->db->where('role_id', $userrole);
		$this->db->join('pincode','pincode.District_Name = users.pincode', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_channel_user_edit($userrole) {
		
		$this->db->select('users.*,pincode.*');
		$this->db->from('users');
		$this->db->where('user_id', $userrole);
		$this->db->join('pincode','pincode.District_Name = users.pincode', 'LEFT');
		$query = $this->db->get();
		return $query->result();

	}
	public function update_channel_user($update_channel_partner_data,$user_id){
		
		$this->db->where('user_id',$user_id);
		$return = $this->db->update('users',$update_channel_partner_data); 
		
	}
	public function list_service_provider(){
		
		
		$this->db->from('users');
		$this->db->where('role_id',3);
        $query = $this->db->get();
        return $query->result_array();
		
	}
	
}