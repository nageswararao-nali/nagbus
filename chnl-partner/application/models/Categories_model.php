<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * categories model admin login validating in this model
 */
class categories_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function list_all_categories() {
        $this->db->from('categories');
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_category($category_id){
		
		$this->db->select('categories.*');

		$this->db->from('categories');

		$this->db->where('cat_id', $category_id);

		$query = $this->db->get();

		return $query->result();
	}
	public function create_category($category_data){	
	
		$this->db->insert('categories', $category_data);

	}
    public function delete_category() {
        $args = func_get_args();
        if (count($args) > 1 || is_array($args[0])) {
            $this->db->where($args[0]);
        } else {
            $this->db->where('cat_id', $args[0]);
        }
        $return = $this->db->delete("categories");
        return $return;
    }	
	public function update_category_table($update_category_data,$category_id){

			$this->db->where('cat_id',$category_id);
			$return = $this->db->update('categories', $update_category_data); 
					// return true;
			
		}
	
	public function list_all_users($role_id=6){
		
		$this->db->select('users.*');

		$this->db->from('users');

		$this->db->where('role_id', $role_id);

		$query = $this->db->get();

		 return $query->result_array();
	}

}
