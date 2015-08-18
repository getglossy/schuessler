<?php

class wp_booking_calendar_setting {
	
	private function doSettingQuery($setting) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$settingQry = $wpdb->get_var($wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name=%s",$setting));
		
		return $settingQry;
		
	}
	
	public function getReservationConfirmationMode() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('reservation_confirmation_mode');
	}
	
	public function getTimezone() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('timezone');
	}
	
	public function getEmailReservation() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('email_reservation');
	}
	
	public function getEmailFromReservation() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('email_from_reservation');
	}
	
	public function getNameFromReservation() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('name_from_reservation');
	}
	
	public function getRecaptchaPublicKey() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('recaptcha_public_key');
	}
	
	public function getRecaptchaPrivateKey() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('recaptcha_private_key');
	}
	
	public function getMandatoryFields() {
		global $wpdb;
		global $blog_id;
		$list=wp_booking_calendar_setting::doSettingQuery('mandatory_fields');
		$arrFields = Array();
		$arrFields = explode(",",$list);
		return $arrFields;
	}
	
	public function getVisibleFields() {
		global $wpdb;
		global $blog_id;
		$list=wp_booking_calendar_setting::doSettingQuery('visible_fields');
		$arrFields = Array();
		$arrFields = explode(",",$list);
		return $arrFields;
	}
	
	public function getRedirect() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('redirect_confirmation_path');
	}
	
	public function getRecaptchaEnabled() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('recaptcha_enabled');
	}
	
	public function getSlotsPopupEnabled() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('slots_popup_enabled');
	}
	
	public function getSlotsUnlimited() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('slots_unlimited');
	}
	
	public function getReservationCancel() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('reservation_cancel');
	}
	
	public function getCancelRedirect() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('redirect_cancel_path');
	}

	public function getRedirectBookingPath() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('redirect_booking_path');
	}
	
	public function getSlotSelection() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('slot_selection');
	}
	
	public function getDateFormat() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('date_format');
	}
	
	public function getTimeFormat() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('time_format');
	}
	
	public function getShowBookedSlots() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('show_booked_slots');
	}
	
	public function getShowCategorySelection() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('show_category_selection');
	}
	
	public function getShowCalendarSelection() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('show_calendar_selection');
	}
	public function getShowFirstFilledMonth() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('show_first_filled_month');
	}	
	
	public function getShowSlotsSeats() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('show_slots_seats');
	}
	
	public function getCalendarMonthLimitPast() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('calendar_month_limit_past');
	}
	
	public function getCalendarMonthLimitFuture() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('calendar_month_limit_future');
	}
	
	public function getShowTerms() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('show_terms');
	}
	
	public function getTermsLabel() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('terms_label');
	}
	
	public function getTermsLink() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('terms_link');
	}
	
	public function getBookFrom() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('book_from');
	}
	
	public function getBookTo() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('book_to');
	}
	
	public function getPaypal() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('paypal');
	}
	
	public function getPaypalAccount() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('paypal_account');
	}
	
	public function getPaypalPrice() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('paypal_price');
	}
	
	public function getPaypalCurrency() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('paypal_currency');
	}
	
	public function getPaypalLocale() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('paypal_locale');
	}
	
	public function getPaypalDisplayPrice() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('paypal_display_price');
	}
	
	public function getFormText() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('form_text');
	}
	
	public function getReservationFieldType($field) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$type="text";
		$typeQry = $wpdb->prepare("SELECT reservation_field_type FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name=%s",$field);
		$numrows = $wpdb->query($typeQry);
		if($numrows>0) {
			$type = $wpdb->get_var($typeQry);
		}
		/*$typeQry=mysql_query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name='".$field."'");
		if(mysql_num_rows($typeQry)>0) {
			$type=mysql_result($typeQry,'0','reservation_field_type');
		}*/
		return $type;
	}
	
	public function getWordpressRegistration() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('wordpress_registration');
	}
	
	public function getUsersRole() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('users_role');
	}
	
	public function getRegistrationText() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_setting::doSettingQuery('registration_text');
	}
	
	public function updateSettings() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='reservation_confirmation_mode'",$_POST["reservation_confirmation_mode"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='timezone'",$_POST["timezone"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='email_reservation'",$_POST["email_reservation"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='email_from_reservation'",$_POST["email_from_reservation"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='name_from_reservation'",$_POST["name_from_reservation"]));
		
		if(isset($_POST["recaptcha_enabled"]) && $_POST["recaptcha_enabled"] == "1") {
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
						 SET config_value=%s
						 WHERE config_name='recaptcha_enabled'",$_POST["recaptcha_enabled"]));
		} else {
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
						 SET config_value=%s
						 WHERE config_name='recaptcha_enabled'",0));
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='recaptcha_public_key'",$_POST["recaptcha_public_key"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='recaptcha_private_key'",$_POST["recaptcha_private_key"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='slots_popup_enabled'",$_POST["slots_popup_enabled"]));
		
		
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='redirect_confirmation_path'",$_POST["redirect_confirmation_path"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='redirect_booking_path'",$_POST["redirect_booking_path"]));
		
		if(isset($_POST["reservation_cancel"]) && $_POST["reservation_cancel"] == "1") {
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
						 SET config_value=%s
						 WHERE config_name='reservation_cancel'",$_POST["reservation_cancel"]));
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
						 SET config_value=%s
						 WHERE config_name='redirect_cancel_path'",$_POST["redirect_cancel_path"]));
			
		} else {
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
						 SET config_value=%s
						 WHERE config_name='reservation_cancel'",0));
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
						 SET config_value=%s
						 WHERE config_name='redirect_cancel_path'",''));
			
		}
		
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='slot_selection'",$_POST["slot_selection"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='date_format'",$_POST["date_format"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='time_format'",$_POST["time_format"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='slots_unlimited'",$_POST["slots_unlimited"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='show_booked_slots'",$_POST["show_booked_slots"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='show_category_selection'",$_POST["show_category_selection"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='show_calendar_selection'",$_POST["show_calendar_selection"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='calendar_month_limit_past'",$_POST["calendar_month_limit_past"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='calendar_month_limit_future'",$_POST["calendar_month_limit_future"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='show_terms'",$_POST["show_terms"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='terms_label'",$_POST["terms_label"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='terms_link'",$_POST["terms_link"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='book_from'",$_POST["book_from"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='book_to'",$_POST["book_to"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='paypal'",$_POST["paypal"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='paypal_account'",$_POST["paypal_account"]));
		
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='paypal_currency'",$_POST["paypal_currency"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='paypal_locale'",$_POST["paypal_locale"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='paypal_display_price'",$_POST["paypal_display_price"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='form_text'",$_POST["form_text"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='show_first_filled_month'",$_POST["show_first_filled_month"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='show_slots_seats'",$_POST["show_slots_seats"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='wordpress_registration'",$_POST["wordpress_registration"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='users_role'",$_POST["users_role"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='registration_text'",$_POST["registration_text"]));
	}
	
	
	public function updateFormSettings() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		if(isset($_POST["mandatory_fields"])) {
			$stringMandatory = "";
			for($i=0;$i<count($_POST["mandatory_fields"]);$i++) {
				if($stringMandatory == "") {
					$stringMandatory.=$_POST["mandatory_fields"][$i];
				} else {
					$stringMandatory.=",".$_POST["mandatory_fields"][$i];
				}
			}
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='mandatory_fields'",$stringMandatory));
		}
		
		if(isset($_POST["visible_fields"])) {
			$stringVisible = "";
			for($i=0;$i<count($_POST["visible_fields"]);$i++) {
				if($stringVisible == "") {
					$stringVisible.=$_POST["visible_fields"][$i];
				} else {
					$stringVisible.=",".$_POST["visible_fields"][$i];
				}
			}
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='visible_fields'",$stringVisible));
		}
		
		//update fields type
		$arrayFields = $_POST["reservation_field_name"];
		$arrayTypes = $_POST["field_type"];
		for($i=0;$i<count($arrayFields);$i++) {
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_fields_types SET reservation_field_type=%s WHERE reservation_field_name=%s",$arrayTypes[$i],$arrayFields[$i]));
		}
	}
	/****styles section****/
	
	public function getMonthContainerBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('month_container_bg'));
	}
	
	public function getMonthNameColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('month_name_color'));
	}
	
	public function getYearNameColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('year_name_color'));
	}
	
	public function getDayNamesColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_names_color'));
	}
		
	public function getDayGreyBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_grey_bg'));
	}
	
	public function getDayWhiteBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_bg'));
	}
	
	public function getDayWhiteBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_bg_hover'));
	}
	
	public function getDayBlackBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_black_bg'));
	}
	
	public function getDayBlackBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_black_bg_hover'));
	}
	
	public function getDayWhiteLine1DisabledColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_line1_disabled_color'));
	}
	
	public function getDayBlackLine1Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_black_line1_color'));
	}
	
	public function getDayBlackLine1ColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_black_line1_color_hover'));
	}
	
	public function getDayBlackLine2Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_black_line2_color'));
	}
	
	public function getDayWhiteLine2DisabledColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_line2_disabled_color'));
	}
	
	public function getDayBlackLine2ColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_black_line2_color_hover'));
	}
	
	public function getDayWhiteLine1Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_line1_color'));
	}
	
	public function getDayWhiteLine1ColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_line1_color_hover'));
	}
	
	public function getDayWhiteLine2Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_line2_color'));
	}
	
	public function getDayWhiteLine2ColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_line2_color_hover'));
	}
	
	public function getFormBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('form_bg'));
	}
	
	public function getFormColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('form_color'));
	}
	public function getFieldInputBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('field_input_bg'));
	}
	
	public function getFieldInputColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('field_input_color'));
	}
	
	public function getRecaptchaStyle() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('recaptcha_style'));
	}
	
	public function getDayRedBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_red_bg'));
	}
	
	public function getDayRedLine1Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_red_line1_color'));
	}
	
	public function getDayRedLine2Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_red_line2_color'));
	}
	
	public function getDayWhiteBgDisabled() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('day_white_bg_disabled'));
	}

	public function getMonthNavigationButtonBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('month_navigation_button_bg'));
	}
	
	public function getMonthNavigationButtonBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('month_navigation_button_bg_hover'));
	}
	
	public function getBookNowButtonBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('book_now_button_bg'));
	}
	
	public function getBookNowButtonBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('book_now_button_bg_hover'));
	}
	
	public function getBookNowButtonColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('book_now_button_color'));
	}
	
	public function getBookNowButtonColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('book_now_button_color_hover'));
	}
	
	public function getClearButtonBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('clear_button_bg'));
	}
	
	public function getClearButtonBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('clear_button_bg_hover'));
	}
	
	public function getClearButtonColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('clear_button_color'));
	}
	
	public function getClearButtonColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('clear_button_color_hover'));
	}
	
	public function getFormCalendarNameColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_setting::doSettingQuery('form_calendar_name_color'));
	}
	
	
	
	public function updateStyles() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='month_container_bg'",$_POST["month_container_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='month_name_color'",$_POST["month_name_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='year_name_color'",$_POST["year_name_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_names_color'",$_POST["day_names_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_grey_bg'",$_POST["day_grey_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_bg'",$_POST["day_white_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_bg_hover'",$_POST["day_white_bg_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_black_bg'",$_POST["day_black_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_black_bg_hover'",$_POST["day_black_bg_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_line1_disabled_color'",$_POST["day_white_line1_disabled_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_black_line1_color'",$_POST["day_black_line1_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_black_line1_color_hover'",$_POST["day_black_line1_color_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_black_line2_color'",$_POST["day_black_line2_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_line2_disabled_color'",$_POST["day_white_line2_disabled_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_black_line2_color_hover'",$_POST["day_black_line2_color_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_line1_color'",$_POST["day_white_line1_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_line1_color_hover'",$_POST["day_white_line1_color_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_line2_color'",$_POST["day_white_line2_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_line2_color_hover'",$_POST["day_white_line2_color_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='form_bg'",$_POST["form_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='form_color'",$_POST["form_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='field_input_bg'",$_POST["field_input_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='field_input_color'",$_POST["field_input_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='recaptcha_style'",$_POST["recaptcha_style"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_red_bg'",$_POST["day_red_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_red_line1_color'",$_POST["day_red_line1_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_red_line2_color'",$_POST["day_red_line2_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='day_white_bg_disabled'",$_POST["day_white_bg_disabled"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='month_navigation_button_bg'",$_POST["month_navigation_button_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='month_navigation_button_bg_hover'",$_POST["month_navigation_button_bg_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='book_now_button_bg'",$_POST["book_now_button_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='book_now_button_bg_hover'",$_POST["book_now_button_bg_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='book_now_button_color'",$_POST["book_now_button_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='book_now_button_color_hover'",$_POST["book_now_button_color_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='clear_button_bg'",$_POST["clear_button_bg"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='clear_button_bg_hover'",$_POST["clear_button_bg_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='clear_button_color'",$_POST["clear_button_color"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='clear_button_color_hover'",$_POST["clear_button_color_hover"]));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_config
					 SET config_value=%s
					 WHERE config_name='form_calendar_name_color'",$_POST["form_calendar_name_color"]));
	}
	

}

?>
