<?php $this->load->view('website/user/link_block.php')?>

<h4>Your Order Details:</h4>

 <div class="ibox-content">	

				
				<?php echo form_open(base_url() . 'user/Orders', array('class' => 'form-horizontal', 'id' => 'Orders')); ?>
				
				
					  
			  
				
				 <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Select Category</label>
                </div>
                <div class="row">
                  <div class="col-lg-3">
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
			  
			  
			    <div class="form-group">
                <div class="row">
                  <div  class="col-lg-3" ><label class="col-lg-12">Select Sub Category</label> </div>
				  <div  class="col-lg-9 subcathide" ><input type="checkbox" class="chkall" value="1" name="all_sub_cat" id="chkall" ><label for="chkall">All</label> </div>
                </div>
                <div class="row subcathide">
                  <div class="col-lg-12" id="subcatdiv">
                   
                  </div>
                </div>
              </div>
			  
			  
			  
			  <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Date Range</label>
                </div>
                <div class="row">
                  <div class="col-lg-3" >
                
					<div class="input-group date datepickerDemo">
                <input type="text" name="st_date" placeholder="Start Date" class="form-control">
                <span class="input-group-addon"><i class="ion ion-calendar"></i></span> </div>
				
                  </div>
				   <div class="col-lg-1" > to </div>
				  <div class="col-lg-3" >
                <div class="input-group date datepickerDemo">
                <input type="text" name="end_date" placeholder="End Date" class="form-control">
                <span class="input-group-addon"><i class="ion ion-calendar"></i></span> </div>
				
                  </div>
				  <div class="col-lg-4" >
                  <input type="submit" name="search" id="search" value="Search">
				 <a href="<?= base_url() ?>agent/Orders"> <input type="button" name="reset" id="reset" value="Show All"></a>
                  </div>
                </div>
              </div>
	        
           
</form>         		 <hr/>

<?php
//print("<pre>");
//print_r($order_details);
?>
          <table class="table table-hover" >
            <thead>
              <tr class="text-center">
                <th>Category</th>
                <th>Sub Category</th>
                <th>(Order Amount)</th>
				<th>Transaction Date</th>
              </tr>
            </thead>
            <tbody >
			
			<?php
			$comm_tot = 0;
			$chnl_tot = 0;
			$smd_tot = 0;
			$agnt_tot = 0;
			$agnt_ref_tot = 0;
			$markup_tot = 0;
			$discount_tot = 0;
			$grand_total_commision = 0;
			$tot_order_amt = 0; 
			foreach($order_details as $key =>$value )
			{
				$comm_tot += $value["laabus_comm"];
				$chnl_tot += $value["channel_part_comm"];
				$smd_tot += $value["smd_comm"];
				$agnt_tot += $value["agent_comm"];
				$agnt_ref_tot += $value["agent_ref_comm"];
				$markup_tot += $value["markup"];
				$discount_tot += $value["discount"];
				$grand_total_commision += $value["total_commision"];
				$tot_order_amt += $value["amount"];
				
			?>
				<tr>
				<td><?php echo $value["cat_name"]?></td>
			<td><?php echo $value["sub_cat_name"]?></td>
			
			
		
				
				<td>(<?php echo $value["amount"]?>)</td>
				<td><?php echo date("d/m/Y",strtotime($value["order_date"]));?></td>
				
				</tr>
				
			<?php }
			?>
			
			<tr>
				<td colspan=2><b>Grand Total</b></td>             
              
                <td><?php echo number_format($tot_order_amt,2)?> </b></td>
				<td></td>
			</tr>
			
			
							
            
            </tbody>
          </table>
        </div>
		
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
		  url:"populat_sub_cat_search" ,
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
 <style>
			  .sub_cat_dis
			  {
				  width:220px;
				  float:left;
				  padding:5px;
				  
			  }
			  .subcathide
			  {
				  display:none;
			  }
			  
			  </style>
			  <!-- Date picker -->
<script src="<?= base_url() ?>admin_assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script>
    $('#startDate').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
        toggleActive: true,
    });

    $('#endDate').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
        toggleActive: true,
    });
    //$('#startDate').datepicker('setDate', new Date());
    var date2 = new Date()
    var nextDayDate = new Date();
    nextDayDate.setDate(date2.getDate() + 7);
   // $('#endDate').datepicker('setDate', nextDayDate);
</script>
<!-- Data picker end-->
<script>
$(function(){
	$('.datepickerDemo').datepicker()
});
</script>
