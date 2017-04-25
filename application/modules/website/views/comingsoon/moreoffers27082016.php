

<?php //$this->load->view('website/recharge/navbar');?>


  <h4>Joining Offers:</h4>

 <div class="ibox-content">	
 <div class="row">	
				
		<?php
		if(!empty($offers1))
		{
			
			?>		
						
			        <?php                         
                           
									foreach( $offers1 as $key =>$value)
									{ 
                                        
                                      ?>
									  <div class="col-md-3">
			<div class="faq_container">
                        <div class="faq1">
                            <div class="faq_question1" ><h4 style="font-weight:bold; font-size:16px; margin:0px; text-align:center;"><?php echo strtoupper($value->title)?> </h4> </div>
                            <div class="faq_answer_container1">
                                <div class="faq_answer1" >
                                            <div class="remarks"><span ><?php echo $value->description;?></span><br></div>
                                            <div style="display:block; text-align:center; line-height:30px;  background-color:#03a9f4; color:#FFFFFF; margin-bottom:20px;"> [PROMO CODE: <h4 style="font-weight:bold; display:inline-block; font-size:16px; margin:0px "><?php echo strtoupper($value->promo_code)?> </h4>]</div>                                       
                                </div>
                            </div>
                        </div>
                    </div></div>
					
		<?php }
		?>
		
		<?php
		}
		?>
		
		<?php
		if(!empty($offers2))
		{
			
			?>		
					
			        <?php                         
                           
									foreach( $offers2 as $key =>$value)
									{ 
                                        
                                      ?>
									  <div class="col-md-3">	
			<div class="faq_container thumbnail">
                        <div class="faq1">
                            <div class="faq_question1" ><h4 style="font-weight:bold; font-size:16px; margin:0px; text-align:center;"><?php echo strtoupper($value->title)?> </h4> </div>
                            <div class="faq_answer_container1">
                                <div class="faq_answer1" >
                                            <div class="remarks"><span ><?php echo $value->description;?></span><br></div>
                                            
                                            <div style="display:block; text-align:center; line-height:30px;  background-color:#03a9f4; color:#FFFFFF; margin-bottom:20px;">[PROMO CODE: <h4 style="font-weight:bold; display:inline-block; font-size:16px; margin:0px "><?php echo strtoupper($value->promo_code)?> </h4>]</div>                                       
                                            
                                </div>
                            </div>
                        </div>
                    </div>
					</div>
					
		<?php }
		?>
		
		<?php
		}
		?>
		
			<?php
		if(!empty($offers3))
		{
			
			?>		
					
			        <?php                         
                           
									foreach( $offers3 as $key =>$value)
									{ 
                                        
                                      ?>
									  <div class="col-md-3">
			<div class="faq_container thumbnail">
                        <div class="faq1">
                            <div class="faq_question1" ><h4 style="font-weight:bold; font-size:16px; margin:0px; text-align:center;"><?php echo strtoupper($value->title)?> </h4> </div>
                            <div class="faq_answer_container1">
                                <div class="faq_answer1" >
                                           <div class="remarks"><span ><?php echo $value->description;?></span><br></div>                                       <div style="display:block; text-align:center; line-height:30px; background-color:#03a9f4; color:#FFFFFF; margin-bottom:20px;">[PROMO CODE:<h4 style="font-weight:bold; display:inline-block; font-size:16px; margin:0px "> <?php echo strtoupper($value->promo_code)?> </h4>]</div>
                                </div>
                            </div>
                        </div>
                    </div>	</div>
					
		<?php }
		?>
	
		<?php
		}
		?>
                
				
				
		
</div>
</div>

<hr>

<h4>Wallet Offers:</h4>

 <div class="ibox-content">	
 <div class="row">	
				
		<?php
		if(!empty($offerswallet1))
		{
			
			?>		
					
			        <?php                         
                           
									foreach( $offerswallet1 as $key =>$value)
									{ 
                                        
                                      ?>
									  <div class="col-md-3">	
			<div class="faq_container thumbnail">
                        <div class="faq1">
                            <div class="faq_question1" ><h4 style="font-weight:bold; font-size:16px; margin:0px; text-align:center;"><?php echo strtoupper($value->title)?></h4> </div>
                            <div class="faq_answer_container1">
                                <div class="faq_answer1" >
                                           <div class="remarks"><span ><?php echo $value->description;?></span><br></div>                                       <div style="display:block; text-align:center; line-height:30px;  background-color:#03a9f4; color:#FFFFFF; margin-bottom:20px;">[PROMO CODE: <h4 style="font-weight:bold; display:inline-block; font-size:16px; margin:0px "><?php echo strtoupper($value->promo_code)?> </h4>]</div>
                                </div>
                            </div>
                        </div>
                    </div></div>
					
		<?php }
		?>
		
		<?php
		}
		?>
		
		<?php
		if(!empty($offerswallet2))
		{
			
			?>		
					
			        <?php                         
                           
									foreach( $offerswallet2 as $key =>$value)
									{ 
                                        
                                      ?><div class="col-md-3">	
			<div class="faq_container thumbnail">
             <div class="faq1">
                            <div class="faq_question1" ><h4 style="font-weight:bold; font-size:16px; margin:0px; text-align:center;"><?php echo strtoupper($value->title)?></h4> </div>
                            <div class="faq_answer_container1">
                                <div class="faq_answer1" >
                                            <div class="remarks"><span ><?php echo $value->description;?></span><br></div>                                       <div style="display:block; text-align:center; line-height:30px;  background-color:#03a9f4; color:#FFFFFF; margin-bottom:20px;">[PROMO CODE:  <h4 style="font-weight:bold; display:inline-block; font-size:16px; margin:0px "><?php echo strtoupper($value->promo_code)?> </h4>]</span>
                                </div>
                            </div>
                        </div>
                    </div></div></div>
					
		<?php }
		?>
		
		<?php
		}
		?>
		
		<?php
		if(!empty($offerswallet3))
		{
			
			?>		
					
			        <?php                         
                           
									foreach( $offerswallet3 as $key =>$value)
									{ 
                                        
                                      ?><div class="col-md-3">	
			<div class="faq_container thumbnail">
                        <div class="faq1">
                            <div class="faq_question1" ><h4 style="font-weight:bold; font-size:16px; margin:0px; text-align:center;"><?php echo strtoupper($value->title)?></h4> </div>
                            <div class="faq_answer_container1">
                                <div class="faq_answer1" >
                                            <div class="remarks"><span ><?php echo $value->description;?></span><br></div>                                       <div style="display:block; text-align:center; line-height:30px;  background-color:#03a9f4; color:#FFFFFF; margin-bottom:20px;"> [PROMO CODE: <h4 style="font-weight:bold; display:inline-block; font-size:16px; margin:0px "><?php echo strtoupper($value->promo_code)?> </h4>]</div>
                                </div>
                            </div>
                        </div>
                    </div></div>
					
		<?php }
		?>
		
		<?php
		}
		?>
                
				
				
		

</div>


</div>

<div id="model_alert" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:green">Description</h4>
      </div>
      <div class="modal-body" id='desc' >
		
			
			
      </div>
      <div class="modal-footer">
        <!--<button type="button"  class="btn btn-default classwalkin" data-dismiss="modal">Save</button>-->
		 
		  <button type="button"  class="btn btn-default classcancel" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>

<style>
    .faq_question {
        margin: 0px;
        padding: 0px 0px 0px 10px;
        display: inline-block;
        cursor: pointer; margin-bottom:20px; overflow:hidden; display:block; background-color:#efefef;
        /*font-weight: bold;*/
    }
.faq_question1 { margin:10px 0px;}
    .faq_answer_container {
        height: 0px;
        overflow: hidden;
        padding: 0px;
    }

    .remarks
    {
        color:gray;
        font-family:verdana;
        margin:30px 10px;
    }

.thumbnail {
    background-color: #fcfcfc;
    border: 1px solid #d5d5d5;
    border-radius: 0;
    box-shadow: 1px 1px 2px -2px rgba(74, 73, 74, 1);
    height: 217px;
    margin-bottom: 30px;
    padding: 10px 0 0;
}


</style>


<script>

$('.faq_question').click(function() {
        //alert("here")

        if ($(this).parent().is('.open')){
            $(this).closest('.faq').find('.faq_answer_container').animate({'height':'0'},500);
            $(this).closest('.faq').removeClass('open');

        }else{
            var newHeight =$(this).closest('.faq').find('.faq_answer').height() +'px';
            $(this).closest('.faq').find('.faq_answer_container').animate({'height':newHeight},500);
            $(this).closest('.faq').addClass('open');
        }

    });
	
	
	
   $(document).ready(function() {
		
		$(document).on('click', '.descclass', function() {
	
	desc = $(this).data('content');
	$('#desc').html(desc);
	$('#model_alert').modal('show');
	
})
   })
   </script>
		
 