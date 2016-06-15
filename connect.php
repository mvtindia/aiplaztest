<?php
error_reporting(0);
$connect=mysqli_connect("ap-cdbr-azure-east-c.cloudapp.net","b660bd5f89b637","ed5c4a00","Yamuna");
/*$connect=mysqli_connect("localhost","root","","vismaadl_bookmyspace");*/
// Database=Yamuna;Data Source=ap-cdbr-azure-east-c.cloudapp.net;User Id=b660bd5f89b637;Password=ed5c4a00
if($connect){
echo "";
}
else{
	echo "Error in Establishing a Connection with database!";
}

?>