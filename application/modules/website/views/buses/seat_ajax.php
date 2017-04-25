<style>
    #image {
        background: url(/localhost/mybus/seatseller/images/ac_semi_sleeper_vacant.jpg) no-repeat;
    }
    
    .checkbox:checked + .containers {
        outline: 2px solid black;
    }
    
    .containers {
        position: relative;
        outline: 1px solid white;
        width: 50px;
        height: 50px;
    }
    
    .containers:hover !important {
        position: relative;
        outline: 2px solid red;
        width: 50px;
        height: 50px;
    }
    
    .containers_vert {
        position: relative;
        outline: 1px solid white;
        width: 50px;
        height: 50px;
    }
    
    .containers_vert:hover {
        position: relative;
        outline: 2px solid red;
        width: 50px;
        height: 50px;
    }
    
    .containers_un {
        position: relative;
        opacity: 0.45;
        filter: alpha(opacity=45);
    }
    
    .containers_vert_un {
        position: relative;
        opacity: 0.45;
        filter: alpha(opacity=45);
    }
    
    .seatTab td {
        width: 50px;
        height: 50px;
    }
    
    .seatTab label {
        width: 50px;
        height: 50px;
    }
    
    .checkbox {
        position: relative;
        bottom: 0px;
        right: 0px;
        width: 50px;
        height: 50px;
    }
    
    .checkbox:hover {
        width: 50px;
        height: 50px;
    }
    /* .imagehover{ outline: 1px solid white; } .imagehover:hover{ outline: 2px solid red; } */
    
    .submit {
        background-color: #ccc;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 6px;
        color: #fff;
        font-family: 'Oswald';
        font-size: 20px;
        text-decoration: none;
        cursor: pointer;
        border: none;
    }
    
    .submit:hover {
        border: none;
        background: red;
        box-shadow: 0px 0px 1px #777;
    }
    
    .input {
        border: 1px solid #C01C22;
        background: #FDF4A5;
        font-family: "cursive", Georgia;
        font-size: 16px;
    }
</style>

<?php
 $tripdetails = getTripDetails($seats);     
 $tripdetails2 = json_decode($tripdetails);
// foreach loop for the value variable
foreach ($tripdetails2 as $key => $value)
{
		
    if(is_array($value)) 
    {
        
        $s=array(array());
        $sleeper=array(array(array()));
        $seatsleep=array(array(array()));

        foreach ($value as $k => $v) 
        {
            foreach ($v as $k1 => $v1)//checking first for seater and sleeper bus
            {
                if(isset($v->zIndex)&&isset($v->length)&&isset($v->width))
                {
                    if ($v->zIndex==0) // checks lower berths
                    {
                        if (($v->length==2 && $v->width==1 )||($v->length==1 && $v->width==2 )) // both vertical and horizontal sleepers in Lower Berth
                        {
                            $flaglsleep=1;
                            $seatsleep[$v->zIndex][$v->row][$v->column]=$v;  
                        }
                        elseif ($v->length==1 && $v->width==1)
                        {
                            $flagseatsleep1=1; 
                            $flaglseat=1;
                            $seatsleep[$v->zIndex][$v->row][$v->column]=$v;
                        }
                    }

                    elseif ($v->zIndex==1) // only sleepers in  upper berths
                    {
                   
                        $seatsleep[$v->zIndex][$v->row][$v->column]=$v;
                        $flagseatsleep2=1;
                    }



                }

            }//ends foreach ($v as $k1 => $v1)


        }//ends foreach ($value as $k => $v)


        if (($flagseatsleep1==1)&&($flagseatsleep2==1)) // if it is a seater+sleeper
        {
            //echo "THIS IS SEATER+ SLEEPER";
            /*
            $seatsleep[0]  // this is seats/sleepers lower level;

            $seatsleep[1]   // these are sleepers upper level

            */

            $rowcountseater = count($seatsleep[0]);

            $max=0;
            $mini = array(); // holds the number of seats in every row
            for ($i=0; $i <=$rowcountseater ; $i++)
            {
  
             if(isset($seatsleep[0][$i]))
                {
                $mini[$i]=count($seatsleep[0][$i]);
                }

            }

            $min=max($mini);

            $posi=array();
            $countter=0;

            for ($j=0; $j <=$rowcountseater ; $j++) // for finding the maximum number of seats in each row and using that as the limit in the for loop
            {
                $countter=0;
                $i=0;
                do
                { 
                    if(!empty($seatsleep[0][$j]))
                    {
                        if(empty($seatsleep[0][$j][$i]))
                        {

                            if (empty($seatsleep[0][$j][$i+1]))
                            {
    
                                if(isset($mini[$j]))
                                {
                                    if($countter==$mini[$j])        
                                    {

                                    $posi[$j]=$i; 
        
                                    break;
                                    }
                                }
                            }

                        }

                        else
                        { $countter++;
                        $pos=$i;
                        }
                    }

                    $i++;
                } 
                    while (($i<$min*2));
           

            }
            $actual = max($posi);

            for($i=0;$i<=$rowcountseater;$i++)
            {

                if(!empty($seatsleep[0][$i]))
                {

                    if(count($seatsleep[0][$i])>$max)
                    {
                      $max=count($seatsleep[0][$i]);
                    }
                    if (count($seatsleep[0][$i])<$min) 
                    {
                      $min=count($seatsleep[0][$i]);
                    }
                }



            }

            $rowcountsleeper = count($seatsleep[1]); 
            $rowcountseater = count($seatsleep[0]);
            $sleeperperrowcount = count($seatsleep[1][0]);


            //For getting the number of seats per row in seater


                for($i=0;$i<=$rowcountseater;$i++)
                {

                    if(!empty($seatsleep[0][$i]))

                    {
                        $flagS=0;
                        $flagSL=0;

                        $seatcount=count($seatsleep[0][$i]);

                        if(!empty($seatsleep[0][$i][0]))
                        {

                            if(($seatsleep[0][$i][0]->length==2 && $seatsleep[0][$i][0]->width==1)||($seatsleep[0][$i][0]->length==1 && $seatsleep[0][$i][0]->width==2))
                            {
                              $flagSL=1;
                            }
                            else
                            {
                              $flagS=1;
                            }


                            for ($j=1; $j <$seatcount ; $j++) 
                            { 
                             
                                if(!empty($seatsleep[0][$i][$j]))
                                {
                                    if ($flagS==1 && (($seatsleep[0][$i][$j]->length==2 && $seatsleep[0][$i][$j]->width==1)||($seatsleep[0][$i][$j]->length==1 && $seatsleep[0][$i][$j]->width==2)))
                                    {
                                
                                    $flagSL=1;
                                    break;
                                    }
                                    elseif ($flagSL==1 && ($seatsleep[0][$i][$j]->length==1 && $seatsleep[0][$i][$j]->width==1)) 
                                    {
                                        
                                    $flagS=1;
                                        break;

                                    }
                              
                                }

                            }


                        }




                    }

                    if($flagS==1 && $flagSL==1)
                    {break;
                    }

                }

                if($flagS==1 && $flagSL==1)
                {
                  $seatperrowcount=$min*2;

                }
                else
                {
                  $seatperrowcount = $max;
                }
            // ends finding the limit for the seater loop (number of seats in a row)



            // FUNCTION CALL (1) UPPER BERTHS IN SEATER+SLEEPER
            generatelayout($rowcountsleeper,$sleeperperrowcount,$seatsleep,1,1);   


            //LOWER BERTHS
            // if seats and sleepers lower berths
            if ($flaglseat==1 && $flaglsleep==1)
            {

                generatelayout($rowcountseater,$actual,$seatsleep,0,1);

            }

            elseif ($flaglseat==1 && $flaglsleep==0) 
            {
                
                generatelayout($rowcountseater,$seatperrowcount,$seatsleep,0,1);
            }



        } //ends if it is a seater+sleeper

        //  If its not sleeper+seater -> basic seater/ sleeper
        elseif((($flagseatsleep1==0)&&($flagseatsleep2==0))||(($flagseatsleep1==1)&&($flagseatsleep2==0))||(($flagseatsleep1==0)&&($flagseatsleep2==1)))
        {
        

            $sleepersize=array(array(array()));

            foreach ($value as $k => $v) 
            {
                
               
                    foreach ($v as $k1 => $v1) 
                    {
                    
                        if(isset($v->length)&&isset($v->width))
                        {

                            if($v->length==1 && $v->width==1) // condition for seater or semi-sleeper
                          
                            {

                                $flag=2;
                                if(!strcmp($k1,'row'))
                                {
                                    $s[$v1][$v->column]=$v;

                                }
                            }
                            else if(($v->length==2 && $v->width==1)||($v->length==1 && $v->width==2)) // condition for horizontal sleeper
                            {  
                                $flag=1;

                                    if($v->length==2 && $v->width==1)
                                    { 
                                       $flag2=1;
                                    }

                                    if(!strcmp($k1,'row'))
                                    {
                                        if($v1>=$rowvalue)
                                       { $rowvalue=$v1;}


                                        $sleeper[$v->zIndex][$v1][$v->column]=$v;
                                        $sleepersize[$v->zIndex][$v1][$v->column]=$v->column;


                                    }

                            }
                   

                        }

                    }
                }

                $rowcountseater = count($s);  
                $seatperrowcount = count($s[0]);
                $c=0;
                for($i=0;$i<=$rowvalue;$i++)
                {
                  
                  if(!empty($sleeper[0][$i]))
                    {$c++;}
                }
                $rowcountsleeper=$c;


                // If it is a sleeper
                if ($flag==1)
                {

                    if (!empty($sleeper[0][$rowvalue]))
                    {  
                     $sleeperperrowcount0= count($sleeper[0][$rowvalue]);
                    }
                    else
                    { 
                        $sleeperperrowcount0=0;
                    }

                    if (!empty($sleeper[1][$rowvalue]))
                    {   
                    $sleeperperrowcount1= count($sleeper[1][$rowvalue]);
                    } // change made here
                    else
                    {
                        $sleeperperrowcount1=0;
                    }


                    $sleeperperrowcount = max($sleeperperrowcount1,$sleeperperrowcount0);

                    $MAXX=0;

                    for ($i=1; $i >=0 ; $i--)
                    {   
                        

                        for ($j=0; $j <=$rowvalue ; $j++)
                        {
                           if(!empty($sleepersize[$i][$j])) 
                            {
                              $X=max($sleepersize[$i][$j]);  
                            }
                            else
                            {
                               $X=0; 
                            }

                            if($X>$MAXX)
                            {
                                $MAXX = $X;
                            }

                        }
                       
                        if($flag2==1) // horizontal + vertical sleepers
                       {

                       //generate seatlayout 
                        generatelayout($rowvalue,$MAXX,$sleeper,$i,0);
                       }
                       else
                       {
                        $Z=$sleeperperrowcount+1;
                        generatelayout($rowvalue,$Z,$sleeper,$i,0);

                       }

                    }

                }
                elseif ($flag==2) // If it is seater
                {
                    

                    if(!empty($s))
                    {
                        generateLayoutSeater($rowcountseater,$seatperrowcount,$s);

                    }

                }




        } // ends if NOT sleeper+seater



    } //ends if(is_array($value))


}// foreach loop for the value variable ends




function generatelayout($rowcountsleeper,$sleeperperrowcount,$seatsleep,$UpperLower,$horVer)
{

    if  ($UpperLower==1)
        {
            echo "<caption><br>UPPER SECTION</caption> ";
            $i=1;

            if($horVer==1)
            {
                $klimit = ($sleeperperrowcount*2+1) ;
            }
            elseif ($horVer==0) 
            {
                $klimit = $sleeperperrowcount+1 ;
            }


        }
    elseif ($UpperLower==0)
        {
            echo "<br><caption>LOWER SECTION</caption> ";
            $i=0;
            $klimit=$sleeperperrowcount;
        }

        $x=0;
        global $y;
        echo "<table frame='box1'><tbody>";
        $l=0;
        for ($j=0; $j <=$rowcountsleeper ; $j++) 
        { 
        
            echo "<tr>";

            for ($k=0; $k <=$klimit ; $k++) 
            { 
              
               if(!empty($seatsleep[$i][$j][$k]))
               { 
       
                    if($seatsleep[$i][$j][$k]->length==2 && $seatsleep[$i][$j][$k]->width==1)
                    {

                        if(!strcmp($seatsleep[$i][$j][$k]->available,'true'))    
                        {
           
                           // $seatsleep[$i][$j][$k]->fare = $_REQUEST['buspricemarkup'];
							if(!strcmp($seatsleep[$i][$j][$k]->ladiesSeat,'true'))
                            {
                            echo "<td><div class='containers c_b'><label for='hsleep".$i.$j.$k."'><img name='hsleep".$y."'src='".base_url()."seat_images/non_sleeper_ac_ladies.jpg' title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/>
                            <input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep".$i.$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapladieshsleeper(this.checked,".$y++.")' style='visibility:hidden'/></label></div></td>";
                            }

                            else
                            {
                            echo "<td><div class='containers c_b'><label for='hsleep".$i.$j.$k."'><img name='hsleep".$y."'src='".base_url()."seat_images/volvo_sleeper_vacant.jpg' title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' name='chkchk[]' class='checkbox' id='hsleep".$i.$j.$k."' value='".$seatsleep[$i][$j][$k]->name."'onclick='swaphsleeper(this.checked,".$y++.")' style='visibility:hidden'/></label></div></td>";
                            }
                        }
                        else
                        {
                        echo "<td><div class='containers_un'><img src='".base_url()."seat_images/volvo_sleeper_unavailable.jpg' /></div></td>";
                        } 

                    }
      
                    elseif ($seatsleep[$i][$j][$k]->length==1 && $seatsleep[$i][$j][$k]->width==2) 
                    {
       
                        if(!strcmp($seatsleep[$i][$j][$k]->available,'true'))    
                        {
                           // $seatsleep[$i][$j][$k]->fare = $_REQUEST['buspricemarkup'];
							if(!strcmp($seatsleep[$i][$j][$k]->ladiesSeat,'true'))
                            {
                            echo "<td><div class='containers_vert c_b'><label for='vsleep".$i.$j.$k."'><img name='vsleep".$y."'src='".base_url()."seat_images/non_ac_vertical_sleeper_ladies.jpg' title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep".$i.$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapvsleeper(this.checked,".$y++.")' style='visibility:hidden'/></label></div></td>";
                            }

                            else
                            {
                                echo "<td><div class='containers_vert c_b'><label for='vsleep".$i.$j.$k."'><img name='vsleep".$y."'src='".base_url()."seat_images/volvo_sleeper_vertical_vacant.jpg' title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='vsleep".$i.$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapvsleeper(this.checked,".$y++.")' style='visibility:hidden'/></label></div></td>";
                            }
                        }
                        else
                       {
                        echo "<td><div class='containers_vert_un'><img src='".base_url()."seat_images/volvo_sleeper_vertical_unavailable.jpg'/></div></td>";
                       } 

                    }
                    elseif ($seatsleep[$i][$j][$k]->length==1 && $seatsleep[$i][$j][$k]->width==1) 
                    {
                        $storeseatname=$seatsleep[$i][$j][$k]->name;

                        if(!strcmp($seatsleep[$i][$j][$k]->available,'true'))
                        {
							//$seatsleep[$i][$j][$k]->fare = $_REQUEST['buspricemarkup'];
						   if(!strcmp($seatsleep[$i][$j][$k]->ladiesSeat,'true'))
                            {
                            echo "<td><div class='containers c_b'><label for='seat".$j.$k."'><img name='img".$l."' id='".$k.$j."' src='".base_url()."seat_images/non_ac_seater_ladies.jpg' title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover'/><input type='checkbox' class='checkbox' name='chkchk[]' id='seat".$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapladiesseater(this.checked,".$l++.")' style='visibility:hidden'/></label></div></td>" ;

                            } 
                             else
                            {
                           
                             echo "<td><div class='containers c_b'><label for='seat".$j.$k."'><img name='img".$l."' id='".$k.$j."'src='".base_url()."seat_images/ac_semi_sleeper_vacant.jpg' title='Seat Number:".$seatsleep[$i][$j][$k]->name." | Fare: ".$seatsleep[$i][$j][$k]->fare."' class='imagehover' /><input  type='checkbox' class='checkbox' name='chkchk[]' id='seat".$j.$k."' value='".$seatsleep[$i][$j][$k]->name."' onclick='swapseater(this.checked,".$l++.")' style='visibility:hidden'/></label></div></td>";

                            }  
                        }
                        else
                        {
                            echo "<td><div class='containers_un'><img src='".base_url()."seat_images/ac_semi_sleeper_unavailable.jpg'/></div></td>";
                        }    
                    }

                }

                if(empty($seatsleep[$i][$j][$k]))
                {
                  
                    if (empty($seatsleep[$i][$j])) 
                    {
                    echo "<td><img src='".base_url()."seat_images/no_seat.jpg'/></td>";
                    }
                    elseif (!empty($seatsleep[$i][$j])) 
                    {
                    echo "<td></td>";
                    }
                  
                
                }



            }

        echo "</tr>";
        }
        echo "</tbody></table>";
}




function generateLayoutSeater($rowcountseater,$seatperrowcount,$s)
{
    if(!empty($s))
   { 
    echo "<table frame='box1'><tbody>";
    $k=0;
    for ($i=0; $i <=$rowcountseater ; $i++) 
    { 
        echo "<tr>";
  
        for ($j=0; $j <= $seatperrowcount ; $j++) 
        { 
    
            if(!empty($s[$i][$j]))
            { 
                $storeseatname=$s[$i][$j]->name;
				//$s[$i][$j]->fare = $_REQUEST['buspricemarkup'];
                if(!strcmp($s[$i][$j]->available,'true'))    

                {
                   if(!strcmp($s[$i][$j]->ladiesSeat,'true'))
                   {
                    echo "<td><div class='containers c_b'><label for='seat".$i.$j."'><img name='img".$k."' id='".$j.$i."' src='".base_url()."seat_images/non_ac_seater_ladies.jpg' title='Seat Number:".$s[$i][$j]->name." | Fare: ".$s[$i][$j]->fare."' class='imagehover'/>
                    <input type='checkbox' class='checkbox' name='chkchk[]' id='seat".$i.$j."' value='".$s[$i][$j]->name."' onclick='swapladiesseater(this.checked,".$k++.")' style='visibility:hidden'/></label></div></td>" ;
                   }

                    else
                    {
               
                 echo "<td><div  class='containers c_b'><label for='seat".$i.$j."'><img name='img".$k."' id='".$j.$i."' src='".base_url()."seat_images/ac_semi_sleeper_vacant.jpg' title='Seat Number:".$s[$i][$j]->name." | Fare: ".$s[$i][$j]->fare."' class='imagehover' /><input  type='checkbox' class='checkbox' name='chkchk[]' id='seat".$i.$j."' value='".$s[$i][$j]->name."' onclick='swapseater(this.checked,".$k++.")' style='visibility:hidden'/></label></div></td>";

                    }
                }
                else
                {
                        echo "<td><div class='containers_un'><img src='".base_url()."seat_images/ac_semi_sleeper_unavailable.jpg'/></div></td>";
                }  

            }

            if(empty($s[$i][$j]))
            {
          
                if (empty($s[$i])) 
                {
                    echo "<td><img src='".base_url()."seat_images/no_seat.jpg'/></td>";
                }
            elseif (!empty($s[$i])) 
            
              {
                echo "<td></td>";
              }
          
            }

        }
  
    echo "</tr>";
    }
echo "</table><br>";
}

}

?>

    <?php

    echo "<input type='hidden' name='chosensource' class='btnclass' value='".$sourceid."'/>";
    echo "<input type='hidden' name='chosendestination' class='btnclass' value='".$destinationid."'/>";      
    echo "<input type='hidden' name='chosenbus' class='btnclass' value='".$chosenbusid."' /></td>";   
    ?>