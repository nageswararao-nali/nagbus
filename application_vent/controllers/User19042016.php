<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Category_model', 'Cat', TRUE);
        $this->load->model('users_model', 'users', TRUE);
        $this->load->model(array('common_model'));
    }

    public function profile() {

        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $data['folder'] = '';
        $data['body'] = 'index';
        $data['country'] = $this->users->get_country();

        $user_id = $this->session->userdata('user_id');

        if (!check_login_status()) {
            redirect('login');
        } else {

            $data['profile_info'] = $this->users->get_userprofile_info('profile', $user_id);
            $data['kyc_info'] = $this->users->get_userprofile_info('profile_kyc', $user_id);
            $data['bank_info'] = $this->users->get_userprofile_info('profile_bank_details', $user_id);

            if (!$this->input->is_ajax_request()) {
                $this->load->view('website_template/header', $data);
                $this->load->view('website/user/profile', $data);
                $this->load->view('website_template/footer');
            } else {
                $this->load->view('website/user/profile', $data);
            }
        }
    }

    public function dashboard() {
            #print_r($this->session->userdata());exit;
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!check_login_status()){
                    redirect('login');
                }else{
                    
                    $role_id=$this->session->userdata('role_id');
                    $user_id=$this->session->userdata('user_id');
                    $orders=$this->common_model->commonOrders($user_id);
                    $data['orders']=json_encode($orders);
                    if(!$this->input->is_ajax_request()) {
                        $this->load->view('website_template/header', $data);
                        $this->load->view('website/user/dashboard',$data);
                        $this->load->view('website_template/footer');
                    }else{
                        $this->load->view('website/user/dashboard',$data);
                    }
                    
                }
	}

    public function change_profile() {
        // print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {

            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/user/change_profile');
            $this->load->view('website_template/footer');
        }
    }
    public function wallet_list() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!check_login_status()){
                    redirect('login');
                }else{
                    $user_id=$this->session->userdata('user_id');
                    $walletlist= $this->users->get_wallet_list($user_id);
                    $data1['walletlist'] = json_encode($walletlist);
                    $role_id=$this->session->userdata('role_id');
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/user/wallet_list',$data1);
                    $this->load->view('website_template/footer');
                }
	}

    public function add_funds() {
        // print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            if($this->input->post('amount')){
                $role_id = $this->session->userdata('role_id');
                $user_id = $this->session->userdata('user_id');
                $arrayData=array(
					'user_id'=>$user_id,
					'total_amount'=>$this->input->post('amount'),
					'information'=>json_encode(array('user_id'=>$user_id,'total_amount'=>$this->input->post('amount'),'transaction_status_id'=>1,'shipping_method_id'=>1,'transaction_stage_time'=>date("Y-m-d H:i:s"))),
					'transaction_status_id'=>1,
					'shipping_method_id'=>1,
					'transaction_stage_time'=>date("Y-m-d H:i:s")
				);
				$sales_id=$this->common_model->commonInsert("va_sales_order",$arrayData);
                $userdetails = $this->users->get_user_details($user_id,$role_id);
				$sessDataArr=array(
					'name'=> $userdetails['name'],
					'email'=> $userdetails['email_id'],
					'phone'=> $userdetails['mobile'],
					'amount'=> $this->input->post('amount')
				);
				$this->session->set_userdata($sessDataArr);
                                /*if($this->input->post('ptype')==1){
		                      $arrayData=array(
			                   'user_id'=>$user_id,
			                   'role_id'=>$role_id,
			                   'amount'=>$this->input->post('amount'),
			                   'reference_number'=>$this->input->post('ref_number'),
			                   'payment_status'=>1,
			                   'payment_mode'=>1,  
			                   'credit_debit'=>2,  
			                   'create_dt'=>date("Y-m-d H:i:s")
		                       );
		                       $wallet=$this->common_model->commonInsert("wallet_history",$arrayData);
                                       redirect('user/addfundsuccess/ptype');
                                }else{*/
				    redirect('Payment/addfundspayment?txnid='.$sales_id);
                               /* }*/
            }else{
                $role_id = $this->session->userdata('role_id');
                $this->load->view('website_template/header', $data);
                $this->load->view('website/user/add_funds');
                $this->load->view('website_template/footer');
            }
        }
    }
    public function addfundsuccess($ptype=NULL){
        $data1['category'] = $this->Cat->get_category();
        $data1['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
			$role_id = $this->session->userdata('role_id');
			$this->load->view('website_template/header', $data1);
                        $data['type'] = ($ptype!=NULL)?1:0;
			$this->load->view('website/user/addfundsuccess',$data);
            $this->load->view('website_template/footer');
		}
    }
    public function addfundfail(){
        $data1['category'] = $this->Cat->get_category();
        $data1['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
			$role_id = $this->session->userdata('role_id');
			$this->load->view('website_template/header', $data1);
			$this->load->view('website/user/addfundsfailure');
            $this->load->view('website_template/footer');
		}
    }	
    public function change_password() {
        // print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {

            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/user/change_password');
            $this->load->view('website_template/footer');
        }
    }

}
