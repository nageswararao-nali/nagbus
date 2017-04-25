<?php $this->load->view('website/recharge/navbar');?>
<div class="row">
  <div class="col-sm-12 homepage-form">
    <div class="panel mb20 panel-default panel-hovered">
      
      <div class="panel-body">
       <?php echo form_open('recharge/proceed','id="recForm" method="post" autocomplete="off"')?>          <input type="hidden" name="redirect" value="Recharge/proceed"/>		  <input type="hidden" name="recharge_type" value="DTH"/>
          <div class="form-group">
            <select class="form-control operators" name="operator">
              <option value="" disabled="disabled">Select Operator</option>
            </select>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" name="mobile_no" id="mobile_no" placeholder="Enter your customer ID">
          </div>
          <div class="form-group">
            <input class="form-control" type="text" placeholder="Amount"  name="rcAmount" id="rcAmount">
          </div>		  		  <?php			if( $this->session->userdata('role_id') )			{			?>
           <div class="form-group">
              <!--<input type="checkbox" class="credit">
              <label for="cabselect">Mark as credit</label>-->
			  <input type="checkbox" value="1" name="mark_as_credit_user" class="credit">
              <label for="cabselect">Mark as credit</label>
              <!--<input type="text" class="form-control Comments" style="display:none" placeholder="Enter Your Comments">-->
			  <input type="text" class="form-control Comments"  name="mark_as_credit_comments" style="display:none" placeholder="Enter Your Comments">
            </div>						<?php }			?>
          <div class="clearfix right">
            <button class="btn btn-info mr5" type="submit">Proceed</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('website/recharge/right_block');?>
<script src="<?=base_url('web_assets/scripts/rechargeDTH.js')?>"></script>

<script>
$('.credit').click(function(){
	if ($(this).is(':checked')){
	$(".Comments").show()
	} else {
		$(".Comments").hide()
	};
});
</script>