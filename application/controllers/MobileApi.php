<?php

/**
 * Created by PhpStorm.
 * User: sayan
 * Date: 20/9/16
 * Time: 10:27 PM
 */
require_once(APPPATH.'config/rest.php');
//ini_set('display_errors', 1);
class MobileApi extends REST_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ApiMobile');
        $this->load->model('users_model', 'users', TRUE );
		 $this->load->model(array('common_model', 'Va_Commisions_model', 'categories_model', 'Sub_categories_model'));
    }
	
	public function replaceNullValues($data, $replacer){
		foreach($data as $key => $value){
			$data[$key] = ($data[$key] == null)?$replacer:$data[$key];
		}
		return $data;
	}
	
    public function role_get(){
        $fetchRoles = $this->ApiMobile->getRoles();
        $roles = new stdClass();
        if($fetchRoles){
            $roles->status="success";
            $roles->code="200";
            $roles->data=$fetchRoles;
            $this->response($roles, 200);
        }
        else{
            $roles->status="failure";
            $roles->code="404";
            $this->response(NULL, 404);
        }
    }
	
	public function supportmatrix_get(){
        $fetchRoles = $this->users->get_supportmatrix();
        $roles = new stdClass();
        if($fetchRoles){
            $roles->status="success";
            $roles->code="200";
            $roles->data=$fetchRoles;
            $this->response($roles, 200);
        }
        else{
            $roles->status="failure";
            $roles->code="404";
            $this->response(NULL, 404);
        }
    }
	
	
    public function agentEarnings_get(){
        $earnings = new stdClass();
        if(!$this->get('id')) {
            $earnings->status = "failure";
            $earnings->code = "500";
            $earnings->message = "Wrong Input Method";
            $this->response($earnings);
        }
        else {
            $user_id = $this->get('id');
			$userDetails = $this->users->get_userprofile_info('users', $user_id);
			$total = $this->users->get_wallet_amount($user_id,$userDetails->role_id);
			$earningsData['today'] = $this->users->get_agent_today_earning($user_id)["0"]["earnings"];
			$earningsData['month'] = $this->users->get_agent_thismonth_earning($user_id)["0"]["earnings"];
			$earningsData['year'] = $this->users->get_agent_currentyear_earning($user_id)["0"]["earnings"];
			$earningsData = $this->replaceNullValues($earningsData, '0.00');
            $earnings->status = "success";
            $earnings->code = "200";
			$earnings->data->total = number_format($total,2);
            $earnings->data->today = $earningsData['today'];
            $earnings->data->month = $earningsData['month'];
            $earnings->data->year = $earningsData['year'];
            $this->response($earnings, 200);
        }
    }

    public function profileKYC_get(){
		$profile = new stdClass();
        if(!$this->get('id')) {
            $profile->status = "failure";
            $profile->code = "500";
            $profile->message = "Wrong Input Method";
            $this->response($profile);
        }
        else {
			$profileKYCData = array('full_name' => '', 'company_name' => '', 'mobile_no' => '', 'email_id' => '', 'city' => '', 'address' => '', 'postal_code' => '', 'business_type' => '', 'pan_number' => '', 'aadhar_number' => '', 'pan_path' => '', 'aadhar_path' => '');
			$user_id = $this->get('id');
            $profileResult = $this->ApiMobile->profileKYC($user_id);
			if(!empty($profileResult)){
				//print_r($profileResult);exit;
				$profileKYCData = array('full_name' => $profileResult->name, 'company_name' => $profileResult->organization_name, 'mobile_no' => $profileResult->mobile, 'email_id' => $profileResult->email_id, 'city' => $profileResult->city_name, 'address' => $profileResult->permanent_address, 'postal_code' => $profileResult->pincode, 'business_type' => $profileResult->bussiness_type, 'pan_number' => $profileResult->pancard_number, 'aadhar_number' => $profileResult->resident_proof_number, 'pan_path' => '', 'aadhar_path' => '');
				$domain = $this->config->item('base_url');
				$path = $domain.'uploads/profile/' . trim($this->get('id'));
				if($profileResult->pancard != ''){
					$profileKYCData['pan_path'] = $path . '/' . str_replace(" ", "_", $_FILES["pancard"]["name"]) . $profileResult->pancard;
				}
				if($profileResult->resident_proof != ''){
					$profileKYCData['aadhar_path'] = $path . '/' . str_replace(" ", "_", $_FILES["proof"]["name"]) . $profileResult->resident_proof;
				}
				//$profileResult[0]->photo = $path . '/' . str_replace(" ", "_", $_FILES["photo"]["name"]).$profileResult[0]->photo;
			}
			$profileKYCData = $this->replaceNullValues($profileKYCData, '');
            $profile->status = "success";
            $profile->code = "200";
            $profile->data = $profileKYCData;
            $this->response($profile, 200);
        }
    }

    public function updateProfile_post(){
        $profileUpdate = new stdClass();
        if(!$this->get('id')) {
            $profileUpdate->status = "failure";
            $profileUpdate->code = "500";
            $profileUpdate->message = "Wrong Input Method";
            $this->response($profileUpdate);
        }
        else {
            $checkuser = $this->users->getuserin_profile('profile', $this->get('id'));
            if ($checkuser == 1) {
                $insert_values = array(
                    "Name" => trim($this->post('fullname')),
                    "Company_Name" => trim($this->post('companyname')),
                    "Dob" => trim($this->post('datepickerDemo1')),
                    "Address" => trim($this->post('address')),
                    "City" => trim($this->post('city')),
                    "Postal_code" => trim($this->post('postalcode')),
                    "updated_date" => date('Y-m-d H:i:s')
                );
                if(is_null($insert_values)){
                    $profileUpdate->status = "failure";
                    $profileUpdate->code = "500";
                    $profileUpdate->message = "Some values are missing";
                    $this->response($profileUpdate);
                }
                else {
                    $savequery = $this->users->update_user_in_profile('profile', $insert_values, $this->get('id'));
                    if ($savequery) {
                        $profileUpdate->status = "success";
                        $profileUpdate->code = "200";
                        $profileUpdate->message = "Updated successfully";
                        $this->response($profileUpdate);
                    }
                }
            }
            else {
                $insert_values = array(
                    "User_id" => trim($this->get('id')),
                    "Name" => trim($this->post('fullname')),
                    "Company_Name" => trim($this->post('companyname')),
                    "Dob" => trim($this->post('datepickerDemo1')),
                    "Address" => trim($this->post('address')),
                    "City" => trim($this->post('city')),
                    "Postal_code" => trim($this->post('postalcode')),
                    "created_date" => date('Y-m-d H:i:s'),
                    "updated_date" => date('Y-m-d H:i:s')
                );
                if(is_null($insert_values)){
                    $profileUpdate->status = "failure";
                    $profileUpdate->code = "500";
                    $profileUpdate->message = "Some values are missing";
                    $this->response($profileUpdate);
                }
                else {
                    if ($this->users->insert_user_in_profile('profile', $insert_values)) {
                        $profileUpdate->status = "success";
                        $profileUpdate->code = "200";
                        $profileUpdate->message = "Updated successfully";
                        $this->response($profileUpdate);
                    }
                }
            }
        }
    }

    public function userWallet_get(){
        $userWalletInfo = new stdClass();
        if(!$this->get('id')) {
            $userWalletInfo->status = "failure";
            $userWalletInfo->code = "500";
            $userWalletInfo->message = "Wrong Input Method";
            $this->response($userWalletInfo);
        }
        else {
            $user_id = $this->get('id');
            $profileResult = $this->ApiMobile->userWalletDetails($user_id);
            $userWalletInfo->status = "success";
            $userWalletInfo->code = "200";
            $userWalletInfo->data = $profileResult;
            $this->response($userWalletInfo, 200);
        }
    }

    public function userProfileDetails_get(){
        $userProfile = new stdClass();
        if(!$this->get('id')) {
            $userProfile->status = "failure";
            $userProfile->code = "500";
            $userProfile->message = "Wrong Input Method";
            $this->response($userProfile);
        }
        else {
            $user_id = $this->get('id');
            $profileResult = $this->ApiMobile->userProfile($user_id);

            $userProfile->status = "success";
            $userProfile->code = "200";
            $userProfile->data = $profileResult;
            $this->response($userProfile, 200);
        }
    }

    public function userAddedByAgents_get(){
        $userProfile = new stdClass();
        if(!$this->get('id')) {
            $userProfile->status = "failure";
            $userProfile->code = "500";
            $userProfile->message = "Wrong Input Method";
            $this->response($userProfile);
        }
        else {
            $user_id = $this->get('id');
            $profileResult = $this->ApiMobile->usersAddedByAgents($user_id);
            $userProfile->status = "success";
            $userProfile->code = "200";
            $userProfile->data = $profileResult;
            $this->response($userProfile, 200);
        }
    }

    public function bannerAndOffers_get(){
        $bannerOffer = new stdClass();
        $joiningOffer = $this->ApiMobile->offers('joining_offers');
        $walletOffer = $this->ApiMobile->offers('joining_wallet_offers');
        $bannerOffer->status = "success";
        $bannerOffer->code = "200";
        $bannerOffer->data->joining_offer = $joiningOffer;
        $bannerOffer->data->wallet_offer = $walletOffer;
        $this->response($bannerOffer, 200);
    }
	
	public function offersAndWalletOffers_get($role_id){
        $bannerOffer = new stdClass();
	$offers = '';
			
	if($role_id == 4){
		$allOffers = $this->users->getoffersusers($role_id);
		$walletOffers = $this->users->getofferswalletusers($role_id);
        }elseif($role_id == 6){
		$allOffers = $this->users->getoffers($role_id);
		$walletOffers = $this->users->getofferswallet($role_id);
	}else{
		$allOffers = $this->users->getoffersusers($role_id);
		$walletOffers = $this->users->getofferswalletusers($role_id);
	}	
	
	$offers = array_merge($allOffers, $walletOffers);
	$bannerOffer->status = "success";
        $bannerOffer->code = "200";
        $bannerOffer->data->offer = $offers;
        $this->response($bannerOffer, 200);
    }

    public function updateAgentKYC_post(){
		$profileKYCUpdate = new stdClass();
        if (!$this->get('id')) {
            $profileKYCUpdate->status = "failure";
            $profileKYCUpdate->code = "500";
            $profileKYCUpdate->message = "Wrong Input Method";
            $this->response($profileKYCUpdate);
        }
        else {
            $user_id = trim($this->get('id'));
            $checkuser = $this->users->getuserin_profile('profile_kyc', $user_id);
            if ($checkuser == 1) {
                $path = 'uploads/profile/' . $user_id;
                if ($this->post('h_photo') != "") {
                    if ($_FILES['photo']['name'] != '') {
                        if (is_dir($path)) {
                            unlink($path . '/' . $this->post('h_photo'));
                            $photo = str_replace(" ", "_", $_FILES["photo"]["name"]);
                            move_uploaded_file($_FILES["photo"]["tmp_name"], $path . '/' . $photo);
                        } else {
                            mkdir($path);
                            $photo = str_replace(" ", "_", $_FILES["photo"]["name"]);
                            move_uploaded_file($_FILES["photo"]["tmp_name"], $path . '/' . $photo);
                        }
                    } else {
                        $photo = $this->post('h_photo');
                    }
                }
                else {
                    if ($_FILES['photo']['name'] != '') {
                        if (is_dir($path)) {
                            $photo = str_replace(" ", "_", $_FILES["photo"]["name"]);
                            move_uploaded_file($_FILES["photo"]["tmp_name"], $path . '/' . $photo);
                        } else {
                            mkdir($path);
                            $photo = str_replace(" ", "_", $_FILES["photo"]["name"]);
                            move_uploaded_file($_FILES["photo"]["tmp_name"], $path . '/' . $photo);
                        }
                    }
                }
                if ($this->post('h_pancard') != "") {
                    if ($_FILES['pancard']['name'] != '') {
                        if (is_dir($path)) {
                            unlink($path . '/' . $this->post('h_pancard'));
                            $pancard = str_replace(" ", "_", $_FILES["pancard"]["name"]);
                            move_uploaded_file($_FILES["pancard"]["tmp_name"], $path . '/' . $pancard);
                        } else {
                            mkdir($path);
                            $pancard = str_replace(" ", "_", $_FILES["pancard"]["name"]);
                            move_uploaded_file($_FILES["pancard"]["tmp_name"], $path . '/' . $pancard);
                        }
                    } else {
                        $pancard = $this->post('h_pancard');
                    }
                } else {
                    if ($_FILES['pancard']['name'] != '') {
                        if (is_dir($path)) {
                            $pancard = str_replace(" ", "_", $_FILES["pancard"]["name"]);
                            move_uploaded_file($_FILES["pancard"]["tmp_name"], $path . '/' . $pancard);
                        } else {
                            mkdir($path);
                            $pancard = str_replace(" ", "_", $_FILES["pancard"]["name"]);
                            move_uploaded_file($_FILES["pancard"]["tmp_name"], $path . '/' . $pancard);
                        }
                    }
                }
                if ($this->post('h_proof') != "") {
                    if ($_FILES['proof']['name'] != '') {
                        if (is_dir($path)) {
                            unlink($path . '/' . $this->post('h_proof'));
                            $proof = str_replace(" ", "_", $_FILES["proof"]["name"]);
                            move_uploaded_file($_FILES["proof"]["tmp_name"], $path . '/' . $proof);
                        } else {
                            mkdir($path);
                            $proof = str_replace(" ", "_", $_FILES["proof"]["name"]);
                            move_uploaded_file($_FILES["proof"]["tmp_name"], $path . '/' . $proof);
                        }
                    } else {
                        $proof = $this->post('h_proof');
                    }
                }
                else {
                    if ($_FILES['proof']['name'] != '') {
                        if (is_dir($path)) {
                            $proof = str_replace(" ", "_", $_FILES["proof"]["name"]);
                            move_uploaded_file($_FILES["proof"]["tmp_name"], $path . '/' . $proof);
                        } else {
                            mkdir($path);
                            $proof = str_replace(" ", "_", $_FILES["proof"]["name"]);
                            move_uploaded_file($_FILES["proof"]["tmp_name"], $path . '/' . $proof);
                        }
                    }
                }
                $insert_values = array(
                    "first_name" => $this->post('firstname'),
                    "middle_name" => $this->post('middlename'),
                    "last_name" => $this->post('lastname'),
                    "mother_name" => $this->post('mothername'),
                    "dob" => $this->post('datepickerDemo'),
                    "gender" => $this->post('gender'),
                    "permanent_address" => $this->post('praddress'),
                    "communication_address" => $this->post('comaddress'),
                    "photo" => $photo,
                    "pancard" => $pancard,
                    "resident_proof" => $proof,
                    "bussiness_type" => $this->post('btype'),
                    "organization_name" => $this->post('organizationname'),
                    "created_date" => date('Y-m-d H:i:s'),
                    "updated_date" => date('Y-m-d H:i:s')
                );
                if (is_null($insert_values)) {
                    $profileKYCUpdate->status = "failure";
                    $profileKYCUpdate->code = "500";
                    $profileKYCUpdate->message = "Some values are missing";
                    $this->response($profileKYCUpdate);
                }
                else {
                    $savequery = $this->users->update_user_in_profile('profile_kyc', $insert_values, $user_id);
                    if ($savequery) {
                        $profileKYCUpdate->status = "success";
                        $profileKYCUpdate->code = "200";
                        $profileKYCUpdate->message = "Updated successfully";
                        $this->response($profileKYCUpdate);
                    }
                }
            }
            else {
                $path = 'uploads/profile/' . $user_id;
                if ($_FILES['photo']['name'] != '') {
                    if (is_dir($path)) {
                        $photo = str_replace(" ", "_", $_FILES["photo"]["name"]);
                        move_uploaded_file($_FILES["photo"]["tmp_name"], $path . '/' . $photo);
                    }
                    else {
                        mkdir($path);
                        $photo = str_replace(" ", "_", $_FILES["photo"]["name"]);
                        move_uploaded_file($_FILES["photo"]["tmp_name"], $path . '/' . $photo);
                    }
                }
                else {
                    $photo = "";
                }
                if ($_FILES['pancard']['name'] != '') {
                    if (is_dir($path)) {
                        $pancard = str_replace(" ", "_", $_FILES["pancard"]["name"]);
                        move_uploaded_file($_FILES["pancard"]["tmp_name"], $path . '/' . $pancard);
                    }
                    else {
                        mkdir($path);
                        $pancard = str_replace(" ", "_", $_FILES["pancard"]["name"]);
                        move_uploaded_file($_FILES["pancard"]["tmp_name"], $path . '/' . $pancard);
                    }
                }
                else {
                    $pancard = "";
                }
                if ($_FILES['proof']['name'] != '') {
                    if (is_dir($path)) {
                        $proof = str_replace(" ", "_", $_FILES["proof"]["name"]);
                        move_uploaded_file($_FILES["proof"]["tmp_name"], $path . '/' . $proof);
                    }
                    else {
                        mkdir($path);
                        $proof = str_replace(" ", "_", $_FILES["proof"]["name"]);
                        move_uploaded_file($_FILES["proof"]["tmp_name"], $path . '/' . $proof);
                    }
                }
                else {
                    $proof = "";
                }
                $insert_values = array(
                    "User_id" => $user_id,
                    "first_name" => $this->post('firstname'),
                    "middle_name" => $this->post('middlename'),
                    "last_name" => $this->post('lastname'),
                    "mother_name" => $this->post('mothername'),
                    "dob" => $this->post('datepickerDemo'),
                    "gender" => $this->post('gender'),
                    "permanent_address" => $this->post('praddress'),
                    "communication_address" => $this->post('comaddress'),
                    "photo" => $path . '/' . $photo,
                    "pancard" => $path . '/' . $pancard,
                    "resident_proof" => $path . '/' . $proof,
                    "bussiness_type" => $this->post('btype'),
                    "organization_name" => $this->post('organizationname'),
                    "created_date" => date('Y-m-d H:i:s'),
                    "updated_date" => date('Y-m-d H:i:s')
                );

                if ($this->users->insert_user_in_profile('profile_kyc', $insert_values)) {
                    $profileKYCUpdate->status = "success";
                    $profileKYCUpdate->code = "200";
                    $profileKYCUpdate->message = "Created successfully";
                    $this->response($profileKYCUpdate);
                }
            }
        }
    }
    public function addUserByAgent_post(){
        $addUserClass = new stdClass();
        if (!$this->post('agentId')) {
            $addUserClass->status = "failure";
            $addUserClass->code = "500";
            $addUserClass->message = "Wrong Input Method";
            $this->response($addUserClass);
        }
        else{
            $password = md5($this->post('password'));
            $this->db->select('*');
            $where1 = "FIND_IN_SET('2', avl_options)";
            $this->db->where( $where1 );
            $where2 = "FIND_IN_SET('2', users)";
            $this->db->where( $where2 );
            $where3 = "NOW() BETWEEN st_date AND end_date";
            $this->db->where( $where3 );
            $this->db->from('joining_offers');
            $query = $this->db->get()->row();

            $mywallet = 0;
            $offer_amt = $query->offer_amount;
            $users_lists = $query->users;
            $options = $query->avl_options;
            $users_lists = explode(",",$users_lists);
            $options = explode(",",$options);
            if(in_array(2,$users_lists)) {
                if(in_array(2,$options)) {
                    $mywallet = $offer_amt;
                }
            }
            $insert_to_user = array(
                "email_id" => trim($this->post('email')),
                "name" => trim($this->post('name')),
                "mobile"	=>	trim($this->post('mobile')),
                "password"	=>	trim($password),
                "org_password"  =>  $password,
                "role_id" => 4,
                "country_name" => trim($this->post('country')),
                "state_name" => trim($this->post('state')),
                "district_name" => trim($this->post('district')),
                "city_name" => ($this->post('city')),
                "address" => ($this->post('address')),
                "lupdate" => date('Y-m-d H:i:s'),
                "created_at" => date('Y-m-d H:i:s'),
                "status" =>'1' ,
                "agent_id" => $this->post('agentId'),
                "wallet" => $mywallet,
                "chp_id"=>0
            );
            if (is_null($insert_to_user)) {
                $addUserClass->status = "failure";
                $addUserClass->code = "500";
                $addUserClass->message = "Some values are missing";
                $this->response($addUserClass);
            }
            else {
                $this->db->insert("users", $insert_to_user);
                ////GENERATE CUSTOMER ID
                $id = $this->db->insert_id();
                $customer_id = "L-USR-" . $id;
                $array_cust["customer_id"] = $customer_id;
                $this->db->where('user_id', $id);
                $query = $this->db->update('users', $array_cust);

                //inserting the mapping

                $insert_agent_user_mapping = array(
                    'creation_date' => date('Y-m-d H:i:s'),
                    'agent_user_id' => $this->post('agentId'),
                    'user_user_id' => $id,
                    'status_id' => 1
                );
                $this->db->insert("va_agent_user", $insert_agent_user_mapping);
                
                $addUserClass->status = "success";
                $addUserClass->code = "200";
                $addUserClass->message = "Created successfully";
                $this->response($addUserClass);
            }
////GENERATE CUSTOMER ID
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

            $mobile = $this->post('mobile');
            $name = $this->post('name');
            $message='Dear  '.$name.', You have successfully registered as   User with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
            $message=urlencode($message);
            //$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
            $parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";
            $url="http://$domain/api/sms.php";
            $ch = curl_init($url);
            if($method=="POST") {
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
            }
            else {
                $get_url=$url."?".$parameters;
                curl_setopt($ch, CURLOPT_POST,0);
                curl_setopt($ch, CURLOPT_URL, $get_url);
            }
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
            curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
            $return_val = curl_exec($ch);

            //ONE MORE SMS TO AGENT WHILE JOING THAT ADMIN WILL APPROVE IT.*/
            /*$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';*/
            $message='Dear '.$name.' your request has been sent to admin successfully, waiting for admin approval.visit www.laabus.com for exiting offers.';
            $message=urlencode($message);
            $parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";
            $url="http://$domain/api/sms.php";
            $ch = curl_init($url);
            if($method=="POST") {
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
            }
            else {
                $get_url=$url."?".$parameters;
                curl_setopt($ch, CURLOPT_POST,0);
                curl_setopt($ch, CURLOPT_URL, $get_url);
            }
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
            curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
        }
    }
	
	public function generateHash_post(){		
        $hash = new stdClass();
		$hash->status=1;
		$hash->code="200";
		require_once APPPATH.'libraries/Payu.php';
		$obj = new Payu();
        if(isset($_GET['invoice_id']))
            $obj->setTransactionid($_GET['invoice_id']);
        if(isset($_GET['amount']))
            $obj->setAmount($_GET['amount']);
        if(isset($_GET['name']))
            $obj->setConsumerName($_GET['name']);
        if(isset($_GET['mobile']))
            $obj->setPhoneNumber($_GET['mobile']);
        if(isset($_GET['email']))
            $obj->setEmail($_GET['email']);
        if(isset($_GET['user_mobile'])&&isset($_GET['user_operator_name'])&&isset($_GET['user_rc_amount'])){
            $productInfo = "Recharge for Mobile Number ".$_GET['user_mobile']." the operator name is" .$_GET['user_operator_name']. " with amount ".$_GET['user_rc_amount']."";
            $obj->setProductInfo($productInfo);
        }
        $obj->setServerMode('test');
        $hash->result=strtolower(hash('sha512', $obj->generateHashString()));
		$this->response($hash, 200);        
	}
	
	public function moneyHash_post(){		
        $hash = new stdClass();
		$hash->status=1;
		$hash->code="200";
		
		$key=$this->post('key');
		$salt="SGuvDqtH";
		$txnId=$this->post('txnid');
		$amount=$this->post('amount');
		$productName=$this->post('productInfo');
		$firstName=$this->post('firstName');
		$email=$this->post('email');
		$udf1=$this->post('udf1');
		$udf2=$this->post('udf2');
		$udf3=$this->post('udf3');
		$udf4=$this->post('udf4');
		$udf5=$this->post('udf5');

		$payhash_str = $key . '|' . $this->checkNull($txnId) . '|' .$this->checkNull($amount)  . '|' .$this->checkNull($productName)  . '|' . $this->checkNull($firstName) . '|' . $this->checkNull($email) . '|' . $this->checkNull($udf1) . '|' . $this->checkNull($udf2) . '|' . $this->checkNull($udf3) . '|' . $this->checkNull($udf4) . '|' . $this->checkNull($udf5) . '|' . $salt;
		$hash->result = strtolower(hash('sha512', $payhash_str));
		$this->response($hash, 200);        
	}
	
	public function checkNull($value) {
		if ($value == null) {
			  return '';
		} else {
			  return $value;
		}
	}
	  
	public function creditOrders_get(){
		$response = new stdClass();
		$data['agent_id'] = $this->get('agent_id');
		$response->status = "failure";
		$response->code = "400";
		$response->message = "Bad Request";
		if($data['agent_id'] != ''){
			$this->load->model(array('common_model','Va_Commisions_model','categories_model','Sub_categories_model'));
			$response->status = "success";
			$response->code = "200";
			$response->message = "List of credit orders";
			$condition = array('agent_id'=> $data['agent_id']);
			$response->data = $this->Va_Commisions_model->order_details_credit($condition);
		}
		$this->response($response, 200);
	}
	
	public function commissionCheckerOffers_get(){
		
			$response = new stdClass();
			$response->status = "success";
			$response->code = "200";
			$response->message = "Commission values";
			$commissionDetails = $this->users->get_AgentCommisionAmountBySubCatOffers($_REQUEST["id"]);
			$netcomm = 0;
			$agent_comm = $commissionDetails[0]->agent_comm_value;			
			$agent_ref_comm = $commissionDetails[0]->agent_ref_comm_value;
			$netcomm = 0;
			$markup = 0;
			$dis = 0;
			
			if( $_REQUEST['role_id'] == 6 ){
				if( $commissionDetails[0]->mark_comm_type == "INR" ){
					$markup = $commissionDetails[0]->mark_comm_value;
				}
				else{
					$markup = $_REQUEST['discount_price']*$commissionDetails[0]->mark_comm_value/100;
				}
				
				if( $commissionDetails[0]->dis_type == "INR" ){
					$dis = $commissionDetails[0]->dis_value;					
				}
				else{
					$dis = $_REQUEST['discount_price']*$commissionDetails[0]->dis_value/100;
				}
				
				if( $commissionDetails[0]->agent_comm_type == "INR" ){
					$netcomm = $commissionDetails[0]->agent_comm_value;
					$rcAmount = $_REQUEST['discount_price']+$markup-$dis;
				}
				else{
					$rc = $_REQUEST['discount_price'];
					$rc = $rc+$markup-$dis;					
					$netcomm = $rc*$commissionDetails[0]->agent_comm_value/100;
				}
			}
			else{
				$netcomm = $_REQUEST['discount_price']*$agent_ref_comm/100;
			}
			
			$sess_net_comm = number_format($netcomm,2);
			$responseData["netcomm"] = number_format($netcomm,2);
			$responseData["markup"] = (string)$markup;
			$responseData["dis"] = (string)$dis;
			
			$response->status = "success";
			$response->code = "200";
			$response->message = "Commission values";
			$response->data = $responseData;
			
			
			/*print("<pre>");
			print_r($commissionDetails);
			die;*/
			$this->response($response, 200);
	}
	public function commissionChecker_post(){
		$response = new stdClass();
		$data = $this->post();
		$response->status = "failure";
		$response->code = "400";
		$response->message = "Bad Request";
		if($data['operator_name'] != ''){
			$commissionDetails = $this->users->get_AgentCommisionAmountBySubCat($data['operator_name']);
			$netcomm = 0;
			$agent_comm = $commissionDetails[0]->agent_comm_value;			
			$agent_ref_comm = $commissionDetails[0]->agent_ref_comm_value;
			$netcomm = 0;
			$markup = 0;
			$dis = 0;
			if( $data['role_id'] == 6 ){
				if( $commissionDetails[0]->mark_comm_type == "INR" ){
					$markup = $commissionDetails[0]->mark_comm_value;
				}
				else{
					$markup = $data['rcAmount']*$commissionDetails[0]->mark_comm_value/100;
				}
				
				if( $commissionDetails[0]->dis_type == "INR" ){
					$dis = $commissionDetails[0]->dis_value;					
				}
				else{
					$dis = $data['rcAmount']*$commissionDetails[0]->dis_value/100;
				}
				
				if( $commissionDetails[0]->agent_comm_type == "INR" ){
					$netcomm = $commissionDetails[0]->agent_comm_value;
					$rcAmount = $data['rcAmount']+$markup-$dis;
				}
				else{
					$rc = $data['rcAmount'];
					$rc = $rc+$markup-$dis;					
					$netcomm = $rc*$commissionDetails[0]->agent_comm_value/100;
				}
			}
			else{
				$netcomm = $data['rcAmount']*$agent_ref_comm/100;
			}
			//echo $netcomm;
			$sess_net_comm = number_format($netcomm,2);
			$responseData["netcomm"] = number_format($netcomm,2);
			$responseData["markup"] = $markup;
			$responseData["dis"] = $dis;
			
			$response->status = "success";
			$response->code = "200";
			$response->message = "Commission values";
			$response->data = $responseData;
		}
		$this->response($response, 200);
	}

	public function walletWithdrawOTP_post(){
		$response = new stdClass();
		$required = ['user_id'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			$userDetails = $this->users->get_userprofile_info('users', $inputs['user_id']);			
			if($userDetails == null)$returnValue = false;
			else{
				$otp = rand(100000, 999999);
                $mobile = $userDetails->mobile;
                $name = $userDetails->name;
                $message = 'Dear ' . $name . ', OTP for transaction varini info systems pvt ltd is ' . $otp . ' on www.laabus.com';
                $this->sendSMS($mobile, $message);
			}            
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "OTP sent";
			$response->data = array("otp" => $otp);
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "OTP Not sent, try again";
		}
		$this->response($response);
	}

	public function walletWithdraw_post(){
		$response = new stdClass();
		$required = ['user_id', 'amount', 'account_number', 'account_name', 'bank_name', 'ifsc_code'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($required)) {
			$returnValue = false;
		}
		else {
			$userDetails = $this->users->get_userprofile_info('users', $inputs['user_id']);			
			if($userDetails == null)$returnValue = false;
			else{
				$arrayData = array(
				    'user_id' => $inputs['user_id'],
				    'amount' => $inputs['amount'],
				    'account_number' => $inputs['account_number'],
				    'account_name' => $inputs['account_name'],
				    'bank_name' => $inputs['bank_name'],
				    'ifsc_code' => $inputs['ifsc_code'],
				    'create_dt' => date("Y-m-d H:i:s")
				);
			        $this->load->model(array('common_model', 'Va_Commisions_model', 'categories_model', 'Sub_categories_model'));
				$wallet_withdraw = $this->common_model->commonInsert("wallet_withdraw", $arrayData);
				$result = $this->common_model->raw_query("update users set wallet = wallet -  ".$inputs['amount']." where user_id = ".$inputs['user_id']);
				$tot_W_a = $userDetails->wallet - $inputs['amount'];
				$message = 'Dear ' . $userDetails->name . ', Your withdraw INR  ' . $inputs['amount'] . '. from www.laabus.com Your net Wallet Amount is ' . $tot_W_a . '. download  app @ https://goo.gl/QWUiJB';
				$message = urlencode($message);
				$this->sendSMS($userDetails->mobile, $message);
				$message = 'Dear Admin, ' . $userDetails->name . ' withdraw INR  ' . $inputs['amount'] . '. from www.laabus.com please review it.';
				$message = urlencode($message);
				$this->sendSMS('9989624611', $message);
			}            
        }
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Request Sent";
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "Request Not sent, try again";
		}
		$this->response($response);
	}

	public function isArrayValuesEmpty($data){
		$null = false;
		foreach($data as $key => $value){
			if(trim($data[$key]) == ''){
				$null = true;
				break;
			}
		}
		return $null;
	}
	
	public function inputsNullValidation($required, $inputs){
		$validation = true;
		foreach($required as $value){
			if(!array_key_exists($value, $inputs)){
				$validation = false;
				break;
			}
		}
		return $validation;
	}

	public function userBankInfo_get(){
		$response = new stdClass();
		$data['user_id'] = $this->get('user_id');
		$response->status = "failure";
		$response->code = "400";
		$response->message = "Bad Request";
		if($data['user_id'] != ''){
			$bank_info = $this->users->get_userprofile_info('profile_bank_details', $data['user_id']);
			if($bank_info == null){
				$bank_info = '';
			}
			$response->status = "success";
			$response->code = "200";
			$response->message = "Bank details";
			$response->data = $bank_info;
		}
		$this->response($response, 200);
	}

	public function updateUserBankInfo_post(){
		$response = new stdClass();
		$required = ['user_id', 'holdername', 'accounttype', 'accountselect', 'accountno'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($required)) {
			$returnValue = false;
		}
		else {
			$user_id=$inputs['user_id'];
			$data = array(
                            "User_id"	=>	$user_id,
                            "acc_holder_name" => $inputs['holdername'],
                            "acc_type" => $inputs['accounttype'],
                            "account_select" => $inputs['accountselect'],
                            "branch_name" => $inputs['branchname'],
                            "bank_name" => $inputs['bankname'],
                            "acc_number" => $inputs['accountno'],
                            "ifsc_code" => $inputs['ifsccode'],
                            "created_date" => date('Y-m-d H:i:s'),
			    "updated_date" => date('Y-m-d H:i:s')
			);
			$checkuser = $this->users->getuserin_profile('profile_bank_details',$user_id);
			if($checkuser==1){
				unset($data['User_id']);unset($data['created_date']);
				$result = $this->users->update_user_in_profile('profile_bank_details',$data,$user_id);
			}else{
				$result = $this->users->insert_user_in_profile('profile_bank_details',$data);
			}
			
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Bank details updated";
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "Bank details Not updated, try again";
		}
		$this->response($response);
	}

	public function createTransaction_post(){
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'rcAmount', 'mobile_no', 'recharge_type', 'couponCode', 'operator', 'operator_name', 'coupon_amount', 'operator_circle'];
		$inputs = $this->post();
		$nonEmptyValues = $inputs;
		unset($nonEmptyValues['couponCode']);unset($nonEmptyValues['coupon_amount']);unset($nonEmptyValues['Mark_credit_text']);
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
			$returnValue = false;
		}
		else {
			$user_id=$inputs['user_id'];
			$role_id=$inputs['role_id'];
			$this->session->set_userdata('operator', $inputs['operator']);
			$this->session->set_userdata('rcAmount', $inputs['rcAmount']);
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mobile_no', $inputs['mobile_no']);
			$this->session->set_userdata('mark_credit_text', $inputs['Mark_credit_text']);
			$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
			$rcAmount = $inputs['rcAmount'];
			$amt = ($rcAmount>$wallet_amount)?$inputs['payamount']:$rcAmount;
			$arr = array('mobile_no' => $inputs['mobile_no'],
				'recharge_type' => $inputs['recharge_type'],
				'rcAmount' => $amt,
				'couponCode' => $inputs['couponCode'],
				'operator' => $inputs['operator'],
				'operator_name'=> $inputs['operator_name'],
				'coupon_amount' => $inputs['coupon_amount'],
				'payable_amount' => ($inputs['rcAmount'] - $inputs['coupon_amount']),
				'purchase_value' => $inputs['rcAmount'],
				'operator_circle' =>$inputs['operator_circle']
					);
			$this->load->model('Sale/Salemodel');
			$sales_id = $this->Salemodel->create_order($arr);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Created";
			$response->data = array('transaction_id' => $sales_id);
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not created, try again";
		}
		$this->response($response);
	}
	
	//
	public function createTransactionNew_post(){
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'rcAmount', 'mobile_no', 'recharge_type', 'couponCode', 'operator', 'operator_name', 'coupon_amount', 'operator_circle'];
		$inputs = $this->post();
		$nonEmptyValues = $inputs;
		unset($nonEmptyValues['couponCode']);unset($nonEmptyValues['coupon_amount']);unset($nonEmptyValues['Mark_credit_text']);
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
			$returnValue = false;
		}
		else {
			$user_id=$inputs['user_id'];
			$role_id=$inputs['role_id'];
			$this->session->set_userdata('operator', $inputs['operator']);
			$this->session->set_userdata('rcAmount', $inputs['rcAmount']);
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mobile_no', $inputs['mobile_no']);
			$this->session->set_userdata('mark_credit_text', $inputs['Mark_credit_text']);
			$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
			$rcAmount = $inputs['rcAmount'];
			$amt = ($rcAmount>$wallet_amount)?$inputs['payamount']:$rcAmount;
			$arr = array('mobile_no' => $inputs['mobile_no'],
				'recharge_type' => $inputs['recharge_type'],
				'rcAmount' => $amt,
				'couponCode' => $inputs['couponCode'],
				'operator' => $inputs['operator'],
				'operator_name'=> $inputs['operator_name'],
				'coupon_amount' => $inputs['coupon_amount'],
				'payable_amount' => ($inputs['rcAmount'] - $inputs['coupon_amount']),
				'purchase_value' => $inputs['rcAmount'],
				'operator_circle' =>$inputs['operator_circle']
					);
			$this->load->model('Sale/Salemodel');
			$sales_id = $this->Salemodel->create_order($arr);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Created";
			$response->data = array('transaction_id' => $sales_id);
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not created, try again";
		}
		$this->response($response);
	}
	//
	
	
	public function checkrefernum_get(){
		$response = new stdClass();
		$required = ['ref_num'];
		$inputs = $this->get();
		$nonEmptyValues = $inputs;
				
		
		
			$ref = $inputs['ref_num'];
			$result123 = $this->common_model->raw_query("select * from wallet_history where reference_number = '$ref' ");
			$num =$result123->result_id->num_rows;
			if($num >= 1 )
					{
						$response->status = "failure";
						$response->code = "200";
						$response->message = "Exists";
					}
					else
					{
			
			$response->status = "success";
			$response->code = "200";
			$response->message = "New";
					}
			
		
		$this->response($response);
	}
	public function createTransactionoffers_get(){
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'Amount','product_id','category_id','sub_cat_id','name','address','zipcode','city','state','contact_number'];
		$inputs = $this->get();
		$nonEmptyValues = $inputs;
		//unset($nonEmptyValues['couponCode']);unset($nonEmptyValues['coupon_amount']);unset($nonEmptyValues['Mark_credit_text']);
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
			//echo "if";die;
			$returnValue = false;
		}
		else {
			//echo "else";die;
			$user_id=$inputs['user_id'];
			$role_id=$inputs['role_id'];
			//$this->session->set_userdata('operator', $inputs['operator']);
			$this->session->set_userdata('Amount', $inputs['Amount']);
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			//$this->session->set_userdata('mobile_no', $inputs['mobile_no']);
			//$this->session->set_userdata('mark_credit_text', $inputs['Mark_credit_text']);
			$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
			$Amount = $inputs['Amount'];
			//$amt = ($rcAmount>$wallet_amount)?$inputs['payamount']:$rcAmount;
			$amt = $Amount;
			$arr = array('mobile_no' => '',
				'recharge_type' => 'Offers',
				'rcAmount' => $amt,
				'couponCode' => '',
				'operator' => $inputs['product_id'],
				'operator_name'=> '',
				'coupon_amount' => '',
				'payable_amount' => $inputs['Amount'],
				'purchase_value' => $inputs['Amount'],
				'operator_circle' =>''
					);
			$this->load->model('Sale/Salemodel');
			$sales_id = $this->Salemodel->create_order($arr);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Created";
			$response->data = array('transaction_id' => $sales_id);
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not created, try again";
		}
		$this->response($response);
	}
	
	public function createTransactionbus_get(){
		$response = new stdClass();
		$_REQUEST["category_id"] = "8888";
		//$required = ['user_id', 'role_id', 'Amount','product_id','category_id','sub_cat_id','name','address','zipcode','city','state','contact_number'];
		$required = ['user_id', 'role_id', 'Amount','bus_id'];
		$inputs = $this->get();
		$nonEmptyValues = $inputs;
		//unset($nonEmptyValues['couponCode']);unset($nonEmptyValues['coupon_amount']);unset($nonEmptyValues['Mark_credit_text']);
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
			//echo "if";die;
			$returnValue = false;
		}
		else {
			//echo "else";die;
			$user_id=$inputs['user_id'];
			$role_id=$inputs['role_id'];
			//$this->session->set_userdata('operator', $inputs['operator']);
			$this->session->set_userdata('Amount', $inputs['Amount']);
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			//$this->session->set_userdata('mobile_no', $inputs['mobile_no']);
			//$this->session->set_userdata('mark_credit_text', $inputs['Mark_credit_text']);
			$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
			$Amount = $inputs['Amount'];
			//$amt = ($rcAmount>$wallet_amount)?$inputs['payamount']:$rcAmount;
			$amt = $Amount;
			$arr = array('mobile_no' => '',
				'recharge_type' => 'Bus',
				'rcAmount' => $amt,
				'couponCode' => '',
				'operator' => "Bus Ticket",
				'operator_name'=> '',
				'coupon_amount' => '',
				'payable_amount' => $inputs['Amount'],
				'purchase_value' => $inputs['Amount'],
				'operator_circle' =>''
					);
			$this->load->model('Sale/Salemodel');
			$sales_id = $this->Salemodel->create_order($arr);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Created";
			$response->data = array('transaction_id' => $sales_id);
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not created, try again";
		}
		$this->response($response);
	}

	public function transactionProcess_post(){
		ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'transaction_id', 'operator', 'recharge_type', 'wallet_amount', 'name'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			$txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
			$this->session->set_userdata('mobile_no', $txnDetails->mobile_no);
			$this->session->set_userdata('rcAmount', $txnDetails->amount);
			$this->session->set_userdata('operator', $inputs['operator']);
			$this->session->set_userdata('recharge_type', $inputs['recharge_type']);
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mark_credit', $txnDetails->mark_as_credit_user);
			$this->session->set_userdata('wallet_amount', $inputs['wallet_amount']);
			$this->session->set_userdata('netcomm', $txnDetails->total_commision);
			$this->session->set_userdata('name', $inputs['name']);
			require_once APPPATH.'libraries/Transaction_stages.php';
			$obj = new Transaction_stages();
			$obj->tenth_stage();
			$obj->update_transaction_finished($inputs['transaction_id']);
			$this->load->driver('session');
			
			require_once(APPPATH.'controllers/Payment.php'); 
			$pObj =  new Payment(false);
			$data = $pObj->recharge_success_new(array('txnid' => $inputs['transaction_id']), false);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Processed";
			$response->data = $data;
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not Processed, try again";
		}
		$this->response($response);
	}
	
	
	public function transactionProcessNew_post(){
		ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'transaction_id', 'operator', 'recharge_type', 'wallet_amount', 'name'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			$txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
			$this->session->set_userdata('mobile_no', $txnDetails->mobile_no);
			$this->session->set_userdata('rcAmount', $txnDetails->amount);
			$this->session->set_userdata('operator', $inputs['operator']);
			$this->session->set_userdata('recharge_type', $inputs['recharge_type']);
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mark_credit', $txnDetails->mark_as_credit_user);
			$this->session->set_userdata('wallet_amount', $inputs['wallet_amount']);
			$this->session->set_userdata('netcomm', $txnDetails->total_commision);
			$this->session->set_userdata('name', $inputs['name']);
			require_once APPPATH.'libraries/Transaction_stages.php';
			$obj = new Transaction_stages();
			$obj->tenth_stage();
			$obj->update_transaction_finished($inputs['transaction_id']);
			$this->load->driver('session');
			
			require_once(APPPATH.'controllers/Payment.php'); 
			$pObj =  new Payment(false);
			$data = $pObj->recharge_success_new(array('txnid' => $inputs['transaction_id']), false);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Processed";
			$response->data = $data;
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not Processed, try again";
		}
		$this->response($response);
	}
	
	
	public function transactionProcessoffers_post(){
		ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'transaction_id', 'wallet_amount'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			$txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
			$this->session->set_userdata('mobile_no', '');
			$this->session->set_userdata('rcAmount', $txnDetails->amount);
			$this->session->set_userdata('operator', '');
			$this->session->set_userdata('recharge_type', '');
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mark_credit', '');
			$this->session->set_userdata('wallet_amount', $inputs['wallet_amount']);
			$this->session->set_userdata('netcomm', $txnDetails->total_commision);
			$this->session->set_userdata('name', '');
			require_once APPPATH.'libraries/Transaction_stages.php';
			$obj = new Transaction_stages();
			$obj->tenth_stage();
			$obj->update_transaction_finished($inputs['transaction_id']);
			$this->load->driver('session');
			
			require_once(APPPATH.'controllers/Payment.php'); 
			$pObj =  new Payment(false);
			$data = $pObj->recharge_success_new(array('txnid' => $inputs['transaction_id']), false);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Processed";
			$response->data = $data;
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not Processed, try again";
		}
		$this->response($response);
	}
	
	public function transactionProcessbus_post(){
		ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'transaction_id', 'wallet_amount'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			$txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
			$this->session->set_userdata('mobile_no', '');
			$this->session->set_userdata('rcAmount', $txnDetails->amount);
			$this->session->set_userdata('operator', '');
			$this->session->set_userdata('recharge_type', '');
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mark_credit', '');
			$this->session->set_userdata('wallet_amount', $inputs['wallet_amount']);
			$this->session->set_userdata('netcomm', $txnDetails->total_commision);
			$this->session->set_userdata('name', '');
			require_once APPPATH.'libraries/Transaction_stages.php';
			$obj = new Transaction_stages();
			$obj->tenth_stage();
			$obj->update_transaction_finished($inputs['transaction_id']);
			$this->load->driver('session');
			
			require_once(APPPATH.'controllers/Payment.php'); 
			$pObj =  new Payment(false);
			$data = $pObj->recharge_success_new(array('txnid' => $inputs['transaction_id']), false);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Processed";
			$response->data = $data;
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not Processed, try again";
		}
		$this->response($response);
	}

	public function rechargePayuFail_post(){
		ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['transaction_id'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			require_once APPPATH.'libraries/Transaction_stages.php';
			$obj = new Transaction_stages();
			$obj->eighth_stage();
			$obj->update_transaction_status($inputs['transaction_id']);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Status updated";
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction status not updated, try again";
		}
		$this->response($response);
	}
	
	public function rechargePayuFailBus_post(){
		ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['transaction_id'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			require_once APPPATH.'libraries/Transaction_stages.php';
			$obj = new Transaction_stages();
			$obj->eighth_stage();
			$obj->update_transaction_status($inputs['transaction_id']);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Status updated";
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction status not updated, try again";
		}
		$this->response($response);
	}
	
	public function rechargeATOMFail_post(){
		ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['transaction_id'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			require_once APPPATH.'libraries/Transaction_stages.php';
			$obj = new Transaction_stages();
			$obj->eighth_stage();
			$obj->update_transaction_status($inputs['transaction_id']);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Status updated";
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction status not updated, try again";
		}
		$this->response($response);
	}
	
	public function walletPayment_post(){
		//ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'transaction_id', 'amount', 'mark_credit', 'mark_credit_text', 'operator', 'recharge_type', 'wallet_amount', 'name'];
		$inputs = $this->post();
		$returnValue = true;
		$nonEmptyValues = $inputs;
		unset($nonEmptyValues['mark_credit_text']);
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
			$returnValue = false;
		}
		else {
			$arrayData=array(
				'user_id'=>$inputs['user_id'],
				'transaction_id'=>$inputs['transaction_id'],
				'amount'=>$inputs['amount'],
				'service_type'=>"Recharge",
				'pay_mode'=>1,
				'lupdate'=>date("Y-m-d H:i:s"),
				'created_date'=>date("Y-m-d H:i:s"),
				'mark_credit'=>$inputs['mark_credit'] ,
				'mark_credit_text'=>$inputs['mark_credit_text'],
				'status'=>1
			);
			$this->load->model(array('common_model','Va_Commisions_model','categories_model','Sub_categories_model'));
                        $orders=$this->common_model->commonInsert("orders",$arrayData);

			$txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
			$this->session->set_userdata('mobile_no', $txnDetails->mobile_no);
			$this->session->set_userdata('rcAmount', $txnDetails->amount);
			$this->session->set_userdata('operator', $inputs['operator']);
			$this->session->set_userdata('recharge_type', $inputs['recharge_type']);
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mark_credit', $inputs['mark_credit']);
			$this->session->set_userdata('wallet_amount', $inputs['wallet_amount']);
			$this->session->set_userdata('netcomm', $txnDetails->total_commision);
			$this->session->set_userdata('name', $inputs['name']);
			require_once(APPPATH.'controllers/Payment.php'); 
			$pObj =  new Payment(false);
			$data = $pObj->wallet_recharge($inputs['transaction_id'], false);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Processed";
			$response->data = $data;
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not Processed, try again";
		}
		$this->response($response);
	}
	
	public function walletPaymentNew_post(){
		//ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'transaction_id', 'amount', 'mark_credit', 'mark_credit_text', 'operator', 'recharge_type', 'wallet_amount', 'name'];
		$inputs = $this->post();
		$returnValue = true;
		$nonEmptyValues = $inputs;
		unset($nonEmptyValues['mark_credit_text']);
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
			$returnValue = false;
		}
		else {
			$arrayData=array(
				'user_id'=>$inputs['user_id'],
				'transaction_id'=>$inputs['transaction_id'],
				'amount'=>$inputs['amount'],
				'service_type'=>"Recharge",
				'pay_mode'=>1,
				'lupdate'=>date("Y-m-d H:i:s"),
				'created_date'=>date("Y-m-d H:i:s"),
				'mark_credit'=>$inputs['mark_credit'] ,
				'mark_credit_text'=>$inputs['mark_credit_text'],
				'status'=>1
			);
			$this->load->model(array('common_model','Va_Commisions_model','categories_model','Sub_categories_model'));
                        $orders=$this->common_model->commonInsert("orders",$arrayData);

			$txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
			$this->session->set_userdata('mobile_no', $txnDetails->mobile_no);
			$this->session->set_userdata('rcAmount', $txnDetails->amount);
			$this->session->set_userdata('operator', $inputs['operator']);
			$this->session->set_userdata('recharge_type', $inputs['recharge_type']);
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mark_credit', $inputs['mark_credit']);
			$this->session->set_userdata('wallet_amount', $inputs['wallet_amount']);
			$this->session->set_userdata('netcomm', $txnDetails->total_commision);
			$this->session->set_userdata('name', $inputs['name']);
			require_once(APPPATH.'controllers/Payment.php'); 
			$pObj =  new Payment(false);
			$data = $pObj->wallet_recharge($inputs['transaction_id'], false);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Processed";
			$response->data = $data;
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not Processed, try again";
		}
		$this->response($response);
	}
	
	
	public function walletPaymentoffers_post(){
		//ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'transaction_id', 'amount',  'wallet_amount'];
		$inputs = $this->post();
		$returnValue = true;
		$nonEmptyValues = $inputs;
		//unset($nonEmptyValues['mark_credit_text']);
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
			$returnValue = false;
		}
		else {
			$arrayData=array(
				'user_id'=>$inputs['user_id'],
				'transaction_id'=>$inputs['transaction_id'],
				'amount'=>$inputs['amount'],
				'service_type'=>"LimitedOffers",
				'pay_mode'=>1,
				'lupdate'=>date("Y-m-d H:i:s"),
				'created_date'=>date("Y-m-d H:i:s"),
				'mark_credit'=>'',
				'mark_credit_text'=>'',
				'status'=>1
			);
			$this->load->model(array('common_model','Va_Commisions_model','categories_model','Sub_categories_model'));
                        $orders=$this->common_model->commonInsert("orders",$arrayData);

			$txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
			$this->session->set_userdata('mobile_no', '');
			$this->session->set_userdata('rcAmount', $inputs['amount']);
			$this->session->set_userdata('operator', '');
			$this->session->set_userdata('recharge_type', 'LimitedOffers');
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mark_credit', '');
			$this->session->set_userdata('wallet_amount', $inputs['wallet_amount']);
			$this->session->set_userdata('netcomm', $txnDetails->total_commision);
			$this->session->set_userdata('name', '');
			require_once(APPPATH.'controllers/Payment.php'); 
			$pObj =  new Payment(false);
			$data = $pObj->wallet_recharge($inputs['transaction_id'], false);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Processed";
			$response->data = $data;
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not Processed, try again";
		}
		$this->response($response);
	}
	
	
	public function walletPaymentbus_post(){
		//ini_set('display_errors', 1);
		$response = new stdClass();
		$required = ['user_id', 'role_id', 'transaction_id', 'amount',  'wallet_amount'];
		$inputs = $this->post();
		$returnValue = true;
		$nonEmptyValues = $inputs;
		//unset($nonEmptyValues['mark_credit_text']);
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
			$returnValue = false;
		}
		else {
			$arrayData=array(
				'user_id'=>$inputs['user_id'],
				'transaction_id'=>$inputs['transaction_id'],
				'amount'=>$inputs['amount'],
				'service_type'=>"Bus",
				'pay_mode'=>1,
				'lupdate'=>date("Y-m-d H:i:s"),
				'created_date'=>date("Y-m-d H:i:s"),
				'mark_credit'=>'',
				'mark_credit_text'=>'',
				'status'=>1
			);
			$this->load->model(array('common_model','Va_Commisions_model','categories_model','Sub_categories_model'));
                        $orders=$this->common_model->commonInsert("orders",$arrayData);

			$txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
			$this->session->set_userdata('mobile_no', '');
			$this->session->set_userdata('rcAmount', $inputs['amount']);
			$this->session->set_userdata('operator', '');
			$this->session->set_userdata('recharge_type', 'Bus');
			$this->session->set_userdata('user_id', $inputs['user_id']);
			$this->session->set_userdata('role_id', $inputs['role_id']);
			$this->session->set_userdata('mark_credit', '');
			$this->session->set_userdata('wallet_amount', $inputs['wallet_amount']);
			$this->session->set_userdata('netcomm', $txnDetails->total_commision);
			$this->session->set_userdata('name', '');
			require_once(APPPATH.'controllers/Payment.php'); 
			$pObj =  new Payment(false);
			$data = $pObj->wallet_recharge_bus($inputs['transaction_id'], false);
        	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Transaction Processed";
			$response->data = $data;
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "transaction Not Processed, try again";
		}
		$this->response($response);
	}
	
	public function sendOTP_post(){
		$response = new stdClass();
		$required = ['user_id'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
		}
		else {
			$userDetails = $this->users->get_userprofile_info('users', $inputs['user_id']);			
			if($userDetails == null)$returnValue = false;
			else{
				$otp = rand(100000, 999999);
                $name = $userDetails->name;
                $message = 'Dear ' . $name . ', OTP for transaction varini info systems pvt ltd is ' . $otp . ' on www.laabus.com';
                $this->sendSMS($userDetails->mobile, $message);
			}            
    	}
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "OTP sent";
			$response->data = array("otp" => $otp);
		}else{
			$response->status = "failure";
			$response->code = "400";
			$response->message = "OTP Not sent, try again";
		}
		$this->response($response);
	}

    public function sendSMS($mobile, $message){
        $uid = "766172696e69696e666f"; //your uid
        $pin = "ccdb37d4de7737d75924ab4507e03303"; //your api pin
        $sender = "LAABUS"; // approved sender id
        $domain = "smsalertbox.com"; // connecting url 
        $route = "5"; // 0-Normal,1-Priority
        $method = "POST";   
        $message = urlencode($message);
        $parameters = "uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";
        
        $url = "http://$domain/api/sms.php";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
        $return_val = curl_exec($ch);
    }

    public function forgotPassword_post(){
        $response = new stdClass();
        $required = ['email'];
        $inputs = $this->post();
        $returnValue = true;
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
            $returnValue = false;
        }
        else {
            $q = $this->users->get_user($inputs['email']);
            if($q->num_rows() == 0)$returnValue = false;
            else{
                $r = $q->result();
                $user = $r[0];
		$mobile = $user->mobile;
                $name = $user->name;
                $password = $user->org_password;
		if($password == ''){
			$password  = 'laabus@123';
			$this->users->saveNewPass($password,$user->email_id,$user->role_id);
		}
                $message ='Dear '.$name.', You new  Password is '.$password.'. thank you for using www.laabus.com For best offers download  app @ https://goo.gl/QWUiJB';
                $this->sendSMS($mobile, $message);
            }            
        }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Password Sent";
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Password Not sent, try again";
        }
        $this->response($response);
    }

    public function passwordReset_post(){
        $response = new stdClass();
        $required = ['email', 'password'];
        $inputs = $this->post();
        $returnValue = true;
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
            $returnValue = false;
        }
        else {
            $q = $this->users->get_user($inputs['email']);
            if($q->num_rows() == 0)$returnValue = false;
            else{
                $r = $q->result();
                $user = $r[0];
                $new_pass = $inputs['password'];
                $email = $inputs['email'];
                $role_id = $user->role_id;
                $this->users->saveNewPass($new_pass,$email,$role_id);                
            }            
        }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Password Updated";
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Password Not Updated, try again";
        }
        $this->response($response);
    }

    public function addFundsTrasactionId_post(){
        $response = new stdClass();
        $required = ['user_id', 'promo_code', 'amount'];
        $inputs = $this->post();
        $returnValue = true;
        $nonEmptyValues = $inputs;
        unset($nonEmptyValues['promo_code']);
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
            $returnValue = false;
        }
        else {
            $usertypes = $this->users->checkUserTypeLaabus($inputs['user_id']);
            $agent_id = $usertypes[0]->agent_id;
            // print_r($usertypes);
            
            
            $role_id = $usertypes[0]->agent_id;
            $user_id = $inputs['user_id'];
            $arrayData = array(
                'user_id' => $user_id,
                'total_amount' => $inputs['amount'],
                'information' => json_encode(array('user_id' => $user_id, 'total_amount' => $inputs['amount'], 'transaction_status_id' => 1, 'shipping_method_id' => 1, 'transaction_stage_time' => date("Y-m-d H:i:s"))),
                'transaction_status_id' => 1,
                'shipping_method_id' => 1,
                'transaction_stage_time' => date("Y-m-d H:i:s")
            );
            $this->load->model('common_model');
            $sales_id = $this->common_model->commonInsert("va_sales_order", $arrayData);            
        }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Transaction Created";
            $response->data = array('transaction_id' => $sales_id);
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Transaction Not Created, try again";
        }
        $this->response($response);
    }

    public function addFundsPaymentSuccess_post(){
        ini_set('display_errors', 1);
        $response = new stdClass();
        $required = ['user_id', 'role_id', 'txnid', 'amount', 'promo_code', 'mobile', 'name'];
        $inputs = $this->post();
        $returnValue = true;
        $nonEmptyValues = $inputs;
        unset($nonEmptyValues['promo_code']);
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
            $returnValue = false;
        }
        else {
            $txnDetails = $this->ApiMobile->getTxnDetails($inputs['transaction_id']);
            $this->load->driver('session');
            $this->session->set_userdata('user_id', $inputs['user_id']);
            $this->session->set_userdata('role_id', $inputs['role_id']);
            $this->session->set_userdata('promo_code_payu', $inputs['promo_code']);
            $this->session->set_userdata('Mobile', $inputs['mobile']);
            $this->session->set_userdata('name', $inputs['name']);
            $this->session->set_userdata('amount', $inputs['amount']);
            require_once(APPPATH.'controllers/Payment.php'); 
            $pObj =  new Payment(false);
            $pObj->fundpayment_success(false);
            }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Funds Added";
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Funds Not Added, try again";
        }
        $this->response($response);
    }

    public function addFundsBank_post(){
        $response = new stdClass();
        $required = ['user_id', 'role_id', 'promo_code', 'amount', 'reference_number', 'ttype', 'account_name', 'bank_name', 'mobile', 'name'];
        $inputs = $this->post();
        $returnValue = true;
        $nonEmptyValues = $inputs;
        unset($nonEmptyValues['account_number']);unset($nonEmptyValues['counter_file']);
	unset($nonEmptyValues['counter_file_ext']);unset($nonEmptyValues['promo_code']);
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($nonEmptyValues)) {
            $returnValue = false;
        }
        else {
            $usertypes = $this->users->checkUserTypeLaabus($inputs['user_id']);
            $agent_id = $usertypes[0]->agent_id;
            if(empty($agent_id))
            {
                $role_id = 4;
            }
            else
            {
                $role_id =44;
            }
            //check whethere user gets Joining offer or not.
            $dataJoinOffers = $this->users->getjoiningoffersWalletDetailsPromoCode($role_id,$inputs['promo_code']);              
            //end check whethere user gets Joining offer or not.
            
            //check whethere user gets Wallet offer or not.
            $dataWalletOffers1 = $this->users->getwalletoffersWalletDetailsPromoCode($role_id,$inputs['promo_code'],$inputs['amount'],'exact');
            $dataWalletOffers2 = $this->users->getwalletoffersWalletDetailsPromoCode($role_id,$inputs['promo_code'],$inputs['amount'],'upto');
            
            //end check whethere user gets Wallet offer or not.
            $totamount = $inputs['amount'];
            $user_id = $inputs['user_id'];
            $role_id = $inputs['role_id'];
            if(!empty($dataJoinOffers))
            {
                if( $inputs['amount'] >= $dataJoinOffers[0]->min_wallet_amoun )
                {
                
                    $totamount = $inputs['amount']+ $dataJoinOffers[0]->offer_amount;                        
                //update users table by making joining offers amount ot 1 measn its used.
                 $updates_status = $this->users->update_joing_offer_min_wallet($user_id,$inputs['promo_code'],$dataJoinOffers[0]->offer_amount,2);
                }
            }
            else if ( !empty($dataWalletOffers1))
            {
                if( $dataWalletOffers1[0]->offer_mode == "INR")
                {
                    $totamount = $inputs['amount']+ $dataWalletOffers1[0]->add_amount;
                    $updates_status = $this->users->update_wallet_offer_min_wallet($user_id,$inputs['promo_code'],$dataWalletOffers1[0]->add_amount,1);
                }
                else if( $dataWalletOffers1[0]->offer_mode == "PEC")
                {
                    $extra_amt = $inputs['amount']*$dataWalletOffers1[0]->add_amount/100;
                    $totamount = $inputs['amount']+ $extra_amt;
                    $updates_status = $this->users->update_wallet_offer_min_wallet($user_id,$inputs['promo_code'],$extra_amt,1);
                }
                else
                {
                    
                }
            }
            else if ( !empty($dataWalletOffers2))
            {
                //echo "333333";//                      
                //print_r($dataWalletOffers1[0]);
                if( $dataWalletOffers2[0]->offer_mode == "INR")
                {
                    $totamount = $inputs['amount']+ $dataWalletOffers2[0]->add_amount;
                    $updates_status = $this->users->update_wallet_offer_min_wallet($user_id,$inputs['promo_code'],$dataWalletOffers2[0]->add_amount,1);
                }
                else if( $dataWalletOffers1[0]->offer_mode == "PEC")
                {
                    $extra_amt = $inputs['amount']*$dataWalletOffers2[0]->add_amount/100;
                    $totamount = $inputs['amount']+ $extra_amt;
                    $updates_status = $this->users->update_wallet_offer_min_wallet($user_id,$inputs['promo_code'],$extra_amt,1);
                }
                else
                {
                    
                }
            }
            else
            {
                
            }
            //exit('at the end Here');
            $arrayData = array(
                'user_id' => $user_id,
                'role_id' => $role_id,
                //'amount' => $inputs['amount'],
                'amount' => $totamount,
                'original_amount' => $inputs['amount'],
                'reference_number' => $inputs['reference_number'],
                'transfer_type' => $inputs['ttype'],
                'account_name' => $inputs['account_name'],
                'bank_name' => $inputs['bank_name'],
                'payment_status' => 0,
                'payment_mode' => 1,
                'credit_debit' => 2,
                'create_dt' => date("Y-m-d H:i:s")
            );
            if ($inputs['ttype'] == 1) {
                $arrayData['account_number'] = $inputs['account_number'];
            } else {
		if(isset($inputs['counter_file_ext'])){
			$path = 'adminnew/uploads';
			if (!file_exists($path)) {
		            mkdir($path, 0777, true);
		        }
			$this->saveBinaryImage($inputs['counter_file'], $path.'/counter_file_'.$user_id.'.'.$inputs['counter_file_ext']);	
			$arrayData['counter_file'] =  'counter_file_'.$user_id.'.'.$inputs['counter_file_ext'];
		}
            }
            $this->load->model('common_model');
            $wallet = $this->common_model->commonInsert("wallet_history", $arrayData);   
            $wallet_amount = $this->users->get_wallet_amount($inputs['user_id'],$inputs['role_id']);
            $tot_W_a = $wallet_amount+$totamount;  
            $mobile = $inputs['mobile'];
            $name = $inputs['name'];
            $message = 'Dear '.$name.', Your Wallet will be credited with INR '.$totamount.'. after admin approval. thank you for using w LAABUS . download  app @ https://goo.gl/QWUiJ';    
            $this->sendSMS($mobile, $message);
            $mobile = '9989624611';
            $message = 'Dear Admin, '.$name.' deposits INR  '.$totamount.' in his Wallet from www.laabus.com.please review it.';
            $this->sendSMS($mobile, $message);
        }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Details Added";
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Details Not Added, try again";
        }
        $this->response($response);
    }

    public function updateCreditReportStatus_post(){
        ini_set('display_errors', 1);
        $response = new stdClass();
        $required = ['sales_ids', 'status'];
        $inputs = $this->post();
        $returnValue = true;
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
            $returnValue = false;
        }
        else {
		$this->load->model(array('Va_Commisions_model'));
		$this->Va_Commisions_model->updatesPaymentStatus($inputs['sales_ids'], $inputs['status']);
            }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Status updated";
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Status not updated, try again";
        }
        $this->response($response);
    }

    public function checkMobileExists_post(){
        ini_set('display_errors', 1);
        $response = new stdClass();
        $required = ['mobile'];
        $inputs = $this->post();
        $returnValue = true;
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
            $returnValue = false;
        }
        else {
		$userDetails = $this->users->mobile_exists(444, $inputs['mobile']);
            }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Details fetched";
	    $response->data = $userDetails;
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Please try again";
        }
        $this->response($response);
    }
	
    public function saveBinaryImage($binaryCode, $imageName){
    	$data = $binaryCode;
	$data = base64_decode($data);
	$im = imagecreatefromstring($data);
	file_put_contents($imageName, $data);
    }

    public function laabusRechargeCommission_post(){
        ini_set('display_errors', 1);
        $response = new stdClass();
        $required = ['operator_name', 'recharge_type', 'rc_amount'];
        $inputs = $this->post();
        $returnValue = true;
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
            $returnValue = false;
        }
        else {
		$this->session->set_userdata('recharge_type', $inputs['recharge_type']);
		$commissionDetails = $this->users->get_AgentCommisionAmountBySubCat($inputs['operator_name']);
		if ($commissionDetails[0]->mark_comm_type == "INR") {
                    $markup = $commissionDetails[0]->mark_comm_value;
                } else {
                    $markup = $inputs['rc_amount'] * $commissionDetails[0]->mark_comm_value / 100;
                }

                if ($commissionDetails[0]->dis_type == "INR") {
                    $dis = $commissionDetails[0]->dis_value;
                } else {
                    $dis = $inputs['rc_amount'] * $commissionDetails[0]->dis_value / 100;
                }
		$data['rc_amount'] = $inputs['rc_amount'] + $markup - $dis;
            }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Details fetched";
	    $response->data = $data;
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Please try again";
        }
        $this->response($response);
    }

    public function subscriptionSuccess_post(){
        ini_set('display_errors', 1);
        $response = new stdClass();
        $required = ['user_id'];
        $inputs = $this->post();
        $returnValue = true;
        if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
            $returnValue = false;
        }
        else {
            $wallet_amount = $this->users->update_agent_subscription_payu($inputs['user_id']);
        }
        if($returnValue){
            $response->status = "success";
            $response->code = "200";
            $response->message = "Subscription success";
        }else{
            $response->status = "failure";
            $response->code = "400";
            $response->message = "Subscription not updated, try again";
        }
        $this->response($response);
    }	
}
