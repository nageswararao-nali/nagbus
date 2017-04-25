<?php $this->load->view('website/recharge/right_block');?>
<div class="recharge_content">
<div class="content_with_ajax_modified">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel mb20 panel-default panel-hovered">
        
        <div class="panel-body"> <?php echo form_open('Recharge/validate','id="recForm" method="post" autocomplete="off"')?>
        	<input type="hidden" name="redirect" value="Recharge/proceed"/>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="ui-radio-inline">
                  <input type="radio"  class="checkpostpaidPrepaid" name="recharge_type" value="Mobile prepaid" checked="checked" required>
                  <span>Prepaid</span> </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="ui-radio-inline">
                  <input type="radio" class="checkpostpaidPrepaid" name="recharge_type" value="Mobile postpaid" required> <?php //Hard coded you need to modify in future?>
                  <span>Postpaid</span> </label>
              </div>
			  
			  
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control fetch_network num_only" name="mobile_no" placeholder="Mobile no" autofocus required>
          </div>
          <div class="form-group">
            <select class="form-control operators" name="operator" style="width: 100%" required>
              <option value="" disabled="disabled">Select Operator</option>
            </select>
          </div>
          
                    
          <div id="acc_number" class="form-group" style="display:none"><br />
<input type="text" name="postpaid_acc_no" value="0">(In case of Post Piad Bill enter Account Number else keep  0 )</div>
          
          
          <div class="brwsePlans" data-toggle="modal" data-target="#PlanModal" id="brwsePlans" style="cursor:pointer">
            <div class="text-right" style="color:#3F51B5;"><span>Browse Plans of <span class="operator_title">all operators</span></span></div>
            <input type="hidden" name="operator_name" value=""/>
            <span style="display:none">
            <select name="operator_circle">
              <option value="">Select Circle</option>
            </select>
            </span> </div>
          <div class="form-group">
            <input type="text" class="form-control rcAmount" placeholder="Recharge Amount" name="rcAmount">
          </div>
           <div class="form-group">
              <input type="checkbox" class="credit">
              <label for="cabselect">Mark as credit</label>
              <input type="text" class="form-control Comments" style="display:none" placeholder="Enter Your Comments">
            </div>
          <div class="clearfix right">
            <button class="btn btn-info mr5" type="submit" name="Proceed">Proceed</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
  

     <div class="panel mb20 panel-default panel-hovered" id="browseplans" style="display:none">
        <div class="modal-header clearfix bg-dark">
          <div class="small text-uppercase left title">Browse Plans</div>
          <button class="close right" data-dismiss="modal">&times;</button>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Select Operator</label>
                <select class="form-control offer_operators">
                </select>
              </div>          
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Select Circle</label>
                <select class="form-control offer_circles">
                  <option value="">Select Circle</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Plan Type</label>
                <select class="form-control types">
                  <option value="">Select Plan</option>
                </select>
              </div>
            </div>
          </div>
          <span class="offers_description"> 
          <!-- recharge offers description here --> 
          </span> </div>
   
    </div>
  
    </div>
    
  </div>
  <!--<div class="modal modalFadeInScale" id="PlanModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header clearfix bg-dark">
          <div class="small text-uppercase left title">Browse Plans</div>
          <button class="close right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Select Operator</label>
                <select class="form-control offer_operators">
                </select>
              </div>          
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Select Circle</label>
                <select class="form-control offer_circles">
                  <option value="">Select Circle</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Plan Type</label>
                <select class="form-control types">
                  <option value="">Select Plan</option>
                </select>
              </div>
            </div>
          </div>
          <span class="offers_description"> 
         
          </span> </div>
      </div>
    </div>
  </div>-->
</div>
</div>
<span class="login_show"></span>


<script src="<?=base_url('web_assets/scripts/recharge.js')?>"></script>
<script>
$('.brwsePlans').click(function(){
	$("#limitedoffers").hide();
	$("#browseplans").show();
});

$('.checkpostpaidPrepaid').click(function(){
	data = $('.checkpostpaidPrepaid').val();
	if(data == "Mobile postpaid")
	{
		$("#acc_number").show();
	}
	else
	{
		$("#acc_number").hide();
	}
});





$('.close').click(function(){
	$("#browseplans").hide();
	$("#limitedoffers").show();
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

</script>
