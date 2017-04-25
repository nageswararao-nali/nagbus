<?php
require_once APPPATH.'libraries/Payu.php';
require_once APPPATH.'libraries/Transaction_stages.php';
class Payment extends CI_Controller{
	function __construct($callParent=true){
		if($callParent){
			parent::__construct();
			$this->load->model('users_model', 'users', TRUE);
	                $this->load->model(array('common_model'));
		}
		
	}
	
	function agent_subscription_payu(){
		$invoice_id = $this->input->get_post('txnid');
		//proceed to payment gateway code here
		
			$obj = new Payu();
			
			$obj->setTransactionid($invoice_id);			
			//$obj->setAmount($this->session->userdata('payable_amount'));
			//$obj->setConsumerName($this->session->userdata('name'));
			//$obj->setPhoneNumber($this->session->userdata('Mobile'));
			//$obj->setEmail($this->session->userdata('email'));
			$obj->setAmount($this->input->get_post('amount'));
			/*$obj->setConsumerName('Venkat');
			$obj->setPhoneNumber('9177531066');
			$obj->setEmail('piridi.venkat@gmail.com');*/
			$productInfo = "Subscription  with LAABUS";
			$obj->setProductInfo($productInfo);
			$obj->setServerMode('live');
			$obj->setSuccess_url(base_url()."Payment/subscription_success");
			$obj->setFailure_url(base_url()."Payment/subscription_failure");
			$obj->generateHash();
			$stage =new Transaction_stages();
			$stage->second_stage();
			$stage->update_transaction_status($invoice_id);
			$obj->goto_collect_money();
			
		
	}
	
	
	function index(){
		$invoice_id = $this->input->get_post('txnid');
		//proceed to payment gateway code here
		if(check_login_status()){
			$obj = new Payu();
			
			$obj->setTransactionid($invoice_id);
			
			
			if( isset($_REQUEST["op"]) && $_REQUEST["op"] == "bus" )
		{
			$obj->setAmount($_GET['amount']);
		}
		else
		{
			$obj->setAmount($this->session->userdata('payable_amount'));
		}
			
			
			$obj->setConsumerName($this->session->userdata('name'));
			$obj->setPhoneNumber($this->session->userdata('Mobile'));
			$obj->setEmail($this->session->userdata('email'));
			$productInfo = "Recharge for Mobile Number ".$this->session->userdata('mobile_no')." the operator name is" .$this->session->userdata('operator_name'). " with amount ".$this->session->userdata('rcAmount')."";
			$obj->setProductInfo($productInfo);
			$obj->setServerMode('test');
			$obj->setSuccess_url(base_url()."Payment/payment_success");
			$obj->setFailure_url(base_url()."Payment/payment_failure");
			$obj->generateHash();
			$stage =new Transaction_stages();
			$stage->second_stage();
			$stage->update_transaction_status($invoice_id);
			$obj->goto_collect_money();
			
		}else "Not logged";
	}
	
	public function addfundspayment(){
		$invoice_id = $this->input->get_post('txnid');
		//proceed to payment gateway code here.
		//redirect payment succees or failure page
		//redirect payment succees or failure page
		if(check_login_status()){
			$obj = new Payu();			
			$obj->setTransactionid($invoice_id);			
			$obj->setAmount($this->session->userdata('amount'));
			$obj->setConsumerName($this->session->userdata('name'));
			$obj->setPhoneNumber($this->session->userdata('phone'));
			$obj->setEmail($this->session->userdata('email'));
			$productInfo = "Add funds amount ".$this->session->userdata('amount')." to wallet";
			$obj->setProductInfo($productInfo);
			$obj->setServerMode('test');
			$obj->setSuccess_url(base_url()."Payment/fundpayment_success");
			$obj->setFailure_url(base_url()."Payment/fundpayment_failure");
			$obj->generateHash();
			$stage =new Transaction_stages();
			$stage->second_stage();
			$stage->update_transaction_status($invoice_id);
			$obj->goto_collect_money();
			
		}else "Not logged";
	}
        function fundpayment_failure(){
                $role_id = $this->session->userdata('role_id');
                if($role_id == 4){
                    redirect('user/addfundfail');
                }
                if($role_id == 6){
                    redirect('agent/addfundfail');
                }
		
	}
	
	function fundpayment_success($redirection = true){
		if(!$redirection){
			$ci = get_instance();
			$ci->load->model('users_model', 'users', TRUE);
            		$ci->load->model(array('common_model'));
            		$amount =  $ci->session->userdata('amount');
		}else{
			$ci = $this;
            		$amount = $_POST['amount'];
		}
		$amount = $this->session->userdata('atom_amount');
		$promo_code = $this->session->userdata('promo_code');
					
		$obj = new Transaction_stages();
		$obj->tenth_stage();
		$user_id = $ci->session->userdata('user_id');
		$role_id = $ci->session->userdata('role_id');
		$obj->update_transaction_finished($_POST['txnid']);
		$userdetails = $ci->users->get_user_details($user_id,$role_id);
		
		//PROMO IF ANY
		 $role_id = $ci->session->userdata('role_id');
         $user_id = $ci->session->userdata('user_id');
		 //$promo_code = $ci->session->userdata('promo_code_payu');
		 $promo_code = $this->session->userdata('promo_code');
		//check whethere user gets Joining offer or not.
		$dataJoinOffers = $ci->users->getjoiningoffersWalletDetailsPromoCode($role_id,$promo_code);
		$totamount = $amount;
		
				//check whethere user gets Wallet offer or not.
				$dataWalletOffers1 = $ci->users->getwalletoffersWalletDetailsPromoCode($role_id,$promo_code,$totamount,'exact');
				$dataWalletOffers2 = $ci->users->getwalletoffersWalletDetailsPromoCode($role_id,$promo_code,$totamount,'upto');
				//end check whethere user gets Wallet offer or not.
		if(!empty($dataJoinOffers))
		{
			
			if( $amount >= $dataJoinOffers[0]->min_wallet_amoun )
			{
			
				$totamount = $totamount + $dataJoinOffers[0]->offer_amount;						
			//update users table by making joining offers amount ot 1 measn its used.
			 $updates_status = $ci->users->update_joing_offer_min_wallet($user_id,$promo_code,$dataJoinOffers[0]->offer_amount,2);
			 $ci->session->unset_userdata('promo_code_payu');
			}
		}
		else if ( !empty($dataWalletOffers1))
					{
						if( $dataWalletOffers1[0]->offer_mode == "INR")
						{
							$totamount = $totamount+ $dataWalletOffers1[0]->add_amount;
							$updates_status = $ci->users->update_wallet_offer_min_wallet($user_id,$promo_code,$dataWalletOffers1[0]->add_amount,1);
							 $ci->session->unset_userdata('promo_code_payu');
						}
						else if( $dataWalletOffers1[0]->offer_mode == "PEC")
						{
							$extra_amt = $totamount*$dataWalletOffers1[0]->add_amount/100;
							$totamount = $totamount+ $extra_amt;
							$updates_status = $ci->users->update_wallet_offer_min_wallet($user_id,$promo_code,$extra_amt,1);
							 $ci->session->unset_userdata('promo_code_payu');
						}
						else
						{
							
						}
					}
					else if ( !empty($dataWalletOffers2))
					{
						if( $dataWalletOffers1[0]->offer_mode == "INR")
						{
							$totamount = $totamount+ $dataWalletOffers1[0]->add_amount;
							$updates_status = $ci->users->update_wallet_offer_min_wallet($user_id,$promo_code,$dataWalletOffers1[0]->add_amount,1);
							 $ci->session->unset_userdata('promo_code_payu');
						}
						else if( $dataWalletOffers1[0]->offer_mode == "PEC")
						{
							$extra_amt = $totamount*$dataWalletOffers1[0]->add_amount/100;
							$totamount = $totamount+ $extra_amt;
							$updates_status = $ci->users->update_wallet_offer_min_wallet($user_id,$promo_code,$extra_amt,1);
							 $ci->session->unset_userdata('promo_code_payu');
						}
						else
						{
							
						}
					}
					else
					{
						
					}
		//END PROMO IF ANY
		$wamt = $amount+$userdetails['wallet'];
		$whereCondition1=array('user_id'=>$user_id);
		$updateArrayData=array('wallet'=>$wamt);
		$ci->common_model->commonUpdate('users',$updateArrayData,$whereCondition1);
		
		//channel partner commision updating to database
		if($ci->session->userdata('channel_part_userid')){
			$userdetailsC = $ci->users->get_user_details($ci->session->userdata('channel_part_userid'),2);
			print_r($userdetailsC);
			echo $wamtC = $ci->session->userdata('channel_part_comm')+$userdetailsC['wallet'];
			print_r($ci->session->all_userdata());die;
			$whereConditionC1=array('user_id'=>$ci->session->userdata('channel_part_userid'));
			$updateArrayDataC=array('wallet'=>$wamtC);
			$ci->common_model->commonUpdate('users',$updateArrayDataC,$whereConditionC1);
		}	
		//
		$arrayData=array(
			'user_id'=>$user_id,
			'role_id'=>$role_id,
			//'amount'=>$amount,
			'amount'=>$totamount,
			'payment_status'=>2,
			'payment_mode'=>2,  
			'credit_debit'=>1,                               
			'create_dt'=>date("Y-m-d H:i:s")
		);
		$wallet=$ci->common_model->commonInsert("wallet_history",$arrayData);
		
		
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



	$mobile = $ci->session->userdata('Mobile');
	$name = $ci->session->userdata('name');	
    //$amount=$this->session->userdata('rcAmount');
	
	
	$user_id=$ci->session->userdata('user_id');
$role_id=$ci->session->userdata('role_id');
$wallet_amount = $ci->users->get_wallet_amount($user_id,$role_id);
$tot_W_a = $wallet_amount+$totamount;
	
	//echo $mobile."::".$amount."::".$totamount;//exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$amount.'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
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

								//SMD
	if($redirection){
		    if($role_id == 4){
                redirect('user/addfundsuccess');
            }
            if($role_id == 6){
                redirect('agent/addfundsuccess');
            }
		}else{
		    return true;	
		}
                
	}
	function payment_failure(){
		$obj = new Transaction_stages();
		$obj->eighth_stage();
		$obj->update_transaction_status();
		//print_r($_POST);
		//echo "Failed";
		redirect('/');
	}
	function subscription_failure(){
		$obj = new Transaction_stages();
		$obj->eighth_stage();
		$obj->update_transaction_status();
		//print_r($_POST);
		//echo "Failed";
		redirect('/');
	}
	
	function subscription_success()
	{
		$wallet_amount = $this->users->update_agent_subscription_payu($_REQUEST['txnid']);
		redirect('welcome/done');
		$obj = new Transaction_stages();
		$obj->tenth_stage();
		$obj->update_transaction_finished($_POST['txnid']);            
	}
	
	function payment_success(){
		$obj = new Transaction_stages();
		$obj->tenth_stage();
		//$obj->update_transaction_finished($_POST['txnid']);
		$obj->update_transaction_finished($this->session->userdata('txnid'));
               // $this->recharge_success($_POST);
			   
			   $this->recharge_success_new($_POST);
		#print_r($_POST);exit;
		#echo "Success";
	}
        function wallet_recharge($txn_id, $redirection = true){
//			echo "Debugging...";
//			print_r($this->session->userdata());
//			exit;
			
			/*echo "+++++++++++++++++++++";
			echo $this->session->userdata('recharge_type');
			echo "<br>";
			echo $this->session->userdata('postpaid_acc_no');
			echo "<br>";
			exit;*/
                $uid=_UID;
                $pin=_PIN;
                $domain=_DOMAIN;
		if(!$redirection){
			$ci = get_instance();
			$ci->load->model('users_model', 'users', TRUE);
	                $ci->load->model(array('common_model'));
		}else{
			$ci = $this;
		}
                $mobile=$ci->session->userdata('mobile_no');
                $amount=$ci->session->userdata('rcAmount');
                $returnTxnId=$txn_id;
                $txnid=base64_encode($txn_id);
                $operator=$ci->session->userdata('operator');
                
				$usertx  = rand(10000,99999)."_".time();
				//$pin = "7109";	
				
				//echo "PIN:".$pin;
				
				//$temp_var = rand(1000000,9999999);
				//$uid = $uid.$temp_var;
				
				$uid = "766172696e69696e666f";
				
				$pin_array[1] = "e3564cdb9877b9ac1b87c74bc41d41c2";
				$pin_array[2] = "dc4a5ba7e2d23d82c5d772e893d3c859";
				$pin_array[3] = "d488df20cc13eb1c78598e1f4590781e";
				$pin_array[4] = "c0443ab7d99cf1d6f9f62c552afc0ec2";
				$pin_array[5] = "bcb5a3ff2d293b86bbabdd8acc516cc4";
				$pin_array[6] = "2239aef41613bac36954531fb6153d5a";
				
				if(!isset($_SESSION["recharge_frequency"]))
				{
					$_SESSION["recharge_frequency"] = 1;
				}
				else
				{
					$_SESSION["recharge_frequency"]++;
				}	

				$recharge_type_sess = $ci->session->userdata('recharge_type');
				$acc_no_sess = $ci->session->userdata('postpaid_acc_no');			
				
				//$pin = $pin_array[$_SESSION["recharge_frequency"]];
				$pin = "e3564cdb9877b9ac1b87c74bc41d41c2";
				if($recharge_type_sess == "Mobile postpaid")
				{
					$parameters="uid=$uid&pin=$pin&number=$mobile&operator=$operator&circle=1&account=$acc_no_sess&amount=$amount&usertx=$usertx&format=json&version=4";
				}
				else
				{
					$parameters="uid=$uid&pin=$pin&number=$mobile&operator=$operator&circle=1&amount=$amount&usertx=$usertx&format=json&version=4";
				}
				
				//echo $parameters;die;

                $url="http://$domain/api/recharge.php";

				/*echo "URL:".$url;
				echo "<br>";
				echo "parameters:".$parameters;*/
				
                $ch = curl_init($url);

           
                $get_url=$url."?".$parameters;

                curl_setopt($ch, CURLOPT_POST,0);
                curl_setopt($ch, CURLOPT_URL, $get_url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                $curl_return = curl_exec($ch);
                $return_val=json_decode($curl_return);
		$rechargeMessage = $return_val->message;		
				//var_dump($return_val);
				//exit;
                $user_id=$ci->session->userdata('user_id');
		$mark_as_credit_user=$ci->session->userdata('mark_credit');
		$wamt = $ci->session->userdata('wallet_amount');
                if($return_val->status=='SUCCESS'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>1);
		    $ci->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1,'mark_as_credit_user'=>$mark_as_credit_user);			
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			
			
		    $whereCondition1=array('user_id'=>$user_id);
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $ci->users->get_AgentCommisionAmount($txn_id);
			/*echo "DEBUGGING...";
			print("<pre>");
			print_r($commision_amt);
			exit;*/
			$netcomm = 0;
			$agent_comm = $commision_amt[0]->agent_comm;
			$agent_ref_comm = $commision_amt[0]->agent_ref_comm;
			if( $agent_comm > $agent_ref_comm)
			{
				$netcomm = $agent_comm;
			}
			else
			{
				$netcomm = $agent_ref_comm;
			}
			$netcomm = $ci->session->userdata('netcomm');
			$wamt = $wamt + $netcomm;
			//echo $wam = $wam + $netcomm;exit;
			//Net Wallet Amount 20052016
			//Net Wallet Amount
		    $updateArrayData1=array('wallet'=>$wamt);
			
			$extra['op'] = $ci->session->userdata('operator');
			$extra['role'] = $ci->session->userdata('role_id');
		    //$this->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1,$extra);
			$ci->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1);
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1);
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			
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



	//$mobile = $ci->input->post('mobile',TRUE);
	$name = $ci->session->userdata('name');
	$mobile=$ci->session->userdata('mobile_no');
    $amount=$ci->session->userdata('rcAmount');
	
	//echo $mobile;exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	$message = 'Dear '.$name.', You have successfully  recharges  INR '.$amount.'. with www.laabus.com download  app @ https://goo.gl/QWUiJB';

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

								//SMD
                if($redirection){
		    redirect('recharge/success/'.$txnid);
		}else{
		    return array('status'=>'success', 'txnid' => $returnTxnId, 'msg' => $rechargeMessage);	
		}
                }elseif($return_val->status=='FAILURE'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>0);
		    $ci->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>2);			
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $ci->users->get_AgentCommisionAmount($txn_id);
			/*echo "DEBUGGING...";
			print("<pre>");
			print_r($commision_amt);
			exit;*/
			$netcomm = 0;
			$agent_comm = $commision_amt[0]->agent_comm;
			$agent_ref_comm = $commision_amt[0]->agent_ref_comm;
			if( $agent_comm > $agent_ref_comm)
			{
				$netcomm = $agent_comm;
			}
			else
			{
				$netcomm = $agent_ref_comm;
			}
			$wamt = $wamt + $netcomm;//exit;
			
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



	//$mobile = $this->input->post('mobile',TRUE);
	$name = $ci->session->userdata('name');
	$mobile=$ci->session->userdata('mobile_no');
    $amount=$ci->session->userdata('rcAmount');
	
	//echo $mobile;exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	$message = 'Dear '.$name.', Your recharges for INR '.$amount.'. with www.laabus.com failed. download app @ https://goo.gl/QWUiJB';

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

								//SMD
		if($redirection){
		    redirect('recharge/failure/'.$txnid);
		}else{
		    return array('status'=>'failure', 'txnid' => $returnTxnId, 'msg' => $rechargeMessage);	
		}
			
                    
                }elseif($return_val->status=='CANCEL'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>0);
		    $ci->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>3);			
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
                    
					
					
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



	//$mobile = $this->input->post('mobile',TRUE);
	$name = $ci->session->userdata('name');
	$mobile=$ci->session->userdata('mobile_no');
    $amount=$ci->session->userdata('rcAmount');
	
	//echo $mobile;exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	$message = 'Dear '.$name.', Your recharges for INR '.$amount.'. with www.laabus.com failed. download app @ https://goo.gl/QWUiJB';

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

								//SMD
	if($redirection){
	    redirect('recharge/cancel/'.$txnid); 
	}else{
	    return array('status'=>'cancel', 'txnid' => $returnTxnId, 'msg' => $rechargeMessage);	
	}
					
                }              
				

        }
		
		
		
		
		 function wallet_recharge_bus($txn_id, $redirection = true){

                $uid=_UID;
                $pin=_PIN;
                $domain=_DOMAIN;
		if(!$redirection){
			$ci = get_instance();
			$ci->load->model('users_model', 'users', TRUE);
	                $ci->load->model(array('common_model'));
		}else{
			$ci = $this;
		}
                $mobile=$ci->session->userdata('mobile_no');
                $amount=$ci->session->userdata('rcAmount');
                $returnTxnId=$txn_id;
                $txnid=base64_encode($txn_id);
                $operator=$ci->session->userdata('operator');
                
				$usertx  = rand(10000,99999)."_".time();
				//$pin = "7109";	
				
				//echo "PIN:".$pin;
				
				//$temp_var = rand(1000000,9999999);
				//$uid = $uid.$temp_var;
				
				$uid = "766172696e69696e666f";
				
				$pin_array[1] = "e3564cdb9877b9ac1b87c74bc41d41c2";
				$pin_array[2] = "dc4a5ba7e2d23d82c5d772e893d3c859";
				$pin_array[3] = "d488df20cc13eb1c78598e1f4590781e";
				$pin_array[4] = "c0443ab7d99cf1d6f9f62c552afc0ec2";
				$pin_array[5] = "bcb5a3ff2d293b86bbabdd8acc516cc4";
				$pin_array[6] = "2239aef41613bac36954531fb6153d5a";
				
				if(!isset($_SESSION["recharge_frequency"]))
				{
					$_SESSION["recharge_frequency"] = 1;
				}
				else
				{
					$_SESSION["recharge_frequency"]++;
				}	

				$recharge_type_sess = $ci->session->userdata('recharge_type');
				$acc_no_sess = $ci->session->userdata('postpaid_acc_no');			
				
				//$pin = $pin_array[$_SESSION["recharge_frequency"]];
				$pin = "e3564cdb9877b9ac1b87c74bc41d41c2";
				if($recharge_type_sess == "Mobile postpaid")
				{
					$parameters="uid=$uid&pin=$pin&number=$mobile&operator=$operator&circle=1&account=$acc_no_sess&amount=$amount&usertx=$usertx&format=json&version=4";
				}
				else
				{
					$parameters="uid=$uid&pin=$pin&number=$mobile&operator=$operator&circle=1&amount=$amount&usertx=$usertx&format=json&version=4";
				}
				
				//echo $parameters;die;

                $url="http://$domain/api/recharge.php";

				/*echo "URL:".$url;
				echo "<br>";
				echo "parameters:".$parameters;*/
				
               
                $user_id=$ci->session->userdata('user_id');
		$mark_as_credit_user=$ci->session->userdata('mark_credit');
		$wamt = $ci->session->userdata('wallet_amount');
                //if($return_val->status=='SUCCESS'){
					if(1){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>1);
		    $ci->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1,'mark_as_credit_user'=>$mark_as_credit_user);			
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			
			
		    $whereCondition1=array('user_id'=>$user_id);
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $ci->users->get_AgentCommisionAmount($txn_id);
			/*echo "DEBUGGING...";
			print("<pre>");
			print_r($commision_amt);
			exit;*/
			$netcomm = 0;
			$agent_comm = $commision_amt[0]->agent_comm;
			$agent_ref_comm = $commision_amt[0]->agent_ref_comm;
			if( $agent_comm > $agent_ref_comm)
			{
				$netcomm = $agent_comm;
			}
			else
			{
				$netcomm = $agent_ref_comm;
			}
			$netcomm = $ci->session->userdata('netcomm');
			$wamt = $wamt + $netcomm;
			//echo $wam = $wam + $netcomm;exit;
			//Net Wallet Amount 20052016
			//Net Wallet Amount
		    $updateArrayData1=array('wallet'=>$wamt);
			
			$extra['op'] = $ci->session->userdata('operator');
			$extra['role'] = $ci->session->userdata('role_id');
		    //$this->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1,$extra);
			$ci->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1);
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1);
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			
		
	//$return_val = curl_exec($ch);

								//SMD
                if($redirection){
		    redirect('recharge/success/'.$txnid);
		}else{
			$rechargeMessage = "Success";
		    return array('status'=>'success', 'txnid' => $returnTxnId, 'msg' => $rechargeMessage);	
		}
                }
			

        }
		
		

		function recharge_success_new($postVal, $redirection = true){
			/*echo "Debugging...";
			print_r($this->session->userdata());
			exit;*/
			
			/*echo "+++++++++++++++++++++";
			echo $this->session->userdata('recharge_type');
			echo "<br>";
			echo $this->session->userdata('postpaid_acc_no');
			echo "<br>";
			exit;*/
				//$txn_id = $postVal['txnid'];
				$txn_id = $this->session->userdata('txnid');
                $uid=_UID;
                $pin=_PIN;
                $domain=_DOMAIN;
		if(!$redirection){
			$ci = get_instance();
			$ci->load->model('users_model', 'users', TRUE);
	                $ci->load->model(array('common_model'));
		}else{
			$ci = $this;
		}
		$mobile=$ci->session->userdata('mobile_no');
                $amount=$ci->session->userdata('rcAmount');
                $txnid=base64_encode($txn_id);
                $operator=$ci->session->userdata('operator');
                
				$usertx  = rand(10000,99999)."_".time();
				//$pin = "7109";	
				
				//echo "PIN:".$pin;
				
				//$temp_var = rand(1000000,9999999);
				//$uid = $uid.$temp_var;
				
				$uid = "766172696e69696e666f";
				
				$pin_array[1] = "e3564cdb9877b9ac1b87c74bc41d41c2";
				$pin_array[2] = "dc4a5ba7e2d23d82c5d772e893d3c859";
				$pin_array[3] = "d488df20cc13eb1c78598e1f4590781e";
				$pin_array[4] = "c0443ab7d99cf1d6f9f62c552afc0ec2";
				$pin_array[5] = "bcb5a3ff2d293b86bbabdd8acc516cc4";
				$pin_array[6] = "2239aef41613bac36954531fb6153d5a";
				
				if(!isset($_SESSION["recharge_frequency"]))
				{
					$_SESSION["recharge_frequency"] = 1;
				}
				else
				{
					$_SESSION["recharge_frequency"]++;
				}	

				$recharge_type_sess = $ci->session->userdata('recharge_type');
				$acc_no_sess = $ci->session->userdata('postpaid_acc_no');			
				
				$pin = $pin_array[$_SESSION["recharge_frequency"]];
				if($recharge_type_sess == "Mobile postpaid")
				{
					$parameters="uid=$uid&pin=$pin&number=$mobile&operator=$operator&circle=1&account=$acc_no_sess&amount=$amount&usertx=$usertx&format=json&version=4";
				}
				else
				{
					$parameters="uid=$uid&pin=$pin&number=$mobile&operator=$operator&circle=1&amount=$amount&usertx=$usertx&format=json&version=4";
				}

                $url="http://$domain/api/recharge.php";

				/*echo "URL:".$url;
				echo "<br>";
				echo "parameters:".$parameters;*/
				
                $ch = curl_init($url);

           
                $get_url=$url."?".$parameters;

                curl_setopt($ch, CURLOPT_POST,0);
                curl_setopt($ch, CURLOPT_URL, $get_url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                $curl_return = curl_exec($ch);
                $return_val=json_decode($curl_return);
		$rechargeMessage = $return_val->message;		
				//var_dump($return_val);
				//exit;
                $user_id=$ci->session->userdata('user_id');
				$mark_as_credit_user=$ci->session->userdata('mark_credit');
		$wamt = $ci->session->userdata('wallet_amount');
                if($return_val->status=='SUCCESS'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>1);
		    $ci->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1,'mark_as_credit_user'=>$mark_as_credit_user);			
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			
			
		    $whereCondition1=array('user_id'=>$user_id);
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $ci->users->get_AgentCommisionAmount($txn_id);
			/*echo "DEBUGGING...";
			print("<pre>");
			print_r($commision_amt);
			exit;*/
			$netcomm = 0;
			$agent_comm = $commision_amt[0]->agent_comm;
			$agent_ref_comm = $commision_amt[0]->agent_ref_comm;
			if( $agent_comm > $agent_ref_comm)
			{
				$netcomm = $agent_comm;
			}
			else
			{
				$netcomm = $agent_ref_comm;
			}
			$netcomm = $ci->session->userdata('netcomm');
			$wamt = $wamt + $netcomm;
			//echo $wam = $wam + $netcomm;exit;
			//Net Wallet Amount 20052016
			//Net Wallet Amount
		    $updateArrayData1=array('wallet'=>$wamt);
			
			$extra['op'] = $ci->session->userdata('operator');
			$extra['role'] = $ci->session->userdata('role_id');
		    //$this->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1,$extra);
			////$this->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1); Wallet amount should not be updated.
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1);
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			
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



	//$mobile = $this->input->post('mobile',TRUE);
	$name = $ci->session->userdata('name');
	$mobile=$ci->session->userdata('mobile_no');
    $amount=$ci->session->userdata('rcAmount');
	
	//echo $mobile;exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	$message = 'Dear '.$name.', You have successfully  recharges  INR '.$amount.'. with www.laabus.com download  app @ https://goo.gl/QWUiJB';

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

								//SMD
			if($redirection){
			    redirect('recharge/success/'.$txnid);
			}else{
			    return array('status'=>'success', 'txnid' => $postVal['txnid'], 'msg' => $rechargeMessage);
			}
                }elseif($return_val->status=='FAILURE'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>0);
		    $ci->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>2);			
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $ci->users->get_AgentCommisionAmount($txn_id);
			/*echo "DEBUGGING...";
			print("<pre>");
			print_r($commision_amt);
			exit;*/
			$netcomm = 0;
			$agent_comm = $commision_amt[0]->agent_comm;
			$agent_ref_comm = $commision_amt[0]->agent_ref_comm;
			if( $agent_comm > $agent_ref_comm)
			{
				$netcomm = $agent_comm;
			}
			else
			{
				$netcomm = $agent_ref_comm;
			}
			$wamt = $wamt + $netcomm;//exit;
			
			
			
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



	//$mobile = $this->input->post('mobile',TRUE);
	$name = $ci->session->userdata('name');
	$mobile=$ci->session->userdata('mobile_no');
    $amount=$ci->session->userdata('rcAmount');
	
	//echo $mobile;exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	$message = 'Dear '.$name.', Your recharges for INR '.$amount.'. with www.laabus.com failed. download app @ https://goo.gl/QWUiJB';

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

								//SMD
			
			
			if($redirection){
			    redirect('recharge/failure/'.$txnid);
			}else{
			    return array('status'=>'failure', 'txnid' => $postVal['txnid'], 'msg' => $rechargeMessage);
			}
			
                    
                }elseif($return_val->status=='CANCEL'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>0);
		    $ci->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>3);			
			$ci->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
                    
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



	//$mobile = $this->input->post('mobile',TRUE);
	$name = $ci->session->userdata('name');
	$mobile=$ci->session->userdata('mobile_no');
    $amount=$ci->session->userdata('rcAmount');
	
	//echo $mobile;exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	$message = 'Dear '.$name.', Your recharges for INR '.$amount.'. with www.laabus.com failed. download app @ https://goo.gl/QWUiJB';

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

								//SMD
	if($redirection){
	    redirect('recharge/cancel/'.$txnid); 
	}else{
	    return array('status'=>'cancel', 'txnid' => $postVal['txnid'], 'msg' => $rechargeMessage);	
	}					

                }              
				

        }
	function recharge_success($postVal){
            
                $uid=_UID;
                $pin=_PIN;
                $domain=_DOMAIN;
                $mobile=$postVal['phone'];
                $amount=$postVal['amount'];
                $txnid=base64_encode($postVal['txnid']);
                $operator=$this->session->userdata('operator');
                
                $parameters="uid=$uid&pin=$pin&number=$mobile&operator=$operator&circle=1&amount=$amount&usertx=123456&format=json&version=4";

                $url="http://$domain/api/recharge.php";

                $ch = curl_init($url);

           
                $get_url=$url."?".$parameters;

                curl_setopt($ch, CURLOPT_POST,0);
                curl_setopt($ch, CURLOPT_URL, $get_url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                $curl_return = curl_exec($ch);
                $return_val=json_decode($curl_return);
				$rcAmount = $this->session->userdata('rcAmount');
				$mobile = $this->session->userdata('mobile_no');
                $this->session->unset_userdata('recharge_type');
                $this->session->unset_userdata('mobile_no');
                $this->session->unset_userdata('operator');
                $this->session->unset_userdata('operator_name');
                $this->session->unset_userdata('operator_circle');
                $this->session->unset_userdata('rcAmount');
                $this->session->unset_userdata('couponCode');
                $this->session->unset_userdata('coupon_amount');
                $this->session->unset_userdata('payable_amount');
                $this->session->unset_userdata('payable_amount');
                $user_id=$this->session->userdata('user_id');
		$wamt = $this->session->userdata('wallet_amount');
                $mark_credit=$this->session->userdata('mark_credit');
		$mark_credit_text= $this->session->userdata('mark_credit_text');
                if($return_val->status=='SUCCESS'){
					
					$arrayData=array(
						'user_id'=>$user_id,
						'transaction_id'=>$postVal['txnid'],
						'amount'=>$amount,
						'service_type'=>"Recharge",
						'pay_mode'=>2,
						'lupdate'=>date("Y-m-d H:i:s"),
						'created_date'=>date("Y-m-d H:i:s"),
						'mark_credit'=>$mark_credit,
						'mark_credit_text'=>$mark_credit_text,
						'status'=>1
					);
					$orders=$this->common_model->commonInsert("orders",$arrayData);
					$whereCondition=array('user_id'=>$user_id);
					$updateArrayData=array('wallet'=>$wamt);
					$this->common_model->commonUpdate('users',$updateArrayData,$whereCondition);
					$this->session->unset_userdata('wallet_amount');
                                        $this->session->unset_userdata('mark_credit');
                                        $this->session->unset_userdata('mark_credit_text');
										
										
										
										
										
								
								
								
                    redirect('recharge/success/'.$txnid);
                }elseif($return_val->status=='FAILURE'){
					$arrayData=array(
						'user_id'=>$user_id,
						'transaction_id'=>$postVal['txnid'],
						'amount'=>$amount,
						'service_type'=>"Recharge",
						'pay_mode'=>2,
						'lupdate'=>date("Y-m-d H:i:s"),
						'created_date'=>date("Y-m-d H:i:s"),
						'mark_credit'=>$mark_credit,
						'mark_credit_text'=>$mark_credit_text,
						'status'=>0
					);
					$orders=$this->common_model->commonInsert("orders",$arrayData);
                                        $this->session->unset_userdata('mark_credit');
                                        $this->session->unset_userdata('mark_credit_text');
                    #redirect('recharge/success');
                    redirect('recharge/failure/'.$txnid);           
                }elseif($return_val->status=='CANCEL'){
					$user_id=$this->session->userdata('user_id');
					$wamt = $this->session->userdata('wallet_amount');
					$arrayData=array(
						'user_id'=>$user_id,
						'transaction_id'=>$postVal['txnid'],
						'amount'=>$amount,
						'service_type'=>"Recharge",
						'pay_mode'=>2,
						'lupdate'=>date("Y-m-d H:i:s"),
						'created_date'=>date("Y-m-d H:i:s"),
						'mark_credit'=>$mark_credit,
						'mark_credit_text'=>$mark_credit_text,
						'status'=>0
					);
					$orders=$this->common_model->commonInsert("orders",$arrayData);
                                        $this->session->unset_userdata('mark_credit');
                                        $this->session->unset_userdata('mark_credit_text');
                    redirect('recharge/cancel/'.$txnid); 
                }
                
                
	}
        
        
	function order_failure(){
		
	}
}
