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
                    <label class="col-lg-4 control-label">Circle</label>
                    <div class="col-lg-8">
                       <select name="state_id">
					   <option value="AP">Andhra Pradesh & Telangana</option>
					   <option value="AS">Assam</option>
					   <option value="BR">Bihar & Jharkhand</option>
					   <option value="Chennai">Chennai</option>
					   <option value="Delhi">Delhi NCR</option>
					   <option value="GJ">Gujarat</option>
					   <option value="HP">Himachal Pradesh</option>
					   <option value="HR">Haryana</option>
					   <option value="JK">Jammu & Kashmir</option>
					   <option value="KA">Karnataka</option>
					   <option value="KL">Kerala</option>
					   <option value="Kolkata">Kolkata</option>
					   <option value="MH">Maharashtra & Goa</option>
					   <option value="MP">Madhya Pradesh & Chhattisgarh</option>
					   <option value="Mumbai">Mumbai</option>
					   <option value="NE">North East</option>
					   <option value="OR">Odisha</option>
					   <option value="PB">Punjab</option>
					   <option value="RJ">Rajasthan</option>
					   <option value="TN">Tamil Nadu</option>
					   <option value="UPE">Uttar Pradesh East</option>
					   <option value="UPW">Uttar Pradesh West & Uttarakhand</option>
					   <option value="WB">West Bengal</option>
					   
					   </select>
                    </div>
                </div>
               
            </div>
        </div>
		
		
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
                    <!--<button class="btn btn-sm btn-white" type="reset">Reset</button>
                    <a class="btn btn-sm btn-white" id="back" href="#">Back</a>-->
                    <button class="btn btn-sm btn-white" type="submit">Upload</button>
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
                    <h5>Browse Plans</h5>
                </div>
                <div class="ibox-content">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Operator</th>
                                <th>Circle</th>
                                <th>Plan Type</th>
                                <th>Talk Time/Price</th>
                                <th>Validity</th>
                                <th>Description</th>                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($browse_plan as $data) { ?>
                                <tr id="chnl<?php echo $data->category_name; ?>">
                                    
                                    <td><?php echo $data->operator_name; ?></td>
                                    <td><?php echo $data->circle_name; ?></td>
									
                                    <td><?php echo $data->category_name; ?></td>
                                    <td><?php echo $data->talktime; ?>/<?php echo $data->price; ?></td>		
                                    <td><?php echo $data->validity; ?></td>
                                    <td><?php echo $data->benifits; ?></td>                                     
                                    <td>N/A</td>
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
	table = $('#example').DataTable( {
				//searching: false
				} );
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