<?php
    session_start();
    if (isset($_SESSION['u_id'])) {
        $uid = $_SESSION['u_id'];
    } else {
          header("Location: index.php");
    }

    include_once('connect.php');
    include_once('email.php');
    include_once('braintree-init.php');

    //require __DIR__ . '/vendor/autoload.php';
    
        
    $amt = $_POST['total_price'];
    $zip = $_POST['address_zip'];
    
    $customer = "";
    $charge = "";
    $cusid = "";
    
    // Charge the user's card:



/*    $subject = 'Your 2finda transaction';

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
    /*$params = array(
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
    die();*/


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
 <style>
  .panel {
  width: 80%;
  margin: 2em auto;
    }
  .braintree-hosted-fields-focused { 
  border: 1px solid #0275d8;
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
    }

  .braintree-hosted-fields-focused.focused-invalid {
  border: 1px solid #ebcccc;
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(100,100,0,.6);
    }
@media (max-width: 670px) {
  .form-group {
    width: 100%;
  }
  
  .btn {
    white-space: normal;
  }
}
 </style>
</head>

<body>
<div class="container-fluid"><!--container-fluid start-->
    <div class="row">

<!--==============menu header=========================-->
        <div class="menu-had2">
          <?php include 'lib/header.php'; ?>
        </div><!--menu-had close-->
<!--==============menu header close=========================-->

<?php 

if (isset($_POST['payment-method-nonce'])) {
    $nonceFromTheClient = $_POST['payment-method-nonce'];
    $amt = $_POST['total_price'];
    $zip = $_POST['address_zip'];
    
    $customer = "";
    $charge = "";
    $cusid = "";
    if (isset($_POST['newcustomer'])) {
      $result = Braintree_Customer::create([
        'paymentMethodNonce' => $nonceFromTheClient
      ]);
    
      if ($result->success) {
          $cusid = $result->customer->id;
          $result2 = Braintree_Transaction::sale(
            [
              'customerId' => $cusid,
              'amount' => $amt
            ]
          );
          error_log($result2->customer->paymentMethods[0]->token);
          if ($result2->success) {
            $inscus = mysqli_query($connect, 'insert into `stripeaccts` (`user_id`, `stripe_cusid`, `stripe_type`) values ("'.$uid.'", "'.$cusid.'", "cu")');
            if ($inscus) {
              $instrans = mysqli_query($connect, 'insert into `transactions` (`user_id`, `stripe_cusid`, `amount`) values ("'.$uid.'", "'.$cusid.'", "'.$amt.'")');
            }
          } else {
            $error = "true";
          }
      } else {
          foreach($result->errors->deepAll() AS $error) {
              echo($error->code . ": " . $error->message . "\n");
          }
      }
    } else {
      $result = Braintree_Transaction::sale([
        'amount' => $amt,
        'paymentMethodNonce' => $nonceFromTheClient,
        'options' => [
          'submitForSettlement' => True
      ]
      ]);
      if ($result->success || !is_null($result->transaction)) {
          $instrans = mysqli_query($connect, 'insert into `transactions` (`user_id`, `amount`, `comment`) values ("'.$uid.'", "'.$amt.'", "One time transaction.")');
          $transaction = $result->transaction;
          //header("Location: transaction.php?id=" . $transaction->id);
      } else {
          $errorString = "";
          $error = "true";
          foreach($result->errors->deepAll() as $error) {
              $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
          }
          //echo $errorString;
          //header("Location: index.php");
      }
    }
 } else if (isset($_POST['customer'])) {
    $cusid = $_POST['stripeid'];
    $amt = $_POST['total_price'];
    $result = Braintree_Transaction::sale(
            [
              'customerId' => $cusid,
              'amount' => $amt
            ]
    );
    $instrans = mysqli_query($connect, 'insert into `transactions` (`user_id`, `amount`, `cust_id`) values ("'.$uid.'", "'.$amt.'", "'.$cusid.'")');
 } else {
    $strq = mysqli_query($connect, 'select * from stripeaccts where user_id = "'.$uid.'" and stripe_type = "cu"');
    $strres = mysqli_fetch_array($strq);
 }

?>       
        <div class="banner-txt">
            <h1> Booking</h1>
        </div>

        <div class="container">
          <div class="row">
              <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 tellus-data" style="text-align: center; padding-bottom: 20px;">
  <?php if ($result->success || $result2->success) {?>
                <!--<div style="font-weight: bold; padding: 10px 10px;">-->

                  <div><h2>Your transaction was successful!</h2></div>
                  <div>Amount: &#36;<?php echo $_POST['total_price']?></div>
                  <div>Location: <?php echo $_POST['theplace']?></div>
                  <div>Event Times: <?php echo $_POST['checkin'] . " to " . $_POST['checkout'] ?></div>
                  <div>An email has been sent to you to you with your transaction details.</div>
                </div>
  <?php } else if (isset($error)) { ?>
                  <div><h2>Transaction failed.</h2></div>
                  <div>Please contact 2finda support for help with this error.</div>
                </div>
  <?php } else if (!isset($strres['stripe_cusid'])) { ?>
      <form id="checkout-form" method="post">
              <div class="row">
                  <div class="form-group col-xs-8">
                    <label class="control-label">Card Number</label>
                    <!--  Hosted Fields div container -->
                    <div class="form-control" id="card-number"></div>
                    <span class="helper-text"></span>
                  </div>
                  <div class="form-group col-xs-4">
                    <div class="row">
                      <label class="control-label col-xs-12">Expiration Date</label>
                      <div class="col-xs-6">
                        <!--  Hosted Fields div container -->
                        <div class="form-control" id="expiration-month"></div>
                      </div>
                      <div class="col-xs-6">
                        <!--  Hosted Fields div container -->
                        <div class="form-control" id="expiration-year"></div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col-xs-6">
                    <label class="control-label">Security Code</label>
                    <!--  Hosted Fields div container -->
                    <div class="form-control" id="cvv"></div>
                  </div>
                  <div class="form-group col-xs-6">
                    <label class="control-label">Zipcode</label>
                    <!--  Hosted Fields div container -->
                    <div class="form-control" id="postal-code"></div>
                  </div>
              </div>
              <input type="hidden" name="total_price" value="<?php echo ltrim($_POST['total_price'], '$') ?>">
              <input type="hidden" name="checkin" value="<?php echo $_POST['checkin'] ?>">
              <input type="hidden" name="checkout" value="<?php echo $_POST['checkout'] ?>">
              <input type="hidden" name="theplace" value="<?php echo $_POST['theplace'] ?>">
              

              <!--<button value="submit" id="submit" class="btn btn-success btn-lg center-block">Pay with <span id="card-type">Card</span></button>-->
              <input type="hidden" name="payment-method-nonce">
               <div class="col-lg-4 col-md-4 col-lg-offset-3 checkbox-inline" style="">
              <label>
              <input type="checkbox" name="newcustomer" value="yes" id="cbox">Save credit card information
              </label>
              </div>
              <input type="submit" value="Pay Now" disabled>
              <div style="height: 10px;"></div>
        </form>
              <div class="clearfix"></div>
            </div>

            <!--</div>-->
<!-- Load the Client component. -->
<script src="https://js.braintreegateway.com/web/3.7.0/js/client.min.js"></script>

<!-- Load the Hosted Fields component. -->
<script src="https://js.braintreegateway.com/web/3.7.0/js/hosted-fields.min.js"></script>

<script>
// We generated a client token for you so you can test out this code
// immediately. In a production-ready integration, you will need to
// generate a client token on your server (see section below).
var form = document.querySelector('#checkout-form');
var submit = document.querySelector('input[type="submit"]');
var authorize = '<?php echo Braintree_ClientToken::generate() ?>';

braintree.client.create({
  // Replace this with your own authorization.
  
  authorization: authorize
}, function (clientErr, clientInstance) {
  if (clientErr) {
    // Handle error in client creation
    return;
  }

  braintree.hostedFields.create({
    client: clientInstance,
    styles: {
      'input': {
        'font-size': '12pt'
      },
      'font-family': 'helvetica, tahoma, calibri, sans-serif',
      'input.invalid': {
        'color': 'red'
      },
      'input.valid': {
        'color': 'green'
      }
    },
    fields: {
      number: {
        selector: '#card-number',
        placeholder: '4111 1111 1111 1111'
      },
      cvv: {
        selector: '#cvv',
        placeholder: '123'
      },
      expirationMonth: {
        selector: '#expiration-month',
        placeholder: 'MM'
      },
      expirationYear: {
        selector: '#expiration-year',
        placeholder: 'YY'
      },
      postalCode: {
        selector: '#postal-code',
        placeholder: '90210'
      }
    }
  }, function (hostedFieldsErr, hostedFieldsInstance) {
    if (hostedFieldsErr) {
      // Handle error in Hosted Fields creation
      return;
    }

    submit.removeAttribute('disabled');

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
        if (tokenizeErr) {
          // Handle error in Hosted Fields tokenization
          return;
        }

        // Put `payload.nonce` into the `payment-method-nonce` input, and then
        // submit the form. Alternatively, you could send the nonce to your server
        // with AJAX.
        console.log(payload.nonce);
        document.querySelector('input[name="payment-method-nonce"]').value = payload.nonce;
        form.submit();
      });
    }, false);
  });
});
</script>

  <?php } else { ?>
  <!--<div style="font-weight: bold; padding: 10px 10px;">-->
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
  ?>

<!--======footer close======-->
  

</body> 
</html>
