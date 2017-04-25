<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Channel Partner</h5>
          <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">		   	<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'create_channel_partner'); echo form_open('dashboard/create_channel_partner',$attributes); ?>
          <div class="form-group">
            <label class="col-lg-2 control-label">Channel Partner Name</label>
            <div class="col-lg-10">
              <input type="text" placeholder="Channel Partner Name" class="form-control" name="name" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Email ID</label>
            <div class="col-lg-10">
              <input type="email" placeholder="Category Name" class="form-control" name="email">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-2 control-label">District</label>
            <div class="col-lg-10">
              <input type="text" placeholder="District" class="form-control" name="district">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-2 control-label">Pincode</label>
            <div class="col-lg-10">
              <input type="text" placeholder="Pincode" class="form-control" name="Pincode">
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
  <div class="row" ng-controller="moduleCtrl">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Channel partners List</h5>
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
                <th>Channel Partner Name</th>				                <th>Email</th>
                <th>District</th>
                <th>Pincode</th>
                <th>Approval Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($channel as $chrole) { ?>			
            <!-- <tr ng-repeat="module in modules"> --><tr>
             	<td><?php echo $chrole->user_id; ?></td>
                <td><?php echo $chrole->name; ?></td>				                <td><?php echo $chrole->email_id; ?></td>				 
                <td><?php echo $chrole->district_name; ?></td>
                <td><?php echo $chrole->pincode; ?></td>								 <td><?php echo $chrole->status; ?></td>
               <td><a href="/laabus/adminnew/dashboard/edit_channel_partner/<?php echo $chrole->user_id; ?>">Edit</a>-<a href="#" class="btn btn-white btn-sm deleteAction" title="Click me to delete" data-module="{{module.module_id}}"><i class="fa fa-times"></i> Delete</a></td></tr>
          <!--   </tr> -->
             <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div><script>    $(document).on('submit', '#create_channel_partner', function() {        $.ajax({            url: baseurl + 'dashboard/create_channel_partner',            data: $(this).serialize(),            type: 'POST',            cache: false,            success: function(res) {                $("#create_channel_partner").trigger("reset");            }        })        return false;    })</script><script>    $(document).ready(function() {        $("#create_channel_partner").validate({            rules: {                moduleid: {                    required: true,                },                name: {                    required: true,                }            }        });    });</script>