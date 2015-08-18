<?php
include '../common.php';

//filter management
if(isset($_REQUEST["date_from"]) && !isset($_REQUEST["date_to"])) {
	$_SESSION["qryReservationsFilterString"] = "AND slot_date = '".str_replace(",","-",$_REQUEST["date_from"])."'";
} else if(isset($_REQUEST["date_from"]) && isset($_REQUEST["date_to"])) {
	$_SESSION["qryReservationsFilterString"] = "AND slot_date >= '".str_replace(",","-",$_REQUEST["date_from"])."' AND slot_date <= '".str_replace(",","-",$_REQUEST["date_to"])."'";
}
if(isset($_REQUEST["wordpress_user_id"]) && $_REQUEST["wordpress_user_id"]!='' && $_REQUEST["wordpress_user_id"]!='undefined') {
	$_SESSION["qryReservationsFilterString"] .=" AND wordpress_user_id=".$_REQUEST["wordpress_user_id"];
}


include 'reservation.php';
?>
