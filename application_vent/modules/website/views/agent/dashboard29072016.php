<?php $this->load->view('website/agent/menu_block.php')?>


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
			if( $this->session->userdata('role_id') )
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


<!--<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3 text-center"><i class="ion ion-android-phone-portrait" style="font-size:30px;;"></i>
            <p> Recharge</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-plug" style="font-size:30px;;"></i>
            <p>Home Services</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-plane" style="font-size:30px;;"></i>
            <p>Flight</p>
          </div>
          <div class="col-md-3 text-center"><i class="ion ion-android-bus" style="font-size:30px;;"></i>
            <p>Bus</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 text-center"><i class=" fa fa-building" style="font-size:30px;;"></i>
            <p>Hotels</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-tree" style="font-size:30px;"></i>
            <p>Holidays</p>
          </div>
          <div class="col-md-3 text-center"><i class="ion ion-model-s" style="font-size:30px;"></i>
            <p>Cabs</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-inr" style="font-size:30px;"></i>
            <p>Money</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 text-center"><i class="ion ion-card" style="font-size:30px;"></i>
            <p>Pay-bills</p>
          </div>
          <div class="col-md-3 text-center"><i class="ion  ion-paper-airplane" style="font-size:30px;"></i>
            <p>Courier</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-cutlery" style="font-size:30px;"></i>
            <p>Food </p>
          </div>
          <div class="col-md-3 text-center"><i class="ion fa fa-shopping-cart" style="font-size:30px;"></i>
            <p>E-shop</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>-->
<!--<div class="row">
  <div class="col-md-7">
    <div class="panel panel-default mb20 panel-hovered analytics">
      <div class="panel-heading">Analytics</div>
      <div class="panel-body" style="margin-bottom:30px;">
        <div id="c3chartAnalytics"></div>
      </div>
    </div>
  </div>
   #end analytics 
  
  <div class="col-md-5 page-dashboard">
    <div class="panel panel-default mb20 activities">
      <div class="panel-heading">Notifications</div>
      <div class="panel-body">
        <ul class="list-unstyled">
          <li class="primary"> <span class="point"></span> <span class="time small text-muted">2 mins ago</span>
            <p>You got a mail. &nbsp;&nbsp;<i class="ion ion-email"></i>
			<span class="badge badge-danger badge-xs circle">3</span></p>
          </li>
          <li class="success"> <span class="point"></span> <span class="time small text-muted">1 hour ago</span>
            <p>Added new Service.</p>
          </li>
          <li class="warning"> <span class="point"></span> <span class="time small text-muted">after 3 hours</span>
            <p>Limited offers completed.</p>
          </li>
          <li class="info"> <span class="point"></span> <span class="time small text-muted">after 2 days</span>
            <p>SMD meeting.</p>
          </li>
          <li class="success"> <span class="point"></span> <span class="time small text-muted">after 5 days</span>
            <p>New offers available.</p>
          </li>
          <li class="primary"> <span class="point"></span> <span class="time small text-muted">after 2 days</span>
            <p>Remainders</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>-->
<!--<div class="row">
  <div class="col-md-5 col-sm-6">
    <div class="panel panel-default mb20 panel-hovered">
      <div class="panel-heading">Service Share</div>
      <div class="panel-body text-center">
        <div id="c3chartbrowsershare"></div>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="panel panel-default mb20 project-stats table-responsive">
      <div class="panel-heading">Project Status</div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th class="col-sm-5">Project</th>
              <th class="col-sm-1">Progress</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>123</td>
              <td>Services Status</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">2,8</span></td>
              <td>25<sup>th</sup> sep 2015</td>
            </tr>
            <tr>
              <td>456</td>
              <td>Services Status</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">4,6</span></td>
              <td>24<sup>th</sup> sep 2015</td>
            </tr>
            <tr>
              <td>789</td>
              <td>Services Status</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">7,3</span></td>
              <td>23<sup>rd</sup> sep 2015</td>
            </tr>
            <tr>
              <td>246</td>
              <td>Services Status</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">4,6</span></td>
              <td>22<sup>nd</sup> sep 2015</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>-->