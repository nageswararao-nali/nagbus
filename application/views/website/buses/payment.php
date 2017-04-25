<div class="row">
  <div class="col-md-8">
    <div class="panel mb20 panel-default panel-hovered">
      <div class="panel-body">
        <form>
          <h4>Enter contact details</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Your email address</label>
                <input type="text" class="form-control" placeholder="Email ID">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Your Contact No.</label>
                <input type="text" class="form-control num_only" placeholder="Mobile No.">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Emergency No.</label>
                <input type="text" class="form-control num_only" placeholder="Emergency Contact">
              </div>
            </div>
          </div>
          <p>(Your booking details will be sent to your email adderess and contact no.)</p>
          <h4>Enter passenger details</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="First Name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Last Name">
              </div>
            </div>
            <div class="col-md-4 mt5">
              <div class="form-group">
                <div class="ui-radio ui-radio-pink">
                 <label class="ui-inline control-label">Gender</label>
                  <label class="ui-radio-inline">
                    <input checked="" name="radioEg" type="radio">
                    <span>M</span> </label>
                  <label class="ui-radio-inline">
                    <input name="radioEg" type="radio">
                    <span>F</span> </label>
                  </div>
              </div>
            </div>
          </div>
          <hr/>
          <div class="row">
          <input type="checkbox" id="coupon">
           <label>I have a coupon code (optional)</label>
           <div class="row couponcode" style="display:none">
           <div class="col-md-3">
           <input type="text" class="form-control" placeholder="coupon code"></div>
           <button type="button" class="btn btn-success col-md-2">Apply coupon</button>
            </div>
            </div>
          <button class="btn btn-group btn-success right">Continue</button>
        </form>
      </div>
    </div>
  </div>
  
</div>
<script>
$('#coupon').click(function(){
	if(this.checked){
		$(".couponcode").show();
	}
	else{
		$(".couponcode").hide();
		}
});
</script>