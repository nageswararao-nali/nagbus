<?php $this->load->view('website/channel_partner/links_block.php')?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Daily Reports
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
              <th>Date</th>
              <th>Total Services wise</th>
              <th>Total Agents wise</th>
              <th>Total SP wise</th>
              <th>Channel Partner wise</th>
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
				date: "8/9/2015",
                totalserviceswise: "20,00,000",
                totalagentswise: "1,80,000",
				totalspwise: "50,000",
				channelpartnerwise: "1,00,000"
				
            }, {
                date: "18/10/2015",
                totalserviceswise: "20,00,000",
                totalagentswise: "1,80,000",
				totalspwise: "50,000",
				channelpartnerwise: "1,00,000"
                
            }, {
                date: "20/11/2015",
                totalserviceswise: "20,00,000",
                totalagentswise: "1,80,000",
				totalspwise: "50,000",
				channelpartnerwise: "1,00,000"
            },{
                date: "10/12/2015",
                totalserviceswise: "20,00,000",
                totalagentswise: "1,80,000",
				totalspwise: "50,000",
				channelpartnerwise: "1,00,000"
             }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
               data: "date"
            }, {
                data: "totalserviceswise"
            }, {
                data: "totalagentswise"
            }, {
				 data: "totalspwise"
			}, {
				 data: "channelpartnerwise"
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
