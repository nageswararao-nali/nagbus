<html>
<head>
<script>
    var hash = '1ed7d8c492c9e5df8773fc6f8571d8e47bc122ce5393a5120fedb21d5acf73fbe3abb94e37110f6ab652be98c2e360bf161559e28697ffef794501ba2dd75a91';
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
<center><img src="http://laabus.com/web_assets/images/ajax-loader.gif" alt="Connecting..." align="absmiddle"/></center>
<form action="https://secure.payu.in/_payment" method="post" name="payuForm">
  <input type="hidden" name="key" value="2CyuEI" />
  <input type="hidden" name="hash" value="1ed7d8c492c9e5df8773fc6f8571d8e47bc122ce5393a5120fedb21d5acf73fbe3abb94e37110f6ab652be98c2e360bf161559e28697ffef794501ba2dd75a91"/>
  <input type="hidden" name="txnid" value="1487" />
  <table  style="display:none">
    <tr>
      <td><b>Mandatory Parameters</b></td>
    </tr>
    <tr>
      <td>Amount: </td>
      <td><input type="hidden" name="amount" value="10" /></td>
      <td>First Name: </td>
      <td><input type="hidden" name="firstname" id="firstname" value="hanshad" /></td>
    </tr>
    <tr>
      <td>Email: </td>
      <td><input type="hidden" name="email" id="email" value="" /></td>
      <td>Phone: </td>
      <td><input type="hidden" name="phone" value="9989624611" /></td>
    </tr>
    <tr>
      <td>Product Info: </td>
      <td colspan="3"><textarea name="productinfo" style="display:none">Recharge for Mobile Number 9494011384 the operator name isBSNL TopUp with amount 10</textarea></td>
    </tr>
    <tr>
      <td>Success URI: </td>
      <td colspan="3"><input type="hidden" name="surl" value="http://laabus.com/Payment/payment_success" size="64" /></td>
    </tr>
    <tr>
      <td>Failure URI: </td>
      <td colspan="3"><input type="hidden" name="furl" value="http://laabus.com/Payment/payment_failure" size="64" /></td>
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