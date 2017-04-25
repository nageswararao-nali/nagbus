<!--<div class="row">
  <div class="col-md-1 col-md-offset-8">
    <input type="radio" name="service_provider" id="Active">
    <label>Active</label>
  </div>
  <div class="col-md-1">
    <input type="radio" name="service_provider" id="Inactive">
    <label>Inactive</label>
  </div>
<div class="col-md-2 text-center"> <a href="<?php echo base_url()?>Index/service_provider/multiple_sp/add_sp">Add a Service Provider</a> </div>
</div>-->

<div class="site-settings clearfix hidden-xs">
  <div class="settings clearfix">
    <div class="trigger left"><img src="<?=base_url()?>images/logo_laabus_footer.png" style="width:25px; height:25px;" alt="Laabus"></div>
    <div class="site-wrapper left">
      <div class="ui-toggle ui-toggle-primary">
        <ul class="list-unstyled other-settings">
          <li class="clearfix mb10">
            <div class="left">Active</div>
            <div class="right">
              <label>
                <input type="radio" name="toggleEg" checked>
                <span>&nbsp;</span> </label>
            </div>
          </li>
          <li class="clearfix mb10">
            <div class="left">Inactive</div>
            <div class="right">
              <label>
                <input type="radio" name="toggleEg">
                <span></span> </label>
            </div>
          </li>
        </ul>
      </div>
      <hr/>
      <ul class="themes list-unstyled">
        <li><a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook" style="font-size:30px;"></i></a></li>
        <li><a target="_blank" href="https://twitter.com/?lang=en"><i class="fa fa-twitter" style="font-size:30px; color:#0CF;"></i></a></li>
        <li><a target="_blank" href="https://plus.google.com/"><i class="fa fa-google-plus" style="font-size:30px; color:#CD3C2E;"></i></a></li>
        <li><a target="_blank" href="https://in.linkedin.com/"><i class="fa fa-linkedin" style="font-size:30px; color:#337AB7;"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-1">
    <div class="panel panel-default mb20 mini-box panel-hovered" style="margin-right:-20px;">
      <div class="panel-body" style="height:80px;">
        <div class="clearfix">
          <div class="text-center"> <a href="<?php echo base_url()?>index/service_provider/multiple_sp/admin_sp"><img alt="home" src="<?php echo base_url()?>images/home1.jpg" style="width:30px; height:30px;"></a> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-10">
    <div class="panel mb20 panel-default panel-hovered">
      <div class="dash-head clearfix mt10 mb10">
        <div class="col-md-10 text-center" style="padding-left:15px;">
          <h4><b> INCOME</b> Today: <i class="fa fa-inr" style="font-size:24px; color:green;" ></i>
            <mark style="color:green ">1000</mark>
            This month: <i class="fa fa-inr" style="font-size:24px; color:green;"></i>
            <mark style="color:green">5000</mark>
            This Year: <i class="fa fa-inr" style="font-size:24px; color:green;"></i>
            <mark style="color:green">10,000</mark>
          </h4>
        </div>
        <div class="col-md-2 text-center" style="margin-bottom:-30px;margin-top:-10px; padding-right:0px">
          <div class="panel mb20 panel-default panel-hovered dropdown"><i class="ion ion-person text-info"></i><strong>100+</strong><br/>
            <a href="<?php echo base_url()?>Index/service_provider/multiple_sp/employee" class="btn btn-info mt15 waves-effect" type="button"><strong>Employees</strong></a> </div>
        </div>
        <!--<div class="col-md-2 text-center">
        <a href="#">Add a Service Provider</a>
        </div>--> 
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
      <div class="panel-footer clearfix panel-footer-sm panel-footer-success"  style="height:35px; margin-top:-3px">
        <h5 class="mb0" style="margin-top:-10px; margin-left:-10px; margin-right:-10px;"><i class="fa fa-inr" style="font-size:14px"></i>5,00,000</h5>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-phone text-info"></i> <strong>100+</strong><br/>
      <a href="<?php echo base_url()?>Index/service_provider/multiple_sp/callalert" class="btn btn-info mt15 waves-effect" type="button">Call Alerts</a> </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-phone text-success"></i> <strong>100+</strong><br/>
      <a href="<?php echo base_url()?>Index/service_provider/multiple_sp/recievedcalls" class="btn btn-success mt15 waves-effect">Recieved Calls</a> </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-phone text-purple"></i> <strong>100+</strong><br/>
      <a href="<?php echo base_url()?>Index/service_provider/multiple_sp/pendingcalls" class="btn btn-purple mt15 waves-effect">Pending calls</a> </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-phone text-pink"></i> <strong>100+</strong><br/>
      <a href="<?php echo base_url()?>Index/service_provider/multiple_sp/completedcalls" class="btn btn-pink mt15 waves-effect">Completed Calls</a> </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-pie-chart text-primary"></i> <strong>100+</strong><br/>
      <button class="btn btn-primary mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">Total Transaction<span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/active">Active</a></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/pending">Pending</a></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/completed">Completed</a></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/cancelled">Cancelled</a></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/refunded">Refunded</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-person text-danger"></i> <strong>100+</strong><br/>
      <a href="<?php echo base_url()?>Index/service_provider/earning" class="btn btn-danger mt15 waves-effect" type="button" data-toggle="dropdown">My Account<span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/add_sp">Add a Service Provider</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/earning">My Earnings</a></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/services">My Services</a></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/list_of_order_sp">My Orders</a></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/edit_profile">Edit Profile</a></li>
        <li><a href="<?php echo base_url()?>Index/service_provider/multiple_sp/appliances">Update Ratecard</a></li>
      </ul>
    </div>
  </div>
</div>
