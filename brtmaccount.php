<?php 
session_start();
require __DIR__ . '/vendor/autoload.php';
require_once('connect.php');
require_once('braintree-init.php');
$uid = $_SESSION['u_id'];
$fname = $_REQUEST['firstName'];

$lname = $_REQUEST['lastName'];
error_log($lname);

$email = $_REQUEST['email'];
error_log($email);
error_log("spota");
$merchantAccountParams = [
  'individual' => [
    'firstName' => Braintree_Test_MerchantAccount::$approve,
    'lastName' => $lname,
    'email' => $email,
    //'phone' => '5553334444',
    'dateOfBirth' => '1981-11-19',
    //'ssn' => '456-45-4567',
    'address' => [
      'streetAddress' => '111 Main St',
      'locality' => 'Chicago',
      'region' => 'IL',
      'postalCode' => '60622'
    ]
  ],
  /*'business' => [
    'legalName' => 'Jane\'s Ladders',
    'dbaName' => 'Jane\'s Ladders',
    'taxId' => '98-7654321',
    'address' => [
      'streetAddress' => '111 Main St',
      'locality' => 'Chicago',
      'region' => 'IL',
      'postalCode' => '60622'
    ]
  ],*/
  'funding' => [
    'descriptor' => 'Blue Ladders',
    'destination' => Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
    //'email' => '$email',
    //'mobilePhone' => '5555555555',
    'accountNumber' => '1123581321',
    'routingNumber' => '071101307'
  ],
  'tosAccepted' => true,
  'masterMerchantAccountId' => '2findacom',
  'id' => 'blue_ladders_store'
];

error_log($merchantAccountParams['individual']['firstName']);
$result = Braintree_MerchantAccount::create($merchantAccountParams);
error_log($merchantAccountParams['funding']['destination']);
error_log($result->merchantAccount->status);

$acctid = $result->merchantAccount->id;
$insres = mysqli_query($connect, "insert into stripeaccts (user_id, stripe_cusid, stripe_type) values ('".$uid."', '".$acctid."', 'ma')");
error_log("spotc");
if ($insres) {
  header('Location: dashboard.php?sacct=y');
  exit;
}
?>