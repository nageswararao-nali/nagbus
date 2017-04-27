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
                    <h5>Users Cashback Usage</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
			   <div class="ibox-content">	
						<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
								 // echo form_open('Offer/update_offeramountnew',$attributes);
							echo form_open('Cashback/add_cashback_usage',$attributes);						 
						?>
						<input type="hidden" name="cbk_usg_id" value="<?php echo $cashback_offer_usage['cbk_usg_id']; ?>">
						<div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Add Cashback Amount to <?php echo $cashback_offer_usage['cbk_usg_service']; ?> Service</label>
                            <div class="col-lg-8">
                            	<div class="form-group col-lg-4">
						   			<input type="text"  placeholder="Service"  name="cbk_usg_service"  value='<?php echo $cashback_offer_usage['cbk_usg_service']; ?>' >
								</div>
							 	<div class="form-group col-lg-4">
						   			<input type="text"  placeholder="Amount or Percentage"  name="cbk_usg_amount_percentage"  value='<?php echo $cashback_offer_usage['cbk_usg_amount_percentage']; ?>' >
								</div>
								<div class="form-group col-lg-4">
						 			<select class="input-sm" name="cbk_usg_mode" >
					                    <option value="">Select</option>
					                    <option value="INR" <?php if($cashback_offer_usage['cbk_usg_mode'] == 'INR') { echo "selected"; } ?>>Rs</option>
					                    <option value="PEC" <?php if($cashback_offer_usage['cbk_usg_mode'] == 'PEC') {echo "selected"; } ?>>%</option>
					                </select>
		                        </div>
								<div class="form-group col-lg-4">
						   			<input type="text"  placeholder="Minimum purchase"  name="cbk_usg_min_amount"  value='<?php echo $cashback_offer_usage['cbk_usg_min_amount']; ?>' >
								</div>
                            </div>
                        </div>
			 			<div class="form-group">
				 			<div  class="col-lg-4" ></div>
                			<div class="col-lg-8">
                				<button class="btn btn-primary btn-xs dim" type="submit" id="flat_apply_comm_submit"><?php echo $cashback_offer_usage['cbk_usg_id'] ? "Update Usage" : "Create Usage"; ?></button>
                  			</div>	
						</div>			
					</form>					
                </div>
            </div>
        </div>
    </div>
</div>
