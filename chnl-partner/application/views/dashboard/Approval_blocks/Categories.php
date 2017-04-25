<div class="wrapper wrapper-content animated fadeInRight" ng-controller="categoryCtrl">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>List of the Categories for all modules</h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#">Config option 1</a> </li>
              <li><a href="#">Config option 2</a> </li>
            </ul>
            <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
          <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
            <thead>
              <tr>
                <th data-toggle="true">Category Name</th>
                <th>Module Name</th>
                <th>Approval Status</th>
                <th>Created Date</th>
                <th>Last Updated</th>
                <th>Previous Activity by</th>
                <th data-hide="all">Category Description</th>
              </tr>
            </thead>
            <tbody class="tblCategories">
				<tr ng-repeat="category in categories">
                <td>{{category.categoryname}}</td>
                <td>{{category.modulename}}</td>
                 <td>
                 <span ng-show="category.approve_id==1"><font color="red" title="The item not activated please activate it by tapping active button">Pending</font> <a href="#" class="btn btn-white btn-sm positiveAction" title="Click me to activate" data-cid="{{category.category_id}}" ng-click="hi(category.category_id)"><i class="fa fa-check"></i> Activate</a></span>
                 <span ng-show="category.approve_id==2"><font color="green" title="The item is activated if you want to deactivate please tab deactive button">Active</font> <a href="#" class="btn btn-white btn-sm nagativeAction" title="Click me to deactive" data-cid="{{category.category_id}}" ng-click="hi(category.category_id)"><i class="fa fa-ban"></i> Deactivate</a></span>
                 </td>
                <td>{{category.creation_date}}</td>
                <td>{{category.updation_date}}</td>
                <td>{{category.update_login}}</td>
                </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5"><ul class="pagination pull-right">
                  </ul></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
//activation and deactivation
$(document).on('click','.positiveAction',function(event){
	event.preventDefault();
	$.ajax({
		url : baseurl+'Approvals/service_category_active',
		data : 'category_id='+$(this).attr('data-cid'),
		type : 'POST',
		success : function(res){
			
		}
	});
	return false;
});
$(document).on('click','.nagativeAction',function(event){
	event.preventDefault();
	$.ajax({
		url : baseurl+'Approvals/service_category_deactive',
		data : 'category_id='+$(this).attr('data-cid'),
		type : 'POST',
		success : function(res){
			
		}
	});
	return false;
});
</script>