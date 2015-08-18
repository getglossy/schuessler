<?php
include '../common.php';

$item_id = $_REQUEST["reservation_id"];	
$bookingReservationObj->setReservation($item_id);
$slot_id=$bookingReservationObj->getReservationSlotId();
$bookingSlotsObj->setSlot($slot_id);
$price=$bookingSlotsObj->getSlotPrice();
echo $price;


?>