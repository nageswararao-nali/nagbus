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
            
        } else   if($tin!='' && $bookingKey != '' && ($payment_transationID == '' || $payment_status=='failed')){
            
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
    
    public function cancelationData($data1,$data2){
        
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
?>