<?php $this->load->view('website/user/link_block.php')?>
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
        <?php echo form_open('Agent/add_user','method="post" id="agentuser_form" class="form-horizontal"');
		
		?>
		 <div class="form-group">
               <label class="control-label col-sm-4"> ID:</label>
               <div class="col-sm-8">
              		<label class="control-label col-sm-4"><?php echo $userlist[0]["custid"]?></label>
              </div>
          </div>
		  
          <div class="form-group">
               <label class="control-label col-sm-4"> Name:</label>
               <div class="col-sm-8">
              		<label class="control-label col-sm-4"><?php echo $userlist[0]["userfullname"]?></label>
              </div>
          </div>
         
          <div class="form-group">
              <label class="control-label col-sm-4">Account Name:</label>
            <div class="col-sm-8">
                <label class="control-label col-sm-4"><?php echo $userlist[0]["account_name"]?></label>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Account No:</label>
            <div class="col-sm-8">
              <label class="control-label col-sm-4"><?php echo $userlist[0]["account_number"]?></label>
            </div>
          </div>
		  
		  <div class="form-group">
              <label class="control-label col-sm-4">Bank:</label>
            <div class="col-sm-8">
              <label class="control-label col-sm-4"><?php echo $userlist[0]["bank_name"]?></label>
            </div>
          </div>
		  
		  
		  <div class="form-group">
              <label class="control-label col-sm-4">Reference Number:</label>
            <div class="col-sm-8">
              <label class="control-label col-sm-4"><?php echo $userlist[0]["reference_number"]?></label>
            </div>
          </div>
		  
		   <div class="form-group">
              <label class="control-label col-sm-4">Amount:</label>
            <div class="col-sm-8">
              <label class="control-label col-sm-4"><i style="color:green;" class="fa fa-inr"></i> <?php echo number_format($userlist[0]["amount"],2)?></label>
            </div>
          </div>
		  
		   <div class="form-group">
              <label class="control-label col-sm-4">Payment Method:</label>
            <div class="col-sm-8">
              <label class="control-label col-sm-4">
			  
			    <?php
				$value = $userlist[0];
			   if($value["payment_mode"] ==2 )
			   {
				   echo "PayU";
			   }
			   else if($value["payment_mode"] ==1 )
			   {
				   echo "Bank";
			   }			  
			   else
			   {
				   echo "N/A";
			   }
			   ?>
			  </label>
            </div>
          </div>
		  
		  
		   <div class="form-group">
              <label class="control-label col-sm-4">Status:</label>
            <div class="col-sm-8">
              <label class="control-label col-sm-4">
			  
			    <?php
				$value = $userlist[0];
			  
			   if($value["payment_status"] ==0 )
			   {
				   echo "Pending";
			   }
			   else if($value["payment_status"] ==1 )
			   {
				   echo "Process";
			   }
			   else if($value["payment_status"] ==2 )
			   {
				   echo "Success";
			   }
			   else
			   {
				   echo "N/A";
			   }
			  
			   ?>
			  </label>
            </div>
          </div>
         
		  
		  
		  
		  <div class="form-group">
              <label class="control-label col-sm-4">Date Time:</label>
            <div class="col-sm-8">
               <label class="control-label col-sm-4"><?php echo date("d.m.y h:i:s",strtotime($userlist[0]["create_dt"]));?></label>
            </div>
          </div>
		  
		  
         <a href='javascript:;' onclick='javascript: history.go(-1)'>Back</a>
        </form>
      </div>
    </div>
  </div>
</div>





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