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
	
	public function offers() {
		
		$data['category'] = $this->Cat->get_category();
		
		
		
		 $usertypes = $this->users->checkUserTypeLaabus($this->session->userdata('user_id'));
				 $agent_id = $usertypes[0]->agent_id;
				// print_r($usertypes);
				if(empty($agent_id))
				{
					$role_id = 4;
				}
				else
				{
					$role_id =44;
				}
				
				
		$data1['offers'] = $this->users->getoffers($role_id);		
		$data1['offerswallet'] = $this->users->getofferswalletusers($role_id);		
		//print_r($data1['offers']);	
	   $this->load->view('website_template/header', $data);
	   $this->load->view('website/user/offers',$data1);
	   $this->load->view('website_template/footer');
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
			 $data['user_info'] = $this->users->get_user_info_only('users', $user_id);

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
                   // $data1['walletlist'] = json_encode($walletlist);
				    $data1['walletlist'] = $walletlist;
                    $role_id=$this->session->userdata('role_id');
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/user/wallet_list',$data1);
                    $this->load->view('website_template/footer');
                }
	}
	
	public function walletuserview() {
            //print_r($this->session->userdata());
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		$id = $this->uri->segment('3');
                if(!check_login_status()){
                    redirect('login');
                }else{
                
                    $role_id=$this->session->userdata('role_id');
					$userlist = $this->users->walletuserview($id);
                    $data1['userlist'] = $userlist;	
					//print_r($data1['userlist']);
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/user/walletuserview',$data1);
                    $this->load->view('website_template/footer');
                }
	}
	
	
	////13042016
	public function wallet_withdraw_otp() {
		
		 if($this->session->userdata('OTPERROR') )
		 {
			 
		 }
		 else
		 {
		 $withdraw['withdraw_otp'] = $_REQUEST;
		 //$withdraw['otp'] = 
		 $otp = rand(100000,999999);
		 $withdraw['otp'] = $otp;
		 $this->session->set_userdata($withdraw);
		 
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



	$mobile = $this->session->userdata('Mobile');
	$name = $this->session->userdata('name');	
    //$amount=$this->session->userdata('rcAmount');
	
	

	
	//echo $mobile."::".$_POST['amount']."::".$totamount;//exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
  $message = 'Dear '.$name.', OTP for transaction varini info systems pvt ltd is '.$otp.' on www.laabus.com';
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
	
	//var_dump($return_val);
		 }
								//SMD
								
				$email_id = $this->session->userdata('email_id');
                $_data['user'] = $this->users->get_user($email_id)->row();
                $this->load->view('website_template/header', $data);
                $this->load->view('website/user/wallet_withdraw_otp', $_data);
                $this->load->view('website_template/footer');
								
	
								
	}
	
	
	public function wallet_withdraw() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
			
				if($this->session->userdata('otp'))
		{
			if($this->session->userdata('otp') != $_REQUEST['txtotp'] )
			{
				$this->session->set_userdata('OTPERROR',1);
				redirect("user/wallet_withdraw_otp");
			}
			else
			{
				//print("<pre>");
				//print_r($this->session->userdata());
				/*echo "++<br>";
				print_r($_REQUEST);			*/
				///
				$withdraw_otp = $this->session->userdata('withdraw_otp');
				//echo "XXX";
				//print_r($withdraw_otp);
				$amount = $withdraw_otp['amount'];
				//exit;
				$user_id = $this->session->userdata('user_id');
                $withdraw_otp = $this->session->userdata('withdraw_otp');
                $arrayData = array(
                    'user_id' => $user_id,
                    'amount' => $withdraw_otp['amount'],
                    'account_number' => $withdraw_otp['account_number'],
                    'account_name' => $withdraw_otp['account_name'],
                    'bank_name' => $withdraw_otp['bank_name'],
                    'ifsc_code' => $withdraw_otp['ifsc_code'],
                    'create_dt' => date("Y-m-d H:i:s")
                );                
                $wallet_withdraw = $this->common_model->commonInsert("wallet_withdraw", $arrayData);
                $result = $this->common_model->raw_query("update users set wallet = wallet -  $amount where user_id = $user_id");
				
				
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



	$mobile = $this->session->userdata('Mobile');
	$name = $this->session->userdata('name');	
    //$amount=$this->session->userdata('rcAmount');
	
	$amount = $withdraw_otp['amount'];
	$user_id=$this->session->userdata('user_id');
$role_id=$this->session->userdata('role_id');
$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
$tot_W_a = $wallet_amount-$amount;
	
	//echo $mobile."::".$_POST['amount']."::".$totamount;//exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
  $message = 'Dear '.$name.', Your withdraw INR  '.$amount.'. from www.laabus.com Your net Wallet Amount is '.$tot_W_a.'. download  app @ https://goo.gl/QWUiJB';
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
	
	//var_dump($return_val);
	//alert to admin
	//$message = 'Dear '.$name.', Your withdraw INR  '.$amount.'. from www.laabus.com Your net Wallet Amount is '.$tot_W_a.'. download  app @ https://goo.gl/QWUiJB';
	$message = 'Dear Admin, '.$name.' withdraw INR  '.$amount.'. from www.laabus.com.please review it.';
	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$mobile = '9989624611';
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

								//SMD
								
				unset($_SESSION['OTPERROR']);
				unset($_SESSION['otp']);
				$this->session->unset_userdata('OTPERROR');				
				$this->session->unset_userdata('otp');
                redirect('user/success/wallet_withdraw');
				///				
				exit;
			}
			
		}
		
		
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
        
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            if ($this->input->post('amount')) {
				 echo "Testing..";
				 //print_r($this->session->userdata());
				 
				 
				 //check  whether User as Direct User OR Under Agent User
				 $usertypes = $this->users->checkUserTypeLaabus($this->session->userdata('user_id'));
				 $agent_id = $usertypes[0]->agent_id;
				// print_r($usertypes);
				if(empty($agent_id))
				{
					$role_id = 4;
				}
				else
				{
					$role_id =44;
				}
				
				//check whethere user gets Joining offer or not.
				$dataJoinOffers = $this->users->getjoiningoffersWalletDetailsPromoCode($role_id,$this->input->post('promo_code'));				
				//end check whethere user gets Joining offer or not.
				
				//check whethere user gets Wallet offer or not.
				$dataWalletOffers1 = $this->users->getwalletoffersWalletDetailsPromoCode($role_id,$this->input->post('promo_code'),$this->input->post('amount'),'exact');
				$dataWalletOffers2 = $this->users->getwalletoffersWalletDetailsPromoCode($role_id,$this->input->post('promo_code'),$this->input->post('amount'),'upto');
				
				//print_r($dataWalletOffers1);
				//echo "++++<br>";
				//print_r($dataWalletOffers2);exit;
				//end check whethere user gets Wallet offer or not.
				//exit;
				 
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
					$totamount = $this->input->post('amount');
					if(!empty($dataJoinOffers))
					{
						 echo "11111";
						if( $this->input->post('amount') >= $dataJoinOffers[0]->min_wallet_amoun )
						{
						
							$totamount = $this->input->post('amount')+ $dataJoinOffers[0]->offer_amount;						
						//update users table by making joining offers amount ot 1 measn its used.
						 $updates_status = $this->users->update_joing_offer_min_wallet($user_id,$this->input->post('promo_code'),$dataJoinOffers[0]->offer_amount,2);
						}
					}
					else if ( !empty($dataWalletOffers1))
					{
						echo "222222";
						if( $dataWalletOffers1[0]->offer_mode == "INR")
						{
							$totamount = $this->input->post('amount')+ $dataWalletOffers1[0]->add_amount;
							$updates_status = $this->users->update_wallet_offer_min_wallet($user_id,$this->input->post('promo_code'),$dataWalletOffers1[0]->add_amount,1);
						}
						else if( $dataWalletOffers1[0]->offer_mode == "PEC")
						{
							$extra_amt = $this->input->post('amount')*$dataWalletOffers1[0]->add_amount/100;
							$totamount = $this->input->post('amount')+ $extra_amt;
							$updates_status = $this->users->update_wallet_offer_min_wallet($user_id,$this->input->post('promo_code'),$extra_amt,1);
						}
						else
						{
							
						}
					}
					else if ( !empty($dataWalletOffers2))
					{
						//echo "333333";//						
						//print_r($dataWalletOffers1[0]);
						if( $dataWalletOffers2[0]->offer_mode == "INR")
						{
							$totamount = $this->input->post('amount')+ $dataWalletOffers2[0]->add_amount;
							$updates_status = $this->users->update_wallet_offer_min_wallet($user_id,$this->input->post('promo_code'),$dataWalletOffers2[0]->add_amount,1);
						}
						else if( $dataWalletOffers1[0]->offer_mode == "PEC")
						{
							$extra_amt = $this->input->post('amount')*$dataWalletOffers2[0]->add_amount/100;
							$totamount = $this->input->post('amount')+ $extra_amt;
							$updates_status = $this->users->update_wallet_offer_min_wallet($user_id,$this->input->post('promo_code'),$extra_amt,1);
						}
						else
						{
							
						}
					}
					else
					{
						
					}
					//exit('at the end Here');
                    $arrayData = array(
                        'user_id' => $user_id,
                        'role_id' => $role_id,
                        //'amount' => $this->input->post('amount'),
						'amount' => $totamount,
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



	$mobile = $this->session->userdata('Mobile');
	$name = $this->session->userdata('name');	
    //$amount=$this->session->userdata('rcAmount');
	
	
	$user_id=$this->session->userdata('user_id');
$role_id=$this->session->userdata('role_id');
$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
$tot_W_a = $wallet_amount+$totamount;
	
	//echo $mobile."::".$_POST['amount']."::".$totamount;//exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
  $message = 'Dear '.$name.', Your Wallet is filled with INR '.$totamount.'. Your net Wallet Amount is '.$tot_W_a.'. thank you for using w LAABUS . download  app @ https://goo.gl/QWUiJ';
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
	
	//var_dump($return_val);
	
	//alert to ADMIN
	$mobile = '9989624611';
	//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$totamount.'. Your net Wallet Amount is '.$tot_W_a.'. thank you for using w LAABUS . download  app @ https://goo.gl/QWUiJ';
	$message = 'Dear Admin, '.$name.' deposits INR  '.$totamount.' in his Wallet from www.laabus.com.please review it.';
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
	
	//var_dump($return_val);

								//SMD
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
	
	public function check_promocode() {
		
		 //check  whether User as Direct User OR Under Agent User
				 $usertypes = $this->users->checkUserTypeLaabus($this->session->userdata('user_id'));
				 $agent_id = $usertypes[0]->agent_id;
				// print_r($usertypes);
				if(empty($agent_id))
				{
					$role_id = 4;
				}
				else
				{
					$role_id =44;
				}
		$data = $this->users->check_promocode($_REQUEST['promo_code'],$_REQUEST['amount'],$role_id);
		echo $data;
		exit;
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
