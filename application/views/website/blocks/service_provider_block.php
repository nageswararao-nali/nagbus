<div class="row">
  <div class="col-md-8">
    <div class="row text-center">
      <div class="col-md-4 prod-title-left">
        <h3>Home Services</h3>
      </div>
      <div class="col-md-6">
        <p>World's Most Cost Effective, Penetrated & Instant Communication Platform.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default mb20 mini-box panel-hovered">
              <div class="panel-body prod-box">
                <div class="clearfix">
                  <div class="info text-center">
                    <h2 class="mt0 mb0 text-success">1000</h2>
                  </div>
                </div>
              </div>
              <div class="panel-footer clearfix panel-footer-sm panel-footer-success text-center">
                <h4 class="mt0 mb0">Services</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default mb20 mini-box panel-hovered">
              <div class="panel-body prod-box">
                <div class="clearfix">
                  <div class="info text-center">
                    <h2 class="mt0 mb0 text-primary">1000+</h2>
                  </div>
                </div>
              </div>
              <div class="panel-footer clearfix panel-footer-sm panel-footer-primary text-center">
                <h4 class="mt0 mb0">Servies Provider</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default mb20 mini-box panel-hovered">
              <div class="panel-body prod-box">
                <div class="clearfix">
                  <div class="info text-center">
                    <h2 class="mt0 mb0 text-danger">10+</h2>
                  </div>
                </div>
              </div>
              <div class="panel-footer clearfix panel-footer-sm panel-footer-danger text-center">
                <h4 class="mt0 mb0">Locations</h4>
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
        <button type="button" class="btn btn-pink btn-rounded waves-effect">Book A service</button>
      </div>
    </div>
  </div>
  <div class="col-md-3 text-center">
    <img id="myImage" onclick="changeImage()" src="<?php echo base_url()?>images/bulboff.jpg" alt="bulboff" width="100px" height="150px" />
  </div>
</div>
<script>
function changeImage() {
    var image = document.getElementById('myImage');
    if (image.src.match("bulbon")) {
        image.src = "<?php echo base_url()?>images/bulboff.jpg";
    } else {
        image.src = "<?php echo base_url()?>images/bulbon.jpg";
		setTimeout(function(){location.href='<?php echo base_url()?>Index/services'},300);
    }
};
</script> 