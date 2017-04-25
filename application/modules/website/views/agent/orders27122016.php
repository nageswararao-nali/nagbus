<style>
.ibox-content {overflow:auto;}
</style>

<?php $this->load->view('website/agent/menu_block.php')?>

<h4>Your Order Details:</h4>

 <div class="ibox-content">	

				
				<?php echo form_open(base_url() . 'agent/Orders', array('class' => 'form-horizontal', 'id' => 'Orders')); ?>
				
				
					  
			  
				
				 <div class="form-group">
                <div class="row1">
                  <label class="col-lg-12">Select Category</label>
                </div>
                <div class="row1">
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
                <div class="row1">
                  <div  class="col-lg-3" ><label class="col-lg-12">Select Sub Category</label> </div>
				  <div  class="col-lg-9 subcathide" ><input type="checkbox" class="chkall" value="1" name="all_sub_cat" id="chkall" ><label for="chkall">All</label> </div>
                </div>
                <div class="row1 subcathide">
                  <div class="col-lg-12" id="subcatdiv">
                   
                  </div>
                </div>
              </div>
			  
			  
			  
			  <div class="form-group">
                <div class="row1">
                  <label class="col-lg-12">Date Range</label>
                </div>
                <div class="row1">
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

<ul class="nav nav-tabs">
    <li class="active"><a href="#home">Recharge</a></li>
    <li><a href="#menu1">Bus</a></li>
  </ul>
  
<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
      <h3>Recharge</h3>
          <table class="table table-hover" >
            <thead>
              <tr class="text-center">
			  <th>Transaction ID</th>
                <th>Category</th>
                <th>Sub Category</th>
				<th>Order To</th>
				<th>Transaction Amount</th>
				<th>Order By</th>
               
                <th>Your Commission</th>
				<th>Ref. Commission</th>
             
                <th>Your Commision Amount</th>
				<th>Transaction Date Time</th>
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
				//$grand_total_commision += $value["total_commision"];
				$tot_order_amt += $value["amount"];
				
				if( $value["end_user_id"] == $value["agent_id"] )
					{
						$grand_total_commision += $value["agent_comm"];
					}
					else
					{
						$grand_total_commision += $value["agent_ref_comm"];
					}
				
			?>
				<tr>
				<td><?php echo $value["sales_id"]?></td>
				<td><?php echo $value["cat_name"]?></td>
			<td><?php echo $value["sub_cat_name"]?></td>
			<td><?php echo $value["ordertouser"];?></td>
			<td><?php echo $value["amount"]?></td>
			<td>
			<?php
			if( $this->session->userdata('user_id') == $value["recharge_by"])
			{
				echo "You";
			}
			else if( $value["sales_id"] == 0 )
			{
				echo "You";
			}
			else
			{
				echo "Your User";
			}
			?>
			</td>
			
			
				<td><?php 
					if( $value["end_user_id"] == $value["agent_id"]   )
					{
						if(!empty($value["agent_comm_percentage"]) )
						echo $value["agent_comm_percentage"]." %";
						else
						echo "N/A";
					}
					else
					{
						echo "0.00 %";
					}
				?></td>
				<td><?php //echo $value["agent_ref_comm"]
				if( $value["end_user_id"] == $value["agent_id"] )
					{
						echo "0.00 %";
					}
					else
					{
						echo $value["agent_ref_comm_percentage"]." %";
					}
				
					
				?></td>
				
				<td><?php //echo $value["agent_comm"]
				
				if( $value["end_user_id"] == $value["agent_id"] )
					{
						echo $value["agent_comm"];
					}
					else
					{
						echo $value["agent_ref_comm"];
					}
				?></td>
				<td><?php echo date("d/m/Y H:i:s",strtotime($value["order_date"]));?></td>
				
				</tr>
				
			<?php }
			?>
			
			<tr>
				<td colspan=4><b>Grand Total</b></td>
				
                <td><b>&#8377;<?php echo number_format($tot_order_amt,2)?></b></td>
				
				<td colspan=3></td>
              
                <td><b>&#8377;<?php echo number_format($grand_total_commision,2)?>  </b></td>
				<td></td>
			</tr>
			
			
							
            
            </tbody>
          </table>
</div>      
	  <div id="menu1" class="tab-pane fade">
      <h3>Bus</h3>
      <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
						
                            <th>Transaction ID<?php echo $email; ?></th>
                            <th>Category</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Date of Journey</th>
                            <th>Seat</th>
                            <th>Fare</th>
                            <th>Date Of Booking</th>
                            <th>View</th>
                            <th>Cancelation</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
						// print_r($ticket_details);
                                      //  echo "I am ok";
                                      //  exit;
			foreach($ticket_details as $value)
			{
                    $value = get_object_vars($value);
			?>
                            <tr>
                                <td>
                                    <?php echo $value['tin'];?>
                                </td>
                                <td>
                                    <?php echo "Bus Ticket"; ?>
                                </td>
                                <td>
                                    <?php echo $value["from_city"]?>
                                </td>
                                <td>
                                    <?php echo $value["to_city"];?>
                                </td>
                                <td>
                                    <?php echo date("d/m/Y",strtotime($value["date_of_Jrny"]));?>
                                </td>
                                <td>
                                    <?php echo $value["seats_no"];?>
                                </td>
                                <td>
                                    <?php echo $value["amount"];?>
                                </td>
                                <td>
                                    <?php echo date("d/m/Y",strtotime($value["dateof_Booking"]));?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url() ?>user/PrintTicket/<?php echo $value['tin']?>">View</a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url() ?>user/PassengerList/<?php echo $value['bookingKey']?>">
                                    Cancel Ticket
                                    </a>
                                </td>

                            </tr>
                            <?php } ?>

                    </tbody>
        
        </table>
    </div>    
  </div>


	   </div>
		<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
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
