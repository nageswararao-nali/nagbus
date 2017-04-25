<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Channel Partner</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li><a href="<?php echo base_url() . 'myaccount/' ?>">My Account</a> </li>
            <li class="active"><strong>Change Password</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <?php echo form_open(base_url() . 'myaccount/changepassword/' . $user_details[0]['a_id'], array('class' => 'form-horizontal', 'id' => 'adminChangePassword')); ?>
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-8">                
            <div class="ibox-content">

                <div class="form-group">
                    <label class="col-lg-4 control-label">Password*</label>
                    <div class="col-lg-8">
                        <?php echo form_password("password", '', 'placeholder="Password" class="form-control" id="password"') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-4 control-label">Confirm Password*</label>
                    <div class="col-lg-8">
                        <?php echo form_password("confirm_password", '', 'placeholder="Confirm Password" class="form-control" id="confirm_password"') ?>
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
        <?php echo form_close(); ?>
    </div>
</div>