<?php
require_once 'connect.php';

$received = json_decode(file_get_contents('php://input'));

$start = $received->start;
$end = $received->end;
$name = $received->text;
$placeid = $received->placeid;

try {
$sql = mysqli_query($connect,'INSERT INTO `calenderdata` ( `placeid`, `label`, `date1`, `date2`, `status`) VALUES ("'.$placeid.'", "'.$name.'", "'.$start.'", "'.$end.'", "unbooked")');
} catch (Exception $e) {
     error_log("we have a problem");
}

class Result {}

$response = new Result();
$response->result = 'OK';

$response->message = mysqli_insert_id($connect);
error_log("hey");
//echo $response->message;
error_log("Response: " . $response->result);
echo json_encode($response);

?>