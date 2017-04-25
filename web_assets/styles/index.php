<div class="recharge_content">
<div class="content_with_ajax_modified">

<div class="row">
  <div class="col-sm-12">
    <div class="btn-group btn-group-sm navContainer"> 
      <!--    <a href="<?php echo base_url()?>Index/recharge/history" class="btn-tag btn-tag-info view-month waves-effect l">Your orders</a> <a href="<?php echo base_url()?>Index/recharge/history" class="btn-tag btn-tag-success view-month waves-effect l">Transactions</a> <a href="<?php echo base_url()?>Index/recharge/history" data-toggle="dropdown" class="btn-tag btn-tag-danger view-month waves-effect l">Wallet</a><a href="<?php echo base_url()?>Index/recharge/DTH" data-toggle="dropdown" class="btn-tag btn-tag-primary view-month waves-effect l">DTH</a> 
-->
      <ul style="margin-left:-30px;">
        <li style="display:inline; margin-right:10px;"><a href="<?php echo base_url()?>Index/recharge/index">Mobile</a> </li>
        <li style="display:inline; margin-right:10px;"> <a href="<?php echo base_url()?>Index/recharge/DTH">DTH</a></li>
        <li style="display:inline; margin-right:10px;"> <a href="<?php echo base_url()?>Index/recharge/datacard">DataCard</a></li>
        <li style="display:inline; margin-right:10px;"> <a href="<?php echo base_url()?>Index/recharge/landline">Landline</a></li>
        <li style="display:inline; margin-right:10px;"> <a href="<?php echo base_url()?>Index/recharge/electricity">Electricity</a></li>
      </ul>
    </div>
  </div>
</div>


  <div class="row">
    <div class="col-sm-12 homepage-form">
      <div class="panel mb20 panel-default panel-hovered">
        
        <div class="panel-body"> <?php echo form_open('recharge/proceed','id="recForm" method="post" autocomplete="off"')?>
          <input type="hidden" name="redirect" value="Recharge/proceed"/>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="ui-radio-inline">
                  <input type="radio" name="recharge_type" value="Mobile prepaid" checked="checked" required>
                  <span>Prepaid</span> </label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="ui-radio-inline">
                  <input type="radio" name="recharge_type" value="Mobile postpaid" required> <?php //Hard coded you need to modify in future?>
                  <span>Postpaid</span> </label>
              </div>
            </div>
            
           
            
            
            <div class="col-md-3"> 
            <div class="brwsePlans" data-toggle="modal" data-target="#PlanModal" id="brwsePlans" style="cursor:pointer">
            <div style="color:#3F51B5;"><span>Browse Plans of <span class="operator_title">all operators</span></span></div>
            <input type="hidden" name="operator_name" value=""/>
            <span style="display:none">
            <select name="operator_circle">
              <option value="">Select Circle</option>
            </select>
            </span> </div>
            
            </div>
            
             <div class="col-md-3">
            
             <input type="checkbox" class="credit">
              <label for="cabselect">Mark as credit</label>
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
          
          <div class="form-group">
            <input type="text" class="form-control rcAmount" placeholder="Recharge Amount" name="rcAmount">
          </div>
           <div class="form-group homepage-rech ">
             
              <input type="text" class="form-control Comments" style="display:none" placeholder="Enter Your Comments">
            </div>
          <div class="clearfix right">
            <button class="btn btn-info mr5" type="submit" name="Proceed">Proceed</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    
    
    
    
    <div class="col-sm-12">
  

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
$('.brwsePlans').click(function(){
 // $("#limitedoffers").hide();
  $("#browseplans").show();
});
$('.close').click(function(){
  $("#browseplans").hide();
  //$("#limitedoffers").show();
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
