<?php session_start();
include_once('connect.php');
$fees = mysqli_query($connect,"select * from fees where feefor='s'");
$feeres = mysqli_fetch_array($fees);
$sfee = $feeres['percentage'] * .01; ?>
<!doctype html>
<html>
<head>

<title>List a Place</title>
  
	<?php include 'lib/top.php';?>
    <link href="tm/jquery.timepicker.css" rel="stylesheet">
  <style>
    .bootstrap-datetimepicker-widget {
        font-size: 10px;
	    width: 200px;
    }
  </style>

</head>

<body>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1446252165384800',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

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
                                    <label for="space">First Name*</label>
                                    <input type="text" class="form-control" id="fname" placeholder="Name" value="<?php echo $_SESSION['fname'] ?>" name="fname" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">     
                                    <label for="space">Last Name*</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Name" value="<?php echo $_SESSION['lname'] ?>" name="lname" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label for="space">Contact Number*</label>
                                    <input type="text" class="form-control phone" id="price" value="<?php echo $_SESSION['contact'] ?>" placeholder="Contact" name="contact" required>
                                    <div class="help-block with-errors"></div>
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
                                            <div class="help-block with-errors"></div>
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
                                <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="email">Property type*</label>
                                <select class="form-control" id="sel1" name="property" required >
                                    <option value="">Select Property type</option>
                                    <?php $query=mysqli_query($connect,'Select * from property');
                                        while($match=mysqli_fetch_array($query)){?>
                                            <option value="<?php echo $match['pid'];?>"><?php echo $match['ptype'];?></option>
                                    <?php }//while ?>
                                </select>
                                <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="space">Capacity*</label>
                                <input type="number" class="form-control" name="capacity" required>
                                <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 sample-only">
                                <label class="wid100" for="space">Can be used for*</label>
                                <select id="select1" class="wid100" multiple="multiple" name="canbe[]" required>
     <!--  <option value="" hidden>Select Uses</option> -->
                                    <?php $query=mysqli_query($connect,'Select * from usedfor');
                                        while($match=mysqli_fetch_array($query)){?>
                                            <option value="<?php echo $match['ufid'];?>"><?php echo $match['ufname'];?></option>
                                    <?php }//while ?>
                                </select>
                                <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12 pd-lr-0">  
                                <label for="space">Area*</label>
                            </div>
                            <div class="col-md-6 pd-l-0">
                                    <input type="text" class="form-control" id="accomodates" placeholder="Area" name="area" required="">
                                    <div class="help-block with-errors"></div>
                            </div>
                            <div class="col-md-6 pd-r-0">
                                    
                                        <select class="form-control" name="areatype"><option>Select Area Type</option>
                                                                                        <option value="1">sqmt</option>
                                                                                        <option value="2">yards</option>
                                                                                        <option value="4">sqft</option>
                                                                                        <option value="11">miles</option>
                                                                            </select>

                                    
                                    <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label class="wid100" for="space">Common Ammenities</label>
                                <select class="form-control" id="select6" name="commonammenties[]" multiple >
                                    <?php $query=mysqli_query($connect,'Select * from ammenities where atype="common"');
                                        while($match=mysqli_fetch_array($query)){?>
                                            <div class="col-md-12 checkbox">
                                                <label type="checkbox">
                                                <option name="commonammenties[]" value="<?php echo $match['aid'];?>"><?php echo $match['aname'];?></option>
                                                </label>
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
                                                <option name="add_ammenties[]" value="<?php echo $match['aid'];?>"><?php echo $match['aname'];?></option>
                                            </div>
                                    <?php }?>
                                </select>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="space">Description</label>
                                <textarea  class="form-control" id="description"  placeholder="Description" name="details" ></textarea>
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
                                <!--<div class="col-md-12 text-center p-x-2" style="margin-bottom: 11px;">
                                    <button id="movon1" type="button">Save & Continue</button>
                                </div>-->
                                <div class="clearfix"></div>
                        </div><!--frm-field-mar-->
  <!--=====================================-->

                        <div class="frm-field-mar" id="pandv">
                            <div class="had-frm-sec">Photos & Videos</div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Upload great photos & Videos of your place *</b></div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                <label class="custom-upload uploadphoto">ADD PHOTOS</label>
                                <div class="upphoto form-group" style="display:none;">
                                        <input id="input-7" name="inputphotos[]" data-show-upload="false" multiple type="file" class="file file-loading form-control-file" >
                                        <p style="font-size: 12px"> Please Upload Photos of (jpg/jpeg/png/gif) formats </p>
                                </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="custom-upload uploadvideo">ADD Videos</label>
                            </div>
                            <div class="upvideo form-group" style="display:none;">
                                    <input id="input-8" name="inputvideos[]" data-show-upload="false" multiple type="file" class="file file-loading form-control-file">
                                    <p style="font-size: 12px"> Please Upload Videos of (webm/mp4) Formats with max size upto 10 MB</p>
                            </div>
                            <!--<div class="but-align form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" name="place" class="btn btn-default cus-save-but">Save & continue</button>
                            </div>-->
                            <div class="clearfix"></div>
                        </div>
                        <!--</form>-->
                        <div class="frm-field-mar" id="pandv">
                            <div class="had-frm-sec">Documents</div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Upload your documents *</b></div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                <label class="custom-upload uploadphoto">ADD DOCUMENT</label>
                                <div class="upphoto form-group" style="display:none;">
                                        <input id="input-7" name="inputdocs[]" data-show-upload="false" multiple type="file" class="file file-loading form-control-file" >
                                        <p style="font-size: 12px"> Please Upload Documents of (txt/pdf/doc/docx) formats </p>
                                </div>
                            </div>
                            <div class="but-align form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" id="addplace" name="place" class="btn btn-default cus-save-but">Continue</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    
<!-- details end -->

  <!--==========================Photos AND Videos TAB STARTS=======================-->
                    <!--<div id="calender-tab" style="display:none; background-color: #fff;">-->
                 
                    
                    <!--<form id="photovideo" method="post" enctype="multipart/form-data" style="">-->
                        <!--<input type="hidden" class="placeid" name="placeid" value="" id="placeid">-->
                        
                    </form>
                    <div class="clearfix"></div>
                    
                    <form id="calenderform" method="POST" enctype="multipart/form-data" >
                    <div id="calender-tab" style="display:none;">
                        <h4 style="color: blue;">*You will receive a confirmation email, but in the meantime, please add available times for your place.</h4>
                        <input type="hidden" class="placeid" name="placeid" value="" id="placeid">
                        <div class="tellus-data col-lg-12 col-sm-12 col-md-12 col-xs-12 pd-lr-0" >
                            <div class="had-frm-sec" >Seasonal & Advanced Scheduling</div>
                            <div class="frm-field-mar">
          	                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 input-group date" id='datetimepicker6' style="float: left;">
                		                        <input type='text' class="form-control" name="from-date1a" id="date1a" required placeholder="From" data-date-format="YYYY-MM-DD" />
                		                        <span class="input-group-addon">
                    			                    <span class="glyphicon glyphicon-calendar"></span>
                		                        </span>
            	                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 input-group date" name="from-date1b" id='datetimepicker7' style="float: left;">
                		                        <input type='text' class="form-control" name="from-date1b" id="date1b" required placeholder="From" data-date-format="HH:mm" />
                		                        <!--<span class="input-group-addon">
                    			                    <span class="glyphicon glyphicon-calendar"></span>
                		                        </span>-->
            	                </div>
               	                <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12 input-group date" id='datetimepicker8' style="float: left;">
                		                        <input type='text' class="form-control" name="to-date2a" id="date2a" required placeholder="To" data-date-format="YYYY-MM-DD"/>
                		                        <span class="input-group-addon">
                    			                    <span class="glyphicon glyphicon-calendar"></span>
                		                        </span>
            	                </div>
                                <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12 input-group date" id='datetimepicker9' style="float: left;">
                		                        <input type='text' class="form-control" name="to-date2b" id="date2b" required placeholder="To" data-date-format="HH:mm"/>
                		                        <!--<span class="input-group-addon">
                    			                    <span class="glyphicon glyphicon-calendar"></span>
                		                        </span>-->
            	                </div>
    		                    <div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12" style="margin: 10px 0 10px 0;">
                	                            <label for="space">Price Per Hour</label>
                                                <input type="number"  class="form-control" id="priceph" placeholder="Enter $$" name="p_p_h">
                                </div>
                                
                                <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" style="margin: 10px 0 10px 0;">
                	                            <label for="space">Price Per Day</label>
                                                <input type="number"  class="form-control" id="pricepd" placeholder="Enter $$" name="p_p_n">
                                </div>
                                
                                <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" style="margin: 10px 0 10px 0;">
                	                            <label for="space">Price Per Week</label>
                                                <input type="number" class="form-control" id="pricepw" placeholder="Enter $$" name="w_p_p_n">
                                                <input type="hidden" class="sfee" value=<?php echo $sfee ?>>
                                </div> 
                                <div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12" style="margin: 10px 0 10px 0;">
                                                <b>My Takehome (per hour):</b> <span id="netpph"></span>
                                                
                                </div>
                                <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" style="margin: 10px 0 10px 0;">
                                                <b>My Takehome (per day):</b> <span id="netppd"></span>
                                                <!--<input type="text"  class="form-control" id="netppd" placeholder="Enter $$">-->
                                </div>                            
                                <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" style="margin: 10px 0 10px 0;">
                                                <b>My Takehome (per week):</b> <span id="netppw"></span>
                                                <!--<input type="text"  class="form-control" id="netppw" placeholder="Enter $$">-->
                                </div>
                                <div class="form-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                	                            <button id="savetime" type="button" name="savetime" class="btn btn-default cus-save-but">Add Availability</button>
                                                <button id="repeat" type="button" name="repeat" class="btn btn-default cus-save-but">Repeat</button>
                                                <span id="span1a" style="display:none; color: red;">Please enter missing values.</span>
		                        </div>
                                <div class="form-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control selectpicker" id="timing" name="timing">
                                                    <option value="">Select Repeat Frequency</option>
                                                    <option value="d">Daily</option>
                                                    <option value="w">Weekly</option>
                                                </select>
                                </div>
		                        <div class="col-md-12 text-center"style="margin-bottom: 11px;">
			                                    <button id="continue" type="button" name="place" class="btn btn-default cus-save-but">Continue</button>                       	
			                                    <!--<a id="" type="button" href="dashboard.php" name="place" class="btn btn-default cus-save-but">My DashBoard</a>-->
		                        </div>
                                
                                <div class="clearfix"></div>
                                <div id="msg" style="color: red; padding: 0 30px;"></div>
    	                    </div><!--frm-field-mar--> 
                        </div>
                                </form>
                        <div class="clearfix"></div>
                    </div>       
                    
                    <form id="brtacctform" method="POST" action="brtmaccount.php" enctype="multipart/form-data" >
                    <div id="sacct-tab" style="display:none;">
                        <h4 style="color: red;"></h4>
                        <input type="hidden" class="placeid" name="placeid" value="" id="placeid">
                        <div class="tellus-data col-lg-12 col-sm-12 col-md-12 col-xs-12 pd-lr-0" >
                            <div class="had-frm-sec" >Payment Information</div>
                            <div class="frm-field-mar">
                                <div class="col-md-4 col-sm-4 col-xs-4 col-lg-offset-3 col-md-offset-3">
			                        <input type="radio" value="business" id="hour_label" class="per_val" name="account_holder_type">
			                        <label for="hour_label" style="cursor: pointer;">Business</label>
		                        </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <input type="radio" value="individual" id="night_label" class="per_val" name="account_holder_type">
                                    <label for="night_label" style="cursor: pointer;">Personal</label>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">Organization</label>
                		                        <input type='text' class="form-control" name="business_name" id=""  />
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">First Name</label>
                		                        <input type='text' class="form-control" name="firstName" id="" value="<?php echo $_SESSION['fname'] ?>" />
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">Last Name</label>
                		                        <input type='text' class="form-control" name="lastName" id="" value="<?php echo $_SESSION['lname'] ?>"  />
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">Email</label>
                		                        <input type='text' class="form-control" name="email" id="" value="<?php echo $_SESSION['lname'] ?>"  />
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">Street Address</label>
                		                        <input type='text' class="form-control" name="streetAddress" id="" value=""  />
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">City</label>
                		                        <input type='text' class="form-control" name="locality" id="" value=""  />
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">State</label>
                		                        <input type='text' class="form-control" name="region" id="" value=""  />
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">Zip Code</label>
                		                        <input type='text' class="form-control" name="postalCode" id="" value=""  />
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">Date of Birth</label>
                		                        <input type='text' class="form-control" name="dateOfBirth" id="" value=""  />
            	                </div>
          	                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">Account Number</label>
                		                        <input type='text' class="form-control" name="accountNumber" id="" required  />
                                                <input type='hidden' class="form-control" name="account_type" value="bank_account" required  />
                                                <input type='hidden' class="form-control" name="account_holder_type" value="individual" required  />
                                                <input type='hidden' class="form-control" name="country" value="US" required  />
                                                <input type='hidden' class="form-control" name="currency" value="USD" required  />
                                                
            	                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3 input-group date">
                                                <label for="space">Routing Number</label>
                		                        <input type='text' class="form-control" name="routingNumber" id="" required  />
            	                </div>

                                <!--<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12" style="margin: 10px 0 10px 0;">
                                                <label for="space">Country</label>
                		                        <input type='text' class="form-control" name="account_number" id="" required  />
                                </div>-->
                                <div class="form-group col-lg-5 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-xs-12">
                	                            <button id="savesacct" type="submit" name="savesacct" class="btn btn-default cus-save-but">Save Account Information</button><br>
                                                By clicking this button, you agree to the.
                                                <span id="span1a" style="display:none; color: red;">Please enter missing values.</span>
		                        </div>
                                <div class="clearfix"></div>
    	                    </div><!--frm-field-mar--> 
                        </div>
                                </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
                    
  <!--============================Photos AND Videos TAB CLOSE============================-->

  <!--==========================PRICE AND TERMS TAB STARTS=======================-->
                        <!--<form id="pricetermss" method="post" enctype="multipart/form-data" >
                    <div class="tellus-data" id="hide-price" style="overflow: auto;">
                        <div class="had-frm-sec" >Price & Terms</div>
                        <div class="frm-field-mar">
                                
                                <input type="hidden" class="placeid" name="placeid" value="" id="placeid">
      <?php //echo '<pre>';
//var_dump($_SESSION);
//echo '</pre>'; ?>
-->

                          <!--      <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="space">Price Per Hour</label>
                                    <input type="number" required class="form-control" id="accomodates" placeholder="Enter $$$$" name="p_p_h">
                                </div>
                        </div><!--frm-field-mar-->
                   <!-- </div><!-- tell us -->
                   <!-- </form>

                    <div class="clearfix"></div>


  <!--============================Price AND TERMS TAB CLOSE============================-->

                   <!-- </div>-->  <!--details -->
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
 
        </div><!--container close-->
    </div><!--row close-->
</div><!--container-fluid close-->

<!-- <script src="js/forms-map.js"></script> -->
<script>
function formVal() {
                    var mess = "Please Enter Missing Information.";

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
                    var fn2=document.getElementById('pricepd').value;
                    var fn3=document.getElementById('pricepw').value;
                    var mess2 = "Please Enter Pricing Information.";
    				if(fn1 == "" && fn2 == "" && fn3 == ""){
        				
        				//document.getElementById('priceph').style.borderColor = "red";
						$("#span1a").html(mess2);
						$("#span1a").css('display', 'block');
        				return false;
    				}else{
        				document.getElementById('priceph').style.borderColor = "green";
                        document.getElementById('pricepd').style.borderColor = "green";
                        document.getElementById('pricepw').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}

					
    				/*if(fn2 == ""){
        				
        				document.getElementById('pricepd').style.borderColor = "red";
						$("#span1a").html(mess);
						$("#span1a").css('display', 'block');
        				return false;
    				}else{
        				document.getElementById('pricepd').style.borderColor = "green";
						$("#span1a").css('display', 'none');
    				}

					
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
                    }
                    return true;
    }
</script>

<?php include 'lib/footer.php'; //if isset
?>
<script src="tm/jquery.timepicker.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0ceT-_kjPt8INNEKoVX9axkv3zw3miBY&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
</body>
<?php 
   if(!isset($_SESSION['u_id'])) {
?>
<script>
     $("#myModal2").modal();
</script>
<?php } ?>
<script type="text/javascript">
/*$(function () {
            $('#datetimepicker6').datetimepicker({
               
            });
           // $('#datetimepicker7').datetimepicker({
               
            //});
            $('#datetimepicker8').datetimepicker({
               
            });
            //$('#datetimepicker9').datetimepicker({
               
            //});
});*/
</script>
</html>

<script type="text/javascript">



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
    

    var url = window.location.href;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if (filename === "") filename = "index.html";
    $(".menu a[href='" + filename + "']").addClass("selected");

    $('#savetime').click(function(){
                    if (formVal()) {
                        $("form#calenderform").submit();
                    } else {
                        return false;
                    }
	});


    $( "#mvdtf" ).click(function() {
        event.preventDefault();
        var i = dae.valueOf() + (604800000 * x);
        dae = new Date( i);
        dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
        
        $('.ishowload').css('display','none');
        //$("#pricetermss").css('display','none');
        $("#calender-tab").css('display','block')
        dp.update();
    });

    $( "#mvdtb" ).click(function() {
        event.preventDefault();
        var i = dae.valueOf() - (604800000 * x);
        dae = new Date( i);
        dp.startDate = dae.getFullYear() + "-" + ("0" + (dae.getMonth() + 1)).slice(-2) + "-" + ("0" + dae.getDate()).slice(-2);
        
        $('.ishowload').css('display','none');
        //$("#pricetermss").css('display','none');
        $("#calender-tab").css('display','block')
        
        dp.update();
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
        $("#netppw").html("$" + String($newval));
    });

    

});
        
</script>