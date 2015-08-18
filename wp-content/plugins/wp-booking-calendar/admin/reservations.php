<?php 
include 'common.php';

if(isset($_GET["calendar_id"])) {
	include 'reservation.php';
} else if(isset($_GET["reservation_id"])) {
	include 'reservation_detail.php';
	
} else {
	?>
	
	<div class="booking_padding_20 booking_font_14 booking_line_percent booking_bg_fff">
	
		<div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("RESERVATIONS"); ?></div>
		   
		<div class="booking_margin_t_20">
			   <div id="table" class="booking_font_12">
				
					<!-- 
					=======================
					=== table header ==
					=======================
					-->
					<div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">
						<!-- number -->
						<div class="booking_float_left booking_width_3p">#</div>
						
						<!-- calendar -->
						<div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("CALENDAR"); ?></div>
						
								  
						<!-- reservations -->
						<div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("RESERVATIONS"); ?></div>
				
						<!-- published -->
						<div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("RESERVATIONS_PUBLISHED_TITLE"); ?></div>
						
						<!-- list -->
						<div class="booking_float_left booking_width_10p"></div>
						
						<div class="booking_cleardiv"></div>
						
					</div>
				
					<?php                         
					$arrayCalendars = $bookingListObj->getCalendarsResList();                        
					$i=1;
					foreach($arrayCalendars as $calendarId => $calendar) {																			
						if($i % 2) {
							$class="booking_alternate_table_row_white";
						} else {
							$class="booking_alternate_table_row_grey";
						}
						
					?>
				
					<!-- number -->
					<div class="booking_float_left booking_width_3p booking_height_50 <?php echo $class; ?>">
						<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $i; ?></div>
					</div>  
								   
					<!-- calendar -->
					<div class="booking_float_left booking_width_20p booking_height_50 <?php echo $class; ?>">
						<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $calendar["calendar_title"]; ?></div>
					</div>
					
					<!-- reservation -->
					<div class="booking_float_left booking_width_10p booking_height_50  <?php echo $class; ?>">
						<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $calendar["tot_reservation"]; ?></div>
					</div>
					
					<!-- status -->
					<div class="booking_float_left booking_width_10p booking_height_50  <?php echo $class; ?>">
						<div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
							<?php if($calendar["calendar_active"]=='1') { ?><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /><?php } else { ?><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /><?php } ?>
						</div>
					</div> 
					
					<!-- list -->
					<div class="booking_float_left booking_width_10p booking_height_50  <?php echo $class; ?>">
						<div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
							<?php
							if($calendar["tot_reservation"]>0) {
								?>
								<a href="?page=wp-booking-calendar-reservations&calendar_id=<?php echo $calendarId; ?>"><?php echo $bookingLangObj->getLabel("RESERVATION_LIST"); ?></a>
								<?php
							}
							?>
						</div>
					</div>                            
				
					<div class="booking_cleardiv"></div>
				
				<?php 
				$i++;
				} ?>
			</div>
		</div>
		
	</div>
	<?php
}
?>
            
