<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 

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
              <legend>Add Event Type If It Does Not Exist</legend>
            <div class="form-group">
            <label>Add New Event Type If Not Found</label>
            <input type="text" name="event_type" class="form-control" placeholder="Enter Your Type Of Event" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_event_type" class="btn btn-primary">Add New Event Type</button>
        </div>
        </fieldset>
      </form>

<?php include('includes/footer.php'); ?> 