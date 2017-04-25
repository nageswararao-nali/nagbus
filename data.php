<?php

			
			$txnid = uniqid();
			$amount=100;
			$apisecret = "kQeDheLqeeQXU6cAGhbdbyfyFVMpVCs4MF2ZaXqdTFmpdgDH";
			$api_user_id= "YGRZ2egUHLBk5FfNTBvPDPU3K5Lcfk27fGYv2FGebGw6c64Y";
			$concat = $txnid."|".$apisecret;
			$hash = hash("sha512",$concat);


$url ="https://api.komparify.com/api/v2/topuptype/recharge+voucher.json?region_id=1&unique_provider_id=1&type=prepaid&api_user_id=".$api_user_id;
$url .="&txnid=".$txnid."&securehash==".$hash."&amount=100";
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
	
	var_dump($data);exit;