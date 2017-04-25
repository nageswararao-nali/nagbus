<?php 
class Location extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('options/SelectBox_model');
	}
	
	public function index($address){
		$address = str_replace(" ", "+", "$address");
		$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=true";
		$result = file_get_contents("$url");
		$json = json_decode($result);
		$city=$district=$state=$country=$pincode=null;
		foreach ($json->results as $result) {
			foreach($result->address_components as $addressPart) {
			  if((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types)))
			  	$city = array('long_name'=>$addressPart->long_name, 'short_name'=>$addressPart->short_name);
			  else if((in_array('administrative_area_level_2',$addressPart->types)) && (in_array('political', $addressPart->types)))
			  	$district = array('long_name'=>$addressPart->long_name, 'short_name'=>$addressPart->short_name);
			  else if((in_array('administrative_area_level_1', $addressPart->types)) && (in_array('political', $addressPart->types)))
			  	$state = array('long_name'=>$addressPart->long_name, 'short_name'=>$addressPart->short_name);
			  else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
			  	$country = array('long_name'=>$addressPart->long_name, 'short_name'=>$addressPart->short_name);
			  else if((in_array('postal_code', $addressPart->types))){
				$pincode=$addressPart->long_name;
			  }
			}
		}
		$addArr=array('city'=>$city,'district'=>$district,'state'=>$state,'country'=>$country,'pincode'=>$pincode);
		echo json_encode($addArr);
	}
	
	function states($country_id){
		if($result=$this->SelectBox_model->get_states($country_id)){
			$msg=array("err_code"=>0, "message"=>$result, "status"=>"SUCCESS");
			echo json_encode($msg);
		}
		else {
			$msg=array("err_code"=>1, "message"=>"No States", "status"=>"FAIL");
			echo json_encode($msg);
		}
	}
	
	function districts($country_id, $stateid){
		if($result=$this->SelectBox_model->get_districts($stateid, $country_id)){
			$msg=array("err_code"=>0, "message"=>$result, "status"=>"SUCCESS");
			echo json_encode($msg);
		}
		else {
			$msg=array("err_code"=>1, "message"=>"No Districts", "status"=>"FAIL");
			echo json_encode($msg);
		}
	}
	
	function locations($country_id, $stateid, $districtid){
		$districtid=utf8_decode(urldecode($districtid));
		if($result=$this->SelectBox_model->get_locations($country_id, $stateid, $districtid)){
			$msg=array("err_code"=>0, "message"=>$result, "status"=>"SUCCESS");
			echo json_encode($msg);
		}
		else {
			$msg=array("err_code"=>1, "message"=>"No Locations", "status"=>"FAIL");
			echo json_encode($msg);
		}
	}
	
	function pincode($country_id, $stateid, $districtid, $location_id){
		$districtid=utf8_decode(urldecode($districtid));
		$location_id=utf8_decode(urldecode($location_id));
		if($result=$this->SelectBox_model->get_pincode($country_id, $stateid, $districtid, $location_id)){
			$msg=array("err_code"=>0, "message"=>$result, "status"=>"SUCCESS");
			echo json_encode($msg);
		}
		else {
			$msg=array("err_code"=>1, "message"=>"No Pincode", "status"=>"FAIL");
			echo json_encode($msg);
		}
	}
}
?>