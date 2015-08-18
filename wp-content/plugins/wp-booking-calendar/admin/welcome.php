<?php
include 'common.php';

?>

<div class="booking_padding_20 booking_font_20 booking_line_percent booking_bg_fff">
	
    <!-- logo -->
	<div><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/logo_admin.gif"  /></div>
	<!-- welcome text -->
	<div class="booking_padding_20"><p><?php echo $bookingLangObj->getLabel("WELCOME_TEXT1"); ?><br /><?php echo $bookingLangObj->getLabel("WELCOME_TEXT2"); ?></p></div>
	<!-- warning text -->
	<?php
	if(($bookingSettingObj->getReservationConfirmationMode() == 0 && $bookingSettingObj->getTimezone() == '') || count($bookingListObj->getCalendarsList()) == 0 ) {
		?>
		<div class="booking_padding_20 booking_bg_f00 booking_mark_fff">
        	<p>
				<?php echo $bookingLangObj->getLabel("WELCOME_TEXT3"); ?><br />
                <?php echo $bookingLangObj->getLabel("WELCOME_TEXT4"); ?><br />
                <?php echo $bookingLangObj->getLabel("WELCOME_TEXT5"); ?><strong><?php echo $bookingLangObj->getLabel("WELCOME_TEXT6"); ?></strong><br />
                <?php echo $bookingLangObj->getLabel("WELCOME_TEXT7"); ?>
            </p>
        </div>
		<?php
	}
	?>
               
</div>
