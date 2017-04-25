<?php $this->load->view('website/agent/menu_block.php')?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Completed Services List</h3>
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
              <th>Client Contact</th>
              <th>Service</th>
              <th>Status</th>
              <th>Ordered Date</th>
              <th>Completed Date</th>
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
                clientcontact: "id1",
                service: "service1",
                status: "completed",
				ordereddate: "08/9/2015",
				completeddate: "08/9/2015",
				
            }, {
                clientcontact: "id2",
                service: "service2",
                status: "completed",
				ordereddate: "10/9/2015",
				completeddate: "10/9/2015",
				
            }, {
                clientcontact: "id3",
                service: "service3",
                status: "completed",
				ordereddate: "20/9/2015",
				completeddate: "20/9/2015",
				
            },{
                clientcontact: "id4",
                service: "service4",
                status: "completed",
				ordereddate: "15/9/2015",
				completeddate: "15/9/2015",
				
            }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
               data: "clientcontact"
            }, {
                data: "service"
            }, {
                data: "status"
            }, {
				 data: "ordereddate"
			}, {
				 data: "completeddate"
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
        toggleBasicTableFns(), initDataTable()
    }
    _init()
});
</script>




<!--<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default mb20 project-stats table-responsive">
      <div class="panel-body">
      <h4 class="text-center">Completed Services List</h4>
      <div class="row">
              <div class="col-md-3">
              		<input type="text" class="form-control input-sm" placeholder="User Id">
              </div>
              <div class="col-md-3">
                  <input type="text" class="form-control input-sm" placeholder="Provider No">
              </div>
          </div>
        <table class="table">
          <thead>
            <tr>
              <th>Client Contact</th>
              <th>Service</th>
              <th>Status</th>
              <th>Ordered Date</th>
              <th>Completed Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
             <td>Id1</td>
              <td>Name1</td>
              <td>completed</td>
              <td>08/5/2015</td>
              <td>08/5/2015</td>
            <tr>
              <td>Id2</td>
              <td>Name2</td>
              <td>completed</td>
               <td>08/5/2015</td>
              <td>08/5/2015</td>
            </tr>
            <tr>
              <td>Id3</td>
              <td>Name3</td>
              <td>completed</td>
               <td>08/5/2015</td>
              <td>08/5/2015</td>
            </tr>
            <tr>
              <td>Id4</td>
              <td>Name4</td>
              <td>completed</td>
              <td>08/5/2015</td>
              <td>08/5/2015</td>
            </tr>
            <tr>
              <td>Id5</td>
              <td>Name5</td>
              <td>completed</td>
               <td>08/5/2015</td>
              <td>08/5/2015</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>-->