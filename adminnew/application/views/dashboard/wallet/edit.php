<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Channel Partner</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li><a href="<?php echo base_url() . 'wallet/requests' ?>">Wallet Requests</a> </li>
            <li class="active"><strong>Edit</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <?php echo form_open(base_url() . 'wallet/update', array('class' => 'form-horizontal', 'id' => 'updateWalletRequest')); ?>
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-12">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Name/Email Address</label>
                    <div class="col-lg-8">
                        <?php echo!empty($wallet_history->name) ? $wallet_history->name . ' ( ' . $wallet_history->email_id . ' )' : $wallet_history->email_id; ?>                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Amount</label>
                    <div class="col-lg-8">
                        <?= $wallet_history->amount ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Reference Number</label>
                    <div class="col-lg-8">
                        <?= $wallet_history->reference_number ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Transfer Type</label>
                    <div class="col-lg-8">
                        <?= ($wallet_history->transfer_type == 1) ? 'Account' : 'Deposit' ?>
                    </div>
                </div>
                <?php if ($wallet_history->transfer_type == 1) { ?>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Account Number</label>
                        <div class="col-lg-8">
                            <?= $wallet_history->account_number ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Counter File</label>
                        <div class="col-lg-8">
                            <a href="<?= base_url('wallet/download_counter_file/' . $wallet_history->counter_file) ?>" target="_blank">Download</a>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Account Name</label>
                    <div class="col-lg-8">
                        <?= $wallet_history->account_name ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Bank Name</label>
                    <div class="col-lg-8">
                        <?= $wallet_history->bank_name ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Status</label>
                    <div class="col-lg-8">
                        <label class="radio-inline"><input type="radio" value="2" name="status" >&nbspApprove&emsp;&emsp;</label>
                        <label class="radio-inline"><input type="radio"  name="status"  value="1"  >&nbspDecline</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Notes</label>
                    <div class="col-lg-8">
                        <?php echo form_input("notes", '', 'placeholder="Enter your comments " class="form-control" id="notes"') ?>
                    </div>
                </div>
            </div>
        </div>       
        <!--</div>-->
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-offset-4">
                    <button class="btn btn-sm btn-white" type="reset">Reset</button>
                    <a class="btn btn-sm btn-white" id="back" href="#">Back</a>
                    <button class="btn btn-sm btn-white" type="submit">Update</button>
                </div>
            </div>
        </div>
        <input type="hidden" value="<?= $wallet_history->wallet_history_id?>" name="wallet_history_id"/>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $(document).ready(function (e) {
        $("#updateWalletRequest").validate({
            rules: {
                status: {
                    required: true
                },
                notes: {
                    required: true
                },
            },
            messages: {
                status: "Please select status",
                notes: "Please enter notes",
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