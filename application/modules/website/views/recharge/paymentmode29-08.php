<link href="../../../../admin_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <div class="row">
          <?php 
		  echo form_open('Recharge/proceedtopay','method="post"');
		  //echo form_open('buses/booking_ticket_process','method="post"');
		  
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
		  ///
				$user_id=$this->session->userdata('user_id');
				$role_id=$this->session->userdata('role_id');
				$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);
				$amount = $this->session->userdata('rcAmount');
                                $waldiv = "";
				if($wallet_amount>=$amount &&  $this->session->userdata('rcAmount') <  $netamt ){
					$waldis = "";
					$payudis = "disabled";
					$walchk = "checked='checked'";
					$payuchk = "disabled";
				}else if($wallet_amount==0){
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
            <input type="hidden" value="<?=$this->session->userdata('recharge_session_key')?>" name="recharge_proceed" />
            <input type="hidden"  name="mobile_no" value="<?=$this->session->userdata('mobile_no')?>" />
            <input type="hidden"  name="operator" value="<?=$this->session->userdata('operator')?>" />
            <input type="hidden"  name="operator_circle" value="<?=$this->session->userdata('operator_circle')?>" />
            <input type="hidden"  name="rcAmount" value="<?=$this->session->userdata('rcAmount')?>" />
            <input type="hidden"  name="recharge_type" value="<?=$this->session->userdata('recharge_type')?>" />
            <input type="hidden"  name="operator_name" value="<?=$this->session->userdata('operator_name')?>" />
            <input type="hidden"  name="mark_credit" value="<?=$this->session->userdata('mark_credit')?>" />
            <input type="hidden"  name="mark_credit_text" value="<?=$this->session->userdata('mark_credit_text')?>" />
            <?php
           if( $role_id == 6)
           {
            ?>
            <div  class="text-left col-md-2"><label for='ccc123'>Mark as Credit</lable> <input  id='ccc123' class="credit" name="mark_as_credit_user" value="1" type="checkbox" onchange="javascript:$('.toggcomm').toggle()"></div>
            
             <div class="text-left col-md-3">
             
              <input type="text" name="mark_as_credit_comments" class="form-control Comments toggcomm" style="display:none" placeholder="Enter Your Comments">
            </div>
            <?php }
            ?>
			<div  class="text-left col-md-12">
			<!--<p class="well-sm">Total Payment to be made : <b>RS. <?php echo $this->session->userdata('rcAmount')."&nbsp;-&nbsp;".$netcomm?>(Commision 	)&emsp;=&nbsp;<?=$this->session->userdata('rcAmount') - $netcomm?></b></p>-->
			
			<p class="well-sm">Total Payment to be made : <b>RS. <?php echo $this->session->userdata('rcAmount')."&nbsp;-&nbsp;"?>&nbsp;<?=$this->session->userdata('rcAmount')?></b></p>
			
			
			<input type="hidden" name="payamount" id="payamount" value="<?php echo ($amount>$wallet_amount)?($amount-$wallet_amount):($amount);?>">
			<input type="hidden" name="walamount" id="walamount" value="1">
			</div>
			<div class="text-left col-md-12">
				<div>
				<p class="well-sm"><input type="checkbox" <?php echo $walchk;?> name="payment" onclick="showpaymodes('walletMode')" id="walletpay" value="Wallet">&emsp;Use LAABUS Wallet(<?php echo $wallet_amount;?>)</p>
				</div>
				<div id="walletMode" style="<?php echo $waldiv;?>">
				<p class="well-sm"><?php 
				if( $waldis != 'disabled' )
				{
				if($amount>$wallet_amount ){ 
				echo $amount."&nbsp;-&nbsp;".$wallet_amount."&nbsp;-&nbsp;".$netcomm."&emsp;=&nbsp;".($amount-$wallet_amount);
				}else{
					echo $wallet_amount."&nbsp;-&nbsp;".$amount."&nbsp;+&nbsp;".$netcomm;
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
				<p class="well-sm">Remaining Balance&emsp;<?php echo ($amount>$wallet_amount)?"0":($wallet_amount-$amount+$netcomm);?></p><?php } ?>
				</div>
			</div>
			<div class="text-left col-md-12">
				<div style=""  id="payuMode">
					<p class="well-sm"><input type="checkbox" <?php echo $payuchk;?> name="payment" id="payupay" value="Payu">&emsp;<button <?php echo $payudis;?> type="submit" class="btn btn-info" id="payuproceed">&emsp;<!--<img src="<?php //echo base_url();?>images/payu.jpg" title="Payu" alt="Payu">-->PayUmoney</button></p>
				</div>
			</div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
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
</script>