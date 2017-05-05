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
				
				
				<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_cashback');
						 // echo form_open('Offer/update_offeramountnew',$attributes);
					echo form_open_multipart('Cashback/add_cashback',$attributes);						 
				?>
					

						
						 <!--<div class="form-group">
                            <label class="col-lg-6 control-label">Minimum Balance in Wallet</label>
                            <div class="col-lg-6">
                                <input type="text"   placeholder="" class="form-control groupOfTexbox" name="min_wallet_amoun" id="min_wallet_amoun" value='<?php echo $data[0]->min_wallet_amoun;?>'>
                            </div>
                        </div>-->
						
						<input type="hidden" name="cbk_id" class="cbk_id" value="<?php echo $cashback_offer['cbk_id']; ?>">
						
						<div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Add Cashback Amount </label>
                            <div class="col-lg-8">
							 	<div class="form-group col-lg-4">
						   			<input type="text"  placeholder="Amount or Percentage"  name="cbk_amount_percentage"  value='<?php echo $cashback_offer['cbk_amount_percentage']; ?>' >
								</div>
								<div class="form-group col-lg-4">
						 			<select class="input-sm" name="cbk_mode" >
					                    <option value="">Select</option>
					                    <option value="INR" <?php if($cashback_offer['cbk_mode'] == 'INR') { echo "selected"; } ?>>Rs</option>
					                    <option value="PEC" <?php if($cashback_offer['cbk_mode'] == 'PEC') {echo "selected"; } ?>>%</option>
					                </select>
		                        </div>
								<div class="form-group col-lg-4">
						   			<input type="text"  placeholder="Minimum purchase"  name="cbk_min_purchase"  value='<?php echo $cashback_offer['cbk_min_purchase']; ?>' >
								</div>
						 		
                            </div>
                        </div>
						<div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Cashback to</label>
                            <div class="col-lg-8">
							
                               	<input type="checkbox" class="isCheck" value="1" name="cbk_isAgent" <?php if($cashback_offer['cbk_isAgent'] == 1) echo "checked";?>> Agent &nbsp;&nbsp;&nbsp;&nbsp;
							    <input type="checkbox" class="isCheck" value="1" name="cbk_isUser" <?php if($cashback_offer['cbk_isUser'] == 1) echo "checked";?>> User &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" class="isCheck" value="1" name="cbk_isAgentUser" <?php if($cashback_offer['cbk_isAgentUser'] == 1) echo "checked";?>> User Under Agent 
                            </div>
                        </div>
			            <hr>
			            <div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Services</label>
                            <div class="col-lg-8">
							
                               	<input type="checkbox" class="isCheck" value="1" name="cbk_isBus" <?php if($cashback_offer['cbk_isBus'] == 1) echo "checked";?>> Bus &nbsp;&nbsp;&nbsp;&nbsp;
							    <input type="checkbox" class="isCheck" value="1" name="cbk_isRecharge" <?php if($cashback_offer['cbk_isRecharge'] == 1) echo "checked";?>> Recharge &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" class="isCheck" value="1" name="cbk_isProduct" <?php if($cashback_offer['cbk_isProduct'] == 1) echo "checked";?>> Product 
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
				  				<input type="text" name="cbk_promo_code" class="cbk_promo_code"  value="<?php echo $cashback_offer['cbk_promo_code'] ? $cashback_offer['cbk_promo_code'] : $promocode; ?>" style="width:200px" <?php echo $cashback_offer['cbk_id'] != "" ? "readonly" : ""; ?>>
				  				<span id="promo_error" style="color: red;">Promo code exists!</span>
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

<script>
    $(document).ready(function() {
    	$("#promo_error").hide();
		$("#flat_apply_comm_submit").on('click', function(e) {
			e.preventDefault();
			if($(".cbk_id").val() == "") {
				var qData = {
					cbk_promo_code : $(".cbk_promo_code").val()
				}
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url(); ?>' + 'cashback/isPromocodeCodeAvailable',
					data: qData,
					dataType: "text",
					success: function (resultData) {
						if(!resultData) {
							$("#promo_error").hide();
							$("#update_cashback").submit();
						}else {
							$("#promo_error").show();
						}						
					}
				});
			}
		})
		/*$(document).on('click', '.descclass', function() {
	
	desc = $(this).data('content');
	$('#desc').html(desc);
	$('#model_alert').modal('show');*/
	
})


</script>
