<?php
include('security.php');

$connection = mysqli_connect("localhost","root","","adminpanel");

if(isset($_POST['login_btn'])){
			$credential = $_POST['mainDetail'];
			$password_login = $_POST['passwordd'];

			$query = "SELECT * FROM event WHERE (email ='$credential' || username = '$credential')  AND password ='$password_login' ";
			$query_run = mysqli_query($connection,$query);

			$usertypes = mysqli_fetch_array($query_run);
			
			if ($usertypes['usertype'] == "admin") 
			{//without fetch array everyone logs in
				$_SESSION['username'] = $credential;
				header('location: index.php');
			}		
			else if($usertypes['usertype'] == "Event Owner")
			{
				$_SESSION['username'] = $credential;
				header('location:owner.php');
			}
			else if($usertypes['usertype'] == "Event Vendor")
			{
				$_SESSION['username'] = $credential;
				header('location: vendor.php');
			}
			else{
				$_SESSION['status'] = "Email or password is invalid";
				//echo $credential.; echo "$password";
				header('location: login.php');

			}
		}

?>