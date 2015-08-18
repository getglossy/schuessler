<?php 
include 'common.php';

if($bookingSettingObj->getRecaptchaEnabled() == "1") {
	require_once('include/recaptchalib.php');
}
$publickey = $bookingSettingObj->getRecaptchaPublicKey();
  
if((!isset($_GET["calendar_id"]) || $_GET["calendar_id"] == 0) && (!isset($_GET["category_id"]) || $_GET["category_id"] == 0)) {
	//get default category and default calendar of the category
	$bookingCategoryObj->getDefaultCategory();
	$bookingCalendarObj->getDefaultCalendar($bookingCategoryObj->getCategoryId());
	
} else if(isset($_GET["calendar_id"]) && $_GET["calendar_id"] > 0) {
	$bookingCalendarObj->setCalendar($_GET["calendar_id"]);
	$bookingCategoryObj->setCategory($bookingCalendarObj->getCalendarCategoryId());
} else if(isset($_GET["category_id"]) && $_GET["category_id"]>0) {
	$bookingCategoryObj->setCategory($_GET["category_id"]);
	$bookingCalendarObj->getDefaultCalendar($bookingCategoryObj->getCategoryId());
}
 ?>


<style>
	.booking_month_navigation_button_custom {
		background-color:<?php echo $bookingSettingObj->getMonthNavigationButtonBg(); ?> !important;
	}
	.booking_month_navigation_button_custom:hover {
		background-color:<?php echo $bookingSettingObj->getMonthNavigationButtonBgHover(); ?> !important;
	}
	.booking_month_container_custom {
		background-color:<?php echo $bookingSettingObj->getMonthContainerBg(); ?> !important;
	}
	.booking_month_name_custom {
		color: <?php echo $bookingSettingObj->getMonthNameColor(); ?> !important;
	}
	.booking_year_name_custom {
		color: <?php echo $bookingSettingObj->getYearNameColor(); ?> !important;
	}
	.booking_weekdays_custom {
		color: <?php echo $bookingSettingObj->getDayNamesColor(); ?> !important;
	}
	.booking_field_input_custom {
		background-color: <?php echo $bookingSettingObj->getFieldInputBg(); ?> !important;
		color: <?php echo $bookingSettingObj->getFieldInputColor(); ?> !important;
	}
	.booking_book_now_custom {
		background-color: <?php echo $bookingSettingObj->getBookNowButtonBg(); ?> !important;
		color: <?php echo $bookingSettingObj->getBookNowButtonColor(); ?> !important;
	}
	.booking_book_now_custom:hover {
		background-color: <?php echo $bookingSettingObj->getBookNowButtonBgHover(); ?> !important;
		color: <?php echo $bookingSettingObj->getBookNowButtonColorHover(); ?> !important;
	}
	.booking_clear_custom {
		background-color: <?php echo $bookingSettingObj->getClearButtonBg(); ?> !important;
		color: <?php echo $bookingSettingObj->getClearButtonColor(); ?> !important;
	}
	.booking_clear_custom:hover {
		background-color: <?php echo $bookingSettingObj->getClearButtonBgHover(); ?> !important;
		color: <?php echo $bookingSettingObj->getClearButtonColorHover(); ?> !important;
	}
</style><!-- ===============================================================
	js
================================================================ -->

<script language="javascript" type="text/javascript">
	jQuery.noConflict();
	var $wbc = jQuery;
	var currentMonth;
	var currentYear;
	var pageX;
	var pageY;
	var today= new Date();
	<?php 
	if($bookingSettingObj->getShowFirstFilledMonth() == 0) {
		?>
		var newday= new Date();
		<?php
	} else {
		?>
		var newday = new Date(<?php echo $bookingCalendarObj->getFirstFilledMonth($bookingCalendarObj->getCalendarId()); ?>);
		<?php
	}
	?>
	
	$wbc(function() {
		$wbc('#booking_back_today').css("display","none");
		getBookingMonthCalendar((newday.getMonth()+1),newday.getFullYear(),'<?php echo $bookingCalendarObj->getCalendarId(); ?>','<?php echo $publickey; ?>');
		<?php
		if($bookingSettingObj->getRecaptchaEnabled() == "1") {
			?>
			Recaptcha.create("<?php echo $publickey; ?>",
				"captcha",
				{
				  theme: "<?php echo $bookingSettingObj->getRecaptchaStyle();?>",
				  callback: Recaptcha.focus_response_field
				}
		   );	
	  <?php
		}
		?>
		$wbc('#reg_button').bind('click',function() {
			if(tmt.validator.validateForm("registration_form")) {
				$wbc('#booking_container_all').parent().prepend('<div id="booking_sfondo" class="booking_modal_sfondo"></div>');
				$wbc('#booking_modal_loading').fadeIn();
			}
		});
		
		
	});
	
	
	function getMonthName(month) {
		var m = new Array();
		m[0] ="<?php echo $bookingLangObj->getLabel("JANUARY"); ?>";
		m[1] ="<?php echo $bookingLangObj->getLabel("FEBRUARY"); ?>";
		m[2] ="<?php echo $bookingLangObj->getLabel("MARCH"); ?>";
		m[3] ="<?php echo $bookingLangObj->getLabel("APRIL"); ?>";
		m[4] ="<?php echo $bookingLangObj->getLabel("MAY"); ?>";
		m[5] ="<?php echo $bookingLangObj->getLabel("JUNE"); ?>";
		m[6] ="<?php echo $bookingLangObj->getLabel("JULY"); ?>";
		m[7] ="<?php echo $bookingLangObj->getLabel("AUGUST"); ?>";
		m[8] ="<?php echo $bookingLangObj->getLabel("SEPTEMBER"); ?>";
		m[9] ="<?php echo $bookingLangObj->getLabel("OCTOBER"); ?>";
		m[10] ="<?php echo $bookingLangObj->getLabel("NOVEMBER"); ?>";
		m[11] ="<?php echo $bookingLangObj->getLabel("DECEMBER"); ?>";
		$wbc('#month_name').html(m[(month-1)]);
		currentMonth = month;
		
		if((today.getMonth()+1)!=(month)) {
			$wbc('#booking_back_today').fadeIn();
		} else {
			$wbc('#booking_back_today').css("display","none");
		}
	}
	
	
	function showResponse(calendar_id) {
		$wbc('#booking_container_all').parent().prepend('<div id="booking_sfondo" class="booking_modal_sfondo" onclick="hideBookingResponse('+calendar_id+',\'<?php echo $publickey; ?>\')"></div>');
		$wbc('#ok_response').attr("href","javascript:hideBookingResponse("+calendar_id+",'<?php echo $publickey; ?>');");
		$wbc('#booking_modal_response').fadeIn('slow');
		$wbc('#booking_submit_button').removeAttr("disabled");
	}
	
	function showCaptchaError() {
		$wbc('#booking_captcha_error').fadeIn();
		$wbc('#booking_submit_button').removeAttr("disabled");
	}
	
	function clearForm() {
		var formObj = document.forms["slot_reservation"];
		<?php
		if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_name.value='';
			<?php
		}
		?>
		<?php
		if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_surname.value='';
			<?php
		}
		?>
		<?php
		if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_email.value='';
			<?php
		}
		?>
		<?php
		if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_phone.value='';
			<?php
		}
		?>
		<?php
		if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_message.value='';
			<?php
		}
		?>
		<?php
		if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_field1.value='';
			<?php
		}
		?>
		<?php
		if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_field2.value='';
			<?php
		}
		?>
		<?php
		if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_field3.value='';
			<?php
		}
		?>
		<?php
		if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) { 
			?>
			formObj.reservation_field4.value='';
			<?php
		}
		?>
		
		$wbc('#booking_captcha_error').fadeOut();
	}
	
	function updateCalendarSelect(category) {
		$wbc.ajax({
		  url: '<?php echo plugins_url('wp-booking-calendar/public');?>/ajax/getCalendarsList.php?category_id='+category,
		  success: function(data) {
			  arrData = data.split("|");
			  $wbc('#calendar_select_input').html(arrData[0]);
			  $wbc("#calendar_select_input").val($wbc("#calendar_select_input option:first").val());
			<?php 
			if($bookingSettingObj->getShowFirstFilledMonth() == 0) {
				?>
				var newday= today;
				<?php
			} else {
				?>
				monthData = arrData[2].split(",");
				var newday = new Date(monthData[0],monthData[1],monthData[2]);
				
				<?php
			}
			?>			 
			 getBookingMonthCalendar((newday.getMonth()+1),newday.getFullYear(),arrData[1],'<?php echo $publickey; ?>');
		  }
		});
	}
	function updateCalendar(calendar_id) {
		$wbc.ajax({
		  url: '<?php echo plugins_url('wp-booking-calendar/public');?>/ajax/getCalendar.php?calendar_id='+calendar_id,
		  success: function(data) {
			  
			  <?php 
			if($bookingSettingObj->getShowFirstFilledMonth() == 0) {
				?>
				var newday= today;
				<?php
			} else {
				?>
				
				monthData = data.split(",");
				var newday = new Date(monthData[0],monthData[1],monthData[2]);
				
				<?php
			}
			?>
			 getBookingMonthCalendar((newday.getMonth()+1),newday.getFullYear(),calendar_id,'<?php echo $publickey; ?>');
		  }
		});
		
	}	<?php
	if($bookingSettingObj->getPaypal() == 1 && $bookingSettingObj->getPaypalAccount()!='' && $bookingSettingObj->getPaypalCurrency()!='' && $bookingSettingObj->getPaypalLocale() != '') {
		?>
		$wbc(function() {
			$wbc('#booking_submit_button').bind('click',function() {
				paypalSubmit();
			});
		});
		function addToPaypalForm() {
			/*
			$wbc('#slots_purchased').html('');
			var new_html = '';
			var i = 1;
			var j = 0;
			//console.log($wbc('#booking_slots').find('input').length);
			$wbc('#booking_slots').find('input').each(function() {
				
				
				if($wbc(this).attr('checked')) {
					var slot_id = $wbc(this).val();
					$wbc('#booking_submit_button').attr("disabled","disabled");
					//ajax request to get data
					$wbc.ajax({
					  url: '<?php echo plugins_url('wp-booking-calendar/public');?>/ajax/getSlotInfo.php?slot_id='+$wbc(this).val(),
					  success: function(data) {
						  
						  arrData=data.split("$");
						  if(arrData[1]>0) {
							  q = 1;
							  if($wbc('#seats_'+slot_id).val()!=undefined) {
								  q = $wbc('#seats_'+slot_id).val();
							  }
							  new_html += '<input type="hidden" name="item_name_'+i+'" value="'+arrData[0]+'" /><input type="hidden" name="amount_'+i+'" value="'+arrData[1]+'" /><input type="hidden" name="quantity_'+i+'" value="'+q+'" />';
							  $wbc('#slots_purchased').html(new_html);
							  
							  if(j == $wbc('#booking_slots').find('input').length) {
							  	$wbc('#booking_submit_button').removeAttr("disabled");
							  }
							  //console.log(j);
							 i++;
						  }
					  }
					});
					
				}
				j++;
			});
			*/
			
		}
		
		function paypalSubmit() {
			if(tmt.validator.validateForm("slot_reservation")) {
				if(Trim($wbc('#slots_purchased').html())!='') {
					$wbc('#slot_reservation').submit();
				} else {
					$wbc('#with_paypal').remove();
					document.forms["slot_reservation"].submit();
				}
			} 
		}
		function submitPaypal() {
			$wbc('#booking_container_all').parent().prepend('<div id="booking_sfondo" class="booking_modal_sfondo"></div>');
			$wbc('#booking_modal_loading').fadeIn();
			document.forms["paypal_form"].submit();
		}
		<?php
	}
	?>
	
</script>

<!-- ===============================================================
	box preview available time slots
================================================================ -->
<div class="booking_box_preview_container_all booking_font_cuprum" id="booking_box_slots" style="display:none !important">
    <div class="booking_box_preview_title" id="booking_popup_title"><?php echo $bookingCalendarObj->getCalendarTitle(); ?></div>
    <div class="booking_box_preview_slots_container" id="booking_slots_popup">
        
    </div>
</div>

<!-- ===============================================================
	booking calendar begins here
================================================================ -->
<div class="booking_main_container" id="booking_container_all">

	<a name="calendar"></a>
    <!-- =======================================
    	header (month + navigation + select)
	======================================== -->
	<div class="booking_header_container">
    	<!-- month and navigation -->
    	<div class="booking_month_container_all">
        	<!-- month -->
        	<div class="booking_month_container booking_month_container_custom">
            	<div class="booking_font_custom booking_month_name booking_month_name_custom" id="month_name"></div>
                <div class="booking_font_custom booking_month_year booking_year_name_custom" id="booking_month_year"></div>
            </div>
            <!-- navigation -->
            <div class="booking_month_nav_container" id="booking_month_nav">
            	<div class="booking_mont_nav_button_container" id="booking_month_nav_prev"><a href="javascript:getBookingPreviousMonth(<?php echo $bookingCalendarObj->getCalendarId(); ?>,'<?php echo $publickey; ?>',<?php echo $bookingSettingObj->getCalendarMonthLimitPast(); ?>);" class="booking_month_nav_button booking_month_navigation_button_custom"><img src="<?php echo plugins_url('wp-booking-calendar/public');?>/images/prev.png" /></a></div>
                <div class="booking_mont_nav_button_container" id="booking_month_nav_next"><a href="javascript:getBookingNextMonth(<?php echo $bookingCalendarObj->getCalendarId(); ?>,'<?php echo $publickey; ?>',<?php echo $bookingSettingObj->getCalendarMonthLimitFuture(); ?>);" class="booking_month_nav_button booking_month_navigation_button_custom"><img src="<?php echo plugins_url('wp-booking-calendar/public');?>/images/next.png" /></a></div>
            </div>
            <div class="booking_cleardiv"></div>
            <div class="booking_back_today" id="booking_back_today"><a href="javascript:getBookingMonthCalendar((today.getMonth()+1),today.getFullYear(),'<?php echo $bookingCalendarObj->getCalendarId(); ?>','<?php echo $publickey; ?>');"><?php echo $bookingLangObj->getLabel("BACK_TODAY"); ?></a></div>
        </div>
        <div class="booking_select_calendar_container">
         <?php
		if($bookingSettingObj->getShowCategorySelection() == 1 && (!isset($_GET["calendar_id"]) || $_GET["calendar_id"] == 0) && (!isset($_GET["category_id"]) || $_GET["category_id"] == 0)) {
			?>
			<!-- select calendar -->
			
            
            	<!-- select message -->
				<div class="booking_float_right booking_font_13" id="booking_category_select_label"><?php echo $bookingLangObj->getLabel("SELECT_CATEGORY"); ?></div>
				<div class="booking_cleardiv"></div>
				<!-- select -->
				<div class="booking_float_right booking_margin_b_10" id="booking_category_select">
					<?php
					$arrayCategories = $bookingListObj->getCategoriesList('ORDER BY category_order');
					if(count($arrayCategories) > 0) {
						?>
						<select name="category" onchange="javascript:updateCalendarSelect(this.options[this.selectedIndex].value);">
							<?php
							foreach($arrayCategories as $categoryId => $category) {
								?>
								<option value="<?php echo $categoryId; ?>" <?php if($categoryId == $bookingCategoryObj->getCategoryId()) { echo 'selected="selected"'; }?>><?php echo $category["category_name"]; ?></option>
								<?php
							}
							?>
						</select>
						<?php
					}
					?>
				</div>
				
				
				
				<div class="booking_cleardiv"></div>
			
            
			<?php
		}
		?>
        
        <?php
		if($bookingSettingObj->getShowCalendarSelection() == 1 && (!isset($_GET["calendar_id"]) || $_GET["calendar_id"] == 0)) {
			?>
			<!-- select calendar -->
			
            
            	<!-- select message -->
				<div class="booking_float_right booking_font_13" id="booking_calendar_select_label"><?php echo $bookingLangObj->getLabel("SELECT_CALENDAR"); ?></div>
				<div class="booking_cleardiv"></div>
				<!-- select -->
				<div class="booking_float_right" id="booking_calendar_select">
					<?php
					
					$arrayCalendars = $bookingListObj->getCalendarsList('ORDER BY calendar_order',$bookingCategoryObj->getCategoryId());
					if(count($arrayCalendars) > 0) {
						?>
						<select name="calendar" id="calendar_select_input" onchange="javascript:updateCalendar(this.options[this.selectedIndex].value);">
							<?php
							foreach($arrayCalendars as $calendarId => $calendar) {
								?>
								<option value="<?php echo $calendarId; ?>" <?php if($calendarId == $bookingCalendarObj->getCalendarId()) { echo "selected"; }?>><?php echo $calendar["calendar_title"]; ?></option>
								<?php
							}
							?>
						</select>
						<?php
					}
					?>
				</div>
				
				
				
				
			
            
			<?php
		}
		?>
        </div>
        
    </div>
    
    
    <!-- =======================================
    	calendar
	======================================== -->
    
				<div class="booking_cleardiv"></div>
    <!-- calendar -->
    <div class="booking_calendar_container_all">
    	<!-- days name -->
    	<div class="booking_name_days_container" id="booking_name_days_container">
        	<?php
			if($bookingSettingObj->getDateFormat() == "UK" || $bookingSettingObj->getDateFormat() == "EU") {
				?>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("MONDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("TUESDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("WEDNESDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("THURSDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("FRIDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("SATURDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom" style="margin-right: 0px;"><?php echo $bookingLangObj->getLabel("SUNDAY"); ?></div>
                <?php
			} else {
				?>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("SUNDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("MONDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("TUESDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("WEDNESDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("THURSDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom"><?php echo $bookingLangObj->getLabel("FRIDAY"); ?></div>
                <div class="booking_font_custom booking_day_name booking_weekdays_custom" style="margin-right: 0px;"><?php echo $bookingLangObj->getLabel("SATURDAY"); ?></div>
                <?php
			}
			?>
        </div>
        
        <!-- days -->
        <div class="days_container_all" id="booking_calendar_container">
        	<!-- content by js -->
        </div>
    </div>
    
    <!-- =======================================
    	booking form. It appears once user clicked on a day
	======================================== -->
    <?php 
	$current_user_id = 0;
	if($bookingSettingObj->getWordpressRegistration()  == 1) {
		  $display_form = "none";
		  $display_login = "block";
		  global $current_user;
		  get_currentuserinfo();
		
		if($current_user->ID>0) {
			$display_form = "block";
			$display_login = "none";
			$current_user_id = $current_user->ID;
		}
		
	} else {
		$display_form = "block";
		$display_login = "none";
		global $current_user;
	}
      
?>
<div id="booking_container" style="display:none !important">
    <form name="slot_reservation" id="slot_reservation" action="<?php echo plugins_url('wp-booking-calendar/public/');?>ajax/doReservation.php" method="post" target="iframe_submit" tmt:validate="true" style="display:inline;">
    <input type="hidden" name="wordpress_user_id" id="wordpress_user_id" value="<?php echo $current_user_id; ?>" />
    <input type="hidden" name="post_id" value="<?php echo $post->ID; ?>" />
    <div class="booking_width_100p booking_margin_t_30">
    	<div id="booking_slot_form" class="booking_font_cuprum">
    	
        </div>
        
        <input type="hidden" name="calendar_id" id="calendar_id" value="" />
        
        
        <!-- rightside -->
        <div class="booking_bg_567 booking_mark_fff booking_padding_10 booking_margin_t_20" id="form_container_all" style="background-color:<?php echo $bookingSettingObj->getFormBg(); ?>;color:<?php echo $bookingSettingObj->getFormColor(); ?>;display:<?php echo $display_form; ?> !important">
        	
			
			<?php
			if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- name -->
                <?php
					if($bookingSettingObj->getReservationFieldType('reservation_name') == 'text') {
						?>
                        <div class="booking_float_left booking_margin_r_2p booking_width_23p">
							<div><?php echo $bookingLangObj->getLabel("INDEX_NAME"); ?></div>
                       		<input type="text" name="reservation_name" id="reservation_name" class="booking_field_input_custom booking_width_90p booking_border_none" <?php if(in_array("reservation_name",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_NAME_ALERT").'"'; }?> value=""/>
                        </div>
                        <?php
					} else if($bookingSettingObj->getReservationFieldType('reservation_name') == 'textarea') {
						?>
                        <div class="booking_float_left booking_margin_r_2p booking_width_98p">
							<div><?php echo $bookingLangObj->getLabel("INDEX_NAME"); ?></div>
                        	<textarea name="reservation_name" id="reservation_name" class="booking_field_input_custom booking_width_98p height_25 booking_border_none" <?php if(in_array("reservation_name",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_NAME_ALERT").'"'; }?>></textarea>
                        </div>
                        <?php
					}
					?>
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_name" value="" />
                <?php
			}
			
			
			if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- surname -->
                <?php
                    if($bookingSettingObj->getReservationFieldType('reservation_surname') == 'text') {
                        ?>
                        <div class="booking_float_left booking_margin_r_2p booking_width_23p">
							<div><?php echo $bookingLangObj->getLabel("INDEX_SURNAME"); ?></div>
                       		<input type="text" name="reservation_surname" id="reservation_surname" class="booking_field_input_custom booking_width_90p booking_border_none" <?php if(in_array("reservation_surname",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_SURNAME_ALERT").'"'; }?> value=""/>
                        </div>
                        <?php
                    } else if($bookingSettingObj->getReservationFieldType('reservation_surname') == 'textarea') {
                        ?>
                        <div class="booking_float_left booking_margin_r_2p booking_width_98p">
							<div><?php echo $bookingLangObj->getLabel("INDEX_SURNAME"); ?></div>
                        	<textarea name="reservation_surname" id="reservation_surname" class="booking_field_input_custom booking_width_98p height_25 booking_border_none" <?php if(in_array("reservation_surname",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_SURNAME_ALERT").'"'; }?>></textarea>
                        </div>
                        <?php
                    }
                    ?>
                
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_surname" value="" />
                <?php
			}
			
			
			
			if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- email -->
                <?php
                    if($bookingSettingObj->getReservationFieldType('reservation_email') == 'text') {
                        ?>
                        <div class="booking_float_left booking_margin_r_2p booking_width_23p">
							<div><?php echo $bookingLangObj->getLabel("INDEX_EMAIL"); ?></div>
                       		<input type="text"  name="reservation_email" id="reservation_email" class="booking_field_input_custom booking_width_90p booking_border_none" <?php if(in_array("reservation_email",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:pattern="email" tmt:message="'.$bookingLangObj->getLabel("INDEX_EMAIL_ALERT").'"'; }?> value="<?php echo $current_user->user_email; ?>"/>
                        </div>
                        <?php
                    } else if($bookingSettingObj->getReservationFieldType('reservation_email') == 'textarea') {
                        ?>
                        <div class="booking_float_left booking_margin_r_2p booking_width_98p">
							<div><?php echo $bookingLangObj->getLabel("INDEX_EMAIL"); ?></div>
                        	<textarea  name="reservation_email" id="reservation_email" class="booking_field_input_custom booking_width_98p height_25 booking_border_none" <?php if(in_array("reservation_email",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:pattern="email" tmt:message="'.$bookingLangObj->getLabel("INDEX_EMAIL_ALERT").'"'; }?>><?php echo $current_user->user_email; ?></textarea>
                        </div>
                        <?php
                    }
                    ?>
                
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_email" value="" />
                <?php
			}
			
			
			
			if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- phone -->
                <?php
				if($bookingSettingObj->getReservationFieldType('reservation_phone') == 'text') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_23p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_PHONE"); ?></div>
						<input type="text" name="reservation_phone" class="booking_field_input_custom booking_width_90p booking_border_none" <?php if(in_array("reservation_phone",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_PHONE_ALERT").'"'; }?>/>
                    </div>
					<?php
				} else if($bookingSettingObj->getReservationFieldType('reservation_phone') == 'textarea') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_98p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_PHONE"); ?></div>
						<textarea name="reservation_phone" class="booking_field_input_custom booking_width_98p height_25 booking_border_none" <?php if(in_array("reservation_phone",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_PHONE_ALERT").'"'; }?>></textarea>
                    </div>
					<?php
				}
				?>
                
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_phone" value="" />
                <?php
			}
			
			
			
			if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- message -->
                <?php
				if($bookingSettingObj->getReservationFieldType('reservation_message') == 'text') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_23p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_MESSAGE"); ?></div>
						<input type="text" class="booking_field_input_custom booking_width_90p booking_border_none" name="reservation_message" <?php if(in_array("reservation_message",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_MESSAGE_ALERT").'"'; }?>/>
                    </div>
					<?php
				} else if($bookingSettingObj->getReservationFieldType('reservation_message') == 'textarea') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_98p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_MESSAGE"); ?></div>
						<textarea class="booking_field_input_custom booking_width_98p height_25 booking_border_none" name="reservation_message" <?php if(in_array("reservation_message",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_MESSAGE_ALERT").'"'; }?>></textarea>
                    </div>
					<?php
				}
				?>
                
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_message" value="" />
                <?php
			}
			
			
			
			if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- additional 1 -->
                <?php
				if($bookingSettingObj->getReservationFieldType('reservation_field1') == 'text') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_23p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD1"); ?></div>
						<input type="text" name="reservation_field1" class="booking_field_input_custom booking_width_90p booking_border_none" <?php if(in_array("reservation_field1",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD1_ALERT").'"'; }?>/>
                    </div>
					<?php
				} else if($bookingSettingObj->getReservationFieldType('reservation_field1') == 'textarea') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_98p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD1"); ?></div>
						<textarea name="reservation_field1" class="booking_field_input_custom booking_width_98p height_25 booking_border_none" <?php if(in_array("reservation_field1",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD1_ALERT").'"'; }?>></textarea>
                    </div>
					<?php
				}
				?>
				
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_field1" value="" />
                <?php
			}
			
			
			
			if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- additional 2 -->
                <?php
				if($bookingSettingObj->getReservationFieldType('reservation_field2') == 'text') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_23p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD2"); ?></div>
						<input type="text" name="reservation_field2" class="booking_field_input_custom booking_width_90p booking_border_none" <?php if(in_array("reservation_field2",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD2_ALERT").'"'; }?>/>
                    </div>
					<?php
				} else if($bookingSettingObj->getReservationFieldType('reservation_field2') == 'textarea') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_98p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD2"); ?></div>
						<textarea name="reservation_field2" class="booking_field_input_custom booking_width_98p height_25 booking_border_none" <?php if(in_array("reservation_field2",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD2_ALERT").'"'; }?>></textarea>
                    </div>
					<?php
				}
				?>
                
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_field2" value="" />
                <?php
			}
			
			
			
			if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- additional 3 -->
                <?php
				if($bookingSettingObj->getReservationFieldType('reservation_field3') == 'text') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_23p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD3"); ?></div>
						<input type="text" name="reservation_field3" class="booking_field_input_custom booking_width_90p booking_border_none" <?php if(in_array("reservation_field3",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD3_ALERT").'"'; }?>/>
                    </div>
					<?php
				} else if($bookingSettingObj->getReservationFieldType('reservation_field3') == 'textarea') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_98p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD3"); ?></div>
						<textarea name="reservation_field3" class="booking_field_input_custom booking_width_98p height_25 booking_border_none" <?php if(in_array("reservation_field3",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD3_ALERT").'"'; }?>></textarea>
                    </div>
					<?php
				}
				?>
                
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_field3" value="" />
                <?php
			}
			
			
			
			if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) { 
				?>
				<!-- additional 4 -->
                <?php
				if($bookingSettingObj->getReservationFieldType('reservation_field4') == 'text') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_23p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD4"); ?></div>
				   		<input type="text" name="reservation_field4" class="booking_field_input_custom booking_width_90p booking_border_none" <?php if(in_array("reservation_field4",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD4_ALERT").'"'; }?>/>
                    </div>
					<?php
				} else if($bookingSettingObj->getReservationFieldType('reservation_field4') == 'textarea') {
					?>
                    <div class="booking_float_left booking_margin_r_2p booking_width_98p">
						<div><?php echo $bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD4"); ?></div>
						<textarea name="reservation_field4" class="booking_field_input_custom booking_width_98p height_25 booking_border_none" <?php if(in_array("reservation_field4",$bookingSettingObj->getMandatoryFields())) { echo 'tmt:required="true" tmt:message="'.$bookingLangObj->getLabel("INDEX_RESERVATION_ADDITIONAL_FIELD4_ALERT").'"'; }?>></textarea>
                    </div>
					<?php
				}
				?>
                
				<?php
			} else {
				?>
                <input type="hidden" name="reservation_field4" value="" />
                <?php
			}
			?>
            
            
            
            <?php
			if($bookingSettingObj->getShowTerms() == 1 && $bookingSettingObj->getTermsLabel() != '') {
				?>
                <!-- terms -->
                <div class="booking_cleardiv"></div>
                <div class="booking_margin_t_10">
                    <div class="booking_float_left"><input type="checkbox" name="reservation_terms" value="checked" tmt:minchecked="1" tmt:message="<?php echo $bookingLangObj->getLabel("INDEX_TERMS_AND_CONDITIONS_ALERT");?>"/></div>
                    <div class="booking_float_left booking_margin_l_10"><a href="<?php echo $bookingSettingObj->getTermsLink(); ?>" class="booking_mark_fff font_size_12 booking_no_decoration" target="_blank"><?php echo $bookingSettingObj->getTermsLabel(); ?></a></div>
                    <div class="booking_cleardiv"></div>
                    <div class="booking_form_input"></div>
                </div>
                <?php
			}
			?>
            
            <div class="booking_cleardiv"></div>
            
            <?php
			if($bookingSettingObj->getWordpressRegistration() == 0) {
				?>
				<!-- google capthca -->
				<div class="booking_margin_t_10">
					<div id="booking_captcha_error" style="display:none !important"><?php echo $bookingLangObj->getLabel("INDEX_INVALID_CODE");?></div>
					<div id="captcha"></div>
				</div>
				
				<div class="booking_cleardiv"></div>
				<?php
			}
			?>
            
            
            <!-- book now button and clear -->
            <div class="booking_margin_t_20">
            	<div class="booking_float_left"><a href="javascript:clearForm();" class="booking_clear_custom booking_public_button booking_grey_button"><?php echo $bookingLangObj->getLabel("INDEX_CLEAR"); ?></a></div>
                
                	 <?php
					if($bookingSettingObj->getPaypal()==1 && $bookingSettingObj->getPaypalAccount() != '' && $bookingSettingObj->getPaypalLocale() != '' && $bookingSettingObj->getPaypalCurrency() != '') {
						?>
                        <div class="booking_float_left booking_margin_l_20">
                        	<input type="hidden" name="with_paypal" id="with_paypal" value="1" />
                        	<input type="button" class="booking_book_now_custom" id="booking_submit_button" value="<?php echo $bookingLangObj->getLabel("INDEX_BOOK_NOW"); ?>" style="cursor:pointer" />
                        </div>
                        <div class="booking_cleardiv"></div>
                        <?php
					} else {
						?>
                        <div class="booking_float_left booking_margin_l_20">
                        	<input type="submit" class="booking_book_now_custom" id="booking_submit_button" value="<?php echo $bookingLangObj->getLabel("INDEX_BOOK_NOW"); ?>" style="cursor:pointer" />
                        </div>
                        <div class="booking_cleardiv"></div>
                        <?php
					}
					?>
            </div>
            
            
            
        </div>
        
    </div>
    </form>
          
            
            <script type="text/javascript" charset="utf-8">
                $wbc(document).ready(function() {
                    $wbc(".tab_content_login").hide();
                    $wbc("ul.tabs_login li:first").addClass("active_login").show();
                    $wbc(".tab_content_login:first").show();
                    $wbc("ul.tabs_login li").click(function() {
                        $wbc("ul.tabs_login li").removeClass("active_login");
                        $wbc(this).addClass("active_login");
                        $wbc(".tab_content_login").hide();
                        var activeTab = $wbc(this).find("a").attr("href");
                        if ($wbc.browser.msie) {$wbc(activeTab).show();}
                        else {$wbc(activeTab).show();}
                        return false;
                    });
                });
            </script>
            
           
            <div id="login-register-password-container" style="display:<?php echo $display_login; ?> !important">
            
                <?php global $user_ID, $user_identity; get_currentuserinfo(); if (!$user_ID) { ?>
            
                <ul class="tabs_login">
                    <li class="active_login"><a href="#tab1_login"><?php echo $bookingLangObj->getLabel("INDEX_LOGIN_TAB"); ?></a></li>
                    <li><a href="#tab2_login"><?php echo $bookingLangObj->getLabel("INDEX_REGISTER_TAB"); ?></a></li>
                   
                </ul>
                <div class="tab_container_login">
                    <div id="tab1_login" class="tab_content_login">
            
                        
            
                        <h3><?php echo $bookingSettingObj->getRegistrationText(); ?></h3>
            
                      
            
            			<script>
							function submitLogin() {
								if(Trim($wbc('#user_login') .val()) != '' && Trim($wbc('#user_pass').val()) != '') {
									
									$wbc('#booking_container_all').parent().prepend('<div id="booking_sfondo" class="booking_modal_sfondo"></div>');
									$wbc('#booking_modal_loading').fadeIn();
		
									$wbc.ajax({
										type: "POST",
										url: "<?php bloginfo('url') ?>/wp-login.php",
										data: { log: $wbc('#user_login').val(), pwd: $wbc('#user_pass').val() }
									}).done(function() {
										$wbc.ajax({
										  url: '<?php echo plugins_url('wp-booking-calendar/public');?>/ajax/getCurrentUser.php',
										  success: function(data) {
											  $wbc('#booking_sfondo').remove();
											  $wbc('#booking_modal_loading').fadeOut();
											  if(data!='error') {
												  arrData = data.split("|");
												  $wbc('#login-register-password-container').removeAttr('style');
												  $wbc('#login-register-password-container').css('display','none !important');
												  $wbc('#reservation_name').val(arrData[0]);
												  $wbc('#reservation_surname').val(arrData[1]);
												  $wbc('#reservation_email').val(arrData[2]);
												  $wbc('#wordpress_user_id').val(arrData[3]);
												  $wbc('#form_container_all').removeAttr('style');
												  $wbc('#form_container_all').css('display','block !important');
												  
											  } else {
												  alert("<?php echo $bookingLangObj->getLabel("INDEX_LOGIN_ERROR_DATA_ALERT"); ?>");
											  }
											  
										  }
										});
										
									});
								} else {
									alert("<?php echo $bookingLangObj->getLabel("INDEX_LOGIN_EMPTY_DATA_ALERT"); ?>");
								}
							}
						</script>
                        <form method="post" action="<?php bloginfo('url') ?>/wp-login.php" class="wp-user-form">
                            <div class="username">
                                <label for="user_login"><?php echo $bookingLangObj->getLabel("INDEX_LOGIN_USERNAME"); ?>: </label>
                                <input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" />
                            </div>
                            <div class="password">
                                <label for="user_pass"><?php echo $bookingLangObj->getLabel("INDEX_LOGIN_PASSWORD"); ?>: </label>
                                <input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />
                            </div>
                            <div class="login_fields">
                                
                                <?php do_action('login_form'); ?>
                                <input type="button" name="user-submit" value="<?php echo $bookingLangObj->getLabel("INDEX_LOGIN_BUTTON"); ?>" tabindex="14" class="user-submit" onclick="javascript:submitLogin();" />
                                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                                <input type="hidden" name="user-cookie" value="1" />
                            </div>
                        </form>
                    </div>
                    <div id="tab2_login" class="tab_content_login" style="display:none;">
                        <h3><?php echo $bookingSettingObj->getRegistrationText(); ?></h3>
                        <div class="booking_font_10 booking_mark_567" style="margin-top:-10px"><?php echo $bookingLangObj->getLabel("INDEX_REGISTER_MANDATORY"); ?></div>
                        <form method="post" action="<?php echo plugins_url('wp-booking-calendar/public');?>/ajax/registerUser.php" class="wp-user-form" target="iframe_submit" tmt:validate="true" name="registration_form">
                            <div class="username">
                                <label for="user_login"><?php echo $bookingLangObj->getLabel("INDEX_REGISTER_USERNAME"); ?>: </label>
                                <input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" tmt:required="true" tmt:pattern="alphanumeric" tmt:message="<?php echo $bookingLangObj->getLabel("INDEX_REGISTER_USERNAME_ALERT"); ?>" />
                            </div>
                            <div class="password">
                                <label for="user_email"><?php echo $bookingLangObj->getLabel("INDEX_REGISTER_EMAIL"); ?>: </label>
                                <input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" tmt:required="true" tmt:pattern="email" tmt:message="<?php echo $bookingLangObj->getLabel("INDEX_REGISTER_EMAIL_ALERT"); ?>" />
                            </div>
                            <div class="password">
                                <label for="user_password"><?php echo $bookingLangObj->getLabel("INDEX_REGISTER_PASSWORD"); ?>: </label>
                                <input type="password" name="user_password" value="" size="25" id="user_password" tabindex="103" tmt:required="true" tmt:pattern="alphanumeric" tmt:message="<?php echo $bookingLangObj->getLabel("INDEX_REGISTER_PASSWORD_ALERT"); ?>" />
                            </div>
                            <div class="password">
                                <label for="user_confirm_password"><?php echo $bookingLangObj->getLabel("INDEX_REGISTER_CONFIRM_PASSWORD"); ?>: </label>
                                <input type="password" name="user_confirm_password" value="" size="25" id="user_confirm_password" tabindex="104" tmt:required="true" tmt:pattern="alphanumeric" tmt:equalto="user_password" tmt:message="<?php echo $bookingLangObj->getLabel("INDEX_REGISTER_CONFIRM_PASSWORD_ALERT"); ?>" />
                            </div>
                             <!-- google capthca -->
                            <div class="booking_margin_t_10">
                                <div id="booking_captcha_error" style="display:none !important"><?php echo $bookingLangObj->getLabel("INDEX_INVALID_CODE");?></div>
                                <div id="captcha"></div>
                            </div>
                            
                            <div class="booking_cleardiv"></div>
                            <div class="login_fields">
                                <?php do_action('register_form'); ?>
                                <input type="submit" id="reg_button" name="user-submit" value="<?php echo $bookingLangObj->getLabel("INDEX_REGISTER_BUTTON"); ?>" class="user-submit" tabindex="105" />
                                
                                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>?register=true" />
                                <input type="hidden" name="user-cookie" value="1" />
                            </div>
                        </form>
                    </div>
                    
                </div>
            
                <?php }  ?>
            
            </div>
            
           
    </div>
    <?php
	if($bookingSettingObj->getPaypal()==1 && $bookingSettingObj->getPaypalAccount() != '' && $bookingSettingObj->getPaypalLocale() != '' && $bookingSettingObj->getPaypalCurrency() != '') {
		?>
        <!-- paypal form -->
        <form action='https://www.paypal.com/cgi-bin/webscr' METHOD='POST' name="paypal_form" style="display:inline">

            <!-- PayPal Configuration -->
            <!--<input type="hidden" name="business" value="businessutente@gmail.com">-->
            <input type="hidden" name="business" value="<?php echo $bookingSettingObj->getPaypalAccount(); ?>">
            
            <input type="hidden" name="upload" value="1" />

            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="charset" value="utf-8">
            
            
            <!--slots purchased-->
            <div id="slots_purchased">
            	
            </div>
            
            <!--<input type="hidden" name="notify_url" value="<?php //echo site_url('')."/?page_id=".$post->ID."&paypal_confirm=1"; ?>">-->
            <input type="hidden" name="notify_url" value="<?php echo site_url('')."/?page_id=".$post->ID."&paypal_ipn_notice=1"; ?>">
           
            <input type="hidden" name="return" value="<?php echo site_url('')."/?page_id=".$post->ID."&paypal_confirm=1"; ?>">
            <input type="hidden" name="cancel_return" value="<?php echo site_url('')."/?page_id=".$post->ID; ?>&paypal_cancel=1">
            
            <input type="hidden" name="rm" value="POST">
            <input type="hidden" name="currency_code" value="<?php echo $bookingSettingObj->getPaypalCurrency();?>">
            <input type="hidden" name="lc" value="<?php echo $bookingSettingObj->getPaypalLocale(); ?>">
            
           
            
                            
                            
                            
        </form>
        <?php
	}
	?>
	<div style="clear:both"></div>
    
</div>


<!-- ===============================================================
	box after booking
================================================================ -->
<div id="booking_modal_response" class="booking_modal" style="display:none !important">
	<?php
	if($bookingSettingObj->getReservationConfirmationMode() == 1) {
		echo $bookingLangObj->getLabel("INDEX_CONFIRM1");
	} else if($bookingSettingObj->getReservationConfirmationMode() == 2) {
		echo $bookingLangObj->getLabel("INDEX_CONFIRM2");
	} else if($bookingSettingObj->getReservationConfirmationMode() == 3) {
		echo $bookingLangObj->getLabel("INDEX_CONFIRM3");
	}
	?>
    <br /><a href="javascript:hideBookingResponse(<?php echo $bookingCalendarObj->getCalendarId(); ?>,'<?php echo $publickey; ?>');" class="booking_button booking_ok_button" id="ok_response"><?php echo $bookingLangObj->getLabel("INDEX_RESPONSE_OK_BUTTON"); ?></a>
</div>

<!-- preloader -->
<div id="booking_modal_loading" class="booking_modal_loading" style="display:none !important">
	<img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>/images/loading.png" border=0 style="-moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;" />
</div>
<!-- necessary to submit form without reload the page -->
<iframe style="border:none;width:0px;height:0px" id="iframe_submit" name="iframe_submit"></iframe>

