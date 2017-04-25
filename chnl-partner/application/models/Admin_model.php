<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Admin model admin login validating in this model
*/
class Admin_Model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function login_validate($user, $pass) {
        // Prep the query
        $this->db->where('admin_name', $user);
        $this->db->where('admin_password', md5($pass));
        
        // Run the query
        $query = $this->db->get('admin');
        // Let's check if there are any results
        if($query->num_rows == 1) {
            // If there is a user, then create session data
            $row = $query->row();
            echo "<pre>"; print_r($row); exit;
            $data = array(
                    'a_id' => $row->a_id,
                    'admin_name' => $row->admin_name,
                    'admin_password' => $row->admin_password,
                    'login_status' => $row->login_status
                    );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
	}

}