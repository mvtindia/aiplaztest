<?php
require_once 'connect.php';

$received = json_decode(file_get_contents('php://input'));
$placeid = $received;
//error_log($received);  
//$result = $db->query('SELECT * FROM events');
$result=mysqli_query($connect,'SELECT * FROM calenderdata where placeid="'.$placeid.'"');

class Event {}

$events = array();
$rowid = "";
//error_log($result);
//foreach($result as $row) {
while ($row = $result->fetch_array()) {
  //error_log($row['label']);
  $e = new Event();
  $e->id = $row['calid'];
  $e->text = $row['status'];
  $e->start = $row['date1'];
  $e->end = $row['date2'];
  $events[] = $e;
  $rowid = $row['calid'];
}

$result2=mysqli_query($connect,'SELECT * FROM booking where placeid="'.$placeid.'"');


//foreach($result as $row) {
error_log("$rowid");
$i = 1;
while ($row = $result2->fetch_array()) {
  $start = $row['checkin'] . " " . $row['ftime'] . ":00";
  $end = $row['checkout'] . " " . $row['ltime'] . ":00";
  //error_log($start);
  //error_log($end);
  //error_log($rowid + $i);
  $e = new Event();
  $e->id = $rowid + $i;
  $e->text = "Booked";
  $e->start = $start;
  $e->end = $end;
  $events[] = $e;
  $i++;
}
error_log($events[5]->text);
//echo "hello world";
echo json_encode($events);

?>