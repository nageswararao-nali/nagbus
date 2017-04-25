<?php if($_POST['f_code']=="Ok"){
	header("location:http://laabus.com/Payment/fundpayment_success");
	} else { 
	header("location:http://laabus.com/Payment/fundpayment_failure");
	} ?>