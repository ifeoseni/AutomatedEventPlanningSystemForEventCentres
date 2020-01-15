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

if (isset($_POST["edit_budget_btn"])) {

	$id = $_POST['edit_id'];

	$query = "SELECT * FROM budget WHERE id = '$id'";
	$query_run = mysqli_query($connection,$query);	

	foreach ($query_run as $row) {
		?>

		 <form action="code.php" method="POST">        
		 	<input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
		 	<input type="hidden" name="username" value="<?php echo $row['username']; ?>">
            <div class="form-group">
             <label>Edit Service Need</label>
            <input type="text" name="user_need" class="form-control" value="<?php echo $row['user_need']; ?>">
          	</div>
         	 <div class="form-group">
            <label>Edit Need Description</label>
            <input type="text" name="describe_need" class="form-control" value="<?php echo $row['describe_need']; ?>">
         	 </div>
         	 <div class="form-group">
            <label>Edit Estimate Price For The Service In ₦</label>
            <input type="text" name="estimate_price" class="form-control" value="<?php echo $row['estimate_price']; ?>">
	          </div>
	          <div class="form-group">
            <label>Edit Amount Spent In ₦ </label>
            <input type="text" name="proposed_income" class="form-control" value="<?php echo $row['proposed_income']; ?>">
         	 </div>
         	 <div class="form-group">
            <label>Edit Expected Income Coming In ₦ </label>
            <input type="text" name="amount_spent" class="form-control" value="<?php echo $row['amount_spent']; ?>">
         	 </div>

         
          <a href="budget_edit.php" class="btn btn-danger">Cancel</a>
          <button type="submit" name="update_budget" class="btn btn-primary">Update This Budget Item</button>
       
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