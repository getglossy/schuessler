<?php
include '../common.php';
//order by management
if(isset($_REQUEST["order_by"]) && $_REQUEST["order_by"] != '' && isset($_REQUEST["type"]) && $_REQUEST["type"] != '') {
	
	switch($_REQUEST["order_by"]) {
		case "date":
			if($_REQUEST["type"] == 'asc') {
				$_SESSION["qryReservationsOrderString"] = "ORDER BY slot_date asc";
				$_SESSION["orderbyReservationDate"] = "desc";
			} else {
				$_SESSION["qryReservationsOrderString"] = "ORDER BY slot_date desc";
				$_SESSION["orderbyReservationDate"] = "asc";
			}
			
			break;
		case "time":
			if($_REQUEST["type"] == 'asc') {
				$_SESSION["qryReservationsOrderString"] = "ORDER BY slot_time_from asc";
				$_SESSION["orderbyReservationTime"] = "desc";
			} else {
				$_SESSION["qryReservationsOrderString"] = "ORDER BY slot_time_from desc";
				$_SESSION["orderbyReservationTime"] = "asc";
			}
			
			break;
		
	}
}


include 'reservation.php';
?>


