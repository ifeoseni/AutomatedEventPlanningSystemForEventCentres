<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
?>
      <form action="code.php" method="POST" enctype="multipart/form-data">
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
            $eventowner = $_SESSION['username'];  //echo $user;
          
             
      ?>



 <?php
          $query = "SELECT * FROM vendor";  
          $query_run = mysqli_query($connection,$query);    

          if (mysqli_num_rows($query_run) > 0)
          {
           
                 
            
             ?>


        
      <table class="table table-bordered container-fluid" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
           <!--  <th>Check</th> -->
           <!--  <th> ID </th> -->
            <th> Vendor Name </th>
            <th>Type Of Service Rendered </th>
            <th>Service Category</th>
            <th>Vendor Phone Number</th>
            <th>Vendor Email</th>
            <th>Current Vendor Rating</th>
            <th>Image Uploaded By Vendor</th>            
            <th>Contact Vendor </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
            <?php
              // $vendorContacted = array();
              while($row = mysqli_fetch_assoc($query_run))
              {

                 // for($x = 0; $x < mysqli_num_rows($query_run); $x++) {
                 //   $vendorContacted[$x] = $row['username'];                    
                 // }

             ?>
              <tr>
                  <td> <?php echo $row['vendor_name']; ?></td>
                  <td> <?php echo $row['vendor_service']; ?></td>
                  <td> <?php echo $row['vendor_category']; ?> </td>
                  <td> <?php echo $row['vendor_phone']; ?></td>
                  <td> <?php echo "<a href='malito:".$row['vendor_email']."'>".$row['vendor_email']."</a>"   ?></td>
                  <td> <?php echo $row['vendor_rating']; ?> </td>
                  <td> <?php echo '<img src="upload/'.$row['vendor_image'].'"  alt="" width="90px;" height="90px;" class="rounded-circle">'?></td>
                  <td>
                 <form action="code.php" method="post">
                      <input type="hidden" name="vendorContacted" value="<?php echo $row['username'];  ?>">
                      <button  type="submit" name="bookVendor" class="btn btn-success"> Book Vendor</button> <!-- Go to faculty_edit.php -->
                  </form>
                 <td>
                  <form action="code.php" method="post">
                  <button type="submit" name="notInterested" class="btn btn-danger"> Hide Vendor</button>
                </form>
            
          </tr>
            <?php
              }

              // for($x = 0; $x < mysqli_num_rows($query_run); $x++) {
              //     echo $vendorContacted[$x]; 

              //   }
              //   echo count($vendorContacted);
              
            ?>
          
         
        
        </tbody>
      </table>
       <?php
            } 
          else
          {
            echo "No record found";
          } 
        ?>





