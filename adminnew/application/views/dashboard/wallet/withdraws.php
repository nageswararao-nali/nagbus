<div class="wrapper wrapper-content animated fadeInRight" ng-controller="operatorCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Wallet History </h5>
                    <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a> </li>
                            <li><a href="#">Config option 2</a> </li>
                        </ul>
                        <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>created by</th>                                
                                <th>Amount</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Bank Name</th>
                                <th>IFSC Code</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody class="tblCategories">
                            <?php
                            foreach ($wallet_withdraws as $wallet) {
                                ?>
                                <tr id="d<?php echo $wallet['wallet_withdraw_id']?>">
                                    <td><?= $wallet['wallet_withdraw_id'] ?></td>
                                    <td><?= !empty($wallet['name']) ? $wallet['name'] . '(' . $wallet['email_id'] . ')' : $wallet['email_id']; ?></td>
                                    <td><?= $wallet['amount'] ?></td>
                                    <td><?= $wallet['account_number'] ?></td>
                                    <td><?= $wallet['account_name'] ?></td>
                                    <td><?= $wallet['bank_name'] ?></td>
                                    <td><?= $wallet['ifsc_code'] ?></td>
                                    <td><?= date("d-m-Y", strtotime($wallet['create_dt'])) ?></td>                                    
                                    <td><select class="withdrawclass" data-id="<?php echo $wallet['wallet_withdraw_id']?>">
                                    <option value=''>Select</option>
                                    <option value='1' <?php if($wallet['paidstatus'] == 1 ) echo "selected"?>>Paid</option>
                                    <option value='2'<?php if($wallet['paidstatus'] ==2 ) echo "selected"?> >Unpaid</option>= 
                                    </select></td>
                                    <td><a href="javascript:;" class="ddelete" id="<?php echo $wallet['wallet_withdraw_id']?>">Delete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
              </div>
            </div>
        </div>
    </div>

</div>

<script src="http://laabus.com/adminnew/admin_assets/js/jquery.dataTables.min.js"></script>
<script src="http://laabus.com/adminnew/admin_assets/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
                            $("#example").DataTable({
                                "order": []
                            });
                            
                            
                            
                            
                            $(document).on('click', ".ddelete", function () {
					id = $(this).attr("id");
					
					$("#d"+id).addClass("selectedrow");
					if(confirm('Are you sure want to delete this record?'))
					{
						
						$.ajax({
						url: 'http://laabus.com/adminnew/Wallet/deletewalletwithdrawnrecord',
						data: {id:id,hid:2},
						type: 'POST',
						cache: false,
						success: function(res) {				
						$("#example").dataTable().fnDestroy();
						 table = $('#example').DataTable( {
							//searching: false
							}); 
						var rows = table
						    .rows( '.selectedrow' )
						    .remove()
						    .draw();
						}
						})
					}
					else
					{
						
					}
				})
                            
                            
                            $(document).on('change', '.withdrawclass', function(){
                            id = $(this).data("id");
                            status= $(this).val();
                            
                            
                            $.ajax({
						url: 'http://laabus.com/adminnew/Wallet/changewithdrawnstatus',
						data: {id:id,status:status},
						type: 'POST',
						cache: false,
						success: function(res) {				
						if(res == "Success")
						{
							alert("Data Updated successfully.")
						}
						}
						})
                            
                            });
                            
                            
                            
                        } );
		</script>