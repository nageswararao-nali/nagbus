<?php
/**
* Users model here for getting roles and data
*/
class Users_ticket extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
    
    
    public function get_ticketDetials($user_id) {
    
        $this->db->select('*');
		$this->db->from('bus_bookings');
		$this->db->where('user_id', $user_id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
       
		return $query->result();
	}
    
    public function get_passengerList($bookingkey) {
    
        $this->db->select('*');
		$this->db->from('bus_passengers');
        $this->db->where('bookingKey', $bookingkey);
		$query = $this->db->get();
       
		return $query->result();
	}
    
}

?>