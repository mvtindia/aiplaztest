<?php 
session_start();
require __DIR__ . '/vendor/autoload.php';
require_once('connect.php');
\Stripe\Stripe::setApiKey("sk_test_MHPzQScCOwog2wlbeqoZtptR");
$uid = $_SESSION['u_id'];
error_log("values: " . $_POST['account_number'] . " " . $_POST['account_holder_type']);
try {
$sacct = \Stripe\Account::create(array(
  "managed" => true,
  "country" => "US",
  "external_account" => (array(
    "object" => "bank_account",
    "country" => "US",
    "currency" => "USD",
    "account_number" => $_POST['account_number'],
    "routing_number" => $_POST['routing_number'],
    "account_type" => $_POST['account_type'],
    "account_type_holder" => $_POST['account_holder_type'],
  )),
  "tos_acceptance" => array(
    "date" => time(),
    "ip" => "73.72.131.239"
  )
));
} catch (Exception $e) {
  error_log($e);
}
error_log("account_holder_type");
error_log("spotb");
$acctid = $sacct->id;
$insres = mysqli_query($connect, "insert into stripeaccts (user_id, stripe_cusid, stripe_type) values ('".$uid."', '".$acctid."', 'ma')");
error_log("spotc");
if ($insres) {
  header('Location: dashboard.php?sacct=y');
  exit;
}
?>