<?php
require_once APPPATH.'models/Interfaces.php';
class ServiceProviderModule extends CI_Model{	
	
	private $module_id;
	private $service_name;
	function create()
	{
		$insert = array(
		'module_id' => $this->getModuleId(),
		'name' => $this->getSericeCategoryName()		
		);
		$this->db->set('creation_date','NOW()',FALSE);
		$this->db->insert('va_categories', $insert);
		return $this->db->affected_rows()== 0 ?FALSE : TRUE;
		
	}
	function setModuleId($module_id){
		$this->id = $module_id;
	}
	
	function setSericeCategoryName($service_name){
		$this->name = $service_name;
	}
	function getModuleId(){
		return $this->id ;
	}
	
	function getSericeCategoryName(){
		return $this->name;
	}
	function fetch_service_providers(){
	   $this->db->select("category_id,name,updation_date,module_id");   
	   $this->db->from('va_categories');
	   $this->db->where('module_id',21);
	   $query = $this->db->get('');
	   return $query->result();	
	}
	
	
	
} 
?>