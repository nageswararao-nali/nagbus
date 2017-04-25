<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laabus | Channel Partner Login</title>
		<link rel="icon" type="image/png" href="http://laabus.com/images/logo_laabus3.png" />
        <link href="<?= base_url() ?>admin_assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/animate.css" rel="stylesheet">
        <link href="<?= base_url() ?>admin_assets/css/style.css" rel="stylesheet">
    </head>

    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <div class="hidden-xs hidden-sm"><br/><br/><br/><br/><br/></div>
                    <img src="<?= base_url() ?>images/logo_laabus.png" class="logo-img"/>
                </div>
                <h3>Channel Partner Login</h3>
                <p>Login in. To see it in action.</p>
                <?php
                if ($this->session->flashdata('msg') != '') {
                    if (is_array($this->session->flashdata('msg'))) {
                        $messages = $this->session->flashdata('msg');
                        ?>
                        <div class="alert alert-danger" style="margin: 0px !important">
                            <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> </button>
                            <div class="msg"><?= $messages['error'] ?></div>
                        </div>
                        <?php
                    }
                }
                ?>
                <?php echo form_open(base_url() . 'welcome/', array('class' => 'form-horizontal', 'id' => 'loginAction')); ?>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" >
                </div>
                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Login</button>
                <?php echo form_close(); ?>
            </div>
        </div>

        <!-- Mainly scripts --> 
        <script src="<?= base_url() ?>admin_assets/js/jquery-2.1.1.js"></script> 
        <script src="<?= base_url() ?>admin_assets/js/bootstrap.min.js"></script>

        <script src="<?= base_url() ?>admin_assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url() ?>admin_assets/js/plugins/validate/jquery.validate.min.js"></script>


        <script>

<?php if (isset($jqueryJavaScript)) { ?>
    <?php echo $jqueryJavaScript; ?>
<?php } ?>



            /*$(document).on('submit', '#login-form', function() {
             $.ajax({
             url: '<?php echo base_url('admin/validate'); ?>',
             data: $('#login-form').serialize(),
             type: 'post',
             success: function(res) {
             var obj = JSON.parse(res);
             if (obj.err_code == 1) {
             $("#login-form").trigger("reset");
             $('.msg').parent('div').removeClass('alert-danger');
             $('.msg').parent('div').addClass('alert-success');
             $('.msg').parent('div').show();
             $('.msg').html(obj.message);
             $('.msg').parent('div').fadeOut(3000, 'swing', function() {
             window.location.href = '<?php echo base_url() . 'dashboard' ?>';
             });
             }
             else {
             $('.msg').parent('div').removeClass('alert-success');
             $('.msg').parent('div').addClass('alert-danger');
             $('.msg').parent('div').show();
             $('.msg').html(obj.message);
             }
             }
             })
             return false;
             })*/
        </script>
    </body>
</html>