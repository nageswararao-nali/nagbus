<?php 
if($_POST['f_code']=="Ok"){
	header("location:http://laabus.com/nag/laabus/Payment/payment_success");
	} else { 
	header("location:http://laabus.com/nag/laabus/Payment/payment_failure");
	} ?>