<?php $this->load->view('website/recharge/right_block');?>

<div class="row">
  <div class="col-sm-4">
    <div class="panel mb20 panel-default panel-hovered">
      
      <div class="panel-body">
        <form >
          <div class="form-group">
            <select class="form-control" name="operator">
              <option value="" disabled="disabled">Select Operator</option>
              <option></option>
              <option></option>
            </select>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" placeholder="Select your Electricity Board">
          </div>
          <div class="form-group">
            <input class="form-control" type="text" placeholder="Amount">
          </div>
          <div class="clearfix right">
            <button class="btn btn-info mr5" type="submit">Proceed</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

