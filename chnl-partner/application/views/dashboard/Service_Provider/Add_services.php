<div class="wrapper wrapper-content animated fadeInRight" ng-controller="spCtrl">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Services Form</h5>
          <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
        <form class="form-horizontal" id="add_service">
          <div class="form-group">
            <label class="col-md-3 control-label">Module Name</label>
            <div class="col-md-6">
              <input type="hidden" name="module_id" value="21" />
              <input value="Service Provider" class="form-control" name="Module_Name" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Service Category Name</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="Service_Category_Name">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-7 col-md-2">
              <button class="btn btn-md btn-white pull-right" type="submit" id="service_add">Add</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Services Table</h5>
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
                <th>Service Name</th>
                <th>Module Name</th>
                <th>Updated by</th>
                <th>Action</th>
              </tr>
            </thead>
             <tbody class="tblCategories">
              <tr ng-repeat="item in ServiceProviderServices">
              	<td>{{item.name}}</td>
                <td>{{item.module_id}}</td>
                <td>{{item.updation_date}}</td>
                <td>{{item.category_id}}</td>
              </tr>
             </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).on('submit','#add_service',function(){
	$.ajax({
		type : 'POST',
		url : baseurl+'Service_provider/create_service',
		data : $(this).serialize(),
		success : function(res){
			$("#add_service").trigger("reset");
			alert("Saved successfully");
		}
	})
});
</script>
<script>
$(document).ready(function(){
 $("#add_service").validate({
	 rules: {
		 Service_Category_Name:{
			 required: true,
		 }
	 }
 });
});
</script>


