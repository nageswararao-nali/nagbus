
<?php
require_once APPPATH.'models/Interfaces.php';
class Categoriesmodule extends CI_Model implements ModuleCrud{
	
	private $id;
	private $name;
	private $description;
	function create(){
		$insert=array("name"=>$this->getCategoryName(),	"description" =>$this->getCategoryDescription(), "module_id"=>$this->getModuleid());
		$this->db->set('creation_date', 'NOW()', FALSE);
		$this->db->insert("va_categories",$insert);
		return $this->db->affected_rows()==0 ? FALSE : TRUE;
	}
	
	function load_all($limit=10){
		$this->db->select('c.category_id, c.name as categoryname, c.description as categorydescription, c.creation_date, c.updation_date, c.update_login, c.update_login, c.updation_date, c.module_id, c.approve_id, m.name as modulename, m.description as moduledescription');
		$this->db->from('va_categories c');
		$this->db->join('va_modules m','c.module_id = m.module_id');
		$this->db->where('c.status_id',AVAILABLE);
		$this->db->or_where('c.approve_id',ACTIVE);
		$this->db->or_where('c.approve_id',INACTIVE);
		$query = $this->db->get();
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}
	
	function load_selected_approved($moduleid){
		$this->db->select('c.category_id, c.name as categoryname');
		$this->db->from('va_categories c');
		$this->db->where('module_id',$moduleid);
		$this->db->where('c.status_id',AVAILABLE);
		$this->db->where('c.approve_id',ACTIVE);
		$query = $this->db->get();
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}
	
	function update(){
	
	}
	
	function delete(){
	
	}
	
	function activate($id){
		$data = array('approve_id'=>ACTIVE);		
		$this->db->where('category_id',$id);
		$this->db->where('approve_id',INACTIVE);
		if($this->db->update('va_categories',$data)){echo $this->db->last_query(); return TRUE;}
		else return FALSE;
	}

	function deactivate($id){
		$data = array('approve_id'=>INACTIVE);
		$this->db->where('category_id',$id);
		$this->db->where('approve_id',ACTIVE);
		if($this->db->update('va_categories',$data)){ echo $this->db->last_query();return TRUE;}
		else return FALSE;
	}
	

	function setModuleId($id){
		$this->id = $id;
	}
	
	function setCategoryName($name){
		$this->name=$name;
	}
	
	function setCategoryDescription($description){
		$this->description=$description;
	}
	
	function getModuleid(){
		return $this->id;
	}
	
	function getCategoryName(){
		return $this->name;
	}
	
	function getCategoryDescription(){
		return $this->description;
	}
	
	function load($limit=10){
		$this->db->select('c.category_id, c.name as categoryname, c.description as categorydescription, c.creation_date, c.updation_date, c.update_login, c.update_login, c.updation_date, c.module_id, c.flag, m.name as modulename, m.description as moduledescription');
		$this->db->from('va_categories c');
		$this->db->join('va_modules m','c.module_id = m.module_id');
		$query = $this->db->get();
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}
}
