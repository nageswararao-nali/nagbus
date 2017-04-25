<?php $this->load->view('website/agent/menu_block.php')?>
<script>
$(document).ready(function(e) {
    $("#add_funds").validate({
        rules: {
            amount: {
                required: true,
                number: true
            },
            ref_number: {
                required: true,
                number: true
            },
        },
        messages: {
            amount: {
                required: "Please enter amount",
                number: "Please enter only numbers"
            },
            ref_number: {
                required: "Please enter Bank Reference Number",
                number: "Please enter only numbers"
            },
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
            <form class="form-horizontal" name="add_funds" id="add_funds" action="<?php echo base_url();?>agent/add_funds" method="post">
              <div class="form-group">
                 <label class="control-label col-sm-4" for="add_money">Add money to Laabus wallet</label>
                 <div class="col-sm-6">
                  <input type="text" name="amount" id="amount" class="form-control" >
                </div>
              </div>
             <div class="form-group">        
                <div class="col-sm-offset-4 col-sm-6">
                  <div class="radio">
                     <label><input type="radio" onclick="showrefnum('bank')" value="1" name="ptype" id="bank">&nbspBank&emsp;&emsp;<input type="radio"  name="ptype"  onclick="showrefnum('payu')" value="2" checked  id="payu">&nbspPayu</label>
                     </div>
                  </div>
                </div>
             <div class="form-group" id="bankref">
              </div>
              <!--<div class="form-group">
                <div class="col-md-12">
                  <label >Have a Promo Code?</label>
                </div>
              </div>-->
              
              <div class="form-group">        
                <div class="col-sm-offset-4 col-sm-6">
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