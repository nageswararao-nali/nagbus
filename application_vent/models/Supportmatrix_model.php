<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * categories model admin login validating in this model
 */
class supportmatrix_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function list_all_supportmatrix() {
        $this->db->from('support_matrix');
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_supportmatrix($id){
		
		$this->db->select('support_matrix.*');

		$this->db->from('support_matrix');

		$this->db->where('id', $id);

		$query = $this->db->get();

		return $query->result();
	}
	public function create_supportmatrix($data){	
	
		$this->db->insert('support_matrix', $data);

	}
    public function delete_supportmatrix() {
        $args = func_get_args();
        if (count($args) > 1 || is_array($args[0])) {
            $this->db->where($args[0]);
        } else {
            $this->db->where('id', $args[0]);
        }
        $return = $this->db->delete("support_matrix");
        return $return;
    }	
	public function update_supportmatrixtable($data,$id){

			$this->db->where('id',$id);
			$return = $this->db->update('support_matrix', $data); 
					// return true;
			
		}
	
	public function list_all_users($role_id=6){
		
		$this->db->select('users.*');

		$this->db->from('users');

		$this->db->where('role_id', $role_id);

		$query = $this->db->get();

		 return $query->result_array();
	}
	
	public function get_supportmatrix_by_role($role_id=6){
		
		$this->db->select('support_matrix.*');

		$this->db->from('support_matrix');

		$this->db->where('role_id', $role_id);

		$query = $this->db->get();

		 return $query->result_array();
	}

}
