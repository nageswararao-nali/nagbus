<div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-7">
        <div class="panel panel-default panel-hovered panel-stacked mb30">
          <div class="panel-body">
            <div class="row text-center">
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/electrician"><img id="myImage" onclick="changebulb()" src="<?php echo base_url()?>images/electrician2.png" width="50" height="60" />
                  <p>Electrical</p></a>
              </div>
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/plumber"><img src="<?=base_url()?>images/Plumber1.jpg" alt="plumber" width="50" height="60" /><p>Plumbing </p></a>
              </div>
              <div class="col-md-4">
               <a href="<?php echo base_url()?>Index/services/list_sp/computer_repair"><img class="imgthumb" src="<?=base_url()?>images/Computer-repair.jpg" alt="computerrepair" width="70" height="60" /><p>Computer Repair</p></a>
              </div>
            </div>
            <div class="row text-center" style="margin-top:15px">
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/laundry"><img class="imgthumb" src="<?=base_url()?>images/laundry1.png" alt="laundry" width="50" height="60" /><p>Laundry</p></a> 
              </div>
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/carpenter"><img class="imgthumb" src="<?=base_url()?>images/carpenter2.png" alt="carpenter" width="60" height="60" /><p>Carpenter</p></a>
              </div>
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/beauty"><img class="imgthumb" src="<?=base_url()?>images/beauty.jpg" alt="beauty" width="100" height="60" /><p>Beauty</p></a> 
              </div>
            </div>
            <div class="row text-center" style="margin-top:15px">
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/mobile_repair"><img class="imgthumb" src="<?=base_url()?>images/mobilerepair.jpg" alt="mobilerepair" width="70" height="60" /><p>Mobile Repair</p> </a>
              </div>
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/pestcontrol"><img class="imgthumb" src="<?=base_url()?>images/pestcontrol.jpg" alt="pestcontrol" width="70" height="70" /><p>Pest Control</p></a>
              </div>
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/painting"><img class="imgthumb" src="<?=base_url()?>images/paint.png" alt="paint" width="70" height="70" /><p>Painting</p> </a>
              </div>
            </div>
            <div class="row text-center" style="margin-top:15px">
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/fitness"><img class="imgthumb" src="<?=base_url()?>images/fitness.jpg" alt="fitness" width="70" height="60" /><p>Fitness</p></a> 
              </div>
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/appliances"><img class="imgthumb" src="<?=base_url()?>images/appliances.jpg" alt="appliances" width="90" height="60" /><p>Appliances</p></a> 
              </div>
              <div class="col-md-4">
                <a href="<?php echo base_url()?>Index/services/list_sp/home_cleaning"><img class="imgthumb" src="<?=base_url()?>images/homeclean.jpg" alt="homeclean" width="90" height="60" /><p>Home Cleaning</p></a> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="panel panel-default panel-hovered panel-stacked mb30">
          <div class="panel-heading">
            <h2 class="text-center text-primary">Make Life Easy </h2>
            <h4>High-quality Home Services.</h4>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="<?php echo base_url()?>Index/services/list_sp">
              <div class="form-group">
                <div class="col-md-12">
                  <select class="form-control" name="city">
                    <option value="1">Select Your city</option>
                    <option value="2">Hyderabad</option>
                    <option value="3">Benguluru</option>
                    <option value="4">Chennai</option>
                    <option value="5">Mumbai</option>
                    <option value="6">Kolkata</option>
                    <option value="7">Pune</option>
                    <option value="8">New Delhi</option>
                    <option value="9">Kochi</option>
                    <option value="10">Ahmedabad</option>
                    <option value="11">Jaipur</option>
                    <option value="12">Agra</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <select class="form-control" >
                    <option value="1">What Service Do You Need?</option>
                    <option value="2">For Electrical</option>
                    <option value="3">For Plumbing</option>
                    <option value="4">For Computer Repair</option>
                    <option value="5">For Laundry</option>
                    <option value="6">For Carpenter</option>
                    <option value="7">For Beauty</option>
                    <option value="8">For Mobile Repair</option>
                    <option value="9">For Pest Control</option>
                    <option value="10">For Painting</option>
                    <option value="11">For Fitness</option>
                    <option value="12">For Appliances</option>
                    <option value="13">For Home Cleaning</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-success pull-right">Book a service</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<script>
function changetap() {
	var image = document.getElementById('tap');
    if (image.src.match("tapon")) {
        image.src = "<?php echo base_url()?>images/tapoff.jpg";
    } else {
        image.src = "<?php echo base_url()?>images/tapon.jpg";
    }
}
</script> -->