<?php
include '../common.php';
$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=UTF-8\n";
$headers .= "X-Priority: 5\n";
$headers .= "X-MSMail-Priority: Low\n";
$headers .= "X-Mailer: php\n";
$headers .= "From: ".$bookingSettingObj->getNameFromReservation()." <".$bookingSettingObj->getEmailFromReservation().">\n" . "Reply-To: ".$bookingSettingObj->getEmailFromReservation()."\n";
$headers .= "Cc: ".$_POST["user_contact_cc"]."\r\n";
$headers .= "Bcc: ".$_POST["user_contact_bcc"]."\r\n";

$subject = $_POST["user_contact_subject"];
$message=$_POST["user_contact_message"];
$to=$_POST["user_contact_email"];
if(wp_mail($to, $subject,$message, $headers )) {
	?>
    <script>
		window.parent.$wbc('#contact_modal').html('<?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_MESSAGE_SENT"); ?><br><input type="button" onclick="hideModal()" value="close">');
	</script>
    <?php
} else {
	?>
    <script>
		window.parent.alert('<?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_MESSAGE_ERROR"); ?>');
	</script>
    <?php
}

?>
