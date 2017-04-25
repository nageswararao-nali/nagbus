<div class="wrapper wrapper-content animated fadeInRight" ng-controller="categoryCtrl">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Category form</h5>
                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="ibox-content">
                <!--    <form class="form-horizontal" id="create_category"> -->					<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'create_category'); echo form_open('Categories/create_category',$attributes); ?>
                        <p>Add new Category</p>
                        <!--                        <div class="form-group">
                                                    <label class="col-lg-2 control-label">Select Module</label>
                                                    <div class="col-lg-10">
                                                        <select class="form-control" name="moduleids" ng-model="mid" ng-options="item.name for item in modules track by item.module_id">
                                                            <option value="" disabled="disabled">Select Module</option>
                                                        </select>
                                                    </div>
                                                </div>-->
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Category Name</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Name" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="Category Description" class="form-control" name="description">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-white" type="reset">Reset</button>
                                <button class="btn btn-sm btn-white" type="submit">Create</button>
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
                    <h5>All Categories Table </h5>
<!--                    <div class="ibox-tools"> <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a> <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-wrench"></i> </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a> </li>
                            <li><a href="#">Config option 2</a> </li>
                        </ul>
                        <a class="close-link"> <i class="fa fa-times"></i> </a> </div>-->
                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
<!--                                <th>Module Name</th>
                                <th>Updated at / by</th>-->
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tblCategories">
                            <tr ng-repeat="category in categories">
                                <td>{{category.cat_id}}</td>
                                <td>{{category.cat_name}}</td>
<!--                                <td>{{category.modulename}}</td>-->
<!--                                <td>-</td>-->
                                <td><font color="green" ng-show="category.enable == 1">Active</font>
                                    <font color="red" ng-show="category.enable == 0">Inactive</font></td>
                                <td><a href="/adminnew/Categories/edit_category/{{category.cat_id}}">Edit</a> - <a href="" class="btn btn-white btn-sm deleteAction" title="Click me to delete" ng-click="delete(category.cat_id)" confirm="Are you sure, {{name}}?"><i class="fa fa-times"></i> Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).on('submit', '#create_category', function() {
        $.ajax({
            url: baseurl + 'Categories/create_category',
            data: $(this).serialize(),
            type: 'POST',
            cache: false,
            success: function(res) {
                $("#create_category").trigger("reset");
            }
        })
        return false;
    })
</script>
<script>
    $(document).ready(function() {
        $("#create_category").validate({
            rules: {
                moduleid: {
                    required: true,
                },
                name: {
                    required: true,
                }
            }
        });
    });


</script>