<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">
  
  <!-- DataTables Example -->
  <div class="card shadow mb-4">
    <div class="card header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Edit Vendor Category </h6>
    </div>  
  <div class="card-body">

<?php

if (isset($_POST["edit_vendor_category"])) {

  $id = $_POST['edit_id'];

  $query = "SELECT * FROM vendorcategory WHERE id = '$id'";
  $query_run = mysqli_query($connection,$query);  

  foreach ($query_run as $row) {
    ?>

     <form action="code.php" method="POST">

          
           <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
          <div class="form-group">
          <label>Vendor Category</label>
          <input type="text" name="edit_vendor_category" class="form-control" placeholder="Edit The Vendor Category" value="<?php echo $row['vendor_category']; ?>">
         </div>
        
        
         
          <a href="manage_vendor_category.php" class="btn btn-danger">Cancel</a>
          <button type="submit" name="update_vendor_category" class="btn btn-primary">Update</button>
       
      </form>
    </div>

      
    <?php    
  }
}

?>
       

  </div>
</div>

<!-- container fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>