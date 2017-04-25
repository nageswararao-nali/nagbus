<div class="wrapper wrapper-content animated fadeInRight" ng-controller="supportmatrixCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Support Matrix </h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="ibox-content">
				<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'create_supportmatrix'); echo form_open('Supportmatrix/create_supportmatrix',$attributes); ?>
                        <p>Add new Support Matrix</p>

						
						 <div class="form-group">
                            <label class="col-lg-2 control-label">Role</label>
                            <div class="col-lg-10">
                                <!--<input type="text" placeholder="Name" class="form-control" name="name">-->
								<select name='role_id' id='role_id' class="form-control">
									<option value=''>Select</option>
									<option value=6>Agent</option>
									<option value=2>Channel Partner</option>
									<option value=5>SMD</option>
									<option value=4>Direct User</option>
								</select>
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label class="col-lg-2 control-label">Support Type</label>
                            <div class="col-lg-10">
                                <!--<input type="text" placeholder="Name" class="form-control" name="name">-->
								<select name='support_type' id='support_type' class="form-control">
									<option value=''>Select</option>	
									<option value='Sales'>Sales</option>
									<option value='Support'>Support</option>
									<option value='Billing'>Billing</option>
									
								</select>
                            </div>
                        </div>
						
						
						
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Name" class="form-control" name="email" id="email">
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label class="col-lg-2 control-label">Contact #</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Name" class="form-control" name="contact_no" id="contact_no">
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label class="col-lg-2 control-label">Timings</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Name" class="form-control" name="timings" id="timings">
                            </div>
                        </div>
						
						
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Comments</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="comments Description" class="form-control" name="comments" id="comments">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-white" type="reset">Reset</button>
                                <button class="btn btn-sm btn-white" type="submit">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Support Matrix</h5>
<!--                    <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a> </li>
                            <li><a href="#">Config option 2</a> </li>
                        </ul>
                        <a class="close-link"> <i class="fa fa-times"></i> </a> </div>-->
                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Type/Role</th>
								<th>Support Type</th>
								<th>Contact Number</th>
								<th>Email</th>
                                <th>Timings</th>                                
								<th>Comments</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tblCategories">
                            <tr ng-repeat="support_matrix in categories">
                               <!-- <td>{{category.cat_id}}</td>
                                <td>{{category.cat_name}}</td>

                                <td><font color="green" ng-show="category.enable == 1">Active</font>
                                    <font color="red" ng-show="category.enable == 0">Inactive</font></td>
                                <td><a href="/adminnew/Categories/edit_category/{{category.cat_id}}">Edit</a> - <a href="" class="btn btn-white btn-sm deleteAction" title="Click me to delete" ng-click="delete(category.cat_id)" confirm="Are you sure, {{name}}?"><i class="fa fa-times"></i> Delete</a></td>-->
								<td>{{support_matrix.id}}</td>
								<td>
                                    <font color="green" ng-show="support_matrix.role_id == '2' ">Channel Partner</font>
									<font color="green" ng-show="support_matrix.role_id == '5' ">SMD</font> 
									<font color="green" ng-show="support_matrix.role_id == '4' ">Direct User</font> 
									<font color="green" ng-show="support_matrix.role_id == '6' ">Agent</font>									
								</td>							
									
								<td><font color="green" ng-show="support_matrix.support_type == 'Sales' ">Sales</font>
                                    <font color="green" ng-show="support_matrix.support_type == 'Support' ">Support</font>
									<font color="green" ng-show="support_matrix.support_type == 'Billing' ">Billing</font>                                 
								</td>
								<td>{{support_matrix.contact_no}}</td>
								<td>{{support_matrix.email}}</td>
								<td>{{support_matrix.timings}}</td>
								<td>{{support_matrix.comments}}</td>
								<td><a class="btn btn-white btn-sm editAction" href="/adminnew/Supportmatrix/edit_supportmatrix/{{support_matrix.id}}">Edit</a> - <a href="" class="btn btn-white btn-sm deleteAction" title="Click me to delete" ng-click="delete(support_matrix.id)" confirm="Are you sure to delete it?"><i class="fa fa-times"></i> Delete</a></td>
							</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).on('submit', '#create_supportmatrix', function() {
        $.ajax({
            url: baseurl + 'Supportmatrix/create_supportmatrix',
            data: $(this).serialize(),
            type: 'POST',
            cache: false,
            success: function(res) {
               // $("#create_supportmatrix").trigger("reset");
			   location.reload();
            }
        })
        return false;
    })
</script>
<script>
    $(document).ready(function() {
        $("#create_supportmatrix").validate({
            rules: {
                role_id: {
                    required: true,
                },
				support_type: {
                    required: true,
                },
				contact_no: {
                    required: true,
                },
				timings: {
                    required: true,
                },
                email: {
                    required: true,
                },
				 comments: {
                    required: true,
                }
            }
        });
    });


</script>