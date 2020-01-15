<?php
include('security.php');//if removed anyone can access the page
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="modal fade" id="staffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Staff</h5>
       



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
            <label>Staff ID</label>
            <input type="text" name="staff_id" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <label>Staff Name</label>
            <input type="text" name="staff_name" class="form-control" placeholder="Enter Designation" required>
          </div>
          <div class="form-group">
            <label>Staff Phone</label>
            <input type="text" name="staff_phone" class="form-control" placeholder="Enter Description" required>
          </div>
          <div class="form-group">
            <label>Staff Email</label>
            <input type="text" name="staff_email" class="form-control" placeholder="Enter Description" required>
          </div>
          <div class="form-group">
            <label>Staff Position</label>
            <input type="text" name="staff_position" class="form-control" placeholder="Enter Description" required>
          </div>
          <div class="form-group">
            <label>Upload Image</label>
            <input type="file" name="staff_image" id="staff_image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="save_staff" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Staff BioData
          <form action="code.php">
            <!-- <button type="submit" name="delete_multiple_data" class="btn btn-danger">Delete Multiple Data</button> -->
          </form>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#staffModal" >
              ADD
            </button>
    </h6>
  </div>

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
            <th>EDIT </th>
            <th>DELETE </th>
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
                  <td>
                 <form action="staff_edit.php" method="post">
                      <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                      <button  type="submit" name="edit_staff_btn" class="btn btn-success"> EDIT</button> 
                  </form>
                 <td>
                  <form action="code.php" method="post">
                  <input type="hidden" name="staff_delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="staff_delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            
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