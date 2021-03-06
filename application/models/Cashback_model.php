<?php
/**
* Users model here for getting roles and data
*/
class cashback_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function getCashBackCodeDetails( $cashBackCode ) {

		$this->db->select('*');
		$this->db->from('va_cashback_offers');


		$where = "cbk_promo_code ='".$cashBackCode."'";

		$this->db->where($where);


		$query = $this->db->get();
//		 echo "<pre>"; print_r($query->result()); exit;
		return $query->result();
	}

	public function getRoleNameByRoleId($roleId)
	{
		$this->db->select('*');
		$this->db->from('roles');


		$where = "role_id=".$roleId;

		$this->db->where($where);


		$query = $this->db->get();
//		 echo "<pre>"; print_r($query->result()); exit;
		$results = $query->result();
		return $results[0]->role_name;
	}
	public function getCashbackOffer($couponCode) {
        $query = $this->db->get_where('va_cashback_offers', array("cbk_promo_code" => $couponCode));
        return $query->result_array();
	}


}
