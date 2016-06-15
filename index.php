<!doctype html>
<html>
<head>

  <title>Book My Space</title>
  <?php include 'lib/top.php';?>
<style>
#carousel-example-generic{
  z-index:-1;
}
.navbar-inverse .navbar-nav > li > a:hover, .navbar-inverse .navbar-nav > li > a:focus {
    color: #D64512!important;
    transition: 0.4s;
}
.btn-custom:hover {
    background-color: transparent !important;
    border: 1px solid #1BBC9B!important;
}

button.multiselect.dropdown-toggle.btn.btn-default
{
  height: 45px;
}
</style>
</head>

<body>
<?php include_once('connect.php'); ?>

<div class="container-fluid"><!--container-fluid start-->
<div class="row">


<!--==============menu header=========================-->
<div class="menu-had">
<?php include 'lib/header.php';?>
</div><!--menu-had close-->
<!--==============menu header close=========================-->

<!--=================slider========================-->

<div class="">
  <div id="carousel-example-generic" class="carousel slide">

      <!-- Wrapper for slides -->
      <div class="carousel-inner hg-500" role="listbox">

        <!-- First slide -->
        <div class="item active deepskyblue">

          <div class="carousel-caption">
         </div>
        </div> <!-- /.item -->

        <!-- Second slide -->
        <div class="item skyblue">
          <div class="carousel-caption">
         
          </div>
        </div><!-- /.item -->

        <!-- Third slide -->
        <div class="item darkerskyblue">
          <div class="carousel-caption">
     </div>
        </div><!-- /.item -->

      </div><!-- /.carousel-inner -->

    </div><!-- /.carousel -->
      <div class="text-center mg-top" style="position: relative;">
    <h1 class="color2">What are you Planning?</h1>
    <p class="color2">The more we share the more we have</p>
    </div>
  <div class="search">
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="">
                <div class="row">
                    <form action="searchlst.php" method="post" >
                      <div class="col-md-2 pd-0">
                        <div class="form-group">
                        
                          <label class="sr-only">Location</label>
                          <!-- <input type="text" class="form-control bord" placeholder="City"> -->
                          <input class="form-control bord" id="autocomplete" placeholder="Location" name="place_loc" onFocus="geolocate()" type="text">
                        <input type="hidden" name="my-lat" id="my-lat" value="">
                        <input type="hidden" name="my-lng" id="my-lng" value="">
                        </div>
                      </div>
                        <div class="col-md-2 pd-0">
                        <div class="form-group">
                          <label class="sr-only">Event</label>
                          <!-- <input type="text" class="form-control bord" placeholder="Event"> -->
                          <select id="select1" class="form-control bord" multiple="multiple" name="events[]" >
                               <!--  <option value="" hidden>Select Uses</option> -->
                              <?php $query=mysqli_query($connect,'Select * from usedfor');
                          while($match=mysqli_fetch_array($query)){?>
                              <option value="<?php echo $match['ufid'];?>"><?php echo $match['ufname'];?></option>
                          <?php }//while ?>
                          </select> 
                        </div>
                      </div>
            
            
            
               <div class="col-md-4 pd-0">
                        <div class="form-group">
                          <label class="sr-only">Check-In</label>
                        <input class="daterange1" name="daterange" placeholder="Checkin-Checkout">

                        </div>
                      </div>
                     
                      <div class="col-md-2 pd-0">
                        <div class="form-group">
                          <label class="sr-only">Guests</label>
                          <input type="number" min="1" class="form-control bord" name="guests" placeholder="Guests">
                        </div>
                      </div>

                      <div class="col-md-2 pd-0">
                      <button class="btn-5 bord" name="searching" type="submit">Search</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

</div><!-- /.container -->

<!--===================slider close==========================-->




<!--===================How it works Section==========================-->
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 mg-top50">
<h1 class="city-had-cus">How it Works?</h1>
<?php
                           $query=mysqli_query($connect,'SELECT * FROM `pages` where page_title="Work"');
                           $row=mysqli_fetch_array($query);
                           $content=html_entity_decode($row["page_content"]);
                           $text=str_ireplace('<p>','',$content);
                           $text=str_ireplace('</p>','',$text);
                            ?>
<iframe class="mg-top10" width="100%" height="415" src="<?php echo $text; ?>" frameborder="0" allowfullscreen></iframe>
 
  </div>
  </div>
  </div>

<!--===================How it Works close==========================-->








<!--===================About Us Section==========================-->
<div class="container mg-top50">
<div class="row">
<div class="col-md-12 col-lg-12 colsm-12 col-xs-12 about-text">
<h1 class="city-had-cus">About Us</h1>
<?php $query=mysqli_query($connect,'SELECT * FROM `pages` where page_title="home"');
        $row=mysqli_fetch_array($query);
        ?>
  <p class=""><?php echo html_entity_decode($row["page_content"]);?></p>
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
  </div>
  </div>
  </div>

<!--===================About Us close==========================-->



<!--========================select your city=================================-->
<div class="container mg-top40">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="select-city-main">
<?php $sql = mysqli_query($connect,"SELECT * FROm city order by cityid");
 ?>
<div><h1 class="city-had-cus" style="margin-bottom:40px;">Select your city</h1></div>

<!--=========================city imgs===================-->
<div><?php 
$flag=1;
while($row = mysqli_fetch_array($sql)){
if($flag==1){
  ?>


<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-pad">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad hover-name-main">
<a href="searchlst.php?place_loc=<?php echo $row['cityname'];?>&my-lat=<?php echo $row['latitude'];?>&my-lng=<?php echo $row['longitude'];?>"><div class="hover-name"> <h1 class="hover-txt"><?php echo $row['cityname'];?></h1></div>
<img class="img-responsive long-img" src="admin/images/<?php echo $row['photo'];?>">
</div>  </a>
  </div>
  <?php 
  $flag=0;
  }//if
  else if($flag==0){?>
 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 no-pad">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad hover-name-main">
<a href="searchlst.php?place_loc=<?php echo $row['cityname'];?>&my-lat=<?php echo $row['latitude'];?>&my-lng=<?php echo $row['longitude'];?>"><div class="hover-name"> <h1 class="hover-txt"><?php echo $row['cityname'];?></h1></div>
<img class="img-responsive long-img" src="admin/images/<?php echo $row['photo'];?>">

  </div></a>
  </div> 
  <?php $flag=1;
  }//else
   }//while ?>


<div class="clearfix"></div>
</div>

<!--================sec part=========-->

<!--=========================city imgs close===================-->

<div class="clearfix"></div>
</div>
</div>
</div>
</div>

<!--========================select your city close=================================-->





<!--======================Services Block=================================-->
<div class="container mg-top20 mg-bottom30">
<h4 class="text-center city2">We facilitate sharing your free space for celebration like weddings, private parties, conferences and help you grow with us</h4>
 <?php
   $query1=mysqli_query($connect,'SELECT * FROM `usedfor` limit 4');
        while($row1=mysqli_fetch_array($query1)){
        
            ?>
<div class="col-md-3 hover 1">
    <figure class="snip1205">

<img class="img-responsive" src="../bookmyspace/images/events/<?php echo $row1['ufimage'];?>" >

<?php ?>
 <i class="fa fa-search"></i>
  <a href="searchlst.php?events=<?php echo $row1['ufid']; ?>"></a><!--eventenquiry.php?id=<?php echo $row1['ufid'];?>-->
<h3 class="text-center abs1"><?php echo $row1['ufname'];?></h3>  </figure>

</div>

<?php }//while ?>
<div class="col-md-12 col-sm-12 col-xs-12 text-center">
<a href="events.php" style="">
<button class="btn-5 bord mg-top10" type="button">View More</button></a>
</div>
</div>
<!--======================Services Block Ends=================================-->





<!--==================Hire Professional Block starts here======================-->


<div class="container mg-bottom30">
<h1 class="city-had-cus text-center">Looking to hire event professionals ? Begin here</h1>
 <?php 
 $que32 = mysqli_query($connect,"SELECT * FROM `services` order by sid asc LIMIT 6");
              while($row32 = mysqli_fetch_array($que32))
              {
                if(!empty($row32['photo'])){
                  $spic=explode(",", $row32['photo']);
               ?>
<div class="col-md-4">
    <figure class="snip1205">
  <img src="images/services/<?php echo $spic[0]?>" alt="<?php echo $spic[0];?>"/>
  <i class="fa fa-search"></i>
  <a href="demo-service.php?serviceid=<?php echo $row32['sid'];?>"></a>
  <h4 class="f1"><?php echo $row32['stitle'];?></h4>
</figure>
</div>
<?php }
else{ ?>
<div class="col-md-4">
    <figure class="snip1205">
  <img src="images/services/no_image.png" alt="<?php echo "No Image";?>"/>
  <i class="fa fa-search"></i>
  <a href="demo-service.php?serviceid=<?php echo $row32['sid'];?>"></a>
  <h4 class="f1"><?php echo $row32['stitle'];?></h4>
</figure>
</div>
 <?php }} ?>

</div>



<!--==================Hire Professional Ends here======================-->




<!--====================================Testimonial==========================-->
<div class="testimon-bg">
<div class="testimon-main">
<div class="container">
<div class="row">
<div><h1 class="city-had-cus2">Testimonial</h1></div>
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

  
  
  
  
  
  


<!--======footer======-->
  <?php include 'lib/footer.php';?>
  <script src="js/forms-map.js"></script>
<!--======footer close======-->


</div><!--row close-->
</div><!--container-fluid close-->
</body>

  
  
  
</html>
