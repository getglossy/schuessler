<?php
include '../common.php';

//order by management
if(isset($_REQUEST["order_by"]) && $_REQUEST["order_by"] != '' && isset($_REQUEST["type"]) && $_REQUEST["type"] != '') {
	
	switch($_REQUEST["order_by"]) {
		case "date":
			if($_REQUEST["type"] == 'asc') {
				$_SESSION["qrySlotsOrderString"] = "ORDER BY slot_date asc";
				$_SESSION["orderbySlotsDate"] = "desc";
			} else {
				$_SESSION["qrySlotsOrderString"] = "ORDER BY slot_date desc";
				$_SESSION["orderbySlotsDate"] = "asc";
			}
			
			break;
		case "time":
			if($_REQUEST["type"] == 'asc') {
				$_SESSION["qrySlotsOrderString"] = "ORDER BY slot_time_from asc";
				$_SESSION["orderbySlotsTime"] = "desc";
			} else {
				$_SESSION["qrySlotsOrderString"] = "ORDER BY slot_time_from desc";
				$_SESSION["orderbySlotsTime"] = "asc";
			}
			
			break;
		
	}
}


include 'slots.php';
?>
