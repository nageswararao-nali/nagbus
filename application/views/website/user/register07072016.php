<div class="page page-auth">
  <div class="auth-container">
    <div class="form-head mb20">
      <h1 class="site-logo h2 mb30 mt5 text-center text-uppercase text-bold"><a href="<?=base_url()?>">Laabus</a></h1>
      <p class="small">Already have an account. <a href="<?php echo base_url('Login')?>">Sign In Now</a></p>
      <div class="alert alert-danger" style="display:none">
        <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> </button>
        <div class="msg"></div>
      </div>
    </div>
    <div class="form-container"> <?php echo form_open('Register/validate','method="post" id="register_form" class="form-horizontal"')?>
      <div class="form-group">
        <input type="text" class="form-control" name="fullname" placeholder="Full Name" required/>
        <input type="hidden" value="<?php $msg="laabus_registration_form_laabus"; $key="laabus_flipinterest"; $encval=$this->encrypt->encode($msg,$key); $this->session->set_userdata('register_form_key',$encval);echo $encval;?>" name="token" />
      </div>
      <div class="form-group">
        <input type="email" class="form-control" placeholder="Email Id" name="email" required/>
      </div>
      <div class="form-group">
        <input type="text" class="form-control num_only" placeholder="Mobile No" name="mobile" required/>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required/>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Retype Password" name="cpassword" required/>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="address" placeholder="Address" id="geocomplete" required/>
        <input type="hidden" name="country" />
        <input type="hidden" name="lat" />
        <input type="hidden" name="lng" />
        <input type="hidden" name="location" />
        <input type="hidden" name="country" />
        <input type="hidden" name="country_short" />
        <input type="hidden" name="administrative_area_level_1" data-id="state" />
        <input type="hidden" name="url" />
        <input type="hidden" name="formatted_address" />
        <div class="map_canvas" style="display:none !important"></div>
      </div>
      <div class="form-group">
        <input type="text" class="form-control num_only" placeholder="Postal/Pin/Zip Code" name="postal_code" required/>
      </div>
      <div class="ui-radio ui-radio-pink">
        <label class="ui-radio-inline">
          <input type="radio" checked name="usertype" value="user" required/>
          <span>User</span> </label>
        <label class="ui-radio-inline">
          <input type="radio" name="usertype" value="agent" required/>
          <span>Agent</span> </label>
        <label class="ui-radio-inline">
          <input type="radio" name="usertype" value="service_provider" required/>
          <span>Service Provider</span> </label>
        <label class="ui-radio-inline">
          <input type="radio" name="usertype" value="channel_partner" required/>
          <span>Channel Partner</span> </label>
      </div>
      <div class="clearfix mt10">
        <div class="ui-checkbox ui-checkbox-primary">
          <label>
            <input type="checkbox" name="agree" required/>
            <span>I agree to the <a href="">terms and conditions for use.</a></span> </label>
        </div>
      </div>
      <div class="clearfix">
        <button type="submit" class="btn btn-primary right">Sign Up</button>
      </div>
      </form>
    </div>
  </div>
  <!-- #end signin-container --> 
</div>
<script>
$(document).ready(function(){
	$("#geocomplete").geocomplete({
	  map: ".map_canvas",
	  details: "form",
	  types: ["geocode", "establishment"],
	});
});
$(document).on('submit','#register_form',function(){
	$.ajax({
		url : baseurl+'Register/validate',
		data : $('#register_form').serialize(),
		type : 'post',
		success : function(res){
			var obj = JSON.parse(res);
			if(obj.err_code==1){
				$("#register_form").trigger("reset");
				$('.msg').parent('div').removeClass('alert-danger');
				$('.msg').parent('div').addClass('alert-success');
				$('.msg').parent('div').show();
				$('.msg').html(obj.message);
				$('.msg').parent('div').fadeOut(3000,'swing',function(){
					window.location.href='<?php echo base_url().'Login'?>';
				});
			}
			else{
				$('.msg').parent('div').removeClass('alert-success');
				$('.msg').parent('div').addClass('alert-danger');
				$('.msg').parent('div').show();
				$('.msg').html(obj.message);
			}
		}
	})
	return false;
})
</script>