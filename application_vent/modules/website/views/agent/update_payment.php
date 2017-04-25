<div class="row">
  <div class="col-lg-8">
    <div class="panel mb20 panel-info panel-hovered">
      <div class="panel-heading text-center">Update Payment(NORMAL PAYMENT METHOD)</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12 alert alert-success">
            <button type="button" class="close" data-dismiss="alert"> </button>
            <div>All Same Bank to Bank Online transfers for mobile recharge credits are fully automated with instant credit.<br>
              For more details <b><a href="">Click Here</a></b></div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Service</label>
              <select class="form-control operators" name="operator"  required="">
                <option value="" >Normal SMS</option>
                <option value="" >Priority SMS</option>
                <option value="">Marketing SMS</option>
                <option value="">Transactional SMS</option>
                <option value="" >Voice Call</option>
                <option value="">9020501501[ LC]</option>
                <option value="" >9664964444[ VM]</option>
                <option value="" >Domain Reg</option>
                <option value="" >Domain Renewal</option>
                <option value="">Reseller Account Activation</option>
                <option value="" >Mobile Recharge API</option>
                <option value="" >Sender ID</option>
                <option value="" >Retailer Account Activation</option>
                <option value="" >MONTHLY RENTAL SIM HOSTING</option>
                <option value="" >Dedicated Sim Hosting</option>
                <option value="" >RESELLER UPGRADATION (RECHARGE)</option>
                <option value="" >Smart 2Way Messaging</option>
                <option value="" >Click 2 Call API</option>
                <option value="" >Missed Call Number (Toll Free)</option>
                <option value="" >Money Transfer Setup Cost</option>
                <option value="" >Money Transfer API</option>
                <option value="" >Flight Booking Engine Setup Cost</option>
                <option value="" >Flight Booking Engine API </option>
                <option value="" >Wallet</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Quantity</label>
              <input type="text" class="form-control fetch_network num_only"  placeholder="0" autofocus="" required="">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Amount</label>
              <input type="text" class="form-control fetch_network num_only" placeholder="Rs.0" autofocus="" required="">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>&nbsp;</label>
              <button type="button" class="btn btn-success btn-md mt15 ADD" style="margin-top:28px"><i class="fa fa-plus-square"></i>ADD</button> </div>
          </div>
        </div>
        <div class="col-md-12" style="display:none;" id="addamount">
          <div class="panel panel-default mb20 project-stats table-responsive">
            <div class="panel-body">
              <div class="row">
                <div class="modal-header clearfix bg-dark">
                  <div class="col-md-4">Wallet</div>
                  <div class="col-md-4">0</div>
                  <div class="col-md-4">200</div>
                   <button class="close right" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-right"> <font color="red">Total Amount: 200</font> </div>
              </div>
            </div>
          </div>
        </div>
        <hr/>
        <div class="row">
          <div class="col-md-6">
            <label>Payment Method</label>
            <select class="form-control operators" name="operator"  required="">
              <option value="" >ICICI to ICICI Transfer-118005000106</option>
              <option value="" > SBI to SBI Transfer-32214087879</option>
              <option value="">SBI NEFT/RTGS -32214087879</option>
              <option value="">SBI NEFT/RTGS -32214087879</option>
              <option value="" >ICICI NEFT/RTGS-118005000106</option>
              <option value="">DIRECT CASH AT TVM OFFICE</option>
              <option value="" >POWER SBI ACCOUNT-3362XXX4422</option>
              <option value="" >ICICI CASH DEPOSIT- 118005000106</option>
              <option value="" >ICICI CHEQUE DEPOSIT- 118005000106</option>
              <option value="">ICICI ATM TRANSFER- 118005000106</option>
              <option value="" >SBI Group Transfer - 32214087879</option>
              <option value="" >SBI Cash Deposit -32214087879</option>
              <option value="" >SBI Cheque Deposit -32214087879</option>
              <option value="" >HDFC TO HDFC-16628630000085</option>
              <option value="" >HDFC NEFT/RTGS-16628630000085</option>
              <option value="" >HDFC CASH DEPOSIT-16628630000085</option>
              <option value="" >HDFC CHEQUE DEPOSIT-16628630000085</option>
            </select>
          </div>
          <div class="col-md-6">
            <label>Your Bank Account Name</label>
            <input type="text" class="form-control" placeholder="ENTER YOUR ACCOUNT NAME" autofocus="" required="">
          </div>
        </div>
        <hr/>
        <div class="row">
          <div class="col-md-6">
            <label>Date of Payment</label>
            <input type="text" class="form-control" placeholder="28/09/2015" autofocus="" required="">
          </div>
          <div class="col-md-6">
            <label>Bank Reference Number</label>
            <input type="text" class="form-control" placeholder="ENTER REFERENCE NUMBER" autofocus="" required="">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Message / Instructions</label>
            <textarea class="form-control" name="content" placeholder="ENTER YOUR MESSAGE" rows="5"></textarea>
          </div>
        </div>
        <div class="row"> <a href="" type="button" class="btn btn-success btn-md mt15 waves-effect waves-effect pull-right waves-effect">Update</a> </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="panel mb20 panel-info panel-hovered">
        <div class="panel-heading text-center">My Recent Payments </div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>Date</th>
                <th colspan="2"><font color="red">28/09/2015/ 12:37:50 PM</font></th>
              </tr>
              <tr>
                <th>Status</th>
                <th colspan="2"><font color="red">Closed</font></th>
              </tr>
            </thead>
            <thead>
              <tr class="tableth">
                <th rowspan="1" colspan="1" style="width: 104px;">Services</th>
                <th rowspan="1" colspan="1">Quantity</th>
                <th rowspan="1" colspan="1">Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr class="gradeA odd">
                <td> Mobile Recharge API </td>
                <td> 1 </td>
                <td> 15000 </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="panel mb20 panel-info panel-hovered">
        <div class="panel-heading text-center">My Recent Transactions </div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr class="tableth">
                <th>Services</th>
                <th>Quantity</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr class="gradeA odd">
                <td> Mobile Recharge API </td>
                <td> 1 </td>
                <td> 15000 </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$('.ADD').click(function(){
	$("#addamount").show();
});
$('.close').click(function(){
	$("#addamount").hide();
});

</script>