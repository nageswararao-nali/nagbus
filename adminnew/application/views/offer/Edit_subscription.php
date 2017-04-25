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
                    <h5>AGENT SUBSCRIPTION</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>


			   <div class="ibox-content">	
				
				
				<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
						 // echo form_open('Offer/update_offeramountnew',$attributes);
					echo form_open('Offer/update_offerwalletamountnewRemoved',$attributes);						 
				?>
					

						
						 <!--<div class="form-group">
                            <label class="col-lg-6 control-label">Minimum Balance in Wallet</label>
                            <div class="col-lg-6">
                                <input type="text"   placeholder="" class="form-control groupOfTexbox" name="min_wallet_amoun" id="min_wallet_amoun" value='<?php echo $data[0]->min_wallet_amoun;?>'>
                            </div>
                        </div>-->
						
						

			
			
									<div class="form-group" style="margin-top:16px">
                            <label class="col-lg-4 control-label">Subscription:</label>
                            <div class="col-lg-8">
							
							
							

							 <div class="form-group col-lg-4">
                          <input type="hidden"   name="offer_type"  value='' >
						
											  
                           <input type="text"  placeholder=" SUBSCRIPTION AMOUNT "  name="subscription_amount"  value='' >
			
                            
                      
						</div>
						
						 <div class="form-group col-lg-4">
                         
											  
                           <input type="text"  placeholder=" TO AGENT WALLET "  name="wallet_amount"  value='' >
						   
						   
		
                            
                      
						</div>
						
						
				
						
						 <div class="form-group col-lg-4">
                          
									 
                        
						   
						 <select class="input-sm" name="offer_mode" >                    
                    <option value="INR">Rs</option>
                    <option value="PEC">%</option>
                  </select>
                            
                        </div>
							
							
								 
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
				 <div  class="col-lg-4" ><label class="col-lg-12 control-label"><span style='color:green'>Promo Code</label></div>
							
		
		
               
                 
               
                <div class="col-lg-8">
               
                
				  <input type="text" name="promo_code"   style="width:200px">(if any)
                 
                  </div>	
					
	</div>


 <div class="form-group">
				 <div  class="col-lg-4" ><label class="col-lg-12 control-label">Offer Description</label></div>
							
		
		
               
                 
               
                <div class="col-lg-8">
               
                
				  <textarea style="width:600px; height:180px" name='description'></textarea>
                 
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
				<hr>
				<div class="col-lg-12">
			<?php				
			if( !empty($aget_sub_status[0]['status']) )
			{
				$status = "Active";
				$st_val = 1;
			}
			else
			{
				$status = "Inactive";
				$str_val = 0;
			}
			?>
              <b> Agent Subscription Required</b>: <input type="checkbox" value="<?php echo $st_val?>" id="sub_status" <?php if($st_val == 1 ) echo "checked";?>> &nbsp;&nbsp;&nbsp;<b style='color:red'>[ Note: If this is ticked then Agent will promt for Subscription while registration. ]</b>
                  </div>					
					
					<div class="col-lg-8"> <hr> </div>
					<table class="table table-hover">
            <thead>
              <tr >
			
			   
               
                <th>SUBSCRIPTION AMOUNT</th>
                <th>WALLET AMOUNT</th>
				  <th>ADMIN AMOUNT</th>
				 <th>Promo Code</th>
                <th>INR / %</th>				
               
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
					
				?> 
			 
			 <tr id="a<?php echo $value["id"]?>" >
			 
			   <td ><a href='javascript:;' data-content='<?php echo $value["description"]?>' class='descclass'><?php echo $value["subscription_amount"]?></a></td>
			 <td><?php echo $value["wallet_amount"]?></td>
			 
			  
			  
                <td><?php echo $value["admin_amount"]?></td>      
              
                <td><?php echo $value["promo_code"]?></td>
				<td><?php echo $value["offer_mode"]?>  <?php if( $value["offer_mode"] == "PEC") { echo "(".$value["percentage_applicable"]." % )"; }?></td>
               
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



<div id="model_alert" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:green">Description</h4>
      </div>
      <div class="modal-body" id='desc' >
		
			
			
      </div>
      <div class="modal-footer">
        <!--<button type="button"  class="btn btn-default classwalkin" data-dismiss="modal">Save</button>-->
		 
		  <button type="button"  class="btn btn-default classcancel" data-dismiss="modal">OK</button>
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
            url: baseurl + 'Offer/update_agentofferamountnew',
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
		
		$(document).on('click', '.descclass', function() {
	
	desc = $(this).data('content');
	$('#desc').html(desc);
	$('#model_alert').modal('show');
	
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
			
			if(confirm('Are you sure want to delete this record?'))
			{
				id = $(this).attr("custdata");				
				$.ajax({
				url: baseurl + 'Offer/delete_agent_sub_offer',
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
	
	
				 $(document).on('click', '#sub_status', function() {			
			if(confirm('Are you sure want to change Agent Subscription Status?'))
			{
				//checked = $(this).attr("checked");
				//alert(checked)				
				//alert($('#sub_status').is(':checked'));
				if($('#sub_status').is(':checked'))
				{
					status = 1;
				}
				else
				{
					status = 0;
				}
				$.ajax({
				url: baseurl + 'Offer/update_agent_sub_status',
				data: {status:status},
				type: 'POST',
				cache: false,
				success: function(res) {        
				  
				  $('#sub_status').prop('checked', !($('#sub_status').is(':checked')));
				  alert(' Agent Subscription Status Changed Successfully')
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