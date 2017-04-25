<div class="recharge_content">
<div class="content_with_ajax_modified">

<?php //$this->load->view('website/recharge/navbar');?>


  <div class="row">
    <div class="col-sm-12 homepage-form">
      <div class="panel mb20 panel-default panel-hovered">
        
        <div class="panel-body">
        <div class="col-sm-4">
        
        <div class="faq_container">
                        <div class="faq1">
                            <div class="faq_question1" ><h4 style="font-weight:bold"><?php echo strtoupper($value->title)?></h4> </div>
                            <div class="faq_answer_container1">
                                <div class="faq_answer1" >
                                            <div class="remarks" style="margin:10px 0px;"><span ><?php echo $value->description;?></span><br></div>                                </div>
                                            
                                            <div style="display:block; text-align:center; line-height:30px; background-color:#ccc; margin-bottom:20px;"> [ PROMO CODE: <h4 style="font-weight:bold; display:inline-block; "><?php echo strtoupper($value->promo_code)?></h4> ] </div>
                            </div>
                        </div>
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

