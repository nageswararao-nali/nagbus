<?php if(check_login_status()){?>
<!--	Welcome to <?php echo $this->session->userdata('email')?> <a href="<?php echo base_url('Logout')?>">Logout</a>
-->

<div class="row">
  <div class="col-md-11">
    <div class="panel mb20 panel-default panel-hovered">
      <div class="dash-head clearfix mt10 mb10">
        <div class="left" style="padding-left:15px;">
          <h4><b> INCOME</b> Today: <i class="fa fa-inr" style="font-size:24px; color:green;" ></i>
            <mark style="color:green ">1000</mark>
            This month: <i class="fa fa-inr" style="font-size:24px; color:green;"></i>
            <mark style="color:green">5000</mark>
            This Year: <i class="fa fa-inr" style="font-size:24px; color:green;"></i>
            <mark style="color:green">10,000</mark>
          </h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-1" style="margin-left:-20px;">
    <div class="panel panel-default mb20 mini-box panel-hovered" style="width:100px;">
      <div class="panel-body prod-box" style="height:37px;">
        <div class="clearfix">
          <div class="info text-center">
            <h4 class="mt0 mb0 text-success"><b><strong>Wallet</strong></b></h4>
          </div>
        </div>
      </div>
      <div class="panel-footer clearfix panel-footer-sm panel-footer-success"  style="height:35px;">
        <h5 class="mb0" style="margin-top:-6px; margin-left:-10px; margin-right:-10px;"><i class="fa fa-inr" style="font-size:14px"></i>5,00,000</h5>
      </div>
    </div>
  </div>
  <!--<div class="col-md-1">
    <div class="text-center right" >
      <div class="panel mb20 panel-default panel-hovered" style="height:40px;"> <strong>Wallet</strong> <br/>
        <button class="btn btn-success btn-xs mt15 waves-effect" style="height:42px;">&nbsp;&nbsp;&nbsp;<i class="fa fa-inr"></i>&nbsp;&nbsp;5,00,000</button>
      </div>
    </div>
  </div>--> 
</div>
<div class="row">
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-person text-success"></i><br/>
      <button class="btn btn-success btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">My Account <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="#" id="updateprofile">Update Profile</a></li>
        <li><a href="#" id="bankdetails">Bank Details</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered"> <i class="ion ion-stats-bars text-danger"></i><br/>
      <button class="btn btn-danger btn-xs mt15 waves-effect">View Reports</button>
    </div>
  </div>
</div>
<div class="row" id="profile" style="display:none">
  <div class="col-md-12">
    <div class="panel panel-default mb20 mini-box panel-hovered">
      <div class="panel panel-body">
      <h3>UPDATE PROFILE</h3>
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
            <textarea class="form-control" name="content" rows="1"></textarea>
          </div>
          <div class="col-md-4">
            <label>Postal Code<font color="red">*</font></label>
            <input type="text" class="form-control" required>
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
        <div class="row text-right" style="margin-top:20px">
          <button type="button" class="btn btn-success waves-effect">Update Profile</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="display:none" id="details">
  <div class="col-md-12">
    <div class="panel panel-default mb20 mini-box panel-hovered">
      <div class="panel panel-body">
      <h3>BANK DETAILS</h3>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>Account Holder Name<font color="red">*</font></label>
            <input type="text" class="form-control" >
          </div>
          <div class="col-md-4">
            <label>Account Type<font color="red">*</font></label>
            <select class="form-control">
              <option>Current Account</option>
              <option>Saving Account</option>
            </select>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>
              <input type="radio" name="account">
              Bank Name<font color="red">*</font></label>
            <label>
              <input type="radio" name="account">
              IFSC Code<font color="red">*</font></label>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>Branch Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label>Bank Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>IFSC Code<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>Account Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label>Confirm Account Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row text-right" style="margin-top:20px">
          <button type="button" class="btn btn-success waves-effect">Submit</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).on("click","#bankdetails",function(){
	$("#details").show(),
	$("#profile").hide()
});
$(document).on("click","#updateprofile",function(){
	$("#details").hide(),
	$("#profile").show()
});
$('#updateprofile').click();
</script>
<?php }else { ?>
<h1 class="text-center">Please click login to continue</h1>
<?php }?>
