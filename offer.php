<?php
/*https://joloapi.com/api/findplan.php?userid=yourusername&key=yourapikey
&opt=operatorcode&cir=circlecode&typ=categorycode&amt=amount&max=10
&type=json*/
$url = "https://joloapi.com/api/findplan.php?userid=piridi&key=178153319187538&opt=28&cir=5&typ=&amt=&max=&type=json";
 $ch = curl_init();  
 

 
    
	curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
    $output=curl_exec($ch);
	
	 if($output === false)
    {
        echo "Error Number:".curl_errno($ch)."<br>";
        echo "Error String:".curl_error($ch);
		exit;
    }
 
    curl_close($ch);
    //return $output;
	//header("Content-type: text/xml");
	//print("<pre>");
	
	//echo $output;//exit;
	$data = json_decode($output);
	
	print("<pre>");
	print_r($data);exit;
?>