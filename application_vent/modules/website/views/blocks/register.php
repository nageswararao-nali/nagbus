<style>
.colorgraph {
	height: 5px;
	border-top: 0;
	background: #c4e17f;
	border-radius: 5px;
	background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
</style>
<div class="col-md-5">
  <div class="panel panel-lined mb20 panel-hovered">
    <div class="row">
      <h3 class="text-light text-center">Sign Up</h3>
    </div>
    <hr class="colorgraph">
    <div class="panel-body">
      <form class="form-horizontal" role="form" accept-charset="utf-8">
        <div class="form-group">
          <input class="col-md-12 col-xs-12" style="height:35px" type="text" placeholder="Enter Full Name" name="Full name">
        </div>
        <div class="form-group">
          <input class="col-md-12 col-xs-12" style="height:35px" type="text" placeholder="Enter email address" name="Full name">
        </div>
        <div class="form-group">
          <input class="col-md-5 col-xs-5" style="height:35px" type="text" placeholder="Enter Password" name="Full name">
          <input class="col-md-offset-1 col-md-6 col-xs-offset-1 col-xs-6"  style=" height:35px" type="text" placeholder="Conform Password" name="Full name">
        </div>
        <div class="form-group">
          <div class="col-sm-12"> I want to join as </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-6">
                <input type="radio" name="usertype" value="channel_partner" id="cp">
                <label for="cp">Channel Partner</label>
              </div>
              <div class="col-sm-6">
                <input type="radio" name="usertype" value="service_provider" id="sp">
                <label for="sp">Service Provider</label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <input type="radio" name="usertype" value="agent" id="agent">
                <label for="agent">Agent</label>
              </div>
              <div class="col-sm-6">
                <input type="radio" name="usertype" value="user" id="user" checked>
                <label for="user">User</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12" id="locationField">
            <input type="text" class="form-control auto" id="autocomplete" placeholder="Address" name="address" onfocus="geolocate()" autocomplete="off">
            <i class="fa fa-map-marker form-control-feedback"></i> </div>
        </div>
        <div class="form-group">
          <div class=" col-sm-12">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="agree">
                Accept our <a href="#">privacy policy</a> and <a href="#">customer agreement</a> </label>
            </div>
          </div>
        </div>
        <hr class="colorgraph">
        <div class="form-group">
          <button type="submit" class="col-md-5 btn btn-success">Register</button>
          <button type="submit" class="col-md-5 col-md-offset-2 right btn btn-success">Sign In</button>
        </div>
      </form>
    </div>
  </div>
</div>
