<?php 
//check if request was made with the right data
if(!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_POST['reference'])){die("Transaction reference not found");
}//set reference to a variable @reference
$reference = $_POST['reference'];

//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'.$reference;//open connection
$ch = curl_init();//set request parameters 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [’Authorization: 
pk_test_ca027a73f3c9099464e974ca70d84bca1d2d150e’]);

 ?>