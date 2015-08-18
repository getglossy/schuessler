<?php 

include 'common.php';

if(isset($_GET["file"]) && $_GET["file"] == "new_calendar") {
	include 'new_calendar.php';
	
} else if(isset($_GET["calendar_id"])) {
	include 'calendar_manage.php';
	
} else {
	if(isset($_POST["operation"]) && $_POST["operation"] != '') {
		$arrCalendars=$_POST["calendars"];
		$qryString = "0";
		for($i=0;$i<count($arrCalendars); $i++) {
			$qryString .= ",".$arrCalendars[$i];
		}
			
		switch($_POST["operation"]) {
			case "publishCalendars":
				$bookingCalendarObj->publishCalendars($qryString);
				break;
			case "unpublishCalendars":
				$bookingCalendarObj->unpublishCalendars($qryString);
				break;
			case "delCalendars":
				$bookingCalendarObj->delCalendars($qryString);
				break;
			case "duplicateCalendars":
				$bookingCalendarObj->duplicateCalendars($qryString);
				break;
		}                
		//header('Location: calendars.php');
	}
	$filter = "";
	
	?>
	
	<!-- 
	=====================================================================
	=====================================================================
	-->
	
	
	<div class="booking_padding_20 booking_font_14 booking_line_percent booking_bg_fff">
	
			
				<?php
				$arrayCalendars = $bookingListObj->getCalendarsList(); 
				
				?>
				<!-- 
				=======================
				=== js - check ==
				=======================
				-->
				<script>
					
					var $wbc = jQuery;
					
					function delItem(itemId) {
						if(confirm("<?php echo $bookingLangObj->getLabel("CALENDARS_DELETE_CONFIRM_SINGLE"); ?>")) {
							$wbc.ajax({
							  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/delCalendarItem.php?item_id='+itemId,
							  success: function(data) {
								  $wbc('#booking_table').hide().html(data).fadeIn(2000);
								 
								
							  }
							});
						} 
					}
					function publishCalendar(itemId) {
						if(confirm("<?php echo $bookingLangObj->getLabel("CALENDARS_PUBLISH_CONFIRM_SINGLE"); ?>")) {
							$wbc.ajax({
							  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/publishCalendar.php?calendar_id='+itemId,
							  success: function(data) {
								  $wbc('#publish_'+itemId).html('<a href="javascript:unpublishCalendar('+itemId+');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /></a>');								 							 
								
							  }
							});
						} 
					}
					function unpublishCalendar(itemId) {
						if(confirm("<?php echo $bookingLangObj->getLabel("CALENDARS_UNPUBLISH_CONFIRM_SINGLE"); ?>")) {
							$wbc.ajax({
							  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/unpublishCalendar.php?calendar_id='+itemId,
							  success: function(data) {
								  $wbc('#publish_'+itemId).html('<a href="javascript:publishCalendar('+itemId+');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /></a>');								 							 
								
							  }
							});
						} 
					}
					
					
					function setDefaultCalendar(calendar,category) {
						$wbc.ajax({
						  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/setDefaultCalendar.php?calendar_id='+calendar+"&category_id="+category,
						  success: function(data) {
							document.location.reload();
						  }
						});
					}
					
					$wbc(function() {
						<?php
						if(count($arrayCalendars)>0) {
							?>
							showActionBar();
							<?php
						}
						?>
					});
					
					function showActionBar() {
						$wbc('#action_bar').slideDown();
					}
					function hideActionBar() {
						$wbc('#action_bar').slideUp();
					}
					
					function filterCalendars() {
						category = document.getElementById('category_filter').options[document.getElementById('category_filter').selectedIndex].value;
						 $wbc.ajax({
						  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/filterCalendars.php?category_id='+category,
						  success: function(data) {
							$wbc('#booking_table').hide().html(data).fadeIn(2000);
							
						  }
						});
					}
				</script>
				
			   
			   
				<!-- 
				=======================
				=== create calendar ==
				=======================
				-->
				
				
				<div><a href="?page=wp-booking-calendar&file=new_calendar&calendar_id=0" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff" style="width:200px;margin:auto;"><?php echo $bookingLangObj->getLabel("CALENDARS_ADD"); ?></a></div>
				
			   
				
				 <!-- 
				=======================
				=== action bar ==
				=======================
				-->
				
				<div id="action_bar" style="display:none !important" class="booking_margin_t_20 booking_bg_f6f booking_border_1 booking_border_solid booking_border_ccc booking_padding_10">
					<div class="booking_float_left">
						<select name="category_filter" id="category_filter" onchange="javascript:filterCalendars();">
							<option value="0"><?php echo $bookingLangObj->getLabel("NEW_CALENDAR_CHOOSE_CATEGORY"); ?></option>
							<?php
							$arrayCategories = $bookingListObj->getCategoriesList();
							foreach($arrayCategories as $categoryId => $category) {
								?>
								<option value="<?php echo $categoryId; ?>"><?php echo $category["category_name"]; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="booking_float_right">
						<div class="booking_float_left"><?php echo $bookingLangObj->getLabel("CALENDARS_SELECTED_ITEMS"); ?>:</div>
						<a onclick="javascript:delItems('manage_calendars','calendars[]','publishCalendars','<?php echo $bookingLangObj->getLabel("CALENDARS_PUBLISH_CONFIRM_MULTIPLE"); ?>','<?php echo $bookingLangObj->getLabel("CALENDARS_NO_ITEMS_SELECTED"); ?>')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("CALENDARS_PUBLISH"); ?></a>
						<a onclick="javascript:delItems('manage_calendars','calendars[]','unpublishCalendars','<?php echo $bookingLangObj->getLabel("CALENDARS_UNPUBLISH_CONFIRM_MULTIPLE"); ?>','<?php echo $bookingLangObj->getLabel("CALENDARS_NO_ITEMS_SELECTED"); ?>')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("CALENDARS_UNPUBLISH"); ?></a>
						<a onclick="javascript:delItems('manage_calendars','calendars[]','delCalendars','<?php echo $bookingLangObj->getLabel("CALENDARS_DELETE_CONFIRM_MULTIPLE"); ?>','<?php echo $bookingLangObj->getLabel("CALENDARS_NO_ITEMS_SELECTED"); ?>')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("CALENDARS_DELETE"); ?></a>
						<a onclick="javascript:delItems('manage_calendars','calendars[]','duplicateCalendars','<?php echo $bookingLangObj->getLabel("CALENDARS_DUPLICATE_CONFIRM_MULTIPLE"); ?>','<?php echo $bookingLangObj->getLabel("CALENDARS_NO_ITEMS_SELECTED"); ?>')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("CALENDARS_DUPLICATE"); ?></a>
						<div class="booking_cleardiv"></div>
					</div>
					<div class="booking_cleardiv"></div>
					
				</div>
			   
				<!-- 
				=======================
				=== table calendars ==
				=======================
				-->
				<form name="manage_calendars" action="" method="post" style="display: inline;">
					<input type="hidden" name="operation" />
					<input type="hidden" name="calendars[]" value=0 />
					
					<div class="booking_margin_t_20">
						<div id="booking_table">
						
							
							
							
							
							<?php include 'ajax/wp_booking_calendars.php'; ?>
						</div>
					</div>
				</form>
				
				
				<div class="booking_cleardiv"></div>
		
	</div>
	<?php
}
?>
