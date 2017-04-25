<div class="wrapper wrapper-content animated fadeInRight" ng-controller="supportmatrixCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Locking Amount</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="ibox-content">
				
				
				<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
						  echo form_open('Lockamount/update_lockingamount',$attributes);										
				?>
					
						
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Agent Locking Amount</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Name" class="form-control" name="agent" id="agent" value='<?php echo $data[0]->agent;?>'>
								<input type="hidden" value=1 class="form-control" name="id">
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label class="col-lg-2 control-label">Channel Partner Locking Amount</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Name" class="form-control" name="channel_partner" id="channel_partner" value='<?php echo $data[0]->channel_partner;?>'>
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label class="col-lg-2 control-label">SMD Locking Amount</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Name" class="form-control" name="smd" id="smd" value='<?php echo $data[0]->smd;?>'>
                            </div>
                        </div>
						
						
                      
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-white" type="reset">Reset</button>
                                <button class="btn btn-sm btn-white" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('submit', '#update_category', function() {
        $.ajax({
            url: baseurl + 'Lockamount/update_lockingamount',
            data: $(this).serialize(),
            type: 'POST',
            cache: false,
            success: function(res) {
               // $("#create_supportmatrix").trigger("reset");
			   location.reload();
            }
        })
        return false;
    })
</script>
<script>
    $(document).ready(function() {
        $("#update_category").validate({
            rules: {
                role_id: {
                    required: true,
                },
				support_type: {
                    required: true,
                },
				contact_no: {
                    required: true,
                },
				timings: {
                    required: true,
                },
                email: {
                    required: true,
                },
				 comments: {
                    required: true,
                }
            }
        });
    });


</script>