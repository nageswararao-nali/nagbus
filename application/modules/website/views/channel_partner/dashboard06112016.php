<?php $this->load->view('website/channel_partner/links_block.php')?>

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
            <p>2 Agents are joined.</p>
          </li>
          <li class="warning"> <span class="point"></span> <span class="time small text-muted">3 hours ago</span>
            <p>5 Service Providers are joined.</p>
          </li>
          <li class="info"> <span class="point"></span> <span class="time small text-muted">after 2 days</span>
            <p>SMD meeting.</p>
          </li>
          <li class="success"> <span class="point"></span> <span class="time small text-muted">after 5 days</span>
            <p>Conduct workshop.</p>
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
              <th>Id</th>
              <th class="col-sm-5">Project</th>
              <th class="col-sm-1">Progress</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>101</td>
              <td>Total Services</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">2,8</span></td>
              <td>26<sup>th</sup> sep 2015</td>
            </tr>
            <tr>
              <td>220</td>
              <td>Total Agents</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">4,6</span></td>
              <td>26<sup>th</sup> sep 2015</td>
            </tr>
            <tr>
              <td>310</td>
              <td>Total Service Providers</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">7,3</span></td>
              <td>26<sup>nd</sup> sep 2015</td>
            </tr>
            <tr>
              <td>405</td>
              <td>Total Users</td>
              <td class="text-center"><span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">4,6</span></td>
              <td>26<sup>th</sup> sep 2015</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--<div class="row">
  <div class="col-md-9">
    <div class="panel panel-default calendar-toolbar mb20 text-center">
    <div class="panel-body">
								<div class="btn-group btn-group-sm left">
				                    <button type="button" class="btn btn-default ion ion-arrow-left-c prev-btn"></button>
				                    <button type="button" class="btn btn-default ion ion-arrow-right-c next-btn"></button>
				                </div>
				               	<button type="button" class="btn btn-default btn-sm ml15 left today-btn">today</button>
				               	<strong class="text-uppercase current-date"></strong>
				               	<div class="btn-group btn-group-sm right">
				                    <button type="button" class="btn btn-default view-month">Month</button>
				                    <button type="button" class="btn btn-default view-week">Week</button>
				                    <button type="button" class="btn btn-default view-day">Day</button>
				                </div>
							</div>
							<div id="fullCalendar"></div>
                            </div>
						</div>

 
  <div class="col-sm-3">
    <button type="button" class="btn btn-pink btn-icon-inline btn-sm mb15 addEventBtn">
							<i class="ion ion-plus"></i>
								Add Event
							</button>
							<ul class="calevents list-unstyled" id="calevents">
							
							</ul>
  </div>
</div>-->

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

<!--<div class="row">
  <div class="col-md-9">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-heading">Order List</div>
      <div class="panel-body">
        <div class="form-group">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-md-1">
                <label class="control-label"><i class="fa fa-search"></i></label>
              </div>
              <div class="col-md-5">
                <input type="text" class="form-control" style="height:30px;" placeholder="From Date"/>
              </div>
              <div class="col-md-1">
                <label class="control-label"><i class="fa fa-arrows-h"></i></label>
              </div>
              <div class="col-md-5">
                <input type="text" class="form-control" style="height:30px;" placeholder="To Date"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <div class="col-md-2">
                <label class="control-label"><i class="fa fa-search"></i></label>
              </div>
              <div class="col-md-10">
                <input type="text" class="form-control" style="height:30px;" placeholder="ID"/>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <div class="col-md-2">
                <label class="control-label"><i class="fa fa-search"></i></label>
              </div>
              <div class="col-md-10">
                <input type="text" class="form-control" style="height:30px;" placeholder="User"/>
              </div>
            </div>
          </div>
        </div>
        <div class="row top-buffer">
          <div class="col-md-12">
            <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
              <table aria-describedby="DataTables_Table_0_info" role="grid" id="DataTables_Table_0" class="table table-bordered table-striped dataTable no-footer">
                <thead>
                  <tr role="row">
                    <th aria-label="Rendering Engine: activate to sort column descending" aria-sort="ascending" colspan="1" rowspan="1" aria-controls="DataTables_Table_0" tabindex="0" class="sorting_asc"> Total Earning</th>
                    <th aria-label="Browser: activate to sort column ascending" colspan="1" rowspan="1" aria-controls="DataTables_Table_0" tabindex="0" class="sorting"> Recivied Amount</th>
                    <th aria-label="Platform(s): activate to sort column ascending" colspan="1" rowspan="1" aria-controls="DataTables_Table_0" tabindex="0" class="sorting"> Amount in Wallet</th>
                    <th aria-label="Engine Version: activate to sort column ascending" colspan="1" rowspan="1" aria-controls="DataTables_Table_0" tabindex="0" class="sorting"> By month</th>
                    <th aria-label="CSS Grade: activate to sort column ascending" colspan="1" rowspan="1" aria-controls="DataTables_Table_0" tabindex="0" class="sorting"> Pending Payment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="odd" role="row">
                    <td class="sorting_1">1000</td>
                    <td>1000</td>
                    <td>1500</td>
                    <td>1200</td>
                    <td>A</td>
                  </tr>
                  <tr class="odd" role="row">
                    <td class="sorting_1">1000</td>
                    <td>1000</td>
                    <td>1500</td>
                    <td>1200</td>
                    <td>A</td>
                  </tr>
                  <tr class="odd" role="row">
                    <td class="sorting_1">1000</td>
                    <td>1000</td>
                    <td>1500</td>
                    <td>1200</td>
                    <td>A</td>
                  </tr>
                  <tr class="odd" role="row">
                    <td class="sorting_1">1000</td>
                    <td>1000</td>
                    <td>1500</td>
                    <td>1200</td>
                    <td>A</td>
                  </tr>
                  <tr class="odd" role="row">
                    <td class="sorting_1">1000</td>
                    <td>1000</td>
                    <td>1500</td>
                    <td>1200</td>
                    <td>A</td>
                  </tr>
                </tbody>
              </table>
              <div style="margin-left: 20px; font-size: 12px;" aria-live="polite" role="status" id="DataTables_Table_0_info" class="dataTables_info">Showing 1 to 10 of 100 entries</div>
              <div id="DataTables_Table_0_paginate" class="dataTables_paginate paging_simple_numbers"><a id="DataTables_Table_0_previous" tabindex="0" data-dt-idx="0" aria-controls="DataTables_Table_0" class="paginate_button previous disabled">Previous</a><span><a tabindex="0" data-dt-idx="1" aria-controls="DataTables_Table_0" class="paginate_button current">1</a><a tabindex="0" data-dt-idx="2" aria-controls="DataTables_Table_0" class="paginate_button ">2</a><a tabindex="0" data-dt-idx="3" aria-controls="DataTables_Table_0" class="paginate_button ">3</a><a tabindex="0" data-dt-idx="4" aria-controls="DataTables_Table_0" class="paginate_button ">4</a><a tabindex="0" data-dt-idx="5" aria-controls="DataTables_Table_0" class="paginate_button ">5</a><span class="ellipsis">…</span><a tabindex="0" data-dt-idx="6" aria-controls="DataTables_Table_0" class="paginate_button ">10</a></span><a id="DataTables_Table_0_next" tabindex="0" data-dt-idx="7" aria-controls="DataTables_Table_0" class="paginate_button next">Next</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>--> 
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
                        ["Network Load", 30, 100, 80, 140, 150, 170],
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