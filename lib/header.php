<?php include_once('connect.php');
session_start();
 ?>
 <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
 <?php $q = mysqli_query($connect,"select * from logo"); $r = mysqli_fetch_array($q); ?>
<a href="index.php"><img class="img-responsive" src="images/<?php echo $r['logo_image']; ?>"></a>
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
        <li id="one"><a href="searchlst.php" >Book a Place</a></li><!--btn-custom-->
    <li id="two">
      <a href="list-place.php">
        List a Place
        </a>
         </li>
    <li id="three"><a href="list-service.php">List a Service</a>     
    </li>
    <?php 
    if(isset($_SESSION['u_id']))
    {
       $q2 = mysqli_query($connect,'SELECT * FROM users where uid="'.$_SESSION['u_id'].'"');
        $res = mysqli_fetch_array($q2)                                                                
        ?>
      <li class="dropdown "><a class="dropdown-toggle" data-toggle="dropdown" href="#" id="login-name" tabindex="-1"> <img class="usr-profile" src="img/<?php if(!empty($res['profile'])){echo $res['profile'];}else{echo "default-user.png";} ?>">&nbsp;<?php echo $res['fname']." ".$res['lname']; ?><span class="caret"></span></a>

      <ul class="dropdown-menu">
      <li><a href="dashboard.php"><i class="fa fa-pencil"></i>&nbsp;Edit Profile</a></li>
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