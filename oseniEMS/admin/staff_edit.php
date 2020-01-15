<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">
	
	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Edit Budget Item</h6>
		</div>	
	<div class="card-body">

<?php

if (isset($_POST["edit_staff_btn"])) {

	$id = $_POST['edit_id'];

         

	$query = "SELECT * FROM staff WHERE id = '$id'";
	$query_run = mysqli_query($connection,$query);	

	foreach ($query_run as $row) {
		?>

		 <form action="code.php" method="POST" enctype="multipart/form-data">        
		 	<input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
             <label>Edit Staff ID</label>
            <input type="text" name="staff_id" class="form-control" value="<?php echo $row['staff_id']; ?>">
          	</div>
         	 <div class="form-group">
            <label>Edit Staff Name</label>
            <input type="text" name="staff_name" class="form-control" value="<?php echo $row['staff_name']; ?>">
         	 </div>
         	 <div class="form-group">
            <label>Edit Staff Phone</label>
            <input type="text" name="staff_phone" class="form-control" value="<?php echo $row['staff_phone']; ?>">
	          </div>
	          <div class="form-group">
            <label>Edit Staff Email </label>
            <input type="text" name="staff_email" class="form-control" value="<?php echo $row['staff_email']; ?>">
         	 </div>
         	 <div class="form-group">
            <label>Edit Staff Position </label>
            <input type="text" name="staff_position" class="form-control" value="<?php echo $row['staff_position']; ?>">
         	 </div>
              <div class="form-group">
            <label>Change Staff Image </label>
            <input type="file" name="staff_image"  id="staff_image" value="<?php echo $row['image'] ?> " class="form-control" required>
          </div>
         
          <a href="staff_edit.php" class="btn btn-danger">Cancel</a>
          <button type="submit" name="update_staff_details" class="btn btn-primary">Update This Staff Information</button>
       
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