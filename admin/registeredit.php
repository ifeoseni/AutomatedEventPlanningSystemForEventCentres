<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">
	
	<!-- DataTables Example -->
	<div class="card shadow mb-4">
		<div class="card header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Edit User Profile</h6>
		</div>	
	<div class="card-body">

<?php
$connection =mysqli_connect("localhost","root","","adminpanel");

if (isset($_POST["edit_btn"])) {

	$id = $_POST['edit_id'];

	$query = "SELECT * FROM event WHERE id = '$id'";
	$query_run = mysqli_query($connection,$query);	

	foreach ($query_run as $row) {
		?>


			<form action="code.php" method="POST">

				<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >
				<div class="form-group">
	                <label> Username </label>
	                <input type="text" name="edit_username" value="<?php echo $row['username']; ?>" class="form-control" placeholder="Enter Username">
	            </div>
	            <div class="form-group">
	                <label>Email</label>
	                <input type="email" name="edit_email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Enter Email">
	            </div>
	            <div class="form-group">
	                <label>Password</label>
	                <input type="password" name="edit_password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="Enter Password">
	            </div>
	            <div class="form-group">
	                <label>UserType</label>
	                <select name="update_usertype" id="">
           			<?php 
           				$query = "SELECT DISTINCT usertype FROM event";
           				$query_run= mysqli_query($connection,$query);
           				  if (mysqli_num_rows($query_run) >0) {
			                while($row = mysqli_fetch_assoc($query_run)){
			                  echo "<option value='".$row['usertype']."'>".$row['usertype']."</option>";
				              }
			              }

           			?>
           			
           		</select>
	            </div>

	            <a href="register.php" class="btn btn-danger"> CANCEL</a>	
	            <button class="btn btn-primary" type="submit" name="updatebtn"> Update</button>
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