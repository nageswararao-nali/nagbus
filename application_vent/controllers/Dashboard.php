<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Category_model', 'Cat', TRUE );
		$this->load->model('users_model', 'users', TRUE );
	}
	
	
        function dashboard1(){
            $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                $this->load->view('website_template/header', $data);
		$this->load->view('website/user/dashboard');
		$this->load->view('website_template/footer');
            
        }
        
        
	public function index() {
            exit;
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
               # print_r($this->session->userdata());
                $role_id=$this->session->userdata('role_id');
                $this->load->view('website_template/header', $data);
                if($role_id=='2'){
                    $this->load->view('website/channel_partner/dashboard');
                }else if($role_id=='4'){
                    $this->load->view('website/user/dashboard');
                }else if($role_id=='6'){
                    $this->load->view('website/agent/dashboard');
                }
		
		$this->load->view('website_template/footer');
	}
        
        

	public function validate() {
            //print_r($this->input->post());exit;
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
   		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
   		if($this->form_validation->run() == FALSE) {
			//Field validation failed.  User redirected to login page
		 	if(!$this->input->is_ajax_request()){
				$this->index();
			}else{
				if(validation_errors()){
					$arr = array('err_code'=>0, "message"=>str_replace('\n',' ',substr(strip_tags(validation_errors()),0,-1)), 'status'=>'FAIL');
				}else $arr = array('err_code'=>0, "message"=>str_replace('\n',' ',substr(strip_tags(validation_errors()),0,-1)), 'status'=>'FAIL');
				echo json_encode($arr);
			}
		} else {
			//Go to private area
			if(!$this->input->is_ajax_request()) {
				$this->index();
				//redirect('home','refresh');
			} else {
				$arr = array('err_code'=>1, 'message'=>'Login Successfull', 'status'=>'SUCCESS');
				echo json_encode($arr);
			}
			
		}
	}
        
        public function check_database($password) {
		$username = $this->input->post('username');
		// $result = $this->admin->login_validate($username, $password);
		$this->db->where('email_id', $username);
        $this->db->where('password', md5($password));
        
        // Run the query
        $query = $this->db->get('users');
        // Let's check if there are any results
        if($query->num_rows()>0) {
            // If there is a user, then create session data
            $row = $query->row();
            // echo "<pre>"; print_r($row); exit;
            $data = array(
                    'user_id' => $row->user_id,
                    'name' => $row->name,
                    'email_id' => $row->email_id,
                    'role_id' => $row->role_id
                    );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
	}

        
        function dashboard(){
            $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                $this->load->view('website_template/header', $data);
		$this->load->view('website/user/dashboard');
		$this->load->view('website_template/footer');
            
        }
        
}


  
 