<link href="../../../../admin_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <div class="row">
          <?php
		//print_r($this->session->userdata('postdata'));




			$lock_amt = $this->users->get_locking_amount();

			//  print_r($lock_amt);
			   $wallet_amount = $this->users->get_wallet_amount($this->session->userdata('user_id'),$this->session->userdata('role_id'));

						$onword = $this->session->userdata("onword");
						$return = $this->session->userdata("return");
						$totalAmount = $onword['amount'] + $return['amount'];
						$this->session->set_userdata("totalAmount",$totalAmount);

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

			   if( $this->session->userdata('totalAmount') >  $netamt && false )
			   {
				?>
				<div class="text-left col-md-12">
				Sorry, You can not Book Seat INR <?php echo $this->session->userdata('totalAmount')?><br>
				You can Book Seat maximum  of INR <?php echo $netamt1?>
				</div
				<?php
			   }
			   else
			   {
				   if($this->session->userdata("onword")!=''){

				    echo form_open('buses/paymenttype','method="post"')

				?>
            <div class="text-left col-md-6">

            <input type="hidden"  name="totalAmount" value="<?=$totalAmount?>" />


            <p class="well-sm">Total Amount :<b>

			 <?php
			  echo $totalAmount."/-";
			  $returnLoc = $this->session->userdata('return');
              $onwordLoc = $this->session->userdata('onword');
			  ?>
              </b></p>
			  <p class="well-sm"><b>BUS BOOKING DETAILS:</b><br /> <b><?php echo $onwordLoc['src']."</b> to <b>".$onwordLoc['dest']. "</b> on ".$onwordLoc['jdate']." at "?>
			  <?php echo $onwordLoc['bpname'] ." - ".$onwordLoc['bptime']?><br />
			    Amount of <b>RS.  <?php  echo $totalAmount."/-";?>

			  <?php
			  if($returnLoc!=''){
			  echo $returnLoc['src']."</b> to <b>".$returnLoc['dest']. "</b> on ".$returnLoc['jdate']." at"?></b>
			  <?php echo $returnLoc['bpname'] ." - ".$returnLoc['bptime']?><br />
                Amount of <b>RS.  <?php  echo $totalAmount."/-";
			  }


				?>



              </b></p></div>
            <div class="text-center col-md-3">
              <input type="text" class="form-control" name="couponCode" id="couponCode" placeholder="Have a Promo code">
              <input type="hidden" class="form-control" name="iscashback" id="iscashback" value="0" >
              <div id='promo_error' style="color:red; display:none">Invalid Promo Code</div>
			  <div id='promo_success' style="color:green; display:none">Promo Code Apply Successfully!</div>
              <p style="z-index:99999999999999; position:absolute; top:08px; left:75%; cursor:pointer" onclick="javascript:checkCashbackCode()" id="apply">Apply</p>
            </div>
            <?php if(count($cashback_offers)) { ?>
			<div class="text-center col-md-1" style="cursor: pointer;"><a data-toggle="modal" data-target="#myModal">Browse Offers</a></div>
			<?php	} ?>
            <div class="col-md-2 text-right">
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
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
        <div class="modal-body">
          <table>
          	<?php foreach($cashback_offers as $offer) { ?>
          		<tr>
          			<td><?php echo $offer["cbk_title"]; ?></td>
          			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          			<td><b><a class="promo_code_list"><?php echo $offer["cbk_promo_code"]; ?></a></b></td>
          		</tr>

          	<?php	} ?>
          	
          </table>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function(){
	$(".promo_code_list").click(function() {
		var pcode = $(this).text();
		$("#couponCode").val(pcode)
	})
})
	function checkCashbackCode(){
		$('#promo_error').hide();
		$('#promo_success').hide();
		//var testurl = 'nag/laabus/';
//	alert($("#couponCode").val());
		var couponCode= $("#couponCode").val();
		var qData = {
			cachback_code : couponCode,
			service:'Bus'
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
