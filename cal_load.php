<?php
require_once 'connect.php';

$received = json_decode(file_get_contents('php://input'));
$placeid = $received;

//error_log($received);  
//$result = $db->query('SELECT * FROM events');
$result=mysqli_query($connect,'SELECT * FROM calenderdata where placeid="'.$placeid.'" and status = "Available"');

class Event {}

$events = array();
$rowid = "";
//error_log($result);
//foreach($result as $row) {
while ($row = $result->fetch_array()) {
  $interval = new DateInterval('P1D'); // 1 day interval
  $start = date_create($row['date1']);
  $end = date_create($row['date2']);
  $period   = new DatePeriod($start, $interval, $end);
  
  foreach ($period as $day) {
        // Do stuff with each $day...
        $days .= $day->format('Y-m-d').',';
  }
  $days = rtrim($days, ",");
  //$days = $days.'<br>';
  $newdays = explode(',', $days);

  //error_log("newdays: " . $newdays);
  foreach ($newdays as $range) {
    if ($range) {
      $e = new Event();
      $e->id = $row['calid'];
      $e->text = $row['status'];
      $e->start = $range . "T" . date_format(date_create($row['time1']), 'H:i:s');
      $e->end = $range . "T" . date_format(date_create($row['time2']), 'H:i:s');
      $events[] = $e;
    }
  }
  
  
  $rowid = $row['calid'];
}

$result2=mysqli_query($connect,'SELECT * FROM booking where placeid="'.$placeid.'"');


//foreach($result as $row) {
//error_log("$rowid");
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
//error_log($events[1]->start);
//error_log($events[1]->end);
//echo "hello world";
echo json_encode($events);

?>