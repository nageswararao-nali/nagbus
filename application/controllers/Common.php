<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
                $this->load->library('upload');
		$this->load->model('Category_model', 'Cat', TRUE );
		$this->load->model('users_model', 'users', TRUE );
		$this->load->model('cashback_model' );
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

	public function update_password() {
		$cur_password=$this->input->post('current_password');
		$new_password=$this->input->post('new_password');
		$confirm_password=$this->input->post('confirm_password');
                $role_id=$this->session->userdata('role_id');
                $email_id=$this->session->userdata('email_id');

		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
   		$this->form_validation->set_rules('new_password', 'New password', 'trim|required|matches[confirm_password]');
   		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');


		if($this->form_validation->run() == FALSE) {

                    $data['category'] = $this->Cat->get_category();
                    $data['roles'] = $this->users->get_roles();
                    $data['country'] = $this->users->get_country();
                    $this->load->view('website_template/header', $data);
                    if($role_id=='4'){
                        //$this->load->view('website/user/change_password', $data);
						redirect('user/change_password');
                    }else if($role_id=='6'){
                        //$this->load->view('website/agent/change_password', $data);
						 redirect('agent/profile');
                    }

                    $this->load->view('website_template/footer');

		} else {
			 $query = $this->users->checkOldPass($cur_password,$role_id,$email_id);
                         if($query==1){
                             $savequery = $this->users->saveNewPass($new_password,$email_id,$role_id);
                             if($savequery){
                                 $this->session->set_flashdata('msg', 'Password updated successfully');
                                 if($role_id=='4'){
                                    redirect('user/change_password');
                                 }else if($role_id=='6'){
                                      redirect('agent/profile');
                                 }
                             }
                         }else{
                             $this->session->set_flashdata('msg', 'Incorrect Old Password ,Please check.');
							  if($role_id=='4'){
                        //$this->load->view('website/user/change_password', $data);
						redirect('user/change_password');
                    }else if($role_id=='6'){
                        //$this->load->view('website/agent/change_password', $data);
						 redirect('agent/profile');
                    }
                         }

		}
	}

        function update_profile(){
            $form_type=$this->input->post('form_type');
            $role_id=$this->session->userdata('role_id');
            $user_id=$this->session->userdata('user_id');
            #print_r($this->session->userdata());
            #print_r($this->input->post());exit;
            if($form_type=='profile'){
                $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
               // $this->form_validation->set_rules('city', 'City', 'trim|required');
                //$this->form_validation->set_rules('postalcode', 'Postal Code', 'trim|required');
            }elseif($form_type=='kyc'){
                $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');

            }elseif($form_type=='bank'){
                $this->form_validation->set_rules('holdername', 'Account Holder Name', 'trim|required');

                if($this->input->post('accountselect')=='ifsc'){
                    $this->form_validation->set_rules('ifsccode', 'IFSC Code', 'trim|required');
                }else{
                    $this->form_validation->set_rules('branchname', 'Branch Name', 'trim|required');
                    $this->form_validation->set_rules('bankname', 'Bank Holder Name', 'trim|required');
                }
                $this->form_validation->set_rules('accountno', 'Account Number', 'trim|required|matches[confirmacctno]');
                $this->form_validation->set_rules('confirmacctno', 'Account Number', 'trim|required');

            }


		if($this->form_validation->run() == FALSE) {
                   # echo "helo";exit;
                    $data['category'] = $this->Cat->get_category();
                    $data['roles'] = $this->users->get_roles();
                    $data['country'] = $this->users->get_country();
                    $this->load->view('website_template/header', $data);
                    if($role_id=='4'){
                        $this->load->view('website/user/profile', $data);
                    }else if($role_id=='6'){
                        $this->load->view('website/agent/profile', $data);
                    }

                    $this->load->view('website_template/footer');

		} else {
                    //echo "failll";exit;
                    //if($role_id==4){
                         if($form_type=='profile'){
                             $checkuser = $this->users->getuserin_profile('profile',$user_id);
                             //print_r($checkuser);exit;
                             if($checkuser==1){
                                 $insert_values = array(
                                        "Name" => $this->input->post('fullname'),
                                        "Company_Name" => $this->input->post('companyname'),
                                        "Dob" => $this->input->post('datepickerDemo1'),
                                        "Address" => $this->input->post('address'),
                                        "City" => $this->input->post('city'),
                                        "Postal_code" => $this->input->post('postalcode'),
                                        "updated_date" => date('Y-m-d H:i:s')
                                    );

                                    $savequery=$this->users->update_user_in_profile('profile',$insert_values,$user_id);

                                    if($savequery){
                                        $this->session->set_flashdata('msg', 'Profile updated successfully');
                                        if($role_id==4){
                                            redirect('user/profile');
                                        }elseif($role_id==6){
                                            redirect('agent/profile');
                                        }
                                    }

                             }else{

                                    $insert_values = array(
                                    "User_id"	=>	$user_id,
                                    "Name" => $this->input->post('fullname'),
                                    "Company_Name" => $this->input->post('companyname'),
                                    "Dob" => $this->input->post('datepickerDemo1'),
                                    "Address" => $this->input->post('address'),
                                    "City" => $this->input->post('city'),
                                    "Postal_code" => $this->input->post('postalcode'),
                                    "created_date" => date('Y-m-d H:i:s'),
                                    "updated_date" => date('Y-m-d H:i:s')
				);

                                 if($this->users->insert_user_in_profile('profile',$insert_values)){
                                     $this->session->set_flashdata('msg', 'Profile updated successfully');
                                     if($role_id==4){
                                            redirect('user/profile');
                                        }elseif($role_id==6){
                                            redirect('agent/profile');
                                        }
                                 }

                             }
                         }

                         if($form_type=='kyc'){
                             $checkuser = $this->users->getuserin_profile('profile_kyc',$user_id);
                             if($checkuser==1){
                                  $path = 'uploads/profile/'.$user_id;
                                 if($this->input->post('h_photo') != ""){
					if($_FILES['photo']['name'] != ''){
						if(is_dir($path)){
							unlink($path.'/'.$this->input->post('h_photo'));
							$photo= str_replace(" ","_",$_FILES["photo"]["name"]);
							move_uploaded_file($_FILES["photo"]["tmp_name"] , $path.'/'.$photo);
						}else{
							mkdir($path);
							$photo= str_replace(" ","_",$_FILES["photo"]["name"]);
							move_uploaded_file($_FILES["photo"]["tmp_name"] , $path.'/'.$photo);
						}
					}else{
						$photo=$this->input->post('h_photo');
					}
				}else{
					if($_FILES['photo']['name'] != ''){
				                if(is_dir($path)){
				                     	 $photo= str_replace(" ","_",$_FILES["photo"]["name"]);
				     	              move_uploaded_file($_FILES["photo"]["tmp_name"] , $path.'/'.$photo);
				                 }else{
					              mkdir($path);
					             $photo= str_replace(" ","_",$_FILES["photo"]["name"]);
					              move_uploaded_file($_FILES["photo"]["tmp_name"] , $path.'/'.$photo);
				                 }
			                 }
				}
                                if($this->input->post('h_pancard') != ""){
					if($_FILES['pancard']['name'] != ''){
						if(is_dir($path)){
							unlink($path.'/'.$this->input->post('h_pancard'));
							$pancard= str_replace(" ","_",$_FILES["pancard"]["name"]);
							move_uploaded_file($_FILES["pancard"]["tmp_name"] , $path.'/'.$pancard);
						}else{
							mkdir($path);
							$pancard= str_replace(" ","_",$_FILES["pancard"]["name"]);
							move_uploaded_file($_FILES["pancard"]["tmp_name"] , $path.'/'.$pancard);
						}
					}else{
						$pancard=$this->input->post('h_pancard');
					}
				}else{
					if($_FILES['pancard']['name'] != ''){
				                if(is_dir($path)){
				                     	 $pancard= str_replace(" ","_",$_FILES["pancard"]["name"]);
				     	              move_uploaded_file($_FILES["pancard"]["tmp_name"] , $path.'/'.$pancard);
				                 }else{
					              mkdir($path);
					             $pancard= str_replace(" ","_",$_FILES["pancard"]["name"]);
					              move_uploaded_file($_FILES["pancard"]["tmp_name"] , $path.'/'.$pancard);
				                 }
			                 }
				}
                                if($this->input->post('h_proof') != ""){
					if($_FILES['proof']['name'] != ''){
						if(is_dir($path)){
							unlink($path.'/'.$this->input->post('h_proof'));
							$proof= str_replace(" ","_",$_FILES["proof"]["name"]);
							move_uploaded_file($_FILES["proof"]["tmp_name"] , $path.'/'.$proof);
						}else{
							mkdir($path);
							$proof= str_replace(" ","_",$_FILES["proof"]["name"]);
							move_uploaded_file($_FILES["proof"]["tmp_name"] , $path.'/'.$proof);
						}
					}else{
						$proof=$this->input->post('h_proof');
					}
				}else{
					if($_FILES['proof']['name'] != ''){
				     if(is_dir($path)){
					 $proof= str_replace(" ","_",$_FILES["proof"]["name"]);
					 move_uploaded_file($_FILES["proof"]["tmp_name"] , $path.'/'.$proof);
				     }else{
					 mkdir($path);
					 $proof= str_replace(" ","_",$_FILES["proof"]["name"]);
					 move_uploaded_file($_FILES["proof"]["tmp_name"] , $path.'/'.$proof);
				     }
			            }
				}
                                 $insert_values = array(
                                    "first_name" => $this->input->post('firstname'),
                                    "middle_name" => $this->input->post('middlename'),
                                    "last_name" => $this->input->post('lastname'),
                                    "mother_name" => $this->input->post('mothername'),
                                    "dob" => $this->input->post('datepickerDemo'),
                                    "gender" => $this->input->post('gender'),
                                    "permanent_address" => $this->input->post('praddress'),
                                    "communication_address" => $this->input->post('comaddress'),
                                    "photo" => $photo,
                                    "pancard" => $pancard,
                                    "resident_proof" => $proof,
                                    "bussiness_type" => $this->input->post('btype'),
                                    "organization_name" => $this->input->post('organizationname'),
                                    "created_date" => date('Y-m-d H:i:s'),
                                    "updated_date" => date('Y-m-d H:i:s')
				);

                                 $savequery=$this->users->update_user_in_profile('profile_kyc',$insert_values,$user_id);

                                    if($savequery){
                                        $this->session->set_flashdata('msg', 'Your KYC data has been updated successfully.');
                                        if($role_id==4){
                                            redirect('user/profile');
                                        }elseif($role_id==6){
                                            redirect('agent/profile');
                                        }
                                    }

                             }else{
                                 $path = 'uploads/profile/'.$user_id;
				if($_FILES['photo']['name'] != ''){
				     if(is_dir($path)){
					 $photo= str_replace(" ","_",$_FILES["photo"]["name"]);
					 move_uploaded_file($_FILES["photo"]["tmp_name"] , $path.'/'.$photo);
				     }else{
					 mkdir($path);
					 $photo= str_replace(" ","_",$_FILES["photo"]["name"]);
					 move_uploaded_file($_FILES["photo"]["tmp_name"] , $path.'/'.$photo);
				     }
			        }else{
                                $photo="";
                                }
                                if($_FILES['pancard']['name'] != ''){
				     if(is_dir($path)){
					 $pancard= str_replace(" ","_",$_FILES["pancard"]["name"]);
					 move_uploaded_file($_FILES["pancard"]["tmp_name"] , $path.'/'.$pancard);
				     }else{
					 mkdir($path);
					 $pancard= str_replace(" ","_",$_FILES["pancard"]["name"]);
					 move_uploaded_file($_FILES["pancard"]["tmp_name"] , $path.'/'.$pancard);
				     }
			        }else{
                                $pancard="";
                                }
                                if($_FILES['proof']['name'] != ''){
				     if(is_dir($path)){
					 $proof= str_replace(" ","_",$_FILES["proof"]["name"]);
					 move_uploaded_file($_FILES["proof"]["tmp_name"] , $path.'/'.$proof);
				     }else{
					 mkdir($path);
					 $proof= str_replace(" ","_",$_FILES["proof"]["name"]);
					 move_uploaded_file($_FILES["proof"]["tmp_name"] , $path.'/'.$proof);
				     }
			        }else{
                                $proof="";
                                }
                                 $insert_values = array(
                                    "User_id"	=>	$user_id,
                                    "first_name" => $this->input->post('firstname'),
                                    "middle_name" => $this->input->post('middlename'),
                                    "last_name" => $this->input->post('lastname'),
                                    "mother_name" => $this->input->post('mothername'),
                                    "dob" => $this->input->post('datepickerDemo'),
                                    "gender" => $this->input->post('gender'),
                                    "permanent_address" => $this->input->post('praddress'),
                                    "communication_address" => $this->input->post('comaddress'),
                                    "photo" => $photo,
                                    "pancard" => $pancard,
                                    "resident_proof" => $proof,
                                    "bussiness_type" => $this->input->post('btype'),
                                    "organization_name" => $this->input->post('organizationname'),
                                    "created_date" => date('Y-m-d H:i:s'),
                                    "updated_date" => date('Y-m-d H:i:s')
				);

                                 if($this->users->insert_user_in_profile('profile_kyc',$insert_values)){
                                     $this->session->set_flashdata('msg', 'Your KYC data has been updated successfully.');
                                     if($role_id==4){
                                            redirect('user/profile');
                                        }elseif($role_id==6){
                                            redirect('agent/profile');
                                        }
                                 }


                             }
                         }

                         if($form_type=='bank'){
                             $checkuser = $this->users->getuserin_profile('profile_bank_details',$user_id);
                             if($checkuser==1){
                                 $insert_values = array(
                                    "acc_holder_name" => $this->input->post('holdername'),
                                    "acc_type" => $this->input->post('accounttype'),
                                    "account_select" => $this->input->post('accountselect'),
                                    "branch_name" => $this->input->post('branchname'),
                                    "bank_name" => $this->input->post('bankname'),
                                    "acc_number" => $this->input->post('accountno'),
                                    "ifsc_code" => $this->input->post('ifsccode'),
                                    "created_date" => date('Y-m-d H:i:s'),
                                    "updated_date" => date('Y-m-d H:i:s')
				);

                                 $savequery=$this->users->update_user_in_profile('profile_bank_details',$insert_values,$user_id);

                                    if($savequery){
                                        $this->session->set_flashdata('msg', 'Your Bank Details data has been updated successfully');
                                        if($role_id==4){
                                            redirect('user/profile');
                                        }elseif($role_id==6){
                                            redirect('agent/profile');
                                        }
                                    }

                             }else{
                                 $insert_values = array(
                                    "User_id"	=>	$user_id,
                                    "acc_holder_name" => $this->input->post('holdername'),
                                    "acc_type" => $this->input->post('accounttype'),
                                    "account_select" => $this->input->post('accountselect'),
                                    "branch_name" => $this->input->post('branchname'),
                                    "bank_name" => $this->input->post('bankname'),
                                    "acc_number" => $this->input->post('accountno'),
                                    "ifsc_code" => $this->input->post('ifsccode'),
                                    "created_date" => date('Y-m-d H:i:s'),
                                    "updated_date" => date('Y-m-d H:i:s')
				);

                                 if($this->users->insert_user_in_profile('profile_bank_details',$insert_values)){
                                     $this->session->set_flashdata('msg', 'Your Bank Details data has been updated successfully.');
                                     if($role_id==4){
                                            redirect('user/profile');
                                        }elseif($role_id==6){
                                            redirect('agent/profile');
                                        }
                                 }
                             }
                         }




                    /*}elseif($role_id==6){

                        if($form_type=='profile'){
                             $checkuser = $this->users->getuserin_profile('profile',$user_id);
                             //print_r($checkuser);exit;
                             if($checkuser==1){
                                 $insert_values = array(
                                        "Name" => $this->input->post('fullname'),
                                        "Company_Name" => $this->input->post('companyname'),
                                        "Address" => $this->input->post('address'),
                                        "City" => $this->input->post('city'),
                                        "Postal_code" => $this->input->post('postalcode')
                                    );

                                    $savequery=$this->users->update_user_in_profile($insert_values,$user_id);

                                    if($savequery){
                                        $this->session->set_flashdata('msg', 'Profile updated successfully');
                                        redirect('agent/profile');
                                    }

                             }else{
                                    $insert_values = array(
                                    "User_id"	=>	$user_id,
                                    "Name" => $this->input->post('fullname'),
                                    "Company_Name" => $this->input->post('companyname'),
                                    "Address" => $this->input->post('address'),
                                    "City" => $this->input->post('city'),
                                    "Postal_code" => $this->input->post('postalcode')
				);
                                 if($this->users->insert_user_in_profile($insert_values)){
                                     $this->session->set_flashdata('msg', 'Profile updated successfully');
                                     redirect('agent/profile');
                                 }
                             }
                         }

                    }*/



                }

        }



	public function isCachBackCodeAvailable()
	{
		$cashback_code = $this->input->post('cachback_code');
		$role_id = $this->session->userdata('role_id');
		$role_name = $this->cashback_model->getRoleNameByRoleId($role_id);
		$details = $this->cashback_model->getCashBackCodeDetails($cashback_code);
		$field = 'cbk_is'.$role_name;
		if($details[0]->$field)
		{
			echo 'success';
			exit;
		}
		else
		{
			echo 'failure';
			exit;
		}
	}










}



