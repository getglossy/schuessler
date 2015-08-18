<?php 
include 'common.php';
//check if reservation is passed
if(!$bookingReservationObj->isPassed($_GET["reservations"])) {
	$calendar_id=$bookingReservationObj->cancelReservations($_GET["reservations"]);
	 ?>
	<div class="booking_text_center booking_width_100p booking_margin_t_100">
        <div style="font-size: 30px;"><?php echo $bookingLangObj->getLabel("CANCEL_RESERVATION_CONFIRMED"); ?></div>
        <div style="font-size: 20px; margin-top: 20px;"><?php echo $bookingLangObj->getLabel("CANCEL_RESERVATION_CONFIRMED_2"); ?></div>
        
        <?php
        if($bookingSettingObj->getCancelRedirect() != '') {
            ?>
            <div id="redirect_link_button" style="font-size: 20px; margin-top: 20px;"><a href="<?php echo $bookingSettingObj->getCancelRedirect(); ?>"><?php echo $bookingLangObj->getLabel("CANCEL_REDIRECT"); ?></a></div>
            <?php
        } else {
            ?>
            <div id="redirect_link_button" style="font-size: 20px; margin-top: 20px;"><a href="?p=<?php echo $post->ID; ?>"><?php echo $bookingLangObj->getLabel("CANCEL_REDIRECT"); ?></a></div>
            <?php
        }
        ?>
    </div>
 	<?php 
	
	
	//send reservation email to admin
	$to = $bookingSettingObj->getEmailReservation();
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=UTF-8\n";
	$headers .= "X-Priority: 5\n";
	$headers .= "X-MSMail-Priority: Low\n";
	$headers .= "X-Mailer: php\n";
	$headers .= "From: ".$bookingSettingObj->getNameFromReservation()." <".$bookingSettingObj->getEmailFromReservation().">\n" . "Reply-To: ".$bookingSettingObj->getEmailFromReservation()."\n";
	$subject = $bookingLangObj->getLabel("CANCEL_MAIL_ADMIN_SUBJECT");
	$message=$bookingLangObj->getLabel("CANCEL_MAIL_ADMIN_MESSAGE1").'<a href="'.plugins_url('wp-booking-calendar/admin').'/reservations.php">'.$bookingLangObj->getLabel("CANCEL_MAIL_ADMIN_MESSAGE2").'</a><br />';
	//get reservations details
	$resDetailsArr=$bookingReservationObj->getReservationsDetails($_GET["reservations"]);
	
	foreach($resDetailsArr as $reservationId =>$reservation) {
		$bookingCalendarObj->setCalendar($reservation["calendar_id"]);
		if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE2")."</strong>: ".$reservation["reservation_name"]."<br>";
		}
		if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE3")."</strong>: ".$reservation["reservation_surname"]."<br>";
		}
		if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE4")."</strong>: ".$reservation["reservation_email"]."<br>";
		}
		if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE5")."</strong>: ".$reservation["reservation_phone"]."<br>";
		}
		
		if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE6")."</strong>: ".$reservation["reservation_message"]."<br>";
		}	
		if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE10")."</strong>: ".$reservation["reservation_field1"]."<br>";
		}
		if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE11")."</strong>: ".$reservation["reservation_field2"]."<br>";
		}
		if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE12")."</strong>: ".$reservation["reservation_field3"]."<br>";
		}
		if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE13")."</strong>: ".$reservation["reservation_field4"]."<br>";
		}
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_CALENDAR")."</strong>: ".$bookingCalendarObj->getCalendarTitle()."<br>";
		$dateToSend = strftime('%B %d %Y',strtotime($reservation["reservation_date"]));
		if($bookingSettingObj->getDateFormat() == "UK") {
			$dateToSend = strftime('%d/%m/%Y',strtotime($reservation["reservation_date"]));
		} else if($bookingSettingObj->getDateFormat() == "EU") {
			$dateToSend = strftime('%Y/%m/%d',strtotime($reservation["reservation_date"]));
		} else {
			$dateToSend = strftime('%m/%d/%Y',strtotime($reservation["reservation_date"]));
		}
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_DATE")."</strong>: ".$dateToSend."<br>";
		if($bookingSettingObj->getTimeFormat() == "12") {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_TIME")."</strong>: ".$reservation["reservation_time_from_ampm"]."-".$reservation["reservation_time_to_ampm"]."<br>";
		} else {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_TIME")."</strong>: ".$reservation["reservation_time_from"]."-".$reservation["reservation_time_to"]."<br>";
		}
		if($bookingSettingObj->getSlotsUnlimited() == 2) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_SEATS")."</strong>: ".$reservation["reservation_seats"]."<br>";
		}
		if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
			$price= money_format('%!.2n',$reservation["reservation_price"])."&nbsp;".$bookingSettingObj->getPaypalCurrency();			
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_PRICE")."</strong>: ".$price."<br>";
		}
	}
	
	wp_mail($to, $subject, $message, $headers);
	
	
} else {
	?>
    <div class="booking_text_center booking_width_100p booking_margin_t_100">
        <div style="font-size: 30px;"><?php echo $bookingLangObj->getLabel("EXPIRED_LINK"); ?></div>
       
        <?php
        if($bookingSettingObj->getCancelRedirect() != '') {
            ?>
            <div id="redirect_link_button" style="font-size: 20px; margin-top: 20px;"><a href="<?php echo $bookingSettingObj->getCancelRedirect(); ?>"><?php echo $bookingLangObj->getLabel("CANCEL_REDIRECT"); ?></a></div>
            <?php
        } else {
            ?>
            <div id="redirect_link_button" style="font-size: 20px; margin-top: 20px;"><a href="?p=<?php echo $post->ID; ?>"><?php echo $bookingLangObj->getLabel("CANCEL_REDIRECT"); ?></a></div>
            <?php
        }
        ?>
    </div>
    <?php
	
}
?>
