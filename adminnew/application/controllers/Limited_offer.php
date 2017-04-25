<?php

/**
 * Created by PhpStorm.
 * User: sayan
 * Date: 20/9/16
 * Time: 10:27 PM
 */

class Limited_offer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('LimitedOfferModel');
        $this->load->helper(array('form', 'url'));
    }

    public function limitedOffers ()
    {
        $offerId = $this->input->get('id');
        $fetchOffers = $this->LimitedOfferModel->getLimitedOffers($offerId);
        //print_r($fetchOffers);

       
          if (!empty($fetchOffers)) {
            $data['offers'] = $fetchOffers;
        } else {
            $data['offers'] = array();
        }
	    $this->load->view('admin_template/Header');
	    $this->load->view('dashboard/Limited_offers/viewlimitedoffers',$data);
	    $this->load->view('admin_template/Footer');
      
        
    }

    public function createOffers()
    {
        $title = $this->input->post('title');
	$startDate = $endDate = '0000-00-00 00:00:00';
        $offerStart = $this->input->post('offer_start');
	$offerStart = explode('/', $offerStart);
	if(isset($offerStart[2])){
		$startDate = $offerStart[2].'-'.$offerStart[1].'-'.$offerStart[0];
	}
	$offerEnd = $this->input->post('offer_end');
	$offerEnd = explode('/', $offerEnd);
	if(isset($offerEnd[2])){
		$endDate = $offerEnd[2].'-'.$offerEnd[1].'-'.$offerEnd[0];
	}
        $original_price = $this->input->post('original_price');
        $discount_price = $this->input->post('discount_price');
        $laabus_price = $this->input->post('laabus_price');
        $quantity = $this->input->post('quantity');
        $details = $this->input->post('details');
	$buy_now = $this->input->post('buy_now');
        $this->LimitedOfferModel->createLimitedOffers($title, $startDate, $endDate, $original_price, $discount_price, $laabus_price, $quantity, $details, $buy_now);
        
    }
     
        public function updateOffers()
    {
    	//echo "hello"; die;
        $title = $this->input->post('title');
        $id = $this->input->post('id');
        $offerStart = $this->input->post('offer_start');
        if(strpos($offerStart, '/')){
        $var = explode('/', $offerStart);
        $offerStart = $var[2].'-'.$var[1].'-'.$var[0];
        }
        $offerEnd = $this->input->post('offer_end');
        if(strpos($offerEnd, '/')){
        $var1 = explode('/', $offerEnd);
        $offerEnd = $var1[2].'-'.$var1[1].'-'.$var1[0];
        }
        $original_price = $this->input->post('original_price');
        $discount_price = $this->input->post('discount_price');
        $laabus_price = $this->input->post('laabus_price');
        $quantity = $this->input->post('quantity');
        $details = $this->input->post('details');
	$buy_now = $this->input->post('buy_now');
	if($buy_now != '') $buy_now = 1;
	else $buy_now = 0;
	$image = $_FILES['fileToUpload'];
        //print_r($offerStart); die;
        if($title){
            $var = $this->LimitedOfferModel->updateLimitedOffers($id, $title, $offerStart, $offerEnd, $original_price, $discount_price, $laabus_price, $quantity, $details, $buy_now);
            
           // redirect(base_url() . 'Limited_offer/limitedOffers/');
           if($var){
           
               $date = date('m-d-Y_H:i:s');
    	$target_dir = "uploads/offers/".$id;

    	mkdir($target_dir, 0777, true);	
       chmod($target_dir, 0777);

    	$name = 'offers_'.$id.'_'.$date;
    	$target_file = $target_dir . basename($_FILES["fileToUpload"]);
    	$uploadOk = 1;
    	$var = explode('/',$image['type']);
    	$imageFileType = $var[1];

    	if (file_exists($target_file.$name)) {
        	$updateImage->messsage = "Sorry, file already exists.";
        	$uploadOk = 0;
   	 }
    	if ($image["size"] > 1024000) {
        	$uploadOk = 0;
   	 }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
       	 $uploadOk = 0;
   	 }
    	if($uploadOk != 0){
        $filename = $id.'_'.$date.'_'.str_replace(' ','_',basename($image['name']));
        if (move_uploaded_file($image['tmp_name'],$target_dir.'/'.$filename)) {
            $updateImage->data = $filename;
            $this->LimitedOfferModel->updateImages($id,$filename);
            chmod($target_dir, 0777);
        }
    }
           
           
           
           
           
         redirect(base_url() . 'Limited_offer/limitedOffers/');
         }
         }
    }
    
    public function rediretUpdateOffer(){
        $offerId = $this->input->get('offer_id');
        //echo $offerId; die;
        if(!$offerId){
            redirect(base_url() . 'Limited_offer/limitedOffers/');
            return;
        }
        $var = $this->LimitedOfferModel->getLimitedOffers($offerId);
        
        $data['offer'] = $var[0];
       	//print_r($var); die;
        if($var){
            //redirect(base_url() . 'Limited_offer/limitedOffers/'.$offerId);
                $this->load->view('admin_template/Header');
                $this->load->view('dashboard/Limited_offers/updateOffer',$data);
                $this->load->view('admin_template/Footer');
        }
    }

        public function deleteOffers ()
    {
        $offerId = $this->input->get('id');
        if (isset($offerId)) {
            $var = $this->LimitedOfferModel->deleteOffers($offerId);
            if (!empty($var)) {
                $this->load->view('admin_template/Header');
                $this->load->view('limited_offer/limitedOffers',$var);
                $this->load->view('admin_template/Footer');

            } else {
                $this->load->view('admin_template/Header');
                $this->load->view('admin_template/Footer');
            }
        }
    }

    public function createOrders()
    {
        $offerId = $this->input->post('offer_id');
        $userId = $this->input->post('user_id');
        //$offerDetails = new stdClass();
        if (isset($offerId) && (isset($userId))) {
            $var = $this->LimitedOfferModel->createOrders($offerId, $userId);
            print_r($var);
            if (!empty($var)) {
                $this->load->view('admin_template/Header');
                $this->load->view('limited_offer/limitedOffers', $var);
                $this->load->view('admin_template/Footer');

            } else {
                $this->load->view('admin_template/Header');
                $this->load->view('admin_template/Footer');
            }
        }
    }
    public function userListByOffer (){
    //echo "called"; die;
        $id = $this->input->get('id');
        //echo $id; die;
        if(!$id){
            redirect(base_url() . 'Limited_offer/limitedOffers/');
            return;
        }
        else{
        	$var = $this->LimitedOfferModel->getUserByOffer($id);
        	//if($var){
        	  $data['users'] = $var;
        	  $this->load->view('admin_template/Header');
                  $this->load->view('dashboard/Limited_offers/userList',$data);
                  $this->load->view('admin_template/Footer');
        	//}
        	//else{
      	          //  redirect(base_url() . 'Limited_offer/limitedOffers/');
	           // return;
        	//}
        }   
    }

public function checkUser (){
    $email = urldecode($this->input->get('email'));
    $phone = $this->input->get('phone');
    $email = explode('@',$email);
    $emailName = $email[0];
    $emailDomain = $email[1];

    //$offer = new stdClass();
    if (isset($email)||isset($phone)) {
        $var = $this->LimitedOfferModel->checkUser(trim($emailName), trim($emailDomain),trim($phone));
        print_r($var);
//          $this->load->view('admin_template/Header');
//          $this->load->view('limited_offer/limitedOffers',$var);
//          $this->load->view('admin_template/Footer');
//          die;
        if (!empty($var)) {
            $this->load->view('admin_template/Header');
            $this->load->view('limited_offer/limitedOffers',$var);
            $this->load->view('admin_template/Footer');
//                $offer->status = 'success';
//                $offer->code = '200';
//                $offer->data = 'User Found';
        } else {
            $this->load->view('admin_template/Header');
            $this->load->view('admin_template/Footer');

//                $offer->status = 'success';
//                $offer->code = '200';
//                $offer->messsage = 'User not found';
        }
    }
//        else {
//            $offer->status = 'failure';
//            $offer->code = '406';
//            $offer->messsage = 'Wrong set of input';
//}
    die;
    $this->response($offer);
}

public function updateImage() {
    $image = $_FILES["image"];
    $offer_id = $_POST['offer_id'];
    $date = date('m-d-Y_H:i:s');
    $target_dir = "uploads/offers/".$offer_id;

    mkdir($target_dir, 0777, true);
    chmod($target_dir, 0777);

    $name = 'offers_'.$offer_id.'_'.$date;
    $target_file = $target_dir . basename($_FILES["image"]);
    $uploadOk = 1;
    $var = explode('/',$image['type']);
    $imageFileType = $var[1];

    if (file_exists($target_file.$name)) {
        $updateImage->messsage = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($image["size"] > 1024000) {
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
    } else {
        $filename = $offer_id.'_'.$date.'_'.str_replace(' ','_',basename($image['name']));
        if (move_uploaded_file($image['tmp_name'],$target_dir.'/'.$filename)) {
            $updateImage->data = $filename;
            $this->LimitedOfferModel->updateImages($offer_id,$filename);
            chmod($target_dir, 0777);
        }
    }
}

}
