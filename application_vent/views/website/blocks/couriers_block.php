<div class="row">
  <div class="col-md-4 text-center">
  <img id="courier" onclick="changecourier()" src="<?php echo base_url()?>images/courier1.jpg" alt="courier1" width="60%"/>
 </div>
  <div class="col-md-8">
    <div class="row text-center">
      <div class="col-md-4 prod-title-left">
        <h3>Courier Services</h3>
      </div>
      <div class="col-md-6">
        <p>World's Most Cost Effective, Penetrated & Instant Communication Platform. Connecting 200+ Countries 800+ Networks.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default mb20 mini-box panel-hovered">
              <div class="panel-body prod-box" >
                <div class="clearfix">
                  <div class="info text-center">
                    <h2 class="mt0 mb0 text-success">1000+</h2>
                  </div>
                </div>
              </div>
              <div class="panel-footer clearfix panel-footer-sm panel-footer-success text-center" >
                <h4 class="mt0 mb0">Countries</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default mb20 mini-box panel-hovered">
              <div class="panel-body prod-box" >
                <div class="clearfix">
                  <div class="info text-center">
                    <h2 class="mt0 mb0 text-primary">1000+</h2>
                  </div>
                </div>
              </div>
              <div class="panel-footer clearfix panel-footer-sm panel-footer-primary text-center" >
                <h4 class="mt0 mb0">Agencies</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default mb20 mini-box panel-hovered">
              <div class="panel-body prod-box" >
                <div class="clearfix">
                  <div class="info text-center">
                    <h2 class="mt0 mb0 text-danger">1000+</h2>
                  </div>
                </div>
              </div>
              <div class="panel-footer clearfix panel-footer-sm panel-footer-danger text-center" >
                <h4 class="mt0 mb0">Laabus courier</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-offset-6 col-md-2 prod-title-left text-center">
        <button type="button" class="btn btn-line-pink btn-rounded waves-effect">Overview</button>
      </div>
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-pink btn-rounded waves-effect">Book A Document</button>
      </div>
    </div>
  </div>
</div>
<script>
function changecourier() {
    var image = document.getElementById('courier');
    if (image.src.match("courier2")) {
        image.src = "<?php echo base_url()?>images/courier1.jpg";
    } else {
        image.src = "<?php echo base_url()?>images/courier2.jpg";
		setTimeout(function(){location.href='<?php echo base_url()?>Index/courier'},300);
    }
};
</script> 