<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="addeventspace" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Event Space</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> EventSpace ID </label>
                <input type="text" name="spaceid" class="form-control" placeholder="Enter Space Code Name">
            </div>
             <div class="form-group">
                <label> Event Space Name </label>
                <input type="text" name="spacename" class="form-control" placeholder="Enter Space Name">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="spacedescription" class="form-control" placeholder="Describe Properties of Space">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="Number" name="spaceprice" class="form-control" placeholder="How much does the space cost In Naira">
            </div>
            <div class="form-group">
                <label>Space Capacity</label>
                <input type="text" name="spaceseat" class="form-control" placeholder="Space Capacity">
            </div>
            <div class="form-group">
                <label>ManagerName</label>
                <input type="text" name="spacemanager" class="form-control" placeholder="General Manager Assigned To The Space">
            </div>
        
        </div>
        <input type="hidden" name="usertype" value="admin">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add_event_space" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Event Space 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addeventspace" >
              Add 
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
            $connection = mysqli_connect("localhost","root","","adminpanel");
          $query = "SELECT * FROM eventspace";  
          $query_run = mysqli_query($connection,$query);      
        ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th> Event Space ID </th>
            <th> Event Space Name </th>
            <th>Description </th>
            <th>Price </th>
            <th>Manager Name</th>
            <th>Space Seat</th>
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
            <td> <?php echo $row['id']; ?></td>
            <td> <?php echo $row['spaceid']; ?></td>
            <td> <?php echo $row['spacename']; ?></td>
            <td> <?php echo $row['spacedescription']; ?></td>
            <td> <?php echo $row['spaceprice']; ?> </td>
            <td> <?php echo $row['spacemanager']; ?> </td>
            <td> <?php echo $row['spaceseat']; ?> </td>
            <td>
                <form action="addcentre_edit.php" method="post">
                    <input type="hidden" name="editspace_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_space" class="btn btn-success"> EDIT Space</button>
                </form>
            </td>
            <td>
              






                <form action="code.php" method="post">
                  <input type="hidden" name="deletespace_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_space" class="btn btn-danger"> DELETE</button>
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