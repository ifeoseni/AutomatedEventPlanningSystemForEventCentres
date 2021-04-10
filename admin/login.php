<?php
//session_start();
include('includes/header.php'); 
?>



<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-6 col-lg-6 col-md-6">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-primary mb-4">Login With Your Credentials To Access Your Profile!</h1>
                  <?php

                      if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                      {
                        //  echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                          unset($_SESSION['status']);
                      }
                  ?>
                </div>

                  <form class="user" action="logincode.php" method="POST">

                      <div class="form-group">
                      <input type="text" name="mainDetail" class="form-control form-control-user" placeholder="Enter Email Address or User Name Here...">
                      </div>
                      <div class="form-group">
                      <input type="password" name="passwordd" class="form-control form-control-user" placeholder="Password">
                      </div>
              
                      <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                      <hr>
                  </form>


              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


  </div>

</div>



<?php
include('includes/scripts.php'); 
?>