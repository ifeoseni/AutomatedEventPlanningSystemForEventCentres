<?php
include('security.php');
include('includes/header.php'); 
 
 ?>

<style type="text/css">
  canvas{
    height:10px;
  }
</style>

 <?php
$username = $_SESSION['username'];
$checkusertype= mysqli_query($connection, "SELECT * FROM event WHERE username= '$username' || email= '$username' ");
$accessType = mysqli_fetch_assoc($checkusertype)['usertype'];
$getVendorUserName = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM event WHERE username= '$username' || email= '$username' "))['username'];

 
  $currentRating = 0 ; $rated_by = 0;
  //echo $accessType;
 
if($accessType == 'Event Vendor'){
  $vendorDetails= mysqli_query($connection, "SELECT * FROM vendor WHERE username= '$getVendorUserName'");
  include('includes/vendornavbar.php');
 
  while( $vendorRating = mysqli_fetch_assoc($vendorDetails) ){
    $currentRating =  $vendorRating['vendor_rating'];
    $rated_by = $vendorRating['rated_by'];

    if($currentRating < 2.5){
     echo "<h2 class='text-center text-danger'> You were rated ".$currentRating." by/at ". $rated_by." people/times</h2>"; 
    }else if($currentRating >= 2.5 && $currentRating < 3.5){
      echo "<h2 class='text-center text-warning'> You were rated ".$currentRating." by/at ". $rated_by." people/times</h2>"; 
    }else if($currentRating >= 3.5 && $currentRating < 4.5){
       echo "<h2 class='text-center text-primary'> You were rated ".$currentRating." by/at ". $rated_by." people/times</h2>";  
    }else if($currentRating >= 4.5 && $currentRating <= 5){
       echo "<h2 class='text-center text-success'> You were rated ".$currentRating." by/at ". $rated_by." people/times</h2>";
    }else{
      echo "Your rating seems to have issues";
    }
  }

    
  //}
  //  echo "<h2 class='text-center '>".$currentRating."</h2>";
}else if($accessType == 'admin'){
  include('includes/navbar.php');
  $vendorDetails= mysqli_query($connection, "SELECT * FROM vendor");
  echo "<table border='1' class='table  table-striped'>";
  echo "<legend class='text-dark text-center font-weight-bold'>Ranking and Rating Of Vendors</legend>";
  while( $vendorRating = mysqli_fetch_assoc($vendorDetails) ){

    $currentRating =  $vendorRating['vendor_rating'];
    $rated_by = $vendorRating['rated_by'];
    $vendorName= $vendorRating['vendor_name'];

    if($currentRating < 1.5){
     echo "<tr class='text-center text-danger font-weight-bold'><td> Vendor ".$vendorName." was rated ".$currentRating." by/at ". $rated_by." people/times</td></tr>"; 
    }else if($currentRating >= 1.5 && $currentRating < 2.5){
      echo "<tr class='text-center text-warning font-weight-bold'><td> Vendor ".$vendorName." was rated ".$currentRating." by/at ". $rated_by." people/times</td></tr>"; 
    }else if($currentRating >= 2.5 && $currentRating < 4){
       echo "<tr class='text-center text-primary font-weight-bold'><td> Vendor ".$vendorName." was rated ".$currentRating." by/at ". $rated_by."  people/times</td></tr>";  
    }else if($currentRating >= 4 && $currentRating <= 5){
       echo "<tr class='text-center text-success font-weight-bold'><td> Vendor ".$vendorName." was rated ".$currentRating." by/at ". $rated_by." people/times</td></tr>";
    }else{
      echo "Your rating seems to have issues";
    }
  }
  echo "</table>";

}else{
  $_SESSION['status']=  "You can rate your vendors here";
  header("location:ratevendor.php");
}


?>

<h5 class="text-dark text-center" >
  <br/>
 <span>Poor Performing Vendor (0- 1.5) <canvas class="bg-danger" ></canvas> </span><br/>
 <span>Average Performing Vendor (1.5 - 2.49) <canvas class="bg-warning"></canvas> </span><br/>
  <span>Above Average Performing Vendor(2.5 - 3.9) <canvas class="bg-primary"></canvas> </span><br/>
   <span>Excellently Performing Vendor (4.0 - 5.0)<canvas class="bg-success"></canvas> </span><br/>
</h5>

<?php include('includes/footer.php'); ?>