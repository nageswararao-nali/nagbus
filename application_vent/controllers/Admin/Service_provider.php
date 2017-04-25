<?php 
class Service_provider extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Admin/ServiceProviderModule');
	}
	function index(){
		$data['body']="Admin/Service_Provider/Add_services";
		$this->load->view("Admin_template",$data);	
	}
	
	function approve_service_providers(){
		$data['body']="Admin/Service_Provider/Approve_Service_Providers";
		$this->load->view("Admin_template",$data);
	}
	function create_service(){
		
		$ci = $this->ServiceProviderModule;
		$ci->setModuleId($this->input->post_get('module_id',TRUE));
		$ci->setSericeCategoryName($this->input->post_get('Service_Category_Name',TRUE));
		echo $ci->create()==TRUE ? TRUE : FALSE;		
	}
	
	function fetch_service_providers(){
		$data = array();
		$result = $this->ServiceProviderModule->fetch_service_providers();
		
		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"No Categories", 'status'=>'FAIL');
		echo json_encode($arr);
	}
}
