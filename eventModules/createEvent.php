<?php
$title  = $_POST['newEventName'];
$master = $_POST['newEventMaster'];
$detail = $_POST['newEventDetail'];
$cost = $_POST['newEventCost'];
$date1 = $_POST['newEventDate1'];
$date2 = $_POST['newEventDate2'];
$date3 = $_POST['newEventDate3'];
$place = $_POST['newEventPlace'];
$url = $_POST['newEventUrl'];

$handle_eventID = fopen("../events/info.csv", "r");
$eventID = fread($handle_eventID, 10);
fclose($handle_eventID);

echo $eventID;
 ?>
