<?php
include 'common.php';
/*if(!isset($_SESSION["admin_id"]) || $_SESSION["admin_id"] == 20000) {
	header('Location: login.php');
}*/
if(isset($_POST["day_grey_bg"])) {	
	$bookingSettingObj->updateStyles();
	//header('Location: welcome.php');	
}



?>

<!-- 
=======================
=== js ==
=======================
-->
<script language="javascript" type="text/javascript">
	var $wbc = jQuery;
	$wbc(function() {
		<?php
		if($bookingSettingObj->getRecaptchaEnabled() == 1) {
			?>
			$wbc('#recaptcha_style').fadeIn();
			<?php
		}
		?>
		$wbc('.color_code_form_calendar_name_color').simpleColor({ 
		 	defaultColor: $wbc('#form_calendar_name_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#form_calendar_name_color').val('#'+hex);
			  
			}
		 });
		$wbc('.color_code_month_container_bg').simpleColor({ 
		 	defaultColor: $wbc('#month_container_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#month_container_bg').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_month_name_color').simpleColor({ 
		 	defaultColor: $wbc('#month_name_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#month_name_color').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_year_name_color').simpleColor({ 
		 	defaultColor: $wbc('#year_name_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#year_name_color').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_day_names_color').simpleColor({ 
		 	defaultColor: $wbc('#day_names_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_names_color').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_field_input_bg').simpleColor({ 
		 	defaultColor: $wbc('#field_input_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#field_input_bg').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_field_input_color').simpleColor({ 
		 	defaultColor: $wbc('#field_input_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#field_input_color').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_book_now_button_bg').simpleColor({ 
		 	defaultColor: $wbc('#book_now_button_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#book_now_button_bg').val('#'+hex);
			  
			}
		 });
		  $wbc('.color_code_book_now_button_bg_hover').simpleColor({ 
		 	defaultColor: $wbc('#book_now_button_bg_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#book_now_button_bg_hover').val('#'+hex);
			  
			}
		 });
		  $wbc('.color_code_book_now_button_color').simpleColor({ 
		 	defaultColor: $wbc('#book_now_button_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#book_now_button_color').val('#'+hex);
			  
			}
		 });
		  $wbc('.color_code_book_now_button_color_hover').simpleColor({ 
		 	defaultColor: $wbc('#book_now_button_color_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#book_now_button_color_hover').val('#'+hex);
			  
			}
		 });
		 
		  $wbc('.color_code_month_navigation_button_bg').simpleColor({ 
		 	defaultColor: $wbc('#month_navigation_button_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#month_navigation_button_bg').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_month_navigation_button_bg_hover').simpleColor({ 
		 	defaultColor: $wbc('#month_navigation_button_bg_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#month_navigation_button_bg_hover').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_clear_button_bg').simpleColor({ 
		 	defaultColor: $wbc('#clear_button_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#clear_button_bg').val('#'+hex);
			  
			}
		 });
		  $wbc('.color_code_clear_button_bg_hover').simpleColor({ 
		 	defaultColor: $wbc('#clear_button_bg_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#clear_button_bg_hover').val('#'+hex);
			  
			}
		 });
		  $wbc('.color_code_clear_button_color').simpleColor({ 
		 	defaultColor: $wbc('#clear_button_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#clear_button_color').val('#'+hex);
			  
			}
		 });
		  $wbc('.color_code_clear_button_color_hover').simpleColor({ 
		 	defaultColor: $wbc('#clear_button_color_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#clear_button_color_hover').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_day_grey_bg').simpleColor({ 
		 	defaultColor: $wbc('#day_grey_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_grey_bg').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_day_white_bg').simpleColor({ 
		 	defaultColor: $wbc('#day_white_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_bg').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_white_bg_hover').simpleColor({ 
		 	defaultColor: $wbc('#day_white_bg_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_bg_hover').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_white_line1_color').simpleColor({ 
		 	defaultColor: $wbc('#day_white_line1_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_line1_color').val('#'+hex);
			  
			}
		 });
		 
		 
		 $wbc('.color_code_day_white_line1_color_hover').simpleColor({ 
		 	defaultColor: $wbc('#day_white_line1_color_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_line1_color_hover').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_white_line2_color').simpleColor({ 
		 	defaultColor: $wbc('#day_white_line2_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_line2_color').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_white_line2_color_hover').simpleColor({ 
		 	defaultColor: $wbc('#day_white_line2_color_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_line2_color_hover').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_black_bg').simpleColor({ 
		 	defaultColor: $wbc('#day_black_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_black_bg').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_black_bg_hover').simpleColor({ 
		 	defaultColor: $wbc('#day_black_bg_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_black_bg_hover').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_black_line1_color').simpleColor({ 
		 	defaultColor: $wbc('#day_black_line1_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_black_line1_color').val('#'+hex);
			  
			}
		 });
		 
		  $wbc('.color_code_day_black_line1_color_hover').simpleColor({ 
		 	defaultColor: $wbc('#day_black_line1_color_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_black_line1_color_hover').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_black_line2_color').simpleColor({ 
		 	defaultColor: $wbc('#day_black_line2_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_black_line2_color').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_black_line2_color_hover').simpleColor({ 
		 	defaultColor: $wbc('#day_black_line2_color_hover').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_black_line2_color_hover').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_red_bg').simpleColor({ 
		 	defaultColor: $wbc('#day_red_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_red_bg').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_red_line1_color').simpleColor({ 
		 	defaultColor: $wbc('#day_red_line1_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_red_line1_color').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_red_line2_color').simpleColor({ 
		 	defaultColor: $wbc('#day_red_line2_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_red_line2_color').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_white_bg_disabled').simpleColor({ 
		 	defaultColor: $wbc('#day_white_bg_disabled').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_bg_disabled').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_day_white_line1_disabled_color').simpleColor({ 
		 	defaultColor: $wbc('#day_white_line1_disabled_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_line1_disabled_color').val('#'+hex);
			  
			}
		 });
		 
		  $wbc('.color_code_day_white_bg_line1_disabled_color').simpleColor({ 
		 	defaultColor: $wbc('#day_white_line1_disabled_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_line1_disabled_color').val('#'+hex);
			  
			}
		 });
		 $wbc('.color_code_day_white_line2_disabled_color').simpleColor({ 
		 	defaultColor: $wbc('#day_white_line2_disabled_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#day_white_line2_disabled_color').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_form_bg').simpleColor({ 
		 	defaultColor: $wbc('#form_bg').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#form_bg').val('#'+hex);
			  
			}
		 });
		 
		 $wbc('.color_code_form_color').simpleColor({ 
		 	defaultColor: $wbc('#form_color').val(),
			onSelect: function( hex ) {
			  //put code in input cell
			  $wbc('#form_color').val('#'+hex);
			  
			}
		 });
		 
	});
	function onManuallyChangeColor(color,div_class,input_id) { 
		if(color.length==7) {
			$wbc('.'+div_class).parent().children('div').eq(1).children('div').eq(0).css('background-color',$wbc('#'+input_id).val());
		}
	}
</script>

 <!-- 
=======================
=== main content ==
=======================
-->

<div class="booking_padding_20 booking_font_18 booking_line_percent booking_bg_fff">
        
        <!-- 
        =======================
        === form ==
        =======================
        -->
        
        <form name="editstyles" action="" method="post" tmt:validate="true" enctype="multipart/form-data">           
                
              
                
        <!-- 
        =======================
        === Month container ==
        =======================
        -->          
        
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_MONTH_CONTAINER_TITLE"); ?></div>
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_MONTH_CONTAINER_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="month_container_bg" name="month_container_bg" maxlength="7" value="<?php echo $bookingSettingObj->getMonthContainerBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_month_container_bg','month_container_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_month_container_bg"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
           
       
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_MONTH_NAME_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="month_name_color" name="month_name_color" maxlength="7" value="<?php echo $bookingSettingObj->getMonthNameColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_month_name_color','month_name_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_month_name_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_YEAR_NAME_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="year_name_color" name="year_name_color" maxlength="7" value="<?php echo $bookingSettingObj->getYearNameColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_year_name_color','year_name_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_year_name_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
         <!-- 
        =======================
        === Navigation buttons==
        =======================
        -->
        
                
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_MONTH_NAVIGATION_BUTTONS_TITLE"); ?></div>
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_MONTH_NAVIGATION_BUTTONS_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="month_navigation_button_bg" name="month_navigation_button_bg" maxlength="7" value="<?php echo $bookingSettingObj->getMonthNavigationButtonBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_month_navigation_button_bg','month_navigation_button_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_month_navigation_button_bg"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_MONTH_NAVIGATION_BUTTONS_BACKGROUND_HOVER"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="month_navigation_button_bg_hover" name="month_navigation_button_bg_hover" maxlength="7" value="<?php echo $bookingSettingObj->getMonthNavigationButtonBgHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_month_navigation_button_bg_hover','month_navigation_button_bg_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_month_navigation_button_bg_hover"></div></div>
        </div>            
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
           
        <!-- 
        =======================
        === Days names color ==
        =======================
        -->
        
       
        
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_DAY_NAMES_TITLE"); ?></div>
       
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_DAY_NAMES_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="day_names_color" name="day_names_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayNamesColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_names_color','day_names_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_names_color"></div></div>
        </div>            
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        <!-- 
        =======================
        === Calendar empty cells ==
        =======================
        -->
       
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_EMPTY_CELLS_TITLE"); ?></div>
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_EMPTY_CELLS_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_grey_bg" name="day_grey_bg" maxlength="7" value="<?php echo $bookingSettingObj->getDayGreyBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_grey_bg','day_grey_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_grey_bg"></div></div>
        </div>
        
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        <!-- 
        =======================
        === Calendar avalaible cells ==
        =======================
        -->
       
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_AVAILABLE_CELLS_TITLE"); ?></div>
        
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_AVAILABLE_CELLS_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_bg" name="day_white_bg" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_bg','day_white_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_bg"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_AVAILABLE_CELLS_BACKGROUND_OVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_bg_hover" name="day_white_bg_hover" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteBgHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_bg_hover','day_white_bg_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_bg_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_AVAILABLE_CELLS_LINE_1_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_line1_color" name="day_white_line1_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteLine1Color(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_line1_color','day_white_line1_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_line1_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_AVAILABLE_CELLS_LINE_1_COLOR_OVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_line1_color_hover" name="day_white_line1_color_hover" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteLine1ColorHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_line1_color_hover','day_white_line1_color_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_line1_color_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_AVAILABLE_CELLS_LINE_2_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_line2_color" name="day_white_line2_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteLine2Color(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_line2_color','day_white_line2_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_line2_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_AVAILABLE_CELLS_LINE_2_COLOR_OVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_line2_color_hover" name="day_white_line2_color_hover" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteLine2ColorHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_line2_color_hover','day_white_line2_color_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_line2_color_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        <!-- 
        =======================
        === Calendar today cell ==
        =======================
        -->
       
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_TODAY_CELLS_TITLE"); ?></div>
        
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_TODAY_CELLS_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_black_bg" name="day_black_bg" maxlength="7" value="<?php echo $bookingSettingObj->getDayBlackBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_black_bg','day_black_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_black_bg"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_TODAY_CELLS_BACKGROUND_OVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_black_bg_hover" name="day_black_bg_hover" maxlength="7" value="<?php echo $bookingSettingObj->getDayBlackBgHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_black_bg_hover','day_black_bg_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_black_bg_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_TODAY_CELLS_LINE_1_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_black_line1_color" name="day_black_line1_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayBlackLine1Color(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_black_line1_color','day_black_line1_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_black_line1_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_TODAY_CELLS_LINE_1_COLOR_OVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_black_line1_color_hover" name="day_black_line1_color_hover" maxlength="7" value="<?php echo $bookingSettingObj->getDayBlackLine1ColorHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_black_line1_color_hover','day_black_line1_color_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_black_line1_color_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_TODAY_CELLS_LINE_2_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_black_line2_color" name="day_black_line2_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayBlackLine2Color(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_black_line2_color','day_black_line2_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_black_line2_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_TODAY_CELLS_LINE_2_COLOR_OVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_black_line2_color_hover" name="day_black_line2_color_hover" maxlength="7" value="<?php echo $bookingSettingObj->getDayBlackLine2ColorHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_black_line2_color_hover','day_black_line2_color_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_black_line2_color_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        <!-- 
        =======================
        === Calendar sold out cells ==
        =======================
        -->
       
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_SOLDOUT_CELLS_TITLE"); ?></div>
        
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_SOLDOUT_CELLS_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_red_bg" name="day_red_bg" maxlength="7" value="<?php echo $bookingSettingObj->getDayRedBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_red_bg','day_red_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_red_bg"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_SOLDOUT_CELLS_LINE_1_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_red_line1_color" name="day_red_line1_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayRedLine1Color(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_red_line1_color','day_red_line1_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_red_line1_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_SOLDOUT_CELLS_LINE_2_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_red_line2_color" name="day_red_line2_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayRedLine2Color(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_red_line2_color','day_red_line2_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_red_line2_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>  
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        <!-- 
        =======================
        === Calendar not available cells ==
        =======================
        -->
       
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_NOTAVAILABLE_CELLS_TITLE"); ?></div>
        
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_NOTAVAILABLE_CELLS_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_bg_disabled" name="day_white_bg_disabled" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteBgDisabled(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_bg_disabled','day_white_bg_disabled');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_bg_disabled"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_NOTAVAILABLE_CELLS_LINE_1_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_line1_disabled_color" name="day_white_line1_disabled_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteLine1DisabledColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_bg_line1_disabled_color','day_white_line1_disabled_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_bg_line1_disabled_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_NOTAVAILABLE_CELLS_LINE_2_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="day_white_line2_disabled_color" name="day_white_line2_disabled_color" maxlength="7" value="<?php echo $bookingSettingObj->getDayWhiteLine2DisabledColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_day_white_line2_disabled_color','day_white_line2_disabled_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_day_white_line2_disabled_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>        
        
        
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
         <!-- 
         =======================
         === form style bg color ==
         =======================
         -->
        <div class="booking_font_bold"><?php echo $bookingLangObj->getLabel("STYLES_FORM_TITLE"); ?></div>
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_FORM_CALENDAR_NAME_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="form_calendar_name_color" name="form_calendar_name_color" maxlength="7" value="<?php echo $bookingSettingObj->getFormCalendarNameColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_form_calendar_name_color','form_calendar_name_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_form_calendar_name_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_FORM_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="form_bg" name="form_bg" maxlength="7" value="<?php echo $bookingSettingObj->getFormBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_form_bg','form_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_form_bg"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_FORM_LABELS_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
        	<input type="text" class="booking_width_100 booking_float_left" id="form_color" name="form_color" maxlength="7" value="<?php echo $bookingSettingObj->getFormColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_form_color','form_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_form_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>        
        
		<div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_FORM_FIELD_INPUT_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="field_input_bg" name="field_input_bg" maxlength="7" value="<?php echo $bookingSettingObj->getFieldInputBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_field_input_bg','field_input_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_field_input_bg"></div></div>
        </div>
     	<div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_12 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_FORM_FIELD_INPUT_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="field_input_color" name="field_input_color" maxlength="7" value="<?php echo $bookingSettingObj->getFieldInputColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_field_input_color','field_input_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_field_input_color"></div></div>
        </div>        
        <div class="booking_cleardiv"></div>
        
        <div id="recaptcha_style" style="display:none !important">
            <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_FORM_RECAPTCHA"); ?></div>
            <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            	<select name="recaptcha_style">
                	<option value="white" <?php if($bookingSettingObj->getRecaptchaStyle() == "white") { echo "selected"; }?>><?php echo $bookingLangObj->getLabel("STYLES_FORM_RECAPTCHA_WHITE"); ?></option>
                    <option value="red" <?php if($bookingSettingObj->getRecaptchaStyle() == "red") { echo "selected"; }?>><?php echo $bookingLangObj->getLabel("STYLES_FORM_RECAPTCHA_RED"); ?></option>
                    <option value="blackglass" <?php if($bookingSettingObj->getRecaptchaStyle() == "blackglass") { echo "selected"; }?>><?php echo $bookingLangObj->getLabel("STYLES_FORM_RECAPTCHA_BLACK"); ?></option>
                </select>
            </div>
            <div class="booking_cleardiv"></div>     
        </div>
        
		<div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_BOOK_NOW_BUTTON_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="book_now_button_bg" name="book_now_button_bg" maxlength="7" value="<?php echo $bookingSettingObj->getBookNowButtonBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_book_now_button_bg','book_now_button_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_book_now_button_bg"></div></div>
        </div>        
        <div class="booking_cleardiv"></div>  
        
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_BOOK_NOW_BUTTON_BACKGROUND_HOVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="book_now_button_bg_hover" name="book_now_button_bg_hover" maxlength="7" value="<?php echo $bookingSettingObj->getBookNowButtonBgHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_book_now_button_bg_hover','book_now_button_bg_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_book_now_button_bg_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>  
        
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_BOOK_NOW_BUTTON_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="book_now_button_color" name="book_now_button_color" maxlength="7" value="<?php echo $bookingSettingObj->getBookNowButtonColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_book_now_button_color','book_now_button_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_book_now_button_color"></div></div>           
        </div>
        <div class="booking_cleardiv"></div>  
     
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_BOOK_NOW_BUTTON_COLOR_HOVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="book_now_button_color_hover" name="book_now_button_color_hover" maxlength="7" value="<?php echo $bookingSettingObj->getBookNowButtonColorHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_book_now_button_color_hover','book_now_button_color_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_book_now_button_color_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
     
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_CLEAR_BUTTON_BACKGROUND"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="clear_button_bg" name="clear_button_bg" maxlength="7" value="<?php echo $bookingSettingObj->getClearButtonBg(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_clear_button_bg','clear_button_bg');">
            <div class="booking_float_left booking_width_20"><div class="color_code_clear_button_bg"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
     
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_CLEAR_BUTTON_BACKGROUND_HOVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="clear_button_bg_hover" name="clear_button_bg_hover" maxlength="7" value="<?php echo $bookingSettingObj->getClearButtonBgHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_clear_button_bg_hover','clear_button_bg_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_clear_button_bg_hover"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
     
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_CLEAR_BUTTON_COLOR"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="clear_button_color" name="clear_button_color" maxlength="7" value="<?php echo $bookingSettingObj->getClearButtonColor(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_clear_button_color','clear_button_color');">
            <div class="booking_float_left booking_width_20"><div class="color_code_clear_button_color"></div></div>
        </div>
        <div class="booking_cleardiv"></div>
      
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_350"><?php echo $bookingLangObj->getLabel("STYLES_CLEAR_BUTTON_COLOR_HOVER"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_122">
            <input type="text" class="booking_width_100 booking_float_left" id="clear_button_color_hover" name="clear_button_color_hover" maxlength="7" value="<?php echo $bookingSettingObj->getClearButtonColorHover(); ?>" onKeyUp="javascript:onManuallyChangeColor(this.value,'color_code_clear_button_color_hover','clear_button_color_hover');">
            <div class="booking_float_left booking_width_20"><div class="color_code_clear_button_color_hover"></div></div>
        </div>
         <div class="booking_cleardiv"></div>
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
       
        
        
        
         <!-- 
        =======================
        === control buttons ==
        =======================
        -->
        <div class="booking_bg_333 booking_padding_10">
            <!-- cancel -->
            <div class="booking_float_left"><a href="javascript:document.location.href='?page=wp-booking-calendar-welcome';" class="booking_bg_ccc booking_admin_button booking_grey_button booking_mark_fff"><?php echo $bookingLangObj->getLabel("STYLES_CANCEL");?></a></div>
            <div class="booking_float_left booking_margin_l_20"><input type="submit" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("STYLES_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
            <div class="booking_cleardiv"></div>
            
        </div>
            
        </form>
         
        

</div>
