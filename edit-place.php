<?php session_start();
include('connect.php');?>
<!doctype html>
<html>
<head>

  <title>Edit Place</title>
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
 <h1> Edit a place</h1>
<h4>Earn money renting out a spare room, marriage place or House. Listing your place is totally free. </h4> 
 </div>  
</div><!--row close-->
</div><!--container close-->

</div><!--banner-upper close-->
</div><!--banner-bg close-->
<div class="container">
<div class="row">
<?php  $pid=$_REQUEST['placeid'];
 $query=mysqli_query($connect,'SELECT * FROM `place`,users where place_id="'.$pid.'" and uid=user_id');
                                $row=mysqli_fetch_array($query);
?>
<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
<div class="ishowload" style="display:none;top:50%;box-shadow:none;background-color:transparent;border:none;">
      <img class="showimg1" src="img/loading.gif" style="margin:0 auto;display:block;width:53px;">
</div>
<!-- details start -->
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Details</a></li>
    <li><a data-toggle="tab" href="#menu12">Photos & Videos</a></li>
    <li><a data-toggle="tab" href="#menu13">Prices</a></li>
    <li><a data-toggle="tab" href="#menu14">Special Prices</a></li>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="tellus-data col-md-12 col-xs-12 col-sm-12 pd-lr-0" id="edetails">
<div class="had-frm">Your Details</div>
<form class="pd-bottom20" role="form" id="edit_place" method="POST">
<div class="frm-field-mar">
  <input type="hidden" class="placeid" name="placeid" value="<?php echo $row['place_id'];?>" id="placeid">


  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Name</label>
    <input type="text" class="form-control" id="price" placeholder="Name" name="name" value="<?php echo $row['p_name'];?>" required>
  </div>
  
   <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Contact Number</label>
    <input type="text" class="form-control phone" id="price" placeholder="Contact" value="<?php echo $row['p_contact'];?>" name="contact" required>
  </div>
  
     <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Postal Code</label>
    <input type="text" class="form-control" id="price" placeholder="Contact" value="<?php echo $row['postal_code'];?>" name="postal" required>
  </div>
  
  
     <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Location</label>
    <input type="text" class="form-control" id="price" placeholder="Location" value="<?php echo $row['p_location'];?>" name="location" required>
  </div>
  
  
  </div><!--frm-field-mar-->
  <!--=======================================-->
   <div class="clearfix"></div>
  
  
  
    <div class="had-frm-sec">Your Place Location...</div>
  <div class="frm-field-mar ">
  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Address *</label>
  </div>
  
        <div id="locationField" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
      <input class="form-control" id="autocomplete" name="address" value="<?php echo $row['p_address'] ;?>" placeholder="Enter your address" onFocus="geolocate()" type="text" required>
    </div>
    <div id="address" class="col-lg-6 col-sm-6 col-md-6 col-xs-6 mg-top20" style="display:none;">

        <input class="field form-control" id="street_number" value="" name="street" disabled="true" >
            </div>
             <div id="address" class="col-lg-6 col-sm-6 col-md-6 col-xs-6 mg-top20" style="display:none;">
                <input class="field form-control" id="route" value="" readonly>
            </div>

      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
     <label class="label">City</label>
        <input class="field form-control" id="locality" value="<?php echo $row['p_city'];?>" readonly name="city" >
      </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
        <label class="label">State</label>
         <input class="field form-control" id="administrative_area_level_1" value="<?php echo $row['p_state'];?>" readonly name="state">
      </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 pd-bottom20">
        <label class="label">Zip code</label> 
        <input class="field form-control" name="postcode" id="postal_code" value="<?php echo $row['p_code'];?>" readonly>
      </div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 pd-bottom20">
        <label class="label">Country</label> 
        <input class="field form-control" name="country" id="country" value="<?php echo $row['p_country'];?>" readonly>
      </div>
    </div>


  <div class="clearfix"></div>
  <!--frm-field-mar-->
  <!--=====================================-->
  
  
  
  
  
     <div class="had-frm-sec">Your Place Details</div>
   
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="space">Space Title *</label>
    <input type="text" class="form-control" id="price" placeholder="Space title" value="<?php echo $row['p_country'];?>" name="space_name" required>
  </div>
  
<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="email">Property type *</label>
    <select class="form-control" id="sel1" name="property" required >
      <option value="">Select Property type</option>
    <?php 
    $query=mysqli_query($connect,'Select * from property');
while($match=mysqli_fetch_array($query)){
  if($row['property_typeid']==$match['pid']){?>
    <option value="<?php echo $match['pid'];?>" selected><?php echo $match['ptype'];?></option>
<?php }
else{ ?>
  <option value="<?php echo $match['pid'];?>" selected><?php echo $match['ptype'];?></option>
  <?php } }//while ?>
  </select>
  </div>
  

<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Capacity</label>
    <input type="number" class="form-control" name="capacity" value="<?php echo $row['capacity'];?>" required>
  </div>

  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
    <label for="space">Accomodates *</label>
    <input type="text" class="form-control" id="accomodates" placeholder="Accomodates" value="<?php echo $row['p_country'];?>" name="accomodates" required>
  </div>
  
  
  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 sample-only">
    <label class="wid100" for="space">Can be used for *</label>
<select id="select1" class="wid100" multiple="multiple" name="canbe[]" required>
      <option value="" >Select Events</option>
    <?php 
    $events=explode(",",$row['can_be_usedid']);
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
  
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div class="col-md-12">  <label for="space">Area*</label></div>
 <div class="col-md-6">   
<input type="text" class="form-control" id="accomodates" placeholder="Area" name="area" value="<?php echo $row['place_area'];?>" required="">
  </div>
   <div class="col-md-6">
<select class="form-control" name="areatype"><option>Select Area Type*</option>
 <?php $query=mysqli_query($connect,'Select * from area');
while($match=mysqli_fetch_array($query)){
      //echo "<<<<<".$match['areaid']."<br> >>>>>>".$row['areatype'];
  if($match['areaid']==$row['areatype']){
?>
<option value="<?php echo $match['areaid'];?>" selected><?php echo $match['areatype'];?></option>
<?php } else{?>
<option value="<?php echo $match['areaid'];?>"><?php echo $match['areatype'];?></option>
<?php }}?>
</select>
  </div>
</div> 
  
  
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Common Ammenities *</label>
     <?php 
    $caid=explode(",",$row['ammenties_id']);

    $query=mysqli_query($connect,'Select * from ammenities where atype="common"');
while($match=mysqli_fetch_array($query)){
  if(in_array($match['aid'], $caid)){?>
    <div class="col-md-12">
<input type="checkbox" name="commonammenties[]"  value="<?php echo $match['aid'];?>" checked>&nbsp;<?php echo $match['aname'];?>
  </div>
<?php }else{
  ?>
<div class="col-md-12">
<input type="checkbox" name="commonammenties[]"  value="<?php echo $match['aid'];?>">&nbsp;<?php echo $match['aname'];?>
  </div>
  <?php } }//while?>
  </div>
  
  
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Additional Ammenities *</label>
         <?php 
          $aid=explode(",",$row['add_ammenties']);
          $query1=mysqli_query($connect,'SELECT * FROM `ammenities` where atype="additional" ');
                                      while($match=mysqli_fetch_array($query1)){
                                      if(in_array($match['aid'], $aid)){
         ?>
    <div class="col-md-12">
<input type="checkbox" name="add_ammenties[]" value="<?php echo $match['aid'];?>" checked>&nbsp;<?php echo $match['aname'];?>
  </div>
<?php  }else{
  ?>
<div class="col-md-12">
<input type="checkbox" name="add_ammenties[]"  value="<?php echo $match['aid'];?>" >&nbsp;<?php echo $match['aname'];?>
  </div>
  <?php } }//while?>?>
  </div>
  
  
      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="space">Description *</label>
    <textarea  class="form-control" id="accomodates" required placeholder="Description" name="details" ><?php echo $row['details'];?></textarea>
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
   <select class="form-control" id="select3" name="ruledo[]" multiple>
      <option>Select Rules</option>
     <?php 
    $dorule=explode(",",$row['rules_doid']);
 $query=mysqli_query($connect,'Select * from rules where rtype="do"');
while($match=mysqli_fetch_array($query)){
  if(in_array($match['rid'], $dorule)){?>
    <option value="<?php echo $match['rid'];?>" selected><?php echo $match['rname'];?></option>
    <?php } 
    else{?>
    <option value="<?php echo $match['rid'];?>"><?php echo $match['rname'];?></option>
    <?php } }?>
  </select>
  </div>
  
        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Don'ts</label>
   <select class="form-control" id="select4" name="ruledonot[]" multiple>
       <option>Select Rules</option>
     <?php 
    $dontrule=explode(",",$row['rules_donotid']);
 $query=mysqli_query($connect,'Select * from rules where rtype="dont"');
while($match=mysqli_fetch_array($query)){
  if(in_array($match['rid'], $dontrule)){?>
    <option value="<?php echo $match['rid'];?>" selected><?php echo $match['rname'];?></option>
    <?php } 
    else{?>
    <option value="<?php echo $match['rid'];?>"><?php echo $match['rname'];?></option>
    <?php } } ?>
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
<option value="">Select Safety Options</option>
   <?php 
    $safety=explode(",",$row['saftyid']);
    $query=mysqli_query($connect,'Select * from safety');
while($match=mysqli_fetch_array($query)){
  if(in_array($match['sid'], $safety)){?>
  ?>
    <option value="<?php echo $match['sid'];?>" selected><?php echo $match['sname'];?></option>
    <?php } 
    else{?>
    <option value="<?php echo $match['sid'];?>"><?php echo $match['sname'];?></option>
    <?php } }?>
</select> 
  </div>
  
  <div class="col-md-12">
  <h4>Safety Card</h4>
  <p>Where is safety card located?</p>
  </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Fire Exitinguisher</label>
   <input type="text" class="form-control" id="accomodates" value="<?php echo $row['fire_extinguisher'];?>" placeholder="Enter Location" name="fire_extinguisher">

  </div>
  
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Fire Alarm</label>
   <input type="text" class="form-control" id="accomodates" value="<?php echo $row['fire_alarm'];?>" placeholder="Enter Location" name="fire_alaram">

  </div>
  
  
         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Gas Shutoff valve</label>
   <input type="text" class="form-control" id="accomodates" value="<?php echo $row['gas_valve'];?>" placeholder="Enter Location" name="gas_valve">

  </div>
  
  
           <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <label for="space">Emergency exit instruction</label>
   <textarea class="form-control" id="accomodates"  placeholder="Enter Instructions" name="emergency"><?php echo $row['exit_extinguisher'];?></textarea>

  </div>
  <div class="clearfix"></div>
  </div><!--frm-field-mar-->
  <!--=====================================-->
  

  
  <div class="but-align form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <!-- <button id="show-photo" type="submit" name="place" class="btn btn-default cus-save-but">Save & continue</button> -->
  <button type="submit" name="eplace" class="btn btn-default cus-save-but">Save & continue</button>
  </div>
</form>
<div class="clearfix"></div>
</div>
<!-- details end -->
    </div>
    <div id="menu12" class="tab-pane fade">
  <!--==========================Photos AND Videos TAB STARTS=======================-->
 <form id="ephotovideo" method="post" enctype="multipart/form-data" style="">

  <div class="" id="hide-photo" >
    <div class="tellus-data col-md-12 col-sm-12 col-xs-12 pd-lr-0">
   <div class="had-frm-sec"  >Photos & Videos</div>
  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Upload great photos & Videos of your place *</b></div>
  <div class="mphotos col-md-9" style="">
                       <input type="hidden" name="pg" id="pg" value="<?php echo $row['photo'];?>">
 
    <?php  
    if(!empty($row['photo'])){
$photo=explode(",",$row['photo']);
$query=mysqli_query($connect,'Select * from place where place_id="'.$pid.'"');
if($match=mysqli_fetch_array($query)){
  for ($k=0; $k < count($photo); $k++) { 
     if($photo[$k]=="")
  {
    continue;
  } 
    echo '<div style="width: 60%;"><img src="images/placephotos/'.$photo[$k].'" class="img-responsive mimages">';
    echo '<i class="fa fa-trash-o cross-hover" data-pid="'.$k.'"></i></div>';
 }//for
  }
  }?>
  </div>
  <input type="hidden" name="placeid1" value="<?php echo $pid; ?>" id="placeid1">

   <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >     
<label class="custom-upload uploadphoto">ADD PHOTOS</label>
<div class="upphoto" style="display:none;">
   <input id="input-7" name="inputphotos[]" data-show-upload="false" multiple type="file" class="file file-loading" >
    <p style="font-size: 12px"> Please Upload Photos of (jpg/jpeg/png/gif) Formats with min size 700*500</p>
</div>
</div>

   <div class="mvideos col-md-9" style="">
                       <input type="hidden" name="pg1" id="pg1" value="<?php echo $row['video'];?>">
                       <input type="hidden" name="pg2" id="pg2" value="<?php echo $row['video_type'];?>">
 
    <?php  
    if(!empty($row['video'])){
$video=explode(",",$row['video']);
$query=mysqli_query($connect,'Select * from place where place_id="'.$pid.'"');
if($match=mysqli_fetch_array($query)){
  for ($k=0; $k < count($video); $k++) {
  if($video[$k]=="")
  {
    continue;
  } 
    echo '<div style="width: 60%;">
    <video autobuffer autoloop loop controls height="200px" width="200px">
    <source src="video/'.$video[$k].'">
  </video>';
    echo '<i class="fa fa-trash-o vcross-hover" data-pid1="'.$k.'"></i></div>';
 }//for
  }
  }?>
  </div>
        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> <label class="custom-upload uploadvideo">
  ADD Videos</label> </div>                 

 <div class="upvideo form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none;">
   <input id="input-8" name="inputvideos[]" data-show-upload="false" multiple type="file" class="file file-loading">
   <p style="font-size: 12px"> Please Upload Videos of (webm/mp4) Formats with max size upto 10 MB</p>
</div>

   <div class="col-md-12 text-center form-group">

  <button id="show-price" type="submit" name="qephoto" class="btn btn-default cus-save-but">Save & Continue</button>
  </div>

  <div class="clearfix"></div>
   </div>
  </div> <!--frm-field-mar-->
  </form>
  <!--=====================================-->
    </div>
    <div id="menu13" class="tab-pane fade">
<!--==========================PRICE AND TERMS TAB STARTS=======================-->
  <form id="epricetermss" method="post" enctype="multipart/form-data" >
   
  <div class="tellus-data" id="hide-price" style="overflow: auto;">
      <div class="had-frm-sec" >Price & Terms</div>

  <div class="frm-field-mar">
    <?php include_once('demo.php');?>
    <input type="hidden"  name="placeid" value="<?php echo $pid; ?>">
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Select Your Currency</label>
    <input type="text" required name="currency" value="<?php echo $row['currency'];?>" class="form-control">
  </div>

      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Price Per Night</label>
   <input type="text" required class="form-control" id="accomodates" value="<?php echo $row['p_p_n'];?>" placeholder="Enter price" name="p_p_n">
  </div>
  
        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <label for="space">Price Per Hour</label>
   <input type="text" required class="form-control" id="accomodates" value="<?php echo $row['p_p_h'];?>" placeholder="Enter price" name="p_p_h">
  </div>
          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <label for="space">Weekend Price Per Night</label>
   <input type="text" required class="form-control" id="accomodates" value="<?php echo $row['w_p_p_n'];?>" placeholder="Enter price" name="w_p_p_n">
  </div>

  <div class="col-md-12 text-center form-group">

  <button id="next2" type="submit" name="qeprice_place" class="btn btn-default cus-save-but">Save & continue</button>
  </div>
  
 
    

 
  </div><!--frm-field-mar-->
  
  </div>

   </form>
    </div>
    <div id="menu14" class="tab-pane fade">
          <div class="" id="hide-photo" >
 
   
    <div class="col-md-12 tellus-data for_claender_data" style="border-bottom: 0px solid rgb(252, 139, 17);border-left: 2px solid rgb(252, 139, 17);border-right: 2px solid rgb(252, 139, 17);">
      <?php  $sql9 = mysqli_query($connect,"SELECT * FROM calenderdata WHERE placeid='".$pid."'");
      if(mysqli_num_rows($sql9)>0)
      { 
        ?>
        <div class="row" style="background: rgb(252, 139, 17);
    padding: 13px 0px;
    color: white;
    font-weight: bolder;
    font-size: 19px;">
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
    border-bottom: 2px solid rgb(252, 139, 17);">
            <div class="col-md-3 text-center"><?php echo $row9['date1'] ?></div>
            <div class="col-md-3 text-center"><?php echo $row9['date2'] ?></div>
            <?php if(($row9['p_p_n']=="")&&($row9['p_p_h']=="")&&($row9['w_p_p_n']==""))
            {
              ?>
<div class="col-md-3 text-center">Not Available</div>
<?php
            }
              else
              {

               ?>
            <div class="col-md-1 text-center"><input class="he<?php echo $he; ?>" style="width: 59px;" type="text" name="p_p_n" value="<?php echo $row9['p_p_n'] ?>"></div>
            <div class="col-md-1 text-center"><input class="he<?php echo $he; ?>" style="width: 59px;" type="text" name="p_p_h" value="<?php echo $row9['p_p_h'] ?>"></div>
            <div class="col-md-1 text-center"><input class="he<?php echo $he; ?>" style="width: 59px;" type="text" name="w_p_p_n" value="<?php echo $row9['w_p_p_n'] ?>"></div>
            <?php } ?>
            <div class="col-md-3 text-center"><button name="calender_price_update"id="he<?php echo$he; ?>" class="btn btn-success onclcick_submit_price " value="<?php echo $row9['calid']; ?>"><i class="fa fa-pencil"></i></button>
            <button name="calender_price_update"id="the<?php echo $row9['calid']; ?>" class="btn btn-danger onclcick_delete_price " value="<?php echo $row9['calid']; ?>"><i class="fa fa-trash"></i></button></div>
            </div>
          <?php
          $he++;
          }
          ?>
               <div class="row"style="padding: 11px 0px 1px 0px;
    border-bottom: 2px solid rgb(252, 139, 17);">
          <div class="col-md-12 form-group">
            <button id="add_cal_price" class="btn-success btn">Add</button>
            <a href="dashboard.php" class="btn-warning btn">My DashBoard</a>
            <a href="edit-place.php?placeid=17" class="btn-info btn">Update Details</a>
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
        </div> 
        <div class="col-md-12" id="cal_data_cl" style="display: none;padding: 11px 0px 1px 0px; border-bottom: 2px solid rgb(252, 139, 17);">
    <?php include_once('calender.php'); ?>
  </div>
    </div>
    </div>



 
  



  <!--============================Photos AND Videos TAB CLOSE============================-->



  
  


  <div class="clearfix"></div>
  <!--=====================================-->
  
  </div>



<!--==========WHY LIST YOUR PLACE?============-->
 <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
<div class="tellus-data col-md-12 col-xs-12 col-sm-12 pd-lr-0">
<div class="had-frm">Why list your place?</div>
<div class="safe-lst">
 <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
 <img class="img-responsive" src="img/save.png">
 </div>
 <div class="col-lg-10 col-sm-10 col-md-10 col-xs10">
 <style>
p {
  font-size: 13px !important;
}
  

 </style>
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
 
<!-- <?php
 // include 'lib/footer.php'; //if isset 

  ?> -->
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
<!--     <script src="js/jquery.min.js"></script> -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

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