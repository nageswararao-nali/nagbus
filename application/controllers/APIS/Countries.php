<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends CI_Controller {
	public function __construct(){
		parent::__construct(); // :: Represent static method of codeigniter system core
	}
	public function index(){
		$this->load->model('options/SelectBox_model');
		if($this->SelectBox_model->get_countries())
			$msg=array("err_code"=>0, "message"=>$this->SelectBox_model->get_countries(), "status"=>"SUCCESS");
		else
			$msg=array("err_code"=>1, "message"=>"No Countries", "status"=>"FAIL");
			echo json_encode($msg);
	}
}
