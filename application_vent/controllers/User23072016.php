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
        //$this->load->model(array('common_model'));
		$this->load->model(array('common_model','Va_Commisions_model','categories_model','Sub_categories_model'));
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
					$role_id=$this->session->userdata('role_id');
                    $walletlist= $this->users->get_wallet_list($user_id,$role_id);
                    $data1['walletlist'] = json_encode($walletlist);
                    $role_id=$this->session->userdata('role_id');
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/user/wallet_list',$data1);
                    $this->load->view('website_template/footer');
                }
	}
	
	
	public function wallet_withdraw() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            if ($this->input->post('amount')) {
                $user_id = $this->session->userdata('user_id');
                $amount = $this->input->post('amount');
                $arrayData = array(
                    'user_id' => $user_id,
                    'amount' => $amount,
                    'account_number' => $this->input->post('account_number'),
                    'account_name' => $this->input->post('account_name'),
                    'bank_name' => $this->input->post('bank_name'),
                    'ifsc_code' => $this->input->post('ifsc_code'),
                    'create_dt' => date("Y-m-d H:i:s")
                );                
                $wallet_withdraw = $this->common_model->commonInsert("wallet_withdraw", $arrayData);
                $result = $this->common_model->raw_query("update users set wallet = wallet -  $amount where user_id = $user_id");
                redirect('user/success/wallet_withdraw');
            } else {
                $email_id = $this->session->userdata('email_id');
                $_data['user'] = $this->users->get_user($email_id)->row();
                $this->load->view('website_template/header', $data);
                $this->load->view('website/user/wallet_withdraw', $_data);
                $this->load->view('website_template/footer');
            }
        }
    }
	
	 public function success($type = 0) {
        $data1['category'] = $this->Cat->get_category();
        $data1['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $this->load->view('website_template/header', $data1);
            $data['type'] = $type;
            $this->load->view('website/user/success', $data);
            $this->load->view('website_template/footer');
        }
    }

  public function add_funds_before() {
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
	
	
	public function add_funds() {
        // print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            if ($this->input->post('amount')) {
                $role_id = $this->session->userdata('role_id');
                $user_id = $this->session->userdata('user_id');
                $arrayData = array(
                    'user_id' => $user_id,
                    'total_amount' => $this->input->post('amount'),
                    'information' => json_encode(array('user_id' => $user_id, 'total_amount' => $this->input->post('amount'), 'transaction_status_id' => 1, 'shipping_method_id' => 1, 'transaction_stage_time' => date("Y-m-d H:i:s"))),
                    'transaction_status_id' => 1,
                    'shipping_method_id' => 1,
                    'transaction_stage_time' => date("Y-m-d H:i:s")
                );
                $sales_id = $this->common_model->commonInsert("va_sales_order", $arrayData);
                $userdetails = $this->users->get_user_details($user_id, $role_id);
                $sessDataArr = array(
                    'name' => $userdetails['name'],
                    'email' => $userdetails['email_id'],
                    'phone' => $userdetails['mobile'],
                    'amount' => $this->input->post('amount')
                );
                $this->session->set_userdata($sessDataArr);
                if ($this->input->post('ptype') == 1) {
					
					//print_r($_POST);
                    $arrayData = array(
                        'user_id' => $user_id,
                        'role_id' => $role_id,
                        'amount' => $this->input->post('amount'),
                        'reference_number' => $this->input->post('reference_number'),
                        'transfer_type' => $this->input->post('ttype'),
                        'account_name' => $this->input->post('account_name'),
                        'bank_name' => $this->input->post('bank_name'),
                        'payment_status' => 0,
                        'payment_mode' => 1,
                        'credit_debit' => 2,
                        'create_dt' => date("Y-m-d H:i:s")
                    );
                    if ($this->input->post('ttype') == 1) {
                        $arrayData['account_number'] = $this->input->post('account_number');
                    } else {
                        $config['upload_path'] = './adminnew/uploads/';
                        $config['file_name'] = '1';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $this->load->library('upload', $config);
                        $this->upload->do_upload('counter_file');
                        $arrayData['counter_file'] = $this->upload->data()['file_name'];
                    }
                    $wallet = $this->common_model->commonInsert("wallet_history", $arrayData);
                    redirect('user/addfundsuccess/ptype');
                } else {
                    redirect('Payment/addfundspayment?txnid=' . $sales_id);
                }
            } else {
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
	
	
	public function Orders() {
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$user_id=$this->session->userdata('user_id');
		
		//echo "<br>";
		//print_r($_REQUEST);
		
		
		$search_params["end_user_id"] = $user_id;
		if( isset($_REQUEST["search"]) )
		{
			
			if(!empty($_REQUEST["st_date"]))
			{
				$st_date = explode("/",$_REQUEST["st_date"]);
				$search_params["st_date"] = $st_date[2]."-".$st_date[0]."-".$st_date[1];
			}
			if(!empty($_REQUEST["end_date"]))
			{
				$end_date = explode("/",$_REQUEST["end_date"]);
				$search_params["end_date"] = $end_date[2]."-".$end_date[0]."-".$end_date[1];
			}
			if(!empty($_REQUEST["agent_id"]))
			{
				//$search_params["agent_id"] = $_REQUEST["agent_id"];
			}
			if(!empty($_REQUEST["cnl_part"]))
			{
				$search_params["cnl_part"] = $_REQUEST["cnl_part"];
			}
			if(!empty($_REQUEST["cat_id"]))
			{
				$search_params["cat_id"] = $_REQUEST["cat_id"];
			}
			if(!empty($_REQUEST["sub_cat"]))
			{
				$search_params["sub_cat"] = implode(",",$_REQUEST["sub_cat"]);
			}
			
			
			
		}
		$data1['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();		
		$data1['categories'] = $this->categories_model->list_all_categories();
		$data1['agents'] = $this->categories_model->list_all_users(6);
		$data1['ch_partners'] = $this->categories_model->list_all_users(2);
		$data1['order_details'] = $this->Va_Commisions_model->order_details_user($search_params);

		 $this->load->view('website_template/header', $data);
	   $this->load->view('website/user/orders',$data1);
	   $this->load->view('website_template/footer');
	}
	
	public function populat_sub_cat_search() {
		
		$sub_cat = $this->Sub_categories_model->get_subcategory($_REQUEST['catid']);
		$data = '';
		if(!empty($sub_cat))
		{
			foreach($sub_cat as $key=>$value)
			{
				$data .= '<div  class="sub_cat_dis"><input type="checkbox" class="chksubcat" name="sub_cat[]" value='.$value->sub_cat_id.'>'.$value->sub_cat_name.' </div>';
			}
		}
		echo $data;
		exit;		
    }

}
