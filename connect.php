<?php
error_reporting(0);


//$connect=mysqli_connect("us-cdbr-azure-east-c.cloudapp.net","bcdc8eec7d9c69","70936a9a","TurtleRiver_testDB");
//$connect=mysqli_connect("us-cdbr-azure-northcentral-b.cloudapp.net","b5ed6b723b4e0c","7bf07005","chicago_river");
//"ap-cdbr-azure-east-c.cloudapp.net","b660bd5f89b637","ed5c4a00","Yamuna"
$connect=mysqli_connect("localhost","root","cubs","andytest");

if($connect){
echo "";
}
else{
	echo "Error in Establishing a Connection with database!";
}

?>
