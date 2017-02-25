<?php

//session_start();

//Include Facebook SDK
//error_log("before incfb");
require_once 'inc/facebook.php';

/*
 * Configuration and setup FB API
 */
$appId = '1446252165384800'; //Facebook App ID
$appSecret = '8051355b0df611d2116c13a7f097b327'; // Facebook App Secret
$redirectURL = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; // Callback URL

$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));
$fbUser = $facebook->getUser();

?>