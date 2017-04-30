 <style>
			  .sub_cat_dis
			  {
				  width:140px;
				  float:left;
				  padding:5px;
			  }
			  
			  </style>
<div class="wrapper wrapper-content animated fadeInRight" ng-controller="supportmatrixCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Users Cashback Offers</h5>
                    <!-- <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div> -->
                </div>
			   	<div class="ibox-content">
			   		<div style="float:right;margin-right:5%;">
			   			<a class="btn btn-primary btn-xs dim" href="./create">Add</a>
			   		</div>
			   		<table class="table table-hover">
			            <thead>
			              	<tr>
						  		<th>Title</th>
							    <th>Promo Code</th>
				                <th>Amount/Percentage</th>
				                <th>Min Purchase</th>
				                <th>Agent</th>
				                <th>User</th>				
				                <th>User under Agent </th>  
								<th>Validity Period </th>  
				                <th>Actions</th>
			              	</tr>
			            </thead>
            			<tbody class="tblCategories2" >
							<?php
							if (!empty($cashback_offers))
							{
								foreach ($cashback_offers as $key=>$cbOffer)
								{
								?> 
								<tr id="a<?php echo $cbOffer["cbk_id"]?>" >
					   				<td ><a href='javascript:;' data-content='<?php echo $cbOffer["title"]?>' class='descclass'><?php echo $cbOffer["cbk_title"]?></a></td>
									<td><?php echo $cbOffer["cbk_promo_code"]; ?></td>
									<td><?php echo $cbOffer["cbk_amount_percentage"] . ' ' . $cbOffer["cbk_mode"]; ?></td>
					                <td><?php echo $cbOffer["cbk_min_purchase"]; ?></td>     
					                <td><?php echo $cbOffer["cbk_isAgent"] == 1 ? "YES" : "No"; ?></td>
					                <td><?php echo $cbOffer["cbk_isUser"] == 1 ? "YES" : "No"; ?></td>
					                <td><?php echo $cbOffer["cbk_isAgentUser"] == 1 ? "YES" : "No"; ?></td>
					                <td><?php echo date("d/m/Y",strtotime($cbOffer["cbk_st_date"])) ." to ".date("d/m/Y",strtotime($cbOffer["cbk_end_date"]));?></td>
					                <td>
					                	<a href='javascript:;' custdata="<?php echo $cbOffer["cbk_id"]?>" custisActive="<?php echo $cbOffer['cbk_status'] ? 'InActive' : 'Active'; ?>" class="activate_cashback_offer btn btn-primary btn-xs dim"><?php echo $cbOffer['cbk_status'] ? 'InActive' : 'Active'; ?></a>
					                	<a href='./view/<?php echo $cbOffer["cbk_id"]; ?>' custdata="<?php echo $cbOffer["cbk_id"]?>" class="btn btn-primary btn-xs dim">View</a>
				                	</td>
		             			</tr>
								<?php 
								}
							} else { ?>
							<tr><td colspan=7>No data found.</td></tr>
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

