<?php $this->load->view('website/channel_partner/links_block.php')?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px">
      <div class="panel-heading text-center"><h4>Invoice List</h4></div>
      <div class="panel-body">
        <div class="small text-bold left mt5"> Show&nbsp;
          <select class="lengthSelect">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
          </select>
          &nbsp;entries </div>
        <form class="form-horizontal right col-lg-2" action="javascript:;">
          <div class="form-group input-group">
         <input type="text" class="form-control input-sm searchInput" placeholder="search">
         <span class="input-group-addon ion ion-ios-search-strong" style="font-size:10px"></span> </div>
        </form>
      </div>
      <!-- data table -->
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="width:20%"> Date</th>
            <th> ID</th>
            <th> Customer Name</th>
            <th> Status</th>
            <th> Amount</th>
            <th> Invoice</th>
            <th> Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--Profile Popup-->
<div class="modal modalFadeInScale" id="invoiceViewModal">
  <div class="modal-dialog"  style="width:700px;"> 
    <div class="modal-content">
      <div class="email-compose">
        <div class="modal-header clearfix bg-dark">
        <div class="text-uppercase h3 left title">Laabus</div>
        <div class="text-uppercase h3 right title">Invoice</div>
          <button class="close right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="invoice-wrap">
            <div class="clearfix invoice-subhead mb20">
              <div class="group clearfix left">
                <p class="text-bold mb5">Invoice No - 006</p>
                <p class="small">Date: 16<sup>th</sup> March 2015</p>
              </div>
              <div class="group clearfix right"> <a href="javascript:;" class="btn btn-default waves-effect"><i class="ion ion-printer"></i>Print</a> <a href="javascript:;" class="btn btn-default waves-effect"><i class="ion ion-archive"></i>Download</a> </div>
            </div>
            <div class="row mb30">
              <div class="col-md-6">
                <div class="address-wrap">
                  <div class="address-title">
                    <p class="mb5">Sent To</p>
                    <h4 class="mt0 text-bold mb0">Varini Info Systems Pvt.Ltd.</h4>
                  </div>
                  <address>
                  302, Sri Kalki Chambers<br>
                  Opp, Reliance Fresh<br>
                  Madinaguda, Hyderabad-500049<br>
                  </address>
                </div>
              </div>
              <div class="col-md-6">
                <div class="address-wrap">
                  <div class="address-title">
                    <p class="mb5">Recieved From</p>
                    <h4 class="mt0 text-bold mb0">Varini Info Systems Pvt.Ltd.</h4>
                  </div>
                  <address>
                  302, Sri Kalki Chambers<br>
                  Opp, Reliance Fresh<br>
                  Madinaguda, Hyderabad-500049<br>
                  </address>
                </div>
              </div>
            </div>
            <div class="dataTables_wrapper no-footer">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="30%">Services</th>
                    <th>% Wise</th>
                    <th>Commision</th>
                    <th>Total</th>
                  </tr>
                <tbody>
                  <tr class="odd" role="row">
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                    <td>Doe</td>
                  </tr>
                  <tr class="odd" role="row">
                    <td>Mary</td>
                    <td>Moe</td>
                    <td>mary@example.com</td>
                    <td>Doe</td>
                  </tr>
                  <tr class="odd" role="row">
                    <td>July</td>
                    <td>Dooley</td>
                    <td>july@example.com</td>
                    <td>Doe</td>
                  </tr>
                </tbody>
                  </thead>
                
              </table>
            </div>
            <div class="row ">
              <div class="col-md-12">
                <h3 class="text-right">Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                <h3 class="text-right">RS.2146123</h3>
              </div>
            </div>
            <p class="text-center small text-info">THANK YOU FOR YOUR BUSSINESS!</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Profile Popup end--> 

<!--<div class="row">
  <div class="col-md-12">
    <div class="panel mb20 panel-default panel-hovered">
    <div class="row">
  
      <div class="panel-heading text-center"><h4>Invoice List</h4></div>
      <div class="panel-body">
        <div class="form-group input-group col-md-3"> <span class="input-group-addon ion ion-search"></span>
          <input class="form-control" placeholder="name/ID" type="search">
        </div>
        
            <div class="dataTables_wrapper no-footer">
              <table class="table table-bordered table-striped">
          <thead>
            <tr role="row">
              <th>Date</th>
              <th>Id</th>
              <th>Customer Name</th>
              <th>Status</th>
              <th>Amount</th>
              <th>Invoice</th>
              <th>Access</th>
            </tr>
          </thead>
          <tbody>
           <?php for($i=1; $i<=50;$i++) {?>

<tr class="odd" role="row">
             <td>Id<?=$i?></td>
              <td>Name<?=$i?></td>
              <td>completed</td>
              <td>08/5/2015</td>
              <td>08/5/2015</td>
              <td>08/5/2015</td>
              <td><label><a href="<?php echo base_url()?>Index/channel_partner/invoice"><input type="radio"><span>Access</span></a> </label></td>
              </tr>



<?php }?>
          </tbody>
        </table>
              <div style="margin-left: 20px; font-size: 12px;" aria-live="polite" role="status" id="DataTables_Table_0_info" class="dataTables_info">Showing 1 to 10 of 100 entries</div>
              <div id="DataTables_Table_0_paginate" class="dataTables_paginate paging_simple_numbers"><a id="DataTables_Table_0_previous" tabindex="0" data-dt-idx="0" aria-controls="DataTables_Table_0" class="paginate_button previous disabled">Previous</a><span><a tabindex="0" data-dt-idx="1" aria-controls="DataTables_Table_0" class="paginate_button current">1</a><a tabindex="0" data-dt-idx="2" aria-controls="DataTables_Table_0" class="paginate_button ">2</a><a tabindex="0" data-dt-idx="3" aria-controls="DataTables_Table_0" class="paginate_button ">3</a><a tabindex="0" data-dt-idx="4" aria-controls="DataTables_Table_0" class="paginate_button ">4</a><a tabindex="0" data-dt-idx="5" aria-controls="DataTables_Table_0" class="paginate_button ">5</a><span class="ellipsis">…</span><a tabindex="0" data-dt-idx="6" aria-controls="DataTables_Table_0" class="paginate_button ">10</a></span><a id="DataTables_Table_0_next" tabindex="0" data-dt-idx="7" aria-controls="DataTables_Table_0" class="paginate_button next">Next</a></div>
           
        </div>
      </div>
    </div>
  </div>
  
</div>
</div>--> 
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
        for (var $dataTable = $(".data-table"), $table = $dataTable.find("table"), 
			datas = [{
                date: "22/10/2015 1:00:15",
                id: 12345,
                customername: "abc",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                date: "22/10/2015 1:00:15",
                id: 456789,
                customername: "xyz",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                date: "22/10/2015 1:00:15",
                id: 123789,
                customername: "asd",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            },{
                date: "22/10/2015 1:00:15",
                id: 3456,
                customername: "asd",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            },{
                date: "22/10/2015 1:00:15",
                id: 123456,
                customername: "abc",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            },{
                date: "22/10/2015 1:00:15",
                id: 987456,
                customername: "name",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
                data: "date"
            }, {
                data: "id"
            }, {
                data: "customername"
            }, {
                data: "status"
            }, {
                data: "amount"
            }, {
                data: "invoice"
            }, {
                data: "action"
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
        toggleBasicTableFns(), initDataTable()
    }
    _init()
});

$(document).on('click','.view_invoice',function(){
	$('#invoiceViewModal').modal('show');
});
</script>