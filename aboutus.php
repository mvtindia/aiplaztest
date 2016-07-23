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
    


<!--====================================Testimonial==========================-->
<div class="">
<div class="testimon">
<div class="container">
<div class="row">
<div><h1 class="city-had-cus1">Testimonials</h1></div>
<!--=====================test slider=================-->

    <div class='col-md-offset-2 col-md-8'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
          <?php $sql = mysqli_query($connect,"SELECT * FROm testimonials order by tid");
          $i=0;
        while($row=mysqli_fetch_array($sql)){

 ?>
          <li data-target="#quote-carousel" data-slide-to="<?php echo $i++;?>" class="<?php echo $row['tactive'];?>"></li>
<?php } ?>
        </ol>

        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">
        <?php $sql = mysqli_query($connect,"SELECT * FROm testimonials order by tid");
        while($row=mysqli_fetch_array($sql)){
 ?>
          <!-- Quote 1 -->
          <div class="item <?php echo $row['tactive'];?>">
           <!--  <blockquote> -->
              <div class="row">

                <div class="col-sm-12">
                  <p class="text-test"><?php echo $row['tcontent'];?></p>
                  <div class="ceo-name">
          <center><h5><?php echo $row['tname'];?></h5></center>
          <!-- <center><h5>CEO of Pineapple</h5></center> -->
          </div>
                </div>
              </div>
           <!--  </blockquote> -->
          </div>
          <?php }//while ?>

        </div>


      </div>
    </div>

<!--======================test slider end==============-->
</div><!--row close-->
</div><!--container close-->
</div><!--testimon-main close-->
</div>
<!--====================================Testimonial end==========================-->




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
