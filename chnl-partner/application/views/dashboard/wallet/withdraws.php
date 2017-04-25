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
                                <th>created by</th>                                
                                <th>Amount</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Bank Name</th>
                                <th>IFSC Code</th>
                                <th>Created Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="tblCategories">
                            <?php
                            foreach ($wallet_withdraws as $wallet) {
                                ?>
                                <tr>
                                    <td><?= $wallet['wallet_withdraw_id'] ?></td>
                                    <td><?= !empty($wallet['name']) ? $wallet['name'] . '(' . $wallet['email_id'] . ')' : $wallet['email_id']; ?></td>
                                    <td><?= $wallet['amount'] ?></td>
                                    <td><?= $wallet['account_number'] ?></td>
                                    <td><?= $wallet['account_name'] ?></td>
                                    <td><?= $wallet['bank_name'] ?></td>
                                    <td><?= $wallet['ifsc_code'] ?></td>
                                    <td><?= date("d-m-Y", strtotime($wallet['create_dt'])) ?></td>                                    
                                    <td><a href="javascript:;">Transfered</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
