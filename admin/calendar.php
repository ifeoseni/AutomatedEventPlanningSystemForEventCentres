<?php
	include('includes/header.php'); 
include('includes/navbar.php'); 

	function build_calendar($month,$year){
		$daysOfWeek = array("Sunday","Monday","Tuesday","Wednesday","Thurday","Friday","Saturday");

		//Get first day off the month that is in the function argument
		$firstDayOfMOnth = mktime(0,0,0,$month,1,$year);

		//Get number of days in the month
		$numberDays = date("t",$firstDayOfMonth);

		//Getting some information about the first day of this month

		$dateComponents = getdate($firstDayOfMonth);

		//Getting the name of this month
		$monthName =$dateComponents['month'];

		//Get the index value 0-6 of the first day of the month;
		$dayOfWeek = $dateComponents['wday'];


		//Getting the current time
		$datetoday = date("Y-m-d");

		//Creating the table
		$calendar ="<Table class='table table-bordered'>";
		$calendar .="<center><h2>$monthName $year</h2></center>";

		$calendar .= "<tr>";

		//Creating the calendar headers
		foreach($daysOfWeek as $day){
			$calendar .= "<th class='header'>$day</th>";
		}

		$calendar ="</tr><tr>";

		//The variable $dayOfWeek will make sure that there must be only 7 columns on our table
		if($dayOfWeek > 0){
			for ($k=0; $k < $dayOfWeek; $k++) { 
				$calendar .="<td></td>";
			}
		}

		$currentDay = 1; //initiating the day counter

		//getting month number

		$month =str_pad($month,2,"0",STR_PAD_LEFT);

		while($currentDay <= $numberDays){

			//if seventh column (saturday) reached, start a new row
			if($dayOfWeek == 7){
				$dayOfWeek = 0;
				$calendar .= " </tr><tr>";
			}

			$currentDayRel = str_pad($currentDay,2,"0",STR_PAD_LEFT);
			$date ="$year-$month-$currentDayRel";

			if ($dateToday ==$date) {
				$calendar .="<td class='today'><h4>$currentDay</h4>";
			}else{
			$calendar .= "<td><h4>$currentDay</h4>";
			}

			$calendar .="</td>";

			//incrementing the counters
			$currentDay++;
			$dayOfWeek++;
		}

		//Completeing the row of the last week in month, if necessary
		if($daysOfWeek !=7){
			$reminingDays = 7-$daysOfWeek;
			for ($i=0; $i < $reminingDays; $i++) { 
				$calendar .-"<td></td>";#; code...
			}
		}

		$calendar .="</tr>";
		$calendar .="</tabe>";

		echo $calendar;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<style type="text/css">
		table{
			table-layout: fixed;
		}
		td{
			width: 33%;
		}
		.today{
			background:yellow;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
					$dateComponents = getdate();
					$month =$dateComponents["mon"];
					$year = $dateComponents["year"];
					echo build_calendar($month,$year)
				?>
			</div>
		</div>
	</div>

</body>
</html>