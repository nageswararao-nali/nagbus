<style>
    .ibox-content {
        overflow: auto;
    }
</style>

<?php $this->load->view('website/user/link_block.php')?>

    <h4>Your Order Details:</h4>

    <div class="ibox-content">


        <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'Orders')); ?>

            <hr/>


            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>S.No</th>
                        <th>Tin</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Seat</th>
                        <th>Fare</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
			       
               // print_r($ticket_details);
                                      //  echo "I am ok";
                                      //  exit;
									  $dob = '';
			foreach($passengers as $value)
			{
                    $value = get_object_vars($value);
					//$dob = date("Y-m-d", strtotime($value['date_of_Jrny']));
			?>
                        <tr>
                            <td>
                                <input type="checkbox" class="chktktcncl" name="seatName[]" id="seatName" value="<?php echo $value['seat_name'];?>">
                                <input type="hidden" name="tin" id="tin" value="<?php echo $value['tin'];?>">
                            </td>
                            <td>
                                <?php echo $value['tin'];?>
                            </td>
                            <td>
                                <?php echo $value['first_name']." ".$value['last_name'];?>
                            </td>
                            <td>
                                <?php echo $value["gender"]?>
                            </td>
                            <td>
                                <?php echo $value["age"];?>
                            </td>
                            <td>
                                <?php echo $value["seat_name"];?>
                            </td>
                            <td>
                                <?php echo $value["fair"];?>
                            </td>

                            <td>
                                <?php echo $value["status"];?>
                            </td>

                        </tr>
                        <?php } ?>

                </tbody>
            </table>
            <input type="submit" name="cancelation" id="cancelation" value="Submit">
            </form>






    </div>
	
	
	<div id="model_po" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:green">Bus cancellation policy:</h4>
      </div>
      <div class="modal-body" >
		<input type="hidden" name="id" id="id">
		<input type="hidden" name="mode" value="delete">
			<h4>Cancellation time Charges</h4>
			<?php
			$dob = $journey_date;
			$date = $dob;
$newdate = strtotime ( '-1 day' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-d' , $newdate );


			$date = $dob;
$newdate2 = strtotime ( '-2 day' , strtotime ( $date ) ) ;
$newdate2 = date ( 'Y-m-d' , $newdate2 );


$date = $dob;
$newdate3 = strtotime ( '-7 day' , strtotime ( $date ) ) ;
$newdate3 = date ( 'Y-m-d' , $newdate3 );
			?>
<p>Between <?php echo date("d/m/Y",strtotime($newdate));?> 8:00 AM between <?php echo date("d/m/Y",strtotime($dob));?> 8:00 AM 100%</p>

<p>Between <?php echo date("d/m/Y",strtotime($newdate2));?> 8:00 AM and <?php echo date("d/m/Y",strtotime($newdate));?> 8:00 AM 20%</p>

<p>Between <?php echo date("d/m/Y",strtotime($newdate3));?> 8:00 AM and <?php echo date("d/m/Y",strtotime($newdate2));?> 8:00 AM 15%</p>

<p>Before <?php echo date("d/m/Y",strtotime($newdate3));?> 8:00 AM 10%</p>

<p>* Partial cancellation is NOT allowed</p>
      </div>
      <div class="modal-footer">
        <!--<button type="button"  class="btn btn-default classwalkin" data-dismiss="modal">Save</button>
		 <button type="submit"  class="btn btn-success " >Update</button>-->
		  <button type="button"  class="btn btn-default classcancel" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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




    <script>
        $(document).ready(function () {
			
			
			$('.chktktcncl').click(function () {
                if ($(this).is(":checked")) {
                    //$(".chksubcat").prop('checked', true);
					$('#model_po').modal('show');
					
                } else if ($(this).is(":not(:checked)")) {
                   // $(".chksubcat").prop('checked', false);
				   $('#model_po').modal('hide');
                }
            });
			
			
			

            $('.chkall').click(function () {
                if ($(this).is(":checked")) {
                    $(".chksubcat").prop('checked', true);
                } else if ($(this).is(":not(:checked)")) {
                    $(".chksubcat").prop('checked', false);
                }
            });

            $(document).on('change', '.chksubcat', function (event) {
                if ($(this).is(":checked")) {
                    chkall = 1;
                } else {
                    chkall = 0;
                }

                $('.chksubcat').each(function (index) {
                    if ($(this).is(":checked")) {
                        chkall = 1;
                    } else {
                        chkall = 0;
                        return false;
                    }
                });
                if (chkall == 0) {
                    $(".chkall").prop('checked', false);
                } else {
                    $(".chkall").prop('checked', true);
                }
            });





            $(document).on('change', '#sel_cat_id', function (event) {
                catid = $(this).val();
                if (catid == 2) {
                    catid = 22;
                }
                $.ajax({
                    url: "populat_sub_cat_search",
                    data: {
                        catid: catid
                    },
                    success: function (data) {
                        //return data; 
                        $("#subcatdiv").html(data);
                        $(".subcathide").show();
                        if (data == '') {
                            alert("No Sub category found...")
                        }
                    }
                });
            })
        })
    </script>
    <style>
        .sub_cat_dis {
            width: 220px;
            float: left;
            padding: 5px;
        }
        
        .subcathide {
            display: none;
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
        $(function () {
            $('.datepickerDemo').datepicker()
        });
    </script>