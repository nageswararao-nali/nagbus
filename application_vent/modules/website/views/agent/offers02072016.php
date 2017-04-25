<?php $this->load->view('website/agent/menu_block.php')?>

<h4>Joining Offers:</h4>

 <div class="ibox-content">	

				
		<?php
		echo wordwrap($offers[0]->joining_offers);
		?>	

</div>

<hr>

<h4>Wallet Offers:</h4>

 <div class="ibox-content">

				
		<?php
		echo wordwrap($offers[0]->wallet_offers);
		?>
	

</div>
		
 

