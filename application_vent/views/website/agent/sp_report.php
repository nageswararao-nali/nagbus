<?php $this->load->view('website/agent/menu_block.php')?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Service Provider Reports
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
              <input class="form-control input-sm" placeholder="" type="text" style="width:100px">
              <input class="form-control input-sm" placeholder="" type="text" style="width:100px">
            </form>
          </div>
        </div>
      </div>
      <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table class="table table-bordered table-striped dataTable no-footer">
          <thead>
            <tr>
              <th>SP ID</th>
              <th>Name</th>
              <th>Total Services Wise</th>
              <th>Earning Wise</th>
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
				spid: 123456,
                name: "asd",
                totalserviceswise: "1,80,000",
				earningwise: "50,000",
				
            }, {
                spid: 456789,
                name: "xyz",
                totalserviceswise: "1,80,000",
				earningwise: "50,000",
                
            }, {
                spid: 789123,
                name: "pqr",
                totalserviceswise: "1,80,000",
				earningwise: "50,000",
            },{
                spid: 456123,
                name: "abc",
                totalserviceswise: "1,80,000",
				earningwise: "50,000",
             }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
               data: "spid"
            }, {
                data: "name"
            }, {
				 data: "totalserviceswise"
			}, {
				 data: "earningwise"
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
