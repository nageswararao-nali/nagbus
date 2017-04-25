<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * categories model admin login validating in this model
 */
class offer_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function list_all_supportmatrix() {
        $this->db->from('support_matrix');
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_offer($id){
		
		$this->db->select('joining_offers.*');

		$this->db->from('joining_offers');

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
	public function update_offertable($data,$id){

			
			//print_r($data);
			//echo "XXX".$id."ZZZ";exit;
			$this->db->where('id',$id);
			$return = $this->db->update('joining_offers', $data); 
					// return true;
			
		}
		
		public function update_offertablenew($data,$id){

			
			//print_r($data);
			//echo "XXX".$id."ZZZ";exit;
			$this->db->where('id',$id);
			$return = $this->db->update('joining_offers', $data); 
					// return true;
			
		}
		
		
		public function update_offertableprodnew($userData) {				
		if ($this->db->insert("user_joining_product_offers", $userData)) {
				return $this->db->insert_id();
			} else {
				return FALSE;
			}		
		}
		
		public function get_offers_all()
		{
			$query = $this->db->query("SELECT b.* from categories a INNER JOIN user_joining_product_offers b on a.cat_id = b.category_id order by b.id desc  ");				
			return $query->result_array();
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
