<?php
error_reporting(0);


<<<<<<< HEAD
//$connect=mysqli_connect("us-cdbr-azure-east-c.cloudapp.net","bcdc8eec7d9c69","70936a9a","TurtleRiver_testDB");
//$connect=mysqli_connect("ap-cdbr-azure-east-c.cloudapp.net","b660bd5f89b637","ed5c4a00","Yamuna");
//$connect=mysqli_connect("localhost:8888","","","2finda_local");
=======
$connect=mysqli_connect("us-cdbr-azure-east-c.cloudapp.net","bcdc8eec7d9c69","70936a9a","TurtleRiver_testDB");
//$connect=mysqli_connect("ap-cdbr-azure-east-c.cloudapp.net","b660bd5f89b637","ed5c4a00","Yamuna");
>>>>>>> origin/test


if($connect){
echo "";
}
else{
	echo "Error in Establishing a Connection with database!";
}

?>
