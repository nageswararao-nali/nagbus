<div class="row">
<div class="col-md-2">
  <h4><font color="#F63">Search Hotel</font></h4>
  <input type="text" class="form-control input-sm" name="search" id="geocomplete" placeholder="Hotel Name"/>
  <div class="map_canvas" style="display:none !important"></div>
  <ul style="list-style:none; padding:0px;">
    <li>
      <h4><font color="#F63">Hotel Location</font></h4>
    </li>
    <li>
      <input type="checkbox">
      &nbsp;Hi-Tech City </li>
    <li>
      <input type="checkbox">
      &nbsp;Madhapur</li>
    <li>
      <input type="checkbox">
      &nbsp;Near Hi-Tech City</li>
    <li>
      <input type="checkbox">
      &nbsp;Gachibowli</li>
    <li>
      <input type="checkbox">
      &nbsp;Central Hyderabad</li>
    <li>
      <input type="checkbox">
      &nbsp;Banjara Hills</li>
    <li>
      <input type="checkbox">
      &nbsp;Kukutpally</li>
    <li>
      <input type="checkbox">
      &nbsp;Miyapur</li>
    <li><a href="#" class="pull-right">...more</a></li>
  </ul>
  <br/>
  <ul style="list-style:none; padding:0px;">
    <li>
      <h4><font color="#F63">Hotel Facilities</font></h4>
    </li>
    <li>
      <input type="checkbox">
      &nbsp;Internet/Wi-Fi</li>
    <li>
      <input type="checkbox">
      &nbsp;Swimming Pool</li>
    <li>
      <input type="checkbox">
      &nbsp;Gym</li>
    <li>
      <input type="checkbox">
      &nbsp;Parking</li>
    <li>
      <input type="checkbox">
      &nbsp;Business Facilities</li>
    <li>
      <input type="checkbox">
      &nbsp;Doctor on Call</li>
    <li>
      <input type="checkbox">
      &nbsp;Sports</li>
    <li>
      <input type="checkbox">
      &nbsp;Restaurant/Bar</li>
    <li>
      <input type="checkbox">
      &nbsp;More Room Facilities</li>
    <li><a href="#" class="pull-right">...more</a></li>
  </ul>
</div>
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default panel-hovered panel-stacked mb30 text-left">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3"><img src="<?=base_url()?>images/hotel1.jpg" alt="hotel"/> </div>
            <div class="col-md-7">
              <h4><span class="left">The Manohar Hotel&nbsp;&nbsp;</span>
                <div class="rating text-warning">
                  <a href="#" style="color:#F60"><input type="hidden" class="rating-control" value="4" data-filled="fa fa-star" data-empty="fa fa-star-o" /></a>
                </div>
              </h4>
              <p> Begumpet </p>
            </div>
            <div class="col-md-2 text-right"> <small><i class="fa fa-inr"></i><strike>4799</strike></small>
              <h4 style="color:#CE4300"><i class="fa fa-inr"></i>2799</h4>
              <small>per room/day</small> <a href="<?php echo base_url()?>Index/hotels/details" class="btn btn-success mt15 waves-effect waves-effect">Book Now</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default panel-hovered panel-stacked mb30 text-left">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3"><img src="<?=base_url()?>images/hotel2.jpg" alt="hotel"/> </div>
            <div class="col-md-7">
              <h4><span class="left">Radisson Hyderabad Hitec City&nbsp;&nbsp;</span>
                <div class="rating text-warning">
                  <a href="#" style="color:#F60"><input type="hidden" class="rating-control" value="4" data-filled="fa fa-star" data-empty="fa fa-star-o" /></a>
                </div>
              </h4>
              <p> Gachibowli </p>
            </div>
            <div class="col-md-2 text-right"> <small><i class="fa fa-inr"></i><strike>6000</strike></small>
              <h4 style="color:#CE4300"><i class="fa fa-inr"></i>4799</h4>
              <small>per room/day</small> <a href="<?php echo base_url()?>Index/hotels/details" class="btn btn-success mt15 waves-effect waves-effect">Book Now</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default panel-hovered panel-stacked mb30 text-left">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-3"><img src="<?=base_url()?>images/hotel3.jpg" alt="hotel"/> </div>
            <div class="col-md-7">
              <h4><span class="left">Oakwood Residence Kapil Hyderabad&nbsp;&nbsp;</span>
                <div class="rating text-warning">
                  <a href="#" style="color:#F60"><input type="hidden" class="rating-control" value="4" data-filled="fa fa-star" data-empty="fa fa-star-o" /></a>
                </div>
              </h4>
              <p> Gachibowli </p>
            </div>
            <div class="col-md-2 text-right"> <small><i class="fa fa-inr"></i><strike>6799</strike></small>
              <h4 style="color:#CE4300"><i class="fa fa-inr"></i>5500</h4>
              <small>per room/day</small> <a href="<?php echo base_url()?>Index/hotels/details" class="btn btn-success mt15 waves-effect waves-effect">Book Now</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
	$('.rating-control').rating()
});
$(document).ready(function(){
	$("#geocomplete").geocomplete({
	  map: ".map_canvas",
	  details: "form",
	  types: ["geocode", "establishment"],
	});
});
</script> 
