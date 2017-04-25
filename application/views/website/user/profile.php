<?php if(check_login_status()){?>
<!--	Welcome to <?php echo $this->session->userdata('email')?> <a href="<?php echo base_url('Logout')?>">Logout</a>
-->

<a href="<?php echo base_url()?>index/channel_partner/dashboard">Goto Channel Partner</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url()?>index/agent/dashboard">Goto Agent Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url()?>index/service_provider/multiple_sp/admin_sp">Goto Multiple Service Provider</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url()?>index/service_provider/single_sp/admin_sp">Goto Single Service Provider</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url()?>index/user/dashboard">Goto User Dashboard</a>
<div class="col-md-12 mb30">
  <div class="panel panel-info panel-hovered panel-stacked mb30 text-left">
    <div class="clearfix tabs-linearrow">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-linearrow-one" data-toggle="tab" aria-expanded="false">Profile</a></li>
        <li class=""><a href="#tab-linearrow-two" data-toggle="tab" aria-expanded="true">KYC</a></li>
        <li class=""><a href="#tab-linearrow-three" data-toggle="tab" aria-expanded="true">Bank Details</a></li>
        <li class=""><a href="#tab-linearrow-four" data-toggle="tab" aria-expanded="true">Support Matrix</a></li>
      </ul>
    </div>
    <div class="tab-content" >
      <div class="tab-pane active" id="tab-linearrow-one">
        <div class="edit-profile">
        	<button class="md-fab md-warn md-button md-mini waves-effect" title="Edit Profile" data-toggle="tooltip" data-placement="top">
				<i class="ion fa fa-edit"  ></i>
            </button>
       </div>
<script>
$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip();});

$('.edit-profile').click(function(){
	$('#tab-linearrow-one').find('input[readonly="readonly"]').removeAttr("readonly");
	$('#tab-linearrow-one').find('textarea[readonly="readonly"]').removeAttr("readonly");
	$('#tab-linearrow-one').find('.user-id').attr("readonly","readonly");
	$('.show-save-button').show();
	$(this).hide();
});
$(document).on('click','.show-save-button',function(){
	$(this).find('button').html('Please wait &nbsp;&nbsp;&nbsp;<i class="ion fa fa-circle-o faa-burst animated"></i>');
	alert("Updated Successfully");
	$(this).find('button').html('Save & Update Profile');
	$('#tab-linearrow-one').find('input').attr("readonly","readonly");
	$('#tab-linearrow-one').find('textarea').attr("readonly","readonly");
	$('.edit-profile').show();
	$(this).hide();
});
$(document).on('click','body',function(){
	var uid = $('.user-id').attr('readonly');
	if(typeof uid !== typeof undefined && uid !== false);
	else $('.user-id').attr('readonly','readonly');	
});
	
</script>
        <div class="row" style="margin-top:20px">
          <div class="col-md-2">
            <label>User Id<font color="red">*</font></label>
            <input type="text" class="form-control user-id" required readonly="readonly" value="<?=$this->session->userdata('userid')?>" title="User id cannot be changed" />
          </div>
          <div class="col-md-4">
            <label>Full Name<font color="red">*</font></label>
            <input type="text" class="form-control" required  value="<?=$this->session->userdata('name')?>" readonly="readonly"/>
          </div>
          <div class="col-md-4">
            <label>Company Name</label>
            <input type="text" class="form-control" required readonly="readonly"/>
          </div>
          <div class="col-md-2">
            <label>DOB</label>
            <div class="input-group date" id="datepickerDemo1">
              <input class="form-control" type="text" readonly="readonly">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>Mobile Number<font color="red">*</font></label>
            <input type="text" class="form-control" required value="<?=$this->session->userdata('Mobile')?>" readonly="readonly" />
          </div>
          <div class="col-md-4">
            <label>Email<font color="red">*</font></label>
            <input type="text" class="form-control" required value="<?=$this->session->userdata('email')?>" readonly="readonly" />
          </div>
          <div class="col-md-4">
            <label>City<font color="red">*</font></label>
            <input type="text" class="form-control" name="city" id="geocomplete" required readonly="readonly"/>
            <div class="map_canvas" style="display:none !important"></div>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-8">
            <label>Address</label>
            <textarea class="form-control" name="content"  rows="1" readonly="readonly"></textarea>
          </div>
          <div class="col-md-4">
            <label>Postal Code<font color="red">*</font></label>
            <input type="text" class="form-control" required readonly="readonly">
          </div>
        </div>
        <div class="row text-right show-save-button" style="margin-top:20px; display:none">
          <button type="button" class="btn btn-success waves-effect">Save & Update Profile</button>
        </div>
      </div>
      <div class="tab-pane" id="tab-linearrow-two">
      <div class="edit-kyc">
        	<button class="md-fab md-warn md-button md-mini waves-effect" title="Edit kyc" data-toggle="tooltip" data-placement="top">
				<i class="ion fa fa-edit"></i>
            </button>
       </div>
       <script>
$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip();});

$('.edit-kyc').click(function(){
	$('#tab-linearrow-two').find('input[readonly="readonly"]').removeAttr("readonly");
	$('#tab-linearrow-two').find('textarea[readonly="readonly"]').removeAttr("readonly");
	$('.submit').show();
	$(this).hide();
});
$(document).on('click','.submit',function(){
	$(this).find('button').html('Please wait &nbsp;&nbsp;&nbsp;<i class="ion fa fa-circle-o faa-burst animated"></i>');
	alert("Updated Successfully");
	$(this).find('button').html('Save & Update Kyc');
	$('#tab-linearrow-two').find('input').attr("readonly","readonly");
	$('#tab-linearrow-two').find('textarea').attr("readonly","readonly");
	$('.edit-kyc').show();
	$(this).hide();
});

	
</script>
        <div class="row" style="margin-top:20px">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-4">
                <label>First Name<font color="red">*</font></label>
                <input type="text" class="form-control" required readonly="readonly"/>
              </div>
              <div class="col-md-4">
                <label>Middle Name</label>
                <input type="text" class="form-control" required readonly="readonly"/>
              </div>
              <div class="col-md-4">
                <label>Last Name<font color="red">*</font></label>
                <input type="text" class="form-control" required readonly="readonly"/>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-5">
                <label>Mother Name<font color="red">*</font></label>
                <input type="text" class="form-control" required readonly="readonly"/>
              </div>
              <div class="col-md-4">
                <label>Date of Birth<font color="red">*</font></label>
                <div class="input-group date" id="datepickerDemo">
                  <input type="text" class="form-control" required readonly="readonly"/>
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
                <textarea class="form-control" name="content" rows="2" readonly="readonly"/></textarea>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-12">
                <label>Communication Address<font color="red">*</font></label>
                <textarea class="form-control" name="content" rows="2" readonly="readonly"/></textarea>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h4 style="margin-top:20px">Bussiness Details<font color="red">*</font></h4>
            <div class="row">
              <div class="col-md-10">
                <label>Bussiness type</label>
                <input type="text" class="form-control" required readonly="readonly"/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-11">
                <label>Organization Name</label>
                <textarea class="form-control" name="content" rows="5" required readonly="readonly"/></textarea>
              </div>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Upload Photo</label>
              <input type="file"  name="browse" required readonly="readonly"/>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Upload Pan card</label>
              <input type="file" name="browse" required readonly="readonly"/>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Resident Proof</label>
              <input type="file"  name="browse" required readonly="readonly"/>
            </div>
          </div>
        </div>
        <div class="row text-right submit" style="margin-top:20px; display:none">
          <button type="button" class="btn btn-success waves-effect">Submit</button>
        </div>
      </div>
     <div class="tab-pane" id="tab-linearrow-three">
        <div class="row" style="margin-top:20px">
          <div class="col-md-4 col-md-offset-1">
            <label>Account Holder Name<font color="red">*</font></label>
            <input type="text" class="form-control" >
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label>Account Type<font color="red">*</font></label>
            <select class="form-control">
              <option>Current Account</option>
              <option>Saving Account</option>
            </select>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4 col-md-offset-1">
            <p>
              <label>
                <input type="radio" name="account">
                Bank Name<font color="red">*</font></label>
              <label>
                <input type="radio" name="account">
                IFSC Code<font color="red">*</font></label>
            </p>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4 col-md-offset-1">
            <label>Branch Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label>Bank Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4 col-md-offset-1">
            <label>IFSC Code<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4 col-md-offset-1">
            <label>Account Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label>Confirm Account Name<font color="red">*</font></label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="row text-right" style="margin-top:20px">
          <button type="button" class="btn btn-success waves-effect">Submit</button>
        </div>
      </div>
      <div class="tab-pane" id="tab-linearrow-four">
        <div class="row" style="margin-bottom:10px;">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                  <table>
                    <thead>
                      <tr>
                        <th colspan="2">COMPANY DETAILS</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="width:30%;">Company Name:</td>
                        <td>Varini Info System Pvt. Ltd.</td>
                      </tr>
                      <tr>
                        <td>Company city:</td>
                        <td>Hyderabad</td>
                      </tr>
                      <tr>
                        <td>Company Address:</td>
                        <td>302, Sri Kalki Chambers, Opp. Reliance Fresh, Madinaguda, Hyderabad</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">SALES CONTACT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="width:50%">Contact Number:</td>
                      <td>9999999999</td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td>sales@gmail.com</td>
                    </tr>
                    <tr>
                      <td style="vertical-align:top">Sales Timings:</td>
                      <td>9:30am to 5:30pm (Mon-Sat)</td>
                    </tr>
                    <tr>
                      <td style="vertical-align:top">Sales Comments:</td>
                      <td>You can also contact your account manager for Sales Enquires</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">SUPPORT CONTACT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="width:50%">Contact Number:</td>
                      <td>9999999999</td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td>support@gmail.com</td>
                    </tr>
                    <tr>
                      <td style="vertical-align:top">Support Timings:</td>
                      <td>9:30am to 5:30pm (Mon-Sat)</td>
                    </tr>
                    <tr>
                      <td style="vertical-align:top">Support Comments:</td>
                      <td>You can also contact your account manager for Support Enquires</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">BILLING CONTACT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="width:50%">Contact Number:</td>
                      <td>9999999999</td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td>billing@gmail.com</td>
                    </tr>
                    <tr>
                      <td style="vertical-align:top">Billing Timings:</td>
                      <td>9:30am to 5:30pm (Mon-Sat)</td>
                    </tr>
                    <tr>
                      <td style="vertical-align:top">Billing Comments:</td>
                      <td>You can also contact your account manager for Billing Queries</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
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
<?php }else { ?>
<h1 class="text-center">Please click login to continue</h1>
<?php }?>