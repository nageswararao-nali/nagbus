<link href="../../../../admin_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <div class="row">
          <?php
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
			   $netamt = number_format($netamt,2);
			   if( $this->session->userdata('rcAmount') >  $netamt )
			   {
				?>
				<div class="text-left col-md-12">
				Sorry, You can not recharge INR <?php echo $this->session->userdata('rcAmount')?><br>
				You can recharge maximum  of INR <?php echo $netamt?>
				</div
				<?php				
			   }
			   else
			   {
		  echo form_open('Recharge/paymenttype','method="post"')?>
            <div class="text-left col-md-6">
            <input type="hidden" value="<?=$this->session->userdata('recharge_session_key')?>" name="recharge_proceed" />
            <input type="hidden"  name="mobile_no" value="<?=$this->session->userdata('mobile_no')?>" />
            <input type="hidden"  name="operator" value="<?=$this->session->userdata('operator')?>" />
            <input type="hidden"  name="operator_circle" value="<?=$this->session->userdata('operator_circle')?>" />
            <input type="hidden"  name="rcAmount" value="<?=$this->session->userdata('rcAmount')?>" />
            <input type="hidden"  name="recharge_type" value="<?=$this->session->userdata('recharge_type')?>" />
            <input type="hidden"  name="operator_name" value="<?=$this->session->userdata('operator_name')?>" />
            <input type="hidden"  name="mark_credit" value="<?=$this->session->userdata('mark_credit')?>" />
            <input type="hidden"  name="mark_credit_text" value="<?=$this->session->userdata('mark_credit_text')?>" />
            <p class="well-sm">Recharge of <b>
              <?=$this->session->userdata('operator_name')?> 
              </b>
              <?=$this->session->userdata('recharge_type')?>
              mobile <b>
              <?=$this->session->userdata('mobile_no')?>
              </b> for <b>RS.
              <?=$this->session->userdata('rcAmount');
			 
			  //print_r($this->session->userdata());   
			  ?>
              </b></p></div>
            <div class="text-center col-md-3">
              <input type="text" class="form-control" name="couponCode" placeholder="Have a Promo code">
              <p style="z-index:99999999999999; position:absolute; top:08px; left:75%; cursor:pointer" id="apply">Apply</p>
            </div>
            <div class="col-md-3 text-right">
            	<button type="submit" class="btn btn-info" id="proceed">Proceed to pay Rs. <?=$this->session->userdata('rcAmount')?></button>
            </div>
          </form>
			   <?php }
			   ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<script>
$('form').on('click', function (e) {
    if (!$('#apply').val()) {
        if ($("#apply").parent().next(".validation").length == 5) ;
		{
            $("#proceed").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Your coupon code is validated</div>");
        }
        e.preventDefault(); 
		$('#apply').focus();
        focusSet = true; 
    } else {
        focusSet = flase;
		$('#proceed').focus();
    }
});  
</script>-->