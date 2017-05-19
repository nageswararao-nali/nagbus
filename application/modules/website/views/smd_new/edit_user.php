<?php $this->load->view('website/smd_new/menu_block.php')?>
<div class="row">
  <div class="col-md-6">

         <?php if(validation_errors()) { ?>
    <div class="alert alert-warning">
        <?php echo validation_errors(); ?>
    </div>
    <?php }else if($this->session->flashdata('msg')){ ?>
<div class="alert alert-warning">
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <?php }?>

    <div class="panel panel-default">

      <div class="panel-body">
        <?php echo form_open('Smd/updateuser','method="post" id="agentuser_form" class="form-horizontal"')?>
          <div class="form-group">
               <label class="control-label col-sm-4">Name:</label>
               <div class="col-sm-8">
              		<input type="text" class="form-control" name="FirstName" id="FirstName" value="<?php echo $userlist[0]["name"]?>" />
					<input type="hidden" class="form-control" name="user_id"  value="<?php echo $userlist[0]["user_id"]?>" />
              </div>
          </div>

          <div class="form-group">
              <label class="control-label col-sm-4">Email Id:</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" name="email"  id="email" value="<?php echo $userlist[0]["email_id"]?>"/>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Mobile No:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control num_only" name="mobile" id="mobile" value="<?php echo $userlist[0]["mobile"]?>" />
            </div>
          </div>

          <div class="form-group">
              <label class="control-label col-sm-4">Address:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="Address" id="Address" value="<?php echo $userlist[0]["address"]?>"/>
            </div>
          </div>

          <div class="form-group">
              <label class="control-label col-sm-4">Pin Code:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" disabled readonly name="nono" id="111" value="<?php echo $userlist[0]["pincode"]?>"/>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">City :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" disabled readonly name="no" id="222" value="<?php echo $userlist[0]["city_name"]?>"/>
            </div>
          </div>
           <div class="form-group">
              <label class="control-label col-sm-4">District:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" disabled readonly name="no1" id="2221" value="<?php echo $userlist[0]["district_name"]?>"/>
            </div>
          </div>



          <button type="submit" class="btn btn-success pull-right">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){

        $("#agentuser_form").validate({
                    rules: {
                            //usertype: {required: {depends: function(element) {return $("#usertype").val() == '';}}},

                            email:{required:true,email:true},
                            mobile:{required:true,minlength:10,maxlength:10},


                            FirstName:{required:true},
                            Address:{required:true},
                            },
                    messages: {

                            email:{required:"Please enter Email Id",email:"Please enter valid Email Id"},
                            mobile:{required:"Please enter Mobile No"},
                            FirstName:{required: "Please enter Name"},
                            Address:{required: "Please enter Address"},
                            },

                submitHandler: function(form) {
                    form.submit();
                }


        });


});

</script>



<!--<div class="col-md-12 mb30">
  <div class="panel panel-info panel-hovered panel-stacked mb30 text-left">
    <div class="clearfix tabs-linearrow">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-linearrow-one" data-toggle="tab" aria-expanded="false">My Account</a></li>
        <li class=""><a href="#tab-linearrow-two" data-toggle="tab" aria-expanded="true">KYC</a></li>
        <li class=""><a href="#tab-linearrow-three" data-toggle="tab" aria-expanded="true">Change Password</a></li>
        <li class=""><a href="#tab-linearrow-four" data-toggle="tab" aria-expanded="true">Edit Your Account</a></li>
      </ul>
    </div>
    <div class="tab-content" >
      <div class="tab-pane active" id="tab-linearrow-one">
        <div class="row" style="margin-top:20px">
          <div class="col-md-2">
            <label>User Id<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-2">
            <label>User Name</label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label>Full Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label>Company Name</label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>Mobile Number<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label>Email<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label>City<font color="red">*</font></label>
            <input type="text" class="form-control" name="city" id="geocomplete" required>
            <div class="map_canvas" style="display:none !important"></div>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-8">
            <label>Address</label>
            <textarea class="form-control" name="content"  rows="1" ></textarea>
          </div>
          <div class="col-md-4">
            <label>Postal Code<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row text-right" style="margin-top:20px">
          <button type="button" class="btn btn-success waves-effect">Update Profile</button>
        </div>
      </div>
      <div class="tab-pane" id="tab-linearrow-two">
        <div class="row" >
          <div class="col-md-8">
            <div class="row" style="margin-top:20px">
              <div class="col-md-4">
                <label>First Name<font color="red">*</font></label>
                <input type="text" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Middle Name</label>
                <input type="text" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Last Name<font color="red">*</font></label>
                <input type="text" class="form-control" required>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-5">
                <label>Mother Name<font color="red">*</font></label>
                <input type="text" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label>Date of Birth<font color="red">*</font></label>
                <div class="input-group date" id="datepickerDemo">
                  <input type="text" class="form-control" required>
                  <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
              </div>
              <div class="col-md-3">
                <label>Gender<font color="red">*</font></label>
                <p>
                  <label>
                    <input type="radio" name="account">
                    Female</label>
                  <label>
                    <input type="radio" name="account">
                    Male</label>
                </p>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-12">
                <label>Permanent Address<font color="red">*</font></label>
                <textarea class="form-control" name="content" rows="2"></textarea>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-12">
                <label>Communication Address<font color="red">*</font></label>
                <textarea class="form-control" name="content" rows="2"></textarea>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h4 style="margin-top:20px">Bussiness Details<font color="red">*</font></h4>
            <div class="row">
              <div class="col-md-10">
                <label>Bussiness type</label>
                <input type="text" class="form-control" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-11">
                <label>Organization Name</label>
                <textarea class="form-control" name="content" rows="5" required></textarea>
              </div>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Upload Photo</label>
              <input type="file"  name="browse" required/>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Upload Pan card</label>
              <input type="file" name="browse" required/>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Resident Proof</label>
              <input type="file"  name="browse" required/>
            </div>
          </div>
        </div>
        <div class="row text-right" style="margin-top:20px">
          <button type="button" class="btn btn-success waves-effect">Submit</button>
        </div>
      </div>
      <div class="tab-pane" id="tab-linearrow-three">
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>Current Password</label>
            <input type="password" class="form-control" required>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>New Password</label>
            <input type="password" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label>Confirm New Password</label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row text-right" style="margin-top:20px">
          <button type="password" class="btn btn-success waves-effect">Submit</button>
        </div>
      </div>
      <div class="tab-pane" id="tab-linearrow-four">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
              <label>Change Designation</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Change Time</label>
              <input type="text" class="form-control" required>
            </div>
          </div>
          <div class="row" style="margin-top:20px">
            <div class="col-md-4">
              <label>Change Your Qualification</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Add Reviews</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Change Hours of Operation</label>
              <input type="text" class="form-control" required>
            </div>
          </div>
          <div class="row" style="margin-top:20px">
            <div class="col-md-8">
              <label>Update Your Listed services</label>
              <input class="form-control" name="content">
            </div>
            <div class="col-md-4">
              <label>Change Moderating</label>
              <input type="text" class="form-control" required>
            </div>
          </div>
          <div class="row text-right" style="margin-top:20px">
            <button type="button" class="btn btn-success waves-effect">Update Profile</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
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
-->