<?php
require_once 'connect.php';

$received = json_decode(file_get_contents('php://input'));

$id = $received->e->id;
settype($id, int);

$start = $received->newStart;
//$start = str_replace("T", " ", $start);
//$start2 = date("Y-m-d h:i:s");
$end = $received->newEnd;

try {
$sql = mysqli_query($connect,'UPDATE `calenderdata` SET `date1` = "'.$start.'", `date2` = "'.$end.'" WHERE `calid` = '.$id.'');
//$sql = mysqli_query($connect, $query);
} catch (Exception $e) {
     error_log("we have a problem");
}
error_log($sql);
class Result {}

$response = new Result();
$response->result = "OK";

$response->message = "Update successful";

echo json_encode($response);

?>