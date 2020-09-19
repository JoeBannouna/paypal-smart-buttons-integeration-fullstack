<?php

require_once 'env.php';

?>
<!DOCTYPE html>
<head>
  <!-- Add meta tags for mobile and IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>
<body>
  <!-- Set up a container element for the button -->
  <div id="paypal-button-container"></div>

  <!-- Include the PayPal JavaScript SDK -->
  <script src="https://www.paypal.com/sdk/js?client-id=<?php echo $_ENV["PAYPAL_CLIENT_ID"]; ?>&currency=USD&merchant-id=<?php echo $_ENV["MERCHANT_ID"]; ?>&components=buttons"></script>

  <script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({
      // Set up the transaction
      createOrder: function () {
        return fetch('create')
          .then(function (res) {
            return res.json();
          })
          .then(function (data) {
            console.log(data)
            return data.result.id; // Use the same key name for order ID on the client and server
          });
      },
      // Finalize the transaction
      onApprove: function (data) {
        console.log(data)
        return fetch('capture', {
          method: "POST",
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            order: {
              id: data.orderID
            }
          })
        })
          .then(function (res) {
            return res.json();
          })
          .then(function (details) {
            console.log(details);
            alert('Transaction funds captured from ' + details.result.payer.name.given_name);
          })
      }
    }).render('#paypal-button-container');
  </script>
</body>