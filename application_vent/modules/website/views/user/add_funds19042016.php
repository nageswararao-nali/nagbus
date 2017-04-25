<?php $this->load->view('website/user/link_block.php')?>
<script>
$(document).ready(function(e) {
    $("#add_funds").validate({
        rules: {
            amount: {
                required: true,
                number: true
            }
        },
        messages: {
            amount: {
                required: "Please enter amount",
                number: "Please enter only numbers"
            }
        },
	ignore: [],
    });
});
function showrefnum(id){
    if($("input:radio[name='ptype']").is(":checked")) {
        if(id=="bank"){
            $("#bankref").html('<label class="control-label col-sm-4" for="ref_number">Reference Number </label><div class="col-sm-6"><input type="text" name="ref_number" id="ref_number" class="form-control" ></div>');
        }else{
            $("#bankref").html('');
        }
    }else{
        $("#bankref").html('');
    }
}
</script>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
        <h4 class="text-center text-primary">Add Funds</h4>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form class="form-inline" name="add_funds" id="add_funds" action="<?php echo base_url();?>user/add_funds" method="post">
              <div class="form-group">
                <div class="col-md-12">
                  <label>Add money to Laabus wallet</label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-4">
                  <input type="text" name="amount" id="amount" class="form-control" >
                </div>
              </div>
              <!--<div class="form-group">
                <div class="col-md-12">
                  <label >Have a Promo Code?</label>
                </div>
              </div>-->
              <div class="form-group">
                <div class="col-md-4">
                  <button type="submit" class="btn btn-info">Add money to Wallet</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>