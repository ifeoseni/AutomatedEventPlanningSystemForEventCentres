<link href="../css/sb-admin-2.min.css" rel="stylesheet">

<?php
//$username = $_SESSION['username'];
$servername="localhost";
$db_username="root";
$db_password="";
$db_name="adminpanel";

 $connection = mysqli_connect($servername,$db_username,$db_password);


$dbconfig =mysqli_select_db($connection,$db_name);
 // $email=  $_SESSION['username'];
 //  $_SESSION['usertype'] =mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM event WHERE email='$email'"))['usertype'];
 
 
if($dbconfig)
{
	//echo "Database Connected";
}
else
{
	echo '
				<div class="container text-danger">
			<div class="row">
				<div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">
					<div class="card">
						<div class="card-body">
							<h1 class="card-title bg-danger text-white">Database Connection Failed</h1>
							<h2 class="card-title">Database Failure</h2>
							<p class="card-text">Please Check Your Datbase Connection</p>
							<a href="#" class="btn btn-primary">:(</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	';
}

 ?>

 <div class="">
 	
 </div>
