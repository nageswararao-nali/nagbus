<?php
abstract class Promotion extends CI_Controller{
	abstract function Save_Business_Promotions();
	abstract function Save_Purchase_Promotions();
}
class Promotions extends Promotion{
	function __construct(){
		parent :: __construct();
		//$this->load->model('Admin/OperatorsModule');
	}
	
	public function index(){
		$data['body']="Admin/Promotions/Business_Promotions";
		$this->load->view("Admin_template",$data);
	}
	
	public function Business_Promotions(){
		$data['body']="Admin/Promotions/Business_Promotions";
		$this->load->view("Admin_template",$data);
	}
	
	public function Purchase_Promotions(){
		$data['body']="Admin/Promotions/Purchase_Promotions";
		$this->load->view("Admin_template",$data);
	}
	
	public function Save_Business_Promotions(){
		
	}
	
	public function Save_Purchase_Promotions(){
		
	}
}