<?php session_start();
include('connect.php');
if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])){ ?>
<!doctype html>
<html>
<head>

  <title>List a Service</title>
  <?php include 'lib/top.php';?>
 <link rel="stylesheet" type="text/css" href="jquery-cal/css/range-calendar.css">
  <link rel="stylesheet" type="text/css" href="jquery-cal/css/range-style.css"> 
</head>

<body>
<div class="ishowload" style="display:none;top:50%;box-shadow:none;background-color:transparent;border:none;">
      <img class="showimg1" src="img/loading.gif" style="margin:0 auto;display:block;width:53px;">
</div>
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
 <h1> Edit Service</h1>
<h4>Earn money renting out a spare room, marriage place or House. Listing your place is totally free. </h4> 
 </div>  
</div><!--row close-->
</div><!--container close-->

</div><!--banner-upper close-->
</div><!--banner-bg close-->
<div class="container">
<div class="row">
<?php  $sid=$_REQUEST['sid'];
 $query=mysqli_query($connect,'SELECT s.city,stitle,seventid,scontact,sdesc,location,state,postcode,ppn,pph,ppw,country,currencyid,photo,photo,video FROM `services` s,`users` u where sid="'.$sid.'" and uid=rid');
                                $row=mysqli_fetch_array($query);
?>
<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
<div class="tellus-data service1 col-md-12 col-sm-12 col-xs-12 pd-lr-0">
<form role="form" id="editserviceform" method="post">
      <div class="had-frm-sec">Your Service Details</div>
   <input type="hidden" name="sid" value="<?php echo $sid; ?>" placeholder="">
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Business Title *</label>
    <input type="text" class="form-control" name="btitle" value="<?php echo $row['stitle'];?>" id="btitle" placeholder="Space title">
  </div>

<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 sample-only">
    <label for="email">Events</label>
<select id="select1" class="wid100" multiple="multiple" name="events[]" >
    <?php 
    $events=explode(",",$row['seventid']);
    $query=mysqli_query($connect,'Select * from usedfor');
while($match=mysqli_fetch_array($query)){
  if(in_array($match['ufid'], $events)){?>
    <option value="<?php echo $match['ufid'];?>" selected><?php echo $match['ufname'];?></option>
<?php }
else{?>
    <option value="<?php echo $match['ufid'];?>"><?php echo $match['ufname'];?></option>

 <?php }}//while ?>

</select> 
  </div>
  
  
<!-- <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="email">Business Category *</label>
    <select class="form-control" name="cat" >
         <?php $query=mysqli_query($connect,'Select * from servicecats');
while($match=mysqli_fetch_array($query)){?>
  <option value="">Select Business type</option>
    <option value="<?php echo $match['scid'];?>"><?php echo $match['scat'];?></option>
    <?php } ?>
  </select>
  </div> -->
  
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Contact</label>
    <input type="text" class="form-control phone"  name="contact" id="contact" value="<?php echo $row['scontact']; ?>" placeholder="Contact">
  </div>

  
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="space">Description *</label>
    <textarea  class="form-control"  name="description" id="description" placeholder="Description"><?php echo $row['sdesc']; ?></textarea>
  </div>
  

  <div class="clearfix"></div>

  <!--=====================================-->
      <div class="had-frm-sec">Your Service Location</div>
  <div class="frm-field-mar">
  <div id="locationField" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <input class="form-control" id="autocomplete" placeholder="Enter your address" value="<?php echo $row['location']; ?>" name="location"  onFocus="geolocate()" type="text">
    </div>
    <div id="address" class="col-lg-6 col-sm-6 col-md-6 col-xs-6 mg-top20" style="display:none;">

        <input class="field form-control" id="street_number" disabled="true">
            </div>
             <div id="address" class="col-lg-6 col-sm-6 col-md-6 col-xs-6 mg-top20" style="display:none;">
<input class="field form-control" id="route" disabled="true">
            </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
     <label class="label">City</label>
        <input class="field form-control" id="locality"  value="<?php echo $row['city']; ?>" name="city" 
              readonly>
      </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <label class="label">State</label>
         <input class="field form-control"
              id="administrative_area_level_1"  name="state" value="<?php echo $row['state']; ?>" readonly>
      </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 pd-bottom20">
        <label class="label">Zip code</label> 
        <input class="field form-control" id="postal_code" value="<?php echo $row['postcode']; ?>" name="postcode" 
              readonly>
      </div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 pd-bottom20">
        <label class="label">Country</label> 
        <input class="field form-control"
              id="country"  name="country" value="<?php echo $row['country']; ?>" readonly>
      </div>
  

  <div class="clearfix"></div>
  </div><!--frm-field-mar-->
  <!--=====================================-->
  

  
      <div class="had-frm-sec">Price & Terms</div>
  <div class="frm-field-mar">
  <?php include_once('demo.php');?>
  
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Currency</label>
    <input type="text" name="currency" value="<?php echo $row['currencyid']; ?>" class="form-control">
<!-- <select class="form-control" id="sel1" name="currency" >
  <option value="">Select Options</option>
    <option value="1">$</option>
    <option value="2">€</option>
    <option value="3">¥</option>
    <option value="4">₹</option>
  </select> -->
  </div>


      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Price Per Night</label>
   <input type="text" class="form-control" name="ppd" id="ppd" value="<?php echo $row['ppn']; ?>" placeholder="Enter price">
  </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Price Per Hour</label>
   <input type="text" class="form-control" name="pph" id="pph" value="<?php echo $row['pph']; ?>" placeholder="Enter price">
  </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Price Per Week</label>
   <input type="text" class="form-control" name="ppp" id="ppp" value="<?php echo $row['ppw']; ?>" placeholder="Enter price">
  </div>
  <div class="clearfix"></div>
  </div><!--frm-field-mar-->
  <!--=====================================-->
  
      <div class="had-frm-sec">Photos & Videos</div>
  <div class="frm-field-mar">
    <div class="mphotos col-md-12" style="">
                       <input type="hidden" name="pg" id="pg" value="<?php echo $row['photo'];?>">
 
    <?php  
    if(!empty($row['photo'])){
$photo=explode(",",$row['photo']);
$query=mysqli_query($connect,'Select * from services where sid="'.$sid.'"');
if($match=mysqli_fetch_array($query)){
  for ($k=0; $k < count($photo); $k++) { 
    echo '<div class="col-md-6"><img style="width: 100%; max-height:145px;" src="images/services/'.$photo[$k].'" class="img-responsive mimages">';
    echo '<i class="fa fa-trash-o scross-hover" data-pid="'.$k.'"></i></div>';
 }//for
  }
  }?>
  </div>
  <input type="hidden" name="placeid1" value="<?php echo $sid; ?>" id="placeid1">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >     
<label class="custom-upload uploadphoto">ADD PHOTOS</label>
<div class="upphoto" style="display:none;">
   <input id="input-7" name="inputphotos[]" data-show-upload="false" multiple type="file" class="file file-loading" >
    <p style="font-size: 12px"> Please Upload Photo of (jpg/png/gif/jpeg) Formats with Min size W:780*H:520</p>
</div>
</div>
   <div class="mvideos col-md-12" style="">
                       <input type="hidden" name="pg1" id="pg1" value="<?php echo $row['video'];?>">
                       <input type="hidden" name="pg2" id="pg2" value="<?php echo $row['video_type'];?>">
 
    <?php  
    if(!empty($row['video'])){
$video=explode(",",$row['video']);
$query=mysqli_query($connect,'Select * from services where sid="'.$sid.'"');
if($match=mysqli_fetch_array($query)){
  for ($k=0; $k < count($video); $k++) { 
    echo '<div class="col-md-6">
    <video autobuffer autoloop loop controls height="145" width="100%">
    <source src="video/'.$video[$k].'">
  </video>';
    echo '<i class="fa fa-trash-o svcross-hover" data-pid1="'.$k.'"></i></div>';
 }//for
  }
  }?>
  </div>
   <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> <label class="custom-upload uploadvideo">
  ADD Videos</label> </div>
 <div class="upvideo" style="display:none;">
   <input id="input-8" name="inputvideos[]" data-show-upload="false" multiple type="file" class="file file-loading">
   <p style="font-size: 12px"> Please Upload Videos of (webm/mp4) Formats with max size upto 10 MB</p>
</div>
  <div class="clearfix"></div>
  </div><!--frm-field-mar-->
  
  <div class="but-align form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <button type="submit" name="editservice" class="btn btn-default cus-save-but">Save</button>
  </div>
</form>
</div>
<div class="clearfix"></div>

<div class="col-md-12 service2" style="padding:0px;display:none;">
     <div class="col-md-12 tellus-data for_service_data" style="border-bottom: 0px solid #FC8B11;border-left: 2px solid #FC8B11;border-right: 2px solid #FC8B11;">

      <?php  $sql9 = mysqli_query($connect,"SELECT * FROM servicedata WHERE sid='".$sid."'");
      if(mysqli_num_rows($sql9)>0)
      { 
        ?>
            <style>
.full-green-theme.range-calendar, .full-green-theme .range-calendar {
    background-color: #FC8B11 !important;
}
.nav-tabs {
    border-bottom: 1px solid #FC8B11 !important;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #FC8B11 !important;
    cursor: default;
    background-color: #FFF !important;
    border: 1px solid #FC8B11  !important;
    border-bottom-color: transparent;
}
    </style>
        <div class="row" style="background: #FC8B11;
    padding: 13px 0px;
    color: white;
    font-weight: bolder;
    font-size: 19px;">
          <div class="col-md-3">From</div>
          <div class="col-md-3">To</div>
          <div class="col-md-1">ppn</div>
          <div class="col-md-1">pph</div>
          <div class="col-md-1">ppw</div>
          <div class="col-md-3">Action</div>
        </div>
        <?php
        $he = 1;
        while($row9 = mysqli_fetch_array($sql9))
        {
          ?><div class="row for_re" style="    padding: 11px 0px 1px 0px;
    border-bottom: 2px solid #FC8B11;">
            <div class="col-md-3 text-center"><?php echo $row9['date1'] ?></div>
            <div class="col-md-3 text-center"><?php echo $row9['date2'] ?></div>
            <?php if(($row9['ppn']=="0")&&($row9['pph']=="0")&&($row9['ppw']=="0"))
            {
              ?>
<div class="col-md-3 text-center">Not Available</div>
<?php
            }
              else
              {

               ?>
            <div class="col-md-1 text-center"><input class="he<?php echo $he; ?>" style="width: 59px;" type="text" name="p_p_n" value="<?php echo $row9['ppn'] ?>"></div>
            <div class="col-md-1 text-center"><input class="he<?php echo $he; ?>" style="width: 59px;" type="text" name="p_p_h" value="<?php echo $row9['pph'] ?>"></div>
            <div class="col-md-1 text-center"><input class="he<?php echo $he; ?>" style="width: 59px;" type="text" name="w_p_p_n" value="<?php echo $row9['ppw'] ?>"></div>
            <?php } ?>
            <div class="col-md-3 text-center"><button name="calender_price_update"id="he<?php echo$he; ?>" class="btn btn-success onclcick_submit_price1" value="<?php echo $row9['sdid']; ?>"><i class="fa fa-pencil"></i></button>
            <button name="calender_price_update"id="the<?php echo $row9['sdid']; ?>" class="btn btn-danger onclcick_delete_price1" value="<?php echo $row9['sdid']; ?>"><i class="fa fa-trash"></i></button></div>
            </div>
          <?php
          $he++;
          }
          ?>
               <div class="row"style="padding: 11px 0px 1px 0px;
    border-bottom: 2px solid #FC8B11;">
          <div class="col-md-12 form-group text-center">
            <button id="add_cal_price" class="btn-success btn">Add</button>
            <a href="dashboard.php" class="btn-warning btn">My DashBoard</a>
            <a href="edit-service.php?sid=<?php echo $sid; ?>" class="btn-info btn">Back</a>
          </div></div>
          <?php
      }
      else{
        echo '<div class="row"style="padding: 11px 0px 1px 0px;
    border-bottom: 2px solid #1BBC9B;">
    <div class="col-md-8"> No Special Price yet!</div> <div class="col-md-2">
            <button id="add_cal_price" class="btn-success btn">Add</button></div>
          </div>';
        } ?>
    </div>
     <div class="col-md-12" id="cal_data_cl" style="display: none;padding: 11px 0px 1px 0px; border-bottom: 2px solid #FC8B11;">
    <?php include_once('calender2.php'); ?>
  </div>
</div>

 </div> 
 <style>
  p
  {
    font-size: 13px !important;
  }
 </style>
<!--==========WHY LIST YOUR PLACE?============-->
 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
<div class="tellus-data col-md-12 col-xs-12 col-sm-12 pd-lr-0">
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
 <div id="myModal2" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="showload" style="display:none;">
      <img class="showimg" src="img/loading.gif" style="margin:0 auto;display:block;">
    </div>
    <div class="hidecontent">
      
   
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login to continue</h4>
      </div>
      <div class="modal-body">
    <div id="first-block">
        <div class="fb">
  <button class="fb-btn"><i class="fa fa-facebook"></i>&nbsp;Join with Facebook</button>
  </div>

  <div class="google mg-top10">
  <button class="google-btn"><i class="fa fa-google-plus"></i>&nbsp;Join with Google</button>
  </div>

  <p class="text-center">or</p>
  <div class="text-center">
  <button type="button" class="btn-3">Login</button>
  <button type="button" class="btn-4">Signup</button>
  </div>
  </div>
  <div class="hide1" id="second-block">
  <form class="form-group" id="login">
  
  <div class="input-group" id="login">
    
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="email" class="form-control form-height40 bord-0"  name="email" reuired placeholder="Email Id"/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
  <input type="password" class="form-control form-height40 bord-0" name="password" required placeholder="Password"/>

  <input type="hidden" class="urlval" >

</div>

  <div class="text-center mg-top10">
  <button type="submit" class="btn-3" name="login">Login</button>
  <button type="button" class="btn-back">Back</button>
  </div>
  </form>
  </div>
  
  
  <div class="hide1" id="third-block">
  <form class="form-group" action="actions.php" id="signup_form" method="POST">
  
  <div class="input-group">
    
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="text" class="form-control form-height40 bord-0" name="fname" placeholder="First Name" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
  <input type="text" class="form-control form-height40 bord-0" name="lname" placeholder="Last Name" required/>
</div>


<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-at"></i></span>
  <input type="email" class="form-control form-height40 bord-0" name="email" placeholder="Email Address" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
<input type="password" class="form-control form-height40 bord-0 pwd" minlength="6" name="pwd" id="pwd" placeholder="Password" required/>
</div>

<div class="input-group mg-top20">
    
    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
<input type="text"  maxlength="15" class="form-control form-height40 bord-0 phone" name="contact" placeholder="Mobile" required/>
</div>  

  
  <div class="text-center mg-top10">
  <button type="submit" name="signup" id="signup" class="btn-4">Signup</button>
  <button type="button" class="btn-back">Back</button>
  </div>
  </form>
  </div>
  
      </div>
      <div class="modal-footer" style="text-align: center;">
       <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <span class="showmsg" style="display:none;"></span>
      </div>
    </div>
 </div>
  </div>
</div>
<?php
if(isset($_GET['unique']))
{
?>
<script>
$(document).ready(function(){
  $('.service1').css('display','none');
   $('.service2').css('display','block');
 });
</script>
<?php
}
if(isset($_GET['unique1']))
{
?>
<script>
$(document).ready(function(){
$('#edetails').css('display','none');
$('#ephotovideo').css('display','block');
});
</script>
<?php
}
?>
  <!--==================Signup Modal box Ends==============-->
  

 
<!--========== footer 1st============-->
<footer class="footer-media">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3 class="subtitle"><strong>Useful Links</strong></h3>
                    <ul class="site-links">
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Rooms</a></li>
                        <li><a href="#">Facilities</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Event Planner</a></li>
                        <li><a href="#">Special Offer</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Under Construction</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 text-center">
                    <h3 class="subtitle wide">Book <strong>My</strong> Space</h3>
                    <div class="moon-divider small"></div>
                    <p>24-26-28 Southern Str, Melbourne, VIC</p>
                    <p>(+333) - 333 - 333333   —   (+333) - 333 - 33333</p>
                    <p><a href="#">info@bookmyspace.com</a></p>
                    <p><a href="#">http://bookmyspace.com</a></p>
                    <div class="moon-divider small"></div>
                    <div class="social-links">
                        <a class="social-link" href="#"><i class="fa fa-facebook"></i><i class="fa fa-facebook"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-google-plus"></i><i class="fa fa-google-plus"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-pinterest-p"></i><i class="fa fa-pinterest-p"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-instagram"></i><i class="fa fa-instagram"></i></a>
                        <a class="social-link" href="#"><i class="fa fa-youtube"></i><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-sm-4 text-right">
                    <h3 class="subtitle"><strong>Newsletter</strong></h3>
                    <p>Cras dignissim, velit ut placerat pulvinar, metus justo ultricies lacus, ut consectetur neque augue maximus lectus. Phasellus non placerat nibh.</p>
                    <div class="inputs">
                        <div class="input-wrapper"><input type="text" id="email" name="email" placeholder="Enter your email here"></div>
                        <button><i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
       
    </footer>
  
  
  
  <div class="footer-lst">
<div class="container wid100">
<span>Copyright &copy; 2016 Bookmyspace</span>
<div class="row">
</div><!--row close-->
</div><!--container close-->
</div><!--footer-fst close-->
 

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <!-- <script src="js/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

       <script src="bootstrap/js/bootstrap.js"></script> -->
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
   <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script src="http://www.jqueryscript.net/demo/jQuery-jQuery-UI-Based-Date-Range-Picker-Plugin/jquery.comiseo.daterangepicker.js"></script>
   
   
        <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
      


    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
 
    <script type="text/javascript" src="bm/js/plugins/canvas-to-blob.min.js"></script>
    <script src="bm/js/fileinput.min.js" type="text/javascript"></script>
    <script src="js/custom-calendar.js"></script>
     
    <script type="text/javascript" src="js/jquery.mask.js"></script>

  
     
     <script src="sm/dist/sweetalert2.min.js"></script>

     <script src="js/nouislider.js"></script>

     
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script src="js/custom.js"></script>
   
   
      <script src="js/forms.js"></script>

      <script src="js/forms2.js"></script>
<script src="js/forms-map.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
   
   <script src="js/star-rating.min.js"></script>
  <!--<script src="js/bootstrap-select.js"></script> -->
  
  <script src="js/wow.js"></script>
<script>
         var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0ceT-_kjPt8INNEKoVX9axkv3zw3miBY&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
<!--======footer close======-->
</div><!--row close-->
</div><!--container-fluid close-->


</body> 
</html>
<?php }//if isset 
else{
  header('location:index.php');
}
  ?>