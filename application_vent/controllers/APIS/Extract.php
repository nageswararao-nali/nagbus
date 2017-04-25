<?php 
class Extract extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('simple_html_dom');
		$this->load->model('APIS/Storage');
		echo "<pre>";
	}
	public function index(){
		die("Invalid Activity.");
	}
	
	function States() {
		
		$url="http://www.mapsofindia.com/pincode/india/";
		$html=file_get_html($url);
		$data=array();
		for($i=0; $i<1; $i++){
			for($j=0; $j<1;$j++){
				$ret = $html->find('//*[@id="content-main"]/div[2]/div[2]/div/div[1]/table/tbody/tr['.$i.']/td['.$j.']/a');
				foreach($ret as $a){
					
					$stateUrl= $a->href;
					$stateName=$a->innertext;
					
					$address = str_replace(" ", "+", "$stateName");
					$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=true";
					$result = file_get_contents("$url");
					$json = json_decode($result);
					foreach ($json->results as $result) {
						foreach($result->address_components as $addressPart) {
							
							if((in_array('political', $addressPart->types)) && (in_array('administrative_area_level_1', $addressPart->types)))
			  					$stateCode = $addressPart->short_name;
							if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
			  					$country_id = $addressPart->short_name;
								
						}
					}
					echo "Country id ".$country_id."<br/>";
					echo "State Name ".$stateName."<br/>";
					echo "State Code ".$stateCode."<br/>";
					echo "<hr/>";
					//$this->Storage->Store_states($country_id, $stateName, $stateUrl, $stateCode);
				}
			}
		}
	}
	
	function District(){
		ini_set('max_execution_time', 2000);
		if($result=$this->Storage->States()){
			for($i=0;$i<count($result);$i++){
				$url=$result[$i]['State_Url'];
				echo "<h3>".$result[$i]['State_Name']."</h3><br/>";
				$html=file_get_html($url);
				$data=array();
				echo "<table border='1px'><tr><th>District Name</th>	<th>Url</th>	<th>State Code</th>	 <th>Country Code</th></tr>";
				for($j=1;$j<=50;$j++){
					$ret = $html->find('//*[@id="content-main"]/div[2]/div[2]/div/div[2]/table/tbody/tr['.$j.']/td[1]/a');
					echo "<tr>";
					foreach($ret as $a){
						$districtName=$a->innertext;
						$stateCode=$result[$i]['State_Code'];
						$district_url = $a->href;
						$countryCode=$result[$i]['Country_id'];
						echo "<td>".$districtName."</td>";
						echo "<td>".$district_url."</td>";
						echo "<td>".$stateCode."</td>";
						echo "<td>".$countryCode."</td>";
						//Store to db
						$this->Storage->Store_Districts($districtName, $stateCode, $countryCode, $district_url);
					}
					echo "</tr>";

				}
				echo "</table>";
			}
		}
	}
	
	function Pincode(){
		ini_set('max_execution_time', 2000000);
		if($result=$this->Storage->districts()){
		//	print_r($result);
			for($i=0;$i<count($result);$i++){
				$url=$result[$i]['District_Url'];
				echo "<h3>$i ".$result[$i]['District_Name']."</h3><br/>";
				$html=file_get_html($url);
				$data=array();				
				echo "<table border='1px'><tr><th>Location Name</th>	<th>Pincode</th> <th>District Name</th>	<th>State Name</th>	 <th>Country Code</th></tr>";
				$ret11 = $html->find('//*[@id="content-main"]/div[2]/div[2]/div/div[1]/table/tbody/tr');
				$l= count($ret11);
				for($j=2;$j<=$l;$j++){
					//To get Location
						$ret = $html->find('//*[@id="content-main"]/div[2]/div[2]/div/div[1]/table/tbody/tr['.$j.']/td[1]/a');
						foreach($ret as $a){
							$location=$a->innertext;
							break;
						}
					//To get Pincode
						$res = $html->find('//*[@id="content-main"]/div[2]/div[2]/div/div[1]/table/tbody/tr['.$j.']/td[2]');
						foreach($res as $a){
							$pincode=$a->innertext;
							break;
						}
						echo "<tr>";
							$districtName = $result[$i]['District_Name'];
							$stateName=$result[$i]['State_Code'];
							$countryCode=$result[$i]['Country_Code'];
							echo "<td>".$location."</td>";
							echo "<td>".$pincode."</td>";
							echo "<td>".$districtName."</td>";
							echo "<td>".$stateName."</td>";
							echo "<td>".$countryCode."</td>";
							//Store to db
							$this->Storage->Store_Pincode($location, $pincode, $districtName, $stateName, $countryCode);
						echo "</tr>";
					}
				echo "</table>";
			}
		}
		
	}
	
	function url_update(){
		$this->Storage->url_update();
	}
}
?>