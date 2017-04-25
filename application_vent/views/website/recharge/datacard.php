<?php $this->load->view('website/recharge/right_block');?>

<div class="row">
  <div class="col-sm-4">
    <div class="panel mb20 panel-default panel-hovered">
     
      <div class="panel-body">
        <form >
       <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="ui-radio-inline">
                  <input type="radio" name="recharge_type"checked="checked" required>
                  <span>Prepaid DataCard</span> </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="ui-radio-inline">
                  <input type="radio" name="recharge_type" required> <?php //Hard coded you need to modify in future?>
                  <span>Postpaid DataCard</span> </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control fetch_network num_only" placeholder="DataCard no" autofocus required>
          </div>
          <div class="form-group">
            <select class="form-control operators" name="operator" style="width: 100%" required>
              <option value="" disabled="disabled">Select Operator</option>
            </select>
          </div>
          
            <div class="text-right" style="color:#3F51B5;"><span>Browse Plans of all operators</span></div>
           
           
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Recharge Amount">
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
</div>
<script>
$('.credit').click(function(){
	if ($(this).is(':checked')){
	$(".Comments").show()
	} else {
		$(".Comments").hide()
	};
});
</script>