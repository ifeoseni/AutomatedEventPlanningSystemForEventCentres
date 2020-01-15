<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 

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
          
          $username = $_SESSION['username'];
          $getOwnerDetails = "SELECT * FROM eventowner where username = '$username'  ";  
          $query_run = mysqli_query($connection,$getOwnerDetails);  
          $row = mysqli_fetch_assoc($query_run);
          $getVendorUserName = $row['vendorContacted'];
          if (empty($getVendorUserName)) {
              echo "<div class='text-bold text-center' style='top:90px;position:relative'>";
              echo "<h3 class='' >Sorry, you have not shown interest in getting a vendor. Please update your profile to request for one</h3>";
                echo "<button class='btn btn-primary' style='!important;'><a href='owner.php' class='text-white' >Click Here To Update Profile</a></button>";
              echo "</div>";
          }

          $getVendorProfile = "SELECT * FROM vendor WHERE username ='$getVendorUserName'";
          $seeVendor= mysqli_query($connection,$getVendorProfile);

          while ($got = mysqli_fetch_assoc($seeVendor)) {
          ?>

              <div class="container-fluid">
                <form method="POST" action="code.php">
                <div class="form-group">
                 <?php echo '<img src="upload/'.$got['vendor_image'].'"  alt="" width="90px;" height="90px;" class="rounded-circle float-right" style="display:block;">'?>
                 </div>
                 <p style="height: 90px;">
                  <div class="form-group">
                  <input type="hidden" name="username" class="form-control" placeholder="Vendor Username" required value="<?php echo $got['username']; ?>" readonly="">
                </div>
                <div class="form-group">
                  <label>Vendor Name</label>
                  <input type="text" name="vendor_name" class="form-control" placeholder="Event Owner Name Goes Here" required value="<?php echo $got['vendor_name']; ?>" readonly="">
                </div>
                <div class="form-group">
                  <label>Vendor Service</label>
                  <input type="text" name="vendor_service" class="form-control" placeholder="Event Owner Name Goes Here" required value="<?php echo $got['vendor_service']; ?>" readonly="">
                </div>
                <div class="form-group">
                  <label>Vendor Category</label>
                  <input type="text" name="vendor_category" class="form-control" placeholder="Event Owner Name Goes Here" required value="<?php echo $got['vendor_category']; ?>" readonly="">
                </div>
                <div class="form-group">
                  <label>Vendor Phone</label>
                  <input type="text" name="vendor_phone" class="form-control" placeholder="Event Owner Name Goes Here" required value="<?php echo $got['vendor_phone']; ?>" readonly="">
                </div>
                <div class="form-group">
                  <label>Vendor Email</label>
                  <input type="text" name="vendor_email" class="form-control" placeholder="Event Owner Name Goes Here" required value="<?php echo $got['vendor_email']; ?>" readonly="">
                </div>      
                <div class="form-group">
                  <label>Rate Vendor</label>
                  <input type="number" name="rate_vendor" class="form-control" placeholder="Please Give A Value Between 0-10. Note only integer values are allowed" required value="" min="0" max="10">
                </div>
                  <button type="submit" name="submitrating" class="btn btn-primary"> Submit Vendor Rating</button>
                </form>
              </div>
            <?php
              }


?>






