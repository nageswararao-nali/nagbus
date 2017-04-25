<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        // $this->load->model(array('agent_model'));
		$this->load->model('channel_model', 'channel', TRUE);
    }

    public function index() {	
	// echo "123";
	$userrole = 6;    
    $data['agent'] = $this->channel->get_channel_users($userrole);
        $this->load->view('admin_template/Header');
        $this->load->view('agent/index',$data);
        $this->load->view('admin_template/Footer');
    }

    function list_all_operators() {
        $list_all_operators = $this->operators_model->list_all_operators();
        echo json_encode($list_all_operators);
    }

    function delete_category($cat_id) {
        $delete_category = $this->categories_model->delete_category($cat_id);
        if ($delete_category) {
            echo json_encode(array("err_code" => 1, "status" => "SUCCESS"));
            exit;
        } else {
            echo json_encode(array("err_code" => 0, "status" => "FAILED"));
            exit;
        }
    }
		
	function create_agent(){

	$this->load->model('agent_model');
	$agent_data= array(
				'name' => $this->input->post('name'),
				'role_id' => '6'
						);
				$this->agent_model->insert_agent($agent_data);
		
	}
	public function update_agent(){
		
		$this->load->model('agent_model');
		$update_agent_data= array(
				'name' => $this->input->post('name'),
				'email_id' => $this->input->post('Email'),
				'mobile' => $this->input->post('mobile_num'),
				'district_name' => $this->input->post('district'),
				'pincode' => $this->input->post('Pincode'),
				'status' => $this->input->post('Status')
						);
		$user_id = $this->input->post('user_id');			
		$this->agent_model->update_agent_user($update_agent_data,$user_id);
		
	}
		public function edit_agent(){
			
		// echo "123";
		$this->load->model('agent_model'); 
		$agent_user_id = $this->uri->segment(3);
		$userrole = 6;
		$data= array();
        $data['agent'] = $this->channel->get_channel_users($userrole);
        $data['agent_edit'] = $this->agent_model->get_agent_data($agent_user_id);
		$this->load->view('admin_template/Header');
		$this->load->view('agent/edit_agent',$data);
	    $this->load->view('admin_template/Footer'); 
	}
	
}
