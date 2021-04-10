<?php 
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
 $username = $_SESSION['username'];

  $interestedTime = array();
     $hall = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM eventowner WHERE username='$username'"))['event_space_selected'];
     $getDate =mysqli_query($connection,"SELECT * FROM eventowner WHERE event_space_selected ='$hall' ORDER BY proposed_event_date");// WHERE username='$username'");
            if ($getDate) {
              echo "<table>";
                //for ($i=0; $i < mysqli_num_rows($getDate); $i++) { 

                  while($date = mysqli_fetch_assoc($getDate)){
                     echo "<tr>";
                     echo "<td class='font-weight-bold text-primary'>".$date['proposed_event_date']."</td>";

                   // $date = mysqli_fetch_assoc($getDate)["proposed_event_date"];
                    // 
                       array_push($interestedTime, $date['proposed_event_date']);
                    // }
                    $checkPayment = mysqli_query($connection,"SELECT amount_paid FROM payment_made WHERE event_date='date(d m Y)'");
                   

                    
                    if(mysqli_fetch_assoc($checkPayment)['amount_paid'] > 0) {
                    // echo "<td class='text-danger font-weight-bold'>Yes</td>";
                    }else{
                     // / echo "<td class='text-success font-weight-bold'>No payment has been made yet</td>";
                    }
                    
                    echo "<tr>";
                    
                  }
                  echo "</table>";
               // }
            } 


for ($i=0; $i < count($interestedTime); $i++) { 
                echo $interestedTime[$i]."<br/>";
            }

      $Day = array();//to store the dates selected from the database into an array
      $Month =array();
      $Year = array();

      

      for ($i=0; $i < count($interestedTime); $i++) { 
        $Day[$i] = explode('-', $interestedTime[$i])[2];//splits date into day only
        $Month[$i] = explode('-', $interestedTime[$i])[1];//splits date into month only
        $Year[$i] = explode('-', $interestedTime[$i])[0];//splits date into day only

      }

     // echo  explode('-', $interestedTime[2][2]);

   

      for ($i=0; $i < count($Day); $i++) { 
        echo $Day[$i];
      }
  
    echo count($interestedTime);
            
?>
