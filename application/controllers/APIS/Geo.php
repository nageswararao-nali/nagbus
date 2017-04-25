<?php 
class Geo extends CI_Controller{
	
	/* 
	Country, State & City from Google's Geocoding API
	http://www.internoetics.com/2012/02/09/country-state-city-from-googles-geocoding-api/
	*/
	
	public function _remap($address){
		$this->index($address);
	}
	
	public function index($address){
		/* Usage: In my case, I needed to return the State and Country of an address */
		$myLocation = $this->reverse_geocode($address);
		echo json_encode($myLocation);
	}
	
	
	function reverse_geocode($address) {
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
		return $addArr;
	}
		
	function api(){
		
	}
}
?>