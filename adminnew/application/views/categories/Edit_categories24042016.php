<div class="wrapper wrapper-content animated fadeInRight" ng-controller="categoryCtrl">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">

                    <h5>Category form</h5>

                    <div class="ibox-tools"> <a class="close-link"> <i class="fa fa-times"></i> </a> </div>

                </div>

                <div class="ibox-content">

        <!--   <form class="form-horizontal" id="create_category" method="post"  action="Categories/insert_category">  -->
			<?php	  $attributes = array('class' => 'form-horizontal', 'id' => 'update_category');
										echo form_open('Categories/update_category',$attributes); ?>
                        <p>Update Category</p>

                      
                        <div class="form-group">

                            <label class="col-lg-2 control-label">Category Name</label>

                            <div class="col-lg-10">

                                <input type="text" value= <?php echo $category_data[0]->cat_name; ?> class="form-control" name="name">
                                <input type="hidden" value= <?php echo $category_data[0]->cat_id; ?> class="form-control" name="cat_id">
								

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-lg-2 control-label">Description</label>

                            <div class="col-lg-10">

                                <input type="text" placeholder="Category Description" class="form-control" name="description">

                            </div>

                        </div>
						
						   <div class="form-group">

                            <label class="col-lg-2 control-label">Status</label>

                            <div class="col-lg-10">

                                <input type="text" value=<?php echo $category_data[0]->enable; ?> class="form-control" name="status">

                            </div>

                        </div>
						
                        <div class="form-group">

                            <div class="col-lg-offset-2 col-lg-10">

                                <button class="btn btn-sm btn-white" type="reset">Reset</button>

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

                    <h5>All Categories Table </h5>
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

                                <td><a href="/laabus/adminnew/Categories/edit_category/{{category.cat_id}}">Edit</a> - <a href="" class="btn btn-white btn-sm deleteAction" title="Click me to delete" ng-click="delete(category.cat_id)" confirm="Are you sure, {{name}}?">
								<i class="fa fa-times"></i> Delete</a></td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>



</div>

<script>

    $(document).on('submit', '#update_category', function() {

        $.ajax({

            url: baseurl + 'Categories/update_category',

            data: $(this).serialize(),

            type: 'POST',

            cache: false,

            success: function(res) {

                $("#update_category").trigger("reset");
				location.reload();

            }

        })

        return false;

    })

</script>

<script>

    $(document).ready(function() {

        $("#update_category").validate({

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