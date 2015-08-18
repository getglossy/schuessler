<?php
include '../common.php';
@session_start();
$fp = fopen(ABSPATH . "wp-content/plugins/wp-booking-calendar/admin/ajax/your_reservation.csv", 'w+');
$headerLine = $bookingLangObj->getLabel("RESERVATION_DATE_LABEL").",".$bookingLangObj->getLabel("RESERVATION_TIME_LABEL");
	if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_SURNAME_LABEL");
	}
	if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_NAME_LABEL");
	}
	if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_EMAIL_LABEL");
	}
	if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_PHONE_LABEL");
	}
	if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_MESSAGE_LABEL");
	}
	if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD1");
	}
	if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD2");
	}
	if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD3");
	}
	if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) { 		
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD4");
	}
	if($bookingSettingObj->getSlotsUnlimited() == 2) {
		$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_SEATS_LABEL");
	}
	$headerLine.=",".$bookingLangObj->getLabel("RESERVATION_CONFIRMED_LABEL").",".$bookingLangObj->getLabel("RESERVATION_CANCELLED")."\r\n";
	
	fwrite($fp, $headerLine);

$arrayReservations = $bookingListObj->getUsersReservationsList($_SESSION["qryUsersReservationsFilterString"],$_SESSION["qryUsersReservationsOrderString"],$_GET["user_id"]);

foreach($arrayReservations as $reservationId => $reservation) {
	$confirmed = $bookingLangObj->getLabel("RESERVATION_CONFIRMED_NO");
	if($reservation["reservation_confirmed"] ==1) {
		$confirmed = $bookingLangObj->getLabel("RESERVATION_CONFIRMED_YES");
	}
	$cancelled = $bookingLangObj->getLabel("RESERVATION_CONFIRMED_NO");
	if($reservation["reservation_cancelled"] ==1) {
		$cancelled = $bookingLangObj->getLabel("RESERVATION_CONFIRMED_YES");
	}
$line = $reservation["reservation_date"].",".$reservation["reservation_time"];
		if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_surname"];
		}
		if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_name"];
		}
		if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_email"];
		}
		if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_phone"];
		}
		if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_message"];
		}
		if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_field1"];
		}
		if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_field2"];
		}
		if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_field3"];
		}
		if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) { 		
			$line.=",".$reservation["reservation_field4"];
		}
		if($bookingSettingObj->getSlotsUnlimited() == 2) {
			$line.=",".$reservation["reservation_seats"];
		}
		$line.=",".$confirmed.",".$cancelled."\r\n";
		fwrite($fp, $line);
	
}
fclose($fp);




?>
