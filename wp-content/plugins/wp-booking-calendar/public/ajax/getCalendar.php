<?php
include '../common.php';
$bookingCalendarObj->setCalendar($_GET["calendar_id"]);
?>
<?php echo $bookingCalendarObj->getFirstFilledMonth($bookingCalendarObj->getCalendarId()); ?>