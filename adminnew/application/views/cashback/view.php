 <style>
			  .sub_cat_dis
			  {
				  width:140px;
				  float:left;
				  padding:5px;
			  }
			  
			  </style>
<div class="wrapper wrapper-content animated fadeInRight" ng-controller="supportmatrixCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Users Cashback Offers</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
			    <div class="ibox-content">	
			    <?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
						 // echo form_open('Offer/update_offeramountnew',$attributes);
					echo form_open('Cashback/add_cashback',$attributes);						 
				?>
					<div class="form-group" style="margin-top:16px">
                        <label class="col-lg-4 control-label">Add Cashback Amount </label>
                        <div class="col-lg-8">
						 	<div class="form-group col-lg-4">
					   			<?php echo $cashback_offer['cbk_amount_percentage']; ?>
							</div>
							<div class="form-group col-lg-4">
								<?php echo $cashback_offer['cbk_min_purchase']; ?>
							</div>
					 		<div class="form-group col-lg-4">
					 			<?php echo $cashback_offer['cbk_mode']; ?>
	                        </div>
                        </div>
                    </div>
					<div class="form-group" style="margin-top:16px">
                        <label class="col-lg-4 control-label">Cashback to</label>
                        <div class="col-lg-8">
						<?php 
						$users = array(0);
						?>
                           	<input type="checkbox" value="1" name="cbk_isAgent" <?php if($cashback_offer['cbk_isAgent']) echo "checked";?>> Agent &nbsp;&nbsp;&nbsp;&nbsp;
						    <input type="checkbox" value="1" name="cbk_isUser" <?php if($cashback_offer['cbk_isUser']) echo "checked";?>> User &nbsp;&nbsp;&nbsp;&nbsp;
							<input type="checkbox" value="1" name="cbk_isAgentUSer" <?php if($cashback_offer['cbk_isAgentUSer']) echo "checked";?>> User Under Agent 
                        </div>
                    </div>
		            <hr>
				 	<div class="form-group">
			 			<div  class="col-lg-4" ><label class="col-lg-12 control-label">Validity Period</label></div>
            			<div class="col-lg-8">
              				From <?php echo $cashback_offer['cbk_st_date']; ?>
			 				to <?php echo $cashback_offer['cbk_end_date']; ?>
              			</div>	
					</div>			
        			<hr>
		 			<div class="form-group">
			 			<div  class="col-lg-4" ><label class="col-lg-12 control-label">Cashback Offer Title</label></div>
            			<div class="col-lg-8">
            				<?php echo $cashback_offer['cbk_title']; ?>
          				</div>	
					</div>

						<div class="form-group">
			 			<div  class="col-lg-4" ><label class="col-lg-12 control-label"><span style='color:green'>Promo Code</label></div>
		                <div class="col-lg-8">
		                	<?php echo $cashback_offer['cbk_promo_code']; ?>
		                </div>	
					</div>
						<div class="form-group">
			 			<div  class="col-lg-4" ><label class="col-lg-12 control-label">Cashback Offer Description</label></div>
            			<div class="col-lg-8">
            				<?php echo $cashback_offer['cbk_description']; ?>
              			</div>	
					</div>	
					<hr>
					<div class="form-group">
			 			<div  class="col-lg-4" ><label class="col-lg-12 control-label">Upload Image</label></div>
            			<div class="col-lg-8">
            				
            				<img src="<?php echo $cashback_offer['cbk_image']; ?>">
              			</div>	
					</div>	
					<hr>
		 			<div class="form-group">
			 			<div  class="col-lg-4" ></div>
            			<div class="col-lg-8">
            				<a class="btn btn-primary btn-xs dim" type="button" id="activate_offer"><?php echo $cashback_offer['cbk_status'] ? '' : 'Activate'; ?></a>
            				<a class="btn btn-primary btn-xs dim" id="edit_offer" href="../create/<?php echo $cashback_offer['cbk_id']; ?>">Edit</a>
              			</div>	
					</div>
				</form>			
                </div>
            </div>
        </div>
    </div>
</div>