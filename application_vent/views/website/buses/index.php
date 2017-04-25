<div class="row">
  <div class="col-lg-6 col-lg-offset-3">
    <div class="panel mb20 panel-info panel-hovered">
      <div class="panel-heading">
        <h4 class="text-successs">Search for bus tickets</h4>
      </div>
      <div class="panel-body">
        <form id="busform" action="<?php echo base_url()?>index/buses/bus_search" method="post" autocomplete="off">
          <div class="row">
            <div class="col-md-11 col-sm-11">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
                     <input type="text" class="form-control" name="city" id="geocomplete" required/>
            <div class="map_canvas" style="display:none !important"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
                     <input type="text" class="form-control" name="city2" id="geocomplete2" required/>
            <div class="map_canvas" style="display:none !important"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-1 col-sm-1">
              <div class="form-group"> <br/>
                <div class="input-group"> <img src="<?php echo base_url()?>assets/icons/twoway.png" alt="twoway"/> </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="input-group date datepickerDemo">
                <input type="text" class="form-control" name="DateofJourney" placeholder="Date of Journey" required/>
                <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
            </div>
            <div class="col-md-6">
              <div class="input-group date datepickerDemo">
                <input type="text" class="form-control" placeholder="Date of Return">
                <span class="input-group-addon"><i class="ion ion-calendar"></i></span> </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <input type="checkbox" id="cabselect">
              <label for="cabselect">Add a cab</label>
              <input type="text" class="form-control destination" style="display:none" placeholder="destination">
            </div>
            <div class="col-md-6">
              <input type="checkbox" id="hotelselect">
              <label for="hotelselect">Add a hotel</label>
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$('#cabselect').click(function(){
	if($(this).is(":not(:checked)")) $(".destination").hide();
	else if($(this).is(":checked") && $('#hotelselect').is(":checked"))	$(".destination").hide();
	else if($(this).is(":checked") && $('#hotelselect').is(":not(:checked)"))$(".destination").show();
});
$('#hotelselect').click(function(){
	if($(this).is(":checked") && $('#cabselect').is(":checked")) $(".destination").hide();
	else if($(this).is(":not(:checked)") && $('#cabselect').is(":checked")) $(".destination").show();
	else if($(this).is(":not(:checked)") && $('#cabselect').is(":not(:checked)"))$(".destination").hide();
});
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
<script>
$(function(){
	$('.datepickerDemo').datepicker()
});
</script>