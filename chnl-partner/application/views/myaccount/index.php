<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>My Account</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li class="active"><strong>My Account</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <?php echo form_open(base_url() . 'myaccount/', array('class' => 'form-horizontal', 'id' => 'addAdmin')); ?>
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-8">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Username*</label>
                    <div class="col-lg-8">
                        <?php echo form_input("name", $user_details[0]['admin_name'], 'id="name" placeholder="Username" class="form-control"') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-lg-4 control-label">last Login*</label>
                    <div class="col-lg-8">
                        <?php echo $user_details[0]['lupdate']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Status*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("status", array("1" => "Active", "0" => "Inactive"), $user_details[0]['login_status'], 'class = "form-control" id = "status"') ?>
                    </div>
                </div>

            </div>
        </div>
        <!--</div>-->
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-offset-4">
<!--                    <button class="btn btn-sm btn-white" type="reset">Reset</button>
                    <a class="btn btn-sm btn-white" id="back" href="#">Back</a>-->
                    <button class="btn btn-sm btn-white" type="submit">Update</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!--    <div class="row" ng-controller="moduleCtrl">-->    
</div>