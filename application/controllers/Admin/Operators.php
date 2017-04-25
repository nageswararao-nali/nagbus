<?php
abstract class Operator extends CI_Controller{
	abstract public function create_operators();
	abstract public function load_operators($moduleid, $catid);
}
class Operators extends Operator{
	function __construct(){
		parent :: __construct();
		$this->load->model('Admin/OperatorsModule');
	}
	public function index(){
		$data['body']="Admin/Add_Operators";
		$this->load->view("Admin_template",$data);
	}
	
	function create_operators(){
		$c=$this->OperatorsModule;
		$c->setModuleId($this->input->post_get('moduleid',TRUE));
		$c->setCategoryId($this->input->post_get('categoryid',TRUE));
		$c->setOperatorName($this->input->post_get('operator_name',TRUE));
		$c->setOperatorCode($this->input->post_get('operator_code',TRUE));
		$c->setOperatorDescription($this->input->post_get('description',TRUE));
		echo $c->create()==TRUE ? TRUE : FALSE;
	}
	
	function load_operators($moduleid, $catid, $billtype = 'all'){
		$c=$this->OperatorsModule;
		$c->setModuleId($moduleid);
		$c->setCategoryId($catid);
		$c->setBillType($billtype);
		make_json($c->get_operators());
	}
	
	function get_network(){
		$c=$this->OperatorsModule;
		$c->setCategoryId($this->input->post_get('categoryid',TRUE));
		$c->setMobileNo($this->input->post_get('mobileno',TRUE));
		echo file_get_contents($c->fetch_mobile_network());
	}
	
}