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
				
				
						
						<div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Add Cashback Amount </label>
                            <div class="col-lg-8">
							 	<div class="form-group col-lg-4">
						   			<input type="text"  placeholder="Amount or Percentage"  name="cbk_amount_percentage"  value='<?php echo $cashback_offer['cbk_amount_percentage']; ?>' >
								</div>
								<div class="form-group col-lg-4">
						   			<input type="text"  placeholder="Minimum purchase"  name="cbk_min_purchase"  value='<?php echo $cashback_offer['cbk_min_purchase']; ?>' >
								</div>
						 		<div class="form-group col-lg-4">
						 			<select class="input-sm" name="cbk_mode" >
					                    <option value="">Select</option>
					                    <option value="INR" <?php if($cashback_offer['cbk_mode'] == 'INR') { echo "selected"; } ?>>Rs</option>
					                    <option value="PEC" <?php if($cashback_offer['cbk_mode'] == 'PEC') {echo "selected"; } ?>>%</option>
					                </select>
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
                  				From <input type="text" id="startDate" name="cbk_st_date" style="width:100px"  value="<?php echo $cashback_offer['cbk_st_date']; ?>">
				 				to 
                  				<input type="text" id="endDate" name="cbk_end_date"  style="width:100px" value="<?php echo $cashback_offer['cbk_end_date']; ?>">
                  			</div>	
						</div>			
            			<hr>
			 			<div class="form-group">
				 			<div  class="col-lg-4" ><label class="col-lg-12 control-label">Cashback Offer Title</label></div>
                			<div class="col-lg-8">
								<input type="text" name="cbk_title"   style="width:100%" value="<?php echo $cashback_offer['cbk_title']; ?>">
              				</div>	
						</div>

 						<div class="form-group">
				 			<div  class="col-lg-4" ><label class="col-lg-12 control-label"><span style='color:green'>Promo Code</label></div>
			                <div class="col-lg-8">
				  				<input type="text" name="cbk_promo_code"  value="<?php echo $cashback_offer['cbk_promo_code'] ? $cashback_offer['cbk_promo_code'] : $promocode; ?>" style="width:200px">
			                </div>	
						</div>
 						<div class="form-group">
				 			<div  class="col-lg-4" ><label class="col-lg-12 control-label">Cashback Offer Description</label></div>
                			<div class="col-lg-8">
				  				<textarea style="width:600px; height:180px" name='cbk_description'><?php echo $cashback_offer['cbk_description']; ?></textarea>
                  			</div>	
						</div>	
						<hr>
						<div class="form-group">
				 			<div  class="col-lg-4" ><label class="col-lg-12 control-label">Upload Image</label></div>
                			<div class="col-lg-8">
				  				<input type="file" name='cbk_image'>
				  				<?php if($cashback_offer['cbk_id']) {
				  					?>
				  					<img src="<?php echo $cashback_offer['cbk_id']; ?>">
				  				<?php } ?>
                  			</div>	
						</div>	
						<hr>
			 			<div class="form-group">
				 			<div  class="col-lg-4" ></div>
                			<div class="col-lg-8">
                				<button class="btn btn-primary btn-xs dim" type="submit" id="flat_apply_comm_submit"><?php echo $cashback_offer['cbk_id'] ? "Update Offer" : "Create Offer"; ?></button>
                  			</div>	
						</div>			
					</form>					
                </div>
            </div>
        </div>
    </div>
</div>
