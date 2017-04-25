<div class="col-md-12">
  <div class="panel panel-default panel-hovered panel-stacked mb30">
    <div class="panel-body">
      <div class="col-md-2 text-center prod-title-left">
        <h4>Hyderabad</h4>
        <p>India</p>
      </div>
      <div class="col-md-2 text-center">
        <label>Check-In</label>
        <p><i class="fa fa-calendar"></i> Wed, 16 Sep'15</p>
        <!--<span class="arrow_greater" style="margin-left:155px">&gt;</span>--> 
      </div>
      <div class="col-md-2 prod-title-left text-center">
        <label>Check-Out</label>
        <p><i class="fa fa-calendar"></i> Fri, 18 Sep'15</p>
      </div>
      <div class="col-md-1 text-center">
        <label>Days</label>
        <p>2</p>
      </div>
      <div class="col-md-1 text-center">
        <label>Rooms</label>
        <p>2</p>
      </div>
      <div class="col-md-1 text-center">
        <label>People</label>
        <p>4</p>
      </div>
      <div class="col-md-2 col-md-offset-1 text-center"> <a href="<?php echo base_url()?>Index/hotels" class="btn btn-danger mt15 waves-effect waves-effect">Modify Details</a> </div>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="panel panel-default panel-hovered panel-stacked mb30">
    <div class="panel-body">
      <form class="horizontal" role="form">
        <div class="row">
          <div class="form-group">
            <h4>Primary Traveller Name </h4>
            <div class="col-md-2">
              <select class="form-control">
                <option value="0">Mr.</option>
                <option value="1">Miss</option>
                <option value="2">Mrs</option>
              </select>
            </div>
            <div class="col-md-3">
              <input class="form-control" id="firstname" type="text" placeholder="First Name">
            </div>
            <div class="col-md-3">
              <input class="form-control" id="lastname" type="text" placeholder="Last Name">
            </div>
          </div>
        </div>
        <div class="row">
          <h4>Contact Details</h4>
          <div class="col-md-4">
            <div class="form-group">
              <input class="form-control" id="email" type="text" placeholder="Email Address">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-md-1">
              <input class="form-control" id="code" type="text" placeholder="+91">
            </div>
            <div class="col-md-3">
              <input class="form-control" id="code" type="text" placeholder="Mobile Number">
            </div>
          </div>
        </div>
        <div class="clearfix right">
          <button class="btn btn-success waves-effect" type="submit">Continue with Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>
