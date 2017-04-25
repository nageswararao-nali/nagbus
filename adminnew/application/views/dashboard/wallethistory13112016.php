 <style>
			  .sub_cat_dis
			  {
				  width:210px;
				  float:left;
				  padding:5px;
			  }
			  .subcathide
			  {
				  display:none;
			  }
			  .footer {
    background: white none repeat scroll 0 0;
    border-top: 1px solid #e7eaec;
    bottom: 0;
    left: 0;
    padding: 10px 20px;
	position: relative;
    
}
			  </style>
			  
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Orders History</h5>
          <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
            <ul class="dropdown-menu dropdown-user">
              <li><a href="#">Config option 1</a> </li>
              <li><a href="#">Config option 2</a> </li>
            </ul>
            <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
        </div>				
       
          <table class="table table-hover" >
            <thead>
              <tr class="text-center">
                <th>User Name</th>
                <th>Wallet Amount</th>
                <th>View All Transsactions</th>
				
              </tr>
            </thead>
            <tbody >
			
			<?php
			foreach($user_details as $key=>$value)
			{
				?><tr>
				 <td><?php echo  $value["name"]?></td>
                <td><?php echo  $value["wallet"]?></td>
                <td><a href="http://laabus.com/adminnew/wallet/received/<?php echo  $value["user_id"]?>">View ALL</a></td>
				</tr>
				<?php
			}
			?>		
		
			
			
			
							
            
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
	
	 $('.chkall').click(function(){
            if($(this).is(":checked")){             
			   $(".chksubcat").prop('checked', true);			   
            }
            else if($(this).is(":not(:checked)")){
                 $(".chksubcat").prop('checked', false);
            }
        });
		
			 $(document).on('change','.chksubcat', function(event){	
			 if($(this).is(":checked"))
			 {
				chkall = 1;				 
			 }
			 else
			 {
				 chkall = 0;				
			 }
			 
           $( '.chksubcat' ).each(function( index ) {			
			if($(this).is(":checked")){
				chkall = 1;	
			}
			else
			{
				 chkall = 0;
				 return  false;
			}			
			});
			if(chkall == 0)				
				{
					$(".chkall").prop('checked', false);
				}
				else
				{
					$(".chkall").prop('checked', true);
				}
        });
		
		
		
		
		
	$(document).on('change','#sel_cat_id', function(event){	
	catid = $(this).val();
	if(catid == 2 )
	{
		catid = 22;
	}
		$.ajax({
		  url:"populat_sub_cat_search" ,
		  data:{catid:catid},
		  success:function(data) {
			 //return data; 
			 $("#subcatdiv").html(data);
			 $(".subcathide").show();
			 if(data == '' )
			 {
				 alert("No Sub category found...")
			 }
		  }
	   });
	})
})
</script>

<script type="text/javascript">
            $(function () {
              $('#sandbox-container input').datepicker({
    autoclose: true
});
            });
        </script>
