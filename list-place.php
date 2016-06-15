<?php session_start();
include('connect.php');?>
<!doctype html>
<html>
<head>

	<title>List a Place</title>
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
 <h1> Add a new place</h1>
<h4>Earn money renting out a spare room, marriage place or House. Listing your place is totally free. </h4> 
 </div>  
</div><!--row close-->
</div><!--container close-->

</div><!--banner-upper close-->
</div><!--banner-bg close-->
<div class="container">
<div class="row">
<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
<div class="ishowload" style="display:none;top:50%;box-shadow:none;background-color:transparent;border:none;">
      <img class="showimg1" src="img/loading.gif" style="margin:0 auto;display:block;width:53px;">
</div>
<!-- details start -->
<div class="tellus-data" id="details">
<div class="had-frm">Your Details</div>
<form class="pd-bottom20" role="form" id="add_place" method="POST">
<div class="frm-field-mar">
  <input type="hidden" class="placeid" name="placeid" value="" id="placeid">


  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Name*</label>
    <input type="text" class="form-control" id="price" placeholder="Name" name="name" required>
  </div>
  
   <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Contact Number*</label>
    <input type="text" class="form-control phone" id="price" placeholder="Contact" name="contact" required>
  </div>
  
     <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Postal Code*</label>
    <input type="text" class="form-control" id="price" placeholder="Contact" name="postal" required>
  </div>
  
  
     <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Location*</label>
    <input type="text" class="form-control" id="price" placeholder="Location" name="location" required>
  </div>
  
  
  </div><!--frm-field-mar-->
  <!--=======================================-->
   <div class="clearfix"></div>
  
  
  
    <div class="had-frm-sec">Your Place Location...</div>
  <div class="frm-field-mar ">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-lr-0">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Address*</label>
	    <div id="locationField" class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pd-lr-0">
      <input class="form-control" id="autocomplete" name="address" placeholder="Enter your address" onFocus="geolocate()" type="text" required>
    </div>
  </div>
  
    
    <div id="address" class="col-lg-6 col-sm-6 col-md-6 col-xs-6 mg-top20" style="display:none;">

        <input class="field form-control" id="street_number" name="street" disabled="true" >
            </div>
             <div id="address" class="col-lg-6 col-sm-6 col-md-6 col-xs-6 mg-top20" style="display:none;">
                <input class="field form-control" id="route" disabled="true">
            </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
     <label class="label newst">City</label>
        <input class="field form-control mg-top5" id="locality" disabled="true" name="city" >
      </div>
	  </div>
	  <div class="clearfix"></div>
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-lr-0 mg-top15">
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <label class="label newst">State</label>
         <input class="field form-control mg-top5" id="administrative_area_level_1" disabled="true" name="state">
      </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 pd-bottom20">
        <label class="label newst">Zip code</label> 
        <input class="field form-control mg-top5" name="postcode" id="postal_code" disabled="true">
      </div>
	  </div>
	  <div class="clearfix"></div>
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-lr-0 ">
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 pd-bottom20">
        <label class="label newst">Country</label> 
        <input class="field form-control mg-top5" name="country" id="country" disabled="true">
      </div>
	  </div>
    </div>



  <!--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="address"> 

  <label for="space">City *</label>

  </div>
  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Postcode *</label>
    <!-- <input type="text" class="form-control" id="price" placeholder="Postcode" name="postcode" >
   
  </div>
  
  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">State/region *</label>
    <!-- <input type="text" class="form-control" id="price" placeholder="State/region" name="state" > -->
   


  
  <div class="clearfix"></div>
  <!--frm-field-mar-->
  <!--=====================================-->
  
  
  
  
  
     <div class="had-frm-sec">Your Place Details</div>
	 
	  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="space">Space Title*</label>
    <input type="text" class="form-control" id="price" placeholder="Space title" name="space_name" required>
  </div>
  
<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="email">Property type*</label>
    <select class="form-control" id="sel1" name="property"required >
      <option value="">Select Property type</option>
    <?php $query=mysqli_query($connect,'Select * from property');
while($match=mysqli_fetch_array($query)){?>
    <option value="<?php echo $match['pid'];?>"><?php echo $match['ptype'];?></option>
<?php }//while ?>
  </select>
  </div>
  

<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Capacity*</label>
    <input type="number" class="form-control" name="capacity"required>
  </div>

  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12"required>
    <label for="space">Accomodates*</label>
    <input type="text" class="form-control" id="accomodates" placeholder="Accomodates" name="accomodates" required>
  </div>
  
  
  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 sample-only">
    <label class="wid100" for="space">Can be used for*</label>
<select id="select1" class="wid100" multiple="multiple" name="canbe[]">
     <!--  <option value="" hidden>Select Uses</option> -->
    <?php $query=mysqli_query($connect,'Select * from usedfor');
while($match=mysqli_fetch_array($query)){?>
    <option value="<?php echo $match['ufid'];?>"><?php echo $match['ufname'];?></option>
<?php }//while ?>
</select>	
  </div>
  
  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="col-md-12 col-sm-12 col-xs-12 pd-lr-0">  <label for="space">Area*</label></div>
 <div class="col-md-6 pd-l-0">   
<input type="text" class="form-control" id="accomodates" placeholder="Area" name="area" required="">
  </div>
   <div class="col-md-6 pd-r-0">
<select class="form-control" name="areatype"><option>Select Area Type*</option>
 <?php $query=mysqli_query($connect,'Select * from area');
while($match=mysqli_fetch_array($query)){?>
<option value="<?php echo $match['areaid'];?>"><?php echo $match['areatype'];?></option>
<?php } ?>
</select>
  </div>
</div>
  
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Common Ammenties*</label>
     <?php $query=mysqli_query($connect,'Select * from ammenities where atype="common"');
while($match=mysqli_fetch_array($query)){?>
    <div class="col-md-12">
<input type="checkbox" name="commonammenties[]"  value="<?php echo $match['aid'];?>">&nbsp;<?php echo $match['aname'];?>
  </div>
<?php }?>
  </div>
  
  
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Additional Ammenties*</label>
         <?php $query=mysqli_query($connect,'Select * from ammenities where atype="additional"');
while($match=mysqli_fetch_array($query)){?>
    <div class="col-md-12">
<input type="checkbox" name="add_ammenties[]"  value="<?php echo $match['aid'];?>">&nbsp;<?php echo $match['aname'];?>
  </div>
<?php }?>
  </div>
  
  
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="space">Description*</label>
    <textarea  class="form-control" id="accomodates" required placeholder="Description" name="details" ></textarea>
  </div>
  

  <div class="clearfix"></div>

  
  <!-- <div class="had-frm-sec">Photos & Videos...</div>
  <div class="frm-field-mar">
  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Upload great photos & Videos of your place *</b></div>
  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> <label class="custom-upload">
  <input type="file" name="upload_file[]" multiple />ADD PHOTOS</label> </div>
  
   <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> <label class="custom-upload">
   <input type="file" name="upload_video[]" multiple />ADD Videos</label> </div>
  <div class="clearfix"></div>
  </div> --><!--frm-field-mar-->
  <!--=====================================-->
  
  
  
  
  
    <div class="had-frm-sec">Rules</div>
  <div class="frm-field-mar">
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Do's</label>
    <select class="form-control" id="select3" name="ruledo[]" multiple >
	<!-- <option>Select Options</option> -->
   <?php $query=mysqli_query($connect,'Select * from rules where rtype="do"');
while($match=mysqli_fetch_array($query)){?>
    <option value="<?php echo $match['rid'];?>"><?php echo $match['rname'];?></option>
    <?php } ?>
  </select>
  </div>
  
        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Don'ts</label>
    <select class="form-control" id="select4" name="ruledonot[]" multiple>
	<!-- <option>Select Options</option> -->
   <?php $query=mysqli_query($connect,'Select * from rules where rtype="dont"');
while($match=mysqli_fetch_array($query)){?>
    <option value="<?php echo $match['rid'];?>"><?php echo $match['rname'];?></option>
    <?php } ?>
  </select>
  </div>
  <div class="clearfix"></div>
  </div><!--frm-field-mar-->
  <!--=====================================-->
  

  
  
  
      <div class="had-frm-sec">Safety</div>
  <div class="frm-field-mar">
        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 sample-only">
    <label class="wid100" for="space">Safety Checklist</label>
<select id="select2" class="wid100" multiple="multiple" name="safety[]">
   <?php $query=mysqli_query($connect,'Select * from safety');
while($match=mysqli_fetch_array($query)){?>
    <option value="<?php echo $match['sid'];?>"><?php echo $match['sname'];?></option>
    <?php } ?>
</select> 
  </div>
  
  <div class="col-md-12">
  <h4>Safety Card</h4>
	<p>Where is safety card located?</p>
  </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Fire Exitinguisher</label>
	 <input type="text" class="form-control" id="accomodates" placeholder="Enter Location" name="fire_extinguisher">

  </div>
  
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Fire Alarm</label>
	 <input type="text" class="form-control" id="accomodates" placeholder="Enter Location" name="fire_alaram">

  </div>
  
  
         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Gas Shutoff valve</label>
	 <input type="text" class="form-control" id="accomodates" placeholder="Enter Location" name="gas_valve">

  </div>
  
  
           <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="space">Emergency exit instruction</label>
	 <textarea class="form-control" id="accomodates" placeholder="Enter Instructions" name="emergency"></textarea>

  </div>
  <div class="clearfix"></div>
  </div><!--frm-field-mar-->
  <!--=====================================-->
  

  
  <div class="but-align form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <!-- <button id="show-photo" type="submit" name="place" class="btn btn-default cus-save-but">Save & continue</button> -->
  <button type="submit" name="place" class="btn btn-default cus-save-but">Save & continue</button>
  </div>
</form>
<div class="clearfix"></div>
</div>
<!-- details end -->


 
  <!--==========================Photos AND Videos TAB STARTS=======================-->
 <form id="photovideo" method="post" enctype="multipart/form-data" style="">

  <input type="hidden" class="placeid" name="placeid" value="" id="placeid">
  <div class="frm-field-mar" id="hide-photo" >
    <div class="tellus-data col-md-12 col-xs-12 col-sm-12 pd-lr-0">
   <div class="had-frm-sec"  >Photos & Videos</div>
  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Upload great photos & Videos of your place *</b></div>
   <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >     
<label class="custom-upload uploadphoto">ADD PHOTOS</label>
<div class="upphoto" style="display:none;">
   <input id="input-7" name="inputphotos[]" data-show-upload="false" multiple type="file" class="file file-loading" >
    <p style="font-size: 12px"> Please Upload Photos of (jpg/jpeg/png/gif) Formats with min size 700*500</p>
</div>
</div>
   <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> <label class="custom-upload uploadvideo">
  ADD Videos</label> </div>
 <div class="upvideo" style="display:none;">
   <input id="input-8" name="inputvideos[]" data-show-upload="false" multiple type="file" class="file file-loading">
   <p style="font-size: 12px"> Please Upload Videos of (webm/mp4) Formats with max size upto 10 MB</p>
</div>

   <div class="col-md-12 text-center p-x-2" style="margin-bottom: 11px;">
<button id="back" type="button" name="place" class="btn btn-default cus-save-but">Back</button>
  <button id="show-price" type="submit" name="photo" class="btn btn-default cus-save-but">Save & Continue</button>
  </div>

  <div class="clearfix"></div>
   </div>
  </div> <!--frm-field-mar-->
  </form>
  <!--=====================================-->
  



  <!--============================Photos AND Videos TAB CLOSE============================-->



  
  <!--==========================PRICE AND TERMS TAB STARTS=======================-->
  <form id="pricetermss" method="post" enctype="multipart/form-data" >
   
  <div class="tellus-data" id="hide-price" style="overflow: auto;">
      <div class="had-frm-sec" >Price & Terms</div>

  <div class="frm-field-mar">
    <?php include_once('demo.php');?>
    <input type="hidden" class="placeid" name="placeid" value="" id="placeid">
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Select Your Currency</label>
    <input type="text" required name="currency" value="<?php echo $_SESSION['currencySymbol'];?>" class="form-control">
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
   <input type="number" required class="form-control" id="accomodates" placeholder="Enter price" name="p_p_n">
  </div>
  
        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <label for="space">Price Per Hour</label>
   <input type="number" required class="form-control" id="accomodates" placeholder="Enter price" name="p_p_h">
  </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <label for="space">Weekend Price Per Night</label>
   <input type="number" required class="form-control" id="accomodates" placeholder="Enter price" name="w_p_p_n">
  </div>

  
  
<!--         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Weekly Discount</label>
    <input class="form-control"  type="text" name="w_discount" value="">
  </div>
  
  
  
        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Monthly Discount</label>
    <input class="form-control"  type="text" name="m_discount" value="">
  </div>
  -->
  <div class="col-md-12 text-center"style="margin-bottom: 11px;">
<button id="back1" type="button" name="place" class="btn btn-default cus-save-but">Back</button>
  <button id="next2" type="submit" name="priceterms" class="btn btn-default cus-save-but">Save & continue</button>
  </div>
  
 
    

 
  </div><!--frm-field-mar-->
  
  </div>
   </form> 
   
  <div class="clearfix"></div>
  <!--=====================================-->
  



  <!--============================Price AND TERMS TAB CLOSE============================-->



  <!--==========================Calendar TAB STARTS=======================-->
  <?php
if(isset($_REQUEST['oplaceid'])){
  $placeid=$_REQUEST['oplaceid'];
  if($_REQUEST['amd']=="success"){
  ?>
<script>
  $(document).ready(function(){    
      swal({   title: "Success",   text: "Your details are added Successfully",   timer: 2000,   showConfirmButton: false });

   });
  </script>
  <?php }//if
  else{ ?>
<script>
  $(document).ready(function(){    
    swal({   title: "Oops!",   text: "Unable To add Your Details",   timer: 2000,   showConfirmButton: false });
   });
  </script>
  <?php }//else ?>
 <script> 
 $(document).ready(function(){
  $("#pricetermss").css('display','none');
  $("#calender-tab").css('display','block');
  $("#photovideo").css('display','none');
  $("#details").css('display','none');
  });
</script>
 <div id="calender-tab" style="display:none;">
  
<?php $query2=mysqli_query($connect,'SELECT * FROM calenderdata where placeid="'.$_SESSION['placeids'].'"');
while ($row2=mysqli_fetch_array($query2)) {
  $plabels .= $row2['label'].",";
  $pstatus .= $row2['status'].",";
  $pdate1 .= $row2['date1'].",";
  $pdate2 .= $row2['date2'].",";
  $ptime1 .= $row2['time1'].",";
  $ptime2 .= $row2['time2'].",";

  $plabels=rtrim($plabels,",");
  $pstatus=rtrim($pstatus,",");
  $pdate1=rtrim($pdate1,",");
  $pdate2=rtrim($pdate2,",");
  $ptime1=rtrim($ptime1,",");
  $ptime2=rtrim($ptime2,",");

  echo '<div id="plabels" style="display:none;">'.$plabels.'</div>';
  echo '<div id="pstatus" style="display:none;">'.$pstatus.'</div>';
  echo '<div id="pdate1" style="display:none;">'.$date1.'</div>';
  echo '<div id="pdate2" style="display:none;">'.$pdate2.'</div>';
  echo '<div id="ptime1" style="display:none;">'.$time1.'</div>';
  echo '<div id="ptime2" style="display:none;">'.$time2.'</div>';
  }//while?>

<form id="calenderform" method="post" enctype="multipart/form-data" >
  <input type="hidden" class="placeid" name="placeid" value="" id="placeid">    
  <div class="tellus-data col-lg-12 col-sm-12 col-md-12 col-xs-12 pd-lr-0" ><!--id="calendar-tab"-->
      <div class="had-frm-sec" >Seasonal & Advanced Scheduling</div>

  <div class="frm-field-mar">
<?php 
$save="";
$query1=mysqli_query($connect,'SELECT * FROM place where place_id="'.$_SESSION['placeids'].'"');
if ($row1=mysqli_fetch_array($query1)) {
  if(!empty($row1['p_p_n'])){$ppn=$row1['p_p_n'];$save .="1,";}else{$save .="0,";}
  if(!empty($row1['p_p_h'])){$ppn=$row1['p_p_h'];$save .="1,";}else{$save .="0,";}
  if(!empty($row1['w_p_p_n'])){$ppn=$row1['w_p_p_n'];$save .="1";}else{$save .="0";}
  echo "<input type='hidden' name='save' id='save' value=".$save.">";
}
?>

        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div id="calendar"></div>
  </div>
  
  <div class="col-md-12 text-center">
<button id="back2" type="button" name="place" class="btn btn-default cus-save-but">Back</button>
<!--   <button id="next3" type="submit" name="priceterms" class="btn btn-default cus-save-but">Save</button>
 -->  </div>
  
  
    
  <div class="clearfix"></div>
 
  </div><!--frm-field-mar-->
  
 </div>
  </form>
</div>
  <?php
}//if isset
else{
echo '<div id="calender-tab" style="display:none;">
    
  </div>';
}//else?>

  
  </div>
  <!--=====================================COL-MD-8 LEFT side CLOSE==========================================-->




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
</div>

  <!--=====================================-->
 <!--==========WHY LIST YOUR PLACE CLOSE============-->  
 

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
