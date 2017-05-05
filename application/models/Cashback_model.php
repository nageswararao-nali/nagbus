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

		$today = date('Y-m-d');
		$where = "cbk_status=1 and cbk_end_date >= '{$today}' and cbk_promo_code ='".$cashBackCode."'";

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
	public function getRechargeOffers() {
		$query = $this->db->get_where('va_cashback_offers', array("cbk_isRecharge" => 1, "cbk_status" => 1));
        return $query->result_array();
	}
	public function getBusCashbackOffers() {
		$query = $this->db->get_where('va_cashback_offers', array("cbk_isBus" => 1, "cbk_status" => 1));
        return $query->result_array();
	}
	public function get_cashback_history($user_id, $service) {
		$this->db->select('*');
		$this->db->from('va_cashback_offers_history ch');
		$this->db->join('va_sales_order', 'ch.cbk_his_txnid = va_sales_order.sales_id', 'left'); 
		$this->db->where('ch.cbk_his_user_id', $user_id);
		$this->db->where('ch.cbk_his_service', $service);
		$query = $this->db->get();
		return $query->result_array();
	}

}
