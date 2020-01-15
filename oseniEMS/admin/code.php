<?php
		include('security.php');




if (isset($_POST['submitrating'])) {
	$username = $_POST['username'];
	$rate_vendor =$_POST['rate_vendor'];
	$new_rater =1; $zero=0;
	$check_rating = "SELECT * FROM vendor WHERE vendor_rating = '$zero' AND rated_by= '$zero' AND username= '$username' ";
	$checking_rating = mysqli_query($connection,$check_rating);
	$fetchVendor = mysqli_num_rows($checking_rating);
	if($fetchVendor == 1 ) { //$fetchNum == 1
		$query = "UPDATE vendor SET vendor_rating='$rate_vendor', rated_by= '$new_rater' WHERE username='$username' ";
		$query_run = mysqli_query($connection,$query);
		$_SESSION['success'] = "You are the first to rate this Vendor ".$rate_vendor; 
	    header("location: ratevendor.php"); 
	}//end of this if

	else{
		$add_rating ="SELECT * FROM vendor WHERE username='$username' AND rated_by != '$zero' "; //AND rated_by != '0'";
		$adding_rating = mysqli_query($connection,$add_rating);

		if (mysqli_num_rows($adding_rating) == 1) {

			while ($row = mysqli_fetch_assoc($adding_rating)) {
				$current_rating = $row['vendor_rating'];
			$rated_by =  $row['rated_by']; $new_raters = $rated_by +1;
			$new_rating =( ( $current_rating * $rated_by) + $rate_vendor) / $new_raters;
			$rateAgain = "UPDATE vendor SET vendor_rating = '$new_rating', rated_by = '$new_raters' WHERE username = '$username' ";
			$sendrateAfain = mysqli_query($connection,$rateAgain);
			$_SESSION['success'] = "New Rating of vendor is ". $current_rating; 
	   	    header("location: ratevendor.php");
			}
			
		}
		else{
				$_SESSION['success'] = "There seems to be a problem updating the vendor score";
	   			header("location: ratevendor.php");
			}
		/*
		if ($adding_rating) {

				while($row = mysqli_fetch_assoc($adding_rating)){
					$current_rating = $row['vendor_rating'];
					$rater_numbers = $row['rated_by']; $new_raters = $rater_numbers+1;
					$new_rating = ( ($current_rating * $rater_numbers) + $rate_vendor )/ ($rater_numbers + $new_rater);


				$query = "UPDATE vendor SET vendor_rating='$new_rating', rated_by= '$new_raters' WHERE username='$username' ";
					$_SESSION['success'] = "Your rating has been added for this vendor"; 
	   				 header("location: ratevendor.php");
				}//end of while

		}//end of if
		else{
			$_SESSION['status'] = "Your rating could not be completed"; 
	  		header("location: ratevendor.php"); 
		}//endo of if-else on top

		*/

		//$_SESSION['status'] = "You were not able to give the vendor the rating ".$rate_vendor."Please try again late. This maybe because you have rated the vendor already.r"; 
	   // header("location: ratevendor.php"); 
	}

}



if (isset($_POST['update_budget'])) {
	
		$id = $_POST['edit_id'];
		$username = $_POST['username'];
		$user_need =$_POST['user_need'];
		$describe_need =$_POST['describe_need'];
		$estimate_price =$_POST['estimate_price']; 
		$proposed_income = $_POST['proposed_income'];
		$amount_spent = $_POST['amount_spent'];
		$date_budget_was_made = date("l d M Y");

		$query ="UPDATE budget SET id= '$id', username = '$username', user_need ='$user_need',describe_need = '$describe_need',estimate_price ='$estimate_price', proposed_income = '$proposed_income', amount_spent = '$amount_spent', date_budget_was_made = '$date_budget_was_made' WHERE id = '$id'";
		$query_run = mysqli_query($connection,$query);

		if($query_run)
		{
			$_SESSION['success'] = "Budget Item Data Was Updated";
			header("location:budget.php");
		}
		else{
			$_SESSION['status'] = "Budget Item Data Was Not Updated";
			header("location:budget_edit.php");
		}
		
	}






if (isset($_POST['budget_delete_btn'])) {
			$delete_id = $_POST['budget_delete_id'];
			$query = "DELETE FROM budget WHERE id='$delete_id' ";
			$query_run =mysqli_query($connection,$query);
			if ($query_run) {
				$_SESSION['success'] = "That expense was deleted. ";
				header("location: budget.php");
			}else{
				$_SESSION['status'] = "There was issue deleting that part of your budget.";
				header("location: budget.php");
			}
		}

if(isset($_POST["save_budget"])){
			$user           = $_POST['username'];
			$user_need      =$_POST["budget_name"];
			$describe_need  =$_POST["budget_description"];
			$estimate_price =$_POST["budget_estimate"];
			$amount_spent   =$_POST["budget_cost"];
			$proposed_income =$_POST["budget_income"];
			$date_budget_was_made = date("l d M Y");

			
			$query = "INSERT INTO budget (username,user_need,describe_need,estimate_price,amount_spent,proposed_income,date_budget_was_made) VALUES ('$user','$user_need','$describe_need','$estimate_price','$amount_spent','$proposed_income','$date_budget_was_made')";
				$query_run =mysqli_query($connection,$query);

				if($query_run){
					//echo "Saved";
					$_SESSION['success'] = "The budget has been added for you";
					header("location:budget.php");
				}else{
					$_SESSION['status'] = "The budget was not added. Please try again later";
					header("location:budget.php");
				}

}//isset

if (isset($_POST['bookVendor'])) {
	$eventowner = $_SESSION['username'];

	$vendorContacted = $_POST['vendorContacted'];
	$vendorContactedCheck = "SELECT * FROM eventowner WHERE vendorContacted ='' ";
	$vendorContactedCheckQuery = mysqli_query($connection,$vendorContactedCheck);
	if ($vendorContactedCheckQuery) {
		$query = "UPDATE eventowner SET vendorContacted = '$vendorContacted' WHERE username='$eventowner'";
	    $query_run = mysqli_query($connection,$query);
	    if($query_run) {
	    	$_SESSION['success'] = "Hi, Vendor ".$vendorContacted." has been assigned to you"; 
	    	header("location: bookvendor.php"); 
	    }else{
	    	$_SESSION['status'] ="You were not able to contact the vendor. Contact him/ her via the email".$vendorContacted; 
	    	header("location: bookvendor.php"); 
	    }
	}else{

	}

}














if (isset($_POST['update_vendor_category'])) {
	$id = $_POST['edit_id'];
	$vendor_category = $_POST['edit_vendor_category'];
	$query ="UPDATE vendorcategory SET vendor_category = '$vendor_category' WHERE id = '$id'";
	$query_run = mysqli_query($connection,$query);

		if($query_run)
		{
			$_SESSION['success'] = "Vendor Category Has Been Updated";
			header("location: manage_vendor_category.php");
		}
		else{
			$_SESSION['status'] = "Vendor Category Has Not Been Updated";
			header("location:manage_vendor_category.php");
		}

}
if (isset($_POST['add_vendor_category']))
	     { 
	      $vendor_category = $_POST['vendor_category'];
	      $check_event_type = "SELECT * FROM vendorcategory WHERE vendor_category='$vendor_category'";
				$check_category_run = mysqli_query($connection,$check_category);
				if (mysqli_num_rows($query_run) >0) {
                 	$_SESSION['status'] = "Vendor  ".$vendor_category." already exists. ";
					header("location: manage_vendor_category.php");
				}
				else{
					$query = "INSERT INTO vendorcategory (vendor_category) VALUES ('$vendor_category')";
					$query_run = mysqli_query($connection,$query);
					if ($query_run) {
						$_SESSION['success'] = "The Vendor Category has been added.";
						header('location: manage_vendor_category.php');
					}else{
					$_SESSION['status'] = "The Vendor Category was not added. It may exist or try again later.";
					header('location: manage_vendor_category.php');
						}
				}
      
    	}





if (isset($_POST['update_event_type'])) {
		$id = $_POST['edit_id'];	
		$edit_event_type = $_POST['edit_event_type'];

		$query ="UPDATE eventtype SET event_type = '$edit_event_type' WHERE id = '$id'";
		$query_run = mysqli_query($connection,$query);

		if($query_run)
		{
			$_SESSION['success'] = "Your Data is Updated";
			header("location: manage_event_type.php");
		}
		else{
			$_SESSION['status'] = "Your Data is nOT Updated";
			header("location:manage_event_type.php");
		}
		
	}

		


		if (isset($_POST['delete_event_type'])) {
			$delete_id = $_POST['delete_id'];
			$query = "DELETE FROM eventtype WHERE id='$delete_id' ";
			$query_run =mysqli_query($connection,$query);
			if ($query_run) {
				$_SESSION['success'] = "Event type has been deleted. ";
				header("location: manage_event_type.php");
			}else{
				$_SESSION['status'] = "There was issue deleting the event type.";
				header("location: manage_event_type.php");
			}
		}

		if (isset($_POST['delete_vendor_category'])) {
			$delete_id = $_POST['delete_id'];
			$query = "DELETE FROM vendorcategory WHERE id='$delete_id' ";
			$query_run =mysqli_query($connection,$query);
			if ($query_run) {
				$_SESSION['success'] = "Vendor Category has been deleted. ";
				header("location: manage_vendor_category.php");
			}else{
				$_SESSION['status'] = "Vendor Category has not been deleted. Try again later.";
				header("location: manage_vendor_category.php");
			}
		}

		if (isset($_POST['add_event_type']))
	     { 
	      $event_type = $_POST['event_type'];
	      $check_event_type = "SELECT * FROM eventtype WHERE event_type='$event_type'";
				$check_category_run = mysqli_query($connection,$check_category);
				if (mysqli_num_rows($query_run) >0) {
                 	$_SESSION['status'] = "Event type ".$event_type." already exists. ";
					header("location: add_event_type.php");
				}
				else{
					$query = "INSERT INTO eventtype (event_type) VALUES ('$event_type')";
					$query_run = mysqli_query($connection,$query);
					if ($query_run) {
						$_SESSION['success'] = "The Category has been added.";
						header('location: manage_event_type.php');
					}else{
					$_SESSION['status'] = "The Category was not added. It may exist or try again later.";
					header('location: add_event_type.php');
						}
				}
      
    	}

		if (isset($_POST['owner_upload'])){ 
		     $username = $_POST['username'];
		      $owner_name = $_POST['owner_name'];
		      $event_date = $_POST['event_date'];
		      $event_type = $_POST['event_type'];
		      $event_space_selected = $_POST['event_space_selected'];
		      $payment_type =$_POST['payment_type'];
		      $phone_number = $_POST['phone_number'];
		      $vendor_needed  = $_POST['vendor_needed'];
		      $planner_name  = $_POST['planner_name'];
		      $budget_price = $_POST['budget_price'];
		      $owner_image= $_FILES["owner_image"]["name"];
		      $_SESSION['bookvendor'] = $vendor_needed;
		      $_SESSION['payment_type']  =$payment_type;  

		       if(file_exists('upload/'.$_FILES["owner_image"]["name"]))
		      {
		        $store = $_FILES["owner_image"]["name"]; 
		        $_SESSION['status'] = "Image already exists in our database, your account was not created or updated. Please use another picture of yours to upload your data into our database".$$tore;
		        header('location: owner.php');
		      }

		      	$check_owner = "SELECT * FROM eventowner WHERE username='$username'";
				$check_owner_status = mysqli_query($connection,$check_owner);
				if (mysqli_num_rows($check_owner_status) >0) {
	            	$_SESSION['success'] = "Your details will be updated shortly";
	                $query = "UPDATE eventowner SET owner_name='$owner_name', event_date='$event_date', event_type='$event_type', event_space_selected = '$event_space_selected',payment_in_full ='$payment_type', phone_number = '$phone_number', vendor_needed = '$vendor_needed', planner_name = '$planner_name', budget_price = '$budget_price', owner_image ='$owner_image' WHERE username='$username'";
	                $query_run = mysqli_query($connection,$query);
					//header("location:vendor_category.php");
					if ($query_run) {
						 move_uploaded_file($_FILES["owner_image"]["tmp_name"], "upload/".$_FILES["owner_image"]["name"]);//to upload images
						$_SESSION['success'] = "Update successful";
						header('location:bookvenue.php');
						// if( ($_SESSION['bookvendor'] == "yes") AND ($_SESSION['payment_type'] = "yes") ){
						// 	header("location: bookvenue.php"); // before we were using bookvendor
						// }else{
						// 	header("location: owner.php");
						// }
						

					}else{
						$_SESSION['status'] = "Sorry, we were not able to upload your details into our database. Please try again at another time.";
		          		header('location: owner.php');	
					}

				}else{
			        $query = "INSERT INTO eventowner (owner_name,event_date,event_type,event_space_selected,payment_in_full,phone_number,vendor_needed,planner_name,budget_price,owner_image,username) VALUES ('$owner_name','$event_date','$event_type','$event_space_selected','$payment_type','$phone_number','$vendor_needed','$planner_name','$budget_price','$owner_image','$username')";
			        $query_run = mysqli_query($connection,$query);

			        if ($query_run){
			          move_uploaded_file($_FILES["owner_image"]["tmp_name"], "upload/".$_FILES["owner_image"]["name"]);//to upload images
			          $_SESSION['success'] = "Your account has been created.";
			          if ($_SESSION['bookvendor'] == "yes") {
							header("location: bookvendor.php");
						}else{
							header("location: owner.php");
						}
			        }else{
			          $_SESSION['status'] = "Sorry, we were not able to upload your details into our database. Please try again at another time.";
			          header('location: owner.php');
			    }	        
	      }

      
    }


		if(isset($_POST['search_data']))
		{
			$id = $_POST['id'];
			$visible = $_POST['visible'];

			$query ="UPDATE faculty SET visible='$visible' WHERE id='$id'";
			$query_run = mysqli_query($connection,$query);
		}

		if(isset($_POST['delete_multiple_data']))//for deleting multiple data in faculty.php
		{
			$id = "1";
			$query = "DELETE FROM faculty WHERE visible='$id' ";
			$query_run = mysqli_query($connection,$query);

			if($query_run)
			{
				$_SESSION['success'] = "Those rows have been deleted.";
				header('location: faculty.php');
			}
			else
			{
				$_SESSION['status'] = "Those rows have not been deleted";
				header('location: faculty.php');
			}

		}



			if (isset($_POST['vendor_category_upload'])) {
				$vendor_category = $_POST['vendor_category'];

				$check_category = "SELECT * FROM vendorcategory WHERE vendor_category='$vendor_category'";
				$check_category_run = mysqli_query($connection,$check_category);
				if (mysqli_num_rows($query_run) >0) {
                  $_SESSION['status'] = "Category ".$vendor_category." already exists";
					header("location:vendor_category.php");
				}
				else{
					$query = "INSERT INTO vendorcategory (vendor_category) VALUES ('$vendor_category')";
					$query_run = mysqli_query($connection,$query);
					if ($query_run) {
						$_SESSION['success'] = "The Category has been added.";
						header('location: vendor_category.php');
					}else{
					$_SESSION['status'] = "The Category was not added. It may exist or try again later.";
					header('location: vendor_category.php');
						}
				}
				
			}




		if (isset($_POST['vendor_upload']))
		 { 
		 	$username = $_POST['username'];
			$vendor_name = $_POST['vendor_name'];
			$vendor_service = $_POST['vendor_service'];
			$vendor_category = $_POST['vendor_category'];
			$vendor_phone = $_POST['vendor_phone'];
			$vendor_email  = $_POST['vendor_email'];
			$vendor_image = $_FILES["vendor_image"]["name"];




				if(file_exists('upload/'.$_FILES["vendor_image"]["name"])){
					$store = $_FILES["vendor_image"]["name"];
					$_SESSION['status'] = "Image already exists in our database. Please use another picture of yours to upload your data into our database".$$tore;
					header('location: vendor.php');
				}

		   

		      	$check_vendor = "SELECT * FROM vendor WHERE username='$username'";
				$check_vendor_status = mysqli_query($connection,$check_vendor);
				if (mysqli_num_rows($check_vendor_status) >0) {
	                $query = "UPDATE vendor SET vendor_name='$vendor_name', vendor_service='$vendor_service', vendor_category='$vendor_category', vendor_phone = '$vendor_phone', vendor_email = '$vendor_email', vendor_image = '$vendor_image' WHERE username='$username'";
	                $query_run = mysqli_query($connection,$query);
					//header("location:vendor_category.php");
					if ($query_run) {
						 move_uploaded_file($_FILES["vendor_image"]["tmp_name"], "upload/".$_FILES["vendor_image"]["name"]);//to upload images
						$_SESSION['success'] = "Update successful";
						header("location: vendor.php");

					}else{
						$_SESSION['status'] = "Sorry, we were not able to upload your details into our database. Please try again at another time.";
		          		header('location: vendor.php');	
					}

				}else{
					$query = "INSERT INTO vendor (vendor_name,vendor_service,vendor_category,vendor_phone,vendor_email,vendor_image,username) VALUES ('$vendor_name','$vendor_service','$vendor_category','$vendor_phone','$vendor_email','$vendor_image','$username')";
					$query_run = mysqli_query($connection,$query);

					if ($query_run)
					 {
					 	move_uploaded_file($_FILES["vendor_image"]["tmp_name"], "upload/".$_FILES["vendor_image"]["name"]);//to upload images
						$_SESSION['success'] = "Your details have been added into our database";
						header('location: vendor.php');
					}
					else
					{
						$_SESSION['status'] = "Sorry, we were not able to upload your details into our database. Please try again at another time.";
						header('location: vendor.php');
					}
				}
			
			}

		if (isset($_POST['save_faculty']))
		 {
			$name = $_POST['faculty_name'];
			$designation = $_POST['faculty_designation'];
			$description = $_POST['faculty_description'];
			$images = $_FILES["faculty_image"]["name"];

			if(file_exists('upload/'.$_FILES["faculty_image"]["name"]))
			{
				$store = $_FILES["faculty_image"]["name"];
				$_SESSION['status'] = "Image already exists.".$$tore;
				header('location: faculty.php');
			}
			else{
				$query = "INSERT INTO faculty (name,designation,description,images) VALUES ('$name','$designation','$description','$images')";
				$query_run = mysqli_query($connection,$query);

				if ($query_run)
				 {
				 	move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);//to upload images
					$_SESSION['success'] = "Faculty Added";
					header('location: faculty.php');
				}
				else
				{
					$_SESSION['status'] = "Faculty not added";
					header('location: faculty.php');
				}
			}

			
		}

		if (isset($_POST['delete_faculty'])) {
			$id =$_POST['delete_id'];
			

			$query = "DELETE FROM faculty WHERE id = '$id'";
			$query_run = mysqli_query($connection,$query);
			if ($query_run)
			 {
				$_SESSION['success']= "Your Data is Deleted";
				header("location: faculty.php");
			}
			else
			{
				$_SESSION['status']= "Your Data is Not Updated";
				header("location: faculty.php");				
			}
		}











		if(isset($_POST['faculty_update_btn']))
		{
			$edit_id = $_POST['edit_id'];
			$edit_name = $_POST['edit_name'];
			$edit_designation = $_POST['edit_designation'];
			$edit_description = $_POST['edit_description'];			
			$edit_faculty_image =$_FILES["faculty_image"]['name'];

			$query ="UPDATE faculty SET name = '$edit_name', designation='$edit_designation', description = '$edit_description', images ='$edit_faculty_image' WHERE id ='$edit_id'  ";
			$query_run = mysqli_query($connection,$query);

			if ($query_run) 
			{
				move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);//to upload images
				$_SESSION['success'] = "Faculty Updated";
				header("location: faculty.php");
			}
			else
			{
				$_SESSION['status'] = "Faculty Not Updated";
				header("location: faculty.php");
				echo $edit_description;
			}


		}

		if (isset($_POST['faculty_delete_btn'])) {
			$id = $_POST['faculty_delete_id'];

			$query = "DELETE FROM faculty WHERE id= '$id' ";
			$query_run = mysqli_query($connection,$query);
			echo $query_run;
			if ($query_run) {
				$_SESSION['success'] = "Your Data Is Deleted";
				header("location: faculty.php");
			}
			else
			{
				$_SESSION['status'] = "Faculty Data Is Not Deleted";
				header("location: faculty.php");
			}
		}


		if(isset($_POST["registerbtn"])){
			$username =$_POST["username"];
			$email =$_POST["email"];
			$password =$_POST["password"];
			$cpassword =$_POST["confirmpassword"];
			$usertype = $_POST['usertype'];
			
			if($password === $cpassword){

				$query = "INSERT INTO event (username,email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
				$query_run =mysqli_query($connection,$query);

				if($query_run){
					//echo "Saved";
					$_SESSION['success'] = "Admin Profile Added";
					header("location:register.php");
				}else{
					echo "Not saved";
					$_SESSION['status'] = "Admin Profile Not Added";
					header("location:register.php");
				}

			}else{
				$_SESSION['status'] = "Password And Confirm Password Does Not Match";
				header("location:register.php");
			}



		}

		if(isset($_POST["registerguest"])){
			$username =$_POST["username"];
			$email =$_POST["email"];
			$fname =$_POST['fname'];
			$lname =$_POST['lname'];
			$password =$_POST["password"];
			$cpassword =$_POST["confirmpassword"];
			$usertype = $_POST['usertype'];
			if ($usertype == "2") {
				$usertype = "Event Vendor";
			}
			if ($usertype == "1") {
				$usertype = "Event Owner";
			}
			if($password === $cpassword){
				$query = "INSERT INTO event (username,email,firstname,lastname,password,usertype) VALUES ('$username','$email','$fname','$lname','$password','$usertype')";
				$query_run =mysqli_query($connection,$query);
				if($query_run){
					//echo "Saved";
					$_SESSION['success'] = "Welcome. Please kindly fill this form to create your account";//"$usertype Profile has been created for you";
					header("location:login.php");
				}else{
					$_SESSION['status'] = "There seems to be an error creating your profile";//"$usertype Profile has Not been created for you";
					header("location:login.php");
				}
			}else{
				$_SESSION['status'] = "Password And Confirm Password Does Not Match";
				header("location:../index.php");
			}
		}






	if (isset($_POST['updatebtn'])) {
	
		$id = $_POST['edit_id'];
		$username =$_POST['edit_username'];
		$email =$_POST['edit_email'];
		$password =$_POST['edit_password']; 
		$updateusertype = $_POST['update_usertype'];

		$query ="UPDATE event SET username = '$username', email = '$email', password ='$password',usertype = '$updateusertype' WHERE id = '$id'";
		$query_run = mysqli_query($connection,$query);

		if($query_run)
		{
			$_SESSION['success'] = "Your Data is Updated";
			header("location:register.php");
		}
		else{
			$_SESSION['status'] = "Your Data is nOT Updated";
			header("location:register.php");
		}
		
	}




		if(isset($_POST['delete_btn'])){
			$id =$_POST['delete_id'];
			$query = "DELETE FROM event WHERE id = '$id'";
			$query_run = mysqli_query($connection,$query);

			if ($query_run) {
				$_SESSION['success'] = "Your data is deleted";
				header("location:register.php");
							# code...
			}
			else{
					$_SESSION['status'] = "Your data is not deleted";
				header("location:register.php");

			}			
		}






		if (isset($_POST['delete_about'])) {
			$id =$_POST['delete_id'];
			

			$query = "DELETE FROM abouts WHERE id = '$id'";
			$query_run = mysqli_query($connection,$query);
			if ($query_run)
			 {
				$_SESSION['success']= "Your Data is Deleted";
				header("location: aboutus.php");
			}
			else
			{
				$_SESSION['status']= "Your Data is Not Updated";
				header("location: aboutus.php");				
			}
		}

		if (isset($_POST['update_about'])) {
			$id =$_POST['edit_id'];
			$title =$_POST['edit_title'];
			$subtitle =$_POST['edit_subtitle'];
			$description =$_POST['edit_description'];
			$links =$_POST['edit_links'];

			$query = "UPDATE abouts SET title ='$title', subtitle = '$subtitle', description = '$description', links = '$links' WHERE id = '$id'";
			$query_run = mysqli_query($connection,$query);
			if ($query_run)
			 {
				$_SESSION['success']= "Your Data is Updated";
				header("location: aboutus.php");
			}
			else
			{
				$_SESSION['status']= "Your Data is Not Updated";
				header("location: aboutus.php");				
			}
		}

		if(isset($_POST['about_save']))
		{
			$title =$_POST['title'];
			$subtitle =$_POST['subtitle'];
			$description =$_POST['description'];
			$links =$_POST['links'];

			$query = "INSERT INTO abouts (title,subtitle,description,links) VALUES ('$title','$subtitle','$description','$links')";
			$query_run = mysqli_query($connection,$query);
			if($query_run)
			{
				$_SESSION['success'] = "About Us Added";
				header("location: aboutus.php");
			}
			else
			{
				$_SESSION['status'] = "About Us Not Added";
				header("location: aboutus.php");
			}
		}




		if(isset($_POST['add_event_space']))
		{
			$spaceid =$_POST['spaceid'];
			$spacename =$_POST['spacename'];
			$spacedescription =$_POST['spacedescription'];
			$spaceprice = $_POST['spaceprice'];
			$spacemanager =$_POST['spacemanager'];
			$spaceseat =$_POST['spaceseat'];

			$query = "INSERT INTO eventspace (spaceid,spacename,spacedescription,spaceprice,spacemanager,spaceseat) VALUES ('$spaceid','$spacename','$spacedescription','$spaceprice','$spacemanager',$spaceseat)";
			$query_run = mysqli_query($connection,$query);
			if($query_run)
			{
				$_SESSION['success'] = "New Event Space Added";
				header("location: addcentre.php");
			}
			else
			{
				$_SESSION['status'] = "New Event Space Not Added";
				header("location: addcentre.php");
			}
		}




		if(isset($_POST['delete_space']))
		{
			$id =$_POST['deletespace_id'];
			$query = "DELETE FROM eventspace WHERE id = '$id'";

			$query_run = mysqli_query($connection,$query);
			if($query_run)
			{
				$_SESSION['success'] = "Event Space Deleted";
				header("location: addcentre.php");
			}
			else
			{
				$_SESSION['status'] = "Event Space Not Deleted";
				header("location: addcentre.php");
			}
		}

		if (isset($_POST['update_centre'])) {
		$id = $_POST['edit_id'];
		$spaceid =$_POST['edit_spaceid'];
		$spacename =$_POST['edit_spacename'];
		$spacedescription =$_POST['edit_spacedescription'];
		$spaceprice = $_POST['edit_spaceprice'];
		$spaceseat =$_POST['edit_spaceseat'];
		$spacemanager =$_POST['edit_spacemanager'];

		$query ="UPDATE eventspace SET spaceid='spaceid', spacename = '$spacename', spacedescription = '$spacedescription', spaceprice ='$spaceprice', spacemanager = '$spacemanager', spaceseat = '$spaceseat'  WHERE id = '$id'";
		$query_run = mysqli_query($connection,$query);

		if($query_run)
		{
			$_SESSION['success'] = "Details of The Event Centre Has Been Updated";
			header("location:addcentre.php");
		}
		else{
			$_SESSION['sTATUS'] = "Details of The Event CEntre Has Not Been Updated";
			header("location:addcentre.php");
		}
		
	}

if (isset($_POST['staff_delete_btn'])) {
			$delete_id = $_POST['staff_delete_id'];
			$query = "DELETE FROM staff WHERE id='$delete_id' ";
			$query_run =mysqli_query($connection,$query);
			if ($query_run) {
				$_SESSION['success'] = "The staff details has been deleted ";
				header("location: staff.php");
			}else{
				$_SESSION['status'] = "The staff has not been removed from database.";
				header("location: staff.php");
			}
		}

		if(isset($_POST['update_staff_details']))
		{
			$edit_id = $_POST['edit_id'];
			$staff_id = $_POST['staff_id'];
			$staff_name = $_POST['staff_name'];	
			$staff_phone = $_POST['staff_phone'];
			$staff_email = $_POST['staff_email'];
			$staff_position = $_POST['staff_position'];
			$staff_image = $_FILES["staff_image"]['name'];

			$query ="UPDATE staff SET staff_id = '$staff_id', staff_name= '$staff_name', staff_phone = '$staff_phone', staff_email = '$staff_email', staff_position  = '$staff_position', staff_image = '$staff_image'  WHERE id ='$edit_id'  ";
			$query_run = mysqli_query($connection,$query);

			if ($query_run) 
			{
				move_uploaded_file($_FILES["staff_image"]["tmp_name"], "upload/".$_FILES["staff_image"]["name"]);//to upload images
				$_SESSION['success'] = "Staff Details Updated";
				header("location: staff.php");
			}
			else
			{
				$_SESSION['status'] = "Staff Details Not Updated";
				header("location: staff.php");
				
			}


		}


		if (isset($_POST['edit_staff_btn']))
		 {
			$staff_id= $_POST['staff_id'];
			$staff_name = $_POST['staff_name'];
			$staff_phone = $_POST['staff_phone'];
			$staff_email = $_POST['staff_email'];
			$staff_position = $_POST['staff_position'];
			$staff_image = $_FILES["staff_image"]["name"];

			if(file_exists('upload/'.$_FILES["staff_image"]["name"]))
			{
				$store = $_FILES["staff_image"]["name"];
				$_SESSION['status'] = "Image already exists.".$$tore;
				header('location: staff.php');
			}
			else{
				$query = "INSERT INTO staff (staff_id,staff_name,staff_phone,staff_email,staff_position,staff_image) VALUES ('$staff_id','$staff_name','$staff_phone','$staff_email','$staff_position','$staff_image')";
				$query_run = mysqli_query($connection,$query);

				if ($query_run)
				 {
				 	move_uploaded_file($_FILES["staff_image"]["tmp_name"], "upload/".$_FILES["staff_image"]["name"]);//to upload images
					$_SESSION['success'] = "Staff Added To The DataBase";
					header('location: staff.php');
				}
				else
				{
					$_SESSION['status'] = "Staff not added";
					header('location: staff.php');
				}
			}

			
		}



		
	if (isset($_POST['save_staff']))
		 {
			$staff_id= $_POST['staff_id'];
			$staff_name = $_POST['staff_name'];
			$staff_phone = $_POST['staff_phone'];
			$staff_email = $_POST['staff_email'];
			$staff_position = $_POST['staff_position'];
			$staff_image = $_FILES["staff_image"]["name"];

			if(file_exists('upload/'.$_FILES["staff_image"]["name"]))
			{
				$store = $_FILES["staff_image"]["name"];
				$_SESSION['status'] = "Image already exists.".$$tore;
				header('location: staff.php');
			}
			else{
				$query = "INSERT INTO staff (staff_id,staff_name,staff_phone,staff_email,staff_position,staff_image) VALUES ('$staff_id','$staff_name','$staff_phone','$staff_email','$staff_position','$staff_image')";
				$query_run = mysqli_query($connection,$query);

				if ($query_run)
				 {
				 	move_uploaded_file($_FILES["staff_image"]["tmp_name"], "upload/".$_FILES["staff_image"]["name"]);//to upload images
					$_SESSION['success'] = "Staff Added To The DataBase";
					header('location: staff.php');
				}
				else
				{
					$_SESSION['status'] = "Staff not added";
					header('location: staff.php');
				}
			}

			
		}





?>