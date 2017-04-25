<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>Agents</h2>
        <ul class="breadcrumb">
            <li> <a href="<?php echo base_url() . 'dashboard' ?>">Dashboard</a> </li>
            <li><a href="<?php echo base_url() . 'dashboard/agents/' ?>">Agents</a> </li>
            <li class="active"><strong>View Details</strong></li>
        </ul>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row white-bg">
       
        <!--<div class="ibox float-e-margins">-->
        <div class="col-lg-6">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Name*</label>
                    <div class="col-lg-8">
                        <?php //echo form_input("name", $user_details[0]['name'], 'id="name" placeholder="Name" class="form-control"') ?>
						<label class="col-lg-12 control-label"><?php echo $user_details[0]['name']?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Email Address*</label>
                    <div class="col-lg-8">
                        <?php //echo form_input("email_address", $user_details[0]['email_id'], 'placeholder="Email Address" class="form-control" id="email_address"') ?>
						<label class="col-lg-12 control-label"><?php echo $user_details[0]['email_id']?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Mobile Number*</label>
                    <div class="col-lg-8">
                        <?php //echo form_input("mobile_number", $user_details[0]['mobile'], 'placeholder="Mobile Number" class="form-control" id="mobile_number"') ?>
						<label class="col-lg-12 control-label"><?php echo $user_details[0]['mobile']?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Status*</label>
                    <div class="col-lg-8">
                        <?php // echo form_dropdown("status", array("1" => "Active", "0" => "Inactive"), $user_details[0]['status'], 'class = "form-control" id = "status"') ?>
						<label class="col-lg-12 control-label">
						<?php if ( $user_details[0]['status'] == 1 ) echo "Active"; else echo "Inactive";?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox-content">

                <div class="form-group">
                    <label class="col-lg-4 control-label">Country*</label>
                    <div class="col-lg-8">
                        <?php //echo form_dropdown("country", array("" => "Select Country") + $countries, $user_details[0]['country_name'], " class=' form-control' id='country'"); ?>
						<label class="col-lg-12 control-label"><?php echo $countries[$user_details[0]['country_name']]?></label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">State*</label>
                    <div class="col-lg-8">
                        <?php //echo form_dropdown("state", $states, $user_details[0]['state_name'], "class='form-control' id='state'"); ?>
						<label class="col-lg-12 control-label"><?php echo $states[$user_details[0]['state_name']]?></label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">District*</label>
                    <div class="col-lg-8">
                        <?php //echo form_dropdown("district", $districts, $user_details[0]['district_name'], "class='form-control' id='district'"); ?>
						<label class="col-lg-12 control-label"><?php echo $districts[$user_details[0]['district_name']]?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">City*</label>
                    <div class="col-lg-8">
                        <?php //echo form_dropdown("city", $cities, $user_details[0]['city_name'] . "<=>" . $user_details[0]['pincode'], "class='form-control' id='city'"); ?>
						<label class="col-lg-12 control-label">
						<?php 
						if(isset($cities[$user_details[0]['city_name'] . "<=>" . $user_details[0]['pincode']]))
						echo $cities[$user_details[0]['city_name'] . "<=>" . $user_details[0]['pincode']];
					else
							echo "N/A";
						?></label>
                    </div>
                </div>

            </div>
        </div>
		
		
		<!-- BANK DETAILS -->
		<?php
		$this->db->where("User_id",$this->session->userdata("user_id"));
		$this->db->from('profile_bank_details');
		$query = $this->db->get();		
		$data = $query->result();
		//print_r($data);
		?>
		  <div class="col-lg-6">                
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-4 control-label">Account Holder Name*</label>
                    <div class="col-lg-8">
                        <?php //echo form_input("name", $user_details[0]['name'], 'id="name" placeholder="Name" class="form-control"') ?>
						<label class="col-lg-12 control-label"><?php echo isset($data[0]->acc_holder_name)?$data[0]->acc_holder_name:"N/A";?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Branch Name*</label>
                    <div class="col-lg-8">
                        <?php //echo form_input("email_address", $user_details[0]['email_id'], 'placeholder="Email Address" class="form-control" id="email_address"') ?>
						<label class="col-lg-12 control-label"><?php echo isset($data[0]->branch_name)?$data[0]->branch_name:"N/A";?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Account Number*</label>
                    <div class="col-lg-8">
                        <?php //echo form_input("mobile_number", $user_details[0]['mobile'], 'placeholder="Mobile Number" class="form-control" id="mobile_number"') ?>
						<label class="col-lg-12 control-label"><?php echo isset($data[0]->acc_number)?$data[0]->acc_number:"N/A";?></label>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox-content">

                <div class="form-group">
                    <label class="col-lg-4 control-label">Account Type*</label>
                    <div class="col-lg-8">
                      <label class="col-lg-12 control-label"><?php echo isset($data[0]->acc_type)?$data[0]->acc_type:"N/A";?></label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">Bank Name*</label>
                    <div class="col-lg-8">
                       <label class="col-lg-12 control-label"><?php echo isset($data[0]->bank_name)?$data[0]->bank_name:"N/A";?></label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-4 control-label">IFSC*</label>
                    <div class="col-lg-8">
                        <?php //echo form_dropdown("district", $districts, $user_details[0]['district_name'], "class='form-control' id='district'"); ?>
						<label class="col-lg-12 control-label"><?php echo isset($data[0]->ifsc_code)?$data[0]->ifsc_code:"N/A";?></label>
                    </div>
                </div>               

            </div>
        </div>
		<!-- -->
 
 
 
 
        <div class="col-lg-12">
            <div class="form-group">
                <div class="col-lg-offset-5">
                  
                    <a class="btn btn-sm btn-white" id="back" href="#">Back</a>
                   
                </div>
            </div>
        </div>
     
    </div>
</div>