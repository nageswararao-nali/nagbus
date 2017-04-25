<?php 
function make_json($result){
	$arr = $result!=FALSE ? array('err_code'=>1, "message"=>$result, 'status'=>'SUCCESS') : array('err_code'=>0, "message"=>"", 'status'=>'FAIL');
	echo json_encode($arr);
}