<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-heading">
        <h2>Book Domestic & International Flight Tickets</h2>
      </div>
      <div class="panel-body">
              <form class="form-horizontal">
          <div class="form-group">
        <div class="col-md-4"> <a href="#" class="btn btn-primary btn-sm">Domestic</a> <a href="#" class="btn btn-info btn-sm">International</a> </div>
            <div class="col-md-2">
              <div class="radio">
                <label>
                  <input type="radio" name="FlightOption" id="rdOnewayFlight" value="oneway" checked="">
                  One Way </label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="radio">
                <label>
                  <input type="radio" name="FlightOption" id="rdRoundtripFlight" value="roundtrip">
                  Round Trip </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="radio">
                <label>
                  <input type="radio" name="FlightOption" id="rdMultyCity" value="multicitystopover">
                  Multi City / stop Over </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4"><span>From</span>
              <input type="text" class="form-control" id="txtFromFlight" placeholder="City or Airport">
            </div>
            <div class="col-md-4"><span>To</span>
              <input type="text" class="form-control" id="txtToFlight" placeholder="City or Airport">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3" id="txtDepartureDateFlight"><span>Departure</span>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-3" id="txtReturnDateFlight" style="display:none"><span>Return</span>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-3"> <br/>
              <a href="#" class="btn btn-primary btn-plus " id="btnAddCity" style="display:none">Add City</a> </div>
          </div>
          <div class="form-group">
            <div class="col-md-2"><span>Adult: (12+ YRS )</span>
              <input type="number" class="form-control" id="txtAdultFlight" onkeypress="return isNumberKey(event)" >
              <p style="color:red; font-size:10pt; display:none;" class="altMessage">Please enter number only</p>
            </div>
            <div class="col-md-2"><span>Child: (2-11 YRS )</span>
              <input type="number" class="form-control" id="txtChildFlight" onkeypress="return isNumberKey(event)" >
              <p style="color:red; font-size:10pt; display:none;" class="altMessage">Please enter number only</p>
            </div>
            <div class="col-md-2"><span>Infant: (0-2 YRS )</span>
              <input type="number" class="form-control" id="txtInfantFlight" onkeypress="return isNumberKey(event)" >
              <p style="color:red; font-size:10pt; display:none;" class="altMessage">Please enter number only</p>
            </div>
            <div class="col-md-2"><span>Class</span>
              <select class="form-control">
                <option value="E" class="economy_class">Economy</option>
                <option value="PE" class="premium_class">Premium Economy </option>
                <option value="B" class="business_class">Business</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <input type="checkbox" id="cab">
              <label>Add a cab</label>
              <input type="text" class="form-control cabdestination" style="display:none" placeholder="destination">
            </div>
            <div class="col-md-offset-2 col-md-4">
              <input type="checkbox" id="hotel">
              <label>Add a hotel</label>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-3"> <a href="<?php echo base_url()?>index/flight/search" class="btn btn-group btn-success btn-sm">
              Search Flights
              </a> </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$('#rdRoundtripFlight').click(function(){
	if(this.checked){
		$("#txtReturnDateFlight").show();
		$("#btnAddCity").hide();
	}else{
		$("#txtReturnDateFlight").hide();
		$("#btnAddCity").hide();
		}
});
$('#rdMultyCity').click(function(){
	if(this.checked){
		$("#txtReturnDateFlight").show();
		$("#btnAddCity").show();
	}else{
		$("#txtReturnDateFlight").hide();
		$("#btnAddCity").hide();
		}
});
$('#rdOnewayFlight').click(function(){
	if(this.checked){
		$("#txtReturnDateFlight").hide();
		$("#btnAddCity").hide();
	}
	else;
});


$('#cab').click(function(){
	if($(this).is(":not(:checked)")) $(".cabdestination").hide();
	else if($(this).is(":checked") && $('#hotel').is(":checked"))	$(".cabdestination").hide();
	else if($(this).is(":checked") && $('#hotel').is(":not(:checked)"))$(".cabdestination").show();
});
$('#hotel').click(function(){
	if($(this).is(":checked") && $('#cab').is(":checked")) $(".cabdestination").hide();
	else if($(this).is(":not(:checked)") && $('#cab').is(":checked")) $(".cabdestination").show();
	else if($(this).is(":not(:checked)") && $('#cab').is(":not(:checked)"))$(".cabdestination").hide();
});
</script>