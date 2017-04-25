<?php
    include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";


    $sourceid		=	$_GET['sourceList'];
    $destinationid 	= 	$_GET['destinationList'];
	$date			=	$_GET['datepicker'];
	$chosenbusid	=	$_GET['chosenone'];
	
	
   
	$result1 =getAvailableTrips($sourceid,$destinationid,$date); 
	$result2=json_decode($result1);
	
	$bcount = count($result2->availableTrips);
	
	for($x=0;$x<$bcount;$x++){
	
	if($result2->availableTrips[$x]->id == $chosenbusid){
		$bpints = $result2->availableTrips[$x]->boardingTimes;
	}	
	
	}
	
	echo "<pre>";
	print_r(json_encode(array('mybpoints' => $bpints)));
	echo "</pre>";

    ?>

