<?php
require_once 'connect.php';

//$insert = "INSERT INTO calendardata (placeid, label, date1, date2) VALUES (6 , :name, :start, :end)";

//$stmt = $db->prepare($insert);

//$stmt->bindParam(':start', $start);
//$stmt->bindParam(':end', $end);
//$stmt->bindParam(':name', $name);

$received = json_decode(file_get_contents('php://input'));

$start = $received->start;
$end = $received->end;
$name = $received->text;
$placeid = $received->placeid;
$calid = $received->idd;

error_log($calid);

//$stmt->execute();
try {
$sql = mysqli_query($connect,'INSERT INTO `calenderdata` ( `calid`, `placeid`, `label`, `date1`, `date2`) VALUES ("'.$calid.'","'.$placeid.'", "'.$name.'", "'.$start.'", "'.$end.'")');
} catch (Exception $e) {
     error_log("we have a problem");
}

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();

echo json_encode($response);

?>