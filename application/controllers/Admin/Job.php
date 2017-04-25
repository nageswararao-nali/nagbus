<?php
class Job extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$data['body']="Admin/Job";
		$this->load->view("Admin_template",$data);	
	}
	
}?>