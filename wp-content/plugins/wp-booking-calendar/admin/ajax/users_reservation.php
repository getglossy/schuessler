<!-- 
=======================
=== table header ==
=======================
-->
<div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">
    <!-- number -->
    <div class="booking_float_left booking_width_3p">#</div>
    
    <!-- check -->
    <div class="booking_float_left booking_width_3p"><input type="checkbox" name="selectAll" onclick="javascript:selectCheckbox('manage_reservations','reservations[]');" /></div>            
    
    <!-- date -->
    <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("RESERVATION_DATE_LABEL");?>&nbsp;<a href="javascript:orderby('date','<?php echo $_SESSION["orderbyUserReservationDate"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbyUserReservationDate"];?>.gif" border=0 /></a></div>            
    
    <!-- time -->
    <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("RESERVATION_TIME_LABEL");?>&nbsp;<a href="javascript:orderby('time','<?php echo $_SESSION["orderbyUserReservationTime"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbyUserReservationTime"];?>.gif" border=0 /></a></div>
    
    <!-- seats -->          
    <div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("RESERVATION_SEATS_LABEL");?></div>
    
    <!-- surname -->
    <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("RESERVATION_SURNAME_NAME_LABEL");?></div>            
    
    <!-- email -->
    <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("RESERVATION_EMAIL_LABEL");?></div>        
    
    <!-- confirmed -->
    <div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("RESERVATION_CONFIRMED_LABEL");?></div>
    
    <!-- delete -->
    <div class="booking_float_left booking_width_10p"></div>
    
    <!-- detail -->
    <div class="booking_float_left booking_width_10p"></div>            
    
    <div class="booking_cleardiv"></div>
    
</div>


<?php
$arrayReservations = $bookingListObj->getUsersReservationsList($_SESSION["qryUsersReservationsFilterString"],$_SESSION["qryUsersReservationsOrderString"],$_GET["user_id"]);                        
$i=1;
foreach($arrayReservations as $reservationId => $reservation) {		
	if($reservation["slot_active"] == 0) {
		$class="booking_table_row_red";
	} else {													
		if($i % 2) {
			$class="booking_alternate_table_row_white";
		} else {
			$class="booking_alternate_table_row_grey";
		}
	}
?>


<div id="row_<?php echo $reservationId; ?>" class="booking_border_b_1 booking_border_solid booking_border_ccc">
                
    <!-- number -->
    <div class="booking_float_left booking_width_3p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $i; ?></div>
    </div>
    
    <!-- check -->
    <div class="booking_float_left booking_width_3p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><input type="checkbox" name="reservations[]" value="<?php echo $reservationId; ?>" onclick="javascript:disableSelectAll('manage_reservations',this.checked);" /></div>
    </div> 
    
    <!-- date -->                 
    <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
        	<?php
			if($bookingSettingObj->getDateFormat() == "UK") {
				$dateToSend = strftime('%d/%m/%Y',strtotime($reservation["reservation_date"]));
			} else if($bookingSettingObj->getDateFormat() == "EU") {
				$dateToSend = strftime('%Y/%m/%d',strtotime($reservation["reservation_date"]));
			} else {
				$dateToSend = strftime('%m/%d/%Y',strtotime($reservation["reservation_date"]));
			}
			?>
			<?php echo $dateToSend; ?>
        </div>
    </div>
    
    <!-- time -->
    <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
			<?php
			if($bookingSettingObj->getTimeFormat() == "12") {
				echo date('h:i a',strtotime(substr($reservation["reservation_time"],0,5)));
				
			} else {
				echo substr($reservation["reservation_time"],0,5);
				
			}
			
			?>
        </div>
    </div>
    
    <!-- seats -->
    <div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $reservation["reservation_seats"]; ?></div>
    </div>
    
    <!-- surname -->
    <div class="booking_float_left booking_width_20p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $reservation["reservation_surname"].", ".$reservation["reservation_name"]; ?></div>
    </div>
    
    <!-- email -->
    <div class="booking_float_left booking_width_20p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $reservation["reservation_email"]; ?></div>
    </div>
    
   <!-- status -->
    <div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><span id="conferma_<?php echo $reservationId; ?>"><?php if($reservation["reservation_confirmed"]=='1' && $reservation["reservation_cancelled"] == 0) { ?><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /><?php } else if($reservation["reservation_cancelled"] == 0 && !$bookingReservationObj->isPassed(md5($reservationId)) && $confirm_function == 1){ ?><a href="javascript:confirmReservation(<?php echo $reservationId; ?>);"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /></a><?php } else if($reservation["reservation_cancelled"] == 0) {?><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /><?php } else { ?><?php echo $bookingLangObj->getLabel("RESERVATION_CANCELLED"); ?><?php } ?></span></div>
    </div>
    
    <!-- delete -->
    <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
        <?php
		
		if(!$bookingReservationObj->isPassed(md5($reservationId)) && $cancel_function == 1) {
			?>
			<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:cancelItem(<?php echo $reservationId; ?>,'reservations','reservation_id');"><?php echo $bookingLangObj->getLabel("USER_RESERVATION_CANCEL"); ?></a></div>
			<?php
		}
		?>
    </div>    
    
    <!-- detail -->                     
    <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="?page=wp-booking-calendar-orders&reservation_id=<?php echo $reservationId; ?>"><?php echo $bookingLangObj->getLabel("RESERVATION_DETAIL");?></a></div>
    </div>
    
    
    <div class="booking_cleardiv"></div>
</div>

<?php 
$i++;
} ?>
