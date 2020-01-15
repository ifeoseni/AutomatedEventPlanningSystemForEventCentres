<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
$username = $_SESSION['username'];
//echo $username ;
?>


<div class="modal fade" id="budgetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Budget title</h5>
       



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">


        	<div class="form-group">
            <input type="hidden" name="username" class="form-control" placeholder="Current username" value="<?php echo $username; ?>" required >
          </div>
		
            <div class="form-group">
            <label>Name Of The Service You Need</label>
            <input type="text" name="budget_name" class="form-control" placeholder="Enter Name" required>
          </div>
          <div class="form-group">
            <label>Describe The Need</label>
            <input type="text" name="budget_description" class="form-control" placeholder="Enter what the usefulness of the service/item is to the success of the event. You can add the nmber of guests planned for here too" required>
          </div>
          <div class="form-group">
            <label>Estimate Price For The Service In ₦</label>
            <input type="Number" name="budget_estimate" class="form-control" placeholder="Enter the estimate you expect to purchase the service/item needed" required>
          </div>
          <div class="form-group">
            <label>Amount Spent In ₦</label>
            <input type="Number" name="budget_cost" class="form-control" placeholder="Enter the amount spent if you have gotten the item/service if not. Leave blank or enter 0" >
          </div>
           <div class="form-group">
            <label>New Income Coming In ₦</label>
            <input type="Number" name="budget_income" class="form-control" placeholder="Enter Description" >
          </div>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="save_budget" class="btn btn-primary">Save</button>
        </div>
       
      </form>


    </div>
  </div>
</div>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Prepare Your Budget
          <form action="code.php">
            <!-- <button type="submit" name="delete_multiple_data" class="btn btn-danger">Delete Multiple Data</button> -->
          </form>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#budgetModal" >
              ADD
            </button>
    </h6>
  </div>

  <div class="card-body">
    <?php
         if (isset($_SESSION['success']) && $_SESSION['success'] !='') 
           {
             echo '<h2 class="bg-primary text-white">'. $_SESSION['success'].'</h2>';
             unset($_SESSION['success']);
              # code...
           }
          if (isset($_SESSION['status']) && $_SESSION['status'] !='') 
          {
              echo "<h2 class='bg-danger'>". $_SESSION['status']."</h2>";
              unset($_SESSION['status']);
              # code...
            }
      ?>
    <div class="table-responsive">
      <?php
          $query = "SELECT * FROM budget";  
          $query_run = mysqli_query($connection,$query);    

          if (mysqli_num_rows($query_run) > 0)
          {
          
            
             ?>


        
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr class="text-white bg-info">
            <th> Name of Service / Item Needed </th>
             <th>Description Of Item / Service</th>
            <th>Your Estimate In ₦ </th>
            <th>Amount Actually Spent On The Service / Item</th>
            <th>Income As At That Time ₦ <i class="fa fa-envelope"></i></th>
            <th>Date <i class="fa fa-calendar text-danger "></i>  This Budget Was Made</th>

            <!-- <i class="fa fa-balance-scale text-warning"></i> -->
          </tr>
        </thead>
        <tbody>
            <?php
              while($row = mysqli_fetch_assoc($query_run))
              { 
            ?>
              <tr>
                  <td> <?php echo $row['user_need']; ?></td>
                  <td> <?php echo $row['describe_need']; ?></td>
                  <?php
                  	if ($row['estimate_price'] > $row['amount_spent']) {
                  		echo "<td class='text-dark'>".$row['estimate_price']."</td>";
                  		echo "<td class='text-success'>".$row['amount_spent']."</td>";
                  	}else{
                  		echo "<td class='text-primary'>".$row['estimate_price']."</td>";
                  		echo "<td class='text-danger'>".$row['amount_spent']."</td>";
                  	}

                  ?>
                 
                  <td> <?php echo $row['proposed_income']; ?> </td>
                  <td> <?php echo $row['date_budget_was_made']; ?> </td>
               	  <td>	
                 <form action="budget_edit.php" method="post">
                      <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                      <button  type="submit" name="edit_budget_btn" class="btn btn-success"> EDIT</button> <!-- Go to budget_edit.php -->
                  </form>
                 </td>
                 <td>
                  <form action="code.php" method="post">
                  <input type="hidden" name="budget_delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="budget_delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            	</td>
            
          </tr>
            <?php

            	//$estimateTotal +=$row['estimate_price'];
          	// $amountSpentTotal +=$row['amount_spent'];
          	// $incomeTotal +=$row['proposed_income'];
              }
            ?>
          
         
        
        </tbody>
        <tfoot>
        	<th> Total </th><?php 
        	$see=  mysqli_query($connection,"SELECT SUM(estimate_price)  FROM budget");
        	$tSpend=  mysqli_query($connection,"SELECT SUM(amount_spent)  FROM budget");
        	$pIncome=  mysqli_query($connection,"SELECT SUM(proposed_income)  FROM budget");
        	echo "<th></th>";
        	echo "<th>".mysqli_fetch_assoc($see)['SUM(estimate_price)']."</th>";
            echo "<th>".mysqli_fetch_assoc($tSpend)['SUM(amount_spent)']."</th>";
            echo "<th>".mysqli_fetch_assoc($pIncome)['SUM(proposed_income)']."</th>";
            echo "<th> On ".date("l d M Y")."</th>";

           
            	//  while($output = mysqli_fetch_assoc($see)){
            	//  
            	//  echo "<th>".$output['SUM(estimate_price)']."</th>";
            	//  echo "<th>".$output['SUM(amount_spent)']."</th>";
            	//  echo "<th>".$output['SUM(proposed_income)']."</th>";
            	//  echo "<th></th>";

            	// }
            	 ?> 
        	
        </tfoot>
      </table>
       <?php
            } 
          else
          {
            echo "No record found";
          } 
        ?>

    </div>
  </div>
</div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>