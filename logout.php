<?php 
session_start();
if(isset($_SESSION['u_id']))
{
	session_unset($_SESSION['u_id']);
	header('location:index.php');
}
else
{
	header('location:index.php');
}

?>