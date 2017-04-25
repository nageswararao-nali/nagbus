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
                $this->form_validation->set_rules('email', 'Email','required');
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
							
							//print_r($user);
							//exit;
                            //$this->resetpassword($user);
                            $info= "Password has been sent to your registered Mobile Number.";
							//SMS
								
//Code using curl

//API stands for Application Programming Integration which is widely used to integrate and enable interaction with other software, much in the same way as a user interface facilitates interaction between humans and computers. Our API codes can be easily integrated to any web or software application. 

//Change your configurations here.
//---------------------------------
$uid="766172696e69696e666f"; //your uid
$pin="ccdb37d4de7737d75924ab4507e03303"; //your api pin
$sender="LAABUS"; // approved sender id
$domain="smsalertbox.com"; // connecting url 
$route="5";// 0-Normal,1-Priority
$method="POST";
//---------------------------------



	$mobile = $user->mobile;
	$name = $user->name;
	$password = $user->org_password;

	//$message='Dear  '.$name.', You have successfully registered as   User with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	$message ='Dear '.$name.', You new  Password is '.$password.'. thank you for using www.laabus.com For best offers download  app @ https://goo.gl/QWUiJB';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);

                            $this->session->set_flashdata('msg',$info);
                            redirect('Forgotpassword');
                    }
                    
                    $error= "The email id/Mobile Number you entered not found on our System ";
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


  
 