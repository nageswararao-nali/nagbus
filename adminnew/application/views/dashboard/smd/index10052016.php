<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Sales Marketing Department</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li class="active"><strong>Sales Marketing Department</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <?php echo form_open(base_url() . 'dashboard/sales_marketing_department/', array('class' => 'form-horizontal', 'id' => 'addSMDs')); ?>
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-6">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Name*</label>
                    <div class="col-lg-8">
                        <?php echo form_input("name", set_value("name"), 'id="name" placeholder="Name" class="form-control"') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Email Address*</label>
                    <div class="col-lg-8">
                        <?php echo form_input("email_address", set_value("email_address"), 'placeholder="Email Address" class="form-control" id="email_address"') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Mobile Number*</label>
                    <div class="col-lg-8">
                        <?php echo form_input("mobile_number", set_value("mobile_number"), 'placeholder="Mobile Number" class="form-control" id="mobile_number"') ?>
                    </div>
                </div>
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
                <div class="form-group">
                    <label class="col-lg-4 control-label">Status*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("status", array("1" => "Active", "0" => "Inactive"), '', 'class = "form-control" id = "status"') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox-content">

                <div class="form-group">
                    <label class="col-lg-4 control-label">Country*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("country", array("" => "Select Country") + $countries, "", " class=' form-control' id='country'"); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">State*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("state", $states, "IN", "class='form-control' id='state'"); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">District*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("district", $districts, "", "class='form-control' id='district'"); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">City*</label>
                    <div class="col-lg-8">
                        <?php echo form_dropdown("city", $cities, "", "class='form-control' id='city'"); ?>
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
                    <button class="btn btn-sm btn-white" type="submit">Create</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!--    <div class="row" ng-controller="moduleCtrl">-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Sales Marketing Department List</h5>
                </div>
                <div class="ibox-content">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name/Email Address</th>
                                <th>Mobile Number</th>
                                <th>City</th>
                                <th>District</th>
                                <th>State</th>
                                <th>Pincode</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($smds as $smd) { ?>
                                <tr>
                                    <td><?php echo $smd['user_id']; ?></td>
                                    <td><?php echo!empty($smd['name']) ? $smd['name'] . '(' . $smd['email_id'] . ')' : $smd['email_id']; ?></td>
                                    <td><?php echo $smd['mobile']; ?></td>
                                    <td><?php echo $smd['city_name']; ?></td>
                                    <td><?php echo $smd['district_name']; ?></td>
                                    <td><?php echo $smd['state_name']; ?></td>
                                    <td><?php echo $smd['pincode']; ?></td>
                                    <td>
                                        <?php if ($smd['status'] == 1) { ?>
                                            <font color="green">Approved</font>
                                        <?php } else { ?>
                                            <font color="red">Approval Pending</font>
                                        <?php } ?>
                                    </td>
                                    <td><!-- <a href="<?php echo base_url()?>dashboard/add_user_money/<?php echo $smd['user_id']; ?>/channel_partner">Add Money</a> - -->
                                        <a href="<?php echo base_url()?>dashboard/update_sales_marketing_department/<?php echo $smd['user_id']; ?>">Edit</a> - <a href="#" class="btn btn-white btn-sm deleteAction" title="Click me to delete" data-module="{{module.module_id}}"><i class="fa fa-times"></i> Delete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>