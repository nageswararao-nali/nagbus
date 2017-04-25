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
    <!--<div class="col-md-2">
    <a href="<?php echo base_url()?>index/channel_partner/dashboard"><i class="ion ion-home" style="text-align:center; font-size:36px;"></i></a>
    </div>-->
      <div class="dash-head clearfix mt10 mb10">
        <div class="text-center" style="padding-left:15px;">
          <h4><b>INCOME</b> Today: <i class="fa fa-inr" style="font-size:24px; color:green;" ></i>
            <mark style="color:green "><?php if($this->session->userdata('today_earning') != '')
				echo $this->session->userdata('today_earning');
			else
				echo "0.00";
			?></mark>
            This month: <i class="fa fa-inr" style="font-size:24px; color:green;"></i>
            <mark style="color:green">
			
			<?php if($this->session->userdata('month_earning') != '')
				echo $this->session->userdata('month_earning');
			else
				echo "0.00";
			?>
			</mark>
            This Year: <i class="fa fa-inr" style="font-size:24px; color:green;"></i>
            <mark style="color:green">
			
			<?php if($this->session->userdata('year_earning') != '')
				echo $this->session->userdata('year_earning');
			else
				echo "0.00";
			?>
			
			</mark>
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
        <h5 class="mb0" style="margin-top:-6px; margin-left:-10px; margin-right:-10px;"><i class="fa fa-inr" style="font-size:14px"></i>5,00,000</h5>
      </div>
    </div>
  </div>
  <!--<div class="col-md-1">
    <div class="text-center right" >
      <div class="panel mb20 panel-default panel-hovered" style="height:40px;"> <strong>Wallet</strong> <br/>
        <button class="btn btn-success btn-xs mt15 waves-effect" style="height:42px;">&nbsp;&nbsp;&nbsp;<i class="fa fa-inr"></i>&nbsp;&nbsp;5,00,000</button>
      </div>
    </div>
  </div>--> 
</div>
<div class="row">
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-ios-body text-success"></i> <strong>192+</strong> <br/>
      <button class="btn btn-success btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">Manage Users <span class="caret"></span></button>
      <ul class="dropdown-menu">
       <!-- <li><a href="<?php echo base_url()?>index/channel_partner/add_agent" class="l">Add an Agents</a></li>
        <li><a href="<?php echo base_url()?>index/channel_partner/add_sp">Add Service Providers</a></li>
        <li><a href="<?php echo base_url()?>index/channel_partner/total_agents">Total Agents</a></li>
        <li><a href="<?php echo base_url()?>index/channel_partner/total_sp"> Toatal service Providers</a></li>
        <li><a href="<?php echo base_url()?>index/channel_partner/total_users">Total Users</a></li>-->
		
		<li><a href="<?php echo base_url()?>channel_partner/add_agent" >Add an Agents</a></li>
        <li><a href="<?php echo base_url()?>channel_partner/Addsp">Add Service Providers</a></li>
        <li><a href="<?php echo base_url()?>channel_partner/TotalAgents">Total Agents</a></li>
        <li><a href="<?php echo base_url()?>channel_partner/Totalsp"> Total service Providers</a></li>
        <li><a href="<?php echo base_url()?>channel_partner/total_users">Total Users</a></li>
		
		
      </ul>
    </div>
  </div>
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered"> <i class="ion ion-person text-danger"></i> <strong>40</strong><br/>
      <a href="<?php echo base_url()?>channel_partner/Addpartner" class="btn btn-danger btn-xs mt15 waves-effect">Add Partner</a> </div>
  </div>
  
  <!--
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-inr text-info"></i> <strong>100+</strong><br/>
      <button class="btn btn-info btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">Earnings <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url()?>index/channel_partner/agent_earning">By Agents</a></li>
        <li><a href="<?php echo base_url()?>index/channel_partner/sp_earning">By Service Providers</a></li>
        <li><a href="<?php echo base_url()?>index/channel_partner/services_earning">By Services</a></li>
        <li><a href="<?php echo base_url()?>index/channel_partner/total_earnings">Total Earnings</a></li>
      </ul>
    </div>
  </div>-->
  
  
  
  <div class="col-md-2 text-center">
    <div class="panel mb20 panel-default panel-hovered dropdown"> <i class="ion ion-stats-bars text-primary"></i> <strong>55</strong><br/>
      <button class="btn btn-primary btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">Reports <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <!--<li><a href="<?php echo base_url()?>Index/channel_partner/reports/daily_report">Daily Report</a></li>
        <li><a href="<?php echo base_url()?>Index/channel_partner/reports/monthly_report">Monthly Report</a></li>
        <li><a href="<?php echo base_url()?>Index/channel_partner/reports/agent_wise">Agent wise</a></li>
        <li><a href="<?php echo base_url()?>Index/channel_partner/reports/sp_report">service Provider</a></li>
        <li><a href="<?php echo base_url()?>Index/channel_partner/reports/reversals_cancels">Reversals and Cancelations</a></li>-->
		 <li><a href="<?php echo base_url()?>channel_partner/Orders">Orders Reports</a></li>
      </ul>
    </div>
  </div>
 
  <div class="col-md-2 text-center">
    <!--<div class="panel mb20 panel-default panel-hovered dropdown"> <i class="fa fa-pie-chart text-purple"></i> <strong>73</strong><br/>
      <button class="btn btn-purple btn-xs mt15 waves-effect dropdown-toggle" type="button" data-toggle="dropdown">Invoices <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="<?php echo base_url()?>Index/channel_partner/invoice_list">New Invoice</a></li>
        <li><a href="<?php echo base_url()?>Index/channel_partner/invoice_list">All Invoices</a></li>
        <li><a href="<?php echo base_url()?>Index/channel_partner/invoice_list">Paid Invoices</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-2 text-center">-->
    <div class="panel mb20 panel-default panel-hovered"> <i class="ion ion-ios-chatboxes-outline text-pink"></i> <strong>32</strong><br/>
    <a href="<?php echo base_url()?>Index/channel_partner/feedback" type="button" class="btn btn-pink btn-xs mt15 waves-effect">Feedback</a>
    </div>
  </div>
</div>

<script>

$(document).on('click','.email',function(){
	location.href='<?php echo base_url()?>index/channel_partner/email'
});
$(document).on('click','.calendar',function(){
	location.href='<?php echo base_url()?>index/channel_partner/calender'
});

</script>