<?php $this->load->view('website/agent/menu_block.php')?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3 text-center"><i class="ion ion-android-phone-portrait" style="font-size:30px;;"></i>
            <p> Recharge</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-plug" style="font-size:30px;;"></i>
            <p>Home Services</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-plane" style="font-size:30px;;"></i>
            <p>Flight</p>
          </div>
          <div class="col-md-3 text-center"><i class="ion ion-android-bus" style="font-size:30px;;"></i>
            <p>Bus</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 text-center"><i class=" fa fa-building" style="font-size:30px;;"></i>
            <p>Hotels</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-tree" style="font-size:30px;"></i>
            <p>Holidays</p>
          </div>
          <div class="col-md-3 text-center"><i class="ion ion-model-s" style="font-size:30px;"></i>
            <p>Cabs</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-inr" style="font-size:30px;"></i>
            <p>Money</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 text-center"><i class="ion ion-card" style="font-size:30px;"></i>
            <p>Pay-bills</p>
          </div>
          <div class="col-md-3 text-center"><i class="ion  ion-paper-airplane" style="font-size:30px;"></i>
            <p>Courier</p>
          </div>
          <div class="col-md-3 text-center"><i class="fa fa-cutlery" style="font-size:30px;"></i>
            <p>Food </p>
          </div>
          <div class="col-md-3 text-center"><i class="ion fa fa-shopping-cart" style="font-size:30px;"></i>
            <p>E-shop</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="panel panel-default mb20 panel-hovered analytics">
      <div class="panel-heading">Analytics</div>
      <div class="panel-body" style="margin-bottom:30px;">
        <div id="c3chartAnalytics"></div>
      </div>
    </div>
  </div>
  <!-- #end analytics -->
  
  <div class="col-md-5 page-dashboard">
    <div class="panel panel-default mb20 activities">
      <div class="panel-heading">Notifications</div>
      <div class="panel-body">
        <ul class="list-unstyled">
          <li class="primary"> <span class="point"></span> <span class="time small text-muted">2 mins ago</span>
            <p>You got a mail. &nbsp;&nbsp;<i class="ion ion-email"></i>
			<span class="badge badge-danger badge-xs circle">3</span></p>
          </li>
          <li class="success"> <span class="point"></span> <span class="time small text-muted">1 hour ago</span>
            <p>Added new Service.</p>
          </li>
          <li class="warning"> <span class="point"></span> <span class="time small text-muted">after 3 hours</span>
            <p>Limited offers completed.</p>
          </li>
          <li class="info"> <span class="point"></span> <span class="time small text-muted">after 2 days</span>
            <p>SMD meeting.</p>
          </li>
          <li class="success"> <span class="point"></span> <span class="time small text-muted">after 5 days</span>
            <p>New offers available.</p>
          </li>
          <li class="primary"> <span class="point"></span> <span class="time small text-muted">after 2 days</span>
            <p>Remainders</p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-5 col-sm-6">
    <div class="panel panel-default mb20 panel-hovered">
      <div class="panel-heading">Service Share</div>
      <div class="panel-body text-center">
        <div id="c3chartbrowsershare"></div>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="panel panel-default mb20 project-stats table-responsive">
      <div class="panel-heading">Project Status</div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th class="col-sm-5">Project</th>
              <th class="col-sm-1">Progress</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>123</td>
              <td>Services Status</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">2,8</span></td>
              <td>25<sup>th</sup> sep 2015</td>
            </tr>
            <tr>
              <td>456</td>
              <td>Services Status</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">4,6</span></td>
              <td>24<sup>th</sup> sep 2015</td>
            </tr>
            <tr>
              <td>789</td>
              <td>Services Status</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">7,3</span></td>
              <td>23<sup>rd</sup> sep 2015</td>
            </tr>
            <tr>
              <td>246</td>
              <td>Services Status</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">4,6</span></td>
              <td>22<sup>nd</sup> sep 2015</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Order List</h3>
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
                <input type="text" class="form-control input-sm searchInput" placeholder="search">
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
              <th>Total Earning</th>
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
    function initSparklines() {
        $(".content-container").find(".sparkline").sparkline("html", {
            enableTagOptions: !0,
            tagOptionsPrefix: "data-"
        })
    }

    function _init() {
        initSparklines()
    }
    _init()
});
$(document).ready(function(){
	"use strict";
	/*function initSparklines() {
        $dash.find(".sparkline").sparkline("html", {
            enableTagOptions: !0,
            tagOptionsPrefix: "data-"
        })
    }*/
	function initC3Chart() {
        var analyticsconfig = {
                bindto: "#c3chartAnalytics",
                data: {
                    columns: [
                        ["Network Load", 30, 100, 80, 140, 150, 190],
                        ["CPU Load", 90, 100, 170, 140, 190, 200]
                    ],
                    type: "spline",
                    types: {
                        "Network Load": "bar"
                    }
                },
                color: {
                    pattern: ["#3F51B5", "#38B4EE", "#4CAF50", "#E91E63"]
                },
                legend: {
                    position: "inset"
                },
                size: {
                    height: 330,
					width: 550
                }
            },
            browserconfig = {
                bindto: "#c3chartbrowsershare",
                data: {
                    columns: [
                        ["Limited Offers", 28.9],
                        ["Home Services", 16.1],
						["Money Transfer", 16.1],
                        ["Bus", 10.9],
                        ["Flight", 12.1],
                        ["Cabs", 10.8],
						["Hotel", 10.1],
						["Holidays", 16.1],
						["Pay Bills", 12.1],
						["Courier", 11.1],
					    ["Food court", 15.1],
					    ["Recharges", 10.1]
                    ],
                    type: "donut"
                },
                size: {
                    width: 260,
                    height: 260
                },
                donut: {
                    width: 40
                },
                color: {
                    pattern: ["#3F51B5", "#4CAF50", "#f44336", "#E91E63", "#38B4EE"]
                }
            };
        c3.generate(analyticsconfig), c3.generate(browserconfig)
    }	
	
	function _init() {
        initC3Chart()
		//initSparklines()
		//initSparklines(), initEasyPieChart(), initRating(), TodoApp()
    }
    var $dash = $(".page-dashboard");
    _init()
	
	
});
</script> 
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