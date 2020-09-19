<?php

require_once 'env.php';

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
// Creating an environment
$clientId = $_ENV['PAYPAL_CLIENT_ID'];
$clientSecret = $_ENV['PAYPAL_CLIENT_SECRET'];

$environment = new ProductionEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);
