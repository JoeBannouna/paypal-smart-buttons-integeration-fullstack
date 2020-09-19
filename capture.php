<?php

require_once 'credentials.php';

use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
// Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
// $response->result->id gives the orderId of the order created above
$json = file_get_contents('php://input');
$data = json_decode($json);
$request = new OrdersCaptureRequest($data->order->id);
$request->prefer('return=representation');
try {
  // Call API with your client and get a response for your call
  $response = $client->execute($request);

  // If call returns body in response, you can get the deserialized version from the result attribute of the response
  print_r(json_encode($response));
} catch (HttpException $ex) {
  echo $ex->statusCode;
  print_r($ex->getMessage());
}
