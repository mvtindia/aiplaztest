<?php 

include_once('connect.php');
require_once('fbConfig.php');
//require_once('user.php');
session_start();
/*
if(!isset($_SESSION['u_id']))
{
  if ($fbUser) {
    
    //error_log("after fbuser check");
    $fbUserProfile = $facebook->api('/me?fields=id,first_name,last_name,email');
    //error_log($fbUserProfile['id']);
    $query1 = mysqli_query($connect, "SELECT * FROM `users` WHERE `fuid` = '".$fbUserProfile['id']."' AND `a_status` = 0");
    //Initialize User class
    //$user = new User();
    
    //Insert or update user data to the database
    /*$fbUserData = array(
        'oauth_provider'=> 'facebook',
        'oauth_uid'     => $fbUserProfile['id'],
        'first_name'     => $fbUserProfile['first_name'],
        'last_name'     => $fbUserProfile['last_name'],
        'email'         => $fbUserProfile['email'],
    );*/
  /*  if (! mysqli_num_rows($query1)) {
      $code = md5(uniqid(rand()));
      $query2 = mysqli_query($connect, "INSERT INTO `users` SET `fuid` = '".$fbUserProfile['id']."', `fname` = '".$fbUserProfile['first_name']."', `lname` = '".$fbUserProfile['last_name']."', `email` = '".$fbUserProfile['email']."', `pwd` = 'password', `contact` = 'contact', `activation_link` = '".$code."', `a_status` = 999");
      
      $id = mysqli_insert_id($connect); 
      $key = base64_encode($id);
      $id = $key;
     
      $body = 'Hi ' . $fbUserProfile['fname'] . ',

To confirm your 2finda account, simply click on the following link: http://' . $_SERVER['SERVER_NAME'] . '/verify.php?id=' . $id . '&code=' . $code . '

Your 2finda team';

      $url = 'https://api.sendgrid.com/';
      $subject = 'Confirm Registration';
      $user='azure_4389271fb296cc51e6ae084dc9819730@azure.com';
      $pass='Book1234';
      $params = array(
        'api_user' => $user,
        'api_key' => $pass,
        'to' => $fbUserProfile['email'],
        'subject' => $subject,
        'html' => $body,
      //'text' => 'I am the text parameter',
        'from' => 'info@2finda.com',
      );
      error_log($params);
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
    } else {
      $row1 = mysqli_fetch_array($query1);
      //error_log($row1['uid']);
      $_SESSION['u_id'] = $row1['uid'];
    }
    
  }
}*/
 ?>
 <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
 <?php //$q = mysqli_query($connect,"select * from logo"); $r = mysqli_fetch_array($q); ?>
<a href="index.php"><img style="max-width:60%" class="img-responsive" src="images/my_logo_2finda.png"></a>  
</div>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
 <nav class="navbar navbar-inverse cus-nav">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav pull-right-cus" >
        <li id="one"><a href="searchlst.php" >Book a Space</a></li><!--btn-custom-->
        
        <li id="two"><a href="list-place.php">List a Space</a></li>

        
        <!--<li id="three"><a href="list-service.php">List a Service</a></li>-->
    <?php 
    if(isset($_SESSION['u_id']))
    {
       $q2 = mysqli_query($connect,'SELECT * FROM users where uid="'.$_SESSION['u_id'].'"');
        $res = mysqli_fetch_array($q2)                                                                
        ?>
      <li class="dropdown "><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="login-name" tabindex="-1"> <img class="usr-profile" src="img/<?php if(!empty($res['profile'])){echo $res['profile'];}else{echo "default-user.png";} ?>">&nbsp;<?php echo $res['fname']." ".$res['lname']; ?><span class="caret"></span></a>

      <ul class="dropdown-menu">
      <li><a href="dashboard.php"><i class="fa fa-pencil"></i>Dashboard</a></li>
      <li><a href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
      </ul>
      </li>
       <!-- <li><a href="logout.php">Logout</a></li> -->
       <?php
    }
    else
    {
      ?>
    <li><a class="signlog" href="#" data-toggle="modal" data-target="#myModal2">Signup/Login</a></li>
      
      <?php
    }

    ?>

      </ul>
      
    </div>
 
</nav>

</div>

</div><!--row close-->
</div><!--container close-->