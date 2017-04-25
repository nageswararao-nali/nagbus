<?php 
require_once APPPATH.'controllers/Admin/Operators.php';
class Recharge_api extends Operators{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/OperatorsModule');
	}
	
	public function get_operators(){
		$this->load_operators(13,3);
		//$this->load_operators(13,17);
	}
	public function get_operatorsDTH(){
		$this->load_operators(13,17);
	}
	
	public function get_circles(){
		make_json($this->OperatorsModule->get_circles());
	}
	public function get_mobile_offer_operators(){
		 make_json($this->OperatorsModule->get_mobile_offer_operators());
	}
	
	public function get_mobile_offer_circles(){
		 make_json($this->OperatorsModule->get_mobile_offer_circles());
	}
	
	public function get_offer_categories(){
		$c=$this->OperatorsModule;
		make_json($c->get_mobile_offer_categories());
	}
	
	public function get_offers(){
		$c=$this->OperatorsModule;
		$c->setOperatorId($this->input->get_post('operatorid',TRUE));
		$c->setCircleId($this->input->get_post('circleid',TRUE));
		$c->setPlanId($this->input->get_post('planid',TRUE));
		$result = $c->OperatorsModule->get_offers();
		make_json($result);
	}
	
	function get_network(){
		$c=$this->OperatorsModule;
		$c->setCategoryId($this->input->post_get('categoryid',TRUE));
		$c->setMobileNo($this->input->post_get('mobileno',TRUE));
		echo file_get_contents($c->fetch_mobile_network());
	}
	
}