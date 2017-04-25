<div class="recharge_content">
<div class="content_with_ajax_modified">

<?php //$this->load->view('website/recharge/navbar');?>


  <div class="row">
    <div class="col-sm-12 homepage-form">
      <div class="panel mb20 panel-default panel-hovered">
   
        <div class="panel-body">
        
        
        <div id="terms-services">
          <div>
            <h2>Online Card Payments </h2>
            <p>Visa, Master and American express   Card payments are processed through an online payment gateway system.   You need not worry about your card information falling into the wrong   hands because your bank will authorize the card transaction directly   without any information passing through us. In approximately 25-30   seconds (depending on your internet connection) your bank will issue,   using the online payment gateway, an authorization code and confirmation   of completion of transaction. </p>
            <p> In fact, transacting online with a credit card at the Website   is even safer than using a credit card at a restaurant because we do not   retain your credit card information. You can be assured that   laabus.com offers you the highest standards of security currently   available on the internet so as to ensure that your shopping experience   is private, safe and secure. </p>
            <p> If the payment on the credit card is declined for some reason,   alternate payment instructions must be received by laabus.com 72   hours prior to the time of departure; else, the order is liable to be   cancelled. </p>
            <p> laabus.com charges a service fee on all domestic airline   bookings. In case of cancellation of booking, this fee is   non-refundable. </p>
          </div>
          <hr />
          <div>
            <h2>Pay at hotel reception (&quot;Post Pay&quot;)</h2>
            <p>With some of our partner hotels   laabus.com has negotiated a special facility where laabus.com   customers can pay the hotel directly at the reception at the time of   check-in at the hotel.</p>
          </div>
          <div>
            <h2>Transaction Confirmation </h2>
            <p>You should not take any action   based on information on the Website until you have received a   confirmation of your transaction. In case of confirmations to be   received by email, if you do not receive a confirmation of your   purchase/transaction within the stipulated time period, first look into   your &quot;spam&quot; or &quot;junk&quot; folder to verify that it has not been misdirected,   and if still not found, please contact our customer care. </p>
          </div>
          <hr />
          <div>
            <h1>Delivery of Products/Services</h1>
            <h2>Electronic Tickets (&quot;e-Tickets&quot;)</h2>
            <h2>What is an e-Ticket?</h2>
            <p>An e-Ticket is a paperless   electronic document with a unique confirmation number given to   passengers in place of a paper ticket. Passengers are required to   produce the unique confirmation number at the airport airline counter to   claim the e-Ticket. </p>
          </div>
          <hr />
          <div>
            <h2>How will I get my e-Ticket details?</h2>
            <p>Your e-Ticket details will be sent to your email address   provided by you at the time of making the payment for your booking. In   case you do not have an email address, the details will be given to you   over the phone. </p>
            <p> If you do not receive your e-ticket within 8 hours of making your booking on laabus.com.in, please email us at <a href="mailto:info@igoesmart.com"> info@laabus</a><a href="mailto:info@igoesmart.com">.com </a></p>
            <p> laabus.com VARINI info systems Pvt.LtD. shall not be liable if customers do not comply with this requirement. </p>
          </div>
          <hr />
          <div>
            <h2>Is it necessary to show my laabus.com Reference Number Confirmation email at the airport check-in counter of the airline?</h2>
            <p>It is not mandatory to show your   laabus.com Reference Number Confirmation email. In case you are not   carrying the laabus.com Reference Number Confirmation email, you will   need to show a photographic identity proof (passport, driver's license   etc.) at the airport check-in counter of the airline. However, it is   advisable that you carry your laabus.com Reference Number   Confirmation email and e-Ticket together. </p>
          </div>
          <hr />
          <div>
            <h2>Is it necessary to carry my e-ticket with me?</h2>
            <p>Yes, it is mandatory for you to   carry a copy of your e-ticket as sent by laabus.com.in. In the event   that you fail to present a copy of your e-ticket, laabus.com will not   be held responsible if the Airline does not issue a boarding pass/   disallows you from traveling. </p>
          </div>
          <hr />
          <div>
            <h2>How will I get my boarding pass for an e-Ticket?</h2>
            <p>You will need to show your   e-Ticket confirmation email and e-Ticket number along with a   photographic identity proof (passport, driver's license etc.) at the   airport check-in counter of the airline. The airline representative will   issue your boarding pass at that time.</p>
          </div>
          <hr />
          <div>
            <h2>Prepaid Ticket Advice (&quot;PTA&quot;)</h2>
            <p>A PTA is a Prepaid Ticket Advice.   We will give you a PTA number that you need to present at the airport   check-in counter of the airline. The airline representative will print   and give you your ticket at that time.</p>
          </div>
          <hr />
          <div>
            <h2>Promotion Codes</h2>
            <p>laabus.com.in generates   promotion codes from time to time which may be availed on the site as a   discount coupon. Users are advised that the promotional offer of using   Promotion Codes for receiving discounts is not valid for transactions   relating to Air Deccan. Other regular promotions that may be offered   from time to time shall be valid for all airlines, including Air Deccan,   unless indicated otherwise. </p>
            <p> laabus.com.in reserves the right to add, alter, modify,   withdraw all or any of the Terms and Conditions or replace, wholly or in   part, the program by any other program, whether similar to this program   or not or withdraw it altogether without any prior notice. </p>
            <p> In case of dispute with any party, laabus.com.in's decision will be binding and final. </p>
            <p> When you register with laabus.com.in, we or any of our   partners/affiliate/group companies may contact you from time to time to   provide the offers/information of such products/services that we believe   may benefit you. </p>
          </div>
        </div>
      
        </div>
		
      </div>
    </div>

   
  </div>
  
</div>
</div><?php //$this->load->view('website/recharge/right_block');?>
<span class="login_show"></span>


<script src="<?=base_url('web_assets/scripts/recharge.js')?>"></script>
<script>
function checkplans(){
    var mbnum = $("#mobile_no").val();
    if(mbnum.length ==10){
       $('#browsplans').show();
    }else{
       $('#browsplans').hide();
    }
}
function selectPrice(price){
   $("#rcAmount").val(price);
   $('#rcAmount').focus();
}
$('.brwsePlans').click(function(){
	//$("#limitedoffers").hide();
	$("#browseplans").show();
});
$('.close').click(function(){
	$("#browseplans").hide();
	//$("#limitedoffers").show();
});


$('.checkpostpaidPrepaid').click(function(){
	data = $(this).val();
	if(data == "Mobile postpaid")
	{
		$("#acc_number").show();
	}
	else
	{
		$("#acc_number").hide();
	}
});

$('.imgthumb').click(function(){
	$('#mobile_large').attr('src',$(this).attr('src'));
});

$('.credit').click(function(){
	if ($(this).is(':checked')){
	$(".Comments").show()
	} else {
		$(".Comments").hide()
	};
		
});

function bigImg(x) {
	x.style.height = "400px";
	x.style.width = "300px";
}

function normalImg(x) {
	x.style.height = "90px";
	x.style.width = "80px";
}

$(function(){
	$('.rating-control').rating()
});

$(document).ready(function(){
    $("#recForm").validate({
                    rules: {
                            mobile_no:{required:true,minlength:10,maxlength:10},
                             operator:{required:true},
                             rcAmount:{required:true, number: true},
							 
							 postpaid_acc_no: {
							required: {
								depends: function(element) {
									return ($('.checkpostpaidPrepaid').val() != 'Mobile postpaid');
								}
							}
						}    
		
		
                            },
                    messages: {
                            mobile_no:{required:"Please enter mobile no"},
                            operator:{required: "Please select operator"},
                            rcAmount:{required: "Please enter recharge amount",number:"Amount should be in numeric"},
                            },
                            
                submitHandler: function(form) {
                    form.submit();
                }
                        
                            
        });
});

</script>

