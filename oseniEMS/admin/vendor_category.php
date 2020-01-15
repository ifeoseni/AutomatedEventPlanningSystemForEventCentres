<?php
include('security.php');
include('includes/header.php'); 
include('includes/vendornavbar.php'); 

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
      <form action="code.php" method="POST" enctype="multipart/form-data">
       
        
      	
        <div class="modal-body" >
           <fieldset>
              <legend>Select Vendor You Will Like To Book</legend>
            <div class="form-group">
            <label>Add New Categor Not Found</label>
            <input type="text" name="vendor_category" class="form-control" placeholder="Enter Name" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="vendor_category_upload" class="btn btn-primary">Upload Biodata</button>
        </div>
        </fieldset>
      </form>

<?php include('includes/footer.php'); ?> 