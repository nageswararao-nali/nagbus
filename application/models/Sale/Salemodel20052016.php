<?php 
require_once APPPATH.'models/global/Parent_model.php';
class Salemodel extends Parent_model{
	function __construct(){
		parent::__construct();
	}
	function create_order($a){
		//this function must be called to create order before to proceed payment gateway.
		/*var_dump($a);
		echo "+++++++++++++++++++";
		print_r("<pre>");
		print_r($this->session->userdata());
		
		echo "+++++++++++++++++++++++";*/
		$operator=$this->session->userdata('operator');
		$cnd_1 = array('sub_cat_code'=>$operator);
		$sub_cats =$this->get_result('sub_cat_id','sub_categories',$cnd_1);
		//var_dump($sub_cats);
		
		//get commision data
		//$cnd_2 = array('subcategory_id'=>$sub_cats[0]->sub_cat_id,'category_id'=>$q[0]->category_id);
		//$sub_cats =$this->get_result('sub_cat_id','sub_categories',$cnd_2);
		//var_dump($sub_cats);
		//end commision data
		
		
		
			$operator=$this->session->userdata('operator');
		$cnd = array_merge($this->whereCnd(),array('name'=>$a['recharge_type']));
		$q=$this->get_result('category_id','va_categories',$cnd);
		
		
		
		$res = $this->db->query("SELECT * FROM `va_commissions_all` WHERE `subcategory_id` = '".$sub_cats[0]->sub_cat_id."' AND category_id  = '".$q[0]->category_id."'");
		//print("<pre>");
		///print_r($res->result_array());
		$resultdata = $res->result_array();
		$TotAmount=$this->session->userdata('rcAmount');
		
		if($resultdata[0]["our_comm_type"] == "PEC")
		{
			$our_comm_value = ($resultdata[0]["our_comm_value"]*$TotAmount)/100;
		}
		else
		{
			$our_comm_value = $resultdata[0]["our_comm_value"];
		}
		
		if($resultdata[0]["agent_comm_type"] == "PEC")
		{
			$agent_comm_value = ($resultdata[0]["agent_comm_value"]*$TotAmount)/100;
		}
		else
		{
			$agent_comm_value = $resultdata[0]["agent_comm_value"];
		}
		
		$tot_comm_value = $agent_comm_value+$our_comm_value;
		
		
		//SMD COMMISION
		$res = $this->db->query("SELECT * FROM `va_commissions_channel_all` WHERE `type` = 0 ");
		//print("<pre>");
		//print_r($res->result_array());
		$resultdata = $res->result_array();		
		$smd_comm = $our_comm_value*$resultdata[0]["smd_percentage"]/100;
		$chnl_comm = ($our_comm_value-$smd_comm)*$resultdata[0]["term1_percentage"]/100;
		$labbus_percentage = 100-$resultdata[0]["term1_percentage"]; 
		$laabus_comm = ($our_comm_value-$smd_comm)*$labbus_percentage/100;
		//END SMD COMMISION
		
		
		$commisions_data = array("cat_id"=>$q[0]->category_id,
								"subcat_id"=>$sub_cats[0]->sub_cat_id,								
								"amount"=>$TotAmount,
								"order_date"=>date("Y-m-d H:i:s"),
								"total_commision"=>$tot_comm_value,
								"agent_comm"=>$agent_comm_value,
								"agent_ref_comm"=>"0",
								"agent_id"=>$this->session->userdata('user_id'),
								"channel_part_comm"=>$chnl_comm,
								"channel_part_id"=>56,
								"smd_comm"=>$smd_comm,
								"smd_user_id"=>66,
								"laabus_comm"=>$laabus_comm,
								"markup"=>0,
								"discount"=>0,
								);
		//exit;
		
		/*$this->db->insert('transaction',$commisions_data);
		exit("Success!");*/

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
			
			/// COMMISSION AMOUNT SETUP 13042016
			//exit("Order placed Testing...");
			//EDN COMMISSION AMOUNT SET UP 13042016
			$id_sales = $this->db->insert_id();
			$this->db->insert('transaction',$commisions_data);
			return $id_sales;
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