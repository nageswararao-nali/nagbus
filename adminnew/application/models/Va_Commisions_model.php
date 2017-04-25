<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Channel partners list model
/**
 * 
 */
class Va_Commisions_model extends CI_Model {

    var $_table = 'va_commissions_all';
	 var $_table_channel = 'va_commissions_channel_all';

    public function __construct() {
        parent::__construct();
    }
	
	public function update_comm_by_id($data)
	{
		$this->db->set($data);
		$this->db->where('id', $data['id']);
        $return = $this->db->update('va_commissions_all', $user_data);
	}
	
	public function update_offer_comm_by_id($data)
	{
		$subcategory_id = $data["id"];
		 $query = $this->db->query("SELECT count(*) as cnt from limited_offers a LEFT JOIN va_commissions_all b on b.subcategory_id = a.id and b.category_id =9999 where is_active=1 and category_id =9999 and subcategory_id=$subcategory_id");
        //print_r();exit;
		$arr = $query->result_array();
		$cnt = $arr[0]['cnt'];
		if($cnt)
		{
			$data["subcategory_id"] = $data["id"];
			unset($data["id"]);
			$data["category_id"] = 9999;	
			$this->db->set($data);
			$this->db->where('subcategory_id', $data['subcategory_id']);
			$this->db->where('category_id', "9999");
			$return = $this->db->update('va_commissions_all', $user_data);
			//return $query->result_array();
			
		}
		else
		{
			$data["subcategory_id"] = $data["id"];
			unset($data["id"]);
			$data["category_id"] = 9999;			
			if ($this->db->insert("va_commissions_all", $data)) {
				//return $this->db->insert_id();
			} else {
				//return FALSE;
			}
		}
		
		
		
	}
	
	
	public function get_comm_categorywise_details($condition = NULL) {
		 
		 $query = $this->db->query("SELECT * from categories a INNER JOIN va_commissions_all b on a.cat_id = b.category_id  ");				
		return $query->result_array();
	 }
	
	public function get_comm_limited_offer_details($condition = NULL) {		 
		 $query = $this->db->query("SELECT a.id as idsubcat,a.offer_title as offer_title  ,b.* from limited_offers a LEFT JOIN va_commissions_all b on b.subcategory_id = a.id and b.category_id =9999 where is_active=1");				
		return $query->result_array();
	 }
	 
	 public function order_details($condition='')
	 {
		$qry = "SELECT a.*,b.*,c.*,d.name as agentname,e.name as chnlname,f.name as smdname FROM `transaction` a
		  LEFT JOIN  categories b ON a.cat_id = b.cat_id ";
		
		$qry  .= "  LEFT JOIN  sub_categories c ON a.subcat_id = c.sub_cat_id  
		  LEFT JOIN users d  ON a.agent_id=d.user_id ";	
		  
		 $qry  .= " LEFT JOIN users e  ON a.channel_part_id = e.user_id ";	
		 
		 $qry  .= "  LEFT JOIN users f  ON a.smd_user_id = f.user_id ";		 

		$qry  .= " where 1  ";
		 
		 if(!empty($condition["st_date"]))
		 {
			$qry .= " AND date(a.order_date) >= '".$condition["st_date"]."' "; 
		 }
		  if(!empty($condition["end_date"]))
		 {
			$qry .= " AND date(a.order_date) <= '".$condition["end_date"]."' "; 
		 }
		 if(!empty($condition["cat_id"]))
		 {
			$qry  .=  " AND b.cat_id =  '".$condition["cat_id"]."' ";
		 }
		 if(!empty($condition["sub_cat"]))
		 {
			$qry  .=  " AND c.sub_cat_id IN (".$condition["sub_cat"].") ";
		 }
		 
		   if(!empty($condition["agent_id"]))
		 {
			$qry  .=  " AND d.user_id = '".$condition["agent_id"]."' ";
		 }
		  if(!empty($condition["cnl_part"]))
		 {
			$qry  .=  " AND e.user_id = '".$condition["cnl_part"]."'";
		 }
		 $qry  .=  " order by a.id desc ";
		
		 $query = $this->db->query($qry);
		
		return $query->result_array();
	 }
	 public function order_details_fail($condition='')
	 {
		$qry = "SELECT a.*,b.*,c.*,d.name as agentname,e.name as chnlname,f.name as smdname FROM `transaction` a
		  LEFT JOIN  categories b ON a.cat_id = b.cat_id ";
		
		$qry  .= "  LEFT JOIN  sub_categories c ON a.subcat_id = c.sub_cat_id  
		  LEFT JOIN users d  ON a.agent_id=d.user_id ";	
		  
		 $qry  .= " LEFT JOIN users e  ON a.channel_part_id = e.user_id ";	
		 
		 $qry  .= "  LEFT JOIN users f  ON a.smd_user_id = f.user_id ";		 

		$qry  .= " where 1  ";
		 
		 if(!empty($condition["st_date"]))
		 {
			$qry .= " AND date(a.order_date) >= '".$condition["st_date"]."' "; 
		 }
		  if(!empty($condition["end_date"]))
		 {
			$qry .= " AND date(a.order_date) <= '".$condition["end_date"]."' "; 
		 }
		 if(!empty($condition["cat_id"]))
		 {
			$qry  .=  " AND b.cat_id =  '".$condition["cat_id"]."' ";
		 }
		 if(!empty($condition["sub_cat"]))
		 {
			$qry  .=  " AND c.sub_cat_id IN (".$condition["sub_cat"].") ";
		 }
		 
		   if(!empty($condition["agent_id"]))
		 {
			$qry  .=  " AND d.user_id = '".$condition["agent_id"]."' ";
		 }
		  if(!empty($condition["cnl_part"]))
		 {
			$qry  .=  " AND e.user_id = '".$condition["cnl_part"]."'";
		 }
		 $qry  .=  " AND a.transaction_status = 2";
		 
		  $qry  .=  " order by a.id desc ";
		
		 $query = $this->db->query($qry);
		
		return $query->result_array();
	 }
	 
	 public function get_cnl_part_comm_details($condition = NULL) {
		 
		 $query = $this->db->query("SELECT * from va_commissions_channel_all order by id desc ");		
		return $query->result_array();
	 }
	
	 public function get_comm_details($condition = NULL) {
		 
		$query = $this->db->query("SELECT * from va_commissions_all limit 1 ");		
		return $query->result_array();
	 }
	
	 public function get_commissions_id($condition = NULL) {
		 
		$query = $this->db->query("SELECT id from va_commissions_all limit 1 ");       
		return $query->result_array();
	 }
	public function insert($userData) {
		
				
		$id = $this->get_commissions_id();		
		
        if($id == 0 )
		{
			if ($this->db->insert($this->_table, $userData)) {
				return $this->db->insert_id();
			} else {
				return FALSE;
			}
		}
		else
		{
			$this->db->where('id', $id);
			$return = $this->db->update($this->_table, $userData);
			return $id;
		}
		
    }
	
	public function savechanneldata($userData) {  //25032016
		
		if ($this->db->insert($this->_table_channel, $userData)) {
				return $this->db->insert_id();
			} else {
				return FALSE;
			}
	}	
	
	public function savecommdata($userData) {
		
				
		$id = $this->get_commissions_catid($userData['category_id']);		
		
        if($id == 0 )
		{
			if ($this->db->insert($this->_table, $userData)) {
				return $this->db->insert_id();
			} else {
				return FALSE;
			}
		}
		else
		{
			$this->db->where('id', $id);
			$return = $this->db->update($this->_table, $userData);
			return $id;
		}
		
    }
	public function savecommdatacatsubcat($userData) {				
		if ($this->db->insert($this->_table, $userData)) {
				return $this->db->insert_id();
			} else {
				return FALSE;
			}		
    }
	
	public function get_commissions_catid($cat_id = NULL) {
		 
		$query = $this->db->query("SELECT id from va_commissions_all where category_id = $cat_id limit 1 ");       
		return $query->result_array();
	 }
	 
	 public function delete_comm_cat_subcat() {
		$id = $this->input->get('id');
		$this->db->where('id', $id);
        $return = $this->db->delete("va_commissions_all");
        return $return;
    }	
	public function deletechannelcomm() {
		$id = $this->input->get('id');
		$this->db->where('id', $id);
        $return = $this->db->delete("va_commissions_channel_all");
        return $return;
    }	


    

}