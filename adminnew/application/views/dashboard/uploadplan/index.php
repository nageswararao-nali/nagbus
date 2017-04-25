<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Agents</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li class="active"><strong>Agents</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
        <?php echo form_open(base_url() . 'dashboard/savebrowseplandata/', array('class' => 'form-horizontal', 'id' => 'addAgents','enctype' => 'multipart/form-data','method'=>'post')); ?>
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-6">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Circle*</label>
                    <div class="col-lg-8">
                        <?php //echo form_input("name", set_value("name"), 'id="name" placeholder="Name" class="form-control"') ?>
						<select name='recharge_offer_circle_id' id='recharge_offer_circle_id' required>
						<?php
						foreach($circles as $key =>$value)
						{
							if( $value['recharge_offer_circle_id'] == 1 )
							{
								$value['recharge_offer_circle_id'] = '';
							}
						?>
						<option value="<?php echo $value['recharge_offer_circle_id']?>"><?php echo $value['circle_name']?></option>
						<?php
						}
						?>
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Operators*</label>
                    <div class="col-lg-8">
                        <select name='recharge_offer_operators_id' id='recharge_offer_operators_id' required>
						<?php
						foreach($op as $key =>$value)
						{
							if( $value['recharge_offer_operators_id'] == 1 )
							{
								$value['recharge_offer_operators_id'] = '';
							}
						?>
						<option value="<?php echo $value['recharge_offer_operators_id']?>"><?php echo $value['operator_name']?></option>
						<?php
						}
						?>
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Plan*</label>
                    <div class="col-lg-8">
                       <select name='recharge_offer_plan_id' id='recharge_offer_plan_id' required>
					   <option value=''>Select</option>
						<?php
						foreach($plans as $key =>$value)
						{
						?>
						<option value="<?php echo $value['recharge_category_id']?>"><?php echo $value['category_name']?></option>
						<?php
						}
						?>
						</select>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-lg-4 control-label">Upload CSV*</label>
                    <div class="col-lg-8">
                       <input type="file" name="userfile" accept=".csv"  required>
                    </div>
                </div>
				
				
               
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-offset-5">
                    <!--<button class="btn btn-sm btn-white" type="reset">Reset</button>
                    <a class="btn btn-sm btn-white" id="back" href="#">Back</a>-->
                    <button class="btn btn-sm btn-white" type="submit">Upload Browse Plan Data</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
     </div>
</div>