<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * operators model admin login validating in this model
 */
class agent_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function list_all_operators() {
        $this->db->select('sub_categories.*,categories.cat_name');        $this->db->from('sub_categories');        $this->db->join('categories', 'sub_categories.cat_id = categories.cat_id', 'INNER');        $query = $this->db->get();        return $query->result_array();
    }
    public function delete_sub_category() {
        $args = func_get_args();        if (count($args) > 1 || is_array($args[0])) {            $this->db->where($args[0]);        } else {            $this->db->where('sub_cat_id', $args[0]);        }        $return = $this->db->delete("sub_categories");        return $return;
    }		public function insert_agent($agent_data) {				$this->db->insert('users',$agent_data);			}
	public function get_agent_data($agent_user_id){				$this->db->select('users.*');		$this->db->from('users');		$this->db->where('user_id',$agent_user_id);		$query = $this->db->get();		return $query->result();	}	public function update_agent_user($update_agent_data,$user_id){				$this->db->where('user_id',$user_id);		$return = $this->db->update('users',$update_agent_data); 			}	
}
