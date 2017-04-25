<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ChannelPartner extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('channel_model', 'channel', TRUE);
        $this->load->model('admin_model', 'admin', TRUE);
        //$this->load->model(array('operator_model'));
    }

    public function index() {

        $userrole = 2;
        $data['channel'] = $this->channel->get_channel_users($userrole);
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Channel_partner/index', $data);
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

    public function Service_Provider() {
        $this->load->model('channel_model');
        $role = 3;
        $data['serviceprovider'] = $this->channel_model->list_service_provider($role);
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Approval_blocks/Service_Provider', $data);
        $this->load->view('admin_template/Footer');
    }

    public function edit_service_provider() {

        $role = 3;
        $data['serviceprovider'] = $this->channel->list_service_provider($role);
        // $data['edit_serviceprovider'] = $this->channel->list_service_provider($role);
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Approval_blocks/edit_service_provider', $data);
        $this->load->view('admin_template/Footer');
    }

    public function Business_Promotions() {
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
    }

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
        $userrole = 2;
        $data['channel'] = $this->channel->get_channel_users($userrole);
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Channel_partner/index', $data);
        $this->load->view('admin_template/Footer');
    }

    public function Agent() {
        $role = 6;
        $data['agent'] = $this->channel->get_agent_users($role);
        // echo "<pre>"; print_r($data); exit;
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/Approval_blocks/agent', $data);
        $this->load->view('admin_template/Footer');
    }

    function create_channel_partner() {

        $channel_partner_data = array(
            /* 'name' => $this->input->post('name'),
              'email_id' => $this->input->post('email'),
              'district_name' => $this->input->post('district'),
              'pincode' => $this->input->post('Pincode'),
              'status' => 1,
              'role_id' => 2 */
            'name' => $this->input->post('name'),
            'email_id' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'password' => $this->input->post('password'),
            'country_name' => $this->input->post('country'),
            'state_name' => $this->input->post('state'),
            'district_name' => $this->input->post('district'),
            'city_name' => $this->input->post('city'),
            'pincode' => $this->input->post('Pincode'),
            'status' => 1,
            'role_id' => 2
        );

        $this->channel->create_channel_partner($channel_partner_data);
    }

    function edit_channel_partner() {
        $channel_data = array();
        $userrole = $this->uri->segment(3);
        $channel_data['channel_user_data'] = $this->channel->get_channel_user_edit($userrole);
        $this->load->view('admin_template/Header');
        $user_ids = 2;
        $channel_data['channel'] = $this->channel->get_channel_users($user_ids);
        $this->load->view('dashboard/Channel_partner/update', $channel_data);
        $this->load->view('admin_template/Footer');
    }

    public function update_channel_partner($channel_id) {

        $update_channel_partner_data = array(
            'name' => $this->input->post('name'),
            'email_id' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'password' => $this->input->post('password'),
            'country_name' => $this->input->post('country'),
            'state_name' => $this->input->post('state'),
            'district_name' => $this->input->post('district'),
            'city_name' => $this->input->post('city'),
            'pincode' => $this->input->post('Pincode'),
            'status' => 1,
            'role_id' => 2
        );
        $this->channel->update_channel_user($update_channel_partner_data, $channel_id);
    }

}
