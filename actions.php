<?php
session_start();
include_once('connect.php');
//require_once('swift_required.php');
require('lib/SendGrid.php');

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
    $code = md5(uniqid(rand()));  
    $q2 = mysqli_query($connect,'INSERT INTO `users`(`fname`, `lname`, `email`, `pwd`, `contact`, `activation_link`, `a_status`) VALUES ("'.$fname.'","'.$lname.'","'.$email.'","'.$pwd.'","'.$contact.'","'.$code.'",999)');
  
    if($q2)
    {
    
      $id = mysqli_insert_id($connect);
      $key = base64_encode($id);
      $id = $key;
    
      $body = 'Hi ' . $fname . ',

To confirm your 2finda account, simply click on the following link: http://' . $_SERVER['SERVER_NAME'] . '/verify.php?id=' . $id . '&code=' . $code . '

Your 2finda team';

      $url = 'https://api.sendgrid.com/';
      $subject = 'Confirm Registration';
      $user='azure_4389271fb296cc51e6ae084dc9819730@azure.com';
      $pass='Book1234';
      $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => $email,
      'subject' => $subject,
      'html' => $body,
      //'text' => 'I am the text parameter',
      'from' => 'info@2finda.com',
    );
    
    $request = $url.'api/mail.send.json';
    $session = curl_init($request);
    curl_setopt ($session, CURLOPT_POST, true);
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($session);
    curl_close($session);

    echo 'done';
  } else {
    echo 'already';
  }
  } else {
    echo 'already';
  }
  
}

// Add place Start Here
if(isset($_REQUEST['place']))
{
  $name = $_POST['name'];
  $contact = $_POST['contact'];
//$postal = $_POST['postal'];
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
  $supported_image = array(
                                              'jpg',
                                              'jpeg',
                                              'png',
                                              'gif',
                                            );
  $supported_videos = array(
                                              'mp4',
                                              'webm',
                                              'mov',
                                            );
  $inputphotos = $_FILES['inputphotos']['name'];
  $tmpphotos = $_FILES['inputphotos']['tmp_name'];
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
            if($imageWidth >= '100' && $imageHeight >='100' )
            {
                $photos .= $inputphotos[$i].",";
                move_uploaded_file($tmpphotos[$i], $path);
            } else {
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
  if(!isset($_SESSION['u_id']))
  {
    echo "login";
  } else if ($err_msg=='') {
    try {
      error_log("before place insert");
      $sql = mysqli_query($connect,'INSERT INTO `place` ( `p_name`, `p_contact`, `p_location`, `p_address`, `p_country`, `p_city`, `p_code`, `p_state`, `space_name`, `property_typeid`, `can_be_usedid`, `accomodates`, `place_area`, `ammenties_id`, `add_ammenties`, `details`, `photo`, `video`, video_type, `rules_doid`, `rules_donotid`, `timestampdate`, `saftyid`, `fire_extinguisher`, `fire_alarm`, `gas_valve`, `exit_extinguisher`,`capacity`,`user_id`,`areatype`) VALUES ("'.$name.'", "'.$contact.'", "'.$location.'", "'.$address.'","'.$country.'" ,"'.$city.'" ,"'.$postcode.'","'.$state.'", "'.$space_name.'", "'.$property.'", "'.$canbe.'", "'.$accomodates.'", "'.$area.'", "'.$commonammenties.'", "'.$add_ammenties.'", "'.$details.'", "'.$photos.'", "'.$videos.'", "'.$videotype.'", "'.$ruledo.'", "'.$ruledonot.'", "'.date('Y-m-d').'", "'.$safety.'", "'.$fire_extinguisher.'", "'.$fire_alaram.'", "'.$gas_valve.'", "'.$emergency.'","'.$capacity.'", "'.$_SESSION['u_id'].'","'.$areatype.'")');

      if($sql>0){
        echo "success";
      } else {
	      echo "error";
      }
    } catch (Exception $e) {
      error_log("we have a problem");
    }
  } else {
    echo"wrong_exe";  
    echo">>>";
    echo $err_msg;
  }

  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $url = 'https://api.sendgrid.com/';
  $subject = 'Earn money with your listed place on 2finda.com';
  
  $body = 
  "Dear " . $fname . " " . $lname . ",<br><br>
  We’re really happy you’ve joined 2finda.com as a host. So, what do you do now?<br>
  Read our general tips on being a successful host.<br>
  Find out more about staying safe on 2finda.<br>
  The higher your place appears on our result pages, the more likely you are to receive booking requests. To optimise your place visibility, make sure you have:
  <br>- A detailed description
  <br>- A competitive price
  <br>- Great photos
  <br>- An updated calendar<br>
  To update everything and anything, just click here.<br><br>
  Kind regards,<br><br>
  Your 2finda team";

  $user='azure_4389271fb296cc51e6ae084dc9819730@azure.com';
  $pass='Book1234';
/*$json_string = array(
  'to' => array($email, 'info@2finda.com'), 'category' => 'test_category'
);*/
  $json_string = array(
    'to' => array($email), 'category' => 'test_category'
  );
  $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      //'x-smtpapi' => json_encode($json_string),
      'to' => $email,
      'subject' => $subject,
      'html' => $body,
      //'text' => 'I am the text parameter',
      'from' => 'info@2finda.com',
  );
    
  $request = $url.'api/mail.send.json';
  $session = curl_init($request);
  curl_setopt ($session, CURLOPT_POST, true);
  curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
  curl_setopt($session, CURLOPT_HEADER, false);
  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec($session);
  curl_close($session);
  echo ',,,'; 
  echo $_SESSION['placeids']=mysqli_insert_id($connect);
  mysqli_close($connect);
}

// signup form end
if(isset($_REQUEST['updprof']))
{
  $fname = mysqli_real_escape_string($connect,$_REQUEST['fname']);
  $lname = mysqli_real_escape_string($connect,$_REQUEST['lname']);
  //$email = mysqli_real_escape_string($connect,$_REQUEST['email']);
  
  $contact = mysqli_real_escape_string($connect,$_REQUEST['contact']);
   
  $code = md5(uniqid(rand()));  
  $q2 = mysqli_query($connect,'UPDATE `users` SET `fname` = "'.$fname.'", `lname` = "'.$lname.'", `contact` = "'.$contact.'" WHERE `uid` = "'.$_SESSION['u_id'].'"');
  
  if($q2)
  {
    echo 'done';
  } else {
    echo 'already';
  }
  
}

// Login start Here
if(isset($_REQUEST['login']))
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = md5($password);
  $statusY = 0;

  $q2 = mysqli_query($connect,'SELECT * FROM users where email="'.$email.'" AND pwd="'.$password.'" and a_status = "'.$statusY.'"');
  if(mysqli_num_rows($q2)>0)
  {
      $row = mysqli_fetch_array($q2);
      $_SESSION['u_id'] = $row['uid'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['fname'] = $row['fname'];
      $_SESSION['lname'] = $row['lname'];
      echo 'done';
  }
  else
  {
      echo 'wrong data';
  }
}
// end here
if(isset($_REQUEST['fblogin']))
{
   
   require_once 'fbConfig.php';
   require_once 'user.php';
   
   
    //Get user profile data from facebook
    $fbUserProfile = $facebook->api('/me?fields=id,first_name,last_name,email');
    
    //Initialize User class
    $user = new User();
    //Insert or update user data to the database
    $fbUserData = array(
        'fuid'      => $fbUserProfile['id'],
        'fname'     => $fbUserProfile['first_name'],
        'lname'     => $fbUserProfile['last_name'],
        'email'     => $fbUserProfile['email']
    );
    $userData = $user->checkUser($fbUserData);
    
    //Put user data into session
    
    $_SESSION['u_id'] = $userData['uid'];
    
    /*Render facebook profile data
    if(!empty($userData)){
        $output = '<h1>Facebook Profile Details </h1>';
        $output .= '<img src="'.$userData['picture'].'">';
        $output .= '<br/>Facebook ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Facebook';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Facebook Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Facebook</a>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }*/
  }

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

//edit place
if(isset($_REQUEST['eplace']))
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

if(isset($_REQUEST['savetime']))
{
 // echo "working";
 $placeid = $_POST['placeid'];
 $date1=$_POST['from-date1a'] . " " . $_POST['from-date1b'];
 $date2 = $_POST['to-date2a'] . " " . $_POST['to-date2b'];
 $pph = $_POST['p_p_h'];
 $ppn = $_POST['p_p_n'];
 $wppn = $_POST['w_p_p_n'];

 if($_SESSION['u_id']=="")
 {
  echo "login";
 } else {
  $res = mysqli_query($connect,"select * from `calenderdata` where `placeid`='".$placeid."' and `date1`='".$date1."' and `date2`='".$date2."'");
    if (mysqli_num_rows($res)) {
      echo "error";
      echo ",,,";
    } else {
      $sql = mysqli_query($connect,"INSERT `calenderdata` SET `placeid`='".$placeid."', `p_p_n`='".$ppn."', `w_p_p_n`='".$wppn."',
`p_p_h`='".$pph."', `date1`='".$date1."', `date2`='".$date2."', `status` ='unbooked', `ctimestampdate` = '".date('Y-m-d')."'" );
  
      if($sql>0){
        echo "success";
      } else {
        echo "error";
      }
      echo ",,,";
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

if(isset($_REQUEST['qephoto']))
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
                                              'mov',
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
              if($imageWidth >= '200' && $imageHeight >='500' )
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
  $query=mysqli_query($connect,'update place set photo="'.$newpg.'" , video="'.$newpg1.'" , video_type="'.$newpg2.'" where place_id="'.$placeid.'"');
  if($query>0){
    echo "success";
    echo">>>";
  } else {
    echo "error";
    echo">>>";
  }
} else {
  echo"wrong_exe";  
  echo">>>";
  echo $err_msg;
}
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
if(isset($_GET['calender_id']))
{
  $cal = $_GET['calender_id'];
  $ppn = $_GET['cal_ppn'];
  $pph = $_GET['cal_pph'];
  $wppn = $_GET['cal_wppn'];
  error_log($cal);
  error_log($ppn);
  error_log($pph);
  error_log($wppn);
  
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
if(isset($_GET['deletecalender_id']))
{
  $val = $_GET['deletecalender_id'];
  $sql = mysqli_query($connect,"DELETE FROM calenderdata WHERE calid='".$val."'");
  error_log($sql);
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
