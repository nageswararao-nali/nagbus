</div>
</div>
<!-- #end page-wrap -->

</div>
<!--# panels -->
</div>
</div>
<!-- #end main-container -->

<div class="page page-email">
    <div class="page-wrap">
        <button type="button" class="btn btn-pink ion ion-arrow-up-a compose-btn waves-effect" id="MD-StoTop"></button>
    </div>
</div>

<div class="container-fluid">
<br/><br/><br/>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 panel-footer" style ="background-color:#333; color:#FFF; padding: 10px 10px; bottom:0px">
      <div class="col-md-6 col-sm-9 col-xs-10">© All Rights Reserved 2017</div>
      <!--<div class="col-md-6 col-sm-3 col-xs-2 text-right" style="position:relative; right:45px;"> <a href="http://varini.in" target="_blank" title="Varini Info Systems Pvt Ltd." style="color:#FFF"><img src="<?php echo base_url()?>/images/powered_big.png" width="30" height="30" alt="Varni Info Systems Pvt Ltd.." /> Varini Info Systems Pvt Ltd.</a></div>-->
    </div>
  </div>
</div>
<!-- theme settings -->

<div class="site-settings clearfix hidden-xs" style="display:none">
  <div class="settings clearfix">
    <div class="trigger ion ion-settings left"></div>
    <div class="wrapper left">
      <ul class="list-unstyled other-settings">
        <li class="clearfix mb10">
          <div class="left small">Nav Horizontal</div>
          <div class="md-switch right">
            <label>
              <input type="checkbox" id="navHorizontal">
              <span>&nbsp;</span> </label>
          </div>
        </li>
        <li class="clearfix mb10">
          <div class="left small">Fixed Header</div>
          <div class="md-switch right">
            <label>
              <input type="checkbox"  id="fixedHeader" checked="checked">
              <span>&nbsp;</span> </label>
          </div>
        </li>
        <li class="clearfix mb10">
          <div class="left small">Nav Full</div>
          <div class="md-switch right">
            <label>
              <input type="checkbox"  id="navFull">
              <span>&nbsp;</span> </label>
          </div>
        </li>
      </ul>
      <hr/>
      <ul class="themes list-unstyled" id="themeColor">
        <li data-theme="theme-zero" class="active"></li>
        <li data-theme="theme-one"></li>
        <li data-theme="theme-two"></li>
        <li data-theme="theme-three"></li>
        <li data-theme="theme-four"></li>
        <li data-theme="theme-five"></li>
        <li data-theme="theme-six"></li>
        <li data-theme="theme-seven"></li>
      </ul>
    </div>
  </div>
</div>
<!-- #end theme settings --> 
<!-- Dev only --> 
<!-- Vendors --> 
<script src="<?php echo base_url()?>web_assets/scripts/plugins/d3.min.js"></script> 
<script src="<?php echo base_url()?>web_assets/scripts/plugins/c3.min.js"></script> 
<script src="<?php echo base_url()?>web_assets/scripts/plugins/screenfull.js"></script> 
<script src="<?php echo base_url()?>web_assets/scripts/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/waves.min.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/jquery.dataTables.min.js"></script>

<script src="<?php echo base_url()?>web_assets/scripts/plugins/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/jquery.easypiechart.min.js"></script>

<script src="<?php echo base_url()?>web_assets/scripts/plugins/moment.min.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/bootstrap-rating.min.js"></script>


<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script src="<?php echo base_url()?>web_assets/scripts/jquery.geocomplete.min.js"></script>



<script src="<?php echo base_url()?>web_assets/scripts/plugins/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/fullcalendar.min.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/summernote.min.js"></script>

<script src="<?php echo base_url()?>web_assets/scripts/app.js"></script>

<script src="<?php echo base_url()?>web_assets/scripts/inbox.init.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/calendar.init.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/scripts.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/jquery.countdown.min.js"></script>
<script src="<?php echo base_url()?>web_assets/scripts/plugins/jquery.validate.min.js"></script>        
     
<span class="footer_scripts">
<?php $this->load->view('website_template/javascripts.php')?>

</span> 
<script>
$(document).ready(function(){
	function get_javascripts(){ $.ajax({url : '<?php echo base_url()?>Index/scripts', success : function(res){$('.footer_scripts').html(res)}})}
	$(document).on('click','.l',function(e){
		e.preventDefault();
		var t=$(this);
		$('#loading').show();
		var ul = $(this).attr('href');
		$.ajax({url : ul, success:function(res){
			t.addClass('active');
			$('.l').parents('li').removeClass('active');
			t.parents('li').addClass('active');
			window.history.pushState("string", "Title", ul);
			$('#loading').hide();
			//get_javascripts();
			$('#pagecontent').html(res);
		}})
		return false;
	});
	//get_javascripts();
});
</script>
<script type='text/javascript'>
$(function() {
    $.fn.scrollToTop = function() {
    $(this).hide().removeAttr('href');
    if ($(window).scrollTop() != '0') {
        $(this).fadeIn('slow')
    }
    var scrollDiv = $(this);
    $(window).scroll(function() {
        if ($(window).scrollTop() == '0') {
        $(scrollDiv).fadeOut('slow')
        } else {
        $(scrollDiv).fadeIn('slow')
        }
    });
    $(this).click(function() {
        $('html, body').animate({
        scrollTop: 0
        }, 'slow')
    })
    }
});
$(function() {
    $('#MD-StoTop').scrollToTop();
});

$(function(){
	$('.prod_exp_time').countdown('2015/10/1',function(event) {
		$(this).html(event.strftime('%H:%M:%S'));
 	});
	$('.prod_exp_date').countdown('2015/10/1',function(event) { //YYYY-mm-dd
		$(this).html(event.strftime('%D days'));
 	});	
});


$(window).on("popstate", function(e) { location.href=location.href; });

</script>

</body></html>