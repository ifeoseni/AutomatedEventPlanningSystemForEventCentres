<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
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
            <input type="hidden" name="username" class="form-control" placeholder="Link To BioData Of Owner" required value="<?php echo $_SESSION['username']; ?>">
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="owner_name" class="form-control" placeholder="Event Owner Name Goes Here" required>
          </div>
          <div class="form-group">
            <label>Date You Will Likely Host The Event</label>
            <input type="date" name="event_date" class="form-control" placeholder="Describe services rendered." required min="">
          </div>
          <div class="form-group">
           <label>Type Of Event</label>
           <select name="event_type">
                <?php 
                  $query = "SELECT DISTINCT event_type FROM eventtype";
                  $query_run= mysqli_query($connection,$query);
                    if (mysqli_num_rows($query_run) >0) {
                      while($row = mysqli_fetch_assoc($query_run)){
                        echo "<option value='".$row['event_type']."'>".$row['event_type']."</option>";
                      }
                    }
                ?>
              </select>
              <br/>
            <!-- <input type="text" name="event_type" class="form-control" placeholder="Describe services rendered." required> -->
            <small class="text-bold text-primary"><a href="add_event_type.php">If Your Type Of Event Do Not Exist Please Click Here To Add It.</a></small>
          </div>
          <div class="form-group">
           <label>Phone Number To Contact</label>
            <input type="text" name="phone_number" class="form-control" placeholder="Enter your phone number starting with country code e.g +2348175461196." required>
          </div>
          <div class="form-group radio">
            <label>Do You Need Service Of Our Event Vendors?</label><br/>
            <input type="radio" name="vendor_needed" value="yes" required class="radio-inline">Yes I do
            <input type="radio" name="vendor_needed" value="no" required class="radio-inline">No I don't
       <!--      <input type="radio" name="vendor_needed" value="yes" required class="radio-inline">Maybe I do -->
          </div> 
          <div class="form-group">
            <label>Name Of Event Planner?</label>
            <input type="text" name="planner_name" placeholder="If you have one please input the name if not please enter your own name" class="form-control" required>
          </div>  
          <div class="form-group">
            <label>Amount You Want To Spend On This Event?</label>
            <input type="Number" name="budget_price" placeholder="This will help you to make a good budget" class="form-control" required>
          </div>    

        

           <div class="form-group">
           <label>Select Event Space You Want To Use</label>
           <select name="event_space_selected">
                <?php 
                  $query = "SELECT DISTINCT spacename FROM eventspace";
                  $query_run= mysqli_query($connection,$query);
                    if (mysqli_num_rows($query_run) >0) {
                      while($row = mysqli_fetch_assoc($query_run)){
                        echo "<option value='".$row['spacename']."'>".$row['spacename']."</option>";
                      }
                    }
                ?>
              </select>
          </div>
            <div class="form-group radio">
            <label>Are You Paying In Full?</label><br/>
            <input type="radio" name="payment_type" value="yes" required class="radio-inline">  Yes, I am 
            <input type="radio" name="payment_type" value="no" required class="radio-inline">  I will be paying in installments
            <!--      <input type="radio" name="vendor_needed" value="yes" required class="radio-inline">Maybe I do -->
          </div> 

          <div>
          		<label>Upload Your Image</label>
          	  <input type="file" name="owner_image" id="owner_image" class="form-control" required>
          </div>
         
        </div>
        <div class="modal-footer">
          <button type="submit" name="owner_upload" class="btn btn-primary">Upload Biodata</button>
        </div>
      </form>

<?php include('includes/footer.php'); ?> 