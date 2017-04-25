<div class="recharge_content">
<div class="content_with_ajax_modified">


<?php $this->load->view('website/recharge/navbar');?>

  <div class="row">
    <div class="col-sm-12 homepage-form">
      <div class="panel mb20 panel-default panel-hovered">
        
        <div class="panel-body"> <?php echo form_open('recharge/proceed','id="recForm" method="post" autocomplete="off"')?>
          <input type="hidden" name="redirect" value="Recharge/proceed"/>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="ui-radio-inline">
                  <input type="radio" name="recharge_type"  class="checkpostpaidPrepaid" value="Mobile prepaid" checked="checked" required>
                  <span>Prepaid</span> </label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="ui-radio-inline">
                  <input type="radio" name="recharge_type"  class="checkpostpaidPrepaid" value="Mobile postpaid" required> <?php //Hard coded you need to modify in future?>
                  <span>Postpaid</span> </label>
              </div>
			
            </div>

            <div class="col-md-3"> 
            <!--<div class="brwsePlans" data-toggle="modal" data-target="#PlanModal" id="brwsePlans" style="cursor:pointer">-->
			<div class="brwsePlans" style="cursor:pointer">
            <div style="color:#3F51B5;display:none;" id="browsplansNew"><span>Browse Plans of <span class="operator_title">all operators</span></span></div>
            <input type="hidden" name="operator_name" value=""/>
            <span style="display:none">
            <select name="operator_circle">
              <option value="">Select Circle</option>
            </select>
            </span> </div>
            
            </div>
            
			<?php
			if( $this->session->userdata('role_id') && $this->session->userdata('role_id') == 6  )
			{
			?>
			<div class="col-md-3">
            
             <input type="checkbox" class="credit" name="mark_as_credit_user" value="1">
              <label for="cabselect">Mark as credit</label>
             </div>
            <?php }
			?>
          </div>
          
          <div class="form-group">
            <input type="text" class="form-control fetch_network num_only" onkeyup="checkplans()" name="mobile_no" id="mobile_no" placeholder="Mobile no" maxlength="10" autofocus required>
          </div>
          
          
          <div class="form-group">
            <select class="form-control operators" id="operator_code" name="operator" style="width: 100%" required>
              <option value="" disabled="disabled">Select Operator</option>
            </select>
          </div>
          
          <div class="form-group">
            <input type="text" class="form-control rcAmount" placeholder="Recharge Amount" name="rcAmount" id="rcAmount">
          </div>
		  
		    <div class="form-group" id="acc_number" style="display:none"><input type="text" class="form-control rcAmount" name="postpaid_acc_no" value="" placeholder='Billing Number'>
			</div>
			
			
			
           <div class="form-group homepage-rech ">
             
              <input type="text" name="mark_as_credit_comments" class="form-control Comments" style="display:none" placeholder="Enter Your Comments">
            </div>
          <div class="clearfix right">
            <button class="btn btn-info mr5" type="submit" name="Proceed">Proceed</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    
    <div class="col-sm-12">
  

	<div class="panel mb20 panel-default panel-hovered" id="browseplansNewModal" style="display:none">
        <!--<div class="modal-header clearfix bg-dark">
          <div class="small text-uppercase left title">Browse Plans</div>
          <button class="close right" data-dismiss="modal">&times;</button>
        </div>-->
        <div class="panel-body">
         
            <span class="offers_description"> 
          <!-- recharge offers description here --> 
          </span>
           </div>
   
    </div>

    </div>

  </div>
  
</div>
</div>

<?php $this->load->view('website/recharge/right_block');?>




<span class="login_show"></span>


<script src="<?=base_url('web_assets/scripts/recharge.js')?>"></script>
<script>
function checkplans(){
    var mbnum = $("#mobile_no").val();
    if(mbnum.length ==10){
       $('#browsplansNew').show();
    }else{
       $('#browsplansNew').hide();
    }
}
function selectPrice(price){
   $("#rcAmount").val(price);
   $('#rcAmount').focus();
}

function selectAmount(price){
   $("#rcAmount").val(price);
   $('#rcAmount').focus();
}

//$('document').on('click', '.selectamount', function (event) {
	//	$('.selectamount').click(function(){
	//$(event.target).remove()
	//alert("Coming Soon...");
	//var amt = $(this).attr("custvalue");
	//$("#rcAmount").val(amt);
//});




$('#browsplansNew').click(function(){
 // $("#limitedoffers").hide();    
	operator_code = $("#operator_code").val();
	category = '';
	$.ajax({
            url: "http://laabus.com/Recharge/getOffers",
			data:{operator:operator_code,category:category},
            success: function(res) {
               $(".offers_description").html(res);
			   $("#browseplansNewModal").show();
            },
            error: function(res) {
				alert("Something went wrong.")
			}
        })
		
		
		
});

//$('#s-category').onchange(function(){
	//$('document').on('change', '#s-category', function (event) {
 // $("#limitedoffers").hide();    
	
		
		
		
//});

function searchbycat(catid)
{
	operator_code = $("#operator_code").val();
	category = catid;
	$.ajax({
            url: "http://laabus.com/Recharge/getOffers",
			data:{operator:operator_code,category:category},
            success: function(res) {
               $(".offers_description").html(res);
			   $("#browseplansNewModal").show();
			   $("#s-category").val(category);
            },
            error: function(res) {
				alert("Something went wrong.")
			}
        })
	
}


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
