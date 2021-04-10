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
          $query = "SELECT  * FROM vendor ";  
          $query_run = mysqli_query($connection,$query);    

          if (mysqli_num_rows($query_run) > 0)
          {
           
                 
            
             ?>


        
      <table class="table table-bordered container-fluid" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-secondary text-white">
          <tr>
           <!--  <th>Check</th> -->
           <!--  <th> ID </th> -->
            <th> Vendor Name </th>
            <th>Type Of Service Rendered </th>
            <th>Service Category</th>
            <th>Vendor Phone Number</th>
            <th>Vendor Email</th>
            <th> Price Range Of Service Offered In Naira</th>
            <th>Current Vendor Rating</th>                
            <th>Image Uploaded By Vendor</th> 
            <th>Contact Vendor </th>    
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
                if ($row['vendor_rating'] == 0) {
                 $row['vendor_rating'] = "No event owner has rated this vendor";
                }
                if ($row['price_range'] == "") {
                 $row['price_range'] = "Value not given by vendor";
                }

             ?>
              <tr>
                  <td> <?php echo $row['vendor_name']; ?></td>
                  <td> <?php echo $row['vendor_service']; ?></td>
                  <td> <?php echo $row['vendor_category']; ?> </td>
                  <td> <?php echo $row['vendor_phone']; ?> / <a href="<?php echo 'https://wa.me/+234'.$row['vendor_phone'];?>">Try contacting via WhatsApp</a></td>
                  <td> <?php echo "<a href='malito:".$row['vendor_email']."'>".$row['vendor_email']."</a>"   ?></td>
                  <td> <?php echo $row['price_range']; ?></td>
                  <td> <?php echo $row['vendor_rating']; ?> </td>
                  <td> <?php echo '<img class="rounded-circle" src="upload/'.$row['vendor_image'].'"  alt="Image not available at the moment" width="90px;" height="90px;" >'?></td>
                  <td>
                 <form action="code.php" method="post">
                      <input type="hidden" name="vendorContacted" value="<?php echo $row['username'];  ?>">
                      <button  type="submit" name="bookVendor" class="btn btn-success"> Show Interest</button> <!-- Go to faculty_edit.php -->
                  </form>
                 </td>

                 
            
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





