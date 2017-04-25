<!--this page is not used in any where-->

<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
td {
    padding: 5px;
    text-align: left;
}
th {
    padding: 5px;
    text-align: center;
}

table tr:nth-child(even) {
    background-color: #eee;
}
table tr:nth-child(odd) {
   background-color:#fff;
}

</style>
<?php
$rechargeInfo=json_decode($rechargeOrder->information);
?>
<div style="width:60%">
<p><img src="<?php echo base_url();?>images/logo_laabus3.png" style="width: 110px; height: 121px;" alt="Laabus"></p>
<p>Dear customer,</p>
<p>Your recharge of RS. <?php echo $rechargeOrder->total_amount;?> success!</p>
<hr/>
<p>Order id &nbsp; :  <?php echo $rechargeOrder->sales_id;?> <span style="float:right;">Recharge Date : <?php echo $rechargeOrder->creation_date;?></span></p>
<hr/>
<p>Recharged No. : <?php echo $rechargeInfo->mobile_no;?> <span style="float:right;">Operator : <?php echo $rechargeInfo->operator_name;?></span></</p>
<table>
<tr style="color: #00F; font-size:18px">
<th></th>
<th>Transaction Details</th>
<th>You Earned</th>
<th>Amount Paid</th>
</tr>
<tr>
<td>1.</td>
<td>Mobile Recharge for <?php echo $rechargeInfo->mobile_no;?></td>
<td>Rs. <?php echo $rechargeOrder->total_amount;?></td>
<td>Rs. <?php echo $rechargeOrder->total_amount;?></td>
</tr>
<tr>
<td>2.</td>
<td>Coupons worth</td>
<td>Rs. 0</td>
<td>Rs. 0</td>
</tr>
<tr style="font-size:18px">
<td></td>
<td>Total</td>
<td>Rs. <?php echo $rechargeOrder->total_amount;?></td>
<td>Rs. <?php echo $rechargeOrder->total_amount;?></td>
</tr>
</table>
</div>