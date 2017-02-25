<?php
require_once 'connect.php';

$received = json_decode(file_get_contents('php://input'));

$id = $received->e->id;
$start = $received->newStart;
$end = $received->newEnd;

$sql = mysqli_query($connect(), "UPDATE `events` SET `date1` = :start, `date2` = :end WHERE `calid` = :id");
class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Update successful';

echo json_encode($response);

?>