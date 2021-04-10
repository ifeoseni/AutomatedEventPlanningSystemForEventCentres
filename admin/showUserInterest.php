<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 

include('allInterest.php');

 if (isset($_SESSION['success']) && $_SESSION['success'] !='') { echo '<h2 class="bg-primary text-white">'. $_SESSION['success'].'</h2>';  unset($_SESSION['success']); }
 if (isset($_SESSION['status']) && $_SESSION['status'] !='') { echo "<h2 class='bg-danger'>". $_SESSION['status']."</h2>"; unset($_SESSION['status']); }

 $username = $_SESSION['username'];
 $hall = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM eventowner WHERE username='$username'"))['event_space_selected'];
            
?>

  <div class="table-responsive">

    <table class="table  table-striped table-bordered">
      
    <legend class="text-primary text-center font-weight-bold text-underline ">This Shows Calendar For <?php echo $hall; ?> At Our Event Centre</legend>
    <thead class="text-dark font-weight-bold">
      <th>Date People Are Interested In </th>
      <th>User Has Made Payment For The Event Centre</th>
    </thead>
    <tbody>
      <?php
        $getDate =mysqli_query($connection,"SELECT * FROM eventowner WHERE event_space_selected ='$hall' ORDER BY proposed_event_date");// WHERE username='$username'");
            if ($getDate) {
              while($date = mysqli_fetch_assoc($getDate)){
                echo "<tr>";
                echo "<td class='font-weight-bold text-primary'>".$date['proposed_event_date']."</td>";

                $date = $date['proposed_event_date'];
                $checkPayment = mysqli_query($connection,"SELECT amount_paid FROM payment_made WHERE event_date='$date' AND (username  != '$username')");
                if(mysqli_fetch_assoc($checkPayment)['amount_paid'] > 0) {
                 echo "<td class='text-dark font-weight-bold'>Payment has been made by another user.</td>";
                }else{
                  $checkPayment = mysqli_query($connection,"SELECT amount_paid FROM payment_made WHERE event_date='$date' AND username  = '$username'");
                   if(mysqli_fetch_assoc($checkPayment)['amount_paid'] > 0) {
                     echo "<td class='text-success bg-dark font-weight-bold'>You have made payment for this day</td>";
                    }else{
                      echo "<td class='text-danger bg-warning font-weight-bold'>No payment has been made yet but a user is interested. It is still available to whoever pays first</td>";
                    }
                  
                }
                echo "<tr>";
                
              }
            } 
      ?>
    </tbody>
  </table>    
  



  </div>
        

<?php include('includes/footer.php'); ?> 