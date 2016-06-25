<?php session_start();
include('connect.php');?>
<!doctype html>
<html>
<head>

	<title>About us</title>
	<?php include 'lib/top.php';?>
	
</head>

<body>

<div class="container-fluid"><!--container-fluid start-->
<div class="row">

    <div class="menu-had2">
<?php include 'lib/header.php';?>
</div><!--menu-had close-->
    <!--===================About Us Section==========================-->
<div class="container mg-top50">
<div class="row">
<div class="col-md-12 col-lg-12 colsm-12 col-xs-12 about-text">
<h1 class="city-had-cus">About Us</h1>
<?php $query=mysqli_query($connect,'SELECT * FROM `pages` where page_title="home"');
        $row=mysqli_fetch_array($query);
        ?>
  <p class=""><?php echo html_entity_decode($row["page_content"]);?></p>
<!--
  <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 text-center">
  <img class="img-responsive margin-auto hw1 icon1" src="img/easy-use1.png">
    <p class="text-center about-p1 mg-top5">Easy to Use</p>
  </div>

    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 text-center">
    <img class="img-responsive margin-auto hw1 icon2" src="img/budget1.png">
    <p class="text-center about-p2 mg-top5">Budget Friendly</p>
  </div>

      <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 text-center">
      <img class="img-responsive margin-auto hw1 icon3" src="img/trusted1.png">
    <p class="text-center about-p3 mg-top5">Verified(Trusted)</p>
  </div>
-->
  </div>
  </div>
  </div>


    
    
    

<!--===================How it works Section==========================-->
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mg-top50">
<h1 class="city-had-cus">How it Works?</h1>
<?php
//                           $query=mysqli_query($connect,'SELECT * FROM `pages` where page_title="Work"');
//                           $row=mysqli_fetch_array($query);
//                           $content=html_entity_decode($row["page_content"]);
//                           $text=str_ireplace('<p>','',$content);
//                           $text=str_ireplace('</p>','',$text);
                            ?>
<!--<iframe class="mg-top10" width="100%" height="415" src="<?php echo $text; ?>" frameborder="0" allowfullscreen></iframe>-->
    
    <img class="img-responsive long-img" src="images/howitworks.jpg">
    
 
  </div>
  </div>
  </div>

<!--===================How it Works close==========================-->
    
</div><!--row close-->


<!--======footer======-->
	
<!--======footer close======-->
</div><!--row close-->
</div><!--container-fluid close-->

</body>	
</html>
<!-- <script src="js/forms-map.js"></script> -->
<?php include 'lib/footer.php'; //if isset 

  ?>
