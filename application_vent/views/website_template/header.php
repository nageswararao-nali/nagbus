<?php $this->load->view('website_template/head.php');
$role_id=$this->session->userdata('role_id');
if($role_id=='2'){
                            $account_url='channel_partner/profile';
                            $dash_url='channel_partner/dashboard';
                        }else if($role_id=='4'){
                            $account_url='user/profile';
                            $dash_url='user/dashboard';
                        }else if($role_id=='6'){
                            $account_url='agent/profile';
                            $dash_url='agent/dashboard';
                        } 

?>
<body id="app" class="app off-canvas theme-four theme-zero">
<!-- header -->

<header class="site-head fixedHeader" id="site-head">
  <ul class="list-unstyled left-elems">
    <!-- nav trigger/collapse -->
    <li class="hidden-lg hidden-md hidden-sm"> <a href="javascript:;" class="nav-trigger ion ion-drag"></a> </li>
    <!-- #end nav-trigger -->
    <li class="notify-drop hidden-xs"> <a href="<?php echo base_url()?>" class="l"><i class="ion ion-home"></i></a> </li>
    
    <!-- Search box -->
    <li>
      <div class="form-search hidden-xs">
        <form id="site-search" action="javascript:;">
          <div class="ui-widget"><input type="search" id="automplete-3" class="form-control" placeholder="Type here for search...">
          <button type="submit" class="ion ion-ios-search-strong"></button></div>
        </form>
      </div>
    </li>
    <!-- #end search-box --> 
    
    
<script>
 $(function() {
	var availableTutorials = [
	   "ActionScript",
	   "Boostrap",
	   "C",
	   "C++",
	   "Ecommerce",
	   "Jquery",
	   "Groovy", 
	   "Java",
	   "JavaScript",
	   "Lua",
	   "Perl",
	   "Ruby",
	   "Scala",
	   "Swing",
	   "XHTML",
	   "kit",
	   "just",
	   "jam",
	   "janaki",
	   "jay",
	   "june",
	   "july",
	   "january"
	];
	$( "#automplete-3" ).autocomplete({
	   minLength:1,   
	   delay:100,   
	   source: availableTutorials,
	   open: function () {
			$(this).autocomplete('widget').zIndex(999999);
		}
	});
	
 });
</script>
  
  
    <!-- site-logo for mobile nav -->
    <li>
      <div class="visible-xs"> <a href="http://laabus.com/" class="text-uppercase h3"> <span class="text"><img alt="Laabus" src="http://laabus.com/images/small_logo.png"</span> </a> </div>
    </li>
    
    <!-- #end site-logo --> 
    
    <!-- fullscreen -->
    <li class="fullscreen hidden-xs"> <a href="javascript:;"><i class="ion ion-qr-scanner"></i></a> </li>
    <!-- #end fullscreen -->
    
  </ul>



  <ul class="list-unstyled right-elems" style="color:#000; padding-right:10px;">
<!--  <li style="padding-right:10px;">Laabus Wallet</li>-->
<?php if($this->session->userdata('user_id')==''){?>
  <li><a style="color:#000" href="<?php echo base_url('login')?>"><img alt="login" src="http://laabus.com/images/user_login.png"></a> &nbsp;  &nbsp; <a style="color:#000" href="<?php echo base_url()?>Welcome/signup"><img alt="login" src="http://laabus.com/images/new_user.png"></a></li>
<?php }?>
  
    <!-- profile drop -->
    <li class="profile-drop dropdown"> 
        <?php if($this->session->userdata('user_id')!=''){?>
<!--        <a href="javascript:;" data-toggle="dropdown"> <img src="<?php echo base_url()?>web_assets/images/admin.jpg" alt="admin-pic"> </a>-->
        <a href="javascript:;" data-toggle="dropdown"><span class="ion ion-person"></span></a>
        <?php }?>
      <ul class="dropdown-menu dropdown-menu-right">
     	<li><a href="#">YOUR ID: <?php //echo @$this->db->select('acc_number')->where('User_id', $this->session->userdata('user_id'))->get('profile_bank_details')->row()->acc_number;
		if( $this->session->userdata('role_id') == 6 )
		{
			$custid = "LaaAG";
		}
		else if( $this->session->userdata('role_id') == 2 )
		{
			$custid = "LaaCH";
		}
		else if( $this->session->userdata('role_id') == 4 )
		{
			$custid = "LaaU";
		}
		else if( $this->session->userdata('role_id') == 5 )
		{
			$custid = "LaaSM";
		}
		echo $custid.str_pad($this->session->userdata('user_id'), 3, "0", STR_PAD_LEFT);
		?></a></li>
        <li><a href="<?php echo base_url($dash_url)?>" class="l"><span class="ion ion-lock-combination">&nbsp;&nbsp;</span>Dashboard</a></li>
        <li><a href="<?php echo base_url($account_url)?>" class="l"><span class="ion ion-person">&nbsp;&nbsp;</span>My Account</a></li>

<!--        <li><a href="<?php echo base_url()?>Index/user/change_ps"><span class="ion ion-lock-combination">&nbsp;&nbsp;</span>Change Password</a></li>-->
        <li class="divider"></li>
<!--        <li><a href="javascript:;"><span class="ion ion-settings">&nbsp;&nbsp;</span>Settings</a></li>
-->        <li><a href="<?php echo base_url()?>welcome/Logout"><span class="ion ion-power">&nbsp;&nbsp;</span>Logout</a></li>
      </ul>
    </li>
    <!-- #end profile-drop --> 
  </ul>
    
    <?php if($this->session->userdata('user_id')!=''){?>
  <ul class="list-unstyled right-elems">
    <li class="hidden-xs"><h4 style="color:#FFF; padding-right:10px;">Welcome </h4></li>
    <li class="hidden-xs"><h6 style="color:#FFF; padding-right:10px;"><?php echo $this->session->userdata('email_id')?></h6></li>
  </ul>
    <?php }?>
  
  
  
</header>
<!-- #end header -->
<?php $this->load->view('website_template/menubar.php');?>
