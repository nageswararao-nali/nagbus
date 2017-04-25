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
	
	
	public function get_comm_categorywise_details($condition = NULL) {
		 
		 $query = $this->db->query("SELECT * from categories a INNER JOIN va_commissions_all b on a.cat_id = b.category_id  ");
		 $data  = array();
        if(!empty($query->result_array()))
		{
			$data = $query->result_array();
			
		}		
		return $data;
	 }
	
	 public function get_comm_details($condition = NULL) {
		 
		 $query = $this->db->query("SELECT * from va_commissions_all limit 1 ");
		 $data  = array();
        if(!empty($query->result_array()))
		{
			$data = $query->result_array();
			
		}		
		return $data;
	 }
	
	 public function get_commissions_id($condition = NULL) {
		 
		 $query = $this->db->query("SELECT id from va_commissions_all limit 1 ");
        if(!empty($query->result_array()))
		{
			$data = $query->result_array();
			$id = $data["0"]["id"];
		}
		else
		{
			$id = 0;
		}
		return $id;
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
        if(!empty($query->result_array()))
		{
			$data = $query->result_array();
			$id = $data["0"]["id"];
		}
		else
		{
			$id = 0;
		}
		return $id;
	 }
	 
	 public function delete_comm_cat_subcat() {
		$id = $this->input->get('id');
		$this->db->where('id', $id);
        $return = $this->db->delete("va_commissions_all");
        return $return;
    }	


    

}