<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Smd extends CI_Controller {

    function __construct() {
        parent::__construct();


        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Category_model', 'Cat', TRUE);
        $this->load->model('users_model', 'users', TRUE);
        $this->load->model('supportmatrix_model', 'supportmatrix_model', TRUE);
        $this->load->model(array('common_model', 'Va_Commisions_model', 'categories_model', 'Sub_categories_model', 'cashback_model'));
        //$this->load->model(array('common_model','Va_commisions_model','categories_model','Sub_categories_model'));

		 $this->load->model('users_ticket', 'ticket', TRUE);
		$this->load->model('bus_booking', 'ticketDeatils', TRUE);


        //start get agent today earnings.
        $todayearning_arr = $this->users->get_agent_today_earning($this->session->userdata('user_id'));
        //print_r($todayearning);exit;
        $today_earning = $todayearning_arr["0"]["earnings"];
        $this->session->set_userdata('today_earning', $today_earning);
        //end get agent today earnings.
        //start get agent today earnings.
        $todayearning_arr = $this->users->get_agent_currentyear_earning($this->session->userdata('user_id'));
        //print_r($todayearning);exit;
        $year_earning = $todayearning_arr["0"]["earnings"];
        $this->session->set_userdata('year_earning', $year_earning);
        //end get agent today earnings.
        //start get agent this month earnings.
        $todayearning_arr = $this->users->get_agent_thismonth_earning($this->session->userdata('user_id'));
        //print_r($todayearning);exit;
        $month_earning = $todayearning_arr["0"]["earnings"];
        $this->session->set_userdata('month_earning', $month_earning);
        //end get agent this month earnings.
    }

    public function test() {
        echo "hello";
        exit;
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function profile() {

        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $data['supportmatrix'] = $this->supportmatrix_model->get_supportmatrix_by_role($this->session->userdata('role_id'));
        //print("<pre>");
        //print_r($data['supportmatrix']);exit;
        $data['folder'] = '';
        $data['body'] = 'index';
        $data['country'] = $this->users->get_country();
        $user_id = $this->session->userdata('user_id');
        $role_id = $this->session->userdata('role_id');

        if (!check_login_status()) {
            redirect('login');
        } else {
            $data['profile_info'] = $this->users->get_userprofile_info('profile', $user_id);
            $data['kyc_info'] = $this->users->get_userprofile_info('profile_kyc', $user_id);
            $data['bank_info'] = $this->users->get_userprofile_info('profile_bank_details', $user_id);
            $data['user_info'] = $this->users->get_user_info_only('users', $user_id);

            if (!$this->input->is_ajax_request()) {
                $this->load->view('website_template/header', $data);
                $this->load->view('website/smd_new/profile', $data);
                $this->load->view('website_template/footer');
            } else {
                $this->load->view('website/agent/profile', $data);
            }
        }
    }

    public function dashboard() {

        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();

        //echo "Test 123";
        $data['offers'] = $this->users->getoffers();
        //$data['offerswallet'] = $this->users->getofferswallet();
        // print_r($usertypes);
        $role_id = $this->session->userdata('role_id');
        if ($this->session->userdata('user_id') && $role_id == 5) {
            $usertypes = $this->users->checkUserTypeLaabus($this->session->userdata('user_id'));
            $smd_id = $usertypes[0]->smd_id;
            if (empty($smd_id)) {
                $role_id = 4;
            } else {
                $role_id = 44;
            }
        }

        $data1['offers'] = $this->users->getalloffers($role_id);
        $data1["offerswallet"] = $this->users->getallofferswallet($role_id);
        $role_id = $this->session->userdata('role_id');
        if (!check_login_status()) {
            redirect('login');
        } else {
            if (!$this->input->is_ajax_request()) {
                //echo "Here";
                $user_id = $this->session->userdata('user_id');
                $orders = $this->common_model->commonOrders($user_id);
                $data1['orders'] = json_encode($orders);

                $this->load->view('website_template/header', $data);
                $this->load->view('website/smd_new/dashboard', $data1);
                $this->load->view('website_template/footer');
            } else {
                //echo "there";
                $this->load->view('website/smd_new/dashboard', $data);
            }
        }
    }

    public function populat_sub_cat_search() {

        $sub_cat = $this->Sub_categories_model->get_subcategory($_REQUEST['catid']);
        $data = '';
        if (!empty($sub_cat)) {
            foreach ($sub_cat as $key => $value) {
                $data .= '<div  class="sub_cat_dis"><input type="checkbox" class="chksubcat" name="sub_cat[]" value=' . $value->sub_cat_id . '>' . $value->sub_cat_name . ' </div>';
            }
        }
        echo $data;
        exit;
    }

    public function check_promocode() {

        $data = $this->users->check_promocode($_REQUEST['promo_code'], $_REQUEST['amount'], $this->session->userdata('role_id'));
        echo $data;
        exit;
    }

    public function Orders() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $user_id = $this->session->userdata('user_id');

        //echo "<br>";
        //print_r($_REQUEST);


        $search_params["agent_id"] = $user_id;
        if (isset($_REQUEST["search"])) {

            if (!empty($_REQUEST["st_date"])) {
                $st_date = explode("/", $_REQUEST["st_date"]);
                $search_params["st_date"] = $st_date[2] . "-" . $st_date[0] . "-" . $st_date[1];
            }
            if (!empty($_REQUEST["end_date"])) {
                $end_date = explode("/", $_REQUEST["end_date"]);
                $search_params["end_date"] = $end_date[2] . "-" . $end_date[0] . "-" . $end_date[1];
            }
            if (!empty($_REQUEST["agent_id"])) {
                //$search_params["agent_id"] = $_REQUEST["agent_id"];
            }
            if (!empty($_REQUEST["cnl_part"])) {
                $search_params["cnl_part"] = $_REQUEST["cnl_part"];
            }
            if (!empty($_REQUEST["cat_id"])) {
                $search_params["cat_id"] = $_REQUEST["cat_id"];
            }
            if (!empty($_REQUEST["sub_cat"])) {
                $search_params["sub_cat"] = implode(",", $_REQUEST["sub_cat"]);
            }
        }
        $data1['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();
        $data1['categories'] = $this->categories_model->list_all_categories();
        $data1['smds'] = $this->categories_model->list_all_users(5);
        $data1['agents'] = $this->categories_model->list_all_users(6);
        $data1['ch_partners'] = $this->categories_model->list_all_users(2);
        $data1['order_details'] = $this->Va_Commisions_model->order_details($search_params);

		$data1['ticket_details'] = $this->ticket->get_ticketDetials($user_id);

        $this->load->view('website_template/header', $data);
        $this->load->view('website/smd_new/orders', $data1);
        $this->load->view('website_template/footer');
    }
    public function Cashback() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $user_id = $this->session->userdata('user_id');

        $data1['cashback_history_bus'] = $this->cashback_model->get_cashback_history($user_id, 'Bus');
        $data1['cashback_history_recharge'] = $this->cashback_model->get_cashback_history($user_id, 'Recharge');
        $data1['user_info'] = $this->users->get_user_info_only('users', $user_id);
        // var_dump($data1['cashback_history']);
        // exit;
        $this->load->view('website_template/header', $data);
        $this->load->view('website/smd_new/cashback', $data1);
        $this->load->view('website_template/footer');
    }

    public function Creditordersstatus() {
        //print_r($_REQUEST);exit;
        $sales_id_str = implode(",", $_REQUEST["chkmarkasCredit"]);
        $mark_as_credit_user_update = $_REQUEST["mark_as_credit_user_update"];
        $this->Va_Commisions_model->updatesPaymentStatus($sales_id_str, $mark_as_credit_user_update);
        redirect('smd/Creditorders');
    }

    public function offers() {

        $data['category'] = $this->Cat->get_category();
        $data1['offers'] = $this->users->getoffers();
        $data1['offerswallet'] = $this->users->getofferswallet();

        //print_r($data1['offers']);

        $this->load->view('website_template/header', $data);
        $this->load->view('website/smd_new/offers', $data1);
        $this->load->view('website_template/footer');
    }

    public function promotions() {

        $data['category'] = $this->Cat->get_category();
        $data1['offers'] = $this->users->getoffers();
        $data1['offerswallet'] = $this->users->getofferswallet();
        $smd_shared_link = base_url('Welcome/signup/'.$this->session->userdata('user_id'));
        $data1['smd_shared_links'] = $this->laabus_social_sharing_buttons($smd_shared_link);


        //print_r($data1['offers']);

        $this->load->view('website_template/header', $data);
        $this->load->view('website/smd_new/promotions', $data1);
        $this->load->view('website_template/footer');
    }

    public function Creditorders() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $user_id = $this->session->userdata('user_id');

        //echo "<br>";
        //print_r($_REQUEST);

        $search_params["agent_id"] = $user_id;
        if (isset($_REQUEST["search"])) {

            if (!empty($_REQUEST["st_date"])) {
                $st_date = explode("/", $_REQUEST["st_date"]);
                $search_params["st_date"] = $st_date[2] . "-" . $st_date[0] . "-" . $st_date[1];
            }
            if (!empty($_REQUEST["end_date"])) {
                $end_date = explode("/", $_REQUEST["end_date"]);
                $search_params["end_date"] = $end_date[2] . "-" . $end_date[0] . "-" . $end_date[1];
            }
            if (!empty($_REQUEST["agent_id"])) {
                //$search_params["agent_id"] = $_REQUEST["agent_id"];
            }
            if (!empty($_REQUEST["cnl_part"])) {
                $search_params["cnl_part"] = $_REQUEST["cnl_part"];
            }
            if (!empty($_REQUEST["cat_id"])) {
                $search_params["cat_id"] = $_REQUEST["cat_id"];
            }
            if (!empty($_REQUEST["sub_cat"])) {
                $search_params["sub_cat"] = implode(",", $_REQUEST["sub_cat"]);
            }
            if (!empty($_REQUEST["mark_as_credit_user"])) {
                $search_params["mark_as_credit_user"] = $_REQUEST["mark_as_credit_user"];
            }
        }
        $data1['comm_detils'] = $this->Va_Commisions_model->get_comm_categorywise_details();
        $data1['categories'] = $this->categories_model->list_all_categories();
        $data1['smds'] = $this->categories_model->list_all_users(5);
        $data1['agents'] = $this->categories_model->list_all_users(6);
        $data1['ch_partners'] = $this->categories_model->list_all_users(2);
        $data1['order_details'] = $this->Va_Commisions_model->order_details_credit($search_params);

        $this->load->view('website_template/header', $data);
        $this->load->view('website/smd_new/orderscredit', $data1);
        $this->load->view('website_template/footer');
    }

    public function user() {
        //print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {

            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/smd_new/add_user');
            $this->load->view('website_template/footer');
        }
    }

    public function edituser() {
        //print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $id = $this->uri->segment('3');
        if (!check_login_status()) {
            redirect('login');
        } else {
            $userlist = $this->users->get_users_list_by_id($id);
            $data1['userlist'] = $userlist;
            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/smd_new/edit_user', $data1);
            $this->load->view('website_template/footer');
        }
    }

    public function updateuser() {
        //print_r($_REQUEST);exit;
        $userdata["user_id"] = $_REQUEST["user_id"];
        $userdata["email_id"] = $_REQUEST["email"];
        $userdata["mobile"] = $_REQUEST["mobile"];
        $userdata["address"] = $_REQUEST["Address"];
        $userdata["name"] = $_REQUEST["FirstName"];
        //print_r($this->session->userdata());
        $id = $this->users->updateUsers($userdata);
        redirect('smd/users_list');
    }

    public function deleteuser() {
        $id = $this->uri->segment('3');
        $id = $this->users->delete_users_list_by_id($id);
        redirect('agent/users_list');
    }

    public function userview() {
        //print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $id = $this->uri->segment('3');
        if (!check_login_status()) {
            redirect('login');
        } else {

            $role_id = $this->session->userdata('role_id');
            $userlist = $this->users->get_users_list_by_id($id);
            $data1['userlist'] = $userlist;
            //print_r($data1['userlist']);
            $this->load->view('website_template/header', $data);
            $this->load->view('website/smd_new/userview', $data1);
            $this->load->view('website_template/footer');
        }
    }

    public function walletuserview() {
        //print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $id = $this->uri->segment('3');
        if (!check_login_status()) {
            redirect('login');
        } else {

            $role_id = $this->session->userdata('role_id');
            $userlist = $this->users->walletuserview($id);
            $data1['userlist'] = $userlist;
            //print_r($data1['userlist']);
            $this->load->view('website_template/header', $data);
            $this->load->view('website/smd_new/walletuserview', $data1);
            $this->load->view('website_template/footer');
        }
    }

    public function wallethistoryview() {
        //print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        $id = $this->uri->segment('3');
        if (!check_login_status()) {
            redirect('login');
        } else {

            $role_id = $this->session->userdata('role_id');
            $userlist = $this->users->wallethistoryview($id);
            $data1['userlist'] = $userlist;
            //print_r($data1['userlist']);
            $this->load->view('website_template/header', $data);
            $this->load->view('website/agent/wallethistoryview', $data1);
            $this->load->view('website_template/footer');
        }
    }

    public function users_list() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $user_id = $this->session->userdata('user_id');
            $userlist = $this->users->get_smd_users_list($user_id);
            $data1['userlist'] = json_encode($userlist);
            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/smd_new/users_list', $data1);
            $this->load->view('website_template/footer');
        }
    }

    public function fetch_users_list_byID() {
        $customer_id = $_REQUEST["customer_id"];
        $data = $this->users->getUserDetail($customer_id);
        $str = "CUSTOMER ID:" . $customer_id . "<br>";
        $str .= "CUSTOMER NAME:" . $data[0]->name . "<br>";
        $str .= "MOBILE:" . $data[0]->mobile . "<br>";
        $str .= "EMAIL:" . $data[0]->email_id . "<br>";
        $str .= "PINCODE:" . $data[0]->pincode . "<br>";
        $str .= "COMPANY:" . $data[0]->company_name . "<br>";
        $str .= "SECURITY PIN:" . $data[0]->security_pin . "<br>";
        $str .= "Date of Birth:" . $data[0]->dob . "<br>";
        $str .= "Address:" . $data[0]->address . "<br>";
        $str .= "<b>Wallet:" . $data[0]->wallet . "</b><br>";
        $str .= "Lst Update:" . $data[0]->lupdate . "<br>";
        $str .= "Country:" . $data[0]->country_name . "<br>";
        $str .= "State:" . $data[0]->state_name . "<br>";
        $str .= "District:" . $data[0]->district_name . "<br>";
        $str .= "City:" . $data[0]->city_name . "<br>";
        //$data = $customer_id."<br>Sample data<br>Sample data<br>Sample data<br>Sample data<br>".print_r($data);
        echo $str;
        exit;
    }

    public function smd_users_list() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $user_id = $this->session->userdata('user_id');
            // $list = $this->users->get_agent_users_list($user_id);
            //$data1['agentuserlist'] =json_encode($list);


            $list = $this->users->get_wallet_list_agent_users($user_id);
            $data1['walletlist'] = $list;
            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/smd_new/smd_users_list', $data1);
            $this->load->view('website_template/footer');
        }
    }

    public function wallet_list() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $user_id = $this->session->userdata('user_id');
            $walletlist = $this->users->get_wallet_list($user_id);

            //print_r($walletlist);exit;
            //$data1['walletlist'] = json_encode($walletlist);
            $data1['walletlist'] = $walletlist;
            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/smd_new/wallet_list', $data1);
            $this->load->view('website_template/footer');
        }
    }

    public function wallet_withdraw_list() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $user_id = $this->session->userdata('user_id');
            $walletlist = $this->users->get_wallet_withdraw_list($user_id);

            //print_r($walletlist);exit;
            //$data1['walletlist'] = json_encode($walletlist);
            $data1['walletlist'] = $walletlist;
            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/agent/wallet_withdraw_list', $data1);
            $this->load->view('website_template/footer');
        }
    }

    ////13042016
    public function wallet_withdraw_otp() {

        if ($this->session->userdata('OTPERROR')) {

        } else {
            $withdraw['withdraw_otp'] = $_REQUEST;
            //$withdraw['otp'] =
            $otp = rand(100000, 999999);
            $withdraw['otp'] = $otp;
            $this->session->set_userdata($withdraw);

            //SMS
//Code using curl
//API stands for Application Programming Integration which is widely used to integrate and enable interaction with other software, much in the same way as a user interface facilitates interaction between humans and computers. Our API codes can be easily integrated to any web or software application.
//Change your configurations here.
//---------------------------------
            $uid = "766172696e69696e666f"; //your uid
            $pin = "ccdb37d4de7737d75924ab4507e03303"; //your api pin
            $sender = "LAABUS"; // approved sender id
            $domain = "smsalertbox.com"; // connecting url
            $route = "5"; // 0-Normal,1-Priority
            $method = "POST";
//---------------------------------



            $mobile = $this->session->userdata('Mobile');
            $name = $this->session->userdata('name');
            //$amount=$this->session->userdata('rcAmount');
            //echo $mobile."::".$_POST['amount']."::".$totamount;//exit;
            //$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
            //$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
            $message = 'Dear ' . $name . ', OTP for transaction varini info systems pvt ltd is ' . $otp . ' on www.laabus.com';
            //$uid=urlencode($uid);
            //$pin=urlencode($pin);
            //$sender=urlencode($sender);
            $message = urlencode($message);
            //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

            $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

            $url = "http://$domain/api/sms.php";

            $ch = curl_init($url);

            if ($method == "POST") {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
            } else {
                $get_url = $url . "?" . $parameters;

                curl_setopt($ch, CURLOPT_POST, 0);
                curl_setopt($ch, CURLOPT_URL, $get_url);
            }

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
            $return_val = curl_exec($ch);

            //var_dump($return_val);
        }
        //SMD

        $email_id = $this->session->userdata('email_id');
        $_data['user'] = $this->users->get_user($email_id)->row();
        $this->load->view('website_template/header', $data);
        $this->load->view('website/agent/wallet_withdraw_otp', $_data);
        $this->load->view('website_template/footer');
    }

    public function wallet_withdraw() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        //exit("WithDraw.");
        if ($this->session->userdata('otp')) {
            if ($this->session->userdata('otp') != $_REQUEST['txtotp']) {
                $this->session->set_userdata('OTPERROR', 1);
                redirect("agent/wallet_withdraw_otp");
            } else {
                //print("<pre>");
                //print_r($this->session->userdata());
                /* echo "++<br>";
                  print_r($_REQUEST); */
                ///
                $withdraw_otp = $this->session->userdata('withdraw_otp');
                //echo "XXX";
                //print_r($withdraw_otp);
                $amount = $withdraw_otp['amount'];
                //exit;
                $user_id = $this->session->userdata('user_id');
                $withdraw_otp = $this->session->userdata('withdraw_otp');
                $arrayData = array(
                    'user_id' => $user_id,
                    'amount' => $withdraw_otp['amount'],
                    'account_number' => $withdraw_otp['account_number'],
                    'account_name' => $withdraw_otp['account_name'],
                    'bank_name' => $withdraw_otp['bank_name'],
                    'ifsc_code' => $withdraw_otp['ifsc_code'],
                    'create_dt' => date("Y-m-d H:i:s")
                );
                $wallet_withdraw = $this->common_model->commonInsert("wallet_withdraw", $arrayData);
                $result = $this->common_model->raw_query("update users set wallet = wallet -  $amount where user_id = $user_id");


                //SMS
//Code using curl
//API stands for Application Programming Integration which is widely used to integrate and enable interaction with other software, much in the same way as a user interface facilitates interaction between humans and computers. Our API codes can be easily integrated to any web or software application.
//Change your configurations here.
//---------------------------------
                $uid = "766172696e69696e666f"; //your uid
                $pin = "ccdb37d4de7737d75924ab4507e03303"; //your api pin
                $sender = "LAABUS"; // approved sender id
                $domain = "smsalertbox.com"; // connecting url
                $route = "5"; // 0-Normal,1-Priority
                $method = "POST";
//---------------------------------



                $mobile = $this->session->userdata('Mobile');
                $name = $this->session->userdata('name');
                //$amount=$this->session->userdata('rcAmount');

                $amount = $withdraw_otp['amount'];
                $user_id = $this->session->userdata('user_id');
                $role_id = $this->session->userdata('role_id');
                $wallet_amount = $this->users->get_wallet_amount($user_id, $role_id);
                $tot_W_a = $wallet_amount - $amount;

                //echo $mobile."::".$_POST['amount']."::".$totamount;//exit;
                //$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
                //$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
                $message = 'Dear ' . $name . ', Your withdraw INR  ' . $amount . '. from www.laabus.com Your net Wallet Amount is ' . $tot_W_a . '. download  app @ https://goo.gl/QWUiJB';
                //$uid=urlencode($uid);
                //$pin=urlencode($pin);
                //$sender=urlencode($sender);
                $message = urlencode($message);
                //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

                $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

                $url = "http://$domain/api/sms.php";

                $ch = curl_init($url);

                if ($method == "POST") {
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                } else {
                    $get_url = $url . "?" . $parameters;

                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_URL, $get_url);
                }

                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
                $return_val = curl_exec($ch);

                //var_dump($return_val);
                //alert to admin
                //$message = 'Dear '.$name.', Your withdraw INR  '.$amount.'. from www.laabus.com Your net Wallet Amount is '.$tot_W_a.'. download  app @ https://goo.gl/QWUiJB';
                $message = 'Dear Admin, ' . $name . ' withdraw INR  ' . $amount . '. from www.laabus.com.please review it.';
                //$uid=urlencode($uid);
                //$pin=urlencode($pin);
                //$sender=urlencode($sender);
                $mobile = '9989624611';
                $message = urlencode($message);
                //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

                $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

                $url = "http://$domain/api/sms.php";

                $ch = curl_init($url);

                if ($method == "POST") {
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                } else {
                    $get_url = $url . "?" . $parameters;

                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_URL, $get_url);
                }

                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
                $return_val = curl_exec($ch);

                //SMD

                unset($_SESSION['OTPERROR']);
                unset($_SESSION['otp']);
                $this->session->unset_userdata('OTPERROR');
                $this->session->unset_userdata('otp');
                redirect('agent/success/wallet_withdraw');
                ///
                exit;
            }
        }


        $this->db->where("User_id", $this->session->userdata("user_id"));
        $this->db->from('profile_bank_details');
        $query = $this->db->get();
        $data["bankdetails"] = $query->result();
        if (!check_login_status()) {
            redirect('login');
        } else {
            if ($this->input->post('amount')) {
                $user_id = $this->session->userdata('user_id');
                $amount = $this->input->post('amount');
                $arrayData = array(
                    'user_id' => $user_id,
                    'amount' => $amount,
                    'account_number' => $this->input->post('account_number'),
                    'account_name' => $this->input->post('account_name'),
                    'bank_name' => $this->input->post('bank_name'),
                    'ifsc_code' => $this->input->post('ifsc_code'),
                    'create_dt' => date("Y-m-d H:i:s")
                );
                //$wallet_withdraw = $this->common_model->commonInsert("wallet_withdraw", $arrayData);
                // $result = $this->common_model->raw_query("update users set wallet = wallet -  $amount where user_id = $user_id");
                //SMS
//Code using curl
//API stands for Application Programming Integration which is widely used to integrate and enable interaction with other software, much in the same way as a user interface facilitates interaction between humans and computers. Our API codes can be easily integrated to any web or software application.
//Change your configurations here.
//---------------------------------
                $uid = "766172696e69696e666f"; //your uid
                $pin = "ccdb37d4de7737d75924ab4507e03303"; //your api pin
                $sender = "LAABUS"; // approved sender id
                $domain = "smsalertbox.com"; // connecting url
                $route = "5"; // 0-Normal,1-Priority
                $method = "POST";
//---------------------------------



                $mobile = $this->session->userdata('Mobile');
                $name = $this->session->userdata('name');
                //$amount=$this->session->userdata('rcAmount');


                $user_id = $this->session->userdata('user_id');
                $role_id = $this->session->userdata('role_id');
                $wallet_amount = $this->users->get_wallet_amount($user_id, $role_id);
                $tot_W_a = $wallet_amount - $amount;

                //echo $mobile."::".$_POST['amount']."::".$totamount;//exit;
                //$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
                //$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
                $message = 'Dear ' . $name . ', Your withdraw INR  ' . $amount . '. from www.laabus.com Your net Wallet Amount is ' . $tot_W_a . '. download  app @ https://goo.gl/QWUiJB';
                //$uid=urlencode($uid);
                //$pin=urlencode($pin);
                //$sender=urlencode($sender);
                $message = urlencode($message);
                //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

                $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

                $url = "http://$domain/api/sms.php";

                $ch = curl_init($url);

                if ($method == "POST") {
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                } else {
                    $get_url = $url . "?" . $parameters;

                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_URL, $get_url);
                }

                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
                //$return_val = curl_exec($ch);
                //var_dump($return_val);
                //SMD



                redirect('agent/success/wallet_withdraw');
            } else {
                $email_id = $this->session->userdata('email_id');
                $_data['user'] = $this->users->get_user($email_id)->row();
                $this->load->view('website_template/header', $data);
                $this->load->view('website/agent/wallet_withdraw', $_data);
                $this->load->view('website_template/footer');
            }
        }
    }

    public function success($type = 0) {
        $data1['category'] = $this->Cat->get_category();
        $data1['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $this->load->view('website_template/header', $data1);
            $data['type'] = $type;
            $this->load->view('website/agent/success', $data);
            $this->load->view('website_template/footer');
        }
    }

    ////13042016
    /* public function add_funds() {
      // print_r($this->session->userdata());
      $data['category'] = $this->Cat->get_category();
      $data['roles'] = $this->users->get_roles();
      if (!check_login_status()) {
      redirect('login');
      } else {
      if($this->input->post('amount')){
      $role_id = $this->session->userdata('role_id');
      $user_id = $this->session->userdata('user_id');
      $arrayData=array(
      'user_id'=>$user_id,
      'total_amount'=>$this->input->post('amount'),
      'information'=>json_encode(array('user_id'=>$user_id,'total_amount'=>$this->input->post('amount'),'transaction_status_id'=>1,'shipping_method_id'=>1,'transaction_stage_time'=>date("Y-m-d H:i:s"))),
      'transaction_status_id'=>1,
      'shipping_method_id'=>1,
      'transaction_stage_time'=>date("Y-m-d H:i:s")
      );
      $sales_id=$this->common_model->commonInsert("va_sales_order",$arrayData);
      $userdetails = $this->users->get_user_details($user_id,$role_id);

      $sessDataArr=array(
      'name'=> $userdetails['name'],
      'email'=> $userdetails['email_id'],
      'phone'=> $userdetails['mobile'],
      'amount'=> $this->input->post('amount')
      );
      $this->session->set_userdata($sessDataArr);
      if($this->input->post('ptype')==1){
      $arrayData=array(
      'user_id'=>$user_id,
      'role_id'=>$role_id,
      'amount'=>$this->input->post('amount'),
      'reference_number'=>$this->input->post('ref_number'),
      'payment_status'=>1,
      'payment_mode'=>1,
      'credit_debit'=>2,
      'create_dt'=>date("Y-m-d H:i:s")
      );
      $wallet=$this->common_model->commonInsert("wallet_history",$arrayData);
      redirect('agent/addfundsuccess/ptype');
      }else{
      redirect('Payment/addfundspayment?txnid='.$sales_id);
      }
      }else{
      $role_id = $this->session->userdata('role_id');
      $this->load->view('website_template/header', $data);
      $this->load->view('website/agent/add_funds');
      $this->load->view('website_template/footer');
      }
      }
      } */


    public function add_funds() {
        // print_r($this->session->userdata());
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            if ($this->input->post('amount')) {


                $role_id = $this->session->userdata('role_id');
                $user_id = $this->session->userdata('user_id');
                $this->session->set_userdata("promo_code",$this->input->post('promo_code'));
                $this->session->set_userdata("atom_amount",$this->input->post('amount'));
                //check whethere user gets Joining offer or not.
                $dataJoinOffers = $this->users->getjoiningoffersWalletDetailsPromoCode($role_id, $this->input->post('promo_code'));
                //end check whethere user gets Joining offer or not.
                //check whethere user gets Wallet offer or not.
                $dataWalletOffers1 = $this->users->getwalletoffersWalletDetailsPromoCode($role_id, $this->input->post('promo_code'), $this->input->post('amount'), 'exact');
                $dataWalletOffers2 = $this->users->getwalletoffersWalletDetailsPromoCode($role_id, $this->input->post('promo_code'), $this->input->post('amount'), 'upto');

                //print_r($dataWalletOffers1);
                //echo "++++<br>";
                //print_r($dataWalletOffers2);exit;
                //end check whethere user gets Wallet offer or not.

                $arrayData = array(
                    'user_id' => $user_id,
                    'total_amount' => $this->input->post('amount'),
                    'information' => json_encode(array('user_id' => $user_id, 'total_amount' => $this->input->post('amount'), 'transaction_status_id' => 1, 'shipping_method_id' => 1, 'transaction_stage_time' => date("Y-m-d H:i:s"))),
                    'transaction_status_id' => 1,
                    'shipping_method_id' => 1,
                    'transaction_stage_time' => date("Y-m-d H:i:s")
                );
                $sales_id = $this->common_model->commonInsert("va_sales_order", $arrayData);
                $userdetails = $this->users->get_user_details($user_id, $role_id);

                $checkWallet = $userdetails['wallet'] + $this->input->post('amount');
                //print_r($userdetails);
                if ($checkWallet < 0) {
                    $this->session->set_userdata("wallet_error", "You have to filled minimum wallet amount " . $userdetails['wallet']);
                    redirect('smd/add_funds');
                    exit;
                }
                $sessDataArr = array(
                    'name' => $userdetails['name'],
                    'email' => $userdetails['email_id'],
                    'phone' => $userdetails['mobile'],
                    'amount' => $this->input->post('amount')
                );
                $this->session->set_userdata($sessDataArr);
                if ($this->input->post('ptype') == 1) {

                    //print_r($_POST);


                    $totamount = $this->input->post('amount');
                    if (!empty($dataJoinOffers)) {
                        echo "smd 11111";
                        if ($this->input->post('amount') >= $dataJoinOffers[0]->min_wallet_amoun) {

                            $totamount = $this->input->post('amount') + $dataJoinOffers[0]->offer_amount;
                            //update users table by making joining offers amount ot 1 measn its used.
                            $updates_status = $this->users->update_joing_offer_min_wallet($user_id, $this->input->post('promo_code'), $dataJoinOffers[0]->offer_amount, 2);
                        }
                    } else if (!empty($dataWalletOffers1)) {
                        echo "smd 222222";
                        if ($dataWalletOffers1[0]->offer_mode == "INR") {
                            $totamount = $this->input->post('amount') + $dataWalletOffers1[0]->add_amount;
                            $updates_status = $this->users->update_wallet_offer_min_wallet($user_id, $this->input->post('promo_code'), $dataWalletOffers1[0]->add_amount, 1);
                        } else if ($dataWalletOffers1[0]->offer_mode == "PEC") {
                            $extra_amt = $this->input->post('amount') * $dataWalletOffers1[0]->add_amount / 100;
                            $totamount = $this->input->post('amount') + $extra_amt;
                            $updates_status = $this->users->update_wallet_offer_min_wallet($user_id, $this->input->post('promo_code'), $extra_amt, 1);
                        } else {

                        }
                    } else if (!empty($dataWalletOffers2)) {
                        //echo "333333";//
                        //print_r($dataWalletOffers1[0]);
                        if ($dataWalletOffers2[0]->offer_mode == "INR") {
                            $totamount = $this->input->post('amount') + $dataWalletOffers2[0]->add_amount;
                            $updates_status = $this->users->update_wallet_offer_min_wallet($user_id, $this->input->post('promo_code'), $dataWalletOffers2[0]->add_amount, 1);
                        } else if ($dataWalletOffers1[0]->offer_mode == "PEC") {
                            $extra_amt = $this->input->post('amount') * $dataWalletOffers2[0]->add_amount / 100;
                            $totamount = $this->input->post('amount') + $extra_amt;
                            $updates_status = $this->users->update_wallet_offer_min_wallet($user_id, $this->input->post('promo_code'), $extra_amt, 1);
                        } else {

                        }
                    } else {

                    }
                    //exit('at the end Here');
					$ref = $this->input->post('reference_number');
					$result123 = $this->common_model->raw_query("select * from wallet_history where reference_number = '$ref' ");
					$num =$result123->result_id->num_rows;
						/*echo "NUM".$num."NUM";
					print("<pre>");
					print_r($result123);die;*/

					if($num >= 1 )
					{
						/*$role_id = $this->session->userdata('role_id');
						$this->load->view('website_template/header', $data);
						$this->load->view('website/agent/add_funds');
						$this->load->view('website_template/footer');*/
						redirect('smd/addfundfail');

					}
					else
					{


                    $arrayData = array(
                        'user_id' => $user_id,
                        'role_id' => $role_id,
                        //'amount' => $this->input->post('amount'),
                        'amount' => $totamount,
                        'original_amount' => $this->input->post('amount'),
                        'reference_number' => $this->input->post('reference_number'),
                        'transfer_type' => $this->input->post('ttype'),
                        'account_name' => $this->input->post('account_name'),
                        'bank_name' => $this->input->post('bank_name'),
                        'payment_status' => 0,
                        'payment_mode' => 1,
                        'credit_debit' => 2,
                        'create_dt' => date("Y-m-d H:i:s")
                    );
                    if ($this->input->post('ttype') == 1) {
                        $arrayData['account_number'] = $this->input->post('account_number');
                    } else {
                        $config['upload_path'] = './adminnew/uploads/';
                        $config['file_name'] = '1';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $this->load->library('upload', $config);
                        $this->upload->do_upload('counter_file');
                        $arrayData['counter_file'] = $this->upload->data()['file_name'];
                    }
                    $wallet = $this->common_model->commonInsert("wallet_history", $arrayData);



                    //SMS
//Code using curl
//API stands for Application Programming Integration which is widely used to integrate and enable interaction with other software, much in the same way as a user interface facilitates interaction between humans and computers. Our API codes can be easily integrated to any web or software application.
//Change your configurations here.
//---------------------------------
                    $uid = "766172696e69696e666f"; //your uid
                    $pin = "ccdb37d4de7737d75924ab4507e03303"; //your api pin
                    $sender = "LAABUS"; // approved sender id
                    $domain = "smsalertbox.com"; // connecting url
                    $route = "5"; // 0-Normal,1-Priority
                    $method = "POST";
//---------------------------------



                    $mobile = $this->session->userdata('Mobile');
                    $name = $this->session->userdata('name');
                    //$amount=$this->session->userdata('rcAmount');


                    $user_id = $this->session->userdata('user_id');
                    $role_id = $this->session->userdata('role_id');
                    $wallet_amount = $this->users->get_wallet_amount($user_id, $role_id);
                    $tot_W_a = $wallet_amount + $totamount;

                    //echo $mobile."::".$_POST['amount']."::".$totamount;//exit;
                    //$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
                    //$message = 'Dear '.$name.', Your Wallet is filled with INR '.$_POST['amount'].'. Your net Wallet Amount is '.$totamount.'. thank you for using w LAABUS . download app @ https://goo.gl/QWUiJ';
                   // $message = 'Dear ' . $name . ', Your Wallet is filled with INR ' . $totamount . '. Your net Wallet Amount is ' . $tot_W_a . '. thank you for using w LAABUS . download  app @ https://goo.gl/QWUiJ';
                    //$uid=urlencode($uid);
                    //$pin=urlencode($pin);
                    //$sender=urlencode($sender);

					$message = 'Dear '.$name.', Your deposit of INR '.$_POST['amount'].' is sent to Admin successfully,Waiting for Admin Approval.';
                    $message = urlencode($message);
                    //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

                    $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

                    $url = "http://$domain/api/sms.php";

                    $ch = curl_init($url);

                    if ($method == "POST") {
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                    } else {
                        $get_url = $url . "?" . $parameters;

                        curl_setopt($ch, CURLOPT_POST, 0);
                        curl_setopt($ch, CURLOPT_URL, $get_url);
                    }

                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
                    $return_val = curl_exec($ch);

                    //var_dump($return_val);
                    //alert to ADMIN
                    $mobile = '9989624611';
                    //$message = 'Dear '.$name.', Your Wallet is filled with INR '.$totamount.'. Your net Wallet Amount is '.$tot_W_a.'. thank you for using w LAABUS . download  app @ https://goo.gl/QWUiJ';
                    $message = 'Dear Admin, ' . $name . ' deposits INR  ' . $totamount . ' in his Wallet from www.laabus.com.please review it.';
                    //$uid=urlencode($uid);
                    //$pin=urlencode($pin);
                    //$sender=urlencode($sender);
                    $message = urlencode($message);
                    //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";

                    $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

                    $url = "http://$domain/api/sms.php";

                    $ch = curl_init($url);

                    if ($method == "POST") {
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                    } else {
                        $get_url = $url . "?" . $parameters;

                        curl_setopt($ch, CURLOPT_POST, 0);
                        curl_setopt($ch, CURLOPT_URL, $get_url);
                    }

                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
                    $return_val = curl_exec($ch);

                    //var_dump($return_val);
                    //SMD
                    redirect('smd/addfundsuccess/ptype');
					}
                } else {
                    $this->session->set_userdata("promo_code_payu", $this->input->post('promo_code'));
                   // redirect('Payment/addfundspayment?txnid=' . $sales_id);
                   //redirect('merchant/index.php?txnid=' . $sales_id);

                   //redirect to ATOM.
                   /*$arrayData = array(
                        'user_id' => $user_id,
                        'role_id' => $role_id,
                        //'amount' => $this->input->post('amount'),
                        'amount' => $this->input->post('amount'),
                        'original_amount' => $this->input->post('amount'),
                        'payment_status' => 0,
                        'payment_mode' => 2,
                        'credit_debit' => 2,
                        'create_dt' => date("Y-m-d H:i:s")
                    );
                     $wallet = $this->common_model->commonInsert("wallet_history", $arrayData);*/
                   	$str ='<form style="display:none" action="http://laabus.com/merchant/submit.php" id="fff" method="post"   onload="">

<INPUT TYPE="hidden" NAME="product" value="ECOM">
<INPUT TYPE="hidden" NAME="prodid" value="ECOM">
<INPUT TYPE="hidden" NAME="TType" value="NBFundTransfer">

<INPUT TYPE="hidden" NAME="clientcode" value="007">
<INPUT TYPE="hidden" NAME="AccountNo" value="1234567890">

<INPUT TYPE="hidden" NAME="ru" value="http://laabus.com/merchant/response.php">
<input type="hidden" name="bookingid" value="100001"/>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
        <td>* Name</td>
        <td>:</td>
        <td><input name="udf1" type="text" value="Venkat" /></td>
        <td><span style="color:Red;visibility:hidden;">Client Name is mandatory.</span></td>

    </tr>
    <tr>
        <td>* Email ID</td>
        <td>:</td>
        <td><input name="udf2" type="text" value="'.$this->session->userdata('email').'" /></td>
        <td><span style="color:Red;visibility:hidden;">Email is mandatory.</span></td>
    </tr>
    <tr>

        <td>* Mobile No</td>
        <td>:</td>
        <td><input name="udf3" type="text" value="'.$this->session->userdata('Mobile').'" /></td>
        <td><span style="color:Red;visibility:hidden;">Mobile No</span></td>
    </tr>
    <tr>
        <td>* Billing Address</td>
        <td>:</td>

        <td><input name="udf4" type="text" value="HYD"  /></td>
        <td><span style="color:Red;visibility:hidden;">Billing Address is mandatory.</span></td>
    </tr>
   <!--  <tr>
        <td>* Bank Name</td>
        <td>:</td>
        <td><input name="udf5" type="text" value="bank1" /></td>
        <td><span style="color:Red;visibility:hidden;">Bank Name is mandatory.</span></td>

    </tr> -->




<tr>
<td>
Amount
</td>
<td>:</td>
<td>
<input type="text" name="amount" value="'.$this->input->post('amount').'" />
</td>
</tr>


<tr>
<td>
</td>
<td></td>
<td>
<input type="submit" name="Submit" value="Submit" />
</td>
</tr>
</table>
 </form><script>document.getElementById("fff").submit()</script>';
 echo $str;die;
                }
            } else {
                $role_id = $this->session->userdata('role_id');
                $this->load->view('website_template/header', $data);
                $this->load->view('website/smd_new/add_funds');
                $this->load->view('website_template/footer');
            }
        }
    }

    public function addfundsuccess($ptype = NULL) {
        $data1['category'] = $this->Cat->get_category();
        $data1['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data1);
            $data['type'] = ($ptype != NULL) ? 1 : 0;
            $this->load->view('website/smd_new/addfundsuccess', $data);
            $this->load->view('website_template/footer');
        }
    }

    public function addfundfail() {
        $data1['category'] = $this->Cat->get_category();
        $data1['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data1);
            $this->load->view('website/smd_new/addfundsfailure');
            $this->load->view('website_template/footer');
        }
    }

    public function services() {
        $data['category'] = $this->Cat->get_category();
        $data['roles'] = $this->users->get_roles();
        if (!check_login_status()) {
            redirect('login');
        } else {
            $role_id = $this->session->userdata('role_id');
            $this->load->view('website_template/header', $data);
            $this->load->view('website/agent/services');
            $this->load->view('website_template/footer');
        }
    }

    public function add_user() {
        $agent_id = $this->session->userdata('agent_id');
        $user_id = $this->session->userdata('user_id');

        $this->form_validation->set_rules('FirstName', 'First Name', 'trim');
        $this->form_validation->set_rules('LastName', 'Last Name', 'trim');
        $this->form_validation->set_rules('promo_code', 'Promo Code', 'callback_promo_code_exists'); //check for valid promo or not.
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_agentuser_exists');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|min_length[10]|is_unique[login.Mobile]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');
        $this->form_validation->set_rules('Address', 'Address', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['category'] = $this->Cat->get_category();
            $data['roles'] = $this->users->get_roles();
            $data['country'] = $this->users->get_country();
            $this->load->view('website_template/header', $data);
            $this->load->view('website/smd_new/add_user', $data);
            $this->load->view('website_template/footer');
        } else {
            $role_id = 4;
            $state=$this->input->post('state');
            $district = $this->input->post('district');
            $checkuser=$this->users->check_channelpatner_exists($state,$district);
            if($checkuser->num_rows() > 0){
                $ch_data=$checkuser->row();
                $chp_id=$ch_data->user_id;
            }else{
                $chp_id='0';
            }
            $user_user_id = $this->users->create_smduser($role_id, $user_id, $chp_id);
            if ($user_user_id) {
                $this->users->insertsmd_user($user_id, $user_user_id);
                $this->session->set_flashdata('msg', 'User Added Successfully.');
                redirect('smd/user');
            }
        }
    }

    public function promo_code_exists($password) {
        $promo_code = $this->input->post('promo_code');
        $role_id = $this->input->post('usertype');
        $offerdata = $this->users->getjoiningoffers(44, $promo_code);
        //print_r($offerdata);exit;
        if (empty($offerdata) && !empty($promo_code)) {
            $this->form_validation->set_message('promo_code_exists', 'Invalid Promo Code.Please enter Valid Promo Code or Leave it as Empty');
            return false;
        } else {
            return true;
        }
    }

    public function check_agentuser_exists() {
        /* $email = $this->input->post('email');
          $role_id=4;

          $emailcount=$this->users->email_agentuser_exists($email,$role_id);
          if($emailcount->cnt==0){
          return true;
          }else{
          $this->form_validation->set_message('check_agentuser_exists', 'Email Id already exists.');
          return false;
          } */

        $email = $this->input->post('email');
        // $role_id = $this->input->post('usertype');
        $role_id = 4;
        $mobile = $this->input->post('mobile');
        $emailcount = $this->users->email_exists($role_id, $email);
        $mobilecount = $this->users->mobile_exists($role_id, $mobile);
        if ($emailcount->cnt == 0 && $mobilecount == 0) {
            return true;
        } else if ($emailcount->cnt > 0 && $mobilecount->cnt == 0) {
            $this->form_validation->set_message('check_agentuser_exists', 'Email Id already exists with this role.');
            return false;
        } else if ($emailcount->cnt == 0 && $mobilecount->cnt > 0) {
            $this->form_validation->set_message('check_agentuser_exists', 'Mobile Number already exists with this role.');
            return false;
        } else if ($emailcount->cnt > 0 && $mobilecount->cnt > 0) {
            $this->form_validation->set_message('check_agentuser_exists', 'Email Id and Mobile Number already exists with this role.');
            return false;
        }
    }

    function laabus_social_sharing_buttons($content)
    {
        $laabusURL = urlencode($content);

        $laabusTitle = str_replace( ' ', '%20', 'laabus');

        $twitterURL = 'https://twitter.com/intent/tweet?text='.$laabusTitle.'&amp;url='.$laabusURL.'&amp;via=laabus';
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$laabusURL;
        $googleURL = 'https://plus.google.com/share?url='.$laabusURL;
        $bufferURL = 'https://bufferapp.com/add?url='.$laabusURL.'&amp;text='.$laabusTitle;
        $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$laabusURL.'&amp;title='.$laabusTitle;
        $whatsappURL = 'whatsapp://send?text='.$laabusTitle . ' ' . $laabusURL;

        $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$laabusURL.'&amp;media=laabus&amp;description='.$laabusTitle;

        // Add sharing button at the end of page/page content
        $variable = '<div class="laabus-social">';
        $variable .= '<a class="laabus-link laabus-twitter" href="'. $twitterURL .'" target="_blank">Twitter</a>';
        $variable .= '<a class="laabus-link laabus-facebook" href="'.$facebookURL.'" target="_blank">Facebook</a>';
        $variable .= '<a class="laabus-link laabus-whatsapp" href="'.$whatsappURL.'" target="_blank">WhatsApp</a>';
        $variable .= '<a class="laabus-link laabus-googleplus" href="'.$googleURL.'" target="_blank">Google+</a>';
        $variable .= '<a class="laabus-link laabus-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>';
        $variable .= '<a class="laabus-link laabus-linkedin" href="'.$linkedInURL.'" target="_blank">LinkedIn</a>';
        $variable .= '<a class="laabus-link laabus-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank">Pin It</a>';
        $variable .= '</div>';

        return $variable;
    }

}
?>
