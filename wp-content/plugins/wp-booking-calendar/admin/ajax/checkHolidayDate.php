<?php
include '../common.php';

if($_REQUEST["add_dates"] == 1) {
	$date = str_replace(",","-",$_REQUEST["date_from"]);		
	$check=$bookingHolidayObj->checkHolidayDate($date,"",$_GET["calendar_id"]);		
	echo $check;
} else if($_REQUEST["add_dates"] == 2) {
	$date_from = str_replace(",","-",$_REQUEST["date_from"]);
	$date_to = str_replace(",","-",$_REQUEST["date_to"]);		
	$check=$bookingHolidayObj->checkHolidayDate($date_from,$date_to,$_GET["calendar_id"]);		
	echo $check;
}

?>