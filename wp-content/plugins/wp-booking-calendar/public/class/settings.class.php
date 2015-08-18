<?php

class wp_booking_calendar_public_setting {
	
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
		return wp_booking_calendar_public_setting::doSettingQuery('reservation_confirmation_mode');
	}
	
	public function getTimezone() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('timezone');
	}
	
	public function getEmailReservation() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('email_reservation');
	}
	
	public function getEmailFromReservation() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('email_from_reservation');
	}
	
	public function getNameFromReservation() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('name_from_reservation');
	}

	public function getRedirectBookingPath() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('redirect_booking_path');
	}
	
	public function getRecaptchaPublicKey() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('recaptcha_public_key');
	}
	
	public function getRecaptchaPrivateKey() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('recaptcha_private_key');
	}
	
	public function getMandatoryFields() {
		global $wpdb;
		global $blog_id;
		$list=wp_booking_calendar_public_setting::doSettingQuery('mandatory_fields');
		$arrFields = Array();
		$arrFields = explode(",",$list);
		return $arrFields;
	}
	
	public function getVisibleFields() {
		global $wpdb;
		global $blog_id;
		$list=wp_booking_calendar_public_setting::doSettingQuery('visible_fields');
		$arrFields = Array();
		$arrFields = explode(",",$list);
		return $arrFields;
	}
	
	public function getRedirect() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('redirect_confirmation_path');
	}
	
	public function getRecaptchaEnabled() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('recaptcha_enabled');
	}
	
	public function getSlotsPopupEnabled() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('slots_popup_enabled');
	}
	
	public function getSlotsUnlimited() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('slots_unlimited');
	}
	
	public function getReservationCancel() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('reservation_cancel');
	}
	
	public function getCancelRedirect() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('redirect_cancel_path');
	}
	
	public function getSlotSelection() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('slot_selection');
	}
	
	public function getDateFormat() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('date_format');
	}
	
	public function getTimeFormat() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('time_format');
	}
	
	public function getShowBookedSlots() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('show_booked_slots');
	}

	public function getShowSlotsSeats() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('show_slots_seats');
	}	
	
	public function getShowFirstFilledMonth() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('show_first_filled_month');
	}
	
	public function getShowCategorySelection() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('show_category_selection');
	}
	
	public function getShowCalendarSelection() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('show_calendar_selection');
	}
	
	public function getCalendarMonthLimitPast() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('calendar_month_limit_past');
	}
	
	public function getCalendarMonthLimitFuture() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('calendar_month_limit_future');
	}
	
	public function getShowTerms() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('show_terms');
	}
	
	public function getTermsLabel() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('terms_label');
	}
	
	public function getTermsLink() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('terms_link');
	}
	
	public function getBookFrom() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('book_from');
	}
	
	public function getBookTo() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('book_to');
	}
	
	public function getPaypal() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('paypal');
	}
	
	public function getPaypalAccount() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('paypal_account');
	}
	
	public function getPaypalPrice() {
		global $wpdb;
		global $blog_id;
		return str_replace(",",".",wp_booking_calendar_public_setting::doSettingQuery('paypal_price'));
	}
	
	public function getPaypalCurrency() {
		global $wpdb;
		global $blog_id;
		return strtoupper(wp_booking_calendar_public_setting::doSettingQuery('paypal_currency'));
	}
	
	public function getPaypalLocale() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('paypal_locale');
	}
	
	public function getPaypalDisplayPrice() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('paypal_display_price');
	}
	
	public function getFormText() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('form_text');
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
		
		if($wpdb->query($typeQry)>0) {
			$type=$wpdb->get_var($typeQry);
		}
		return $type;
	}
	
	/****styles section****/
	
	public function getMonthContainerBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('month_container_bg'));
	}
	
	public function getMonthNameColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('month_name_color'));
	}
	
	public function getYearNameColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('year_name_color'));
	}
	
	public function getDayNamesColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_names_color'));
	}
		
	public function getDayGreyBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_grey_bg'));
	}
	
	public function getDayWhiteBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_bg'));
	}
	
	public function getDayWhiteBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_bg_hover'));
	}
	
	public function getDayBlackBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_black_bg'));
	}
	
	public function getDayBlackBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_black_bg_hover'));
	}
	
	public function getDayWhiteLine1DisabledColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_line1_disabled_color'));
	}
	
	public function getDayBlackLine1Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_black_line1_color'));
	}
	
	public function getDayBlackLine1ColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_black_line1_color_hover'));
	}
	
	public function getDayBlackLine2Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_black_line2_color'));
	}
	
	public function getDayWhiteLine2DisabledColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_line2_disabled_color'));
	}
	
	public function getDayBlackLine2ColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_black_line2_color_hover'));
	}
	
	public function getDayWhiteLine1Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_line1_color'));
	}
	
	public function getDayWhiteLine1ColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_line1_color_hover'));
	}
	
	public function getDayWhiteLine2Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_line2_color'));
	}
	
	public function getDayWhiteLine2ColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_line2_color_hover'));
	}
	
	public function getFormBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('form_bg'));
	}
	
	public function getFormColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('form_color'));
	}
	
	public function getFieldInputBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('field_input_bg'));
	}
	
	public function getFieldInputColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('field_input_color'));
	}
	
	public function getRecaptchaStyle() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('recaptcha_style'));
	}
	
	public function getDayRedBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_red_bg'));
	}
	
	public function getDayRedLine1Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_red_line1_color'));
	}
	
	public function getDayRedLine2Color() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_red_line2_color'));
	}
	
	public function getDayWhiteBgDisabled() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('day_white_bg_disabled'));
	}
	
	public function getMonthNavigationButtonBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('month_navigation_button_bg'));
	}
	
	public function getMonthNavigationButtonBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('month_navigation_button_bg_hover'));
	}
	
	public function getBookNowButtonBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('book_now_button_bg'));
	}
	
	public function getBookNowButtonBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('book_now_button_bg_hover'));
	}
	
	public function getBookNowButtonColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('book_now_button_color'));
	}
	
	public function getBookNowButtonColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('book_now_button_color_hover'));
	}
	
	public function getClearButtonBg() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('clear_button_bg'));
	}
	
	public function getClearButtonBgHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('clear_button_bg_hover'));
	}
	
	public function getClearButtonColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('clear_button_color'));
	}
	
	public function getClearButtonColorHover() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('clear_button_color_hover'));
	}
	
	public function getFormCalendarNameColor() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_setting::doSettingQuery('form_calendar_name_color'));
	}
	
	public function getWordpressRegistration() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('wordpress_registration');
	}
	
	public function getUsersRole() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('users_role');
	}
	
	public function getRegistrationText() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_setting::doSettingQuery('registration_text');
	}

}

?>
