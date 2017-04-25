<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Agent</h5>
          <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
           			<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_agent');
					echo form_open('Agent/update_agent',$attributes); ?>
          <div class="form-group">
            <label class="col-lg-2 control-label">Agent Name</label>
            <div class="col-lg-10">
              <input type="text" placeholder="Name" class="form-control" name="name"  value="<?php echo $agent_edit[0]->name; ?>">
            </div>
          </div>
          <div class="form-group">          <label class="col-lg-2 control-label">Email</label>          <div class="col-lg-10">          <input type="email" placeholder="Email" class="form-control" name="Email" value="<?php echo $agent_edit[0]->email_id; ?>">          </div>          </div>		  		  <div class="form-group">          <label class="col-lg-2 control-label">Mobile No</label>          <div class="col-lg-10">          <input type="mobile" placeholder="Mobile Number" class="form-control" name="mobile_num" value="<?php echo $agent_edit[0]->mobile; ?>">          </div>         </div>		           <div class="form-group">           <label class="col-lg-2 control-label">District</label>           <div class="col-lg-10">           <input type="text" placeholder="District" class="form-control" name="district" value="<?php echo $agent_edit[0]->district_name; ?>" >           </div>           </div>
          <div class="form-group">           <label class="col-lg-2 control-label">Village</label>           <div class="col-lg-10">           <input type="text" placeholder="Village" class="form-control" name="Village">           </div>          </div>
           <div class="form-group">           <label class="col-lg-2 control-label">Pincode</label>            <div class="col-lg-10">            <input type="text" placeholder="Pincode" class="form-control" name="Pincode" value="<?php echo $agent_edit[0]->pincode; ?>">            <input type="hidden" value= <?php echo $agent_edit[0]->user_id; ?> class="form-control" name="user_id">            </div>            </div>							   <div class="form-group">           <label class="col-lg-2 control-label">Status</label>           <div class="col-lg-10">           <input type="text" placeholder="Status" class="form-control" name="Status" value= <?php echo $agent_edit[0]->status; ?>>           </div>          </div>			          <div class="form-group">          <div class="col-lg-offset-2 col-lg-10">          <button class="btn btn-sm btn-white" type="reset">Reset</button>          <button class="btn btn-sm btn-white" type="submit">Update</button>		  </div>          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row" ng-controller="moduleCtrl">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Agents List</h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#">Config option 1</a> </li>
              <li><a href="#">Config option 2</a> </li>
            </ul>
            <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Agent Name</th>
                <th>Email</th>
                <th>District</th>
                <th>Village</th>
                <th>Pincode</th>
                <th>Approval Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($agent as $agrole) {				//Fetching Agent users list 
              ?>
             <tr >
             	<td><?php echo $agrole->user_id; ?></td>
                <td><?php echo $agrole->name; ?></td>
                <td><?php echo $agrole->email_id; ?></td>
                <td><?php echo $agrole->district_name; ?></td>
                <td><?php echo $agrole->Location; ?></td>
                <td><?php echo $agrole->pincode; ?></td>                <td><?php echo $agrole->status; ?></td>
                <td><font color="red" ng-show="module.approve_id==1">Approval Pending</font>
                	<font color="green" ng-show="module.approve_id==2">Active</font></td>
                <td><a href="<?php echo $agrole->user_id; ?>">Edit</a> - <a href="#" class="btn btn-white btn-sm deleteAction" title="Click me to delete" data-module="{{module.module_id}}"><i class="fa fa-times"></i> Delete</a></td>
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

    $(document).on('submit', '#update_agent', function() {

        $.ajax({

            url: baseurl + 'Agent/update_agent',

            data: $(this).serialize(),

            type: 'POST',

            cache: false,

            success: function(res) {

                $("#update_agent").trigger("reset");

            }

        })

        return false;

    })
 
</script>