<div class="wrapper wrapper-content animated fadeInRight">
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
                <th data-toggle="true">Module Name</th>
                <th>Approval Status</th>
                <th>Created Date</th>
                <th>Last Updated</th>
                <th>Previous Activity by</th>
                <th>Module Description</th>
              </tr>
            </thead>
            <tbody class="tblCategories">

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
function get_modules(){
	$.ajax({
		url : baseurl+'Approvals/get_all_modules',
		success : function(res){
			var obj = JSON.parse(res);
			if(obj.err_code==1){
				$('.tblCategories').html('');
				for(var i=0; i<obj.message.length; i++){
					var c = obj.message[i];
					var status = c.flag=="1" ? '<font color="red" title="The item not activated please activate it by tapping active button">Pending</font> <a href="#" class="btn btn-white btn-sm positiveAction" title="Click me to activate" data-module="'+c.module_id+'"><i class="fa fa-check"></i> Activate</a>' : '<font color="green" title="The item is activated if you want to deactivate please tab deactive button">Active</font> <a href="#" class="btn btn-white btn-sm nagativeAction" title="Click me to deactive" data-module="'+c.module_id+'"><i class="fa fa-ban"></i> Deactivate</a>';
					$('.tblCategories').append('<tr><td class="text-navy" data-module="'+c.module_id+'" title="'+c.description+'">'+c.name+' (<span title="Categories Count">'+c.categories_count+'</span>)</td><td>'+status+'</td><td>'+c.creation_date+'</td><td>'+c.updation_date+'</td><td>'+c.update_login+'</td><td>'+c.description+'</td></tr>');
				}
			}else {
					$('.tblCategories').html('<tr><td colspan="4"><h2 class="text-center">No Categories</h2></td></tr>');
			}
		}
	});
}
$(document).ready(function(){
	get_modules();
});
//activation and deactivation
$(document).on('click','.positiveAction',function(event){
	event.preventDefault();
	$.ajax({
		url : baseurl+'Approvals/service_module_active',
		data : 'module_id='+$(this).attr('data-module'),
		type : 'POST',
		success : function(res){
			if(res)	get_modules();
		}
	});
	
	return false;
});
$(document).on('click','.nagativeAction',function(event){
	event.preventDefault();
	$.ajax({
		url : baseurl+'Approvals/service_module_deactive',
		data : 'module_id='+$(this).attr('data-module'),
		type : 'POST',
		success : function(res){
			if(res)	get_modules();
		}
	});
	return false;
});
</script>