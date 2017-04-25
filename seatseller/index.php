<script language="javascript" type="text/javascript">
function getXMLHTTP() 
	{ 
		var xmlhttp=false;	
		try
		{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	
		{		
			try
			{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				try
				{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1)
				{
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	

function getDestination(chosensource)
{

var strURL="seatseller/destinationList.php?sourceList="+chosensource;
var req = getXMLHTTP();

		if(req)
 		{

		req.onreadystatechange = function()
		{
				if (req.readyState == 4) 
				{
					
					if (req.status == 200) 
					{
						document.getElementById('destdiv').innerHTML=req.responseText;
					} else
					{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
		}	
				req.open("GET",strURL,true);
				req.send(null);

		}

}


 
</script>
<?php
	include_once "seatseller/library/OAuthStore.php";
	include_once "seatseller/library/OAuthRequester.php";
	include_once "seatseller/SSAPICaller.php";

	//$sourceList = getSourcesAsDropDownList();
	
	
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

		$selectControlForSources = "<select onChange='getDestination(this.value)' id='sourceList' name='sourceList' class='input'> ";

		//if(is_array($cities))
		//{ 
			//	foreach($cities as $cities)
			//	{
					//$selectControlForSources = $selectControlForSources."<option value=". $cities->id." selected='selected'>"
					//				.$cities->name." </option>";
				//	$citiess[]=$cities->name;
				//}
			//	$selectControlForSources = $selectControlForSources."</select>";
		//}
				
			// $var='"'.implode ('","', $citiess).'"';
		
		
		return $cities ;

}
?>