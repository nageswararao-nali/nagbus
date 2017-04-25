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
