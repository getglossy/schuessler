<?php
if(isset($_POST["category_id"])) {
	if($_POST["calendar_id"] > 0) {
		$bookingCalendarObj->updateCalendar();
	} else {
		$bookingCalendarObj->addCalendar();
	}
	?>
    <script>
		document.location.href="?page=wp-booking-calendar";
	</script>
    <?php
}
$bookingCalendarObj->setCalendar($_GET["calendar_id"]);
?>


<script>
	var $wbc = jQuery;
	
	$wbc(function() {
		
		
		
		
	});
	
	function checkData(frm) {
		with(frm) {
			if(category_id.options[category_id.selectedIndex].value==0) {
				alert("<?php echo $bookingLangObj->getLabel("NEW_CALENDAR_CATEGORY_ALERT"); ?>");
				return false;
			} else if(Trim(calendar_title.value) == '') {
				alert("<?php echo $bookingLangObj->getLabel("NEW_CALENDAR_TITLE_ALERT"); ?>");
				return false;
			} else {
				return true;
			}
		}
	}
	
</script>

<div class="booking_margin_t_30 booking_font_18 booking_bg_fff">

<form name="addcalendar" action="" method="post" onsubmit="return checkData(this);" style="display:inline;">
    <input type="hidden" name="calendar_id" value="<?php echo $_GET["calendar_id"]; ?>" />
    
    <!-- 
    =======================
    === Creation date ==
    =======================
    -->
    <div class="booking_font_bold booking_margin_t_20"><label for="category_id"><?php echo $bookingLangObj->getLabel("NEW_CALENDAR_CATEGORY_LABEL"); ?></label></div>
   
    <div class="booking_font_12 booking_margin_t_10">
        <select name="category_id" id="category_id">
        	<option value="0"><?php echo $bookingLangObj->getLabel("NEW_CALENDAR_CHOOSE_CATEGORY"); ?></option>
            <?php
			$arrayCategories = $bookingListObj->getCategoriesList();
			foreach($arrayCategories as $categoryId => $category) {
				?>
                <option value="<?php echo $categoryId; ?>" <?php if($_GET["calendar_id"]>0 && $bookingCalendarObj->getCalendarCategoryId() == $categoryId) { echo "selected"; } ?>><?php echo $category["category_name"]; ?></option>
                <?php
			}
			?>
        </select>
        
        <div class="booking_cleardiv"></div>
    
    </div>
    
    <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
    
    <div class="booking_font_bold booking_margin_t_20"><label for="calendar_title"><?php echo $bookingLangObj->getLabel("NEW_CALENDAR_NAME_LABEL"); ?></label></div>
   
    <div class="booking_font_12 booking_margin_t_10">
        <input type="text" name="calendar_title" id="calendar_title" style="height:50px;width:400px" value="<?php echo $bookingCalendarObj->getCalendarTitle(); ?>" />
        
        <div class="booking_cleardiv"></div>
    
    </div>
    
    <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
    
    <div class="booking_font_bold booking_margin_t_20"><label for="calendar_title"><?php echo $bookingLangObj->getLabel("NEW_CALENDAR_EMAIL_LABEL"); ?></label></div>
   
    <div class="booking_font_12 booking_margin_t_10">
        <input type="text" name="calendar_email" id="calendar_email" style="height:50px;width:400px" value="<?php echo $bookingCalendarObj->getCalendarEmail(); ?>" />
        
        <div class="booking_cleardiv"></div>
    
    </div>
    
    <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
    
    
    
    <!-- bridge buttons -->
    <div class="booking_bg_333 booking_padding_10">
        <!-- cancel -->
        <div class="booking_float_left"><a href="javascript:document.location.href='?page=wp-booking-calendar';" class="booking_bg_ccc booking_admin_button booking_grey_button booking_mark_fff"><?php echo $bookingLangObj->getLabel("CALENDAR_CANCEL"); ?></a></div>
        <div class="booking_float_left booking_margin_l_20"><input type="submit" id="apply_button" value="<?php echo $bookingLangObj->getLabel("CALENDAR_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
        <div id="loading" style="float:left;margin-top:30px;margin-left:10px"></div>
        <div class="booking_cleardiv"></div>
        
    </div>
    
    
    </form>
    
 </div>

        
      
