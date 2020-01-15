<?php
include('security.php');

$connection = mysqli_connect("localhost","root","","adminpanel");

if(isset($_POST['login_btn'])){
			$email_login = $_POST['emaill'];
			$password_login = $_POST['passwordd'];

			$query = "SELECT * FROM event WHERE email ='$email_login' AND password ='$password_login' ";
			$query_run = mysqli_query($connection,$query);

			$usertypes = mysqli_fetch_array($query_run);
			
			if ($usertypes['usertype'] == "admin") 
			{//without fetch array everyone logs in
				$_SESSION['username'] = $email_login;
				header('location: index.php');
			}		
			else if($usertypes['usertype'] == "Event Owner")
			{
				$_SESSION['username'] = $email_login;
				header('location:owner.php');
			}
			else if($usertypes['usertype'] == "Event Vendor")
			{
				$_SESSION['username'] = $email_login;
				header('location: vendor.php');
			}
			else{
				$_SESSION['status'] = "Email or password is invalid";
				//echo $email_login.; echo "$password";
				header('location: login.php');

			}
		}

?>