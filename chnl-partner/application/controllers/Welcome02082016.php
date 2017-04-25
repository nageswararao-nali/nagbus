<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('users_model'));
    }

    public function index() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $("#loginAction").validate({
                              rules: {                                    
                                      username: {required:true},
                                      password:{required:true},                                      
                                      },
                              messages: {
                                      username: {required:"Please enter Username"},
                                      password:{required:"Please enter Password"},
                              }
                      });
                ';
            $this->load->view('adminlogin', $footerData);
        } else {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $where = " where admin_name = '$username' and admin_password = '$password'";
            $user_details = $this->users_model->get_admin_user($where);
            if (count($user_details) > 0) {
                $user_data['admin_session'] = array("username" => $user_details[0]['admin_name'], "user_id" => $user_details[0]['a_id'], "role_id" => $user_details[0]['role_id']);
                $this->users_model->admin_update(array("lupdate" => date("Y-m-d H:i:s")), $user_details[0]['a_id']);
                $this->session->set_userdata($user_data);
                redirect(base_url() . 'dashboard/');
                exit;
                //$session_data = $this->session->userdata("admin_session");
                //print_r($session_data);
            } else {
                $this->session->set_flashdata('msg', array('error' => 'Invalid Username OR Password'));
                redirect(base_url());
            }
        }
    }

    public function logout() {
//                $session_data = $this->session->userdata("admin_session");
 //               print_r($session_data);exit;

        $this->session->unset_userdata('admin_session');
        redirect(base_url());
    }

}
