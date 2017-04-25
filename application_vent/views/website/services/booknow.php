<!--<div class="col-md-7">
  <div class="panel-body"> <a class="btn-tag btn-tag-info" href="#">Index</a> <a class="btn-tag btn-tag-success" href="#">Services</a> <a class="btn-tag btn-tag-danger" href="#">List of Services</a> <a class="btn-tag btn-tag-purple" href="#">Electrician</a> <a class="btn-tag btn-tag-pink" href="#">Book Now</a></div>
</div>-->
<div class="col-md-6 col-md-offset-3">
  <div class="panel panel-info panel-hovered panel-stacked mb30">
    <div class="panel-heading text-center">Book Your Electrician Now</div>
    <div class="panel-body">
      <form class="form-horizontal" id="booknow">
          <div class="form-group">
            <label class="control-label">Name:<font color="red">*</font></label>
            <input class="form-control" type="text" placeholder="" required>
          </div>
          <div class="form-group">
            <label class="control-label">Schedule Date:<font color="red">*</font></label>
            <div class="input-group date" id="datepickerDemo">
              <input type="text" class="form-control" placeholder="Select Date" required>
              <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
          </div>
          <div class="form-group">
            <label class="control-label">Select Time:<font color="red">*</font></label>
            <select class="timeselect form-control" data-placeholder="Select">
              <option value="0">--Select Time--</option>
              <option value="1">09:00 AM - 10:00 AM</option>
              <option value="2">10:00 AM - 11:00 AM</option>
              <option value="3">11:00 AM - 12:00 PM</option>
              <option value="4">12:00 PM - 01:00 PM</option>
              <option value="5">01:00 PM - 02:00 PM</option>
              <option value="6">02:00 PM - 03:00 PM</option>
              <option value="7">03:00 PM - 04:00 PM</option>
              <option value="8">04:00 PM - 05:00 PM</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Location:<font color="red">*</font></label>
            <input class="form-control" type="text" placeholder="" required>
          </div>
          <div class="form-group">
            <label class="control-label">Address:<font color="red">*</font></label>
            <input class="form-control" type="text" placeholder="" required>
          </div>
          <div class="form-group">
            <label class="control-label">Landmark:</label>
            <input class="form-control" type="text" placeholder="" required>
          </div>
          <div class="form-group">
            <label class="control-label">City:<font color="red">*</font></label>
            <input type="text" class="form-control" name="city" id="geocomplete" required>
            <div class="map_canvas" style="display:none !important"></div>
          </div>
          <div class="form-group">
            <label class="control-label">Mobile:<font color="red">*</font></label>
            <input class="form-control" type="text" placeholder="" required>
          </div>
          <div class="form-group">
            <label class="control-label">Email:<font color="red">*</font></label>
            <input class="form-control" type="text" placeholder="" required>
          </div>
          <div class="form-group">
            <label class="control-label">Promotion Code:</label>
            <input class="form-control" type="text" placeholder="" required>
          </div>
          <div class="clearfix right">
            <button class="btn btn-primary mr5" type="submit" id="button">Confirm Order</button>
            <a href="<?php echo base_url()?>Index/services/thankyou" class="btn btn-success mr5" type="submit" id="button">Submit</a>
          </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
	$("#geocomplete").geocomplete({
	  map: ".map_canvas",
	  details: "form",
	  types: ["geocode", "establishment"],
	});
});
</script>