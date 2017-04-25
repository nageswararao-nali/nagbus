<?php $this->load->view('website/agent/menu_block.php') ?>
<script>
    $(document).ready(function (e) {
        $("#wallet_withdraw").validate({
            rules: {
                amount: {
                    required: true,
                    number: true,
                    min: 500
                },
                account_number: {
                    required: true,
                    number: true
                },
                account_name: {
                    required: true
                },
                bank_name: {
                    required: true
                },
                ifsc_code: {
                    required: true
                },
            },
            messages: {
                amount: {
                    required: "Please enter amount",
                    number: "Please enter only numbers",
                    min: "Minimum wallet amount should be 500"
                },
                account_number: {
                    required: "Please enter bank account number",
                    number: "Please enter only numbers"
                },
                account_name: "Please enter account name",
                bank_name: "Please enter bank name",
                ifsc_code: "Please enter bank name",
            }
        });
    });
</script>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default panel-hovered panel-stacked mb30">
            <h4 class="text-center text-primary">Withdraw Funds</h4>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" name="wallet_withdraw" id="wallet_withdraw" action="<?php echo base_url(); ?>agent/wallet_withdraw_otp" method="post">
                            <div class="form-group">
                                <label class="control-label col-sm-4" >Laabus Wallet amount</label>
                                <div class="col-sm-6">
                                    <?= $user->wallet ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="add_money">Withdraw money from Laabus wallet</label>
                                <div class="col-sm-6">
                                    <input type="text" name="amount" id="amount" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="account_number">Account Number </label>
                                <div class="col-sm-6"><input type="text" name="account_number" id="account_number" class="form-control" value="<?php echo isset($bankdetails[0]->acc_holder_name)?$bankdetails[0]->acc_number:"";?>"  ></div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-sm-4" for="account_name">Account Name </label>
                                <div class="col-sm-6"><input type="text" name="account_name" id="account_name" class="form-control" value="<?php echo isset($bankdetails[0]->acc_holder_name)?$bankdetails[0]->acc_holder_name:"";?>" ></div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-sm-4" for="bank_name">Bank Name </label>
                                <div class="col-sm-6"><input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo isset($bankdetails[0]->acc_holder_name)?$bankdetails[0]->bank_name:"";?>" ></div>
                            </div>
                            <div class="form-group" >
                                <label class="control-label col-sm-4" for="ifsc_code">IFSC Code </label>
                                <div class="col-sm-6"><input type="text" name="ifsc_code" id="ifsc_code" class="form-control" value="<?php echo isset($bankdetails[0]->acc_holder_name)?$bankdetails[0]->ifsc_code:"";?>" ></div>
                            </div>
                            <div class="form-group">        
                                <div class="col-sm-offset-4 col-sm-6">
                                    <button type="submit" class="btn btn-info">Withdraw money from Wallet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>