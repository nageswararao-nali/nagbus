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

	public function getstate($country_id) {
		// echo "<pre>"; print_r($country_id);
	 	$this->db->select('*');
	 	$this->db->from('state');
        $this->db->where('Country_id', $country_id);
        $query = $this->db->get();
        return $query->result();
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
	
	
	
	public function getofferswallet() {
		$this->db->select('*');
	 	$this->db->from('joining_wallet_offers');
		$where = "FIND_IN_SET('1', users_type_ids)";  
		$this->db->where( $where ); 
		$this->db->order_by("id", "desc");		
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
		$this->db->select('agent_comm_type,agent_ref_comm_type,agent_comm_value,agent_ref_comm_value,mark_comm_type,mark_comm_value,dis_type,dis_value');
		$this->db->from('va_commissions_all');
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
						"city_name" => $this->input->post('city'),
						"pincode" => $this->input->post('city', TRUE),
						"wallet" => $mywallet,
						"lupdate" => date('Y-m-d H:i:s'),
                                                "status"=>'0'
				);
			
			$this->db->insert("users",$insert_to_login);
			
			////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								$customer_id = "L-AGT-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
								////GENERATE CUSTOMER ID
                        return true;
		
	}

	//Create Normal user here
	public function create_normaluser($chp_id) {
			//Creating channel partner user here
			$password = md5($this->input->post('password'));
			
			
			
		$this->db->select('*');
		$where1 = "FIND_IN_SET('2', avl_options)"; 
		$this->db->where( $where1 );
		$where2 = "NOT FIND_IN_SET('1', users)"; 
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
			$insert_to_user = array(
						"email_id" => $this->input->post('email',TRUE),
						"name" => $this->input->post('name',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"role_id" => $this->input->post('usertype', TRUE),
						"country_name" => $this->input->post('country'),
						"state_name" => $this->input->post('state'),
						"district_name" => $this->input->post('district'),
						"city_name" => $this->input->post('city'),
						"pincode" => $this->input->post('city', TRUE),
						"lupdate" => date('Y-m-d H:i:s'),
						"status" =>'1' ,
						"wallet" => $mywallet,
                                                "chp_id"=>$chp_id
				);
			// echo "<pre>"; print_r($insert_to_login); exit;
			$this->db->insert("users",$insert_to_user);
			
			////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								$customer_id = "L-USR-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
								////GENERATE CUSTOMER ID
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
		
			$insert_to_agent = array(
						"email_id" => $this->input->post('email',TRUE),
						"name" => $this->input->post('name',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"role_id" => $this->input->post('usertype', TRUE),
						"role_based_id" => '',
						"country_name" => $this->input->post('country'),
						"state_name" => $this->input->post('state'),
						"district_name" => $this->input->post('district'),
						"city_name" => $this->input->post('city'),
                                                "pincode" => $this->input->post('city', TRUE),
						"lupdate" => date('Y-m-d H:i:s'),
						"status" => 0,
						"agent_id" => '',
						"wallet" => $mywallet,
						"chp_id" => $chp_id,
				);
                                //print_r($insert_to_agent);exit;
								
								

                                $this->db->insert("users",$insert_to_agent);
								
								////GENERATE CUSTOMER ID
								$id = $this->db->insert_id();
								$customer_id = "L-AGT-".$id;
								$array_cust["customer_id"] = $customer_id;								
								$this->db->where('user_id', $id);								
								$query = $this->db->update('users',$array_cust);
								////GENERATE CUSTOMER ID
			
                                return true;
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
                $this->db->where('status', '1');
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
                'password'=>md5($new_pass)
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
		
		
		
			// echo "<pre>"; print_r($_POST);
			$insert_to_agent = array(
						"email_id" => $this->input->post('email',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"role_id" => $role_id,
						"name" => $this->input->post('FirstName').' '.$this->input->post('LastName'),
						"address" => $this->input->post('Address'),
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
								
								
								
                                return true;
	}
        
        public function get_agent_today_earning($user_id)
		{
			$date = date('Y-m-d');
			$result = $this->db->query("SELECT SUM(agent_comm+agent_ref_comm) as earnings FROM `transaction` WHERE   transaction_status = 1 AND (`end_user_id`= $user_id OR `agent_id`= $user_id ) and date(order_date)= '$date' " )->result_array();
            //echo $this->db->last_query();exit;
            return $result;
		}
		
		 public function get_agent_currentyear_earning($user_id)
		{
			$date = 'Y-m-d';
			$result = $this->db->query("SELECT SUM(agent_comm+agent_ref_comm) as earnings FROM `transaction` WHERE  transaction_status = 1 AND (`end_user_id`= $user_id OR `agent_id`= $user_id ) and date(order_date) BETWEEN '2016-01-01' AND '2016-12-31'  " )->result_array();
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
        public function get_users_list($user_id){
            $result = $this->db->query("SELECT `user_id`, `customer_id`, `name`, `mobile`, `email_id`, `pincode`, `role_id`, `password`, `company_name`, `approve_id`, `security_pin`, `dob`, `address`, IF(`status`=1,'Active','Inactive') as status, `alias`, `role_based_id`, `agent_id`, `chp_id`, `smd_id`, `wallet`,DATE_FORMAT( `created_at` , '%d.%m.%Y %H:%i:%s' ) as doj,`lupdate` ,CONCAT(CONCAT('<a href=\http://laabus.com/agent/userview\/',`user_id`,'>View</a>'),'  ',CONCAT('<a href=\http://laabus.com/agent/edituser\/',`user_id`,'>Edit</a>'),'  ',CONCAT('<a onclick=\"javascript:return confirm(\'Are you sure want to delete this user?\')\" href=\http://laabus.com/agent/deleteuser\/',`user_id`,'>Delete</a>')) as actions, `country_name`, `state_name`, `district_name`, `city_name` FROM `users` WHERE `agent_id`= $user_id AND  `role_id`=4 order by user_id desc ")->result_array();
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
	public function get_wallet_list($user_id){
		//$result = $this->db->query("SELECT a.*,IF(credit_debit=1,'Credited',IF(credit_debit=2,'Need Approval','Debited')) as cr_dr,(SELECT `name` FROM `users` WHERE `user_id`=a.`user_id`) as name FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
		$result = $this->db->query("select * FROM `wallet_history` a WHERE a.`user_id`=".$user_id)->result_array();
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
        public function get_wallet_amount($user_id,$role_id){
            $result = $this->db->query("SELECT  `wallet` FROM `users` WHERE `user_id`=$user_id and `role_id`=".$role_id)->row_array();
            //echo $this->db->last_query();exit;
            return $result['wallet'];
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
}