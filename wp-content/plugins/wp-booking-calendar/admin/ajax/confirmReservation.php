<?php
include '../common.php';

global $wpdb;
global $blog_id;
$blog_prefix=$blog_id."_";
if($blog_id==1) {
	$blog_prefix="";
}
$item_id = $_REQUEST["reservation_id"];	

$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_reservation SET reservation_confirmed = 1,admin_confirmed_cancelled = 1 WHERE reservation_id = %d",$item_id));

if($bookingSettingObj->getReservationConfirmationMode() == 3 || ($bookingSettingObj->getPaypal()==1 && $bookingSettingObj->getPaypalAccount() != '' && $bookingSettingObj->getPaypalLocale() != '' && $bookingSettingObj->getPaypalCurrency() != '')) {
	//send reservation email to user if setted in config
	$bookingReservationObj->setReservation($item_id);
	$bookingSlotsObj->setSlot($bookingReservationObj->getReservationSlotId());
	$bookingCalendarObj->setCalendar($bookingReservationObj->getReservationCalendarId());
	
	if($bookingReservationObj->getReservationEmail() != '') {
		$to = $bookingReservationObj->getReservationEmail();
		$headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "X-Priority: 5\n";
		$headers .= "X-MSMail-Priority: Low\n";
		$headers .= "X-Mailer: php\n";
		$headers .= "From: ".$bookingSettingObj->getNameFromReservation()." <".$bookingSettingObj->getEmailFromReservation().">\n" . "Reply-To: ".$bookingSettingObj->getEmailFromReservation()."\n";
		$bookingMailObj->setMail(4);
		$subject = $bookingMailObj->getMailSubject();
		
		$message=str_replace("[customer-name]",$bookingReservationObj->getReservationName(),$bookingMailObj->getMailText());
		if($bookingSettingObj->getReservationCancel() == "1") {
			$message.=$bookingMailObj->getMailCancelText();
		}	
		$res_details="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_VENUE")."</strong>: ".$bookingCalendarObj->getCalendarTitle()."<br>";
		$dateToSend = strftime('%B %d %Y',strtotime($bookingSlotsObj->getSlotDate()));
		if($bookingSettingObj->getDateFormat() == "UK") {
			$dateToSend = strftime('%d/%m/%Y',strtotime($bookingSlotsObj->getSlotDate()));
		} else if($bookingSettingObj->getDateFormat() == "EU") {
			$dateToSend = strftime('%Y/%m/%d',strtotime($bookingSlotsObj->getSlotDate()));
		} else {
			$dateToSend = strftime('%m/%d/%Y',strtotime($bookingSlotsObj->getSlotDate()));
		}
		$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_DATE")."</strong>: ".$dateToSend."<br>";
		if($bookingSlotsObj->getSlotSpecialMode() == 1) {
			if($bookingSettingObj->getTimeFormat() == "12") {
				$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_TIME")."</strong>: ".$bookingSlotsObj->getSlotTimeFromAMPM()."-".$bookingSlotsObj->getSlotTimeToAMPM();
			} else {
				$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_TIME")."</strong>: ".$bookingSlotsObj->getSlotTimeFrom()."-".$bookingSlotsObj->getSlotTimeTo();
			}
			if($bookingSlotsObj->getSlotSpecialText()!='') {
				$res_details.=" - ".$bookingSlotsObj->getSlotSpecialText();
			}
			$res_details.="<br>";
		} else if($bookingSlotsObj->getSlotSpecialMode() == 0 && $bookingSlotsObj->getSlotSpecialText() != '') {
			$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_TIME")."</strong>:".$bookingSlotsObj->getSlotSpecialText()."<br>";
		} else {
			if($bookingSettingObj->getTimeFormat() == "12") {
				$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_TIME")."</strong>: ".$bookingSlotsObj->getSlotTimeFromAMPM()."-".$bookingSlotsObj->getSlotTimeToAMPM()."<br>";
			} else {
				$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_TIME")."</strong>: ".$bookingSlotsObj->getSlotTimeFrom()."-".$bookingSlotsObj->getSlotTimeTo()."<br>";
			}
		}
		if($bookingSettingObj->getSlotsUnlimited() == 2) {
			$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_SEATS")."</strong>: ".$bookingReservationObj->getReservationSeats()."<br>";
		}
		if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
			$price= money_format('%!.2n',$bookingSlotsObj->getSlotPrice())."&nbsp;".$bookingSettingObj->getPaypalCurrency();			
			$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_PRICE")."</strong>: ".$price."<br>";
		}
		$res_details.="<br><br>";
		
		$message=str_replace("[reservation-details]",$res_details,$message);
		if($bookingSettingObj->getReservationCancel() == "1") {
			$listReservations=md5($bookingReservationObj->getReservationId());
			$message=str_replace("[cancellation-link]","<a href='".site_url('')."/?p=".$bookingReservationObj->getReservationPostId()."&cancel=1&reservations=".$listReservations."'>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_MESSAGE4")."</a>",$message);
			$message=str_replace("[cancellation-link-url]",site_url('')."/?p=".$bookingReservationObj->getReservationPostId()."&cancel=1&reservations=".$listReservations,$message);
		}
		
		$message.="<br><br>".$bookingMailObj->getMailSignature();
		
		//$headers = 'From: Booking Calendar <'.$bookingSettingObj->getEmailFromReservation().'>' . "\r\n";
		//mail($to, $subject, $message, $headers);
		wp_mail($to, $subject,$message, $headers );
	}
}


?>
