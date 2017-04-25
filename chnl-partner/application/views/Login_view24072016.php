<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LAABUS | Login</title>
<link href="<?=base_url()?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url()?>admin_assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="<?=base_url()?>admin_assets/css/animate.css" rel="stylesheet">
<link href="<?=base_url()?>admin_assets/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="middle-box text-center loginscreen animated fadeInDown">
  <div>
    <div>
      <!--<h1 class="logo-name">IN+</h1>-->
      <div class="hidden-xs hidden-sm"><br/><br/><br/><br/><br/></div>
      <img src="<?=base_url()?>images/logo_laabus.png" class="logo-img"/>
    </div>
    <h3>Admin Login</h3>
    <?php if(!check_login_status()){?>
    <p>Login in. To see it in action.</p>
    <?php echo form_open('','class="m-t" role="form" id="login-form"')?>
    <div class="msg"><i class="ion ion-checkmark"></i> Login success</div>
      <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password" required="">
      </div>
      <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Login</button>
    </form>
    <?php } ?>
  </div>
</div>

<!-- Mainly scripts --> 
<script src="<?=base_url()?>admin_assets/js/jquery-2.1.1.js"></script> 
<script src="<?=base_url()?>admin_assets/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$(document).on('submit','#login-form',function() {
    // alert('hi am here');
		var username  = $(this).find('input[name="username"]').val();
		var passsword = $(this).find('input[name="password"]').val();
		location.href="<?php echo base_url()?>Admin/Categories";
		return false;
	});
});
/*$(document).ready(function() {
    $(document).on("submit", "#login", function() {
      var baseurl = "http://192.168.10.4:8312/laabus/www/";
        $.ajax({
            url: baseurl + 'admin/validate',
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
});*/
</script>
</body>
</html>
