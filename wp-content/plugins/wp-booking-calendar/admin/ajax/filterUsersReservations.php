<?php
include '../common.php';

//filter management
if(isset($_REQUEST["date_from"]) && !isset($_REQUEST["date_to"])) {
	$_SESSION["qryUsersReservationsFilterString"] = "AND slot_date = '".str_replace(",","-",$_REQUEST["date_from"])."'";
} else if(isset($_REQUEST["date_from"]) && isset($_REQUEST["date_to"])) {
	$_SESSION["qryUsersReservationsFilterString"] = "AND slot_date >= '".str_replace(",","-",$_REQUEST["date_from"])."' AND slot_date <= '".str_replace(",","-",$_REQUEST["date_to"])."'";
}


include 'users_reservation.php';
?>
