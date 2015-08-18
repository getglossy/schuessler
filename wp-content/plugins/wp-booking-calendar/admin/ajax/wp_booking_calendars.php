<!-- 
=======================
=== table header ==
=======================
-->
<div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">

    <div class="booking_float_left booking_width_5p">#</div>
    
    <div class="booking_float_left booking_width_5p"><input type="checkbox" name="selectAll" onclick="javascript:selectCheckbox('manage_calendars','calendars[]');" /></div>
    
    <div class="booking_float_left booking_width_25p"><?php echo $bookingLangObj->getLabel("CALENDAR_TITLE_LABEL"); ?></div>
    
    <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("CALENDAR_CATEGORY_LABEL"); ?></div>
    
    <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("CALENDAR_SHORTCODE_LABEL"); ?></div>
   
    <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("CALENDAR_PUBLISHED_LABEL"); ?></div>

    <div class="booking_float_left booking_width_5p"></div>
   
    <div class="booking_float_left booking_width_5p"></div>

    <div class="booking_float_left booking_width_5p"></div>

    <div class="booking_cleardiv"></div>
    
</div>

<!-- 
=======================
=== table rows ==
=======================
-->
<?php                         
$arrayCalendars = $bookingListObj->getCalendarsList($filter);    
if(count($arrayCalendars)==0) {
	?>
    <script>
		window.parent.hideActionBar();
	</script>
    <?php
}    
$i=1;
foreach($arrayCalendars as $calendarId => $calendar) {																			
    if($i % 2) {
        $class="booking_alternate_table_row_white";
    } else {
        $class="booking_alternate_table_row_grey";
    }
    
?>
<div id="row_<?php echo $calendarId; ?>" class="booking_border_b_1 booking_border_solid booking_border_ccc">
    
    <!-- row number -->
    <div class="booking_float_left booking_width_5p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $i; ?></div>
    </div>
  
    
    <!-- check calendar -->
    <div class="booking_float_left booking_width_5p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><input type="checkbox" name="calendars[]" value="<?php echo $calendarId; ?>" onclick="javascript:disableSelectAll('manage_calendars',this.checked);" /></div>
    </div>
  
    
    <!-- name calendar -->                   
    <div class="booking_float_left booking_width_25p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
            <?php echo $calendar["calendar_title"]; ?>
            
        </div>
        
    </div>
    
     <!-- name category -->                   
    <div class="booking_float_left booking_width_20p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
            <?php 
			$bookingCategoryObj->setCategory($calendar["category_id"]);
			echo $bookingCategoryObj->getCategoryName(); ?>
            
        </div>
        
    </div>
    
    <!-- shortcode calendar -->
    <div class="booking_float_left booking_width_20p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">[wp_booking_calendar calendar_id=<?php echo $calendarId; ?>]</div>
    </div>
    
    <!-- status icon -->
    <div class="booking_float_left booking_width_10p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
            <span id="publish_<?php echo $calendarId; ?>"><?php if($calendar["calendar_active"]=='1') { ?><a href="javascript:unpublishCalendar(<?php echo $calendarId; ?>);"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /></a><?php } else { ?><a href="javascript:publishCalendar(<?php echo $calendarId; ?>);"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /></a><?php } ?></span>
            <?php
            if($calendar["calendar_order"] > 0) {
            ?>
            <br /><input type="button" value="<?php echo $bookingLangObj->getLabel("CALENDARS_SET_AS_DEFAULT"); ?>" onclick="javascript:setDefaultCalendar(<?php echo $calendarId; ?>,<?php echo $calendar["category_id"]; ?>);" class="booking_font_12"/>
            <?php
            }
            ?>
        </div>
    </div> 
    
    <!-- modify name button -->                      
    <div class="booking_float_left booking_width_5p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
            <span id="modify_<?php echo $calendarId; ?>"><a href="?page=wp-booking-calendar&file=new_calendar&calendar_id=<?php echo $calendarId; ?>"><?php echo $bookingLangObj->getLabel("CALENDARS_MODIFY"); ?></a></span>
        </div>
    </div>
    
    <!-- manage button -->
    <div class="booking_float_left booking_width_5p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="?page=wp-booking-calendar&calendar_id=<?php echo $calendarId; ?>&ref=slots"><?php echo $bookingLangObj->getLabel("CALENDARS_MANAGE"); ?></a></div>
    </div>
    
    <!-- delete button -->
    <div class="booking_float_left booking_width_5p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:delItem(<?php echo $calendarId; ?>,'calendars','calendar_id');"><?php echo $bookingLangObj->getLabel("CALENDARS_DELETE"); ?></a></div>
    </div>                            
   
    <div class="booking_cleardiv"></div>
</div>
<?php 
$i++;
} ?>