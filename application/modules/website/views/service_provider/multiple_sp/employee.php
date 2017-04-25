<?php $this->load->view('website/service_provider/multiple_sp/links_block.php')?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px">
      <div class="panel-heading text-center"><h4>Employee Details</h4></div>
      <div class="panel-body">
        <div class="small text-bold left mt5"> Show&nbsp;
          <select class="lengthSelect">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
          </select>
          &nbsp;entries </div>
        <form class="form-horizontal right col-lg-2" action="javascript:;">
        <div class="form-group input-group">
         <input type="text" class="form-control input-sm searchInput" placeholder="search">
         <span class="input-group-addon ion ion-ios-search-strong" style="font-size:10px"></span> </div>
        </form>
      </div>
      <!-- data table -->
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th> Employee ID
              <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
            </th>
            <th> Name
              <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
            </th>
            <th> Login Date
              <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
            </th>
            <th> Status
              <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
            </th>
            <th> Action
              <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
            </th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--Profile Popup-->
<div class="modal modalFadeInScale" id="ProfileViewModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="email-compose"> <!-- wrapper for specific style -->
        
        <div class="modal-header clearfix bg-dark" style="border-bottom: 0px">
          <button class="close right" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="clearfix mb15 top-info">
            <div class="col-md-8">
              <h3 class="text-light mt0">Name</h3>
              <p><strong>Designation:&nbsp;</strong>electrician</p>
              <p><strong>Location:&nbsp;</strong>1st Floor, Sathyanarayana Enclave, Miyapur, Hyderabad - 500049.</p>
              <p><span class="fa fa-envelope" style="font-size:18px; color:#C30"></span>&nbsp;&nbsp;<span>Send Enquiry By Email</span></p>
              <p><span class="fa fa-clock-o" style="font-size:18px;color:#C30"></span>&nbsp;&nbsp;<span>12:30 pm to 11:00 pm </span></p>
               <p><span class="fa fa-inr" style="font-size:18px;color:#C30"></span>&nbsp;&nbsp;<span>Rs 400 to Rs 800</span></p>
              <p> <strong>Qualification: </strong>
                  <label class="label label-pink">ITI</label>
              </p>
            </div>
            <div class="col-md-4"> <img src="<?php echo  base_url()?>web_assets/images/admin.jpg" class="img-circle" style=" width:50px;" alt="user">
              <div class="rating text-warning"> <span>
                <div style="display: inline-block; position: relative;" class="rating-symbol">
                  <div style="visibility: hidden;" class="rating-symbol-background fa fa-star-o"></div>
                  <div style="display: inline-block; position: absolute; overflow: hidden; left: 0px; width: auto;" class="rating-symbol-foreground"><span class="fa fa-star"></span></div>
                </div>
                <div style="display: inline-block; position: relative;" class="rating-symbol">
                  <div style="visibility: hidden;" class="rating-symbol-background fa fa-star-o"></div>
                  <div style="display: inline-block; position: absolute; overflow: hidden; left: 0px; width: auto;" class="rating-symbol-foreground"><span class="fa fa-star"></span></div>
                </div>
                <div style="display: inline-block; position: relative;" class="rating-symbol">
                  <div style="visibility: hidden;" class="rating-symbol-background fa fa-star-o"></div>
                  <div style="display: inline-block; position: absolute; overflow: hidden; left: 0px; width: auto;" class="rating-symbol-foreground"><span class="fa fa-star"></span></div>
                </div>
                <div style="display: inline-block; position: relative;" class="rating-symbol">
                  <div style="visibility: hidden;" class="rating-symbol-background fa fa-star-o"></div>
                  <div style="display: inline-block; position: absolute; overflow: hidden; left: 0px; width: auto;" class="rating-symbol-foreground"><span class="fa fa-star"></span></div>
                </div>
                <div style="display: inline-block; position: relative;" class="rating-symbol">
                  <div style="visibility: visible;" class="rating-symbol-background fa fa-star-o"></div>
                  <div style="display: inline-block; position: absolute; overflow: hidden; left: 0px; width: 0%;" class="rating-symbol-foreground"><span></span></div>
                </div>
                </span>
                <input class="rating-control" value="4" data-filled="fa fa-star" data-empty="fa fa-star-o" type="hidden">
              </div>
            </div>
          </div>
          <hr/>
          <ul class="user-badges list-unstyled row">
            <li class="col-xs-4 prod-title-left text-center"> <i class="fa fa-inr text-success"></i> <strong>192</strong>
              <br/><button class="btn btn-success btn-xs mt15 waves-effect">transactions</button>
            </li>
            <li class="col-xs-4 prod-title-left text-center"> <i class="ion ion-person text-info"></i> <strong>5K+</strong>
              <br/><button class="btn btn-info btn-xs mt15 waves-effect">users</button>
            </li>
            <li class="col-xs-4  text-center"> <i class="ion ion-ios-body text-primary"></i> <strong>32</strong>
              <br/><button class="btn btn-primary btn-xs mt15 waves-effect">Profile</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Profile Popup end-->
   
    
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
                employeeid: 123456,
                name: "abc",
				logindate: "22/10/2015 1:00:15",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer"></i>&nbsp;<span id="icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                employeeid: 789456,
                name: "xyz",
				logindate: "22/10/2015 1:00:15",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer"></i>&nbsp;<span class="icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                employeeid: 456789,
                name: "asd",
				logindate: "22/10/2015 1:00:15",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer"></i>&nbsp;<span class="icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            },{
                employeeid: 12345,
                name: "abc",
				logindate: "22/10/2015 1:00:15",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer"></i>&nbsp;<span class="icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
             }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
                data: "employeeid"
            }, {
                data: "name"
            }, {
                data: "logindate"
            }, {
                data: "status"
            }, {
                data: "action"
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

$(document).on('click','.view_profile',function(){
	$('#ProfileViewModal').modal('show');
});

$(document).on('click','.icon',function(){
  $("i",this).toggleClass("fa fa-thumbs-down fa fa-thumbs-up");
});
</script>









<!--<div class="row">
  <div class="col-md-12">
  <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px">
        <h4 class="text-center">Employee Details</h4>
      <div class="panel-body">
             <div class="small text-bold left mt5"> Show&nbsp;
          <select class="lengthSelect">
            <option value="5" >5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
          </select>
          &nbsp;entries </div>
          <form class="form-horizontal right col-lg-2" action="javascript:;">
          <input type="text" class="form-control input-sm searchInput" placeholder="search">
        </form>
      </div>
      <div class="dataTables_wrapper no-footer">
        <table class="table table-bordered table-striped">
          <thead>
            <tr role="row">
              <th> <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
              Pin Code</th>
              <th> <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
              ID</th>
              <th> <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
              Name</th>
              <th> <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
              Date of Joining</th>
              <th> <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
              Status</th>
              <th> <div class="th"> <i class="fa fa-caret-up icon-up"></i> <i class="fa fa-caret-down icon-down"></i> </div>
              Action</th>
            </tr>
          </thead>
        </table>
       
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
                pincode: 500085,
                id: 1000,
                name: "name1",
                dateofjoining: "8/12/2015",
				status: "pending",
				Action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<span class="change_icon"><i class="fa fa-thumbs-up" title="view invoice" style="cursor:pointer"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                pincode: 500085,
                id: 1000,
                name: "name2",
                dateofjoining: "8/12/2015",
				status: "pending",
				Action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<span class="change_icon"><i class="fa fa-thumbs-up" title="view invoice" style="cursor:pointer"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
            }, {
                pincode: 500085,
                id: 1000,
                name: "name3",
                dateofjoining: "8/12/2015",
				status: "pending",
				Action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<span class="change_icon"><i class="fa fa-thumbs-up" title="view invoice" style="cursor:pointer"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
            },{
                pincode: 500085,
                id: 1000,
                name: "name4",
                dateofjoining: "8/12/2015",
				status: "pending",
				Action: '<i class="ion ion-eye view_invoice" title="view invoice" style="cursor:pointer"></i>&nbsp;<span class="change_icon"><i class="fa fa-thumbs-up" title="view invoice" style="cursor:pointer"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
             }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
                data: "pincode"
            }, {
                data: "id"
            }, {
                data: "name"
            }, {
                data: "dateofjoining"
            }, {
                data: "status"
			}, {
                data: "Action"
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

$(document).on('click','.change_icon',function(){
  $("i",this).toggleClass("fa fa-thumbs-down fa fa-thumbs-up");
});
</script>
  </div>
</div>
-->