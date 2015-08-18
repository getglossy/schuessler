<?php
include '../common.php';

if($_REQUEST["add_dates"]==1) {
	$date = str_replace(",","-",$_REQUEST["date_from"]);
	
	$newid=$bookingHolidayObj->addHoliday($date,"",$_GET["calendar_id"]);
	$newnum=$bookingHolidayObj->getHolidayRecordcount($_GET["calendar_id"]);
	if($newnum % 2) {
		$newclass="booking_alternate_table_row_white";
	} else {
		$newclass="booking_alternate_table_row_grey";
	}

	if($newid != '0') {
		
		?>
		<div id="row_<?php echo $newid; ?>">
			<div class="booking_float_left booking_width_5p booking_height_50 <?php echo $newclass; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $newnum; ?></div>
			</div>
			<div class="booking_float_left booking_width_5p booking_height_50 <?php echo $newclass; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><input type="checkbox" name="holidays[]" value="<?php echo $newid; ?>" onclick="javascript:disableSelectAll('manage_holidays',this.checked);" /></div>
			</div>                    
			<div class="booking_float_left booking_width_70p booking_height_50 <?php echo $newclass; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                	<?php
					if($bookingSettingObj->getDateFormat() == "UK") {
						$dateToSend = strftime('%d/%m/%Y',strtotime($date));
					} else if($bookingSettingObj->getDateFormat() == "EU") {
						$dateToSend = strftime('%Y/%m/%d',strtotime($date));
					} else {
						$dateToSend = strftime('%m/%d/%Y',strtotime($date));
					}
					?>
					<?php echo $dateToSend; ?>
                </div>
			</div>
			<div class="booking_float_left booking_width_20p booking_height_50 <?php echo $newclass; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:delItem(<?php echo $newid; ?>,'holidays','holiday_id');"><?php echo $bookingLangObj->getLabel("HOLIDAY_DELETE"); ?></a></div>
			</div>
			<div class="booking_cleardiv"></div>
		</div>
	<?php
	}
} else {
	$date_from = str_replace(",","-",$_REQUEST["date_from"]);
	$date_to = str_replace(",","-",$_REQUEST["date_to"]);
	
	$num=$bookingHolidayObj->getHolidayRecordcount($_GET["calendar_id"]);
	$arrNewIds = Array();
	$arrNewIds=$bookingHolidayObj->addHoliday($date_from,$date_to,$_GET["calendar_id"]);
	for($i=0;$i<count($arrNewIds);$i++) {
		$bookingHolidayObj->setHoliday($arrNewIds[$i]);
		if($num % 2) {
			$newclass="booking_alternate_table_row_grey";
		} else {
			$newclass="booking_alternate_table_row_white";
		}
		$num++;
		?>
		<div id="row_<?php echo $arrNewIds[$i]; ?>">
			<div class="booking_float_left booking_width_5p booking_height_50 <?php echo $newclass; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $num; ?></div>
			</div>
			<div class="booking_float_left booking_width_5p booking_height_50 <?php echo $newclass; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><input type="checkbox" name="holidays[]" value="<?php echo $arrNewIds[$i]; ?>" onclick="javascript:disableSelectAll('manage_holidays',this.checked);" /></div>
			</div>                    
			<div class="booking_float_left booking_width_70p booking_height_50 <?php echo $newclass; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                	<?php
					if($bookingSettingObj->getDateFormat() == "UK") {
						$dateToSend = strftime('%d/%m/%Y',strtotime($bookingHolidayObj->getHolidayDate()));
					} else if($bookingSettingObj->getDateFormat() == "EU") {
						$dateToSend = strftime('%Y/%m/%d',strtotime($bookingHolidayObj->getHolidayDate()));
					} else {
						$dateToSend = strftime('%m/%d/%Y',strtotime($bookingHolidayObj->getHolidayDate()));
					}
					?>
					<?php echo $dateToSend; ?>
                 </div>
			</div>
			<div class="booking_float_left booking_width_20p booking_height_50 <?php echo $newclass; ?>">
				<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:delItem(<?php echo $arrNewIds[$i]; ?>,'holidays','holiday_id');"><?php echo $bookingLangObj->getLabel("HOLIDAY_DELETE"); ?></a></div>
			</div>
			<div class="booking_cleardiv"></div>
		</div>
		<?php
		
	}
}


?>
