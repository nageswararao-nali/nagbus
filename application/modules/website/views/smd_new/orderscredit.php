<style>
.ibox-content {overflow:auto;}
</style>
<?php $this->load->view('website/smd_new/menu_block.php')?>

<h4>Your Order Details:</h4>

 <div class="ibox-content">


				<?php echo form_open(base_url() . 'smd/Creditorders', array('class' => 'form-horizontal', 'id' => 'Orders')); ?>


				 <div class="form-group col-lg-6">
                <div class="row1">
                  <label class="col-lg-12">Select Mark as Credit Status</label>
                </div>
                <div class="row1">
                  <div class="col-lg-3">
                   <select  class="form-control" name="mark_as_credit_user" id="mark_as_credit_user">
									<option value="">All</option>
									<option value="1">Not Paid</option>
									<!--<option value="3">Partially Paid</option>-->
									<option value="2">Paid</option>

								</select>
                  </div>
                </div>
              </div>


				 <div class="form-group col-lg-6">
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
			  <div style="clear:both"> </div>

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
				 <a href="<?= base_url() ?>smd/Creditorders"> <input type="button" name="reset" id="reset" value="Show All"></a>
				 &nbsp;&nbsp; <a onclick="checkit()" href="javascript:void(0)"> <input type="button" name="changestatus" id="changestatus" value="Change Status"></a>
                  <!--javascript:$('#model_po').modal('show');-->
				  </div>


                </div>
              </div>


</form>         		 <hr/>



			<script>
			function checkit()
			{
				if($('.chkcreditrow:checked').size() == 0 )
				{
					$('#model_alert').modal('show');
				}
				else
				{
					$('#model_po').modal('show');
				}
			}
			</script>


			<?php echo form_open(base_url() . 'smd/Creditordersstatus', array('class' => 'form-horizontal', 'id' => 'Ordersst')); ?>
			<div id="model_po" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:green">Change Status  of Selected Orders</h4>
      </div>
      <div class="modal-body" >
		<input type="hidden" name="id" id="id">
		<input type="hidden" name="mode" value="delete">
			<h4>Change Status to: </h4>
			<select  class="form-control" name="mark_as_credit_user_update" id="mark_as_credit_user_update">
									<option value="1">Not Paid</option>
									<!--<option value="3">Partially Paid</option>-->
									<option value="2">Paid</option>

								</select>
      </div>
      <div class="modal-footer">
        <!--<button type="button"  class="btn btn-default classwalkin" data-dismiss="modal">Save</button>-->
		 <button type="submit"  class="btn btn-success " >Update</button>
		  <button type="button"  class="btn btn-default classcancel" data-dismiss="modal">Cancel</button>
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
        <h4 class="modal-title" style="color:red">Alert</h4>
      </div>
      <div class="modal-body" >
		<input type="hidden" name="id" id="id">
		<input type="hidden" name="mode" value="delete">
			<h4>Please tick atleast one Checkbox to change Status</h4>

      </div>
      <div class="modal-footer">
        <!--<button type="button"  class="btn btn-default classwalkin" data-dismiss="modal">Save</button>-->

		  <button type="button"  class="btn btn-default classcancel" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>

<?php
//print("<pre>");
//print_r($order_details);
?>
          <table class="table table-hover" >
            <thead>
              <tr class="text-center">
			 <!-- <th><input type="checkbox" id="chkcreditall" class="chkcreditall"></th>
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
				<th>Credit Status</th>-->
				<th><input type="checkbox" id="chkcreditall" class="chkcreditall"></th>
				<th>User</th>
				<th>Mobile No.</th>
				<th>Transaction ID</th>
				 <th>Category</th>
                <th>Operator</th>
				<th>Amount</th>
				<!--<th>Your Commission</th>
				<th>Your Commission Amount</th>-->
				<th>Transaction Date Time</th>
				<th>Comment</th>
				<th>Status</th>

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
				 <td><input value="<?php echo $value["sales_id"]?>" name="chkmarkasCredit[]" type="checkbox" id="chkcreditrow<?php echo $value["sales_id"]?>" class="chkcreditrow"></td>
				<td><?php echo $value["ordertouser"];?></td>
				<td><?php echo $value["mobile_no"];?></td>
				<td><?php echo $value["sales_id"]?></td>
				<td><?php echo $value["cat_name"]?></td>
			<td><?php echo $value["sub_cat_name"]?></td>

			<td><?php echo $value["amount"]?></td>



				<!--<td><?php
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


				<td><?php

				if( $value["end_user_id"] == $value["agent_id"] )
					{
						echo $value["agent_comm"];
					}
					else
					{
						echo $value["agent_ref_comm"];
					}
				?></td>-->
				<td><?php echo date("d/m/Y H:i:s",strtotime($value["order_date"]));?></td>
				<td><?php echo $value["mark_as_credit_comments"];?></td>
				<td><?php
				if( $value["mark_as_credit_user"] == 1 ) echo "Not Paid";
				if( $value["mark_as_credit_user"] == 2 ) echo "Paid";
				if( $value["mark_as_credit_user"] == 3 ) echo "Partially Paid";

				?></td>

				</tr>

			<?php }
			?>

			<tr>
				<td colspan=6><b>Grand Total</b></td>

                <td><b>&#8377;<?php echo number_format($tot_order_amt,2)?></b></td>

				<td ></td>

                <td><b><?php //echo number_format($grand_total_commision,2)?>  </b></td>
				<td></td>
			</tr>




            </tbody>
          </table>
        </div>
		</form>

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




	$('.chkcreditall').click(function(){
            if($(this).is(":checked")){
			   $(".chkcreditrow").prop('checked', true);
            }
            else if($(this).is(":not(:checked)")){
                 $(".chkcreditrow").prop('checked', false);
            }
        });

			 $(document).on('change','.chkcreditrow', function(event){
			 if($(this).is(":checked"))
			 {
				chkcreditall = 1;
			 }
			 else
			 {
				 chkcreditall = 0;
			 }

           $( '.chkcreditrow' ).each(function( index ) {
			if($(this).is(":checked")){
				chkcreditall = 1;
			}
			else
			{
				 chkcreditall = 0;
				 return  false;
			}
			});
			if(chkcreditall == 0)
				{
					$(".chkcreditall").prop('checked', false);
				}
				else
				{
					$(".chkcreditall").prop('checked', true);
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
