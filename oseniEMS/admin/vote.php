<?php


$servername="localhost";
$db_username="root";
$db_password="";
$db_name="vote";

 $connection = mysqli_connect($servername,$db_username,$db_password);

 if($connection){
 	echo "Conn4c";
 }


if (isset($_POST['submit'])) {


		

		// $jamiu = $_POST['jamiu'];
		// $emma = $_POST['emma'];
		// $ife = $_POST['ife'];


		if (isset($_POST['jamiu']) ) {
			$jamiu = 1;
		}else{
			$jamiu = 0;
		}
		if (isset($_POST['emma']) ) {
			$emma = 1;
		}else{
			$emma = 0;
		}
		if (isset($_POST['ife']) ) {
			$ife = 1;
		}else{
			$ife = 0;
		}



		echo $jamiu. $ife. $emma; 
		$jamiu1 = $jamiu; $ife1 =$ife; $emma1=$emma;


	$total =$jamiu1+$emma1+$ife1;
	echo $total;

	if( ($total <= 2 ) && ($total > 0)  ){
		$query = "INSERT into vote (jamiu, emma, ife) VALUES ('$jamiu1','$emma1','$ife1')";
		$query_run = mysqli_query($connection,$query);

		if ($query_run) {
		echo "Submitted";
		}else{
			echo "Not submitted";
		}

	}else{
		$msg = "You select more than two";
	}
 

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Voting</title>
</head>
<body>
	<form method="POST" action="vote.php">
		<?php echo "<span style='color: red;'>" .@$msg."</span><br>" ?>
		<input type="checkbox" name="jamiu" value="1"> Jamiue<br>
  		<input type="checkbox" name="emma" value="1"> Emma<br/>
  		<input type="checkbox" name="ife" value="1"> Ife<br/>
  		<button type="submit" name="submit" class="btn btn-success">Submit</button>
	</form>

</body>
</html>