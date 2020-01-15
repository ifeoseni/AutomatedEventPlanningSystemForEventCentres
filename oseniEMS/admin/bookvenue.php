<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
$username= $_SESSION['username'];//email


$query = "SELECT * from event where email ='$username' ";
$query_run = mysqli_query($connection,$query);
if (mysqli_num_rows($query_run) >0) {
    while($row = mysqli_fetch_assoc($query_run) ){
      echo "<h5>". $row['email']."</h5>";
    }
}else{
  echo "There seem to be issue getting your email address";
}



?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
 

  <div class="card-body">

      <?php
           if (isset($_SESSION['success']) && $_SESSION['success'] !='') {
             echo '<h2 class="bg-primary text-white">'. $_SESSION['success'].'</h2>';
             unset($_SESSION['success']);
              # code...
           }
          if (isset($_SESSION['status']) && $_SESSION['status'] !='') {
              echo "<h2 class='bg-danger'>". $_SESSION['status']."</h2>";
              unset($_SESSION['status']);
              # code...
            }
      ?>
    <div class="table-responsive">
      <p id='payment_reference'>Your Transaction reference number will replace this text if payment is successful</p> 
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th> Event Space ID </th>
            <th> Event Space Name </th>
            <th>Description </th>
            <th>Price </th>
            <th>Manager Name</th>
            <th>Space Seat</th>
            <th>EDIT </th>            
          </tr>
        </thead>
        <tbody>
            <?php
              $getBio = mysqli_query($connection,"SELECT firstname,lastname FROM event where email ='$username'");
              $bioGotten = mysqli_fetch_assoc($getBio);
              $firstname = $bioGotten['firstname'];
              $lastname = $bioGotten['lastname'];

             $query = "SELECT * from eventowner INNER JOIN eventspace INNER JOIN event ON eventspace.spacename = eventowner.event_space_selected WHERE eventowner.username='$username' AND payment_in_full='yes' ";
              $query_run = mysqli_query($connection,$query);
              if (mysqli_num_rows($query_run) == 1) {
                while($row = mysqli_fetch_assoc($query_run)){
                  ?>
          <tr>
            <td> <?php echo $row['id']; ?></td>
            <td> <?php echo $row['spaceid']; ?></td>
            <td> <?php echo $row['spacename']; ?></td>
            <td> <?php echo $row['spacedescription']; ?></td>
            <td> <?php echo $row['spaceprice']; ?> </td>
            <td> <?php echo $row['spacemanager']; ?> </td>
            <td> <?php echo $row['spaceseat']; ?> </td>
            <td>
                <form action="savespaceandpay.php" method="POST">
                  <script type="text/javascript">
                   
                    var price = <?php echo $row['spaceprice']*100; ?>;
                    var email = "<?php echo $username; ?>";
                  </script>
                  <script src="https://js.paystack.co/v1/inline.js"></script>
                     <input type="hidden" name="email_prepared_for_paystack" value="<?php echo $username; ?>"> 
                     <input type="hidden" name="amount" value="<?php echo $row['spaceprice']*100; ?>"> 
                     <input type="hidden" name="spaceid" value="<?php echo $row['spaceid']; ?>"> 
                     <button type="button" class="btn btn-dark" name="pay_now" id="pay-now" title="Pay now"  onclick="payWithPaystack(price,email,firstname,lastname)">Pay For This Space In Full</button>
                </form>
            </td>
           
          </tr>
          <?php
              }
            }
            else{
              echo "No Record Found";

                
                 $partPayment = "SELECT * from eventowner INNER JOIN eventspace ON eventspace.spacename = eventowner.event_space_selected WHERE eventowner.username='$username' AND payment_in_full='no' ";
                $query_partPayment = mysqli_query($connection,$partPayment);

                if(mysqli_num_rows($query_partPayment) == 1) {
                while($got = mysqli_fetch_assoc($query_partPayment)){
                  ?>
                <tr>
                   <script type="text/javascript">
                    alert("Please enter only numeric digit from 0-9");
                    var price = Number(prompt("How much will you be paying now"));
                    if(Number.isInteger(price) == false){
                       price = prompt("You need to enter a Number");
                    }
                    
                    
                    var email = "<?php echo $username; ?>";
                  
                  </script>
                  
                  <td> <?php echo $got['id']; ?></td>
                  <td> <?php echo $got['spaceid']; ?></td>
                  <td> <?php echo $got['spacename']; ?></td>
                  <td> <?php echo $got['spacedescription']; ?></td>
                  <td> <?php echo $got['spaceprice']; ?> </td>
                  <td> <?php echo $got['spacemanager']; ?> </td>
                  <td> <?php echo $got['spaceseat']; ?> </td>
                  <td>
             
                <form action="savespaceandpay.php" method="POST">
                   <input type="hidden" name="email_prepared_for_paystack" value="<?php echo $username; ?>"> 
                     <input type="hidden" name="amount" value="<?php echo $paying ?>"> 
                     <input type="hidden" name="spaceid" value="<?php echo $got['spaceid']; ?>"> 
                     <button type="button" name="pay_now" id="pay-now" title="Pay part" class="btn btn-dark text-underline"  onclick="payWithPaystack(priceinkobo,email,firstname,lastname)"><small>Pay For This Space</small></button>
                </form>
                </td>
                  <script src="https://js.paystack.co/v1/inline.js"></script>
                  <script type="text/javascript">
                    var spaceprice = <?php echo $got['spaceprice']; ?>;
                    var spacename = "<?php echo $got['spacename']; ?>";
                    while( (price -spaceprice) > 0){
                      price = prompt("Please enter a value equals to or less than the spaceprice");
                    }
                    var priceinkobo =price* 100; 
                    document.getElementById("pay-now").innerHTML = "Pay "+price+" out of "+spaceprice+ " for "+spacename ;//+price+" out of "+spaceprice+" for "+spacename;

                  </script>
                    

                    
               <?php 
             }}
             }    
          ?>
        
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>


</div>
<!-- /.container-fluid -->
 
<script>
   var firstname ="<?php $bioGotten['firstname']; ?>";
    var lastname ="<?php echo $bioGotten['lastname']; ?>";
  function payWithPaystack(price,email,firstname,lastname){
    var handler = PaystackPop.setup({
      key: 'pk_test_ca027a73f3c9099464e974ca70d84bca1d2d150e',
      email: email,
      amount: price,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      firstname: firstname,
      lastname: lastname,
      // label: "Optional string that replaces customer email"
      metadata: {
         custom_fields: [
            {
                display_name: "Oseni Event Management Center For Event Center",
                variable_name: "mobile_number",
                value: "+2348175461196"
            }
         ]
      },
      callback: function(response){
          alert('success. Transaction ref is ' + response.reference);
           document.getElementById("payment_reference").innerHTML = response.reference;

          
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
</script>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>