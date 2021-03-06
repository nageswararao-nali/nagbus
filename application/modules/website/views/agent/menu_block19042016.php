<?php 
$user_id=$this->session->userdata('user_id');
$role_id=$this->session->userdata('role_id');
$userlist = $this->users->get_users_list($user_id);
$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);?>

<div class="site-settings clearfix hidden-xs">
  <div class="settings clearfix">
    <div class="trigger left"><img src="<?=base_url()?>images/logo_laabus_footer.png" style="width:25px; height:25px;" alt="Laabus"></div>
    <div class="site-wrapper left">
      <ul class="list-unstyled other-settings">
        <li class="clearfix mb10">
          <div class="left small">EMAIL</div>
          <div class="md-switch right">
          <label>
              <input type="checkbox" class="email">
              <span>&nbsp;</span> </label>
          </div>
        </li>
        <li class="clearfix mb10">
          <div class="left small">CALENDER</div>
          <div class="md-switch right">
          <label>
              <input type="checkbox" class="calendar">
              <span>&nbsp;</span> </label>
         </div>
        </li>
      </ul>
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
          <div class="text-center">
            <a href="<?php echo base_url()?>"><img alt="home" src="<?php echo base_url()?>images/home1.jpg" style="width:30px; height:30px;"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-10">
    <div class="panel mb20 panel-default panel-hovered">
      <div class="dash-head clearfix mt10 mb10">
        <div class="text-center" style="padding-left:15px;">
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
        <h5 class="mb0" style="margin-top:-6px; margin-left:-10px; margin-right:-10px;"><i class="fa fa-inr" style="font-size:14px"></i>&nbsp;<?php echo number_format($wallet_amount);?></h5>
      </div>
    </div>
  </div>
</div>

<div class="row">
    
    <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-ios-body text-success"></i> <strong><?php echo count($userlist);?></strong> <br/>
      <button class="btn btn-success btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">My Account <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url('agent/profile')?>">Edit Profile</a></li>
      </ul>
    </div>
  </div>
    
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-ios-body text-success"></i> <strong><?php echo count($userlist);?></strong> <br/>
      <button class="btn btn-success btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">Users <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url('agent/user')?>">Add an User</a></li>
        <!--<li><a href="<?php echo base_url('agent/services')?>">Add Services</a></li>-->
        <li><a href="<?php echo base_url('agent/users_list')?>">Users List</a></li>
       <!-- <li><a href="#">User Credit List</a></li>-->
      </ul>
    </div>
  </div>
<!--  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-inr text-info"></i> <strong>100+</strong><br/>
      <button class="btn btn-info btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">My Billing <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url()?>Index/agent/by_sp">By Service Providers</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/by_services">By Services</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/earnings">Total Earnings</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/add_funds">Add Funds</a></li>
      </ul>
    </div>
  </div>-->
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered"> <i class="fa fa-list-ul text-danger"></i> <strong>32</strong><br/>
      <button class="btn btn-danger btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown"> Orders <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url()?>Index/agent/active">Active</a></li> 
        <li><a href="<?php echo base_url()?>Index/agent/pending">Pending</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/completed">Completed</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/list_of_orders">List of Orders</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-stats-bars text-primary"></i> <strong>55</strong><br/>
      <button class="btn btn-primary btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">
	  <a href='<?php echo base_url()?>agent/Orders' style='color:#fff'>Reports </a><span class="caret"></span></button>
     <ul class="dropdown-menu">
	 <li><a href="<?php echo base_url()?>agent/Orders">Orders Reports</a></li>
         <!-- <li><a href="<?php echo base_url()?>Index/agent/daily_report">Daily Report</a></li>
      <li><a href="<?php echo base_url()?>Index/agent/monthly_report">Monthly Report</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/sp_report">service Provider</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/reversals_cancels">Reversals and Cancelations</a></li>-->
      </ul>
    </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-pie-chart text-pink"></i> <strong>&nbsp;</strong><br/>
      <button class="btn btn-pink btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">Funds<span class="caret"></span></button>
      <!--<ul class="dropdown-menu">
        <li><a href="<?php echo base_url('agent/add_funds')?>">Add Funds</a></li>
        <li><a href="<?php echo base_url('agent/wallet_list')?>">Wallet List</a></li>
        <li><a href="<?php echo base_url('agent/agent_users_list')?>">Users Wallet Listing</a></li>
      </ul>-->
	  
	  <ul class="dropdown-menu">
        <li><a href="<?php echo base_url('agent/add_funds')?>">Add Funds</a></li>
        <li><a href="<?php echo base_url('agent/wallet_list')?>">Wallet List</a></li>
        <li><a href="<?php echo base_url('agent/agent_users_list')?>">Users Wallet Listing</a></li>
        <li><a href="<?php echo base_url('agent/wallet_withdraw')?>">Wallet withdraw</a></li>
      </ul>
	  
	  
	  
    </div>
  </div>
<!--  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered"> <i class="ion ion-ios-chatboxes-outline text-purple"></i> <strong>40</strong><br/>
      <a href="<?php echo base_url()?>Index/agent/feedback" type="button"  class="btn btn-purple btn-xs mt15 waves-effect">Feedback</a>
    </div>
  </div>-->
</div>

<script>
$(document).on('click','.calendar',function(){
	location.href='<?php echo base_url()?>index/agent/calender'
});

$(document).on('click','.email',function(){
	location.href='<?php echo base_url()?>index/agent/email'
});

</script>