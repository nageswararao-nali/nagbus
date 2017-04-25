<?php 
require_once APPPATH.'controllers/Admin/Operators.php';
class Recharge_api extends Operators{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/OperatorsModule');
	}
	
	public function get_operators($billtype = 'all'){
		$this->load_operators(13,3, $billtype);
		//$this->load_operators(13,17);
	}
	public function get_operatorsDTH(){
		$this->load_operators(13,17);
	}
	
	public function get_operatorsDatacard(){
		$this->load_operators(13,26);
	}
	
	public function get_operatorsLandline(){
		$this->load_operators(13,27);
	}
	public function get_operatorsElectricity(){
		$this->load_operators(13,28);
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
	
	public function get_offers_mobile(){
		$c=$this->OperatorsModule;
		
		$operator = $this->input->get_post('operatorid',TRUE);
		if($operator == 1 )
		{
			$operator = 3;
		}
		else if($operator == 2 )
		{
			$operator = 18;
		}
		else if($operator == 4 ||  $operator == 5 || $operator == 6 || $operator == 7 )
		{
			$operator = 4;
		}
		else if($operator == 8 )
		{
			$operator = 11;
		}
		else if($operator == 9 )
		{
			$operator = 12;
		}
		else if( $operator == 11 || $operator == 12 )
		{
			$operator = 9;
		}
		else if($operator == 13 )
		{
			$operator = 6;
		}
		else if($operator == 14 )
		{
			$operator = 7;
		}
		else if($operator == 15 )
		{
			$operator = 8;
		}
		else if($operator == 16 || $operator == 17  )
		{
			$operator = 5;
		}
		else if($operator == 18 )
		{
			$operator = 16;
		}
		else if($operator == 19 )
		{
			$operator = 10;
		}
		else if($operator == 20 )
		{
			$operator = 17;
		}
		
		else if($operator == 24 || $operator == 25  )
		{
			$operator = 15;
		}
		else
		{
			$operator = 1;
		}
		
		
		
		$c->setOperatorId($operator);
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
		/*
		$c=$this->OperatorsModule;
		$c->setCategoryId($this->input->post_get('categoryid',TRUE));
		$c->setMobileNo($this->input->post_get('mobileno',TRUE));
		echo file_get_contents($c->fetch_mobile_network());
		
		$data["operator"] = 1;
		$data["circle"] = 1;
		$data["error_code"] = '';
		$data["message"] = '';
		
		echo json_encode($data);*/
	}
	
}