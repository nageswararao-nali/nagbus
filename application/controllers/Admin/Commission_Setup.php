<?php
abstract class Commission extends CI_Controller{
	abstract function save_operator_commission();
}
class Commission_Setup extends Commission{
	function __construct(){
		parent :: __construct();
		$this->load->model('Admin/CommissionModule');
	}
	public function index(){
		$data['body']="Admin/Commission";
		$this->load->view("Admin_template",$data);
	}

	function save_operator_commission(){	
		$c=$this->CommissionModule;
		$c->setOperatorId($this->input->post('operator_id',TRUE));
		$c->setOurCalType($this->input->post('our_cal_type',TRUE));
		$c->setOurAmount($this->input->post('our_amount',TRUE));
		$c->setAgentCalType($this->input->post('agent_cal_type',TRUE));
		$c->setAgentAmount($this->input->post('agent_amount',TRUE));
		$c->setMarkCalType($this->input->post('mark_cal_type',TRUE));
		$c->setMarkAmount($this->input->post('mark_amount',TRUE));
		$c->setDiscountCalType($this->input->post('discount_cal_type',TRUE));
		$c->setDiscountAmount($this->input->post('discount_amount',TRUE));
		$c->save();
	}
	
	public function user_agent(){
		$data['body']="Admin/User_under_agent_commission";
		$this->load->view("Admin_template",$data);
	}
	
	public function get_operators_commission($moduleid, $catid){
		$c=$this->CommissionModule;
		$c->setModuleId($moduleid);
		$c->setCategoryId($catid);
		$result = $c->get_operators();
		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"", 'status'=>'FAIL');
		echo json_encode($arr);	
	}

	public function distribute(){
		$data['body']="Admin/Commission_distribute";
		$this->load->view("Admin_template",$data);	
	}
	
	public function commission_distribute_save(){
		$c=$this->CommissionModule;
		$c->setSmdPercentage($this->input->post('smd_percentage',TRUE));
		$c->setLaabusPercentage($this->input->post('labbus_percentage',TRUE));
		$c->setCpTerm1Period($this->input->post('term1_period',TRUE));
		$c->setCpTerm1Amount($this->input->post('term1_percentage',TRUE));
		$c->setCpTerm2Period($this->input->post('term2_period',TRUE));
		$c->setCpTerm2Amount($this->input->post('term2_percentage',TRUE));
		$c->setCpTerm3Amount($this->input->post('term3_percentage',TRUE));
		$result = $c->save_commission_distribute();

		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"", 'status'=>'FAIL');
		echo json_encode($arr);
	}
	
	public function fetch_commission(){
		$c=$this->CommissionModule;
		$result = $c->fetch_commission_distribute();
		$result!=FALSE ? $arr=array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : $arr=array('err_code'=>0, "message"=>"", 'status'=>'FAIL');
		echo json_encode($arr);
	}
}