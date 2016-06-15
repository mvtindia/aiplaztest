<?php session_start();
include('connect.php');
if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])){?>
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
 <h1> List a Service</h1>
<h4>Earn money renting out a spare room, marriage place or House. Listing your place is totally free. </h4> 
 </div>  
</div><!--row close-->
</div><!--container close-->

</div><!--banner-upper close-->
</div><!--banner-bg close-->
<div class="container">
<div class="row">
<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
<div class="tellus-data service1 col-xs-12 col-sm-12 col-md-12 pd-lr-0">
<form role="form" id="serviceform" method="post">
      <div class="had-frm-sec">Your Service Details</div>
   
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="black" for="space">Business Title *</label>
    <input type="text" class="form-control"required name="btitle" id="btitle" placeholder="Space title">
  </div>

<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 sample-only">
    <label class="black" for="email">Events</label>
<select id="select1" class="wid100" required multiple="multiple" name="events[]" >
     <!--  <option value="" hidden>Select Uses</option> -->
    <?php $query=mysqli_query($connect,'Select * from usedfor');
while($match=mysqli_fetch_array($query)){?>
    <option value="<?php echo $match['ufid'];?>"><?php echo $match['ufname'];?></option>
<?php }//while ?>
</select> 
  </div>
  
  

  
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="black" for="space">Contact</label>
    <input type="text"  maxlength="15" class="form-control form-height40 bord-0 phone" name="contact" placeholder="Mobile" required/>
  </div>

  
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label class="black" for="space">Description *</label>
    <textarea  class="form-control" required  name="description" id="description" placeholder="Description"></textarea>
  </div>
  

  <div class="clearfix"></div>

  <!--=====================================-->
      <div class="had-frm-sec">Your Service Location</div>
  <div class="frm-field-mar">
  <div id="locationField" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
  <label class="black">Address</label>
      <input class="form-control" required id="autocomplete" name="location" placeholder="Enter your address"
             onFocus="geolocate()" type="text">
    </div>
    <div id="address" class="col-lg-6 col-sm-6 col-md-6 col-xs-6 mg-top20" style="display:none;">

        <input class="field form-control" id="street_number" disabled="true">
            </div>
             <div id="address" class="col-lg-6 col-sm-6 col-md-6 col-xs-6 mg-top20" style="display:none;">
<input class="field form-control" id="route" disabled="true">
            </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 mg-top15">
     <label class="black">City</label>
        <input class="field form-control" id="locality"  name="city" 
              readonly>
      </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 mg-top15">
        <label class="black">State</label>
         <input class="field form-control"
              id="administrative_area_level_1"  name="state" readonly>
      </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 pd-bottom20 mg-top15">
        <label class="black">Zip code</label> 
        <input class="field form-control" id="postal_code" name="postcode" 
              readonly>
      </div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 pd-bottom20 mg-top15">
        <label class="black">Country</label> 
        <input class="field form-control"
              id="country"  name="country" readonly>
      </div>
  

  <div class="clearfix"></div>
  </div><!--frm-field-mar-->
  <!--=====================================-->
  

  
      <div class="had-frm-sec">Price & Terms</div>
  <div class="frm-field-mar">
  <?php include_once('demo.php');?>
  
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="black" for="space">Currency</label>
    <input type="text" name="currency" value="<?php echo $_SESSION['currencySymbol'];?>" class="form-control">
<!-- <select class="form-control" id="sel1" name="currency" >
  <option value="">Select Options</option>
    <option value="1">$</option>
    <option value="2">€</option>
    <option value="3">¥</option>
    <option value="4">₹</option>
  </select> -->
  </div>


      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="black" for="space">Price Per Night</label>
   <input type="number" required class="form-control" name="ppd" id="ppd" placeholder="Enter price">
  </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="black" for="space">Price Per Hour</label>
   <input type="number" required class="form-control" name="pph" id="pph" placeholder="Enter price">
  </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="black" for="space">Price Per Week</label>
   <input type="number" required class="form-control" name="ppp" id="ppp" placeholder="Enter price">
  </div>
  <div class="clearfix"></div>
  </div><!--frm-field-mar-->
  <!--=====================================-->
  
      <div class="had-frm-sec">Photos & Videos</div>
  <div class="frm-field-mar">
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >     
<label class="custom-upload uploadphoto">ADD PHOTOS</label>
<div class="upphoto" style="display:none;">
   <input id="input-7" name="inputphotos[]" data-show-upload="false" multiple type="file" class="file file-loading" >
   <p style="font-size: 12px"> Please Upload Photo of (jpg/png/gif/jpeg) Formats with Min size W:780*H:520</p>
</div>
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
  <button type="submit" name="saveservice" class="btn btn-default cus-save-but">Save</button>
  </div>
</form>



</div>
<div class="clearfix"></div>
<div class="col-md-12 service2" style="padding:0px;display:none;">
 
  
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
 
<span class="had-2nd black">It's safe</span>
<p class="p14">Your property is covered for up to €500,000.</p>
 </div>
<div class="clearfix"></div>
</div>

<div class="safe-lst">
 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
 <img class="img-responsive" src="img/easy.png">
 </div>
 <div class="col-lg-10 col-sm-10 col-md-10 col-xs10">
 
<span class="had-2nd black">It's easy</span>
<p class="p14">We'll do all the hard work of finding guests, while you just enjoy earning money with a spare space.</p>
 </div>
<div class="clearfix"></div>
</div>

<div class="safe-lst">
 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
 <img class="img-responsive" src="img/free.png">
 </div>
 <div class="col-lg-10 col-sm-10 col-md-10 col-xs10">
 
<span class="had-2nd black">It's free</span>
<p class="p14">We don't charge you to upload your place, and you get instant access to thousands of guests.</p>
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
  <?php include 'lib/footer.php';?>

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