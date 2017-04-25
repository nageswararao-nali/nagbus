<?php
class Common_model extends CI_Model {
        #--------------------------------------------------------------------
	# Common Insert Function
	#---------------------------------------------------------------------
	public function commonInsert($tableName,$arrayData){
		$this->db->insert($tableName,$arrayData);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}	
        #--------------------------------------------------------------------
	# Common Update Function
	#---------------------------------------------------------------------
	public function commonUpdate($tableName,$updateArray,$whereCondition){
		$this->db->where($whereCondition);
		return $this->db->update($tableName,$updateArray);
	}
        #--------------------------------------------------------------------
	# Common Order Details For Agent And User Function
	#---------------------------------------------------------------------
	public function commonOrders($userid){
                $this->db->select('`order_id`, `user_id`, `sub_cat_id`, `transaction_id`, `amount`, `service_type`, `pay_mode`, `lupdate`, `created_date`, `mark_credit`, `mark_credit_text`, IF(`status`=1,"Completed","Incompleted") as status');
		$array = array('user_id' => $userid);
		$this->db->where($array);	
		$result = $this->db->get('orders')->result_array();
		return $result;
	}
}
?>