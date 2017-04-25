<?php
require_once APPPATH.'models/Interfaces.php';
require_once APPPATH.'models/global/Parent_model.php';
class OperatorsModule extends Parent_model implements ModuleCrud,OperatorsInterface, FetchNetwork{
	
	public $moduleid;
	public $categoryid;
	private $operatorName;
	private $operatorCode;
	private $operatorDescription;
	private $mobileno;
	private $operatorBaseTbl = 'va_operator_base_url';
	private $operator_base_url_id;
	public function __construct(){
		parent::__construct();
		
	}
	function create(){
		$insert=array("operator_name"=>$this->getOperatorName(),
					  "description" =>$this->getOperatorDescription(),
					  "operator_code"=>$this->getOperatorCode(),
					  "category_id"=>$this->getCategoryId(),
					  "module_id"=>$this->getModuleId(),
						);
		$this->db->set('creation_date', 'NOW()', FALSE);
		$this->db->insert("va_operators",$insert);
		return $this->db->affected_rows()==0 ? FALSE : TRUE;
	}	
	
	function load_approved($limit=10){
		$this->db->select('m.module_id, m.name, m.description, m.update_login, m.updation_date, m.creation_date, m.flag, count(c.module_id) as categories_count');
		//$this->db->where('flag',0);
		$this->db->join('va_categories c','m.module_id=c.module_id','left');
		$this->db->group_by('c.module_id');
		$query = $this->db->get('va_modules m');
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}
	
	function setModuleId($val){
		$this->moduleid=$val;
	}
	public function setCategoryId($val){
		$this->categoryid=$val;
	}
	public function setOperatorName($val){
		$this->operatorName=$val;
	}
	public function setOperatorCode($val){
		$this->operatorCode=$val;
	}
	public function setOperatorDescription($val){
		$this->operatorDescription=$val;
	}
		
	function setMobileNo($val){
		$this->mobileno=$val;
	}
        
	function setBillType($val){
		$this->billtype=$val;
	}
	
	public function getModuleId(){
		return $this->moduleid;
	}
	public function getCategoryId(){
		return $this->categoryid;
	}
	public function getOperatorName(){
		return $this->operatorName;
	}
	public function getOperatorCode(){
		return $this->operatorCode;
	}
	public function getOperatorDescription(){
		return $this->operatorDescription;
	}
	public function getBillType(){
		return $this->billtype;
	}
	
	
	function getMobileNo(){
		return $this->mobileno;
	}
	function getAPIUid(){
		$res = $this->get_result('api_uid','va_api_credentials',$this->whereCnd());
		return $res[0]->api_uid;
	}
	function getAPIPwd(){
		$res = $this->get_result('api_pwd','va_api_credentials',$this->whereCnd());
		//return $res[0]->api_pwd;
		return "2239aef41613bac36954531fb6153d5a";
	}
	function getAPIPin(){
		$res = $this->get_result('api_security_pin','va_api_credentials',$this->whereCnd());
		$res = $q->result();
		return $q->num_rows()>0 ? $res[0]->api_security_pin : FALSE;
	}
	
	function getAPIResponseFormat(){
		return 'JSON';
	}
	function getAPIVersion(){
		return 4;
	}
	
	
	function update(){
	
	}
	
	function delete(){
	
	}
	
	function activate($id){
		$data = array('flag'=>0);		
		$this->db->where('module_id',$id);
		$this->db->where('flag',1);
		if($this->db->update('va_modules',$data)) return TRUE;
		else return FALSE;
	}

	function deactivate($id){
		$data = array('flag'=>1);
		$this->db->where('module_id',$id);
		$this->db->where('flag',0);
		if($this->db->update('va_modules',$data)) return TRUE;
		else return FALSE;
	}
	
	
	function get_operators(){//default - prepaid
		$this->db->select('o.operator_id, o.operator_name, o.operator_code, o.category_id, o.module_id');
		//$this->db->where('o.flag',0);
		$this->db->where('o.category_id',$this->getCategoryId());
		$this->db->where('o.module_id',$this->getModuleId());
                
                if($this->getBillType() !== 'all')//1-prepaid, 2 - postpaid
                $this->db->where('o.bill_type', $this->getBillType());
                
		$query = $this->db->get('va_operators o');
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}
	
	function load($limit=10){
		$this->db->select('o.operator_id, o.operator_name, o.operator_code, o.category_id, o.module_id');
		$this->db->where('o.flag',0);
		$this->db->where('o.category_id',$this->getCategoryId());
		$this->db->where('o.module_id',$this->getModuleId());
		$query = $this->db->get('va_operators o');
		return $query->num_rows()>0 ? $query->result() : FALSE;
	}


	function fetch_mobile_network(){
		$a = array('title'=>'Finding Mobile Operator & Circle Code');
		$base = $this->get_result('base_url,operator_base_url_id','va_operator_base_url',
										array_merge($this->whereCnd(),$a));
		$url = $base[0]->base_url.'?';
		$this->operator_base_url_id =  $base[0]->operator_base_url_id;
		$a = array('operator_base_url_id'=> $base[0]->operator_base_url_id);
		$cnd = array_merge($this->whereCnd(),$a);
		unset($cnd['category_id']); // category id not required so i unset this
		$params = $this->get_result('param_name, param_desc, param_value','va_operator_base_url_params',
										array_merge($cnd));
		for($i=0; $i<count($params); $i++){
			if($params[$i]->param_name == "uid") $params[$i]->param_value = $this->getAPIUid();
			if($params[$i]->param_name == "pin") $params[$i]->param_value = $this->getAPIPwd();
			if($params[$i]->param_name == "mobile") $params[$i]->param_value = $this->getMobileNo();
			if($params[$i]->param_name == "version") $params[$i]->param_value = 4;
		}
		$parameters = "";
		for($i=0; $i<count($params); $i++){
			$parameters .= $params[$i]->param_name."=".$params[$i]->param_value.'&';
		}
		return $url.$parameters;
	
	}
	
	function get_circles(){
		$cnd = $this->whereCnd();
		unset($cnd['category_id']);
		return $this->get_result('circle_id, circle_name','va_operator_circles',$cnd);
	}
	
	
	function get_mobile_operators(){
		$this->setCategoryId(3);
		$cnd = $this->whereCnd();
		return $this->get_result('operator_code, operator_name, icon','va_operators',$cnd);
	}
	private $circleId;
	private $operatorId;
	private $planid;
	
	function setCircleId($val){
		$this->circleId=$val;
	}
	function setOperatorId($val){
		$this->operatorId=$val;
	}
	function getCircleId(){
		return $this->circleId;
	}
	function getOperatorId(){
		return $this->operatorId;
	}

	function setPlanId($va){
		$this->planid=$va;
	}
	
	function getPlanId(){
		return $this->planid;
	}
	public function get_offers(){
		$cnd = array('r.recharge_offer_circle_id'=>$this->getCircleId(), 'r.recharge_offer_operators_id'=>$this->getOperatorId(),
					't.recharge_category_id'=>$this->getPlanId());
		$this->db->select('r.recharge_offer_id, r.creation_date, r.recharge_offer_circle_id, r.recharge_offer_operators_id, r.price, r.validity, r.talktime, r.benifits, c.category_name');
		$this->db->from('va_recharge_offers_test r');
		$this->db->join('va_recharge_offer_tags_test t','r.id = t.recharge_offer_id');
		
		$this->db->join('va_recharge_categories c','t.recharge_category_id = c.recharge_category_id');
		
		$this->db->where($cnd);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->num_rows()>0 ? $query->result() : FALSE;
		
		
	}
	
	private function _get_tags($offers_result){
		for($i=0; $i<count($offers_result); $i++){
			$this->db->select('c.category_name');
			$this->db->from('va_recharge_offer_tags a');
			$this->db->join('va_recharge_categories c','a.recharge_category_id = c.recharge_category_id');
			$this->db->where('a.recharge_category_id',$this->getPlanId());
			$this->db->where('a.recharge_offer_id', $offers_result[$i]->recharge_offer_id);
			$res = $this->db->get();
			$offers_result[$i]->tags = $res->num_rows()>0 ? $res->result() : '';
		}
		return $offers_result;
	}
	
	function get_mobile_offer_operators(){
		return $this->get_result('recharge_offer_operators_id, operator_name','va_recharge_offer_operators');
	}
	
	function get_mobile_offer_circles(){
		return $this->get_result('recharge_offer_circle_id, circle_name','va_recharge_offer_circles');
	}
	
	function get_mobile_offer_categories(){
		return $this->get_result('category_name, recharge_category_id','va_recharge_categories');
	}
}