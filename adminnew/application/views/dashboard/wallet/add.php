<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Channel Partner</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li><a href="<?php echo base_url() . 'dashboard/channel_partner/' ?>">Channel Partner</a> </li>
            <li class="active"><strong>Add Balance</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <?php echo form_open(base_url() . 'dashboard/add_user_money/' . $user_details[0]['user_id'].'/'.$page, array('class' => 'form-horizontal', 'id' => 'addUserMoney')); ?>
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-12">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Name/Email Address</label>
                    <div class="col-lg-8">
                        <?php echo!empty($user_details[0]['name']) ? $user_details[0]['name'] . '(' . $user_details[0]['email_id'] . ')' : $user_details[0]['email_id']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Wallet Balance</label>
                    <div class="col-lg-8">
                        <?php echo$user_details[0]['wallet']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">New Amount*</label>
                    <div class="col-lg-8">
                        <?php echo form_input("wallet", '', 'placeholder="Enter Amount to be Added in Wallet " class="form-control" id="wallet"') ?>
                    </div>
                </div>  
                <div class="form-group">
                    <label class="col-lg-4 control-label">Mark as credit</label>
                    <div class="col-lg-8">
                        <?php echo form_checkbox(array('name' => 'mark_as_credit', 'value' => 1, 'id' => 'mark_as_credit')) ?>
                    </div>
                </div>
                <div class="form-group hidden mark_as_credit_notes_div">
                    <label class="col-lg-4 control-label">Notes</label>
                    <div class="col-lg-8">
                        <?php echo form_input("mark_as_credit_notes", '', 'placeholder="Enter your comments " class="form-control" id="mark_as_credit_notes"') ?>
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
                    <button class="btn btn-sm btn-white" type="submit">Add</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>