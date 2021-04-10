<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
$username = $_SESSION['username'];

 $interestedTime = array();
     $hall = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM eventowner WHERE username='$username'"))['event_space_selected'];
     $getDate =mysqli_query($connection,"SELECT * FROM eventowner ");// WHERE event_space_selected ='$hall' ORDER BY proposed_event_date");// WHERE username='$username'");
            if ($getDate) {
              echo "<table>";
                //for ($i=0; $i < mysqli_num_rows($getDate); $i++) { 

                  while($date = mysqli_fetch_assoc($getDate)){
                     echo "<tr>";
                     echo "<td class='font-weight-bold text-primary'>".$date['proposed_event_date']."</td>";

                   // $date = mysqli_fetch_assoc($getDate)["proposed_event_date"];
                    // 
                       array_push($interestedTime, $date['proposed_event_date']);
                    // }
                    $checkPayment = mysqli_query($connection,"SELECT amount_paid FROM payment_made WHERE event_date='date(d m Y)'");
                   

                    /*
                    if(mysqli_fetch_assoc($checkPayment)['amount_paid'] > 0) {
                    // echo "<td class='text-danger font-weight-bold'>Yes</td>";
                    }else{
                     // / echo "<td class='text-success font-weight-bold'>No payment has been made yet</td>";
                    }
                    */
                    echo "<tr>";
                    
                  }
                  echo "</table>";
               // }
            } 


for ($i=0; $i < count($interestedTime); $i++) { 
                echo $interestedTime[$i]."<br/>";
            }

      $Day = array();//to store the dates selected from the database into an array
      $Month =array();
      $Year = array();

      

      for ($i=0; $i < count($interestedTime); $i++) { 
        $Day[$i] = explode('-', $interestedTime[$i])[2];//splits date into day only
        $Month[$i] = explode('-', $interestedTime[$i])[1];//splits date into month only
        $Year[$i] = explode('-', $interestedTime[$i])[0];//splits date into day only

      }

     // echo  explode('-', $interestedTime[2][2]);

   

      for ($i=0; $i < count($Day); $i++) { 
        echo $Day[$i];
      }
  
    echo count($interestedTime);
    echo '<script>var Day = ' . json_encode($Day) . ';</script>';
    echo '<script>var Month = ' . json_encode($Month) . ';</script>';
    echo '<script>var Year = ' . json_encode($Year) . ';</script>';
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

            <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()">Previous</button>

            <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()">Next</button>
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
            <option value=1990>1990</option>
            <option value=1991>1991</option>
            <option value=1992>1992</option>
            <option value=1993>1993</option>
            <option value=1994>1994</option>
            <option value=1995>1995</option>
            <option value=1996>1996</option>
            <option value=1997>1997</option>
            <option value=1998>1998</option>
            <option value=1999>1999</option>
            <option value=2000>2000</option>
            <option value=2001>2001</option>
            <option value=2002>2002</option>
            <option value=2003>2003</option>
            <option value=2004>2004</option>
            <option value=2005>2005</option>
            <option value=2006>2006</option>
            <option value=2007>2007</option>
            <option value=2008>2008</option>
            <option value=2009>2009</option>
            <option value=2010>2010</option>
            <option value=2011>2011</option>
            <option value=2012>2012</option>
            <option value=2013>2013</option>
            <option value=2014>2014</option>
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
            <option value=2026>2026</option>
            <option value=2027>2027</option>
            <option value=2028>2028</option>
            <option value=2029>2029</option>
            <option value=2030>2030</option>
        </select></form>
    </div>
</div>
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