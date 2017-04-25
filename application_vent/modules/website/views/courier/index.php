<div class="row">
  <div class="col-lg-6 col-lg-offset-3">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-heading">
        <h4 class=text-center>Get a Quick Rate</h4>
      </div>
      <div class="panel-body">
        <form class="form-horizontal">
        <div class="form-group">
            <div class="col-md-6"><span>From</span>
              <input type="text" class="form-control" name="city" id="geocomplete" required>
            <div class="map_canvas" style="display:none !important"></div>
            </div>
            <div class="col-md-6"><span>To</span>
             <input type="text" class="form-control" name="city" id="geocomplete2" required>
            <div class="map_canvas" style="display:none !important"></div>
            </div>
          </div>
        <div class="form-group">
            <div class="col-md-6">
              <input type="text" class="form-control" placeholder="Enter Weight" style="height:35px;" />
            </div>
            <div class="col-md-3">
              <select class="form-control"  style="height:35px;">
                <option>kgs</option>
                <option>lbs</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <button type="submit" class="col-md-2 btn btn-success right">Next</button>
            </div>
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
	$("#geocomplete2").geocomplete({
	  map: ".map_canvas",
	  details: "form",
	  types: ["geocode", "establishment"],
	});
});
</script>