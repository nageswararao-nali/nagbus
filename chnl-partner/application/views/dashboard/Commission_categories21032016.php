<div class="wrapper wrapper-content animated fadeInRight" ng-controller="categoryCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Category wise commision</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="ibox-content">
                <!--    <form class="form-horizontal" id="create_category"> -->					
				<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'save_comm_cat'); 
				echo form_open('Dashboard/Save_comm_cat',$attributes);
				
				?>
                                            
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Select Category</label>
                            <div class="col-lg-10">
                                
								<select  class="form-control" name="cat_id">
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
						
						 <div class="form-group">
							 <label class="col-lg-2 control-label">Our Commision</label>
                            <div class="col-lg-5">
                                
								<select  class="form-control" name="our_comm_type">
									<option value="">Select</option>
									<option value="%">%</option>
									<option value="INR">INR</option>
										
								</select>
                            </div>
							<div class="col-lg-5">
                                <input type="text" placeholder="Our Commision Value " class="form-control" name="our_comm_value">
                            </div>							
						 </div>
						 
						 
						 <div class="form-group">
							 <label class="col-lg-2 control-label">Agent Commision</label>
                            <div class="col-lg-5">
                                
								<select  class="form-control" name="agent_comm_type">
									<option value="">Select</option>
									<option value="%">%</option>
									<option value="INR">INR</option>
										
								</select>
                            </div>
							<div class="col-lg-5">
                                <input type="text" placeholder="Agent Commision Value " class="form-control" name="agent_comm_value">
                            </div>							
						 </div>
						 
						 
						 <div class="form-group">
							 <label class="col-lg-2 control-label">Agent Reference Commision</label>
                            <div class="col-lg-5">
                                
								<select  class="form-control" name="agent_ref_comm_type">
									<option value="">Select</option>
									<option value="%">%</option>
									<option value="INR">INR</option>
										
								</select>
                            </div>
							<div class="col-lg-5">
                                <input type="text" placeholder="Agent Reference Commision Value " class="form-control" name="agent_ref_comm_value">
                            </div>							
						 </div>
						 
						 
						 
						
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Notes/Comments</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Commision Description" class="form-control" name="description">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-white" type="reset">Reset</button>
                                <button class="btn btn-sm btn-white" type="submit">Save</button>
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
                    <h5>All Commision Category wise Table </h5>

                </div>				
                <div class="ibox-content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Our Commission</th>
								 <th>Agent Commission</th>
								 <th>Agent Reference Commission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tblCategories">
							<?php
							foreach($comm_detils as $key=>$value)
							{							
							?>
							
							<tr>
                             <td><?php echo $value["cat_name"];?></td>
                                <td><?php echo $value["our_comm_value"];?></td>
								 <td><?php echo $value["agent_comm_value"];?></td>
								 <td><?php echo $value["agent_ref_comm_value"];?></td>
                                <td><a href='#'>Edit</a>&nbsp; <a href='#'>Delete</a></td>
							</tr>
							<?php }
							?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).on('submit', '#create_category', function() {
        $.ajax({
            url: baseurl + 'Categories/create_category',
            data: $(this).serialize(),
            type: 'POST',
            cache: false,
            success: function(res) {
                $("#create_category").trigger("reset");
            }
        })
        return false;
    })
</script>
<script>
    $(document).ready(function() {
        $("#create_category").validate({
            rules: {
                moduleid: {
                    required: true,
                },
                name: {
                    required: true,
                }
            }
        });
    });


</script>