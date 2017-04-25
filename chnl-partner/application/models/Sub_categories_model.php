<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * categories model admin login validating in this model
 */
class Sub_categories_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
	public function get_subcategory($category_id){
		
		$this->db->select('sub_categories.*');

		$this->db->from('sub_categories');

		$this->db->where('cat_id', $category_id);

		$query = $this->db->get();

		return $query->result();
	}
}
