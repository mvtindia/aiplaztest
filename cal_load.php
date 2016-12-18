<?php
require_once 'connect.php';

$received = json_decode(file_get_contents('php://input'));
$placeid = $received;
//error_log($received);  
//$result = $db->query('SELECT * FROM events');
$result=mysqli_query($connect,'SELECT * FROM calenderdata where placeid="'.$placeid.'"');

class Event {}

$events = array();
//error_log($result);
//foreach($result as $row) {
while ($row = $result->fetch_array()) {
  //error_log($row['label']);
  $e = new Event();
  //$e->id = $row['calid'];
  $e->text = $row['status'];
  $e->start = $row['date1'];
  $e->end = $row['date2'];
  $events[] = $e;
}
//echo "hello world";
echo json_encode($events);

?>