<?php $this->load->view('website/agent/menu_block.php') ?>
<script>
    $(document).ready(function (e) {
        $("#add_funds").validate({
            rules: {
                amount: {
                    required: true,
                    number: true
                },
                reference_number: {
                    required: true,
                    number: true
                },
                account_number: {
                    required: true,
                    number: true
                },
                counter_file: {
                    required: true
                },
                account_name: {
                    required: true
                },
                bank_name: {
                    required: true
                },
            },
            messages: {
                amount: {
                    required: "Please enter amount",
                    number: "Please enter only numbers"
                },
                reference_number: {
                    required: "Please enter bank reference number",
                    number: "Please enter only numbers"
                },
                account_number: {
                    required: "Please enter bank account number",
                    number: "Please enter only numbers"
                },
                counter_file: "Please upload the counter file",
                account_name: "Please enter account name",
                bank_name: "Please enter bank name",                
            }
        });
        $('input[type=radio][name=ptype]').change(function () {
            if (this.value == 1) {
                $("#bankref").removeClass('hidden');
            }
            else if (this.value == 2) {
                $("#bankref").addClass('hidden');
            }
        });
        $('input[type=radio][name=ttype]').change(function () {
            if (this.value == 1) {
                $(".aNumber").removeClass('hidden');
                $(".cFile").addClass('hidden');
            }
            else if (this.value == 2) {
                $(".cFile").removeClass('hidden');
                $(".aNumber").addClass('hidden');
            }
        });

    });
</script>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default panel-hovered panel-stacked mb30">
            <h4 class="text-center text-primary">Add Funds</h4>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" name="add_funds" id="add_funds" action="<?php echo base_url(); ?>agent/add_funds" method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="add_money">Add money to Laabus wallet</label>
                                <div class="col-sm-6">
                                    <input type="text" name="amount" id="amount" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">        
                                <div class="col-sm-offset-4 col-sm-6">
                                    <div class="radio">
                                        <label><input type="radio" value="1" name="ptype" id="bank" class="ptype">
										<!--&nbspBank&emsp;&emsp;-->
										Select this add funds through direct bank Deposit or Account transfer
										</label>
                                        <label><input type="radio"  name="ptype"  value="2" checked  id="payu" class="ptype">
										<!--&nbspPayu-->
										Select this add funds through netbanking/debit card/credit card
										</label>
                                    </div>
                                </div>
                            </div>
                            <div id="bankref" class="hidden">
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="reference_number">Reference Number </label>
                                    <div class="col-sm-6"><input type="text" name="reference_number" id="reference_number" class="form-control" ></div>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label col-sm-4" for="ref_number">Transfer Type </label>
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <label><input type="radio" value="1" name="ttype" checked>&nbspAccount Transfer&emsp;&emsp;</label>
                                            <label><input type="radio"  name="ttype"  value="2"  >&nbspCash Deposit</label>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="form-group aNumber">
                                    <label class="control-label col-sm-4" for="account_number">Account Number </label>
                                    <div class="col-sm-6"><input type="text" name="account_number" id="account_number" class="form-control" ></div>
                                </div>
                                <div class="form-group cFile hidden" >
                                    <label class="control-label col-sm-4" for="counter_file">Counter File </label>
                                    <div class="col-sm-6"><input type="file" name="counter_file" id="counter_file" class="form-control" ></div>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label col-sm-4" for="account_name">Account Name </label>
                                    <div class="col-sm-6"><input type="text" name="account_name" id="account_name" class="form-control" ></div>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label col-sm-4" for="bank_name">Bank Name </label>
                                    <div class="col-sm-6"><input type="text" name="bank_name" id="bank_name" class="form-control" ></div>
                                </div>
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