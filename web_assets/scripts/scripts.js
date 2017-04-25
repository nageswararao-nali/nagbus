// JavaScript Document
$(document).ready(function(){
	//For header action purpose
	$(window).scroll(function(){
		//console.log(window.screen.width);
		//console.log(window.matchMedia("(max-width: 767px)"));
		if(window.matchMedia("(min-width: 767px)").matches){
			//alert(window.innerHeight);
			if($(this).scrollTop()>40){
				//alert("if");
				$('.site-logo img').css('width','60px');
				$('.site-logo img').css('height','60px');
				$('.main-container .nav-wrap .site-nav').css('margin-top','4px');
				$('.main-container .nav-wrap .nav-head').css('height','85px');
				$('.app .main-container.nav-horizontal .nav-wrap').css('box-shadow','0 8px 6px -6px grey')
			}else{
				//alert("else");
				$('.site-logo img').css('width','110px');
				$('.site-logo img').css('height','121px');
				$('.main-container .nav-wrap .site-nav').css('margin-top','55px');
				$('.main-container .nav-wrap .nav-head').css('height','131px');
				$('.app .main-container.nav-horizontal .nav-wrap').css('box-shadow','0 8px 6px -6px lightgray')
			}
		}
	});
	$(document).on('keypress','.num_only',function(event){
	  return isNumberKey(event);
	})
	 function isNumberKey(evt)
	 {
	  var charCode = (evt.which) ? evt.which : event.keyCode
	  if(charCode == 46 ) {$('.altMessage').css('display', 'block');
		$('.altMessage').fadeOut(2000); return false;}
	   if (charCode != 46 && charCode > 31
	   && (charCode < 48 || charCode > 57)){
		 $('.altMessage').css('display', 'block');
		 $('.altMessage').fadeOut(2000);
		return false;
	  }
	  return true;
	 } 
});