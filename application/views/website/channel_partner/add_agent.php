<?php $this->load->view('website/channel_partner/links_block.php')?>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-body">
        <form class="form-horizontal">
          <div class="form-group">
               <label class="control-label col-sm-4">First Name:</label>
               <div class="col-sm-8">
              		<input type="text" class="form-control" name="FirstName" required/>
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Last Name:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="LastName" required/>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Email Id:</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" name="email" required/>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Mobile No:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control num_only" name="mobile" required/>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Password:</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="password" required/>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Retype Password:</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="cpassword" required/>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Address:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="Address" required/>
            </div>
          </div>
          <div class="form-group">
          <label class="control-label col-sm-4">Zip Code:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control num_only" name="postal_code" required/>
          </div>
          </div>
          <button type="submit" class="btn btn-success pull-right">register</button>
        </form>
      </div>
    </div>
  </div>
</div>
