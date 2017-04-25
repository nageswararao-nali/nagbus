<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Browse Plan</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li class="active"><strong>Browse Plan</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <?php echo form_open(base_url() . 'dashboard/browseplan/', array('class' => 'form-horizontal', 'id' => 'addAgents','enctype'=>'multipart/form-data')); ?>
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-6">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Upload Browse Plan</label>
                    <div class="col-lg-8">
                       <input type="file" name="userfile">
                    </div>
                </div>
               
            </div>
        </div><!--</div>-->
        <div class="col-lg-6">
            <div class="form-group">
                <div class="col-lg-offset-5">
                    <button class="btn btn-sm btn-white" type="reset">Reset</button>
                    <a class="btn btn-sm btn-white" id="back" href="#">Back</a>
                    <button class="btn btn-sm btn-white" type="submit">Create</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!--    <div class="row" ng-controller="moduleCtrl">-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Agents</h5>
                </div>
                <div class="ibox-content">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Name/Email Address</th>
                                <th>Mobile Number</th>
                                <th>Channel Partner</th>
                                <th>City</th>
                                <th>District</th>
                                <th>State</th>
                                <th>Pincode</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_details as $data) { ?>
                                <tr id="chnl<?php echo $data['user_id']; ?>">
                                    <td><a href="<?php echo base_url()?>dashboard/view_agent/<?php echo $data['user_id']; ?>"><?php echo $data['customer_id']; ?></a></td>
                                    <td><?php echo!empty($data['name']) ? $data['name'] . '(' . $data['email_id'] . ')' : $data['email_id']; ?></td>
                                    <td><?php echo $data['mobile']; ?></td>
                                    <td><?php echo $data['cname']; ?></td>
                                    <td><?php echo $data['city_name']; ?></td>
                                    <td><?php echo $data['district_name']; ?></td>
                                    <td><?php echo $data['state_name']; ?></td>
                                    <td><?php echo $data['pincode']; ?></td>
                                    <td>
                                        <?php if ($data['status'] == 1) { ?>
                                            <font color="green">Approved</font>
                                        <?php } else { ?>
                                            <font color="red">Approval Pending</font>
                                        <?php } ?>
                                    </td>
                                    <td><a href="<?php echo base_url()?>dashboard/add_user_money/<?php echo $data['user_id']; ?>/agent">Add Money</a> - 
									<a href="<?php echo base_url()?>dashboard/update_agent/<?php echo $data['user_id']; ?>">Edit</a> - <a href="javascript:;"  data-id="<?php echo $data['user_id']; ?>" class="btn btn-white btn-sm deleteAction" title="Click me to delete" ><i class="fa fa-times"></i> Delete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
				data: {user_id:id},
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