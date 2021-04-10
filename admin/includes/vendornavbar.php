   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">OSENI<sup>EMS</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="../index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Go To The Website</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<li class="nav-item">
  <a class="nav-link" href="see_rating.php">
    <i class="fas fa-fw fa-laptop"></i>
    <span>See Your Rating</span></a>
</li>


<li class="nav-item">
  <a class="nav-link" href="vendor_category.php">
    <i class="fas fa-fw fa-laptop"></i>
    <span>Add New Service Category</span></a>
</li>




<!-- Divider -->
<hr class="sidebar-divider">
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="knowowners.php">
    <i class="fas fa-fw fa-magic"></i>
    <span>Possible Contract For You</span></a>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link" href="vendor.php">
    <i class="fas fa-fw fa-edit"></i>
    <span>Create/Update Profile</span></a>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Pages</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Login Screens:</h6>
      <a class="collapse-item" href="login.php">Login</a>
      <a class="collapse-item" href="register.php">Register</a>
      <a class="collapse-item" href="forgot-password.php">Forgot Password</a>
      <div class="collapse-divider"></div>
      <h6 class="collapse-header">Other Pages:</h6>
      <a class="collapse-item" href="404.php">404 Page</a>
    </div>
  </div>
</li>




</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

           

            <!-- Nav Item - Messages -->
          

            <div class="topbar-divider d-none d-sm-block"></div>


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
              <?php echo $_SESSION['username']; ?>

                  
                </span>
                <?php
                      $user = $_SESSION['username'];
                       $query = "SELECT * FROM vendor WHERE username='$user' ";//  '$_SESSION['']'";  
                      $query_run = mysqli_query($connection,$query);
                        if (mysqli_num_rows($query_run) > 0)
                       {
                             while($row = mysqli_fetch_assoc($query_run))
                           { 
                            
                             echo '<img src="../admin/upload/'.$row['vendor_image'].'" class="img-fluid rounded-circle  img-responsive"  alt="See me"  width="40px" height="10px">';
                           }
                        }      
                    ?>
              </a>
              <!-- Dropdown - User Information -->

            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->