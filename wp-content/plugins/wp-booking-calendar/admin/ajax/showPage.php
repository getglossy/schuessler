<?php
include '../common.php';
$_SESSION["qryReservationsFilterString"] = '';
$_SESSION["qrySlotsFilterString"] = '';
include '../'.$_GET["pagename"].'_include.php';
?>