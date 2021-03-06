<?php if(check_login_status()){?>
<!--	Welcome to <?php echo $this->session->userdata('email')?> <a href="<?php echo base_url('Logout')?>">Logout</a>
-->
<div class="col-md-12 mb30">
  <div class="panel panel-info panel-hovered panel-stacked mb30 text-left">
    <div class="clearfix tabs-linearrow">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-linearrow-one" data-toggle="tab" aria-expanded="false">My Account</a></li>
        <li class=""><a href="#tab-linearrow-two" data-toggle="tab" aria-expanded="true">KYC</a></li>
        <li class=""><a href="#tab-linearrow-three" data-toggle="tab" aria-expanded="true">Bank Details</a></li>
        <li class=""><a href="#tab-linearrow-four" data-toggle="tab" aria-expanded="true">Change Password</a></li>
        <li class=""><a href="#tab-linearrow-five" data-toggle="tab" aria-expanded="true">Edit Your Account</a></li>
        <li class=""><a href="#tab-linearrow-six" data-toggle="tab" aria-expanded="true">Support Matrix</a></li>
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
      <div class="tab-pane" id="tab-linearrow-five">
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
      <div class="tab-pane" id="tab-linearrow-six">
        <div class="row" style="margin-bottom:10px;">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                  <table>
                  <thead>
                  <tr><th colspan="2">COMPANY DETAILS</td></th>
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
                      <td  style="width:50%">Contact Number:</td>
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
                      <td  style="width:50%">Contact Number:</td>
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
