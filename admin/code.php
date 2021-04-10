<?php
	include('security.php');
	$usertype= $_SESSION['usertype'];
if (isset($_POST['accept_work'])) {
	$getowner = $_POST['get_owner'];
	$currentuser = $_POST['current_user'];
	//echo $getowner;echo $currentuser;
	$vendorUserName = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM event WHERE email='$currentuser'"))['username'];
	$changestatus = mysqli_query($connection,"SELECT * FROM ownervendor WHERE userdetail = '$getowner' AND agreement = 'interested' AND (vendordetail='$currentuser' || vendordetail='$vendorUserName')");
	//echo mysqli_num_rows($changestatus);
	if(mysqli_num_rows($changestatus) == 1){
		$updatestatus = mysqli_query($connection, "UPDATE ownervendor SET agreement ='accepted' WHERE userdetail = '$getowner' AND (vendordetail='$currentuser' || vendordetail='$vendorUserName') ");
		if($updatestatus){
			$_SESSION['success']= "Deal sealed with ". $getowner;
			header("location:knowowners.php");
		}else{
			$_SESSION['status'] = "Your acceptance was not completed at the moment. Try again";
			header("location:knowowners.php");
		}
	}else{
		$_SESSION['status'] = "You have either accepted or rejected this event owner earlier";
		header("location:knowowners.php");
	}
}
if (isset($_POST['ratingvendors'])) {
	$rateVendor = $_POST['ratevendor'];
	$acceptedVendor = $_POST['acceptedvendors'];
	$owner =$_POST['owner'];
	$getVendor = mysqli_query($connection,"SELECT * FROM ownervendor WHERE userdetail='$owner' AND vendordetail='$acceptedVendor' AND agreement='accepted'");
	if($getVendor){
		mysqli_query($connection,"UPDATE ownervendor SET rating='$rateVendor' WHERE userdetail='$owner' AND vendordetail='$acceptedVendor'");
		$_SESSION['success'] = "Your rating for this vendor has been recorded. This current rating will stand unless you want to change it. Your rating score affects this vendor rating";
		
		$getVendorRating= mysqli_query($connection,"SELECT * FROM ownervendor WHERE vendordetail='$acceptedVendor' AND rating !=0");
		$storeRaters = mysqli_num_rows($getVendorRating); $storerating =0;
		while($total = mysqli_fetch_assoc($getVendorRating)){
			$storerating += $total['rating'];
		}
		$vendorRating = $storerating/$storeRaters;
		mysqli_query($connection,"UPDATE vendor SET vendor_rating = '$vendorRating', rated_by='$storeRaters' WHERE username = '$acceptedVendor' ");
		header("location:ratevendor.php");
	}
}
if (isset($_POST['reject_offer'])) {
	$getowner = $_POST['get_owner'];
	$currentuser = $_POST['current_user'];
	echo $getowner;echo $currentuser;
	$vendorUserName = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM event WHERE email='$currentuser'"))['username'];
	$changestatus = mysqli_query($connection,"SELECT * FROM ownervendor WHERE userdetail = '$getowner' AND agreement = 'interested' AND (vendordetail='$currentuser' || vendordetail='$vendorUserName')");
	echo mysqli_num_rows($changestatus);
	if(mysqli_num_rows($changestatus) == 1){
		$updatestatus = mysqli_query($connection, "UPDATE ownervendor SET agreement ='not interested' WHERE userdetail = '$getowner' AND (vendordetail='$currentuser' || vendordetail='$vendorUserName') ");
		if($updatestatus){
			$_SESSION['success']= "You have rejected working with the event owner ". $getowner;
			header("location:knowowners.php");
		}else{
			$_SESSION['status'] = "Your rejection was not completed. Try again";
			header("location:knowowners.php");
		}
	}else{
		$_SESSION['status'] = "You have either accepted or rejected this event owner earlier";
		header("location:knowowners.php");
	}
}

if(isset($_POST['owner_upload'])){ 
    $username = $_POST['username'];
    $owner_name = $_POST['owner_name'];
    $event_date = $_POST['proposed_event_date'];
    $event_type = $_POST['event_type'];
    $event_space_selected = $_POST['event_space_selected'];
    $phone_number = $_POST['phone_number'];    
    $vendor_needed  = $_POST['vendor_needed'];
    $planner_name  = $_POST['planner_name'];
    $payment_type = $_POST['payment_type'];
    $owner_image= $_FILES["owner_image"]["name"];
    $_SESSION['bookvendor'] = $vendor_needed;

    if (strlen($phone_number) != (10 || 14) ) 	  { $_SESSION['status'] = "Your phone number is not 11 or 14. ".strlen($phone_number) ;header("location: owner.php"); }
    
  $check_owner = "SELECT * FROM eventowner WHERE username='$username' ";
  $check_owner_status = mysqli_query($connection,$check_owner);
	if(mysqli_num_rows($check_owner_status) >0) {
	    $_SESSION['success'] = "Your details will be updated shortly";
	    $query = "UPDATE eventowner SET owner_name='$owner_name', proposed_event_date='$event_date', event_type='$event_type', event_space_selected = '$event_space_selected',phone_number='$phone_number', vendor_needed = '$vendor_needed', planner_name = '$planner_name',payment_in_full = '$payment_type',owner_image ='$owner_image' WHERE username='$username'";
	    $query_run = mysqli_query($connection,$query);
	        
		        if(file_exists('upload/'.$_FILES["owner_image"]["name"])){
		        $store = $_FILES["owner_image"]["name"]; 
		        $_SESSION['status'] = "Image already exists in our database. Please use another picture of yours to upload your data into our database".$$tore; header('location: owner.php'); 
		        }

		        if ($query_run) {
		            move_uploaded_file($_FILES["owner_image"]["tmp_name"], "upload/".$_FILES["owner_image"]["name"]);//to upload images
		            $_SESSION['success'] = "Account update successful";header('location: owner.php');  
				}else{$_SESSION['status'] = "Account update unsuccessful. Please try again later.";header('location: owner.php');}

	}else{
	  $query = "INSERT INTO eventowner (username,owner_name,proposed_event_date,event_type,event_space_selected, phone_number,vendor_needed,planner_name,payment_in_full,owner_image) VALUES ('$username','$owner_name','$event_date','$event_type','$event_space_selected','$phone_number','$vendor_needed','$planner_name','$payment_type','$owner_image')";
	  $query_run = mysqli_query($connection,$query);

	    if ($query_run){
	     move_uploaded_file($_FILES["owner_image"]["tmp_name"], "upload/".$_FILES["owner_image"]["name"]);//to upload images
	      $_SESSION['success'] = "Your account has been created as an event owner.";header('location: owner.php');
	    }else{$_SESSION['status'] = "Sorry, we were not able to insert your details into our database. Please try again at another time.";header('location: owner.php'); }         
	}

}



 if (isset($_POST['payment_reference'])){ //bookvenue.php
	    $username = $_POST['sendusername'];
	    $spacename=  $_POST['sendspacename'];
	    $amount_paid = $_POST['amount_paid'];
	    $transaction_state = $_POST['is_transaction_complete'];
	    $payment_reference = $_POST['payment_reference'];    
	    $event_date = $_POST['event_date'];


	    if (empty($payment_reference) ) {
	    	$_SESSION['payment'] = "No payment has been made";
	    	header("location: bookvenue.php");
	    }else{
	    	 $date = date("d M Y");
	    	 $check_payment = mysqli_query($connection, "SELECT * FROM payment_made WHERE username = '$username' AND is_transaction_complete = 'yes' ");//checking if payment is complete	
			if (mysqli_num_rows($check_payment) > 0 ) {
		    	$_SESSION['payment'] = "You have already made a complete payment already ".$payment_reference; header("location: bookvenue.php");
		    }else{
		    	$checkleft = mysqli_query($connection,"SELECT * FROM payment_made WHERE 'username' = '$username'");
		    	$totalPaid = 0;
		    	while($paid = mysqli_fetch_assoc($checkleft)){
		    		$totalPaid += $paid['amount_paid'];
		    	}
		    	$totalAmount = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM eventspace WHERE spacename='$spacename'"));
		    	$amountToPay = $totalAmount['spaceprice'];

		    	if( ($totalPaid < $amountToPay) && ($totalPaid+$amount_paid < $amountToPay) ) {// checking that payment is 
		    		$query_run = mysqli_query($connection,"INSERT INTO payment_made (username,spacename,event_date,amount_paid,is_transaction_complete,payment_date,payment_reference ) VALUES ('$username','$spacename','$event_date','$amount_paid','$transaction_state','$date','$payment_reference')");
		    		$_SESSION['payment']= "Part payment has been made";
		   			header("location:bookvenue.php");
		    	}

		    	if( ($totalPaid < $amountToPay) && ($totalPaid+$amount_paid == $amountToPay) ){//full payment
		    		$transaction_state = 
		    		$query_run = mysqli_query($connection,"INSERT INTO payment_made (username,spacename,event_date,amount_paid,is_transaction_complete,payment_date,payment_reference ) VALUES ('$username','$spacename','$event_date','$amount_paid','$transaction_state','$date','yes')");
		    		$_SESSION['payment'] = "Payment completed";
		   			header("location:bookvenue.php");
		    	}
	
			}
	    }

	   
	}//else{	$_SESSION['payment'] = "You have not made any payment, no payment reference id was generated."; header('location: bookvenue.php'); 	}

 
 
if (isset($_POST['submitrating'])) {
	$username = $_POST['username'];
	$rate_vendor =$_POST['rate_vendor'];
	$new_rater =1; $zero = 0;

	$fetchVendor =mysqli_num_rows( mysqli_query($connection,"SELECT * FROM vendor WHERE vendor_rating = '$zero' AND rated_by= '$zero' AND username= '$username' ") );
	
	if($fetchVendor == 1 ) { //$fetchNum == 1
		$query_run = mysqli_query($connection,"UPDATE vendor SET vendor_rating='$rate_vendor', rated_by= '$new_rater' WHERE username='$username' ");
		$_SESSION['success'] = "You are the first to rate this Vendor ".$rate_vendor;    header("location: ratevendor.php"); 
	}//end of this if
	else{
		$adding_rating =mysqli_query($connection,"SELECT * FROM vendor WHERE username='$username' AND rated_by != '$zero' "); //AND rated_by != '0'";
		if (mysqli_num_rows($adding_rating) == 1) {
			while ($row = mysqli_fetch_assoc($adding_rating)) {
			$current_rating = $row['vendor_rating'];
			$rated_by =  $row['rated_by']; $new_raters = $rated_by +1;
			$new_rating =( ( $current_rating * $rated_by) + $rate_vendor) / $new_raters;
			//$rateAgain = "UPDATE vendor SET vendor_rating = '$new_rating', rated_by = '$new_raters' WHERE username = '$username' ";
			$sendrateAfain = mysqli_query($connection,"UPDATE vendor SET vendor_rating = '$new_rating', rated_by = '$new_raters' WHERE username = '$username' ");
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
	$checkstatus = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM ownervendor WHERE userdetail='$eventowner' AND vendordetail='$vendorContacted'"));
	if ($checkstatus > 0) {
		$_SESSION['success'] = "Hi, you have shown interest in this vendor previously."; 
    	header("location: bookvendor.php");   
	}else{
		$showInterest = mysqli_query($connection,"INSERT INTO ownervendor (userdetail,vendordetail,agreement) VALUES ('$eventowner','$vendorContacted','interested')");
		if ($showInterest) {
	    	$_SESSION['success'] = "Hi, your interest in vendor the vendor has been noticed. The vendor will contact you shortly "; 
	    	header("location: bookvendor.php");    
		}else{
			$_SESSION['status'] ="Your interest in the vendor was not sent. Try again later!"; 
		    header("location: bookvendor.php"); 
		}
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
	      $check_category = "SELECT * FROM vendorcategory WHERE vendor_category= '$vendor_category' ";
				$check_category_run = mysqli_query($connection,$check_category);
				if (mysqli_num_rows($check_category_run) >0) {
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
					if($usertype == 'Event Owner'){
						if ($query_run) {
							$_SESSION['success'] = "The Category has been added.";
							header('location: add_event_type.php');
						}else{
						$_SESSION['status'] = "The Category was not added. It may exist or try again later.";
						header('location: add_event_type.php');
						}
					}if($usertype == 'admin'){
						if ($query_run) {
							$_SESSION['success'] = "The Category has been added.";
							header('location: manage_event_type.php');
						}else{
						$_SESSION['status'] = "The Category was not added by adm. It may exist or try again later.";
						header('location: manage_event_type.php');
						}
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




	if (isset($_POST['vendor_upload'])){ 
	 	$username = $_POST['username'];
		$vendor_name = $_POST['vendor_name'];
		$vendor_service = $_POST['vendor_service'];
		$vendor_category = $_POST['vendor_category'];
		$vendor_phone = $_POST['vendor_phone'];
		$vendor_email  = $_POST['vendor_email'];
		$price_range = $_POST['price_range'];
		$vendor_image = $_FILES["vendor_image"]["name"];

		if(file_exists('upload/'.$_FILES["vendor_image"]["name"])){
			$store = $_FILES["vendor_image"]["name"];
			$_SESSION['status'] = "Image already exists in our database. Please use another picture of yours to upload your data into our database".$$tore;
			header('location: vendor.php');
		}

      	$check_vendor = "SELECT * FROM vendor WHERE username='$username'";
		$check_vendor_status = mysqli_query($connection,$check_vendor);
		if (mysqli_num_rows($check_vendor_status) >0) {
            $query = "UPDATE vendor SET vendor_name='$vendor_name', vendor_service='$vendor_service', vendor_category='$vendor_category', price_range ='$price_range', vendor_phone = '$vendor_phone', vendor_email = '$vendor_email', vendor_image = '$vendor_image' WHERE username='$username'";
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
			$query = "INSERT INTO vendor (vendor_name,vendor_service,vendor_category,price_range,vendor_phone,vendor_email,vendor_image,username) VALUES ('$vendor_name','$vendor_service','$vendor_category','$price_range','$vendor_phone','$vendor_email','$vendor_image','$username')";
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

	if (isset($_POST['save_faculty'])){
		$name = $_POST['faculty_name'];
		$designation = $_POST['faculty_designation'];
		$description = $_POST['faculty_description'];
		$images = $_FILES["faculty_image"]["name"];

		if(file_exists('upload/'.$_FILES["faculty_image"]["name"])){
			$store = $_FILES["faculty_image"]["name"];
			$_SESSION['status'] = "Image already exists.".$$tore;
			header('location: faculty.php');
		}
		else{
			$query_run = mysqli_query($connection,"INSERT INTO faculty (name,designation,description,images) VALUES ('$name','$designation','$description','$images')");

			if ($query_run){
			 	move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);//to upload images
				$_SESSION['success'] = "Faculty Added";	header('location: faculty.php');
			}
			else{$_SESSION['status'] = "Faculty not added";header('location: faculty.php');	}
		}

		
	}

	if (isset($_POST['delete_faculty'])) {
		$id =$_POST['delete_id'];
		$query_run = mysqli_query($connection,"DELETE FROM faculty WHERE id = '$id'");
		if ($query_run) { $_SESSION['success']= "Your Data is Deleted"; header("location: faculty.php");	}
		else{$_SESSION['status']= "Your Data is Not Updated";header("location: faculty.php"); }
	}


	if(isset($_POST['faculty_update_btn'])){
		$edit_id = $_POST['edit_id'];
		$edit_name = $_POST['edit_name'];
		$edit_designation = $_POST['edit_designation'];
		$edit_description = $_POST['edit_description'];			
		$edit_faculty_image =$_FILES["faculty_image"]['name'];

		$query ="UPDATE faculty SET name = '$edit_name', designation='$edit_designation', description = '$edit_description', images ='$edit_faculty_image' WHERE id ='$edit_id'  ";
		$query_run = mysqli_query($connection,$query);

		if ($query_run){
			move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);//to upload images
			$_SESSION['success'] = "Faculty Updated"; header("location: faculty.php");
		}
		else{$_SESSION['status'] = "Faculty Not Updated"; header("location: faculty.php"); echo $edit_description; }
	}

	if (isset($_POST['faculty_delete_btn'])) {
		$id = $_POST['faculty_delete_id'];
		$query_run = mysqli_query($connection,"DELETE FROM faculty WHERE id= '$id' ");
		if ($query_run) { $_SESSION['success'] = "Your Data Is Deleted"; header("location: faculty.php"); }
		else{ $_SESSION['status'] = "Faculty Data Is Not Deleted"; header("location: faculty.php");	}
	}


	if(isset($_POST["registerbtn"])){
		$username =$_POST["username"];
		$email =$_POST["email"];
		$password =$_POST["password"];
		$cpassword =$_POST["confirmpassword"];
		$usertype = $_POST['usertype'];
		$fname =$_POST['fname'];
		$lname =$_POST['lname'];
		
		if($password === $cpassword){
			$verifying= mysqli_query($connection,"SELECT * FROM event WHERE username='$username' || email='$email' ");
			if (mysqli_num_rows($verifying) > 0) {
				$_SESSION['status'] = "Someone has used that username or email. ";
				header("location:register.php");
			}else{
				$query_run =mysqli_query($connection,"INSERT INTO event (username,email,firstname,lastname,password,usertype) VALUES ('$username','$email','$fname','$lname','$password','$usertype')");
				if($query_run){	$_SESSION['success'] = "Admin Profile Added"; header("location:register.php"); }
				else{ $_SESSION['status'] = "Admin Profile Not Added"; header("location:register.php"); }
			}
			
		}
		else{ $_SESSION['status'] = "Password And Confirm Password Does Not Match"; header("location:register.php"); }
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
				$verifying= mysqli_query($connection,"SELECT * FROM event WHERE username='$username' || email='$email' ");
				if (mysqli_num_rows($verifying) > 0) {
					$_SESSION['status'] = "The uername or email has been taken please use another one to register";
					header("location:../index.php");
				}else{
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

		$query ="UPDATE eventspace SET spaceid='$spaceid', spacename = '$spacename', spacedescription = '$spacedescription', spaceprice ='$spaceprice', spacemanager = '$spacemanager', spaceseat = '$spaceseat'  WHERE id = '$id'";
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
			$_SESSION['success'] = "Staff Details Updated";	header("location: staff.php");
		}
		else{ $_SESSION['status'] = "Staff Details Not Updated"; header("location: staff.php");	}

	}


	if (isset($_POST['edit_staff_btn'])){
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
			$query = 
			$query_run = mysqli_query($connection,"INSERT INTO staff (staff_id,staff_name,staff_phone,staff_email,staff_position,staff_image) VALUES ('$staff_id','$staff_name','$staff_phone','$staff_email','$staff_position','$staff_image')");

			if ($query_run){
			 	move_uploaded_file($_FILES["staff_image"]["tmp_name"], "upload/".$_FILES["staff_image"]["name"]);//to upload images
				$_SESSION['success'] = "Staff Added To The DataBase"; header('location: staff.php');
			}
			else{ $_SESSION['status'] = "Staff not added"; header('location: staff.php'); }
		}

		
	}



		
	if (isset($_POST['save_staff'])){
		$staff_id= $_POST['staff_id'];
		$staff_name = $_POST['staff_name'];
		$staff_phone = $_POST['staff_phone'];
		$staff_email = $_POST['staff_email'];
		$staff_position = $_POST['staff_position'];
		$staff_image = $_FILES["staff_image"]["name"];

		if(file_exists('upload/'.$_FILES["staff_image"]["name"])){
			$store = $_FILES["staff_image"]["name"];
			$_SESSION['status'] = "Image already exists.".$$tore; header('location: staff.php');
		}
		else{
			$query_run = mysqli_query($connection,"INSERT INTO staff (staff_id,staff_name,staff_phone,staff_email,staff_position,staff_image) VALUES ('$staff_id','$staff_name','$staff_phone','$staff_email','$staff_position','$staff_image')");

			if ($query_run){
			 	move_uploaded_file($_FILES["staff_image"]["tmp_name"], "upload/".$_FILES["staff_image"]["name"]);//to upload images
				$_SESSION['success'] = "Staff Added To The DataBase"; header('location: staff.php');
			}
			else{ $_SESSION['status'] = "Staff not added"; header('location: staff.php'); }
		}
	}





?>
