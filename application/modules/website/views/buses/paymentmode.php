<link href="../../../../admin_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <div class="row">
          <?php echo form_open('buses/paymenttopay','method="post"');
		 // echo form_open('buses/booking_ticket_process','method="post"');

		  ///
		   $lock_amt = $this->users->get_locking_amount();
			//  print_r($lock_amt);
			   $wallet_amount = $this->users->get_wallet_amount($this->session->userdata('user_id'),$this->session->userdata('role_id'));
			   if( $this->session->userdata('role_id') == 6 )
			   {
				   $netamt = $wallet_amount - $lock_amt["agent"];
			   }
			   else if( $this->session->userdata('role_id') == 2 )
			   {
				   $netamt = $wallet_amount - $lock_amt["channel_partner"];
			   }
			   else if( $this->session->userdata('role_id') == 5 )
			   {
				   $netamt = $wallet_amount - $lock_amt["smd"];
			   }
			   else if( $this->session->userdata('role_id') == 4 )
			   {
				   $netamt = $wallet_amount - $lock_amt["smd"];
			   }
			   $netamt1 = number_format($netamt,2);

				$user_id=$this->session->userdata('user_id');
				$role_id=$this->session->userdata('role_id');
				$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
			    $promo_wallet_amount = $this->users->get_promo_wallet_amount($user_id,$role_id);

				if($this->session->userdata('rcAmount')!=''){
				$amount = $this->session->userdata('rcAmount');
				}else if($this->session->userdata('totalAmount')!=''){
				$amount = $this->session->userdata('totalAmount');
				}
			  $cbk_usg_service = 'Bus';
			  $cbk_usg_service_obj = $this->users->get_cbk_usg_service($cbk_usg_service);
			  $is_promo_wallet = FALSE;
			  $useable_promo_wallet = 0;
			  if($promo_wallet_amount > 0 && count($cbk_usg_service_obj) > 0)
			  {
				  if($amount >= $cbk_usg_service_obj['cbk_usg_min_amount'])
				  {
					  //check promotional wallet is through percentage or rupees
					  if($cbk_usg_service_obj['cbk_usg_mode'] == 'PEC')
					  {
						  $useable_promo_wallet = $promo_wallet_amount * $cbk_usg_service_obj[ 'cbk_usg_amount_percentage' ] / 100;
					  }else{
						  $useable_promo_wallet = $cbk_usg_service_obj[ 'cbk_usg_amount_percentage' ];
					  }
					  $is_promo_wallet = true;
				  }
			  }

                $waldiv = "";
				if($wallet_amount>=$amount &&  $this->session->userdata('rcAmount') <  $netamt ){
					$waldis = "";
					$payudis = "disabled";
					$walchk = "checked='checked'";
					$payuchk = "disabled";
				}else if($wallet_amount>=$amount &&  $this->session->userdata('totalAmount') <  $netamt ){
					$waldis = "";
					$payudis = "disabled";
					$walchk = "checked='checked'";
					$payuchk = "disabled";
				}
				else if($wallet_amount==0){
					$waldis = "disabled";
					$payudis = "";
					$walchk = "disabled";
					$payuchk = "checked='checked'";
                    $waldiv = "display:none;";
				}else{
					$waldis = "disabled";
					$payudis = "";
					$walchk = ($amount>$wallet_amount)?"checked='checked'":"disabled";
					$payuchk = "checked='checked'";
				}
			?>

            <input type="hidden"  name="mobile_no" value="<?=$this->session->userdata('mobile_no')?>" />
            <input type="hidden"  name="mark_credit" value="<?=$this->session->userdata('mark_credit')?>" />
            <input type="hidden"  name="mark_credit_text" value="<?=$this->session->userdata('mark_credit_text')?>" />
			<input type="hidden" name="totalAmount" value="<?=$this->session->userdata('totalAmount')?>"/>
			<input type="hidden" name="rcAmount" value="<?=$this->session->userdata('totalAmount')?>"/>
			<input type="hidden" name="couponCode" value="<?=$this->session->userdata('couponCode')?>"/>
			<input type="hidden" name="iscashback" value="<?=$this->session->userdata('iscashback')?>"/>
			<span class="paydata" style="dispaly:none;" userType="<?php echo $this->session->userdata('role_id'); ?>" amount="<?php echo round($amount,2); ?>" wallet_amount="<?php echo round($wallet_amount,2); ?>" netcomm="<?php echo round($netcomm,2); ?>" useable_promo_wallet="<?php echo round($useable_promo_wallet,2); ?>" ></span>
			<div  class="text-left col-md-12">
			<?php
                        //print_r($this->session->userdata);
			if( $this->session->userdata('role_id') == 6 ){
				//$this->session->userdata('totalAmount') = $amount;
			?>
			<p class="well-sm paydatares">Total Payment to be made : <b>RS. <?php echo $amount."&nbsp;-&nbsp;".$netcomm?>(Commision)<?php echo ($is_promo_wallet ? '&nbsp;-&nbsp;'.$useable_promo_wallet.'(Promotional Wallet)' : '') ?>&emsp;=&nbsp;Rs. <?=$amount - $netcomm - $useable_promo_wallet?></b></p>
			<?php
			}else if($this->session->userdata('totalAmount')!=''){
			?>
				<p class="well-sm paydatares">Total Payment to be made : <b>RS. <?php echo $amount-$useable_promo_wallet."/-"?></b></p>
			<?php
			}
			?>
			<input type="hidden" name="payamount" id="payamount" value="<?php echo ($amount>$wallet_amount)?($amount-$wallet_amount):($amount);?>">
			<input type="hidden" name="walamount" id="walamount" value="1">
			</div>
			<div class="text-left col-md-12">
				<div>
				<p class="well-sm"><input type="checkbox" <?php echo $walchk;?> name="payment" onclick="showpaymodes('walletMode')" id="walletpay" value="Wallet">&emsp;Use LAABUS Wallet(<?php echo $wallet_amount;?>)</p>
				</div>
				<?php if($is_promo_wallet){ ?>
					<div>
						<p class="well-sm"><input type="checkbox" checked name="promo_wallet" id="promoWallet" value="<?php echo $useable_promo_wallet ?>">&emsp;Use LAABUS Promotional Wallet(<?php echo $useable_promo_wallet;?>)</p>

					</div>
				<?php } ?>
				<div id="walletMode" style="<?php echo $waldiv;?>">
				<p class="well-sm"><?php
				if( $waldis != 'disabled' )
				{
				if($amount>$wallet_amount ){
				echo $amount."&nbsp;-&nbsp;".$wallet_amount."&nbsp;-&nbsp;".$netcomm."&emsp;=&nbsp;".($amount-$wallet_amount);
				}else{
					echo "<span class='paynow_bal'>".$wallet_amount." - ".($amount-$netcomm-$useable_promo_wallet)."</span>";
					}
				}
				else
				{
					echo "Not enough amount in Wallet.Please Pay by PayUMoney.";
				}
					?>&emsp;<button <?php echo $waldis;?> type="submit" class="btn btn-info" id="walproceed">Pay Now</button></p>
					<?php
					if( $waldis != 'disabled' )
						{
					?>
				<p class="well-sm remaining_bal_str">Remaining Balance&emsp;<?php echo ($amount>$wallet_amount)? $amount - $wallet_amount:($wallet_amount-$amount+$netcomm+$useable_promo_wallet);?></p>
				<?php } ?>
				</div>
			</div>
			<div class="text-left col-md-12" style="display:block">
				<div style=""  id="payuMode">
					<p class="well-sm"><input type="checkbox" <?php echo $payuchk;?> name="payment" id="payupay" value="Payu">&emsp;<button <?php echo $payudis;?> type="submit" class="btn btn-info" id="payuproceed">&emsp;<!--<img src="<?php //echo base_url();?>images/payu.jpg" title="Payu" alt="Payu">-->PAY BY ATOM</button></p>
				</div>
			</div>
          </form>
		  		<?php
		/*echo "Onword :";
		$onward = $this->session->userdata('onword');
		echo "bp name:".$onward["bpname"];
		echo "<pre>";
		print_r($this->session->userdata('onword'));
		echo "</pre>";
		echo "<br>";
		echo "Return :";
		echo "<pre>";
		print_r($this->session->userdata('return'));
		echo "</pre>";*/
		//print("<pre>");
		//print_r($this->session->userdata());
		//echo "MOBILE:".$this->session->userdata('mobile');
		?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
	alert("")
})
function showpaymodes(id){
	if($("#walletpay").is(":checked")){
		//$("#"+id).show();
		<?php if($amount>$wallet_amount){?>
		$("#payamount").val("<?php echo ($amount-$wallet_amount);?>");
		$("#walproceed").prop("disabled", true);
		$("#payupay").prop("disabled", false);
		$("#walletpay").prop("checked", true);
		$("#payupay").prop("checked", true);
		$("#payuproceed").prop("disabled", false);
		<?php }else{?>
		$("#payamount").val("<?php echo ($amount);?>");
		$("#payupay").prop("disabled", true);
		$("#walletpay").prop("checked", true);
		$("#payupay").prop("checked", false);
		$("#payuproceed").prop("disabled", true);
		$("#walproceed").prop("disabled", false);
		<?php }?>
		$("#walamount").val("1");
	}else{
		//$("#"+id).hide();
		$("#payamount").val("<?php echo ($amount);?>");
		$("#payupay").prop("disabled", false);
		$("#walproceed").prop("disabled", true);
		$("#walletpay").prop("checked", false);
		$("#payupay").prop("checked", true);
		$("#payuproceed").prop("disabled", false);
		$("#walamount").val("0");
	}
}
$("#promoWallet").click(function()
{
	var role = $(".paydata").attr("userType");
	var amount = parseFloat($(".paydata").attr("amount"));
	var netcomm = parseFloat($(".paydata").attr("netcomm"));
	var use_promo_wallet = parseFloat($(".paydata").attr("useable_promo_wallet"));
	var wallet_amount = parseFloat($(".paydata").attr("wallet_amount"));
	var paydataString = '';
	var remaining_bal_str = '';
	if($("#promoWallet").is(":checked"))
	{
		var paynow_bal = wallet_amount +" - "+ (amount - netcomm - use_promo_wallet);
		if(role == 6) {
			var calRes = amount - netcomm - use_promo_wallet;
			paydataString = 'Total Payment to be made : <b> RS. ' + amount + '-' + netcomm + '(Commision ) - '+ use_promo_wallet +'(Promotional Wallet) = ' + calRes + '</b>';
			remaining_bal_str = (amount > wallet_amount)? amount - wallet_amount + use_promo_wallet:wallet_amount - amount + netcomm+use_promo_wallet;
		}else {
			paydataString = 'Total Payment to be made : <b> RS. ' + amount + '</b>';
			remaining_bal_str = (amount>wallet_amount)? amount - wallet_amount+use_promo_wallet:(wallet_amount-amount+use_promo_wallet);

		}
	}else {
		var paynow_bal = wallet_amount +" -  "+ (amount - netcomm );
		if(role == 6) {
			var calRes = amount - netcomm;
			paydataString = 'Total Payment to be made : <b> RS. ' + amount + '-' + netcomm + '(Commision ) = ' + calRes + '</b>';
			remaining_bal_str = (amount>wallet_amount)? amount - wallet_amount:wallet_amount-amount+netcomm;
		}else {
			paydataString = 'Total Payment to be made : <b> RS. ' + amount + '</b>';
			remaining_bal_str = (amount>wallet_amount)? amount - wallet_amount-use_promo_wallet:(wallet_amount-amount-use_promo_wallet);
		}
	}
	console.log(paydataString);
	$(".paydatares").html(paydataString);
	$(".paynow_bal").html(paynow_bal);
	$(".remaining_bal_str").html("Remaining Balance&emsp;"+remaining_bal_str.toFixed(2));

});
</script>