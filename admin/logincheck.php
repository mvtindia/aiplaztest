<?php ob_start(); session_start();
 include("../connect.php");
if(isset($_POST["submit"]))
{ 
 $email=$_POST["emails"];
 $password=$_POST["password"];
$query=mysqli_query($connect,'Select * from admin where admin_email="'.$email.'" && admin_password="'.$password.'"');
$match=mysqli_fetch_array($query);
 $femail=$match["admin_email"];
 $fpass=$match["admin_password"];
 $loginid=$match["admin_id"];
 $uname=$match["admin_uname"];
  if(($email==$femail)&&($password==$fpass))
         {
        //echo"session".
         $_SESSION["id"]=$loginid;
         $_SESSION["uname"]=$uname;
        header("location:index.php?msg=001");
         }
          else
         {
         header("location:login.php?nomsg=002");
         }
}
 ?>