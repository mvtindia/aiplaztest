<?php
session_start();

//Include Facebook SDK
require_once 'inc/facebook.php';

/*
 * Configuration and setup FB API
 */
$appId = '1446252165384800'; //Facebook App ID
$appSecret = '8051355b0df611d2116c13a7f097b327'; // Facebook App Secret
$redirectURL = 'http://localhost:8081/facebook_login_with_php/'; // Callback URL
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));
$fbUser = $facebook->getUser();
?>