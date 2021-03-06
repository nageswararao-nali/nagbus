<?php

/**
 * Created by PhpStorm.
 * User: anik
 * Date: 8/11/16
 * Time: 8:43 PM
 */
require_once(APPPATH.'config/rest.php');

class LimitedOfferApi extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('LimitedOfferModel');
        $this->load->model('users_model', 'users', TRUE);
        $this->load->helper(array('form', 'url'));
    }
    public function limitedOffers_get()
    {
        $offerId = $this->get('offer_id');
        $userId = $this->get('user_id');
        $offers = new stdClass();
        if (!empty($offerId) && empty($userId)) {
            if (!empty($this->LimitedOfferModel->getLimitedOffers($offerId))) {
                $offers->status = "success";
                $offers->code = "200";
                $offers->data = $this->LimitedOfferModel->getLimitedOffers($offerId);
                $offers->image_path = 'adminnew/uploads/offers/' . $offerId . '/';
            } else {
                $offers->status = "failure";
                $offers->code = "500";
                $offers->message = "No Records found";
            }
        }
        elseif(!empty($userId)) {
            if (!empty($this->LimitedOfferModel->getOfferByUser($userId))) {
                $offers->status = "success";
                $offers->code = "200";
                $offers->data = $this->LimitedOfferModel->getOfferByUser($userId);
            } else {
                $offers->status = "failure";
                $offers->code = "500";
                $offers->message = "No Records found";
            }
        }
        else{
            $offers->status = "failure";
            $offers->code = "500";
            $offers->message = "Internal server error/No Records found";
        }
        $this->response($offers);
    }

    public function createOffers_post()
    {
        $title = $this->post('title');
        $offerPeriod = $this->post('offer_period');
        $price = $this->post('price');
        $quantity = $this->post('quantity');
        $details = $this->post('details');
        $offer = new stdClass();
        if (isset($title) && isset($price)) {
            $var = $this->LimitedOfferModel->createLimitedOffers($title, $offerPeriod, $price, $quantity, $details);
            if ($var) {
                $offer->status = 'success';
                $offer->code = '200';
                $offer->message = 'Inserted';
            } else {
                $offer->status = 'failure';
                $offer->code = '500';
                $offer->messsage = 'Internal server error';
            }
        } else {
            $offer->status = 'failure';
            $offer->code = '406';
            $offer->messsage = 'Wrong set of input';
        }
        $this->response($offer);
    }

    public function updateOffers_post()
    {
        $title = $this->post('title');
        $offerPeriod = $this->post('offer_period');
        $price = $this->post('price');
        $quantity = $this->post('quantity');
        $details = $this->post('details');
        $offer = new stdClass();
        if (isset($title) && isset($price)) {
            $var = $this->LimitedOfferModel->updateLimitedOffers($title, $offerPeriod, $price, $quantity, $details);
            if ($var) {
                $offer->status = 'success';
                $offer->code = '200';
                $offer->messsage = 'Offer Updated';
            } else {
                $offer->status = 'failure';
                $offer->code = '500';
                $offer->messsage = 'Internal server error';
            }
        }
        else {
            $offer->status = 'failure';
            $offer->code = '406';
            $offer->messsage = 'Wrong set of input';
        }
        $this->response($offer);
    }

    public function deleteOffers_get()
    {
        $offerId = $this->get('id');
        $offer = new stdClass();
        if (isset($offerId)) {
            $var = $this->LimitedOfferModel->deleteOffers($offerId);
            if ($var) {
                $offer->status = 'success';
                $offer->code = '200';
                $offer->messsage = 'Offer Deleted';
            } else {
                $offer->status = 'failure';
                $offer->code = '500';
                $offer->messsage = 'Internal server error/No Records found';
            }
        }
        else {
            $offer->status = 'failure';
            $offer->code = '406';
            $offer->messsage = 'Wrong set of input';
        }
        $this->response($offer);
    }

    public function createOrders_post()
    {
        $offerId = $this->post('offer_id');
        $userId = $this->post('user_id');
        $offerDetails = new stdClass();
        if (isset($offerId) && (isset($userId))) {
            $var = $this->LimitedOfferModel->createOrders($offerId, $userId);

            if ($var) {
                $offerDetails->status = 'success';
                $offerDetails->code = '200';
                $offerDetails->messsage = 'Order Created';

            } else {
                $offerDetails->status = 'failure';
                $offerDetails->code = '500';
                $offerDetails->messsage = 'Internal server error';
            }
        } else {
            $offerDetails->status = 'failure';
            $offerDetails->code = '406';
            $offerDetails->messsage = 'Wrong set of input';

        }
        $this->response($offerDetails);
    }

    public function userListByOffer_get(){
        $id = $this->get('id');
        $offer = new stdClass();
        if (isset($offerId)) {
            $var = $this->LimitedOfferModel->getUserByOffer($id);
            if ($var) {
                $offer->status = 'success';
                $offer->code = '200';
                $offer->data = $var;
            } else {
                $offer->status = 'failure';
                $offer->code = '500';
                $offer->messsage = 'Internal server error/No Records found';
            }
        }
        else {
            $offer->status = 'failure';
            $offer->code = '406';
            $offer->messsage = 'Wrong set of input';
        }
        $this->response($offer);
    }

    public function checkUser_get(){
        $email = urldecode($this->get('email'));
        $phone = $this->get('phone');
        $email = explode('@',$email);
        $emailName = $email[0];
        $emailDomain = $email[1];

        $offer = new stdClass();
        if (isset($email)||isset($phone)) {
            $var = $this->LimitedOfferModel->checkUser(trim($emailName), trim($emailDomain),trim($phone));
            if ($var) {
                $offer->status = 'success';
                $offer->code = '200';
                $offer->data = 'User Found';
            } else {
                $offer->status = 'success';
                $offer->code = '200';
                $offer->messsage = 'User not found';
            }
        }
        else {
            $offer->status = 'failure';
            $offer->code = '406';
            $offer->messsage = 'Wrong set of input';
        }
        $this->response($offer);
    }

    public function updateImage_post() {
        $updateImage = new stdClass();
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

// Check if image file is a actual image or fake image
//            $check = getimagesize($image["tmp_name"]);
//            if($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
//                $uploadOk = 1;
//            } else {
//                echo "File is not an image.";
//                $uploadOk = 0;
//            }
//
//        print_r($_FILES['image']);
        $updateImage->status = 'failure';
        $updateImage->code = '500';
// Check if file already exists
        if (file_exists($target_file.$name)) {
            $updateImage->messsage = "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($image["size"] > 1024000) {
            $updateImage->messsage = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $updateImage->messsage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $updateImage->messsage = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
//            $filePath = $target_dir.'/'.$offer_id.'_'.$date.'_'.trim(basename($image['name']));
            $filename = $offer_id.'_'.$date.'_'.str_replace(' ','_',basename($image['name']));
            if (move_uploaded_file($image['tmp_name'],$target_dir.'/'.$filename)) {
                $updateImage->status = 'success';
                $updateImage->code = '200';
                $updateImage->messsage = "The file has been uploaded.";
                $updateImage->data = $filename;
                $this->LimitedOfferModel->updateImages($offer_id,$filename);
                chmod($target_dir, 0777);
            } else {
                $updateImage->status = 'failure';
                $updateImage->messsage = "Sorry, there was an error uploading your file.";
            }
        }
        $this->response($updateImage);
        return $filename;
    }

}
