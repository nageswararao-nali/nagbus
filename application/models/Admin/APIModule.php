<?php
require_once APPPATH.'models/Interfaces.php';
require_once APPPATH.'models/Admin/OperatorsModule.php';
class APIModule extends OperatorsModule implements Operators_API{
	public function __construct(){
		parent::__construct();
	}
	private $operatorBaseTbl = "va_operator_base_url";
	private $operatorUrlParamsTbl = "va_operator_base_url_params";
	private $category_id;
	private $base_url;
	private $baseurlTitle;
	private $param_name=array();
	private $param_desc;
	private $opBaseId;
	private $api_title;
	
	public function setCategoryId($a){
		$this->category_id=$a;
	}
	public function setBaseUrl($a){
		$this->base_url=$a;
	}
	public function setAPITitle($a){
		$this->api_title=$a;
	}
	public function setParamNames($a){
		$this->param_name=$a;
	}
	public function setParamDesc($a){
		$this->param_desc=$a;
	}
	public function setBaseUrlId($a){
		$this->opBaseId=$a;
	}
	
	public function getCategoryId(){
		return $this->category_id; 
	}
	
	public function getAPITitle(){
		return $this->api_title;
	}
	
	function getBaseUrl(){
		return $this->base_url;
	}
	public function getBaseUrlId(){
		return $this->opBaseId;
	}

	function getParamNames(){
		return $this->param_name;
	}
	function getParamDesc(){
		return $this->param_desc;
	}
	
	public function save(){
		$this->db->select('category_id, base_url');
		$this->db->where('category_id',$this->getCategoryId());
		$this->db->where('base_url', $this->getBaseUrl());
		$q=$this->db->get($this->operatorBaseTbl);
		if($q->num_rows()==0){
			$to_base_url=array('category_id' => $this->getCategoryId(),
							   'title' =>$this->getAPITitle(),
							   'base_url'=>$this->getBaseUrl());
			$this->db->set('creation_date','NOW()',FALSE);
			if($this->db->insert($this->operatorBaseTbl,$to_base_url)){
				$this->setBaseUrlId($this->db->insert_id());
				
			}
			
			for($i=0; $i<count($this->getParamNames());$i++){
				$to_base_url_params=array(	'operator_base_url_id'=>$this->getBaseUrlId(),
											'param_name'=>$this->param_name[$i],
											'param_desc'=>$this->param_desc[$i]);
				$this->db->set('creation_date','NOW()',FALSE);
				$this->db->insert($this->operatorUrlParamsTbl,$to_base_url_params);
			}
		}
			
	}
	
	public function get_apis(){
		$this->db->select('operator_base_url_id, updation_date, base_url, title, status_id, approve_id, title as params');
		$this->db->where('category_id',$this->getCategoryId());
		$q=$this->db->get($this->operatorBaseTbl);
		if($q->num_rows()==0) return false;
		else return $this->getParameters($q->result_array());
		
	}
	
	private function getParameters($apiObj){
		$param = array();
		for($i=0; $i<count($apiObj); $i++){
			$this->db->select('param_name, param_desc, arrange, operator_base_url_id, operator_base_url_params_id');
			$this->db->where('operator_base_url_id',$apiObj[$i]['operator_base_url_id']);
			$q=$this->db->get($this->operatorUrlParamsTbl);
			if($q->num_rows()>0){
				$apiObj[$i]['params'] = $q->result_array();
			}else return false;
		}
		return $apiObj;
	}
	
	function save_credentials(){
		
	}
}
