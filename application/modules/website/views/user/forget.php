<!--this page is not used in any where-->
    <div class="page page-auth">
      <div class="auth-container">
        <div class="form-head mb20">
          <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"><a href="<?php echo base_url()?>">Laabus</a></h1>
      <h5 class="text-normal h5 text-center">Forget Password</h5>
        </div>
        <div class="form-container">
            
            <?php if(validation_errors()) { ?>
            
                <div class="alert alert-warning">
                    <?php echo validation_errors(); ?>
                </div>
            <?php }else if ($this->session->flashdata('msg') != ''){ ?>
            
                <div class="alert alert-warning" id="fmsg">
                    <?php echo  $this->session->flashdata('msg');?>
                </div>
            
            <?php }?>
            
            
          <?php echo form_open('Forgotpassword/doforget','method="post" id="forgotpassword_form" class="form-horizontal"')?>
            <p class="small text-center mb20">Enter your email address or Mobile Number you've registered with us. We'll send Password into your registered Mobile Number.</p>
            <div class="md-input-container md-float-label">
              <input type="text" name="email" id="email" class="md-input">
              <label>Email Id</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block text-uppercase btn-lg">Send Password</button>
          </form>
        </div>
      </div>
    </div>

<script>
$(document).ready(function(){
    
    $("#forgotpassword_form").validate({
                    rules: {
                            email:{required:true},
                    },
                    messages: {
                           email:{required:"Please enter email id or Mobile Number"},
                    },
                            
                submitHandler: function(form) {
                    form.submit();
                }
                        
                            
        });
        
        setTimeout(function() {
            $('#fmsg').fadeOut('fast');
        }, 20000);
    
});
</script>
  
