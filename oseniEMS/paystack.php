<form action="#">
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <button type="button" name="pay_now" id="pay-now" title="Pay now"  onclick="saveOrderThenPayWithPaystack()">Book Venue</button>
</form>

<script >
  var orderObj = {
    email_prepared_for_paystack: '<?php echo $email; ?>',
    amount: <?php echo $amount_in_kobo; ?>,
    cartid: <?php echo $cartid; ?>
    // other params you want to save
  };

  function saveOrderThenPayWithPaystack(){
    // Send the data to save using post
    var posting = $.post( '/save-order', orderObj );

    posting.done(function( data ) {
      /* check result from the attempt */
      payWithPaystack(data);
    });
    posting.fail(function( data ) { /* and if it failed... */ });
  }

  function payWithPaystack(data){
    var handler = PaystackPop.setup({
      // This assumes you already created a constant named
      // PAYSTACK_PUBLIC_KEY with your public key from the
      // Paystack dashboard. You can as well just paste it
      // instead of creating the constant
      key: '<?php echo pk_test_ca027a73f3c9099464e974ca70d84bca1d2d150e; ?>',
      email: orderObj.email_prepared_for_paystack,
      amount: orderObj.amount,
      metadata: {
        cartid: orderObj.cartid,
        orderid: data.orderid,
        custom_fields: [
          {
            display_name: "Paid on",
            variable_name: "paid_on",
            value: 'Website'
          },
          {
            display_name: "Paid via",
            variable_name: "paid_via",
            value: 'Inline Popup'
          }
        ]
      },
      callback: function(response){
        // post to server to verify transaction before giving value
        var verifying = $.get( '/verify.php?reference=' + response.reference);
        verifying.done(function( data ) { /* give value saved in data */ });
      },
      onClose: function(){
        alert('Click "Pay now" to retry payment.');
      }
    });
    handler.openIframe();
  }
</script>