<?php $this->load->view('website/smd/links_block.php')?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px"> 
      <!--<div class="panel-heading">
        <h4>List of Agents&nbsp;&nbsp;&nbsp;<span>(192)</span></h4>
      </div>-->
      <div class="panel-body">
        <div class="row">
          <div class="left">
            <h4>LIST OF AGENTS&nbsp;&nbsp;&nbsp;<span>(192)</span></h4>
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
          <div class="right col-lg-2">
            <form class="form-horizontal" action="javascript:;">
              <div class="form-group input-group">
                <input type="text" class="form-control input-sm searchInput" placeholder="search">
                <span class="input-group-addon ion ion-ios-search-strong" style="font-size:10px"></span> </div>
            </form>
          </div>
        </div>
      </div>
      
      <!-- data table -->
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th> Agent ID</th>
            <th> Customer Name</th>
            <th> Login Date</th>
            <th> Status</th>
            <th> Action</th>
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
              <p><strong>Designation:&nbsp;</strong>Agent</p>
              <p><strong>Location:&nbsp;</strong>1st Floor, Sathyanarayana Enclave, Miyapur, Hyderabad - 500049.</p>
              <div class="details" style="display:none;">
                <p><strong>Mobile NO:&nbsp;</strong>9999999999</p>
                <p><strong>Date of Birth:&nbsp;</strong>01/01/2000</p>
                <p><strong>Bussiness Type:&nbsp;</strong></p>
                <p><strong>Organization Name:&nbsp;</strong></p>
              </div>
              <p><span class="fa fa-envelope" style="font-size:18px; color:#C30"></span>&nbsp;&nbsp;<span>Send Enquiry By Email</span></p>
              <p><span class="fa fa-clock-o" style="font-size:18px; color:#C30"></span>&nbsp;&nbsp;<span>12:30 pm to 11:00 pm </span></p>
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
            <li class="col-xs-4 prod-title-left text-center"> <i class="fa fa-inr text-success"></i> <strong>192</strong> <br/>
              <button class="btn btn-success btn-xs mt15 waves-effect">transactions</button>
            </li>
            <li class="col-xs-4 prod-title-left text-center"> <i class="ion ion-person text-info"></i> <strong>5K+</strong> <br/>
              <button class="btn btn-info btn-xs mt15 waves-effect">users</button>
            </li>
            <li class="col-xs-4 text-center Profile"> <i class="ion ion-ios-body text-primary"></i> <strong>32</strong> <br/>
              <button class="btn btn-primary btn-xs mt15 waves-effect">Profile</button>
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
                agentid: 123456,
                customername: "abc",
				logindate: "22/10/2015 1:00:15",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer;"></i>&nbsp;<span id="icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer; display:none"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                agentid: 789456,
                customername: "xyz",
				logindate: "22/10/2015 1:00:15",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer;"></i>&nbsp;<span id="icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer; display:none"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                agentid: 456789,
                customername: "asd",
				logindate: "22/10/2015 1:00:15",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer;"></i>&nbsp;<span id="icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer; display:none"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            },{
                agentid: 12345,
                customername: "abc",
				logindate: "22/10/2015 1:00:15",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer;"></i>&nbsp;<span id="icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer; display:none"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
             }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
                data: "agentid"
            }, {
                data: "customername"
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

$(document).on('click','.Profile',function(){
	$('.details').show();
	$(this).hide();
});

/*$(document).on('click','#icon',function(){
  $("i",this).toggleClass("fa fa-thumbs-down fa fa-thumbs-up");
});*/
</script> 
