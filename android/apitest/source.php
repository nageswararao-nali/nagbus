<?php
	include_once "library/OAuthStore.php";
	include_once "library/OAuthRequester.php";
	include_once "SSAPICaller.php";

	$sourceList = getSourcesAsDropDownList();
	echo $sourceList;



function getSourcesAsDropDownList()
{	
	global $scr,$sourceId , $sourcename;

	$scr = getAllSources();
	$json_o=json_decode($scr);
	$cities = $json_o->cities;

		function my_sort($a,$b)
		{

			if (strcasecmp($a->name , $b->name)<0)
			{ return 1;
			}
			elseif (strcasecmp($a->name, $b->name)>0)
			{
				return -1;
			}
			else 
			{
				return 0;
			}
		}

		usort($cities, 'my_sort');
		
		echo json_encode(array('myCities' => $cities));
		

	
		//return $selectControlForSources ;
}
?>
