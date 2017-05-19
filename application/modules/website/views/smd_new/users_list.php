<?php $this->load->view('website/smd_new/menu_block.php')?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-lined table-responsive panel-hovered mb20 data-table panel-defalut" style="padding-bottom:20px">
      <div class="panel-body">
        <h3 class="text-center">List of User</h3>
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
              <!--<input class="form-control input-sm" placeholder="" type="text" style="width:100px">
              <input class="form-control input-sm" placeholder="" type="text" style="width:100px">-->
            </form>
          </div>
        </div>
      </div>
      <div class="dataTables_wrapper no-footer" id="DataTables_Table_0_wrapper">
        <table class="table table-bordered table-striped dataTable no-footer">
          <thead>
            <tr>
			<th>Customer ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile Number</th>
              <th>Address</th>
              <th>Status</th>
			   <th>Joining Date</th>
			    <th>Action</th>
            </tr>
        </thead>
    </table>
      </div>
    </div>
  </div>
</div>
<script>
$('.dataTable').delegate('tr td:first-child', 'click', function() {
 // $('#showgrid').load('/Products/List/Items/');
	 customer_id = $(this).text();
	$('.'+$(this).text()).remove();
	//alert($(this).text())
	$obj = $(this);
	$.post("http://laabus.com/nag/laabus/smd/fetch_users_list_byID",
    {
        customer_id: customer_id,
    },
    function(data, status){
       // alert("Data: " + data + "\nStatus: " + status);
	   $('.'+$obj.text()).remove();
	   $obj.parent('tr').after("<tr class="+$obj.text()+"><td colspan=6>"+data+"</td></tr>");
    });

});


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
			datas = <?php echo $userlist;?>, prelength = datas.length, i = 0; i > Number(prelength); i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
			"bSort" : false,
            data: datas,
            columns: [
			{
               data: "customer_id"
            },{

               data: "name"
            }, {
                data: "email_id"
            }, {
                data: "mobile"
            }, {
				 data: "address"
			}, {
				 data: "status"
            },
			 {
				 data: "doj"
            },
			{
				 data: "actions"
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
         initDataTable()
    }
    _init()
});
</script>