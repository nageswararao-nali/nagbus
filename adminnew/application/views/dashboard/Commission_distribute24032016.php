<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox float-e-margins" ng-controller="commissionDistributeCtrl">
    <div class="ibox-title">
      <h5>Commission distribute form</h5>
      <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
    </div>
    <div class="ibox-content">
      <form id="distribution">
        <div class="form-group">
          <div class="row">
            <div class="col-lg-2">
            <div class="row">
            <div class="col-lg-offset-7 col-lg-5">
              <label class="control-label">SMD</label>
            </div>
            </div>
            </div>
            <div class="col-lg-10">
              <input class="form-control num_only" type="text" name="smd_percentage" placeholder="Enter SMD Commission value" ng-model="smd_percentage">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-lg-2">
              <div class="row">
                <label class="col-lg-6 control-label"> <br/>
                </label>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-offset-1 col-lg-11">
                    <label class="control-label">Channel partner</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-lg-offset-3">
                    <label class="control-label">Term1 years</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input class="form-control num_only" type="text" placeholder="year" name="term1_period" ng-model="term1_period">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input class="form-control num_only" type="text" placeholder="%" name="term1_percentage" ng-model="term1_percentage">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-lg-offset-3">
                    <label class="control-label">2<sup>nd</sup> Term</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input class="form-control num_only" type="text" placeholder="year" name="term2_period" ng-model="term2_period">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input class="form-control num_only" type="text" placeholder="%" name="term2_percentage" ng-model="term2_percentage">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                    <label class="control-label">3<sup>rd</sup> Term (forever)</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-11 col-lg-offset-1">
                    <input class="form-control num_only" type="text" placeholder="%" name="term3_percentage" ng-model="term3_percentage">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2">
            <label class="control-label">Laabus Commission</label>
          </div>
          <div class="col-lg-3">
            <div class="input-group">
              <input class="form-control" name="labbus_percentage" type="hidden" value="" ng-model="labbus_percentage"/>
              <h2><span ng-bind="labbus_percentage"></span>%</h2>
            </div>
          </div>
          <div class="col-lg-7">
            <button class="btn btn-sm btn-primary pull-right" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
	$("#distribution").validate({
		rules:{
			smd_percentage:{
				required: true,
				},
				
			term1_period:{
				required: true,
				},
			term1_percentage:{
				required: true,
				},
				
			term2_period:{
				required: true,
				},
			term2_percentage:{
				required: true,
				},
				
			term3_percentage:{
				required: true,
				},
			}
	});
});

$(document).on('submit','#distribution',function(){
	$.ajax({
		type : 'POST',
		url : baseurl+'Commission_Setup/commission_distribute_save',
		data : $(this).serialize(),
		success : function(res){
			alert("Saved successfully");
		}
	})
});
</script>