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
                                <th>Reference Number</th>
                                <th>Transfer Type</th>
                                <th>Payment Status</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody class="tblCategories">
                            <?php
                            $status = array(0 => 'Pending', 1 => 'Decline', 2=>'Approve', 'Success');
                            foreach ($wallet_history as $wallet) {
                                ?>
                                <tr>
                                    <td><?= $wallet['wallet_history_id'] ?></td>
                                    <td><?= !empty($wallet['name']) ? $wallet['name'] . '(' . $wallet['email_id'] . ')' : $wallet['email_id']; ?></td>
                                    <td><?= $wallet['amount'] ?></td>
                                    <td><?= $wallet['reference_number'] ?></td>
                                    <td><?= (($wallet['transfer_type'] == 1) ? 'Account' : 'Deposit') ?></td>
                                    <td><?= $status[$wallet['payment_status']] ?></td>
                                    <td><?= $wallet['create_dt'] ?></td>
                                    <td>
                                        <?php if ($wallet['payment_status'] == 0) { ?>
                                            <a href="<?= base_url('wallet/requests_edit/' . $wallet['wallet_history_id']) ?>">Edit</a>
                                        <?php } elseif ($wallet['payment_status'] == 1) { ?>                                    
                                            <a href="<?= base_url('wallet/requests_declined/' . $wallet['wallet_history_id']) ?>">View</a>
                                        <?php } ?>  
                                                                       
                                        
                                        <a href="javascript:;"  <?php /*?>data-id="<?php echo $chrole['wallet_history_id']; ?>"<?php */?> class="btn btn-white btn-sm deleteAction" title="Click me to delete" ><i class="fa fa-times"></i> Delete</a>
                                        
                                        
                                         </td>
                                    
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
$( document ).ready(function() {
    console.log( "ready!" );
	$(document).on('click', '.deleteAction', function(){		
		id = $(this).data("id");
		
		if(confirm('Are you sure want to delete this record?'))
			{
				//id = $(this).attr("custdata");				
				$.ajax({
				url: baseurl + 'Offer/delete_users_ByAdmin',
				data: {wallet_history_id:id},
				type: 'POST',
				cache: false,
				success: function(res) {              
				  $("#chnl"+id).addClass("selected");	
				$("#example").dataTable().fnDestroy(); 
				table = $('#example').DataTable( {
				//searching: false
				} );
				
				var rows = table
			.rows( '.selected' )
			.remove()
			.draw();
						}
					})
			
			}

	});
});
</script>