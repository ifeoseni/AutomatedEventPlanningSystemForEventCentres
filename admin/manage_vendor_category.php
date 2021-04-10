<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="VENDORCATEGORY" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD ANOTHER VENDOR CATEGORY</h5>
       



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">
          <div class="form-group">
            <label>Add New Category</label>
            <input type="text" name="vendor_category" class="form-control" placeholder="Add category here" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="add_vendor_category" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Vendor Categories Available On The Platform
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VENDORCATEGORY" >
              ADD NEW VENDOR CATEGORY
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
          $query = "SELECT * FROM vendorcategory";  
          $query_run = mysqli_query($connection,$query);      
        ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> VENDOR CATEGORY </th>
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
            <td> <?php echo $row['vendor_category']; ?></td>
            <td>
               <form action="edit_vendor_category.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_vendor_category" class="btn btn-success"> EDIT</button>
                </form>
            <td>
                  <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_vendor_category" class="btn btn-danger"> DELETE</button>
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