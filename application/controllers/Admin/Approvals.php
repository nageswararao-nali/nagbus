<?php

abstract class Approve extends CI_Controller{
	abstract protected function Channel_Partners();
	abstract protected function Agents();
	abstract protected function Service_Provider_Services();
	abstract protected function Sales_Marketing_Department();
	abstract protected function Food_Courts();
	abstract protected function Modules();
	abstract protected function Categories();
	abstract protected function E_com_Sellers();
	abstract protected function Cabs();
	abstract protected function Delivary_Agencies();
}

class Approvals extends Approve{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$data['body']="Admin/Approvals_view";
		$this->load->view("Admin_template",$data);	
	}
	function Channel_Partners(){
		$data['body']="Admin/Approvals_view";
		$this->load->view("Admin_template",$data);	
	}
	function Agents(){
		$data['body']="Admin/Approvals_view";
		$this->load->view("Admin_template",$data);
	}
	function Service_Provider_Services(){
		$data['body']="Admin/Approvals_view";
		$data['block']="Service_Provider";
		$this->load->view("Admin_template",$data);	
	}
	function Sales_Marketing_Department(){
		$data['body']="Admin/Approvals_view";
		$this->load->view("Admin_template",$data);
	}
	function Food_Courts(){
		$data['body']="Admin/Approvals_view";
		$this->load->view("Admin_template",$data);
	}
	function Modules(){
		$data['body']="Admin/Approvals_view";
		$data['block']="Modules";
		$this->load->view("Admin_template",$data);
	}
	function Categories(){
		$data['body']="Admin/Approvals_view";
		$data['block']="Categories";
		$this->load->view("Admin_template",$data);		
	}
	function E_com_Sellers(){
		$data['body']="Admin/Approvals_view";
		$this->load->view("Admin_template",$data);
	}
	function Cabs(){
		$data['body']="Admin/Approvals_view";
		$this->load->view("Admin_template",$data);
	}
	function Delivary_Agencies(){
		$data['body']="Admin/Approvals_view";
		$this->load->view("Admin_template",$data);
	}

	function get_all_categories(){
		$this->load->model('Admin/CategoriesModule');
		$result=$this->CategoriesModule->load();
		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"", 'status'=>'FAIL');
		echo json_encode($arr);
	}
	
	function get_all_modules(){
		$this->load->model('Admin/ServiceModule');
		$result=$this->ServiceModule->load();
		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"", 'status'=>'FAIL');
		echo json_encode($arr);
	}
	
	function service_module_deactive(){
		if(!$this->input->is_ajax_request()) die('Unauthrized access');
		$this->load->model('Admin/ServiceModule');
		$module_id = $this->input->get_post('module_id',TRUE);
		echo $this->ServiceModule->deactivate($module_id);
	}
	
	function service_module_active(){
		if(!$this->input->is_ajax_request()) die('Unauthrized access');
		$this->load->model('Admin/ServiceModule');
		$module_id = $this->input->get_post('module_id',TRUE);
		echo $this->ServiceModule->activate($module_id);
	}
	
	function service_category_deactive(){
		if(!$this->input->is_ajax_request()) die('Unauthrized access');
		$this->load->model('Admin/CategoriesModule');
		$category_id = $this->input->post_get('category_id',TRUE);
		echo $this->CategoriesModule->deactivate($category_id);
	}
	
	function service_category_active(){
		if(!$this->input->is_ajax_request()) die('Unauthrized access');
		$this->load->model('Admin/CategoriesModule');
		$category_id = $this->input->post_get('category_id',TRUE);
		echo $this->CategoriesModule->activate($category_id);
	}
}