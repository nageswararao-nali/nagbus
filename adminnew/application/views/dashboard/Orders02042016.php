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
		<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'save_comm_cat_subcat'); 
				echo form_open('Dashboard/Save_comm_cat_subcat',$attributes);
				
				?>
				
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
                  <input type="text" id="startDate" class="form-control">
                  </div>
				   <div class="col-lg-1" > to </div>
				  <div class="col-lg-3" >
                  <input type="text" id="endDate" class="form-control">
                  </div>
				  <div class="col-lg-4" >
                  <input type="submit" id="search" value="Search">
                  </div>
                </div>
              </div>
	        
           
</form>         		 <hr/>
          <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <th>Category</th>
                <th>Sub Category</th>
                <th>Our Commission</th>
				<th>Channel Partner</th>
				<th>SMD</th>
                <th>Agent Commission</th>
				<th>Agent Ref. Commission</th>
                <th>Markup </th>
                <th>Discount</th>
                <th>Order Amount</th>
              </tr>
            </thead>
            <tbody >
				<tr>
				<td>Category</td>
			<td>Category</td>
				<td>Category</td>
				<td>Category</td>
				<td>Category</td>
				<td>Category</td>
				<td>Category</td>
				<td>Category</td>
				
				</tr>
							
            
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

<script type="text/javascript">
            $(function () {
              $('#sandbox-container input').datepicker({
    autoclose: true
});
            });
        </script>
