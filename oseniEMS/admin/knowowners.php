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
           $currentuser = $_SESSION['username'];


      ?>

        	<div class="form-group">
            <input type="hidden" name="username" class="form-control" placeholder="Link To BioData Of Vendor" required value="<?php echo $_SESSION['username']; ?>">
         	 </div>



      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Event Owner Name </th>
            <th>Proposed Event Date</th>
            <th>Event Type</th>
            <th>Planner Name</th>
            <th>Owner Image </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
            <?php
              $query_run =mysqli_query($connection, "SELECT * FROM eventowner WHERE vendorContacted ='$currentuser' AND vendor_needed='yes' ");
              echo $currentuser;
              if (mysqli_num_rows($query_run) >0) {
                while($row = mysqli_fetch_assoc($query_run)){
                  ?>
          <tr>
            <td> <?php echo $row['id']; ?></td>
            <td> <?php echo $row['owner_name']; ?></td>
            <td> <?php echo $row['event_date']; ?></td>
            <td> <?php echo $row['event_type']; ?> </td>
            <td> <?php echo $row['planner_name']; ?> </td>
            <td> <?php echo '<img src="upload/'.$row['owner_image'].'"  alt="Image Not Available" class="rounded-circle img-fluid" width="90px" height="90px">' ?> </td>
            <td>
                <form action="registeredit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
              






                <form action="code.php" method="post">
                 <?php  echo $currentuser; ?>
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
          <?php
              }
            }
            else{
                echo "No Record Found";
             }    
          ?>
        
        </tbody>
      </table><


<?php include('includes/footer.php'); ?> 