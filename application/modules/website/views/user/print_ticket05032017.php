<?php
$ticket = json_decode($ticket, true);
// echo "<pre>";
// print_r($ticket);
// echo "</pre>";

function getTime($totMin){

    $timestring="";

    $oneDay=24*60;
    $noOfDays = floor($totMin / $oneDay);
    $time = $totMin % $oneDay;

    $hours = floor($time/60);
    $minutes = floor($time%60);


    if($minutes<10)
    {
        $minutes='0'.$minutes;
    }

    if($hours%12==0)
    {
        $timestring.="00";
    }
    else
    { $timestring.=$hours%12;}
    $timestring.=":";
    $timestring.=$minutes;

    if($hours<12)
    {
        $timestring.=" AM";
    }
    else{
        $timestring.=" PM";
    }

    return $timestring;
}
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <table>
            <tbody>
                <tr>
                    <td>
                        <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:900px">
                            <tbody>
                                <tr>
                                    <td colspan="6">
                                        <div style="display:none;background-color:#f1f1f1;width:98%;padding:10px;border-top:1px solid #ccc;border-bottom:1px solid #ccc;overflow:hidden">
                                            <a href="http://www.laabus.in/PrintControlPagert.aspx?onwardTIN=lhJcTxkcQH5Cr6bl___48ezA%3d%3d&amp;returnTIN=&amp;enctId=GN8m8GXXdOrKXq7paeNlNqGaQwZY3dCDNu7Yt4M5ENuWMd0I4NRt54PHwpQJmS53XWK%2fHv6Or3nWeTNLXh789livGKfR340qRNk___zzyiITDa6FHsJLdmuA%3d%3d&amp;tcCode=G" style="border-radius:5px;padding:5px 20px 6px;font-size:14px;color:#666;border:1px solid #ccc;background:rgb(255,255,255);background:-moz-linear-gradient(top,rgba(255,255,255,1) 0%,rgba(221,221,221,1) 100%);background:-webkit-linear-gradient(top,rgba(255,255,255,1) 0%,rgba(221,221,221,1) 100%);background:-o-linear-gradient(top,rgba(255,255,255,1) 0%,rgba(221,221,221,1) 100%);background:-ms-linear-gradient(top,rgba(255,255,255,1) 0%,rgba(221,221,221,1) 100%);background:linear-gradient(to bottom,rgba(255,255,255,1) 0%,rgba(221,221,221,1) 100%);text-decoration:none;float:right;margin-right:20px" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.laabus.in/PrintControlPagert.aspx?onwardTIN%3DlhJcTxkcQH5Cr6bl___48ezA%253d%253d%26returnTIN%3D%26enctId%3DGN8m8GXXdOrKXq7paeNlNqGaQwZY3dCDNu7Yt4M5ENuWMd0I4NRt54PHwpQJmS53XWK%252fHv6Or3nWeTNLXh789livGKfR340qRNk___zzyiITDa6FHsJLdmuA%253d%253d%26tcCode%3DG&amp;source=gmail&amp;ust=1472406427206000&amp;usg=AFQjCNEWr61Ko7Y1Io1uTPrRCjSY8ny6nQ">
										 print <span class="il">Ticket</span>
										</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin:0 20px 0 0;padding:0 15px 0 0;width:1%">
                                        <div style="display:inline-block;border-right:1px solid #ccc;margin:0 0 8px 0"><img style="padding:10px" src="http://laabus.com/images/logo_laabus3.png" alt="laabusLogo" class="CToWUd"></div>
                                    </td>
                                    <td style="font-size:30px;margin:0;padding:3px;width:1%">eTICKET</td>


                                    <td colspan="3">


                                    </td>


                                    <td style="width:35%;padding:0;margin:0;text-align:right">
                                        <p style="font-weight:bold;margin:0 0 5px;padding:0">Need help with your trip?</p>
                                        <p style="margin:0;padding:0"><a href="mailto:care@laabus.in" target="_blank">care@<span class="il">laabus</span>.com</a></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <hr style="border-top:0px solid #ccc">
                                    </td>
                                </tr>

                                <tr style="height:60px;overflow:hidden;margin-top:20px;padding:0 0 5px">
                                    <td colspan="4" style="border-bottom:1px solid #ffcc00;width:50%">
                                        <div style="font-size:22px">
                                            <span style="display:-moz-inline-stack;display:inline-block;zoom:1;margin:0 0 7px 0;font-weight:bold;padding:0"><span><?=$ticket['sourceCity']?></span></span>
                                            <span style="display:-moz-inline-stack;display:inline-block;zoom:1;margin-right:10px;margin-left:10px">
										<img src="https://ci4.googleusercontent.com/proxy/qhpJexyKFtba9912_mnptwbvYz-CyqND-PPSvEm_lxQ6jioQKCZ8eifx-b4Hy-V5lL5KGLSr0Wzhtg=s0-d-e1-ft#http://st.laabus.in/images/arrow.png" alt="->" class="CToWUd">
									</span>
                                            <span style="display:-moz-inline-stack;display:inline-block;zoom:1;margin:0 0 7px 0;font-weight:bold;padding:0;margin-right:19px"><span><?=$ticket['destinationCity']?></span></span>

                                            <span><span><?php
                                             $date= $ticket['doj'];                                           
                                             echo  date("j F ,Y", strtotime($date))
                                                
                                                ?></span></span>
                                        </div>
                                    </td>
                                    <td colspan="2" style="border-bottom:1px solid #ffcc00;width:15%;text-align:right">
                                        <p style="font-size:12px;font-weight:bold;margin:0;padding:0"><span class="il">Ticket</span> No: <span><?=$ticket['tin']?></span> </p>
                                        <p style="font-size:12px;margin:0;padding:0">PNR No: <span><?=$ticket['pnr']?></span></p>
                                        <p style="font-size:12px;margin:0;padding:0"></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:900px">




                            <tbody>
                                <tr style="margin:0;padding:0">
                                    <td style="width:25%;font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle">
                                        <p style="font-weight:bold;margin:0 0 5px;padding:0;text-transform:capitalize">
                                            <span><?=$ticket['travels']?></span></p>
                                        <span style="font-size:12px;color:#999;margin:0;padding:0"><span><?=$ticket['busType']?></span></span>
                                    </td>
                                    <td style="width:25%;font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle">
                                        <p style="font-weight:700;margin:0 0 5px;padding:0"> <span><?=getTime($ticket['pickupTime'])?></span></p>
                                        <span style="font-size:12px;color:#999;margin:0;padding:0">Reporting time</span>
                                    </td>
                                    <td style="width:25%;font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle">
                                        <p style="font-weight:700;margin:0 0 5px;padding:0"><span><?=getTime($ticket['primeDepartureTime'])?></span></p>
                                        <span style="font-size:12px;color:#999;margin:0;padding:0">Departure time</span>
                                    </td>
                                    <td style="width:25%;font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle">
                                        <p style="font-weight:700;margin:0 0 5px;padding:0"><span><?=$ticket['status']?></span></p>
                                        <span style="font-size:12px;color:#999;margin:0;padding:0">Status</span>
                                    </td>
                                </tr>


                                <tr style="margin:0;padding:0">
                                    <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle">
                                        <p style="font-weight:700;margin:0 0 5px;padding:0">Boardings point details</p>
                                    </td>
                                    <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle">
                                        <p style="font-weight:700;margin:0 0 5px;padding:0"><span><?=$ticket['sourceCity']?>
</span></p>
                                        <span style="font-size:12px;color:#999;margin:0;padding:0">Location</span>
                                    </td>
                                    <td style="font-size:14px;margin:0;padding:10px;border-bottom:1px solid #e0e0e0;vertical-align:middle">
                                        <p style="font-weight:700;margin:0 0 5px;padding:0"><span><?=$ticket['pickupLocationLandmark']?></span></p>
                                        <span style="font-size:12px;color:#999;margin:0;padding:0">Landmark</span>
                                    </td>
                                </tr>



                            </tbody>
                        </table>

                        <table style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:900px">
                            <tbody>
                                <?php
                                if(!isset($ticket['inventoryItems'][0]['fare'])){                   
                                  $t=array();
                                  $t[0] = $ticket['inventoryItems'];
                                 $ticket['inventoryItems'] = $t;
                                }   
    
    
                                    foreach($ticket['inventoryItems'] as $tkt):
                                ?>
                                    <tr style="margin:0 0 20px 0;padding:0;overflow:hidden">
                                        <td colspan="6" style="border-bottom:1px solid #e0e0e0">
                                            <ul style="list-style:none;margin:0;padding:0">
                                                <li style="word-wrap:break-word;width:190px;max-width:900px;margin:0 20px 0 0;padding:10px;float:left">
                                                    <p style="margin:0 0 5px;padding:0;text-transform:capitalize"><span>
                                                      <?php if($tkt['passenger']['gender'] == 'FEMALE'){
                                                        echo "Mrs.";
                                                        
                                                        } else{
    
                                                        echo "Mr.";
                                                        }
                                                        ?>
                                                       
                                                        </span><span><?=$tkt['passenger']['name'];?></span></p>
                                                    <span style="font-size:12px;color:#999;margin:0;padding:0;text-transform:capitalize"><span style="font-size:12px;color:#999">Seat No.</span>
                                                    <?=$tkt['seatName']?>
                                                        </span>
                                                </li>

                                            </ul>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>

                                        <tr style="margin:0 0 20px;padding:0">
                                            <td>

                                            </td>

                                            <td colspan="6" style="margin:0;padding:5px;text-align:right">
                                                <p style="font-size:18px;font-weight:700;margin:0;padding:0"><span style="font-size:12px;margin:0 10px 0 0;padding:0">Total Fare :</span><span>Rs. <?=$tkt['fare']+$agent_comm;?></span></p>
                                                <p style="font-size:12px;color:#999;margin:0;padding:0"><span>(Inclusive of Rs.0 Service Tax)     </span></p>
                                            </td>
                                        </tr>

                            </tbody>
                        </table>

                        <table cellspacing="3" style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:900px">
                            <tbody>
                                <tr>
                                    <td style="width:40%">
                                        <hr style="min-height:3px;background-color:#333;width:103%">
                                    </td>
                                    <td>
                                        <div style="background:#fff;width:176px;text-align:center">
                                            Terms and Conditions
                                        </div>
                                    </td>
                                    <td style="width:41%">
                                        <hr style="min-height:3px;background-color:#333;width:103%">
                                    </td>
                                </tr>

                            </tbody>

                        </table>


                        <table cellspacing="3" style="overflow:visible;text-align:left;font-variant:normal;font-weight:normal;font-size:14px;background-color:fff;line-height:20px;font-family:Asap,sans-serif;color:#333;padding:0;font-style:normal;width:900px">
                            <tbody>


                                <tr>
                                    <td style="width:47%;font-size:12px;line-height:16px;vertical-align:top">
                                        <ol>
                                            <li>
                                                <p style="min-height:99px;padding:0">
                                                    <span class="il">laabus</span>* is ONLY a bus <span class="il">ticket</span> agent. It does not operate bus services of its own. In order to provide a comprehensive choice of bus operators, departure times and prices to customers, it has tied up with many bus operators.
                                                    <span class="il">laabus</span>'s advice to customers is to choose bus operators they are aware of and whose service they are comfortable with.
                                                </p>
                                                <p style="font-weight:bold;margin:0"><span class="il">laabus</span> responsibilities include:</p>
                                                <ul style="margin:0 0 10px 0;padding:0;list-style:none">
                                                    <li style="margin-left:10px">(1) Issuing a valid <span class="il">ticket</span> (a <span class="il">ticket</span> that will be accepted by the bus operator) for its network of bus operators</li>
                                                    <li style="margin-left:10px">(2) Providing refund and support in the event of cancellation</li>
                                                    <li style="margin-left:10px"> (3) Providing customer support and information in case of any delays / inconvenience</li>
                                                </ul>

                                                <p style="font-weight:bold;margin:0"><span class="il">laabus</span> responsibilities do not include:</p>

                                                <ul style="min-height:251px;margin:0 0 10px 0;padding:0;list-style:none">
                                                    <li style="margin-left:10px">(1) The bus operator's bus not departing / reaching on time.</li>
                                                    <li style="margin-left:10px">(2) The bus operator's employees being rude.</li>
                                                    <li style="margin-left:10px">(3) The bus operator's bus seats etc not being up to the customer's expectation.</li>
                                                    <li style="margin-left:10px">(4) The bus operator canceling the trip due to unavoidable reasons.</li>
                                                    <li style="margin-left:10px">(5) The baggage of the customer getting lost / stolen / damaged.</li>
                                                    <li style="margin-left:10px">(6) The bus operator changing a customer's seat at the last minute to accommodate a lady / child. </li>
                                                    <li style="margin-left:10px">(7) The customer waiting at the wrong boarding point (please call the bus operator to find out the exact boarding point if you are not a regular traveler on that particular bus).</li>
                                                    <li style="margin-left:10px">(8) The bus operator changing the boarding point and/or using a pick-up vehicle at the boarding point to take customers to the bus departure point.</li>
                                                </ul>
                                            </li>
                                            <li>
                                                <p style="margin:0px 0 20px 0px;padding:0">
                                                    The departure time mentioned on the <span class="il">ticket</span> are only tentative timings. However the bus will not leave the source before the time that is mentioned on the <span class="il">ticket</span>.
                                                </p>
                                            </li>
                                        </ol>
                                    </td>
                                    <td style="width:6%">
                                    </td>
                                    <td style="width:47%;font-size:12px;line-height:16px;vertical-align:top">
                                        <ol start="3">
                                            <li>
                                                <p style="padding:0">Passengers are required to furnish the following at the time of boarding the bus:
                                                    <br>(1) A copy of the <span class="il">ticket</span> (A print out of the <span class="il">ticket</span> or the print out of the <span class="il">ticket</span> e-mail).
                                                    <br>(2) A valid identity proof
                                                    <br>Failing to do so, they may not be allowed to board the bus.</p>
                                            </li>
                                            <li>
                                                <p style="padding:0"><span>Change of bus: In case the bus operator changes the type of bus due to some reason, <span class="il">laabus</span> will refund the differential amount to the customer upon being intimated by the customers in 24 hours of the journey.</span>
                                                </p>
                                            </li>
                                            <li>
                                                <p style="padding:0">Amenities for this bus as shown on <span class="il">laabus</span> have been configured and provided by the bus provider (bus operator). These amenities will be provided unless there are some exceptions on certain days. Please note that <span class="il">laabus</span> provides this information in good faith to help passengers to make an informed decision. The liability of the amenity not being made available lies with the operator and not with <span class="il">laabus</span>.</p>
                                            </li>
                                            <li>
                                                <p style="padding:0"><span>In case one needs the refund to be credited back to his/her bank account, please write your cash coupon details to <a href="mailto:support@laabus.in" target="_blank">support@<span class="il">laabus</span>.com</a>
                                                    * The home delivery charges (if any), will not be refunded in the event of <span class="il">ticket</span> cancellation </span>
                                                </p>
                                            </li>
                                            <li>
                                                <p style="padding:0">In case a booking confirmation e-mail and sms gets delayed or fails because of technical reasons or as a result of incorrect e-mail ID / phone number provided by the user etc, a <span class="il">ticket</span> will be considered 'booked' as long as the <span class="il">ticket</span> shows up on the confirmation page of <a href="http://www.laabus.in" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://www.laabus.in&amp;source=gmail&amp;ust=1472406427206000&amp;usg=AFQjCNFLdWFxYMxL7l2Jb48EO1iEoNbEAw">www.<span class="il">laabus</span>.com</a></p>
                                            </li>
                                            <li>
                                                <p style="padding:0">Grievances and claims related to the bus journey should be reported to <span class="il">laabus</span> support team within 10 days of your travel date.</p>
                                            </li>
                                            <li>
                                                <p style="padding:0"><span>Partial Cancellation is <b>NOT</b> allowed for this <span class="il">ticket</span>.</span>
                                                </p>
                                                <p></p>
                                                <div style="display:none">
                                                    <table cellspacing="0" align="Left" rules="all" border="1" height="57" width="400" style="padding:0;margin-bottom:7px; font-size:12px">
                                                        <tbody>
                                                            <tr align="left">
                                                                <th align="left" scope="col" width="60%"><font size="1"><b>Cancellation time</b></font></th>
                                                                <th align="left" scope="col" width="29%"><font size="1"><b>Cancellation charges</b></font></th>
                                                            </tr>
                                                            <tr>
                                                                <td><font size="1">
														<span style="font-weight:normal">&nbsp;<span><span style="margin-right:2px;display:inline-block;text-align:left">Till </span><span style="display:inline-block;text-align:left;font-weight:bold;margin-right:2px;margin-left:2px">10:30 PM</span><span style="width:63px;display:inline-block;text-align:left;margin-right:2px"> on 26th Jan</span></span></span>
													</font></td>
                                                                <td align="left"><font size="1">
														<span>&nbsp;</span><span style="font-weight:normal">Rs. 750</span>
													</font></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <p></p>
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <hr style="border-top:0px solid #ccc">
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </td>
                </tr>
            </tbody>
        </table>

    </body>

    </html>