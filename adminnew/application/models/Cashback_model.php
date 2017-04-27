<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * operators model admin login validating in this model
 */
class cashback_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function save($data) {
        $this->db->insert('va_cashback_offers', $data);  
        return $this->db->insert_id();
    }
    public function get_cashback_offers() {
        $query = $this->db->get('va_cashback_offers', 0, 10);
        return $query->result_array();
    }
    public function get_cashback_offer($cbk_id) {
        $query = $this->db->get_where('va_cashback_offers', array("cbk_id" => $cbk_id));
        return $query->result_array();
    }
    public function update($data) {
        $this->db->where('cbk_id', $data['cbk_id']);
        $query = $this->db->update('va_cashback_offers', $data);
        //$query->result_array();
        return $data['cbk_id'];
    }
    public function get_cashback_usage_offers() {
        $query = $this->db->get('va_cashback_usage', 0, 10);
        return $query->result_array();
    }
    public function activateCashbackOfer($data) {
        $this->db->where('cbk_id', $data['cbk_id']);
        $cbk_status = trim($data['cbk_isActive']) === 'Active' ? 1 : 0;
        $updData = array("cbk_status" => $cbk_status);
        $query = $this->db->update('va_cashback_offers', $updData);
        return $cbk_status ? 'InActive' : 'Active';
    }
    public function get_cashback_offer_usage($cbk_usg_id) {
        $query = $this->db->get_where('va_cashback_usage', array("cbk_usg_id" => $cbk_usg_id));
        return $query->result_array();
    }
    public function save_usage($data) {
        $this->db->insert('va_cashback_usage', $data);  
        return $this->db->insert_id();
    }
    public function update_usage($data) {
        $this->db->where('cbk_usg_id', $data['cbk_usg_id']);
        $query = $this->db->update('va_cashback_usage', $data);
        //$query->result_array();
        return $data['cbk_usg_id'];
    }
}
