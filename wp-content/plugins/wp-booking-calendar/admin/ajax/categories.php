<!-- 
=======================
=== table header ==
=======================
-->
<div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">

    <div class="booking_float_left booking_width_5p">#</div>
    
    <div class="booking_float_left booking_width_5p"><input type="checkbox" name="selectAll" onclick="javascript:selectCheckbox('manage_categories','categories[]');" /></div>
    
    <div class="booking_float_left booking_width_40p"><?php echo $bookingLangObj->getLabel("CATEGORY_NAME_LABEL"); ?></div>
    
    <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("CATEGORY_SHORTCODE_LABEL"); ?></div>
   
    <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("CATEGORY_PUBLISHED_LABEL"); ?></div>

    <div class="booking_float_left booking_width_10p"></div>

    <div class="booking_float_left booking_width_10p"></div>

    <div class="booking_cleardiv"></div>
    
</div>
<!-- 
=======================
=== table rows ==
=======================
-->
<?php                         
$arrayCategories = $bookingListObj->getCategoriesList(); 
if(count($arrayCategories)==0) {
	?>
    <script>
		window.parent.hideActionBar();
	</script>
    <?php
}            
$i=1;
foreach($arrayCategories as $categoryId => $category) {																			
    if($i % 2) {
        $class="booking_alternate_table_row_white";
    } else {
        $class="booking_alternate_table_row_grey";
    }
    
?>
<div id="row_<?php echo $categoryId; ?>" class="booking_border_b_1 booking_border_solid booking_border_ccc">
    
    <!-- row number -->
    <div class="booking_float_left booking_width_5p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $i; ?></div>
    </div>
  
    
    <!-- check calendar -->
    <div class="booking_float_left booking_width_5p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><input type="checkbox" name="categories[]" value="<?php echo $categoryId; ?>" onclick="javascript:disableSelectAll('manage_categories',this.checked);" /></div>
    </div>
  
    
    <!-- name calendar -->                   
    <div class="booking_float_left booking_width_40p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
            <span id="name_display_<?php echo $categoryId; ?>"><?php echo $category["category_name"]; ?></span>
            <span id="name_input_<?php echo $categoryId; ?>" style="display:none !important"><input type="text" name="category_name" id="category_name_<?php echo $categoryId; ?>" value="<?php echo $category["category_name"]; ?>" ></span>
        </div>
        
    </div>
    
    <!-- shortcode calendar -->
    <div class="booking_float_left booking_width_20p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">[wp_booking_calendar category_id=<?php echo $categoryId; ?>]</div>
    </div>
    
    <!-- status icon -->
    <div class="booking_float_left booking_width_10p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
            <span id="publish_<?php echo $categoryId; ?>"><?php if($category["category_active"]=='1') { ?><a href="javascript:unpublishCategory(<?php echo $categoryId; ?>);"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /></a><?php } else { ?><a href="javascript:publishCategory(<?php echo $categoryId; ?>);"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /></a><?php } ?></span>
            <?php
            if($category["category_order"] > 0) {
            ?>
            <br /><input type="button" value="<?php echo $bookingLangObj->getLabel("CATEGORY_SET_AS_DEFAULT"); ?>" onclick="javascript:setDefaultCategory(<?php echo $categoryId; ?>);" class="booking_font_12"/>
            <?php
            }
            ?>
        </div>
    </div> 
    
    <!-- modify name button -->                      
    <div class="booking_float_left booking_width_10p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
            <span id="modify_<?php echo $categoryId; ?>"><a href="javascript:editItem(<?php echo $categoryId; ?>);"><?php echo $bookingLangObj->getLabel("CATEGORY_MODIFY_NAME"); ?></a></span>
        </div>
    </div>
    
    <!-- delete button -->
    <div class="booking_float_left booking_width_10p booking_height_60 <?php echo $class; ?>">
        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:delItem(<?php echo $categoryId; ?>,'categories','category_id');"><?php echo $bookingLangObj->getLabel("CATEGORY_DELETE"); ?></a></div>
    </div>                            
   
    <div class="booking_cleardiv"></div>
</div>
<?php 
$i++;
} ?>