<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {

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
		
                 $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['country'] = $this->users->get_country();
		$this->load->view('website_template/header', $data);
		$this->load->view('website/user/forget');
		$this->load->view('website_template/footer');
	}

	public function doforget()
	{
		$email= $this->input->post('email');
		$q = $this->users->get_user($email);
                $this->form_validation->set_rules('email', 'Email','required|valid_email');
                if($this->form_validation->run() == FALSE) {
                    
                    $data['category'] = $this->Cat->get_category();
                    $data['roles'] = $this->users->get_roles();
                    $data['country'] = $this->users->get_country();
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/user/forget');
                    $this->load->view('website_template/footer');
			
		} else {
                        if ($q->num_rows() > 0) {

                            $r = $q->result();
                            $user=$r[0];
							
							print_r($user);
							exit;
                            $this->resetpassword($user);
                            $info= "Password has been reset and has been sent to email id: ". $email;
                            $this->session->set_flashdata('msg',$info);
                            redirect('Forgotpassword');
                    }
                    
                    $error= "The email id you entered not found on our database ";
                    $this->session->set_flashdata('msg',$error);
                    redirect('Forgotpassword');
                }
                
                //exit;
		//$error= "The email id you entered not found on our database ";
		//redirect('/index.php/login/forget?error=' . $error, 'refresh');
		
	}
        
        public function resetpassword($user)
	{
            
		date_default_timezone_set('GMT');
		$this->load->helper('string');
		$password= random_string('alnum', 16);
		$this->db->where('user_id', $user->user_id);
		$this->db->update('users',array('password'=>MD5($password)));
		$this->load->library('email');
		$this->email->from('cantreply@youdomain.com', 'Laabus');
		$this->email->to($user->email_id); 	
		$this->email->subject('Password reset');
		$this->email->message('You have requested the new password, Here is you new password:'. $password);	
		$this->email->send();
	} 
        
        
}


  
 