<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'seatseller/index.php';


class Bus_ajax extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		
			
	}
	
	public function filters(){	
        //print_r($_GET);
        $data['searchResult']=$this->session->userdata('busSearchResult');
		
		$data['operators'] = json_decode($_GET['operators'], true);
        $data['busTypes'] = json_decode($_GET['busType'], true);
        $data['boardingPoints'] = json_decode($_GET['boarding'],true);
        $data['droppingPoints'] = json_decode($_GET['dropping'], true);
//       <pre>";
//        print_r($data['droppingPoints']);
//        echo "</pre>";
        $this->load->view('website/buses/filters_ajax', $data);////
		
	}
    
    public function seatLayout($busID){
        //$tripdetails = getTripDetails($busID);
        
        $data['seats'] = json_decode($_GET['seatVal']);
        $this->load->view('website/buses/seat_ajax', $data);
    }
    
   
	
}
?>