<?php
require_once APPPATH.'controllers/Template.php';
class Recharge extends Template{
	function __construct(){
		parent::__construct();
		$this->load->model('Category_Model', 'Cat', TRUE );
		$this->load->model('users_model', 'users', TRUE );
//		$this->load->model('cashback_model' );
                $this->load->model('Sale/Salemodel');
                $this->load->model(array('common_model'));
	}

	private $key='hanisoft';

	function index(){
            //print_r($this->session->userdata());

			$data['offers'] = $this->users->getoffers();
		$data['offerswallet'] = $this->users->getofferswallet();




				// print_r($usertypes);
				$role_id = $this->session->userdata('role_id');
				if($this->session->userdata('user_id') && $role_id ==4  )
				{
					$usertypes = $this->users->checkUserTypeLaabus($this->session->userdata('user_id'));
					$agent_id = $usertypes[0]->agent_id;
					if(empty($agent_id))
					{
						$role_id = 4;
					}
					else
					{
						$role_id =44;
					}
				}
		$data['offers'] = $this->users->getalloffers($role_id);
		$data["offerswallet"] = $this->users->getallofferswallet($role_id);

		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/index');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/recharge/index', $data);
                }
	}


	function proceed(){
//            echo "<pre>";
           //print_r($this->session->userdata());
           // print("<pre>");
           // print_r($_POST);exit;
              $data['category'] = $this->Cat->get_category();
            $data['roles'] = $this->users->get_roles();
			$data["recharge_flag"] = 1;

					   $user_id=$this->session->userdata('user_id');
					   $role_id=$this->session->userdata('role_id');
					   $userlist = $this->users->get_users_list($user_id);
					   $wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);

		if(!check_login_status()){
			$redirect = 'Recharge/validate';
			if($this->input->is_ajax_request()){
				echo $this->ajax_template('popup/login',$redirect);
				return;
			}else if(!$this->input->is_ajax_request()){
                                $this->load->library('encrypt');
				$msg = $_POST['operator_name'].$_POST['mobile_no'];

				$encrypted_string = $this->encrypt->encode($msg, $this->key);
				if(!isset($_POST["mark_as_credit_user"]))
				{
					$_POST["mark_as_credit_user"] = 0;
				}
				if( isset($_POST["mark_as_credit_user"]) &&  empty($_POST["mark_as_credit_user"]) )
				{
					$_POST["mark_as_credit_user"] = 0;
				}
				$_POST['operator_name'] = str_ireplace(array("\r","\n",'\r','\n'),'', $_POST['operator_name']);

				if(empty($_POST['operator_name']))
				{
					//$_POST['operator_name'] = str_ireplace(array("\r","\n",'\r','\n'),'', $_POST['operator']);
					if( $_POST['operator'] == 42 )
					{
						$_POST['operator_name'] = "Airtel Landline";
					}
					else if( $_POST['operator'] == 37 )
					{
						$_POST['operator_name'] = "BSNL Landline";
					}
					else if( $_POST['operator'] == 41 )
					{
						$_POST['operator_name'] = "MTNL Landline";
					}
					else if( $_POST['operator'] == 19 )
					{
						$_POST['operator_name'] = "Tata Sky DTH";
					}
				}
				$this->session->set_userdata($_POST);
				$this->session->set_userdata("onword","");
				$this->session->set_userdata('recharge_session_key',$encrypted_string);
                                $this->session->set_userdata('login_from','recharge');
				redirect('login');
			}
		}else{
            //redirect('Recharge/

            //Buses...
			//This method will have the credentials validation
			$this->load->library('form_validation');
			$this->load->helper('security');

			$this->form_validation->set_rules('recharge_type', 'Recharge type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mobile_no', 'Mobile number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('operator', 'Mobile operator', 'trim|required|xss_clean');
			$this->form_validation->set_rules('rcAmount', 'Recharge amount', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE)
			{

				//Field validation failed.  User redirected to login page
				if(!$this->input->is_ajax_request()){
                                        $this->load->view('website_template/header', $data);

										if( $wallet_amount < 0 )
										{
										$this->load->view('website/recharge/unproceed');
										}
										else
										{
											  //echo "123454543435";
											  				$this->load->library('encrypt');
				$msg = $_POST['operator_name'].$_POST['mobile_no'];

				$encrypted_string = $this->encrypt->encode($msg, $this->key);

				if(!isset($_POST["mark_as_credit_user"]))
				{
					$_POST["mark_as_credit_user"] = 0;
				}
				if( isset($_POST["mark_as_credit_user"]) &&  empty($_POST["mark_as_credit_user"]) )
				{
					$_POST["mark_as_credit_user"] = 0;
				}

				if(!isset($_POST["mark_as_credit_comments"]))
				{
					$_POST["mark_as_credit_comments"] = '';
				}
				if( isset($_POST["mark_as_credit_comments"]) &&  empty($_POST["mark_as_credit_comments"]) )
				{
					$_POST["mark_as_credit_comments"] = '';
				}
				//print_r($_POST);

				if(empty($_POST['operator_name']))
				{
					//$_POST['operator_name'] = str_ireplace(array("\r","\n",'\r','\n'),'', $_POST['operator']);
					/*if( $_POST['operator'] == 42 )
					{
						$_POST['operator_name'] = "Airtel Landline";
					}*/
					if( $_POST['operator'] == 42 )
					{
						$_POST['operator_name'] = "Airtel Landline";
					}
					else if( $_POST['operator'] == 37 )
					{
						$_POST['operator_name'] = "BSNL Landline";
					}
					else if( $_POST['operator'] == 41 )
					{
						$_POST['operator_name'] = "MTNL Landline";
					}
//					else if( $_POST['operator'] == 19 )
//					{
//						$_POST['operator_name'] = "Tata Sky DTH";
//					}
				}


				$this->session->set_userdata("onword","");
				$_POST['operator_name'] = str_ireplace(array("\r","\n",'\r','\n'),'', $_POST['operator_name']);
				$this->session->set_userdata($_POST);

				$this->session->set_userdata('recharge_session_key',$encrypted_string);
										$this->load->view('website/recharge/proceed',$data);
										}

                                        $this->load->view('website_template/footer');
					//$this->index();
				}else{
                                    $this->index();
					/*if(validation_errors()){
						$arr = array('err_code'=>0, "message"=>substr(strip_tags(validation_errors()),0,-1), 'status'=>'FAIL');
					}else $arr = array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS');
					echo json_encode($arr);*/
				}
			}
			else
			{
                                //echo "helo11111";
				$this->load->library('encrypt');
				$msg = $_POST['operator_name'].$_POST['mobile_no'];

				$encrypted_string = $this->encrypt->encode($msg, $this->key);

				if(!isset($_POST["mark_as_credit_user"]))
				{
					$_POST["mark_as_credit_user"] = 0;
				}
				if( isset($_POST["mark_as_credit_user"]) &&  empty($_POST["mark_as_credit_user"]) )
				{
					$_POST["mark_as_credit_user"] = 0;
				}

				if(!isset($_POST["mark_as_credit_comments"]))
				{
					$_POST["mark_as_credit_comments"] = '';
				}
				if( isset($_POST["mark_as_credit_comments"]) &&  empty($_POST["mark_as_credit_comments"]) )
				{
					$_POST["mark_as_credit_comments"] = '';
				}
				//print_r($_POST);

				if(empty($_POST['operator_name']))
				{
					//$_POST['operator_name'] = str_ireplace(array("\r","\n",'\r','\n'),'', $_POST['operator']);
					/*if( $_POST['operator'] == 42 )
					{
						$_POST['operator_name'] = "Airtel Landline";
					}*/
					if( $_POST['operator'] == 42 )
					{
						$_POST['operator_name'] = "Airtel Landline";
					}
					else if( $_POST['operator'] == 37 )
					{
						$_POST['operator_name'] = "BSNL Landline";
					}
					else if( $_POST['operator'] == 41 )
					{
						$_POST['operator_name'] = "MTNL Landline";
					}
//					else if( $_POST['operator'] == 19 )
//					{
//						$_POST['operator_name'] = "Tata Sky DTH";
//					}
				}


				$this->session->set_userdata("onword","");
				$_POST['operator_name'] = str_ireplace(array("\r","\n",'\r','\n'),'', $_POST['operator_name']);
				$this->session->set_userdata($_POST);

				$this->session->set_userdata('recharge_session_key',$encrypted_string);
				if($this->input->is_ajax_request()){
                                    //echo "helo";
                                    redirect('website/recharge/proceed');
					//$this->load->view('website/recharge/proceed');
				}else if(!$this->input->is_ajax_request()){
                                    //echo "faill";
                                        $this->load->view('website_template/header', $data);
                                        //$this->load->view('website/recharge/proceed');
                                        if( $wallet_amount < 0 )
                                        {
                                            $this->load->view('website/recharge/unproceed');
                                        }
                                        else
                                        {

											$this->load->view('website/recharge/proceed',$data);
                                        }
                                        $this->load->view('website_template/footer');
				}

			}
		}

	}


	public function paymenttype(){
            //print_r($_POST);exit;
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
//		print("<pre>");
//		print_r($this->session->userdata());exit;
		if(check_login_status()){

			if($this->encrypt->decode($this->session->userdata('recharge_session_key'),$this->key)==$this->encrypt->decode($this->input->get_post('recharge_proceed'),$this->key) ){  //true added for Buses

				$arr = array(
					'mobile_no' => $this->input->post_get('mobile_no'),
					'recharge_type' => $this->input->post_get('recharge_type'),
					'rcAmount' => $this->input->post_get('rcAmount'),
					'couponCode' => $this->input->post_get('couponCode'),
					'operator' => $this->input->post_get('operator'),
					'operator_name'=> $this->input->post_get('operator_name'),
					'coupon_amount' => $this->input->post_get('coupon_amount'),
					'payable_amount' => ($this->input->post_get('rcAmount') - $this->input->post_get('coupon_amount')),
					'purchase_value' => $this->input->post_get('rcAmount'),
					'mark_credit' => $this->input->post_get('mark_credit_user'),
					'mark_credit_text' => $this->input->post_get('mark_as_credit_comments'),
					'operator_circle' =>$this->input->post_get('operator_circle'),
					'couponCode' =>$this->input->post_get('couponCode'),
					'iscashback' =>$this->input->post_get('iscashback')
				);

				$this->session->set_userdata($arr);
				if($this->input->is_ajax_request()){
				   redirect('website/recharge/paymentmode');
				}else if(!$this->input->is_ajax_request()){
					// print("<pre>");
					// print_r($this->session->userdata());
					// exit;

					//Net wallet amount
			//Net wallet amount 20052016


		 $commision_amt = $this->users->get_AgentCommisionAmountBySubCat($this->session->userdata('operator_name'));
//			 echo "DEBUGGING...";
//			 print("<pre>");
//                         print_r($this->session->userdata);
//			 print_r($commision_amt);
//			 exit;

			//save Our Comminisssion values into Sessions.
			$our_comm_type = $commision_amt[0]->our_comm_type;
			$our_comm_value = $commision_amt[0]->our_comm_value;
			$this->session->set_userdata('our_comm_type', $our_comm_type);
			$this->session->set_userdata('our_comm_value', $our_comm_value);
			//End save Our Commission value into database.
			$netcomm = 0;
			$agent_comm = $commision_amt[0]->agent_comm_value;
			$agent_ref_comm = $commision_amt[0]->agent_ref_comm_value;
			$netcomm = 0;
			$markup = 0;
			$dis = 0;
			if( $this->session->userdata('role_id') == 6 )
			{
				//$netcomm = $this->session->userdata('rcAmount')*$agent_comm/100;

				if( $commision_amt[0]->mark_comm_type == "INR" )
				{
					$markup = $commision_amt[0]->mark_comm_value;
				}
				else
				{
					$markup = $this->session->userdata('rcAmount')*$commision_amt[0]->mark_comm_value/100;
				}

				//print_r($commision_amt[0]);exit;

				if( $commision_amt[0]->dis_type == "INR" )
				{
					$dis = $commision_amt[0]->dis_value;
				}
				else
				{
					$dis = $this->session->userdata('rcAmount')*$commision_amt[0]->dis_value/100;
				}

				if( $commision_amt[0]->agent_comm_type == "INR" )
				{
					$netcomm = $commision_amt[0]->agent_comm_value;
					$this->session->set_userdata('rcAmount',$this->session->userdata('rcAmount')+$markup-$dis) ;
				}
				else
				{
					//$this->session->set_userdata('rcAmount',$this->session->userdata('rcAmount')+$markup-$dis) ;
					//$netcomm =( $this->session->userdata('rcAmount') + $markup - $dis )*$commision_amt[0]->agent_comm_value/100;
					$rc = $this->session->userdata('rcAmount');
					//var_dump($markup);
					//var_dump($dis);
					$rc = $rc+$markup-$dis;

					$this->session->set_userdata('rcAmount',$rc);

					$netcomm = $this->session->userdata('rcAmount')*$commision_amt[0]->agent_comm_value/100;

				}


				//print_r($this->session->userdata());exit;



			}
			else
			{
				$netcomm = $this->session->userdata('rcAmount')*$agent_ref_comm/100;
			}
			//echo $netcomm;
			$sess_net_comm = number_format($netcomm,2);
			$data["netcomm"] = number_format($netcomm,2);
			$data["markup"] = $markup;
			$data["dis"] = $dis;

			if( $this->session->userdata('role_id') == 4 && $this->session->userdata('agent_id') == 0 )
			{
				$this->session->set_userdata('netcomm',0);
			}
			else{
			$this->session->set_userdata('netcomm',$sess_net_comm);
			}


//			print_r($this->session->userdata());exit;
//			exit;

			//exit("123455555");

					$this->load->view('website_template/header', $data);
					$this->load->view('website/recharge/paymentmode',$data);
					$this->load->view('website_template/footer');
				}
			}else if($this->session->userdata('user_id')!='' && $this->session->userdata('onword')!=''){
				$arr = array(
					'totalAmount' => $this->input->post_get('totalAmount'),
					'rcAmount' => $this->input->post_get('totalAmount')
				);
				$this->session->set_userdata($arr);
				if($this->input->is_ajax_request()){
				   redirect('website/recharge/paymentmode');
				}else if(!$this->input->is_ajax_request()){
					// print("<pre>");
					// print_r($this->session->userdata());
					// exit;

					//Net wallet amount
			//Net wallet amount 20052016


		 $commision_amt = $this->users->get_AgentCommisionAmountBySubCat($this->session->userdata('operator_name'));
			 //echo "DEBUGGING...";
			 //print("<pre>");
			 //print_r($commision_amt);
			 //exit;

			//save Our Comminisssion values (Total Profit inclusing Agent SMS LAABUS CHANLE PARTNER) into Sessions.
			$our_comm_type = $commision_amt[0]->our_comm_type;
			$our_comm_value = $commision_amt[0]->our_comm_value;
			$this->session->set_userdata('our_comm_type', $our_comm_type);
			$this->session->set_userdata('our_comm_value', $our_comm_value);
			//End save Our Commission value into database.



			$netcomm = 0;
			$agent_comm = $commision_amt[0]->agent_comm_value;
			$agent_ref_comm = $commision_amt[0]->agent_ref_comm_value;
			$netcomm = 0;
			$markup = 0;
			$dis = 0;
			if( $this->session->userdata('role_id') == 6 )
			{
				//$netcomm = $this->session->userdata('rcAmount')*$agent_comm/100;

				if( $commision_amt[0]->mark_comm_type == "INR" )
				{
					$markup = $commision_amt[0]->mark_comm_value;
				}
				else
				{
					$markup = $this->session->userdata('rcAmount')*$commision_amt[0]->mark_comm_value/100;
				}

				//print_r($commision_amt[0]);exit;

				if( $commision_amt[0]->dis_type == "INR" )
				{
					$dis = $commision_amt[0]->dis_value;
				}
				else
				{
					$dis = $this->session->userdata('rcAmount')*$commision_amt[0]->dis_value/100;
				}

				if( $commision_amt[0]->agent_comm_type == "INR" )
				{
					$netcomm = $commision_amt[0]->agent_comm_value;
					$this->session->set_userdata('rcAmount',$this->session->userdata('rcAmount')+$markup-$dis) ;
				}
				else
				{
					//$this->session->set_userdata('rcAmount',$this->session->userdata('rcAmount')+$markup-$dis) ;
					//$netcomm =( $this->session->userdata('rcAmount') + $markup - $dis )*$commision_amt[0]->agent_comm_value/100;
					$rc = $this->session->userdata('rcAmount');
					//var_dump($markup);
					//var_dump($dis);
					$rc = $rc+$markup-$dis;

					$this->session->set_userdata('rcAmount',$rc);

					$netcomm = $this->session->userdata('rcAmount')*$commision_amt[0]->agent_comm_value/100;

				}


				//print_r($this->session->userdata());exit;



			}
			else
			{
				$netcomm = $this->session->userdata('rcAmount')*$agent_ref_comm/100;
			}
			//echo $netcomm;exit;
			$sess_net_comm = number_format($netcomm,2);
			$data["netcomm"] = number_format($netcomm,2);
			$data["markup"] = $markup;
			$data["dis"] = $dis;



			$this->session->set_userdata('netcomm',$sess_net_comm);


			if( $this->session->userdata('role_id') == 4 && $this->session->userdata('agent_id') == 0 )
			{
				$this->session->set_userdata('netcomm',0);
			}




			//print_r($this->session->userdata());exit;
			//exit;

			//exit("123455555");

					$this->load->view('website_template/header', $data);
					$this->load->view('website/recharge/paymentmode',$data);
					$this->load->view('website_template/footer');
				}

			}else{ redirect('recharge');}
		}else { redirect('login');}
	}

	function proceedtopay(){

		if(check_login_status()){
			if($this->encrypt->decode($this->session->userdata('recharge_session_key'),$this->key)==$this->encrypt->decode($this->input->get_post('recharge_proceed'),$this->key)){
				//create sale to database
				if($this->input->post_get('payment')){

					$user_id=$this->session->userdata('user_id');
					$role_id=$this->session->userdata('role_id');
					$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
					$rcAmount = $this->input->post_get('rcAmount');
					$amt = ($this->input->post_get('payment')=="Payu")?(($rcAmount>$wallet_amount)?$this->input->post_get('payamount'):$rcAmount):$this->input->post_get('payamount');
					//$wamt = ($rcAmount>$wallet_amount)?"0":($wallet_amount-$rcAmount);
                                        $wamt = ($this->input->post_get('walamount')=="1")?(($rcAmount>$wallet_amount)?"0":($wallet_amount-$rcAmount)):$wallet_amount;
                                        //echo $wamt;exit;
					$this->session->set_userdata("wallet_amount",$wamt);
					$payamt = $this->input->post_get('rcAmount') - $this->input->post_get('coupon_amount');
					$this->session->set_userdata("payable_amount",$payamt);
					$arr = array('mobile_no' => $this->input->post_get('mobile_no'),
						'recharge_type' => $this->input->post_get('recharge_type'),
						'rcAmount' => $amt,
						'couponCode' => $this->input->post_get('couponCode'),
						'operator' => $this->input->post_get('operator'),
						'operator_name'=> $this->input->post_get('operator_name'),
						'coupon_amount' => $this->input->post_get('coupon_amount'),
						'payable_amount' => ($this->input->post_get('rcAmount') - $this->input->post_get('coupon_amount')),
						'purchase_value' => $this->input->post_get('rcAmount'),
						'operator_circle' =>$this->input->post_get('operator_circle')
					);
					$this->session->set_userdata($arr);
                                        //print_r($this->session->userdata);echo $this->session->userdata('operator');
                                        $mark_credit = ($this->input->post_get('mark_credit'))?$this->input->post_get('mark_credit'):"0";
                                        $mark_credit_text= ($this->input->post_get('mark_credit_text'))?($this->input->post_get('mark_credit_text')):"";
                                        $arr1 = array('mark_credit' => $mark_credit,
						'mark_credit_text' => $mark_credit_text);
                                        $this->session->set_userdata($arr1);
                                        //echo "<pre>";print_r($this->session->userdata);print_r($_POST);exit;
					if($sales_id = $this->Salemodel->create_order($arr)){
						if($this->input->post_get('payment')=="Wallet"){
							$arrayData=array(
								'user_id'=>$user_id,
								'transaction_id'=>$sales_id,
								'amount'=>$amt,
								'service_type'=>"Recharge",
								'pay_mode'=>1,
								'lupdate'=>date("Y-m-d H:i:s"),
								'created_date'=>date("Y-m-d H:i:s"),
								'mark_credit'=>$this->session->userdata('mark_credit') ,
								'mark_credit_text'=>$this->session->userdata('mark_credit_text'),
								'status'=>1
							);
                                                        //echo "<pre>";print_r($this->session->userdata);print_r($arrayData);exit;
							$orders=$this->common_model->commonInsert("orders",$arrayData);
                                                        redirect('Payment/wallet_recharge/'.$sales_id);
						}else{
							//redirect('Payment?txnid='.$sales_id);  //New Payment Integration with ATOM....
							$this->session->set_userdata("txnid", $sales_id);
							//SET FORM
							$str ='<form style="display:none" action="http://laabus.com/merchant_mobile/submit.php" id="fff" method="post"   onload="">

<INPUT TYPE="hidden" NAME="product" value="VARINI_RECHARGE">
<INPUT TYPE="hidden" NAME="prodid" value="VARINI_RECHARGE">
<INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">

<INPUT TYPE="hidden" NAME="clientcode" value="007">
<INPUT TYPE="hidden" NAME="AccountNo" value="1234567890">

<INPUT TYPE="hidden" NAME="ru" value="http://laabus.com/nag/laabus/merchant/service_response.php">
<input type="hidden" name="bookingid" value="100001"/>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
        <td>* Name</td>
        <td>:</td>
        <td><input name="udf1" type="text" value="Venkat" /></td>
        <td><span style="color:Red;visibility:hidden;">Client Name is mandatory.</span></td>

    </tr>
    <tr>
        <td>* Email ID</td>
        <td>:</td>
       <td><input name="udf2" type="text" value="'.$this->session->userdata('email_id').'" /></td>
        <td><span style="color:Red;visibility:hidden;">Email is mandatory.</span></td>
    </tr>
    <tr>

        <td>* Mobile No</td>
        <td>:</td>
        <td><input name="udf3" type="text" value="'.$this->session->userdata('Mobile').'" /></td>
        <td><span style="color:Red;visibility:hidden;">Mobile No</span></td>
    </tr>
    <tr>
        <td>* Billing Address</td>
        <td>:</td>

        <td><input name="udf4" type="text" value="HYD"  /></td>
        <td><span style="color:Red;visibility:hidden;">Billing Address is mandatory.</span></td>
    </tr>
   <!--  <tr>
        <td>* Bank Name</td>
        <td>:</td>
        <td><input name="udf5" type="text" value="bank1" /></td>
        <td><span style="color:Red;visibility:hidden;">Bank Name is mandatory.</span></td>

    </tr> -->




<tr>
<td>
Amount
</td>
<td>:</td>
<td>
<input type="text" name="amount" value="'.$payamt.'" />
</td>
</tr>


<tr>
<td>
</td>
<td></td>
<td>
<input type="submit" name="Submit" value="Submit" />
</td>
</tr>
</table>
 </form><script>document.getElementById("fff").submit()</script>';
 echo $str;die;
							//END SET FORM.
						}
					}else redirect('recharge');
				}else redirect('recharge');
			}else	redirect('recharge');
		}else redirect('recharge');
	}
	function success(){
                 $sales_id=base64_decode($this->uri->segment(3));

		#echo file_get_contents("http://recharge.cyberdeer.com/api/recharge.php?uid=766172696e69696e666f73797374656d73&pin=0ccbc48aecdc342960c932d2d416e837&number=".$this->session->userdata('mobile_no')."&operator=".$this->session->userdata('operator')."&circle=".$this->session->userdata('operator_circle')."&amount=".$this->session->userdata('rcAmount')."&usertx=".$_POST['txnid']."&format=json&version=4");
		#print_r($_POST);
                $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();


		$data['rechargeOrder'] = $this->Salemodel->get_recharge_order($sales_id);



		//channel partner commision updating to database
		$userdetailsC = $this->users->get_user_details($this->session->userdata('channel_part_userid'),2);
		//print_r($userdetailsC);
		$wamtC = $this->session->userdata('channel_part_comm')+$userdetailsC['wallet'];
		//print_r($this->session->all_userdata());die;
		$whereConditionC1=array('user_id'=>$this->session->userdata('channel_part_userid'));
		$updateArrayDataC=array('wallet'=>$wamtC);
		$this->common_model->commonUpdate('users',$updateArrayDataC,$whereConditionC1);
		//


                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/receipt');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/recharge/index');
                }
	}

	function failure(){
            #print_r($this->session->userdata());
            $sales_id=base64_decode($this->uri->segment(3));

		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();

                $data['rechargeOrder'] = $this->Salemodel->get_recharge_order($sales_id);

                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/failure');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/recharge/index');
                }
	}

        function cancel(){
            #print_r($this->session->userdata());
            $sales_id=base64_decode($this->uri->segment(3));

		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();

                $data['rechargeOrder'] = $this->Salemodel->get_recharge_order($sales_id);

                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/cancel');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/recharge/index');
                }
	}

        function DTH(){
            $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/DTH');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/recharge/DTH');
                }
        }

        function datacard(){
            $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/datacard');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/recharge/datacard');
                }
        }

        function landline(){
            $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/landline');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/recharge/landline');
                }
        }

        function electricity(){
            $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/recharge/electricity');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/recharge/electricity');
                }
        }
		public function getOffersplan()
		{
			//$_REQUEST['operator'] = 3;
			$plan = $this->users->getOffersplan($_REQUEST['operator'],$_REQUEST['amount']);
			//print_r($plan);
			if(!empty($plan))
				echo $plan[0]->validity;
			else
				echo "General Plan";
			die;
		}

		public function getOffers()
		{
			//print_r($_REQUEST);
			$cat = $_REQUEST["category"];
			$op = $_REQUEST["operator"];
			/*if($op == 1 )
			{
				$op = 28;
			}
			else if ( $op == 2 )
			{
				$op = 22;
			}
			else if ( $op == 6 )
			{
				$op = 1;
			}
			else if ( $op == 16 )
			{
				$op = 19;
			}
			else if ( $op == 10 )
			{
				$op = 9;
			}
			if(!empty($cat) )
			{

			}
			else
			{

			}*/
			//$url = "https://joloapi.com/api/findplan.php?userid=piridi&key=178153319187538&opt=".$op."&cir=5&typ=".$cat."&amt=&max=&type=json";


			if($op == 3 )
			{
				$op = 6;  //BSNL
			}
			else if( $op == 6 )
			{
				$op = 5; //AIRCEL
			}
			else if( $op == 11 )
			{
				$op = 13; //DATA DOCOMO
			}
			else if( $op == 2 )
			{
				$op = 4; //VODAFONE
			}
			else if( $op == 8 )
			{
				$op = 7; //IDEA
			}
			else if( $op == 17 )
			{
				$op = 15; //VIDEOCON
			}
			else if( $op == 16 )
			{
				$op = 14; //VIDEOCON
			}
			else
			{
				$op = 1; //AIRTEL
			}
			$txnid = uniqid();
			$apisecret = "kQeDheLqeeQXU6cAGhbdbyfyFVMpVCs4MF2ZaXqdTFmpdgDH";
			$api_user_id= "YGRZ2egUHLBk5FfNTBvPDPU3K5Lcfk27fGYv2FGebGw6c64Y";
			$concat = $txnid."|".$apisecret;
			 $hash = hash("sha512",$concat);
			//echo "<br>";
$url ="https://api.komparify.com/carriers.json?unique_provider_id=".$op."&securehash=".$hash."&txnid=".$txnid."&type=prepaid&region_id=2";
$url .="&number_of_packs=100&typeofplan=mobile&api_user_id=".$api_user_id;
			$ch = curl_init();




	curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $output=curl_exec($ch);

	 if($output === false)
    {
        echo "Error Number:".curl_errno($ch)."<br>";
        echo "Error String:".curl_error($ch);
		exit;
    }

    curl_close($ch);
    //return $output;
	//header("Content-type: text/xml");
	//print("<pre>");

	//echo $output;//exit;
	$data = json_decode($output);

	$str = "";
	if(!empty($data))
	{
		/*$str .= "<div>Search By Category: ";
		$str .= "<select id='s-category' name='s-category' onchange='searchbycat(this.value)'>";
		$str .= "<option value=''>All</option>";
		$str .= "<option value='TUP'>Top-up Recharge</option>";
		$str .= "<option value='FTT'>Full Talk-time Recharge</option>";
		$str .= "<option value='2G'>2G Data Recharge</option>";
		$str .= "<option value='3G'>3G/4G Data Recharge</option>";
		$str .= "<option value='SMS'>SMS Pack Recharge</option>";
		$str .= "<option value='LSC'>Local/STD/ISD Call Recharge</option>";
		$str .= "<option value='OTR'>Other Recharge</option>";
		$str .= "<option value='RMG'>National/International Roaming Recharge</option>";
		$str .= "</select></div><br>";*/
		$str .= "<table class='data-table' width='100%' cellspacing='6' cellpadding='7' border='1' >";
		$str .= "<tr><td width='60%'><b>Detail</b></td><td width='25%'><b>Validity</b></td><td width='15%'><b>Amount</b></td></tr>";

		$i =0;
		foreach($data as $key => $valuem)
		{
			$i++;
			if($i<=2)
			{
				continue;
			}
			foreach($valuem->topups as $keym => $value)
			{
			$str .= "<tr><td>".$value->name."<br>".$value->description."</td><td>".$value->validity_string."</td><td align='center'>Rs. ".$value->price." <a style='float:right' href='javascript:;' onclick ='selectAmount(".$value->price.")' class='selectamount' custvalue=".$value->Amount.">Select</a></td></tr>";
			}
		}
		$str .="</table>";
	}
	else
	{
		/*$str .= "<div>Search By Category: ";
		$str .= "<select id='s-category' name='s-category' onchange='searchbycat(this.value)'>";
		$str .= "<option value=''>All</option>";
		$str .= "<option value='TUP'>Top-up Recharge</option>";
		$str .= "<option value='FTT'>Full Talk-time Recharge</option>";
		$str .= "<option value='2G'>2G Data Recharge</option>";
		$str .= "<option value='3G'>3G/4G Data Recharge</option>";
		$str .= "<option value='SMS'>SMS Pack Recharge</option>";
		$str .= "<option value='LSC'>Local/STD/ISD Call Recharge</option>";
		$str .= "<option value='OTR'>Other Recharge</option>";
		$str .= "<option value='RMG'>National/International Roaming Recharge</option>";
		$str .= "</select></div><br>";*/
		$str .= "<table class='data-table' width='100%' cellspacing='6' cellpadding='7' border='1' >";
		$str .= "<tr><td width='60%'><b>Detail</b></td><td width='25%'><b>Validity</b></td><td width='15%'><b>Amount</b></td></tr>";
		$str .= "<tr><td colspan=3>No Data found.</td></tr>";
		$str .="</table>";
	}
	//print("<pre>");
	//print_r($data);exit;
	echo $str;exit;

		}/*

	public function isCachBackCodeAvailable()
	{
		$cashback_code = $this->input->post('cachback_code');
		$role_id = $this->session->userdata('role_id');
		$role_name = $this->cashback_model->getRoleNameByRoleId($role_id);
		$details = $this->cashback_model->getCashBackCodeDetails($cashback_code);
		$filed = 'cbk_is'.$role_name;
		echo $details[0]->$filed;
		exit;
	}*/
}
