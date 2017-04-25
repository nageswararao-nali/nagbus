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
          <h5>Commissions Setup</h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#">Config option 1</a> </li>
              <li><a href="#">Config option 2</a> </li>
            </ul>
            <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>				<div id='comm_msg' style='color:green;text-align: center; background-color:#fff'></div>
        <div class="ibox-content">	
		<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'save_comm_cat_subcat'); 
				echo form_open('Dashboard/Save_comm_cat_subcat',$attributes);
				
				?>
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
                <div class="row subcathide" >
                  <div class="col-lg-12" id="subcatdiv">
                   
                  </div>
                </div>
              </div>
			  
			  	 <div class="form-group">
                <div class="row">
			      <label class="col-lg-12 ">Select Bill Type</label>
                            <div class="col-lg-12">
                                
								<select  class="form-control" name="bill_type">
									<option value="0">N/A</option>
									<option value="1">Prepaid Mobile</option>
									<option value="2">Postpaid Mobile</option>
										
							
								</select>
                           </div>
                </div>
              </div>
			  
 
 
 
 
 
          <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <!--<th>#</th>-->
                <th>Title</th>
                <th>Our Commission</th>
                <th>Agent Commission</th>
                <th>Agent Reference Commission</th>
                <th>Markup </th>
                <th>Discount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="flat_currency_table">
              <tr style="background-color:#9CC">
                <!--<td>@</td>-->
                <td><label>Commissions</label></td>
                <td>								<?php				//echo $comm_detils[0]["our_commission_percentage"];				?>				
				<select class="input-sm" name="our_comm_type" id="our_comm_type">
                    <option value=""></option>
                    <option value="INR" <?php if(isset($comm_detils[0]["our_commission_amount"]) && !empty($comm_detils[0]["our_commission_amount"])) echo "selected";?>>Rs</option>
                    <option value="PEC" <?php if( isset($comm_detils[0]["our_commission_percentage"]) && !empty($comm_detils[0]["our_commission_percentage"])) echo "selected";?>>%</option>
                  </select>	
				  <?php				  $amt = '';				  if(isset($comm_detils[0]["our_commission_amount"]) && !empty($comm_detils[0]["our_commission_amount"]))				  {					$amt = $comm_detils[0]["our_commission_amount"];				  }				  else  if( isset($comm_detils[0]["our_commission_percentage"]) && !empty($comm_detils[0]["our_commission_percentage"]))				  {					$amt = $comm_detils[0]["our_commission_percentage"];				  }				  				  ?>
                  <input type="text" class="input-sm" size="4" name="our_comm_value" id="our_comm_value" value="<?php echo $amt;  ?>" /></td>
				  
				  
				  
				  
                <td><select class="input-sm" name="agent_comm_type" id="agent_comm_type">
                    <option value=""></option>
                    <option value="INR" <?php if(isset($comm_detils[0]["agent_commission_amount"]) && !empty($comm_detils[0]["agent_commission_amount"])) echo "selected";?>>Rs</option>  
					<option value="PEC" <?php if( isset($comm_detils[0]["agent_commission_percentage"]) && !empty($comm_detils[0]["agent_commission_percentage"])) echo "selected";?>>%</option>
                  </select>				  <?php				  $amt = '';				  if(isset($comm_detils[0]["agent_commission_amount"]) && !empty($comm_detils[0]["agent_commission_amount"]))				  {					$amt = $comm_detils[0]["agent_commission_amount"];				  }				  else  if( isset($comm_detils[0]["agent_commission_percentage"]) && !empty($comm_detils[0]["agent_commission_percentage"]))				  {					$amt = $comm_detils[0]["agent_commission_percentage"];				  }				  				  ?>
                  <input type="text" class="input-sm" size="4" name="agent_comm_value" id="agent_comm_value" value="<?php echo $amt;  ?>" /></td>
				  <td>
				  <select class="input-sm" name="agent_ref_comm_type" id="agent_ref_comm_type">
				  <option value=""></option>
                     <option value="INR" <?php if(isset($comm_detils[0]["agent_reference_commission_amount"]) && !empty($comm_detils[0]["agent_reference_commission_amount"])) echo "selected";?>>Rs</option> 
					 <option value="PEC" <?php if( isset($comm_detils[0]["agent_reference_commission_percentage"]) && !empty($comm_detils[0]["agent_reference_commission_percentage"])) echo "selected";?>>%</option>
                  </select><?php				  $amt = '';				  if(isset($comm_detils[0]["agent_reference_commission_amount"]) && !empty($comm_detils[0]["agent_reference_commission_amount"]))				  {					$amt = $comm_detils[0]["agent_reference_commission_amount"];				  }				  else  if( isset($comm_detils[0]["agent_reference_commission_percentage"]) && !empty($comm_detils[0]["agent_reference_commission_percentage"]))				  {					$amt = $comm_detils[0]["agent_reference_commission_percentage"];				  }				  				  ?>
                  <input type="text" class="input-sm" size="4" name="agent_ref_comm_value" id="agent_ref_comm_value" value="<?php echo $amt;  ?>" /></td>
                   <td><select class="input-sm" name="mark_comm_type" id="mark_comm_type">
                    <option value=""></option>
                    <option value="INR" <?php if(isset($comm_detils[0]["markup_commission_amount"]) && !empty($comm_detils[0]["markup_commission_amount"])) echo "selected";?>>Rs</option>  
					<option value="PEC" <?php if( isset($comm_detils[0]["markup_commission_percentage"]) && !empty($comm_detils[0]["markup_commission_percentage"])) echo "selected";?>>%</option>
                  </select>					<?php				  $amt = '';				  if(isset($comm_detils[0]["markup_commission_amount"]) && !empty($comm_detils[0]["markup_commission_amount"]))				  {					$amt = $comm_detils[0]["markup_commission_amount"];				  }				  else  if( isset($comm_detils[0]["markup_commission_percentage"]) && !empty($comm_detils[0]["markup_commission_percentage"]))				  {					$amt = $comm_detils[0]["markup_commission_percentage"];				  }				  				  ?>
                  <input type="text" class="input-sm" size="4" name="mark_comm_value" id="mark_comm_value" value="<?php echo $amt;  ?>" /></td>
                <td><select class="input-sm" name="dis_type" id="dis_type">
                    <option value=""></option>
                    <option value="INR" <?php if(isset($comm_detils[0]["discount_amount"]) && !empty($comm_detils[0]["discount_amount"])) echo "selected";?>>Rs</option> 
					<option value="PEC" <?php if( isset($comm_detils[0]["discount_percentage"]) && !empty($comm_detils[0]["discount_percentage"])) echo "selected";?>>%</option>
                  </select>					<?php				  $amt = '';				  if(isset($comm_detils[0]["discount_amount"]) && !empty($comm_detils[0]["discount_amount"]))				  {					$amt = $comm_detils[0]["discount_amount"];				  }				  else  if( isset($comm_detils[0]["discount_percentage"]) && !empty($comm_detils[0]["discount_percentage"]))				  {					$amt = $comm_detils[0]["discount_percentage"];				  }				  				  ?>
                  <input type="text" class="input-sm" size="4" name="dis_value" id="dis_value" value="<?php echo $amt;  ?>"/></td>
               <td><button class="btn btn-primary btn-xs dim" type="submit" id="flat_apply_comm_submit"><i class="fa fa-check"></i>&nbsp;Apply</button></td>
              </tr>
            </tbody>
          </table>
</form>         		 <hr/>
          <table class="table table-hover" id="myTable"> 
            <thead>
              <tr class="text-center">
                <th>Category</th>
                <th>Operators Name</th>
                <th>Our Commission</th>
                <th>Agent Commission</th>
				<th>Agent Ref. Commission</th>
                <th>Markup </th>
                <th>Discount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="tblCategories2">
			
				<?php
							$cnt = 0;
							foreach($comm_detils as $key=>$value)
							{
$cnt++;								
							?>
							
							<tr>
							
                             <td><?php echo $value["cat_name"];?>

							<?php
							if( $value["bill_type"] == 1)
							{
								echo "(Prepaid)";
							}
							else if( $value["bill_type"] == 2 )
							{
								echo "(Postpaid)";
							}
							?>
							 </td>
							 <td>
							 <?php 
							 if($value["sub_cat_id"] == 0 )
							 {
									echo "All";
							 }
							 else
							 {
								echo $value["sub_cat_names"];
							 }
							 ?>
							 </td>
                                <td><span id="view_our_comm<?php echo $value["id"]?>"><?php echo $value["our_comm_value"];?>
								&nbsp;
								<?php
								if( $value["our_comm_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["our_comm_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?></span>
								<span id="edit_our_comm<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="our_comm_type<?php echo $value["id"]?>" id="our_comm_type<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="our_comm_value<?php echo $value["id"]?>" id="our_comm_value<?php echo $value["id"]?>" value="" />
				  </span>
								
								 
								
								</td>
								 <td>
								 <span id="view_agent_comm<?php echo $value["id"]?>" >
								 <?php echo $value["agent_comm_value"];?>
								 
								 
								 &nbsp;
								<?php
								if( $value["agent_comm_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["agent_comm_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?></span>
								
								<span id="edit_agent_comm<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="agent_comm_type<?php echo $value["id"]?>" id="agent_comm_type<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="agent_comm_value<?php echo $value["id"]?>" id="agent_comm_value<?php echo $value["id"]?>" value="" />
				  </span>
								
								 </td>
								 <td>
								  <span id="view_agent_ref_comm<?php echo $value["id"]?>" ><?php echo $value["agent_ref_comm_value"];?>
								 
								  &nbsp;
								<?php
								if( $value["agent_ref_comm_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["agent_ref_comm_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?></span>
<span id="edit_agent_ref_comm<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="agent_ref_comm_type<?php echo $value["id"]?>" id="agent_ref_comm_type<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="agent_ref_comm_value<?php echo $value["id"]?>" id="agent_ref_comm_value<?php echo $value["id"]?>" value="" />
				  </span>								
								 </td>
								  <td>
								   <span id="view_mark_comm<?php echo $value["id"]?>" >
								   <?php echo $value["mark_comm_value"];?>
								 
								  &nbsp;
								<?php
								if( $value["mark_comm_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["mark_comm_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?>	</span>	
								<span id="edit_mark_comm<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="mark_comm_type<?php echo $value["id"]?>" id="mark_comm_type<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="mark_comm_value<?php echo $value["id"]?>" id="mark_comm_value<?php echo $value["id"]?>" value="" />
				  </span>	
								
								 </td>
								 <td>
								  <span id="view_dis_comm<?php echo $value["id"]?>" >
								  <?php echo $value["dis_value"];?>
								 
								  &nbsp;
								<?php
								if( $value["dis_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["dis_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?></span>

<span id="edit_dis_comm<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="dis_comm_type<?php echo $value["id"]?>" id="dis_comm_type<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="dis_comm_value<?php echo $value["id"]?>" id="dis_comm_value<?php echo $value["id"]?>" value="" />
				  </span>									
								 </td>
								 
                                <td><a class="editcomm" id="<?php echo $value["id"]?>" href='javascript:;'>Edit</a>&nbsp;&nbsp;<a onclick="return confirm('Are you sure?')" href='deletecomm?id=<?php echo $value["id"]?>'>Delete</a></td>
								</tr>
							<?php }
							?>
							
							<?php
							
							foreach($comm_limitedoffer_detils as $key=>$value)
							{
$cnt++;								
							?>
							
							<tr>
							
                             <td>Limited Offer

							
							 </td>
							 <td>
							 <?php 
							 echo $value["offer_title"];
							 ?>
							 </td>
                                <td><span id="view_our_comml<?php echo $value["id"]?>"><?php echo $value["our_comm_value"];?>
								&nbsp;
								<?php
								if( $value["our_comm_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["our_comm_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?></span>
								<span id="edit_our_comml<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="our_comm_type<?php echo $value["id"]?>" id="our_comm_typel<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="our_comm_value<?php echo $value["id"]?>" id="our_comm_valuel<?php echo $value["id"]?>" value="" />
				  </span>
								
								 
								
								</td>
								 <td>
								 <span id="view_agent_comml<?php echo $value["id"]?>" >
								 <?php echo $value["agent_comm_value"];?>
								 
								 
								 &nbsp;
								<?php
								if( $value["agent_comm_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["agent_comm_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?></span>
								
								<span id="edit_agent_comml<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="agent_comm_type<?php echo $value["id"]?>" id="agent_comm_typel<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="agent_comm_value<?php echo $value["id"]?>" id="agent_comm_valuel<?php echo $value["id"]?>" value="" />
				  </span>
								
								 </td>
								 <td>
								  <span id="view_agent_ref_comml<?php echo $value["id"]?>" ><?php echo $value["agent_ref_comm_value"];?>
								 
								  &nbsp;
								<?php
								if( $value["agent_ref_comm_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["agent_ref_comm_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?></span>
<span id="edit_agent_ref_comml<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="agent_ref_comm_type<?php echo $value["id"]?>" id="agent_ref_comm_typel<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="agent_ref_comm_value<?php echo $value["id"]?>" id="agent_ref_comm_valuel<?php echo $value["id"]?>" value="" />
				  </span>								
								 </td>
								  <td>
								   <span id="view_mark_comml<?php echo $value["id"]?>" >
								   <?php echo $value["mark_comm_value"];?>
								 
								  &nbsp;
								<?php
								if( $value["mark_comm_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["mark_comm_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?>	</span>	
								<span id="edit_mark_comml<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="mark_comm_type<?php echo $value["id"]?>" id="mark_comm_typel<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="mark_comm_value<?php echo $value["id"]?>" id="mark_comm_valuel<?php echo $value["id"]?>" value="" />
				  </span>	
								
								 </td>
								 <td>
								  <span id="view_dis_comml<?php echo $value["id"]?>" >
								  <?php echo $value["dis_value"];?>
								 
								  &nbsp;
								<?php
								if( $value["dis_type"] == "PEC")
								{
									echo "(%)";
								}
								else if ($value["dis_type"] == "INR" )
								{
									echo "(INR)";
								}
								else
								{
									
								}
								?></span>

<span id="edit_dis_comml<?php echo $value["id"]?>" style='display:none'>
								<select class="input-sm" name="dis_comm_type<?php echo $value["id"]?>" id="dis_comm_typel<?php echo $value["id"]?>">
                    <option value=""></option>
                    <option value="INR" >Rs</option>
                    <option value="PEC" >%</option>
                  </select>	
				  <input type="text" class="input-sm" size="4" name="dis_comm_value<?php echo $value["id"]?>" id="dis_comm_valuel<?php echo $value["id"]?>" value="" />
				  </span>									
								 </td>
								 
                                <td><a class="editcommlimoffer" id="<?php echo $value["id"]?>" href='javascript:;'>Edit</a>&nbsp;&nbsp;<a onclick="return confirm('Are you sure?')" href='deletecommlimoffer?id=<?php echo $value["id"]?>'>Delete</a></td>
								</tr>
							<?php }
							?>
            
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<script>
$(document).ready(function(){
	
	$('#myTable').DataTable();
	
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
		
		
		
		$(document).on('click','.editcommlimoffer', function(event){	
			id = $(this).attr("id");
			this1 = $(this);
			if($(this).text() == "Edit")
			{
				//fetch data to display
				
				$.ajax({
		  url:"http://laabus.com/adminnew/dashboard/get_offer_comm_by_id" ,
		  data:{id:id},
		  success:function(data) {
			 //return data; 
			  data = JSON.parse(data);
				$("#edit_our_comml"+id).show();
				$("#view_our_comml"+id).hide();		
				$("#our_comm_typel"+id).val(data[0].our_comm_type);
				$("#our_comm_valuel"+id).val(data[0].our_comm_value);
				
				$("#edit_agent_comml"+id).show();
				$("#view_agent_comml"+id).hide();
				$("#agent_comm_typel"+id).val(data[0].agent_comm_type);
				$("#agent_comm_valuel"+id).val(data[0].agent_comm_value);				
				
				$("#edit_agent_ref_comml"+id).show();
				$("#view_agent_ref_comml"+id).hide();
				$("#agent_ref_comm_typel"+id).val(data[0].agent_ref_comm_type);
				$("#agent_ref_comm_valuel"+id).val(data[0].agent_ref_comm_value);
				
				$("#edit_mark_comml"+id).show();
				$("#view_mark_comml"+id).hide();
				$("#mark_comm_typel"+id).val(data[0].mark_comm_type);
				$("#mark_comm_valuel"+id).val(data[0].mark_comm_value);	
				
				$("#edit_dis_comml"+id).show();
				$("#view_dis_comml"+id).hide();
				$("#dis_comm_typel"+id).val(data[0].dis_type);
				$("#dis_comm_valuel"+id).val(data[0].dis_value);	
		  }
	   });
	   
				
				this1.text("Save");
			}
			else
			{
				//save the data into DB.
				our_comm_type = $("#our_comm_type"+id).val();
				our_comm_value = $("#our_comm_value"+id).val();
				agent_comm_type = $("#agent_comm_type"+id).val();
				agent_comm_value = $("#agent_comm_value"+id).val();
				agent_ref_comm_type = $("#agent_ref_comm_type"+id).val();
				agent_ref_comm_value = $("#agent_ref_comm_value"+id).val();
				mark_comm_type = $("#mark_comm_type"+id).val();
				mark_comm_value = $("#mark_comm_value"+id).val();
				dis_comm_type = $("#dis_comm_type"+id).val();
				dis_comm_value = $("#dis_comm_value"+id).val();
				$.ajax({
		  url:"http://laabus.com/adminnew/dashboard/update_comm_by_id",
		  data:{id:id,our_comm_type:our_comm_type,our_comm_value:our_comm_value,agent_comm_type:agent_comm_type,agent_comm_value:agent_comm_value,agent_ref_comm_type:agent_ref_comm_type,agent_ref_comm_value:agent_ref_comm_value,mark_comm_type:mark_comm_type,mark_comm_value:mark_comm_value,dis_comm_type:dis_comm_type,dis_comm_value:dis_comm_value},
		  success:function(data) {
			 //return data;

			 $("#view_our_comm"+id).show();
				$("#edit_our_comm"+id).hide();				
				ty = $("#our_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#our_comm_value"+id).val() + " (INR)";
					$("#view_our_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#our_comm_value"+id).val() + " (%)";
					$("#view_our_comm"+id).text(data);
				}
				else
				{
					data = $("#our_comm_value"+id).val() + "( )";
					$("#view_our_comm"+id).text(data);
				}
				
				
				$("#edit_agent_comm"+id).hide();
				$("#view_agent_comm"+id).show();
				ty = $("#agent_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#agent_comm_value"+id).val() + " (INR)";
					$("#view_agent_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#agent_comm_value"+id).val() + " (%)";
					$("#view_agent_comm"+id).text(data);
				}
				else
				{
					data = $("#agent_comm_value"+id).val() + "( )";
					$("#view_agent_comm"+id).text(data);
				}
				
				
				
				$("#edit_agent_ref_comm"+id).hide();
				$("#view_agent_ref_comm"+id).show();
ty = $("#agent_ref_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#agent_ref_comm_value"+id).val() + " (INR)";
					$("#view_agent_ref_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#agent_ref_comm_value"+id).val() + " (%)";
					$("#view_agent_ref_comm"+id).text(data);
				}
				else
				{
					data = $("#agent_ref_comm_value"+id).val() + "( )";
					$("#view_agent_ref_comm"+id).text(data);
				}				
				$("#edit_mark_comm"+id).hide();
				$("#view_mark_comm"+id).show();
				ty = $("#mark_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#mark_comm_value"+id).val() + " (INR)";
					$("#view_mark_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#mark_comm_value"+id).val() + " (%)";
					$("#view_mark_comm"+id).text(data);
				}
				else
				{
					data = $("#mark_comm_value"+id).val() + "( )";
					$("#view_mark_comm"+id).text(data);
				}				
				$("#edit_dis_comm"+id).hide();
				$("#view_dis_comm"+id).show();
				ty = $("#dis_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#dis_comm_value"+id).val() + " (INR)";
					$("#view_dis_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#dis_comm_value"+id).val() + " (%)";
					$("#view_dis_comm"+id).text(data);
				}
				else
				{
					data = $("#dis_comm_value"+id).val() + "( )";
					$("#view_dis_comm"+id).text(data);
				}
				this1.text("Edit");
			 	
		  }
	   });
	   
	   
				
				
				
				
				
			}
	})	
	$(document).on('click','.editcomm', function(event){	
			id = $(this).attr("id");
			this1 = $(this);
			if($(this).text() == "Edit")
			{
				//fetch data to display
				
				$.ajax({
		  url:"http://laabus.com/adminnew/dashboard/get_comm_by_id" ,
		  data:{id:id},
		  success:function(data) {
			 //return data; 
			  data = JSON.parse(data);
				$("#edit_our_comm"+id).show();
				$("#view_our_comm"+id).hide();		
				$("#our_comm_type"+id).val(data[0].our_comm_type);
				$("#our_comm_value"+id).val(data[0].our_comm_value);
				
				$("#edit_agent_comm"+id).show();
				$("#view_agent_comm"+id).hide();
				$("#agent_comm_type"+id).val(data[0].agent_comm_type);
				$("#agent_comm_value"+id).val(data[0].agent_comm_value);				
				
				$("#edit_agent_ref_comm"+id).show();
				$("#view_agent_ref_comm"+id).hide();
				$("#agent_ref_comm_type"+id).val(data[0].agent_ref_comm_type);
				$("#agent_ref_comm_value"+id).val(data[0].agent_ref_comm_value);
				
				$("#edit_mark_comm"+id).show();
				$("#view_mark_comm"+id).hide();
				$("#mark_comm_type"+id).val(data[0].mark_comm_type);
				$("#mark_comm_value"+id).val(data[0].mark_comm_value);	
				
				$("#edit_dis_comm"+id).show();
				$("#view_dis_comm"+id).hide();
				$("#dis_comm_type"+id).val(data[0].dis_type);
				$("#dis_comm_value"+id).val(data[0].dis_value);	
		  }
	   });
	   
				
				this1.text("Save");
			}
			else
			{
				//save the data into DB.
				our_comm_type = $("#our_comm_type"+id).val();
				our_comm_value = $("#our_comm_value"+id).val();
				agent_comm_type = $("#agent_comm_type"+id).val();
				agent_comm_value = $("#agent_comm_value"+id).val();
				agent_ref_comm_type = $("#agent_ref_comm_type"+id).val();
				agent_ref_comm_value = $("#agent_ref_comm_value"+id).val();
				mark_comm_type = $("#mark_comm_type"+id).val();
				mark_comm_value = $("#mark_comm_value"+id).val();
				dis_comm_type = $("#dis_comm_type"+id).val();
				dis_comm_value = $("#dis_comm_value"+id).val();
				$.ajax({
		  url:"http://laabus.com/adminnew/dashboard/update_comm_by_id",
		  data:{id:id,our_comm_type:our_comm_type,our_comm_value:our_comm_value,agent_comm_type:agent_comm_type,agent_comm_value:agent_comm_value,agent_ref_comm_type:agent_ref_comm_type,agent_ref_comm_value:agent_ref_comm_value,mark_comm_type:mark_comm_type,mark_comm_value:mark_comm_value,dis_comm_type:dis_comm_type,dis_comm_value:dis_comm_value},
		  success:function(data) {
			 //return data;

			 $("#view_our_comm"+id).show();
				$("#edit_our_comm"+id).hide();				
				ty = $("#our_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#our_comm_value"+id).val() + " (INR)";
					$("#view_our_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#our_comm_value"+id).val() + " (%)";
					$("#view_our_comm"+id).text(data);
				}
				else
				{
					data = $("#our_comm_value"+id).val() + "( )";
					$("#view_our_comm"+id).text(data);
				}
				
				
				$("#edit_agent_comm"+id).hide();
				$("#view_agent_comm"+id).show();
				ty = $("#agent_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#agent_comm_value"+id).val() + " (INR)";
					$("#view_agent_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#agent_comm_value"+id).val() + " (%)";
					$("#view_agent_comm"+id).text(data);
				}
				else
				{
					data = $("#agent_comm_value"+id).val() + "( )";
					$("#view_agent_comm"+id).text(data);
				}
				
				
				
				$("#edit_agent_ref_comm"+id).hide();
				$("#view_agent_ref_comm"+id).show();
ty = $("#agent_ref_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#agent_ref_comm_value"+id).val() + " (INR)";
					$("#view_agent_ref_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#agent_ref_comm_value"+id).val() + " (%)";
					$("#view_agent_ref_comm"+id).text(data);
				}
				else
				{
					data = $("#agent_ref_comm_value"+id).val() + "( )";
					$("#view_agent_ref_comm"+id).text(data);
				}				
				$("#edit_mark_comm"+id).hide();
				$("#view_mark_comm"+id).show();
				ty = $("#mark_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#mark_comm_value"+id).val() + " (INR)";
					$("#view_mark_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#mark_comm_value"+id).val() + " (%)";
					$("#view_mark_comm"+id).text(data);
				}
				else
				{
					data = $("#mark_comm_value"+id).val() + "( )";
					$("#view_mark_comm"+id).text(data);
				}				
				$("#edit_dis_comm"+id).hide();
				$("#view_dis_comm"+id).show();
				ty = $("#dis_comm_type"+id).val();
				if(ty == "INR")
				{
					data = $("#dis_comm_value"+id).val() + " (INR)";
					$("#view_dis_comm"+id).text(data);
				}
				else if(ty == "PEC")
				{
					data = $("#dis_comm_value"+id).val() + " (%)";
					$("#view_dis_comm"+id).text(data);
				}
				else
				{
					data = $("#dis_comm_value"+id).val() + "( )";
					$("#view_dis_comm"+id).text(data);
				}
				this1.text("Edit");
			 	
		  }
	   });
	   
	   
				
				
				
				
				
			}
	})	
		
	$(document).on('change','#sel_cat_id', function(event){	
	catid = $(this).val();
	if(catid == 2 )
	{
		catid = 22;
	}
		$(".subcathide").show();
		/*$.ajax({
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
	   });*/
	})
})
</script>
