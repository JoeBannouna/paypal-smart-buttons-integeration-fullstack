<?php

require_once 'credentials.php';

// Construct a request object and set desired parameters
// Here, OrdersCreateRequest() creates a POST request to /v2/checkout/orders
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

$request = new OrdersCreateRequest();
$request->prefer('return=representation');
$request->body = [
  "intent" => "CAPTURE",
  "purchase_units" => [[
    "reference_id" => "test_ref_id1",
    "amount" => [
      "value" => "0.01",
      "currency_code" => "USD"
    ]
  ]],
  "application_context" => [
    "cancel_url" => "https://example.com/cancel",
    "return_url" => "https://example.com/return"
  ]
];

try {
  // Call API with your client and get a response for your call
  $response = $client->execute($request);

  // If call returns body in response, you can get the deserialized version from the result attribute of the response
  print_r(json_encode($response));
} catch (HttpException $ex) {
  echo $ex->statusCode;
  print_r($ex->getMessage());
}
