<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">
	
	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card header py-3">
			<h6 class="m-0 font-weight-bold text-primary">About Us Page</h6>
		</div>	
	<div class="card-body">

<?php
$connection =mysqli_connect("localhost","root","","adminpanel");

if (isset($_POST["edit_about"])) {

	$id = $_POST['edit_id'];

	$query = "SELECT * FROM abouts WHERE id = '$id'";
	$query_run = mysqli_query($connection,$query);	

	foreach ($query_run as $row) {
		?>

		 <form action="code.php" method="POST">

        
		 	<input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
            <label>Title</label>
            <input type="text" name="edit_title" class="form-control" placeholder="Enter Title" value="<?php echo $row['title']; ?>">
          	</div>
         	 <div class="form-group">
            <label>Sub Title</label>
            <input type="text" name="edit_subtitle" class="form-control" placeholder="Enter Sub Title" value="<?php echo $row['subtitle']; ?>">
         	 </div>
         	 <div class="form-group">
            <label>Description</label>
            <input type="text" name="edit_description" class="form-control" placeholder="Enter Description" value="<?php echo $row['description']; ?>">
	          </div>
	          <div class="form-group">
            <label>Links</label>
            <input type="text" name="edit_links" class="form-control" placeholder="Enter links" value="<?php echo $row['links']; ?>">
         	 </div>
        
        
         
          <a href="aboutus.php" class="btn btn-danger">Cancel</a>
          <button type="submit" name="update_about" class="btn btn-primary">Update</button>
       
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