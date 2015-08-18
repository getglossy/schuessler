<?php
include '../common.php';

$confirm=0;
$bookingCalendarObj->setCalendar($_POST["calendar_id"]);
if($bookingSettingObj->getRecaptchaEnabled() == "1") {
	require_once('../include/recaptchalib.php');
	$privatekey = $bookingSettingObj->getRecaptchaPrivateKey();
	$resp = recaptcha_check_answer ($privatekey,
								$_SERVER["REMOTE_ADDR"],
								$_POST["recaptcha_challenge_field"],
								$_POST["recaptcha_response_field"]);
	
	if (!$resp->is_valid) {
		// What happens when the CAPTCHA was entered incorrectly
		?>
		<script>
			window.parent.showCaptchaError();
		</script>
		<?php
	} else {
		// Your code here to handle a successful verification
		$listReservations=$bookingReservationObj->insertReservation($bookingSettingObj);
		if($listReservations != '') {
			if($bookingSettingObj->getReservationConfirmationMode() == 1 && !isset($_POST["with_paypal"])) {
				$bookingReservationObj->confirmReservations($listReservations);
			}
			$confirm = 1;
		} else {
			$confirm = 0;
		}
	}
} else {
	$listReservations=$bookingReservationObj->insertReservation($bookingSettingObj);
	if($listReservations != '') {
		if($bookingSettingObj->getReservationConfirmationMode() == 1 && !isset($_POST["with_paypal"])) {
			$bookingReservationObj->confirmReservations($listReservations);
		}
		$confirm = 1;
	} else {
		$confirm = 0;
	}
}
if($confirm == 1) {
	
	if(isset($_POST["with_paypal"])) {
		//set session variables if it's from paypal
		$_SESSION["reservation_paypal_list"] = $listReservations;
	}
	//send reservation email to admin
	//check first if the current calendar has a custom email address
	
	if($bookingCalendarObj->getCalendarEmail() != '') {
		$to = $bookingCalendarObj->getCalendarEmail();
	} else {
		$to = $bookingSettingObj->getEmailReservation();
	}
	
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=UTF-8\n";
	$headers .= "X-Priority: 5\n";
	$headers .= "X-MSMail-Priority: Low\n";
	$headers .= "X-Mailer: php\n";
	$headers .= "From: ".$bookingSettingObj->getNameFromReservation()." <".$bookingSettingObj->getEmailFromReservation().">\n" . "Reply-To: ".$bookingSettingObj->getEmailFromReservation()."\n";
	$subject = $bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_SUBJECT");
	$message=$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE1")."<br>";
	
	if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE2")."</strong>: ".$_POST["reservation_name"]."<br>";
	}
	if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE3")."</strong>: ".$_POST["reservation_surname"]."<br>";
	}
	if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE4")."</strong>: ".$_POST["reservation_email"]."<br>";
	}
	if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE5")."</strong>: ".$_POST["reservation_phone"]."<br>";
	}
	
	if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE6")."</strong>: ".$_POST["reservation_message"]."<br>";
	}	
	if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE10")."</strong>: ".$_POST["reservation_field1"]."<br>";
	}
	if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE11")."</strong>: ".$_POST["reservation_field2"]."<br>";
	}
	if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE12")."</strong>: ".$_POST["reservation_field3"]."<br>";
	}
	if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) {
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE13")."</strong>: ".$_POST["reservation_field4"]."<br>";
	}
	$message.="<br><strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE7")."</strong>:<br>";
	$message.="<ul type='disc'>";
	//loop through slots
	$paypalHtml = "";
	for($i=0;$i<count($_POST["reservation_slot"]);$i++) {
		$bookingSlotsObj->setSlot($_POST["reservation_slot"][$i]);
		$bookingCalendarObj->setCalendar($_POST["calendar_id"]);
		///PAYPAL/////
		if($bookingSlotsObj->getSlotSpecialMode() == 1) {
			if($bookingSettingObj->getTimeFormat() == "12") {
				$time= date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeFrom(),0,5)))." - ".date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeTo(),0,5)));
			} else {
				$time= substr($bookingSlotsObj->getSlotTimeFrom(),0,5)." - ".substr($bookingSlotsObj->getSlotTimeTo(),0,5);
			}
			if($bookingSlotsObj->getSlotSpecialText() != '') {
				$time.= " - ".$bookingSlotsObj->getSlotSpecialText(); 
			}
		} else if($bookingSlotsObj->getSlotSpecialMode() == 0 && $bookingSlotsObj->getSlotSpecialText() != '') {
			$time= $bookingSlotsObj->getSlotSpecialText(); 
		} else {
			if($bookingSettingObj->getTimeFormat() == "12") {
				echo date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeFrom(),0,5)))." - ".date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeTo(),0,5)));
			} else {
				echo substr($bookingSlotsObj->getSlotTimeFrom(),0,5)." - ".substr($bookingSlotsObj->getSlotTimeTo(),0,5);
			}
		}
		if($bookingSettingObj->getDateFormat() == "UK") {
			$dateToSend = strftime('%d/%m/%Y',strtotime($bookingSlotsObj->getSlotDate()));
		} else if($bookingSettingObj->getDateFormat() == "EU") {
			$dateToSend = strftime('%Y/%m/%d',strtotime($bookingSlotsObj->getSlotDate()));
		} else {
			$dateToSend = strftime('%m/%d/%Y',strtotime($bookingSlotsObj->getSlotDate()));
		}
		$info_slot = $dateToSend." ".$time;
		$seats = 1;
		if($bookingSettingObj->getSlotsUnlimited() == 2) {
			$seats=$_POST["reservation_seats_".$_POST["reservation_slot"][$i]];
		}
		$paypalHtml.=trim('<input type="hidden" name="item_name_'.($i+1).'" value="'.$info_slot.'" /><input type="hidden" name="amount_'.($i+1).'" value="'.$bookingSlotsObj->getSlotPrice().'" /><input type="hidden" name="quantity_'.($i+1).'" value="'.$seats.'" />');
		/////END PAYPAL////
		$message.="<li>";
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_CALENDAR")."</strong>: ".$bookingCalendarObj->getCalendarTitle()."<br>";
		$dateToSend = strftime('%B %d %Y',strtotime($bookingSlotsObj->getSlotDate()));
		if($bookingSettingObj->getDateFormat() == "UK") {
			$dateToSend = strftime('%d/%m/%Y',strtotime($bookingSlotsObj->getSlotDate()));
		} else if($bookingSettingObj->getDateFormat() == "EU") {
			$dateToSend = strftime('%Y/%m/%d',strtotime($bookingSlotsObj->getSlotDate()));
		} else {
			$dateToSend = strftime('%m/%d/%Y',strtotime($bookingSlotsObj->getSlotDate()));
		}
		$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_DATE")."</strong>: ".$dateToSend."<br>";
		if($bookingSettingObj->getTimeFormat() == "12") {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_TIME")."</strong>: ".$bookingSlotsObj->getSlotTimeFromAMPM()."-".$bookingSlotsObj->getSlotTimeToAMPM()."<br>";
		} else {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_TIME")."</strong>: ".$bookingSlotsObj->getSlotTimeFrom()."-".$bookingSlotsObj->getSlotTimeTo()."<br>";
		}
		if($bookingSettingObj->getSlotsUnlimited() == 2) {
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_SEATS")."</strong>: ".$_POST["reservation_seats_".$_POST["reservation_slot"][$i]]."<br>";
		}
		if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
			$price= money_format('%!.2n',$bookingSlotsObj->getSlotPrice())."&nbsp;".$bookingSettingObj->getPaypalCurrency();			
			$message.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_PRICE")."</strong>: ".$price."<br>";
		}
		$message.="</li>";
	}
	$message.="</ul>";
	if($bookingSettingObj->getReservationConfirmationMode() == 3) {
		
		$message.=$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE8").'<a href="'.site_url('wp-admin/admin.php?page=wp-booking-calendar-reservations').'">'.$bookingLangObj->getLabel("DORESERVATION_MAIL_ADMIN_MESSAGE9").'</a>';
	}
	//$headers = 'From: Booking Calendar <'.$bookingSettingObj->getEmailFromReservation().'>' . "\r\n";
	//mail($to, $subject, $message, $headers);
	wp_mail($to, $subject,$message, $headers );
	
	if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) {
		//send reservation email to user
		$to = $_POST["reservation_email"];
		$headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "X-Priority: 5\n";
		$headers .= "X-MSMail-Priority: Low\n";
		$headers .= "X-Mailer: php\n";
		$headers .= "From: ".$bookingSettingObj->getNameFromReservation()." <".$bookingSettingObj->getEmailFromReservation().">\n" . "Reply-To: ".$bookingSettingObj->getEmailFromReservation()."\n";
		//WARNING!! static mail record ids, if deleted/changed, must be changed here also
		switch($bookingSettingObj->getReservationConfirmationMode()) {
			case "1":
				$bookingMailObj->setMail(1);
				break;
			case "2":
				$bookingMailObj->setMail(2);
				break;
			case "3":
				$bookingMailObj->setMail(3);
				break;
		}
		if($bookingSettingObj->getPaypal()==1 && $bookingSettingObj->getPaypalAccount() != '' && $bookingSettingObj->getPaypalLocale() != '' && $bookingSettingObj->getPaypalCurrency() != '') {
			$bookingMailObj->setMail(1);
		}
		$subject = $bookingMailObj->getMailSubject();
		//setting username in message
		$message=str_replace("[customer-name]",$_POST["reservation_name"],$bookingMailObj->getMailText());
		//check if cancellation is enabled id email is 1
		if($bookingMailObj->getMailId() == 1 && $bookingSettingObj->getReservationCancel() == "1") {
			$message.=$bookingMailObj->getMailCancelText();
		}
		//setting reservation detail in message
		//loop through slots
		$res_details = "";
		for($i=0;$i<count($_POST["reservation_slot"]);$i++) {
			$bookingSlotsObj->setSlot($_POST["reservation_slot"][$i]);
			$bookingCalendarObj->setCalendar($_POST["calendar_id"]);	
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
			if($bookingSettingObj->getSlotsUnlimited() == 2) {
				$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_SEATS")."</strong>: ".$_POST["reservation_seats_".$_POST["reservation_slot"][$i]]."<br>";
			}
			if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
				$price= money_format('%!.2n',$bookingSlotsObj->getSlotPrice())."&nbsp;".$bookingSettingObj->getPaypalCurrency();			
				$res_details.="<strong>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_PRICE")."</strong>: ".$price."<br>";
			}
			$res_details.="<br><br>";
		}
		$message=str_replace("[reservation-details]",$res_details,$message);	
		
		
		if($bookingMailObj->getMailId() == 2) {
			//setting reservation confirmation link in message
			//if he must confirm it via mail, I send the link
			
			
			
			$message=str_replace("[confirmation-link]","<a href='".site_url('')."/?p=".$_POST["post_id"]."&confirm=1&reservations=".$listReservations."'>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_MESSAGE3")."</a>",$message);
			$message=str_replace("[confirmation-link-url]",site_url('')."/?p=".$_POST["post_id"]."&confirm=1&reservations=".$listReservations,$message);
		}
		
		if($bookingMailObj->getMailId() == 1 && $bookingSettingObj->getReservationCancel() == "1") {
			$message=str_replace("[cancellation-link]","<a href='".site_url('')."/?p=".$_POST["post_id"]."&cancel=1&reservations=".$listReservations."'>".$bookingLangObj->getLabel("DORESERVATION_MAIL_USER_MESSAGE4")."</a>",$message);
			$message=str_replace("[cancellation-link-url]",site_url('')."/?p=".$_POST["post_id"]."&cancel=1&reservations=".$listReservations,$message);
		}
		$message.="<br><br>".$bookingMailObj->getMailSignature();
		
		//$headers = 'From: Booking Calendar <'.$bookingSettingObj->getEmailFromReservation().'>' . "\r\n";
		//mail($to, $subject, $message, $headers);
		wp_mail($to, $subject,$message, $headers );
		
	}
	$arrReservations = explode(",",$listReservations);
	$htmlToAppend = "";
	for($i=0;$i<count($arrReservations);$i++) {
		$htmlToAppend.='<input type="hidden" name="item_number_'.($i+1).'" value="'.$arrReservations[$i].'" />';
	}
	?>
	<script>
		<?php
		if(isset($_POST["with_paypal"])) {
			?>
			htmlToAppend = "";
			window.parent.$wbc('#slots_purchased').append('<input type="hidden" name="custom" value="<?php echo $listReservations; ?>" />');
			window.parent.$wbc('#slots_purchased').append('<?php echo addslashes($paypalHtml); ?>');
			window.parent.submitPaypal();
			<?php
		} else {
			
			if($bookingSettingObj->getRedirectBookingPath() == '') {
				?>
				window.parent.showResponse(<?php echo $bookingCalendarObj->getCalendarId(); ?>);
				<?php
			} else {
				?>
				window.parent.document.location = '<?php echo $bookingSettingObj->getRedirectBookingPath(); ?>';
				<?php
			}
			
		}
		?>
	</script>
	<?php
} else {
	$publickey = "";
	if($bookingSettingObj->getRecaptchaEnabled() == "1") {
		$publickey = $bookingSettingObj->getRecaptchaPublicKey();
	}
	?>
	<script>
		window.parent.alert('<?php echo $bookingLangObj->getLabel("DORESERVATION_ERROR"); ?>');		
		window.parent.hideBookingResponse(<?php echo $bookingCalendarObj->getCalendarId(); ?>,'<?php echo $publickey; ?>');
	</script>
	<?php
}


?>
