<?php
include('security.php');//if removed anyone can access the page
include('includes/header.php'); 
include('includes/navbar.php'); 

 $queryAdmin ="SELECT * FROM event WHERE usertype= 'admin'";// ORDER BY id";
 $query_run_admin= mysqli_query($connection,$queryAdmin);

 $Admin = mysqli_num_rows($query_run_admin);
 
// $noaccess = mysqli_query($connection,"SELECT * FROM event WHERE username ='' AND (usertype  != 'Event Vendor'  OR usertype != 'Event Vendor' OR usertype != 'admin' ");
 // $vendor = mysqli_query($connection,"SELECT * FROM event WHERE usertype = 'Event Vendor' ");
 // $owner  =  mysqli_query($connection,"SELECT * FROM event WHERE usertype = 'Event Owner' ");
 // if($vendor){
 //  header("location: vendor.php");
 // }if ($owner) {
 //   header("location: owner.php");
 // }
 /*if ($noaccess) {
  header("location: ../display ");
 }*/

 $queryOwner ="SELECT * FROM event WHERE usertype= 'Event Owner'";// ORDER BY id";
 $query_run_owner= mysqli_query($connection,$queryOwner);
 $oNumber = mysqli_num_rows($query_run_owner);
 $queryVendor ="SELECT * FROM event WHERE usertype= 'Event Vendor'";// ORDER BY id";
 $query_run_vendor= mysqli_query($connection,$queryVendor);
 $vNumber= mysqli_num_rows($query_run_vendor);
 $queryStaff ="SELECT * FROM staff";// ORDER BY id";
 $query_run_Staff= mysqli_query($connection,$queryStaff);
 $sNumber= mysqli_num_rows($query_run_Staff);



?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              

               
               <?php echo $Admin; ?>
               

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-secret fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Registered Event Owners</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                 <?php echo $oNumber; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Event Vendors</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                 <?php echo '<h4> Total Event Vendors '.$vNumber.'</h4>'; ?>
              </div>
              
            </div>
            <div class="col-auto">
              <i class="fas fa-birthday-cake fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Staff Strength -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Registered Staff</div>
              <div class="h5 mb-0 font-weight-bold text-danger-800"><?php  echo $sNumber; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-child fa-2x text-danger"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->








  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>