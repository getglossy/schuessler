<?php
include '../common.php';
@session_start();
$_SESSION["qryUsersReservationsFilterString"]=" AND slot_date = DATE_FORMAT(NOW(),'%Y-%m-%d') ";

include 'users_reservation.php';
?>
