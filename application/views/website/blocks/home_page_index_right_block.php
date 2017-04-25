<div class="col-md-3 text-center">
   
    <div class="page-auth" id="login_container">
      <div class="auth-container">
        <div class="form-head mb20">
          <div class="text-normal h5">
            <div class="row">
              <div class="left"> <a href="" class="sign_btn"><i class="ion ion-lock-combination"></i> Sign In</a> </div>
              <div class="right"> <a href="" class="register_btn right"><i class="ion ion-person"></i> New Account</a> </div>
            </div>
          </div>
        </div>
        <div class="form-container" id="SignIn">
          <div class="alert alert-danger" style="display:none">
            <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> </button>
            <div class="msg"><i class="ion ion-checkmark"></i> Login success</div>
          </div>
          <form class="form-horizontal" action="javascript:;" id="login">
            <div class="form-group">
              <input type="email" class="form-control" autofocus name="username" id="username" placeholder="E-mail" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
            </div>
            <div class="clearfix mb15"><a href="forget-pass.html" class="text-success small">Forget your password?</a></div>
            <div class="btn-group btn-group-justified mb15">
              <div class="btn-group">
                <button type="submit" class="btn btn-success">Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <span id="asd"></span> 
      <!-- #end signin-container --> 
    </div>
    
    <div class="row mt20" id="offers">
      <div class="col-md-12">
        <h3>Special Offers</h3>
        <a href="Index/recharge" class="l"><img src="http://smsachariya.com/images/all-logo.gif" alt="earn more" /></a>
      </div>
    </div>
    
    
    <div class="page-auth" id="register_container" style="display:none;">
      <div class="auth-container">
        <div class="form-head mb10" id="register">
          <div class="text-normal h5">
            <div class="row">
              <div class="left"> <a href="" class="register_btn right"><i class="ion ion-person"></i> New Account</a> </div>
              <div class="right"> <a href="" class="sign_btn right"><i class="ion ion-lock-combination"></i> Sign In</a> </div>
            </div>
          </div>
          <div class="alert alert-danger" style="display:none">
            <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> </button>
            <div class="msg"></div>
          </div>
        </div>
        <div class="form-container"> <?php echo form_open('Welcome/register','method="post" id="register_form" class="form-horizontal"')?>
          <div class="form-group">
            <select class="form-control" name="usertype" required>
                <option value="0" selected="selected">Please Select</option>
                <?php foreach($roles as $row) { ?>
                <option value="<?=$row->role_id?>"><?=$row->role_name?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="hidden" value="" name="token" />
            <input type="email" class="form-control" name="email" placeholder="Email Id" required/>
          </div>
          <div class="form-group">
            <input type="text" class="form-control num_only" name="mobile" placeholder="Mobile No" required/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="cpassword" placeholder="Retype Password" required/>
          </div>
          <div class="form-group">
            <input type="text" id="geocomplete" class="form-control" name="ccity" placeholder="Your City" required/>
            <div class="map_canvas" style="display:none !important"></div>
          </div>
          <!-- <div class="form-group">
            <input type="text" class="form-control num_only" name="postal_code" placeholder="Zip-code" required/>
          </div> -->
          <div class="form-group mt10">
            <div class="ui-checkbox ui-checkbox-primary text-left">
              <label>
                <input type="checkbox" name="agree" required/>
                <span>Accept <a href="#" title="Terms & Conditions">T &amp; C.</a></span> </label>
            </div>
          </div>
          <div class="clearfix" style="margin-top:-10px;">
            <button type="submit" class="btn btn-primary right">Sign Up</button>
          </div>
          </form>
        </div>
      </div>
      <!-- #end signin-container --> 
    </div>
  </div>
</div>
<script>
$(document).on("click",".register_btn",function(e){e.preventDefault(),$("#login_container").hide(),$("#offers").hide(),$("#register_container").show()}),$(document).on("click",".sign_btn",function(e){e.preventDefault(),$("#register_container").hide(),$("#login_container").show(),$("#offers").show()});

$(document).ready(function(){$("#geocomplete").geocomplete({map:".map_canvas",details:"form",types:["geocode","establishment"]})});

$(document).on('submit','#register_form',function(){
	$.ajax({
		url : baseurl+'Welcome/register',
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
				$('.msg').parent('div').fadeOut(500,'swing',function(){
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
					$('.msg').parent('div').fadeOut(500,'swing',function(){
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


$(document).on('submit','#register_form',function(){
	$.ajax({
		url : baseurl+'Welcome/register',
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
				$('.msg').parent('div').fadeOut(500,'swing',function(){
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

$(document).ready(function(){$("#login").validate({rules:{username:{required:!0},password:{required:!0}}})});

$(document).ready(function(){$("#register_form").validate({rules:{email:{required:!0},mobile:{required:!0},password:{required:!0},cpassword:{required:!0},postal_code:{required:!0},agree:{required:!0}}})});
$(document).ready(function(){
  $("#geocomplete").geocomplete({
    map: ".map_canvas",
    details: "form",
    types: ["geocode", "establishment"],
  });
});
</script>
<style>
.pac-container:after{
    content:none !important;
}
</style>