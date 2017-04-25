   <?php
       
    include_once "library/OAuthStore.php";
    include_once "library/OAuthRequester.php";
    include_once "SSAPICaller.php";


   $sourceid=$_GET['sourceList'];
  $destid=$_GET['destinationList'];
  $date=$_GET['datepicker'];

  
  $result =getAvailableTrips($sourceid,$destid,$date); 
 
  $result2[]=json_decode($result);
  echo json_encode(array('MyVals' => $result2));
  
  exit;  

?>