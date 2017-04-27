<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Cashback extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model(array('cashback_model'));
    }
	
	
	function create($cbk_id = 0){
		
		if($cbk_id) {
			$cashback_offers = $this->cashback_model->get_cashback_offer($cbk_id);		
			$data['cashback_offer'] = $cashback_offers[0];		
		}
		// $data['data'] = $this->offer_model->get_offer($id);
		//$data['categories'] = $this->categories_model->list_all_categories();
		$promocode = "LCB" . intval(date("Y")%100) . intval(date("m"));
		// $data['offers'] = $this->offer_model->get_wallet_offers_all();		
		$data['promocode'] = $promocode;		

		$this->load->view('admin_template/Header');
		
		$this->load->view('cashback/create',$data);
		
        $this->load->view('admin_template/Footer');
		
	}

	public function add_cashback() {
		$data = $this->input->post();
		$data['cbk_create_date'] = date('Y-m-d H:i:s');
		$data['cbk_st_date'] = date('Y-m-d', strtotime($this->input->post('cbk_st_date')));
		$data['cbk_end_date'] = date('Y-m-d', strtotime($this->input->post('cbk_end_date')));
		if(!empty($_FILES['cbk_image']['name']))
		{
			$upload_path = 'web_assets/';
			if( move_uploaded_file( $_FILES['cbk_image'][ 'tmp_name' ], $upload_path . $_FILES[ 'cbk_image' ][ 'name' ] ) )
			{
				$data['cbk_image'] = $upload_path . $data['cbk_promo_code'] . '_' . $_FILES[ 'cbk_image' ][ 'name' ];
			}
		}
		if($data['cbk_id']) {
			$cbk_id = $this->cashback_model->update($data);
		}else {
			$cbk_id = $this->cashback_model->save($data);
		}
		if($cbk_id){
			redirect('/cashback/offers_list', 'refresh');
		}
	}
	
	public function offers_list() {
		$data['cashback_offers'] = $this->cashback_model->get_cashback_offers();		
		$this->load->view('admin_template/Header');
		
		$this->load->view('cashback/list',$data);
		
        $this->load->view('admin_template/Footer');
	}
	public function view($cbk_id=0) {
		if($cbk_id) {
			$cashback_offers = $this->cashback_model->get_cashback_offer($cbk_id);		
			$data['cashback_offer'] = $cashback_offers[0];		
			$this->load->view('admin_template/Header');
			
			$this->load->view('cashback/view',$data);
			
	        $this->load->view('admin_template/Footer');
		}else {
			redirect('/cashback/offers_list', 'refresh');
		}
	}
	public function usage_list() {
		$data['cashback_offers'] = $this->cashback_model->get_cashback_usage_offers();		
		$this->load->view('admin_template/Header');
		
		$this->load->view('cashback/usage_list',$data);
		
        $this->load->view('admin_template/Footer');
	}
	public function usage_create($cbk_usg_id = 0) {
		if($cbk_usg_id) {
			$cashback_offer_usage = $this->cashback_model->get_cashback_offer_usage($cbk_usg_id);		
			$data['cashback_offer_usage'] = $cashback_offer_usage[0];
		}
		$this->load->view('admin_template/Header');
		
		$this->load->view('cashback/usage_create',$data);
		
        $this->load->view('admin_template/Footer');
	}
	public function usage_view($cbk_usg_id=0) {
		if($cbk_usg_id) {
			$cashback_offer_usage = $this->cashback_model->get_cashback_offer_usage($cbk_usg_id);		
			$data['cashback_offer_usage'] = $cashback_offer_usage[0];
			$this->load->view('admin_template/Header');
			
			$this->load->view('cashback/usage_view',$data);
			
	        $this->load->view('admin_template/Footer');
		}else {
			redirect('/cashback/offers_list', 'refresh');
		}
	}
	public function add_cashback_usage() {
		$data = $this->input->post();
		$data['cbk_usg_create_date'] = date('Y-m-d H:i:s');
		if($data['cbk_usg_id']) {
			$cbk_id = $this->cashback_model->update_usage($data);
		}else {
			$cbk_id = $this->cashback_model->save_usage($data);
		}
		if($cbk_id){
			redirect('/cashback/usage_list', 'refresh');
		}
	}
	public function activateCashbackOfer() {
		$data = $this->input->post();
		$isActive = $this->cashback_model->activateCashbackOfer($data);
		echo $isActive;
	}
}
