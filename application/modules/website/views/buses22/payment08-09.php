<div class="row">
    <div class="col-md-8">
        <div class="panel mb20 panel-default panel-hovered">
            <div class="panel-body">
                     <!--<form action="/buses/booking_process" method="post">-->
					<form action="/buses/laabuspayment" method="post">
                    <h4>Enter contact details</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Your email address</label>
                                <input name="email" type="text" class="form-control" placeholder="Email ID">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Your Contact No.</label>
                                <input name="mobile" type="text" class="form-control num_only" placeholder="Mobile No.">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Emergency No.</label>
                                <input name="emergency_no" type="text" class="form-control num_only" placeholder="Emergency Contact">
                            </div>
                        </div>
                    </div>
                    <p>(Your booking details will be sent to your email adderess and contact no.)</p>
                    <h4>Enter passenger details</h4>
                    <?php
                    $seats = $this->session->userdata('onword');
                    $passVal = explode(",",$seats['seats']);
                    for($i=0;$i<count($passVal);$i++){
                    ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="fname[]" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="lname[]" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" placeholder="Age" class="form-control" name="age[]" required="">
                                </div>
                            </div>
                            <div class="col-md-3 mt5">
                                <div class="form-group">
                                    <div class="ui-radio ui-radio-pink">
                                        <label class="ui-inline control-label">Gender</label>
                                        <label class="ui-radio-inline">
                                            <input checked="" name="gender<?=$i?>[]" value="M" type="radio">
                                            <span>M</span> </label>
                                        <label class="ui-radio-inline">
                                            <input name="gender<?=$i?>[]" value="F" type="radio">
                                            <span>F</span> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                            <hr/>
                            <div class="row">
                                <input type="checkbox" id="coupon">
                                <label>I have a coupon code (optional)</label>
                                <div class="row couponcode" style="display:none">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="coupon code">
                                    </div>
                                    <button type="button" class="btn btn-success col-md-2">Apply coupon</button>
                                </div>
                            </div>
                            <?php
                            
                    
                            ?>
                                <!--
                               <input type="hidden" name="srcid" id="srcid" value="<?=$_POST['srcid']?>">
<input type="hidden" name="destid" id="destid" value="<?=$_POST['destid']?>">
<input type="hidden" name="from_city" id="src" value="<?=$_POST['src']?>">
<input type="hidden" name="to_city" id="dest" value="<?=$_POST['dest']?>">
<input type="hidden" name="date_of_Jrny" id="jdate" value="<?=$_POST['jdate']?>">
<input type="hidden" name="bus_id" id="busId" value="<?=$_POST['busId']?>">
<input type="hidden" name="amount" id="amount" value="<?=$_POST['amount']?>">
<input type="hidden" name="boarding" id="bPoint" value="<?=$_POST['bPoint']?>">
<input type="hidden" name="seats_no" id="seats" value="<?=$_POST['seats']?>">-->

                                <button type="submit" class="btn btn-group btn-success right">Continue</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <?php
     $onword = $this->session->userdata("onword");
        ?>
            <div class="well">
                <h4>Onward Journey</h4>
                <p>
                    <?=$onword['src']?> to
                        <?=$onword['dest']?>
                </p>
                <p>
                    Date Of Jounrney :
                    <?=date("j F ,Y", strtotime($onword['jdate']))?>
                </p>
                <p>
                    Seat No(s) :
                    <?=$onword['seats']?>
                </p>
                <p>
                    <?=$onword['src']?> -
                        <?=$onword['startingTime']?>
                </p>
                <p>
                    <?=$onword['travels']?>
                </p>
                <p>
                    <?=$onword['busType']?>
                </p>
            </div>

            <?php
        $return = $this->session->userdata("return");
        if(isset($return) && $return!=''){            
        ?>

                <div class="well">
                    <h4>Return Journey</h4>
                    <p>
                        <?=$return['src']?> to
                            <?=$return['dest']?>
                    </p>
                    <p>
                        Date Of Jounrney :
                        <?=date("j F ,Y", strtotime($return['jdate']))?>
                    </p>
                    <p>
                        Seat No(s) :
                        <?=$return['seats']?>
                    </p>
                    <p>
                        <?=$return['src']?> -
                            <?=$return['startingTime']?>
                    </p>
                    <p>
                        <?=$return['travels']?>
                    </p>
                    <p>
                        <?=$return['busType']?>
                    </p>
                </div>

                <?php
        }
            ?>





    </div>

</div>
<script>
    $('#coupon').click(function () {
        if (this.checked) {
            $(".couponcode").show();
        } else {
            $(".couponcode").hide();
        }
    });
</script>