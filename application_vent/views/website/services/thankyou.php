<div class="col-md-12">
  <div class="panel panel-default panel-hovered panel-stacked mb30">
  <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">×</span> </button>
        <div>Dear Customer, Thank you for booking an order on laabus. We will send you the service provider details soon.</div>
      </div>
    <div class="panel-body">
     <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table aria-describedby="DataTables_Table_0_info" role="grid" id="DataTables_Table_0" class="table table-bordered table-striped dataTable no-footer">
          <tbody>
            <tr>
              <td><b>Your OrderId:</b></td>
              <td>4433</td>
            </tr>
            <tr>
              <td><b>Name:</b></td>
              <td>abc</td>
            </tr>
            <tr>
              <td><b>Address:</b></td>
              <td>Kukatpally</td>
            </tr>
            <tr>
              <td><b>Selected Location:</b></td>
              <td>Masab Tank, Hyderabad, Telangana, India</td>
            </tr>
            <tr>
              <td><b>Service Type:</b></td>
              <td>Electrical</td>
            </tr>
            <tr>
              <td><b>Sub Service:</b></td>
              <td>Tube Light Repair / Replacement</td>
            </tr>
            <tr>
              <td><b>Requested time:</b></td>
              <td>24-Sep-2015 12:00 PM - 01:00 PM</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
$(document).on('submit','#register_form',function(){
	$.ajax({
		url : baseurl+'Register/validate',
		data : $('#register_form').serialize(),
		type : 'post',
		success : function(res){
			var obj = JSON.parse(res);
			if(obj.err_code==1){
				$("#register_form").trigger("reset");
				$('.msg').parent('div').removeClass('alert-danger');
				$('.msg').parent('div').addClass('alert-success');
				$('.msg').parent('div').show();
				$('.msg').html(obj.message);
				$('.msg').parent('div').fadeOut(3000,'swing',function(){
					window.location.href='<?php echo base_url().'Login'?>';
				});
			}
			else{
				$('.msg').parent('div').removeClass('alert-success');
				$('.msg').parent('div').addClass('alert-danger');
				$('.msg').parent('div').show();
				$('.msg').html(obj.message);
			}
		}
	})
	return false;
})
</script>
