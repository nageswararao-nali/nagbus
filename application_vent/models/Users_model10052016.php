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
		
			//Creating channel partner user here
			$password = md5($this->input->post('password'));
			// echo "<pre>"; print_r($_POST);
			$insert_to_login = array(
						"email_id" => $this->input->post('email',TRUE),
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
                                                "status"=>'0'
				);
			
			$this->db->insert("users",$insert_to_login);
                        return true;
		
	}

	//Create Normal user here
	public function create_normaluser($chp_id) {
			//Creating channel partner user here
			$password = md5($this->input->post('password'));
			// echo "<pre>"; print_r($_POST);
			$insert_to_user = array(
						"email_id" => $this->input->post('email',TRUE),
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
                                                "chp_id"=>$chp_id
				);
			// echo "<pre>"; print_r($insert_to_login); exit;
			$this->db->insert("users",$insert_to_user);
	}

	//Creat Agent here
	public function create_agent($chp_id) {
		$password = md5($this->input->post('password'));
			// echo "<pre>"; print_r($_POST);
			$insert_to_agent = array(
						"email_id" => $this->input->post('email',TRUE),
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
						"chp_id" => $chp_id,
				);
                                //print_r($insert_to_agent);exit;

                                $this->db->insert("users",$insert_to_agent);
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
			// echo "<pre>"; print_r($_POST);
			$insert_to_agent = array(
						"email_id" => $this->input->post('email',TRUE),
						"mobile"	=>	$this->input->post('mobile',TRUE),
						"password"	=>	$password,
						"role_id" => $role_id,
						"name" => $this->input->post('FirstName').''.$this->input->post('LastName'),
						"address" => $this->input->post('Address'),
						"lupdate" => date('Y-m-d H:i:s'),
						"status" => 1,
						"agent_id" => $user_id,
						"chp_id" => $chp_id,
				);
                                //print_r($insert_to_agent);exit;

                                $this->db->insert("users",$insert_to_agent);
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
            $result = $this->db->query("SELECT `user_id`, `name`, `mobile`, `email_id`, `pincode`, `role_id`, `password`, `company_name`, `approve_id`, `security_pin`, `dob`, `address`, IF(`status`=1,'Active','Inactive') as status, `alias`, `role_based_id`, `agent_id`, `chp_id`, `smd_id`, `wallet`, `lupdate`, `country_name`, `state_name`, `district_name`, `city_name` FROM `users` WHERE `agent_id`= $user_id AND  `role_id`=4")->result_array();
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