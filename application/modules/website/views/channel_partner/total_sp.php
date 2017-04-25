
<?php $this->load->view('website/channel_partner/links_block.php')?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px">
      <div class="panel-heading"><h4>List of Service Providers&nbsp;&nbsp;&nbsp;<span>(<?php  if(!empty($userlist)) echo count($userlist); else echo "0";?>)</span></h4></div>
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
            <th> SP ID</th>
            <th> Customer Name</th>
            <th> Login Date</th>
            <th> Services</th>
            <th> Status</th>
            <th> Action</th>
          </tr>
        </thead>
        <tbody>
		<?php
		foreach($userlist as $key=>$value)
		{
		?>
		 <tr>
            <td> <?php echo $value["customer_id"];?></td>
            <td> <?php echo $value["name"];?></td>
            <td> <?php echo $value["lupdate"];?></td>
			<td> Electrician</td>
            <td> Status</td>
            <td> <?php echo $value["actions"];?></td>
          </tr>
		<?php }
		?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--Profile Popup-->
<div class="modal modalFadeInScale" id="ViewModal">
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
              <p><strong>Designation:&nbsp;</strong>Electrician</p>
              <p><strong>Location:&nbsp;</strong>1st Floor, Sathyanarayana Enclave, Miyapur, Hyderabad - 500049.</p>
              <div class="details" style="display:none;">
              <p><strong>Mobile NO:&nbsp;</strong>9999999999</p>
              <p><strong>Date of Birth:&nbsp;</strong>01/01/2000</p>
              <p><strong>Bussiness Type:&nbsp;</strong></p>
              <p><strong>Organization Name:&nbsp;</strong></p>
              </div>
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
            <li class="col-xs-4 text-center Profile"> <i class="ion ion-ios-body text-primary"></i> <strong>32</strong>
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
                spid: 123456,
                customername: "abc",
				logindate: "22/10/2015 1:00:15",
				services: "Electrician",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer"></i>&nbsp;<span id="change_icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer; display:none"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                spid: 789456,
                customername: "xyz",
				logindate: "22/10/2015 1:00:15",
				services: "Plumber",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer"></i>&nbsp;<span id="change_icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer; display:none"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            }, {
                spid: 456789,
                customername: "asd",
				logindate: "22/10/2015 1:00:15",
				services: "Carpenter",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer"></i>&nbsp;<span id="change_icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer; display:none"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
                
            },{
                spid: 12345,
                customername: "abc",
				logindate: "22/10/2015 1:00:15",
				services: "Electrician",
                status: "Active",
				action: '<i class="ion ion-eye view_profile" title="view profile" style="cursor:pointer"></i>&nbsp;<span id="change_icon"><i class="fa fa-thumbs-up" title="active" style="cursor:pointer; display:none"></i></span>&nbsp;<i class="ion ion-printer" title="print" style="cursor:pointer"></i>&nbsp;<i class="ion ion-android-download" title="download" style="cursor:pointer"></i>'
             }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
                data: "spid"
            }, {
                data: "customername"
            }, {
                data: "logindate"
            },{
                data: "services"
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
   // _init()
});

$(document).on('click','.view_profile',function(){
	$('#ViewModal').modal('show');
});

$(document).on('click','.Profile',function(){
	$('.details').show();
	$(this).hide();
});


/*$(document).on('click','#change_icon',function(){
  $("i",this).toggleClass("fa fa-thumbs-down fa fa-thumbs-up");
});*/
</script>


<!--<div class="row">
  <div class="col-md-8">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table" style="padding-bottom: 20px">
      <div class="panel-body">
        <div class="form-group input-group col-md-4"> <span class="input-group-addon ion ion-search"></span>
          <input class="form-control" placeholder="pincode/name/ID" type="search">
        </div>
        <div class="small text-bold left mt5"> Show&nbsp;
          <select class="lengthSelect">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="20">20</option>
            <option value="50">50</option>
          </select>
          &nbsp;entries </div>
      </div>
      <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table class="table table-bordered table-striped">
          <thead>
            <tr role="row">
              <th> Pin Code</th>
              <th> ID</th>
              <th> Name</th>
              <th> Date of Joining</th>
              <th> Service</th>
              <th> Status</th>
              <th> Rewards</th>
            </tr>
          </thead>
          <tbody>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>best</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>average</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>normal</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>best</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>average</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>average</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>normal</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>average</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>best</td>
              <td>A</td>
            </tr>
            <tr class="odd" role="row">
              <td class="sorting_1">500049</td>
              <td>ID</td>
              <td>name</td>
              <td>11/9/2015</td>
              <td> Service</td>
              <td>normal</td>
              <td>A</td>
            </tr>
          </tbody>
        </table>
        <div style="margin-left: 20px; font-size: 12px;" aria-live="polite" role="status" id="DataTables_Table_0_info" class="dataTables_info">Showing 1 to 10 of 100 entries</div>
        <div id="DataTables_Table_0_paginate" class="dataTables_paginate paging_simple_numbers"><a id="DataTables_Table_0_previous" tabindex="0" data-dt-idx="0" aria-controls="DataTables_Table_0" class="paginate_button previous disabled">Previous</a><span><a tabindex="0" data-dt-idx="1" aria-controls="DataTables_Table_0" class="paginate_button current">1</a><a tabindex="0" data-dt-idx="2" aria-controls="DataTables_Table_0" class="paginate_button ">2</a><a tabindex="0" data-dt-idx="3" aria-controls="DataTables_Table_0" class="paginate_button ">3</a><a tabindex="0" data-dt-idx="4" aria-controls="DataTables_Table_0" class="paginate_button ">4</a><a tabindex="0" data-dt-idx="5" aria-controls="DataTables_Table_0" class="paginate_button ">5</a><span class="ellipsis">…</span><a tabindex="0" data-dt-idx="6" aria-controls="DataTables_Table_0" class="paginate_button ">10</a></span><a id="DataTables_Table_0_next" tabindex="0" data-dt-idx="7" aria-controls="DataTables_Table_0" class="paginate_button next">Next</a></div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="row">
      <div class="col-md-offset-2 col-md-8 text-center">
        <div class="panel panel-default mb20 mini-box panel-hovered">
          <div class="panel-body prod-box" style="height:50px;">
            <div class="clearfix">
              <div class="info text-center">
                <h4 class="mt0 mb0 text-success"><i class="ion ion-ios-body text-success"></i> <strong>192</strong></h4>
              </div>
            </div>
          </div>
          <div class="panel-footer clearfix panel-footer-sm panel-footer-success text-center"  style="height:50px;">
            <h4 class="mb0" style="margin-top:-10px; margin-left:-10px; font-size:17px;">Total Service Providers</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default mb20 panel-hovered profile-widget">
          <div class="panel-body">
            <div class="clearfix mb15 top-info">
              <div class="col-md-8">
                <h3 class="text-light mt0">Name</h3>
                <p><strong>Designation:&nbsp;</strong>Electrician</p>
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
              <li class="col-xs-4 prod-title-left text-center"> <i class="ion ion-ios-chatboxes-outline text-success"></i> <strong>192</strong>
                <button class="btn btn-success btn-xs mt15 waves-effect">View</button>
              </li>
              <li class="col-xs-4 prod-title-left text-center"> <i class="ion ion-ios-heart-outline text-primary"></i> <strong>5K+</strong>
                <button class="btn btn-info btn-xs mt15 waves-effect">Follow</button>
              </li>
              <li class="col-xs-4"> <i class="ion ion-ios-body text-danger text-center"></i> <strong>32</strong>
                <button class="btn btn-primary btn-xs mt15 waves-effect">Profile</button>
              </li>
            </ul>
          </div>
        </div>
        </div>
    </div>
  </div>
</div>
-->