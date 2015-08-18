<?php
include '../common.php';

//order by management
if(isset($_REQUEST["order_by"]) && $_REQUEST["order_by"] != '' && isset($_REQUEST["type"]) && $_REQUEST["type"] != '') {
	
	switch($_REQUEST["order_by"]) {
		case "date":
			if($_REQUEST["type"] == 'asc') {
				$_SESSION["qryHolidaysOrderString"] = "ORDER BY holiday_date asc";
				$_SESSION["orderbyHolidayDate"] = "desc";
			} else {
				$_SESSION["qryHolidaysOrderString"] = "ORDER BY holiday_date desc";
				$_SESSION["orderbyHolidayDate"] = "asc";
			}
			break;
		
	}
}


?>

<!-- 
=======================
=== table header ==
=======================
-->


<div id="table" class="booking_margin_t_20">
    
    	<div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">
        
			<div class="booking_float_left booking_width_5p">#</div>
			
			<div class="booking_float_left booking_width_5p"><input type="checkbox" name="selectAll" onclick="javascript:selectCheckbox('manage_holidays','holidays[]');" /></div>
			
			<div class="booking_float_left booking_width_70p"><?php echo $bookingLangObj->getLabel("HOLIDAY_DATE_LABEL"); ?>&nbsp;<a href="javascript:orderby('<?php echo $_SESSION["orderbyHolidayDate"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbyHolidayDate"];?>.gif" border=0 /></a></div>
			
			
			
			<div class="booking_float_left booking_width_20p"></div>
			
			<div class="booking_cleardiv"></div>
			
		</div>


<!-- 
=======================
=== table row ==
=======================
-->
<?php                         
$arrayHolidays = $bookingListObj->getHolidaysList($_SESSION["qryHolidaysOrderString"],$_GET["calendar_id"]);                        
$i=1;
foreach($arrayHolidays as $holidayId => $holiday) {							
	if($i % 2) {
		$class="booking_alternate_table_row_white";
	} else {
		$class="booking_alternate_table_row_grey";
	}
?>

<div id="row_<?php echo $holidayId; ?>">
	<div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
		<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $i; ?></div>
	</div>
	<div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
		<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><input type="checkbox" name="holidays[]" value="<?php echo $holidayId; ?>" onclick="javascript:disableSelectAll('manage_holidays',this.checked);" /></div>
	</div>                    
	<div class="booking_float_left booking_width_70p booking_height_50 <?php echo $class; ?>">
		<div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
        	<?php
			if($bookingSettingObj->getDateFormat() == "UK") {
				$dateToSend = strftime('%d/%m/%Y',strtotime($holiday["holiday_date"]));
			} else if($bookingSettingObj->getDateFormat() == "EU") {
				$dateToSend = strftime('%Y/%m/%d',strtotime($holiday["holiday_date"]));
			} else {
				$dateToSend = strftime('%m/%d/%Y',strtotime($holiday["holiday_date"]));
			}
			?>
			<?php echo $dateToSend; ?>
         
        </div>
	</div>
	<div class="booking_float_left booking_width_20p booking_height_50 <?php echo $class; ?>">
		<div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:delItem(<?php echo $holidayId; ?>,'holidays','holiday_id');"><?php echo $bookingLangObj->getLabel("HOLIDAY_DELETE"); ?></a></div>
	</div>
	<div class="booking_cleardiv"></div>
</div>


<?php 
$i++;
} ?>
