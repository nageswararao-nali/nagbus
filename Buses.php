<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require_once '/hello.php';
    require_once "seatseller/library/OAuthStore.php";
	require_once "seatseller/library/OAuthRequester.php";
	require_once "seatseller/SSAPICaller.php";

include_once 'seatseller/index.php';
//include_once '/seatseller/BuServiceList.php';


class Buses extends CI_Controller {
	
		function __construct() {
		parent::__construct();
            
		$this->load->library('session');
        $this->load->model('Bus_booking', 'Booking_model', TRUE );
        	
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
		$this->session->unset_userdata('busSearchResult');	
        $this->session->unset_userdata("onword");
        $this->session->unset_userdata("return");
        $this->session->unset_userdata('rdate');
        $this->session->unset_userdata('rjrny');
        $this->session->unset_userdata('onword_block_ticket');
        $this->session->unset_userdata('onword_unique_key');
        $this->session->unset_userdata('return_block_ticket');
        $this->session->unset_userdata('return_unique_key');
		
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
        if(!check_login_status()){
         if($this->session->userdata('rjrny') == '')
          { 
              $this->session->set_userdata('rjrny',  'Yes');
                          
              $onword = array('src' => $_POST['src'],'srcid' => $_POST['srcid'],'dest' => $_POST['dest'],'destid' => $_POST['destid'],'jdate' => $_POST['jdate'],'busId' => $_POST['busId'],'amount' => $_POST['amount'],'bPoint' => $_POST['bPoint'],'seats' => $_POST['seats'],'busType' => $_POST['busType'],'startingTime' => $_POST['startingTime'],'travels' => $_POST['travels']);
             
            $this->session->set_userdata('onword', $onword);
             
           
            if($this->session->userdata('rdate') !=''){
            redirect('/buses/busesList');
               exit;
           }
              // exit;
          }else{
             
              $return = array('src' => $_POST['src'],'srcid' => $_POST['srcid'],'dest' => $_POST['dest'],'destid' => $_POST['destid'],'jdate' => $_POST['jdate'],'busId' => $_POST['busId'],'amount' => $_POST['amount'],'bPoint' => $_POST['bPoint'],'seats' => $_POST['seats'],'busType' => $_POST['busType'],'startingTime' => $_POST['startingTime'],'travels' => $_POST['travels']);
             
              $this->session->set_userdata('return', $return);             
             
          }
		  redirect('login');
            $data['folder'] ='buses/';
		    $data['body'] = 'payment';        
            $this->load->view('website_template', $data); 
        print_r($_POST);
		}
		else{
	if($this->session->userdata('rjrny') == '')
          { 
              $this->session->set_userdata('rjrny',  'Yes');
                          
              $onword = array('src' => $_POST['src'],'srcid' => $_POST['srcid'],'dest' => $_POST['dest'],'destid' => $_POST['destid'],'jdate' => $_POST['jdate'],'busId' => $_POST['busId'],'amount' => $_POST['amount'],'bPoint' => $_POST['bPoint'],'seats' => $_POST['seats'],'busType' => $_POST['busType'],'startingTime' => $_POST['startingTime'],'travels' => $_POST['travels']);
             
            $this->session->set_userdata('onword', $onword);
             
           
            if($this->session->userdata('rdate') !=''){
            redirect('login');
               exit;
           }
              // exit;
          }else{
             
              $return = array('src' => $_POST['src'],'srcid' => $_POST['srcid'],'dest' => $_POST['dest'],'destid' => $_POST['destid'],'jdate' => $_POST['jdate'],'busId' => $_POST['busId'],'amount' => $_POST['amount'],'bPoint' => $_POST['bPoint'],'seats' => $_POST['seats'],'busType' => $_POST['busType'],'startingTime' => $_POST['startingTime'],'travels' => $_POST['travels']);
             
              $this->session->set_userdata('return', $return);             
             
          }
            $data['folder'] ='buses/';
		    $data['body'] = 'payment';        
            $this->load->view('website_template', $data); 
        print_r($_POST);

		}		
    }
    
     public function busesList(){
                      
          if($this->session->userdata('rdate')!='' && $this->session->userdata('rjrny')!=''){ 
              
             // print_r($this->session->userdata('onword'));
                     
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
                    
                       if(!isset($jsonresult['availableTrips'][0]['AC'])){                   
                              $t=array();
                              $t[0] = $jsonresult['availableTrips'];
                              $jsonresult['availableTrips'] = $t;
                          }                           
//                         if(isset($jsonresult[0]['AC'])){ // // }else{ // $t=array(); // $t[0] = $jsonresult; // $jsonresult = $t; // }
                    
					
					$this->session->set_userdata('busSearchResult',$jsonresult);
					}else{
					$jsonresult=$this->session->userdata('busSearchResult');	
					}
					 
		    $data['from'] = $from;
                    $data['to'] = $to;
                    $data['srcid'] = $sourceid;
                    $data['destid'] = $destid;
                    $data['jdate'] = $jdate;
				    $data['folder'] ='buses/';
				    $data['body'] = 'bus_search';
					$data['jsonresult'] =  $jsonresult;
                    $data['cities'] = getSourcesAsDropDownList();
         
          
					
//                       echo "<pre>";
//						print_r($jsonresult);
//						echo "</pre>";
					$this->load->view('website_template',$data);
        
    }
    
    
    
      public function booking_process(){
          $bookingKey = uniqid();
          
       if($this->Booking_model->create_booking($bookingKey)){
		   
          // redirect('/');   
        $jsone= array();
                               
           
        $jsone['availableTripId']=$this->input->post('bus_id');
        $jsone['boardingPointId']=$this->input->post('boarding');
        $jsone['destination']= $this->input->post('destid');

        $jsone['inventoryItems']=array();
           
           
           $seatNo = explode(",", $this->input->post('seats_no'));
           
             $count = count($_POST['fname']);
             $per_head = $this->input->post('amount')/$count;
           
        for($i=0; $i<$count; $i++){
			
            $gender = "gender".$i;           
            $gndr = $_POST[$gender][0] == 'F' ? 'female' : 'male';
            
            $jsone['inventoryItems'][$i]['seatName'] = $seatNo[$i];
            $jsone['inventoryItems'][$i]['ladiesSeat'] = "false";
            $jsone['inventoryItems'][$i]['passenger'] = array();
                    $jsone['inventoryItems'][$i]['passenger']['age'] = $_POST['age'][$i];
                    $jsone['inventoryItems'][$i]['passenger']['primary'] = $i == 0 ? "true" : "false";
                    $jsone['inventoryItems'][$i]['passenger']['name'] = $_POST['fname'][$i] . ' ' . $_POST['lname'][$i];
                    $jsone['inventoryItems'][$i]['passenger']['title'] = "Laabus Ticket Booking";
                    $jsone['inventoryItems'][$i]['passenger']['gender'] = $gndr; 
                    if($i == 0):
                    $jsone['inventoryItems'][$i]['passenger']['idType'] = "Pan Card"; 
                    $jsone['inventoryItems'][$i]['passenger']['email'] = $this->input->post('email',TRUE); 
                    $jsone['inventoryItems'][$i]['passenger']['idNumber'] = "123456"; 
                    $jsone['inventoryItems'][$i]['passenger']['address'] = "Sample Address"; 
                    $jsone['inventoryItems'][$i]['passenger']['mobile'] = $this->input->post('mobile', TRUE);
                    endif;
                    $jsone['inventoryItems'][$i]['fare'] = $per_head;
                                  
        }          
           
            
         $jsone['source']= $this->input->post('srcid');
           
           $jsonVar = json_encode($jsone);
           
           $block_key= blockTicket($jsonVar);
           $block_key;
           
          //$this->session->set_userdata('confrm_ticket',$jsonVar);
           $this->session->set_userdata('block_ticket',$block_key);
           $this->session->set_userdata('unique_key',$bookingKey);
          
           
           //------------------ Redirecting To payment GateWay------------
           
           
           
           // Return url form payment gateWay URL : http://laabus.com/buses/payment_process
            
            $this->payment_process('123455', 'success'); 
           
       }else{
           echo "Error Processing ....!";
       }
        
       // $this->load->view('website_template', $data);
        
    }
    
    
    public function payment_process($payment_transationKey='', $payment_status = 'failed'){
      //  echo "Payment Process testing";
        $block_ticket = $this->session->userdata('block_ticket');
        $unique_key = $this->session->userdata('unique_key');
        
        
        
        if($block_ticket != "" && $unique_key != ""){
            
            if($payment_transationKey != "" && $payment_status != 'failed'){   
                
                
               // $con=confirmTicket($block_ticket);
                
                $this->session->set_userdata('confrm_ticket',$con);
                                   
                $this->Booking_model->update_ticket_status($con,$unique_key,$payment_transationKey,$payment_status);
                
                echo "Success";
                
            }else{
                
                $this->Booking_model->update_ticket_status($con,$unique_key,$payment_transationKey,$payment_status);  
                echo "Faile One ";
            }
        }else{
            
       
            if($payment_transationKey != "" && $payment_status != 'failed' && ($block_ticket == "" || $unique_key == "")){   
                echo "Faile  Two ";
                
                 // Process for failed transation system  
                
            }else if(($payment_transationKey == "" || $payment_status == 'failed') && ($block_ticket == "" || $unique_key == "")){
                
                // Showing alert like booking faild
                echo "Faile Three";
                
            }
            
        }
        
        
       
    }
	
	 public function onword_booking_process(){
          
         
          
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
           
             $count = count($_POST['fname']);
             $per_head = $onword['amount']/$count;
           
        for($i=0; $i<$count; $i++){
			
            $gender = "gender".$i;           
            $gndr = $_POST[$gender][0] == 'F' ? 'female' : 'male';
            
            $jsone['inventoryItems'][$i]['seatName'] = $seatNo[$i];
            $jsone['inventoryItems'][$i]['ladiesSeat'] = "false";
            $jsone['inventoryItems'][$i]['passenger'] = array();
                    $jsone['inventoryItems'][$i]['passenger']['age'] = $_POST['age'][$i];
                    $jsone['inventoryItems'][$i]['passenger']['primary'] = $i == 0 ? "true" : "false";
                    $jsone['inventoryItems'][$i]['passenger']['name'] = $_POST['fname'][$i] . ' ' . $_POST['lname'][$i];
                    $jsone['inventoryItems'][$i]['passenger']['title'] = "Laabus Ticket Booking";
                    $jsone['inventoryItems'][$i]['passenger']['gender'] = $gndr; 
                    if($i == 0):
                    $jsone['inventoryItems'][$i]['passenger']['idType'] = "Pan Card"; 
                    $jsone['inventoryItems'][$i]['passenger']['email'] = $this->input->post('email',TRUE); 
                    $jsone['inventoryItems'][$i]['passenger']['idNumber'] = "123456"; 
                    $jsone['inventoryItems'][$i]['passenger']['address'] = "Sample Address"; 
                    $jsone['inventoryItems'][$i]['passenger']['mobile'] = $this->input->post('mobile', TRUE);
                    endif;
                    $jsone['inventoryItems'][$i]['fare'] = $per_head;
                                  
        }          
           
            
         $jsone['source']= $onword['srcid'];
           
           $jsonVar = json_encode($jsone);
           
           $block_key= blockTicket($jsonVar);
           
           if($block_key!=''){
               
    
           
           //$this->session->set_userdata('confrm_ticket',$jsonVar);
           $this->session->set_userdata('onword_block_ticket',$block_key);
           $this->session->set_userdata('onword_unique_key',$bookingKey);
          
           
           //------------------ Redirecting To payment GateWay------------
           
           
           
           // Return url form payment gateWay URL : http://laabus.com/buses/payment_process
            
            $this->paymentGateway_callback('123455', 'success');
           
           
           if($this->session->userdata("return") != ''){
               
            $this->return_booking_process();
                          
         
           }
                 }
             
          
       }else{
           echo "Error Processing ....!";
       }
        
       // $this->load->view('website_template', $data);
        
    }
    
    
      
     public function return_booking_process(){
          
         
          
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
           
             $count = count($_POST['fname']);
             $per_head = $return['amount']/$count;
           
        for($i=0; $i<$count; $i++){
			
            $gender = "gender".$i;           
            $gndr = $_POST[$gender][0] == 'F' ? 'female' : 'male';
            
            $jsone['inventoryItems'][$i]['seatName'] = $seatNo[$i];
            $jsone['inventoryItems'][$i]['ladiesSeat'] = "false";
            $jsone['inventoryItems'][$i]['passenger'] = array();
                    $jsone['inventoryItems'][$i]['passenger']['age'] = $_POST['age'][$i];
                    $jsone['inventoryItems'][$i]['passenger']['primary'] = $i == 0 ? "true" : "false";
                    $jsone['inventoryItems'][$i]['passenger']['name'] = $_POST['fname'][$i] . ' ' . $_POST['lname'][$i];
                    $jsone['inventoryItems'][$i]['passenger']['title'] = "Laabus Ticket Booking";
                    $jsone['inventoryItems'][$i]['passenger']['gender'] = $gndr; 
                    if($i == 0):
                    $jsone['inventoryItems'][$i]['passenger']['idType'] = "Pan Card"; 
                    $jsone['inventoryItems'][$i]['passenger']['email'] = $this->input->post('email',TRUE); 
                    $jsone['inventoryItems'][$i]['passenger']['idNumber'] = "123456"; 
                    $jsone['inventoryItems'][$i]['passenger']['address'] = "Sample Address"; 
                    $jsone['inventoryItems'][$i]['passenger']['mobile'] = $this->input->post('mobile', TRUE);
                    endif;
                    $jsone['inventoryItems'][$i]['fare'] = $per_head;
                                  
        }          
           
            
         $jsone['source']= $return['srcid'];
           
           $jsonVar = json_encode($jseone);
           
           $block_key= blockTicket($jsonVar);
        if($block_key!=''){
           
          //$this->session->set_userdata('confrm_ticket',$jsonVar);
           $this->session->set_userdata('return_block_ticket',$block_key);
           $this->session->set_userdata('return_unique_key',$bookingKey);
          
           
           //------------------ Redirecting To payment GateWay------------
           
           
           
           // Return url form payment gateWay URL : http://laabus.com/buses/payment_process
            
            $this->paymentGateway_callback('123455', 'success'); 
        }
       }else{
           echo "Error Processing ....!";
       }
        
       // $this->load->view('website_template', $data);
        
    }
    
    
    public function paymentGateway_callback($transationKey,$payment_status){
        
        //Onword processing 
        $this->payment_process($this->session->userdata('onword_block_ticket'), $this->session->userdata('onword_unique_key'), $transationKey, $payment_status);
        
        //Return processing
         if($this->session->userdata("return") != ''){
               
            $this->payment_process($this->session->userdata('return_block_ticket'), $this->session->userdata('return_unique_key'), $transationKey, $payment_status);
        }
    }
    
    
    
    
    
    
        

}
?>