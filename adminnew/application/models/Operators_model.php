<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * operators model admin login validating in this model
 */
class operators_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function list_all_operators() {
        $this->db->select('sub_categories.*,categories.cat_name');
        $this->db->from('sub_categories');
        $this->db->join('categories', 'sub_categories.cat_id = categories.cat_id', 'INNER');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }	

    function list_category_operators($cat_id) {
        $this->db->select('sub_categories.sub_cat_id,sub_categories.sub_cat_name');
        $this->db->from('sub_categories');
        $this->db->join('categories', 'sub_categories.cat_id = categories.cat_id', 'INNER');
        $this->db->where('sub_categories.cat_id', $cat_id);
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $val) {
            $countries [$val['sub_cat_id']] = $val['sub_cat_name'];
        }
        return array("" => "Select Home Repair") + $countries;
    }

    public function delete_sub_category() {
		
        $args = func_get_args();
        if (count($args) > 1 || is_array($args[0])) {
            $this->db->where($args[0]);
        } else {
            $this->db->where('sub_cat_id', $args[0]);
        }
        $return = $this->db->delete("sub_categories");
        return $return;
		
    }
	function  insert_operators($operator_data){		
	
	$this->db->insert('sub_categories', $operator_data);	
	}	
	public function get_operator_data($edit_operator_id){
		
		$this->db->select('sub_categories.*');
		$this->db->from("sub_categories");
		$this->db->where('sub_cat_id',$edit_operator_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function update_operator_model($update_operator_data,$sub_cat_id){
		
		
		// print_r($update_operator_data);
		// print_r($sub_cat_id);
		$this->db->where('sub_cat_id',$sub_cat_id);
			$return = $this->db->update('sub_categories', $update_operator_data); 
		
	}

}
