<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('wallet_history'));
    }

    public function index() {
		$wallet_history = $this->wallet_history->get_wallet_details();
        $_data['wallet_history'] =  $wallet_history;
        $this->load->view('admin_template/Header');
        $this->load->view('dashboard/wallet/list', $_data);
        $this->load->view('admin_template/Footer');
    }

}
