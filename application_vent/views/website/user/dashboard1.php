<?php $this->load->view('website/user/link_block.php');?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Orders</h3>
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
              <input class="form-control input-sm" placeholder="Provider No" type="text" style="width:100px">
            </form>
          </div>
        </div>
      </div>
      <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table class="table table-bordered table-striped dataTable no-footer">
          <thead>
            <tr>
              <th>Order Id</th>
              <th>Date</th>
              <th>Service</th>
              <th>Status</th>
              <th>Close Order</th>
              <th>Feedback</th>
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
                date: "08/9/2015",
                service: 1,
				status: "Active",
				closeorder: "08/12/2015",
				feedback: "Active",
				
            }, {
                id: "id2",
                date: "08/9/2015",
                service: 2,
				status: "Active",
				closeorder: "08/12/2015",
				feedback: "Active",
				
            }, {
                id: "id3",
                date: "08/9/2015",
                service: 3,
				status: "Active",
				closeorder: "08/12/2015",
				feedback: "Active",
				
            },{
                id: "id4",
                date: "08/9/2015",
                service: 4,
				status: "Active",
				closeorder: "08/12/2015",
				feedback: "Active",
				
            }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
               data: "id"
            }, {
                data: "date"
            }, {
                data: "service"
            }, {
				 data: "status"
			}, {
				 data: "closeorder"
			}, {
				 data: "feedback"
			}],
            searching: !0,
            dom: "rtip",
            pageLength: 5
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
    _init()
});
</script>