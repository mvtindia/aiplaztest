<?php session_start();
include_once('connect.php');?>
<!doctype html>
<html>
<head>

	<title>List a Place</title>
  <script src='js/daypilot-all.min.js?v=2542'></script>
  <link type="text/css" rel="stylesheet" href="helpers/demo.css?v=2542" />
  <link type="text/css" rel="stylesheet" href="helpers/media/layout.css?v=2542" />
  <link type="text/css" rel="stylesheet" href="helpers/media/elements.css?v=2542" />

  <link type="text/css" rel="stylesheet" href="themes/month_white.css?v=2542" />    
  <link type="text/css" rel="stylesheet" href="themes/month_green.css?v=2542" />    
  <link type="text/css" rel="stylesheet" href="themes/month_transparent.css?v=2542" />    
  <!--<link type="text/css" rel="stylesheet" href="themes/month_traditional.css?v=2542" />
  <link type="text/css" rel="stylesheet" href="themes/areas.css?v=2542" />       
  <link type="text/css" rel="stylesheet" href="themes/navigator_8.css?v=2542" />
  <link type="text/css" rel="stylesheet" href="themes/calendar_traditional.css?v=2542" />-->  
  <link type="text/css" rel="stylesheet" href="themes/navigator_white.css?v=2542" />    
        
  <link type="text/css" rel="stylesheet" href="themes/calendar_transparent.css?v=2542" />    
  <link type="text/css" rel="stylesheet" href="themes/calendar_white.css?v=2542" />    
  <link type="text/css" rel="stylesheet" href="themes/calendar_green.css?v=2542" /> 
	<?php include 'lib/top.php';?>
  <script>
    var incr = "no";
  </script>

</head>

<body>

<div class="container-fluid"><!--container-fluid start-->
    <div class="row">

<!--==============menu header=========================-->
        <div class="menu-had2">
                <?php include 'lib/header.php';?>
        </div><!--menu-had close-->
<!--==============menu header close=========================-->

        <div class="banner-txt">
            <h1> Add a new place</h1>
<!--<h4>Earn money renting out a spare room, marriage place or House. Listing your place is totally free. </h4>-->
        </div>

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

                            <div class="clearfix"></div>
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
                                    <select class="form-control" name="areatype"><option>Select Area Type</option>
                                        <?php $query=mysqli_query($connect,'Select * from area');
                                            while($match=mysqli_fetch_array($query)){?>
                                                <option value="<?php echo $match['areaid'];?>"><?php echo $match['areatype'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label class="wid100" for="space">Common Ammenities</label>
                                <select class="form-control" id="select6" name="commonammenties[]" multiple >
                                    <?php $query=mysqli_query($connect,'Select * from ammenities where atype="common"');
                                        while($match=mysqli_fetch_array($query)){?>
                                            <div class="col-md-12 checkbox">
                                                <label type="checkbox">
<!--<input type="checkbox" name="commonammenties[]"  value="<?php echo $match['aid'];?>">&nbsp;<?php echo $match['aname'];?></label>-->
                                                <option name="commonammenties[]"value="<?php echo $match['aid'];?>"><?php echo $match['aname'];?></option>
                                            </div>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label class="wid100" for="space">Additional Ammenities</label>
                                <select class="form-control" id="select5" name="add_ammenties[]" multiple >
                                    <?php $query=mysqli_query($connect,'Select * from ammenities where atype="additional"');
                                        while($match=mysqli_fetch_array($query)){?>
                                            <div class="col-md-12 checkbox"><label type="checkbox">
<!--<input type="checkbox" name="add_ammenties[]"  value="<?php echo $match['aid'];?>">&nbsp;<?php echo $match['aname'];?></label>-->
                                                <option name="add_ammenties[]"value="<?php echo $match['aid'];?>"><?php echo $match['aname'];?></option>
                                            </div>
                                    <?php }?>
                                </select>
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="space">Description</label>
                                <textarea  class="form-control" id="accomodates"  placeholder="Description" name="details" ></textarea>
                            </div>

                            <div class="clearfix"></div>

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
                                        <p style="font-size: 12px"> Please Upload Photos of (jpg/jpeg/png/gif) formats </p>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="custom-upload uploadvideo">ADD Videos</label>
                                </div>
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
  
  <!--============================Photos AND Videos TAB CLOSE============================-->

  <!--==========================PRICE AND TERMS TAB STARTS=======================-->
                        <form id="pricetermss" method="post" enctype="multipart/form-data" >
                        <div class="tellus-data" id="hide-price" style="overflow: auto;">
                            <div class="had-frm-sec" >Price & Terms</div>
                            <div class="frm-field-mar">
                                <?php //include_once('demo.php');?>
                                <input type="hidden" class="placeid" name="placeid" value="" id="placeid">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="space">Select Your Currency</label>
<!--    <input type="text" required name="currency" value="<?php echo $_SESSION['currencySymbol'];?>" class="form-control">-->

                                    <select class="form-control" id="sel1" name="currency" >
                                        <option value="">Select Options</option>
                                        <option value="1">$</option>
                                        <option value="4">₹</option>
                                    </select>
                                </div>
<!--
      <?php echo '<pre>';
var_dump($_SESSION);
echo '</pre>'; ?>
-->

                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="space">Price Per Hour</label>
                                    <input type="number" required class="form-control" id="accomodates" placeholder="Enter price" name="p_p_h">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="space">Price Per Day</label>
                                    <input type="number" required class="form-control" id="accomodates" placeholder="Enter price" name="p_p_n">
                                </div>

                                <div class="col-md-12 text-center"style="margin-bottom: 11px;">
                                    <button id="back1" type="button" name="place" class="btn btn-default cus-save-but">Back</button>
                                    <button id="next2" type="submit" name="priceterms" class="btn btn-default cus-save-but">Save and continue</button>
                                </div>
                            </div><!--frm-field-mar-->
                        </div><!-- tell us -->
                    </form>

                        <div class="clearfix"></div>
<input type="hidden" id="spacehog">

  <!--============================Price AND TERMS TAB CLOSE============================-->


  <!--==========================Calendar TAB STARTS=======================-->
                    
                    <script>
                        /*$(document).ready(function(){
                            $("#pricetermss").css('display','none');
                            $("#calender-tab").css('display','block');
                            $("#photovideo").css('display','none');
                            $("#details").css('display','none');
                        });*/
                    </script>
                        <div id="calender-tab" style="display:none;">
                            <?php 
                                //$query2=mysqli_query($connect,'SELECT * FROM calenderdata where placeid="'.$_SESSION['placeids'].'"');
                            ?>

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
                                    <button id="mvdtb"><---</button><button id="mvdtf">---></button>
                                    <div id="dp"></div>
                                    <div class="col-md-12 text-center">
                                        <button id="back2" type="button" name="place" class="btn btn-default cus-save-but">Back</button>
<!--   <button id="next3" type="submit" name="priceterms" class="btn btn-default cus-save-but">Save</button>
 -->                                </div>

                                    <div class="clearfix"></div>
                                </div><!--frm-field-mar--> 
                            </div>
                            <div class="col-md-12 text-center" style="margin-top: 20px;">
                                <a id="" type="button" href="dashboard.php" name="place" class="btn btn-default cus-save-but">My DashBoard</a>
                            </div>
                        </form>
                            <div class="clearfix"></div>
                        </div><!-- calendar tab -->
                    </div> <!-- details -->
                    <!-- below is ok -->
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                        <div class="tellus-data">
                            <div class="had-frm">Why list your place?</div>
                            <div class="safe-lst">
                                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
                                    <img class="img-responsive" src="img/save.png">
                                </div>
                                <div class="col-lg-10 col-sm-10 col-md-10 col-xs10">
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
                        </div><!-- tell us -->
                    </div> 
                </div>
            </div><!--row close-->
  <!--=====================================COL-MD-8 LEFT side CLOSE==========================================-->

<!--==========WHY LIST YOUR PLACE?============-->
            

 <!--==========WHY LIST YOUR PLACE CLOSE============-->
 
        </div><!--container close-->
    </div><!--row close-->
</div><!--container-fluid close-->

<!-- <script src="js/forms-map.js"></script> -->
<?php include 'lib/footer.php'; //if isset
?>
</body>
<?php 
   if(!isset($_SESSION['u_id'])) {
?>
<script>
     $("#myModal2").modal();
</script>
<?php } ?>

<script type="text/javascript">
  var dp = new DayPilot.Calendar("dp");
  var dae = new Date();
  var x = 1;

  function dayplt() {
    
    dp.cssClassPrefix = "calendar_white";
    dp.viewType = "Week";
    // view
    if (incr == "forw")
    {
        //var dataI = new Date();
        var i = dae.valueOf() + (604800000 * x);
        dae = new Date( i);
        //console.log(dae.getMonth());
    } else if (incr == "back") {
        //var dataI = new Date();
        var i = dae.valueOf() - (604800000 * x);
        dae = new Date( i);
        //console.log(dae.getMonth());
    }
    //alert(("0" + dae.getDate()).slice(-2));
    dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
    //dp.startDate = "2016-11-25";  // or just dp.startDate = "2013-03-25";
    dp.days = 1;
    dp.allDayEventHeight = 25;
    dp.initScrollPos = 9 * 40;
    dp.moveBy = 'Full';
    
    // bubble, with async loading
    /*dp.bubble = new DayPilot.Bubble({
        cssClassPrefix: "bubble_default",
        onLoad: function(args) {
            var ev = args.source;
            args.async = true;  // notify manually using .loaded()
            
            // simulating slow server-side load
            setTimeout(function() {
                args.html = "testing bubble for: <br>" + ev.text();
                args.loaded();
            }, 500);
        }
    });
    
    dp.contextMenu = new DayPilot.Menu({
        cssClassPrefix: "menu_default",
        items: [
        {text:"Show event ID", onclick: function() {alert("Event value: " + this.source.value());} },
        {text:"Show event text", onclick: function() {alert("Event text: " + this.source.text());} },
        {text:"Show event start", onclick: function() {alert("Event start: " + this.source.start().toStringSortable());} },
        {text:"Delete", onclick: function() { dp.events.remove(this.source); } }
    ]});*/

    // event movijng
    dp.onEventMoved = function (args) {
        dp.message("Moved: " + args.e.text());
    };
    
    dp.onBeforeHeaderRender = function(args) {
        args.header.areas = [{"action":"JavaScript","bottom":1,"w":17,"html":"<div><div><\/div><\/div>","css":"resource_action_menu","js":"(function(e) { alert(e.date);; })","top":0,"v":"Visible","right":1}];
    };
    
    // event resizing
    dp.onEventResized = function (args) {
        dp.message("Resized: " + args.e.text());
    };

    // event creating
    dp.onTimeRangeSelected = function (args) {
        var name = prompt("New event name:", "Event");
        dp.clearSelection();
        form = $('#calenderform');
        args.placeid = form.find('input.placeid').val();
        args.idd = DayPilot.guid();

        if (!name) return;
        var e = new DayPilot.Event({
            start: args.start,
            end: args.end,
            id: args.idd,
            resource: args.resource,
            text: name
        });
        dp.events.add(e);
        
        args.text = name;
        //console.log(args);
        DayPilot.request(
                        "cal_db.php", 
                        function(req) { // success
                            //var response = eval("(" + req.responseText + ")");
                            //if (response && response.result) {
                            //    dp.message("Created: " + response.message);
                            //}
                        },
                        args,
                        function(req) {  // error
                            dp.message("Saving failed");
                        }
        ); 
        //DayPilot.request(
          /*  $.ajax({
                url:"cal_db.php",
                type:"POST",
                data:args,
                success:function(req){
                    var response = eval("(" + req.responseText + ")");
                    if (response && response.result) {
                        dp.message("Created: " + response.message);
                    }
                },
                error:function(req) {  // error
                    dp.message("Saving failed");
                }                    
            });
            */
    };

    
    dp.onTimeRangeDoubleClicked = function(args) {
        alert("DoubleClick: start: " + args.start + " end: " + args.end + " resource: " + args.resource);
    };
    
    dp.onEventClick = function(args) {
        alert("clicked: " + args.e.id());
    };

    dp.onEventMoved = function (args) {
        form = $('#calenderform');
        args.placeid = form.find('input.placeid').val();
        DayPilot.request(
            "cal_move.php", 
            function(req) { // success
                var response = eval("(" + req.responseText + ")");
                if (response && response.result) {
                    //dp.message("Moved: " + response.message);
                }
            },
            args,
            function(req) {  // error
                //dp.message("Saving failed");
            }
        );        
    };

    dp.onEventResized = function (args) {
        form = $('#calenderform');
        args.placeid = form.find('input.placeid').val();    
        DayPilot.request(
            "cal_move.php", 
            function(req) { // success
                var response = eval("(" + req.responseText + ")");
                if (response && response.result) {
                //dp.message("Resized: " + response.message);
                }
            },
            args,
            function(req) {  // error
                //dp.message("Saving failed");
            }
        );    
    };
    
    dp.init();

    /*var e = new DayPilot.Event({
        start: new DayPilot.Date("2013-03-25T12:00:00"),
        end: new DayPilot.Date("2013-03-25T12:00:00").addHours(3),
        id: DayPilot.guid(),
        text: "Special event",
        areas: [{"action":"JavaScript","js":"(function(e) { dp.events.remove(e); })","h":17,"w":17,"v":"Hover","css":"event_action_delete","top":3,"right":2}]    
    });
    dp.events.add(e);*/
  };
  function loadEvents() {
    DayPilot.request("cal_load.php", function(result) {
        //console.log(result);
        var data = eval("(" + result.responseText + ")");
        for(var i = 0; i < data.length; i++) {
            var e = new DayPilot.Event(data[i]);                
            dp.events.add(e);
        }
    });
    }
  dayplt();
  loadEvents();
</script>

</html>

<script type="text/javascript">

$(document).ready(function() {

    var url = window.location.href;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if (filename === "") filename = "index.html";
    $(".menu a[href='" + filename + "']").addClass("selected");

    $( "#mvdtf" ).click(function() {
        //alert("hello");
        event.preventDefault();
        var i = dae.valueOf() + (604800000 * x);
        dae = new Date( i);
        dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
        
        $('.ishowload').css('display','none');
        $("#pricetermss").css('display','none');
        $("#calender-tab").css('display','block')
        dp.update();
    });

    $( "#mvdtb" ).click(function() {
        event.preventDefault();
        var i = dae.valueOf() - (604800000 * x);
        dae = new Date( i);
        dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
        
        $('.ishowload').css('display','none');
        $("#pricetermss").css('display','none');
        $("#calender-tab").css('display','block')
        
        dp.update();
    });
});
        
</script>