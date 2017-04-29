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
			   $netamt1 = number_format($netamt,2);

			   if( $this->session->userdata('rcAmount') >  $netamt && false )
			   {
				?>
				<div class="text-left col-md-12">
				Sorry, You can not recharge INR <?php echo $this->session->userdata('rcAmount')?><br>
				You can recharge maximum  of INR <?php echo $netamt1?>
				</div
				<?php
			   }
			   else
			   {
				   if($this->session->userdata('rcAmount')!=''){
			echo form_open('Recharge/paymenttype','method="post"') ?>
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
            <?php
			//echo "XXX".$this->session->userdata("onword");
            if($this->session->userdata("onword")!='' && empty($recharge_flag)){
                $returnLoc = $this->session->userdata('return');
                $onwordLoc = $this->session->userdata('onword');
            ?>
            <p class="well-sm"><b>BUS BOOKING DETAILS:</b><br /> <b><?php echo $onwordLoc['src']."</b> to <b>".$onwordLoc['dest']. "</b> on ".$onwordLoc['jdate']." at ".$onwordLoc['startingTime']; ?><br /> <b><?php echo $returnLoc['src']."</b> to <b>".$returnLoc['dest']. "</b> on ".$returnLoc['jdate']." at ".$returnLoc['startingTime']; ?></b><br />
                Amount of <b>RS.
              <?=$this->session->userdata('rcAmount');?>
              </b></p>
            <?php
                                   }else{
            ?>
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
              </b></p>
            <?php
                                   }
            ?>
            </div>
            <div class="text-center col-md-3">
              <input type="text" class="form-control" name="couponCode" id="couponCode" placeholder="Have a Promo code">
              <input type="hidden" class="form-control" name="iscashback" id="iscashback" value="0" >
			  <div id='promo_error' style="color:red; display:none">Invalid Promo Code</div>
			  <div id='promo_success' style="color:green; display:none">Promo Code Apply Successfully!</div>
<!--              <p style="z-index:99999999999999; position:absolute; top:08px; left:75%; cursor:pointer" id="apply" onclick="javascript:$('#promo_error').show()">Apply</p>-->
              <p style="z-index:99999999999999; position:absolute; top:08px; left:75%; cursor:pointer" id="apply" onclick="javascript:checkCachbackCode()">Apply</p>
            </div>
            <div class="col-md-3 text-right">
            	<button type="submit" class="btn btn-info" id="proceed">Proceed to pay Rs. <?=$this->session->userdata('rcAmount')?></button>
            </div>
            <?php $role_id=$this->session->userdata('role_id');
                if($role_id && $role_id == "6"){
            ?>
                                <hr>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <input type="checkbox" value="1" name="mark_credit_user" class="credit">
                                        <label for="cabselect">Mark as credit</label>
                                    </div>

                                    <div class="col-md-3">


                                    <input type="text" class="form-control Comments"  name="mark_as_credit_comments" style="display:none" placeholder="Enter Your Comments">
                                    </div>
                                </div>
                                <?php
                }
                                ?>
          </form>
			   <?php }else if($this->session->userdata("onword")!=''){
				     $onword = $this->session->userdata("onword");
                     $return = $this->session->userdata("return");
					 $totalAmount = $onword['amount'] + $return['amount'];
					 $this->session->set_userdata("totalAmount",$totalAmount);
				    echo form_open('Recharge/paymenttype','method="post"')?>
            <div class="text-left col-md-6">

            <input type="hidden"  name="totalAmount" value="<?=$totalAmount?>" />

            <p class="well-sm">Total Amount :<b>

			 <?php
			  echo $totalAmount."/-";
			  ?>
              </b></p></div>
            <div class="text-center col-md-3">
              <input type="text" class="form-control" name="couponCode" placeholder="Have a Promo code">
              <p style="z-index:99999999999999; position:absolute; top:08px; left:75%; cursor:pointer" id="apply">Apply</p>
            </div>
            <div class="col-md-3 text-right">
            	<button type="submit" class="btn btn-info" id="proceed">Proceed to pay Rs. <?=$totalAmount?>/-</button>
            </div>
          </form>
				<?php
			   }
			   }
			   ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$('.credit').click(function(){
	if ($(this).is(':checked')){
	$(".Comments").show()
	} else {
		$(".Comments").hide()
	};

});
function checkCachbackCode(){
	$('#promo_error').hide();
	$('#promo_success').hide();
	//var testurl = 'nag/laabus/';
//	alert($("#couponCode").val());
	var couponCode= $("#couponCode").val();
	var qData = {
		cachback_code : couponCode
	}
	if(couponCode != '') {
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>' + 'Common/isCachBackCodeAvailable',
			data: qData,
			dataType: "text",
			success: function (resultData) {
//				alert(resultData);
				console.log(resultData)
				if(resultData == "success")
				{
					console.log("ok");
					$('#promo_success').show();
					$('#iscashback').val(1);
				}
				else
				{
					console.log("not ok");
					$('#promo_error').show();
				}
			}
		});
	}
	else
	{
		$('#promo_error').show();
	}
};


</script>