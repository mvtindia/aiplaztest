  <?php
session_start();
include_once('connect.php');
// if(isset($_SESSION['u_id'])
// {
  $paypal_url='https://www.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='bluestar.jeet@gmail.com'; // Business email ID
$book = $_REQUEST['booking_id'];
$q17 = mysqli_query($connect,'Select * from users,booking where uid="'.$_SESSION['u_id'].'" and uid=userid and bookid="'.$book.'"');
if(mysqli_num_rows($q17)>0)
{
$r17=mysqli_fetch_array($q17);

// $q18 = mysqli_query($connect,"select * from booking where bookid=".$book);
// $r18 = mysqli_fetch_array($q18);
?>

<!doctype html>
<html>
<head>

  <title>Booking form</title>
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
<h4>Feel free to book a place and enjoy your occasion.</h4> 
 </div>  
</div><!--row close-->
</div><!--container close-->

</div><!--banner-upper close-->
</div><!--banner-bg close-->
<div class="container">
<div class="row">
<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
<div class="tellus-data col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-lr-0">
<form  id="booking_form45" method="post" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-lr-0" >
<div class="had-frm">Your Details</div>
<div class="frm-field-mar">

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Package</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
   <input type="hidden" value="<?php echo $book; ?>" id="booking_id" >
     <input type="text" name="book_id" hidden value="<?php echo $book; ?>">
    <input readonly="" type="text" value="<?php echo $r17['package']; ?>" class="form-control" id="" placeholder="Premium">
  </div>
  
  </div>
  
  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
  <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Price Per <?php echo $r17['package']; ?></label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" type="text" value="<?php echo $r17['price']; ?>" class="form-control" id="" placeholder="2000/-">
  </div>
  </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
  <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Checkin</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" type="text" value="<?php echo $r17['checkin']; ?>" class="form-control" id="" placeholder="2-10-12">
  </div>
  
  </div>
  
  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
  <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Checkout</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" type="text" value="<?php echo $r17['checkout']; ?>" class="form-control" id="" placeholder="5-10-12">
  </div>
  
  </div>
  
  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
  <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Total Price</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" id="amount" type="text" name="total_price" value="<?php echo $r17['hotel']; ?>" class="form-control" id="" >
  </div>
  
  </div>
  
  
  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
  <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Number of persons</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" type="text" value="<?php echo $r17['guests ']; ?>" class="form-control" id="" placeholder="1">
  </div>
  
  </div>
  
  

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
  <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Name</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" type="text" value="<?php echo $r17['fname']." ".$r17['lname']; ?>" class="form-control" id="" placeholder="Name">
  </div>
  </div>
  
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Contact Number</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" type="text" value="<?php echo $r17['contact']; ?>" class="form-control" id="" placeholder="Contact">
  </div>
  </div>
  
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
      <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Location</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" type="text" value="<?php echo $r17['city']; ?>" class="form-control" id="" placeholder="Location">
  </div>
  </div>
  
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top10">
    <div class="col-md-3 col-lg-3 col-sm-4 col-xs-6">
    <label for="space">Email ID</label>
  </div>
   <div class="col-md-9 col-lg-9 col-sm-8 col-xs-6">
    <input readonly="" type="text" value="<?php echo $r17['email']; ?>" class="form-control" id="" placeholder="Email">
  </div>
  </div>
  
  
  
  

  <!--=======================================-->

  <div class="col-md-12 text-center mg-top20 mg-bottom20">
  <div class="btn-group" data-toggle="buttons">
      <label class="btn btn-success">
        <button type="submit" id="paypal_data" name="paypal_insertion"  style="background: transparent;border: none; padding: 0px;">Pay online</button>
      </label>
      
      <label class="btn btn-success hotel-btn">
        <button type="button" required="" class="hotel-btn"  name="method" value="hotel" style="background: transparent;border: none; padding: 0px;">Pay at Hotel</button>
      </label>
      <label class="btn btn-success ">
        <button type="button" required="" class="cancel-btn btn-danger"  name="method"style="background: transparent;border: none; padding: 0px;" value="<?php echo $r17['bookid']; ?>">Cancel Booking</button>
      </label>
      </div>

    </div>
      </div>
    </form>
<?php 
  $sql4 = mysqli_query($connect,"SELECT * FROM place,users WHERE user_id=uid and place_id='".$r17['placeid']."'");
  $row4 = mysqli_fetch_array($sql4); ?>
    <form method="post" id="book_messagess">
<input name="to_msg" value="<?php echo $row4['uid']; ?>" type="hidden">
  <div class="hides">
 <textarea required="" class="form-control height90" name="message" placeholder="Type Your Message Here.."></textarea>
 <input type="text" name="place_id" hidden value="<?php echo $r17['placeid']; ?>">
   </div>
    <button class="btn-reply send_btn2 mg-top10" type="submit" name="book_messagess" style="display: none;"><i class="fa fa-share-square-o"></i>&nbsp;Send</button>
    <button class="btn-reply cancel_btn2 mg-top10" type="button" style="display: none;"><i class="fa fa-times"></i>&nbsp;Cancel</button>
    </form>
</div>

  </div>
    <form action="<?php echo $paypal_url ?>" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="<?php echo $row4['space_name'];?>">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="<?php echo $r17['hotel']; ?>">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="cancel_return" value="http://vismaadlabs.org/bookmyspace/forms.php?bookid_cancel=<?php echo $r17['bookid']; ?>">
    <input type="hidden" name="return" value="http://vismaadlabs.org/bookmyspace/forms.php?bookid_success=<?php echo $r17['bookid']; ?>&ser_placeid=<?php echo $r17['placeid']; ?>">
    <input type="image" id="paypal_submit" border="0" name="submit" hidden>
   <!--  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"> -->
    </form> 
<!--  <span><button style="float: right; margin-bottom: 1%;" class="btn-3" data-toggle="modal" data-target="#compose">Compose</button></span> -->


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
<p>Your property is covered for up to €500,000.</p>
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


<!--======footer======-->
  <?php include 'lib/footer.php'; 
}
 else 
  { 
    header('location:index.php');
   } 
// else
// {
//    header('location:index.php'); 
// }

  ?>
<!--======footer close======-->
</div><!--row close-->
</div><!--container-fluid close-->

</body> 
</html>
