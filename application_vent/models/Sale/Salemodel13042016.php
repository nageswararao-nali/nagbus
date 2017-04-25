<?php 
require_once APPPATH.'models/global/Parent_model.php';
class Salemodel extends Parent_model{
	function __construct(){
		parent::__construct();
	}
	function create_order($a){
		//this function must be called to create order before to proceed payment gateway.
		$cnd = array_merge($this->whereCnd(),array('name'=>$a['recharge_type']));
		$q=$this->get_result('category_id','va_categories',$cnd);

		$insert_to_sale_order = array('sub_total'=> $a['purchase_value'],
                                            'rebate_amount' => $a['coupon_amount']!='' ? $a['coupon_amount'] : 0,
                                            'total_amount' => $a['payable_amount'],
                                            'information' => json_encode($a),
                                            'coupon_amount' => $a['coupon_amount'],
                                            'promotion_code_id' => $a['couponCode'],
                                            'category_id'=>$q[0]->category_id,
                                            'transaction_status_id'=>1,
                                            'user_id'=>$this->session->userdata('user_id'),
                                            'shipping_method_id'=>1);
		$this->db->set('creation_date','now()',false);
		if($this->db->insert('va_sales_order',$insert_to_sale_order)){
			//$res = $this->db->query("SELECT * FROM `va_sales_order` WHERE `sales_id` = '".$this->db->insert_id()."'");
			//return $res->result_array();
			return $this->db->insert_id();
		}else return false;
	}
        
         function get_recharge_order($sales_id){
		$this->db->select('*');
		$this->db->from('va_sales_order');
                $this->db->where('sales_id', $sales_id);
		$query = $this->db->get();
                #echo $this->db->last_query();exit;
  		return $query->row();
	}
}
?>