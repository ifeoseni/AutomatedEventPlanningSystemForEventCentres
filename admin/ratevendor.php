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
           //$getOwnerDetails = "SELECT * FROM ownerstatus where username in (".implode(',',$username).")";  
          $query_run = mysqli_query($connection,"SELECT * FROM ownervendor where userdetail = '$username'"); 
          $vendordetail = array(); $vendorNumber = mysqli_num_rows($query_run);
          while($row = mysqli_fetch_assoc($query_run)['vendordetail']) {
            array_push($vendordetail,$row );
          }
          
          
          $getVendorStatus = $row['vendordetail'];
          if ($vendorNumber < 1) {
                header("location:bookvendor.php");
              echo "<div class='text-dark text-center' style=''>";
              echo "<h3 class='' >Sorry, you have not shown interest in getting a vendor. Please update your profile to request for one</h3>";
                echo "<button class='btn btn-primary' style='!important;'><a href='owner.php' class='text-white' >Click Here To Update Profile</a></button>";
              echo "</div>";

          }else{
            $getVendors = mysqli_query($connection,"SELECT * FROM ownervendor WHERE userdetail='$username' AND agreement='accepted' ");
            echo "<form method='POST' action='code.php' class='form-inline'>";
              echo "<legend class='text-dark'>Select The Vendor You Wish To Rate. Rating Is Between 1 -5 (Lowest to Highest)</legend>";
             echo "<select name='acceptedvendors'>";

              $getWorkingVendors= array();
              while($vendors = mysqli_fetch_assoc($getVendors)){
                 echo "<option value='".$vendors['vendordetail']."'>".$vendors['vendordetail']."</option>";
                  array_push($getWorkingVendors,"'".$vendors['vendordetail']."'");
              }
             echo "</select>";
             echo "<input type='number' name='ratevendor' placeholder='Rate this vendor between 1-5 ' min='1' max='5' class='mr-2 ml-4 form-group'>";
             echo "<input type='hidden' name='owner' value='$username'>";
             echo "<button class='btn btn-primary' type='submit' name='ratingvendors'>Submit Rating</button>";
            echo "</form>";
           
          }
  ?>
     
      <table class="table table-bordered container-fluid" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-secondary text-white">
    <tr>
      <th>Vendor Main Detail</th>
      <th>Vendor Name</th>
      <th>Vendor Service</th>
      <th>Category</th>
      <th>Price Range</th>
      <th>Vendor Phone Number</th>
      <th>Vendor Email Address</th>
      <th>Vendor Current Rating</th>
    </tr>
  </thead>
    <?php

                 $newarray = implode(",", $getWorkingVendors); 
                 $getVendorsDetails = mysqli_query($connection,"SELECT * FROM vendor WHERE username in ($newarray)");
       while($row = mysqli_fetch_assoc($getVendorsDetails) ){
        ?>
         <tr>
                  <td><?php echo $row['username']; ?> </td>
                 <td><?php echo $row['vendor_name']; ?></td>
                <td><?php echo $row['vendor_service']; ?></td>
                <td><?php echo $row['vendor_category'];?> </td>
                <td><?php echo $row['price_range']; ?></td>
                <td><?php echo $row['vendor_phone']; ?></td>
                <td><?php echo $row['vendor_email']; ?></td>
                <td><?php echo $row['vendor_rating']; ?></td>
          </tr>
          <?php
        }

        


     






    ?>
     


  </table>




<?php
    include('includes/footer.php');     
?>
