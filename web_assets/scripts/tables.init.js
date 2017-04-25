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
                date: 12345,
                id: "22/10/2015 1:00:15",
                customername: "abc",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="icon-eye-open"></i>&nbsp;<i class="icon-print"></i>&nbsp;<i class="icon-download-alt"></i>'
                
            }, {
                date: 12345,
                id: "22/10/2015 1:00:15",
                customername: "xyz",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="icon-eye-open"></i>&nbsp;<i class="icon-print"></i>&nbsp;<i class="icon-download-alt"></i>'
                
            }, {
                date: 12345,
                id: "22/10/2015 1:00:15",
                customername: "asd",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="icon-eye-open"></i>&nbsp;<i class="icon-print"></i>&nbsp;<i class="icon-download-alt"></i>'
                
            },{
                date: 12345,
                id: "22/10/2015 1:00:15",
                customername: "asd",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="icon-eye-open"></i>&nbsp;<i class="icon-print"></i>&nbsp;<i class="icon-download-alt"></i>'
                
            },{
                date: 12345,
                id: "22/10/2015 1:00:15",
                customername: "abc",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="icon-eye-open"></i>&nbsp;<i class="icon-print"></i>&nbsp;<i class="icon-download-alt"></i>'
                
            },{
                date: 12345,
                id: "22/10/2015 1:00:15",
                customername: "name",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="icon-eye-open"></i>&nbsp;<i class="icon-print"></i>&nbsp;<i class="icon-download-alt"></i>'
                
            },{
                date: 12345,
                id: "22/10/2015 1:00:15",
                customername: "asd",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="icon-eye-open"></i>&nbsp;<i class="icon-print"></i>&nbsp;<i class="icon-download-alt"></i>'
                
            },{
                date: 12345,
                id: "22/10/2015 1:00:15",
                customername: "xyz",
                status: "Active",
				amount: 100,
				invoice: "invoice",
				action: '<i class="icon-eye-open"></i>&nbsp;<i class="icon-print"></i>&nbsp;<i class="icon-download-alt"></i>'
                
            }], prelength = datas.length, i = prelength; 50 > i; i++) {
            var rand = Math.floor(Math.random() * prelength);
            datas.push(datas[rand])
        }
        var table = $table.DataTable({
            data: datas,
            columns: [{
                data: "date"
            }, {
                data: "id"
            }, {
                data: "customername"
            }, {
                data: "status"
            }, {
                data: "amount"
            }, {
                data: "invoice"
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