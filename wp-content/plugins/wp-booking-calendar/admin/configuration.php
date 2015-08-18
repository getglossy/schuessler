<?php
include 'common.php';
/*if(!isset($_SESSION["admin_id"]) || $_SESSION["admin_id"] == 20000) {
	header('Location: login.php');
}*/
if(isset($_POST["reservation_confirmation_mode"])) {	
	$bookingSettingObj->updateSettings();
	//header('Location: welcome.php');	
}

$arrayTimezones = $bookingListObj->getTimezonesList();

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
		if($bookingSettingObj->getReservationConfirmationMode() == "2") {
			?>			
			$wbc('#redirect_path_container').fadeIn();			
			<?php
			if($bookingSettingObj->getRedirect()!='') {
				?>
				$wbc('#add_redirect').attr("checked","checked");
				$wbc('#redirect_text').slideDown();
				<?php
			}
		}
		if($bookingSettingObj->getRecaptchaEnabled() == "1") {
			?>
			$wbc('#recaptcha_enabled').attr("checked","true");
			$wbc('#recaptcha_options').slideDown();
			$wbc('#recaptcha_public_key').attr("tmt:required","true");
			$wbc('#recaptcha_private_key').attr("tmt:required","true");
			<?php
		}
		if($bookingSettingObj->getReservationCancel() == "1") {
			?>			
			$wbc('#redirect_cancel_path_container').fadeIn();			
			<?php
			if($bookingSettingObj->getCancelRedirect()!='') {
				?>
				$wbc('#add_cancel_redirect').attr("checked","checked");
				$wbc('#redirect_cancel_text').slideDown();
				<?php
			}
		}
		?>
		showTermsFields(<?php echo $bookingSettingObj->getShowTerms(); ?>);
		showPaypalFields(<?php echo $bookingSettingObj->getPaypal(); ?>);
		showCustomOptions(<?php echo $bookingSettingObj->getSlotsUnlimited(); ?>);
		showRegistrationField(<?php echo $bookingSettingObj->getWordpressRegistration(); ?>);
	});
	function showRedirect(val) {
		if(val == 2) {
			$wbc('#redirect_path_container').fadeIn();
		} else {
			$wbc('#redirect_path_container').fadeOut();
		}
	}
	function showRecaptchaOptions(el) {
		if(el.checked) {
			$wbc('#recaptcha_options').slideDown();
			$wbc('#recaptcha_public_key').attr("tmt:required","true");
			$wbc('#recaptcha_private_key').attr("tmt:required","true");
		} else {
			$wbc('#recaptcha_options').slideUp();
			$wbc('#recaptcha_public_key').attr("tmt:required","false");
			$wbc('#recaptcha_private_key').attr("tmt:required","false");
		}
	}
	
	function showRedirectPath(el) {
		if(el.checked) {
			$wbc('#redirect_text').slideDown();
		} else {
			$wbc('#redirect_text').slideUp();
			$wbc('#redirect_confirmation_path').val('');
		}
	}
	
	function showCancelRedirect(el) {
		if(el.checked) {
			$wbc('#redirect_cancel_path_container').fadeIn();
		} else {
			$wbc('#redirect_cancel_path_container').fadeOut();
		}
	}
	function showCancelRedirectPath(el) {
		if(el.checked) {
			$wbc('#redirect_cancel_text').slideDown();
		} else {
			$wbc('#redirect_cancel_text').slideUp();
			$wbc('#redirect_cancel_path').val('');
		}
	}
	function showTermsFields(val) {
		if(val==1) {
			$wbc('#terms_fields').slideDown();
		} else {
			$wbc('#terms_fields').slideUp();
			
		}
	}
	function showPaypalFields(val) {
		if(val==1) {
			$wbc('#paypal_fields').slideDown();
		} else {
			$wbc('#paypal_fields').slideUp();
			
		}
	}
	
	function showRegistrationField(val) {
		if(val==1) {
			$wbc('#registration_fields').slideDown();
		} else {
			$wbc('#registration_fields').slideUp();
			
		}
	}
	

	function showCustomOptions(val) {
		if(val==2) {
			$wbc('#custom_options').slideDown();
		} else {
			$wbc('#custom_options').slideUp();
			
		}
	}
	
	function displayError(formNode,validators) {
		for(var i=0;i<validators.length;i++){
			if(validators[i].name == 'reservation_confirmation_mode') {
				$wbc('#reservation_confirmation_mode_label').css('color','#C00');
			}
		  
		 }
		 var error="";
		 for(var i=0;i<validators.length;i++){
		  error += "\r\n"+validators[i].message;
		 }
		 if(Trim(error)!= '') {
		 	alert(error);
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
        
        <form name="editsettings" action="" method="post" tmt:validate="true" enctype="multipart/form-data" tmt:callback="displayError">           
                
              
                
        <!-- 
        =======================
        === Timezone ==
        =======================
        -->
        <div class="booking_font_bold"><label for="timezone"><?php echo $bookingLangObj->getLabel("CONFIGURATION_TIMEZONE_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_TIMEZONE_SUBLABEL"); ?></div>
       
        <div class="booking_font_12 booking_margin_t_10">
            <select name="timezone" id="timezone" tmt:invalidvalue="" tmt:required="true" tmt:message="<?php echo $bookingLangObj->getLabel("CONFIGURATION_TIMEZONE_ALERT"); ?>">
                <option value=""><?php echo $bookingLangObj->getLabel("CONFIGURATION_TIMEZONE_SELECT"); ?></option>
                <?php
                foreach($arrayTimezones as $timezoneid => $timezone) {
                ?>
                    <option value="<?php echo $timezone["timezone_value"]; ?>" <?php if(trim($bookingSettingObj->getTimezone()) == trim($timezone["timezone_value"])) { echo 'selected="selected"'; }?>><?php echo $timezone["timezone_name"]; ?></option>
                <?php
                }
                ?>
            </select>
          
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
        
        <!-- 
        =======================
        === Date format ==
        =======================
        -->
        <div class="booking_font_bold"><label for="date_format"><?php echo $bookingLangObj->getLabel("CONFIGURATION_DATE_FORMAT_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_DATE_FORMAT_SUBLABEL"); ?></div>
        
        <div class="booking_font_12 booking_margin_t_10">
           <select name="date_format">
             <option value="UK" <?php if($bookingSettingObj->getDateFormat()=="UK") { echo "selected"; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_DATE_FORMAT_UK"); ?></option>
             <option value="US" <?php if($bookingSettingObj->getDateFormat()=="US") { echo "selected"; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_DATE_FORMAT_US"); ?></option>
             <option value="EU" <?php if($bookingSettingObj->getDateFormat()=="EU") { echo "selected"; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_DATE_FORMAT_EU"); ?></option>
           </select>
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
       
        
        
        <!--
        =======================
        === Time format ==
        =======================
        -->
        <div class="booking_font_bold"><label for="time_format"><?php echo $bookingLangObj->getLabel("CONFIGURATION_TIME_FORMAT_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_TIME_FORMAT_SUBLABEL"); ?></div>
     
        <div class="booking_font_12 booking_margin_t_10">
           <select name="time_format">
             <option value="12" <?php if($bookingSettingObj->getTimeFormat()=="12") { echo "selected"; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_TIME_FORMAT_12"); ?></option>
             <option value="24" <?php if($bookingSettingObj->getTimeFormat()=="24") { echo "selected"; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_TIME_FORMAT_24"); ?></option>
           </select>
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
          
          
               
        <!-- 
        =======================
        === Email Admin ==
        =======================
        -->
        <div class="booking_font_bold"><label for="email_reservation"><?php echo $bookingLangObj->getLabel("CONFIGURATION_EMAIL_RESERVATION_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_EMAIL_RESERVATION_SUBLABEL"); ?></div>
     
        <div class="booking_font_12 booking_margin_t_10"><input type="text" id="email_reservation" class="booking_width_250 booking_height_30" name="email_reservation" value="<?php echo $bookingSettingObj->getEmailReservation(); ?>" tmt:required="true" tmt:message="<?php echo $bookingLangObj->getLabel("CONFIGURATION_EMAIL_RESERVATION_ALERT"); ?>"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
         
         
         
         
                
        <!-- 
        =======================
        === Email From ==
        =======================
        -->
        <div class="booking_font_bold"><label for="email_from_reservation"><?php echo $bookingLangObj->getLabel("CONFIGURATION_EMAIL_FROM_RESERVATION_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_EMAIL_FROM_RESERVATION_SUBLABEL"); ?></div>
        
        <div class="booking_font_12 booking_margin_t_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_NAME_FROM_RESERVATION_SIDE_LABEL"); ?>&nbsp;<input type="text" class="booking_width_250 booking_height_30" id="name_from_reservation" name="name_from_reservation" value="<?php echo $bookingSettingObj->getNameFromReservation(); ?>"></div>
        
        <div class="booking_font_12 booking_margin_t_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_EMAIL_FROM_RESERVATION_SIDE_LABEL"); ?>&nbsp;<input type="text" class="booking_width_250 booking_height_30" id="email_from_reservation" name="email_from_reservation" value="<?php echo $bookingSettingObj->getEmailFromReservation(); ?>" tmt:required="true" tmt:message="<?php echo $bookingLangObj->getLabel("CONFIGURATION_EMAIL_FROM_RESERVATION_ALERT"); ?>"></div>
        
        
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
                
                
        <!-- 
        ===============================
        === confirmation mode select ==
        ===============================
        -->
        <div class="booking_font_bold"><label for="reservation_confirmation_mode" id="reservation_confirmation_mode_label"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CONFIRMATION_MODE_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CONFIRMATION_MODE_SUBLABEL"); ?></div>
        
        <div class="booking_font_12 booking_margin_t_10">
            <select name="reservation_confirmation_mode" id="reservation_confirmation_mode" onchange="javascript:showRedirect(this.options[this.selectedIndex].value);" style="width:700px" tmt:invalidvalue="0" tmt:required="true" tmt:message="<?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CONFIRMATION_MODE_ALERT"); ?>">
                <option value="0"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CONFIRMATION_MODE_SELECT"); ?></option>
                <option value="1" <?php if($bookingSettingObj->getReservationConfirmationMode() == "1") { echo 'selected="selected"'; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CONFIRMATION_MODE_1"); ?></option>
                <option value="2" <?php if($bookingSettingObj->getReservationConfirmationMode() == "2") { echo 'selected="selected"'; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CONFIRMATION_MODE_2"); ?></option>
                <option value="3" <?php if($bookingSettingObj->getReservationConfirmationMode() == "3") { echo 'selected="selected"'; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CONFIRMATION_MODE_3"); ?></option>
            </select>
            
            <div id="redirect_path_container" class="booking_margin_t_20" style="display:none !important">
                <div class="booking_margin_t_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_REDIRECT_CONFIRMATION_PATH_LABEL"); ?> <input type="checkbox" name="add_redirect" id="add_redirect" value="1" onclick="javascript:showRedirectPath(this);" /></div>
                <div class="redirect_text" style="display:none !important" id="redirect_text"><?php echo $bookingLangObj->getLabel("CONFIGURATION_REDIRECT_CONFIRMATION_PATH_SUBLABEL"); ?>&nbsp;<input type="text" class="short_input_box" name="redirect_confirmation_path" id="redirect_confirmation_path" value="<?php echo $bookingSettingObj->getRedirect(); ?>"/></div>
            </div>
                
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
	<!-- 
        =======================
        === page after booking setting ==
        =======================
        -->
        <div class="booking_font_bold"><label for="reservation_cancel"><?php echo $bookingLangObj->getLabel("CONFIGURATION_REDIRECT_BOOKING_PATH_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_REDIRECT_BOOKING_PATH_SUBLABEL"); ?></div>
        
        <div class="booking_font_12 booking_margin_t_10"><input type="text" class="booking_width_250 booking_height_30" id="redirect_booking_path" name="redirect_booking_path" value="<?php echo $bookingSettingObj->getRedirectBookingPath(); ?>"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>             
        <!-- 
        =================================
        === cancel reservation setting ==
        =================================
        -->
        <div class="booking_font_bold"><label for="reservation_cancel"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CANCEL_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CANCEL_SUBLABEL"); ?></div>
        
        <div class="booking_font_12 booking_margin_t_10">
            <input type="checkbox" name="reservation_cancel" id="reservation_cancel" value ="1" <?php if($bookingSettingObj->getReservationCancel() == "1") { echo "checked"; } ?> onclick="javascript:showCancelRedirect(this);"/>&nbsp;<?php echo $bookingLangObj->getLabel("CONFIGURATION_RESERVATION_CANCEL_ENABLED"); ?>
            <div id="redirect_cancel_path_container" style="display:none !important">
                <div class="booking_margin_t_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_REDIRECT_CANCEL_PATH_LABEL"); ?> <input type="checkbox" name="add_cancel_redirect" id="add_cancel_redirect" value="1" onclick="javascript:showCancelRedirectPath(this);" class="booking_margin_t_10" /></div>
                <div class="booking_margin_t_10" style="display:none !important" id="redirect_cancel_text">
                	<div class="booking_float_left booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("CONFIGURATION_REDIRECT_CANCEL_PATH_SUBLABEL"); ?></div>
                    <div class="booking_float_left booking_margin_l_10"><input type="text" class="short_input_box" name="redirect_cancel_path" id="redirect_cancel_path" value="<?php echo $bookingSettingObj->getCancelRedirect(); ?>"/></div>
                    <div class="booking_cleardiv"></div>
                </div>
            </div>
                
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
                
        <!-- 
        =======================
        === google recaptcha ==
        =======================
        -->
        <div class="booking_font_bold"><label for="recaptcha_enabled"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_ENABLED_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_ENABLED_SUBLABEL"); ?></div>
       
        
        <div class="booking_float_left booking_margin_t_12"><input type="checkbox" name="recaptcha_enabled" id="recaptcha_enabled" value="1" onclick="javascript:showRecaptchaOptions(this);"/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_ENABLED_ENABLED"); ?></div>
        
        <div class="booking_cleardiv"></div>
        
        <div id="recaptcha_options" style="display:none !important">
            <div class="booking_font_bold booking_margin_t_20"><label for="recaptcha_public_key"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_PUBLIC_KEY_LABEL"); ?></label></div>
            <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_PUBLIC_KEY_SUBLABEL"); ?>  <a href="http://www.google.com/recaptcha">http://www.google.com/recaptcha</a></div>
            
            <div class="booking_font_12 booking_margin_t_10"><input type="text" class="booking_width_fluid" id="recaptcha_public_key" name="recaptcha_public_key" value="<?php echo $bookingSettingObj->getRecaptchaPublicKey(); ?>" tmt:required="false" tmt:message="<?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_PUBLIC_KEY_ALERT"); ?>" onblur="javascript:checkRecaptchaPublic();"></div>
        
            <div class="booking_font_bold booking_margin_t_20"><label for="recaptcha_private_key"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_PRIVATE_KEY_LABEL"); ?></label></div>
            <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_PRIVATE_KEY_SUBLABEL"); ?>  <a href="http://www.google.com/recaptcha">http://www.google.com/recaptcha</a></div>
            
            <div class="booking_font_12 booking_margin_t_10"><input type="text" class="booking_width_fluid" id="recaptcha_private_key" name="recaptcha_private_key" value="<?php echo $bookingSettingObj->getRecaptchaPrivateKey(); ?>" tmt:required="false" tmt:message="<?php echo $bookingLangObj->getLabel("CONFIGURATION_RECAPTCHA_PRIVATE_KEY_ALERT"); ?>"></div>
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
                
                
                
        <!-- 
        ====================================
        === add terms and condition check ==
        ====================================
        -->
        <div class="booking_font_bold"><label for="show_terms"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_TERMS_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_TERMS_SUBLABEL"); ?></div>
        
        <div class="booking_font_12">
        	<div class="booking_float_left"><input type="radio" name="show_terms" value="1" <?php if($bookingSettingObj->getShowTerms() == 1) { echo "checked"; }?> onclick="javascript:showTermsFields(1);"/></div>
            <div class="booking_float_left booking_margin_l_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_TERMS_YES"); ?></div>
            <div class="booking_float_left booking_margin_l_10"><input type="radio" name="show_terms" value="0" <?php if($bookingSettingObj->getShowTerms() == 0) { echo "checked"; }?> onclick="javascript:showTermsFields(0);"/></div>
            <div class="booking_float_left booking_margin_l_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_TERMS_NO"); ?></div>
            <div class="booking_cleardiv"></div>
            <div id="terms_fields" class="booking_margin_t_20" style="display:none !important">
            	<div><?php echo $bookingLangObj->getLabel("CONFIGURATION_TERMS_LABEL_LABEL"); ?></div>
                <div class="booking_margin_t_10"><input type="text" class="booking_width_fluid" name="terms_label" id="terms_label" value="<?php echo $bookingSettingObj->getTermsLabel(); ?>"/></div>
                
                <div class="booking_margin_t_20"><?php echo $bookingLangObj->getLabel("CONFIGURATION_TERMS_LINK_LABEL"); ?></div>
                <div class="booking_margin_t_10"><input type="text" class="booking_width_fluid" name="terms_link" id="terms_link" value="<?php echo $bookingSettingObj->getTermsLink(); ?>"/></div>
                <div class="booking_cleardiv"></div>
            </div>
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
        
        
        <!-- 
        =======================
        === slots selection ==
        =======================
        -->
        <div class="booking_font_bold"><label for="slot_selection"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOT_SELECTION_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOT_SELECTION_SUBLABEL"); ?></div>
        
        <div class="booking_margin_t_10 booking_font_12">
            <select name="slot_selection" id="slot_selection">
                <option value="0" <?php if($bookingSettingObj->getSlotSelection()=="0") { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOT_SELECTION_MULTIPLE"); ?></option>
                <option value="1" <?php if($bookingSettingObj->getSlotSelection()=="1") { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOT_SELECTION_ONE"); ?></option>
                
            </select>
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
        
        
        
        
        
        <!-- 
        =======================
        === slots unlimited ==
        =======================
        -->
        <div class="booking_font_bold"><label for="slots_unlimited"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_UNLIMITED_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_UNLIMITED_SUBLABEL"); ?></div>
        
        
        <div class="booking_margin_t_10 booking_font_12">
            <select name="slots_unlimited" id="slots_unlimited" onchange="javascript:showCustomOptions(this.options[this.selectedIndex].value);">
                <option value="0" <?php if($bookingSettingObj->getSlotsUnlimited()=="0") { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_UNLIMITED_ONE"); ?></option>
    <option value="2" <?php if($bookingSettingObj->getSlotsUnlimited()=="2") { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_UNLIMITED_CUSTOM"); ?></option>
                <option value="1" <?php if($bookingSettingObj->getSlotsUnlimited()=="1") { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_UNLIMITED_UNLIMITED"); ?></option>
                
            </select>
	<div id="custom_options" class="redirect_text" style="display:none">
                    	<div class="booking_float_left booking_width_400 booking_height_30 booking_line_30 booking_margin_t_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_SLOTS_SEATS_LABEL"); ?>:</div>
                        <div class="booking_float_left booking_margin_t_10"><input type="radio" name="show_slots_seats" value="1" <?php if($bookingSettingObj->getShowSlotsSeats() == 1) { echo "checked"; }?> />&nbsp;<?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_SLOTS_SEATS_YES"); ?>&nbsp;<input type="radio" name="show_slots_seats" value="0" <?php if($bookingSettingObj->getShowSlotsSeats() == 0) { echo "checked"; }?>/>&nbsp;<?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_SLOTS_SEATS_NO"); ?></div>
                        
                        <div class="booking_cleardiv"></div>
                    </div>
        </div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
        
        
        
                
        <!-- 
        ========================
        === show booked slots ==
        ========================
        -->
        <div class="booking_font_bold"><label for="show_booked_slots"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_BOOKED_SLOTS_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_BOOKED_SLOTS_SUBLABEL"); ?></div>
        
        <div class="booking_float_left booking_margin_t_10"><input type="radio" name="show_booked_slots" value="1" <?php if($bookingSettingObj->getShowBookedSlots() == 1) { echo "checked"; }?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_BOOKED_SLOTS_YES"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10"><input type="radio" name="show_booked_slots" value="0" <?php if($bookingSettingObj->getShowBookedSlots() == 0) { echo "checked"; }?>/></div>
        <div class="booking_float_left booking_margin_t_10  booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_BOOKED_SLOTS_NO"); ?></div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
         
         
         
                
        <!-- 
        =======================
        === slots popup ==
        =======================
        -->
        <div class="booking_font_bold"><label for="slots_popup_enabled"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_POPUP_ENABLED_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_POPUP_ENABLED_SUBLABEL"); ?></div>
       
        <div class="booking_float_left booking_margin_t_10"><input type="radio" name="slots_popup_enabled" id="slots_popup_enabled" value="1" <?php if($bookingSettingObj->getSlotsPopupEnabled() == 1) { echo "checked"; } ?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_POPUP_ENABLED_ENABLED"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10"><input type="radio" name="slots_popup_enabled" id="slots_popup_enabled" value="0" <?php if($bookingSettingObj->getSlotsPopupEnabled() == 0) { echo "checked"; } ?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SLOTS_POPUP_ENABLED_DISABLED"); ?></div>
        <div class="booking_cleardiv"></div>
        
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        <!-- 
        ==============================
        === show category selection ==
        ==============================
        -->
        <div class="booking_font_bold"><label for="show_category_selection"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_CATEGORY_SELECTION_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_CATEGORY_SELECTION_SUBLABEL"); ?></div>
        
        <div class="booking_float_left booking_margin_t_10"><input type="radio" name="show_category_selection" value="1" <?php if($bookingSettingObj->getShowCategorySelection() == 1) { echo "checked"; }?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_CATEGORY_SELECTION_YES"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10"><input type="radio" name="show_category_selection" value="0" <?php if($bookingSettingObj->getShowCategorySelection() == 0) { echo "checked"; }?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_CATEGORY_SELECTION_NO"); ?></div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
        <!-- 
        ==============================
        === show calendar selection ==
        ==============================
        -->
        <div class="booking_font_bold"><label for="show_calendar_selection"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_CALENDAR_SELECTION_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_CALENDAR_SELECTION_SUBLABEL"); ?></div>
        
        <div class="booking_float_left booking_margin_t_10"><input type="radio" name="show_calendar_selection" value="1" <?php if($bookingSettingObj->getShowCalendarSelection() == 1) { echo "checked"; }?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_CALENDAR_SELECTION_YES"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10"><input type="radio" name="show_calendar_selection" value="0" <?php if($bookingSettingObj->getShowCalendarSelection() == 0) { echo "checked"; }?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_CALENDAR_SELECTION_NO"); ?></div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
                
 		<!-- 
        ===========================
        === Calendar first month ==
        ===========================
        -->
        <div class="booking_font_bold"><label for="show_first_filled_month"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_FIRST_FILLED_MONTH_LABEL"); ?></label></div>
         <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_FIRST_FILLED_MONTH_SUBLABEL"); ?></div>
        
        <div class="booking_float_left booking_margin_t_10"><input type="radio" name="show_first_filled_month" value="1" <?php if($bookingSettingObj->getShowFirstFilledMonth() == 1) { echo "checked"; }?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_FIRST_FILLED_MONTH_YES"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10"><input type="radio" name="show_first_filled_month" value="0" <?php if($bookingSettingObj->getShowFirstFilledMonth() == 0) { echo "checked"; }?>/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_SHOW_FIRST_FILLED_MONTH_NO"); ?></div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>              
        <!-- 
        ===========================
        === Calendar month limit ==
        ===========================
        -->
        <div class="booking_font_bold"><label for="calendar_month_limit"><?php echo $bookingLangObj->getLabel("CONFIGURATION_CALENDAR_MONTH_LIMIT_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_CALENDAR_MONTH_LIMIT_SUBLABEL"); ?></div>
        
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_100"><?php echo $bookingLangObj->getLabel("CONFIGURATION_CALENDAR_MONTH_LIMIT_PAST"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_100"><input type="text" class="booking_width_60" id="calendar_month_limit_past" name="calendar_month_limit_past" value="<?php echo $bookingSettingObj->getCalendarMonthLimitPast(); ?>"></div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_width_100"><?php echo $bookingLangObj->getLabel("CONFIGURATION_CALENDAR_MONTH_LIMIT_FUTURE"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12 booking_width_100"><input type="text" class="booking_width_60" id="calendar_month_limit_future" name="calendar_month_limit_future" value="<?php echo $bookingSettingObj->getCalendarMonthLimitFuture(); ?>"></div>
        <div class="booking_cleardiv"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
           
           
           
                
        <!-- 
        ================
        === book from and to ==
        ================
        -->
        <div class="booking_font_bold"><label for="book_from"><?php echo $bookingLangObj->getLabel("CONFIGURATION_BOOK_FROM_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_BOOK_FROM_SUBLABEL"); ?></div>
        
        <div class="booking_margin_t_10"><input type="text" class="long_input_box" id="book_from" name="book_from" value="<?php echo $bookingSettingObj->getBookFrom(); ?>"></div>
        
        <div class="booking_font_12 booking_margin_t_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_BOOK_TO_SUBLABEL"); ?></div>
        
        <div class="booking_margin_t_10"><input type="text" class="long_input_box" id="book_to" name="book_to" value="<?php echo $bookingSettingObj->getBookTo(); ?>"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        <!-- 
        ===========================
        === Show price ==
        ===========================
        -->
        
        <div class="booking_font_bold"><label for="paypal_display_price"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_DISPLAY_PRICE"); ?>:</label></div>
      
        <div class="booking_float_left booking_margin_t_10"><input type="radio" name="paypal_display_price" value="1" <?php if($bookingSettingObj->getPaypalDisplayPrice() == 1) { echo "checked"; }?> /></div>
		<div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_YES"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10"><input type="radio" name="paypal_display_price" value="0" <?php if($bookingSettingObj->getPaypalDisplayPrice() == 0) { echo "checked"; }?>/></div>
		<div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_NO"); ?></div>
        <div class="booking_cleardiv"></div>
        <div class="booking_float_left booking_margin_t_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_CURRENCY"); ?>:</div>
       <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_margin_l_10">
             <select name="paypal_currency">
                <option value=""><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_CURRENCY_CHOOSE"); ?></option>
                <?php
                $arrayCurrencies = $bookingListObj->getPaypalCurrencyList();
                foreach($arrayCurrencies as $currencyId => $currency) {
                    ?>
                    <option value="<?php echo $currency["currency_code"]; ?>" <?php if($bookingSettingObj->getPaypalCurrency() == $currency["currency_code"]) { echo "selected"; }?>><?php echo $currency["currency_name"]; ?></option>
                    <?php
                }
                ?>
            </select> 
        </div>
        <div class="booking_cleardiv"></div>
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
        <!-- 
        =============
        === paypal ==
        =============
        -->
        <div class="booking_font_bold"><label for="show_terms"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_SUBLABEL1"); ?><br /><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_SUBLABEL2"); ?> (<a href="http://www.paypalobjects.com/en_US/ebook/PP_OrderManagement_IntegrationGuide/ipn.html#1071087" target="_blank">Instant Payment Notification</a>) <?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_SUBLABEL3"); ?></div>
        
        
        <div class="booking_float_left booking_margin_t_10 booking_font_12"><input type="radio" name="paypal" value="1" <?php if($bookingSettingObj->getPaypal() == 1) { echo "checked"; }?> onclick="javascript:showPaypalFields(1);"/></div>
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_margin_l_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_YES"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_margin_l_10"><input type="radio" name="paypal" value="0" <?php if($bookingSettingObj->getPaypal() == 0) { echo "checked"; }?> onclick="javascript:showPaypalFields(0);"/></div>
        <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_margin_l_10"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_NO"); ?></div>
        <div class="booking_cleardiv"></div>
        
        <div id="paypal_fields" class="redirect_text" style="display:none !important">
        	<div class="booking_float_left booking_margin_t_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_ACCOUNT"); ?></div>
            <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_margin_l_10"><input type="text" class="short_input_box" name="paypal_account" id="paypal_account" value="<?php echo $bookingSettingObj->getPaypalAccount(); ?>"/></div>
            <div class="booking_cleardiv"></div>
            
            <div class="booking_float_left booking_margin_t_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_LOCALE"); ?>:</div>
            <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_margin_l_10">
            	<select name="paypal_locale">
                    <option value=""><?php echo $bookingLangObj->getLabel("CONFIGURATION_PAYPAL_LOCALE_CHOOSE"); ?></option>
                    <?php
                    $arrayLocales = $bookingListObj->getPaypalLocaleList();
                    foreach($arrayLocales as $localeId => $locale) {
                        ?>
                        <option value="<?php echo $locale["locale_code"]; ?>" <?php if($bookingSettingObj->getPaypalLocale() == $locale["locale_code"]) { echo "selected"; }?>><?php echo $locale["locale_country"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
           </div>
           <div class="booking_cleardiv"></div>
           
            
        </div>
        
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
         
        
        
        
        
        <!-- 
        ================
        === form text ==
        ================
        -->
        <div class="booking_font_bold"><label for="form_text"><?php echo $bookingLangObj->getLabel("CONFIGURATION_FORM_TEXT_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_FORM_TEXT_SUBLABEL"); ?></div>
        
        <div class=""><input type="text" class="long_input_box" id="form_text" name="form_text" value="<?php echo $bookingSettingObj->getFormText(); ?>"></div>
        
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
        
        <!-- 
        ========================
        === wordpress users ==
        ========================
        -->
        <div class="booking_font_bold"><label for="wordpress_registration"><?php echo $bookingLangObj->getLabel("CONFIGURATION_WORDPRESS_REGISTRATION_LABEL"); ?></label></div>
        <div class="booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_WORDPRESS_REGISTRATION_SUBLABEL"); ?></div>
        
        <div class="booking_float_left booking_margin_t_10"><input type="radio" name="wordpress_registration" value="1" <?php if($bookingSettingObj->getWordpressRegistration() == 1) { echo "checked"; }?> onclick="javascript:showRegistrationField(1);"/></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_WORDPRESS_REGISTRATION_YES"); ?></div>
        <div class="booking_float_left booking_margin_t_10 booking_margin_l_10"><input type="radio" name="wordpress_registration" value="0" <?php if($bookingSettingObj->getWordpressRegistration() == 0) { echo "checked"; }?> onclick="javascript:showRegistrationField(0);"/></div>
        <div class="booking_float_left booking_margin_t_10  booking_margin_l_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_WORDPRESS_REGISTRATION_NO"); ?></div>
        <div class="booking_cleardiv"></div>
        
        <div id="registration_fields" class="redirect_text" style="display:none !important">
        	
            <div class="booking_float_left booking_margin_t_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_USERS_ROLE_LABEL"); ?>:</div>
            <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_margin_l_10">
            	<select name="users_role">
                    <?php
					global $wp_roles;
     				$roles = $wp_roles->get_names();
                    foreach($roles as $role) {
   						if(strtolower($role) != 'administrator') {
							?>
							<option value="<?php echo strtolower($role);?>" <?php if(strtolower($bookingSettingObj->getUsersRole()) == strtolower($role)) { echo "selected"; }?>><?php echo $role;?></option>
							<?php
						}
                    }
                    ?>
                </select>
           </div>
           <div class="booking_cleardiv"></div>
           
           <div class="booking_float_left booking_margin_t_10 booking_font_12"><?php echo $bookingLangObj->getLabel("CONFIGURATION_REGISTRATION_TEXT_LABEL"); ?>:</div>
            <div class="booking_float_left booking_margin_t_10 booking_font_12 booking_margin_l_10">
            	<input type="text" class="long_input_box" id="registration_text" name="registration_text" value="<?php echo $bookingSettingObj->getRegistrationText(); ?>">
           </div>
           <div class="booking_cleardiv"></div>
           
           
            
            
                
            
        </div>
        <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
        
         <!-- 
        =======================
        === control buttons ==
        =======================
        -->
        <div class="booking_bg_333 booking_padding_10">
            <!-- cancel -->
            <div class="booking_float_left"><a href="javascript:document.location.href='?page=wp-booking-calendar-welcome';" class="booking_bg_ccc booking_admin_button booking_grey_button booking_mark_fff"><?php echo $bookingLangObj->getLabel("CONFIGURATION_CANCEL"); ?></a></div>
            <div class="booking_float_left booking_margin_l_20"><input type="submit" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("CONFIGURATION_SAVE");?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
            <div class="booking_cleardiv"></div>
            
        </div>
            
        </form>
         
        

</div>
