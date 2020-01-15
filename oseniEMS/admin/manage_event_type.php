<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="EVENTTYPE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD ANOTHER EVENT TYPE</h5>
       



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">
          <div class="form-group">
            <label>Add New Event Type</label>
            <input type="text" name="event_type" class="form-control" placeholder="Enter New Event Type" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="add_event_type" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Event Types Added So Far
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EVENTTYPE" >
              ADD NEW EVENT TYPE
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
          $query = "SELECT * FROM eventtype";  
          $query_run = mysqli_query($connection,$query);      
        ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Event Type </th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
            <?php
              if (mysqli_num_rows($query_run) >0)
               {
                while($row = mysqli_fetch_assoc($query_run))
                {
                  ?>
          <tr>
            <td> <?php echo $row['event_type']; ?></td>
            <td>
               <form action="edit_event_type.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_event_type" class="btn btn-success"> EDIT</button>
                </form>
            <td>
                  <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_event_type" class="btn btn-danger"> DELETE</button>
                </form>
                </form>
            </td>
          </tr>
          <?php
              }
            }
            else{
                echo "No Event Type Found";
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