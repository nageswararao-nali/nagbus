<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: sayan
 * Date: 20/9/16
 * Time: 11:36 PM
 */
//echo "1"; die;
class LimitedOfferModel extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }
    
    public function offers($tableName = NULL){
        if($tableName) {
            $query = $this->db->get_where($tableName);
            return $query->result();
        }
    }
    public function getLimitedOffers($id = NULL){
    
        $this->db->select('*');
        $this->db->from('limited_offers');
        $this->db->where('is_active','1');
        if($id)
            $this->db->where('id', $id);
        $query=$this->db->get();
        //print_r($query->result()); die;
        return $query->result();
    }
    
    public function createLimitedOffers($title,$offerStart,$offerEnd,$original_price, $discount_price, $laabus_price,$offerQuantity=null,$moreDetails=null, $buy_now = 0){
       // $date = '+'.$offerPeriod.' days';
        $createOffers = array(
            'id' => '',
            'offer_title' => urldecode($title),
            'offer_start' => $offerStart,
            'offer_end' => $offerEnd,
            'original_price' => $original_price,
            'discount_price' => $discount_price,
            'laabus_price' => $laabus_price,
            'offer_quantity' =>$offerQuantity,
            'more_details' => urldecode($moreDetails),
	    'buy_now' => $buy_now,	
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('limited_offers',$createOffers );
        return true;
    }
    public function updateLimitedOffers($id, $title,$offerStart,$offerEnd, $original_price, $discount_price, $laabus_price, $offerQuantity,$moreDetails=null, $buy_now = 0){
        $date = '+'.$offerPeriod.' days';
        if(!$offerQuantity){
            $offerQuantity = 1;
        }
        $createOffers = array(
            'offer_title' => urldecode($title),
            'offer_start' => $offerStart,
            'offer_end' => $offerEnd,
           // 'offer_period' => date('Y-m-d H:i:s', strtotime($date)),
            'original_price' => $original_price,
            'discount_price' => $discount_price,
            'laabus_price' => $laabus_price,
            'offer_quantity' =>$offerQuantity,
            'more_details' => urldecode($moreDetails),
	    'buy_now' => $buy_now,
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('limited_offers',$createOffers);
        return true;
    }
    
    public function createOrders($offerId,$userId){
        $createOffers = array(
            'id' => '',
            'user_id' =>$userId,
            'offer_id' => $offerId,
            'created_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('offer_order_users',$createOffers );
        return true;
    }
    public function updateImages($offerId, $filename){
        $data = array(
            'image_name' => $filename
        );
        $this->db->where("id", $offerId);
        $this->db->update("limited_offers", $data);
    }
    public function deleteOffers($offerId){
        $data = array(
            'is_active' => 0
        );
        $this->db->set($data);
        $this->db->where("id", $offerId);
        $this->db->update("limited_offers", $data);
    }

    public function getUserByOffer($id){
    	
        $this->db->select('users.mobile, users.email_id, users.customer_id, users.name');
        $this->db->from('limited_offers');
        $this->db->join('offer_order_users', 'limited_offers.id = offer_order_users.offer_id');
        $this->db->join('users', 'offer_order_users.user_id = users.user_id');
        $this->db->where('limited_offers.id', $id);
        $this->db->where('limited_offers.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    public function checkUser($emailName,$emailDomain,$phone){
        $this->db->where('mobile', $phone);
        $this->db->or_like('email_id',$emailName.'@'.$emailDomain);
        $query = $this->db->count_all_results('users');
        return $query;
    }
}
