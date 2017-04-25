<!--<a href="<?php echo base_url()?>index/channel_partner/dashboard">Goto Channel Partner</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url()?>index/agent/dashboard">Goto Agent Dashboard</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url()?>index/service_provider/multiple_sp/admin_sp">Goto Multiple Service Provider</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url()?>index/service_provider/single_sp/admin_sp">Goto Single Service Provider</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url('user/dashboard')?>">Goto User Dashboard</a>-->
&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('user/dashboard')?>">Goto User Dashboard</a>
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
<!-- Profile Starts-->
  <?php if(validation_errors()) { ?>
    <div class="alert alert-warning">
        <?php echo validation_errors(); ?>
    </div>
  <?php }else { ?>
        <div id="confirm-div"></div>
  <?php }?>
    
    
    

      <div class="tab-pane active" id="tab-linearrow-one">
          <?php echo form_open('common/update_profile','method="post" id="profile_form" class="form-horizontal"')?>
        <div class="edit-profile">
        	<button class="md-fab md-warn md-button md-mini waves-effect" title="Edit Profile" data-toggle="tooltip" data-placement="top">
		<i class="ion fa fa-edit"  ></i>
                </button>
       </div>

        <div class="row" style="margin-top:20px">
          <div class="col-md-2">
            <label>User Id<font color="red">*</font></label>
            <input type="text" class="form-control user-id" readonly="readonly" name="userid" id="userid" value="<?=$this->session->userdata('user_id')?>" />
          </div>
          <div class="col-md-4">
            <label>Full Name<font color="red">*</font></label>
            <input type="text" class="form-control"  name="fullname" id="fullname" value="<?php echo @$profile_info->Name;?>" readonly="readonly"/>
          </div>
          <div class="col-md-4">
            <label>Company Name</label>
            <input type="text" class="form-control" name="companyname" id="companyname" value="<?php echo @$profile_info->Company_Name;?>"  readonly="readonly"/>
          </div>
          <div class="col-md-2">
            <label>DOB</label>
            <div class="input-group date" id="datepickerDemo1">
              <input class="form-control" type="text"  name="datepickerDemo1" readonly="readonly" value="<?php echo @$profile_info->Dob;?>">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> </div>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4">
            <label>Mobile Number<font color="red">*</font></label>
            <input type="text" class="form-control" name="mobileno"  id="mobileno"  value="<?=$this->session->userdata('Mobile')?>" readonly="readonly" />
          </div>
          <div class="col-md-4">
            <label>Email<font color="red">*</font></label>
            <input type="text" class="form-control" name="emailid"  id="emailid"   value="<?=$this->session->userdata('email_id')?>" readonly="readonly" />
          </div>
          <div class="col-md-4">
            <label>City<font color="red">*</font></label>
            <input type="text" class="form-control" name="city" id="geocomplete" value="<?php echo @$profile_info->City;?>"  readonly="readonly"/>
            <div class="map_canvas" style="display:none !important"></div>
          </div>
        </div>
        <div class="row" style="margin-top:20px">
          <div class="col-md-8">
            <label>Address</label>
            <textarea class="form-control" name="address" id="address" rows="1"  readonly="readonly"><?php echo @$profile_info->Address;?></textarea>
          </div>
          <div class="col-md-4">
            <label>Postal Code<font color="red">*</font></label>
            <input   type="text" class="form-control" name="postalcode" id="postalcode" value="<?php echo @$profile_info->Postal_code;?>" readonly="readonly">
          </div>
        </div>
        <div class="row text-right show-save-button" style="margin-top:20px; display:none">
          <button type="submit" name="form_type" value="profile" class="btn btn-success waves-effect">Save & Update Profile</button>
        </div>
              </form>
      </div>
  
        <!--Profile Ends -->
        
<!-- KYC starts-->
      <div class="tab-pane" id="tab-linearrow-two">
          <?php echo form_open('common/update_profile','method="post" id="kyc_form" class="form-horizontal" enctype="multipart/form-data"')?>
      <div class="edit-kyc">
        	<button class="md-fab md-warn md-button md-mini waves-effect" title="Edit kyc" data-toggle="tooltip" data-placement="top">
				<i class="ion fa fa-edit"></i>
            </button>
       </div>

        <div class="row" style="margin-top:20px">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-4">
                <label>First Name<font color="red">*</font></label>
                <input type="text" name="firstname" class="form-control" required readonly="readonly" value="<?php echo @$kyc_info->first_name;?>" title="Please enter First Name"/>
              </div>
              <div class="col-md-4">
                <label>Middle Name</label>
                <input type="text" name="middlename" class="form-control" required readonly="readonly" title="Please enter Middle Name" value="<?php echo @$kyc_info->middle_name;?>"/>
              </div>
              <div class="col-md-4">
                <label>Last Name<font color="red">*</font></label>
                <input type="text" name="lastname" class="form-control" required readonly="readonly" title="Please enter Last Name" value="<?php echo @$kyc_info->last_name;?>"/>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-5">
                <label>Mother Name<font color="red">*</font></label>
                <input type="text" name="mothername" class="form-control" required readonly="readonly" title="Please enter Mother Name" value="<?php echo @$kyc_info->mother_name;?>"/>
              </div>
              <div class="col-md-4">
                <label>Date of Birth<font color="red">*</font></label>
                <div class="input-group date" id="datepickerDemo">
                  <input type="text" class="form-control" name="datepickerDemo" required readonly="readonly" title="Please enter Date of Birth" value="<?php echo @$kyc_info->dob;?>"/>
                  <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
              </div>
              <div class="col-md-3">
                <label>Gender<font color="red">*</font></label>
                <p>
                  <label>
                    <input type="radio" name="gender" value="1">
                    Female</label>
                  <label>
                    <input type="radio" checked name="gender" value="2">
                    Male</label>
                </p>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-12">
                <label>Permanent Address<font color="red">*</font></label>
                <textarea class="form-control" name="praddress" rows="2" required title="Please enter Permanent Address" readonly="readonly"/><?php echo @$kyc_info->permanent_address;?></textarea>
              </div>
            </div>
            <div class="row" style="margin-top:20px">
              <div class="col-md-12">
                <label>Communication Address<font color="red">*</font></label>
                <textarea class="form-control" name="comaddress" required title="Please enter Permanent Address" rows="2" readonly="readonly"/><?php echo @$kyc_info->communication_address;?></textarea>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h4 style="margin-top:20px">Bussiness Details<font color="red">*</font></h4>
            <div class="row">
              <div class="col-md-10">
                <label>Bussiness type</label>
                <input type="text" class="form-control" name="btype" readonly="readonly" value="<?php echo @$kyc_info->bussiness_type;?>"/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-11">
                <label>Organization Name</label>
                <textarea class="form-control" rows="5" name="organizationname" readonly="readonly" /><?php echo @$kyc_info->organization_name;?></textarea>
              </div>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Upload Photo<font color="red">*</font></label>
              <input type="hidden"  name="h_photo" value="<?php echo @$kyc_info->photo;?>"/>
              <input type="file"  name="photo" <?php if(empty($kyc_info->photo)){?>required<?php }?> title="Please upload photo" readonly="readonly"/>
              <a href="<?php echo base_url();?>uploads/profile/<?php echo $this->session->userdata('user_id');?>/<?php echo @$kyc_info->photo;?>" target="_blank"><?php echo @$kyc_info->photo;?></a>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Upload Pan card<font color="red">*</font></label>
              <input type="hidden"  name="h_pancard" value="<?php echo @$kyc_info->pancard;?>"/>
              <input type="file" name="pancard"  <?php if(empty($kyc_info->pancard)){?>required<?php }?> title="Please upload PAN Card" readonly="readonly"/>
              <a href="<?php echo base_url();?>uploads/profile/<?php echo $this->session->userdata('user_id');?>/<?php echo @$kyc_info->pancard;?>" target="_blank"><?php echo @$kyc_info->pancard;?></a>
            </div>
            <div class="row" style=" padding-left:7px">
              <label>Resident Proof<font color="red">*</font></label>
              <input type="hidden"  name="h_proof" value="<?php echo @$kyc_info->resident_proof;?>"/>
              <input type="file"  name="proof"  <?php if(empty($kyc_info->resident_proof)){?>required<?php }?> title="Please upload Resident Proof" readonly="readonly"/>
              <a href="<?php echo base_url();?>uploads/profile/<?php echo $this->session->userdata('user_id');?>/<?php echo @$kyc_info->resident_proof;?>" target="_blank"><?php echo @$kyc_info->resident_proof;?></a>
            </div>
          </div>
        </div>
        <div class="row text-right submit" style="margin-top:20px; display:none">
          <button type="submit" name="form_type" value="kyc" class="btn btn-success waves-effect">Submit</button>
        </div>
      </form>
      </div>
<!-- KYC ends -->

<!--bank details starts-->
     <div class="tab-pane" id="tab-linearrow-three">
         <?php echo form_open('common/update_profile','method="post" id="bank_form" class="form-horizontal"')?>
        <div class="row" style="margin-top:20px">
          <div class="col-md-4 col-md-offset-1">
            <label>Account Holder Name<font color="red">*</font></label>
            <input type="text" class="form-control" name="holdername" id="holdername" value="<?php echo @$bank_info->acc_holder_name;?>">
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label>Account Type<font color="red">*</font></label>
            <select class="form-control" name="accounttype" id="accounttype">
              <option value="current">Current Account</option>
              <option value="saving">Saving Account</option>
            </select>
          </div>
        </div>
        <div class="row" style="margin-top:20px" >
          <div class="col-md-4 col-md-offset-1" id="selectaccount">
            <p>
              <label>
                <input type="radio" name="accountselect" checked="checked" value="bankname">
                Bank Name<font color="red">*</font>
              </label>
              <label>
                <input type="radio" name="accountselect" value="ifsc">
                IFSC Code<font color="red">*</font>
              </label>
            </p>
          </div>
        </div>
        <div class="row" style="margin-top:20px;" id="showbank">
          <div class="col-md-4 col-md-offset-1">
            <label>Branch Name<font color="red">*</font></label>
            <input type="text" name="branchname" id="branchname"  class="form-control" value="<?php echo @$bank_info->branch_name;?>">
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label>Bank Name<font color="red">*</font></label>
            <input type="text" name="bankname" id="bankname" class="form-control" value="<?php echo @$bank_info->bank_name;?>">
          </div>
        </div>
         
        <div class="row" style="margin-top:20px;display:none" id="showifsc">
          <div class="col-md-4 col-md-offset-1">
            <label>IFSC Code<font color="red">*</font></label>
            <input type="text" name="ifsccode" id="ifsccode" class="form-control" value="<?php echo @$bank_info->ifsc_code;?>">
          </div>
        </div>
         
        <div class="row" style="margin-top:20px">
          <div class="col-md-4 col-md-offset-1">
            <label>Account Number<font color="red">*</font></label>
            <input type="text" class="form-control" name="accountno" id="accountno" value="<?php echo @$bank_info->acc_number;?>">
          </div>
          <div class="col-md-4 col-md-offset-1">
            <label>Confirm Account Number<font color="red">*</font></label>
            <input type="text" class="form-control" name="confirmacctno" id="confirmacctno">
          </div>
        </div>
        <div class="row text-right" style="margin-top:20px">
          <button name="form_type" value="bank" class="btn btn-success waves-effect">Submit</button>
        </div>
     </form>
      </div>
<!--bank details ends -->

<!--Company details starts-->
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
<!--Company details ends -->

    </div>
  </div>
    
</div>
<script>
$(document).ready(function() {
    //alert('heloo');
$('#bank_form input').on('change', function() {
   //if($('#account').is(':checked')) { alert("it's checked"); }
   if($('input[name=accountselect]:checked', '#bank_form').val()=='ifsc'){
       $('#showifsc').show();
       $('#showbank').hide();
   }else{
       $('#showifsc').hide();
       $('#showbank').show();
   }

});
    
$('#confirm-div').hide();
    <?php if($this->session->flashdata('msg')){ ?>
        $('#confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();
        $('#confirm-div').addClass("alert alert-warning");
        //$('#li-changepassword').addClass("active");
        //$('#li-account').removeClass("active");
        setTimeout(function() { $("#confirm-div").hide(); }, 5000);
    <?php }?>
        
});

$(document).ready(function(){
	$("#geocomplete").geocomplete({
	  map: ".map_canvas",
	  details: "form",
	  types: ["geocode", "establishment"],
	});
        
        
        $("#profile_form").validate({
                    rules: {
                            //usertype: {required: {depends: function(element) {return $("#usertype").val() == '';}}},
                            fullname: {required: true},
                            mobileno:{required:true,minlength:10,maxlength:10},
                            emailid:{required:true,email:true},
                            city:{required:true},
                            postalcode:{required:true},
                          },
                    messages: {
                            fullname:{required:"Please enter Full Name"},
                            mobileno:{required:"Please enter Mobile Number"},
                            emailid:{required:"Please enter Email",email:"Please enter valid Email"},
                            city:{required: "Please enter City"},
                            postalcode:{required: "Please enter Postcode"},
                            
                            },
                            
                submitHandler: function(form) {
                    form.submit();
                    
                }              
        });
        
        
        $("#kyc_form").validate({
                submitHandler: function(form) {
                    form.submit();
                }
         
        });
        
        $("#bank_form").validate({
                    rules: {
                            holdername: {required: true,minlength: 3,maxlength: 50,lettersonly: true},
                            accounttype:{required:true},
                            branchname:{required:true,lettersonly: true},
                            bankname:{required:true,lettersonly: true},
                            ifsccode:{required:true,ifsc_code: true},
                            accountno:{required:true,minlength: 8,number: true},
                            confirmacctno:{required:true,equalTo : "#accountno",number: true},
                          },
                    messages: {
                            holdername:{required:"Please enter Account Holder Name"},
                            accounttype:{required:"Please select Account Type"},
                            branchname:{required:"Please enter Branch Name"},
                            bankname:{required:"Please enter Bank Name"},
                            ifsccode:{required:"Please enter IFSC Code"},
                            accountno:{required: "Please enter Account Number",number: "Please enter only numbers"},
                            confirmacctno:{required: "Please enter Confirm Account Number",equalTo:"Please verify your Account Number",number: "Please enter only numbers"},
                            
                            },
                            
                submitHandler: function(form) {
                    form.submit();
                    
                }
        
        });
        
     jQuery.validator.addMethod("lettersonly", function(value, element) {
					return this.optional(element) || /^[a-zA-Z ]*$/i.test(value);
				}, "Please enter only letters"); 
     jQuery.validator.addMethod("ifsc_code", function(value, element) {
					return this.optional(element) || /^[A-Z]{4}(0)[\d]{6}$/i.test(value);
				}, "Please enter valid IFSC code");   
        
});

$(function () {
                $('#datepickerDemo').datepicker({
                     format: "yyyy-mm-dd"
                });
                $('#datepickerDemo1').datepicker({
                    format: "yyyy-mm-dd"
                });
            });
            
            
            
</script>
<script>
$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip();});

$('.edit-profile').click(function(){
    //alert('helooooooo');return false;
	$('#tab-linearrow-one').find('input[readonly="readonly"]').removeAttr("readonly");
	$('#tab-linearrow-one').find('textarea[readonly="readonly"]').removeAttr("readonly");
	$('#tab-linearrow-one').find('.user-id').attr("readonly","readonly");
	$('.show-save-button').show();
	$(this).hide();
        return false;
});
/*$(document).on('click','.show-save-button',function(){
	$(this).find('button').html('Please wait &nbsp;&nbsp;&nbsp;<i class="ion fa fa-circle-o faa-burst animated"></i>');
	alert("Updated Successfully");
	$(this).find('button').html('Save & Update Profile');
	$('#tab-linearrow-one').find('input').attr("readonly","readonly");
	$('#tab-linearrow-one').find('textarea').attr("readonly","readonly");
	$('.edit-profile').show();
	$(this).hide();
});*/
$(document).on('click','body',function(){
	var uid = $('.user-id').attr('readonly');
	if(typeof uid !== typeof undefined && uid !== false);
	else $('.user-id').attr('readonly','readonly');	
});
	
</script>          
          
       <script>
$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip();});

$('.edit-kyc').click(function(){
    
	$('#tab-linearrow-two').find('input[readonly="readonly"]').removeAttr("readonly");
	$('#tab-linearrow-two').find('textarea[readonly="readonly"]').removeAttr("readonly");
	$('.submit').show();
	$(this).hide();
        return false;
});
/*$(document).on('click','.submit',function(){
	$(this).find('button').html('Please wait &nbsp;&nbsp;&nbsp;<i class="ion fa fa-circle-o faa-burst animated"></i>');
	alert("Updated Successfully");
	$(this).find('button').html('Save & Update Kyc');
	$('#tab-linearrow-two').find('input').attr("readonly","readonly");
	$('#tab-linearrow-two').find('textarea').attr("readonly","readonly");
	$('.edit-kyc').show();
	$(this).hide();
});*/

	
</script>
<style>
.pac-container:after{
    content:none !important;
}
</style>