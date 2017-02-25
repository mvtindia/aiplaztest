<?php
require_once('connect.php');

if(empty($_GET['id']))
{
 header("Location: index.php");
 exit;
}

?>
<html>

<head>
<title>Reset Password</title>
<?php include 'lib/top.php';?>
</head>
<body>

<div class="container-fluid"><!--container-fluid start-->
    <div>
        <div class="row">
            <div class="menu-had2">
                <?php include 'lib/header.php';?>
            </div><!--menu-had close-->
            <div class="banner-txt">    
                <h1>Reset Password</h1>
            </div>
            
            <div style="float: none; margin: 0 auto;">
                <form class="form-group" id="reset_pass" method="post">
                    <div class="col-xs-3" style="float: none; margin: 0 auto;">  
                        <input type="hidden" class="form-control" name="userid" value="<?php echo $_REQUEST['id'] ?>">
                        <input type="password" class="form-control mg-top15" placeholder="New Password" name="newpassword" required>
                        <input type="password" class="form-control mg-top15" placeholder="Confirm Password" name="confpassword" required>
                        <div class="text-center">
                            <button class="btn-5 mg-top15" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
    </div><br><br> 
<?php include 'lib/footer.php';?>
</body>
</html>