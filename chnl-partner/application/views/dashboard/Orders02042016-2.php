 <style>
			  .sub_cat_dis
			  {
				  width:210px;
				  float:left;
				  padding:5px;
			  }
			  .subcathide
			  {
				  display:none;
			  }
			  .footer {
    background: white none repeat scroll 0 0;
    border-top: 1px solid #e7eaec;
    bottom: 0;
    left: 0;
    padding: 10px 20px;
	position: relative;
    
}
			  </style>
			  
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Orders History</h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#">Config option 1</a> </li>
              <li><a href="#">Config option 2</a> </li>
            </ul>
            <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>				
        <div class="ibox-content">	

				
				<?php echo form_open(base_url() . 'dashboard/Orders', array('class' => 'form-horizontal', 'id' => 'Orders')); ?>
				
				
				 <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Select Agent</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                   <select  class="form-control" name="agent_id" id="agent_id">
									<option value="">Select</option>
									
										<?php
							foreach($agents as $key=>$value)
							{							
							?>
							<option value="<?php echo $value["user_id"];?>"><?php echo $value["name"];?>(<?php echo $value["pincode"];?>)</option>
							<?php }
							?>
										
								</select>
                  </div>
                </div>
              </div>
			  
			  
			   <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Select Channel Partner</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                   <select  class="form-control" name="cnl_part" id="cnl_part">
									<option value="">Select</option>
									<?php
							foreach($ch_partners as $key=>$value)
							{							
							?>
							<option value="<?php echo $value["user_id"];?>"><?php echo $value["name"];?>(<?php echo $value["pincode"];?>)</option>
							<?php }
							?>
										
								</select>
                  </div>
                </div>
              </div>
				
				 <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Select Category</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
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
                  <input type="text" id="startDate" name="st_date" class="form-control">
                  </div>
				   <div class="col-lg-1" > to </div>
				  <div class="col-lg-3" >
                  <input type="text" id="endDate" name="end_date" class="form-control">
                  </div>
				  <div class="col-lg-4" >
                  <input type="submit" name="search" id="search" value="Search">
				 <a href="<?= base_url() ?>dashboard/Orders"> <input type="button" name="reset" id="reset" value="Show All"></a>
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
                <th>Laabus Commission</th>
				<th>Channel Partner</th>
				<th>SMD</th>
                <th>Agent Commission</th>
				<th>Agent Ref. Commission</th>
                <th>Markup </th>
                <th>Discount</th>
                <th>Total Comm.(Order Amount)</th>
				<th>Transaction Date</th>
              </tr>
            </thead>
            <tbody >
			
			<?php
			foreach($order_details as $key =>$value )
			{
			?>
				<tr>
				<td><?php echo $value["cat_name"]?></td>
			<td><?php echo $value["sub_cat_name"]?></td>
				<td><?php echo $value["laabus_comm"]?></td>
				<td><?php echo $value["channel_part_comm"]?> (<?php echo $value["chnlname"]?>)</td>
				<td><?php echo $value["smd_comm"]?> (<?php echo $value["smdname"]?>)</td>
				<td><?php echo $value["agent_comm"]?> (<?php echo $value["agentname"]?>)</td>
				<td><?php echo $value["agent_ref_comm"]?> (<?php echo $value["agentname"]?>)</td>
				<td><?php echo $value["markup"]?></td>
				<td><?php echo $value["discount"]?></td>
				<td><?php echo $value["total_commision"]?> (<?php echo $value["amount"]?>)</td>
				<td><?php echo date("d/m/Y",strtotime($value["order_date"]));?></td>
				
				</tr>
				
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

<script type="text/javascript">
            $(function () {
              $('#sandbox-container input').datepicker({
    autoclose: true
});
            });
        </script>
