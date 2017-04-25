<div class="wrapper wrapper-content animated fadeInRight" ng-controller="commissionCtrl"> 
<form role="form" id="create_api">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>API Integration Page <small class="text-danger">Please be care full while filling this form</small></h5>
          <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-lg-5">
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Select Module</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <select class="form-control" name="moduleid" ng-model="mid" ng-change="servic()" ng-options="item.name for item in modules track by item.module_id">
                      <option value="" disabled="disabled">Select Module</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6">
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Select Category</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <select class="form-control" name="categoryid" ng-model="cid" ng-options="item.categoryname for item in categories track by item.category_id">
                      <option selected="selected" class="" value="" disabled="disabled">Select Category</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>API INSERT FORM</h5>
          <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Base_URL</label>
                </div>
                <div class="row">
                  <div class="col-lg-2">
                  	<select name="api_protocol" class="form-control">
                    	<option value="http://" selected="selected">http://</option>
                        <option value="https://">https://</option>
                    </select>
                  </div>
                  <div class="col-lg-10">
                    <input placeholder="Enter Base_URL" class="form-control" name="operator_base_url" type="text">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">API Title</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <input placeholder="Enter API Title" class="form-control" name="api_title" type="text">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">API PATH</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <input placeholder="Enter API url" class="form-control" name="api_url_path" type="text">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5><strong>Parameters</strong></h5>
          <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Name</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <input placeholder="Enter Parameter Name" class="form-control" name="param_name[]" type="text" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
              <div class="form-group">
                <div class="row">
                  <label class="col-lg-12">Description</label>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <input placeholder="Enter Parameter Description" class="form-control" name="param_desc[]" type="text" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-2">
            	<div class="row">
                	<label class="col-lg-12">Action</label>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12">
                       <!-- <button class="btn btn-sm btn-defulat btn_delete" type="button">Delete</button>-->
                      </div>
                </div>
            </div>
          </div>
          <span class="param_div">
          	
          </span>
          <div class="form-group  text-right">
               <button class="btn btn-primary" type="submit">Create API</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form> </div>
  <span class="reusable" style="display:none;">
          <div class="row par">
            <div class="col-lg-4">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-12">
                    <input placeholder="Enter Parameter Name" class="form-control" name="param_name[]" type="text" required/>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-12">
                    <input placeholder="Enter Parameter Description" class="form-control" name="param_desc[]" type="text" required/>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-2">
                <div class="row form-group">
                    <div class="col-lg-12">
                        <button class="btn btn-sm btn-primary btn_add" type="button">Add</button>
                      </div>
                </div>
            </div>
          </div>
          </span>
<script>
	$(document).on('click','.btn_add',function(){
		$('.param_div').prepend($('.reusable').html());
		if($('.param_div').find('.par').length>2){
			$('.param_div').find('.par').eq(1).find('.btn_add').addClass("btn_delete");
			$('.param_div').find('.par').eq(1).find('.btn_add').removeClass("btn_add");
		}
	});

	$(document).ready(function(){
		$('.param_div').prepend($('.reusable').html());
		$('.reusable').find('.btn_add').html("Delete");
		$('.reusable').find('.btn_add').addClass("btn_delete");
		$('.reusable').find('.btn_add').removeClass("btn_add");
	});

	$(document).on('click','.btn_delete',function(){
		$(this).parents('.par').fadeOut();
	});
	
	$(document).on('submit','#create_api',function(){
		
		$.ajax({
				url : baseurl+'APISetup/create_api',
				type : 'POST',
				data : $(this).serialize(),
				success : function(res){
					alert("API successfully created")
					$("#create_api").trigger("reset");
				}
			})
		return false;
	});
$(document).ready(function(){
             $("#create_api").validate({
                 rules: {
                     moduleid: {
                         required: true,
                     }, 
					 categoryid: {
                         required: true,
                     }, 
					 api_title: {
                         required: true,
                     }, 
					 api_url_path: {
                         required: true,
                     }, 
					 param_name: {
                         required: true,
                     }, 
					 param_desc: {
                         required: true,
                     }, 
					 operator_base_url: {
                         required: true,
                     },                     
                 }
				 
             });
        });
</script>
