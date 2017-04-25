<?php
	include_once "library/OAuthStore.php";
	include_once "library/OAuthRequester.php";
	include_once "SSAPICaller.php";


	$storesource = $_GET['sourceList'];


	echo $scr = getAllDestinations($storesource);
	
	
?>
