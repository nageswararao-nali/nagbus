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
                    <h5>Users Joining/Registration Offers</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>


			   <div class="ibox-content">	
				
				
				<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
						  echo form_open('Offer/update_offeramount12345',$attributes);										
				?>
					

						
						 <!--<div class="form-group">
                            <label class="col-lg-6 control-label">Minimum Balance in Wallet</label>
                            <div class="col-lg-6">
                                <input type="text"   placeholder="" class="form-control groupOfTexbox" name="min_wallet_amoun" id="min_wallet_amoun" value='<?php echo $data[0]->min_wallet_amoun;?>'>
                            </div>
                        </div>-->
						

						
						 <div class="form-group" style="margin-top:16px">
                            <label class="col-lg-6 control-label">Offer to</label>
                            <div class="col-lg-6">
							
							
							<?php $users = $data[0]->users;
							$users = explode(",",$users);
							
							?>
						
                               <input type="checkbox" value="1" name="users[]" <?php if(in_array(1,$users)) echo "checked";?>> Agent &nbsp;&nbsp;&nbsp;&nbsp;
							    <input type="checkbox" value="2" name="users[]" <?php if(in_array(2,$users)) echo "checked";?>> User &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" value="1" name="users[]" <?php if(in_array(1,$users)) echo "checked";?>> User Under Agent 
								 
                            </div>
                        </div>
						

            
						
						
						 <div class="form-group col-lg-6">
                            <label class="col-lg-6 control-label"></label>
</div>							
											   <div  class="form-group col-lg-6" style="margin-top:10px;">
                           Add ( INR )<input type="text"  placeholder="" class="groupOfTexbox" name="offer_amount" id="offer_amount" value='<?php echo $data[0]->offer_amount;?>' style='width:120px'>Amount 1st time to user wallet
                           
                               
								<input type="hidden" value=1 class="form-control" name="id">
                            
                        </div>
						
						<div class="form-group">
                            <label class="col-lg-6 control-label">Options</label>
                            <div class="col-lg-6">
                                <input type="checkbox"> They can utilize the amount after adding minimum balance <input type="text"  placeholder="" class="groupOfTexbox" name="offer_amount" id="offer_amount" value='<?php echo $data[0]->offer_amount;?>' style='width:120px'>	 <br>
								<input type="checkbox"> They can use amount directly<br>
								<input type="checkbox">	Must send the app link to a friend to utilize the amount ( after downloading the app by the friend)<br>
								<input type="checkbox"> Get ‘y’ discount on ‘z’ product with below rules<br>
								<div style='margin-left:20px'>
							 <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <!--<th>#</th>-->
                <th>Discount in INR OR %</th>
                <th>Discount Value</th> 
 <th>Action</th> 				
              </tr>
            </thead>
            <tbody class="flat_currency_table">
              <tr style="background-color:#9CC">
                <!--<td>@</td>-->
                <td><select class="input-sm" name="our_comm_type" id="our_comm_type">
                    <option value=""></option>
                    <option value="INR" <?php if(isset($comm_detils[0]["our_commission_amount"]) && !empty($comm_detils[0]["our_commission_amount"])) echo "selected";?>>Rs</option>
                    <option value="PEC" <?php if( isset($comm_detils[0]["our_commission_percentage"]) && !empty($comm_detils[0]["our_commission_percentage"])) echo "selected";?>>%</option>
                  </select>	</td>
                <td>								<?php				//echo $comm_detils[0]["our_commission_percentage"];				?>				
				
				  <?php				  $amt = '';				  if(isset($comm_detils[0]["our_commission_amount"]) && !empty($comm_detils[0]["our_commission_amount"]))				  {					$amt = $comm_detils[0]["our_commission_amount"];				  }				  else  if( isset($comm_detils[0]["our_commission_percentage"]) && !empty($comm_detils[0]["our_commission_percentage"]))				  {					$amt = $comm_detils[0]["our_commission_percentage"];				  }				  				  ?>
                  <input type="text" class="input-sm" size="4" name="our_comm_value" id="our_comm_value" value="<?php echo $amt;  ?>" /></td>
				  
				  <td><button class="btn btn-primary btn-xs dim" type="button" id="flat_apply_comm_submit"><i class="fa fa-check"></i>Choose Categories</button>
				  </td>
				  
				  
				  
				  
              
              </tr>
            </tbody>
          </table>
							</div>
							
									<div style='margin-left:20px' id='cat'>
									<div class="form-group">
              
                  <label class="col-lg-6">Select Category</label>
                
                <div class="row">
                  <div class="col-lg-6">
                   <select  class="form-control" name="cat_id" id="sel_cat_id">
									<option value="">Select</option>
										<?php
							foreach($categories as $key=>$value)
							{							
							?>
							<option value="<?php echo $value["cat_id"];?>"><?php echo $value["cat_name"];?></option>
							<?php }
							?>
								</select>
                  </div>
                </div>
              </div>
									</div>
									
									
									
									<!-- -->
									 <div class="form-group">
             
                  <div  class="col-lg-6" ><label class="col-lg-12">Select Sub Category</label> </div>
				  <div  class="col-lg-6 subcathide" ><input type="checkbox" class="chkall" value="1" name="all_sub_cat" id="chkall" ><label for="chkall">All</label> </div>
               
                <div class="row subcathide">
                  <div class="col-lg-12" id="subcatdiv">
                   
                  </div>
                </div>
				</div>
				
				 <div class="form-group">
				 <div  class="col-lg-4" ><label class="col-lg-12 control-label">Validity Period</label></div>
							
		
		
               
                 
               
                <div class="col-lg-8">
               
                  From <input type="text" id="startDate" name="st_date" style="width:100px" >
                 
				 to 
				 
                  <input type="text" id="endDate" name="end_date"  style="width:100px">
                  </div>	
					
	</div>			
            
									
									
									<!-- -->
                            </div>
							
							
													
							
                        </div>
						
						
						
						
						
                      
                        <div class="form-group">
                            <div class="col-lg-offset-6 col-lg-6">
                                <button class="btn btn-sm btn-white" type="button" onclick="javascript:location.reload();">Reset</button>
                                <button class="btn btn-sm btn-white" type="submit">Update</button>
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



    $(document).on('submit', '#update_category', function() {
        $.ajax({
            url: baseurl + 'Offer/update_offeramount',
            data: $(this).serialize(),
            type: 'POST',
            cache: false,
            success: function(res) {
               // $("#create_supportmatrix").trigger("reset");
			   location.reload();
            }
        })
        return false;
    })
</script>
<script>
    $(document).ready(function() {
		
		
		 $('.groupOfTexbox').keypress(function (event) {
            return isNumber(event, this)
        });
		
		
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
	
	 $('.chkall').click(function(){
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
        });
		
		
		
		
		
	$(document).on('change','#sel_cat_id', function(event){	
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
	})
})
</script>