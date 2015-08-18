<?php 
include 'common.php';

if(isset($_GET["mail_id"])) {
	include 'new_mail.php';
} else {

	?>
	
	<div class="booking_padding_20 booking_font_14 booking_line_percent booking_bg_fff">
	
		<div id="table" class="booking_font_12 booking_margin_t_20">
				
			<!-- 
			=======================
			=== table header ==
			=======================
			-->
			<div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">
				
				<!-- number -->
				<div class="booking_float_left booking_width_3p">#</div>
				
				
				<!-- description -->
				<div class="booking_float_left booking_width_90p"><?php echo $bookingLangObj->getLabel("MAIL_DESCRIPTION_LABEL"); ?></div>
							   
				<!-- modify -->
				<div class="booking_float_left booking_width_7p"></div>
				
				<div class="booking_cleardiv"></div>
			</div>
				
			
			<!-- 
			=======================
			=== table row ==
			=======================
			-->
			
			<?php                         
			$arrayMails = $bookingListObj->getMailsList();                        
			$i=1;
			foreach($arrayMails as $mailId => $mail) {																			
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
			
			<!-- description -->
			<div class="booking_float_left booking_width_90p booking_height_50  <?php echo $class; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $mail["email_name"]; ?></div>
			</div>
			
			<!-- modify -->
			<div class="booking_float_left booking_width_7p booking_height_50  <?php echo $class; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="?page=wp-booking-calendar-mails&mail_id=<?php echo $mailId; ?>"><?php echo $bookingLangObj->getLabel("MAIL_MODIFY"); ?></a></div>
			</div>                            
			
			<div class="booking_cleardiv"></div>
				
			<?php 
			$i++;
			} ?>
			
				
		</div>
	</div>
	<?php
}
?>
