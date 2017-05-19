<div class="page page-auth">
  <div class="auth-container">
    <div class="form-head mb20">
      <h1 class="site-logo h2 mb30 mt5 text-center text-uppercase text-bold"><a href="<?php echo base_url()?>">Laabus</a></h1>
      <p class="small">Already have an account. <a href="<?php echo base_url('login')?>">Sign In Now</a></p>
      <div class="alert alert-danger" style="display:none">
        <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> </button>
        <div class="msg"></div>
      </div>
    </div>
<!--    <div class="alert alert-danger" style="display:none">
        <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> </button>
        <div class="msg"></div>
    </div>-->

    <?php if(validation_errors()) { ?>
    <div class="alert alert-warning">
        <?php echo validation_errors(); ?>
    </div>
    <?php }else if($this->session->flashdata('msg')){ ?>
<div class="alert alert-warning">
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <?php }?>

    <div class="form-container">
        <!--Welcome/register  onkeyup="checkEmail(this.value)"-->

    <?php echo form_open('Welcome/register','method="post" id="register_form" class="form-horizontal"')?>
          <div class="form-group">
            <select class="form-control" name="usertype"  id="usertype">
                <option value="">Please Select Your Role</option>
                <?php foreach($roles as $row) { if($row->enable == 1) {
                    if($row->role_id == $this->input->post('usertype')){
                        $selected = " selected=selected ";
                    } else {
                        $selected = "";
                    }
                    ?>
                <option value="<?=$row->role_id?>" <?php echo $selected;?>><?=$row->role_name?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>


		  <div class="form-group">
            <input type="hidden" value="" name="token" />
            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" value="<?php echo set_value('name'); ?>"/>
          </div>

          <div class="form-group">
            <input type="hidden" value="" name="token" />
            <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" value="<?php echo set_value('email'); ?>"/>
          </div>
          <div class="form-group">
            <input type="text" class="form-control num_only" name="mobile" id="mobile" placeholder="Mobile No" value="<?php echo set_value('mobile'); ?>"/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password"/>
          </div>
          <div class="form-group">
            <select class="form-control" name="country" id="ccountry" onChange="getStates(this.value)">
                <option value="" selected="selected">Please Select Your Country</option>
                <?php foreach($country as $c) { if($c->Country_Code == IN) {

                        if($c->Country_Code == $this->input->post('country')){
                        $selected = " selected=selected ";
                        } else {
                        $selected = "";
                        }
                    ?>
                <option value="<?=$c->Country_Code?>" <?php echo $selected;?>><?=$c->Country_Name?></option>
              <?php } } ?>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" name="state" id="old_state" onChange="getDistrict(this.value)">
                <option value="" selected="selected">Please Select Your State</option>
                <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" name="district" id="old_district" onChange="getCities(this.value)">
                <option value="" selected="selected">Please Select Your District</option>
                <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" name="city" id="old_city" onChange="getPincode(this.value)">
                <option value="" selected="selected">Please Select Your City</option>
                <option value=""></option>
            </select>
          </div>
          <!-- <div class="form-group">
            <?php foreach($pincode as $cpin): ?>
            <input type="hidden" readonly="readonly" id="old_pinc" class="form-control" name="pincode" value="<?php echo $cpin->Pincode; ?>" placeholder="Your Pincode" required/>
            <?php endforeach; ?>
          </div> -->
          <!-- <div class="form-group">
            <input type="text" class="form-control num_only" name="postal_code" placeholder="Zip-code" required/>
          </div> -->




            <input type="hidden" class="form-control" name="promo_code" id="promo_code" placeholder="Promo Code" value=""/>

            <input type="hidden" name="smd_id" value="<? echo ($this->input->post())? set_value('smd_id'): $smd_user_id ?>"/>


          <div class="form-group mt10">
            <div class="ui-checkbox ui-checkbox-primary text-left">
              <label>
                <input type="checkbox" name="agree"/>
                <span>Accept <a href="#" title="Terms & Conditions">T &amp; C.</a></span> </label>
            </div>
          </div>
          <div class="clearfix" style="margin-top:-10px;">
            <button type="submit" name="submit" class="btn btn-primary right">Sign Up</button>
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


        $("#register_form").validate({
                    rules: {
                            //usertype: {required: {depends: function(element) {return $("#usertype").val() == '';}}},
							name:{required:true},
                            usertype: {required: true},
                            email:{required:true,email:true},
                            mobile:{required:true,minlength:10,maxlength:10},
                            password :{required:true,minlength:6,maxlength:20},
                            cpassword :{required:true,minlength:6,maxlength:20,equalTo : "#password"},
                            country:{required:true},
                            state:{required:true},
                            district:{required:true},
                            city:{required:true},
                            agree:"required"

                            },
                    messages: {
							usertype:{required:"Please enter your full name "},
                            usertype:{required:"Please select role"},
                            email:{required:"Please enter email id",email:"Please enter valid email id"},
                            mobile:{required:"Please enter mobile no"},
                            password  : {required:"Please enter password",minlength:"Password should have minimum 6 characters",maxlength:"Password should have Maximum 20 characters"},
                            cpassword  : {required:"Please enter confirm password",minlength:"Confirm Password should have minimum 6 characters",maxlength:"Confirm Password should have Maximum 20 characters",equalTo:"Password and confirm password should be same"},
                            country:{required: "Please select country"},
                            state:{required: "Please select state"},
                            district:{required: "Please select district"},
                            city:{required: "Please select city"},
                            agree: "Please accept our policy"

                            },

                submitHandler: function(form) {
                    form.submit();
                }


        });


});

function getStates(id) {
      //alert('this id value :'+id);
  $.ajax({
      type: "POST",
      url: '<?php echo base_url('Welcome/ajax_state_list').'/';?>'+id,
      data: id='cat_id',
      success: function(data){
          //alert(data);
          $('#old_state').html(data);
      },
  });
}

function getDistrict(id) {
  // alert('this id value :'+id);
  $.ajax({
        type: "POST",
        url: '<?php echo base_url('Welcome/ajax_district_list').'/';?>'+id,
        data: id='cat_id',
        success: function(data){
            //alert(data);
            $('#old_district').html(data);
      },
  });
}

function getCities(id) {
  // alert('this id value :'+id);
  $.ajax({
        type: "POST",
        url: '<?php echo base_url('Welcome/ajax_cities_list').'/';?>'+id,
        data: id='cat_id',
        success: function(data){
            //alert(data);
            $('#old_city').html(data);
      },
  });
}

function getPincode(id) {
  // alert('this id value :'+id);
  $.ajax({
        type: "POST",
        url: '<?php echo base_url('Welcome/ajax_pincode').'/';?>'+id,
        data: id='cat_id',
        success: function(data){
            //alert(data);
            $('#old_pinc').html(data);
      },
  });
}




/*$(document).on('submit','#register_form',function(){

	$.ajax({
		url : '<?php echo base_url('Welcome/register'); ?>',
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
					window.location.href='<?php echo base_url().'Welcome/login'?>';
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
})*/
</script>