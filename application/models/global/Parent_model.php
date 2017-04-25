<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_model extends CI_Model {
	public function __construct(){
		parent::__construct(); // :: Represent static method of codeigniter system core
	}
	
	public function get_result($colName, $tbName, $cond=""){
		$this->db->select($colName);
		if($cond!="")$this->db->where($cond);
		$data=$this->db->get($tbName);
		$res=$data->result();
		return $data->num_rows()>0 ? $res : FALSE;
	}
	
	public function user_summary($a){
		try {
			$insert_to_user_summary=array("ip" 	=>	$a['ip'],
										"task"	=>	$a['task'],
										"comment"	=>	$a['comment'],
										"ref"	=> $a['ref'],
										"User_Aget" => $_SERVER['HTTP_USER_AGENT']
									);
			$this->db->set($insert_to_user_summary);
			$this->db->insert("useractivity");
		}catch(Exception $e){
			log_message('error', 'Some variable did not contain a value.'.print_r($user_array));
		}
	}
	
	protected function generate_random_key($colName, $tbName, $length = 10){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		if($this->get_result($colName,$tbName,"$colName='".$randomString."'")==FALSE) return $randomString;
		else $this->generate_random_key($colName, $tbName);
	}
	
	function store_sms($mobile, $message, $transid){
		$insert_to_message = array(
									"mobile" =>$mobile,
									"message" => $message,
									"trans_id" => $transid,
									);
		$this->db->set($insert_to_message);
		$this->db->insert('message_box');
	}
	
	protected function whereCnd($boolean=FALSE){
           
		if(!$boolean) {
                   
                    return array('status_id'=>AVAILABLE , 'approve_id'=>ACTIVE);
                }
		else{
                     
                    return array('category_id'=>$this->getCategoryId(), 'status_id'=>AVAILABLE , 'approve_id'=>ACTIVE);
                }
                 
	}

}
