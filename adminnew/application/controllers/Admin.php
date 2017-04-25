<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Controller for admin user
 */
class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            $footerData['jqueryJavaScript'] = '
                        $("#loginAction").validate({
                              rules: {                                    
                                      username: {required:true},
                                      password:{equalTo: "#password"},                                      
                                      },
                              messages: {
                                      username: {required:"Please enter Username"},
                                      password:{required:"Please enter Password"},
                              }
                      });
                ';
            $this->load->view('adminlogin', $footerData);
        } else {
            
        }
    }

    public function validate() {
        
    }

    public function check_database($password) {
        $username = $this->input->post('username');
        $this->db->where('admin_name', $username);
        $this->db->where('admin_password', md5($password));

        // Run the query
        $query = $this->db->get('admin');
        // Let's check if there are any results
        if ($query->num_rows() > 0) {
            // If there is a user, then create session data
            $row = $query->row();
            // echo "<pre>"; print_r($row); exit;
            $data = array(
                'a_id' => $row->a_id,
                'admin_name' => $row->admin_name,
                'admin_password' => $row->admin_password,
                'login_status' => $row->login_status
            );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }

}
