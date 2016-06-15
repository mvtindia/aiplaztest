  <?php
session_start();
include_once('connect.php');
if(isset($_GET['msg']))
{
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
<?php 
$msg = $_GET['msg'];
if($msg=='001')
{
  $place = $_GET['paypal_status'];
 echo'<div class="col-md-12"style="padding: 33px 0px;text-align: center; color: green; font-size: 25px; font-weight: 700;">
    <p style=" display: inline-block; border: 2px groove; padding: 20px 209px; box-shadow: 0px 0px 14px black;">Booking Successfully Done</p>
  </div>';
  header('location:list-service1.php?id='.$place.'');
  
}
elseif($msg=='002')
{
  
    echo '<div class="col-md-12" style="padding: 33px 0px;text-align: center; color: red; font-size: 25px; font-weight: 700;">
    <p style=" display: inline-block; border: 2px groove; padding: 20px 209px; box-shadow: 0px 0px 14px black;">Booking Cancelled </p>
  </div>';

}
 ?>
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
