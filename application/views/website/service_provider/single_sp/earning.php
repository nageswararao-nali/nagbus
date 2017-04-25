<?php $this->load->view('website/service_provider/single_sp/links_block.php')?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Earnings
        <a href="javascript:;" class="btn btn-default btn-xs waves-effect pull-right"><i class="ion ion-printer"></i>Print</a>
        <a href="javascript:;" class="btn btn-default btn-xs waves-effect pull-right"><i class="ion ion-archive"></i>Download</a></h3>
        <div class="row">
          <div class="col-md-3 small text-bold left mt5"> Show&nbsp;
            <select class="lengthSelect">
              <option value="5">5</option>
              <option value="10" selected>10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
            &nbsp;entries </div>
          <div class="col-md-9 text-right">
            <form class="form-inline" action="javascript:;">
              <div class="form-group input-group">
                <input type="text" class="form-control input-sm searchInput" placeholder="Type keyword">
                <span class="input-group-addon ion ion-ios-search-strong" style="font-size:10px"></span> </div>
              <input class="form-control input-sm" placeholder="" type="search" style="width:100px">
              <input class="form-control input-sm" placeholder="" type="search" style="width:100px">
            </form>
          </div>
        </div>
      </div>
      <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table class="table table-bordered table-striped dataTable no-footer">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Login date</th>
              <th>Total Earnings</th>
              <th>Recieved Amount</th>
              <th>Amount in Wallet</th>
              <th>Pending Amount</th>
            </tr>
          </thead>
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
        for (var $dataTable = $(".data-table"), $table = $dataTable.find("table"), 
			datas = [{
                id: "id1",
                name: "name1",
                logindate: "8/12/2015",
				totalearnings: 5000,
				pendingamount: 3000,
				amountinwallet: 5000,
				earnings: 5000
                
            }, {
                id: "id2",
                name: "name2",
                logindate: "8/12/2015",
				totalearnings: 5000,
				pendingamount: 3000,
				amountinwallet: 5000,
				earnings: 5000
                
            }, {
                id: "id3",
                name: "name3",
                logindate: "8/12/2015",
				totalearnings: 5000,
				pendingamount: 3000,
				amountinwallet: 5000,
				earnings: 5000
            },{
                id: "id4",
                name: "name4",
                logindate: "8/12/2015",
				totalearnings: 5000,
				pendingamount: 3000,
				amountinwallet: 5000,
				earnings: 5000
             }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
                data: "id"
            }, {
                data: "name"
            }, {
                data: "logindate"
            }, {
				 data: "totalearnings"
			}, {
				 data: "pendingamount"
            }, {
                data: "amountinwallet"
            }, {
                data: "earnings"
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
</script> 
