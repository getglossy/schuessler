<?php
include '../common.php';
$bookingSlotsObj->setSlot($_GET["slot_id"]);
if($bookingSlotsObj->getSlotSpecialMode() == 1) {
	if($bookingSettingObj->getTimeFormat() == "12") {
		$time= date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeFrom(),0,5)))." - ".date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeTo(),0,5)));
	} else {
		$time= substr($bookingSlotsObj->getSlotTimeFrom(),0,5)." - ".substr($bookingSlotsObj->getSlotTimeTo(),0,5);
	}
	if($bookingSlotsObj->getSlotSpecialText() != '') {
		$time.= " - ".$bookingSlotsObj->getSlotSpecialText(); 
	}
} else if($bookingSlotsObj->getSlotSpecialMode() == 0 && $bookingSlotsObj->getSlotSpecialText() != '') {
	$time= $bookingSlotsObj->getSlotSpecialText(); 
} else {
	if($bookingSettingObj->getTimeFormat() == "12") {
		echo date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeFrom(),0,5)))." - ".date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeTo(),0,5)));
	} else {
		echo substr($bookingSlotsObj->getSlotTimeFrom(),0,5)." - ".substr($bookingSlotsObj->getSlotTimeTo(),0,5);
	}
}
if($bookingSettingObj->getDateFormat() == "UK") {
	$dateToSend = strftime('%d/%m/%Y',strtotime($bookingSlotsObj->getSlotDate()));
} else if($bookingSettingObj->getDateFormat() == "EU") {
	$dateToSend = strftime('%Y/%m/%d',strtotime($bookingSlotsObj->getSlotDate()));
} else {
	$dateToSend = strftime('%m/%d/%Y',strtotime($bookingSlotsObj->getSlotDate()));
}
$info_slot = $dateToSend."\r\n".$time;
echo $info_slot."$".$bookingSlotsObj->getSlotPrice();
?>
