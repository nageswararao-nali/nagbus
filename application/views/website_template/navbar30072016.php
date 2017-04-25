<!-- main-navigation -->

<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
  <div class="nav-head"> 
    <!-- site logo --> 
    <a href="<?php echo base_url()?>" class="site-logo text-uppercase"> <img src="<?php echo base_url()?>images/logo_laabus3.png" alt="Laabus"><span class="text"></span> </a> </div>
  
  <!-- Site nav (vertical) -->
  
  <nav class="site-nav clearfix">
    <div class="profile clearfix mb15">
    	<img src="<?php echo base_url()?>web_assets/images/admin.jpg" alt="admin" class="hidden-xs">
          <div class="group hidden-xs">
            <h5 class="name"></h5>
            <small class="desig text-uppercase">PHP Developer</small> </div>
        </div>
    
    <!-- navigation -->
    <ul class="list-unstyled clearfix nav-list mb15">
    <?php
      foreach ($category as $cat) {
    ?>
        <!--<li data-d='flight' <?php echo strtolower($this->uri->segment($this->uri->total_segments()))=="flight" ? 'class="active"' : 'class="waves-effect"'?>> <a class="l" href="<?php echo base_url().$cat->base_url; ?>"> <i class="<?php echo $cat->fav_icon; ?>"></i> <span class="text"><?php echo $cat->cat_name; ?></span></a> </li>-->
    <?php
        // echo "<li <?php echo strtolower($this->uri->segment($this->uri->total_segments()))=='flight' ? 'class='active'' : ''
      }
    ?>


        <li class=" waves-effect"> <a href="http://laabus.com/Comingsoon" class="l"> <i class="flight-icon"></i> <span class="text">FLIGHT TICKETS</span></a> </li>
        <li class=" waves-effect"> <a href="http://laabus.com/Comingsoon" class="l"> <i class="bus-icon"></i> <span class="text">BUS TICKETS</span></a> </li>
        <li class=" waves-effect"> <a href="http://laabus.com/recharge" class="l"> <i class="recharge-icon"></i> <span class="text">MOBILE RECHARGE</span></a> </li>
    
<!--<li class=" waves-effect"> <a href="http://laabus.com/Comingsoon" class="l"> <i class="paybills-icon"></i> <span class="text">PAY BILLS</span></a> </li>-->
        <li class=" waves-effect"> <a href="http://laabus.com/Comingsoon" class="l"> <i class="home-repair-icon"></i> <span class="text">HOME REPAIR</span></a> </li>
        <li class=" waves-effect"> <a href="http://laabus.com/Comingsoon" class="l"> <i class="e-shope-icon"></i> <span class="text">E-SHOP</span></a> </li>
        


    </ul>
    <!-- #end navigation --> 
  </nav>
  
</aside>
<!-- #end main-navigation --> 