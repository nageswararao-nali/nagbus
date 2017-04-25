<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaction_stages {
	private $transaction_status_id;
	private $tblName = 'va_sales_order';
	
	private $ci ='';
	function __construct(){
		$this->ci = & get_instance();
	}
	
	function first_stage() {
		//NAME : Not Started
		//DESCRIPTION : The transaction has not been started yet.
		$this->transaction_status_id = 1;
	}
	function second_stage(){
		//NAME : Initiated
		//DESCRIPTION : The transaction has been started but not completed.
		$this->transaction_status_id=2;
	}
	function third_stage(){
		//NAME : Money With Payment Gateway
		//DESCRIPTION : The transaction was successful and the transaction amount is with PayUMoney.
		$this->transaction_status_id=3;
	}
	function fourth_stage(){
		//NAME : Under Dispute
		//DESCRIPTION : A dispute for the transaction has been raised.
		$this->transaction_status_id=4;
	}
	function fifth_stage(){
		//NAME : Refunded
		//DESCRIPTION : The entire amount of the transaction has been refunded.
		$this->transaction_status_id=5;
	}
	function sixth_stage(){
		//NAME : Partially Refunded
		//DESCRIPTION : A part of the amount of the transaction has been refunded.
		$this->transaction_status_id=6;
	}
	function seventh_stage(){
		//NAME : Bounced
		//DESCRIPTION : Incomplete or no details provided at PayUMoney payment page.
		$this->transaction_status_id=7;
	}
	function eighth_stage(){
		//NAME : Failed
		//DESCRIPTION : The transaction didn't complete due to a failure.
		$this->transaction_status_id=8;
	}
	function ninth_stage(){
		//NAME : Settlement in Process
		//DESCRIPTION : Settlement for the transaction is in process.
		$this->transaction_status_id=9;
	}
	function tenth_stage(){
		//NAME : Completed
		//DESCRIPTION : The transaction is settled and complete.
		$this->transaction_status_id=10;
	}
	function eleventh_stage(){
		//NAME : Payment waiting for payment confirmation
		//DESCRIPTION : Connected to payment gateway but confirmation from bank not succeeded
		$this->transaction_status_id=11;
	}
	function update_transaction_status($sales_order_id){
		try{
			$this->ci->db->where('sales_id',$sales_order_id);
			$this->ci->db->set('transaction_stage_time','NOW()',FALSE);
			$this->ci->db->set('transaction_status_id',$this->transaction_status_id);
			$this->ci->db->update($this->tblName);
		}catch (Exception $e){
			log_message(3,$e);
		}
	}
	function update_transaction_finished($sales_order_id){
		try{
			$this->ci->db->where('sales_id',$sales_order_id);
			$this->ci->db->set('transaction_stage_time','NOW()',FALSE);
			$this->ci->db->set('transaction_finished_time','NOW()',FALSE);
			$this->ci->db->set('transaction_status_id',$this->transaction_status_id);
			$this->ci->db->update($this->tblName);
		}catch(Exception $e){
		}
	}
	
	function store_successfull_transaction_info($a){
		
	}
}
