<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('wallet_history'));
    }

    public function index() {
        redirect('wallet/history');
    }

    public function history() {
        $wallet_history = $this->wallet_history->get_wallet_details();
        $_data['wallet_history'] = $wallet_history;
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/wallet/list', $_data);
        $this->load->view('admin_template/Footer');
    }

    public function requests() {
        $wallet_history = $this->wallet_history->get_wallet_request_details();
        $_data['wallet_history'] = $wallet_history;
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/wallet/requests', $_data);
        $this->load->view('admin_template/Footer');
    }
	
	 public function reminder() {
        //$wallet_history = $this->wallet_history->get_wallet_request_details();
       // $_data['wallet_history'] = $wallet_history;
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/wallet/reminder');
        $this->load->view('admin_template/Footer');
    }
	public function sendReminder() {
		//print_r($_REQUEST);exit;
		$query = $this->db->query("select mobile,name,wallet from users where wallet <=".$_REQUEST["min_wallet_amoun"]);
        //echo $query;exit;
       $data= $query->result_array();
	   
	   //print("<pre>");
	   //print_r($data);
	  // exit;
	  if(!empty($data))
	  {
		  foreach($data as $key=>$value)
		  {
			  $mobile = $value["mobile"];
			  $name = $value["name"];
			  $wallet = $value["wallet"];
			  
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



	//$mobile = '9177531066';

	$message='Dear '.$name.', Your Wallet is left with INR '.$wallet.'. add funds in  LaabusWallet, thank you for using LAABUS .';

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
	//exit;

								//SMD
		  }
	  }
	  redirect("Wallet/reminder");
	}

    public function requests_edit($id) {
        $_data['wallet_history'] = $this->wallet_history->get_wallet_info($id);
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/wallet/edit', $_data);
        $this->load->view('admin_template/Footer');
    }

    public function download_counter_file($file) {
        $this->load->helper('download');
        $data = file_get_contents(base_url('uploads/' . $file)); // Read the file's contents
        force_download($file, $data);
    }
    
    public function update(){
        $result = $this->wallet_history->update_wallet_info();
        redirect('wallet/requests');
    }
    
    public function requests_declined($id) {
        $_data['wallet_history'] = $this->wallet_history->get_wallet_info($id);
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/wallet/view', $_data);
        $this->load->view('admin_template/Footer');
    }
    
    public function withdraws() {
        $wallet_withdraws = $this->wallet_history->get_wallet_withdraw_details();
        $_data['wallet_withdraws'] = $wallet_withdraws;
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/wallet/withdraws', $_data);
        $this->load->view('admin_template/Footer');
    }

}
