<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">
	
	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card header py-3">
			<h6 class="m-0 font-weight-bold text-primary">EDIT Event Space</h6>
		</div>	
	<div class="card-body">

<?php
$connection =mysqli_connect("localhost","root","","adminpanel");

if (isset($_POST["edit_space"])) {

	$id = $_POST['editspace_id'];

	$query = "SELECT * FROM eventspace WHERE id = '$id'";
	$query_run = mysqli_query($connection,$query);	

	foreach ($query_run as $row) {
		?>


			<form action="code.php" method="POST">
				<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
				<div class="form-group">
                <label> EventSpace ID </label>
                <input type="text" name="edit_spaceid" class="form-control" placeholder="Enter Space Code Name" value="<?php echo $row['id'] ?>">
            </div>
             <div class="form-group">
                <label> Event Space Name </label>
                <input type="text" name="edit_spacename" class="form-control" placeholder="Enter Space Name" value="<?php echo $row['spacename'] ?>" required="">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="edit_spacedescription" class="form-control" placeholder="Describe Properties of Space" value="<?php echo $row['spacedescription'] ?>" required="">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="Number" name="edit_spaceprice" class="form-control" placeholder="How much does the space cost In Naira" value="<?php echo $row['spaceprice'] ?>" required="">
            </div>
             <div class="form-group">
                <label> Event Space Capacity </label>
                <input type="text" name="edit_spaceseat" class="form-control" placeholder="Enter Space Capacity" value="<?php echo $row['spaceseat'] ?>" required="">
            </div>
            <div class="form-group">
                <label>ManagerName</label>
                <input type="text" name="edit_spacemanager" class="form-control" placeholder="General Manager Assigned To The Space" value="<?php echo $row['spacemanager'] ?>" required="">
            </div>
	            <a href="addcentre.php" class="btn btn-danger"> CANCEL</a>	
	            <button class="btn btn-primary" type="submit" name="update_centre"> Update</button>
            </form>
    <?php    
	}
}

?>
		   

	</div>
</div>
</div>
</div>
<!-- container fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>