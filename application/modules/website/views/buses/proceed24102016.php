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

			//echo "XXX".$this->session->userdata("onword");
            //if($this->session->userdata("onword")!='' && empty($recharge_flag)){
                $returnLoc = $this->session->userdata('return');
                $onwordLoc = $this->session->userdata('onword');
            ?>
            <p class="well-sm"><b>BUS BOOKING DETAILS:</b><br /> <b><?php echo $onwordLoc['src']."</b> to <b>".$onwordLoc['dest']. "</b> on ".$onwordLoc['jdate']." at ".$onwordLoc['startingTime']; ?><br /> <b><?php echo $returnLoc['src']."</b> to <b>".$returnLoc['dest']. "</b> on ".$returnLoc['jdate']." at ".$returnLoc['startingTime']; ?></b><br />
                Amount of <b>RS.  <?php  echo $totalAmount."/-";?>
             
              </b></p>
			  
			  
			 
			  
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
