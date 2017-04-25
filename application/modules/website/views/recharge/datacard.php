<?php
$this->load->view('website/recharge/navbar');
?><div class="row">  <div class="col-sm-12 homepage-form">    <div class="panel mb20 panel-default panel-hovered">            <div class="panel-body">       <?php
echo form_open('recharge/proceed', 'id="recForm" method="post" autocomplete="off"');
?>          <input type="hidden" name="redirect" value="Recharge/proceed"/>		  <input type="hidden" name="recharge_type" value="Data Card"/>          <div class="form-group">            <select class="form-control operators" name="operator">              <option value="" disabled="disabled">Select Operator</option>            </select>          </div>          <div class="form-group">            <input class="form-control" type="text" name="mobile_no" id="mobile_no" placeholder="Enter your 10 Digit Number">          </div>          <div class="form-group">            <input class="form-control" type="text" placeholder="Amount"  name="rcAmount" id="rcAmount">          </div><input type="hidden" name="operator_name" value=""/>            <button class="btn btn-info mr5" type="submit">Proceed</button>          </div>        </form>      </div>    </div>  </div></div><?php
$this->load->view('website/recharge/right_block');
?><script src="<?= base_url('web_assets/scripts/rechargeDataCard.js') ?>"></script><script>$('.credit').click(function() {
        if ($(this).is(':checked')) {
            $(".Comments").show()
        } else {
            $(".Comments").hide()
        }
        ;
    });</script>