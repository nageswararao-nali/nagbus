<?php $this->load->view('website/service_provider/single_sp/links_block.php')?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Recieved Calls</h3>
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
              <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Phone No</th>
                <th>Address</th>
                <th>status</th>
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
                name: "asdf",
                date: "20/9/2015",
                time: "11:00AM",
				phoneno: "9999999999",
				address: "address",
				status: '<input type="radio" name="service_provider" id="Accept">Accept &nbsp;&nbsp;<input type="radio" name="service_provider" id="Reject">Reject'
				
            }, {
                name: "xyz",
                date: "10/9/2015",
                time: "11:00AM",
				phoneno: "9999999999",
				address: "address",
				status: '<input type="radio" name="service_provider" id="Accept">Accept &nbsp;&nbsp;<input type="radio" name="service_provider" id="Reject">Reject'
				
            }, {
                name: "pqrs",
                date: "22/9/2015",
                time: "11:00AM",
				phoneno: "9999999999",
				address: "address",
				status: '<input type="radio" name="service_provider" id="Accept">Accept &nbsp;&nbsp;<input type="radio" name="service_provider" id="Reject">Reject'
				
            },{
                name: "awsd",
                date: "08/9/2015",
                time: "11:00AM",
				phoneno: "9999999999",
				address: "address",
				status: '<input type="radio" name="service_provider" id="Accept">Accept &nbsp;&nbsp;<input type="radio" name="service_provider" id="Reject">Reject'
				
            }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
               data: "name"
            }, {
                data: "date"
            }, {
                data: "time"
            }, {
				 data: "phoneno"
			}, {
				 data: "address"
			}, {
				 data: "status"
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
  <div class="col-md-10">
    <div class="panel panel-default mb20 project-stats table-responsive">
      <div class="panel-body">
        <h4 class="text-center">Recieved Calls</h4>
        <div class="row">
          <div class="col-md-3">
            <input type="text" class="form-control input-sm" placeholder="User Id">
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control input-sm" placeholder="Provider No">
          </div>
        </div>
        <div class="form-group">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Phone No</th>
                <th>Address</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Name1</td>
                <td>28/5/2015</td>
                <td>11:00AM</td>
                <td>9876543210</td>
                <td>address</td>
                <td><input type="radio" name="service_provider" id="Accept">Accept</input></td>
                <td><input type="radio" name="service_provider" id="Reject">Reject</input></td>
              </tr>
              <tr>
                <td>Name1</td>
                <td>28/5/2015</td>
                <td>11:00AM</td>
                <td>9876543210</td>
                <td>address</td>
                <td><input type="radio" name="service_provider" id="Accept">Accept</input></td>
                <td><input type="radio" name="service_provider" id="Reject">Reject</input></td>
              </tr>
              <tr>
                <td>Name1</td>
                <td>28/5/2015</td>
                <td>11:00AM</td>
                <td>9876543210</td>
                <td>address</td>
                <td><input type="radio" name="service_provider" id="Accept">Accept</input></td>
                <td><input type="radio" name="service_provider" id="Reject">Reject</input></td>
              </tr>
              <tr> 
                <td>Name1</td>
                <td>28/5/2015</td>
                <td>11:00AM</td>
                <td>9876543210</td>
                <td>address</td>
                <td><input type="radio" name="service_provider" id="Accept">Accept</input></td>
                <td><input type="radio" name="service_provider" id="Reject">Reject</input></td>
              </tr>
              <tr>
                <td>Name1</td>
                <td>28/5/2015</td>
                <td>11:00AM</td>
                <td>9876543210</td>
                <td>address</td>
                <td><input type="radio" name="service_provider" id="Accept">Accept</input></td>
                <td><input type="radio" name="service_provider" id="Reject">Reject</input></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
-->