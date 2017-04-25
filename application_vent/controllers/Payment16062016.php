<?php 
require_once APPPATH.'libraries/Payu.php';
require_once APPPATH.'libraries/Transaction_stages.php';
class Payment extends CI_Controller{
	function __construct(){
		parent::__construct();
                $this->load->model('users_model', 'users', TRUE);
                $this->load->model(array('common_model'));
	}
	function index(){
		$invoice_id = $this->input->get_post('txnid');
		//proceed to payment gateway code here
		if(check_login_status()){
			$obj = new Payu();
			
			$obj->setTransactionid($invoice_id);
			
			$obj->setAmount($this->session->userdata('payable_amount'));
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
		//proceed to payment gateway code here
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
	function fundpayment_success(){
		$obj = new Transaction_stages();
		$obj->tenth_stage();
		$user_id = $this->session->userdata('user_id');
		$role_id = $this->session->userdata('role_id');
		$obj->update_transaction_finished($_POST['txnid']);
		$userdetails = $this->users->get_user_details($user_id,$role_id);
		$wamt = $_POST['amount']+$userdetails['wallet'];
		$whereCondition1=array('user_id'=>$user_id);
		$updateArrayData=array('wallet'=>$wamt);
		$this->common_model->commonUpdate('users',$updateArrayData,$whereCondition1);
		$arrayData=array(
			'user_id'=>$user_id,
			'role_id'=>$role_id,
			'amount'=>$_POST['amount'],
			'payment_status'=>2,
			'payment_mode'=>2,  
			'credit_debit'=>1,                               
			'create_dt'=>date("Y-m-d H:i:s")
		);
		$wallet=$this->common_model->commonInsert("wallet_history",$arrayData);
                if($role_id == 4){
                    redirect('user/addfundsuccess');
                }
                if($role_id == 6){
                    redirect('agent/addfundsuccess');
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
	
	function payment_success(){
		$obj = new Transaction_stages();
		$obj->tenth_stage();
		$obj->update_transaction_finished($_POST['txnid']);
               // $this->recharge_success($_POST);
			   
			   $this->recharge_success_new($_POST);
		#print_r($_POST);exit;
		#echo "Success";
	}
        function wallet_recharge($txn_id){
			//echo "Debugging...";
			//print_r($this->session->userdata());
			//exit;
			
			/*echo "+++++++++++++++++++++";
			echo $this->session->userdata('recharge_type');
			echo "<br>";
			echo $this->session->userdata('postpaid_acc_no');
			echo "<br>";
			exit;*/
                $uid=_UID;
                $pin=_PIN;
                $domain=_DOMAIN;
                $mobile=$this->session->userdata('mobile_no');
                $amount=$this->session->userdata('rcAmount');
                $txnid=base64_encode($txn_id);
                $operator=$this->session->userdata('operator');
                
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

				$recharge_type_sess = $this->session->userdata('recharge_type');
				$acc_no_sess = $this->session->userdata('postpaid_acc_no');			
				
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
				
				//var_dump($return_val);
				//exit;
                $user_id=$this->session->userdata('user_id');
				$mark_as_credit_user=$this->session->userdata('mark_as_credit_user');
		$wamt = $this->session->userdata('wallet_amount');
                if($return_val->status=='SUCCESS'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>1);
		    $this->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1,'mark_as_credit_user'=>$mark_as_credit_user);			
			$this->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			
			
		    $whereCondition1=array('user_id'=>$user_id);
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $this->users->get_AgentCommisionAmount($txn_id);
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
			$wamt = $wamt + $netcomm;
			//echo $wam = $wam + $netcomm;exit;
			//Net Wallet Amount 20052016
			//Net Wallet Amount
		    $updateArrayData1=array('wallet'=>$wamt);
			
			$extra['op'] = $this->session->userdata('operator');
			$extra['role'] = $this->session->userdata('role_id');
		    //$this->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1,$extra);
			$this->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1);
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1);
			$this->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
                    redirect('recharge/success/'.$txnid);
                }elseif($return_val->status=='FAILURE'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>0);
		    $this->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>2);			
			$this->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $this->users->get_AgentCommisionAmount($txn_id);
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
			
			
			
                    redirect('recharge/failure/'.$txnid);           
                }elseif($return_val->status=='CANCEL'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>0);
		    $this->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>3);			
			$this->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
                    redirect('recharge/cancel/'.$txnid); 
                }              
				

        }
		
		
		function recharge_success_new($postVal){
			//echo "Debugging...";
			//print_r($this->session->userdata());
			//exit;
			
			/*echo "+++++++++++++++++++++";
			echo $this->session->userdata('recharge_type');
			echo "<br>";
			echo $this->session->userdata('postpaid_acc_no');
			echo "<br>";
			exit;*/
				$txn_id = $postVal['txnid'];
                $uid=_UID;
                $pin=_PIN;
                $domain=_DOMAIN;
                $mobile=$this->session->userdata('mobile_no');
                $amount=$this->session->userdata('rcAmount');
                $txnid=base64_encode($txn_id);
                $operator=$this->session->userdata('operator');
                
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

				$recharge_type_sess = $this->session->userdata('recharge_type');
				$acc_no_sess = $this->session->userdata('postpaid_acc_no');			
				
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
				
				//var_dump($return_val);
				//exit;
                $user_id=$this->session->userdata('user_id');
				$mark_as_credit_user=$this->session->userdata('mark_as_credit_user');
		$wamt = $this->session->userdata('wallet_amount');
                if($return_val->status=='SUCCESS'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>1);
		    $this->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1,'mark_as_credit_user'=>$mark_as_credit_user);			
			$this->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			
			
		    $whereCondition1=array('user_id'=>$user_id);
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $this->users->get_AgentCommisionAmount($txn_id);
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
			$wamt = $wamt + $netcomm;
			//echo $wam = $wam + $netcomm;exit;
			//Net Wallet Amount 20052016
			//Net Wallet Amount
		    $updateArrayData1=array('wallet'=>$wamt);
			
			$extra['op'] = $this->session->userdata('operator');
			$extra['role'] = $this->session->userdata('role_id');
		    //$this->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1,$extra);
			////$this->common_model->commonUpdate('users',$updateArrayData1,$whereCondition1); Wallet amount should not be updated.
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>1);
			$this->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
                    redirect('recharge/success/'.$txnid);
                }elseif($return_val->status=='FAILURE'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>0);
		    $this->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>2);			
			$this->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
			
			//Net wallet amount
			//Net wallet amount 20052016
			$commision_amt = $this->users->get_AgentCommisionAmount($txn_id);
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
			
			
			
                    redirect('recharge/failure/'.$txnid);           
                }elseif($return_val->status=='CANCEL'){
                    $whereCondition=array('transaction_id'=>$txn_id);
		    $updateArrayData=array('status'=>0);
		    $this->common_model->commonUpdate('orders',$updateArrayData,$whereCondition);
			
			$whereConditionT=array('sales_id'=>$txn_id);
		    $updateArrayDataT=array('transaction_status'=>3);			
			$this->common_model->commonUpdateTransaction('transaction',$updateArrayDataT,$whereConditionT);
			
                    redirect('recharge/cancel/'.$txnid); 
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