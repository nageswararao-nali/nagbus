<!--this page is not used in any where-->
<?php
$rechargeInfo=json_decode($rechargeOrder->information);
?>
<div class="row">
  <div class="col-md-10">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <div class="row">
            <div class="col-md-6" style="font-size:16px;">
			<?php
			//print_r($this->session->userdata());
			if( $this->session->userdata('recharge_type') == "DTH")
			{
				?>
				Your DTH   <b><?php echo $rechargeInfo->mobile_no;?></b> process is failed.
				<?php
				
			}
			else if( $this->session->userdata('recharge_type') == "Data Card")
			{
				?>
				Your Data Card   <b><?php echo $rechargeInfo->mobile_no;?></b> process is failed.
				<?php
				
			}
			else if( $this->session->userdata('recharge_type') == "Electricity")
			{
				?>
				Your Electricity Bill   <b><?php echo $rechargeInfo->mobile_no;?></b> process is failed.
				<?php
				
			}
			else
			{
			?>
			
			Your <?php echo $rechargeInfo->operator_name;?> <b>mobile no. <?php echo $rechargeInfo->mobile_no;?></b> process is failed.
			<?php }
			?>
			</div>
          <div class="col-md-offset-3 col-md-3">
              <a href="<?php echo base_url('recharge');?>"><button type="submit" class="btn btn-primary">Try Again</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
