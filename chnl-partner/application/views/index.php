<div class="row">
<div class="col-md-12">
<h4 class="text-center">Welcome to laabus Admin </h4>
</div>

<div>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h2>Wallet</h2></td>
  </tr>
  <tr>
    <td width="33%" height="30" align="center" valign="middle"><strong>Total Amount</strong></td>
    <td width="33%" height="30" align="center" valign="middle"><strong>Current Month</strong></td>
    <td width="33%" height="30" align="center" valign="middle"><strong>Today </strong></td>
  </tr>
  <tr>
    <td width="33%" height="80" align="center" valign="middle" bgcolor="#Cfecfcf"><h4><?php echo @$tot_wallet[0]['totwallet'];?>/- Rs</h4></td>
    <td width="33%" height="80" align="center" valign="middle" bgcolor="#Cfecfcf"><h4><?php  if(!empty($tot_wallet[0]['month_wallet'])) echo $tot_wallet[0]['month_wallet'] ; else echo "0.00";?>/- Rs</h4></td>
    <td width="33%" height="80" align="center" valign="middle" bgcolor="#Cfecfcf"><h4><?php  if(!empty($tot_wallet[0]['today_wallet'])) echo $tot_wallet[0]['today_wallet'] ; else echo "0.00";?>/- Rs</h4></td>
  </tr>
  
  
   <tr>
    <td height="40" align="center" valign="middle" bgcolor="#FFFFFF"><h4>Today Deposits By Users</h4></td>
    <td height="0" align="center" valign="middle" bgcolor="#FFFFFF"><h4>Today Deposits By Agents</h4></td>
    <td height="0" align="center" valign="middle" bgcolor="#FFFFFF"><h4>View Details</h4></td>
  </tr>
  <tr>
    <td width="33%" height="40" align="center" valign="middle" bgcolor="#CFECFC"><h4><?php echo @$tot_wallet[0]['totwallet'];?></h4></td>
    <td width="33%" height="0" align="center" valign="middle" bgcolor="#CFECFC"><h4><?php echo @$agent_wallet[0]['totwallet'];?></h4></td>
    <td width="33%" height="0" align="center" valign="middle" bgcolor="#CFECFC"><h4><a href="http://laabus.com/adminnew/wallet/requests">View Details</a></h4></td>
  </tr>
  
  
  
  <tr>
    <td width="33%" height="20" colspan="3" align="center" valign="middle"> </td>
  </tr>
  <tr>
    <td height="30" colspan="3" align="left" valign="middle"><h2>Total Users</h2></td>
  </tr>
  <tr>
    <td height="30" align="center" valign="middle"><strong>Agent</strong></td>
    <td height="30" align="center" valign="middle"><strong>Channel Partners</strong></td>
    <td height="30" align="center" valign="middle"><strong>Users</strong></td>
  </tr>
  
  <?php
  $agent_tot = 0;
  $users_tot = 0;
  $chnl_part = 0;
  $cnt = 0;
  
  if(!empty($users))
  {
	 foreach($users as $key =>$value)
	 {
		   $cnt+=$value['cnt'];
		 if($value["role_id"] == 2 )
		 {
			$chnl_part  =  $value['cnt'];
		 }
		 if($value["role_id"] == 4 )
		 {
			$users_tot  =  $value['cnt'];
		 }
		 if($value["role_id"] == 6 )
		 {
			$agent_tot  =  $value['cnt'];
		 }
	 }	 
  }
  ?>
  <tr>
    <td height="80" align="center" valign="middle" bgcolor="#Cfecfcf"><h4><?php echo $agent_tot?></h4></td>
    <td height="80" align="center" valign="middle" bgcolor="#Cfecfcf"><blockquote>
      <h4><?php echo $chnl_part?></h4>
    </blockquote></td>
    <td height="80" align="center" valign="middle" bgcolor="#Cfecfcf"><h4><?php echo $users_tot?></h4></td>
  </tr>
  
   <tr>
    <td height="40" align="center" valign="middle" bgcolor="#FFFFFF">Today Joined Users</td>
    <td height="0" align="center" valign="middle" bgcolor="#FFFFFF">Today Joined Agents</td>
    <td height="0" align="center" valign="middle" bgcolor="#FFFFFF">View Details</td>
  </tr>
  <tr>
    <td height="80" align="center" valign="middle" bgcolor="#CFECFC"><?php echo $cnt?></td>
    <td height="0" align="center" valign="middle" bgcolor="#CFECFC"><?php echo $agent_tot?></td>
    <td height="80" align="center" valign="middle" bgcolor="#CFECFC"><h4><a href="http://laabus.com/adminnew/dashboard/agents">view List</a></h4></td>
  </tr>
</table>
</div>




</div>