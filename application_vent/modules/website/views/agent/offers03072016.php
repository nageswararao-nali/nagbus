<?php $this->load->view('website/agent/menu_block.php')?>

<h4>Joining Offers:</h4>

 <div class="ibox-content">	

				
		<?php
		if(!empty($offers))
		{
			
			?>
			<ul>
			<?php
			foreach( $offers as $key =>$value)
			{
				?>
				<li><a href='javascript:;' data-content='<?php echo $value->description?>' class='descclass'><?php echo $value->title?></a></li>
				
				<?php
			}
			?>
			</ul>
			<?php
		}
		//echo wordwrap($offers[0]->joining_offers);
		?>	

</div>

<hr>

<h4>Wallet Offers:</h4>

 <div class="ibox-content">

				
	<?php
		if(!empty($offerswallet))
		{
			
			?>
			<ul>
			<?php
			foreach( $offerswallet as $key =>$value)
			{
				?>
				<li><a href='javascript:;' data-content='<?php echo $value->description?>' class='descclass'><?php echo $value->title?></a></li>
				
				<?php
			}
			?>
			</ul>
			<?php
		}
		//echo wordwrap($offers[0]->joining_offers);
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
<script>
   $(document).ready(function() {
		
		$(document).on('click', '.descclass', function() {
	
	desc = $(this).data('content');
	$('#desc').html(desc);
	$('#model_alert').modal('show');
	
})
   })
   </script>
		
 

