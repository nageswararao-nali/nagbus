<?php
    include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";

// Getting the chosen bus id.
    
	 $chosenbusid=$_GET['chosenone']; 
     $sourceid=$_GET['sourceList'];
     $destinationid=$_GET['destinationList'];
     $date=$_GET['datepicker'];


 $result1 =getAvailableTrips($sourceid,$destinationid,$date); 
 $tripdetails = getTripDetails($chosenbusid);     
 $tripdetails2 = json_decode($tripdetails);
	
	echo json_encode(array('seatsinBus' => $tripdetails2));	
	?>