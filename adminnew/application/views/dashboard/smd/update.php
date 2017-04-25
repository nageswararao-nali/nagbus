<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Sales Marketing Department</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li><a href="<?php echo base_url() . 'dashboard/sales_marketing_department/' ?>">Sales Marketing Department</a> </li>
            <li class="active"><strong>Update Sales Marketing Department</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <?php echo form_open(base_url() . 'dashboard/update_sales_marketing_department/' . $user_details[0]['user_id'], array('class' => 'form-horizontal', 'id' => 'updateSMDs')); ?>
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-6">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Name*</label>
                    <div class="col-lg-8">
                        <?php echo form_input("name", $user_details[0]['name'], 'id="name" placeholder="Name" class="form-control"') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Email Address*</label>
                    <div class="col-lg-8">
                        <?php echo form_input("email_address", $user_details[0]['email_id'], 'placeholder="Email Address" class="form-control" id="email_address"') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Mobile Number*</label>
                    <div class="col-lg-8">
                        <?php echo form_input("mobile_number", $user_details[0]['mobile'], 'placeholder="Mobile Number" class="form-control" id="mobile_number"') ?>
                    </div>
                </div>
                <!--<div class="form-group">
                                    <label class="col-lg-4 control-label">Password (Change Password)*</label>
                                    <div class="col-lg-8">
                <?php echo form_password("password", '', 'placeholder="Password" class="form-control" id="password"') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">Confirm Password*</label>
                                    <div class="col-lg-8">
                <?php echo form_password("confirm_password", '', 'placeholder="Confirm Password" class="form-control" id="confirm_password"') ?>
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-lg-4 control-label">Status*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("status", array("1" => "Active", "0" => "Inactive"), $user_details[0]['status'], 'class = "form-control" id = "status"') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox-content">

                <div class="form-group">
                    <label class="col-lg-4 control-label">Country*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("country", array("" => "Select Country") + $countries, $user_details[0]['country_name'], " class=' form-control' id='country'"); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">State*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("state", $states, $user_details[0]['state_name'], "class='form-control' id='state'"); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">District*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("district", $districts, $user_details[0]['district_name'], "class='form-control' id='district'"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">City*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("city", $cities, $user_details[0]['city_name'] . "<=>" . $user_details[0]['pincode'], "class='form-control' id='city'"); ?>
                    </div>
                </div>

            </div>
        </div>
        <!--</div>-->
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-offset-5">
                    <button class="btn btn-sm btn-white" type="reset">Reset</button>
                    <a class="btn btn-sm btn-white" id="back" href="#">Back</a>
                    <button class="btn btn-sm btn-white" type="submit">Update</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>