
<div class="page page-auth">
  <div class="auth-container" style="width:400px;">
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
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Email ID" autofocus name="username" id="username">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
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
  <!-- #end signin-container --> 
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
					$('.msg').parent('div').fadeOut(3000,'swing',function(){
						window.location.href='<?php echo base_url().'Login'?>';
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
</script> 
