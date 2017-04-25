<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Category_model', 'Cat', TRUE );
		$this->load->model('users_model', 'users', TRUE );
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
           //print_r($this->session->userdata());
	
        $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$this->load->view('website_template/header', $data);
		$this->load->view('website/user/login');
		$this->load->view('website_template/footer');
	}

	public function validate() {
            //print_r($this->session->userdata());exit;
            $data['category'] = $this->Cat->get_category();
            $data['roles'] = $this->users->get_roles();
           //print_r($this->input->post());exit;
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
   		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
   		if($this->form_validation->run() == FALSE) {
                    
			//Field validation failed.  User redirected to login page
                           $this->index();     
		 	
		} else {
                    if($this->session->userdata('login_from')=='recharge'){
                         redirect('recharge/proceed');
                            /*$this->load->view('website_template/header', $data);
                            $this->load->view('website/recharge/proceed');
                            $this->load->view('website_template/footer');*/
                    }else{
                        $role_id=$this->session->userdata('role_id');
                        if($role_id=='2'){
                            redirect('channel_partner/dashboard');
                        }else if($role_id=='4'){
                            redirect('user/dashboard');
                        }else if($role_id=='6'){
                            redirect('agent/dashboard');
                        } 
                    }
			
		}
	}
        
        public function check_database($password) {
			
		$username = $this->input->post('username');
		//$usertype = $this->input->post('usertype');
		// $result = $this->admin->login_validate($username, $password);
		//$this->db->where('role_id', $usertype);
		$this->db->where('status','1');
		$this->db->where('email_id', $username);
		//$this->db->or_where('mobile', $username);
        $this->db->where('password', md5($password));       
        
        // Run the query
        $query = $this->db->get('users');
		 if($query->num_rows()>0) {
		 }
		 else
		 {
			$this->db->where('status','1');		
			$this->db->where('mobile', $username);
			$this->db->where('password', md5($password));
			$query = $this->db->get('users');			 
		 }		
		
        
        // Run the query
        //$query = $this->db->get('users');
		
		//echo $this->db->last_query();;
		
		//var_dump($query);
		//exit('123Here');
        
        // Let's check if there are any results
        if($query->num_rows()>0) {
            // If there is a user, then create session data
            $row = $query->row();
           // echo "<pre>"; print_r($row); exit;		
            $data = array(
                    'user_id' => $row->user_id,
                    'name' => $row->name,
                    'email_id' => $row->email_id,
                    'role_id' => $row->role_id,
                    'agent_id' => $row->agent_id,
                    'chp_id' => $row->chp_id,
                    'Mobile'=>$row->mobile,
                    'Login'=>TRUE
                    );
            $this->session->set_userdata($data);
            return true;
			
        }
        // If the previous process did not validate
        // then return false.
         $this->form_validation->set_message('check_database', 'Please check your login credentials.');
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


  
 