<?php
session_start();
include_once('connect.php');
require_once('swift_required.php');
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
    error_log($id);
    $key = base64_encode($id);
    $id = $key;
    
    $body = 'Hi ' . $fname . ',

To confirm your 2finda account, simply click on the following link: http://' . $_SERVER['SERVER_NAME'] . '/verify.php?id=' . $id . '&code=' . $code . '

Your 2finda team';

    $url = 'https://api.sendgrid.com/';
    $user='azure_4389271fb296cc51e6ae084dc9819730@azure.com';
    $pass='Book1234';
    $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => 'andy@gooseswan.com',
      'subject' => 'subject of the email',
      'html' => 'I am the HTML parameter',
      'text' => 'I am the text parameter',
      'from' => 'info@2finda.com',
    );
    error_log('here');
    $request = $url.'api/mail.send.json';
    $session = curl_init($request);
    curl_setopt ($session, CURLOPT_POST, true);
    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($session);
    error_log(curl_error($session));
    curl_close($session);
    error_log("successful");

  
    echo 'done';
  } else {
    echo 'already';
  }
  }
}


// signup form end


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
    error_log("facebook");
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
// Add place Start Here
if(isset($_REQUEST['place']))
{
 // echo "working";
//error_log($_POST['name']);
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

if(!isset($_SESSION['u_id']))
{
echo "login";
}
else
{
//$sql = mysqli_query($connect,"INSERT INTO `place` (`user_id`, `p_name`, `timestampdate`) VALUES ('" . mysql_real_escape_string($_SESSION['u_id'] . "','test user', NOW()));

try {
$sql = mysqli_query($connect,'INSERT INTO `place` ( `p_name`, `p_contact`, `p_location`, `p_address`, `p_country`, `p_city`, `p_code`, `p_state`, `space_name`, `property_typeid`, `can_be_usedid`, `accomodates`, `place_area`, `ammenties_id`, `add_ammenties`, `details`, `rules_doid`, `rules_donotid`, `timestampdate`, `saftyid`, `fire_extinguisher`, `fire_alarm`, `gas_valve`, `exit_extinguisher`,`capacity`,`user_id`,`areatype`) VALUES ("'.$name.'", "'.$contact.'", "'.$location.'", "'.$address.'","'.$country.'" ,"'.$city.'" ,"'.$postcode.'","'.$state.'", "'.$space_name.'", "'.$property.'", "'.$canbe.'", "'.$accomodates.'", "'.$area.'", "'.$commonammenties.'", "'.$add_ammenties.'", "'.$details.'", "'.$ruledo.'", "'.$ruledonot.'", "'.date('Y-m-d').'", "'.$safety.'", "'.$fire_extinguisher.'", "'.$fire_alaram.'", "'.$gas_valve.'", "'.$emergency.'","'.$capacity.'", "'.$_SESSION['u_id'].'","'.$areatype.'")');
} catch (Exception $e) {
     error_log("we have a problem");
}

//error_log("sqlcode: " + $sql);
$_SESSION['placeids']=mysqli_insert_id($connect);
echo $_SESSION['placeids'];
//error_log("placeid");
//error_log($_SESSION['placeids']);
echo ',,,'; 
if($sql>0){
  echo "success";
}
else{
  echo "error";
}
}

}//if isset

 

if(isset($_REQUEST['photo']))
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
$pi2="$placeid";
error_log($pi2);
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
if(isset($_REQUEST['priceterms']))
{
  //if ($_REQUEST['priceterms'] == 303) {
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
    } else {
	    echo "error123 ";
      echo " db error begin ".mysqli_error($query);
      error_log("Failed to connect to database!", 0);
    } 

//check with error123 623 to 628 


    echo ",,,";
  //} else {
  //  $placeid = $_REQUEST['placeid'];
  //}
  ?>
  <script>
    var incr = "no";
  </script>
  <form id="calenderform" method="post" enctype="multipart/form-data" >
  <input type="hidden" class="placeid" name="placeid" value="" id="placeid">

  <div class="tellus-data col-md-12 col-sm-12 col-xs-12 pd-lr-0" ><!--id="calendar-tab"-->
      <div class="had-frm-sec" >Seasonal Pricing & Scheduling</div>
      <button id="mvdtb"><---</button><button id="mvdtf">---></button>
      <div id="dp"></div>
  
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
  
  </div>
  
  <div class="col-md-12 text-center" style="margin-top: 20px;">
      <a id="" type="button" href="dashboard.php" name="place" class="btn btn-default cus-save-but">My DashBoard</a>
  </div>
  </form>
  
  
  <div class="clearfix"></div>
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
        if (!name) return;
        var e = new DayPilot.Event({
            start: args.start,
            end: args.end,
            id: DayPilot.guid(),
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
     DayPilot.request(
        "cal_move.php", 
        function(req) { // success
            var response = eval("(" + req.responseText + ")");
            if (response && response.result) {
                dp.message("Resized: " + response.message);
            }
        },
        args,
        function(req) {  // error
            dp.message("Saving failed");
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

<!-- bottom 
                </div>
	        </div>
        </div>
    </div>-->
</html>
<script type="text/javascript">
$(document).ready(function() {

    var url = window.location.href;
    var filename = url.substring(url.lastIndexOf('/')+1);
    if (filename === "") filename = "index.html";
    $(".menu a[href='" + filename + "']").addClass("selected");
    $( "#mvdtf" ).click(function() {
        incr = "forw";
        var i = dae.valueOf() + (604800000 * x);
        dae = new Date( i);
        dp.init();
    });
    $( "#mvdtb" ).click(function() {
        incr = "back";
        dayplt();
    });
});
        
</script>
});
    

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
