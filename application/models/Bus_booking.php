<?php
/**
* Users model here for getting roles and data
*/
class Bus_Booking extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
	
	
	//Create channel partner here
	//Create channel partner here
	public function create_booking($bookingKey,$sessionData) {		
			date_default_timezone_set("Asia/Kolkata");
			// echo "<pre>"; print_r($_POST);
            //$bookingKey = uniqid();
		
		
		//echo "SUB CAT:".$subcatid;
		$this->db->select('agent_comm_type,agent_ref_comm_type,agent_comm_value,agent_ref_comm_value,mark_comm_type,mark_comm_value,dis_type,dis_value,our_comm_type,our_comm_value');
		$this->db->from('va_commissions_all');
		/*if( $subcatid == 'BSNL' && $this->session->userdata('recharge_type') == "Mobile postpaid" )
		{
			$subcatid = 'BSNL Top Up';
		}
		if( $subcatid == 'BSNL' && $this->session->userdata('recharge_type') == "Mobile prepaid" )
		{
			$subcatid = 'BSNL Top Up';
		}*/
		$this->db->where('sub_cat_names', 'All Buses');
		/*if( $this->session->userdata('recharge_type') == "Mobile prepaid")
		{
			$this->db->where('bill_type', 1);
		}
		else if( $this->session->userdata('recharge_type') == "Mobile postpaid")
		{
			$this->db->where('bill_type', 2);
		}*/
		$query = $this->db->get();
		//print_r($query->result());
                //echo $this->db->last_query();
        $commision_amt =  $query->result();
		
		if( $commision_amt[0]->mark_comm_type == "INR" )
				{
					 $markup = $commision_amt[0]->mark_comm_value;
				}
				else
				{
					 $markup = $sessionData['amount']*$commision_amt[0]->mark_comm_value/100;
				}
				
				//COMM DIST. 18122016
				$TotAmount =$sessionData['amount'];
				if($commision_amt[0]->our_comm_type == "PEC")
		{
			$our_comm_value = ($commision_amt[0]->our_comm_value*$TotAmount)/100;
		}
		else
		{
			$our_comm_value = $commision_amt[0]->our_comm_value;
		}
		
		if($resultdata[0]["agent_comm_type"] == "PEC")
		{
			//$agent_comm_value = ($resultdata[0]["agent_comm_value"]*$TotAmount)/100;
			$agent_comm_value = $this->session->userdata('netcomm');
		}
		else
		{
			//$agent_comm_value = $resultdata[0]["agent_comm_value"];
			$agent_comm_value = $this->session->userdata('netcomm');
			
		}
		//$tot_comm_value = $agent_comm_value+$our_comm_value;
		$total_comm = $our_comm_value;
		$total_comm_after_agent = $total_comm - $this->session->userdata("netcomm");
		
		/*if($resultdata[0]["agent_ref_comm_type"] == "PEC")
		{
			$agent_ref_comm_value = ($resultdata[0]["agent_ref_comm_value"]*$TotAmount)/100;
		}
		else
		{
			$agent_ref_comm_value = $resultdata[0]["agent_ref_comm_value"];
		}*/
		
		
		//get user data
		$udid = $this->session->userdata("user_id");
		$res = $this->db->query("SELECT * FROM `users` WHERE `user_id` = $udid ");
		$resultdata = $res->result_array();
		$dis_name = $resultdata["0"]["district_name"];


		$res = $this->db->query("SELECT * FROM `users` WHERE `district_name` = '$dis_name' and role_id=2 ");
		$resultdata = $res->result_array();
		$channel_part_id = 0;
		if(!empty($resultdata))
		{
			$channel_part_id = $resultdata["0"]["user_id"];			
		}
		$this->session->set_userdata('channel_part_userid',$channel_part_id);
		
		
		//total coom after SMD
		//SMD COMMISION
		$res = $this->db->query("SELECT * FROM `va_commissions_channel_all` WHERE `type` = 0 ");
		$resultdata = $res->result_array();
		$smd = 0;
		$smd_comm = $total_comm_after_agent*$resultdata[0]["smd_percentage"]/100;
		$total_comm_after_agent_and_smd = $total_comm_after_agent - $smd_comm;
				
		
		//$smd_comm = 0;
		//$cm = $our_comm_value*$this->session->userdata("rcAmount")/100;
		$chnl_comm = ($total_comm_after_agent_and_smd)*$resultdata[0]["term1_percentage"]/100;
		$this->session->set_userdata('channel_part_comm',$chnl_comm);
		$labbus_percentage = 100-$resultdata[0]["term1_percentage"]; 
		$laabus_comm = ($total_comm_after_agent_and_smd)*$labbus_percentage/100;
		//END SMD COMMISION
		
		
				//END COOMMM DIST. 18122016
				
				
        $sessionData['amount']  = $sessionData['amount']-$markup;
           $bookingDate = date('Y-m-d H:i:s');
			$insert_to_booking = array(
						"bookingKey" => $bookingKey,						
						"email"	=>	$this->session->userdata('email'),						
						"mobile" => $this->session->userdata('mobile'),
						"emergency_no" => $this->session->userdata('emergency_no'),
						"bus_id" => $sessionData['busId'],
                        "src_id" => $sessionData['srcid'],
						"dest_id" => $sessionData['destid'],
						"from_city" => $sessionData['src'],
						"to_city" => $sessionData['dest'],
						"boarding" =>$sessionData['bPoint'],						
						"date_of_Jrny" => date('Y-m-d', strtotime($sessionData['jdate'])),
						"dateof_Booking" => $bookingDate,
						"amount" => $sessionData['amount'],
						"seats_no" => $sessionData['seats'],
						"payment_status" => 'Pending',
                        "booking_status" => 'Processing',
						"user_id" => $this->session->userdata('user_id')
				);
			
			$this->db->insert("bus_bookings",$insert_to_booking);
			$bus_booking_id =  $this->db->insert_id();
			//insert to tranasction table//
			$insert_to_tranasction = array(					
								
						"mobile_no" => $this->session->userdata('mobile'),
						"bus_boooking_id" => $bus_booking_id,						
						"amount" => $sessionData['amount'],
						"order_date" => $bookingDate,					
						"end_user_id" => $this->session->userdata('user_id'),
						"agent_id" => $this->session->userdata('user_id'),
						"agent_comm" =>	$this->session->userdata('netcomm'),
						"laabus_comm"=>$laabus_comm, //18122016 added
						"smd_comm"=>$smd_comm,
						"smd_user_id"=>66,
						"channel_part_comm"=>$chnl_comm,
						"channel_part_id"=>$channel_part_id, //56 testing hard coded
						"agent_ref_comm" =>	0,						
						"transaction_status" =>0
				);
			$this->db->insert("transaction",$insert_to_tranasction);
			$trans_id =  $this->db->insert_id();
			$this->session->set_userdata("trans_id",$trans_id);
			//
				/*echo "DEBUGGING TEST";
		  print("<pre>");
          print_r($this->session->userdata());
		  die;*/
		    $this->create_mulitple_booking($bookingKey,$bookingDate,$sessionData['amount'],$sessionData['seats']); 
        
            return true;
	}
    
    public function create_mulitple_booking($bookingKey,$bookingDate,$tamount,$seatss){
        
         $count = count($this->session->userdata('fname'));
        $fare_perHead = $tamount/$count;
        $seats = explode(",", $seatss);
        $email			= $this->session->userdata('email');		
		$mobile			= $this->session->userdata('mobile');		
		$emergency_no	= $this->session->userdata('emergency_no');		
		$fname			= $this->session->userdata('fname');	
		$lname			= $this->session->userdata('lname');		
		$age			= $this->session->userdata('age');
        $gender        = $this->session->userdata('gender');
      
        for($i=0; $i<$count; $i++){
          // $gndr = 'Male';
           //if($gender[$i] == 'M'){ $gndr = 'Male';}else { $gndr = 'Female';}
            
            $insert_to_passengers = array(
							"bookingKey" => $bookingKey,
						"first_name"	=>	$fname[$i],					
						"last_name" => $lname[$i],
						"gender" =>  'M',
						"age" =>  $age[$i],	
                        "fair" => $fare_perHead,
						"seat_name" => $seats[$i],
                        "date_of_booking" => $bookingDate,						
                        "status" => 'pending'                
				);
			
			$this->db->insert("bus_passengers",$insert_to_passengers);
            
             //print_r($insert_to_passengers);
        }
       
        
        
    }
    
    
	
	//APP BUS SERVICE
	public function create_booking_app($bookingKey,$sessionData) {		
			date_default_timezone_set("Asia/Kolkata");
			// echo "<pre>"; print_r($_POST);
            //$bookingKey = uniqid();
		
		$user_id = $_REQUEST['user_id']; // hardcode 184 venkat
		//echo "SUB CAT:".$subcatid;
		$this->db->select('agent_comm_type,agent_ref_comm_type,agent_comm_value,agent_ref_comm_value,mark_comm_type,mark_comm_value,dis_type,dis_value,our_comm_type,our_comm_value');
		$this->db->from('va_commissions_all');
		/*if( $subcatid == 'BSNL' && $this->session->userdata('recharge_type') == "Mobile postpaid" )
		{
			$subcatid = 'BSNL Top Up';
		}
		if( $subcatid == 'BSNL' && $this->session->userdata('recharge_type') == "Mobile prepaid" )
		{
			$subcatid = 'BSNL Top Up';
		}*/
		$this->db->where('sub_cat_names', 'All Buses');
		/*if( $this->session->userdata('recharge_type') == "Mobile prepaid")
		{
			$this->db->where('bill_type', 1);
		}
		else if( $this->session->userdata('recharge_type') == "Mobile postpaid")
		{
			$this->db->where('bill_type', 2);
		}*/
		$query = $this->db->get();
		//print_r($query->result());
                //echo $this->db->last_query();
        $commision_amt =  $query->result();
		
		//get total fare amount without markup
		$busfare = 0;
		foreach($sessionData->inventoryItems as $kq =>$vq)
		{
			$busfare += $vq->fare;
		}
		
		//$busfare =100;
		
		//end get total fare amount without markup
		//$sessionData['amount'] = $busfare;
		
		//echo $commision_amt[0]->mark_comm_value;
		//var_dump($commision_amt);
		if( $commision_amt[0]->mark_comm_type == "INR" )
				{
					 $markup = $commision_amt[0]->mark_comm_value;
				}
				else
				{
					// $markup = $sessionData['amount']*$commision_amt[0]->mark_comm_value/100;
					$markup = $busfare*$commision_amt[0]->mark_comm_value/100;
				}
				
				//COMM DIST. 18122016
				$TotAmount = $busfare+$markup;
				
				if($commision_amt[0]->our_comm_type == "PEC")
		{
			$our_comm_value = ($commision_amt[0]->our_comm_value*$TotAmount)/100;
		}
		else
		{
			$our_comm_value = $commision_amt[0]->our_comm_value;
		}
		
		//if($resultdata[0]["agent_comm_type"] == "PEC")
		if( $commision_amt[0]->agent_comm_type == "PEC" )
		{
			$agent_comm_value = ($commision_amt[0]->agent_comm_value*$TotAmount)/100;
			//$agent_comm_value = $this->session->userdata('netcomm');
		}
		else
		{
			$agent_comm_value = $commision_amt[0]->agent_comm_value;
			//$agent_comm_value = $this->session->userdata('netcomm');
			
		}
		
		
		//echo $agent_comm_value;
		//$tot_comm_value = $agent_comm_value+$our_comm_value;
		$total_comm = $our_comm_value;
		//$total_comm_after_agent = $total_comm - $this->session->userdata("netcomm");
		$total_comm_after_agent = $total_comm - $agent_comm_value;
		
		/*if($resultdata[0]["agent_ref_comm_type"] == "PEC")
		{
			$agent_ref_comm_value = ($resultdata[0]["agent_ref_comm_value"]*$TotAmount)/100;
		}
		else
		{
			$agent_ref_comm_value = $resultdata[0]["agent_ref_comm_value"];
		}*/
		
		
		//get user data
		//$udid = $this->session->userdata("user_id");
		$udid = $user_id;
		$res = $this->db->query("SELECT * FROM `users` WHERE `user_id` = $udid ");
		$resultdata = $res->result_array();
		$dis_name = $resultdata["0"]["district_name"];
		$email_user = $resultdata["0"]["email_id"];
		$mobile_user = $resultdata["0"]["mobile"];


		$res = $this->db->query("SELECT * FROM `users` WHERE `district_name` = '$dis_name' and role_id=2 ");
		$resultdata = $res->result_array();
		$channel_part_id = 0;
		if(!empty($resultdata))
		{
			$channel_part_id = $resultdata["0"]["user_id"];			
		}
		////$this->session->set_userdata('channel_part_userid',$channel_part_id);
		
		
		//total coom after SMD
		//SMD COMMISION
		$res = $this->db->query("SELECT * FROM `va_commissions_channel_all` WHERE `type` = 0 ");
		$resultdata = $res->result_array();
		$smd = 0;
		$smd_comm = $total_comm_after_agent*$resultdata[0]["smd_percentage"]/100;
		$total_comm_after_agent_and_smd = $total_comm_after_agent - $smd_comm;
				
		
		//$smd_comm = 0;
		//$cm = $our_comm_value*$this->session->userdata("rcAmount")/100;
		$chnl_comm = ($total_comm_after_agent_and_smd)*$resultdata[0]["term1_percentage"]/100;
		////$this->session->set_userdata('channel_part_comm',$chnl_comm);
		$labbus_percentage = 100-$resultdata[0]["term1_percentage"]; 
		$laabus_comm = ($total_comm_after_agent_and_smd)*$labbus_percentage/100;
		//END SMD COMMISION
		
		
				//END COOMMM DIST. 18122016
				
				
        ////$sessionData['amount']  = $sessionData['amount']-$markup;
           $bookingDate = date('Y-m-d H:i:s');
          
			$insert_to_booking = array(
						"bookingKey" => $bookingKey,						
						"email"	=>	$email_user,						
						"mobile" => $mobile_user,
						"emergency_no" => $mobile_user,
						//"bus_id" => $sessionData['busId'],
						"bus_id" => $sessionData->availableTripId,
                        			"src_id" => $sessionData->boardingPointId,
						"dest_id" => $sessionData->destination,
						"from_city" => $_REQUEST['from_city'],
						"to_city" => $_REQUEST['to_city'],
						"boarding" =>$sessionData->boardingPointId,					
						"date_of_Jrny" => $_REQUEST['date_of_Jrny'],
						"dateof_Booking" => $bookingDate,
						"amount" => $busfare,
						"seats_no" => $sessionData->inventoryItems[0]->seatName,
						"payment_status" => 'Pending',
                        "booking_status" => 'Processing',
						"user_id" => $udid
				);
			
			$this->db->insert("bus_bookings",$insert_to_booking);
			$bus_booking_id =  $this->db->insert_id();
			//$bus_booking_id = 1;
			
			//echo "INSERT ID:".$bus_booking_id;die;
			//insert to tranasction table//
			//echo "NET:".$agent_comm_value;die;
			$insert_to_tranasction = array(					
								
						"mobile_no" =>$mobile_user,
						"bus_boooking_id" => $bus_booking_id,						
						"amount" => $busfare,
						"order_date" => $bookingDate,					
						"end_user_id" => $udid,
						"agent_id" => $udid,
						"agent_comm" =>	$agent_comm_value,
						"laabus_comm"=>$laabus_comm, //18122016 added
						"smd_comm"=>$smd_comm,
						"smd_user_id"=>66,
						"channel_part_comm"=>$chnl_comm,
						"channel_part_id"=>$channel_part_id, //56 testing hard coded
						"agent_ref_comm" =>	0,						
						"transaction_status" =>0
				);
			$this->db->insert("transaction",$insert_to_tranasction);
			$trans_id =  $this->db->insert_id();
			//echo "TRANSACTION INSERT ID:".$trans_id;die;
			//$this->session->set_userdata("trans_id",$trans_id);
			//
				/*echo "DEBUGGING TEST";
		  print("<pre>");
          print_r($this->session->userdata());
		  die;*/
		    ///$this->create_mulitple_booking_app($bookingKey,$bookingDate,$sessionData['amount'],$sessionData['seats']); 
			$this->create_mulitple_booking_app($bookingKey,$bookingDate,$busfare,$sessionData->inventoryItems[0]->seatName,$sessionData);
        
            return true;
	}
    
    public function create_mulitple_booking_app($bookingKey,$bookingDate,$tamount,$seatss,$sessionData){
        
        /* $count = count($this->session->userdata('fname'));
        $fare_perHead = $tamount/$count;
        $seats = explode(",", $seatss);
        $email			= $this->session->userdata('email');		
		$mobile			= $this->session->userdata('mobile');		
		$emergency_no	= $this->session->userdata('emergency_no');		
		$fname			= $this->session->userdata('fname');	
		$lname			= $this->session->userdata('lname');		
		$age			= $this->session->userdata('age');
        $gender        = $this->session->userdata('gender');
      
        for($i=0; $i<$count; $i++){
          // $gndr = 'Male';
           //if($gender[$i] == 'M'){ $gndr = 'Male';}else { $gndr = 'Female';}
            
            $insert_to_passengers = array(
							"bookingKey" => $bookingKey,
						"first_name"	=>	$fname[$i],					
						"last_name" => $lname[$i],
						"gender" =>  'M',
						"age" =>  $age[$i],	
                        "fair" => $fare_perHead,
						"seat_name" => $seats[$i],
                        "date_of_booking" => $bookingDate,						
                        "status" => 'pending'                
				);
			
			$this->db->insert("bus_passengers",$insert_to_passengers);
        */    
             //print_r($insert_to_passengers);
			 foreach($sessionData->inventoryItems as $kq =>$vq)
			 {
				 
				  $insert_to_passengers = array(
						"bookingKey" => $bookingKey,
						"first_name"	=>	$vq->passenger->name,					
						"last_name" => '',
						"gender" =>  $vq->passenger->gender,
						"age" =>  $vq->passenger->age,	
                        "fair" => $vq->fare,
						"seat_name" => $vq->seatName,
                        "date_of_booking" => $bookingDate,						
                        "status" => 'pending'                
				);
			
			$this->db->insert("bus_passengers",$insert_to_passengers);
				 
			 }
			 
			 //exit("Looks Good");
     
       
        
        
    }
	
	
		public function update_ticket_status_app($tin ='',$bookingKey , $payment_transationID, $payment_status ){
        
       // if($tin!='' && $bookingKey != '' && $payment_transationID != '' && $payment_status!='failed'){
		   if($tin!='' && $bookingKey != '' ){
				//send SMS
				$uid="766172696e69696e666f"; //your uid
				$pin="ccdb37d4de7737d75924ab4507e03303"; //your api pin
				$sender="LAABUS"; // approved sender id
				$domain="smsalertbox.com"; // connecting url 
				$route="5";// 0-Normal,1-Priority
				$method="POST";
				//---------------------------------

				/*$mobile = 9177531066;
				$name = "VenkatRamana";	*/
				$amount="0";
				

				/*$user_id=184;
				$role_id=6;
				*/
				$udid = $_REQUEST["user_id"];
				$res = $this->db->query("SELECT * FROM `users` WHERE `user_id` = $udid ");
				$resultdata = $res->result_array();
				$name = $resultdata["0"]["name"];
				$user_id = $resultdata["0"]["user_id"];
				$role_id = $resultdata["0"]["role_id"];
				$mobile = $resultdata["0"]["mobile"];
				//$mobile = "9177531066";  //here remove venkat
		
		
				///$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
				////$tot_W_a = $wallet_amount+$totamount;

				//echo $mobile."::".$_POST['amount']."::".$totamount;//exit;

				//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
				//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
				//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$totamount.'. Your net Wallet Amount is '.$tot_W_a.'. thank you for using w LAABUS . download  app @ https://goo.gl/QWUiJ';
				
				$message = 'Dear '.$name.', your ticket has been booked successfully with the transaction ID '.$tin.' please visit www.laabus.com for more details';
				
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

				
            $data = array(
               'tin' => $tin,
               'payment_tran_id	' => $payment_transationID,
               'payment_status' => 'success',
               'booking_status' => 'confirm'             
            );

            $this->db->where('bookingKey', $bookingKey);
            $this->db->update('bus_bookings', $data); 
            
            $data = array(
               'tin' => $tin,
               'status' => 'confirm'
               
                );

            $this->db->where('bookingKey', $bookingKey);
            $this->db->update('bus_passengers', $data); 
            
        } else  if($tin!='' && $bookingKey != '' && ($payment_transationID == '' || $payment_status=='failed')){
            
            $data = array(
               'tin' => $tin,
               'payment_tran_id	' => $payment_transationID,
               'payment_status' => 'fail',
               'booking_status' => 'fail'
            );

            $this->db->where('bookingKey', $bookingKey);
            $this->db->update('bus_bookings', $data); 
            
            $data = array(
               'tin' => $tin,
               'status' => 'fail'
                );

            $this->db->where('bookingKey', $bookingKey);
            $this->db->update('bus_passengers', $data); 
            
        } 
        
        
    }
    
   
	//END APP BUS SERVICE
	public function update_ticket_status($tin ='',$bookingKey , $payment_transationID, $payment_status ){
        
        if($tin!='' && $bookingKey != '' && $payment_transationID != '' && $payment_status!='failed'){
				//send SMS
				$uid="766172696e69696e666f"; //your uid
				$pin="ccdb37d4de7737d75924ab4507e03303"; //your api pin
				$sender="LAABUS"; // approved sender id
				$domain="smsalertbox.com"; // connecting url 
				$route="5";// 0-Normal,1-Priority
				$method="POST";
				//---------------------------------

				$mobile = $this->session->userdata('mobile');
				$name = $this->session->userdata('fname');	
				$amount=$this->session->userdata('totalAmount');
				

				$user_id=$this->session->userdata('user_id');
				$role_id=$this->session->userdata('role_id');
				$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
				$tot_W_a = $wallet_amount+$totamount;

				//echo $mobile."::".$_POST['amount']."::".$totamount;//exit;

				//$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
				//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
				//$message = 'Dear '.$name.', Your Wallet is filled with INR '.$totamount.'. Your net Wallet Amount is '.$tot_W_a.'. thank you for using w LAABUS . download  app @ https://goo.gl/QWUiJ';
				
				$message = 'Dear '.$name.', your ticket has been booked successfully with the transaction ID '.$tin.' please visit www.laabus.com for more details';
				
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

				
            $data = array(
               'tin' => $tin,
               'payment_tran_id	' => $payment_transationID,
               'payment_status' => 'success',
               'booking_status' => 'confirm'             
            );

            $this->db->where('bookingKey', $bookingKey);
            $this->db->update('bus_bookings', $data); 
            
            $data = array(
               'tin' => $tin,
               'status' => 'confirm'
               
                );

            $this->db->where('bookingKey', $bookingKey);
            $this->db->update('bus_passengers', $data); 
            
        } else  if($tin!='' && $bookingKey != '' && ($payment_transationID == '' || $payment_status=='failed')){
            
            $data = array(
               'tin' => $tin,
               'payment_tran_id	' => $payment_transationID,
               'payment_status' => 'fail',
               'booking_status' => 'fail'
            );

            $this->db->where('bookingKey', $bookingKey);
            $this->db->update('bus_bookings', $data); 
            
            $data = array(
               'tin' => $tin,
               'status' => 'fail'
                );

            $this->db->where('bookingKey', $bookingKey);
            $this->db->update('bus_passengers', $data); 
            
        } 
        
        
    }
    
    public function cancelationData($data1,$data2=''){
        $refundamount = 0;
        $d1 = json_decode($data1, true);
        /*echo "Welcome";
        print("<pre>");
        print_r($d1);
        exit;*/
		//$d1["refundAmount"] = 0;
		//$d1["tin"] = "TDK364G";
		if( isset($d1['refundAmount']))
		{
			$refundamount = $d1['refundAmount'];
		$tin = $d1['tin'];
		$user_id = $this->session->userdata('user_id');
		if( isset($_REQUEST["user_id"]) )
			$user_id = $_REQUEST["user_id"];
		$result = $this->db->query("update `users` SET wallet = wallet+$refundamount  WHERE `user_id`= $user_id");
		$resultcancel = $this->db->query("update `bus_bookings` SET booking_status = 'Cancelled'   WHERE `tin`='$tin'");
		//var_dump($data1);
		//echo "<br>+++++++++++++<br>";
		//$d1 = json_decode($data1, true);
		//print("<pre>");
		//print_r($d1);
		//var_dump($data2);
		//die;
		
		//SEND CANCELLATION SMS
		$result = $this->db->query("SELECT  * FROM `bus_bookings` WHERE `tin`='$tin'")->row_array();
		$fromcity = $result['from_city'];
		$to_city = $result['to_city'];
		$date_of_Jrny = $result['date_of_Jrny'];
		$seats_no = $result['seats_no'];
		$bus_id = $result['bus_id'];
		$message ='your ticket for '.$fromcity.' to '.$to_city.' on '.$date_of_Jrny.' is booked on laabus. seat no '; $message.= $seats_no.' with PNR '.$bus_id.' has been cancelled successfully  . Thank you for using www.laabus.com';
		
		//$message = 'your ticket for #VAL# to #VAL# on #VAL# is booked on laabus. seat no #VAL# with PNR #VAL# has been cancelled successfully  . Thank you for using www.laabus.com';
		//SMS
//Code using curl
//API stands for Application Programming Integration which is widely used to integrate and enable interaction with other software, much in the same way as a user interface facilitates interaction between humans and computers. Our API codes can be easily integrated to any web or software application. 
//Change your configurations here.
//---------------------------------
            $uid = "766172696e69696e666f"; //your uid
            $pin = "ccdb37d4de7737d75924ab4507e03303"; //your api pin
            $sender = "LAABUS"; // approved sender id
            $domain = "smsalertbox.com"; // connecting url 
            $route = "5"; // 0-Normal,1-Priority
            $method = "POST";
//---------------------------------



            $mobile = $this->session->userdata('Mobile');
            $name = $this->session->userdata('name');
            //$amount=$this->session->userdata('rcAmount');
            //echo $mobile."::".$_POST['amount']."::".$totamount;//exit;
            //$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
            //$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
            //$message = 'Dear ' . $name . ', OTP for transaction varini info systems pvt ltd is ' . $otp . ' on www.laabus.com';
            //$uid=urlencode($uid);
            //$pin=urlencode($pin);
            //$sender=urlencode($sender);
            $message = urlencode($message);
            //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

            $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

            $url = "http://$domain/api/sms.php";

            $ch = curl_init($url);

            if ($method == "POST") {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
            } else {
                $get_url = $url . "?" . $parameters;

                curl_setopt($ch, CURLOPT_POST, 0);
                curl_setopt($ch, CURLOPT_URL, $get_url);
            }

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
            $return_val = curl_exec($ch);

           // var_dump($return_val);die;
		//END SEND CANCELLATION SMS
		$d1 = json_decode($data1, true);
        
        $tin= $d1['tin'];
        
        $d2 = json_decode($data2, true);
        
        $partiallyCancellable = $d2['partiallyCancellable'];
        
        if($partiallyCancellable){
            
             $data = array(
               'booking_status' => 'Partial Cancel'
            );
        }else {
            
            $data = array(
               'booking_status' => 'Cancelled'
            );
        }
        
        
        $this->db->where('tin', $tin);
        $this->db->update('bus_bookings', $data); 
        
        //'date_of_cancellation' => 
        
        $d2value = count($d2['cancellationCharges']['entry']);
        
        for($i=0;$i<$d2value;$i++){
            
            $refund = $d2['fares']['entry'][$i] - $d2['cancellationCharges']['entry'][$i]['value'];
             $data = array(
               'status' => ($d2['partiallyCancellable'] ==  'true') ? 'Partial Cancel' : 'Cancelled',
               'date_of_cancellation' => date('Y-m-d H:i:s'),
               'refund_amount' =>$refund
            );
             $this->db->where('tin', $tin);
             $this->db->update('bus_passengers', $data); 
        }
		} 
    }
    
    }
?>