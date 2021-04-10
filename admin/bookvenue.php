<?php
include('security.php');
include('includes/header.php'); 
include('includes/ownernavbar.php'); 
$username= $_SESSION['username'];//email

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


$query = "SELECT * from event where email ='$username' ";
$query_run = mysqli_query($connection,$query);
if (mysqli_num_rows($query_run) >0) {
    while($row = mysqli_fetch_assoc($query_run) ){
     // echo "<h5>". $row['email']."</h5>";
    }
}else{
  echo "There seem to be issue getting your email address";
}

$checkPaymentStatus = mysqli_query($connection,"SELECT * from payment_made INNER JOIN eventspace ON eventspace.spacename = payment_made.spacename WHERE payment_made.username = '$username' ");
$makeFullPayment = mysqli_query($connection,"SELECT * from eventowner WHERE username = '$username' AND payment_in_full='yes' ");
$payment_made_so_far = 0;$spaceprice =0;
while ($status = mysqli_fetch_assoc($checkPaymentStatus)) {
  $spaceprice = $status['spaceprice'];
  // echo "i".$spaceprice;
  $payment_made_so_far += $status['amount_paid'];
 
  
} 
//echo $spaceprice; echo $payment_made_so_far;

if ( ($payment_made_so_far > 0) AND ($spaceprice > 0) AND ($payment_made_so_far == $spaceprice ) ){
    echo "<h2 class='text-success text-center'> Payment completed ".$payment_made_so_far." out of ".$spaceprice." </h2>";
    $payment = "<h4 class='font-weight-bold text-success'>Payment Completed</h4>";
    echo "<h1 class='text-center text-danger'>Do  not make any more payment you have completed payment. Payment is done at owner's risk and a refund will not be possible anytime soon. </h1>";
}else if( ($payment_made_so_far == 0) AND ( $spaceprice == 0) AND (mysqli_fetch_assoc($makeFullPayment)['payment_in_full'] == "yes") ){
    echo "<h2 class='text-danger text-center'>You have not made any payment at all</h2>";
    $payment ="<button type='button' class='btn btn-dark' name='pay_now' title='Pay in full'  onclick='payWithPaystack(price,email,firstname,lastname)'>Pay For The Space In Full</button>";
}else{//only for partial payment
    echo "<h2 class='text-warning text-center'>You have made a payment of ".$payment_made_so_far." out of ".$spaceprice." </h2>";
    $payment ="<button type='button' class='btn btn-dark' name='pay_now' id='pay-now' title='Pay partially'  onclick='payWithPaystack(price,email,firstname,lastname)'>Pay For This Space In Piecel</button>";

}


?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
 

  <div class="card-body">

      <?php
  if (isset($_SESSION['payment']) && $_SESSION['payment'] !='') {
     echo '<h2 class="bg-dark text-danger text-center">'. $_SESSION['payment'].'</h2>';
     unset($_SESSION['payment']);
      # code...
   }
 
?>
    <div class="table-responsive">

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
            <th>Event Date</th>  
            <th>Make Payment</th>          
          </tr>
        </thead>
        <tbody>
<?php
  $getBio = mysqli_query($connection,"SELECT firstname,lastname FROM event where email ='$username'");
  $bioGotten = mysqli_fetch_assoc($getBio);
  $firstname = $bioGotten['firstname'];
  $lastname = $bioGotten['lastname'];

  $query = "SELECT * from eventowner INNER JOIN eventspace ON eventspace.spacename = eventowner.event_space_selected WHERE eventowner.username='$username' AND payment_in_full='yes' ";
  $query_run = mysqli_query($connection,$query);
if (mysqli_num_rows($query_run) == 1) {
  while($row = mysqli_fetch_assoc($query_run)){?>
    <tr>
      <td> <?php echo $row['id']; ?></td>
      <td> <?php echo $row['spaceid']; ?></td>
      <td> <?php echo $row['spacename']; $spacename = $row['spacename']; ?></td>
      <td> <?php echo $row['spacedescription']; ?></td>
      <td> <?php echo $row['spaceprice']; $spaceprice = $row['spaceprice']; ?> </td>
      <td> <?php echo $row['spacemanager']; ?> </td>
      <td> <?php echo $row['spaceseat']; ?> </td>
      <td> <?php echo $row['proposed_event_date'];$event_date = $row['proposed_event_date']; ?>
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
               <?php echo $payment; ?>
          </form>
      </td>

      <form action="code.php" method="POST" id="sendPaymentDetails">
        <input type="hidden" name="sendusername" value="<?php echo $username; ?>" >
        <input type="hidden" name="event_date" value="<?php echo $event_date; ?>">
        <input type="hidden" name="sendspacename" value="<?php echo $spacename; ?>" id="amount_paid">
        <input type="hidden" name="is_transaction_complete" value="yes">
        <input type="hidden" name="amount_paid" value="<?php echo $spaceprice; ?>">
        <input type="hidden" name="payment_reference" id="payment_reference">

      </form> 
    </tr>
              
<?php
  }
}
else{

   $partPayment = "SELECT * from eventowner INNER JOIN eventspace ON eventspace.spacename = eventowner.event_space_selected WHERE eventowner.username='$username' AND payment_in_full='no' ";
  $query_partPayment = mysqli_query($connection,$partPayment);

          $checkleft = mysqli_query($connection,"SELECT * FROM payment_made WHERE username = '$username'");
          $totalPaid = 0;
           while($paid = mysqli_fetch_assoc($checkleft) ){
             $totalPaid += $paid['amount_paid'];

           } 
           $totalAmount = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * from eventowner INNER JOIN eventspace ON eventspace.spacename = eventowner.event_space_selected WHERE username='$username'"))['spaceprice'];
           


  if(mysqli_num_rows($query_partPayment) == 1) {
    while($got = mysqli_fetch_assoc($query_partPayment)){
        $minimum = $got['spaceprice'] * 0.25;//* shows the minimum amount you have to pay first
      ?>
       <script>
          var minimumForFirstTime =parseInt(<?php echo $minimum; ?>);
          var totalAmount = <?php echo $totalAmount; ?>;// total amount expected of you to pay
          var totalPaid = <?php echo $totalPaid; ?>;// total amount paid by user
          var amount_left = totalAmount - totalPaid;

          alert("You have paid "+totalPaid+" so far");
         // setTimeout(function(){//delay the javascript
             alert("Please enter only numeric digit from 0-9");
            var price = Number(prompt("How much will you be paying now. Note you have to pay at least "+ minimumForFirstTime + " for first time and maximum of "+amount_left+" which remains for you to pay"));
            if(Number.isInteger(price) == false){
               price = prompt("You need to enter a Number");
            }


         // }, 5000); 

          var spaceprice = <?php echo $got['spaceprice']; ?>;
            var spacename = "<?php echo $got['spacename']; ?>";
            while( (price -spaceprice) > 0){
              price = prompt("Please enter a value equals to or less than the spaceprice");
            }while(price > amount_left){
              price = prompt("Please enter a value less than "+amount_left+" to complete your payment");
            }
         
          
          
          var email = "<?php echo $username; ?>";
        
      </script>
      <tr>      
      <td> <?php echo $got['id']; ?></td>
      <td> <?php echo $got['spaceid']; ?></td>
      <td> <?php echo $got['spacename'];$spacename=$got['spacename']; ?></td>
      <td> <?php echo $got['spacedescription']; ?></td>
      <td> <?php echo $got['spaceprice']; ?> </td>
      <td> <?php echo $got['spacemanager']; ?> </td>
      <td> <?php echo $got['spaceseat']; ?> </td>
      <td> <?php echo $got['proposed_event_date'];$event_date = $got['proposed_event_date']; ?>
      <td>
 
    <form action="bookvenue.php" method="POST">
       <input type="hidden" name="email_prepared_for_paystack" value="<?php echo $username; ?>"> 
       <input type="hidden" name="event_date" value="<?php echo $event_date; ?>">
         <input type="hidden" name="amount" value="<?php echo $paying ?>"> 
         <input type="hidden" name="spaceid" value="<?php echo $got['spaceid']; ?>"> 
         <button type="button" name="pay_now" id="pay-now" title="Pay part" class="btn btn-dark text-underline"  onclick="payWithPaystack(priceinkobo,email,firstname,lastname)"><small>Pay For This Space</small></button>
    </form>

      <form action="code.php" method="POST" id="sendPaymentDetails">
          <input type="hidden" name="sendusername" value="<?php echo $username; ?>" >
          <input type="hidden" name="sendspacename" value="<?php echo $spacename; ?>" >
          <input type="hidden" name="event_date" value="<?php echo $event_date; ?>" >
          <input type="hidden" name="is_transaction_complete" value="part">
          <input type="hidden" name="amount_paid"  id="paypart" onclick="startPayment()" value="<script>document.write(price)</script>">
          <input type="hidden" name="payment_reference" id="payment_reference">
       </form>







        </td>
          <script src="https://js.paystack.co/v1/inline.js"></script>
          <script type="text/javascript">
            var priceinkobo =price* 100; 
            document.getElementById("pay-now").innerHTML = "Pay "+price+" out of "+spaceprice+ " for "+spacename ;
             document.getElementById("paypart").value = price;

          </script>
                      

                    
     <?php 
    }
  }
 
}   


 // if(mysqli_num_rows($query_run) == 0) {               
 //              echo "<div class='text-center'>Please do ensure you choose an event space before you make payment. Click on the button below to do so<br/><br/>";
 //              echo "<button class='btn btn-info'><a href='owner.php' class='text-white text-bold '> Choose Event Space</a></button></div>";
 //  }
          ?>
        
        </tbody>
      </table>
          <div class="text-center">
          <button onclick="submitform()" class="btn btn-primary text-center"> Click this after making payment alert to help submit your payment details</button>
        </div>
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
           document.getElementById("payment_reference").value = response.reference;
          // document.getElementById('')

          
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
  function submitform(){
    document.getElementById("sendPaymentDetails").submit();
  }
</script>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>