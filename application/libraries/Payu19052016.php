<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Payu {
	
	// Merchant key here as provided by Payu
	private $MERCHANT_KEY = "ah6Qbj";
	
	// Merchant Salt as provided by Payu
	private $SALT = "9BvG4I1m"; 
	
	
	private $PAYU_BASE_URL = '';
	
	function setServerMode($servermode = 'live'){
		// End point - change to https://secure.payu.in for LIVE mode
		$this->PAYU_BASE_URL = $servermode == 'test' ?  'https://test.payu.in/_payment' : 'https://secure.payu.in/_payment';
	}
	
	private $action = '';
	private $posted = array();
	
	private $txnid;
	
	private $hash = '';
	
	private $amount = '';

	private $phonenumber = '';
	
	private $productInfo = '';
	
	private $email = '';
	
	private $success_url = '';
	
	private $failure_url = '';

	private $consumername = '';
	
	private $hash_string = '';
	
	// Hash Sequence
	private $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4";
	
	function __construct()
    {
		 $CI =& get_instance();
	}
	
	function generate_auto_transaction_id(){
		if(empty($posted['txnid'])) {
		  // Generate random transaction id
		  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		} else {
		  $txnid = $posted['txnid'];
		}
	}
	
	function generateHashString(){
		$this->hash_string = $this->MERCHANT_KEY.'|'.$this->txnid.'|'.$this->amount.'|'.$this->productInfo.'|'.$this->consumername.'|'.$this->email.'|||||||||||';
		//Add aditional parameters if you need
		return $this->hash_string .= $this->SALT;
	}
	
	function generateHash(){
		$this->hash = strtolower(hash('sha512', $this->generateHashString()));
	}
	
	function goto_collect_money(){
		
		$this->showForm();
		$this->action = $this->PAYU_BASE_URL;
	}
	
	function setTransactionid($invoiceid){
		$this->txnid = $invoiceid;
	}
	
	function setAmount($amount){
		$this->amount = $amount;
	}
	
	function setEmail($email){
		$this->email = $email;
	}
	function setConsumerName($name){
		$this->consumername = $name;
	}
	function setProductInfo($proInfo){
		$this->productInfo = $proInfo;
	}
	
	function setPhoneNumber($phone){
		$this->phonenumber = $phone;
	}
	function setSuccess_url($surl){
		$this->success_url=$surl;
	}
	function setFailure_url($furl){
		$this->failure_url = $furl;
	}
	
	function showForm(){
$this->image_url = base_url().'web_assets/images/ajax-loader.gif';
		echo $html = <<<HTML

<html>
<head>
<script>
    var hash = '$this->hash';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
</head>
<body onLoad="submitPayuForm()">
<h2 style="text-align:center">Please wait connecting to payment gateway</h2>
<center><img src="$this->image_url" alt="Connecting..." align="absmiddle"/></center>
<form action="$this->PAYU_BASE_URL" method="post" name="payuForm">
  <input type="hidden" name="key" value="$this->MERCHANT_KEY" />
  <input type="hidden" name="hash" value="$this->hash"/>
  <input type="hidden" name="txnid" value="$this->txnid" />
  <table  style="display:none">
    <tr>
      <td><b>Mandatory Parameters</b></td>
    </tr>
    <tr>
      <td>Amount: </td>
      <td><input type="hidden" name="amount" value="$this->amount" /></td>
      <td>First Name: </td>
      <td><input type="hidden" name="firstname" id="firstname" value="$this->consumername" /></td>
    </tr>
    <tr>
      <td>Email: </td>
      <td><input type="hidden" name="email" id="email" value="$this->email" /></td>
      <td>Phone: </td>
      <td><input type="hidden" name="phone" value="$this->phonenumber" /></td>
    </tr>
    <tr>
      <td>Product Info: </td>
      <td colspan="3"><textarea name="productinfo" style="display:none">$this->productInfo</textarea></td>
    </tr>
    <tr>
      <td>Success URI: </td>
      <td colspan="3"><input type="hidden" name="surl" value="$this->success_url" size="64" /></td>
    </tr>
    <tr>
      <td>Failure URI: </td>
      <td colspan="3"><input type="hidden" name="furl" value="$this->failure_url" size="64" /></td>
    </tr>
    <tr>
      <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
    </tr>
    <tr>
      <td colspan="4"><input type="submit" value="Submit" style="display:none"/></td>
    </tr>
  </table>
</form>
</body>
</html>

HTML;
	}
}