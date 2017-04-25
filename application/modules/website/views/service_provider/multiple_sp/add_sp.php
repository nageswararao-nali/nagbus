<?php $this->load->view('website/service_provider/multiple_sp/links_block.php')?>
<div class="page-auth" id="register_container">
      <div class="auth-container">
        <div class="form-head mb10" id="register">
        <h4>Add a Service Provider</h4>
        </div>
        <div class="form-container"> <?php echo form_open('Register/validate','method="post" id="register_form" class="form-horizontal"')?>
          <div class="form-group">
            <select class="form-control" name="usertype" required>
              <option>Join as</option>
              <option value="service_provider">Service Provider</option>
            </select>
          </div>
          <div class="form-group">
            <input type="hidden" value="<?php $msg="laabus_registration_form_manikanta"; $key="laabus_flipinterest"; $encval=$this->encrypt->encode($msg,$key); $this->session->set_userdata('register_form_key',$encval);echo $encval;?>" name="token" />
            <input type="email" class="form-control" name="email" placeholder="Email Id" required/>
          </div>
          <div class="form-group">
            <input type="text" class="form-control num_only" name="mobile" placeholder="Mobile No" required/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required/>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="cpassword" placeholder="Retype Password" required/>
          </div>
          <div class="form-group">
            <input type="text" class="form-control num_only" name="postal_code" placeholder="Zip-code" required/>
          </div>
          <div class="form-group mt10">
            <div class="ui-checkbox ui-checkbox-primary text-left">
              <label>
                <input type="checkbox" name="agree" required/>
                <span>Accept <a href="#" title="Terms & Conditions">T &amp; C.</a></span> </label>
            </div>
          </div>
          <div class="clearfix" style="margin-top:-10px;">
            <button type="submit" class="btn btn-primary right">Sign Up</button>
          </div>
          </form>
        </div>
      </div>
      <!-- #end signin-container --> 
    </div>

<!--<div class="row">
<div class="col-md-12 mb30">
  <div class="panel panel-default panel-hovered panel-stacked mb30 text-left">
    
    <div class="panel-body" >
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
      
    </div>
  </div>
</div>
-->