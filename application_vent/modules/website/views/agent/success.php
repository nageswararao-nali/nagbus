<?php $this->load->view('website/agent/menu_block.php') ?>
<br/>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default panel-hovered panel-stacked mb30">
            <br/>
            <h4 class="text-center text-success">
                <?php
                switch ($type) {
                    case "wallet_withdraw":
                        $msg = "Successfully money detected from account. It will process after admin approval.";
                        break;
                    default:
                        $msg = "Your form submitted sccuessfully";
                }
                echo $msg;
                ?>
            </h4>
            <br/>
        </div>
    </div>
</div>