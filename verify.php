<?php 
require_once('connect.php');
$msg = "";
if(empty($_GET['id']) && empty($_GET['code']))
{
 header("Location: index.php");
 exit;
}

if(isset($_GET['id']) && isset($_GET['code']))
{
    $id = base64_decode($_GET['id']);
    error_log("id: " . $id);
    $code = $_GET['code'];
    $statusY = 0;
    $statusN = 999;

    $result = mysqli_query($connect,"SELECT `uid`, `a_status` FROM `users` WHERE `uid` = '".$id."' AND `activation_link` = '".$code."' LIMIT 1");
    error_log("spotb");
    while ($row = mysqli_fetch_row($result))
    {
        if($row[1]==$statusN)
            {
                $res2 = mysqli_query($connect,'UPDATE `users` SET `a_status` = "'.$statusY.'" WHERE `uid` ="'.$id.'"');
                //$q2 =   mysqli_query($connect,'UPDATE `users` SET fname="'.$fname.'",lname="'.$lname.'",contact="'.$contact.'",dob="'.$dob.'",city="'.$city.'" WHERE uid="'.$_SESSION['u_id'].'"');
                $msg = "
                    <div class='alert alert-success'>
                    Your Account is Now Activated! Please log in.
                    </div>
                ";
            }
        else
            {
                error_code("spota");
                $msg = "
                    <div class='alert alert-error'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <h2>Your Account is already Activated : <a href='index.php'>Login here</a></h2>
                    </div>
                ";
            }
    }
 }
 else
 {
  $msg = "
         <div class='alert alert-error'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
      </div>
      ";
 }

?>

<html>

<head>
<title>Confirm Registration</title>
<?php include 'lib/top.php';?>
</head>
<body>

<div class="container-fluid"><!--container-fluid start-->
    <div class="row">

        <div class="menu-had2">
                <?php include 'lib/header.php';?>
        </div><!--menu-had close-->
<?php if (isset($_SESSION['u_id'])) {

} else {
    ?>
        <div class="banner-txt">    
            <h1>Confirm Registration</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-md-6 col-xs-10" style="margin: 0 385px;">
                    <?php  echo $msg ?>
        
                   <form class="pd-bottom20" id="login" method="POST">
  
                    <div class="input-group" id="login">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="email" class="form-control form-height40 bord-0"  name="email" required placeholder="Email Id"/>
                    </div>

                    <div class="input-group mg-top20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control form-height40 bord-0" name="password" required placeholder="Password"/>
                        <input type="hidden" class="urlval" value="dashboard.php" >
                    </div>
                    <div class="text-center mg-top10">
                        <button type="submit" class="" name="login">Login</button>
                    </div>

                   </form>
                </div>
            </div>
        </div> 
<?php } ?>
    </div>
</div>         
<?php include 'lib/footer.php';?>
</html>