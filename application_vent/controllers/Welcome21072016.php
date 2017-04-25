<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
            
		//echo "Test 123";
		$data['offers'] = $this->users->getoffers();
		$data['offerswallet'] = $this->users->getofferswallet();
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$data['country'] = $this->users->get_country();
                $this->load->view('website_template', $data);
                
		
	}

	public function register() {
		$usertype = $this->input->post('usertype');
		// $this->form_validation->set_rules('token', 'Token missing','trim|required|callback_check_token');
		$this->form_validation->set_rules('usertype', 'User Type', 'trim|required|callback_check_role');
		$this->form_validation->set_rules('fullname', 'Full Name','trim');
		//$this->form_validation->set_rules('email', 'Email','required|valid_email|is_unique[users.email_id]');
		$this->form_validation->set_rules('promo_code', 'Promo Code','callback_promo_code_exists'); //check for valid promo or not.
		$this->form_validation->set_rules('email', 'Email','required|valid_email|callback_check_email_role_exists');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|min_length[10]|is_unique[login.Mobile]');
   		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]');
   		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim');
		$this->form_validation->set_rules('country', 'Country', 'trim');
		$this->form_validation->set_rules('state', 'State', 'trim');
		$this->form_validation->set_rules('district', 'District', 'trim');
		$this->form_validation->set_rules('city', 'City', 'trim');
		$this->form_validation->set_rules('lat', 'latitude', 'trim');
		$this->form_validation->set_rules('lng', 'logitude', 'trim');
		$this->form_validation->set_rules('location', 'location', 'trim');
		$this->form_validation->set_rules('country', 'country', 'trim');
		$this->form_validation->set_rules('country_short', 'country code', 'trim');
		$this->form_validation->set_rules('administrative_area_level_1','State', 'trim');
		$this->form_validation->set_rules('url', 'map url', 'trim');
		$this->form_validation->set_rules('formatted_address', 'Formatted address', 'trim');
		$this->form_validation->set_rules('ccity', 'city', 'trim');
		// $this->form_validation->set_rules('postal_code', 'Postal code', 'trim|required');
		$this->form_validation->set_rules('usertype', 'User type', 'trim|required');
		$this->form_validation->set_rules('agree', 'agree', 'trim|required');
		$usertype = $this->input->post('usertype');
		if($this->form_validation->run() == FALSE) {
                    
                                            $data['category'] = $this->Cat->get_category();
                                            $data['roles'] = $this->users->get_roles();
                                            $data['country'] = $this->users->get_country();
                                            $this->load->view('website_template/header', $data);
                                            $this->load->view('website/user/register', $data);
                                            $this->load->view('website_template/footer');
			
		} else {
			//Channel Partner register here
			if($usertype == 2) {
                            $country=$this->input->post('country');
                            $state=$this->input->post('state');
                            $district = $this->input->post('district');
                            $checkuser=$this->users->check_channelpatner_exists($state,$district);
                            
                            if($checkuser->num_rows() > 0){
                                $this->session->set_flashdata('msg', 'Channel Partner already exists with this district. Please try to add with different district.');
                                redirect('Welcome/signup');
                            }else{
                                if($this->users->create_user()) {
                                     $this->session->set_flashdata('msg', 'Channel Partner Registered Successfully ,Please wait for Admin Approval');
                                     redirect('login');
				} else {
                                    $this->session->set_flashdata('msg', 'Channel Partner Registration Failed.');
                                   redirect('Welcome/signup');
				}
                            }
				/*$this->users->addChannelPartner($district);
				$getchannel = $this->users->getChannel($district);
				//Inserting channel partner id value into role_based table
				$userrole = $this->session->userdata('usertype');
				$this->users->addRoleBased($getchannel);
				$chrole = $this->users->getChannelRole($getchannel);
				if($this->users->create_user($chrole)) {
                                     $this->session->set_flashdata('msg', 'Channel Partner Register Successfully Need to wait for Admin Approval');
                                     redirect('login');
				} else {
                                    $this->session->set_flashdata('msg', 'Channel Partner Registration Failed.');
                                   redirect('Welcome/signup');
				}*/
				/*if($this->users->create_user($chrole)) {
					if(!$this->input->is_ajax_request()) {
						$data['category'] = $this->Cat->get_category();
						$data['roles'] = $this->users->get_roles();
						$this->load->view('website_template/header', $data);
						$this->load->view('website/user/login');
						$this->load->view('website_template/footer');
					} else {
						$arr = array('err_code'=>1, "message"=>'Channel Partner Register Successfully Need to wait for Admin Approval', 'status'=>'SUCCESS');

						echo json_encode($arr);
					}
				} else {
					$msg=array("err_code"=>1, "message"=>"Channel Partner Register Successfully Need to wait for Admin Approval", "status"=>"FAIL");
					// echo "<pre>"; print_r($msg);
					echo json_encode($msg);
				}*/
			}
			//Service Provider register here
			if($usertype == 3) {
				$district = $this->input->post('district');
				$this->users->addChannelPartner($district);
				$getchannel = $this->users->getChannel($district);
				//Inserting channel partner id value into role_based table
				$userrole = $this->session->userdata('usertype');
				$this->users->addRoleBased($getchannel);
				$chrole = $this->users->getChannelRole($getchannel);
				
                                     
                                     
                                if($this->users->create_service($chrole)) {
                                    $this->session->set_flashdata('msg', 'Registration Successfull Please Login');
                                     redirect('login');
				} else {
					$this->session->set_flashdata('msg', 'Registration Failed.');
                                        redirect('Welcome/signup');
				}
                                     
				/*if($this->users->create_service($chrole)) {
					if(!$this->input->is_ajax_request()) {
						$data['category'] = $this->Cat->get_category();
						$data['roles'] = $this->users->get_roles();
						$this->load->view('website_template/header', $data);
						$this->load->view('website/user/login');
						$this->load->view('website_template/footer');
					} else {
						$arr = array('err_code'=>1, "message"=>'Registraion Successfull Please Login', 'status'=>'SUCCESS');

						echo json_encode($arr);
					}
				} else {
					$msg=array("err_code"=>1, "message"=>"User already registered", "status"=>"FAIL");
					// echo "<pre>"; print_r($msg);
					echo json_encode($msg);
				}*/
			}
			//Normal user register here
			if($usertype == 4) {
                                $pincode = $this->input->post('city');
				$country=$this->input->post('country');
                                $state=$this->input->post('state');
                                $district = $this->input->post('district');
                                $checkuser=$this->users->check_channelpatner_exists($state,$district);
                                if($checkuser->num_rows() > 0){
                                    $ch_data=$checkuser->row();
                                    $chp_id=$ch_data->user_id;
                                }else{
                                    $chp_id='0';
                                }
                                
                            $this->users->create_normaluser($chp_id);
                            $this->session->set_flashdata('msg', 'Registration Successfull Please Login');
                            redirect('login');
			}
                        
                        
			//Agent Register here
			if($usertype == 6) {
				$pincode = $this->input->post('city');
				$country=$this->input->post('country');
                                $state=$this->input->post('state');
                                $district = $this->input->post('district');
                                $checkuser=$this->users->check_channelpatner_exists($state,$district);
                                if($checkuser->num_rows() > 0){
                                    $ch_data=$checkuser->row();
                                    $chp_id=$ch_data->user_id;
                                }else{
                                    $chp_id='0';
                                }
                                
                                if($this->users->create_agent($chp_id)) {
                                        $this->session->set_flashdata('msg', 'You have successfully Registered as Agent. Please select below option for subscription');
                                       // redirect('login');
									    redirect('Welcome/agentsubscription');
                                    }else{
                                        $this->session->set_flashdata('msg', 'Failed to register the agent.Please retry.');
                                         redirect('Welcome/signup');
                                    }
                               /*
                                * $getdist = $this->users->getDistrictPin($pincode);
                                $getchannel = $this->users->getAgentChannelRole($getdist);
                                *  if($getchannel){
                                    
                                    $dpin = $this->users->getdpin($getchannel);
                                    $userrole = $this->input->post('usertype');
                                    
                                if($dpin){
                                        //Inserting Agent related channel partner id and pincode into agent table
                                    foreach ($getchannel as $gch) {
                                            $data1 = $gch->chp_id;
                                    }
                                    foreach ($dpin as $dp) {
                                            $data2 = $dp->Pincode;
                                    }

                                    $this->users->addAgentRole($data1, $data2);
                                    $getagr = $this->users->getAgentRole($data1);
                                    foreach ($getagr as $agr) {
                                            $data3 = $agr->agent_id;
                                    }
                                    $this->users->insertRole_Based($data3, $userrole);
                                    $getar = $this->users->getArole($data3, $userrole);
                                    foreach ($getar as $arole) {
                                            $datar = $arole->role_based_id;
                                    }

                                          #  print_r($data1);
                                           # print_r($data3);
                                           # exit;

                                    if($this->users->create_agent($datar,$data1,$data3)) {
                                        $this->session->set_flashdata('msg', 'Agent Registered Successfully Please wait for channel partner approval');
                                        redirect('login');
                                    }else{
                                        $this->session->set_flashdata('msg', 'Failed to register the agent.Please retry.');
                                         redirect('Welcome/signup');
                                    }
                                }else{
                                          $this->session->set_flashdata('msg', 'Sry');
                                          redirect('Welcome/signup');          
                                }
             
                }else{
                    $this->session->set_flashdata('msg', 'Sorry!!! no channel partners are avialable for this district,Please try with another district.');
                    redirect('Welcome/signup');
                }*/
				
				/*if($this->users->create_agent($datar)) {
                                       // redirect('login');
					if(!$this->input->is_ajax_request()) {
						$data['category'] = $this->Cat->get_category();
						$data['roles'] = $this->users->get_roles();
						$this->load->view('website_template/header', $data);
						$this->load->view('website/user/login');
						$this->load->view('website_template/footer');
					} else {
						$arr = array('err_code'=>1, "message"=>'Agent Registraion Successfull Please wait for channel partner approval', 'status'=>'SUCCESS');
						echo json_encode($arr);
					}
				} else {
                                    $this->session->set_flashdata('msg', 'Agent Registered Successfully Please wait for channel partner approval');
                                    redirect('Welcome/register');
//					$msg=array("err_code"=>1, "message"=>"Agent Registered Successfully Please wait for channel partner approval", "status"=>"FAIL");
//					// echo "<pre>"; print_r($msg);
//					echo json_encode($msg);
				}*/
			}
			//Service Agency register here
			if($usertype == 7) {
				$district = $this->input->post('district');
				$this->users->addChannelPartner($district);
				$getchannel = $this->users->getChannel($district);
				//Inserting channel partner id value into role_based table
				$userrole = $this->session->userdata('usertype');
				$this->users->addRoleBased($getchannel);
				$chrole = $this->users->getChannelRole($getchannel);
				// echo "<pre>"; print_r($chrole); exit;
                                if($this->users->create_service_agency($chrole)) {
					$this->session->set_flashdata('msg', 'Registraion Successfull Please Login');
                                        redirect('login');
				} else {
					$this->session->set_flashdata('msg', 'User already registered');
                                    redirect('Welcome/signup');
				}
				/*if($this->users->create_service_agency($chrole)) {
					if(!$this->input->is_ajax_request()) {
						$data['category'] = $this->Cat->get_category();
						$data['roles'] = $this->users->get_roles();
						$this->load->view('website_template/header', $data);
						$this->load->view('website/user/login');
						$this->load->view('website_template/footer');
					} else {
						$arr = array('err_code'=>1, "message"=>'Registraion Successfull Please Login', 'status'=>'SUCCESS');

						echo json_encode($arr);
					}
				} else {
					$msg=array("err_code"=>1, "message"=>"User already registered", "status"=>"FAIL");
					// echo "<pre>"; print_r($msg);
					echo json_encode($msg);
				}*/
			}
			//Delivery boys register here
			if($usertype == 8) {
				$district = $this->input->post('district');
				$this->users->addChannelPartner($district);
				$getchannel = $this->users->getChannel($district);
				//Inserting channel partner id value into role_based table
				$userrole = $this->session->userdata('usertype');
				$this->users->addRoleBased($getchannel);
				$chrole = $this->users->getChannelRole($getchannel);
				// echo "<pre>"; print_r($chrole); exit;
                                
                                if($this->users->create_delivery($chrole)) {
					$this->session->set_flashdata('msg', 'Registraion Successfull Please Login');
                                        redirect('login');
				} else {
					$this->session->set_flashdata('msg', 'User already registered');
                                    redirect('Welcome/signup');
				}
                                
				/*if($this->users->create_delivery($chrole)) {
					if(!$this->input->is_ajax_request()) {
						$data['category'] = $this->Cat->get_category();
						$data['roles'] = $this->users->get_roles();
						$this->load->view('website_template/header', $data);
						$this->load->view('website/user/login');
						$this->load->view('website_template/footer');
					} else {
						$arr = array('err_code'=>1, "message"=>'Registraion Successfull Please Login', 'status'=>'SUCCESS');

						echo json_encode($arr);
					}
				} else {
					$msg=array("err_code"=>1, "message"=>"User already registered", "status"=>"FAIL");
					// echo "<pre>"; print_r($msg);
					echo json_encode($msg);
				}*/
			}
		}
	}

	public function ajax_state_list($country_id) {
		$data['state'] = $this->users->getstate($country_id);
		$this->load->view('website/user/states', $data);
	}

	public function ajax_district_list($state_id) {
		$data['district'] = $this->users->getdistrict($state_id);
		// echo "<pre>"; print_r($data); exit;
		$this->load->view('website/user/district', $data);
	}

	public function ajax_cities_list($city_id) {
		$data['cities'] = $this->users->getcities($city_id);
		// echo "<pre>"; print_r($data); exit;
		$this->load->view('website/user/cities', $data);
	}

	public function ajax_pincode($pinc_id) {
		$data['pincode'] = $this->users->getpincode($pinc_id);
		// echo "<pre>"; print_r($data); exit;
		$this->load->view('website/user/pincode', $data);
	}


	public function signup() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['country'] = $this->users->get_country();
		$this->load->view('website_template/header', $data);
		$this->load->view('website/user/register', $data);
		$this->load->view('website_template/footer');
	}
	
	public function agentsubscription() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['country'] = $this->users->get_country();
		$data['subscription'] = $this->users->getsubscription();
		$this->load->view('website_template/header', $data);
		$this->load->view('website/user/agentsubscription', $data);
		$this->load->view('website_template/footer');
	}
	
	public function subscriptionaction()
	{
		$this->session->set_flashdata('msg', 'Registraion Successfull Please Login');
        redirect('login');
	}
	
										
										
										
										

	//Checking role is empty
	public function check_role($usertype) {
		if($usertype=="0"){
		$this->form_validation->set_message('check_role', 'Please Select User Role');
		return false;
		} else{
		// User picked something.
		return true;
		}
	}

        
        
	public function flight() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/flight/index', $data);
	}
	public function recharge() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
                if(!$this->input->is_ajax_request()) {
                   
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/index', $data);
                    $this->load->view('website_template/footer');
                }else{
                    $this->load->view('website/recharge/index', $data);
                    
                }
		
	}


	public function buses() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/buses/index', $data);
	}

public function cabs() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/cabs/index', $data);
	}
	public function hotels() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/hotels/index', $data);
	}

public function Holidays() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/holidays/index', $data);
	}

public function money() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/hotels/index', $data);
	}
	public function paybills() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/billpayments/index', $data);
	}

public function courier() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/courier/index', $data);
	}

public function food() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/food/index', $data);
	}

public function services() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/services/index', $data);
		
		
	}
public function e_com() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$data['folder'] ='';
		$data['body'] = 'index';
		$this->load->view('website/e_com/index', $data);
	}
        
    public function logout(){
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('email_id');      
        $this->session->sess_destroy();
        redirect('','refresh');
    }
    
    //Checking Email Exists
	
	public function promo_code_exists($password) {
		$promo_code = $this->input->post('promo_code');
		$role_id = $this->input->post('usertype');
		$offerdata =$this->users->getjoiningoffers($role_id,$promo_code);
		//print_r($offerdata);exit;
		if(empty($offerdata) && !empty($promo_code)  )
		{
			$this->form_validation->set_message('promo_code_exists', 'Invalid Promo Code.Please enter Valid Promo Code or Leave it as Empty');
			return false;
		}
		else
		{
			return true;
		}
	}
    
    public function check_email_role_exists($password) {
        $email = $this->input->post('email');
        $role_id = $this->input->post('usertype');
		$mobile = $this->input->post('mobile');
        $emailcount=$this->users->email_exists($role_id,$email);
		$mobilecount=$this->users->mobile_exists($role_id,$mobile);
         if($emailcount->cnt==0 && $mobilecount == 0 ){
                return true;
            }else if( $emailcount->cnt > 0 && $mobilecount->cnt == 0) {
                $this->form_validation->set_message('check_email_role_exists', 'Email Id already exists with this role.');
		return false;
            }
			else if( $emailcount->cnt == 0 && $mobilecount->cnt > 0) {
                $this->form_validation->set_message('check_email_role_exists', 'Mobile Number already exists with this role.');
		return false;
            }
			else if( $emailcount->cnt > 0 && $mobilecount->cnt > 0) {
                $this->form_validation->set_message('check_email_role_exists', 'Email Id and Mobile Number already exists with this role.');
		return false;
            }
        
	}
    
     
}


  
 