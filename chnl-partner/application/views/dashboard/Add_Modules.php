<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Category form</h5>
          <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
           <?php form_open('','class="form-horizontal" id="create_category"')?>
          <p>Add new Module</p>
          
          <div class="form-group">
            <label class="col-lg-2 control-label">Module Name</label>
            <div class="col-lg-10">
              <input type="text" placeholder="Name" class="form-control" name="name" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Description</label>
            <div class="col-lg-10">
              <input type="text" placeholder="Module Description" class="form-control" name="description">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
              <button class="btn btn-sm btn-white" type="reset">Reset</button>
              <button class="btn btn-sm btn-white" type="submit">Create</button>
            </div>
          </div>
           <?php form_close ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row" ng-controller="moduleCtrl">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>All Modules </h5>
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
                <th>Module Name</th>
                <th>Description</th>
                <th>Updated at / by</th>
                <th>Approval Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
             <tr ng-repeat="module in modules">
             	<td>{{module.module_id}}</td>
                <td>{{module.name}}</td>
                <td>{{module.description}}</td>
                <td>{{module.updation_date}} / {{module.update_login}}</td>
                <td><font color="red" ng-show="module.approve_id==1">Approval Pending</font>
                	<font color="green" ng-show="module.approve_id==2">Active</font></td>
                <td>Edit - <a href="#" class="btn btn-white btn-sm deleteAction" title="Click me to delete" data-module="{{module.module_id}}"><i class="fa fa-times"></i> Delete</a></td>
             </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
//Module Create
$(document).on('submit','#create_module', function(){
	$.ajax({
		url : baseurl+'Modules/create_module',
		data : $(this).serialize(),
		type  :'POST',
		cache : false,
		success : function(res){
			get_modules();
			$("#create_module").trigger("reset");
		}
	})
	return false;
})
//Module end
</script>
<script>
$(document).ready(function(){
	 $("#create_module").validate({
		 rules: {
			 name:{
				 required: true,
			 }
		 }
	 });
});

$(document).on('click','.deleteAction',function(event){
	event.preventDefault();
	var t = $(this).parents('tr');
	$.ajax({
		url : baseurl+'Modules/delete',
		type : 'POST',
		data : 'module_id='+$(this).attr('data-module'),
		success : function(res){if(res==1) t.fadeOut("slow")}
	});
});
</script>