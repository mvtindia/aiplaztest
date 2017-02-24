<?php session_start();
include('connect.php');
if(!isset($_SESSION['u_id'])) {
  header( 'Location: http://' . $_SERVER['SERVER_NAME'] ) ;
}
$fees = mysqli_query($connect,"select * from fees where feefor='s'");
$feeres = mysqli_fetch_array($fees);
$sfee = $feeres['percentage'] * .01;
?> 

<!doctype html>
<html>
<head>

  <title>Edit Place</title>
  <?php include 'lib/top.php';?>
  <style>
    .bootstrap-datetimepicker-widget {
        font-size: 10px;
	    width: 200px;
    }
  </style>
  
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
              <h4></h4> 
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
          <li><a data-toggle="tab" href="#menu15">Documents</a></li>
          <!--<li><a data-toggle="tab" href="#menu13">Prices</a></li>-->
          <li><a data-toggle="tab" href="#menu14">Scheduling and Prices</a></li>
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
                <!--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label for="space">Postal Code</label>
                  <input type="text" class="form-control" id="price" placeholder="Contact" value="<?php //echo $row['postal_code'];?>" name="postal" required>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label for="space">Location</label>
                  <input type="text" class="form-control" id="price" placeholder="Location" value="<?php //echo $row['p_location'];?>" name="location" required>
                </div>-->
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
                  <input type="text" class="form-control" id="price" placeholder="Space title" value="<?php echo $row['space_name'];?>" name="space_name" required>
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
                    <?php } else { ?>
                          <option value="<?php echo $match['pid'];?>"><?php echo $match['ptype'];?></option>
                    <?php } }//while ?>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label for="space">Capacity</label>
                  <input type="number" class="form-control" name="capacity" value="<?php echo $row['capacity'];?>" required>
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
                    <?php } else {?>
                          <option value="<?php echo $match['ufid'];?>"><?php echo $match['ufname'];?></option>
                    <?php }}//while ?>
                  </select> 
                </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="col-md-12">  
                  <label for="space">Area*</label>
                </div>
                <div class="col-md-6">   
                  <input type="text" class="form-control" id="accomodates" placeholder="Area" name="area" value="<?php echo $row['place_area'];?>" required="">
                </div>
                <div class="col-md-6">
                  <select class="form-control" name="areatype"><option value="">Select Area Type*</option>
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
                <select class="form-control" id="select6" name="commonamenities[]" multiple >
                <?php 
                  $caid=explode(",",$row['ammenties_id']);
                  $query=mysqli_query($connect,'Select * from ammenities where atype="common"');
                  while($match=mysqli_fetch_array($query)){
                    if(in_array($match['aid'], $caid)){?>
                      <div class="col-md-12 checkbox">
                            <label type="checkbox">
                              <option name="commonamenities[]" value="<?php echo $match['aid'];?>" selected><?php echo $match['aname'];?></option>
                            </label>
                        <!--<input type="checkbox" name="commonammenties[]"  value="<?php //echo $match['aid'];?>" checked>&nbsp;<?php echo $match['aname'];?>-->
                      </div>
                <?php }else{ ?>
                      <div class="col-md-12 checkbox">
                        <label type="checkbox">
                              <option name="commonamenities[]" value="<?php echo $match['aid'];?>"><?php echo $match['aname'];?></option>
                        </label>
                        <!--<input type="checkbox" name="commonammenties[]"  value="<?php //echo $match['aid'];?>">&nbsp;<?php echo $match['aname'];?>-->
                      </div>
                <?php } }//while?>
                </select>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label for="space">Additional Ammenities *</label>
                <select class="form-control" id="select5" name="add_ammenties[]" multiple >
                <?php 
                  $aid=explode(",",$row['add_ammenties']);
                  $query1=mysqli_query($connect,'SELECT * FROM `ammenities` where atype="additional" ');
                    while($match=mysqli_fetch_array($query1)){
                      if(in_array($match['aid'], $aid)){
                ?>  
                <div class="col-md-12">
                  <label type="checkbox">
                              <option name="add_ammenties[]" value="<?php echo $match['aid'];?>" selected><?php echo $match['aname'];?></option>
                  </label>
                </div>
                <?php } else {?>
                <div class="col-md-12">
                  <label type="checkbox">
                              <option name="add_ammenties[]" value="<?php echo $match['aid'];?>"><?php echo $match['aname'];?></option>
                  </label>
                </div>
                <?php } }//while?>
                </select>
              </div>
              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="space">Description *</label>
                <textarea  class="form-control" id="accomodates" placeholder="Description" name="details" ><?php echo $row['details'];?></textarea>
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
                        if(in_array($match['rid'], $dorule)) { ?>
                    <option value="<?php echo $match['rid'];?>" selected><?php echo $match['rname'];?></option>
                    <?php } else {?>
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
                    <?php } else {?>
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
                  <?php } else { ?>
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
 
  <button type="submit" name="eplace" class="btn btn-default cus-save-but">Save</button>
  <div id="msg"></div>
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
    <p style="font-size: 12px"> Please Upload Photos of (jpg/jpeg/png/gif) formats</p>
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
   
  <button id="show-price" type="submit" name="qephoto" class="btn btn-default cus-save-but">Save</button><br>
  <div id="msg2"></div>
  </div>

  <div class="clearfix"></div>
   </div>
  </div> <!--frm-field-mar-->
  </form>
  <!--=====================================-->
    </div>
    <div id="menu15" class="tab-pane fade">
  <!--==========================Photos AND Videos TAB STARTS=======================-->
 <form id="edoc" method="post" enctype="multipart/form-data" style="">

  <div class="" id="hide-photo" >
    <div class="tellus-data col-md-12 col-sm-12 col-xs-12 pd-lr-0">
   <div class="had-frm-sec"  >Documents</div>
  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Upload documents *</b></div>
  <div class="mphotos col-md-9" style="">
                       <input type="hidden" name="pg3" id="pg3" value="<?php echo $row['document'];?>">
 
    <?php  
    if(!empty($row['document'])){
      $doc=explode(",",$row['document']);
      $query=mysqli_query($connect,'Select * from place where place_id="'.$pid.'"');
      if($match=mysqli_fetch_array($query)){
        for ($k=0; $k < count($doc); $k++) { 
          if($doc[$k]=="")
          {
            continue;
          } 
          //echo '<div style="width: 60%;"><a href="doc/'.$doc[$k].'" class="img-responsive mimages">Document</a>';
          echo '<div style="width: 60%; display:inline;"><a href="doc/'.$doc[$k].'" target="newtab" class=""><i class="fa fa-paperclip cross-hover">'.$doc[$k].'</i></a>';
          echo ' <i class="fa fa-trash-o dcross-hover"  data-pid="'.$k.'"></i></div><div class="clearfix"></div>';
        }//for
  }
  }?>
  </div>
  <input type="hidden" name="placeid1" value="<?php echo $pid; ?>" id="placeid1">

   <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >     
<label class="custom-upload uploadphoto">ADD DOCUMENTS</label>
<div class="upphoto" style="display:none;">
   <input id="input-9" name="inputdocs[]" data-show-upload="false" multiple type="file" class="file file-loading" >
    <p style="font-size: 12px"> Please Upload Documents of (pdf/txt/doc/docx) formats</p>
</div>
</div>

   <div class="col-md-12 text-center form-group">

  <button id="show-price" type="submit" name="qephoto" class="btn btn-default cus-save-but">Save</button>
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
      <!--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Select Your Currency</label>
 <select class="form-control" id="sel1" name="currency" >
  <option value="">Select Options</option>
    <option value="1">$</option>
    <option value="4">₹</option>
  </select>  </div>-->
      
      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label for="space">Price Per Day</label>
   <input type="text" required class="form-control" id="accomodates" value="<?php echo "$" . $row['p_p_n'];?>" placeholder="Enter price" name="p_p_n">
  </div>
  
        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <label for="space">Price Per Hour</label>
   <input type="text" required class="form-control" id="accomodates" value="<?php echo "$" . $row['p_p_h'];?>" placeholder="Enter price" name="p_p_h">
  </div>
<!--
          <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <label for="space">Weekend Price Per Night</label>
   <input type="text" required class="form-control" id="accomodates" value="<?php echo $row['w_p_p_n'];?>" placeholder="Enter price" name="w_p_p_n">
  </div>
-->
<link href="tm/jquery.timepicker.css" rel="stylesheet">
  <div class="col-md-12 text-center form-group">

  <button id="next2" type="submit" name="qeprice_place" class="btn btn-default cus-save-but">Save</button>
  </div>
  
  </div><!--frm-field-mar-->
  
  </div>

   </form>
    </div>
    <div id="menu14" class="tab-pane fade">
        <div class="" id="hide-photo" >
 
            <div id="calender-tab" style="display:block;">
  <form id="calenderform" method="post" enctype="multipart/form-data" >
                            <input type="hidden" class="placeid" name="placeid" value="<?php echo $_REQUEST['placeid']?>" id="placeid">
                            <div class="tellus-data col-lg-12 col-sm-12 col-md-12 col-xs-12 pd-lr-0"><!--id="calendar-tab"-->
                                <div class="had-frm-sec" >Seasonal & Advanced Scheduling</div>
                                <div class="frm-field-mar container">
          	                    <div class="form-group input-group date row" id='datetimepicker6' style="margin: 0 0 5px 70px;">
                		                        <div class="col-md-6 col-lg-6"><label for="space">From date:</label>
                                            <input type='text' class="form-control" name="from-date1a" id="date1a" required placeholder="From" data-date-format="YYYY-MM-DD" />
                		                        <!--<span class="input-group-addon">
                    			                    <span class="glyphicon glyphicon-calendar"></span>
                		                        </span>-->
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-6"><label for="space">To date: </label>
                                              <input type='text' class="form-control" name="to-date2a" id="date2a" required placeholder="To" data-date-format="YYYY-MM-DD"/>                                   
                                            </div>
            	                  </div>        
               	                <div class="form-group input-group date row" id='datetimepicker8' style="margin: 5px 0 5px 70px;">
                		                        <div class="col-md-6 col-lg-6"><label for="space">From time:</label>
                                              <input type='text' class="form-control" name="from-date1b" id="date1b" required placeholder="From" data-date-format="HH:mm" />
                		                          <!--<span class="input-group-addon">
                    			                      <span class="glyphicon glyphicon-calendar"></span>
                		                          </span>-->
                                            </div>
                                            <div class="col-md-6 col-lg-6"><label for="space">To time:</label>
                                              <input type='text' class="form-control" name="to-date2b" id="date2b" required placeholder="To" data-date-format="HH:mm"/>
                                            </div>
            	                  </div>
                                
    		                        <div class="form-group input-group row" style="margin: 5px 0 5px 70px;">
                	                          <div class="col-md-4 col-lg-4" style="margin: 0 0px 0 0;"><label for="priceph">Price Per Hour</label>
                                                <input type="number" class="form-control" size="3" id="priceph" placeholder="Enter $$" name="p_p_h">
                                                <div class="" style="">
                                                  <b>My Takehome (per hour):</b> <span id="netpph">$0</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-lg-4"><label for="pricepd">Price Per Day </label>
                                                <input type="number"  class="form-control" size="3" id="pricepd" placeholder="Enter $$" name="p_p_n">
                                                <div class="  " ><br>
                                                  <b> My Takehome (per day):</b> <span id="netppd">$0</span>
                                                </div>
                                                <input type="hidden" class="sfee" value=<?php echo $sfee ?>>
                                              </div>                                          
                                </div>                               
                                
                                <div class="form-group  row" style="margin: 20px 0 5px 70px; width: 650px;">
                	                            <div class="col-md-4 col-lg-4">
                                                <button id="savetime" type="button" name="savetime" class="btn btn-default cus-save-but">Add Availability</button>            
                                              </div>                                        
                                              <div class="col-md-2 col-lg-2">
                                                <button id="repeat" type="button" name="repeat" class="btn btn-default cus-save-but">Repeat</button>
                                              </div>
                                              <div class="col-md-6 col-lg-6">
                                                <select class="form-control selectpicker" id="timing" name="timing">
                                                      <option value="">Select Repeat Frequency</option>
                                                      <option value="d">Daily</option>
                                                      <option value="w">Weekly</option>
                                                </select>
                                              </div>
                                              <span id="span1a" style="display:none; color: red;">Please enter missing values.</span>
		                            </div>
                              
		                        <div class="col-md-12 col-lg-12 form-group row" style="margin: 5px 0px 11px 70px;">
			                                                          	
			                                    <!--<a id="" type="button" href="dashboard.php" name="place" class="btn btn-default cus-save-but">My DashBoard</a>-->
		                        </div>
                                
                                <div id="msg3" style="color: red; padding: 0 30px;"></div>
    	                    </div><!--frm-field-mar--> 
                            </div>
</form>
<div class="clearfix"></div>
        </div>
        <div class="col-md-12 tellus-data for_claender_data" style="border-bottom: 0px solid rgb(252, 139, 17);border-left: 2px solid rgb(252, 139, 17);border-right: 2px solid rgb(252, 139, 17);">
      <?php  $sql9 = mysqli_query($connect,"SELECT * FROM calenderdata WHERE placeid='".$pid."'");
      if(mysqli_num_rows($sql9)>0)
      { 
        ?>
        <div class="row" style="background: rgb(252, 139, 17);
    padding: 18px 0px;
    color: white;
    font-weight: bolder;
    font-size: 13px;">
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
          <div class="col-md-3" style="text-align: center; padding-left: 50px;">From</div>
          <div class="col-md-3" style="text-align: center;">To</div>
          <div class="col-md-1" style="padding-left: 50px;">Price/<br>Hour</div>
          <div class="col-md-1" style="padding-left: 50px;">Price/<br>Day</div>
          <!--<div class="col-md-1">Price/<br>Week</div>-->
          <div class="col-md-3" style="text-align: center; style="padding-left: 50px;">Action</div>
        </div>
        <?php
        $he = 1;
        while($row9 = mysqli_fetch_array($sql9))
        {
          $fromdt = date_format(date_create($row9['date1']), 'Y-m-d g:s a');
          $todt = date_format(date_create($row9['date2']), 'Y-m-d g:s a');
          ?>
            <div class="row for_re" style="padding: 11px 0px 1px 50px; border-bottom: 2px solid rgb(252, 139, 17);">
            <div class="col-md-3 text-center"><?php echo $fromdt ?></div>
            <div class="col-md-3 text-center"><?php echo $todt ?></div>
          
            <?php /*if(($row9['p_p_n']=="")&&($row9['p_p_h']=="")&&($row9['w_p_p_n']==""))
            {*/
              ?>
<!--<div class="col-md-3 text-center">Not Available</div>-->
<?php
            //}
              //else
              //{

               ?>
            <div class="col-md-1 text-center"><input class="he<?php echo $he; ?>" style="width: 59px;" type="text" name="p_p_h" value="<?php echo $row9['p_p_h']  ? $row9['p_p_h'] : '0';  ?>"></div>
            <div class="col-md-1 text-center"><input class="he<?php echo $he; ?>" style="width: 59px;" type="text" name="p_p_n" value="<?php echo $row9['p_p_n'] ? $row9['p_p_n'] : '0';  ?>"></div>       
            <!--<div class="col-md-1 text-center"><input class="he<?php //echo $he; ?>" style="width: 59px;" type="text" name="w_p_p_n" value="<?php //echo $row9['w_p_p_n']  ? $row9['w_p_p_n'] : '0'; ?>"></div>-->
            <?php //} ?>
            <div class="col-md-3 text-center"><button name="calender_price_update" id="he<?php echo $he; ?>" class="btn btn-success onclick_submit_price " value="<?php echo $row9['calid'] ?>" ><i class="fa fa-floppy-o"></i></button>
            <button name="calender_price_delete" id="he<?php echo $row9['calid']; ?>" class="btn btn-danger onclick_delete_price " value="<?php echo $row9['calid'] ?>"><i class="fa fa-trash"></i></button></div>
            
            </div>
            <span id="delmsg" style="color: blue;"></span>
          <?php
          $he++;
          }
          ?>
          <span id="heval" style="display:none;"><?php echo $he ?></span>
               <div class="row"style="padding: 11px 0px 1px 0px;
    border-bottom: 2px solid rgb(252, 139, 17);">
          <!--div class="col-md-12 form-group">
            <!--<button id="add_cal_price" class="btn-success btn">Add</button>-->
            <!--<a href="dashboard.php" class="btn-warning btn">My DashBoard</a>-->
            <!--<a href="edit-place.php?placeid=17" class="btn-info btn">Update Details</a>-->
          <!--</div>--></div>
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
    <?php //include_once('calender.php'); ?>
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
      <input type="email" class="form-control form-height40 bord-0"  name="email" required placeholder="Email Id"/>
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

  <div class="hide1" id="fourth-block"> 
<form class="form-group" id="change_price">
    <div class="input-group" id="change_price">
      <span class="input-group-addon"><i class="fa fa-user"></i></span>
      <input type="text" class="form-control form-height40 bord-0" value=""  name="ppn"/>
    </div>
    <div class="input-group mg-top20">
      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
      <input type="text" class="form-control form-height40 bord-0" value="" name="pph"/>
      <input type="hidden" class="urlval" >
    </div>
    <div class="input-group mg-top20">
      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
      <input type="text" class="form-control form-height40 bord-0" value="" name="wpph"/>
      <input type="hidden" class="urlval" >
    </div>
    <div class="text-center mg-top10">
      <button type="submit" class="btn-3" name="change_price">Login</button>
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
<?php include 'lib/footer.php'; //if isset
?>
<script src="tm/jquery.timepicker.js"></script>
  <!--==================Signup Modal box Ends==============-->
  

 
<!--========== footer 1st============-->
<!--<footer class="footer-media">
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
<span>Copyright &copy; 2016 2Finda</span>
<div class="row">
</div><!--row close-->
</div><!--container close-->
</div><!--footer-fst close-->
 

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--     <script src="js/jquery.min.js"></script> -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

     <script src="bootstrap/js/bootstrap.js"></script> -->

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="tm/jquery.timepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>   
<script src="js/forms.js"></script>
<script src="js/forms2.js"></script>
<script src="sm/dist/sweetalert2.min.js"></script>
<script src="bm/js/fileinput.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script src="js/nouislider.js"></script>


    <script src="js/forms-map.js"></script>
    Include all compiled plugins (below), or include individual files as needed
   
   <script src="js/star-rating.min.js"></script>
  <script src="js/bootstrap-select.js"></script>
  
  <script src="js/wow.js"></script>-->
    <script type="text/javascript">
        $(function () {
            
            //$('#datetimepicker6').datetimepicker();
            //$('#datetimepicker7').datetimepicker();
            //$('#datetimepicker8').datetimepicker();
            //$('#datetimepicker9').datetimepicker();
        });
        $(document).ready(function() {
          $('#date1a').datepicker({
		          'dateFormat':'yy-mm-dd',
		          step: 60,
		          //minTime:'<?php //echo $dt1time ?>',
		          //maxTime:'<?php //echo $dt2time ?>',
    	        'scrollDefaultNow': 'true',
              'closeOnWindowScroll': 'true',
              'showDuration': false
	        });
          $('#date2a').datepicker({
		          'dateFormat':'yy-mm-dd',
		          step: 60,
		          //minTime:'<?php //echo $dt1time ?>',
		          //maxTime:'<?php //echo $dt2time ?>',
    	        'scrollDefaultNow': 'true',
              'closeOnWindowScroll': 'true',
              'showDuration': false
	        });
          $('#date1b').timepicker({
		          'timeFormat':'g:i a',
		          step: 60,
		          //minTime:'<?php //echo $dt1time ?>',
		          //maxTime:'<?php //echo $dt2time ?>',
    	        'scrollDefaultNow': 'true',
              'closeOnWindowScroll': 'true',
              'showDuration': false
	      });
        $('#date2b').timepicker({
		          'timeFormat':'g:i a',
		          step: 60,
		          //minTime:'<?php //echo $dt1time ?>',
		          //maxTime:'<?php //echo $dt2time ?>',
    	        'scrollDefaultNow': 'true',
              'closeOnWindowScroll': 'true',
              'showDuration': false
	      });
        $sfee = $('.sfee').val();
        $("#priceph").change(function() {
            $prh = Number($("#priceph").val());
            $newval = $prh - ($prh * $sfee)
            $("#netpph").html("$" + String($newval));
        });

        $("#pricepd").change(function() {
          $prd = Number($("#pricepd").val());
          $newval = $prd - ($prd * $sfee)
          $("#netppd").html("$" + String($newval));
        });

        $("#pricepw").change(function() {
          $prw = Number($("#pricepw").val());
          $newval = $prw - ($prw * $sfee);
          $("#netppw").val("$" + String($newval));
        });

        $('#savetime').click(function(){
                    if (formVal()) {
                        $("form#calenderform").submit();
                    } else {
                        return false;
                    }
	      });
        });
    </script>

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


      function formVal() {
            var mess = "Please Enter Missing Information.";
            $('#msg3').html("");
    				var fn=document.getElementById('date1a').value;
    				if(fn == ""){
        				
        				document.getElementById('date1a').style.borderColor = "red";
						$("#span1a").html(mess);
						$("#span1a").css('display', 'block');
        				return false;
    				}else{
        				document.getElementById('date1a').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}

					var fn1=document.getElementById('date1b').value;
    				if(fn1 == ""){
        				
        				document.getElementById('date1b').style.borderColor = "red";
						$("#span1a").html(mess);
						$("#span1a").css('display', 'block');
        				return false;
    				}else{
        				document.getElementById('date1b').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}

					var fn2=document.getElementById('date2a').value;
    				if(fn2 == ""){
        				
        				document.getElementById('date2a').style.borderColor = "red";
						$("#span1a").html(mess);
						$("#span1a").css('display', 'block');
        				return false;
    				}else{
        				document.getElementById('date2a').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}

					var fn2=document.getElementById('date2b').value;
    				if(fn2 == ""){
        				
        				document.getElementById('date2b').style.borderColor = "red";
						$("#span1a").html(mess);
						$("#span1a").css('display', 'block');
        				return false;
    				}else{
        				document.getElementById('date2b').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}
					var fn1=document.getElementById('priceph').value;
    				if(fn1 == ""){
        				
        				document.getElementById('priceph').style.borderColor = "red";
						$("#span1a").html(mess);
						$("#span1a").css('display', 'block');
        				return false;
    				}else{
        				document.getElementById('priceph').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}

					var fn2=document.getElementById('pricepd').value;
    				if(fn2 == ""){
        				
        				/*document.getElementById('pricepd').style.borderColor = "red";
						$("#span1a").html(mess);
						$("#span1a").css('display', 'block');
        				return false;*/
    				}else{
        				document.getElementById('pricepd').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}

					/*var fn2=document.getElementById('pricepw').value;
    				if(fn2 == ""){
        				
        				document.getElementById('pricepw').style.borderColor = "red";
						$("#span1a").html(mess);
						$("#span1a").css('display', 'block');
        				return false;
    				}else{
        				document.getElementById('pricepw').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}*/
                    
              var dt1 = new Date($("#date1a").val() + " " + $("#date1b").val());
			        var dt2 = new Date($("#date2a").val() + " " + $("#date2b").val());
              var dt3 = new Date();
              var dttm1 = new Date($("#date1a").val() + " " + $("#date1b").val());
              var dttm2 = new Date($("#date1a").val() + " " + $("#date2b").val());
			        if (dt1 >= dt2) {
				        document.getElementById('date1a').style.borderColor = "red";
				        document.getElementById('date1b').style.borderColor = "red";
				        document.getElementById('date2a').style.borderColor = "red";
				        document.getElementById('date2b').style.borderColor = "red";
				        $("#span1a").html("From Date is Greater than or Equal to To Date.");
				        $("#span1a").css('display', 'block');
				        return false;
              } else if (dt1 < dt3) {
                document.getElementById('date1a').style.borderColor = "red";
                $("#span1a").html("From Date is in the Past.");
				        $("#span1a").css('display', 'block');
                return false;
              } else if (dttm1 >= dttm2) {
                document.getElementById('date1b').style.borderColor = "red";
				        document.getElementById('date2b').style.borderColor = "red";
				        $("#span1a").html("From Time is Greater than or Equal to To Time.");
				        $("#span1a").css('display', 'block');
				        return false;
              }
              return true;
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0ceT-_kjPt8INNEKoVX9axkv3zw3miBY&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
   
