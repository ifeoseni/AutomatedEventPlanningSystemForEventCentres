<style type="text/css">
    canvas{
        height:20px;
        
    }
</style>
<?php
//include('security.php');
// include('includes/header.php'); 
// include('includes/ownernavbar.php'); 


 $interestedTime = array(); $paidSpace = array();
   
     $getDate =mysqli_query($connection,"SELECT * FROM eventowner");
     $payee = mysqli_query($connection,"SELECT * FROM payment_made ");
    if($getDate) { while( $date = mysqli_fetch_assoc($getDate)){ array_push($interestedTime, $date['proposed_event_date']); } } 
    if($payee)   { while(   $date = mysqli_fetch_assoc($payee)){ array_push($paidSpace, $date['event_date']); }  }//get payment details

      $Day = array();   $Month =array();    $Year = array();//to store the dates selected from the database into an array
      $pDay = array(); $pMonth =array();   $pYear = array();//to store thepayment side  dates selected from the database into an array
      
       for ($p=0 ; $p < count($paidSpace); $p++) { 
        $pYear[$p] = explode('-', $paidSpace[$p])[0];
        $pMonth[$p] =explode('-', $paidSpace[$p])[1];
        $pDay[$p] =   explode('-', $paidSpace[$p])[2];//splits date into day based on payment only
         //splits date into month based on payment only
         //splits date into day based on payment only
      }

      for ($i=0 ; $i < count($interestedTime); $i++) { 
        $Day[$i] = explode('-', $interestedTime[$i])[2];//splits date into day only
        $Month[$i] = explode('-', $interestedTime[$i])[1];//splits date into month only
        $Year[$i] = explode('-', $interestedTime[$i])[0];//splits date into day paid
       }


     

     // echo  explode('-', $interestedTime[2][2]);

   // echo count($interestedTime);
    echo '<script>var Day = ' . json_encode($Day) . ';</script>';
    echo '<script>var Month = ' . json_encode($Month) . ';</script>';
    echo '<script>var Year = ' . json_encode($Year) . ';</script>';

     echo '<script>var pDay = ' . json_encode($pDay) . ';</script>';
    echo '<script>var pMonth = ' . json_encode($pMonth) . ';</script>';
    echo '<script>var pYear = ' . json_encode($pYear) . ';</script>';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/sb-admin-2.css" >

</head>
<body>
    <h2 class="text-center text-primary font-weight-bold" style="margin-bottom: -2.0rem !important;">Event Calendar Showing Days People Are Interested In And Days People Have Paid For</h2>
<div class="container col-sm-4 col-md-7 col-lg-4 mt-5">
    <div class="card">
        <h3 class="card-header" id="monthAndYear"></h3>
        <table class="table table-bordered table-responsive-sm" id="calendar">
            <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            </thead>

            <tbody id="calendar-body">

            </tbody>
        </table>

        <div class="form-inline">

            <button class="btn btn-outline-info text-primary font-weight-bold col-sm-6" id="previous" onclick="previous()">Previous</button>

            <button class="btn btn-outline-info text-primar font-weight-bold col-sm-6" id="next" onclick="next()">Next</button>
        </div>
        <br/>
        <form class="form-inline">
            <label class="lead mr-2 ml-2" for="month">Jump To: </label>
            <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                <option value=0>January</option>
                <option value=1>February</option>
                <option value=2>March</option>
                <option value=3>April</option>
                <option value=4>May</option>
                <option value=5>June</option>
                <option value=6>July</option>
                <option value=7>August</option>
                <option value=8>September</option>
                <option value=9>October</option>
                <option value=10>Novemmber</option>
                <option value=11>December</option>
            </select>


            <label for="year"></label><select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
            <option value=2015>2015</option>
            <option value=2016>2016</option>
            <option value=2017>2017</option>
            <option value=2018>2018</option>
            <option value=2019>2019</option>
            <option value=2020>2020</option>
            <option value=2021>2021</option>
            <option value=2022>2022</option>
            <option value=2023>2023</option>
            <option value=2024>2024</option>
            <option value=2025>2025</option> 
        </select></form>
    </div>
</div>

<h3 class="text-dark text-center" >
 <span> Already Booked Date <canvas class="bg-success" ></canvas> </span>
 <span> Interested Date <canvas class="bg-danger"></canvas> </span>
  <span> Current Date <canvas class="bg-dark"></canvas> </span>
</h3>

<!--<button name="jump" onclick="jump()">Go</button>-->
<script >
  /*  var Day = <?php echo json_encode($Day); ?>;//converting php array into javascript array
var Month = <?php echo json_encode($Month); ?>;//converting php array into javascript array
var Year = <?php echo json_encode($Year); ?>;

let write ="";
for (var i = 0; i < Day.length; i++) {
   write += Day[i]
}
alert(Day[1])
*/

</script>
<!-- <script src="scripts.js"></script> -->
<?php
include('scriptsjs.php'); 

?>

<!-- Optional JavaScript for bootstrap -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script> -->




</body>
</html>