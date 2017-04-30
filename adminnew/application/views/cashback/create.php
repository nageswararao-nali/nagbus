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
					echo form_open_multipart('Cashback/add_cashback',$attributes);						 
				?>
					

						
						 <!--<div class="form-group">
                            <label class="col-lg-6 control-label">Minimum Balance in Wallet</label>
                            <div class="col-lg-6">
                                <input type="text"   placeholder="" class="form-control groupOfTexbox" name="min_wallet_amoun" id="min_wallet_amoun" value='<?php echo $data[0]->min_wallet_amoun;?>'>
                            </div>
                        </div>-->
						
						<input type="hidden" name="cbk_id" value="<?php echo $cashback_offer['cbk_id']; ?>">
						
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
							
                               	<input type="checkbox" class="isCheck" value="1" name="cbk_isAgent" <?php if($cashback_offer['cbk_isAgent']) echo "checked";?>> Agent &nbsp;&nbsp;&nbsp;&nbsp;
							    <input type="checkbox" class="isCheck" value="1" name="cbk_isUser" <?php if($cashback_offer['cbk_isUser']) echo "checked";?>> User &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" class="isCheck" value="1" name="cbk_isAgentUSer" <?php if($cashback_offer['cbk_isAgentUser']) echo "checked";?>> User Under Agent 
                            </div>
                        </div>
			            <hr>
			            <div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Services</label>
                            <div class="col-lg-8">
							
                               	<input type="checkbox" class="isCheck" value="1" name="cbk_isBus" <?php if($cashback_offer['cbk_isBus']) echo "checked";?>> Bus &nbsp;&nbsp;&nbsp;&nbsp;
							    <input type="checkbox" class="isCheck" value="1" name="cbk_isRecharge" <?php if($cashback_offer['cbk_isRecharge']) echo "checked";?>> Recharge &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" class="isCheck" value="1" name="cbk_isProduct" <?php if($cashback_offer['cbk_isProduct']) echo "checked";?>> Product 
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
<script>

function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57) && (charCode != 8))
            return false;
			
			
			 else {
    var len = $(element).val().length;
    var index = $(element).val().indexOf('.');
    if (index > 0 && charCode == 46) {
      return false;
    }
    if (index > 0) {
      var CharAfterdot = (len + 1) - index;
      if (CharAfterdot > 3) {
        return false;
      }
    }

  }

        return true;
    } 



	



    /*$(document).on('click', '#flat_apply_comm_submit', function() {
		$(this).hide();
        $.ajax({
            url: baseurl + 'Offer/update_walletofferamountnew',
            data: $("#update_category").serialize(),
            type: 'POST',
            cache: false,
            success: function(res) {
               // $("#create_supportmatrix").trigger("reset");
			   //console.log(res);
			  location.reload();
            }
        })
        return false;
    })*/
</script>
<script>
    $(document).ready(function() {
		
		/*$(document).on('click', '.descclass', function() {
	
	desc = $(this).data('content');
	$('#desc').html(desc);
	$('#model_alert').modal('show');*/
	
})


			 $(document).on('click', '.deleteme', function() {
       /* $.ajax({
            url: baseurl + 'Offer/update_offeramountnew',
            data: $(this).serialize(),
            type: 'POST',
            cache: false,
            success: function(res) {
               // $("#create_supportmatrix").trigger("reset");
			   //console.log(res);
			  location.reload();
            }
        })*/
			
			/*if(confirm('Are you sure want to delete this record?'))
			{
				id = $(this).attr("custdata");				
				$.ajax({
				url: baseurl + 'Offer/delete_wallet_offer',
				data: {id:id},
				type: 'POST',
				cache: false,
				success: function(res) {              
				  $("#a"+id).remove();
				  alert('Record Deleted Successfully')
				}
			})
			
			}
			return false;
    })
	
	

		$('.groupOfTexbox').keypress(function (event) {
            return isNumber(event, this)
        });*/
		
		
        /*$("#update_category").validate({
            rules: {
                role_id: {
                    required: true,
                },
				support_type: {
                    required: true,
                },
				contact_no: {
                    required: true,
                },
				timings: {
                    required: true,
                },
                email: {
                    required: true,
                },
				 comments: {
                    required: true,
                }
            }
        });*/
		
		
    });


</script>


<script>
$(document).ready(function(){
	$('.isCheck').click(function(){
            if($(this).is(":checked")){             
			   $(this).val(1)			   
            }else{
            	$(this).val(0)
            }
            
        });
	 /*$('.chkall').click(function(){
            if($(this).is(":checked")){             
			   $(".chksubcat").prop('checked', true);			   
            }
            else if($(this).is(":not(:checked)")){
                 $(".chksubcat").prop('checked', false);
            }
        });
		
			 $(document).on('change','.chksubcat', function(event){	
			 if($(this).is(":checked"))
			 {
				chkall = 1;				 
			 }
			 else
			 {
				 chkall = 0;				
			 }
			 
           $( '.chksubcat' ).each(function( index ) {			
			if($(this).is(":checked")){
				chkall = 1;	
			}
			else
			{
				 chkall = 0;
				 return  false;
			}			
			});
			if(chkall == 0)				
				{
					$(".chkall").prop('checked', false);
				}
				else
				{
					$(".chkall").prop('checked', true);
				}
        });*/
		
		
		
		
		
	/*$(document).on('change','#sel_cat_id', function(event){	
	catid = $(this).val();
	if(catid == 2 )
	{
		catid = 22;
	}
		$.ajax({
		  url:"populat_sub_cat" ,
		  data:{catid:catid},
		  success:function(data) {
			 //return data; 
			 $("#subcatdiv").html(data);
			 $(".subcathide").show();
			 if(data == '' )
			 {
				 alert("No Sub category found...")
			 }
		  }
	   });
	})*/
})
</script>