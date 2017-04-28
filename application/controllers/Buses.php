<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once '/hello.php';
    require_once "seatseller/library/OAuthStore.php";
	require_once "seatseller/library/OAuthRequester.php";
	require_once "seatseller/SSAPICaller.php";

include_once 'seatseller/index.php';
//include_once '/seatseller/BuServiceList.php';
require_once APPPATH.'controllers/Template.php';

class Buses extends Template {

   function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('users_model', 'users', TRUE );
        $this->load->model('Bus_booking', 'Booking_model', TRUE );
        $this->load->model('Category_Model', 'Cat', TRUE );
		$this->load->model('Sale/Salemodel');
        $this->load->model(array('common_model'));
    }

    public function index() {
        //$this->myclass->hello();
        //sayHello();

        $data['folder'] ='';
        $data['body'] = 'index';
        $data['country'] = $this->users->get_country();
        $this->load->view('website_template', $data);
    }

    public function buses() {
        $this->session->unset_userdata('rcAmount');
        $this->session->unset_userdata('totalAmount');
        $this->session->unset_userdata('busSearchResult');
        $this->session->unset_userdata("onword");
        $this->session->unset_userdata("return");
        $this->session->unset_userdata('rdate');
        $this->session->unset_userdata('rjrny');
        $this->session->unset_userdata('onword_block_ticket');
        $this->session->unset_userdata('onword_unique_key');
        $this->session->unset_userdata('return_block_ticket');
        $this->session->unset_userdata('return_unique_key');
        $this->session->unset_userdata('sourceid');
        $this->session->unset_userdata('destid');

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('mobile');
        $this->session->unset_userdata('emergency_no');
        $this->session->unset_userdata('fname');
        $this->session->unset_userdata('lname');
        $this->session->unset_userdata('age');
        $this->session->unset_userdata('gender');


        $data['cities'] =  getSourcesAsDropDownList();
        //	echo "Its me";
        //$data['cities'] = $this->busses->citieslist();
        //		$data['category'] = $this->Cat->get_category();
        //		$data['roles'] = $this->users->get_roles();
        $data['folder'] ='';
        $data['body'] = 'index';
        $this->load->view('website/buses/index', $data);
    }

    public function modify() {
        $this->session->unset_userdata('busSearchResult');

        echo  json_encode(getSourcesAsDropDownList());
    }

    public function printTicket($tin){
        $data['ticket'] = getTicket($tin);
        $data['folder'] ='user/';
        $data['body'] = 'print_ticket';

        $this->load->view('website_template', $data);
    }



    public function payment(){
        //echo $this->session->userdata('rdate')."Data";
        //exit;
        if($this->session->userdata('rjrny') =='')
        {

            $this->session->set_userdata('rjrny',  'Yes');

            /*$onword = array('bptime'=>$_POST['bptime'],'serviceid'=>$_POST['serviceid'],'bpname' => $_POST['bPointName'],'src' => $_POST['src'],'srcid' => $_POST['srcid'],'dest' => $_POST['dest'],'destid' => $_POST['destid'],'jdate' => $_POST['jdate'],'busId' => $_POST['busId'],'amount' => $_POST['amount'],'bPoint' => $_POST['bPoint'],'seats' => $_POST['seats'],'busType' => $_POST['busType'],'startingTime' => $_POST['startingTime'],'travels' => $_POST['travels']);*/

			$onword = array('bptime'=>$_POST['bptime'],'serviceid'=>$_POST['serviceid'],'bpname' => $_POST['bPointName'],'src' => $_POST['src'],'srcid' => $_POST['srcid'],'dest' => $_POST['dest'],'destid' => $_POST['destid'],'jdate' => $_POST['jdate'],'busId' => $_POST['busId'],'amount' => $_POST['amount'],'onward_org_amt' => $_POST['onward_org_amt'],'bPoint' => $_POST['bPoint'],'seats' => $_POST['seats'],'busType' => $_POST['busType'],'startingTime' => $_POST['startingTime'],'travels' => $_POST['travels']);


            $this->session->set_userdata('onword', $onword);

            if($this->session->userdata('rdate') !=''){
                redirect('/buses/busesList');
                exit;
            }
            // exit;
        }else{

            $return = array('bptime'=>$_POST['bptime'],'serviceid'=>$_POST['serviceid'],'bpname' => $_POST['bPointName'],'src' => $_POST['src'],'srcid' => $_POST['srcid'],'dest' => $_POST['dest'],'destid' => $_POST['destid'],'jdate' => $_POST['jdate'],'busId' => $_POST['busId'],'amount' => $_POST['amount'],'bPoint' => $_POST['bPoint'],'seats' => $_POST['seats'],'busType' => $_POST['busType'],'startingTime' => $_POST['startingTime'],'travels' => $_POST['travels']);

            $this->session->set_userdata('return', $return);

        }

		$commision_amt = $this->users->get_AgentCommisionAmountBySubCat('All Buses');
		//print_r($commision_amt);
		$data['commision_amt'] = $commision_amt;
        $data['folder'] ='buses/';
        $data['body'] = 'payment';
        $this->load->view('website_template', $data);
        // print_r($_POST);

    }

    public function busesList(){

        if($this->session->userdata('rdate')!='' && $this->session->userdata('rjrny')!=''){

            // print_r($this->session->userdata('onword'));
            // exit;

            $from=$this->session->userdata('to');
            $to=$this->session->userdata('from');
            $sourceid=$this->session->userdata('destid');
            $destid=$this->session->userdata('sourceid');
            $jdate=$this->session->userdata('rdate');

            //                     $this->session->set_userdata('nav_rfrom',$from);
            //                     $this->session->set_userdata('nav_rto',$to);
            //$this->session->set_userdata('nav_rdate',$jdate);

            $this->session->unset_userdata('busSearchResult');

        }else if(isset($_POST['cities'])){

            $this->session->set_userdata('busSearchResult', "");

            $from=$_POST['cities'];
            $to=$_POST['cities2'];
            $sourceid=$_POST['cities_val'];
            $destid=$_POST['cities2val'];
            $jdate=date("Y-m-d", strtotime($_POST['DateofJourney']));
            $rdate=$_POST['DateofReturn'];


            $this->session->set_userdata('nav_from',$from);
            $this->session->set_userdata('nav_to',$to);
            $this->session->set_userdata('nav_jdate',$jdate);


        }else{

            echo "Access Denied";
            exit;
        }

        $this->session->set_userdata('from',$from);
        $this->session->set_userdata('to',$to);
        $this->session->set_userdata('jdate',$jdate);
        $this->session->set_userdata('sourceid', $sourceid);
        $this->session->set_userdata('destid',  $destid);

        if(isset($rdate) && $rdate!=''){
            $returnDate= date("Y-m-d", strtotime($rdate));
            $this->session->set_userdata('rdate',$returnDate);
        }


        if($this->session->userdata('busSearchResult') == ""){

            $getData = getAvailableTrips($sourceid,$destid,$jdate);
            $jsonresult = json_decode($getData,true);

            $this->session->set_userdata('busSearchResult',$jsonresult);
            if(!isset($jsonresult['availableTrips'][0]['AC'])){
                $t=array();
                $t[0] = $jsonresult['availableTrips'];
                $jsonresult['availableTrips'] = $t;
            }

        }else{
            $jsonresult=$this->session->userdata('busSearchResult');
        }


		$commision_amt = $this->users->get_AgentCommisionAmountBySubCat('All Buses');
		$data['commision_amt'] = $commision_amt;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['srcid'] =$sourceid;
        $data['destid'] = $destid;
        $data['jdate'] = $jdate;
        $data['folder'] ='buses/';
        $data['body'] = 'bus_search';
        $data['jsonresult'] =  $jsonresult;
        $data['cities'] = getSourcesAsDropDownList();


        // echo "<pre>";
        //print_r($jsonresult);
        //echo "</pre>";
        $this->load->view('website_template',$data);

    }


    public function onword_booking_process(){
        //echo "Onword";

        $bookingKey = uniqid();
         $onword = $this->session->userdata("onword");


        if($this->Booking_model->create_booking($bookingKey,$onword)){

            // redirect('/');
            $jsone= array();

            $jsone['availableTripId']=$onword['busId'];
            $jsone['boardingPointId']=$onword['bPoint'];
            $jsone['destination']= $onword['destid'];

            $jsone['inventoryItems']=array();

            $seatNo = explode(",", $onword['seats']);

            $count = count($this->session->userdata('fname'));
			$commision_amt = $this->users->get_AgentCommisionAmountBySubCat('All Buses');

			if( $commision_amt[0]->mark_comm_type == "INR" )
				{
					 $markup = $commision_amt[0]->mark_comm_value;
				}
				else
				{
					 $markup = $onword['amount']*$commision_amt[0]->mark_comm_value/100;
				}

				//echo $commision_amt[0]->mark_comm_value;
				//print("<pre>");
				//print_r($onword);
             $per_head = (string)$onword['onward_org_amt']/$count;
			 //$per_head = "250.00";



        $email			= $this->session->userdata('email');
        $mobile			= $this->session->userdata('mobile');
        $emergency_no	= $this->session->userdata('emergency_no');
        $fname			= $this->session->userdata('fname');
        $lname			= $this->session->userdata('lname');
        $age			= $this->session->userdata('age');
        $gender 		= $this->session->userdata('gender');

            for($i=0; $i<$count; $i++){

                $gender = "gender".$i;
                $gndr = $gender[0] == 'F' ? 'female' : 'male';

                $jsone['inventoryItems'][$i]['seatName'] = $seatNo[$i];
                $jsone['inventoryItems'][$i]['ladiesSeat'] = "false";
                $jsone['inventoryItems'][$i]['passenger'] = array();
                $jsone['inventoryItems'][$i]['passenger']['age'] = $age[$i];
                $jsone['inventoryItems'][$i]['passenger']['primary'] = $i == 0 ? "true" : "false";
                $jsone['inventoryItems'][$i]['passenger']['name'] = $fname[$i] . ' ' . $lname[$i];
                $jsone['inventoryItems'][$i]['passenger']['title'] = "Laabus Ticket Booking";
                $jsone['inventoryItems'][$i]['passenger']['gender'] = $gndr;
                if($i == 0):
                $jsone['inventoryItems'][$i]['passenger']['idType'] = "Pan Card";
                $jsone['inventoryItems'][$i]['passenger']['email'] = $email;
                $jsone['inventoryItems'][$i]['passenger']['idNumber'] = "123456";
                $jsone['inventoryItems'][$i]['passenger']['address'] = "Sample Address";
                $jsone['inventoryItems'][$i]['passenger']['mobile'] = $mobile;
                endif;
                $jsone['inventoryItems'][$i]['fare'] = $per_head;

            }


            $jsone['source']= $onword['srcid'];

            $jsonVar = json_encode($jsone);


           //echo $jsonVar;
          // exit;
            //echo "<br><br>----------------<br><br>";
            $block_key= blockTicket($jsonVar);

            //var_dump($block_key);die;
			//echo "Onword";

            // echo "<br><br>----------------<br><br>";
            if($block_key!=''){

                // $this->session->set_userdata('confrm_ticket',$jsonVar);
                $this->session->set_userdata('onword_block_ticket',$block_key);
                $this->session->set_userdata('onword_unique_key',$bookingKey);


                //------------------ Redirecting To payment GateWay------------

                // Return url form payment gateWay URL : http://laabus.com/buses/payment_process
                if($this->session->userdata("return") != ''){

                    $this->return_booking_process();

                }else{
                    $this->paymentGateway_callback($bookingKey, 'success');
                }
            }else{

                echo "Onword Unable to book your ticket".var_dump($block_key);
                exit;
            }


        }else{
            echo "Error Processing ....!";
        }

        // $this->load->view('website_template', $data);

    }


    public function return_booking_process(){

        // echo "Return";

        $bookingKey = uniqid();
        $return = $this->session->userdata("return");
        if($this->Booking_model->create_booking($bookingKey,$return)){

            // redirect('/');
            $jsone= array();


            $jsone['availableTripId']=$return['busId'];
            $jsone['boardingPointId']=$return['bPoint'];
            $jsone['destination']= $return['destid'];

            $jsone['inventoryItems']=array();


            $seatNo = explode(",", $return['seats']);

            $count = count($this->session->userdata('fname'));
            $per_head = $return['amount']/$count;


            $email			= $this->session->userdata('email');
            $mobile			= $this->session->userdata('mobile');
            $emergency_no	= $this->session->userdata('emergency_no');
            $fname			= $this->session->userdata('fname');
            $lname			= $this->session->userdata('lname');
            $age			= $this->session->userdata('age');
            $gender 		= $this->session->userdata('gender');


            for($i=0; $i<$count; $i++){

                //$gender = "gender".$i;
                $gndr = $gender[0] == 'F' ? 'female' : 'male';


                $jsone['inventoryItems'][$i]['seatName'] = $seatNo[$i];
                $jsone['inventoryItems'][$i]['ladiesSeat'] = "false";
                $jsone['inventoryItems'][$i]['passenger'] = array();
                $jsone['inventoryItems'][$i]['passenger']['age'] = $age[$i];
                $jsone['inventoryItems'][$i]['passenger']['primary'] = $i == 0 ? "true" : "false";
                $jsone['inventoryItems'][$i]['passenger']['name'] = $fname[$i] . ' ' . $lname[$i];
                $jsone['inventoryItems'][$i]['passenger']['title'] = "Laabus Ticket Booking";
                $jsone['inventoryItems'][$i]['passenger']['gender'] = $gndr;
                if($i == 0):
                $jsone['inventoryItems'][$i]['passenger']['idType'] = "Pan Card";
                $jsone['inventoryItems'][$i]['passenger']['email'] = $email;
                $jsone['inventoryItems'][$i]['passenger']['idNumber'] = "123456";
                $jsone['inventoryItems'][$i]['passenger']['address'] = "Sample Address";
                $jsone['inventoryItems'][$i]['passenger']['mobile'] = $mobile;
                endif;
                $jsone['inventoryItems'][$i]['fare'] = (string)$per_head;

            }


            $jsone['source']= $return['srcid'];

            $jsonVar = json_encode($jsone);

            //echo $jsonVar;
            //echo "<br><br>----------------<br><br>";
            $block_key= blockTicket($jsonVar);
            // echo "Return";
            //echo "<br><br>----------------<br><br>";
            if($block_key!=''){

                //$this->session->set_userdata('confrm_ticket',$jsonVar);
                $this->session->set_userdata('return_block_ticket',$block_key);
                $this->session->set_userdata('return_unique_key',$bookingKey);


                //------------------ Redirecting To payment GateWay------------



                // Return url form payment gateWay URL : http://laabus.com/buses/payment_process

                $this->paymentGateway_callback($bookingKey, 'success');
            }else{

                echo "Return Unable to book your ticket";
                exit;
            }
        }else{
            echo "Error Processing ....!";
        }

        // $this->load->view('website_template', $data);

    }


    public function paymentGateway_callback($transationKey,$payment_status){
        //echo "111";
        // echo "<br><br>----------------<br><br>";
        //Onword processing
        $this->payment_process($this->session->userdata('onword_block_ticket'), $this->session->userdata('onword_unique_key'), $transationKey, $payment_status);

        //Return processing
        if($this->session->userdata("return") != ''){
            // echo "222";
            // echo "<br><br>----------------<br><br>";
            $this->payment_process($this->session->userdata('return_block_ticket'), $this->session->userdata('return_unique_key'), $transationKey, $payment_status);
        }
    }




    public function payment_process($block_ticket,$unique_key,$payment_transationKey='', $payment_status = 'failed'){
          // echo "Payment Process testing".$block_ticket;
			// exit;
	/*echo "Debigging by Venkat P";
	print("<pre>");
	print_r($this->session->all_userdata());
	die;*/
        if($block_ticket != "" && $unique_key != ""){

            if($payment_transationKey != "" && $payment_status != 'failed'){


                $con=confirmTicket($block_ticket);
               // $con =rand();
                if($con!=''){
                    //$con =rand();
                    $this->session->set_userdata('confrm_ticket',$con);

                    $this->Booking_model->update_ticket_status($con,$unique_key,$payment_transationKey,$payment_status);

                    echo "Success";
                    //echo "<br><br>----------------<br><br>";
                }else{
                    echo "Unable to book your ticket";
                    exit;
                }
            }else{

                $this->Booking_model->update_ticket_status($con,$unique_key,$payment_transationKey,$payment_status);
                echo "Faile One ";
                //echo "<br><br>----------------<br><br>";
            }
        }else{


            if($payment_transationKey != "" && $payment_status != 'failed' && ($block_ticket == "" || $unique_key == "")){
                echo "Faile  Two ";
                //  echo "<br><br>----------------<br><br>";

                // Process for failed transation system

            }else if(($payment_transationKey == "" || $payment_status == 'failed') && ($block_ticket == "" || $unique_key == "")){

                // Showing alert like booking faild
                echo "Faile Three";
                // echo "<br><br>----------------<br><br>";

            }

        }


    }

	//Checking Login Session
	function proceed(){

			  $data['category'] = $this->Cat->get_category();
			  $data['roles'] = $this->users->get_roles();

            if($this->session->userdata('email')==''){

            $this->session->set_userdata('email',$_POST['email']);
			$this->session->set_userdata('mobile',$_POST['mobile']);
			$this->session->set_userdata('emergency_no',$_POST['emergency_no']);
			$this->session->set_userdata('fname',$_POST['fname']);
			$this->session->set_userdata('lname',$_POST['lname']);
			$this->session->set_userdata('age',$_POST['age']);
                for($k=0;$k<count($_POST['fname']);$k++){
                    $this->session->set_userdata('gender'.$k,$_POST['gender'.$k]);
                }


              }
						$user_id=$this->session->userdata('user_id');
						$role_id=$this->session->userdata('role_id');
						$userlist = $this->users->get_users_list($user_id);
						$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);

		if(!check_login_status()){


			$redirect = 'Buses/validate';
			if($this->input->is_ajax_request()){

                echo "i am if";
                exit;
				echo $this->ajax_template('popup/login',$redirect);
				return;
			}else if(!$this->input->is_ajax_request()){

                echo "i am else if";
               // exit;
                $this->load->library('encrypt');

				$this->session->set_userdata($_POST);


				//$this->session->set_userdata('recharge_session_key',$encrypted_string);
                $this->session->set_userdata('login_from','buses');


               // print_r($_SESSION);
				redirect('login');
			}
		}else{
            //redirect('Recharge/

            //Buses...
			//This method will have the credentials validation
			$this->load->library('form_validation');
			$this->load->helper('security');

			             //echo "helo11111";
				$this->load->library('encrypt');

				$this->session->set_userdata($_POST);

				//$this->session->set_userdata('recharge_session_key',$encrypted_string);
				if($this->input->is_ajax_request()){
                                    //echo "helo";
                     redirect('website/buses/proceed');
					//$this->load->view('website/buses/proceed');
				}else if(!$this->input->is_ajax_request()){
                                    //echo "faill";
                                        $this->load->view('website_template/header', $data);
                                        //$this->load->view('website/buses/proceed');
                                        if( $wallet_amount < 0 )
                                        {
                                            $this->load->view('website/buses/unproceed');
                                        }
                                        else
                                        {
                                            $this->load->view('website/buses/proceed');
                                        }
                                        $this->load->view('website_template/footer');
				}


		}
	}

    // Proceed to Payment Type like wallete or payumoney

   public function paymenttype(){
		//print_r($_POST);exit;
		//$data['category'] = $this->Cat->get_category();
		//$data['roles'] = $this->users->get_roles();
		//print("<pre>");
		//echo "Test Ok";
			//exit;
		//print_r($this->session->userdata());exit;
		if(check_login_status()){

			if($this->session->userdata('user_id')!='' && $this->session->userdata('onword')!=''){
				$arr = array(
					'totalAmount' => $this->input->post_get('totalAmount'),
					'rcAmount' => $this->input->post_get('totalAmount'),
					'couponCode' => $this->input->post_get('couponCode'),
					'iscashback' => $this->input->post_get('iscashback')
				);
				$this->session->set_userdata($arr);
				if($this->input->is_ajax_request()){
				   redirect('website/buses/paymentmode');
				}else if(!$this->input->is_ajax_request()){
					// print("<pre>");
					// print_r($this->session->userdata());
					// exit;

                        //unset recharge type, to set for bus comission
                        $this->session->set_userdata('recharge_type','');
                        //Ravi.Ch -- all busses has same comission which has to configured from backend
                        $commision_amt = $this->users->get_AgentCommisionAmountBySubCat('All Buses');
                        //print_r($commision_amt);exit;
			$netcomm = 0;
			$agent_comm = $commision_amt[0]->agent_comm_value;
			$agent_ref_comm = $commision_amt[0]->agent_ref_comm_value;
			$netcomm = 0;
			$markup = 0;
			$dis = 0;

			//echo $netcomm;
			$sess_net_comm = number_format($netcomm,2);
			$data["netcomm"] = number_format($netcomm,2);
			$data["markup"] = $markup;
			$data["dis"] = $dis;
			if( $this->session->userdata('role_id') == 6 )
			{
				//$netcomm = $this->session->userdata('rcAmount')*$agent_comm/100;

				if( $commision_amt[0]->mark_comm_type == "INR" )
				{
					$markup = $commision_amt[0]->mark_comm_value;
				}
				else
				{
					$markup = $this->session->userdata('totalAmount')*$commision_amt[0]->mark_comm_value/100;
				}

				//print_r($commision_amt[0]);exit;

				if( $commision_amt[0]->dis_type == "INR" )
				{
					$dis = $commision_amt[0]->dis_value;
				}
				else
				{
					$dis = $this->session->userdata('totalAmount')*$commision_amt[0]->dis_value/100;
				}

				if( $commision_amt[0]->agent_comm_type == "INR" )
				{
					$netcomm = $commision_amt[0]->agent_comm_value;
					$this->session->set_userdata('totalAmount',$this->session->userdata('totalAmount')+$markup-$dis) ;
				}
				else
				{

					//print("<pre>");
					//print_r($this->session->userdata());
					$rc = $this->session->userdata('totalAmount');
					//$rc = $rc+$markup-$dis;
					$this->session->set_userdata('totalAmount',$rc);
					//$commision_amt[0]->agent_comm_value.":::".$this->session->userdata('totalAmount');
					//print("<pre>");
					//print_r($this->session->userdata());die;
					$netcomm = $this->session->userdata('totalAmount')*$commision_amt[0]->agent_comm_value/100;
				}
				//print_r($this->session->userdata());exit;
			}
			else
			{
				$netcomm = $this->session->userdata('totalAmount')*$agent_ref_comm/100;
			}
                        $sess_net_comm = number_format($netcomm,2);
                        $data["netcomm"] = number_format($netcomm,2);
			$data["markup"] = $markup;
			$data["dis"] = $dis;
                        //echo $this->session->userdata('totalAmount')." :: ".$sess_net_comm;exit;
			$this->session->set_userdata('netcomm',$sess_net_comm);

					$this->load->view('website_template/header', $data);
					$this->load->view('website/buses/paymentmode',$data);
					$this->load->view('website_template/footer');
				}

			}else{ redirect('buses');}
		}else { redirect('login');}
	}

    function paymenttopay(){

        if($this->input->post_get('payment')){
            $user_id=$this->session->userdata('user_id');
            $role_id=$this->session->userdata('role_id');
            $wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);

            $tcAmount = $this->input->post_get('totalAmount');


            $amt = ($this->input->post_get('payment')=="Payu")?(($tcAmount>$wallet_amount)?$this->input->post_get('payamount'):$rcAmount):$this->input->post_get('payamount');
            //$wamt = ($rcAmount>$wallet_amount)?"0":($wallet_amount-$rcAmount);
            $wamt = ($this->input->post_get('walamount')=="1")?(($tcAmount>$wallet_amount)?"0":($wallet_amount-$rcAmount)):$wallet_amount;
            //echo $wamt;exit;

            $sales_id =uniqid();


            if($this->input->post_get('payment')=="Wallet"){
                if($tcAmount < $wallet_amount){
                    $balance = $wallet_amount -$tcAmount+$this->session->userdata('netcomm');
                    $this->onword_booking_process();

                    $data = array(
                        'wallet' => $balance
                    );

                    $this->db->where('user_id', $this->session->userdata('user_id'));
                    $this->db->update('users', $data);

					//update tranasction
					 $data1 = array(
                        'transaction_status' => 1
                    );
					$this->db->where('id', $this->session->userdata('trans_id'));
                    $this->db->update('transaction', $data1);
					//end update transaction

                }
				$this->sendtktSMS();
                //redirect('user/Orders#menu1');
				if($role_id == 6 )
				{
					//redirect('user/Orders#menu1');
					$tin = $this->session->userdata('confrm_ticket');
					redirect('user/PrintTicket/'.$tin);
				}
				else
				{

					redirect('user/Orders#menu1');
				}

                exit;
            }else{
                //redirect('Payment?txnid='.$sales_id.'&op=bus&amount='.$tcAmount);
				$this->session->set_userdata("txnid", $sales_id);
							//SET FORM
							$str ='<form style="display:none" action="http://laabus.com/merchant_bus/submit.php" id="fff" method="post"   onload="">

<INPUT TYPE="hidden" NAME="product" value="TRAVEL">
<INPUT TYPE="hidden" NAME="prodid" value="TRAVEL">
<INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">

<INPUT TYPE="hidden" NAME="clientcode" value="007">
<INPUT TYPE="hidden" NAME="AccountNo" value="1234567890">

<INPUT TYPE="hidden" NAME="ru" value="http://laabus.com/merchant/service_response.php">
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
<input type="text" name="amount" value="'.$tcAmount.'" />
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
            }

        }else redirect('buses/buses');

    }
	 public function sendtktSMS()
   {
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
	$onward = $this->session->userdata('onword');

	$from = $onward["src"];
	$to = $onward["dest"];
	$jdate = date("d/m/Y",strtotime($onward["jdate"]));
	$seats = $onward["seats"];
	$serviceid = $onward["serviceid"];
	$sid = $onward["serviceid"];
	$bpname = $onward["bpname"];
	$bptime = $onward["bptime"];

	//echo $mobile."::".$amount."::".$totamount;//exit;

	//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$amount.'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
  //$message = 'Dear '.$name.', Your Wallet is filled with INR '.$totamount.'. Your net Wallet Amount is '.$tot_W_a.'. thank you for using w LAABUS . download  app @ https://goo.gl/QWUiJ';


  //$message = 'your ticket for '.$from.' to '.$to.' on '.$jdate.' is booked on laabus. seat no '.$seats.' and PNR is '.$serviceid.' . Boarding at '.$bpname.' time '.$bptime.' . Thank you for using www.laabus.com';
  $message = 'your ticket for '.$from.' to '.$to.' on '.$jdate.' is booked on laabus. seat no '.$seats.'  and PNR is '.$sid.' . Boarding at '.$bpname.' time '.$bptime.' . Thank you for using www.laabus.com';
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
	//travelelr SMS
	if ( $this->session->userdata('mobile') != '' )
	{
		$mobile = $this->session->userdata('mobile');
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
	}
	//end traveelwe
	//var_dump($return_val);
   }

}
?>