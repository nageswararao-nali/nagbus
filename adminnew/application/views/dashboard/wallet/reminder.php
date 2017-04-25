<div class="wrapper wrapper-content animated fadeInRight" ng-controller="operatorCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Wallet Reminder </h5>
                    <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a> </li>
                            <li><a href="#">Config option 2</a> </li>
                        </ul>
                        <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="ibox-content">
                 
                       <?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
						  echo form_open('Wallet/sendReminder',$attributes);										
				?>
					
					   <div class="form-group">
                            <label class="col-lg-6 control-label">Minimum Balance in Wallet (INR)</label>
                            <div class="col-lg-6">
                                <input type="text" required   placeholder="" class="form-control " name="min_wallet_amoun" id="min_wallet_amount" value='10.00'>
                            
							</div>
							 <div class="col-lg-6">
                                
                            <button class="btn btn-primary btn-xs dim" type="submit" id="flat_apply_comm_submit"><i class="fa fa-check"></i>Send Reminder</button>
							</div>
                        </div>
						</form>
                </div>
            </div>
        </div>
    </div>

</div>
