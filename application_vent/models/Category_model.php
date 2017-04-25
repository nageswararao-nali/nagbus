<?php 
/**
* Laabus menus table
*/

class Category_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	public function get_category() {
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('enable','1');
		$query = $this->db->get();
		return $query->result();
	}

}