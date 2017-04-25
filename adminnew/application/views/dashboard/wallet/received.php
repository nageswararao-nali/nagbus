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
                                <th>Customer ID</th>
                                <th>Customer name</th>                                
                                <th>Amount</th>
                                <th>Reference Number</th>
                                <th>Transfer Type</th>
                                <th>Payment Status</th>
                                <th>Transaction Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="tblCategories">
                            <?php
                            $status = array(0 => 'Pending', 1 => 'Decline', 2=>'Approve', 'Success');
                            foreach ($wallet_history as $wallet) {
                                ?>
                                <tr>
                                    <td><?= $customer_id ?></td>
                                   <!-- <td><?= !empty($wallet['name']) ? $wallet['name'] . '(' . $wallet['email_id'] . ')' : $wallet['email_id']; ?></td>-->
								   <td><?= !empty($wallet['name']) ? $wallet['name']  : $wallet['email_id']; ?></td>
                                    <td><?= $wallet['amount'] ?></td>
                                    <td><?= $wallet['reference_number'] ?></td>
                                    <td><?= (($wallet['transfer_type'] == 1) ? 'Account' : 'Deposit') ?></td>
                                    <td><?= $status[$wallet['payment_status']] ?></td>
                                    <td><?= date("d/m/Y H:i",strtotime($wallet['create_dt'] ))?></td>
                                    <td>
                                        <?php if ($wallet['payment_status'] == 0) { ?>
                                            <a href="<?= base_url('wallet/requests_edit/' . $wallet['wallet_history_id']) ?>">Edit</a>
                                        <?php } elseif ($wallet['payment_status'] == 1) { ?>                                    
                                            <a href="<?= base_url('wallet/requests_declined/' . $wallet['wallet_history_id']) ?>">View</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
