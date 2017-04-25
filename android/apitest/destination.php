<?php
	include_once "library/OAuthStore.php";
	include_once "library/OAuthRequester.php";
	include_once "SSAPICaller.php";

	
	if(isset($_GET['sourceList'])){
	$storesource = $_GET['sourceList'];

	$scr = getAllDestinations($storesource);
	$json_o=json_decode($scr);

	$destcities=$json_o->cities;

	//var_dump($destcities);

	

	function my_sort($a,$b)
		{


			if (strcasecmp($a->name , $b->name)<0)
			{ return -1;
			}
			elseif (strcasecmp($a->name, $b->name)>0){
				return 1;

			}
			else {
				return 0;
			}
		}


		usort($destcities, 'my_sort');

		echo json_encode(array('myDestination' => $destcities));
		
	}else{
		echo "<h1>Access Forbidden for this page</h1>";		
	}

?>
