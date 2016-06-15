<?php
session_start();
include_once('connect.php');

if(isset($_REQUEST['delete_place']))
{
	$placeid = $_REQUEST['delete_place'];
	$ntime = date('y-m-d h:s:i');
	$q = mysqli_query($connect,"delete from place where place_id=".$placeid);
	//echo "Select * from booking where placeid=".$placeid;
	$que = mysqli_query($connect,"Select * from booking where placeid=".$placeid);
	while($r = mysqli_fetch_array($que))
	{
		//echo "INSERT INTO `notes`(`bookid`,`userid`,`ntime`) VALUES ('".$r['bookid']."','".$r['userid']."','".$ntime."')";
		$query = mysqli_query($connect,"INSERT INTO `notes`(`bookid`,`userid`,`ntime`) VALUES ('".$r['bookid']."','".$r['userid']."','".$ntime."')");
	}

	header('location:dashboard.php?msg=place deleted');
}

if(isset($_REQUEST['ratings']))
{
	$serviceid = $_REQUEST['serviceid'];
	$ratings = $_REQUEST['ratings'];
	$comments = $_REQUEST['reviews'];
	if(isset($_SESSION['u_id']))
	{
		$q = mysqli_query($connect,"INSERT INTO `ratings`(`serviceid`, `userid`, `ratings`, `comments`) VALUES ('".$serviceid."','".$_SESSION['u_id']."','".$ratings."','".$comments."')");
		if($q)
		{
			echo 'given';
		}
	}
	else
	{
		echo 'not login';
	}
}

if(isset($_REQUEST['noteid']))
{
	$nid = $_REQUEST['noteid'];
	$q = mysqli_query($connect,"update notes set nstatus='R' where nid=".$nid);
}

if(isset($_REQUEST['delete_service']))
{
	$sid = $_REQUEST['delete_service'];
	$que = mysqli_query($connect,"delete from services where sid=".$sid);
	if($que>0)
	{
		header('location:dashboard.php?msg=39489338');
	}
}
?>