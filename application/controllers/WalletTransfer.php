<?php

/**
 * Created by PhpStorm.
 * User: sayan
 * Date: 20/9/16
 * Time: 10:27 PM
 */
require_once(APPPATH.'config/rest.php');

class WalletTransfer extends REST_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ApiMobile');
		$this->load->model('WalletTransferModel', 'wtm', TRUE );
        $this->load->model('users_model', 'users', TRUE );
		$this->load->model(array('common_model','Va_Commisions_model','categories_model','Sub_categories_model'));
    }
	
	public function replaceNullValues($data, $replacer){
		foreach($data as $key => $value){
			$data[$key] = ($data[$key] == null)?$replacer:$data[$key];
		}
		return $data;
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
	
    public function sendMoney_post(){
		$response = new stdClass();
		$required = ['mobile', 'amount', 'user_id'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
        }
        else {
			$senderDetails = $this->users->get_userprofile_info('users', $inputs['user_id']);			
			$reciverDetails = $this->wtm->getUserDetailsByMobile($inputs['mobile']);
			if($senderDetails == null || $reciverDetails == null)$returnValue = false;
			else{
				$inputs['type'] = 'send';
				$inputs['mobile_user_id'] = $reciverDetails->user_id;
				$walletTransferID = $this->wtm->insertWalletTransfer($inputs);
				$walletUpdate = $this->users->update_wallet_bus($inputs['amount'], $inputs['user_id']);
				$walletUpdate = $this->wtm->update_wallet_bus($inputs['amount'], $reciverDetails->user_id);
				$historyData = array("operator_id"=>0, "operator_type"=>'0', "role_id"=>$senderDetails->role_id, "credit_debit"=>0, "reference_number"=>$walletTransferID, "payment_mode"=>3, "transfer_type"=>3, "account_number"=>"", "counter_file"=>"", "account_name"=>"", "bank_name"=>"", "amount"=>$inputs['amount'], "original_amount"=>$inputs['amount'], "payment_status"=>2, "mark_credit"=>"", "notes"=>"", "create_dt"=>date('Y-m-d h:i:s'));
				$historyData['user_id'] = $inputs['user_id'];
				$historyData['role_id'] = $senderDetails->role_id;
				$historyData['credit_debit'] = 0;
				$wallet_history = $this->common_model->commonInsert("wallet_history", $historyData);
				$historyData['user_id'] = $reciverDetails->user_id;
				$historyData['role_id'] = $reciverDetails->role_id;
				$historyData['credit_debit'] = 1;
				$wallet_history = $this->common_model->commonInsert("wallet_history", $historyData);
			}            
        }
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Money sent";
		}else{
			$response->status = "failure";
            $response->code = "400";
            $response->message = "Money Not sent, try again";
		}
		$this->response($response);
    }
	
	public function requestMoney_post(){
		$response = new stdClass();
		$required = ['mobile', 'amount', 'user_id'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
        }
        else {
			$senderDetails = $this->users->get_userprofile_info('users', $inputs['user_id']);			
			$reciverDetails = $this->wtm->getUserDetailsByMobile($inputs['mobile']);
			if($senderDetails == null || $reciverDetails == null)$returnValue = false;
			else{
				$inputs['type'] = 'request';
				$inputs['mobile_user_id'] = $reciverDetails->user_id;
				$walletTransfer = $this->wtm->insertWalletTransfer($inputs);				
			}            
        }
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Request sent";
		}else{
			$response->status = "failure";
            $response->code = "400";
            $response->message = "Request Not sent, try again";
		}
		$this->response($response);
    }
	
	public function requestInbox_get(){
		$response = new stdClass();
		$required = ['user_id'];
		$inputs = $this->get();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$response->status = "failure";
            $response->code = "400";
            $response->message = "Wrong inputs, try again";
        }
        else {
			$inboxMessages = $this->wtm->getInboxMessages($inputs['user_id']);
			$response->status = "success";
			$response->code = "200";
			$response->message = "Money recived from your friends and money requested by friends";            
			$response->data = $inboxMessages;            
        }
		$this->response($response);
    }
	
	public function requestedAmounts_get(){
		$response = new stdClass();
		$required = ['user_id'];
		$inputs = $this->get();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$response->status = "failure";
            $response->code = "400";
            $response->message = "Wrong inputs, try again";
        }
        else {
			$requestedList = $this->wtm->getRequestedAmounts($inputs['user_id']);
			$response->status = "success";
			$response->code = "200";
			$response->message = "Request amounts to your friends";            
			$response->data = $requestedList;
        }
		$this->response($response);
    }
	
	public function approvedAmounts_get(){
		$response = new stdClass();
		$required = ['user_id'];
		$inputs = $this->get();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$response->status = "failure";
            $response->code = "400";
            $response->message = "Wrong inputs, try again";
        }
        else {
			$sentList = $this->wtm->getApprovedAmounts($inputs['user_id']);
			$response->status = "success";
			$response->code = "200";
			$response->message = "List of amounts you helped your friends";            
			$response->data = $sentList;
        }
		$this->response($response);
    }
	
	public function requestAction_post(){
		$response = new stdClass();
		$required = ['user_id', 'wallet_transer_id', 'action'];
		$inputs = $this->post();
		$returnValue = true;
		if(!$this->inputsNullValidation($required, $inputs) || $this->isArrayValuesEmpty($inputs)) {
			$returnValue = false;
        }
        else {
			$wallet_transfer_details = $this->wtm->getWalletTransferDetails($inputs['wallet_transer_id']);
			if(($wallet_transfer_details != null) && ($wallet_transfer_details->mobile_user_id == $inputs['user_id'])){
				$this->wtm->updateWalletAction($inputs['wallet_transer_id'], $inputs['action']);
				$returnValue = true;
			}else{
				$returnValue = false;
			}
	    }
		if($returnValue){
			$response->status = "success";
			$response->code = "200";
			$response->message = "Action Updated";
		}else{
			$response->status = "failure";
            $response->code = "400";
            $response->message = "Request not updated, try again";
		}
		$this->response($response);
    }
    
}
