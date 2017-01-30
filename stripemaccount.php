<?php 
session_start();
require __DIR__ . '/vendor/autoload.php';
require_once('connect.php');
\Stripe\Stripe::setApiKey("sk_test_oVcdv8o1obp6jTmxLNRUeH9s");
$uid = $_SESSION['u_id'];

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
    "date" => 1485721872,
    "ip" => "73.72.131.239"
  )
));
$acctid = $sacct->id;
$insres = mysqli_query($connect, "insert into stripeaccts (user_id, stripe_cusid, stripe_type) values ('".$uid."', '".$acctid."', 'ma')");

if ($insres) {
  header('Location: dashboard.php');
  exit;
}
?>