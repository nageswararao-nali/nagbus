<?php
/**
* Users model here for getting roles and data
*/
class Bus_Booking extends CI_Model {

	function __construct() {
		parent::__construct();
		//$this->load->library('session');
	}
	
	
	//Create channel partner here
	public function create_booking() {		
			date_default_timezone_set("Asia/Kolkata");
			// echo "<pre>"; print_r($_POST);
            $bookingKey = uniqid();
			$Busdata = $this->session->userdata('Busdata');
			echo "in model";
			print_r($Busdata);exit;
			$insert_to_booking = array(
						"bookingKey" => $bookingKey,
						"email"	=>	$this->input->post('email',TRUE),						
						"mobile" => $this->input->post('mobile', TRUE),
						"emergency_no" => $this->input->post('emergency_no', TRUE),
						"bus_id" => $this->input->post('bus_id'),
						"from_city" => $this->input->post('from_city'),
						"to_city" => $this->input->post('to_city'),
						"boarding" => $this->input->post('boarding'),						
						"date_of_Jrny" => date('Y-m-d', strtotime($this->input->post('date_of_Jrny'))),
						"dateof_Booking" => date('Y-m-d H:i:s'),
						"amount" => $this->input->post('amount'),
						"seats_no" => $this->input->post('seats_no'),
						"payment_status" => 'Pending'
				);
			
			$this->db->insert("bus_bookings",$insert_to_booking);
		    $this->create_mulitple_booking($bookingKey); 
        
            return true;
	}
    
    public function create_mulitple_booking($bookingKey){
        
        $count = count($_POST['fname']);
        for($i=0; $i<$count; $i++){
            $gender = "gender".$i;
            $insert_to_passengers = array(
						"booking_Key" => $bookingKey,
						"first_name"	=>	$_POST['fname'][$i],					
						"last_name" => $_POST['lname'][$i],
						"gender" =>  $_POST[$gender][0],
						//"age" =>  $_POST['age'][$i],						
						"age" =>  0					
				);
			
			$this->db->insert("bus_passengers",$insert_to_passengers);
        }
        
    }


}
?>