<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
        <h2>User List</h2>
        <ul class="breadcrumb">
            <li> <a href="">Dashboard</a> </li>
            <li class="active"><a href="<?php base_url(); ?>limitedOffers">Limited Offers</a></li>
            <li class="active"><strong> User List</strong></li>
        </ul>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Offer List</h5>
                </div>
                <div class="ibox-content">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Customer Id</th>
                            <th>Name</th>
                            <th>Email-id</th>
                            <th>Mobile No</th>
                       </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user){?>
                            <tr id="chnl">
                            	<td><?php echo $user->customer_id;?></td>
                            	<td><?php echo $user->name;?></td>
                                <td><?php echo $user->email_id;?></td>
                                <td><?php echo $user->mobile;?></td>
                                <?php  }  ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>