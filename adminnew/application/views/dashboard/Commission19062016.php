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
                <div class="row subcathide">
                  <div class="col-lg-12" id="subcatdiv">
                   
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
          <table class="table table-hover">
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
							
                             <td><?php echo $value["cat_name"];?></td>
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
                                <td><?php echo $value["our_comm_value"];?>
								 
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
								?>
								</td>
								 <td><?php echo $value["agent_comm_value"];?>
								 
								 
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
								?>
								 </td>
								 <td><?php echo $value["agent_ref_comm_value"];?>
								 
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
								?>							
								 </td>
								  <td><?php echo $value["mark_comm_value"];?>
								 
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
								?>							
								 </td>
								 <td><?php echo $value["dis_value"];?>
								 
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
								?>							
								 </td>
								 
                                <td><a href='#'>Edit</a>&nbsp;&nbsp;<a onclick="return confirm('Are you sure?')" href='deletecomm?id=<?php echo $value["id"]?>'>Delete</a></td>
								</tr>
							<?php }
							?>
            <!--  <tr ng-repeat="operator in operators">
                <td>{{operator.operator_code}}</td>
                <td>{{operator.operator_name}}</td>
                <td><select class="input-sm" name="our_cal_type" ng-model="our_cal_type">
                    <option value="R" ng-selected="{{operator.our_commission_amount!=null}}">Rs</option>
                    <option value="P" ng-selected="{{operator.our_commission_percentage!=null}}">%</option>
                  </select>
                  <input type="text" class="input-sm" name="our_amount" size="5" value="{{operator.our_commission_percentage!=null ? operator.our_commission_percentage : operator.our_commission_amount}}"/></td>
                <td><select class="input-sm" name="agent_cal_type">
                    <option value="R" ng-selected="{{operator.agent_commission_amount!=null}}">Rs</option>
                    <option value="P" ng-selected="{{operator.agent_commission_percentage!=null}}">%</option>
                  </select>
                  <input type="text" class="input-sm" name="agent_amount" size="5"  value="{{operator.agent_commission_percentage!=null ? operator.agent_commission_percentage : operator.agent_commission_amount }}"/></td>
                <td><select class="input-sm" name="mark_cal_type">
                    <option value="R" ng-selected="{{operator.markup_commission_amount!=null}}">Rs</option>
                    <option value="P" ng-selected="{{operator.markup_commission_percentage!=null}}">%</option>
                  </select>
                  <input type="text" class="input-sm" name="mark_amount" size="5"   value="{{operator.markup_commission_percentage!=null ? operator.markup_commission_percentage : operator.markup_commission_amount }}"/></td>
                <td><select class="input-sm" name="discount_cal_type">
                    <option value="R" ng-selected="{{operator.discount_amount!=null}}">Rs</option>
                    <option value="P" ng-selected="{{operator.discount_percentage!=null}}">%</option>
                  </select>
                  <input type="text" class="input-sm" name="discount_amount" size="5"  value="{{operator.discount_percentage!=null ? operator.discount_percentage : operator.discount_amount }}"/></td>
                <td><button class="btn btn-primary btn-xs update dim" type="button" data-oid="{{operator.operator_id}}"><i class="fa fa-check"></i>&nbsp;Update</button></td>
              </tr>-->
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
