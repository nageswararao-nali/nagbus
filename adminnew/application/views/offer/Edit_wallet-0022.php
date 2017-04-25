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
                    <h5>Users Wallet Offers</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>


			   <div class="ibox-content">	
				
				
				<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
						 // echo form_open('Offer/update_offeramountnew',$attributes);
					echo form_open('Offer/update_offerwalletamountnew',$attributes);						 
				?>
					

						
						 <!--<div class="form-group">
                            <label class="col-lg-6 control-label">Minimum Balance in Wallet</label>
                            <div class="col-lg-6">
                                <input type="text"   placeholder="" class="form-control groupOfTexbox" name="min_wallet_amoun" id="min_wallet_amoun" value='<?php echo $data[0]->min_wallet_amoun;?>'>
                            </div>
                        </div>-->
						
						
						
						<div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Add <span style='color:red'>EXACT</span> ‘x’ funds get ‘y%’ of additional</label>
                            <div class="col-lg-8">
							

							 <div class="form-group col-lg-4">
                          
						
											  
                           <input type="text"  placeholder=" EXACT X amount in wallet "  name="org_amount[0]"  value='' >
						   
						   
                           
                               
								
                            
                      
						</div>
						
						 <div class="form-group col-lg-4">
                           
                        
						   
						   <input type="text"  placeholder="GET Y additional amount "  name="add_amount[0]"  value='' >
						   
						     <input type="hidden"   name="offer_type[0]"  value='EXACT' >
                           
                               
								
                            
                        </div>
						
						 <div class="form-group col-lg-4">
                          
									 
                        
						   
						 <select class="input-sm" name="offer_mode[0]" >
                    <option value="">Select</option>
                    <option value="INR">Rs</option>
                    <option value="PEC">%</option>
                  </select>
                            
                        </div>
							
							 
								 
                            </div>
                        </div>
						
						 <div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Offer to</label>
                            <div class="col-lg-8">
							
							
							<?php 
							$users = array(0);
							
							?>
						
                               <input type="checkbox" value="1" name="users[0][]" <?php if(in_array(1,$users)) echo "checked";?>> Agent &nbsp;&nbsp;&nbsp;&nbsp;
							    <input type="checkbox" value="2" name="users[0][]" <?php if(in_array(2,$users)) echo "checked";?>> User &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" value="3" name="users[0][]" <?php if(in_array(3,$users)) echo "checked";?>> User Under Agent 
								 
                            </div>
                        </div>
						

            <hr>
			
			
									<div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Add <span style='color:red'>UPTO</span> ‘x’ funds get ‘y%’ of additional</label>
                            <div class="col-lg-8">
							
							
							<?php
							for($i=1;$i<=5;$i++)
							{
							?>

							 <div class="form-group col-lg-4">
                          <input type="hidden"   name="offer_type[<?php echo $i ?>]"  value='UPTO' >
						
											  
                           <input type="text"  placeholder=" Add Upto X amount in wallet "  name="org_amount[<?php echo $i?>]"  value='' >
						   
						   
                           
                               
								<input type="hidden" value=1 class="form-control" name="id">
                            
                      
						</div>
						
						 <div class="form-group col-lg-4">
                           
                        
						   
						   <input type="text"  placeholder="GET Y additional amount "  name="add_amount[<?php echo $i?>]"  value='' >
                           
                               
								<input type="hidden" value=1 class="form-control" name="id">
                            
                        </div>
						
						 <div class="form-group col-lg-4">
                          
									 
                        
						   
						 <select class="input-sm" name="offer_mode[<?php echo $i?>]" >
                    <option value="">Select</option>
                    <option value="INR">Rs</option>
                    <option value="PEC">%</option>
                  </select>
                            
                        </div>
							
							<?php }
							?>
								 
                            </div>
                        </div>
						
						 <div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Offer to</label>
                            <div class="col-lg-8">
							
							
							<?php $users = array(0);
							
							?>
						
                               <input type="checkbox" value="1" name="users[<?php echo $i?>][]" <?php if(in_array(1,$users)) echo "checked";?>> Agent &nbsp;&nbsp;&nbsp;&nbsp;
							    <input type="checkbox" value="2" name="users[<?php echo $i?>][]" <?php if(in_array(2,$users)) echo "checked";?>> User &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" value="3" name="users[<?php echo $i?>][]" <?php if(in_array(3,$users)) echo "checked";?>> User Under Agent 
								 
                            </div>
                        </div>
						

						 <hr>
						
							 <div class="form-group">
				 <div  class="col-lg-4" ><label class="col-lg-12 control-label">Validity Period</label></div>
							
		
		
               
                 
               
                <div class="col-lg-8">
               
                  From <input type="text" id="startDate" name="st_date" style="width:100px" >
                 
				 to 
				 
                  <input type="text" id="endDate" name="end_date"  style="width:100px">
                  </div>	
					
	</div>			
            <hr>
			
			 <div class="form-group">
				 <div  class="col-lg-4" ></div>
							
		
		
               
                 
               
                <div class="col-lg-8">
               
                <button class="btn btn-primary btn-xs dim" type="button" id="flat_apply_comm_submit"><i class="fa fa-check"></i>APPLY</button>
                  </div>	
					
	</div>			
			
			
			
						
					</form>					
					
					<table class="table table-hover">
            <thead>
              <tr >
                <th>EXACT/UPTO</th>
                <th>ORIGINAL AMOUNT</th>
                <th>ADDITIONAL AMOUNT</th>
                <th>INR / %</th>				
                <th>Users </th>  
				<th>Validity Period </th>  
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="tblCategories2" >
			
			 <?php
			 if(!empty($offers))
			 {
				foreach($offers as $key=>$value)
				{
					$users = explode(",",$value["users_type_ids"]);
					$str = '';
					if(in_array(1,$users))
					{
						$str .= " Agent,";
					}
					if(in_array(2,$users))
					{
						$str .= " User,";
					}
					if(in_array(3,$users))
					{
						$str .= " User Under Agent,";
					}

				$str = rtrim($str,",");
				?> 
			 
			 <tr id="a<?php echo $value["id"]?>" >
			  <td><?php echo $value["offer_type"]?></td>
                <td><?php echo $value["org_amount"]?></td>      
              
                <td><?php echo $value["add_amount"]?></td>
				<td><?php echo $value["offer_mode"]?></td>
                <td><?php echo $str?> </td>  
				<td><?php echo date("d/m/Y",strtotime($value["start_date"])) ." to ".date("d/m/Y",strtotime($value["end_date"]));?></td>				
                <td><a href='javascript:;' custdata="<?php echo $value["id"]?>" class="deleteme">Delete</a></td>
              </tr>
			  
			 <?php }
			 }
			 else{
			 ?>
			 <tr><td colspan=7>No data found.</tr>
			 <?php }
			 ?>
			  
			  
			</tbody>
			</table>
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



    $(document).on('click', '#flat_apply_comm_submit', function() {
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
    })
</script>
<script>
    $(document).ready(function() {
		
		
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
			
			if(confirm('Are you sure want to delete this record?'))
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