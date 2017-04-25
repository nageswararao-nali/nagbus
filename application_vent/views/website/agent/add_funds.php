<?php $this->load->view('website/agent/menu_block.php')?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-heading text-center">
        <h3>Welcome to Laabus Wallet</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form class="form-inline">
              <div class="form-group">
                <div class="col-md-12">
                  <label>Add money to Laabus wallet</label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-4">
                  <input type="text" class="form-control" >
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <label >Have a Promo Code?</label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-4">
                  <button type="submit" class="btn btn-info">Add money to Wallet</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="clearfix tabs-linearrow">
      <ul class="nav nav-tabs">
        <li class="active"><a aria-expanded="true" href="#tab-linearrow-one" data-toggle="tab">Total Amount</a></li>
        <li class=""><a aria-expanded="false" href="#tab-linearrow-two" data-toggle="tab">Balance</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab-linearrow-one">
          <div class="row">
            <div class="col-md-10">
              <div class="panel panel-default mb20 mini-box panel-hovered">
                <div class="panel-body prod-box">
                  <div class="clearfix">
                    <div class="info text-center">
                      <h2 class="mt0 mb0 text-success">30,200</h2>
                    </div>
                  </div>
                </div>
                <div class="panel-footer clearfix panel-footer-sm panel-footer-success text-center">
                  <h4 class="mt0 mb0">Total Amount</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="tab-linearrow-two">
          <div class="row">
            <div class="col-md-10">
              <div class="panel panel-default mb20 mini-box panel-hovered">
                <div class="panel-body prod-box">
                  <div class="clearfix">
                    <div class="info text-center">
                      <h2 class="mt0 mb0 text-success">1000</h2>
                    </div>
                  </div>
                </div>
                <div class="panel-footer clearfix panel-footer-sm panel-footer-success text-center">
                  <h4 class="mt0 mb0">Balance</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">Payment History</h3>
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
                <input type="text" class="form-control input-sm searchInput" placeholder="Type keyword">
                <span class="input-group-addon ion ion-ios-search-strong" style="font-size:10px"></span> </div>
            </form>
          </div>
        </div>
      </div>
      <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table class="table table-bordered table-striped dataTable no-footer">
          <thead>
            <tr>
              <th>Account Name</th>
              <th>Reference Number</th>
              <th>Payment Method</th>
              <th>Total Amount</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- view popup -->
<div class="modal modalFadeInScale" id="ViewModal">
  <div class="modal-dialog">
    <div class="modal-content" style="width:800px;">
      <div class="email-compose"> 
        
        <div class="modal-header clearfix bg-dark" style="border-bottom: 0px">
          <button class="close right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="clearfix mb15 top-info">
           <div class="panel panel-lined panel-hovered mb20 panel-info">
           <div class="panel-heading">
           <h5><span class="text-left">Payment Request Details</span>
           <span class="pull-right"><span style="margin-right:50px;">Payment Date: 28/9/2015 3:27:20 PM </span>15000/-</span>
           </h5>
           </div>
        <div class="panel-body"> 
            <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SL</th>
                <th>Service</th>
                <th>Quality</th>
                <th>Amount</th>
              </tr>
            </thead>
             <tbody>
              	<td>1</td>
                <td>Service</td>
                <td>1</td>
                <td>15000</td>
              </tr>
             </tbody>
          </table>
          </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- view popup end -->        
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
                accountname: "asdf",
				referencenumber: 123456,
				paymentmethod: "SBI to SBI Transfer",
                totalamount: 5000,
				date: "28/9/2015",
				status: "Closed",
				action: '<button class="btn btn-info btn-sm view" type="submit">view </button>'
                
            }, {
                accountname: "pqrs",
				referencenumber: 789456,
				paymentmethod: "SBI to SBI Transfer",
                totalamount: 15000,
				date: "28/9/2015",
				status: "Closed",
				action: '<button class="btn btn-info btn-sm view" type="submit">view </button>'
                
            }, {
                accountname: "xyz",
				referencenumber: 45623,
				paymentmethod: "SBI to SBI Transfer",
                totalamount: 10000,
				date: "28/9/2015",
				status: "Closed",
				action: '<button class="btn btn-info btn-sm view" type="submit">view </button>'
            },{
                accountname: "asdf",
				referencenumber: 123456,
				paymentmethod: "SBI to SBI Transfer",
                totalamount: 15000,
				date: "28/9/2015",
				status: "Closed",
				action: '<button class="btn btn-info btn-sm view" type="submit">view </button>'
            
             }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
               data: "accountname"
            }, {
				data: "referencenumber"
            }, {
				data: "paymentmethod"
            }, {
				 data: "totalamount"
			}, {
				 data: "date"
            }, {
                data: "status"
            }, {
                data: "action"
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

$(document).on('click','.view',function(){
	$('#ViewModal').modal('show');
});

</script>       

<!--<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default panel-hovered panel-stacked mb30">
      <div class="panel-body">
        <label>Rs:</label>
        <input type="text" class="control-label" required="">
        <button type="submit" class="money">Add Funds</button>
      </div>
    </div>
  </div>
</div>
-->