<?php
session_start();
require_once("vendor/autoload.php");
if(file_exists(__DIR__ . "/../.env")) {
    $dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
    $dotenv->load();
}

Braintree\Configuration::environment('sandbox');
Braintree\Configuration::merchantId('grjwdrhvmbzwnr5b');
Braintree\Configuration::publicKey('cy5s92dfgnnxt2w2');
Braintree\Configuration::privateKey('e95a03c5b69091e4d368a27c0278b503');
?>