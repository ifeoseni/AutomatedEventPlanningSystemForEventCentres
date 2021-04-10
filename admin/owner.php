<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
$username = $_SESSION['username'];
 if (isset($_SESSION['success']) && $_SESSION['success'] !='') {
   echo '<h2 class="bg-primary text-white text-center">'. $_SESSION['success'].'</h2>';
   unset($_SESSION['success']);
    # code...
  }
  if (isset($_SESSION['status']) && $_SESSION['status'] !='') {
    echo "<h2 class='bg-info text-danger text-center font-weight-bold'>". $_SESSION['status']."</h2>";
    unset($_SESSION['status']);# code...
    }
            
 

?>
  <h1 class="text-info text-center">Create / Update Your Account As An Event Owner</h1>
      <form action="code.php" method="POST" enctype="multipart/form-data">
      	<?php
            
            $owner_name = ""; $proposed_event_date = ""; $event_type = ""; $phone_number =""; $vendor_needed =""; $planner_name ="";
            $budget_price =""; $event_space_selected =""; $payment_in_full = "";
            $retrieveDetails =mysqli_query($connection,"SELECT * FROM eventowner WHERE username='$username'");

            $user = mysqli_fetch_assoc($retrieveDetails);
                $owner_name = $user['owner_name'];
                $proposed_event_date = $user['proposed_event_date'];
                //$event_type = $user['event_type'];
                $phone_number = $user['phone_number'];
                //$vendor_needed = $user['vendor_needed'];
                $planner_name = $user['planner_name'];
                // $budget_price = $user['budget_price'];
                 $event_space_selected = $user['event_space_selected'];
                // $payment_in_full = $user['payment_in_full'];
              
            $msg = "";$msgspace= "";
            $helpUserCheckDate = mysqli_query($connection,"SELECT * FROM eventowner WHERE username != '$username'");
            if ($helpUserCheckDate) {
              while ($row = mysqli_fetch_assoc($helpUserCheckDate) ) {
                  if($row['proposed_event_date'] == $proposed_event_date){
                     $msg=  "<h4 class='text-warning text-center font-weight-bold'>Someone is also interested in having an event at our event centre that day</h4>";
                    if($row['event_space_selected'] == $event_space_selected){
                      $msg = "<h4 class='text-info text-center font-weight-bold'>Someone is also interested in that venue for that time you desirre. Pay before he does. </b></h4>";
                    }
                 }
               
              }
            }

      ?>

        <div class="modal-body">


          <div class="form-group">
            <input type="hidden" name="username" class="form-control" placeholder="Link To BioData Of Owner" requi value="<?php echo $username; ?>">
          </div>
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="owner_name" class="form-control" placeholder="Event Owner Name Goes Here" value="<?php echo $owner_name; ?>" required>
          </div>
          <div class="form-group">
            <label>Date You Will Likely Host The Event</label>
            <input type="date" name="proposed_event_date" class="form-control" placeholder="Describe services rende." value="<?php echo $proposed_event_date; ?>" min="<?php echo date('Y-m-d'); ?>" required>
            <?php echo $msg;  ?>
          </div>
          <div class="form-group">
           <label>Type Of Event</label>
           <select name="event_type" value="<?php echo $event_type; ?>">
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
            <!-- <input type="text" name="event_type" class="form-control" placeholder="Describe services rende." requi> -->
            <small class="text-bold text-primary"><a href="add_event_type.php">If Your Type Of Event Do Not Exist Please Click Here To Add It.</a></small>
          </div>
          <div class="form-group">
           <label>Phone Number To Contact</label>
            <input type="text" name="phone_number" class="form-control" value="<?php echo $phone_number; ?>" placeholder="Enter your phone number starting with 0 or country code e.g 8175461196 or +2348175461196." required>
          </div>
          <div class="form-group radio">
            <label>Do You Need Service Of Our Event Vendors?</label><br/>
            <input type="radio" name="vendor_needed" value="yes" requi class="radio-inline"> Yes I do
            <input type="radio" name="vendor_needed" value="no" requi class="radio-inline">No I don't
       <!--      <input type="radio" name="vendor_needed" value="yes" requi class="radio-inline">Maybe I do -->
          </div> 
          <div class="form-group">
            <label>Who will plan the Event for you?</label><br/>
            <input type="radio" name="planner_name" value="event_owner" class="radio radio-inline"> Self
            <input type="radio" name="planner_name" value="friend_or_family" class="radio radio-inline"> Friend Or Family
            <input type="radio" name="planner_name" value="get_vendor" class="radio radio-inline"> Get For Me 
            <!-- <input type="text" name="planner_name" placeholder="If you have one please input the name if not please enter your own name" class="form-control" requi> -->
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
            <input type="radio" name="payment_type" value="yes" requi class="radio-inline">  Yes, I am 
            <input type="radio" name="payment_type" value="no" requi class="radio-inline">  I will not be able to pay in full 
            <!--      <input type="radio" name="vendor_needed" value="yes" requi class="radio-inline">Maybe I do -->
          </div> 

          <div>
          		<label>Upload Your Image</label>
          	  <input type="file" name="owner_image" id="owner_image" class="form-control" >
          </div>
         
        </div>
        <div class="modal-footer">
          <button type="submit" name="owner_upload" class="btn btn-primary">Upload Biodata</button>
        </div>
      </form>

<?php include('includes/footer.php'); ?> 