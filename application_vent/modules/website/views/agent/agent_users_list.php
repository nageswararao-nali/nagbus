<?php $this->load->view('website/agent/menu_block.php')?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Users Wallet Listing</h3>
        <div class="row">
          <div class="col-md-3 small text-bold left mt5"> Show&nbsp;
            <select class="lengthSelect">
              <option value="5" selected>5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
            &nbsp;entries </div>
          <div class="col-md-9 text-right">
            <form class="form-inline" action="javascript:;">
              <div class="form-group input-group">
                <input type="text" class="form-control input-sm searchInput" placeholder="search">
                <span class="input-group-addon ion ion-ios-search-strong" style="font-size:10px"></span> </div>
              <!--<input class="form-control input-sm" placeholder="Provider No" type="text" style="width:100px">-->
            </form>
          </div>
        </div>
      </div>
      <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table class="table table-bordered table-striped dataTable no-footer">
          <thead>
            <tr>
              <th>SR. NO.</th>
			  <th>User Name</th>
              <th>Account Name & Number</th>
              <th>Ref Number</th>
              <th>Payment Method</th>
			   <th>Total Amount</th>
			   <th>Date Time</th>
			   <th>Status</th>
			    <th>Action</th>
            </tr>
        </thead>
		<tbody>
		
		<?php
		$cnt=0;
		foreach($walletlist as $key => $value)
		{
			$cnt++;
		?>
		<tr>
		<td><?php echo $cnt?></td>
		<td><?php echo $value["userfullname"]?></td>
              <td><?php echo $value["account_name"]?><br>[<?php echo $value["account_number"]?>]</td>
              <td><?php echo $value["reference_number"]?></td>
              <td><?php //echo $value["payment_mode"]?>
			  
			    <?php
			   if($value["payment_mode"] ==2 )
			   {
				   echo "PayU";
			   }
			   else if($value["payment_mode"] ==1 )
			   {
				   echo "Bank";
			   }			  
			   else
			   {
				   echo "N/A";
			   }
			   ?>
			  </td>
			   <td><i style="color:green;" class="fa fa-inr"></i> <?php echo number_format($value["amount"],2)?></td>
			   <td><?php echo date("d/m/Y H:i:s",strtotime($value["create_dt"]));?></td>
			   <td>
			   <?php
			   if($value["payment_status"] ==0 )
			   {
				   echo "Pending";
			   }
			   else if($value["payment_status"] ==1 )
			   {
				   echo "Process";
			   }
			   else if($value["payment_status"] ==2 )
			   {
				   echo "Success";
			   }
			   else
			   {
				   echo "N/A";
			   }
			   ?>
			   </td>
			    <td><a href="http://laabus.com/agent/walletuserview/<?php echo $value["wallet_history_id"]?>">View Details</a></td>
		</tr>
		<?php }
		?>
		</tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
jQuery(function() {
    "use strict";

    function toggleBasicTableFns() {
        var $btable = $(".basic-table"),
            btns = [".btable-bordered", ".btable-striped", ".btable-condensed", ".btable-hover"];
        btns.forEach(function(btn) {
            $btable.find(btn).on("click touchstart", function(e) {
                var tableClass = $(this).data("table-class");
                e.preventDefault(), $(this).toggleClass("active"), $btable.find("table").toggleClass(tableClass)
            })
        })
    }

    function initDataTable() {
        for (var $dataTable = $(".data-table"), $table = $dataTable.find("table"), datas = <?php echo $agentuserlist;?>, prelength = datas.length, i = 0; i > Number(prelength); i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
               data: "name"
            }, {
                data: "wallet"
            }, {
                data: "lupdate"
            }],
            searching: !0,
            dom: "rtip",
            pageLength: 10
        });        
        $dataTable.find(".searchInput").on("keyup", function() {
            table.search(this.value).draw()
        }), $dataTable.find(".lengthSelect").on("change", function() {
            table.page.len(this.value).draw()
        }), $dataTable.find(".dataTables_info").css({
            "margin-left": "20px",
            "font-size": "12px"
        })
    }

    function _init() {		
        //initDataTable()
    }
   // _init()
});
</script>