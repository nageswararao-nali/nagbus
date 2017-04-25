<?php $this->load->view('website_template/head.php');?>
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
      <div class="visible-xs"> <a href="http://laabus.com/" class="text-uppercase h3"> <span class="text"><img alt="Laabus" src="http://laabus.com/images/small_logo.png"></span> </a> </div>
    </li>
    
    <!-- #end site-logo --> 
    
    <!-- fullscreen -->
    <li class="fullscreen hidden-xs"> <a href="javascript:;"><i class="ion ion-qr-scanner"></i></a> </li>
    <!-- #end fullscreen -->
    
  </ul>



  <ul class="list-unstyled right-elems" style="color:#000; padding-right:10px;">
  <li style="padding-right:10px;">Laabus Wallet</li>
  <li><a style="color:#000" href="<?php echo base_url()?>welcome/login">login/signup</a></li>
  
    <!-- profile drop -->
    <li class="profile-drop dropdown"> <a href="javascript:;" data-toggle="dropdown"> <img src="<?php echo base_url()?>web_assets/images/admin.jpg" alt="admin-pic"> </a>
      <ul class="dropdown-menu dropdown-menu-right">
     	<li><a href="#">Account No:</a></li>
        <li><a href="<?php echo base_url()?>Index/user/profile" class="l"><span class="ion ion-person">&nbsp;&nbsp;</span>My Account</a></li>

        <li><a href="<?php echo base_url()?>Index/user/change_ps"><span class="ion ion-lock-combination">&nbsp;&nbsp;</span>Change Password</a></li>
        <li class="divider"></li>
<!--        <li><a href="javascript:;"><span class="ion ion-settings">&nbsp;&nbsp;</span>Settings</a></li>
-->        <li><a href="<?php echo base_url()?>Logout"><span class="ion ion-power">&nbsp;&nbsp;</span>Logout</a></li>
      </ul>
    </li>
    <!-- #end profile-drop --> 
  </ul>
  <ul class="list-unstyled right-elems">
    <li class="hidden-xs"><h4 style="color:#FFF; padding-right:10px;">Welcome </h4></li>
  </ul>
  
  
</header>
<!-- #end header -->
<?php $this->load->view('website_template/menubar.php');?>
