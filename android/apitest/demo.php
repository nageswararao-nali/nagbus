<?php
	include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";

$json_arr = '{"data" :{
	"availableTripId":"1000197122460005487",
	"boardingPointId":"1483903",
	"destination":"21",
	"srcid" : "6",
	"inventoryItems":
		[{"fare":"610.00",
			"ladiesSeat":"false",
			"seatName":"R15",
			"passenger":
				{"age":"52","name":"gg",
				"gender":"MALE"}},
		{"fare":"610.00",
		"ladiesSeat":"false",
		"seatName":"R16",
		"passenger":
				{"age":"55","name":"ghuuioo",
				"gender":"MALE"}}]
}}';

			$data = json_decode($json_arr, true);
			
			foreach($data['data']['inventoryItems'] as $item) {
				$seats []= $item['seatName'];
				$name [] = $item['passenger']['name'];
				$age  [] = $item['passenger']['age'];
				$gender  [] = $item['passenger']['gender'];			
			}
		
			
			$count = count($data['data']['inventoryItems']);
			$per_head = $data['data']['inventoryItems'][0]['fare'];
			
			$email			= 'gangadhar@gmail.com';
			$mobile			= '9999999999';
			$emergency_no	= '8888888888';	
			
			
			
			$jsone= array();

            $jsone['availableTripId']=$data['data']['availableTripId'];
            $jsone['boardingPointId']=$data['data']['boardingPointId'];
            $jsone['destination']= $data['data']['destination'];

            $jsone['inventoryItems']=array();
			      
			  for($i=0; $i<$count; $i++){

                $gender = "gender".$i;           
                $gndr = $gender[0] == 'F' ? 'female' : 'male';

                $jsone['inventoryItems'][$i]['seatName'] = $seats[$i];
                $jsone['inventoryItems'][$i]['ladiesSeat'] = "false";
                $jsone['inventoryItems'][$i]['passenger'] = array();
                $jsone['inventoryItems'][$i]['passenger']['age'] = $age[$i];
                $jsone['inventoryItems'][$i]['passenger']['primary'] = $i == 0 ? "true" : "false";
                $jsone['inventoryItems'][$i]['passenger']['name'] = $name[$i];
                $jsone['inventoryItems'][$i]['passenger']['title'] = "Laabus Ticket Booking";
                $jsone['inventoryItems'][$i]['passenger']['gender'] = $gndr; 
                if($i == 0):
                $jsone['inventoryItems'][$i]['passenger']['idType'] = "Pan Card"; 
                $jsone['inventoryItems'][$i]['passenger']['email'] = $email; 
                $jsone['inventoryItems'][$i]['passenger']['idNumber'] = "123456"; 
                $jsone['inventoryItems'][$i]['passenger']['address'] = "Sample Address"; 
                $jsone['inventoryItems'][$i]['passenger']['mobile'] = $mobile;
                endif;
                $jsone['inventoryItems'][$i]['fare'] = $per_head;

            }          


            $jsone['source']= $data['data']['srcid'];
            $jsonVar = json_encode($jsone);
           
			// print_r($jsonVar);
            // exit;
            //echo "<br><br>----------------<br><br>";
            $block_key= blockTicket($jsonVar);
			
			echo json_encode(array("block_key"=>$block_key));
			
?>