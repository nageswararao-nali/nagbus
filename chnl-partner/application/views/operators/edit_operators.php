<?php
// print_r($edit_operator_data[0]->cat_id);
// print_r($edit_operator_data[0]->sub_cat_name);
// print_r($edit_operator_data[0]->sub_cat_code);
// print_r($edit_operator_data[0]->sub_cat_desc);
// print_r($edit_operator_data[0]->cat_id);

	// exit;
?>
<div class="wrapper wrapper-content animated fadeInRight" ng-controller="operatorCtrl">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5>Category form</h5>

                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>

                </div>

                <div class="ibox-content">

                    <form class="form-horizontal" id="create_operator">

                        <p>Add new Operator</p>

                        <!--                        <div class="form-group">

                                                    <label class="col-lg-2 control-label">Select Module</label>

                                                    <div class="col-lg-10">

                                                        <select class="form-control" name="moduleid">

                                                        </select>

                                                    </div>

                                                </div>-->
						
                        <div class="form-group">

                            <label class="col-lg-2 control-label">Select Category</label>

                            <div class="col-lg-10">
							 <select class="form-control" name="categoryid">
							 <option value="<?php echo $edit_operator_data[0]->cat_id; ?>">Select Category</option>
								<?php
							$cat = json_decode($categorydata);
							foreach($cat as $data){
								?>
			                <option value="<?php echo $data->cat_id; ?>"><?php echo $data->cat_name; ?></option>
	                    	<?php		
							}
							?>
								 </select>
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-lg-2 control-label">Operator Name</label>

                            <div class="col-lg-10">

                                <input type="text" placeholder="Enter Operator Name" class="form-control" name="operator_name" value="<?php echo $edit_operator_data[0]->sub_cat_name; ?>">

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-lg-2 control-label">Operator code</label>

                            <div class="col-lg-10">

                                <input type="text" placeholder="Enter Operator Code" class="form-control" name="operator_code" value="<?php echo $edit_operator_data[0]->sub_cat_code; ?>">

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-lg-2 control-label">Description</label>

                            <div class="col-lg-10">

                                <input type="text" placeholder="Enter Operator Description" class="form-control" name="description" value="<?php echo $edit_operator_data[0]->sub_cat_desc; ?>">
								<input type="hidden" value="<?php echo $edit_operator_data[0]->sub_cat_id; ?>" name="sub_cat_id">
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-lg-offset-2 col-lg-10">

                                <button class="btn btn-sm btn-white" type="submit">Reset</button>

                                <button class="btn btn-sm btn-white" type="submit">Update</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5>All Operators Table </h5>

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

                                <th>Operator Id</th>

                                <th>Operator Name</th>

                                <th>Category Name</th>

<!--                                <th>Module Name</th>-->

                                <th>Updated by</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody class="tblCategories">

                            <tr ng-repeat="operator in operators">

                                <td>{{operator.sub_cat_id}}</td>

                                <td>{{operator.sub_cat_name}}</td>

                                <td>{{operator.cat_name}}</td>

                                <td>{{operator.lupdate}}</td>

<!--                                <td>-</td>-->

<!--                                <td><font color="green" ng-show="category.enable == 1">Active</font>

                                    <font color="red" ng-show="category.enable == 0">Inactive</font></td>-->

                                <td><a href="{{operator.sub_cat_id}}">Edit</a> - <a href="" class="btn btn-white btn-sm deleteAction" title="Click me to delete" ng-click="delete(operator.sub_cat_id)"><i class="fa fa-times"></i> Delete</a></td>

                            </tr>

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

            success: function(res) {

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

            success: function(res) {

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



    $(document).ready(function() {

        get_modules();

        get_categories();

    });



    $(document).on('submit', '#create_operator', function() {

        $.ajax({

            url: baseurl + 'operators/update_operator',

            data: $(this).serialize(),

            type: 'POST',

            cache: false,

            success: function(res) {

                $("#create_operator").trigger("reset");

                get_categories();
				location.reload(baseurl + 'operators/create_operators');
            }

        })

        return false;

    });



    function get_selected_module_categories(moduleid) {

        $.get(baseurl + 'Categories/get_selected_module_categories/' + moduleid, function(data, success) {

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



    $(document).on('change', 'select[name="moduleid"]', function() {

        get_selected_module_categories($(this).val());

    });

//validation code

    $(document).ready(function() {

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