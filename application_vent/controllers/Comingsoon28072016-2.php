<?php 
require_once APPPATH.'controllers/Template.php';
class Comingsoon extends Template{
	function __construct(){
		parent::__construct();
		$this->load->model('Category_Model', 'Cat', TRUE );
		$this->load->model('users_model', 'users', TRUE );
                $this->load->model('Sale/Salemodel');
                $this->load->model(array('common_model'));
	}
        
	private $key='hanisoft';
        
	function index(){
            //print_r($this->session->userdata());
			$data['offers'] = $this->users->getoffers();
		$data['offerswallet'] = $this->users->getofferswallet();
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/comingsoon/index');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/comingsoon/index', $data);
                }
	}
	
	function moreoffers(){
            //print_r($this->session->userdata());
			$data['offers'] = $this->users->getoffers();
		$data['offerswallet'] = $this->users->getofferswallet();
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
                if(!$this->input->is_ajax_request()) {
                    $this->load->view('website_template/header', $data);
                    $this->load->view('website/comingsoon/moreoffers');
                    $this->load->view('website_template/footer');
                } else {
                    $this->load->view('website/comingsoon/index', $data);
                }
	}
        
        
	function proceed(){
           // print_r($this->session->userdata());
                $data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
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
				//print("<pre>");
				//print_r($_POST);exit;
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
				}
				$this->session->set_userdata($_POST);
				$this->session->set_userdata('recharge_session_key',$encrypted_string);
                                $this->session->set_userdata('login_from','recharge');
				redirect('login');
			}
		}else{
                    
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
                                        $this->load->view('website/recharge/proceed');
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
				}
				
				
				
				$_POST['operator_name'] = str_ireplace(array("\r","\n",'\r','\n'),'', $_POST['operator_name']);
				$this->session->set_userdata($_POST);                                
                                //print_r($_POST);
								//print_r($this->session->userdata());   
								
								//exit;
				$this->session->set_userdata('recharge_session_key',$encrypted_string);
				if($this->input->is_ajax_request()){
                                    //echo "helo";
                                    redirect('website/recharge/proceed');
					//$this->load->view('website/recharge/proceed');
				}else if(!$this->input->is_ajax_request()){
                                    //echo "faill";
                                        $this->load->view('website_template/header', $data);
                                        $this->load->view('website/recharge/proceed');
                                        $this->load->view('website_template/footer');
					
				}

			}
		}
	}
        
            
	public function paymenttype(){
		$data['category'] = $this->Cat->get_category();
		$data['roles'] = $this->users->get_roles();
		if(check_login_status()){
			if($this->encrypt->decode($this->session->userdata('recharge_session_key'),$this->key)==$this->encrypt->decode($this->input->get_post('recharge_proceed'),$this->key)){
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
					'mark_credit' => $this->input->post_get('mark_credit'),
					'mark_credit_text' => $this->input->post_get('mark_credit_text'),
					'operator_circle' =>$this->input->post_get('operator_circle')
				);
				$this->session->set_userdata($arr);
				if($this->input->is_ajax_request()){
				   redirect('website/recharge/paymentmode');
				}else if(!$this->input->is_ajax_request()){
					//print("<pre>");
					//print_r($this->session->userdata());
					//exit;
					
					//Net wallet amount
			//Net wallet amount 20052016
			
			//print_r($this->session->userdata());
			$commision_amt = $this->users->get_AgentCommisionAmountBySubCat($this->session->userdata('operator_name'));
			/*echo "DEBUGGING...";
			print("<pre>");
			print_r($commision_amt);
			exit;*/
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
				
				if( $commision_amt[0]->dis_type == "INR" )
				{
					$dis = $this->session->userdata('rcAmount') + $commision_amt[0]->dis_value;
					
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
					$this->session->set_userdata('rcAmount',$this->session->userdata('rcAmount')+$markup-$dis) ;
					$netcomm =( $this->session->userdata('rcAmount') + $markup - $dis )*$commision_amt[0]->agent_comm_value/100;
				}
				
				
				
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
			
			$this->session->set_userdata('netcomm',$sess_net_comm);
			//exit;
			
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
                                                       $mark_credit = ($this->input->post_get('mark_credit'))?$this->input->post_get('mark_credit'):"0";
                                                       $mark_credit_text= ($this->input->post_get('mark_credit_text'))?($this->input->post_get('mark_credit_text')):"";
                                        $arr1 = array('mark_credit' => $mark_credit,
						'mark_credit_text' => $mark_credit_text);
                                        $this->session->set_userdata($arr1);
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
								'mark_credit'=>$mark_credit ,
								'mark_credit_text'=>$mark_credit_text,
								'status'=>1
							);
							$orders=$this->common_model->commonInsert("orders",$arrayData);
                                                        redirect('Payment/wallet_recharge/'.$sales_id);
						}else{
							redirect('Payment?txnid='.$sales_id);
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
		
		public function getOffers()
		{
			//print_r($_REQUEST);
			$cat = $_REQUEST["category"];
			$op = $_REQUEST["operator"];
			if($op == 1 )
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
				
			}
			$url = "https://joloapi.com/api/findplan.php?userid=piridi&key=178153319187538&opt=".$op."&cir=5&typ=".$cat."&amt=&max=&type=json";
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
		$str .= "<div>Search By Category: ";
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
		$str .= "</select></div><br>";
		$str .= "<table class='data-table' width='100%' cellspacing='6' cellpadding='7' border='1' >";
		$str .= "<tr><td width='60%'><b>Detail</b></td><td width='25%'><b>Validity</b></td><td width='15%'><b>Amount</b></td></tr>";		
		foreach($data as $key => $value)
		{
			$str .= "<tr><td>".$value->Detail."</td><td>".$value->Validity."</td><td align='center'>Rs. ".$value->Amount." <a style='float:right' href='javascript:;' onclick ='selectAmount(".$value->Amount.")' class='selectamount' custvalue=".$value->Amount.">Select</a></td></tr>";
		}
		$str .="</table>";
	}
	else
	{
		$str .= "<div>Search By Category: ";
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
		$str .= "</select></div><br>";
		$str .= "<table class='data-table' width='100%' cellspacing='6' cellpadding='7' border='1' >";
		$str .= "<tr><td width='60%'><b>Detail</b></td><td width='25%'><b>Validity</b></td><td width='15%'><b>Amount</b></td></tr>";
		$str .= "<tr><td colspan=3>No Data found.</td></tr>";
		$str .="</table>";
	}
	//print("<pre>");
	//print_r($data);exit;
	echo $str;exit;
			
		}
}