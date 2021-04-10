<?php
include('security.php');
include('includes/header.php'); 
include('includes/vendornavbar.php'); 
?>
      <form action="code.php" method="POST" enctype="multipart/form-data">
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
        <div class="modal-body">

        	<div class="form-group">
            <input type="hidden" name="username" class="form-control" placeholder="Link To BioData Of Vendor" required value="<?php echo $_SESSION['username']; ?>">
         	 </div>
            <div class="form-group">
            <label>Business Name</label>
            <input type="text" name="vendor_name" class="form-control" placeholder="Enter Business Name" required>
          </div>
          <div class="form-group">
            <label>Type of Service</label>
            <input type="text" name="vendor_service" class="form-control" placeholder="Describe services rendered." required>
          </div>
          <div class="form-group">
            <label>Category</label>
           <!--  <input type="text" name="vendor_category" class="form-control" placeholder="Enter Description" required> -->
           		<select name="vendor_category">
           			<?php 
           				$query = "SELECT DISTINCT vendor_category FROM vendorcategory";
           				$query_run= mysqli_query($connection,$query);
           				  if (mysqli_num_rows($query_run) >0) {
			                while($row = mysqli_fetch_assoc($query_run)){
			                  echo "<option value='".$row['vendor_category']."'>".$row['vendor_category']."</option>";
				              }
			              }

           			?>
           			
           		</select>
              <p><a href="vendor_category.php" class="text-primary font-weight-bold form-group">Click Here If You Can't Find Your Category</a></p>
          </div>
          <div class="form-group">
            <label>Contact Details</label>
            <input type="text" name="vendor_phone" placeholder="Enter your phone number. Do not start with 0" class="form-control" required>
          </div>
           <div class="form-group">
            <label>Enter price range</label>
            <input type="text" name="price_range" placeholder="E.g ₦10 000 - ₦100 000" class="form-control" required>
          </div>
          <div class="form-group">Business Email Address</label>
            <input type="email" name="vendor_email" id="faculty_image" class="form-control" required placeholder="Enter business email address here">
          </div>
          <div>
          		<label>Upload Your Image</label>
          	  <input type="file" name="vendor_image" id="vendor_image" class="form-control" required>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="vendor_upload" class="btn btn-primary">Upload Biodata</button>
        </div>
      </form>

<?php include('includes/footer.php'); ?> 