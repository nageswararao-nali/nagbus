<div class="col-md-8">
  <div class="panel panel-default panel-hovered panel-stacked mb30">
    <div class="panel-heading">
      <h3 class="text-successs">Book Your Cab</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal">
        <div class="form-group">
          <div class="col-md-6"> <a href="#" class="btn btn-pink btn-sm">Outstation</a> <a href="#" class="btn btn-success btn-sm">Local</a> <a href="#" class="btn btn-primary btn-sm">Transfer</a> </div>
          <div class="col-md-6">
            <div class="col-md-6">
              <div class="radio">
                <label>
                  <input type="radio" name="flightOption" value="oneway" checked="">
                  One Way </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="radio">
                <label>
                  <input type="radio" name="flightOption" value="roundtrip">
                  Round Trip </label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6"><span>Pick-Up location</span>
            <input type="text" class="form-control" name="city" id="geocomplete">
            <div class="map_canvas" style="display:none !important"></div>
          </div>
          <div class="col-md-6"><span>Drop-off Location</span>
            <input type="text" class="form-control" name="city" id="geocomplete2">
            <div class="map_canvas" style="display:none !important"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6"><span>Pick-up date</span>
            <div class="input-group date" id="datepickerDemo">
              <input type="text" class="form-control" placeholder="Pick-up Date">
              <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
          </div>
          <div class="col-md-6"><span>Pick-up Time</span>
            <select class="timeselect form-control" data-placeholder="Select">
              <option value="0">--Select Time--</option>
              <option value="1">09:00 AM</option>
              <option value="2">10:00 AM</option>
              <option value="3">11:00 AM</option>
              <option value="4">12:00 PM</option>
              <option value="5">01:00 PM</option>
              <option value="6">02:00 PM</option>
              <option value="7">03:00 PM</option>
              <option value="8">04:00 PM</option>
            </select>
          </div>
        </div>
        <div class="form-group" id="txtReturn">
          <div class="col-md-6"><span>Return Date</span>
            <div class="input-group date" id="datepickerDemo">
              <input type="text" class="form-control" placeholder="Return Date">
              <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
          </div>
          <div class="col-md-6"><span>Return Time to Start(Hrs)</span>
            <select class="timeselect form-control" data-placeholder="Select">
              <option value="0">--Select Time--</option>
              <option value="1">09:00 AM</option>
              <option value="2">10:00 AM</option>
              <option value="3">11:00 AM</option>
              <option value="4">12:00 PM</option>
              <option value="5">01:00 PM</option>
              <option value="6">02:00 PM</option>
              <option value="7">03:00 PM</option>
              <option value="8">04:00 PM</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <input type="checkbox">
            <label>Add a flight</label>
          </div>
          <div class="col-md-6">
            <input type="checkbox" checked>
            <label>Add a hotel</label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-4">
            <button type="submit" class="btn btn-group btn-info btn-sm">Show Cars</button>
          </div>
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
	$("#geocomplete2").geocomplete({
	  map: ".map_canvas",
	  details: "form",
	  types: ["geocode", "establishment"],
	});
});
</script>