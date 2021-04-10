<?php
include('security.php');//if removed anyone can access the page
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
?>


  <div class="card-body">
    <?php
         if (isset($_SESSION['success']) && $_SESSION['success'] !='') 
           {
             echo '<h2 class="bg-primary text-white">'. $_SESSION['success'].'</h2>';
             unset($_SESSION['success']);
              # code...
           }
          if (isset($_SESSION['status']) && $_SESSION['status'] !='') 
          {
              echo "<h2 class='bg-danger'>". $_SESSION['status']."</h2>";
              unset($_SESSION['status']);
              # code...
            }
      ?>
    <div class="table-responsive">
      <?php
          $query = "SELECT * FROM staff";  
          $query_run = mysqli_query($connection,$query);    

          if (mysqli_num_rows($query_run) > 0)
          {
            
             ?>


        
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
           <!--  <th>Check</th> -->
           <!--  <th> ID </th> -->
            <th> Staff ID </th>
            <th>Staff Name </th>
            <th>Staff Phone</th>
            <th>Staff Email</th>
            <th>Staff Position</th>
            <th>Staff Image</th>
          </tr>
        </thead>
        <tbody>
            <?php
              while($row = mysqli_fetch_assoc($query_run))
              {
            ?>
              <tr>
                <!-- <td>
                    <input type="checkbox" onclick="toggleCheckbox(this)" name="" value="<?php echo $row['id']; ?>" <?php echo $row['visible'] == 1 ? "checked" : "" ?> >
                </td> -->
                 <!-- <td> <?php // echo $row['id']; ?></td> -->
                  <td> <?php echo $row['staff_id']; ?></td>
                  <td> <?php echo $row['staff_name']; ?></td>
                  <td> <?php echo $row['staff_phone']; ?> </td>
                  <td> <?php echo $row['staff_email']; ?></td>
                  <td> <?php echo $row['staff_position']; ?></td>
                  <!--   <td> <?php echo $row['images']; ?> </td> -->
                  <td> <?php echo '<img src="upload/'.$row['staff_image'].'"  alt="" width="90px;" height="90px;" class="rounded-circle">'?></td>
                
            
          </tr>
            <?php
              }
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

    </div>
  </div>
</div>

</div>

  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>