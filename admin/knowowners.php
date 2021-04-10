<?php
include('security.php');
include('includes/header.php'); 
include('includes/vendornavbar.php'); 
?>
      	<?php
         if (isset($_SESSION['success']) && $_SESSION['success'] !='') {
           echo '<h2 class="bg-primary text-white">'. $_SESSION['success'].'</h2>';
           unset($_SESSION['success']);
            # code...
         }
          if (isset($_SESSION['status']) && $_SESSION['status'] !='') {
            echo "<h2 class='bg-danger'>". $_SESSION['status']."</h2>";
            unset($_SESSION['status']);
            # code...
          }


      ?>

        	



      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Owner Registered Email Address</th>
            <th> Event Owner Name </th>
            <th>Proposed Event Date</th>
            <th>Contact Number</th>
            <th>Contact Email Address</th>
            <th>Event Type</th>
            <th>Planner Name</th>
            <th>Owner Image </th>
            <th>Agree Contract </th>
            <th>Reject Work</th>
          </tr>
        </thead>
        <tbody>

            <?php
            $currentuser =  $_SESSION['username'];
            $otherDetail = mysqli_fetch_assoc(mysqli_query($connection,"SELECT username FROM event WHERE email = '$currentuser' "))['username'];

            $details = mysqli_query($connection, "SELECT userdetail FROM ownervendor WHERE vendorDetail ='$currentuser' || vendorDetail= '$otherDetail' AND agreement ='interested'");
              
              $ownersDetails = array(); $interestedOwnersNumbers = mysqli_num_rows($details);
             // echo $interestedOwnersNumbers;

              while($get =mysqli_fetch_assoc($details)['userdetail']){
                array_push($ownersDetails,"'".$get."'");
              }


              $newarray = implode(",", $ownersDetails); //makes format 'hi', 'there', 'everybody' 
             
              // count($newarray);
//SELECT * FROM myTable WHERE title IN ($);
              if ($interestedOwnersNumbers >0) {

                // for ($i=0; $i < $interestedOwnersNumbers; $i++) { 
                 
                 $getOwnerDetails = mysqli_query($connection,"SELECT * FROM eventowner where username in ($newarray)");//('".implode("','",array_map('mysql_real_escape_string', $ownersDetails))."')" ); 
                
                 while($seeowners = mysqli_fetch_assoc($getOwnerDetails)){
                ?>

                <tr>
            <td> <?php echo $seeowners['username']; ?></td>
            <td> <?php echo $seeowners['owner_name']; ?></td>
            <td> <?php echo $seeowners['proposed_event_date']; ?></td>
            <td> <?php echo $seeowners['phone_number']; ?></td>
            <td> <?php echo $seeowners['username']; ?></td>
            <td> <?php echo $seeowners['event_type']; ?> </td>
            <td> <?php echo $seeowners['planner_name']; ?> </td>
            <td> <?php echo '<img src="upload/'.$seeowners['owner_image'].'"  alt="Image Not Available" class="rounded-circle img-fluid" width="90px" height="90px">' ?> </td>
            <td>
                <form action="code.php" method="post">
                    <input type="hidden" name="get_owner" value="<?php echo $seeowners['username']; ?>">
                    <input type="hidden" name="current_user" value="<?php echo $_SESSION['username'] ?>">
                    <button  type="submit" name="accept_work" class="btn btn-success"> Accept Work</button>
                </form>
            </td>
            <td>
              






                <form action="code.php" method="post">
                    <input type="hidden" name="get_owner" value="<?php echo $seeowners['username']; ?>">
                    <input type="hidden" name="current_user" value="<?php echo $_SESSION['username'] ?>">
                  <button type="submit" name="reject_offer" class="btn btn-danger"> Reject Offer</button>
                </form>
            </td>
          </tr>


                <?php
                // }
                }
              }
            else{
                echo "<p class='text-dark text-center font-weight-bold'>No Event Owner Has Shown Interest Recently</p>";
             }    
          ?>
        
        </tbody>
      </table>


<?php include('includes/footer.php'); ?> 