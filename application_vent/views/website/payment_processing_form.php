<html>
<head>
<script>
    var hash = '';
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
<h2>PayU Form</h2>
<br/>
<form action="" method="post" name="payuForm">
  <input type="hidden" name="key" value="ah6Qbj" />
  <input type="hidden" name="hash" value=""/>
  <input type="hidden" name="txnid" value="5fccaeab6ef5f24259d4" />
  <table>
    <tr>
      <td><b>Mandatory Parameters</b></td>
    </tr>
    <tr>
      <td>Amount: </td>
      <td><input name="amount" value="" /></td>
      <td>First Name: </td>
      <td><input name="firstname" id="firstname" value="" /></td>
    </tr>
    <tr>
      <td>Email: </td>
      <td><input name="email" id="email" value="" /></td>
      <td>Phone: </td>
      <td><input name="phone" value="" /></td>
    </tr>
    <tr>
      <td>Product Info: </td>
      <td colspan="3"><textarea name="productinfo"></textarea></td>
    </tr>
    <tr>
      <td>Success URI: </td>
      <td colspan="3"><input name="surl" value="" size="64" /></td>
    </tr>
    <tr>
      <td>Failure URI: </td>
      <td colspan="3"><input name="furl" value="" size="64" /></td>
    </tr>
    <tr>
      <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
    </tr>
    <tr>
      <td colspan="4"><input type="submit" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>
