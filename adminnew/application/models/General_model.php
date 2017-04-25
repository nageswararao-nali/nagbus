<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_countries() {
        $query = $this->db->query("select Country_Name, Country_Code, status_id from country where status_id = '1'");
        $result = $query->result_array();
        $countries = array();
        foreach ($result as $key => $val) {
            $countries [$val['Country_Code']] = $val['Country_Name'];
        }
        return array("" => "Select Country") + $countries;
    }

    function get_states($country_code) {
        $query = $this->db->query("select State_Name, State_Code from state where Country_id = '$country_code' and status_id = 1");
        $result = $query->result_array();
        $states = array();
        foreach ($result as $key => $val) {
            $states [$val['State_Code']] = $val['State_Name'];
        }
        return array("" => "Select State") + $states;
    }

    function get_districts($country_code, $states_code) {
        $query = $this->db->query("SELECT District_Name FROM `district` where State_Code = '$states_code' and Country_Code = '$country_code'");
        $result = $query->result_array();
        $district = array();
        foreach ($result as $key => $val) {
            $district [$val['District_Name']] = $val['District_Name'];
        }
        return array("" => "Select District") + $district;
    }

    function get_cities($country_code = 'IN', $states_code, $district_code) {
        $query = $this->db->query("SELECT Location, Pincode FROM `pincode` where District_Name = '$district_code' and State_Code = '$states_code' and Country_code='$country_code'");
        //echo $this->db->last_query();exit;
        $result = $query->result_array();
        $cities = array();
        foreach ($result as $key => $val) {
            $cities [$val['Location'] . '<=>' . $val['Pincode']] = $val['Location'] . '(' . $val['Pincode'] . ')';
        }
        return array("" => "Select City") + $cities;
    }

}
