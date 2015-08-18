<?php 
include 'common.php';
//check if reservation is passed
if(!$bookingReservationObj->isPassed($_GET["reservations"]) && !$bookingReservationObj->isAdminConfirmed($_GET["reservations"])) {
	$bookingReservationObj->confirmReservations($_GET["reservations"]);
	//send reservation email to user
	//get all reservations data
	$bookingReservationObj->setReservation($bookingListObj->getCustomerDataList($_GET["reservations"]));
	$to = $bookingReservationObj->getReservationEmail();
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=UTF-8\n";
	$headers .= "X-Priority: 5\n";
	$headers .= "X-MSMail-Priority: Low\n";
	$headers .= "X-Mailer: php\n";
	$headers .= "From: ".$bookingSettingObj->getNameFromReservation()." <".$bookingSettingObj->getEmailFromReservation().">\n" . "Reply-To: ".$bookingSettingObj->getEmailFromReservation()."\n";
		
	$bookingMailObj->setMail(1);
		
	$subject = $bookingMailObj->getMailSubject();
	//setting username in message
	$message=str_replace("[customer-name]",$bookingReservationObj->getReservationName(),$bookingMailObj->getMailText());
	//check if cancellation is enabled id email is 1
	if($bookingMailObj->getMailId() == 1 && $bookingSettingObj->getReservationCancel() == "1") {
		$message.=$bookingMailObj->getMailCancelText();
	}
	//setting reservation detail in message
	//get reservations list
	$slotsArray = $bookingListObj->getSlotsByReservationsList($_GET["reservations"]);
	//loop through slots
	$res_details = "";
	for($i=0;$i<count($slotsArray);$i++) {
		$bookingSlotsObj->setSlot($slotsArray[$i]);
		$bookingCalendarObj->setCalendar($bookingSlotsObj->getSlotCalendarId());	
		$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_VENUE")."</strong>: ".$bookingCalendarObj->getCalendarTitle()."<br>";
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
		
		$res_details.="<br><br>";
	}
	$message=str_replace("[reservation-details]",$res_details,$message);	
	
	if($bookingSettingObj->getReservationCancel() == "1") {
		$message=str_replace("[cancellation-link]","<a href='".site_url('')."/?p=".$post->ID."&cancel=1&reservations=".$_GET["reservations"]."'>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_MESSAGE4")."</a>",$message);
		$message=str_replace("[cancellation-link-url]",site_url('')."/?p=".$post->ID."&cancel=1&reservations=".$_GET["reservations"],$message);
	}
	
	$message.="<br><br>".$bookingMailObj->getMailSignature();
	
	//$headers = 'From: Booking Calendar <'.$bookingSettingObj->getEmailFromReservation().'>' . "\r\n";
	//mail($to, $subject, $message, $headers);
	wp_mail($to, $subject,$message, $headers );
 ?>

	<div class="booking_text_center booking_width_100p booking_margin_t_100">
        <div style="font-size: 30px;"><?php echo $bookingLangObj->getLabel("CONFIRM_RESERVATION_CONFIRMED"); ?></div>
        <div style="font-size: 20px; margin-top: 20px;"><?php echo $bookingLangObj->getLabel("CONFIRM_RESERVATION_CONFIRMED_2"); ?></div>
        
        <?php
        if($bookingSettingObj->getRedirect() != '') {
            ?>
            <div id="redirect_link_button" style="font-size: 20px; margin-top: 20px;"><a href="<?php echo $bookingSettingObj->getRedirect(); ?>"><?php echo $bookingLangObj->getLabel("CONFIRM_REDIRECT"); ?></a></div>
            <?php
        } else {
            ?>
            <div id="redirect_link_button" style="font-size: 20px; margin-top: 20px;"><a href="?p=<?php echo $post->ID;?>"><?php echo $bookingLangObj->getLabel("CONFIRM_REDIRECT"); ?></a></div>
            <?php
        }
        ?>
    </div>
    <?php
} else {
	?>
    <div class="booking_text_center booking_width_100p booking_margin_t_100">
        <div style="font-size: 30px;"><?php echo $bookingLangObj->getLabel("EXPIRED_LINK"); ?></div>
        
        <?php
        if($bookingSettingObj->getRedirect() != '') {
            ?>
            <div id="redirect_link_button" style="font-size: 20px; margin-top: 20px;"><a href="<?php echo $bookingSettingObj->getRedirect(); ?>"><?php echo $bookingLangObj->getLabel("CONFIRM_REDIRECT"); ?></a></div>
            <?php
        } else {
            ?>
            <div id="redirect_link_button" style="font-size: 20px; margin-top: 20px;"><a href="?p=<?php echo $post->ID;?>"><?php echo $bookingLangObj->getLabel("CONFIRM_REDIRECT"); ?></a></div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
