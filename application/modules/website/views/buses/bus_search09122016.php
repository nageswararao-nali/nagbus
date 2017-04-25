<?php
$rdates= $this->session->userdata('rdate');
//echo $rdates;
$dj     =   $this->session->userdata('nav_jdate');
$from   =   $this->session->userdata('from');
$to     =   $this->session->userdata('to');
$fromID  =   $this->session->userdata('sourceid');
$toID    =   $this->session->userdata('destid');

if(isset($rdates) && $rdates!=''){
?>

    <div class="row navbar-default navbar">
        <div class="col-md-3">

            <button class="btn-primary" data-target="#modidfybus" data-toggle="collapse" id="modify" style=" line-height:40px; border:0px; margin-top:13px" aria-expanded="true"> MODIFY</button>

        </div>
        <?php
                $onstyle= $this->session->userdata('rjrny') == '' ? "font-weight:bold;" : '';
               $rstyle= $this->session->userdata('rjrny') != '' ? "font-weight:bold;" : '';
                                  ?>
            <div style="border-right:#CCCCCC solid 1px; <?=$onstyle?>" class="col-md-3 text-right">
                <p> <span> <?=$this->session->userdata('nav_from');?> </span><i class="fa fa-arrow-right" aria-hidden="true"></i>
                    <span> <?=$this->session->userdata('nav_to');?> </span></p>

                <p>
                    <?=date("j-F-Y", strtotime($this->session->userdata('nav_jdate')))?>
                </p>
            </div>

            <div class="col-md-3 text-left" style="<?=$rstyle?>">
                <p> <span> <?=$this->session->userdata('nav_to');?> </span><i aria-hidden="true" class="fa fa-arrow-right"></i>
                    <span>  <?=$this->session->userdata('nav_from');?> </span></p>
                <p>
                    <?=date("j-F-Y", strtotime($this->session->userdata('rdate')))?>
                </p>
            </div>
            <div class="col-md-3 text-right ">
                
            </div>
    </div>
    <?php
                                
                               }else{
                                ?>
        <div class="row navbar-default navbar">
            <div class="col-md-4">

                <button style=" line-height:40px; border:0px; margin-top:13px" id="modify" data-toggle="collapse" data-target="#modidfybus" class="btn-primary"> MODIFY</button>


            </div>
            <div style="text-align:center" class="col-md-4">
                <p> <span> <?=$this->session->userdata('nav_from');?> </span><i aria-hidden="true" class="fa fa-arrow-right"></i>
                    <span>  <?=$this->session->userdata('nav_to');?> </span></p>

                <p>
                    <?=date("j-F-Y", strtotime($this->session->userdata('nav_jdate')))?>
                </p>
            </div>

            <div class="col-md-4 text-right ">
                 <button class="btn-primary" data-target="#modidfybus" data-toggle="collapse" id="modify" style=" line-height:40px; border:0px; margin-top:13px" aria-expanded="true"> RETURN</button>
            </div>

        </div>

        <?php
}
?>

            <div id="modidfybus" class="collapse row">
                <form id="busform" action="<?php echo base_url()?>buses/busesList" method="post" autocomplete="off">
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
                                <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                                <input type="text" value="<?=(($from != " ")? $from : '')?>" required="" id="tags" name="cities" class="form-control ui-autocomplete-input" autocomplete="off" placeholder="From">
                               <input type="hidden" id="tags_val" value="<?=(($fromID != " ")? $fromID : '')?>" name="cities_val" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
                                <input type="text" required="" value="<?=(($to != " ")? $to : '')?>" id="tags2" name="cities2" class="form-control" placeholder="To">
                               <input type="hidden" id="tags2val" name="cities2val" value="<?=(($toID != " ")? $toID : '')?>" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="input-group date datepickerDemo">
                            <?php
                            if(isset($dj) && $dj!=''){
                                
                               $dofj = date("m/d/Y", strtotime($dj));
                            }
    
                            ?>
                                <input type="text" required="" value="<?=(($dofj != '') ? $dofj : '')?>" placeholder="Date of Journey" readonly="" name="DateofJourney" class="form-control">
                                <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-group date datepickerDemo">
                            <?php
                            if(isset($rdates) && $rdates!=''){
                                
                               $rofj = date("m/d/Y", strtotime($rdates));
                            } 
                                       ?>
                                <input type="text" required="" value="<?=(($rofj != '') ? $rofj : '')?>" placeholder="Date of Return" readonly="" name="DateofReturn" id="DateofReturn" class="form-control">
                                <span class="input-group-addon"><i class=" ion ion-calendar"></i></span> </div>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-info pull-right" type="submit"><i class="fa fa-search"></i> Search</button>
                    </div>
                </form>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="navbar navbar-default navbar-custom" style="color:#000; padding-top:8px">
                        <div class="col-md-1">
                            <h5>Filter by</h5>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Operator <span class="caret"></span></button>
                            <ul class="dropdown-menu filters" id="travels">
                                <li class="dropdown-header">clear all</li>
                                <li>
                                    <?php
		  $j=0;
				 
		  foreach ($jsonresult as $key => $values) 
			{
				if(is_array($values))
				{   
					foreach ($values as $k => $v) 
					{
			 
					  foreach ($v as $k1 => $v1) 
					  {
						 if(!strcmp($k1,'travels'))
						 {
							  $travelsList[$j++]=$v1;
						 }
						 
					  }

					}
				}
			}

		  $travelsListnew=array_unique($travelsList);
		  		  
		  for ($t=0; $t <$j ; $t++) 
			{
			if(!empty($travelsListnew[$t]))
			{	 
			 $p=0;
					if (isset($_POST['operators']))
					{

					foreach($_POST['operators'] as $chosen)
					{  

					if( strpos($travelsListnew[$t], $chosen ) !== false)
					{
					$flagTravels[$p++]=1;
					}
					else
					{
					$flagTravels[$p++]=0;

					}
					}

					$flagTT=0;
					for ($q=0; $q <$p ; $q++) 
					{
					if($flagTravels[$q]==1)
					{
					$flagTT=1;
					break;
					}
					}

					if($flagTT==1)
					{
					?>
                                        <li>
                                            <input type='checkbox' name='operators[]' id="myval" value="<?=$travelsListnew[$t]?>">
                                            <?=$travelsListnew[$t]?>
                                        </li>
                                        <?php
					}
					else
					{
					?>
                                            <li>
                                                <input type='checkbox' name='operators[]' id="myval" value="<?=$travelsListnew[$t]?>">
                                                <?=$travelsListnew[$t]?>
                                            </li>
                                            <?php
					}

					}
					else{
					?>
                                                <li>
                                                    <input type='checkbox' name='operators[]' id="myval" value="<?=$travelsListnew[$t]?>">
                                                    <?=$travelsListnew[$t]?>
                                                </li>

                                                <?php
					}
	  
			}
			}
		  ?>

                            </ul>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default btn-sm  dropdown-toggle" type="button" data-toggle="dropdown">Bus type <span class="caret"></span></button>
                            <ul class="dropdown-menu filters" id="busTypes">
                                <li class="dropdown-header">clear all</li>
                                <li>
                                    <input type="checkbox" value="AC"> AC
                                </li>
                                <li>
                                    <input type="checkbox" value="nonAC"> NON-AC
                                </li>
                                <li>
                                    <input type="checkbox" value="sleeper"> SLEEPER
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default btn-sm  dropdown-toggle" type="button" data-toggle="dropdown">Boarding points <span class="caret"></span></button>
                            <?php
		 $boardingPoints= array();
		 $dropingPoints = array();
         $startMinTime = array();      
         $totalSeats = 0;      
         $priceList = array();
			
			foreach($jsonresult['availableTrips'] as $travel):
                                      
                    $v1 = $travel['fares'];
                    if( is_array($v1))
                    {
                        $num=count($v1);
                        for ($l=0; $l <$num ; $l++) {                            
                            $priceList[] = $v1[$l];
                        }                       
                    }else{                       
                        $priceList[] = $v1;
                    }
                
                
                
                
                 $startMinTime[] = $travel['departureTime'];                
                $totalSeats += $travel['availableSeats'];     
               
                //For Boarding Points
                foreach($travel['boardingTimes'] as $key => $val){                
                    if(isset($val['bpId'])){
                        $boardingPoints[$val['bpId']] = array($val['bpName'],getTime($val['time']));
                    }elseif($key == "bpId"){
                        $boardingPoints[$val] = array($travel['boardingTimes']['bpName'],getTime($travel['boardingTimes']['time']));
                    }
                    //echo "<br>";
                }
			endforeach;
		// echo $boarding['droppingTimes']['location'];
		asort($boardingPoints);
		
		 ?>
                                <ul class="dropdown-menu filters" id="bPoints" style="height:200px !important;overflow-y:scroll;">
                                    <li class="dropdown-header">clear all</li>

                                    <?php
		
		foreach($boardingPoints as $key => $val):

		?>
                                        <li>
                                            <input type="checkbox" name="select" value="<?=$key?>">
                                            <?=$val[0]?>
                                        </li>
                                        <?php endforeach;?>


                                </ul>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default btn-sm  dropdown-toggle" type="button" data-toggle="dropdown">Droping points <span class="caret"></span></button>
                            <?php
	   foreach($jsonresult['availableTrips'] as $travel):
			//For Boarding Points
			foreach($travel['droppingTimes'] as $key => $val){
				if(isset($val['bpId'])){
					$dropingPoints[$val['bpId']] = array($val['bpName'], getTime($val['time']));
				}elseif($key == "bpId"){
					$dropingPoints[$val] = array($travel['droppingTimes']['bpName'], getTime($travel['droppingTimes']['time']));
				}
				//echo "<br>";
			}
			endforeach;
			
		//echo "<pre>";
		//print_r($dropingPoints);
		//echo "</pre>";
	   
	   ?>
                                <ul class="dropdown-menu filters" id="dPoints" style="height:200px !important;overflow-y:scroll;">
                                    <li class="dropdown-header">clear all</li>

                                    <?php
		  asort($dropingPoints);
		  foreach($dropingPoints as $key => $val):
		  ?>

                                        <li>
                                            <input type="checkbox" name="select" value="<?=$key?>">
                                            <?=$val[0]?>
                                        </li>

                                        <?php endforeach;?>
                                </ul>
                        </div>
                        <div class="col-md-1">
                            <h5>Sort by</h5>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-default btn-sm  dropdown-toggle" type="button" data-toggle="dropdown">Price<span class="caret"></span></button>
                            <ul class="dropdown-menu filters">
                                <li class="dropdown-header">clear all</li>
                                <li><a href="javascript:;" id="priceDown">Price(low to high)</a></li>
                                <li><a href="javascript:;" id="priceUp">Price(high to low)</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success panel-hovered panel-stacked mb30">
                        <div class="panel-body" style="padding:6px">
                            <div class="col-md-1"> <i class="fa fa-plus-square" style="font-size:30px"></i> </div>
                            <div class="col-md-2">
                                <h4><?=getTime(min($startMinTime))?></h4> On Words</div>
                            <div class="col-md-5" style="text-align:center;maring-top:20px;">
                                <?=$totalSeats?> Seats Available</div>
                            <div class="col-md-3">
                                <h4><i class="fa fa-inr" style="font-size:18px"></i> <?=min($priceList)?> TO <i class="fa fa-inr" style="font-size:18px"></i> <?=max($priceList)?></h4>
                            </div>
                            <div class="col-md-1"> <i class="fa fa-arrow-down" style="font-size:36px; color: #903"></i> </div>
                        </div>
                    </div>
                </div>
            </div>

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



    $boardingPoints= array();
 
	$travelsLists=array();
                        
             
	if(isset($_POST['filterSub']) && $_POST['operators']!=""){
		
		foreach($jsonresult['availableTrips'] as $travel){
			if(in_array($travel['travels'], $_POST['operators'])){
				$travelsLists[]=$travel;
			}			
		}
		
	}else{
		$travelsLists=$jsonresult['availableTrips'];
	}
?>


                <div id="travelRows">

                    <?php        
          
          foreach($travelsLists as $travel):

        
	//For Boarding Points
	foreach($travel['boardingTimes'] as $boardingpoint){
		$boardingPoints[$boardingpoint['bpId']] = $boardingpoint['bpName'];
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
            
            if($travel['travels']!=''){
            ?>

                            <div class="row travels" data-stime="<?=$travel['departureTime']?>" data-price="<?=round($dataFare)?>">
                                <div class="col-md-12">
                                    <div class="panel panel-success panel-hovered panel-stacked mb30">
                                        <div class="panel-body" style="padding:6px">
                                            <div class="col-md-5">
                                                <h4><?=$travel['travels']?> </h4>
                                                <?=$travel['busType']?>
                                            </div>

                                            <div class="col-md-3">
                                                <h4><?=getTime($travel['departureTime'])?> <i class="fa fa-long-arrow-right"></i> 
                                        <?=getTime($travel['arrivalTime'])?></h4> Duration :
                                                <?= floor($hours) . ':' . sprintf("%'.02d\n",( ($hours-floor($hours)) * 60 ));  // Outputs "1:42"?> hours </div>
                                            <div class="col-md-2"> <span> Available Seats  :  <b style="font-size:18px;"><?=$travel['availableSeats']?></b></span>
                                                <h4 class="amount"><i class="fa fa-inr" style="font-size:18px"></i>

<?php


if( $commision_amt[0]->mark_comm_type == "INR" )
				{
					$markup = $commision_amt[0]->mark_comm_value;
				}
				else
				{
					$markup = $dataFare*$commision_amt[0]->mark_comm_value/100;
				}
				$finalmarkup = $dataFare+$markup;
?>												<?=$dataFare+$markup;?>
	
											</h4>
                                            </div>



                                            <div class="col-md-2">
                                                <h4 class="panel-title" style="font-size:16px;"> 
									<a class="collapsed"  data-toggle="collapse" data-parent="#accordion" href="#tr<?=$travel['id']?>" aria-expanded="true" aria-controls="headingTwo">
            <button type="button" class="btn btn-danger waves-effect pull-right mySeatVal"  style="margin-top:12px" data-bussid="<?=$travel['id']?>">Select Your Seats</button>
            </a> </h4>
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
		<?php                              
        if($this->session->userdata('rjrny') ==''){       
         $label = "Onward Journey";   
        }else{
            $label = "Return Journey"; 
        }
        ?>
                                                                <h5><b><?=$label?></b></h5>
                                                            <p>from
                                                                <?=$from?>to
                                                                    <?=$to?>
                                                                        <br/> on
                                                                        <?=date("j F ,Y", strtotime($jdate))?>
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
                                                <input type="hidden" name="tot" id="tot<?=$travel['id']?>" 
												value="<?=$dataFare;?>"/>
                                                        <i class="fa fa-inr" id="totf<?=$travel['id']?>"> </i>
                                                        
                                                        </span>
                                                            </p>
                                                            <p class="mb20">Boarding Point <span class="col-md-7 right">
                 
                    <select class="form-control selectVal" id="selectBpoint" name="selectBpoint"  data-bid="<?=$travel['id']?>" value="Boarding Point" >
                        <option>Boarding Point</option>
                    <?php                                        
						foreach($travel['boardingTimes'] as $key => $val){
							if(isset($val['bpId'])){
								echo "<option data-bptime='".getTime($val['time'])."' value='".$val['bpId']."'>".$val['bpName']."</option>";
							}elseif($key == "bpId"){
								echo "<option data-bptime='".getTime($travel['boardingTimes']['time'])."' value='".$travel['boardingTimes']['bpId']."'>".$travel['boardingTimes']['bpName']."</option>";
							}
							//echo "<br>";
						}           
                    ?>
                    </select>                     
                    </span></p>
                                                            <hr/>
															<?php
															if($this->session->userdata("onword")!=''){  
															?>
			                                        <form action="/buses/payment" method="post" onsubmit="return checkseats()">
													<?php
															}else{
													?>
													 <form action="/buses/payment" method="post" onsubmit="return chkseats()">
															<?php } ?>
													
								<input type="hidden" name="src" id="src" value="<?=$this->session->userdata('from');?>">
								<input type="hidden" name="srcid" id="srcid" value="<?=$this->session->userdata('sourceid');?>">
								<input type="hidden" name="dest" id="dest" value="<?=$this->session->userdata('to');?>">
								<input type="hidden" name="destid" id="destid" value="<?=$this->session->userdata('destid');?>">
								<input type="hidden" name="jdate" id="jdate" value="<?=$this->session->userdata('jdate');?>">
								<input type="hidden" name="rdate" id="rdate" value="<?=$this->session->userdata('rdate');?>">


								<input type="hidden" name="busId" id="busId" value="<?=$travel['id']?>">                                                                               
								<input type="hidden" name="amount" id="amount" value="">
								<input type="hidden" name="bPoint" id="bPoint" value="">
								<input type="hidden" name="bPointName" id="bPointName" value="">
								<input type="hidden" name="serviceid" id="serviceid" value="<?=$travel['id']?>">
								<input type="hidden" name="bptime" id="bptime" value="">
								<input type="hidden" name="seats" id="seats" value="">

								<input type="hidden" name="busType" id="busType" value="<?=$travel['busType']?>" />
								<input type="hidden" name="startingTime" id="startingTime" value="<?=getTime($travel['departureTime'])?>" />
								<input type="hidden" name="travels" id="travels" value="<?=$travel['travels']?>" />



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
                                            <div class="clearfix"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php
							 }else{
								 ?>
								           <div class="row travels" data-stime="<?=$travel['departureTime']?>" data-price="<?=round($dataFare)?>">
                                        <div class="col-md-12">
                                            <div class="panel panel-success panel-hovered panel-stacked mb30">
                                                <center>
                                                    <h4>No Buses are available in this Route</h4>
                                                </center>

                                            </div>
                                        </div>
                                    </div>


                                    <?php
            }								 
       endforeach;   
        if($this->session->userdata("onword")!=''){                                                                
           $onwordSeats = $this->session->userdata("onword");
           $countSeats = count(explode("," , $onwordSeats['seats']));
       }
       
        ?>


                </div>


                <?php
$citiesList="";
$cityListArray =array();
foreach($cities as $city){
	$citiesList .= '"'.$city->name.'",';	
	$cityListArray[] = array("name"=>$city->name, "id"=>$city->id);
}

	$sourceJson = json_encode($cityListArray);

?>
                    <script>
                        var sourceJson = <?=$sourceJson?>;

                        var destJson = '';
                        var destCityResult = [];
                        $(function () {

                            var availableTags = [<?=rtrim($citiesList,",")?>];

                            $("#tags").on("blur", function () {
                                var sourceCityName = $(this).val();

                                var found = getIdbyCityName(sourceCityName);
                                var sourceCityId = found[0].id;

                                $("#tags_val").val(sourceCityId);

                                if (sourceCityId > 0) {
                                    $.ajax({
                                        url: '/seatseller/destinationList.php?sourceList=' + sourceCityId,
                                        dataType: 'json',
                                        success: function (result) {

                                            var destJson = result.cities;

                                            for (var key in destJson) {
                                                if (destJson.hasOwnProperty(key)) {
                                                    destCityResult.push(destJson[key].name);
                                                }
                                            }

                                            $("#tags2").autocomplete({
                                                source: destCityResult
                                            });
                                        },
                                        error: function (data) {
                                            console.log(data);
                                        }
                                    });

                                } else {

                                    alert("Invalid Source City ID");
                                }
                            });


                            $("#tags").autocomplete({
                                source: availableTags
                            });

                        });


                        function getIdbyCityName(name) {
                            return sourceJson.filter(
                                function (sourceJson) {
                                    return sourceJson.name == name
                                }
                            );
                        }

                        function getDestID(id) {
                            return sourceJson.filter(
                                function (sourceJson) {
                                    return sourceJson.name == id
                                }
                            );
                        }

                        $("#tags2").on("blur", function () {
                            var destVal = $("#tags2").val();

                            if (destVal != "") {

                                var found = getDestID(destVal);
                                var destCityID = found[0].id;
                                $("#tags2val").val(destCityID);
                            }

                        });
                    </script>
                    <script>
                        //$("select[name='selectBpoint']").on("change", function () {

                        $(document).on("change", ".collapse select", function () {

								 //  alert("I am test");
                                var lids 	= $(this).data('bid');
								

                                var bPint 			= $(this).val();
								var optionSelected 	= $(this).find("option:selected");
								var bpointText 		= optionSelected.text();
								var bptime 			= optionSelected.data('bptime');
								
								//alert(bpointText);
                                //bPoint

                                $('#tr' + lids).find('input[name="bPoint"]').val(bPint);
								$('#tr' + lids).find('input[name="bPointName"]').val(bpointText);
								$('#tr' + lids).find('input[name="bptime"]').val(bptime);

                        });



                        $("#travelRows div.travels").sort(sort_time).appendTo('#travelRows'); // append again to the list
                        // sort by time callback
                        function sort_time(a, b) {
                            return ($(b).data('stime')) < ($(a).data('stime')) ? 1 : -1;
                        }

                        $("#priceUp").on("click", function () {
                            $("#travelRows div.travels").sort(sort_price_up).appendTo('#travelRows');
                        });
                        // sort by price callback
                        function sort_price_up(a, b) {
                            return ($(b).data('price')) < ($(a).data('price')) ? -1 : 1;
                        }

                        $("#priceDown").on("click", function () {
                            $("#travelRows div.travels").sort(sort_price_down).appendTo('#travelRows');
                        });
                        // sort by price callback
                        function sort_price_down(a, b) {
                            return ($(b).data('price')) < ($(a).data('price')) ? 1 : -1;
                        }


                        $('.filters').change(function () {

                            // Operators check
                            var operators = [];
                            $("#travels li").each(function () {
                                if ($(this).find("input:checkbox").is(":checked")) {
                                    var travelsName = $(this).find("input:checkbox").val();
                                    operators.push(travelsName);
                                }
                            });
                            //console.log(operators);

                            // Bus types
                            var busTypes = {};
                            $("#busTypes li").each(function () {
                                if ($(this).find("input:checkbox").is(":checked")) {
                                    var busType = $(this).find("input:checkbox").val();
                                    busTypes[busType] = busType;
                                }
                            });

                            //Bording Points
                            var boardingPoints = [];
                            $("#bPoints li").each(function () {
                                if ($(this).find("input:checkbox").is(":checked")) {
                                    var boardingPoint = $(this).find("input:checkbox").val();
                                    boardingPoints.push(boardingPoint);
                                    console.log(boardingPoints);
                                }
                            });


                            //Dropping Points
                            var droppingPoints = [];
                            $("#dPoints li").each(function () {
                                if ($(this).find("input:checkbox").is(":checked")) {
                                    var droppingPoint = $(this).find("input:checkbox").val();
                                    droppingPoints.push(droppingPoint);
                                    console.log(droppingPoints);
                                }
                            });

                            var sample = $('#myval').val();
                            $.ajax({
                                type: 'GET',
                                url: "<?php echo base_url(); ?>" + "bus_ajax/filters",
                                data: {
                                    operators: JSON.stringify(operators),
                                    busType: JSON.stringify(busTypes),
                                    boarding: JSON.stringify(boardingPoints),
                                    dropping: JSON.stringify(droppingPoints),
                                    price: ''
                                },
                                //dataType: 'json',
                                success: function (data) {
                                    if (data != "") {
                                        $("#travelRows").html(data);
                                    } else {
                                        $("#travelRows").html("<p align='center'>No services available!</p>");
                                    }
                                    console.log(data);
                                }
                            });
                        });


                        $(document).on("click", ".mySeatVal", function () {

                            var seatVal = $(this).data("bussid");

                            $.ajax({
                                type: 'GET',
                                url: "<?php echo base_url(); ?>" + "bus_ajax/seatLayout",
                                data: {
                                    seatVal: JSON.stringify(seatVal)

                                },
                                //dataType: 'json',
                                success: function (data) {
                                    //busseats
                                    if (data != "") {
                                        $("#" + seatVal).html(data);
                                    } else {
                                        $("#" + seatVal).html("<p align='center'>No services available!</p>");
                                    }

                                    // console.log(data);
                                }
                            });


                        });

                        function swapImage(id, primary, secondary) {
                            src = document.getElementById(id).src;
                            if (src.match(primary)) {
                                document.getElementById(id).src = secondary;
                            } else {
                                document.getElementById(id).src = primary;
                            }
                        }




                        $(document).on("click", ".c_b", function () {
                            // alert();
                            var lid = $(this).parents('.seatLayouts').attr("id");
                            //alert(lid);
                            var allVals = [];
                            var tot = 0;

                            $('#' + lid).find('input:checkbox:checked').each(function () {
                                //alert($(this).val());
                                //  allVals.push($(this).val());
                                var val = $(this).val();
                                if (val) {
                                    allVals.push(val);
                                    tot += Number($("#tot" + lid).val());
                                }
                            });



                            if (allVals.length > 0) {
                                $('#tr' + lid).find('.cp').html('<button class="btn btn-success waves-effect" type="submit">Continue to Payment</button>');
                                $('#tr' + lid).find('input[name="seats"]').val(allVals.join(','));

                            } else {
                                $('#tr' + lid).find('.cp').html('<button class="btn btn-grey waves-effect" type="button">Continue to Payment</button>');
                                $('#tr' + lid).find('input[name="seats"]').val('');
                            }

                            //alert(allVals);

                            $('#t' + lid).html(allVals.join(','));
                            $('#totf' + lid).html('&nbsp;' + tot + '/-');
                            $('#tr' + lid).find('input[name="amount"]').val(tot);


                        });
						
						 function checkseats() {							 
                            var seats = $('input[name="seats"]').val();
                            var seatVal = seats.split(',');
                            var count = seatVal.length;

                            var onword = '<?=$countSeats?>';

                            // alert(count + "----" + onword);

                            if (count < onword) {
                                alert("Please select " + onword + " seats");
                                return false;
                            } else if (count > onword) {
                                alert("Please select " + onword + "seats only");
                                return false;
                            } else {
                                return true;
                            }
                        }
						
						function chkseats(){
							return true;
						}
                    </script>




                    <script>
                        imgseaterArr = new Array();
                        imgladiesseaterArr = new Array();
                        imgvsleeperArr = new Array();
                        imgladiesvsleeperArr = new Array();
                        imghsleeperArr = new Array();
                        imgladieshsleeperArr = new Array();

                        for (var i = 0; i < 100; i++) {
                            imgseaterArr[i] = new Array(
                                '/seat_images/ac_semi_sleeper_vacant.jpg',
                                '/seat_images/ac_sleeper_selected.jpg');
                            imgladiesseaterArr[i] = new Array(
                                '/seat_images/non_ac_seater_ladies.jpg',
                                '/seat_images/ac_sleeper_selected.jpg');

                            imgvsleeperArr[i] = new Array('/seat_images/volvo_sleeper_vertical_vacant.jpg', '/seat_images/volvo_sleeper_vertical_selected.jpg');
                            imgladiesvsleeperArr[i] = new Array('/seat_images/non_ac_vertical_sleeper_ladies.jpg', '/seat_images/volvo_sleeper_vertical_selected.jpg');

                            imghsleeperArr[i] = new Array('/seat_images/volvo_sleeper_vacant.jpg', '/seat_images/volvo_sleeper_selected.jpg');

                            imgladieshsleeperArr[i] = new Array('/seat_images/non_sleeper_ac_ladies.jpg', '/seat_images/volvo_sleeper_selected.jpg');

                        }

                        function swapseater(chk, ind) {
                            //alert("Hello I am test");
                            img = document.images['img' + ind];
                            if (chk) {
                                img.src = imgseaterArr[ind][1];
                                img.alt = imgseaterArr[ind][1];
                            } else {
                                img.src = imgseaterArr[ind][0];
                                img.alt = imgseaterArr[ind][0];
                            }
                        }

                        function swapladiesseater(chk, ind) {
                            img = document.images['img' + ind];

                            if (chk) {
                                img.src = imgladiesseaterArr[ind][1];
                                img.alt = imgladiesseaterArr[ind][1];
                            } else {
                                img.src = imgladiesseaterArr[ind][0];
                                img.alt = imgladiesseaterArr[ind][0];
                            }
                        }

                        function swapvsleeper(chk, ind) {
                            img = document.images['vsleep' + ind];
                            if (chk) {
                                img.src = imgvsleeperArr[ind][1];
                                img.alt = imgvsleeperArr[ind][1];
                            } else {
                                img.src = imgvsleeperArr[ind][0];
                                img.alt = imgvsleeperArr[ind][0];
                            }
                        }

                        function swapladiesvsleeper(chk, ind) {
                            img = document.images['vsleep' + ind];
                            if (chk) {
                                img.src = imgladiesvsleeperArr[ind][1];
                                img.alt = imgladiesvsleeperArr[ind][1];
                            } else {
                                img.src = imgladiesvsleeperArr[ind][0];
                                img.alt = imgladiesvsleeperArr[ind][0];
                            }
                        }

                        function swaphsleeper(chk, ind) {
                            img = document.images['hsleep' + ind];
                            if (chk) {
                                img.src = imghsleeperArr[ind][1];
                                img.alt = imghsleeperArr[ind][1];
                            } else {
                                img.src = imghsleeperArr[ind][0];
                                img.alt = imghsleeperArr[ind][0];
                            }
                        }


                        function swapladieshsleeper(chk, ind) {
                            img = document.images['hsleep' + ind];
                            if (chk) {
                                img.src = imgladieshsleeperArr[ind][1];
                                img.alt = imgladieshsleeperArr[ind][1];
                            } else {
                                img.src = imgladieshsleeperArr[ind][0];
                                img.alt = imgladieshsleeperArr[ind][0];
                            }
                        }
                    </script>
                    <script>
                        $(function () {
                            $('.datepickerDemo').datepicker({
                                startDate: new Date(),
                                autoclose: true,
                            })
                        });
                    </script>