<?php
class Modules extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Admin/ServiceModule');
	}
	function index(){
		$data['body']="Admin/Add_Modules";
		$this->load->view("Admin_template",$data);	
	}
	
	function create_module(){
		$this->ServiceModule->setServiceName($this->input->post_get('name',TRUE));
		$this->ServiceModule->setServiceDescription($this->input->post_get('description',TRUE));
		echo $this->ServiceModule->create()==TRUE ? TRUE : FALSE;
	}
	
	function get_all_modules(){
		$result=$this->ServiceModule->load_all();
		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"", 'status'=>'FAIL');
		echo json_encode($arr);
	}
	function delete(){
		$this->ServiceModule->setModuleId($this->input->get_post('module_id',TRUE));
		echo $this->ServiceModule->delete();
	}
}?>