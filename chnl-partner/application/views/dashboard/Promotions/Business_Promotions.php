<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Promotions <small>Add promotions to grow business</small></h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#">Config option 1</a> </li>
              <li><a href="#">Config option 2</a> </li>
            </ul>
            <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-sm-12 b-r">
              <h3 class="m-t-none m-b">Coupon Form</h3>
              <p>Publish codes today for more expirience.</p>
              <form role="form" id="create_promotion">
              <div class="form-group">
                <label>Promotion Code</label>
                <input type="text" placeholder="Enter Promotion Code" class="form-control" name="promotioncode" required>
              </div>
              <div class="form-group">
                <label>Discount</label>
                <div class="row">
                  <div class="col-sm-4">
                    <select class="form-control" name="discount" required>
                      <option value="">Select Distype</option>
                      <option value="R">Rs</option>
                      <option value="P">%</option>
                    </select>
                  </div>
                  <div class="col-sm-8">
                    <input type="text" placeholder="Enter Discount" class="form-control num_only" name="Enterdiscount" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Promotion code valid for the below services</label>
                <select data-placeholder="This promotion valid for..." class="chosen-select form-control" name="services" multiple required>
                  <option value="" disabled="disabled">Select Services</option>
                  <option value="1">Service 1</option>
                  <option value="2">Service 2</option>
                </select>
              </div>
              <div class="form-group">
                <label>Promotion Code for</label>
                <select data-placeholder="This promotion valid for..." class="chosen-select form-control" multiple name="promotioncodefor" required>
                  <option value="" disabled="disabled">Select Usertypes</option>
                  <option value="1">All</option>
                  <option value="1">All Agents</option>
                  <option value="1">All Users</option>
                  <option value="1">New Users</option>
                  <option value="1">New Agents</option>
                  <option value="1">Existing Users</option>
                  <option value="2">Existing Agents</option>
                </select>
              </div>
              <div class="form-group">
                <label>Schedule</label>
                <div class="row">
                  <div class="col-sm-3">
                    <label class="font-noraml">From Date</label>
                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" class="form-control" id="startDate" data-date-format="dd-mm-yyyy"/>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <label class="font-noraml">To Date</label>
                    <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" class="form-control" id="endDate"  data-date-format="dd-mm-yyyy"/>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <label class="font-noraml">Total coupon valid peroid is</label>
                    <div class="input-group">
                      <h2><span class="coupon_days">50</span> days</h2>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <label class="font-noraml">Usage times</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="usageTimes" placeholder="Max times"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Create</strong></button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).on('submit','#create_promotion',function(){
	console.log($(this).serialize());
	alert($(this).find('input[name="promotioncodefor"]').val());
	return false;
});
$(document).ready(function(){
	 $("#create_promotion").validate({
		 rules: {
			 promotioncode: {
				 required: true,
		   },
		   discount: {
				 required: true,
		   },
		   Enterdiscount: {
				 required: true,
		   },
		   services: {
				 required: true,
		   },
		   promotioncodefor: {
				 required: true,
		   }
		 }
	 });	 
});
</script>