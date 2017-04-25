<div class="page page-auth">

	
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