<div class="wrapper wrapper-content animated fadeInRight" ng-controller="supportmatrixCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Join & Refer (Mobile APP) Very First Time Details</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="ibox-content">
				
				
				<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
						  echo form_open('Offer/update_offeramount',$attributes);										
				?>
					
						
                        <div class="form-group">
                            <label class="col-lg-6 control-label">Amount to be Added in User Wallet first Time Only</label>
                            <div class="col-lg-6">
                                <input type="text"  placeholder="" class="form-control groupOfTexbox" name="offer_amount" id="offer_amount" value='<?php echo $data[0]->offer_amount;?>'>
								<input type="hidden" value=1 class="form-control" name="id">
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label class="col-lg-6 control-label">Minimum Balance in Wallet</label>
                            <div class="col-lg-6">
                                <input type="text"   placeholder="" class="form-control groupOfTexbox" name="min_wallet_amoun" id="min_wallet_amoun" value='<?php echo $data[0]->min_wallet_amoun;?>'>
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label class="col-lg-6 control-label">Valid For</label>
                            <div class="col-lg-6">
							
							
							<?php $users = $data[0]->users;
							$users = explode(",",$users);
							
							?>
						
                               <input type="checkbox" value="1" name="users[]" <?php if(in_array(1,$users)) echo "checked";?>> Agent &nbsp;&nbsp;&nbsp;&nbsp;
							    <input type="checkbox" value="2" name="users[]" <?php if(in_array(2,$users)) echo "checked";?>> User 
								 
                            </div>
                        </div>
						
						
                      
                        <div class="form-group">
                            <div class="col-lg-offset-6 col-lg-6">
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

function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57) && (charCode != 8))
            return false;
			
			
			 else {
    var len = $(element).val().length;
    var index = $(element).val().indexOf('.');
    if (index > 0 && charCode == 46) {
      return false;
    }
    if (index > 0) {
      var CharAfterdot = (len + 1) - index;
      if (CharAfterdot > 3) {
        return false;
      }
    }

  }

        return true;
    }    



    $(document).on('submit', '#update_category', function() {
        $.ajax({
            url: baseurl + 'Offer/update_offeramount',
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
		
		
		 $('.groupOfTexbox').keypress(function (event) {
            return isNumber(event, this)
        });
		
		
        /*$("#update_category").validate({
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
        });*/
		
		
    });


</script>