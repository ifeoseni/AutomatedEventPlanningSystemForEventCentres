<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create an account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label> First Name </label>
                <input type="text" name="fname" class="form-control" placeholder="Enter your first name">
            </div>
            <div class="form-group">
                <label> Last Name </label>
                <input type="text" name="lname" class="form-control" placeholder="Enter your last name">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
        
        </div>
        <input type="hidden" name="usertype" value="admin">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">All Registered Users
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" >
              Add New User
            </button>
    </h6>
  </div>

  <div class="card-body">

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
    <div class="table-responsive">
        <?php
          $query = "SELECT * FROM event";  
          $query_run = mysqli_query($connection,$query);      
        ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>            
            <th> Username </th>
            <th> Full Name </th>
            <th>Email </th>
           <!--  <th>Password</th> -->
            <th>UserType</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
            <?php
              if (mysqli_num_rows($query_run) >0) {
                while($row = mysqli_fetch_assoc($query_run)){
                  ?>
          <tr>           
            <td> <?php echo $row['username']; ?></td>
            <td> <?php echo $row['firstname']." ".$row['lastname']; ?></td>
            <td> <?php echo $row['email']; ?></td>
           <!--  <td> <?php echo $row['password']; ?> </td> -->
            <td> <?php echo $row['usertype']; ?> </td>
            <td>
                <form action="registeredit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
              






                <form action="code.php" method="post">
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
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>