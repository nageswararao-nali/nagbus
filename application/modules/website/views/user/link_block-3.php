<?php 
$user_id=$this->session->userdata('user_id');
$role_id=$this->session->userdata('role_id');
$wallet_amount = $this->users->get_wallet_amount($user_id,$role_id);?>
<div class="row" style="margin-left:-40px;">
  <div class="col-md-offset-2 col-md-1">
  <div class="panel panel-default mb20 mini-box panel-hovered">
      <div class="panel-body">
    <div class="text-center"> <a href="<?php echo base_url();?>"><img alt="home" src="<?php echo base_url()?>images/home1.jpg" style="width:30px; height:30px;"></a> </div>
  </div>
  </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-person text-danger"></i> <strong>100+</strong><br/>
      <a href="" class="btn btn-danger mt15 waves-effect" type="button" data-toggle="dropdown">My Account<span class="caret"></span></a>
      <ul class="dropdown-menu">
<!--        <li><a href="<?php echo base_url('user/change_profile')?>">Change Profile</a></li>-->
       <!-- <li><a href="<?php echo base_url('user/add_funds')?>">Add Funds</a></li>-->
        <!--<li><a href="<?php echo base_url('user/wallet_list')?>">Wallet List</a></li>-->
        <li><a href="<?php echo base_url('user/profile')?>">Edit Profile</a></li>
      </ul>
    </div>
  </div>
  
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-stats-bars text-primary"></i> <strong>55</strong><br/>
      <button class="btn btn-primary  mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">
	  <a href='<?php echo base_url()?>agent/Orders' style='color:#fff'>Reports </a><span class="caret"></span></button>
     <ul class="dropdown-menu">
	 <li><a href="<?php echo base_url()?>user/Orders">Orders Reports</a></li>
         <!-- <li><a href="<?php echo base_url()?>Index/agent/daily_report">Daily Report</a></li>
      <li><a href="<?php echo base_url()?>Index/agent/monthly_report">Monthly Report</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/sp_report">service Provider</a></li>
        <li><a href="<?php echo base_url()?>Index/agent/reversals_cancels">Reversals and Cancelations</a></li>-->
      </ul>
    </div>
  </div>
  
   <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-pie-chart text-pink"></i> <strong>&nbsp;</strong><br/>
      <button class="btn btn-pink  mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">Funds<span class="caret"></span></button>
      <!--<ul class="dropdown-menu">
        <li><a href="<?php echo base_url('agent/add_funds')?>">Add Funds</a></li>
        <li><a href="<?php echo base_url('agent/wallet_list')?>">Wallet List</a></li>
        <li><a href="<?php echo base_url('agent/agent_users_list')?>">Users Wallet Listing</a></li>
      </ul>-->
	  
	  <ul class="dropdown-menu">
        <li><a href="<?php echo base_url('user/add_funds')?>">Add Funds</a></li>
        <li><a href="<?php echo base_url('user/wallet_list')?>">Wallet List</a></li>
        <!--<li><a href="<?php echo base_url('agent/agent_users_list')?>">Users Wallet Listing</a></li>-->
        <li><a href="<?php echo base_url('user/wallet_withdraw')?>">Wallet withdraw</a></li>
      </ul>
	  
	  
	  
    </div>
  </div>
  
  
  
<!--  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-plug text-success"></i> <strong>100+</strong><br/>
      <a href="<?php echo base_url()?>Index/user/services" class="btn btn-success mt15 waves-effect">Services</a> </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-card text-purple"></i> <strong>100+</strong><br/>
      <a href="<?php echo base_url()?>Index/user/transactions" class="btn btn-purple mt15 waves-effect">Transactions</a> </div>
  </div>-->
  <div class="col-md-1">
    <div class="panel panel-default mb20 mini-box panel-hovered" style="width:100px;">
      <div class="panel-body prod-box" style="height:35px;">
        <div class="clearfix">
          <div class="info text-center">
            <h4 class="mt0 mb0 text-success"><b><strong>Wallet</strong></b></h4>
          </div>
        </div>
      </div>
      <div class="panel-footer clearfix panel-footer-sm panel-footer-success text-center"  style="height:30px; padding:20px;">
        <h5 class="mb0" style="margin-top:-6px; margin-left:-10px; margin-right:-10px;"><i class="fa fa-inr" style="font-size:14px"></i>&nbsp;<?php echo number_format($wallet_amount);?></h5>
      </div>
    </div>
  </div>
  
  
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered"> <i class="ion ion-ios-chatboxes-outline text-purple"></i> <strong></strong><br/>
      <a href="<?php echo base_url('user/offers')?>" type="button"  class="btn btn-purple btn-xs mt15 waves-effect"><img src="http://laabus.com/images/star4_e0.gif"> Offers</a>
    </div>
  </div>
  
  
  
</div>
