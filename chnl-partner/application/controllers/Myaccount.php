<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount extends CI_Controller {

    var $userrole = '';

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('general_model', 'users_model'));
        $this->form_validation->set_error_delimiters('<div class="alert alert-error"> ', '</div>');
    }

    // channel partner Started here
    public function index() {
        $this->userrole = 1;
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $where = " where role_id='1'";
        $data["user_details"] = $this->users_model->get_admin_user($where);
        if ($this->form_validation->run() === FALSE) {
            //print_r($data["user_details"]);exit;
            $footerData['jqueryJavaScript'] = '
                
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#addAdmin").validate({
                              rules: {                                    
                                      name: {required:true},
                                      //mobile_number:{required:true, digits:true},
                                      //password: {required:true},
                                      //confirm_password:{equalTo: "#password"},                                      
                                      },
                              messages: {
                                      name: {required:"Please enter username"},
				      //mobile_number:{required:"Please enter Mobile Number", digits: "Please enter valid Mobile Number"},
                                      //password: {required:"Please enter Password"},
                                      //confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},pincode:{required:"Please enter Pincode"},
                              }
                      });
                ';
            $this->load->view('admin_template/Header');
            $this->load->view('myaccount/index', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {
            $user_data = array(
                'admin_name' => $this->input->post('name'),
                'login_status' => $this->input->post('status'),
                    //'role_id' => 1
            );
            $this->users_model->admin_update($user_data, $data["user_details"][0]['a_id']);
            $this->session->set_flashdata('msg', array('success' => 'Admin data updated successfully'));
            redirect(base_url() . 'myaccount/');
        }
    }

    function changepassword() {
        $this->userrole = 1;
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
        $where = " where role_id='1'";
        $data["user_details"] = $this->users_model->get_admin_user($where);
        if ($this->form_validation->run() === FALSE) {
            //print_r($data["user_details"]);exit;
            $footerData['jqueryJavaScript'] = '                
                        $(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                        } );
                        $("#adminChangePassword").validate({
                              rules: {                                    
                                      password: {required:true},
                                      confirm_password:{equalTo: "#password"},                                      
                                      },
                              messages: {
                                      password: {required:"Please enter Password"},
                                      confirm_password:{required:"Please enter Confirm Password", equalTo: "Password & confirm Password should match"},pincode:{required:"Please enter Pincode"},
                              }
                      });
                ';
            $this->load->view('admin_template/Header');
            $this->load->view('myaccount/changepassword', $data);
            $this->load->view('admin_template/Footer', $footerData);
        } else {
            $user_data = array(
                'admin_password' => md5($this->input->post('password')),
            );
            $this->users_model->admin_update($user_data, $data["user_details"][0]['a_id']);
            $this->session->set_flashdata('msg', array('success' => 'Password updated successfully'));
            redirect(base_url() . 'myaccount/changepassword');
        }
    }

    

}
