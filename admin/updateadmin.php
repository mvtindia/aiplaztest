<?php include "../connect.php";
if(isset($_POST["submit"]))
{
 $semail=$_POST["email"];
 $pass=$_POST["pass"];
$cpass=$_POST["cpass"];
if($pass==$cpass)
{
$query=mysqli_query($connection,"update admin set admin_password='$pass',admin_email='$semail' where admin_id='1'");
header('location:changepassword.php?msg=001');
}
elseif($pass!=$cpass)
{
header('location:changepassword.php?msg=002');
}
else
{
header('location:changepassword.php?msg=002');
}
}
?>