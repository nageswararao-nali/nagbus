<?php $this->load->view('website/recharge/navbar');?>
<div class="row">
  <div class="col-sm-4">
    <div class="panel mb20 panel-default panel-hovered">
      
      <div class="panel-body">
        <form >
          <div class="form-group">
            <select class="form-control" name="operator">
              <option value="" disabled="disabled">Select Operator</option>
            </select>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" placeholder="Enter your customer ID">
          </div>
          <div class="form-group">
            <input class="form-control" type="text" placeholder="Amount">
          </div>
           <div class="form-group">
              <input type="checkbox" class="credit">
              <label for="cabselect">Mark as credit</label>
              <input type="text" class="form-control Comments" style="display:none" placeholder="Enter Your Comments">
            </div>
          <div class="clearfix right">
            <button class="btn btn-info mr5" type="submit">Proceed</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('website/recharge/right_block');?>

<script>
$('.credit').click(function(){
	if ($(this).is(':checked')){
	$(".Comments").show()
	} else {
		$(".Comments").hide()
	};
});
</script>