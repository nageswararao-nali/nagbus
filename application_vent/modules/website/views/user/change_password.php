<?php $this->load->view('website/user/link_block.php')?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <h3 class="text-center text-primary">Change Password</h3>
      <?php echo form_open('common/update_password','method="post" id="changepassword_form" class="form-horizontal"')?>
      <div class="panel-body">
          
            <?php if(validation_errors()) { ?>
                <div class="alert alert-warning">
            <?php echo validation_errors(); ?>
                </div>
            <?php }else if($this->session->flashdata('msg')){ ?>
                <div class="alert alert-warning">
            <?php echo $this->session->flashdata('msg'); ?>
                </div>
            <?php }?>
          
        <div class="row">
          <div class="col-md-4">
            <label>Current Password</label>
            <input type="password" class="form-control"  name="current_password" id="current_password">
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>New Password</label>
            <input type="password" class="form-control"  name="new_password" id="new_password">
          </div>
          <div class="col-md-4">
            <label>Confirm New Password</label>
            <input type="text" class="form-control"  name="confirm_password" id="confirm_password">
          </div>
        </div>
        <div class="row text-right" style="margin-top:20px">
          <button type="submit" class="btn btn-success waves-effect">Submit</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
	
        $("#changepassword_form").validate({
                    rules: {
                            current_password :{required:true,minlength:6,maxlength:20},
                            new_password :{required:true,minlength:6,maxlength:20},
                            confirm_password :{required:true,minlength:6,maxlength:20,equalTo : "#new_password"},
                            },
                    messages: {
                            current_password  : {required:"Please enter Current password",minlength:"Password should have minimum 6 characters",maxlength:"Password should have maximum 20 characters"},
                            new_password  : {required:"Please enter New password",minlength:"New password should have minimum 6 characters",maxlength:"New password should have maximum 20 characters"},
                            confirm_password :{required:"Please enter Confirm password",minlength:"New password should have minimum 6 characters",maxlength:"Confirm password should have maximum 20 characters",equalTo:"New password and confirm password should be same"},
                            },
                            
                submitHandler: function(form) {
                    form.submit();
                }              
        });
        
        
});
</script>