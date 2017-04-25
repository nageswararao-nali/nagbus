<?php $this->load->view('website/channel_partner/links_block.php')?>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-body">
         <form class="form-horizontal" method="post" action="http://laabus.com/channel_partner/save_partner">
        <!--<div class="form-group">
        <label class="control-label col-sm-4">Company Investment:</label>
               <div class="col-sm-8">
              		<input type="text" class="form-control" name="Investment" required/>
              </div>
        </div>-->
        <div class="form-group">
        <label class="control-label col-sm-4">Investment Amount:</label>
               <div class="col-sm-8">
              		<input type="text" class="form-control" name="invest_amount" required/>
              </div>
        </div>
        <div class="form-group">
        <label class="control-label col-sm-4">Percentage:</label>
               <div class="col-sm-8">
              		<input type="text" class="form-control" name="percentage" required/>
              </div>
        </div>
          <div class="form-group">
               <label class="control-label col-sm-4">First Name:</label>
               <div class="col-sm-8">
              		<input type="text" class="form-control" name="first_name" required/>
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-sm-4">Last Name:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="last_name" required/>
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
              <input type="text" class="form-control" name="address" required/>
            </div>
          </div>
          <div class="form-group">
          <label class="control-label col-sm-4">Zip Code:</label>
          <div class="col-sm-8">
            <input type="text" class="form-control num_only" name="zipcode" required/>
          </div>
          </div>
          <div class="ui-radio ui-radio-pink">
        <label class="ui-radio-inline">
          <input type="radio" checked name="invest_type" value="1" required/>
          <span>Working &amp; inverstment</span> </label>
        <label class="ui-radio-inline">
          <input type="radio" name="invest_type" value="2" required/>
          <span>Inverstment</span> </label>
          </div>
          <button type="submit" class="btn btn-success pull-right">register</button>
        </form>
      </div>
    </div>
  </div>
</div>

<table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th> First Name</th>
            <th> Last Name</th>
            <th> Invetsment</th>
            <th> Percentage</th>
          
            <th> Action</th>
          </tr>
        </thead>
        <tbody>
		<?php
		foreach($userlist as $key=>$value)
		{
		?>
		 <tr>
            <td> <?php echo $value["first_name"];?></td>
            <td> <?php echo $value["last_name"];?></td>
            <td> <?php echo $value["invest_amount"];?></td>
			<td> <?php echo $value["percentage"];?></td>           
            <td> N/A</td>
          </tr>
		<?php }
		?>
        </tbody>
      </table>
