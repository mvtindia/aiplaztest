  <?php
session_start();
include_once('connect.php');
include_once('email.php');
$uid = $_SESSION['u_id'];
/*require __DIR__ . '/vendor/autoload.php';
\Stripe\Stripe::setApiKey("sk_test_oVcdv8o1obp6jTmxLNRUeH9s");
if (isset($_POST['stripeToken'])) {
    
    

    // Token is created using Stripe.js or Checkout!
    // Get the payment token submitted by the form:
    //if (isset($_POST['stripetoken'])) {
        $token = $_POST['stripeToken'];
    //} else if (isset($_POST['stripeid'])) {
    //    $token = $_POST['stripeid'];
   // }
    
    $amt = $_POST['total_price'];
    $zip = $_POST['address_zip'];
    
    $customer = "";
    $charge = "";
    $cusid = "";
    error_log("token: " . $token . " ". $uid);
    // Charge the user's card:
    if (isset($_POST['newcustomer'])) {
      //$strq = mysqli_query($connect, 'select * from stripeaccts where user_id = "'.$uid.'"');
        //if (!isset($_POST['stripeid'])) {
        //  error_log('spotz');
          $customer = \Stripe\Customer::create(array(
              "description" => "2finda id: " . $uid,
              "source" => $token,
          ));
          $cusid = $customer->id;
        //} else {
        //  $cusid = $_POST['stripeid'];
        //}
        //error_log('spotx');
        
        $charge = \Stripe\Charge::create(array(
            "amount" => $amt,
            "currency" => "usd",
            "customer" => $cusid,
        ));
        //error_log($charge->status);
        if ($charge->status == 'succeeded') {
          //error_log('insert into `stripeaccts` (`user_id`, `stripe_cusid`) values ("'.$uid.'", "'.$cusid.'")');
          
          $inscus = mysqli_query($connect, 'insert into `stripeaccts` (`user_id`, `stripe_cusid`) values ("'.$uid.'", "'.$cusid.'")');
        }
    } else {
        $charge = \Stripe\Charge::create(array(
        "amount" => $amt,
        "currency" => "usd",
        "description" => "2finda charge",
        "source" => $token,
        "address_zip" => $zip,
        ));
    }
} else if (isset($_POST['customer'])) {
  error_log("here i is");
  
  $cusid = $_POST['stripeid'];
  $amt = $_POST['total_price'];
  error_log($cusid . " " . $amt);
  $charge = \Stripe\Charge::create(array(
            "amount" => $amt,
            "currency" => "usd",
            "customer" => $cusid,
  ));
  error_log($charge->status);
} else {
  $strq = mysqli_query($connect, 'select * from stripeaccts where user_id = "'.$uid.'"');
  $strres = mysqli_fetch_array($strq);
  error_log("stripe code: " . $strres['stripe_cusid']);
}
if (isset($charge)) {
  if ($charge->status = 'succeeded') {
    $email = $_SESSION['email'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $total_price = $_POST['total_price'] * .01;
    $theplace = $_POST['theplace'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $subject = 'Your 2finda transaction';

    $body = "Dear " . $fname . " " . $lname . ",<br><br>
  You have successfully booked a space on 2finda.com<br>
  See the details of your credit card transation:<br>
  Amount: &#36;" . $total_price . "<br>
  Location: " . $theplace . "<br>
  Event Times: " . $checkin . " to " . $checkout . "<br>Your 2finda team";


    $json_string = array(
        'to' => array($email, 'info@2finda.com'), 'category' => 'test_category'
    );
     $json_string = array(
      'to' => array($email), 'category' => 'test_category'
      ); 
    $params = array(
        'api_user' => $sguser,
        'api_key' => $sgpass,
        'to' => $email,
        'subject' => $subject,
        'html' => $body,
        'from' => 'info@2finda.com',
    );


    $session = curl_init($sgrequest);
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $params);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($session);
    curl_close($session);
    mysqli_close($connect);
  }
}*/
// if(isset($_SESSION['u_id'])
// {
//$paypal_url='https://www.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
//$paypal_id='bluestar.jeet@gmail.com'; // Business email ID
//$book = $_REQUEST['bookid'];

//$q17 = mysqli_query($connect,'Select * from users,booking where uid="'.$_SESSION['u_id'].'" and uid=userid and bookid="'.$book.'"');
//if(mysqli_num_rows($q17)>0)
//{
 
//$r17=mysqli_fetch_array($q17);

// $q18 = mysqli_query($connect,"select * from booking where bookid=".$book);
// $r18 = mysqli_fetch_array($q18);
$amt = $_SESSION['total_price'];
$checkin = $_SESSION['checkin'];
$checkout = $_SESSION['checkout'];
$theplace = $_SESSION['theplace'];
$_SESSION['total_price'] = "";
?>

<!doctype html>
<html>
<head>

  <title>Transaction Success</title>
  <?php include 'lib/top.php';?>
  
</head>

<body>
<div class="container-fluid"><!--container-fluid start-->
<div class="row">


<!--==============menu header=========================-->
<div class="menu-had2">
<?php include 'lib/header.php';?>
</div><!--menu-had close-->
<!--==============menu header close=========================-->
<div class="banner-bg">
<div class="banner-upper">
<div class="container">
<div class="row">
<div class="banner-txt">
 <h1> Booking is completed</h1>

 </div>  
</div><!--row close-->
</div><!--container close-->

</div><!--banner-upper close-->
</div><!--banner-bg close-->
<div class="container">
<div class="row">
<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
<div class="tellus-data col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-lr-0">

<div style="font-weight: bold; padding: 10px 10px;">
<div>
<h2>Your transaction was successful!</h2>
</div>
<div>Amount: &#36;<?php echo $amt ?></div>
<div>Location: <?php echo $theplace?></div>
<div>Event Times: <?php echo $checkin . " to " . $checkout ?></div>
<div>An email has been sent to you to you with your transaction details.</div>
</div>
</div>

  </div>


<!--==========WHY LIST YOUR PLACE?============-->
 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
<div class="tellus-data">
<div class="had-frm">Why list your place?</div>
<div class="safe-lst">
 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
 <img class="img-responsive" src="img/save.png">
 </div>
 <div class="col-lg-10 col-sm-10 col-md-10 col-xs10">
 
<span class="had-2nd">It's safe</span>
<p>We provide a trusted environment.</p>
 </div>
<div class="clearfix"></div>
</div>

<div class="safe-lst">
 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
 <img class="img-responsive" src="img/easy.png">
 </div>
 <div class="col-lg-10 col-sm-10 col-md-10 col-xs10">
 
<span class="had-2nd">It's easy</span>
<p>We'll do all the hard work of finding guests, while you just enjoy earning money with a spare space.</p>
 </div>
<div class="clearfix"></div>
</div>

<div class="safe-lst">
 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
 <img class="img-responsive" src="img/free.png">
 </div>
 <div class="col-lg-10 col-sm-10 col-md-10 col-xs10">
 
<span class="had-2nd">It's free</span>
<p>We don't charge you to upload your place, and you get instant access to thousands of guests.</p>
 </div>
<div class="clearfix"></div>
</div>

</div>
</div> 


  <!--=====================================-->
 <!--==========WHY LIST YOUR PLACE CLOSE============-->  
 
</div><!--row close-->
</div><!--container close-->
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="showload" style="display:none;">
        <img class="showimg" src="img/loading.gif" style="margin:0 auto;display:block;">
      </div>
      <div class="" style="display:block;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          "Are you ready to submit payment?"
        </div>
        <div class="modal-footer" style="text-align: center;">
       <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <span class="showmsg" style="display:none;"></span>
      </div>
      </div>
    </div>
  </div>
</div>

<!--======footer======-->
  <?php include 'lib/footer.php'; 
/*}
 else 
  { 
    header('location:searchlst.php');
   }*/ 
// else
// {
//    header('location:index.php'); 
// }

  ?>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
<?php 
  //if (isset($strres['stripe_cusid'])) {
?>
/*$(document).ready(function() {
    $('#myModal3').modal({ show: false});
    $('#myModal3').modal('show');
});*/
<?php // }
?> 
  Stripe.setPublishableKey('pk_test_v4SVzvDaOp0VobXVlwXx6UdB');
  $(function() {
  var $form = $('#payment-form');
  $form.submit(function(event) {
    // Disable the submit button to prevent repeated clicks:
    $form.find('.submit').prop('disabled', true);

    // Request a token from Stripe:
    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from being submitted:
    return false;
  });
});
function stripeResponseHandler(status, response) {
  // Grab the form:
  var $form = $('#payment-form');

  if (response.error) { // Problem!

    // Show the errors on the form:
    $form.find('.payment-errors').text(response.error.message);
    $form.find('.submit').prop('disabled', false); // Re-enable submission

  } else { // Token was created!

    // Get the token ID:
    var token = response.id;

    // Insert the token ID into the form so it gets submitted to the server:
    $form.append($('<input type="hidden" name="stripeToken">').val(token));

    // Submit the form:
    $form.get(0).submit();
  }
};
</script>

<!--======footer close======-->
</div><!--row close-->
</div><!--container-fluid close-->

</body> 
</html>
