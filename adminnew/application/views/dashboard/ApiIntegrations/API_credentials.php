<div class="wrapper wrapper-content animated fadeInRight" ng-controller="commissionCtrl">
  <form id="API_credentials">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>API credentials</h5>
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
            <h5>API credentials</h5>
            <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
          </div>
          <div class="ibox-content">
            <div class="form-group">
              <div class="row">
                <label class="col-lg-2">Enter User id</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="APIuserid" placeholder="Enter User id">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-lg-2">Enter Password</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="APIpassword" placeholder="Enter Password">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <label class="col-lg-2">Security Pin</label>
                <div class="col-lg-3">
                  <input type="text" class="form-control" name="APISecurityPin" placeholder="(optional)">
                </div>
                <div class="col-lg-2 col-lg-offset-5">
                  <button class="btn btn-primary pull-right" name="button">save</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<script>
$(document).ready(function(){
		
	$(document).on('submit','#API_credentials',function(){
		$.ajax({
				url : baseurl+'APISetup/API_save_credentials',
				type : 'POST',
				data : $(this).serialize(),
				success : function(res){
					alert("API credentials successfully saved")
					$("#API_credentials").trigger("reset");
				}
			})
		return false;
	});
	
	 $("#API_credentials").validate({
		 rules: {
			 moduleid: {
				 required: true,
			 }, 
			 categoryid: {
				 required: true,
			 }, 
			 APIuserid: {
				 required: true,
			 }, 
			APIpassword: {
				 required: true,
			 }       
		 }
		 
	 });
});
</script> 
