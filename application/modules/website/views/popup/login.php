<div class="modal modalFadeInScale" id="Login">
  <div class="modal-dialog" style="width:450px;">
    <div class="modal-content">
      <div class="modal-header clearfix bg-dark">
        <div class="small text-uppercase left title">Login</div>
        <button class="close right" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-head mb20">
          <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"><a href="<?php echo base_url()?>">Laabus</a></h1>
          <h5 class="text-normal h5 text-center">Sign In to proceed</h5>
        </div>
        <div class="form-container">
          <div class="alert alert-danger" style="display:none">
            <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> </button>
            <div class="msg">Login success</div>
          </div>
          <form class="form-horizontal" action="javascript:;" id="login">
            <div class="md-input-container md-float-label">
              <input type="email" class="md-input" autofocus name="username" id="username">
              <label>Email Id</label>
            </div>
            <div class="md-input-container md-float-label">
              <input type="password" class="md-input" name="password" id="password">
              <label>Password</label>
            </div>
            <div class="clearfix">
              <div class="ui-checkbox ui-checkbox-primary">
                <label>
                  <input type="checkbox" name="remember">
                  <span>Remember me</span> </label>
              </div>
            </div>
            <div class="clearfix mb15"><a href="forget-pass.html" class="text-success small">Forget your password?</a></div>
            <div class="btn-group btn-group-justified mb15">
              <div class="btn-group">
                <button type="button" class="btn btn-facebook"><span class="ion ion-social-facebook"></span>&nbsp;&nbsp;Facebook</button>
              </div>
              <div class="btn-group">
                <button type="submit" class="btn btn-success">Sign In</button>
              </div>
            </div>
            <div class="clearfix text-center small">
              <p>Don't have an account? <a href="<?php echo base_url('Register')?>">Create Now</a></p>
            </div>
          </form>
        </div>
      </div>
      <span id="asd"></span> 
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    $(document).on("submit", "#login", function() {
        $.ajax({
            url: baseurl + 'Login/validate',
            data: $("#login").serialize(),
            cache: false,
            type: 'post',
            success: function(a) {
                var obj = JSON.parse(a);
				if(obj.err_code==1){
					$("#login").trigger("reset");
					$('.msg').parent('div').removeClass('alert-danger');
					$('.msg').parent('div').addClass('alert-success');
					$('.msg').parent('div').show();
					$('.msg').html(obj.message);
					$('.msg').parent('div').fadeOut('fast','swing',function(){
						$('#Login').modal('hide'); 
						$('.recharge_content').show();
						//window.location.href='<?php $url = isset($red) ? $red : 'Login'; echo base_url().$url?>';
					});
				}else{
					$('.msg').parent('div').removeClass('alert-success');
					$('.msg').parent('div').addClass('alert-danger');
					$('.msg').parent('div').show();
					$('.msg').html(obj.message);
				}
            }
        })
    })
});
$('#Login').modal({
    show: true
});
</script> 
