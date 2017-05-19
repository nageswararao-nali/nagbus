<?php $this->load->view('website/smd_new/menu_block.php')?>

<h4>Joining Offers:</h4>

 <div class="ibox-content">


		<?php
		if(!empty($offers))
		{

			?>
			<div class="col-md-12">
			        <?php

									foreach( $offers as $key =>$value)
									{

                                      ?>
			<div class="faq_container">
                        <div class="faq">
                            <div class="faq_question" ><h5 style="float:left"><?php echo strtoupper($value->title)?> </h5> <span style="margin-left:25px; font-size:16px; color:#03a9f4; font-weight:bold;line-height:35px; ">[PROMO CODE: <?php echo strtoupper($value->promo_code)?>]</span></div>
                            <div class="faq_answer_container">
                                <div class="faq_answer" >
                                            <div class="remarks"><span ><?php echo $value->description;?></span><br></div>
                                </div>
                            </div>
                        </div>
                    </div>

		<?php }
		?>
		</div>
		<?php
		}
		?>





</div>

<hr>

<h4>Wallet Offers:</h4>

 <div class="ibox-content">


		<?php
		if(!empty($offerswallet))
		{

			?>
			<div class="col-md-12">
			        <?php

									foreach( $offerswallet as $key =>$value)
									{

                                      ?>
			<div class="faq_container">
                        <div class="faq">
                            <div class="faq_question" ><h5 style="float:left"><?php echo strtoupper($value->title)?></h5> <span style="margin-left:25px; font-size:16px; color:#03a9f4; font-weight:bold; line-height:35px; "> [PROMO CODE: <?php echo strtoupper($value->promo_code)?>] </span></div>
                            <div class="faq_answer_container">
                                <div class="faq_answer" >
                                            <div class="remarks"><span ><?php echo $value->description;?></span><br></div>
                                </div>
                            </div>
                        </div>
                    </div>

		<?php }
		?>
		</div>
		<?php
		}
		?>





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

    .faq_answer_container {
        height: 0px;
        overflow: hidden;
        padding: 0px;
    }

    .remarks
    {
        color:gray;
        font-family:verdana;
        margin:10px;
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



