<?php
require_once APPPATH.'models/Interfaces.php';
class ServiceModule extends CI_Model implements ModuleCrud{
	
	private $serviceName;
	private $serviceDescription;
	private $moduleid;
	function create(){
		$insert_to_module=array("name"=>$this->getServiceName(),	"description" =>$this->getServiceDescription());
		$this->db->set('creation_date', 'NOW()', FALSE);
		$this->db->insert("va_modules",$insert_to_module);
		return $this->db->affected_rows()==0 ? FALSE : TRUE;
	}
	
	public function setModuleId($mid){
		$this->moduleid = $mid;
	}
	
	private function getModuleId(){
		return $this->moduleid;
	}
	function load_all($limit=10){
		$this->db->select('module_id, name, description, update_login, updation_date, creation_date, approve_id');
		$this->db->where('status_id',AVAILABLE);
		$this->db->or_where('approve_id',ACTIVE);
		$this->db->or_where('approve_id',INACTIVE);
		$query=$this->db->get('va_modules');
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}
	
	function update(){
		
	}
	
	function delete(){
		$this->db->where('module_id', $this->getModuleId());
		return $this->db->update('va_modules', array('flag' => 2)) == TRUE ? TRUE : FALSE;
	}
	
	function activate($id){
		$data = array('flag'=>0);		
		$this->db->where('module_id',$id);
		$this->db->where('status_id',AVAILABLE);
		$this->db->where('approve_id',ACTIVE);
		if($this->db->update('va_modules',$data)) return TRUE;
		else return FALSE;
	}

	function deactivate($id){
		$data = array('flag'=>1);
		$this->db->where('module_id',$id);
		$this->db->or_where('approve_id',INACTIVE);
		if($this->db->update('va_modules',$data)) return TRUE;
		else return FALSE;
	}
	
	function setServiceName($serviceName){
		$this->serviceName=$serviceName;
	}
	
	function getServiceName(){
		return $this->serviceName;
	}
	
	function setServiceDescription($serviceDescription){
		$this->serviceDescription=$serviceDescription;
	}
	
	function getServiceDescription(){
		return $this->serviceDescription;
	}
	
	function load($limit=10){
		//$this->db->select('module_id, name, description, update_login, updation_date, creation_date, flag');
		//$query = $this->db->get('va_modules');
		//return $query->num_rows()>0 ? $query->result() : FALSE;
		$this->db->select('m.module_id, m.name, m.description, m.update_login, m.updation_date, m.creation_date, m.flag, count(c.module_id) as categories_count');
		$this->db->join('va_categories c','m.module_id=c.module_id','left');
		$this->db->group_by('c.module_id');
		$query = $this->db->get('va_modules m');
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}
}
