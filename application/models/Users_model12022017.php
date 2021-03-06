<?php
/**
* Users model here for getting roles and data
*/
class Users_Model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
	
	public function get_roles() {
		$this->db->select('*');
		$this->db->from('roles');
		

		$where = "role_id in(2,4,6)";

		$this->db->where($where);


		$query = $this->db->get();
		// echo "<pre>"; print_r($query); exit;
  		return $query->result();
	}

	public function get_country() {
		$this->db->select('*');
		$this->db->from('country');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getOffersplan($operator,$amount){
		
		$this->db->select('benifits as validity');
		$this->db->from('va_recharge_offers_test');
		$where = "recharge_offer_circle_id =1  and recharge_offer_operators_id = '$operator' AND price='$amount'  ";
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_supportmatrix() {
		$this->db->select('*');
		$this->db->from('support_matrix');
		$query = $this->db->get();
		return $query->result();
	}

	public function getstate($country_id) {
		// echo "<pre>"; print_r($country_id);
	 	$this->db->select('*');
	 	$this->db->from('state');
        $this->db->where('Country_id', $country_id);
        $query = $this->db->get();
        return $query->result();
	}
	
	public function getstatearray($country_id) {
		// echo "<pre>"; print_r($country_id);
	 	$this->db->select('*');
	 	$this->db->from('state');
        $this->db->where('Country_id', $country_id);
        $query = $this->db->get();
        return $query->result_array();
	}
	
	
	

	public function getdistrict($state_id) {
		// echo "<pre>"; print_r($country_id);
	 	$this->db->select('*');
	 	$this->db->from('district');
        $this->db->where('State_Code', $state_id);
        $query = $this->db->get();
        return $query->result();
	}

	public function getcities($city_id) {
		$this->db->select('*');
	 	$this->db->from('pincode');
        $this->db->where('District_Name', $city_id);
        $query = $this->db->get();
        return $query->result();
	}

	public function getpincode($city_id) {
		$this->db->select('*');
	 	$this->db->from('pincode');
        $this->db->where('Pincode', $city_id);
        $query = $this->db->get();
        return $query->result();
	}
	
	public function getoffers() {
		$this->db->select('*');
	 	$this->db->from('joining_offers');
		$where = "FIND_IN_SET('1', users)";  
		$this->db->where( $where ); 
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
        return $query->result();
	}
	
	
	public function getoffersusers($role_id) {
		$this->db->select('*');
	 	$this->db->from('joining_offers');
		//$where = "FIND_IN_SET('1', users)";  
		if($role_id == 4)
			$where = "FIND_IN_SET('2', users)"; 
		if($role_id == 44 )
			$where = "FIND_IN_SET('3', users)"; 
		$this->db->where( $where ); 
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
        return $query->result();
	}
	
	public function getsubscription() {
		$this->db->select('*');
	 	$this->db->from('agent_subscription_offers');		
		$where3 = "NOW() BETWEEN start_date AND end_date";  
		$this->db->where( $where3 ); 
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
        return $query->result();
	}
	
	
	public function getjoiningoffers($role_id,$promo_code) {
		if($role_id == 4 )
		{
			$usertype = 2;
		}
		if($role_id == 6 )
		{
			$usertype = 1;
		}
		if($role_id == 44 )
		{
			$usertype = 3;
		}
		
		$this->db->select('*');
	 	$this->db->from('joining_offers');
		
		$where = "FIND_IN_SET($usertype, users)";  
		$this->db->where( $where ); 
		
		$where2 = "FIND_IN_SET('2', avl_options)";  
		$this->db->where( $where2 );
		
		//$this->db->where('promo_code', $promo_code);

		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
        return $query->result();
	}
	
	////////
	public function getjoiningoffersWalletDetails($role_id,$promo_code) {
		if($role_id == 4 )
		{
			$usertype = 2;
		}
		if($role_id == 6 )
		{
			$usertype = 1;
		}
		if($role_id == 44 )
		{
			$usertype = 3;
		}
		
		$this->db->select('*');
	 	$this->db->from('joining_offers');
		
		$where = "FIND_IN_SET($usertype, users)";  
		$this->db->where( $where ); 
		
		$where2 = "FIND_IN_SET('1', avl_options)";  
		$this->db->where( $where2 );
		
		//$this->db->where('promo_code', $promo_code);
		

		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
		$result = $query->result();
		
		
		
		$this->db->select('*');
	 	$this->db->from('users');		
		$this->db->where('joining_offfer_wallet_amount_status', 0);
		$this->db->where("user_id", $this->session->userdata('user_id'));
		$query = $this->db->get();
		$result2 = $query->result();
		if(!empty($result2))
			return $result;
		else  
			return array();
		
		
        
	}
	/////
	
	public function check_promocode($promo_code,$amount='',$role_id='')
	{
		
		//check if user used the promo code
		$this->db->select('*');
	 	$this->db->from('users');	
		$where = "FIND_IN_SET('$promo_code', promo_code)";  
		$this->db->where( $where );
		$this->db->where("user_id", $this->session->userdata('user_id'));				
        $query = $this->db->get();
		$result = $query->result();
		if(!empty($result))
		{
			return "1";
		}
		else
		{			
			//check promo code in joining 
			$exists = 1;
			$exists2 = 1;
			$exists3 = 1;
			
			$this->db->select('*');
			$this->db->from('joining_offers');	
			$this->db->where('promo_code', $promo_code);
			$where3 = "NOW() BETWEEN st_date AND end_date";  
			$this->db->where( $where3 );			
			$query = $this->db->get();
			$result = $query->result();
			if(empty($result))
			{
				//return "0";
				$exists =0;
			}
			
			//check promo code in wallet with exact amount type.
			$this->db->select('*');
			$this->db->from('joining_wallet_offers');	
			$this->db->where('promo_code', $promo_code);
			$this->db->where('org_amount', $amount);
			$where3 = "NOW() BETWEEN start_date AND end_date";  
			$this->db->where( $where3 );
			
			if($role_id == 4 )
			{
				$usertype = 2;
			}
			if($role_id == 6 )
			{
				$usertype = 1;
			}
			if($role_id == 44 )
			{
				$usertype = 3;
			}

			$where = "FIND_IN_SET('$usertype', users_type_ids)";  
			$this->db->where( $where );			
			$query = $this->db->get();
			$result = $query->result();
			if(empty($result))
			{
				//return "0";
				$exists2 =0;
			}
			
			//check promo code in wallet with UPTO amount type.
			$this->db->select('*');
			$this->db->from('joining_wallet_offers');	
			$this->db->where('promo_code', $promo_code);
			//$this->db->where('org_amount', $amount);
			
			$where5 = "$amount BETWEEN org_amount AND org_amount_max";  
			$this->db->where( $where5 );
			
			
			$where3 = "NOW() BETWEEN start_date AND end_date";  
			$this->db->where( $where3 );
			
			if($role_id == 4 )
			{
				$usertype = 2;
			}
			if($role_id == 6 )
			{
				$usertype = 1;
			}
			if($role_id == 44 )
			{
				$usertype = 3;
			}

			$where = "FIND_IN_SET('$usertype', users_type_ids)";  
			$this->db->where( $where );			
			$query = $this->db->get();
			$result = $query->result();
			if(empty($result))
			{
				//return "0";
				$exists3 =0;
			}			
			if($exists == 0 && $exists2 == 0 && $exists3 ==0   )
			{
				return "0";
			}
			else
			{
				return "OK";
			}
			
			//return $exists;
				
		}	
		
	}
	
	
	////////
	public function getjoiningoffersTotalAmount() {
		
		$this->db->select('SUM(amount) as tot');
	 	$this->db->from('user_used_offers');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('offer_type', 2);
		$this->db->group_by('user_id');		
        $query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function getwalletoffersTotalAmount() {
		
		$this->db->select('SUM(amount) as tot');
	 	$this->db->from('user_used_offers');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('offer_type', 1);
		$this->db->group_by('user_id');		
        $query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	public function getjoiningoffersWalletDetailsPromoCode($role_id,$promo_code) {
		if($role_id == 4 )
		{
			$usertype = 2;
		}
		if($role_id == 6 )
		{
			$usertype = 1;
		}
		if($role_id == 44 )
		{
			$usertype = 3;
		}
		
		$this->db->select('*');
	 	$this->db->from('joining_offers');
		
		$where = "FIND_IN_SET($usertype, users)";  
		$this->db->where( $where ); 
		
		$where2 = "FIND_IN_SET('1', avl_options)";  
		$this->db->where( $where2 );
		
		$this->db->where('promo_code', $promo_code);
		

		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
		$result = $query->result();
		
		
		
		$this->db->select('*');
	 	$this->db->from('users');		
		$this->db->where('joining_offfer_wallet_amount_status', 0);
		$this->db->where("user_id", $this->session->userdata('user_id'));
		$query = $this->db->get();
		$result2 = $query->result();
		if(!empty($result2))
			return $result;
		else  
			return array();
		
		
        
	}
	
	public function checkUserTypeLaabus($user_id='')
	{
		$this->db->select('*');
	 	$this->db->from('users');		
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$result = $query->result();	
		return $result;
	}
	
	public function getwalletoffersWalletDetailsPromoCode($role_id,$promo_code,$amount='',$exact_upto='') {
		if($role_id == 4 )
		{
			$usertype = 2;
		}
		if($role_id == 6 )
		{
			$usertype = 1;
		}
		if($role_id == 44 )
		{
			$usertype = 3;
		}
		
		$this->db->select('*');
	 	$this->db->from('joining_wallet_offers');
		
		$where = "FIND_IN_SET($usertype, users_type_ids)";  
		$this->db->where( $where ); 		
		
		$this->db->where('promo_code', $promo_code);
		

		$where3 = "NOW() BETWEEN start_date AND end_date";  
		$this->db->where( $where3 );
		if( $exact_upto == "upto")
		{
		$where4 = "$amount BETWEEN org_amount AND org_amount_max"; 
		$this->db->where( $where4 );
		}
		else
		{
			$this->db->where('org_amount', $amount);
				
		}
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
		$result = $query->result();
		
		return $result;
		/*$this->db->select('*');
	 	$this->db->from('users');		
		$this->db->where('joining_offfer_wallet_amount_status', 0);
		$this->db->where("user_id", $this->session->userdata('user_id'));
		$query = $this->db->get();
		$result2 = $query->result();
		if(!empty($result2))
			return $result;
		else  
			return array();
		*/	
        
	}
	
	public function update_wallet_bus($amount,$user_id)
	{
		//$array_cust["xxx"] = 1;
		//$array_cust["xxx"] = 1;
		$lastUpdate = date('Y-m-d H:i:s');
		$result = $this->db->query("update `users` SET wallet = wallet-$amount, lupdate = '$lastUpdate'  WHERE `user_id`= $user_id");
	}
	public function update_joing_offer_min_wallet($user_id,$promo_code='',$offer_amt='',$offer_type='')
	{
		$array_cust["joining_offfer_wallet_amount_status"] = 1;
		//$promo_code = ",".$promo_code;
		//$array_cust["promo_code"] = "if(promo_code is null, $promo_code, concat(promo_code, $promo_code));"	;
		
		$this->db->set('promo_code', "if(promo_code is null, '".$promo_code."', CONCAT(promo_code,',','".$promo_code."'))", FALSE); 
	
		$this->db->where('user_id', $user_id);								
		$query = $this->db->update('users',$array_cust);
		
		//add offer data to db
		$insert_offer = array(
				"promo_code" => $promo_code,
				"user_id" => $user_id,
				"offer_type" => $offer_type,
				"amount" => $offer_amt,				
				"created_at" => date('Y-m-d H:i:s')
			);
		$this->db->insert("user_used_offers", $insert_offer);		
		return true;
	}
	
	public function update_wallet_offer_min_wallet($user_id,$promo_code='',$offer_amt='',$offer_type='')
	{
		$array_cust["user_id"] = $user_id;
		//$promo_code = ",".$promo_code;
		//$array_cust["promo_code"] = "if(promo_code is null, $promo_code, concat(promo_code, $promo_code));"	;
		
		$this->db->set('promo_code', "if(promo_code is null, '".$promo_code."', CONCAT(promo_code,',','".$promo_code."'))", FALSE); 
	
		$this->db->where('user_id', $user_id);								
		$query = $this->db->update('users',$array_cust);
		
		//add offer data to db
		$insert_offer = array(
				"promo_code" => $promo_code,
				"user_id" => $user_id,
				"offer_type" => $offer_type,
				"amount" => $offer_amt,				
				"created_at" => date('Y-m-d H:i:s')
			);
		$this->db->insert("user_used_offers", $insert_offer);		
		return true;
	}
	
	/////
	
	
	
	public function getofferswallet() {
		$this->db->select('*');
	 	$this->db->from('joining_wallet_offers');
		$where = "FIND_IN_SET('1', users_type_ids)";  
		$this->db->where( $where ); 
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
        return $query->result();
	}
	
	public function getofferswalletusers($role_id) {
		$this->db->select('*');
	 	$this->db->from('joining_wallet_offers');
		if($role_id == 4)
			$where = "FIND_IN_SET('2', users_type_ids)"; 
		if($role_id == 44 )
			$where = "FIND_IN_SET('3', users_type_ids)"; 
		$this->db->where( $where ); 
		$this->db->order_by("id", "desc");		
        $query = $this->db->get();
        return $query->result();
	}
	
	public function getalloffers($role_id) {
		$this->db->select('*');
	 	$this->db->from('joining_offers');
		//$where = "FIND_IN_SET('1', users)";  
		//$this->db->where( $where ); 
		$where = '';
		if($role_id == 4)
			$where = "FIND_IN_SET('2', users)"; 
		else if($role_id == 44 )
			$where = "FIND_IN_SET('3', users)"; 
		else if($role_id == 6 )
			$where = "FIND_IN_SET('1', users)"; 
		
		if(!empty($where))
		$this->db->where( $where );
	
		$this->db->order_by("id", "desc");
		$this->db->limit(2);		
        $query = $this->db->get();
        return $query->result();
	}
	
	public function getallofferswallet($role_id) {
		$this->db->select('*');
	 	$this->db->from('joining_wallet_offers');
		$where = '';
		if($role_id == 4)
			$where = "FIND_IN_SET('2', users_type_ids)"; 
		else if($role_id == 44 )
			$where = "FIND_IN_SET('3', users_type_ids)"; 
		else if($role_id == 6 )
			$where = "FIND_IN_SET('1', users_type_ids)"; 
		
		if(!empty($where))
		$this->db->where( $where );
		
		$this->db->order_by("id", "desc");
		$this->db->limit(2);		
        $query = $this->db->get();
        return $query->result();
	}
	
	
	

	//Channel Partner creating here
	public function addChannelPartner($district) {
		$insert_channel = array(
				"District_Name" => $district,
				"wallet" => "5000",
				"lupdate" => date('Y-m-d H:i:s')
			);
		$this->db->insert("channel_partners", $insert_channel);
	}

	//Channel Partner id selecting
	public function getChannel($channel) {
		$this->db->select('*');
		$this->db->from('channel_partners');
		$this->db->where('District_Name', $channel);
		$query = $this->db->get();
        return $query->result();
	}
	//Channel Partner id selecting
	public function getUserDetail($customer_id) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
        return $query->result();
	}

	//Inserting channel partner id value into role_based table
	public function addRoleBased($chrole) {
		foreach ($chrole as $chr) {
			//Getting channel partner id here
			$insert_channel = array(
					"role_reference" => $chr->chp_id,
					"role_id" => $this->input->post('usertype'),
					"lupdate" => date('Y-m-d H:i:s')
				);
			$this->db->insert("role_based", $insert_channel);
		}
	}

	public function getChannelRole($gch) {
		foreach ($gch as $gh) {
			//Selecting role based id from role based table
			$this->db->select('*');
			$this->db->from('role_based');
			$this->db->where('role_reference', $gh->chp_id);
			$query = $this->db->get();
	        return $query->result();
	    }
	}

	public function getDistrictPin($pcode) {
		$this->db->select('*');
		$this->db->from('pincode');
		$this->db->where('Pincode', $pcode);
		$query = $this->db->get();
                return $query->result();
	}
	
	public function get_AgentCommisionAmount($txn_id) {
		$this->db->select('agent_comm,agent_ref_comm');
		$this->db->from('transaction');
		$this->db->where('sales_id', $txn_id);
		$query = $this->db->get();
        return $query->result();
	}
	
	public function get_AgentCommisionAmountBySubCat($subcatid) {
		//print_r($this->session->userdata());
	  
		//echo $subcatid =  $this->session->userdata('operator_name');
		//echo "SUB CAT:".$subcatid;
		$this->db->select('agent_comm_type,agent_ref_comm_type,agent_comm_value,agent_ref_comm_value,mark_comm_type,mark_comm_value,dis_type,dis_value,our_comm_type,our_comm_value');
		$this->db->from('va_commissions_all');
		/*if( $subcatid == 'BSNL' && $this->session->userdata('recharge_type') == "Mobile postpaid" )
		{
			$subcatid = 'BSNL Top Up';
		}
		if( $subcatid == 'BSNL' && $this->session->userdata('recharge_type') == "Mobile prepaid" )
		{
			$subcatid = 'BSNL Top Up';
		}*/
		$this->db->where('sub_cat_names', $subcatid);
		if( $this->session->userdata('recharge_type') == "Mobile prepaid")
		{
			$this->db->where('bill_type', 1);
		}
		else if( $this->session->userdata('recharge_type') == "Mobile postpaid")
		{
			$this->db->where('bill_type', 2);
		}
		$query = $this->db->get();
		//print_r($query->result());
                //echo $this->db->last_query();
                return $query->result();
	}
	
	public function get_AgentCommisionAmountBySubCatOffers($subcatid) {
		
			$this->db->select('agent_comm_type,agent_ref_comm_type,agent_comm_value,agent_ref_comm_value,mark_comm_type,mark_comm_value,dis_type,dis_value,our_comm_type,our_comm_value');
		$this->db->from('va_commissions_all');
		$this->db->where('subcategory_id', $subcatid);
		$this->db->where('category_id', 9999);
		$query = $this->db->get();
		//print_r($query->result());
                //echo $this->db->last_query();
        return $query->result();
		
	}
	
	

	public function getAgentChannelRole($agr) {
		foreach ($agr as $ag) {
			$this->db->select('*');
			$this->db->from('channel_partners');
			$this->db->where('District_Name', $ag->District_Name);
			$query = $this->db->get();
        	return $query->result();
		}
	}

	//Getting district wise pincode
	public function getdpin($dpin) {
		foreach ($dpin as $dp) {
			$this->db->select('*');
			$this->db->from('pincode');
			$this->db->where('Location', $dp->District_Name);
			$query = $this->db->get();
			return $query->result();
		}
	}

	public function addAgentRole($data1, $data2) {
		$insert_agent = array(
				"chp_id" => $data1,
				"pincode" => $data2,
				"lupdate" => date('Y-m-d H:i:s'),
				"wallet" => '500'
			);
		// echo "<pre>"; print_r($insert_agent); exit;
		$this->db->insert('agents', $insert_agent);
	}

	//Getting agent role from agents table
	public function getAgentRole($val) {
		$this->db->select('*');
		$this->db->from('agents');
		$this->db->where('chp_id', $val);
		$query = $this->db->get();
		return $query->result();
	}

	public function getArole($val) {
		$this->db->select('*');
		$this->db->from('role_based');
		$this->db->where('role_reference', $val);
		$query = $this->db->get();
		return $query->result();
	}

	//Inserting agent role in role based table
	public function insertRole_Based($data3, $res) {
			$insert_agent_role = array(
				"role_reference" => $data3,
				"role_id" => $res,
				"lupdate" => date('Y-m-d H:i:s')
			);
		$this->db->insert('role_based', $insert_agent_role);
	}
        //Create channel partner here
	/*public function create_user($chrl) {
		foreach ($chrl as $val) {
			//Creating channel partner user here
			$password = md5($this->input->post('password'));
			// echo "<pre>"; print_r($_POST);
			$insert_to_login = array(
						"email_id" => $this->input->post('email',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"role_id" => $this->input->post('usertype', TRUE),
						"role_based_id" => $val->role_based_id,
						"country_name" => $this->input->post('country'),
						"state_name" => $this->input->post('state'),
						"district_name" => $this->input->post('district'),
						"city_name" => $this->input->post('city'),
						"pincode" => $this->input->post('city', TRUE),
						"lupdate" => date('Y-m-d H:i:s')
				);
			
			$this->db->insert("users",$insert_to_login);
                        return true;
		}
	}*/

/*****************************************************************************************************************/
        
        public function check_channelpatner_exists($state,$district) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('role_id', '2');
		$this->db->where('status', '1');
		$this->db->where('state_name', $state);
		$this->db->where('district_name', $district);
		$query = $this->db->get();
                return $query;
                
	}
	
	public function update_agent_subscription_payu($user_id='')
	{
		$this->db->select('*');
		$this->db->where('user_id', $user_id);		
		$this->db->from('users');		
		$query = $this->db->get()->row();		
		$agent_subscription_amt = $query->agent_subscription_amt;
		$subscription_wallet_amt = $query->subscription_wallet_amt;
		$wallet = $query->wallet;
		$wallet = $wallet+$agent_subscription_amt+$subscription_wallet_amt;
		
		$array_cust["wallet"] = $wallet;
		$array_cust["subscription_status"] = 1;		
		$this->db->where('user_id', $user_id);								
		$query = $this->db->update('users',$array_cust);							
								
		return true;
	}
        
	//Create channel partner here
	public function create_user() {
		
		
		$this->db->select('*');
		$where1 = "FIND_IN_SET('2', avl_options)"; 
		$this->db->where( $where1 );
		$where2 = "FIND_IN_SET('1', users)"; 
		$this->db->where( $where2 );

		//$this->db->where('promo_code', $this->input->post('promo_code'));
		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->from('joining_offers');
		
		$query = $this->db->get()->row();
		
		
		
		$mywallet = 0;
		$offer_amt = $query->offer_amount;
		$users_lists = $query->users;
		$options = $query->avl_options;
		
		//echo $offer_amt."<br>";
		//echo $users_lists."<br>";
		//echo $options."<br>";
		
		$users_lists = explode(",",$users_lists);
		$options = explode(",",$options);
		
		//print_r($users_lists)."<br>";
		//print_r($options)."<br>";
		
		
		//print_r($query);
		
		if(in_array(1,$users_lists))
		{
			if(in_array(2,$options))
			{
				//$mywallet = $offer_amt;
			}
		}
		
		
		
		
			//Creating channel partner user here
			$password = md5($this->input->post('password'));
			
			$cities = explode("<=>",$this->input->post('city'));	
			// echo "<pre>"; print_r($_POST);
			$insert_to_login = array(
						"email_id" => $this->input->post('email',TRUE),
						"name" => $this->input->post('name',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"role_id" => $this->input->post('usertype', TRUE),
						"role_based_id" => '',
						"country_name" => $this->input->post('country'),
						"state_name" => $this->input->post('state'),
						"district_name" => $this->input->post('district'),
						"city_name" => $cities[0],
						"pincode" => $cities[1],
						"wallet" => $mywallet,
						"lupdate" => date('Y-m-d H:i:s'),
                                                "status"=>'0'
				);
			
			$this->db->insert("users",$insert_to_login);
			
			////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								$customer_id = "L-CNL-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
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



	$mobile = $this->input->post('mobile',TRUE);
	$name = $this->input->post('name',TRUE);

	$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);

								//SMD
                        return true;
		
	}

	//Create Normal user here
	public function create_normaluser($chp_id) {
			//Create Normal user here
			
			
			//print_r($_REQUEST);exit;
			$password = md5($this->input->post('password'));
			
			
			
		$this->db->select('*');
		$where1 = "FIND_IN_SET('2', avl_options)"; 
		$this->db->where( $where1 );
		$where2 = "FIND_IN_SET('2', users)"; 
		$this->db->where( $where2 );

		//$this->db->where('promo_code', $this->input->post('promo_code'));
		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->from('joining_offers');
		
		$query = $this->db->get()->row();
		
		$mywallet = 0;
		$offer_amt = $query->offer_amount;
		$users_lists = $query->users;
		$options = $query->avl_options;
		
		//echo $offer_amt."<br>";
		//echo $users_lists."<br>";
		//echo $options."<br>";
		
		$users_lists = explode(",",$users_lists);
		$options = explode(",",$options);
		
		//print_r($users_lists)."<br>";
		//print_r($options)."<br>";
		
		
		//print_r($query);
		
		if(in_array(2,$users_lists))
		{
			if(in_array(2,$options))
			{
				$mywallet = $offer_amt;
			}
		}		
		
		
		
			// echo "<pre>"; print_r($_POST);
			
			$cities = explode("<=>",$this->input->post('city'));
			$insert_to_user = array(
						"email_id" => $this->input->post('email',TRUE),
						"name" => $this->input->post('name',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"role_id" => $this->input->post('usertype', TRUE),
						"country_name" => $this->input->post('country'),
						"state_name" => $this->input->post('state'),
						"district_name" => $this->input->post('district'),
						"city_name" => $cities[0],
						"pincode" => $cities[1],
						"lupdate" => date('Y-m-d H:i:s'),
						"status" =>'1' ,
						"wallet" => $mywallet,
                                                "chp_id"=>$chp_id
				);
			 //echo "<pre>"; print_r($insert_to_user); exit;
			$this->db->insert("users",$insert_to_user);
			
			////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								$customer_id = "L-USR-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
								////GENERATE CUSTOMER ID
								
								
								
								//SMS
								
								
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



	$mobile = $this->input->post('mobile',TRUE);
	$name = $this->input->post('name',TRUE);

	$message='Dear  '.$name.', You have successfully registered as   User with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	
	$message='Dear  '.$name.', You have successfully registered as   User with LAABUS.COM, download app @ https://goo.gl/tjc8mr';
	
	//Dear  #VAL#, You have successfully registered as   #VAL# with LAABUS.COM, download app @ https://goo.gl/tjc8mr

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
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
								$message='Dear '.$name.' your request has been sent to admin successfully, waiting for admin approval.
visit www.laabus.com for exiting offers.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	//$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
								
								//SMD
	}

	//Creat Agent here
	public function create_agent($chp_id) {
		$password = md5($this->input->post('password'));
			// echo "<pre>"; print_r($_POST);
			
		$this->db->select('*');
		$where1 = "FIND_IN_SET('2', avl_options)"; 
		$this->db->where( $where1 );
		$where2 = "FIND_IN_SET('1', users)"; 
		$this->db->where( $where2 );

		//$this->db->where('promo_code', $this->input->post('promo_code'));
		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->from('joining_offers');
		
		$query = $this->db->get()->row();
		
		
		
		$mywallet = 0;
		$offer_amt = $query->offer_amount;
		$users_lists = $query->users;
		$options = $query->avl_options;
		
		//echo $offer_amt."<br>";
		//echo $users_lists."<br>";
		//echo $options."<br>";
		
		$users_lists = explode(",",$users_lists);
		$options = explode(",",$options);
		
		//print_r($users_lists)."<br>";
		//print_r($options)."<br>";
		
		
		//print_r($query);
		
		if(in_array(1,$users_lists))
		{
			if(in_array(2,$options))
			{
				$mywallet = $offer_amt;
			}
		}
		
		
		//echo "TT".$mywallet;
		//exit;	
		
		//$agent_sub_status_data = $this->db->query("SELECT * from agent_subscription_status order by id desc  ");
		$this->db->select('*');
		$this->db->from('agent_subscription_status');		
		$agent_sub_status_data = $this->db->get()->row();
		//print_r($agent_sub_status_data);exit;
		if( !empty($agent_sub_status_data->status) )
		{
			$subscription = $this->users->getsubscription();
			if(!empty($subscription[0]->subscription_amount))
			{
				$sub_amt = $subscription[0]->subscription_amount;
				$subscription_wallet_amt = $subscription[0]->wallet_amount;
				$subscription_laabus_amt = $subscription[0]->admin_amount;
			}
			else
			{
				$sub_amt = 0;
				$subscription_wallet_amt = 0;
				$subscription_laabus_amt = 0;
			}
			$mywallet =  $mywallet - $sub_amt;
			$subscription_status = 0;
		}
		else
		{
			$sub_amt = 0;
			$subscription_wallet_amt = 0;
			$subscription_laabus_amt = 0;
			$subscription_status = 1;
		}

$cities = explode("<=>",$this->input->post('city'));		
		
			$insert_to_agent = array(
						"email_id" => $this->input->post('email',TRUE),
						"name" => $this->input->post('name',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"org_password"=>$this->input->post('password'),
						"role_id" => $this->input->post('usertype', TRUE),
						"role_based_id" => '',
						"country_name" => $this->input->post('country'),
						"state_name" => $this->input->post('state'),
						"district_name" => $this->input->post('district'),
						"city_name" => $cities[0],
                        "pincode" => $cities[1],
						"lupdate" => date('Y-m-d H:i:s'),
						"status" => 0,
						"subscription_status" =>$subscription_status,
						"agent_id" => '',
						"wallet" => $mywallet,
						"agent_subscription_amt" => $sub_amt,
						"subscription_wallet_amt" => $subscription_wallet_amt,
						"subscription_laabus_amt" => $subscription_laabus_amt,
						"chp_id" => $chp_id,
				);
                                //print_r($insert_to_agent);exit;
								
								

                                $this->db->insert("users",$insert_to_agent);
								
								////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								if($subscription_status == 1 )
								{
									$txnid = 0;
								}
								else
								{
									$txnid = $id;
								}
								
								$customer_id = "L-AGT-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
								////GENERATE CUSTOMER ID
								
								//SMS
								
								
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



	$mobile = $this->input->post('mobile',TRUE);
	$name = $this->input->post('name',TRUE);

	$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
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
								$message='Dear '.$name.' your request has been sent to admin successfully, waiting for admin approval.
visit www.laabus.com for exiting offers.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
	
	
	
	//ONE MORE SMS TO ADMIN FOR AGENT JOINING.*/
								/*$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';*/
								$message='Dear  Admin,  '.$name.' is registered as new agent  with LAABUS.COM, Please review the details for approval.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$mobile = "9989624611";//ADMIN NO.
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
								
								//SMD
			
                               // return true;
							   return $txnid;
	}
        
        public function email_exists($role_id,$email_id) {
		$this->db->select('count(email_id) as cnt');
		$this->db->from('users');
                //$this->db->where('role_id', $role_id);
                $this->db->where('email_id', $email_id);
		$query = $this->db->get()->row();
		// echo "<pre>"; print_r($query); exit;
  		return $query;
	}
	
	public function mobile_exists($role_id,$mobile) {
		$this->db->select('count(mobile) as cnt');
		$this->db->from('users');
                //$this->db->where('role_id', $role_id);
                $this->db->where('mobile', $mobile);
		$query = $this->db->get()->row();
		// echo "<pre>"; print_r($query); exit;
  		return $query;
	}
	
	
        
        public function get_user($email){
                $this->db->select('*');
		$this->db->from('users');
         $this->db->where('email_id', $email);
		 $this->db->or_where('mobile',$email);
                //$this->db->where('status', '1');
		$query = $this->db->get();
  		return $query;
        }
        
        public function checkOldPass($cur_password,$role_id,$email)
        {
            $this->db->where('email_id',$email);
            $this->db->where('role_id', $role_id);
            $this->db->where('password', md5($cur_password));
            $this->db->where('status', '1');
            $query = $this->db->get('users');
            #echo $this->db->last_query();exit;
            if($query->num_rows() > 0)
                return 1;
            else
                return 0;
        }
        
        public function saveNewPass($new_pass,$email,$role_id){
            $array = array(
                'password'=>md5($new_pass),
                'org_password'=>$new_pass,
                'lupdate'=>date('Y-m-d H:i:s')
                );
            $this->db->where('email_id', $email);
            $this->db->where('role_id', $role_id);
            $query = $this->db->update('users',$array);
            if($query){
                return true;
            }else{
                return false;
            }
        }  
        
        public function getorders($user_id){
            $this->db->select('sales_id as oid,transaction_stage_time as created_date,'
                    . 'transaction_finished_time as closed_date,transaction_status_id as status,"Recharge" as service');
		$this->db->from('va_sales_order');
                $this->db->order_by('sales_id','DESC');
                $this->db->where('user_id', $user_id);
                
		$query = $this->db->get()->result();
		// echo "<pre>"; print_r($query); exit;
  		return $query;
        }
        
        public function getuserin_profile($tablename,$user_id) {
            
		$this->db->select('*');
		$this->db->from("".$tablename."");
		$this->db->where('User_id', $user_id);
		$query = $this->db->get();
                #echo $this->db->last_query();exit;
                if($query->num_rows() > 0)
                    return 1;
                else
                    return 0;
	}
        
        public function insert_user_in_profile($tablename,$values){
                $this->db->insert("".$tablename."",$values);
                return true;
        }
        
        public function update_user_in_profile($tablename,$values,$user_id){
            
            $this->db->where('User_id', $user_id);
            $query = $this->db->update("".$tablename."",$values);
            if($query){
                return true;
            }else{
                return false;
            }
        }
        
        public function get_userprofile_info($tablename,$user_id){
			    $this->db->select('*');
		$this->db->from("".$tablename."");
                $this->db->where('User_id', $user_id);
		$query = $this->db->get()->row();
		// echo "<pre>"; print_r($query); exit;
  		return $query;
        }
		
		 public function get_user_info_only($tablename,$user_id){
                $this->db->select('*');
		$this->db->from("".$tablename."");
                $this->db->where('user_id', $user_id);
		$query = $this->db->get()->row();
		// echo "<pre>"; print_r($query); exit;
  		return $query;
        }
        
        public function email_agentuser_exists($email_id,$role_id){
                $this->db->select('count(email_id) as cnt');
		$this->db->from('users');
                $this->db->where('role_id', $role_id);
                $this->db->where('email_id', $email_id);
		$query = $this->db->get()->row();
		// echo "<pre>"; print_r($query); exit;
  		return $query;
        }
        
        
        public function create_agentuser($role_id,$user_id,$chp_id) {
		$password = md5($this->input->post('password'));
		
		
		$this->db->select('*');
		$where1 = "FIND_IN_SET('2', avl_options)"; 
		$this->db->where( $where1 );
		$where2 = "FIND_IN_SET('3', users)"; 
		$this->db->where( $where2 );

		//$this->db->where('promo_code', $this->input->post('promo_code'));
		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->from('joining_offers');
		
		$query = $this->db->get()->row();
		
		$mywallet = 0;
		$offer_amt = $query->offer_amount;
		$users_lists = $query->users;
		$options = $query->avl_options;
		
		//echo $offer_amt."<br>";
		//echo $users_lists."<br>";
		//echo $options."<br>";
		
		$users_lists = explode(",",$users_lists);
		$options = explode(",",$options);
		
		//print_r($users_lists)."<br>";
		//print_r($options)."<br>";
		
		
		//print_r($query);
		
		if(in_array(3,$users_lists))
		{
			if(in_array(2,$options))
			{
				$mywallet = $offer_amt;
			}
		}	
		
		
		$cities = explode("<=>",$this->input->post('city'));
		
		
			// echo "<pre>"; print_r($_POST);
			$insert_to_agent = array(
						"email_id" => $this->input->post('email',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"org_password"=>$this->input->post('password'),
						"role_id" => $role_id,
						"name" => $this->input->post('FirstName').' '.$this->input->post('LastName'),
						"address" => $this->input->post('Address'),
						
						"country_name" => $this->input->post('country'),
						"state_name" => $this->input->post('state'),
						"district_name" => $this->input->post('district'),
						"city_name" => $cities[0],
                        "pincode" => $cities[1],
						
						
						
						"lupdate" => date('Y-m-d H:i:s'),
						"created_at" => date('Y-m-d H:i:s'),
						"status" => 1,
						"wallet" => $mywallet,
						"agent_id" => $user_id,
						"chp_id" => $chp_id,
				);
                                //print_r($insert_to_agent);exit;

                                $this->db->insert("users",$insert_to_agent);
								
								
								////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								$customer_id = "Laa-U-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
								////GENERATE CUSTOMER ID
								
								
								//SMS
								
								
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



	$mobile = $this->input->post('mobile',TRUE);
	$name = $this->input->post('FirstName').' '.$this->input->post('LastName');
	$agtname = $this->session->userdata('name');

	//$message='Dear  '.$name.', You have successfully registered as   User with LAABUS.COM, download app @ https://goo.gl/QWUiJB';
	//$message ='Dear '.$name.',You are registered by '.$agtname.' as an user with LAABUS.COM .now you can login with user ID '.$mobile.' and password '.$this->input->post('password').'  download app@ https://goo.gl/QWUiJB';
	
	$message ='Dear '.$name.',You are registered by '.$agtname.' as an user with LAABUS.COM .now you can login with user ID '.$mobile.' and password '.$this->input->post('password').'  download app@ https://goo.gl/tjc8mr';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
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
								$message='Dear '.$name.' your request has been sent to admin successfully, waiting for admin approval.
visit www.laabus.com for exiting offers.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	//$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
	
	
	//////////////////
	
	
	$mobile =  $this->session->userdata('Mobile');
	$name = $this->session->userdata('name');

	$message='Dear  '.$name.', You have successfully registered as   User with LAABUS.COM, download app @ https://goo.gl/QWUiJB';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
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
								$message='Dear '.$name.' your request has been sent to admin successfully, waiting for admin approval.
visit www.laabus.com for exiting offers.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	//$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
								
								//SMD
								
								
								
                                return true;
	}
        
        public function get_agent_today_earning($user_id)
		{
			$date = date('Y-m-d');
			$result = $this->db->query("SELECT SUM(agent_comm+agent_ref_comm) as earnings FROM `transaction` WHERE   transaction_status = 1 AND (`end_user_id`= $user_id OR `agent_id`= $user_id ) and date(order_date)= '$date' " )->result_array();
            //echo $this->db->last_query();exit;
            return $result;
		}
		public function get_channelpart_today_earning($user_id)
		{
			$date = date('Y-m-d');
			$result = $this->db->query("SELECT SUM(channel_part_comm) as earnings FROM `transaction` WHERE   transaction_status = 1 AND (`channel_part_id`= $user_id ) and date(order_date)= '$date' " )->result_array();
            //echo $this->db->last_query();exit;
            return $result;
		}
		
		 public function get_agent_currentyear_earning($user_id)
		{
			$date = 'Y-m-d';
			$result = $this->db->query("SELECT SUM(agent_comm+agent_ref_comm) as earnings FROM `transaction` WHERE  transaction_status = 1 AND (`end_user_id`= $user_id OR `agent_id`= $user_id ) and date(order_date) BETWEEN '2017-01-01' AND '2017-12-31'  " )->result_array();
            //echo $this->db->last_query();exit;
            return $result;
		}
		
		public function get_channelpart_currentyear_earning($user_id)
		{
			$date = 'Y-m-d';
			$result = $this->db->query("SELECT SUM(channel_part_comm) as earnings FROM `transaction` WHERE  transaction_status = 1 AND ( `channel_part_id`= $user_id ) and date(order_date) BETWEEN '2016-01-01' AND '2016-12-31'  " )->result_array();
            //echo $this->db->last_query();exit;
            return $result;
		}
		
			 public function get_agent_thismonth_earning($user_id)
		{
			$date = 'Y-m-d';
			
			$st_date = date('Y-m-01',strtotime(date('Y-m-d')));
			$end_date =  date('Y-m-t',strtotime(date('Y-m-d')));
  
  
			$result = $this->db->query("SELECT SUM(agent_comm+agent_ref_comm) as earnings FROM `transaction` WHERE transaction_status = 1 and (`end_user_id`= $user_id OR `agent_id`= $user_id)  and date(order_date) BETWEEN '$st_date' AND '$end_date'  " )->result_array();
            //echo $this->db->last_query();exit;
            return $result;
		}
		public function get_channelpart_thismonth_earning($user_id)
		{
			$date = 'Y-m-d';
			
			$st_date = date('Y-m-01',strtotime(date('Y-m-d')));
			$end_date =  date('Y-m-t',strtotime(date('Y-m-d')));
  
  
			$result = $this->db->query("SELECT SUM(channel_part_comm) as earnings FROM `transaction` WHERE transaction_status = 1 and (`channel_part_id`= $user_id)  and date(order_date) BETWEEN '$st_date' AND '$end_date'  " )->result_array();
            //echo $this->db->last_query();exit;
            return $result;
		}
		
		
		public function updateAgentUsers($data)
		{
			//$array_cust["customer_id"] = $customer_id;								
			$this->db->where('user_id', $data["user_id"]);								
			$query = $this->db->update('users',$data);
			return true;
		}
	   public function insertagent_user($agent_user_id, $user_user_id) {
			$insert_agent_role = array(
				"agent_user_id" => $agent_user_id,
				"user_user_id" => $user_user_id,
				"creation_date" => date('Y-m-d H:i:s')
			);
		$this->db->insert('va_agent_user', $insert_agent_role);
	}
        
	#--------------------------------------------------------------------
	# function for get Agent User List based on Agent User Id
	#---------------------------------------------------------------------
        public function get_users_list($user_id=0){
			
            $result = $this->db->query("SELECT `user_id`, `customer_id`, `name`, `mobile`, `email_id`, `pincode`, `role_id`, `password`, `company_name`, `approve_id`, `security_pin`, `dob`, `address`, IF(`status`=1,'Active','Inactive') as status, `alias`, `role_based_id`, `agent_id`, `chp_id`, `smd_id`, `wallet`,DATE_FORMAT( `created_at` , '%d.%m.%Y %H:%i:%s' ) as doj,`lupdate` ,CONCAT(CONCAT('<a href=\http://laabus.com/agent/userview\/',`user_id`,'>View</a>'),'  ',CONCAT('<a href=\http://laabus.com/agent/edituser\/',`user_id`,'>Edit</a>')) as actions, `country_name`, `state_name`, `district_name`, `city_name` FROM `users` WHERE `agent_id`= '$user_id' AND  `role_id`=4 order by user_id desc ")->result_array();
            //echo $this->db->last_query();exit;
            return $result;
        }
		
		 public function get_users_list_chnl($user_id){
            $result = $this->db->query("SELECT `user_id`, `customer_id`, `name`, `mobile`, `email_id`, `pincode`, `role_id`, `password`, `company_name`, `approve_id`, `security_pin`, `dob`, `address`, IF(`status`=1,'Active','Inactive') as status, `alias`, `role_based_id`, `agent_id`, `chp_id`, `smd_id`, `wallet`,DATE_FORMAT( `created_at` , '%d.%m.%Y %H:%i:%s' ) as doj,`lupdate` ,CONCAT(CONCAT('<a href=\http://laabus.com/agent/userview\/',`user_id`,'>View</a>'),'  ',CONCAT('<a href=\http://laabus.com/agent/edituser\/',`user_id`,'>Edit</a>')) as actions, `country_name`, `state_name`, `district_name`, `city_name` FROM `users` WHERE `chp_id`= $user_id AND  `role_id`=6 order by user_id desc ")->result_array();
            //echo $this->db->last_query();exit;
            return $result;
        }
		
		
		 public function get_users_list_part($user_id){
            $result = $this->db->query("SELECT * FROM `partners` WHERE `channel_part_id`= $user_id  ")->result_array();
            //echo $this->db->last_query();exit;
            return $result;
        }
		
		public function get_serviceusers_list_chnl($user_id){
            $result = $this->db->query("SELECT `user_id`, `customer_id`, `name`, `mobile`, `email_id`, `pincode`, `role_id`, `password`, `company_name`, `approve_id`, `security_pin`, `dob`, `address`, IF(`status`=1,'Active','Inactive') as status, `alias`, `role_based_id`, `agent_id`, `chp_id`, `smd_id`, `wallet`,DATE_FORMAT( `created_at` , '%d.%m.%Y %H:%i:%s' ) as doj,`lupdate` ,CONCAT(CONCAT('<a href=\http://laabus.com/agent/userview\/',`user_id`,'>View</a>'),'  ',CONCAT('<a href=\http://laabus.com/agent/edituser\/',`user_id`,'>Edit</a>')) as actions, `country_name`, `state_name`, `district_name`, `city_name` FROM `users` WHERE `chp_id`= $user_id AND  `role_id`=3 order by user_id desc ")->result_array();
            //echo $this->db->last_query();exit;
            return $result;
        }
		
		
		 public function delete_users_list_by_id($user_id){
			  $result = $this->db->query("delete FROM `users` WHERE `user_id`= $user_id");
			  return true;
		 }
		
		 public function get_users_list_by_id($user_id){
            $result = $this->db->query("SELECT `user_id`, `customer_id`, `wallet`, `name`, `mobile`, `email_id`, `pincode`, `role_id`, `password`, `company_name`, `approve_id`, `security_pin`, `dob`, `address`, IF(`status`=1,'Active','Inactive') as status, `alias`, `role_based_id`, `agent_id`, `chp_id`, `smd_id`, `wallet`,DATE_FORMAT( `created_at` , '%d.%m.%Y %H:%i:%s' ) as doj,`lupdate` ,'<a href=\"http://laabus.com/agent/userview\">View</a>   <a href=\"test.php\">Edit</a>  <a href=\"test.php\">Delete</a>' as actions, `country_name`, `state_name`, `district_name`, `city_name` FROM `users` WHERE `user_id`= $user_id")->result_array();
            //echo $this->db->last_query();exit;
            return $result;
        }
		
		
		
		
        
	#--------------------------------------------------------------------
	# function for get Agent User List based on Agent User Id
	#---------------------------------------------------------------------
        public function get_agent_users_list($user_id){
            $result = $this->db->query("SELECT *, IF(`status`=1,'Active','Inactive') as user_status FROM `users` WHERE `agent_id`= $user_id")->result_array();
            //echo $this->db->last_query();exit;
            return $result;
        }
		
	
	
	#--------------------------------------------------------------------
	# function for get Wallet List of Users
	#---------------------------------------------------------------------
	public function get_wallet_list($user_id,$role_id=6){
		/*if($role_id == 4 )
		{
		$result = $this->db->query("SELECT a.*,IF(credit_debit=1,'Credited',IF(credit_debit=2,'Need Approval','Debited')) as cr_dr,(SELECT `name` FROM `users` WHERE `user_id`=a.`user_id`) as name FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
		}
		else
		{
		$result = $this->db->query("select * FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
		}*/
                $query = "SELECT a.*, b.mobile as wt_mobile,b.comments as wt_comments FROM `wallet_history` as a 
left join wallet_transfer as b on a.reference_number = b.wallet_transfer_id
WHERE a.`user_id`=".$user_id;
		$result = $this->db->query($query)->result_array();
		//echo $this->db->last_query();exit;
		return $result;
	}
	
	
	#--------------------------------------------------------------------
	# function for get Wallet List of Users
	#---------------------------------------------------------------------
	public function get_wallet_withdraw_list($user_id){
		//$result = $this->db->query("SELECT a.*,IF(credit_debit=1,'Credited',IF(credit_debit=2,'Need Approval','Debited')) as cr_dr,(SELECT `name` FROM `users` WHERE `user_id`=a.`user_id`) as name FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
		$result = $this->db->query("select * FROM `wallet_withdraw` a WHERE a.`user_id`=".$user_id)->result_array();
		//echo $this->db->last_query();exit;
		return $result;
	}
	
	
	#--------------------------------------------------------------------
	# function for get Wallet List of Users Under Agent
	#---------------------------------------------------------------------
	public function get_wallet_list_agent_users($user_id){
		//$result = $this->db->query("SELECT a.*,IF(credit_debit=1,'Credited',IF(credit_debit=2,'Need Approval','Debited')) as cr_dr,(SELECT `name` FROM `users` WHERE `user_id`=a.`user_id`) as name FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
		$result = $this->db->query("select a.*,b.name as userfullname FROM `wallet_history` a LEFT JOIN  users b on a.user_id = b.user_id WHERE a.`user_id` IN (select user_id from users where `agent_id`= $user_id)")->result_array();
		//echo $this->db->last_query();exit;
		return $result;
	}
	
	public function walletuserview($user_id){
		//$result = $this->db->query("SELECT a.*,IF(credit_debit=1,'Credited',IF(credit_debit=2,'Need Approval','Debited')) as cr_dr,(SELECT `name` FROM `users` WHERE `user_id`=a.`user_id`) as name FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
		$result = $this->db->query("select a.*,b.name as userfullname,b.customer_id as custid FROM `wallet_history` a LEFT JOIN  users b on a.user_id = b.user_id WHERE a.`wallet_history_id`=".$user_id)->result_array();
		//echo $this->db->last_query();exit;
		return $result;
	}
	
	public function wallethistoryview($user_id){
		//$result = $this->db->query("SELECT a.*,IF(credit_debit=1,'Credited',IF(credit_debit=2,'Need Approval','Debited')) as cr_dr,(SELECT `name` FROM `users` WHERE `user_id`=a.`user_id`) as name FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
		$result = $this->db->query("select a.*,b.name as userfullname,b.customer_id as custid FROM `wallet_withdraw` a LEFT JOIN  users b on a.user_id = b.user_id WHERE a.`wallet_withdraw_id`=".$user_id)->result_array();
		//echo $this->db->last_query();exit;
		return $result;
	}
	
	
	
	#--------------------------------------------------------------------
	# function for get Wallet List of Users
	#---------------------------------------------------------------------
	public function get_wallet_list_old($user_id){
		$result = $this->db->query("SELECT a.*,IF(credit_debit=1,'Credited',IF(credit_debit=2,'Need Approval','Debited')) as cr_dr,(SELECT `name` FROM `users` WHERE `user_id`=a.`user_id`) as name FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
		//echo $this->db->last_query();exit;
		return $result;
	}
	#--------------------------------------------------------------------
	# function for get User Wallet Amount Based on User Id And Role Id
	#---------------------------------------------------------------------
        public function get_wallet_amount($user_id=0,$role_id=0){
            $result = $this->db->query("SELECT  `wallet` FROM `users` WHERE `user_id`='$user_id' and `role_id`='$role_id' ")->row_array();
            //echo $this->db->last_query();exit;
            return $result['wallet'];
        }
		
		public function get_wallet_org_amount($user_id,$role_id){
            $result = $this->db->query("SELECT  SUM(`original_amount`) as original_amount  FROM `wallet_history` WHERE `payment_status` = 2 and `user_id`=$user_id and `role_id`=".$role_id.' group by user_id ')->row_array();
            //echo $this->db->last_query();exit;
            return $result['original_amount'];
        }
		
		 public function get_subscription_status($user_id,$role_id){
            $result = $this->db->query("SELECT  `subscription_status` FROM `users` WHERE `user_id`=$user_id and `role_id`=".$role_id)->row_array();
            //echo $this->db->last_query();exit;
            return $result['subscription_status'];
        }
		
		
		
		 public function get_subscription_amount($user_id,$role_id){
            $result = $this->db->query("SELECT  * FROM `users` WHERE `user_id`=$user_id and `role_id`=".$role_id)->row_array();
            //echo $this->db->last_query();exit;
            return $result;
        }
		
		
		
		  public function get_locking_amount(){
            $result = $this->db->query("SELECT  * FROM `locaking_amount` limit 1")->row_array();
            //echo $this->db->last_query();exit;
            return $result;
        }
	#--------------------------------------------------------------------
	# function for get User Wallet Amount Based on User Id And Role Id
	#---------------------------------------------------------------------
        public function get_user_details($user_id,$role_id=NULL){
            $where =($role_id==NULL)?" ":"  and `role_id`=$role_id";
            $result = $this->db->query("SELECT  `user_id`, `name`, `mobile`, `email_id`, `pincode`, `role_id`, `password`, `company_name`, `approve_id`, `security_pin`, `dob`, `address`, `status`, `alias`, `role_based_id`, `agent_id`, `chp_id`, `smd_id`, `wallet`, `lupdate`, `country_name`, `state_name`, `district_name`, `city_name` FROM `users` WHERE `user_id`=$user_id $where")->row_array();
            //echo $this->db->last_query();exit;
            return $result;
        }		
		
public function create_agent_by_chnprtn($chp_id) {
		$password = md5($this->input->post('password'));
			// echo "<pre>"; print_r($_POST);
			
		$this->db->select('*');
		$where1 = "FIND_IN_SET('2', avl_options)"; 
		$this->db->where( $where1 );
		$where2 = "FIND_IN_SET('1', users)"; 
		$this->db->where( $where2 );

		//$this->db->where('promo_code', $this->input->post('promo_code'));
		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->from('joining_offers');
		
		$query = $this->db->get()->row();
		
		
		
		$mywallet = 0;
		$offer_amt = $query->offer_amount;
		$users_lists = $query->users;
		$options = $query->avl_options;
		
		//echo $offer_amt."<br>";
		//echo $users_lists."<br>";
		//echo $options."<br>";
		
		$users_lists = explode(",",$users_lists);
		$options = explode(",",$options);
		
		//print_r($users_lists)."<br>";
		//print_r($options)."<br>";
		
		
		//print_r($query);
		
		if(in_array(1,$users_lists))
		{
			if(in_array(2,$options))
			{
				$mywallet = $offer_amt;
			}
		}
		
		
		//echo "TT".$mywallet;
		//exit;	
		
		//$agent_sub_status_data = $this->db->query("SELECT * from agent_subscription_status order by id desc  ");
		$this->db->select('*');
		$this->db->from('agent_subscription_status');		
		$agent_sub_status_data = $this->db->get()->row();
		//print_r($agent_sub_status_data);exit;
		if( !empty($agent_sub_status_data->status) )
		{
			$subscription = $this->users->getsubscription();
			if(!empty($subscription[0]->subscription_amount))
			{
				$sub_amt = $subscription[0]->subscription_amount;
				$subscription_wallet_amt = $subscription[0]->wallet_amount;
				$subscription_laabus_amt = $subscription[0]->admin_amount;
			}
			else
			{
				$sub_amt = 0;
				$subscription_wallet_amt = 0;
				$subscription_laabus_amt = 0;
			}
			$mywallet =  $mywallet - $sub_amt;
			$subscription_status = 0;
		}
		else
		{
			$sub_amt = 0;
			$subscription_wallet_amt = 0;
			$subscription_laabus_amt = 0;
			$subscription_status = 1;
		}

$cities = explode("<=>",$this->input->post('city'));		
		
			$insert_to_agent = array(
						"email_id" => $this->input->post('email',TRUE),
						"name" => $this->input->post('name',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"org_password"=>$this->input->post('password'),
						"role_id" => 6,
						"role_based_id" => '',						
                        "pincode" => $this->input->post('pincode',TRUE),
						"lupdate" => date('Y-m-d H:i:s'),
						"status" => 0,
						"subscription_status" =>$subscription_status,
						"agent_id" => '',
						"wallet" => $mywallet,
						"agent_subscription_amt" => $sub_amt,
						"subscription_wallet_amt" => $subscription_wallet_amt,
						"subscription_laabus_amt" => $subscription_laabus_amt,
						"chp_id" => $chp_id,
				);
                                //print_r($insert_to_agent);exit;
								
								

                                $this->db->insert("users",$insert_to_agent);
								
								////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								if($subscription_status == 1 )
								{
									$txnid = 0;
								}
								else
								{
									$txnid = $id;
								}
								
								$customer_id = "L-AGT-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
								////GENERATE CUSTOMER ID
								
								//SMS
								
								
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



	$mobile = $this->input->post('mobile',TRUE);
	$name = $this->input->post('name',TRUE);

	$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
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
								$message='Dear '.$name.' your request has been sent to admin successfully, waiting for admin approval.
visit www.laabus.com for exiting offers.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
	
	
	
	//ONE MORE SMS TO ADMIN FOR AGENT JOINING.*/
								/*$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';*/
								$message='Dear  Admin,  '.$name.' is registered as new agent  with LAABUS.COM, Please review the details for approval.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$mobile = "9989624611";//ADMIN NO.
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
								
								//SMD
			
                               // return true;
							   return $txnid;
	
}

public function create_sp_by_chnprtn($chp_id) {
		$password = md5($this->input->post('password'));
			// echo "<pre>"; print_r($_POST);
			
		$this->db->select('*');
		$where1 = "FIND_IN_SET('2', avl_options)"; 
		$this->db->where( $where1 );
		$where2 = "FIND_IN_SET('6', users)"; 
		$this->db->where( $where2 );

		//$this->db->where('promo_code', $this->input->post('promo_code'));
		$where3 = "NOW() BETWEEN st_date AND end_date";  
		$this->db->where( $where3 );
		
		$this->db->from('joining_offers');
		
		$query = $this->db->get()->row();
		
		
		
		$mywallet = 0;
		$offer_amt = $query->offer_amount;
		$users_lists = $query->users;
		$options = $query->avl_options;
		
		//echo $offer_amt."<br>";
		//echo $users_lists."<br>";
		//echo $options."<br>";
		
		$users_lists = explode(",",$users_lists);
		$options = explode(",",$options);
		
		//print_r($users_lists)."<br>";
		//print_r($options)."<br>";
		
		
		//print_r($query);
		
		if(in_array(6,$users_lists))
		{
			if(in_array(2,$options))
			{
				$mywallet = $offer_amt;
			}
		}
		
		
		//echo "TT".$mywallet;
		//exit;	
		
		//$agent_sub_status_data = $this->db->query("SELECT * from agent_subscription_status order by id desc  ");
		$this->db->select('*');
		$this->db->from('agent_subscription_status');		
		$agent_sub_status_data = $this->db->get()->row();
		//print_r($agent_sub_status_data);exit;
		if( !empty($agent_sub_status_data->status) )
		{
			$subscription = $this->users->getsubscription();
			if(!empty($subscription[0]->subscription_amount))
			{
				$sub_amt = $subscription[0]->subscription_amount;
				$subscription_wallet_amt = $subscription[0]->wallet_amount;
				$subscription_laabus_amt = $subscription[0]->admin_amount;
			}
			else
			{
				$sub_amt = 0;
				$subscription_wallet_amt = 0;
				$subscription_laabus_amt = 0;
			}
			$mywallet =  $mywallet - $sub_amt;
			$subscription_status = 0;
		}
		else
		{
			$sub_amt = 0;
			$subscription_wallet_amt = 0;
			$subscription_laabus_amt = 0;
			$subscription_status = 1;
		}

$cities = explode("<=>",$this->input->post('city'));		
		
			$insert_to_agent = array(
						"email_id" => $this->input->post('email',TRUE),
						"name" => $this->input->post('name',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"org_password"=>$this->input->post('password'),
						"role_id" => 3,
						"role_based_id" => '',						
                        "pincode" => $this->input->post('pincode',TRUE),
						"lupdate" => date('Y-m-d H:i:s'),
						"status" => 0,
						"subscription_status" =>$subscription_status,
						"agent_id" => '',
						"wallet" => $mywallet,
						"agent_subscription_amt" => $sub_amt,
						"subscription_wallet_amt" => $subscription_wallet_amt,
						"subscription_laabus_amt" => $subscription_laabus_amt,
						"chp_id" => $chp_id,
				);
                                //print_r($insert_to_agent);exit;
								
								

                                $this->db->insert("users",$insert_to_agent);
								
								////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								if($subscription_status == 1 )
								{
									$txnid = 0;
								}
								else
								{
									$txnid = $id;
								}
								
								$customer_id = "L-AGT-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
								////GENERATE CUSTOMER ID
								
								//SMS
								
								
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



	$mobile = $this->input->post('mobile',TRUE);
	$name = $this->input->post('name',TRUE);

	$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
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
								$message='Dear '.$name.' your request has been sent to admin successfully, waiting for admin approval.
visit www.laabus.com for exiting offers.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
	
	
	
	//ONE MORE SMS TO ADMIN FOR AGENT JOINING.*/
								/*$message='Dear  '.$name.', You have successfully registered as   Agent with LAABUS.COM, download app @ https://goo.gl/QWUiJB';*/
								$message='Dear  Admin,  '.$name.' is registered as new agent  with LAABUS.COM, Please review the details for approval.';

	//$uid=urlencode($uid);
	//$pin=urlencode($pin);
	//$sender=urlencode($sender);
	$mobile = "9989624611";//ADMIN NO.
	$message=urlencode($message);
	//$message = "Dear%20%23VAL%23%2C%20You%20have%20successfully%20%20recharges%20%20INR%20%23VAL%23.%20with%20www.laabus.com%20download%20%20app%20%40%20https%3A%2F%2Fgoo.gl%2FQWUiJB";
	
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&tempid=2&mobile=$mobile&message=$message&pushid=1";

	$url="http://$domain/api/sms.php";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
	
	//var_dump($return_val);exit;
								
								//SMD
			
                               // return true;
							   return $txnid;
	
}

  public function create_partners_by_chnprtn($data) {			
		$this->db->insert('partners', $data);
	}
	
	
	
}
