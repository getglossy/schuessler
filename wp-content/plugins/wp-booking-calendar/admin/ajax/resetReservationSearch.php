<?php
include '../common.php';
@session_start();
$_SESSION["qryReservationsFilterString"]=" AND slot_date = DATE_FORMAT(NOW(),'%Y-%m-%d') ";

include 'reservation.php';
?>
