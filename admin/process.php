<?php 
ob_start();
include "../connect.php";
//echo "abc";
if(isset($_REQUEST['oldpas']))
{
    if($_REQUEST['oldpas']=="")
    {
        echo "empty";
    }
	//echo $_REQUEST['oldpass'];
	//echo $_REQUEST['pswrd'];
$sql=mysqli_query($connect,"select * from admin where admin_id=1 and admin_password='".$_REQUEST['oldpas']."'");
if($row=mysqli_num_rows($sql)>0){
 echo'matches';
}
else{
 echo'Incorrect password';
}
//echo $row['admin_password'];
//die();
}

if(isset($_REQUEST['submit']))
{
$oldpass=$_REQUEST['oldpass'];
if($oldpass!="")
{
$cpass=$_REQUEST['cpass'];

$updatesql="UPDATE admin SET admin_password='".$cpass."' WHERE admin_id=1";

$query=mysqli_query($connect,$updatesql);
if($query>0){
echo '<div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Password changed Successfully.</p>
                            </div>';
}
else{
	echo '<div class="alert alert-danger alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Success!
                                </h4>
                                <p> Wrong password</p>
                            </div>';
}
}
}

//else{
	/*<script>swal({   title: "Wrong Passwod",   text: "Incorrect Old Password.",   timer: 2000,   showConfirmButton: false });</script>*/
//}
?>