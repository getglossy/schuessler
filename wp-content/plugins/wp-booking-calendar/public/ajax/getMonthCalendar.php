<?php
include '../common.php';
//check what date format in settings
if($bookingSettingObj->getDateFormat() == "UK" || $bookingSettingObj->getDateFormat() == "EU") {
	$startDay=1;
	$weekday_format="N";
	$lastWeekDay=7;
} else {
	$startDay=0;
	$weekday_format="w";
	$lastWeekDay=6;
}
if($_GET["calendar_id"] > 0) {
	$bookingCalendarObj->setCalendar($_GET["calendar_id"]);
	$arrayMonth = $bookingListObj->getMonthCalendar($_GET["month"],$_GET["year"],$weekday_format);
	
	$i = 0;
	$slots_popup_enabled = $bookingSettingObj->getSlotsPopupEnabled();
	foreach($arrayMonth as $daynum => $daydata) {
		if($i == 0) {
			//check what's first week day and add cells
			for($j=$startDay;$j<$daydata["dayofweek"];$j++) {
				?>
				<div class="booking_day_container booking_day_grey booking_font_14"><a style="background-color:<?php echo $bookingSettingObj->getDayGreyBg(); ?>" class="booking_font_14"></a></div>
				<?php
			}
		}
		$numslots = $bookingListObj->getSlotsPerDay($_GET["year"],$_GET["month"],$daynum,$_GET["calendar_id"],$bookingSettingObj);
		
		//get default background color from style options, have to maintain classes for js to work
		$background = "booking_day_white";
		$background_color = $bookingSettingObj->getDayWhiteBg();
		$newstyle='';
		$newstyle1 = 'style="color:'.$bookingSettingObj->getDayWhiteLine1Color().'"';
		$newstyle2 = 'style="color:'.$bookingSettingObj->getDayWhiteLine2Color().'"';
		$over=1;
		
		$date = date_create(date('Y-m-d'));
		if(function_exists("date_add")) {
			date_add($date, date_interval_create_from_date_string($bookingSettingObj->getBookFrom().' days'));
		} else {
			date_modify($date, '+'.$bookingSettingObj->getBookFrom().' day');
		}
		
		//date_add($date, date_interval_create_from_date_string($bookingSettingObj->getBookFrom().' days'));
		$bookfromdate = date_format($date, 'Ymd');
		
		if($bookingSettingObj->getBookTo() > 0) {
			$date = date_create(date('Y-m-d'));
			if(function_exists("date_add")) {
				date_add($date, date_interval_create_from_date_string($bookingSettingObj->getBookTo().' days'));
			} else {
				date_modify($date, '+'.$bookingSettingObj->getBookTo().' day');
			}
			
			//date_add($date, date_interval_create_from_date_string($bookingSettingObj->getBookFrom().' days'));
			$booktodate = date_format($date, 'Ymd');
		} else {
			$booktodate = '30001010';
		}
		//if it's a past day or there are no slots
		if($daydata["yearnum"].$daydata["monthnum"].$daydata["daynum"] < $bookfromdate || $numslots == -1 || $daydata["yearnum"].$daydata["monthnum"].$daydata["daynum"] > $booktodate) {
			$background_color = $bookingSettingObj->getDayWhiteBgDisabled();
			$newstyle='style="color:#CCC"';
			$newstyle1 = 'style="color:'.$bookingSettingObj->getDayWhiteLine1DisabledColor().'"';
			$newstyle2 = 'style="color:'.$bookingSettingObj->getDayWhiteLine2DisabledColor().'"';
			$over=0;
		}
		//no slots, it's day greater or equal to today, but it's red because it's sold out
		if($numslots == 0 && $daydata["yearnum"].$daydata["monthnum"].$daydata["daynum"] >= date('Ymd')) {
			$background="booking_day_red";
			$background_color = $bookingSettingObj->getDayRedBg();
			$newstyle1 = 'style="color:'.$bookingSettingObj->getDayRedLine1Color().'"';
			$newstyle2 = 'style="color:'.$bookingSettingObj->getDayRedLine2Color().'"';
		} else if($daydata["yearnum"].$daydata["monthnum"].$daydata["daynum"] == date('Ymd')) {
			// today without sold out
			$background="booking_day_black";
			$background_color = $bookingSettingObj->getDayBlackBg();
			$newstyle1 = 'style="color:'.$bookingSettingObj->getDayBlackLine1Color().'"';
			$newstyle2 = 'style="color:'.$bookingSettingObj->getDayBlackLine2Color().'"';
		} else if($numslots == -1) {
			//no slots but not sold out
			$background="booking_day_white";
			$background_color = $bookingSettingObj->getDayWhiteBgDisabled();
			$newstyle1 = 'style="color:'.$bookingSettingObj->getDayWhiteLine1DisabledColor().'"';
			$newstyle2 = 'style="color:'.$bookingSettingObj->getDayWhiteLine2DisabledColor().'"';
		}
		// last day of week
		if($daydata["dayofweek"] == $lastWeekDay) {
			
			?>
			<div class="booking_day_container <?php echo $background; ?> booking_font_14" style="margin-right: 0px;"><a class="booking_font_14" style="cursor:pointer;background-color:<?php echo $background_color; ?>" year="<?php echo $_GET["year"]; ?>" month="<?php echo $_GET["month"]; ?>" day="<?php echo $daynum; ?>" popup="<?php echo $slots_popup_enabled; ?>" over="<?php echo $over; ?>">
				<div class="booking_day_number booking_font_14" <?php echo $newstyle1; ?>><?php echo $daynum; ?></div>
                <div class="booking_day_book booking_font_14" <?php echo $newstyle1; ?>>
					<?php
					if($numslots>0 && $daydata["yearnum"].$daydata["monthnum"].$daydata["daynum"] >= $bookfromdate && $daydata["yearnum"].$daydata["monthnum"].$daydata["daynum"] <= $booktodate) {
						// there are slots, date is greater or equal to today: book now text
						echo $bookingLangObj->getLabel("GETMONTHCALENDAR_BOOK_NOW");
					} else if($numslots == 0) {
						// date is greater or equal to today, there are no slots: sold out text
						echo $bookingLangObj->getLabel("GETMONTHCALENDAR_SOLDOUT");
					}
					?>
				</div>
                <div class="booking_cleardiv"></div>
				<div class="booking_day_slots booking_font_14" <?php echo $newstyle2; ?>>
					<?php
					// if there are slots: slots number text
					if($numslots>0) {
						echo $bookingLangObj->getLabel("GETMONTHCALENDAR_SLOTS_AVAILABLE").": ".$numslots;
					} else {
						// if there aren't slots: text no slots
						echo $bookingLangObj->getLabel("GETMONTHCALENDAR_NO_SLOTS_AVAILABLE");
					}
					?>
				</div>
				
			</a></div>
			<?php
		// all other days
		} else {
			?>
			<div class="booking_day_container <?php echo $background; ?> booking_font_14"><a class="booking_font_14" style="cursor:pointer;background-color:<?php echo $background_color; ?>" year="<?php echo $_GET["year"]; ?>" month="<?php echo $_GET["month"]; ?>" day="<?php echo $daynum; ?>" popup="<?php echo $slots_popup_enabled; ?>" over="<?php echo $over; ?>">
				<!-- giorno del mese -->
                <div class="booking_day_number booking_font_14" <?php echo $newstyle1; ?>><?php echo $daynum; ?></div>
                <!-- book now o sold out -->
                <div class="booking_day_book booking_font_14" <?php echo $newstyle1; ?>>
					<?php
					if($numslots>0 && $daydata["yearnum"].$daydata["monthnum"].$daydata["daynum"] >= $bookfromdate && $daydata["yearnum"].$daydata["monthnum"].$daydata["daynum"] <= $booktodate) {
						echo $bookingLangObj->getLabel("GETMONTHCALENDAR_BOOK_NOW");
					} else if($numslots == 0)  {
						echo $bookingLangObj->getLabel("GETMONTHCALENDAR_SOLDOUT");
					}
					?>
				</div>
                <div class="booking_cleardiv"></div>
                <!-- time slots available -->
				<div class="booking_day_slots booking_font_14" <?php echo $newstyle2; ?>>
					<?php
					if($numslots>0) {
						echo $bookingLangObj->getLabel("GETMONTHCALENDAR_SLOTS_AVAILABLE").": ".$numslots;
					} else {
						echo $bookingLangObj->getLabel("GETMONTHCALENDAR_NO_SLOTS_AVAILABLE");
					}
					?>
				</div>
				
			</a></div>
			<?php
		}
		
		$i++;
		if($i == count($arrayMonth)) {
			$lastDay=$daydata["dayofweek"];
		}
	}
	//check what's last week day and add cells
	for($j=$lastWeekDay;$j>$lastDay;$j--) {
		?>
		<div class="booking_day_container booking_day_grey booking_font_14"><a class="booking_font_14" style="background-color:<?php echo $bookingSettingObj->getDayGreyBg(); ?>"></a></div>
		<?php
	}
	?>
	<script>
		var $wbc = jQuery;
		$wbc(function() {
			$wbc('#booking_month_nav_prev').html("<a href=\"javascript:getBookingPreviousMonth(<?php echo $bookingCalendarObj->getCalendarId(); ?>,'<?php echo $_GET["publickey"]; ?>',<?php echo $bookingSettingObj->getCalendarMonthLimitPast(); ?>);\" class=\"booking_month_nav_button booking_month_navigation_button_custom\"><img src=\"<?php echo plugins_url('wp-booking-calendar/public');?>/images/prev.png\" /></a>");
			$wbc('#booking_month_nav_next').html("<a href=\"javascript:getBookingNextMonth(<?php echo $bookingCalendarObj->getCalendarId(); ?>,'<?php echo $_GET["publickey"]; ?>',<?php echo $bookingSettingObj->getCalendarMonthLimitFuture(); ?>);\" class=\"booking_month_nav_button booking_month_navigation_button_custom\"><img src=\"<?php echo plugins_url('wp-booking-calendar/public');?>/images/next.png\" /></a>");
		});
	</script>
<?php
} else {
	$arrayMonth = $bookingListObj->getMonthCalendar($_GET["month"],$_GET["year"],$weekday_format);
	
	$i = 0;
	foreach($arrayMonth as $daynum => $daydata) {
		if($i == 0) {
			//check what's first week day and add cells
			for($j=$startDay;$j<$daydata["dayofweek"];$j++) {
				?>
				<div class="booking_day_container booking_day_grey booking_font_14"><a class="booking_font_14" style="background-color:<?php echo $bookingSettingObj->getDayGreyBg(); ?>" ></a></div>
				<?php
			}
		}
		
		$background = "booking_day_white";
		$background_color = $bookingSettingObj->getDayWhiteBgDisabled();
		$newstyle='';
		$newstyle1='';
		$newstyle2='';
		$over=0;
		
		if($daydata["dayofweek"] == $lastWeekDay) {
			
			?>
			<div class="booking_day_container <?php echo $background; ?> booking_font_14" style="margin-right: 0px;"><a class="booking_font_14" style="cursor:pointer;background-color:<?php echo $background_color; ?>" year="<?php echo $_GET["year"]; ?>" month="<?php echo $_GET["month"]; ?>" day="<?php echo $daynum; ?>" popup="<?php echo $slots_popup_enabled; ?>" over="<?php echo $over; ?>">
				<div class="booking_day_number booking_font_14" <?php echo $newstyle; ?>><?php echo $daynum; ?></div>
				<div class="booking_day_slots booking_font_14" <?php echo $newstyle; ?>>
					
				</div>
				<div class="booking_day_book booking_font_14">
					
				</div>
			</a></div>
			<?php
		} else {
			?>
			<div class="booking_day_container <?php echo $background; ?> booking_font_14"><a class="booking_font_14" style="cursor:pointer;background-color:<?php echo $background_color; ?>" year="<?php echo $_GET["year"]; ?>" month="<?php echo $_GET["month"]; ?>" day="<?php echo $daynum; ?>" over="<?php echo $over; ?>">
				<div class="booking_day_number booking_font_14" <?php echo $newstyle; ?>><?php echo $daynum; ?></div>
				<div class="booking_day_slots booking_font_14" <?php echo $newstyle; ?>>
					
				</div>
				<div class="booking_day_book booking_font_14">
					
				</div>
			</a></div>
			<?php
		}
		
		$i++;
		if($i == count($arrayMonth)) {
			$lastDay=$daydata["dayofweek"];
		}
	}
	//check what's last week day and add cells
	for($j=$lastWeekDay;$j>$lastDay;$j--) {
		?>
		<div class="booking_day_container booking_day_grey booking_font_14"><a class="booking_font_14" style="background-color:<?php echo $bookingSettingObj->getDayGreyBg(); ?>"></a></div>
		<?php
	}
	?>
	<script>
		var $wbc = jQuery;
		$wbc(function() {
			$wbc('#booking_month_nav_prev').html("<a href=\"javascript:getBookingPreviousMonth('<?php echo $bookingCalendarObj->getCalendarId(); ?>','<?php echo $_GET["publickey"]; ?>',<?php echo $bookingSettingObj->getCalendarMonthLimitPast(); ?>);\" class=\"booking_month_nav_button booking_month_navigation_button_custom\"><img src=\"<?php echo plugins_url('wp-booking-calendar/public');?>/images/prev.png\" /></a>");
			$wbc('#booking_month_nav_next').html("<a href=\"javascript:getBookingNextMonth('<?php echo $bookingCalendarObj->getCalendarId(); ?>','<?php echo $_GET["publickey"]; ?>',<?php echo $bookingSettingObj->getCalendarMonthLimitFuture(); ?>);\" class=\"booking_month_nav_button booking_month_navigation_button_custom\"><img src=\"<?php echo plugins_url('wp-booking-calendar/public');?>/images/next.png\" /></a>");
		});
	</script>
    <?php
}
?>
