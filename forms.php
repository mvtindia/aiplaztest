<?php
session_start();
include_once('connect.php');


if(isset($_REQUEST['place_id']))
{
	$placeid = $_REQUEST['place_id'];
	$start_date = date('Y-m-d',strtotime($_REQUEST['checkin']));
	$end_date = date('Y-m-d',strtotime($_REQUEST['checkout']));
	$q = mysqli_query($connect,"select * from place where place_id=".$placeid);
	$r = mysqli_fetch_array($q);
	$start    = new DateTime($start_date);
	$end      = new DateTime($end_date);
	$interval = new DateInterval('P1D'); // 1 day interval
	$period   = new DatePeriod($start, $interval, $end);
	foreach ($period as $day) {
	    // Do stuff with each $day...
	    $days .= $day->format('Y-m-d').',';
	}
	 $days.$end_date;
}

// compose msg start

if(isset($_REQUEST['composing']))
{
	$message = htmlentities($_REQUEST['message']);

	$count = 0;

	$today = date('Y-m-d h:s:i');

	foreach ($_REQUEST['tos'] as $value) {
		$q = mysqli_query($connect,'INSERT INTO `messages`(`mto`, `mfrom`, `msg`, `tostatus`, `fromstatus`, `mtimestamp`) VALUES ("'.$value.'","'.$_SESSION['u_id'].'","'.$message.'","0","0","'.$today.'")');
		$count++;
	}

	if($count == 0)
	{
		echo 'fail';
	}
	else
	{
		echo 'sent';
	}


}

// compose msg end

// reply msg start

if(isset($_REQUEST['replying']))
{
	$message = htmlentities($_REQUEST['reply_msg']);

	$value = $_REQUEST['to_msg'];

	$today = date('Y-m-d h:s:i');

		$q = mysqli_query($connect,'INSERT INTO `messages`(`mto`, `mfrom`, `msg`, `tostatus`, `fromstatus`, `mtimestamp`) VALUES ("'.$value.'","'.$_SESSION['u_id'].'","'.$message.'","0","0","'.$today.'")');
		if($q)
		{
			echo 'msg sent';
		}
		else
		{
			echo 'msg fail';
		}
}

// reply msg end

// unread msg start

	if(isset($_REQUEST['message_id']))
	{
		$mid = $_REQUEST['message_id'];

		$q = mysqli_query($connect,"update messages set mstatus='Y' where mid=".$mid);
	}

// unread msg end


	
	if(isset($_REQUEST['book_now']))
	{
    if(isset($_SESSION['u_id']))
    {   
        $sql = mysqli_query($connect,"SELECT * FROM users WHERE uid='".$_SESSION['u_id']."' ");
        $row= mysqli_fetch_array($sql);
        if($_REQUEST['hours']=="")
        {
          $hours=0;
        }
        else
        {
            $hours = $_REQUEST['hours'];
        }
		    $package = $_REQUEST['package'];
		    $price = $_REQUEST['price'];
		    $checkin = date('Y-m-d', strtotime($_REQUEST['checkin']));
        if($_REQUEST['checkout']=="")
        {
           $checkout = date('Y-m-d', strtotime($_REQUEST['checkin']));
        }
        else
        {
          $checkout = date('Y-m-d', strtotime($_REQUEST['checkout'])); 
        }
		   
		    $placeid = $_REQUEST['myplaceid'];
		    $guests = $_REQUEST['guests'];
		    $totalprice = $_REQUEST['totalprice'];
        $sql = mysqli_query($connect,"SELECT * FROM  `booking` WHERE`placeid`='".$placeid."' and `userid`='".$_SESSION['u_id']."'and `price`='".$price."'and`checkin`='".$checkin."'and `checkout`='".$checkout."'and`hours`='".$hours."'and`guests`='".$guests."'");
        if(mysqli_num_rows($sql)>0)
        {
          echo "Already";
        }
        else
        {
		    $q = mysqli_query($connect,"INSERT INTO `booking`(`placeid`, `userid`, `package`, `price`, `checkin`, `checkout`, `hours`, `guests`, `online`, `hotel`) VALUES ('".$placeid."','".$_SESSION['u_id']."','".$package."','".$price."','".$checkin."','".$checkout."','".$hours."','".$guests."','".$totalprice."','".$totalprice."')");
		$last_id = $connect->insert_id;
    if($q)
    {
     if($row['a_status']=="1")
    {    

          $sql4 = mysqli_query($connect,"SELECT * FROM place WHERE place_id='".$placeid."'");
          $row4 = mysqli_fetch_array($sql4);
         
          $message ="Dear ".$row['fname']." ".$row['lname'].", You have Received this mail from Bookmyspace. \n\n Your Booking Request for".$row4['space_name']." has Been Generated\n\n";

      $headers = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail = mail($row['email'], 'Bookmyspace [Booking Info]', $message, $headers);
   $sql5 = mysqli_query($connect,"SELECT * FROM users WHERE uid='".$row4['user_id']."'");
          $row5 = mysqli_fetch_array($sql5);
            $message2 ="Dear ".$row5['fname']." ".$row5['lname'].", You have Received this mail from Bookmyspace. \n\n Your Place ".$row4['space_name']." has Been Booked by ".$row['fname']." ".$row['lname']."\n\n";

      $headers2 = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail2 = mail($row5['email'], 'Bookmyspace [Booking Info]]', $message2, $headers2);
      echo "ok";
      echo ">>>";
      echo $last_id;
      // echo "<script> window.location.href='booking-form.php?booking_id=".$last_id."';</script>";
    }
  else
  {
    $encrypt=md5($row['email'].time());
     $sql3 = mysqli_query($connect,"UPDATE   users SET activation_link='".$encrypt."' WHERE uid='".$_SESSION['u_id']."'");
   $message ="Dear ".$row['fname']." ".$row['lname'].", You have Received this mail from Bookmyspace. \n\n Your Request has been Generated. Click on the following Link to Confirm Your Booking \n\n.'http://vismaadlabs.org/bookmyspace/forms.php?activatelink=".$encrypt."&bookid=".$last_id."'\n\n";

      $headers = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail = mail($row['email'], 'Bookmyspace [Sent Enquiry]', $message, $headers);
      echo"not_activate";
  }
    }
    else
    { 
    echo"not_inserted";
    }
  }
	     }
  else
  {
    echo"not_login";
  }
}



//booking according to time strat here

  if(isset($_REQUEST['book_now_hour']))
  {
    if(isset($_SESSION['u_id']))
    {   

        $sql = mysqli_query($connect,"SELECT * FROM users WHERE uid='".$_SESSION['u_id']."' ");
        $row= mysqli_fetch_array($sql);
        if($_REQUEST['hours']=="")
        {
          $hours=0;
        }
        else
        {
            $hours = $_REQUEST['hours'];
        }
        $start_time = $_REQUEST['time1'];
        $start_time12 = $_REQUEST['time1'];
        $end_time = $_REQUEST['time2'];
        $strStart = '2013-06-19 '.$start_time; 
        $strEnd   = '06/19/13 '.$end_time; 
        $dteStart = new DateTime($strStart); 
        $dteEnd   = new DateTime($strEnd); 
        $dteDiff  = $dteStart->diff($dteEnd);
       $counter = $dteDiff->format("%H");
       $time_array= $start_time;
       for($i=0;$i<$counter;$i++)
       {
              $dateTime = date_create_from_format('H:i',$start_time);
              date_add($dateTime, date_interval_create_from_date_string('1 hour'));
              $start_time = date_format($dateTime, 'H:i');
              $time_array = $time_array.$start_time.",";
       }
       $time_array = rtrim($time_array,',');
       $time_array = explode(',',$time_array);
        $package = $_REQUEST['package'];
        $price = $_REQUEST['price'];
        $checkin = date('Y-m-d', strtotime($_REQUEST['checkin']));
        if($_REQUEST['checkout']=="")
        {
           $checkout = date('Y-m-d', strtotime($_REQUEST['checkin']));
        }
        else
        {
          $checkout = date('Y-m-d', strtotime($_REQUEST['checkout'])); 
        }
       
        $placeid = $_REQUEST['myplaceid'];
        $guests = $_REQUEST['guests'];
        $totalprice = $_REQUEST['totalprice'];
        $query_status="0";
        $sql = mysqli_query($connect,"SELECT * FROM  `booking` WHERE`placeid`='".$placeid."' and `userid`='".$_SESSION['u_id']."'and `checkin`='".$checkin."'and `checkout`='".$checkout."'");
        if(mysqli_num_rows($sql)>0)
        {
          while($row2 = mysqli_fetch_array($sql))
          {
              if($row2['hours']=='0')
              {
                echo "Already";
                break;
              }
              else
              { 
                $ftime=$row2['ftime'];
                $ltime = $row2['ltime'];
                if(($ftime=="")||($ltime==""))
                {
                  continue;
                }
                $fStart = '2013-06-19 '.$ftime; 
                $lEnd   = '06/19/13 '.$ltime; 
                $dteStart = new DateTime($fStart); 
                $dteEnd   = new DateTime($lEnd); 
                $dteDiff2  = $dteStart->diff($dteEnd);
                $counter2 = $dteDiff2->format("%H");
                $time_array2= $ftime;
                for($i=0;$i<$counter2;$i++)
                {
                    $dateTime = date_create_from_format('H:i',$ftime);
                    date_add($dateTime, date_interval_create_from_date_string('1 hour'));
                    $ftime = date_format($dateTime, 'H:i');
                    $time_array2 = $time_array2.$ftime.",";
                }
                $time_array2 = rtrim($time_array2,',');
                $time_array2 = explode(',',$time_array2);
                for($j=0;$j<count($time_array);$j++)
                {
                  if(in_array($time_array[$j],$time_array2))
                  {
                    $query_status="1";
                  }
                }
              }
          }
        }
        else
        {
            $query_status="0";
        }
        //start 
        if($query_status=="0")
        {
    $q = mysqli_query($connect,"INSERT INTO `booking`(`placeid`, `userid`, `package`, `price`, `checkin`, `checkout`, `hours`, `guests`, `online`, `hotel`,`ftime`,`ltime`) VALUES ('".$placeid."','".$_SESSION['u_id']."','".$package."','".$price."','".$checkin."','".$checkout."','".$hours."','".$guests."','".$totalprice."','".$totalprice."','".$start_time12."','".$end_time."')");
    $last_id = $connect->insert_id;
    if($q)
    {
     if($row['a_status']=="1")
    {    

          $sql4 = mysqli_query($connect,"SELECT * FROM place WHERE place_id='".$placeid."'");
          $row4 = mysqli_fetch_array($sql4);
          $message ="Dear ".$row['fname']." ".$row['lname'].", You have Received this mail from Bookmyspace. \n\n Your Booking Request for".$row4['space_name']." has Been Generated\n\n";

      $headers = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail = mail($row['email'], 'Bookmyspace [Booking Info]', $message, $headers);
   $sql5 = mysqli_query($connect,"SELECT * FROM users WHERE uid='".$row4['user_id']."'");
          $row5 = mysqli_fetch_array($sql5);
            $message2 ="Dear ".$row5['fname']." ".$row5['lname'].", You have Received this mail from Bookmyspace. \n\n Your Place ".$row4['space_name']." has Been Booked by ".$row['fname']." ".$row['lname']."\n\n";

      $headers2 = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail2 = mail($row5['email'], 'Bookmyspace [Booking Info]]', $message2, $headers2);
      echo "ok";
      echo ">>>";
      echo $last_id;
      // echo "<script> window.location.href='booking-form.php?booking_id=".$last_id."';</script>";
    }
  else
  {
    $encrypt=md5($row['email'].time());
     $sql3 = mysqli_query($connect,"UPDATE   users SET activation_link='".$encrypt."' WHERE uid='".$_SESSION['u_id']."'");
   $message ="Dear ".$row['fname']." ".$row['lname'].", You have Received this mail from Bookmyspace. \n\n Your Request has been Generated. Click on the following Link to Confirm Your Booking \n\n.'http://vismaadlabs.org/bookmyspace/forms.php?activatelink=".$encrypt."&bookid=".$last_id."'\n\n";

      $headers = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail = mail($row['email'], 'Bookmyspace [Sent Enquiry]', $message, $headers);
      echo"not_activate";
  }
    }
    else
    { 
    echo"not_inserted";
    }
        //end
        }
        else
        {
           echo "Already";
        }

       }
  else
  {
    echo"not_login";
  }
}

//end here


//activation Start HEre

if((isset($_GET['activatelink']))&&(isset($_GET['bookid'])))
{
  $activation= $_GET['activatelink'];
  $bookid= $_GET['bookid'];
  $sql = mysqli_query($connect,"SELECT * FROM booking WHERE bookid='".$bookid."'");
  $row = mysqli_fetch_array($sql);
  $sql2 = mysqli_query($connect,"SELECT * FROM  users WHERE activation_link='".$activation."' and uid='".$row['userid']."' and a_status='0'");
  if(mysqli_num_rows($sql2)>0)
  {
    $sql3 = mysqli_query($connect,"UPDATE users SET a_status='1' WHERE uid='".$row['userid']."'");
   header('location:booking-form.php?booking_id='.$bookid.'');
  }
  else
  {
     header('location:index.php');
  }
}

// End Here

// booking messsges Sent HERe
if(isset($_POST['book_messagess']))
{
$to = $_POST['to_msg'];
$msg = $_POST['message'];
$place = $_POST['place_id'];
$today = date('Y-m-d h:s:i');
$sql =   mysqli_query($connect,'INSERT INTO `messages`(`mto`, `mfrom`, `msg`, `tostatus`, `fromstatus`, `mtimestamp`) VALUES ("'.$to.'","'.$_SESSION['u_id'].'","'.$msg.'","0","0","'.$today.'")');
if($sql)
{
echo"ok";
echo">>>";
echo$place;
}
else
{
echo"not";
}
}
//booking message end here


//paypal insertion Start HERE
if(isset($_GET['paypal_insertion']))
{
  $book_id = $_GET['paypal_insertion'];
  $payment_status="0";
  $payment = $_GET['amount'];
  $date =  date('Y-m- d h:s:i'); 
  $sql2 = mysqli_query($connect,"SELECT * FROM paypal WHERE amount='".$amount."' and time='".$date."' and book_id='".$book_id."'");
  if(mysqli_num_rows($sql2)>0)
  {
     $row2 = mysqli_fetch_array($sql2);
     if($row2['status']=='0')
     {
      echo"fine_ok";
     }
     else
     {
       echo "not_done";
     }
  } 
  else
  {
     
  $sql = mysqli_query($connect,"INSERT INTO paypal(`amount`,`status`,`time`,`book_id`) VALUES('".$payment."','".$payment_status."','".$date."','".$book_id."')");
  if($sql)
  {
echo"ok";
  }
  else
  {
echo"not";
  } 
  }

}
//paypal insertion ENd HERE
	// booking form 2 start

	if(isset($_REQUEST['booking']))
	{
		 $method = $_REQUEST['method'];
		 $booking_id = $_REQUEST['booking_id'];
		 'hello';

		$q = mysqli_query($connect,"update booking set method='".$method."' where bookid=".$booking_id);
		if($q)
		{
			header('location:index.php');
		}
	}

// calender data
	if(isset($_REQUEST['label']))
  {
  $place = $_REQUEST['placeid_cal'];
    if($place=="")
    {
     $place_id = $_SESSION['placeids'];
    }
    else
    {
      $place_id = $place;
    }
 $label=$_REQUEST['label'];

  $datefirst=date('Y-m-d',strtotime($_REQUEST['datefirst']));

  $datelast=date('Y-m-d',strtotime($_REQUEST['datelast']));

 $status=$_REQUEST['status'];
 // $pdate2=$_REQUEST['pdate2'];
 // $ptime1=$_REQUEST['ptime1'];
 // $ptime2=$_REQUEST['ptime2'];
 //$repetition=$_REQUEST['repetition'];
 // $repetition='';
 $pph=$_REQUEST['pph'];
 $ppn=$_REQUEST['ppn'];
 $ppw=$_REQUEST['ppw'];

$days1 = "";
     

      $st1    = new DateTime($datefirst);
      $et1    = new DateTime($datelast);
      $in1 = new DateInterval('P1D'); // 1 day interval
      $per1   = new DatePeriod($st1, $in1, $et1);
      foreach ($per1 as $day) 
      {
            // Do stuff with each $day...
           $days1 .= $day->format('Y-m-d').',';
      }    
     $days1 = $days1.$datelast;

       $chinout = explode(',',$days1);

    $que = mysqli_query($connect,"select * from calenderdata where placeid='".$place_id."'");
      while($rw = mysqli_fetch_array($que))
      {
         
        $days="";
        $newdays = "";
        $start    = new DateTime($rw['date1']);
        $end_date = $rw['date2'];
        $end      = new DateTime($rw['date2']);
        $interval = new DateInterval('P1D'); // 1 day interval
        $period   = new DatePeriod($start, $interval, $end);
        foreach ($period as $day) {
            // Do stuff with each $day...
           $days .= $day->format('Y-m-d').',';
        }    
        $days = $days.$end_date.'<br>';

        $newdays = explode('<br>', $days);

        foreach ($newdays as $range) {
          $ranges = explode(',',$range);
         
          
          for($ik = 0 ; $ik<count($chinout); $ik++)
          { 
           	 $chinout[$ik];
            if(in_array($chinout[$ik], $ranges))
            {
             
             
					$msg="Exist";                          
               
               // if counting end
                          } // if in array end
          } // ik for end
        } // $range foreach end

      }

    
 //echo 'INSERT INTO `calenderdata`( `placeid`, `p_p_n`, `p_p_h`, `w_p_p_n`, `date1`, `date2`, `label`, `status`, `time1`, `time2`, `repetition`, `ctimestampdate`) values("'.$_SESSION['placeids'].'","'.$ppn.'","'.$pph.'","'.$wppn.'","'.$pdate1.'","'.$pdate2.'" ,"'.$plabel.'" ,"'.$pstatus.'", "'.$ptime1.'" ,"'.$ptime2.'","'.$repetition.'" , "'.$curdate.'")';

$curdate=date('Y-m-d');
	if($msg == "")
	{
 $query=mysqli_query($connect,'INSERT INTO `calenderdata`( `placeid`, `p_p_n`, `p_p_h`, `w_p_p_n`, `date1`, `date2`, `label`, `status`,  `ctimestampdate`) values("'.$place_id.'","'.$ppn.'","'.$pph.'","'.$ppw.'","'.$datefirst.'","'.$datelast.'" ,"'.$label.'" ,"'.$status.'" , "'.$curdate.'")');

if($query>0){
   echo "ok";
}else{
   echo "not";
}
}
else
{
	echo "Already";
}
}

//add services
if(isset($_POST['saveservice']))
{
$btitle = $_POST['btitle'];
$location = $_POST['location'];
$events ="";
for($i=0;$i<count($_POST['events']);$i++)
{
  $events .= $_POST['events'][$i].",";
}
$events = rtrim($events,",");

$cat = $_POST['cat'];
for($i=0;$i<count($_POST['cat']);$i++)
{
  $cat .= $_POST['cat'][$i].",";
}
$cat = rtrim($cat,",");

$contact = $_POST['contact'];
$description = $_POST['description'];

$city = $_POST['city'];
$postcode = $_POST['postcode'];$
$state = $_POST['state'];
$country = $_POST['country'];

$currency = $_POST['currency'];
$ppd = $_POST['ppd'];
$pph = $_POST['pph'];
$ppp = $_POST['ppp'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$curdate=date('Y-m-d');

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

$inputvideos = $_FILES['inputvideos']['name'];
$tmpvideos = $_FILES['inputvideos']['tmp_name'];
$types = $_FILES['inputvideos']['type'];

  for ($i=0; $i < count($inputphotos) ; $i++)
  { 
    $path = "images/services/".$inputphotos[$i];
    $ext = strtolower(pathinfo($inputphotos[$i], PATHINFO_EXTENSION));
    if (in_array($ext, $supported_image))
            {
                $imageInformation = getimagesize($tmpphotos[$i]);
             $imageWidth = $imageInformation[0]; //Contains the Width of the Image
             $imageHeight = $imageInformation[1]; //Contains the Height of the Image
              if($imageWidth >= '780' && $imageHeight >='520' )
              {
              $photos .= $inputphotos[$i].",";
              move_uploaded_file($tmpphotos[$i], $path);
              }
              else
              {
                $err_msg=$inputphotos[$i];
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


$sql = mysqli_query($connect,"INSERT INTO `services`(`stitle`,`location`, `seventid`, `scatid`, `scontact`, `sdesc`,`ip`, `city`,  `state`,`postcode`,`country`, `currencyid`, `scurdate`,`rid`,`photo`,`video`,`video_type`) VALUES ('".$btitle."', '".$location."','".$events."', '".$cat."', '".$contact."', '".$description."', '".$_SESSION['ip']."', '".$city."', '".$state."', '".$postcode."', '".$country."', '".$currency."','".$curdate."','".$_SESSION['u_id']."','".$photos."','".$videos."','".$videotype."')");
echo $_SESSION['sid']=mysqli_insert_id($connect);
echo ',,,';
if($err_msg=='')
{
if($sql>0)
{
  echo "success,,,";
  ?>
<form id="serviceform" method="post" enctype="multipart/form-data" >
      
  <div class="tellus-data col-md-12 col-xs-12 col-sm-12 pd-lr-0" ><!--id="calendar-tab"-->
      <div class="had-frm-sec" >Seasonal Pricing & Scheduling</div>

  <div class="frm-field-mar">

        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
 <!-- <div id="calendar">
  
  </div>-->
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
  <div  id="savail" >
  <div class="col-md-12">
  <div class="event empty">
  <input class="form-control "type="text" required id="plabel" placeholder="Give Dates a Label" name="plabel">
  </div></div>
  <div class="col-md-12 mg-top10">
  <div class="col-md-6">
<button class="btn-3 btn-custom2 avail1" style="background: #03DAAB;" type="button" value="Available">Available</button>
  </div><div class="col-md-6">
<button class="btn-3 btn-custom2 avail2" type="button">Not Available</button>
  </div>
  </div>
  <div class="col-md-12 mg-top10" id="priceper">
  <div class="col-md-4">
<input type="text" id="pph" required placeholder="Price Per hour" class="form-control">
  </div>
    <div class="col-md-4">
<input type="text" id="ppw" required placeholder="Price Per Night" class="form-control">
  </div>
    <div class="col-md-4">
<input type="text" id="ppm" required placeholder="Price Per Week" class="form-control">
  </div>
  </div>

  <input type="text" id="status" required value="" hidden>;
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
  <div class="col-md-6"><button class="btn-3 btn-custom2 myset" type="button" name="values">Set</button></div></div></div></div></div>
 <!--  -->

  
  </div>
  
  <div class="col-md-12 text-center">
<button id="sback" type="button" name="place" class="btn btn-default cus-save-but">Back</button>
<!--   <button id="next3" type="submit" name="priceterms" class="btn btn-default cus-save-but">Save</button>
 -->  </div>
  
  
    
  <div class="clearfix"></div>
 
  </div><!--frm-field-mar-->
  
 </div> </div>
  </form>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment-with-langs.min.js"></script>
    <script src="jquery-cal/js/jquery.rangecalendar.js"></script>

    
     <script>
     $(document).ready(function(){
      var customizedRangeCalendar = $("#demo").rangeCalendar({ theme:"full-green-theme", start : "+0",startRangeWidth : 1,


});

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
$('.service1').css('display','none');

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
    //$("#savail")[0].reset();
    var status = $('#status').val();
  var pph = $('#pph').val();
   var ppw = $('#ppw').val();
    var ppm = $('#ppm').val();
   var label =  $('#plabel').val();
   var date1 = $('#datevalue1').val();
   var date2 = $('#datevalue2').val();
   console.log('label1='+label+'&datefirst='+date1+'&datelast='+date2+'&status='+status+'&pph='+pph+'&ppn='+ppw+'&ppw='+ppm);
     $.ajax({
           url: 'forms.php?label1='+label+'&datefirst='+date1+'&datelast='+date2+'&status='+status+'&pph='+pph+'&ppn='+ppw+'&ppw='+ppm,
           contentType: false,
           cache: false,
           processData:false,
           success: function(data, textStatus, jqXHR)
           {    
            console.log(data);
             if(data == 'ok')
             { 
               $('.service1').css('display','none');
               $('#serviceform').find("input[type=text], textarea").val("");
               
               $('#display-form').css('display','none');
              //swal( 'Success!', 'Sucessfully Saved', 'success');
              swal({ title: 'Success', text: 'Sucessfully Saved', timer: 2000 });
              $('#selecteddates').load(window.location + ' #selecteddates');
              // $('.comment-main').load(window.location + ' .comment-main');
               $('.month-cell').removeClass('selected');
              $('.selected').append( "<p style='    padding: 1px 2px 1px 2px;color: rgb(3, 218, 171); background:rgb(205, 87, 87); font-size: 13px;  margin: 11px -9px; display: inline-block;'>"+label+"</p>" );
              $('.start').addClass('last');
           
             }
             else
             { 
              $('#selecteddates').load(window.location + ' #selecteddates');
               //swal( 'Oops!', 'This Date Range Already Booked', 'error');
               swal({ title: 'Error', text: 'This Date Range is not Available', timer: 2000 });
             }      
           },
      });
});
  }); 
   </script>

  <?php
}
else
{
  echo "error,,,";
}
}
else
{
  echo"wrong_exe,,,";
  echo $err_msg;
}


}//if isset

// services data

// calender data
  if(isset($_REQUEST['label1']))
  {
     $label .=$_REQUEST['label1'];
       $place = $_REQUEST['placeid_cal'];
    if($place=="")
    {
      $place_id = $_SESSION['sid'];
    }
    else
    {
      $place_id = $place;
    }
  $label=$_REQUEST['label'];

  $datefirst=date('Y-m-d',strtotime($_REQUEST['datefirst']));

  $datelast=date('Y-m-d',strtotime($_REQUEST['datelast']));

 $status=$_REQUEST['status'];
 // $pdate2=$_REQUEST['pdate2'];
 // $ptime1=$_REQUEST['ptime1'];
 // $ptime2=$_REQUEST['ptime2'];
 //$repetition=$_REQUEST['repetition'];
 // $repetition='';
 $pph=$_REQUEST['pph'];
 $ppn=$_REQUEST['ppn'];
 $ppw=$_REQUEST['ppw'];

$days1 = "";
     

      $st1    = new DateTime($datefirst);
      $et1    = new DateTime($datelast);
      $in1 = new DateInterval('P1D'); // 1 day interval
      $per1   = new DatePeriod($st1, $in1, $et1);
      foreach ($per1 as $day) 
      {
            // Do stuff with each $day...
           $days1 .= $day->format('Y-m-d').',';
      }    
     $days1 = $days1.$datelast;

       $chinout = explode(',',$days1);

    $que = mysqli_query($connect,"select * from servicedata where sid='".$place_id."'");
      while($rw = mysqli_fetch_array($que))
      {
         
        $days="";
        $newdays = "";
        $start    = new DateTime($rw['date1']);
        $end_date = $rw['date2'];
        $end      = new DateTime($rw['date2']);
        $interval = new DateInterval('P1D'); // 1 day interval
        $period   = new DatePeriod($start, $interval, $end);
        foreach ($period as $day) {
            // Do stuff with each $day...
           $days .= $day->format('Y-m-d').',';
        }    
        $days = $days.$end_date.'<br>';

        $newdays = explode('<br>', $days);

        foreach ($newdays as $range) {
          $ranges = explode(',',$range);
         
          
          for($ik = 0 ; $ik<count($chinout); $ik++)
          { 
             $chinout[$ik];
            if(in_array($chinout[$ik], $ranges))
            {
             
             
          $msg="Exist";                          
               
               // if counting end
                          } // if in array end
          } // ik for end
        } // $range foreach end

      }

    
 //echo 'INSERT INTO `calenderdata`( `placeid`, `p_p_n`, `p_p_h`, `w_p_p_n`, `date1`, `date2`, `label`, `status`, `time1`, `time2`, `repetition`, `ctimestampdate`) values("'.$_SESSION['placeids'].'","'.$ppn.'","'.$pph.'","'.$wppn.'","'.$pdate1.'","'.$pdate2.'" ,"'.$plabel.'" ,"'.$pstatus.'", "'.$ptime1.'" ,"'.$ptime2.'","'.$repetition.'" , "'.$curdate.'")';

$curdate=date('Y-m-d');
  if($msg == "")
  {
 $query=mysqli_query($connect,'INSERT INTO `servicedata` (`ppn`, `pph`, `ppw`, `label`, `status`, `scurdate`, `date1`, `date2`,`sid`) VALUES("'.$ppn.'","'.$pph.'","'.$ppw.'","'.$label.'","'.$status.'","'.$cdate.'","'.$datefirst.'","'.$datelast.'", "'.$place_id.'")');

if($query>0){
   echo "ok";
}else{
   echo "not";
}
}
else
{
  echo "Already";
}
}


// if(isset($_REQUEST['label1']))
// {
//  $label .=$_REQUEST['label1'];
// $sid = $_REQUEST['placeid_cal'];
// if($sid=="")
// {
//  $s_id = $_SESSION['sid'];
// }
// else
// {
// $s_id = $sid;
// }
//   $datefirst=date('Y-m-d',strtotime($_REQUEST['datefirst']));

//   $datelast=date('Y-m-d',strtotime($_REQUEST['datelast']));

//  $status=$_REQUEST['status'];
//  // $pdate2=$_REQUEST['pdate2'];
//  // $ptime1=$_REQUEST['ptime1'];
//  // $ptime2=$_REQUEST['ptime2'];
//  //$repetition=$_REQUEST['repetition'];
//  // $repetition='';
//  $pph=$_REQUEST['pph'];
//  $ppn=$_REQUEST['ppn'];
//  $ppw=$_REQUEST['ppw'];

// $days1 = "";
     

//       $st1    = new DateTime($datefirst);
//       $et1    = new DateTime($datelast);
//       $in1 = new DateInterval('P1D'); // 1 day interval
//       $per1   = new DatePeriod($st1, $in1, $et1);
//       foreach ($per1 as $day) 
//       {
//             // Do stuff with each $day...
//            $days1 .= $day->format('Y-m-d').',';
//       }    
//      $days1 = $days1.$datelast;

//        $chinout = explode(',',$days1);

//     $que = mysqli_query($connect,"select * from servicedata where sid='".$s_id."'");
//       while($rw = mysqli_fetch_array($que))
//       {
         
//         $days="";
//         $newdays = "";
//         $start    = new DateTime($rw['date1']);
//         $end_date = $rw['date2'];
//         $end      = new DateTime($rw['date2']);
//         $interval = new DateInterval('P1D'); // 1 day interval
//         $period   = new DatePeriod($start, $interval, $end);
//         foreach ($period as $day) {
//             // Do stuff with each $day...
//            $days .= $day->format('Y-m-d').',';
//         }    
//         $days = $days.$end_date.'<br>';

//         $newdays = explode('<br>', $days);

//         foreach ($newdays as $range) {
//           $ranges = explode(',',$range);
         
          
//           for($ik = 0 ; $ik<count($chinout); $ik++)
//           { 
//            	 $chinout[$ik];
//             if(in_array($chinout[$ik], $ranges))
//             {
             
             
// 					$msg="Exist";                          
               
//                // if counting end
//                           } // if in array end
//           } // ik for end
//         } // $range foreach end

//       }

// 	if($msg == "")
// 	{
// 		$cdate=date('Y-m-d');

//  $query=mysqli_query($connect,'INSERT INTO `servicedata` (`ppn`, `pph`, `ppw`, `label`, `status`, `scurdate`, `date1`, `date2`,`sid`) VALUES("'.$ppn.'","'.$pph.'","'.$ppw.'","'.$label.'","'.$status.'","'.$cdate.'","'.$datefirst.'","'.$datelast.'", "'.$sid.'")');

// if($query>0){
//    //$fullpath=$ppath."?osid=".$_SESSION['sid']."&amd=success#calender-tab";
//    echo "ok";
// }else{
//    //$fullpath=$ppath."?osid=".$_SESSION['sid']."&amd=error#calender-tab";
//    echo "not";
// }
// }
// else
// {
// 	echo "Already";
// }
// }


//send enquiry
  if(isset($_REQUEST['senquiry']))
  {
    $canbe = $_REQUEST['canbe'];
    for ($i=0; $i <count($canbe) ; $i++) { 
      $events .= $canbe[$i].",";
    }
    $events = rtrim("$events",",");
    $date1 = date('Y-m-d', strtotime($_REQUEST['date1']));
    $nguest = $_REQUEST['nguest'];
    $ebudget = $_REQUEST['ebudget'];
    $ename = $_REQUEST['ename'];
    $eemail = $_REQUEST['eemail'];
    $emobile = $_REQUEST['emobile'];
    $edetails = $_REQUEST['edetails'];
    $serviceid = $_REQUEST['serviceid'];
if(isset($_SESSION['u_id']))
{
  $uid=$_SESSION['u_id'];
}
    $q = mysqli_query($connect,"INSERT INTO `enquiry`( `eventsid`, `date1`, `ebudget`, `nguest`, `ename`, `eemail`, `emobile`, `edetails`, `serviceid`, `uid`) VALUES ('".$events."','".$date1."','".$ebudget."','".$nguest."','".$ename."','".$eemail."','".$emobile."','".$edetails."','".$serviceid."','".$uid."')");
    if($q>0){
      echo "success";

      $message ="Dear ".$ename.", You have Received this mail from Bookmyspace. \n\n Your Enquiry has been sent successfully. Soon We will come to you. \n\n";

      $headers = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail = mail($eemail, 'Bookmyspace [Sent Enquiry]', $message, $headers);
    }
    else{
      echo "error";
    }
  }

  //cancel booking 

if(isset($_GET['cancel_booking']))
{
  $val = $_GET['cancel_booking'];
  $sql2 = mysqli_query($connect,"SELECT * FROM booking WHERE bookid='".$val."'");
  $row = mysqli_fetch_array($sql2);
  $sql= mysqli_query($connect,"DELETE FROM booking WHERE bookid='".$val."'");
  if($sql)
  {
    $sql4 = mysqli_query($connect,"SELECT * FROM users WHERE uid='".$row['userid']."'");
    $row4 = mysqli_fetch_array($sql4);
    $sql3 = mysqli_query($connect,"SELECT * FROM place WHERE place_id='".$row['placeid']."'");
    $row3 = mysqli_fetch_array($sql3);
//mail sending here
$message ="Dear ".$row4['fname']." ".$row4['lname'].", You have Received this mail from Bookmyspace. \n\n Your Booking Request for".$row3['space_name']." has Been Cancelled\n\n";
      $headers = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail = mail($row4['email'], 'Bookmyspace [Booking Info]', $message, $headers);
   $sql5 = mysqli_query($connect,"SELECT * FROM users WHERE uid='".$row3['user_id']."'");
          $row5 = mysqli_fetch_array($sql5);
            $message2 ="Dear ".$row5['fname']." ".$row5['lname'].", You have Received this mail from Bookmyspace. \n\n Your Place ".$row3['space_name']." has Been Cancelled by ".$row4['fname']." ".$row4['lname']."\n\n";

      $headers2 = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail2 = mail($row5['email'], 'Bookmyspace [Booking Info]]', $message2, $headers2);
      echo "ok";
  $sql= mysqli_query($connect,"DELETE FROM booking WHERE bookid='".$val."'");
  }
  else
  {
    echo"not";
  }
  //end here
}

//book_id cancel

if(isset($_GET['bookid_cancel']))
{
  $val = $_GET['bookid_cancel'];
  $sql2 = mysqli_query($connect,"SELECT * FROM booking WHERE bookid='".$val."'");
  $row = mysqli_fetch_array($sql2);
  $sql= mysqli_query($connect,"DELETE FROM booking WHERE bookid='".$val."'");
  if($sql)
  {
    $sql4 = mysqli_query($connect,"SELECT * FROM users WHERE uid='".$row['userid']."'");
    $row4 = mysqli_fetch_array($sql4);
    $sql3 = mysqli_query($connect,"SELECT * FROM place WHERE place_id='".$row['placeid']."'");
    $row3 = mysqli_fetch_array($sql3);
//mail sending here
$message ="Dear ".$row4['fname']." ".$row4['lname'].", You have Received this mail from Bookmyspace. \n\n Your Booking Request for".$row3['space_name']." has Been Cancelled\n\n";
      $headers = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail = mail($row4['email'], 'Bookmyspace [Booking Info]', $message, $headers);
   $sql5 = mysqli_query($connect,"SELECT * FROM users WHERE uid='".$row3['user_id']."'");
          $row5 = mysqli_fetch_array($sql5);
            $message2 ="Dear ".$row5['fname']." ".$row5['lname'].", You have Received this mail from Bookmyspace. \n\n Your Place ".$row3['space_name']." has Been Cancelled by ".$row4['fname']." ".$row4['lname']."\n\n";

      $headers2 = 'From: no-reply@vismaadlabs.org' . "\r\n" .
          'Reply-To: no-reply@vismaadlabs.org' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
      $mail2 = mail($row5['email'], 'Bookmyspace [Booking Info]]', $message2, $headers2);
      echo "ok";
    //end here
  header('location:paypal_status.php?msg=002');
  }
  else
  {
    header('location:index.php');
  }
}

//end here

//book_id accept here
if(isset($_GET['bookid_success']))
{
  $val = $_GET['bookid_success'];
  $place = $_GET['ser_placeid'];
  $sql= mysqli_query($connect,"UPDATE paypal SET status='1' WHERE book_id='".$val."'");
  if($sql)
  {
  header('location:paypal_status.php?msg=001&place_id='.$place.'');
  }
  else
  {
    header('location:index.php');
  }
}

// end here

//edit service
if(isset($_POST['editservice']))
{
$btitle = $_POST['btitle'];
$location = $_POST['location'];
$events ="";
for($i=0;$i<count($_POST['events']);$i++)
{
  $events .= $_POST['events'][$i].",";
}
$events = rtrim($events,",");

$cat = $_POST['cat'];
for($i=0;$i<count($_POST['cat']);$i++)
{
  $cat .= $_POST['cat'][$i].",";
}
$cat = rtrim($cat,",");

$contact = $_POST['contact'];
$description = $_POST['description'];

$city = $_POST['city'];
$postcode = $_POST['postcode'];$
$state = $_POST['state'];
$country = $_POST['country'];

$currency = $_POST['currency'];
$ppd = $_POST['ppd'];
$pph = $_POST['pph'];
$ppp = $_POST['ppp'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$curdate=date('Y-m-d');

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

$sid=$_REQUEST['sid'];
$inputphotos = $_FILES['inputphotos']['name'];
$tmpphotos = $_FILES['inputphotos']['tmp_name'];

$inputvideos = $_FILES['inputvideos']['name'];
$tmpvideos = $_FILES['inputvideos']['tmp_name'];
$types = $_FILES['inputvideos']['type'];

$sql2 = mysqli_query($connect,"SELECT * FROM  `services` where sid='".$sid."'");
$row2 = mysqli_fetch_array($sql2);
if($row2['photo']=="")
{

}
else
{
$photos=$row2['photo'].","; 
}
if($row2['video']=="")
{

}
else
{
$videos=$row2['video'].","; 
}
  for ($i=0; $i < count($inputphotos) ; $i++)
  { 
    $path = "images/services/".$inputphotos[$i];
    $ext = strtolower(pathinfo($inputphotos[$i], PATHINFO_EXTENSION));
    if (in_array($ext, $supported_image))
            {

                $imageInformation = getimagesize($tmpphotos[$i]);
             $imageWidth = $imageInformation[0]; //Contains the Width of the Image
             $imageHeight = $imageInformation[1]; //Contains the Height of the Image
              if($imageWidth >= '780' && $imageHeight >='520' )
              {
               $photos .= $inputphotos[$i].",";
                move_uploaded_file($tmpphotos[$i], $path);
              }
              else
              {
                $err_msg=$inputphotos[$i];
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


$sql = mysqli_query($connect,"UPDATE `services` set `stitle`='".$btitle."',`location`='".$location."', `seventid`='".$events."', `scatid`='".$cat."', `scontact`='".$contact."', `sdesc`='".$description."',`ip`='".$_SESSION['ip']."', `city`='".$city."',  `state`='".$state."',`postcode`='".$postcode."',`country`='".$country."', `currencyid`='".$currency."',`photo`='".$photos."',`video`='".$videos."',`video_type`='".$videotype."' where sid='".$sid."'");
if($err_msg=="")
{
if($sql>0){
  echo "success";
  echo ">>>";
}
else
{
  echo"error";
  echo">>>";
}
}
else
{
  echo"wrong_exe";
  echo">>>";
  echo $err_msg;

}

}//if isset
?>