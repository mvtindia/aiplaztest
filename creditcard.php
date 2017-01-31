  <?php
session_start();
include_once('connect.php');
include_once('email.php');
$uid = $_SESSION['u_id'];
require __DIR__ . '/vendor/autoload.php';
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
          
          $inscus = mysqli_query($connect, 'insert into `stripeaccts` (`user_id`, `stripe_cusid`, `stripe_type`) values ("'.$uid.'", "'.$cusid.'", "cu")');
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
  $strq = mysqli_query($connect, 'select * from stripeaccts where user_id = "'.$uid.'" and stripe_type = "cu"');
  $strres = mysqli_fetch_array($strq);
  error_log("stripe code: " . $strres['stripe_cusid']);
}
if (isset($charge)) {
  if ($charge->status = 'succeeded') {
    $email = $_SESSION['email'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $total_price = $_POST['total_price'] * .01;
    $_SESSION['total_price'] = $total_price;
    
    $theplace = $_POST['theplace'];
    $_SESSION['theplace'] = $theplace;
    $checkin = $_POST['checkin'];
    $_SESSION['checkin'] = $checkin;
    $checkout = $_POST['checkout'];
    $_SESSION['checkout'] = $checkout;

    $subject = 'Your 2finda transaction';

    $body = "Dear " . $fname . " " . $lname . ",<br><br>
  You have successfully booked a space on 2finda.com<br>
  See the details of your credit card transaction:<br>
  Amount: &#36;" . $total_price . "<br>
  Location: " . $theplace . "<br>
  Event Times: " . $checkin . " to " . $checkout . "<br>Your 2finda team";


    $json_string = array(
        'to' => array($email, 'info@2finda.com'), 'category' => 'test_category'
    );
    /* $json_string = array(
      'to' => array($email), 'category' => 'test_category'
      ); */
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
    header('Location: success.php');
    die();
  }
}
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
?>

<!doctype html>
<html>
<head>

  <title>Credit card form</title>
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
 <h1> Booking is now very easy</h1>

 </div>  
</div><!--row close-->
</div><!--container close-->

</div><!--banner-upper close-->
</div><!--banner-bg close-->
<div class="container">
<div class="row">
<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
<div class="tellus-data col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-lr-0">
<?php if (isset($charge) && $charge->status == 'succeeded') {
?>
<div style="font-weight: bold; padding: 10px 10px;">
<div>
<h2>Your transaction was successful!</h2>
</div>
<div>Amount: &#36;<?php echo $_POST['total_price'] * .01 ?></div>
<div>Location: <?php echo $_POST['theplace']?></div>
<div>Event Times: <?php echo $_POST['checkin'] . " to " . $_POST['checkout'] ?></div>
<div>An email has been sent to you to you with your transaction details.</div>
</div>
<?php
 } else if (!isset($strres['stripe_cusid'])) {
?>
<form  method="POST" id="payment-form" class="form-horizontal">
    <fieldset>
      <legend>Payment</legend>
      
      <div class="form-group">
        <label class="col-sm-3 control-label" for="card-number">Card Number</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" data-stripe="number" id="card-number">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-xs-3">
              <select class="form-control col-sm-2" data-stripe="exp_month" id="expiry-month">
                <option>Month</option>
                <option value="01">Jan (01)</option>
                <option value="02">Feb (02)</option>
                <option value="03">Mar (03)</option>
                <option value="04">Apr (04)</option>
                <option value="05">May (05)</option>
                <option value="06">June (06)</option>
                <option value="07">July (07)</option>
                <option value="08">Aug (08)</option>
                <option value="09">Sep (09)</option>
                <option value="10">Oct (10)</option>
                <option value="11">Nov (11)</option>
                <option value="12">Dec (12)</option>
              </select>
            </div>
            <div class="col-xs-3">
              <select class="form-control" data-stripe="exp_year">
                <option value="17">2017</option>
                <option value="18">2018</option>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
                <option value="23">2023</option>
                <option value="23">2024</option>
                <option value="23">2025</option>
                <option value="23">2026</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="cvv">CVC</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" data-stripe="cvc" id="cvv">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label" for="card-holder-name">Zip Code</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" data-stripe="address_zip" id="card-holder-name">
          <input type="hidden" name="total_price" value="<?php echo (ltrim($_POST['total_price'], '$') * 100)?>">
          <input type="hidden" name="checkin" value="<?php echo $_POST['checkin']?>">
          <input type="hidden" name="checkout" value="<?php echo $_POST['checkout']?>">
          <input type="hidden" name="theplace" value="<?php echo $_POST['theplace']?>">

        </div>
      </div>
      
      <div class="col-lg-4 col-md-4 col-lg-offset-3 checkbox-inline" style="">
          <label>
              <input type="checkbox" name="newcustomer" value="yes" id="cbox">Save credit card information
          </label>
      </div>
      
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" class="btn btn-success submit">Pay Now</button>
        </div>
      </div>
    </fieldset>
  </form>
  <?php } else {?>
    <div style="font-weight: bold; padding: 10px 10px;">
    <h2>Do you wish to complete your transaction?</h2>
    <div>Amount: <?php echo $_POST['total_price'] ?></div>
    <div>Location: <?php echo $_POST['theplace']?></div>
    <div>Event Times: <?php echo $_POST['checkin'] . " to " . $_POST['checkout'] ?></div>
    <form method="post">
    <input type="hidden" name="stripeid" value="<?php echo $strres['stripe_cusid'] ?>">
    <input type="hidden" name="customer" value="customer">
    <input type="hidden" name="total_price" value="<?php echo (ltrim($_POST['total_price'], '$') * 100) ?>">
    <input type="hidden" name="checkin" value="<?php echo $_POST['checkin'] ?>">
    <input type="hidden" name="checkout" value="<?php echo $_POST['checkout'] ?>">
    <input type="hidden" name="theplace" value="<?php echo $_POST['theplace'] ?>">
    <button type="submit">Yes</button>
    </form>
    </div>
  <?php } ?>
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
