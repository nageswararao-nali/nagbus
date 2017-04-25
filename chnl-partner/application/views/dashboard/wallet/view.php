<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Channel Partner</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li><a href="<?php echo base_url() . 'wallet/requests' ?>">Wallet Requests</a> </li>
            <li class="active"><strong>View</strong></li>
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
                        <?php $status = array(0 => 'Pending', 1 => 'Decline', 2, 'Success'); echo $status[$wallet_history->payment_status] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Notes</label>
                    <div class="col-lg-8">
                        <?= $wallet_history->notes ?>
                    </div>
                </div>
            </div>
        </div>     
        <?php echo form_close(); ?>
    </div>
</div>