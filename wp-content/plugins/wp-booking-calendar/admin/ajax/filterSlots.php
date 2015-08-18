<?php
include '../common.php';

//filter management
switch($_REQUEST["search_date"]) {
	case "1":
		$_SESSION["qrySlotsFilterString"] = "AND slot_date = '".str_replace(",","-",$_REQUEST["date_from"])."'";
		$arrTimeFrom = explode(":",$_REQUEST["time_from"]);
		if($arrTimeFrom[0]!='' && $arrTimeFrom[1]!='') {
			
			if($arrTimeFrom[2]!='undefined') {
				if($arrTimeFrom[2] == 'pm') {
					//am pm Have to put it in 24 hour
					switch($arrTimeFrom[0]) {
						case '1':
							$arrTimeFrom[0] = '13';
							break;
						case '2':
							$arrTimeFrom[0] = '14';
							break;
						case '3':
							$arrTimeFrom[0] = '15';
							break;
						case '4':
							$arrTimeFrom[0] = '16';
							break;
						case '5':
							$arrTimeFrom[0] = '17';
							break;
						case '6':
							$arrTimeFrom[0] = '18';
							break;
						case '7':
							$arrTimeFrom[0] = '19';
							break;
						case '8':
							$arrTimeFrom[0] = '20';
							break;
						case '9':
							$arrTimeFrom[0] = '21';
							break;
						case '10':
							$arrTimeFrom[0] = '22';
							break;
						case '11':
							$arrTimeFrom[0] = '23';
							break;
					}
				} else if($arrTimeFrom[2] == 'am') {
					switch($arrTimeFrom[0]) {
						case '12':
							$arrTimeFrom[0] = '0';
							break;
					}
				}
				if(strlen($arrTimeFrom[0]) == 1) {
					$arrTimeFrom[0]='0'.$arrTimeFrom[0];
				}
				if(strlen($arrTimeFrom[1]) == 1) {
					$arrTimeFrom[1]='0'.$arrTimeFrom[1];
				}
			} 
			$timeFromString=$arrTimeFrom[0].":".$arrTimeFrom[1];
			$_SESSION["qrySlotsFilterString"] .= " AND slot_time_from >= '".$timeFromString.":00'";
		}
		$arrTimeTo = explode(":",$_REQUEST["time_to"]);
		if($arrTimeTo[0]!='' && $arrTimeTo[1]!='') {
			
			if($arrTimeTo[2]!='undefined') {
				if($arrTimeTo[2] == 'pm') {
					//am pm Have to put it in 24 hour
					switch($arrTimeTo[0]) {
						case '1':
							$arrTimeTo[0] = '13';
							break;
						case '2':
							$arrTimeTo[0] = '14';
							break;
						case '3':
							$arrTimeTo[0] = '15';
							break;
						case '4':
							$arrTimeTo[0] = '16';
							break;
						case '5':
							$arrTimeTo[0] = '17';
							break;
						case '6':
							$arrTimeTo[0] = '18';
							break;
						case '7':
							$arrTimeTo[0] = '19';
							break;
						case '8':
							$arrTimeTo[0] = '20';
							break;
						case '9':
							$arrTimeTo[0] = '21';
							break;
						case '10':
							$arrTimeTo[0] = '22';
							break;
						case '11':
							$arrTimeTo[0] = '23';
							break;
					}
				} else if($arrTimeTo[2] == 'am') {
					switch($arrTimeTo[0]) {
						case '12':
							$arrTimeTo[0] = '0';
							break;
					}
				}
				if(strlen($arrTimeTo[0]) == 1) {
					$arrTimeTo[0]='0'.$arrTimeTo[0];
				}
				if(strlen($arrTimeTo[1]) == 1) {
					$arrTimeTo[1]='0'.$arrTimeTo[1];
				}
			} 
			$timeToString=$arrTimeTo[0].":".$arrTimeTo[1];
			$_SESSION["qrySlotsFilterString"] .= " AND slot_time_to <= '".$timeToString.":00'";
		}
		
		break;
	case "2":
		$_SESSION["qrySlotsFilterString"] = "AND slot_date >= '".str_replace(",","-",$_REQUEST["date_from"])."' AND slot_date <= '".str_replace(",","-",$_REQUEST["date_to"])."'";
		$arrTimeFrom = explode(":",$_REQUEST["time_from"]);
		if($arrTimeFrom[0]!='' && $arrTimeFrom[1]!='') {
			
			if($arrTimeFrom[2]!='undefined') {
				if($arrTimeFrom[2] == 'pm') {
					//am pm Have to put it in 24 hour
					switch($arrTimeFrom[0]) {
						case '1':
							$arrTimeFrom[0] = '13';
							break;
						case '2':
							$arrTimeFrom[0] = '14';
							break;
						case '3':
							$arrTimeFrom[0] = '15';
							break;
						case '4':
							$arrTimeFrom[0] = '16';
							break;
						case '5':
							$arrTimeFrom[0] = '17';
							break;
						case '6':
							$arrTimeFrom[0] = '18';
							break;
						case '7':
							$arrTimeFrom[0] = '19';
							break;
						case '8':
							$arrTimeFrom[0] = '20';
							break;
						case '9':
							$arrTimeFrom[0] = '21';
							break;
						case '10':
							$arrTimeFrom[0] = '22';
							break;
						case '11':
							$arrTimeFrom[0] = '23';
							break;
					}
				} else if($arrTimeFrom[2] == 'am') {
					switch($arrTimeFrom[0]) {
						case '11':
							$arrTimeFrom[0] = '0';
							break;
					}
				}
				if(strlen($arrTimeFrom[0]) == 1) {
					$arrTimeFrom[0]='0'.$arrTimeFrom[0];
				}
				if(strlen($arrTimeFrom[1]) == 1) {
					$arrTimeFrom[1]='0'.$arrTimeFrom[1];
				}
			} 
			$timeFromString=$arrTimeFrom[0].":".$arrTimeFrom[1];
			$_SESSION["qrySlotsFilterString"] .= " AND slot_time_from >= '".$timeFromString.":00'";
		}
		$arrTimeTo = explode(":",$_REQUEST["time_to"]);
		if($arrTimeTo[0]!='' && $arrTimeTo[1]!='') {
			
			if($arrTimeTo[2]!='undefined') {
				if($arrTimeTo[2] == 'pm') {
					//am pm Have to put it in 24 hour
					switch($arrTimeTo[0]) {
						case '1':
							$arrTimeTo[0] = '13';
							break;
						case '2':
							$arrTimeTo[0] = '14';
							break;
						case '3':
							$arrTimeTo[0] = '15';
							break;
						case '4':
							$arrTimeTo[0] = '16';
							break;
						case '5':
							$arrTimeTo[0] = '17';
							break;
						case '6':
							$arrTimeTo[0] = '18';
							break;
						case '7':
							$arrTimeTo[0] = '19';
							break;
						case '8':
							$arrTimeTo[0] = '20';
							break;
						case '9':
							$arrTimeTo[0] = '21';
							break;
						case '10':
							$arrTimeTo[0] = '22';
							break;
						case '11':
							$arrTimeTo[0] = '23';
							break;
					}
				} else if($arrTimeTo[2] == 'am') {
					switch($arrTimeTo[0]) {
						case '11':
							$arrTimeTo[0] = '0';
							break;
					}
				}
				if(strlen($arrTimeTo[0]) == 1) {
					$arrTimeTo[0]='0'.$arrTimeTo[0];
				}
				if(strlen($arrTimeTo[1]) == 1) {
					$arrTimeTo[1]='0'.$arrTimeTo[1];
				}
			} 
			$timeToString=$arrTimeTo[0].":".$arrTimeTo[1];
			$_SESSION["qrySlotsFilterString"] .= " AND slot_time_to <= '".$timeToString.":00'";
		}
		if($_REQUEST["weekday"] != 0) {
			if($_REQUEST["weekday"] == 7) {
				//sunday, for mysql sunday is 0 not 7
				$_REQUEST["weekday"] =0;
			}
			$_SESSION["qrySlotsFilterString"] .= " AND DATE_FORMAT(slot_date,'%w') =".$_REQUEST["weekday"];
		}
		break;
}



include 'slots.php';
?>
