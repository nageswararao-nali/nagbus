<?php $this->load->view('website/smd/links_block.php')?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <div class="row">
          <div class="left">
            <h4 class="text-center">TOTAL EARNINGS</h4>
          </div>
          <div class="right"> <a href="javascript:;" class="btn btn-default btn-xs waves-effect pull-right"><i class="ion ion-printer"></i>Print</a> <a href="javascript:;" class="btn btn-default btn-xs waves-effect pull-right"><i class="ion ion-archive"></i>Download</a></div>
        </div>
        <div class="row mt15">
          <div class="small text-bold col-md-2">
            <select class="form-control" name="State">
              <option>Select State</option>
              <option>Andra pradesh</option>
              <option>Telangana</option>
            </select>
          </div>
          <div class="small text-bold col-md-2">
            <select class="form-control" name="District">
              <option>Select District</option>
              <option>Adilabad </option>
              <option>Hyderabad </option>
              <option>Karimnagar </option>
              <option>Anantapur </option>
              <option>Chittoor </option>
              <option>Guntur </option>
              <option>Krishna </option>
            </select>
          </div>
          <div class="small text-bold col-md-2">
            <select class="form-control" name="Zip_code">
              <option>500050</option>
              <option>500048</option>
              <option>500047</option>
              <option>500049</option>
            </select>
          </div>
          <div class="col-md-2 small text-bold right mb10"> Show&nbsp;
            <select class="lengthSelect">
              <option value="5">5</option>
              <option value="10" selected>10</option>
              <option value="20">20</option>
              <option value="50">50</option>
            </select>
            &nbsp;entries </div>
        </div>
        <div class="right col-lg-2">
          <form class="form-horizontal" action="javascript:;">
            <div class="form-group input-group">
              <input type="text" class="form-control input-sm searchInput" placeholder="search">
              <span class="input-group-addon ion ion-ios-search-strong" style="font-size:10px"></span> </div>
          </form>
        </div>
      </div>
      <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table class="table table-bordered table-striped dataTable no-footer">
          <thead>
            <tr>
              <th>Total Earnings</th>
              <th>Recivied Amount</th>
              <th>Amount in Wallet</th>
              <th>By month</th>
              <th>Pending Payment</th>
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
                totalearning: 1234,
                reciviedamount: 2000,
                amountinwallet: 5000,
				bymonth: 1000,
				pendingpayment: 1000,
				
            }, {
                totalearning: 4567,
                reciviedamount: 1000,
                amountinwallet: 5000,
				bymonth: 1000,
				pendingpayment: 2000,
				
            }, {
                totalearning: 7894,
                reciviedamount: 1500,
                amountinwallet: 5000,
				bymonth: 2000,
				pendingpayment: 1500,
				
            },{
                totalearning: 9871,
                reciviedamount: 2000,
                amountinwallet: 5000,
				bymonth: 1000,
				pendingpayment: 2000,
				
            }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
               data: "totalearning"
            }, {
                data: "reciviedamount"
            }, {
                data: "amountinwallet"
            }, {
				 data: "bymonth"
			}, {
				 data: "pendingpayment"
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
