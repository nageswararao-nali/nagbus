<div class="col-md-12">
  <div class="panel panel-default panel-hovered panel-stacked mb30">
    <div class="panel-body">
      <div class="col-md-6">
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-md-12">
              <h3>Hotel Search</h3>
              <input type="text" class="form-control" name="city" id="geocomplete">
              <div class="map_canvas" style="display:none !important"></div>
              <p>Destination, hotel, landmark or address</p>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <label class="control-label">Check in</label>
              <div class="input-group date datepickerDemo">
                <input class="form-control" type="text">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
            </div>
            <div class="col-md-6">
              <label class="control-label">Check out</label>
              <div class="input-group date datepickerDemo">
                <input class="form-control" type="text">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <label class="control-label">Rooms</label>
              <select class="form-control">
                <option value="">0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
              </select>
            </div>
            <div class="col-md-4">
              <label>Adult</label>
              <input type="number" class="form-control">
            </div>
            <div class="col-md-4">
              <label>Child</label>
              <input type="number" class="form-control">
            </div>
          </div>
          <!--<div class="form-group">
            <div class="col-md-4">
              <input type="checkbox">
              <label>Add a flight</label>
            </div>
            <div class="col-md-4">
              <input type="checkbox" checked>
              <label>Add a car</label>
            </div>
            <div class="col-md-4">
              <input type="checkbox" checked>
              <label>Add a bus</label>
            </div>
          </div>-->
          <div class="form-group">
            <a href="<?php echo base_url()?>index/hotels/search" class="btn btn-success pull-right">Search</a>
          </div>
        </form>
      </div>
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
<script>
$(function(){
	$('.datepickerDemo').datepicker()
});
</script>