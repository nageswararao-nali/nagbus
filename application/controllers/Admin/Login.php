<?php
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		//$data['body']="Admin/Login_view";
		$this->load->view("Admin/Login_view");
	}
}?>