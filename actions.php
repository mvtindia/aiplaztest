<?php
session_start();
include_once('connect.php');

// signup form start

if(isset($_REQUEST['value']))
{
  $fname = mysqli_real_escape_string($connect,$_REQUEST['fname']);
  $lname = mysqli_real_escape_string($connect,$_REQUEST['lname']);
  $email = mysqli_real_escape_string($connect,$_REQUEST['email']);
  $pwd = md5($_REQUEST['pwd']);
  $contact = mysqli_real_escape_string($connect,$_REQUEST['contact']);

  $q1 = mysqli_query($connect,"select * from users where email='".$email."'");

  if(mysqli_num_rows($q1) <= 0) {

  $q2 = mysqli_query($connect,'INSERT INTO `users`(`fname`, `lname`, `email`, `pwd`, `contact`) VALUES ("'.$fname.'","'.$lname.'","'.$email.'","'.$pwd.'","'.$contact.'")');
  if($q2)
  {
    echo 'done';
  }
  }
  else
  {
    echo 'already';
  }
}


// signup form end


// Login start Here
if(isset($_REQUEST['login']))
{
   $email = $_POST['email'];
   $password = $_POST['password'];
  $password = md5($password);
  $q2 = mysqli_query($connect,'SELECT * FROM users where email="'.$email.'" AND pwd="'.$password.'"');
  if(mysqli_num_rows($q2)>0)
  {
      $row = mysqli_fetch_array($q2);
      $_SESSION['u_id'] = $row['uid'];
    echo 'done';
  }
  else
  {
    echo 'wrong data';
  }
}
// end here

//update profile pic start here

         if(isset($_REQUEST["upload"]))
                      {
                        $filename=$_FILES['input4']['name'];
                        $filetmp=$_FILES['input4']['tmp_name']; 
                        $filepath="img/".$filename;
                       $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
                      $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                      if(!empty($filename))
                      {
                      if (in_array($ext, $supported_image))
                         {
                          $query=mysqli_query($connect,'update users set profile="'.$filename.'" WHERE uid="'.$_SESSION['u_id'].'"');
                          move_uploaded_file($filetmp,$filepath);
                          echo '<p style="font-size:18px; color:green;">Your Profile Pic Updated Successfully</p>';
                          }
                          else
                           {
                             
                          echo '<p>Please Choose Image With Right Extension</p>';

                           } 
                      }
                      else
                      {
                          echo '<p>Unable To Upadte Profile Picture</p>';
                      }
                      }

//end here
                      // update data start here
   if(isset($_REQUEST['update']))
{
  $fname = $_REQUEST['fname'];
  $lname = $_REQUEST['lname'];
  $contact = $_REQUEST['contact'];
 $dob =$_REQUEST['dob'];
  $city = $_POST['city'];
  $q2 = mysqli_query($connect,'UPDATE `users` SET fname="'.$fname.'",lname="'.$lname.'",contact="'.$contact.'",dob="'.$dob.'",city="'.$city.'" WHERE uid="'.$_SESSION['u_id'].'"');
  if($q2>0)
  {
    echo 'done';
  }
  else{
    echo "not";
  }
  
}

//end here
// change password start here

if(isset($_REQUEST['change_pass']))
{
  $cpass = $_REQUEST['curepassword'];
  $npass = $_REQUEST['newpassword'];
  $cfpass = $_REQUEST['confpassword'];
    $sql = mysqli_query($connect,"SELECT * FROM  users WHERE uid='".$_SESSION['u_id']."'");
    $row = mysqli_num_rows($sql);
    if($row>0)
    {
        $row1 = mysqli_fetch_array($sql);
        $cupass = $row1['pwd'];
        if($cupass == md5($cpass))
        {
           if(md5($npass) == md5($cfpass))
          {    
              $q2 = mysqli_query($connect,'UPDATE `users` SET pwd="'.md5($cfpass).'" WHERE uid="'.$_SESSION['u_id'].'"');
              if($q2>0)
              {
                    echo 'done';
                    session_unset($_SESSION['u_id']);
              }
              else
              {
                    echo"not";
              }
          }
          else
          {
              echo"donot";
          }
        }
        else
        {
            echo "cupass";
        }
    }
    else
    {
        echo"wrong";
    }
  
}
// end here
// Add place Start Here
if(isset($_POST['place']))
{
 // echo "working";
$name = $_POST['name'];
$contact = $_POST['contact'];
$postal = $_POST['postal'];
$location = $_POST['location'];

$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$postcode = $_POST['postcode'];
$country= $_REQUEST['country'];

$space_name = $_POST['space_name'];
$property = $_POST['property'];
$accomodates = $_POST['accomodates'];

$canbe ="";
for($i=0;$i<count($_POST['canbe']);$i++)
{
  $canbe .= $_POST['canbe'][$i].",";
}
$canbe = rtrim($canbe,",");

$area = $_POST['area'];
$areatype = $_POST['areatype'];

$commonammenties="";
for($j=0;$j<count($_POST['commonammenties']);$j++)
{
  $commonammenties .= $_POST['commonammenties'][$j].",";
}
$commonammenties = rtrim($commonammenties,",");

$add_ammenties = "";
for($i=0;$i<count($_POST['add_ammenties']);$i++)
{
  $add_ammenties .=$_POST['add_ammenties'][$i].",";
}
$add_ammenties = rtrim($add_ammenties,",");

$details = $_POST['details'];

$ruledo = "";
for($i=0;$i<count($_POST['ruledo']);$i++)
{
  $ruledo .=$_POST['ruledo'][$i].",";
}
$ruledo = rtrim($ruledo,",");

$ruledonot = "";
for($i=0;$i<count($_POST['ruledonot']);$i++)
{
$ruledonot .=$_POST['ruledonot'][$i].",";
}
$ruledonot = rtrim($ruledonot,",");

$safety ="";
for($i=0;$i<count($_POST['safety']);$i++)
{
  $safety .=$_POST['safety'][$i].",";
}
$safety = rtrim($safety,",");

$fire_extinguisher = $_POST['fire_extinguisher'];
$fire_alaram = $_POST['fire_alaram'];
$gas_valve = $_POST['gas_valve'];
$emergency = $_POST['emergency'];
$capacity = $_POST['capacity'];

if($_SESSION['u_id']=="")
{
echo "login";
}
else
{
$sql = mysqli_query($connect,"INSERT INTO `place` ( `p_name`, `p_contact`, `postal_code`, `p_location`, `p_address`, `p_country`, `p_city`, `p_code`, `p_state`, `space_name`, `property_typeid`, `can_be_usedid`, `accomodates`, `place_area`, `ammenties_id`, `add_ammenties`, `details`, `rules_doid`, `rules_donotid`, `timestampdate`, `saftyid`, `fire_extinguisher`, `fire_alarm`, `gas_valve`, `exit_extinguisher`,`capacity`,`user_id`,`areatype`) VALUES ('".$name."', '".$contact."', '".$postal."', '".$location."', '".$address."','".$country."' ,'".$city."' ,'".$postcode."','".$state."', '".$space_name."', '".$property."', '".$canbe."', '".$accomodates."', '".$area."', '".$commonammenties."', '".$add_ammenties."', '".$details."',  '".$ruledo."', '".$ruledonot."', '".date('Y-m-d')."', '".$safety."', '".$fire_extinguisher."', '".$fire_alaram."', '".$gas_valve."', '".$emergency."','".$capacity."','".$_SESSION['u_id']."','".$areatype."')");
echo $_SESSION['placeids']=mysqli_insert_id($connect);
echo ',,,'; 
if($sql>0){
  echo "success";
}
else{
  echo "error";
}
}

}//if isset

 

if(isset($_POST['photo']))
{
	    $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );

	     $supported_videos = array(
                                              'mp4',
                                              'webm',
                                            );

$placeid=$_POST['placeid'];
$inputphotos = $_FILES['inputphotos']['name'];
$tmpphotos = $_FILES['inputphotos']['tmp_name'];

// //for 
// $imageInformation = getimagesize($_FILES['inputphotos']['tmp_name']);
// $imageWidth = $imageInformation[0]; //Contains the Width of the Image
// $imageHeight = $imageInformation[1]; //Contains the Height of the Image
// if($imageWidth >= '1000' && $imageHeight >='700' )
// {
  
// }
// else
// {

// }
// //end


$inputvideos = $_FILES['inputvideos']['name'];
$tmpvideos = $_FILES['inputvideos']['tmp_name'];
$types = $_FILES['inputvideos']['type'];

	for ($i=0; $i < count($inputphotos) ; $i++)
	{ 
		$path = "images/placephotos/".$inputphotos[$i];
		$ext = strtolower(pathinfo($inputphotos[$i], PATHINFO_EXTENSION));
		if (in_array($ext, $supported_image))
            {
              $imageInformation = getimagesize($tmpphotos[$i]);
             $imageWidth = $imageInformation[0]; //Contains the Width of the Image
             $imageHeight = $imageInformation[1]; //Contains the Height of the Image
              if($imageWidth >= '250' && $imageHeight >='100' )
              {
                $photos .= $inputphotos[$i].",";
                move_uploaded_file($tmpphotos[$i], $path);
              }
              else
              {
                  $err_msg = $inputphotos[$i];
              }      
			       }
	}
	$photos=rtrim($photos,",");
	for ($j=0; $j < count($inputvideos); $j++)
	{ 
		$path1 = "video/".$inputvideos[$j];
		$ext1 = strtolower(pathinfo($inputvideos[$j], PATHINFO_EXTENSION));
		if (in_array($ext1, $supported_videos))
	   {
				$videos .=$inputvideos[$j].",";
				$type .= $types[$j].',';
				move_uploaded_file($tmpvideos[$j], $path1);
			}
	}
$videos=rtrim($videos,",");
$videotype=rtrim($type,",");
if($err_msg=='')
{
$query=mysqli_query($connect,'update place set photo="'.$photos.'" , video="'.$videos.'" , video_type="'.$videotype.'" where place_id="'.$placeid.'"');
if($query>0){
  echo "success";
   echo">>>";
}
else{
	echo "error";
  echo">>>";
}
}
else
{
  echo"wrong_exe";  
   echo">>>";
  echo $err_msg;
}
}//isset photo

//price
if(isset($_POST['priceterms']))
{
//$placeid=$_POST['placeid'];
$placeid=$_POST['placeid'];
$currency = $_POST['currency'];
$p_p_n = $_POST['p_p_n'];
$p_p_h = $_POST['p_p_h'];
$w_p_p_n = $_POST['w_p_p_n'];
$w_discount = $_POST['w_discount'];
$m_discount = $_POST['m_discount'];
echo "Test begin";
echo "currency='.$currency.', p_p_n='$p_p_n', p_p_h='.$p_p_h.', w_p_p_n='.$w_p_p_n.' where place_id='.$placeid.' ";


// $query=mysqli_query($connect,'update `place` set 	`currency`="'.$currency.'" , `p_p_n`='.$p_p_n.', `p_p_h`='.$p_p_h.', `w_p_p_n`='.$w_p_p_n.' where `place_id`='.$placeid.'');

$query=mysqli_query($connect,'update `place` set 	`currency`="'.$currency.'" , `p_p_n`="'.$p_p_n.'", `p_p_h`="'.$p_p_h.'", `w_p_p_n`="'.$w_p_p_n.'" where `place_id`='.$placeid.'');


//$query=mysqli_query($connect,'update place set  currency="RS" , p_p_n="1", p_p_h="1", w_p_p_n="1" where place_id='.$placeid.'');
echo "currency='.$currency.', p_p_n='$p_p_n', p_p_h='.$p_p_h.', w_p_p_n='.$w_p_p_n.' where place_id='.$placeid.' ";
//UPDATE `yamuna`.`place` SET `currency`='Rs', `p_p_n`='12', `p_p_h`='13', `w_p_p_n`='14' WHERE `place_id`='291';


echo "test end ".$placeid;
if($query>0)
{
	echo "success post price";
    echo "success";
  }
else{
	echo "error123 ";
  echo " db error begin ".mysqli_error($query);
  error_log("Failed to connect to database!", 0);

} 

//check with error123 623 to 628 


  echo ",,,";?>
  <form id="calenderform" method="post" enctype="multipart/form-data" >
  <input type="hidden" class="placeid" name="placeid" value="" id="placeid">


      
  <div class="tellus-data col-md-12 col-sm-12 col-xs-12 pd-lr-0" ><!--id="calendar-tab"-->
      <div class="had-frm-sec" >Seasonal Pricing & Scheduling</div>

  <div class="frm-field-mar">
<?php 
$save="";
//$placeid=75;
$query1=mysqli_query($connect,'SELECT * FROM place where place_id="'.$placeid.'"');
if ($row1=mysqli_fetch_array($query1)) {
  if(!empty($row1['p_p_n'])){$ppn=$row1['p_p_n'];$save .="1,";}else{$save .="0,";}
  if(!empty($row1['p_p_h'])){$ppn=$row1['p_p_h'];$save .="1,";}else{$save .="0,";}
  if(!empty($row1['w_p_p_n'])){$ppn=$row1['w_p_p_n'];$save .="1";}else{$save .="0";}
  echo "<input type='hidden' name='save' id='save' value=".$save.">";
}
?>

        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
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
    <div id="demo">     
    </div>
    
    <div id="display-form" style="display: none;">
  <div class="details in" style="width:100%;">
<!--   <div class="arrow" style="left: 147px;"></div> -->
  <div class="events in">
  <form  id="savail" >
  <div class="col-md-12">
  <div class="event empty">
  <input class="form-control "type="text" required id="plabel" placeholder="Give Dates a Label" name="plabel">
  </div></div>
  <div class="col-md-12 mg-top10">
  <div class="col-md-6">
<button class="btn-3 btn-custom2 avail1" style="background: #03DAAB;" type="button">Available</button>
  </div><div class="col-md-6">
<button class="btn-3 btn-custom2 avail2" type="button">Not Available</button>
  </div>
  </div>
  <div class="col-md-12 mg-top10" id="priceper">
  <div class="col-md-4">
<input type="number" id="pph" required placeholder="Price Per hour" class="form-control">
  </div>
    <div class="col-md-4">
<input type="number" id="ppw" required placeholder="Price Per Night" class="form-control">
  </div>
    <div class="col-md-4">
<input type="number" id="ppm" required placeholder="Price Per Week" class="form-control">
  </div>
  </div>

  <input type="text" id="status" required="required" hidden>;
  <div class="col-md-12 mg-top10" id="showpnames"></div>
  <div class="col-md-12 mg-top10"><div class="col-md-6">
  <input class="form-control date21" required type="text" id="datevalue1" name="pdate1" readonly>
  </div>
  <div class="col-md-6">
  <input class="form-control date21" required type="text" id="datevalue2" name="pdate2" readonly>
  <!-- <input class="form-control placeid" type="hidden" name="placeid" placeholder="dd/mm/yy"> -->
 <!--  <input class="form-control" type="hidden" name="ppath" value="http://localhost/nf/bookmyspace"> --></div>
  </div>
 <!--  <div class="col-md-12 mg-top10">
  <div class="col-md-6">
  <input class="form-control" type="time" name="ptime1"></div>
  <div class="col-md-6">
  <input class="form-control" type="time" name="ptime2">
  </div>
  </div> -->
  <div class="col-md-12 mg-top10"><div class="col-md-6">
  <button class="btn-3 btn-custom2 cancl" type="button">Cancel</button></div>
  <div class="col-md-6"><button class="btn-3 btn-custom2 myset" type="button" name="values">Set</button></div></div></form></div></div>
 <!--  -->

  
  </div>
  
  <div class="col-md-12 text-center" style="margin-top: 20px;">
<a id="" type="button" href="dashboard.php" name="place" class="btn btn-default cus-save-but">My DashBoard</a>
<!--   <button id="next3" type="submit" name="priceterms" class="btn btn-default cus-save-but">Save</button>
 -->  </div>
  
  
    
  <div class="clearfix"></div>
 
  </div><!--frm-field-mar-->
  
 </div>
  </form>
  <link rel="stylesheet" type="text/css" href="jquery-cal/css/range-calendar.css">
  <link rel="stylesheet" type="text/css" href="jquery-cal/css/range-style.css">

      <script src="js/jquery.min.js"></script>     
     <script src="bootstrap/js/bootstrap.js"></script>
     
     <!-- range calender -->
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment-with-langs.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script src="js/custom-calendar.js"></script>-->
    <script src="jquery-cal/js/jquery.rangecalendar.js"></script>
  <!--   <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
    
     <script>
     $(document).ready(function(){
      // $('.date21').datepicker();
			var customizedRangeCalendar = $("#demo").rangeCalendar({ theme:"full-green-theme", start : "+0",startRangeWidth : 1,


});
    //    $('.date21').datepicker(
    //     {  //beforeShowDay: $.datepicker.noWeekends,
    //         beforeShowDay: function (date) {
    //             var startDate = "2016-03-15", // some start date
    // endDate = "2016-03-21",  // some end date
    // dateRange = [];           // array to hold the range

    //             // populate the array
    //             for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
    //                 dateRange.push($.datepicker.formatDate('yy-mm-dd', d));
    //             }


    //             var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
    //             return [dateRange.indexOf(dateString) == -1];
    //         }

    //          });
 $(".cal-cell ").click(function(){
                $('#display-form').css('display','block');
              });
        $(".cal-cell ").mouseenter(function(){
               var start = $('.start').attr('date-id');
               var  year = start.substring(0,4);
               var month = start.substring(4,6);
               var day = start.substring(6,8);
               var last = $('.last').attr('date-id');
               var  year1 = last.substring(0,4);
               var month1 = last.substring(4,6);
               var day1 = last.substring(6,8);
             
                $('#datevalue1').val(year+"-"+month+"-"+day).attr('readonly');
               $('#datevalue2').val(year1+"-"+month1+"-"+day1).attr('readonly');
              });
         $(".cal-cell").mouseleave(function(){
               var start = $('.start').attr('date-id');
             var  year = start.substring(0,4);
             var month = start.substring(4,6);
             var day = start.substring(6,8);
                var last = $('.last').attr('date-id');
                var  year1 = last.substring(0,4);
             var month1 = last.substring(4,6);
             var day1 = last.substring(6,8);
              
                $('#datevalue1').val(year+"-"+month+"-"+day).attr('readonly');
               $('#datevalue2').val(year1+"-"+month1+"-"+day1).attr('readonly');
              });
$('#priceper').css('display','none');

$('.avail1').click(function(){
  $('this').css('background','white;');
  $('.avail2').removeAttr('disabled');
     $('#status').attr('value','Available');
     $('#priceper').css('display','block');
    });

    $('.avail2').click(function(){
      $('#priceper input').attr('value','');
      $('#priceper').css('display','none');
       $('this').css('background','white;');
  $('.avail1').removeAttr('disabled');
  $('#pph').val('');
   $('#ppw').val('');
    $('#ppm').val('');
      $('#status').attr('value','Not Available');
    });
  $(".myset").click(function(e)
  {
    var status = $('#status').val();
  var pph = $('#pph').val();
   var ppw = $('#ppw').val();
    var ppm = $('#ppm').val();
   var label =  $('#plabel').val();
   var date1 = $('#datevalue1').val();
   var date2 = $('#datevalue2').val();
   console.log('label='+label+'&datefirst='+date1+'&datelast='+date2+'&status='+status+'&pph='+pph+'&ppn='+ppw+'&ppw='+ppm);
     $.ajax({
           url: 'forms.php?label='+label+'&datefirst='+date1+'&datelast='+date2+'&status='+status+'&pph='+pph+'&ppn='+ppw+'&ppw='+ppm,
           contentType: false,
           cache: false,
           processData:false,
           success: function(data, textStatus, jqXHR)
           {    
            console.log(data);
             if(data == 'ok')
             { 
               $('#priceper').css('display','none');
               $('#calenderform').find("input[type=text], textarea").val("");
               
               $('#display-form').css('display','none');
              swal( 'Success!', 'Sucessfully Submitted', 'success');
              $('#selecteddates').load(window.location + ' #selecteddates');
              // $('.comment-main').load(window.location + ' .comment-main');
               $('.month-cell').removeClass('selected');
              $('.selected').append( "<p style='    padding: 1px 2px 1px 2px;color: rgb(3, 218, 171); background:rgb(205, 87, 87); font-size: 13px;  margin: 11px -9px; display: inline-block;'>Booked</p>" );
              $('.start').addClass('last');
           
           

            // $( ".selected").each(function( index ) {
            //   if($(this).hasClass('.month-cell'))
            //   {
            //     
            //   }
            //   else
            //   {
            //     $(this).css('display','none');
            //   }
            // });

             }
             else
             { 
              $('#selecteddates').load(window.location + ' #selecteddates');
               swal( 'Oops!', 'This Date Range Already Booked', 'error');
             }      
           },
      });
});
	}); 
     </script>


  <?php
//}
//else{
//	echo "error123 ";
//  echo " db error begin ".mysqli_connect_error();
//}
}//isset price



//edit place
if(isset($_POST['eplace']))
{
 // echo "working";
$pid=$_POST['placeid'];
$name = $_POST['name'];
$contact = $_POST['contact'];
$postal = $_POST['postal'];
$location = $_POST['location'];

$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$postcode = $_POST['postcode'];
$country= $_REQUEST['country'];

$space_name = $_POST['space_name'];
$property = $_POST['property'];
$accomodates = $_POST['accomodates'];

$canbe ="";
for($i=0;$i<count($_POST['canbe']);$i++)
{
  $canbe .= $_POST['canbe'][$i].",";
}
$canbe = rtrim($canbe,",");

$area = $_POST['area'];
$areatype = $_POST['areatype'];

$commonammenties="";
for($j=0;$j<count($_POST['commonammenties']);$j++)
{
  $commonammenties .= $_POST['commonammenties'][$j].",";
}
$commonammenties = rtrim($commonammenties,",");

$add_ammenties = "";
for($i=0;$i<count($_POST['add_ammenties']);$i++)
{
  $add_ammenties .=$_POST['add_ammenties'][$i].",";
}
$add_ammenties = rtrim($add_ammenties,",");

$details = $_POST['details'];

$ruledo = "";
for($i=0;$i<count($_POST['ruledo']);$i++)
{
  $ruledo .=$_POST['ruledo'][$i].",";
}
$ruledo = rtrim($ruledo,",");

$ruledonot = "";
for($i=0;$i<count($_POST['ruledonot']);$i++)
{
$ruledonot .=$_POST['ruledonot'][$i].",";
}
$ruledonot = rtrim($ruledonot,",");

$safety ="";
for($i=0;$i<count($_POST['safety']);$i++)
{
  $safety .=$_POST['safety'][$i].",";
}
$safety = rtrim($safety,",");

$fire_extinguisher = $_POST['fire_extinguisher'];
$fire_alaram = $_POST['fire_alaram'];
$gas_valve = $_POST['gas_valve'];
$emergency = $_POST['emergency'];
$capacity = $_POST['capacity'];

if($_SESSION['u_id']=="")
{
echo "login";
}
else
{
$sql = mysqli_query($connect,"UPDATE `place` SET `p_name`='".$name."', `p_contact`='".$contact."', `postal_code`='".$postal."', `p_location`='".$location."', `p_address`='".$address."', `p_country`='".$country."', `p_city`='".$city."', `p_code`='".$postcode."', `p_state`='".$state."', `space_name`='".$space_name."', `property_typeid`='".$property."', `can_be_usedid`='".$canbe."', `accomodates`='".$accomodates."', `place_area`='".$area."', `ammenties_id`='".$commonammenties."', `add_ammenties`='".$add_ammenties."', `details`='".$details."', `rules_doid`='".$ruledo."', `rules_donotid`='".$ruledonot."', `timestampdate`='".date('Y-m-d')."', `saftyid`='".$safety."', `fire_extinguisher`='".$fire_extinguisher."', `fire_alarm`='".$fire_alaram."', `gas_valve`='".$gas_valve."', `exit_extinguisher`='".$emergency."',`capacity`='".$capacity."',`user_id`='".$_SESSION['u_id']."',`areatype`='".$areatype."' where place_id='".$pid."'" );
//echo $_SESSION['placeids']=mysqli_insert_id($connect);
echo ',,,'; 
if($sql>0){
  echo "success";
}
else{
  echo "error";
}
}

}//if isset

//del pic from list places edit
if(isset($_REQUEST['delpic'])=='el_del'){
     $pid=$_REQUEST['pid'];
      $pg=$_REQUEST['pg'];

      $allpics=explode(',', $pg);
    
      array_splice($allpics,$pid,1);
      
      $newpg=implode(',',$allpics);
      $newpg;
     $plid=$_REQUEST['plid'];
     //echo 'UPDATE `place` SET `photo`="'.$newpg.'" where place_id="'.$plid.'"';
        $query1=mysqli_query($connect,'UPDATE `place` SET `photo`="'.$newpg.'" where place_id="'.$plid.'"');
        if($query1>0){
          echo 'success';                  
                      }else{
          echo 'error';
                      }
}//isset


//del pic from list places edit
if(isset($_REQUEST['sdelpic'])=='el_del'){
     $pid=$_REQUEST['pid'];
      $pg=$_REQUEST['pg'];

      $allpics=explode(',', $pg);
    
      array_splice($allpics,$pid,1);
      
      $newpg=implode(',',$allpics);
      $newpg;
     $plid=$_REQUEST['plid'];
     //echo 'UPDATE `place` SET `photo`="'.$newpg.'" where place_id="'.$plid.'"';
        $query1=mysqli_query($connect,'UPDATE `services` SET `photo`="'.$newpg.'" where sid="'.$plid.'"');
        if($query1>0){
          echo 'success';                  
                      }else{
          echo 'error';
                      }
}//isset


//del video from list places edit
if(isset($_REQUEST['delvideo'])=='vdel'){
      $pid=$_REQUEST['vpid'];
      $pg1=$_REQUEST['vpg1'];
      $pg2=$_REQUEST['vpg2'];

      $allvideos=explode(',', $pg1);
      array_splice($allvideos,$pid,1);
      "<br>newpg". $newpg=implode(',',$allvideos);

             $allvideostype=explode(',', $pg2);
      array_splice($allvideostype,$pid,1);
      "<br>newpg1". $newpg1=implode(',',$allvideostype);
  
     $plid=$_REQUEST['vplid'];
     //echo 'UPDATE `place` SET `video`="'.$newpg.'" and video_type="'.$newpg1.'" where place_id="'.$plid.'"';
        $query1=mysqli_query($connect,'UPDATE `place` SET `video`="'.$newpg.'" where place_id="'.$plid.'"');
        $query2=mysqli_query($connect,'UPDATE `place` SET  video_type="'.$newpg1.'" where place_id="'.$plid.'"');
        if($query1>0){
          echo 'success';                  
                      }else{
          echo 'error';
                      }
}//isset


//del video from list services edit
if(isset($_REQUEST['sdelvideo'])=='vdel'){
      $pid=$_REQUEST['vpid'];
      $pg1=$_REQUEST['vpg1'];
      $pg2=$_REQUEST['vpg2'];

      $allvideos=explode(',', $pg1);
      array_splice($allvideos,$pid,1);
      "<br>newpg". $newpg=implode(',',$allvideos);

             $allvideostype=explode(',', $pg2);
      array_splice($allvideostype,$pid,1);
      "<br>newpg1". $newpg1=implode(',',$allvideostype);
  
     $plid=$_REQUEST['vplid'];
     //echo 'UPDATE `place` SET `video`="'.$newpg.'" and video_type="'.$newpg1.'" where place_id="'.$plid.'"';
        $query1=mysqli_query($connect,'UPDATE `services` SET `video`="'.$newpg.'" where sid="'.$plid.'"');
        $query2=mysqli_query($connect,'UPDATE `services` SET  video_type="'.$newpg1.'" where sid="'.$plid.'"');
        if($query1>0){
          echo 'success';                  
                      }else{
          echo 'error';
                      }
}//isset

//edit places photos
if(isset($_REQUEST['checkgal'])=='addgal'){

     $sid=$_REQUEST['sid'];
      //$pid=$_REQUEST['pid'];
      $pg=$_REQUEST['pg'];
        $filename1=$_FILES['input7']['name'];
         $filetmp1=$_FILES['input7']['tmp_name']; 
       
         
      $inp=implode(',', $filename1);
      if(!empty($pg)){
       $newpg=$pg.",".$inp;
      }else{
       $newpg=$inp;
      }
      for($i=0;$i<count($filename1);$i++){
         $filepath1="../img/products/".$filename1[$i];
      $mv=move_uploaded_file($filetmp1[$i],$filepath1);
}
  if($mv>0){
        $query1=mysqli_query($connection,'UPDATE `products` SET `pgallery`="'.$newpg.'" where prid="'.$sid.'"');
        if($query1>0){
                        echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Product Gallery is update Successfully.</p>
                            </div>';
                      }else{
                        echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Failure!
                                </h4>
                                <p> Failed to update the Product Gallery.</p>
                            </div>';
                      }
  }
     
}//isset

if(isset($_POST['qephoto']))
{
  //echo "working";
      $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );

       $supported_videos = array(
                                              'mp4',
                                              'webm',
                                            );

$placeid=$_POST['placeid1'];
$pg=$_POST['pg'];
$inputphotos = $_FILES['inputphotos']['name'];
$tmpphotos = $_FILES['inputphotos']['tmp_name'];

    
      $inp=implode(',', $inputphotos);
      if(!empty($pg)){
       $newpg=$pg.",".$inp;
      }else{
       $newpg=$inp;
      }

//echo "newpg:".$newpg;

$pg1=$_POST['pg1'];
$pg2=$_POST['pg2'];
$inputvideos = $_FILES['inputvideos']['name'];
$tmpvideos = $_FILES['inputvideos']['tmp_name'];
$types = $_FILES['inputvideos']['type'];
  $inp1=implode(',', $inputvideos);
      if(!empty($pg1)){
       $newpg1=$pg1.",".$inp1;
      }else{
       $newpg1=$inp1;
      }

      $inp2=implode(',', $types);
      if(!empty($pg2)){
       $newpg2=$pg2.",".$inp2;
      }else{
       $newpg2=$inp2;
      }

//echo "<br>newpg1:".$newpg1;
//echo "<br>newpg2:".$newpg2;


  for ($i=0; $i < count($inputphotos) ; $i++)
  { 
    $path = "images/placephotos/".$inputphotos[$i];
    $ext = strtolower(pathinfo($inputphotos[$i], PATHINFO_EXTENSION));
    if (in_array($ext, $supported_image))
            {
              $imageInformation = getimagesize($tmpphotos[$i]);
             $imageWidth = $imageInformation[0]; //Contains the Width of the Image
             $imageHeight = $imageInformation[1]; //Contains the Height of the Image
              if($imageWidth >= '700' && $imageHeight >='500' )
              {
                $photos .= $inputphotos[$i].",";
                move_uploaded_file($tmpphotos[$i], $path);
              }
              else
              {
                  $err_msg = $inputphotos[$i];
              } 
      }
  }
  $photos=rtrim($photos,",");

  for ($j=0; $j < count($inputvideos); $j++)
  { 
    $path1 = "video/".$inputvideos[$j];
    $ext1 = strtolower(pathinfo($inputvideos[$j], PATHINFO_EXTENSION));
    if (in_array($ext1, $supported_videos))
          {
        $videos .=$inputvideos[$j].",";
        $type .= $types[$j].',';
        move_uploaded_file($tmpvideos[$j], $path1);
      }
  }
$videos=rtrim($videos,",");
$videotype=rtrim($type,",");
//echo 'update place set photo="'.$newpg.'" , video="'.$newpg1.'" , video_type="'.$newpg2.'" where place_id="'.$placeid.'"';
if($err_msg=='')
{
$query=mysqli_query($connect,'update place set photo="'.$newpg.'" , video="'.$newpg1.'" , video_type="'.$newpg2.'" where place_id="'.$placeid.'"');
if($query>0){
  echo "success";
  echo">>>";
}
else
{
  echo "error";
  echo">>>";
}
}
else
{
  echo"wrong_exe";  
   echo">>>";
  echo $err_msg;}
}//isset photo

//update place price

if(isset($_POST['qeprice_place']))
{
$placeid=$_POST['placeid'];
$currency = $_POST['currency'];
$p_p_n = $_POST['p_p_n'];
$p_p_h = $_POST['p_p_h'];
$w_p_p_n = $_POST['w_p_p_n'];
//$query=mysqli_query($connect,'update place set  currency="'.$currency.'" , p_p_n="'.$p_p_n.'", p_p_h="'.$p_p_h.'", w_p_p_n="'.$w_p_p_n.'" where place_id="'.$placeid.'"');
    
$query=mysqli_query($connect,'update `place` set `currency`="'.$currency.'" , `p_p_n`="'.$p_p_n.'", `p_p_h`="'.$p_p_h.'", `w_p_p_n`="'.$w_p_p_n.'" where `place_id`='.$placeid.'');
    
    
if($query>0){
  echo"success";
  }
  else
  {
echo"not";
  }
}
//end here

//calender data price
if(isset($_GET['calneder_id']))
{
  $cal = $_GET['calneder_id'];
  $ppn = $_GET['cal_ppn'];
  $pph = $_GET['cal_pph'];
  $wppn = $_GET['cal_wppn'];
  $sql = mysqli_query($connect,"UPDATE calenderdata SET p_p_n='".$ppn."',p_p_h='".$pph."',w_p_p_n='".$wppn."' WHERE calid='".$cal."'");
  if($sql>0)
  {
  echo "ok";
  }
  else
  {
      echo "not";
  }
}
//end here
//service data price
if(isset($_GET['calneder_id1']))
{
  $cal = $_GET['calneder_id1'];
  $ppn = $_GET['cal_ppn'];
  $pph = $_GET['cal_pph'];
  $wppn = $_GET['cal_wppn'];
  $sql = mysqli_query($connect,"UPDATE servicedata SET ppn='".$ppn."',pph='".$pph."',ppw='".$wppn."' WHERE sdid='".$cal."'");
  if($sql>0)
  {
  echo "ok";
  }
  else
  {
      echo "not";
  }
}
//end here

//calender data delete here
if(isset($_GET['deletecalneder_id']))
{
  $val = $_GET['deletecalneder_id'];
  $sql = mysqli_query($connect,"DELETE FROM calenderdata WHERE calid='".$val."'");
  if($sql>0)
  {
echo"ok";
  }
  else
  {
    echo"not";
  }
}
//end here

//calender data delete here
if(isset($_GET['deletecalneder_id1']))
{
  $val = $_GET['deletecalneder_id1'];
  $sql = mysqli_query($connect,"DELETE FROM servicedata WHERE sdid='".$val."'");
  if($sql>0)
  {
echo"ok";
  }
  else
  {
    echo"not";
  }
}
//end here
?>
