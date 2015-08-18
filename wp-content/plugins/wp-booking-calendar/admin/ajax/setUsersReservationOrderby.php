<?php
include '../common.php';
//order by management
if(isset($_REQUEST["order_by"]) && $_REQUEST["order_by"] != '' && isset($_REQUEST["type"]) && $_REQUEST["type"] != '') {
	
	switch($_REQUEST["order_by"]) {
		case "date":
			if($_REQUEST["type"] == 'asc') {
				$_SESSION["qryUsersReservationsOrderString"] = "ORDER BY slot_date asc";
				$_SESSION["orderbyUserReservationDate"] = "desc";
			} else {
				$_SESSION["qryUsersReservationsOrderString"] = "ORDER BY slot_date desc";
				$_SESSION["orderbyUserReservationDate"] = "asc";
			}
			
			break;
		case "time":
			if($_REQUEST["type"] == 'asc') {
				$_SESSION["qryUsersReservationsOrderString"] = "ORDER BY slot_time_from asc";
				$_SESSION["orderbyUserReservationTime"] = "desc";
			} else {
				$_SESSION["qryUsersReservationsOrderString"] = "ORDER BY slot_time_from desc";
				$_SESSION["orderbyUserReservationTime"] = "asc";
			}
			
			break;
		
	}
}


include 'users_reservation.php';
?>


