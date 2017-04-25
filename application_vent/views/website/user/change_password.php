<?php $this->load->view('website/user/link_block.php')?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <h3 class="text-center text-primary">Change Password</h3>
      <div class="panel-body">
        <div class="row">
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
    </div>
  </div>
</div>
