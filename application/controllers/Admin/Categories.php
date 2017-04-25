<?php
class Categories extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Admin/CategoriesModule');
	}
	function index(){
		$data['body']="Admin/Add_categories";
		$this->load->view("Admin_template",$data);	
	}
	
	function create_category(){
		$c=$this->CategoriesModule;
		$c->setModuleId($this->input->post_get('moduleid',TRUE));
		$c->setCategoryName($this->input->post_get('name',TRUE));
		$c->setCategoryDescription($this->input->post_get('description',TRUE));
		echo $c->create()==TRUE ? TRUE : FALSE;
	}
	
	function get_all_categories(){
		//it will give all the approved category records
		$result=$this->CategoriesModule->load_all();
		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"", 'status'=>'FAIL');
		echo json_encode($arr);
	}
	
	function get_selected_module_categories($moduleid){
		//it will give all the approved category records
		$result=$this->CategoriesModule->load_selected_approved($moduleid);
		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"No Categories", 'status'=>'FAIL');
		echo json_encode($arr);
	}
	
}?>