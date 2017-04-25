<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function send_message($message=""){
	
	$domain="standardservices.biz"; // connecting url 
	$route="0";// 0-Normal,1-Priority
	$method="POST";

	$uid=urlencode("4b756e697365747479");
	$pin=urlencode("51dfa6d9b3c13");
	$mobile=9502901001;
	$message=urlencode($message);
	$sender="";
	$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&mobile=$mobile&message=$message ";
	if($method=="POST")
	{
		$opts = array(
		  'http'=>array(
			'method'=>"$method",
			'content' => "$parameters",
			'header'=>"Accept-language: en\r\n" .
					  "Cookie: foo=bar\r\n" . "Content-type: application/x-www-form-urlencoded\r\n"
		  )
		);

		$context = stream_context_create($opts);

		$fp = fopen("http://$domain/api/sms.php", "r", false, $context);
	}
	else
	{
		$fp = fopen("http://$domain/api/sms.php?$parameters", "r");
	}

	$response = stream_get_contents($fp);
	fpassthru($fp);
	fclose($fp);

	if($response=="")
		echo "Process Failed, Please check your connecting domain, username or password.";
	else{
		$CI=get_instance();
		$CI->load->model('global/Parent_model');
		$CI->Parent_model->store_sms($mobile, urldecode($message), $response);
	}
}
?>