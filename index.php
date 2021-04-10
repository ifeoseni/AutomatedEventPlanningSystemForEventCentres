<?php

    include ('admin/security.php');
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

<style type="text/css">
  .counter{
    background: #f6c23e !important;
  }
  .card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
}.d-block{
  height:700px;
  width: calc(1519px-500px);
  /*margin:40px 100px;*/
}
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
      
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="assets/fonts/line-icons.css">
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="admin/css/sb-admin-2.css">
    <link rel="stylesheet" type="text/css" href="admin/vendor/fontawesome-free/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home Page | Event Management System</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
   <link href="admin/css/all.min.css" rel="stylesheet">
   <link href="admin/css/fontawesome.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="admin/upload/IS3.jpg">
  </head>
  <body>
       
    <!-- Header Area wrapper Starts -->
    <header id="header-wrap">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg bg-inverse fixed-top scrolling-navbar">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
         
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto w-100 img-fluid img-responsive justify-content-end">
              <li class="nav-item active">
                <a class="nav-link" href="#header-wrap">
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">
                  About
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#team">
                  Events
                </a>
              </li>
              <li class="nav-item">
                <a href="admin/login.php" class="nav-link">
                  Login
                </a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#adduserprofile">
                  Register 
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>


  <div class="modal fade" id="adduserprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register To Create An Account On The Event Management System</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form action="admin/code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Your Preferred Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter Your First Name Here">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" placeholder="Enter Your Last Name Here">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Desired Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm The Desired Password">
            </div>
            <div class="form-group">
                <label>I am an Event</label><br/>
                <input type="radio" name="usertype" class="form-line" value="1"> Event Owner
                <input type="radio" name="usertype" class="form-line" value="2"> Event Vendor 
                   <!-- placeholder="Press 1 if you are an event owner  or 2 if you are a vendor"     -->
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerguest" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
   </div>


  
</div>
      <!-- Navbar End -->

      <!-- Hero Area Start -->
      <div id="hero-area" class="bg-primary">
        <div class="overlay"></div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-9 col-sm-12">
              <div class="contents text-center">
               
                <h2 class="head-title">Event Management System For Event Centre</h2>
                <p class="banner-desc">
                  Where event owners get to prepare budget, book vendors, etc.</p>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero Area End -->

    </header>
    <!-- Header Area wrapper End -->

    <!-- Count Bar Start -->
    <section id="count">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-10">
            <div class="count-wrapper text-center">
              <div class="time-countdown wow fadeInUp" data-wow-delay="0.2s">
                <div id="clock" class="time-count"></div>
                <p class="head-title content" style="color:#fff;font-size: 28px;line-height: 48px;text-transform: uppercase;font-weight: 700;margin-bottom: 22px;">Count Down To 2021</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Count Bar End -->

    <!-- About Section Start -->
    <section id="about" class="section-padding" style="background:#99ddff !important;">
      <div class="container">
        <h1 class="text-center">About Our Event Centre</h1>
        <div class="row">
          <div class="col-lg-6 col-md-12 col-xs-12">
            <div class="img-thumb">
              <img class="img-fluid" src="assets/img/about/img1.png" alt="">
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-xs-12">
            <div class="about-content">
              <div>
                <div class="about-text">                     
                  <?php
                    $query = "SELECT * FROM abouts";
                    $query_run = mysqli_query($connection,$query);
                     
                     //  if (mysqli_num_rows($query_run) >0) {
                     while($row = mysqli_fetch_assoc($query_run)){
                     
                        echo "<h2><u>".$row['title']."</u></h2>";
                        echo "<h4>".$row['subtitle']."</h4>";
                        echo "<p>".$row['description']."</p>";
                        // echo "<a href='".$row['links']."' class='btn btn-common'>".$row['links']."</a>";
                     }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Section End -->
       <!-- Team Section Start -->
    <section id="team" class="text-center">
      <div class="container">
        <div class="row panel-group">
           <?php
                $query = mysqli_query($connection,"SELECT * FROM faculty");  
                while ($got = mysqli_fetch_assoc($query)){

                  echo "<div class='col-lg-4 col-md-6 col-xs-12 panel panel-default'>";
                    echo '<img src="admin/upload/'.$got['images'].'"  alt=""  class="card-image img-responsive img-fluid">';
                      echo "<p class='panel-heading font-weight-bold' style='color:#6610f2;100px !important' height='100px !important;'>".$got['name']."</p>";
                       echo "<p class='panel-body text' style='color:#6610f2;'>".$got['designation']."</p>";
                      echo "<p class='panel-footer' style='color:#6610f2;'>".$got['description']."</p>";
                     
                  echo "</div>";
                 
                }
        ?>
       </div>
      </div>
          

    </section>
    <!-- Team Section End -->

   

     <!-- intro Section Start -->
<!--     <section id="intro" class="intro section-padding"> -->
  <div class="container-fluid" style="background: #1cc88a">
      <div class="container" style="background: #e6ffff !important;">
        <div class="row">
          <div class="col-12">
            <div class="section-title-header text-center">
              <h2 class="section-title wow fadeInUp" data-wow-delay="0.2s">Why You Should Use Our Event Centre?</h2>
              <p class="wow fadeInDown" data-wow-delay="0.2s" style="color:#009933;">We have the capacity, the people and services that other event centres do not offer. Thesse services include:</p>
            </div>
          </div>
        </div>
        <div class="row intro-wrapper">
          <div class="col-lg-12 col-md-6 col-xs-12 bg-danger">
            <div class="single-intro-text mb-70 text-white">
               <h3 class="text-danger text-center">Our Event Spaces</h3>
               <p>
                <ul>
                  <?php
                     $query = "SELECT * FROM eventspace";
                     $query_run = mysqli_query($connection,$query);
                     
                     //  if (mysqli_num_rows($query_run) >0) {
                     while($row = mysqli_fetch_assoc($query_run)){
                     
                        echo "<li style='color:#ff6600;'>".$row['spacename']." : ".$row['spacedescription']." with a space of ".$row['spaceseat']." . The event space price is ₦".$row['spaceprice'].". </li>";
                     }
                  ?>
                </ul>
                  
               </p>
               <span class="count-number"><?php 
                       $query = "SELECT * FROM eventspace";
                       $query_run = mysqli_query($connection,$query);
                       $rows = mysqli_num_rows($query_run);
                       echo $rows;
                   
                   ?></span>
            </div>
          </div>
         
         

        </div>
      </div>
  </div>
    
<!--     </section> -->
    <!-- intro Section End -->
  
    <!-- Counter Area Start-->
    <section class="counter-section section-padding">
      <div class="container">
        <div class="row text-primary">
          <!-- Counter Item -->
          <div class="col-lg-3 col-md-6 col-xs-12 work-counter-widget">
            <div class="counter">
              <div class="counter-content text-center ">
                <?php 
                      
                       $Vendors = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM event WHERE usertype= 'Event Vendor' "));

                       
                       $Users  = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM event WHERE usertype= 'Event Owner'"));
                        $staff = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM staff"));



                     echo '<div class="counterUp"> '.$Vendors.'</div>';
                ?><!-- 
                <div class="counterUp">42</div> -->

                <p class="">Vendors Available</p>
              </div>
            </div>
          </div>
          <!-- Counter Item -->
          <div class="col-lg-3 col-md-6 col-xs-12 work-counter-widget">
            <div class="counter">
              <div class="counter-content">
                <div class="counterUp"><?php echo mysqli_num_rows(mysqli_query($connection,"SELECT * FROM budget" )); ?></div>
                <p>Budgets Created</p>
              </div>
            </div>
          </div>
          <!-- Counter Item -->
          <div class="col-lg-3 col-md-6 col-xs-12 work-counter-widget">
            <div class="counter">
             
              <div class="counter-content">
                <div class="counterUp"><?php echo $Users; ?></div>
                <p>Registered Event Users</p>
              </div>
            </div>
          </div>
          <!-- Counter Item -->
          <div class="col-lg-3 col-md-6 col-xs-12 work-counter-widget">
            <div class="counter">
              <div class="counter-content">
                <div class="counterUp"><?php echo $staff; ?></div>
                <p>Staff Population</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Counter Area End-->

    <!-- Schedule Section Start -->
    <?php include("admin/allInterest.php"); ?>
<div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="10000">
      <img src="admin/upload/2.jpg" class="d-block w-100 img-responsive" alt="...">
      <div class="carousel-caption d-none d-md-block text-white font-weight-bold" style="background: #fd7e14;">
        <h1>A Yoruba Event</h1>
        <h3>This event had over 400 people in attendance</h3>
      </div>
    </div>
    <div class="carousel-item" data-interval="2000">
      <img src="admin/upload/1.jpg" class="d-block w-100 img-responsive "  alt="...">
      <div class="carousel-caption d-none d-md-block text-white font-weight-bold" style="background:#6610f2;">
        <h1>Religious Gathering</h1>
        <h3>Largest Prayer Worship In Ibadan Was Held Here With Over 500 people </h3>
      </div>
    </div>
    <div class="carousel-item">
      <img src="admin/upload/5.jpg" class="d-block w-100 img-responsive" alt="...">
      <div class="carousel-caption d-none d-md-block text-white font-weight-bold" style="background: #f6c23e;">
        <h1>Friend Meet Up</h1>
        <h3>Socialites at an event </h3>
      </div>
    </div>
    <div class="carousel-item">
      <img src="admin/upload/4.jpg" class="d-block w-100 img-responsive" alt="...">
      <div class="carousel-caption d-none d-md-block text-white font-weight-bold" style="background: #36b9cc;">
        <h1>Business Event</h1>
        <h3>Investors at an hackathon recently held at our event space </h3>
      </div>
    </div>
    <div class="carousel-item">
      <img src="admin/upload/3.jpg" class="d-block w-100 img-responsive" alt="...">
      <div class="carousel-caption d-none d-md-block text-white font-weight-bold" style="background: #20c9a6">
        <h1>Government Session</h1>
        <h3>People asking government officials questions at a government event held recently </h3>
      </div>
    </div>
    <div class="carousel-item">
      <img src="admin/upload/6.jpg" class="d-block w-100 img-responsive" alt="...">
      <div class="carousel-caption d-none d-md-block bg-white font-weight-bold" style="color:#e83e8c; ">
        <h1>Singing Concert</h1>
        <p>Soweto Choir From South Africa Recent Performance At Our Event Space </p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    <!-- Map Section Start -->
    <section id="google-map-area">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <object style="border:0; height: 450px; width: 100%;" data="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d7913.095407133417!2d3.912983669983437!3d7.404466161217277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x103992be48a0ebc9%3A0xa0b309d3d0e37e17!2sKola%20Daisi%20Civic%20Centre%20Hall%2C%20Ibadan!3m2!1d7.400709399999999!2d3.9235406999999998!5e0!3m2!1sen!2sng!4v1579825228674!5m2!1sen!2sng"></object>

        </div>
      </div>
    </section> 

    <footer>
      <div class="container" >
        <div class="row justify-content-center">
          <div class="col-lg-12 col-md-12 col-xs-12">
              
              <h3 class="text-white font-weight-bold">Designed and Developed by OSENI Ifeoluwa Daniel</h3>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Go to Top Link -->
    


 

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>

    <script src="assets/js/main.js"></script>   
     <script type="text/javascript">
      // Activate Carousel
$("#myCarousel").carousel();
interval:200
// Enable Carousel Indicators
$(".item").click(function(){
    $("#myCarousel").carousel(1);
});

// Enable Carousel Controls
$(".left").click(function(){
    $("#myCarousel").carousel("prev");
});
    </script>  
   
  </body>
</html>
