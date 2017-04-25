<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('channel_model', 'channel', TRUE);
        $this->load->model('admin_model', 'admin', TRUE);
        //$this->load->model(array('operator_model'));
    }
    public function index() {
        $this->load->view('admin_template/Header');
        $this->load->view('index');
        $this->load->view('admin_template/Footer');
    }

    public function API_credentials() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/ApiIntegrations/API_credentials');
        $this->load->view('admin_template/Footer');
    }

    public function API_list() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/ApiIntegrations/API_List');
        $this->load->view('admin_template/Footer');
    }

    public function API_setup() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/ApiIntegrations/API_setup');
        $this->load->view('admin_template/Footer');
    }

    public function categories() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Approval_blocks/categories');
        $this->load->view('admin_template/Footer');
    }

    public function Modules() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Approval_blocks/Modules');
        $this->load->view('admin_template/Footer');
    }

    public function Service_Provider() {				// echo "I am new";
         $this->load->view('admin_template/Header');
         $this->load->view('dashboard/Approval_blocks/Service_Provider');		
         $this->load->view('admin_template/Footer');
    }        public function Business_Promotions() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Promotions/Business_Promotions');
        $this->load->view('admin_template/Footer');
    }

    public function Purchase_Promotions() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Promotions/Purchase_Promotions');
        $this->load->view('admin_template/Footer');
    }

    public function Add_services() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Service_Provider/Add_services');
        $this->load->view('admin_template/Footer');
    }

    public function Approve_Service_Providers() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Service_Provider/Approve_Service_Providers');
        $this->load->view('admin_template/Footer');
    }

    public function Add_categories() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Add_categories');
        $this->load->view('admin_template/Footer');
    }

    public function Add_Modules() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Add_Modules');
        $this->load->view('admin_template/Footer');
    }	// public function channel_partner_list(){							// }



    public function Commission() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Commission');
        $this->load->view('admin_template/Footer');
    }

    public function Commission_distribute() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Commission_distribute');
        $this->load->view('admin_template/Footer');
    }

    public function Job() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Job');
        $this->load->view('admin_template/Footer');
    }

    public function User_under_agent_commission() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/User_under_agent_commission');
        $this->load->view('admin_template/Footer');
    }

    // only for practice
    public function practice() {
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/practice');
        $this->load->view('admin_template/Footer');
    }

    // end parctice


    public function channel_partner() {
        $userrole = 2;        $data['channel'] = $this->channel->get_channel_users($userrole);        $this->load->view('admin_template/Header');        $this->load->view('dashboard/Approval_blocks/channel_partner', $data);        $this->load->view('admin_template/Footer');
    }	public function create_channel_partner() {		print_r($_POST);			 /* 	$channel_partner_data= array(				'name' => $this->input->post('name'),				'email_id' => $this->input->post('email'),				'password' => $this->input->post('Password'),				'mobile' => $this->input->post('mobile_no'),				'district_name' => $this->input->post('district'),				'pincode' => $this->input->post('Pincode'),				'status' => 1,				'role_based_id' => 2							);							;				$this->channel->create_channel_partner($channel_partner_data); */		     }		public function edit_channel_partner() {						$userrole = $this->uri->segment(3);		$channel_data['channel_user_data'] = $this->channel->get_channel_user_edit($userrole);	    $this->load->view('admin_template/Header');        $this->load->view('dashboard/Approval_blocks/edit_channel_partner',$channel_data);        $this->load->view('admin_template/Footer');    }
	public function update_channel_partner(){									}
    public function Agent() {
        $role = 6;
        $data['agent'] = $this->channel->get_agent_users($role);
        // echo "<pre>"; print_r($data); exit;
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Approval_blocks/agent', $data);
        $this->load->view('admin_template/Footer');
    }

}
