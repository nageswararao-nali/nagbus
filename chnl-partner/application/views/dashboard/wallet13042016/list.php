<div class="wrapper wrapper-content animated fadeInRight" ng-controller="operatorCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Wallet History </h5>
                    <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a> </li>
                            <li><a href="#">Config option 2</a> </li>
                        </ul>
                        <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Operator</th>
                                <th>created by</th>
                                <th>Role</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Credit</th>
                                <th>Notes</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody class="tblCategories">
                            <?php foreach ($wallet_history as $wallet) { ?>
                            <tr>
                                <td><?= $wallet['wallet_history_id'] ?></td>
                                <td><?= (($wallet['operator_type'] == '0')?'Admin':'User') ?></td>
                                <td><?= !empty($wallet['name']) ? $wallet['name'] . '(' . $wallet['email_id'] . ')' : $wallet['email_id']; ?></td>
                                <td><?= $wallet['role_name'] ?></td>
                                <td><?= $wallet['amount'] ?></td>
                                <td><?= $wallet['payment_status'] ?></td>
                                <td><?= (($wallet['mark_credit'] == 1)?'Yes':'No') ?></td>
                                <td><?= $wallet['notes'] ?></td>
                                <td><?= $wallet['create_dt'] ?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function get_modules() {
        $.ajax({
            url: baseurl + 'Modules/get_all_modules',
            success: function (res) {
                var obj = JSON.parse(res);
                if (obj.err_code == 1) {
                    $('select[name="moduleid"]').html('<option value>Select Module</option>');
                    for (var i = 0; i < obj.message.length; i++)
                        $('select[name="moduleid"]').append('<option value="' + obj.message[i].module_id + '">' + obj.message[i].name + '</option>');
                } else {
                    alert("No modules");
                }
            }
        });
    }
    function get_categories() {
        $.ajax({
            url: baseurl + 'Categories/get_all_categories',
            success: function (res) {
                var obj = JSON.parse(res);
                if (obj.err_code == 1) {
                    $('.tblCategories').html('');
                    for (var i = 0; i < obj.message.length; i++) {
                        var c = obj.message[i];
                        $('.tblCategories').append('<tr><td>' + c.category_id + '</td><td title="' + c.categorydescription + '">' + c.categoryname + '</td><td class="text-navy" data-module="' + c.module_id + '">' + c.modulename + '</td><td>' + c.update_login + '</td><td>Edit - Delete</td></tr>');
                    }
                } else {
                    $('.tblCategories').html('<tr><td colspan="5"><h2 class="text-center">No Categories</h2></td></tr>');
                }
            }
        });
    }

    $(document).ready(function () {
        get_modules();
        get_categories();
    });

    $(document).on('submit', '#create_operator', function () {
        $.ajax({
            url: baseurl + 'Operators/create_operators',
            data: $(this).serialize(),
            type: 'POST',
            cache: false,
            success: function (res) {
                $("#create_operator").trigger("reset");
                get_categories();
            }
        })
        return false;
    });

    function get_selected_module_categories(moduleid) {
        $.get(baseurl + 'Categories/get_selected_module_categories/' + moduleid, function (data, success) {
            var obj = JSON.parse(data);
            if (obj.err_code == 1) {
                $('select[name="categoryid"]').html('<option>Select Categories</option>');
                for (var i = 0; i < obj.message.length; i++)
                    $('select[name="categoryid"]').append('<option value="' + obj.message[i].category_id + '">' + obj.message[i].categoryname + '</option>');
            } else {
                $('select[name="categoryid"]').html('<option value="">No Categories</option>');
            }
        })
    }

    $(document).on('change', 'select[name="moduleid"]', function () {
        get_selected_module_categories($(this).val());
    });
//validation code
    $(document).ready(function () {
        $('#create_operator').validate({
            rules: {
                moduleid: {
                    required: true,
                },
                categoryid: {
                    required: true,
                },
                operator_name: {
                    required: true,
                },
                operator_code: {
                    required: true,
                }
            }
        });
    })
</script>