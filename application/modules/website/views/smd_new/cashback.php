<style>
.ibox-content {overflow:auto;}
.cb_amount {
	color : red;
	font-weight: 500;
}
.amount_text{
	font-weight: 500;
}
</style>

<?php $this->load->view('website/smd_new/menu_block.php')?>

<h4>Your Cashback Details:</h4>

 <div class="ibox-content">

<?php
//print("<pre>");
//print_r($order_details);
?>
<div>
	<span style="float:right;"><span class="amount_text">Promotional Wallet :</span><span class="cb_amount"> <?php echo number_format((float)$user_info->promotional_wallet, 2, '.', ''); ?></span></span>
</div>
<ul class="nav nav-tabs">
    <li class="active"><a href="#home">Recharge</a></li>
    <li><a href="#menu1">Bus</a></li>
  </ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
      	<h3>Recharge</h3>
      	<table class="table table-hover" >
            <thead>
              <tr class="text-center">
			  <th>Date</th>
			  <th>Description</th>
                <th>Status</th>
                <th>Credit/Debit</th>
				<th>Amount</th>
              </tr>
            </thead>
            <tbody >

			<?php

			foreach($cashback_history_recharge as $key =>$value )
			{
				$desc = "";
				$cb_status =  "";
				if($value["cbk_his_info"] == 'Cashback') {
					$desc = $desc.'<p>Cashback Amount FROM Laabus :: '.$value["cbk_his_coupon_code"].'</p>';
					$cb_status = base_url().'web_assets/images/plus.png';
				}elseif($value["cbk_his_info"] == 'promotional walet usage') {
					$information = json_decode($value['information']);
					$desc = $desc.'<p>Recharge Amount To '.$information->mobile_no.' :: '.$value["cbk_his_coupon_code"].'</p>';
					$cb_status = base_url().'web_assets/images/minus.png';
				}
				$desc = $desc . '<p>Promotional : Rs.'.$value["cbk_his_cbk_amount"].'</p><p>Reference : '.$value["cbk_his_txnid"].'</p>';
			?>
				<tr>
					<td><?php echo date("d/m/Y H:i:s",strtotime($value["cbk_his_create_date"])); ?></td>
					<td><?php echo $desc; ?></td>
					<td><?php echo $value["cbk_his_cashback_status"]?></td>
					<td><img src="<?php echo $cb_status;?>" style="width:20px;"></td>
					<td><span class="cb_amount"><?php echo number_format((float)$value["cbk_his_cbk_amount"], 2, '.', ''); ?></span></td>
				</tr>

			<?php }
			?>
            </tbody>
      	</table>
</div>
	  <div id="menu1" class="tab-pane fade">
      <h3>Bus</h3>
      <table class="table table-hover" >
            <thead>
              <tr class="text-center">
			  <th>Date</th>
			  <th>Description</th>
                <th>Status</th>
                <th>Credit/Debit</th>
				<th>Amount</th>
              </tr>
            </thead>
            <tbody >

			<?php

			foreach($cashback_history_bus as $key =>$value )
			{
				$desc = "";
				$cb_status =  "";
				if($value["cbk_his_info"] == 'Cashback') {
					$desc = $desc.'<p>Cashback Amount FROM Laabus :: '.$value["cbk_his_coupon_code"].'</p>';
					$cb_status = base_url().'web_assets/images/plus.png';
				}elseif($value["cbk_his_info"] == 'promotional walet usage') {
					$information = json_decode($value['information']);
					$desc = $desc.'<p>Ticket Booking :: '.$value["cbk_his_coupon_code"].'</p>';
					$cb_status = base_url().'web_assets/images/minus.png';
				}
				$desc = $desc . '<p>Promotional : Rs.'.$value["cbk_his_cbk_amount"].'</p><p>Reference : '.$value["cbk_his_txnid"].'</p>';
			?>
				<tr>
					<td><?php echo date("d/m/Y H:i:s",strtotime($value["cbk_his_create_date"])); ?></td>
					<td><?php echo $desc; ?></td>
					<td><?php echo $value["cbk_his_cashback_status"]?></td>
					<td><img src="<?php echo $cb_status;?>" style="width:20px;"></td>
					<td><span class="cb_amount"><?php echo number_format((float)$value["cbk_his_cbk_amount"], 2, '.', ''); ?></span></td>
				</tr>

			<?php }
			?>
            </tbody>
      	</table>
    </div>
  </div>


	   </div>
		<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>

