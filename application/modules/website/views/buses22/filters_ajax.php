<?php
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

function get_time_difference($time1, $time2)
                {
                    $time1 = strtotime("1/1/1980 $time1");
                    $time2 = strtotime("1/1/1980 $time2");

                    if ($time2 < $time1)
                    {
                        $time2 = $time2 + 86400;
                    }
                        
                    return ($time2 - $time1) / 3600;
                    //return floor((($time2- $time1)/60)/60);  

                }  


    $travelsLists=$searchResult['availableTrips'];

//print_r($busTypes);

    foreach($travelsLists as $travel):   

        if(sizeof($operators)>0 && !in_array($travel['travels'], $operators)){
            continue;
        }

    
        if(sizeof($busTypes)>0 && ((isset($busTypes['AC']) && !isset($busTypes['nonAC'])) && $busTypes['AC'] == "AC" && $travel['AC'] == "false") ){
            continue;
        }

        if( sizeof($busTypes)>0 && ((isset($busTypes['nonAC']) && !isset($busTypes['AC'])) && $busTypes['nonAC'] == "nonAC" && $travel['nonAC'] == "false") ){
            continue;
        }

        if( sizeof($busTypes)>0 && ((isset($busTypes['sleeper']) && !isset($busTypes['nonAC']) && !isset($busTypes['AC'])) && $busTypes['sleeper'] == "sleeper" && $travel['sleeper'] == "false") ){
            continue;
        }
	 
        //For Boarding Points
        $bPoints = array();
        foreach($travel['boardingTimes'] as $key => $val){
            if(isset($val['bpId']))
            {
                $bPoints[] = $val['bpId']; 
            }elseif($key == "bpId"){ 
                $bPoints[] = $travel['boardingTimes']['bpId'];
            } 
        }

       
        //print_r($bPoints);
       // print_rboardingPoints);
        $boardingMatches = count(array_intersect($bPoints, $boardingPoints)); 

        if(isset($boardingPoints) && count($boardingPoints)>0 && $boardingMatches == 0){
            continue;
        }

       

        //For Dropping Points   droppingTimes
        $dPoints = array();
        foreach($travel['droppingTimes'] as $key => $val){
            if(isset($val['bpId']))
            {
                $dPoints[] = $val['bpId']; 
            }elseif($key == "bpId"){ 
                $dPoints[] = $travel['droppingTimes']['bpId'];
            } 
        }

        $droppingMatches = count(array_intersect($dPoints, $droppingPoints)); 
        if(isset($droppingPoints) && count($droppingPoints)>0 && $droppingMatches == 0){
            continue;
        }


    $fares = "";
    $dataFare = "";    
    $v1 = $travel['fares'];
    if( is_array($v1))
    {
        $num=count($v1);
        for ($l=0; $l <$num ; $l++) { 
            $fares= $fares." <br>".$v1[$l];
        }
        $dataFare = $v1[0];
    }else{
        $fares = '<i class="fa fa-inr" style="font-size:18px"></i> '.$v1;
        $dataFare = $v1;
    }

?>

    <?php            
             $ts1 = date("H:i:s", strtotime(getTime($travel['departureTime'])));
             $ts2 = date("H:i:s", strtotime(getTime($travel['arrivalTime'])));
            
             $hours = get_time_difference($ts1, $ts2);            
            
            ?>

        <div class="row travels" data-stime="<?=$travel['departureTime']?>" data-price="<?=round($dataFare)?>">
            <div class="col-md-12">
                <div class="panel panel-success panel-hovered panel-stacked mb30">
                    <div class="panel-body" style="padding:6px">
                        <div class="col-md-5">
                            <h4><?=$travel['travels']?></h4>

                            <?=$travel['busType']?>
                        </div>
                        <div class="col-md-3">
                            <h4><?=getTime($travel['departureTime'])?> <i class="fa fa-long-arrow-right"></i> <?=getTime($travel['arrivalTime'])?></h4> Duration :
                            <?= floor($hours) . ':' . sprintf("%'.02d\n",( ($hours-floor($hours)) * 60 ));  // Outputs "1:42"?> hours </div>

                        <div class="col-md-2">
                            <span> Available Seats :  <b style="font-size:18px;"><?=$travel['availableSeats']?></b></span>
                            <h4 class="amount"><i class="fa fa-inr" style="font-size:18px"></i> <?=$dataFare?></h4>
                        </div>

                        <div class="col-md-2">
                            <?php
				$fares = "";
				$v1 = $travel['fares'];
				if( is_array($v1))
				{
					$num=count($v1);
					for ($l=0; $l <$num ; $l++) { 
						$fares= $fares." <br>".$v1[$l];
					}
				}else $fares = '<i class="fa fa-inr" style="font-size:18px"></i> '.$v1;
		?>

                                <h4 class="panel-title" style="font-size:16px;"><a class="collapsed"  data-toggle="collapse" data-parent="#accordion" href="#tr<?=$travel['id']?>" aria-expanded="true" aria-controls="headingTwo">
            <button type="button" class="btn btn-danger waves-effect pull-right mySeatVal"  style="margin-top:12px" data-bussid="<?=$travel['id']?>">Select Your Seats</button>
            </a></h4>
                        </div>
                        <div class="clearfix"> </div>

                        <div id="tr<?=$travel['id']?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div id="<?=$travel['id']?>" class="seatLayouts">


                                        </div>

                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div style="background-color:#FFF; border:1px solid #C0C0C0; width:20px; height:18px;" class="left"></div>
                                                <label class="left">&nbsp;&nbsp;Available</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div style="background-color:#CCE8B5; border:1px solid #C0C0C0; width:20px; height:18px;" class="left"></div>
                                                <label class="left">&nbsp;&nbsp;Selected</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div style="background-color:#C0C0C0; border:1px solid #C0C0C0; width:20px; height:18px;" class="left"></div>
                                                <label class="left">&nbsp;&nbsp;Unavailable</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div style="background-color:#ED719E; border:1px solid #C0C0C0; width:20px; height:18px;" class="left"></div>
                                                <label class="left">&nbsp;&nbsp;For Ladies</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <h5><b>Onward Journey</b></h5>
                                        <p>from
                                            <?=$this->session->userdata('from');?> to
                                                <?=$this->session->userdata('to');?>
                                                    <br/> on
                                                    <?=date("j F ,Y", strtotime($this->session->userdata('jdate')))?>
                                        </p>
                                        <p>Duration :
                                            <?= floor($hours) . ':' . sprintf("%'.02d\n",( ($hours-floor($hours)) * 60 ));  // Outputs "1:42"?> hours</p>

                                        <p>
                                            Available Seats :
                                            <?=$travel['availableSeats']?>
                                        </p>

                                        <hr/>
                                        <span style="float:left;">Seats Selected : &nbsp;&nbsp;&nbsp;</span>
                                        <div id="t<?=$travel['id']?>">

                                        </div>
                                        <br>
                                        <p>Amount : <span class="col-md-7 right ">&nbsp;
                                                <input type="hidden" name="tot" id="tot<?=$travel['id']?>" value="<?=round($dataFare)?>"/>
                                                        <i class="fa fa-inr" id="totf<?=$travel['id']?>"> </i>
                                                        
                                                        </span>
                                        </p>
                                        <p class="mb20">Boarding Point <span class="col-md-7 right">
                 
                    <select class="form-control" name="selectBpoint" data-bid="<?=$travel['id']?>" value="Boarding Point" >
                        <option>Boarding Point</option>
                                                         <?php
                                        
            foreach($travel['boardingTimes'] as $key => $val){
				if(isset($val['bpId'])){
                    echo "<option value='".$val['bpId']."'>".$val['bpName']."</option>";
				}elseif($key == "bpId"){
                    echo "<option value='".$travel['boardingTimes']['bpId']."'>".$travel['boardingTimes']['bpName']."</option>";
				}
				//echo "<br>";
			}
           
                    ?>
                    </select>                     
                    </span></p>
                                        <hr/>
                                        <form action="/buses/payment" method="post">
                                            <input type="hidden" name="src" id="src" value="<?=$this->session->userdata('from');?>">
                                            <input type="hidden" name="srcid" id="srcid" value="<?=$this->session->userdata('sourceid');?>">
                                            <input type="hidden" name="dest" id="dest" value="<?=$this->session->userdata('to');?>">
                                            <input type="hidden" name="destid" id="destid" value="<?=$this->session->userdata('destid');?>">
                                            <input type="hidden" name="jdate" id="jdate" value="<?=$this->session->userdata('jdate');?>">
                                            <input type="hidden" name="busId" id="busId" value="<?=$travel['id']?>">
                                            <input type="hidden" name="amount" id="amount" value="">
                                            <input type="hidden" name="bPoint" id="bPoint" value="">
                                            <input type="hidden" name="seats" id="seats" value="">

                                            <span class="cp">
                                                    <button class="btn btn-grey waves-effect" type="button">Continue to Payment</button>
                                                    </span>
                                        </form>

                                        <script>
                                            $(document).on('click', '#seats', function () {
                                                $('#Seats_selected').hide();
                                                $('#selected').show();
                                            })
                                            $(document).on('click', '#seats', function () {
                                                $('#selected').hide();
                                                $('#Seats_selected').show();
                                            })
                                        </script>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php    
    endforeach;
    ?>