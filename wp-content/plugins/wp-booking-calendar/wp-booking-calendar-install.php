<?php
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
define('BOOKING_CALENDAR_PLUGIN_PATH', WP_PLUGIN_DIR . '/wp-booking-calendar/');

function booking_calendar_install_db($blog_prefix = '') {
	global $wpdb;
	$sql2="CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_categories (
	category_id int(11) NOT NULL AUTO_INCREMENT ,
	category_name varchar(255) NOT NULL ,
	category_order int(11) NOT NULL ,
	category_active int(11) NOT NULL ,
	PRIMARY KEY  (category_id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	";
	dbDelta($sql2);
	
	$sql3="CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_calendars (
	  calendar_id int(11) NOT NULL AUTO_INCREMENT,
	  category_id int(11) NOT NULL,
	  calendar_title varchar(255) NOT NULL,
	  calendar_email varchar(700) NOT NULL,
	  calendar_order int(11) NOT NULL,
	  calendar_active int(11) NOT NULL,
	  PRIMARY KEY  (calendar_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
	";
	dbDelta($sql3);
	$sql4="
	CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_config (
	  config_id int(11) NOT NULL AUTO_INCREMENT,
	  config_name varchar(255) NOT NULL,
	  config_value varchar(255) NOT NULL,
	  PRIMARY KEY  (config_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8  ;
	";
	dbDelta($sql4);
	$sql5="
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'reservation_confirmation_mode', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'reservation_confirmation_mode'
	) LIMIT 1;
	
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'timezone', 'Europe/Belgrade') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'timezone'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'redirect_confirmation_path', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'redirect_confirmation_path'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'redirect_booking_path', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'redirect_booking_path'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'email_reservation', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'email_reservation'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'recaptcha_public_key', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'recaptcha_public_key'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'recaptcha_private_key', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'recaptcha_private_key'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'mandatory_fields', 'reservation_name,reservation_surname,reservation_email,reservation_phone,reservation_message') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'mandatory_fields'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'email_from_reservation', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'email_from_reservation'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'name_from_reservation', 'Booking Calendar') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'name_from_reservation'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'recaptcha_enabled', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'recaptcha_enabled'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'slots_popup_enabled', '1') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'slots_popup_enabled'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'reservation_cancel', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'reservation_cancel'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'redirect_cancel_path', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'redirect_cancel_path'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'slot_selection', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'slot_selection'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'date_format', 'UK') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'date_format'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'date_format', 'UK') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'date_format'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'time_format', '24') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'time_format'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'slots_unlimited', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'slots_unlimited'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'calendar_month_limit_future', '-1') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'calendar_month_limit_future'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'show_booked_slots', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'show_booked_slots'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'show_calendar_selection', '1') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'show_calendar_selection'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'calendar_month_limit_past', '-1') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'calendar_month_limit_past'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'show_terms', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'show_terms'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'terms_label', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'terms_label'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'terms_link', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'terms_link'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'book_from', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'book_from'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'book_to', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'book_to'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'paypal', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'paypal'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'paypal_account', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'paypal_account'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'form_text', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'form_text'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'paypal_currency', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'paypal_currency'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'paypal_locale', '') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'paypal_locale'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'paypal_display_price', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'paypal_display_price'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'visible_fields', 'reservation_name,reservation_surname,reservation_email,reservation_phone,reservation_message') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'visible_fields'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_grey_bg', '#F6F6F6') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_grey_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_bg', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_bg_hover', '#567BD2') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_bg_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_black_bg', '#333333') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_black_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_black_bg_hover', '#567BD2') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_black_bg_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_line1_disabled_color', '#CCCCCC') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_line1_disabled_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_black_line1_color', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_black_line1_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_black_line1_color_hover', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_black_line1_color_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_black_line2_color', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_black_line2_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_line2_disabled_color', '#CCCCCC') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_line2_disabled_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_black_line2_color_hover', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_black_line2_color_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_line1_color', '#999999') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_line1_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_line1_color_hover', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_line1_color_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_line2_color', '#00CC33') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_line2_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_line2_color_hover', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_line2_color_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'form_bg', '#567BD2') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'form_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'form_color', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'form_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'recaptcha_style', 'white') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'recaptcha_style'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_red_bg', '#D74E4E') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_red_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_red_line1_color', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_red_line1_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_red_line2_color', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_red_line2_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_white_bg_disabled', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_white_bg_disabled'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'show_category_selection', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'show_category_selection'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'show_first_filled_month', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'show_first_filled_month'
	) LIMIT 1;
	
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'show_slots_seats', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'show_slots_seats'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'book_now_button_bg', '#333333') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'book_now_button_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'book_now_button_color', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'book_now_button_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'field_input_bg', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'field_input_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'field_input_color', '#000000') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'field_input_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'day_names_color', '#666666') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'day_names_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'month_name_color', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'month_name_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'year_name_color', '#999999') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'year_name_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'month_container_bg', '#333333') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'month_container_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'month_navigation_button_bg', '#333333') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'month_navigation_button_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'book_now_button_bg_hover', '#00CC66') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'book_now_button_bg_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'month_navigation_button_bg_hover', '#567BD2') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'month_navigation_button_bg_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'clear_button_bg', '#999999') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'clear_button_bg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'clear_button_bg_hover', '#333333') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'clear_button_bg_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'clear_button_color', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'clear_button_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'clear_button_color_hover', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'clear_button_color_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'book_now_button_color_hover', '#FFFFFF') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'book_now_button_color_hover'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'form_calendar_name_color', '#567BD2') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'form_calendar_name_color'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'wordpress_registration', '0') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'wordpress_registration'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'users_role', 'subscriber') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'users_role'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_config (config_name, config_value)
	SELECT * FROM (SELECT 'registration_text', 'To be able to book you have to be registered.') AS tmp
	WHERE NOT EXISTS (
		SELECT config_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = 'registration_text'
	) LIMIT 1;
	
	";
	
	
	dbDelta($sql5);
	
	$sql6="
	
	CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_emails (
	  email_id int(11) NOT NULL AUTO_INCREMENT,
	  email_name varchar(255) NOT NULL,
	  email_subject varchar(700) NOT NULL,
	  email_text text NOT NULL,
	  email_cancel_text text NOT NULL,
	  email_signature text NOT NULL,
	  PRIMARY KEY  (email_id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	dbDelta($sql6);
	if($wpdb->query("select * from ".$wpdb->base_prefix.$blog_prefix."booking_emails where email_id = 1")==0) {
		$wpdb->insert($wpdb->base_prefix.$blog_prefix."booking_emails",array('email_id'=>1,'email_name'=>'Email sent automatically to customer to confirm reservation','email_subject'=>'Confirmation of Booking','email_text'=>'<p>Hello [customer-name],</p><p>thanks for Booking,<br />your Reservation details:</p><p>[reservation-details]</p><p></p>','email_cancel_text'=>'<p>If you want to cancel your reservation, simply click the link below:<br />[cancellation-link]<br />If the link is not clickable, please copy and paste this URL into your browser\'s address bar: [cancellation-link-url]</p>','email_signature'=>'<p>Thanks,<br />The Team<br /><br /></p>'));
	}
	
	if($wpdb->query("select * from ".$wpdb->base_prefix.$blog_prefix."booking_emails where email_id = 2")==0) {
		$wpdb->insert($wpdb->base_prefix.$blog_prefix."booking_emails",array('email_id'=>2,'email_name'=>'Email sent automatically to customer to make him/her confirm the reservation via link','email_subject'=>'Confirm your Booking','email_text'=>'<p>Hello [customer-name],</p><p>we received your reservation request:</p><p>[reservation-details]</p><p>To confirm your reservation, simply click the link below to verify your email address:</p><p>[confirmation-link]</p><p>If the link is not clickable, please copy and paste this URL into your browser\'s address bar: [confirmation-link-url]</p>','email_cancel_text'=>'','email_signature'=>'<p>Thanks,<br />The Team<br /><br /></p>'));
	}
	
	if($wpdb->query("select * from ".$wpdb->base_prefix.$blog_prefix."booking_emails where email_id = 3")==0) {
		$wpdb->insert($wpdb->base_prefix.$blog_prefix."booking_emails",array('email_id'=>3,'email_name'=>'Email sent automatically to customer to tell him/her that you have to confirm his/her reservation','email_subject'=>'Confirmation of Booking','email_text'=>'<p>Hello [customer-name],</p><p>thanks for Booking, you\'ll receive a mail when your reservation/s will be confirmed.<br />Your Reservation details:</p><p>[reservation-details]</p>','email_cancel_text'=>'','email_signature'=>'<p>Thanks,<br />The Team<br /><br /></p>'));
	}
	
	if($wpdb->query("select * from ".$wpdb->base_prefix.$blog_prefix."booking_emails where email_id = 4")==0) {
		$wpdb->insert($wpdb->base_prefix.$blog_prefix."booking_emails",array('email_id'=>4,'email_name'=>'Email sent to customer when reservation is confirmed manually from admin panel','email_subject'=>'Booking Confirmed','email_text'=>'<p>Hello [customer-name],</p><p>Your reservation has been confirmed.<br />Reservation details:</p><p>[reservation-details]</p>','email_cancel_text'=>'<p>If you want to cancel your reservation, simply click the link below:<br />[cancellation-link]<br />If the link is not clickable, please copy and paste this URL into your browser\'s address bar: [cancellation-link-url]</p>','email_signature'=>'<p>Thanks,<br />The Team<br /><br /></p>'));
	}
	
	
	$sql8="
	CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_holidays (
	  holiday_id int(11) NOT NULL AUTO_INCREMENT,
	  holiday_date date NOT NULL,
	  calendar_id int(11) NOT NULL,
	  PRIMARY KEY  (holiday_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
	";
	dbDelta($sql8);
	
	$sql14="CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_pages (
	  page_id int(11) unsigned NOT NULL AUTO_INCREMENT,
	  page_type char(1) NOT NULL DEFAULT '',
	  page_name varchar(255) NOT NULL DEFAULT '',
	  PRIMARY KEY  (page_id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	dbDelta($sql14);
	
	$sql15="
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 1,'a', 'Booking Calendar') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 1
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 2,'a', 'Settings') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 2
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 3,'a', 'Bg and Colors') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 3
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 4,'a', 'Manage Categories') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 4
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 5,'a', 'Manage Calendars') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 5
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 6,'a', 'Reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 6
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 7,'a', 'Manage mail') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 7
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 8,'a', 'Form management') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 8
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 9,'a', 'Texts management') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 9
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 10,'a', 'Admin left menu') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 10
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 11,'p', 'Public section') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 11
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 12,'a', 'Your reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 12
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_pages (page_id, page_type, page_name)
	SELECT * FROM (SELECT 13,'a', 'Contact administrator') AS tmp
	WHERE NOT EXISTS (
		SELECT page_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_pages WHERE page_id = 13
	) LIMIT 1;
	
	";
	dbDelta($sql15);
	
	$sql16="CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_texts (
	  text_id int(11) unsigned NOT NULL AUTO_INCREMENT,
	  page_id int(11) NOT NULL,
	  text_label varchar(255) NOT NULL DEFAULT '',
	  text_value text NOT NULL,
	  PRIMARY KEY  (text_id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	dbDelta($sql16);
		
	$sql17 = "INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '1','WELCOME_TEXT1' as label, 'WELCOME TO BOOKING CALENDAR CONTROL PANEL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 1 AND text_label = 'WELCOME_TEXT1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '1','WELCOME_TEXT2' as label, 'Use the menu on the left to manage all configurations and contents') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 1 AND text_label = 'WELCOME_TEXT2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '1','WELCOME_TEXT3' as label, 'Hey Admin,') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 1 AND text_label = 'WELCOME_TEXT3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '1','WELCOME_TEXT4' as label, 'it seems like you did not adjust the settings and  created a calendar yet.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 1 AND text_label = 'WELCOME_TEXT4'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '1','WELCOME_TEXT5' as label, 'Remember, ') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 1 AND text_label = 'WELCOME_TEXT5'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '1','WELCOME_TEXT6' as label, 'if you skip these two steps, the Booking Calendar cannot work.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 1 AND text_label = 'WELCOME_TEXT6'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '1','WELCOME_TEXT7' as label, 'Let\'s go to start now!') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 1 AND text_label = 'WELCOME_TEXT7'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TIMEZONE_LABEL' as label, 'Timezone') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TIMEZONE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TIMEZONE_SUBLABEL' as label, 'Your timezone to manage the time slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TIMEZONE_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TIMEZONE_ALERT' as label, 'Select your timezone') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TIMEZONE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TIMEZONE_SELECT' as label, 'Select your timezone') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TIMEZONE_SELECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_DATE_FORMAT_LABEL' as label, 'Choose calendar date format.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_DATE_FORMAT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_DATE_FORMAT_SUBLABEL' as label, 'Switch between US, UK and EU date formats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_DATE_FORMAT_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_DATE_FORMAT_UK' as label, 'UK - dd/mm/yyyy - week starts on Monday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_DATE_FORMAT_UK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_DATE_FORMAT_US' as label, 'US - mm/dd/yyyy - week starts on Sunday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_DATE_FORMAT_US'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_DATE_FORMAT_EU' as label, 'EU - yyyy/mm/dd - week starts on Monday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_DATE_FORMAT_EU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TIME_FORMAT_LABEL' as label, 'Choose calendar time format.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TIME_FORMAT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TIME_FORMAT_SUBLABEL' as label, 'Switch between 12-hour and 24-hour time formats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TIME_FORMAT_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TIME_FORMAT_12' as label, '12-hour time format with am/pm') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TIME_FORMAT_12'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TIME_FORMAT_24' as label, '24-hour time format') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TIME_FORMAT_24'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_EMAIL_RESERVATION_LABEL' as label, 'Admin Email') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_EMAIL_RESERVATION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_EMAIL_RESERVATION_SUBLABEL' as label, 'E-mail address where you\'ll receive reservation alerts') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_EMAIL_RESERVATION_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_EMAIL_RESERVATION_ALERT' as label, 'Specify your email address') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_EMAIL_RESERVATION_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_EMAIL_FROM_RESERVATION_LABEL' as label, 'Email \"from\"') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_EMAIL_FROM_RESERVATION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_EMAIL_FROM_RESERVATION_SUBLABEL' as label, 'Name and e-mail address shown in the field \"From\" in every e-mail sent to confirm the reservation to your customer') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_EMAIL_FROM_RESERVATION_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_NAME_FROM_RESERVATION_SIDE_LABEL' as label, 'Sender name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_NAME_FROM_RESERVATION_SIDE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_EMAIL_FROM_RESERVATION_SIDE_LABEL' as label, 'E-mail address') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_EMAIL_FROM_RESERVATION_SIDE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_EMAIL_FROM_RESERVATION_ALERT' as label, 'Specify an email address \'from\'') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_EMAIL_FROM_RESERVATION_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CONFIRMATION_MODE_LABEL' as label, 'Reservation: confirmation mode') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CONFIRMATION_MODE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CONFIRMATION_MODE_SUBLABEL' as label, 'Choose how to confirm reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CONFIRMATION_MODE_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CONFIRMATION_MODE_ALERT' as label, 'Select reservation confirm mode') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CONFIRMATION_MODE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CONFIRMATION_MODE_SELECT' as label, 'Select reservation confirmation mode') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CONFIRMATION_MODE_SELECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CONFIRMATION_MODE_1' as label, 'Automatically - When a user book a time slot, it is automatically confirmed') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CONFIRMATION_MODE_1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CONFIRMATION_MODE_2' as label, 'By a verification e-mail - When a user book a time slot, he has to confirm the reservation by clicking on a link sent to him by e-mail') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CONFIRMATION_MODE_2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CONFIRMATION_MODE_3' as label, 'Admin confirm - You must confirm the reservation in the reservations area') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CONFIRMATION_MODE_3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_REDIRECT_CONFIRMATION_PATH_LABEL' as label, 'Currently in the confirmation page, the user will be pointed to the calendar. If you want to modify the destination page click here: ') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_REDIRECT_CONFIRMATION_PATH_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_REDIRECT_CONFIRMATION_PATH_SUBLABEL' as label, 'Set the url (starting with: http://): ') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_REDIRECT_CONFIRMATION_PATH_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_REDIRECT_BOOKING_PATH_LABEL' as label, 'Redirect page after booking') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_REDIRECT_BOOKING_PATH_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_REDIRECT_BOOKING_PATH_SUBLABEL' as label, ' (starting with: http://)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_REDIRECT_BOOKING_PATH_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CANCEL_LABEL' as label, 'Reservation: cancellation') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CANCEL_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CANCEL_SUBLABEL' as label, 'Choose if the customer will be able to cancel his reservation by a link in the confirmation email he receives (when you decide to activate this function you can check the email to change the text)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CANCEL_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RESERVATION_CANCEL_ENABLED' as label, 'enabled') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RESERVATION_CANCEL_ENABLED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_REDIRECT_CANCEL_PATH_LABEL' as label, 'Currently in the cancellation page, the user will be pointed to the calendar. If you want to modify the destination page click here: ') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_REDIRECT_CANCEL_PATH_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_REDIRECT_CANCEL_PATH_SUBLABEL' as label, 'Set the url (starting with: http://): ') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_REDIRECT_CANCEL_PATH_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_ENABLED_LABEL' as label, 'Google recaptcha') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_ENABLED_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_ENABLED_SUBLABEL' as label, 'Code verification to avoid spam') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_ENABLED_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_ENABLED_ENABLED' as label, 'enabled') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_ENABLED_ENABLED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_PUBLIC_KEY_LABEL' as label, 'Public Key') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_PUBLIC_KEY_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_PUBLIC_KEY_SUBLABEL' as label, 'It must be associated with your site domain, go to Recaptcha site to get it:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_PUBLIC_KEY_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_PUBLIC_KEY_ALERT' as label, 'Insert Google recaptcha public key') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_PUBLIC_KEY_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_PRIVATE_KEY_LABEL' as label, 'Private key') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_PRIVATE_KEY_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_PRIVATE_KEY_SUBLABEL' as label, 'It must be associated with your site domain, go to Recaptcha site to get it:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_PRIVATE_KEY_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_RECAPTCHA_PRIVATE_KEY_ALERT' as label, 'Insert Google recaptcha private key') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_RECAPTCHA_PRIVATE_KEY_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_TERMS_LABEL' as label, 'Add terms and condition check') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_TERMS_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_TERMS_SUBLABEL' as label, 'Adding this control, the user must check it to be able to book. It\'s mandatory to insert at least a label to enable this option') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_TERMS_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_TERMS_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_TERMS_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_TERMS_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_TERMS_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TERMS_LABEL_LABEL' as label, 'Label to show:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TERMS_LABEL_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_TERMS_LINK_LABEL' as label, 'Link to terms and conditions (starting with \'http://\'):') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_TERMS_LINK_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOT_SELECTION_LABEL' as label, 'Slot selection') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOT_SELECTION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOT_SELECTION_SUBLABEL' as label, '(choose if customer can reserve only one or multiple slots at once)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOT_SELECTION_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOT_SELECTION_MULTIPLE' as label, 'Multiple selection') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOT_SELECTION_MULTIPLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOT_SELECTION_ONE' as label, 'Only one') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOT_SELECTION_ONE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_UNLIMITED_LABEL' as label, 'Unlimited reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_UNLIMITED_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_UNLIMITED_SUBLABEL' as label, 'Choose if slots can have unlimited reservations or just one.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_UNLIMITED_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_UNLIMITED_ONE' as label, 'one reservation per slot') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_UNLIMITED_ONE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_UNLIMITED_UNLIMITED' as label, 'unlimited reservations per slot') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_UNLIMITED_UNLIMITED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_UNLIMITED_CUSTOM' as label, 'use the number set in slot insertion') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_UNLIMITED_CUSTOM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_BOOKED_SLOTS_LABEL' as label, 'Show booked slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_BOOKED_SLOTS_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_BOOKED_SLOTS_SUBLABEL' as label, 'Choose whether to show or not the booked slots. This works only if reservations per slot are not unlimited') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_BOOKED_SLOTS_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_BOOKED_SLOTS_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_BOOKED_SLOTS_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_BOOKED_SLOTS_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_BOOKED_SLOTS_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_POPUP_ENABLED_LABEL' as label, 'Available time slots preview') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_POPUP_ENABLED_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_POPUP_ENABLED_SUBLABEL' as label, 'Show the preview of available time slots on calendar days rollover') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_POPUP_ENABLED_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_POPUP_ENABLED_ENABLED' as label, 'enabled') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_POPUP_ENABLED_ENABLED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SLOTS_POPUP_ENABLED_DISABLED' as label, 'disabled') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SLOTS_POPUP_ENABLED_DISABLED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_CATEGORY_SELECTION_LABEL' as label, 'Show category selection') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_CATEGORY_SELECTION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_CATEGORY_SELECTION_SUBLABEL' as label, 'Choose whether to show or not the category selection drop down at the top right of the calendar when general shortcode <strong>[wp_booking_calendar]</strong> is used') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_CATEGORY_SELECTION_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_CATEGORY_SELECTION_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_CATEGORY_SELECTION_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_CATEGORY_SELECTION_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_CATEGORY_SELECTION_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_CALENDAR_SELECTION_LABEL' as label, 'Show calendar selection') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_CALENDAR_SELECTION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_CALENDAR_SELECTION_SUBLABEL' as label, 'Choose whether to show or not the calendar selection drop down at the top right of the calendar when general or category shortcode id used') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_CALENDAR_SELECTION_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_CALENDAR_SELECTION_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_CALENDAR_SELECTION_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_CALENDAR_SELECTION_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_CALENDAR_SELECTION_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_CALENDAR_MONTH_LIMIT_LABEL' as label, 'Calendar months view') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_CALENDAR_MONTH_LIMIT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_CALENDAR_MONTH_LIMIT_SUBLABEL' as label, 'Choose if you want to limit the number of past and future months shown in the calendar. Leave -1 if you don\'t want to set this limit') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_CALENDAR_MONTH_LIMIT_SUBLABEL'
	) LIMIT 1;			
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_CALENDAR_MONTH_LIMIT_PAST' as label, 'Past months:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_CALENDAR_MONTH_LIMIT_PAST'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_CALENDAR_MONTH_LIMIT_FUTURE' as label, 'Future months:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_CALENDAR_MONTH_LIMIT_FUTURE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_BOOK_FROM_LABEL' as label, 'Choose when users are able to book a slot') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_BOOK_FROM_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_BOOK_FROM_SUBLABEL' as label, 'Insert the minimum number of days that a user has to book before the slot date in order to get admitted. Leave 0 if he can book even at the last minute.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_BOOK_FROM_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_BOOK_TO_SUBLABEL' as label, 'Insert the maximum number of days that a user can book when landing on the calendar. Leave 0 if he can book at any date.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_BOOK_TO_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_LABEL' as label, 'Enable Paypal payment') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_SUBLABEL1' as label, 'Activate this option if you want people to pay the booking fee with Paypal. You must complete all the fields below to activate this service.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_SUBLABEL1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_SUBLABEL2' as label, 'Note that if you activate IPN') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_SUBLABEL2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_SUBLABEL3' as label, 'in your Paypal profile the system will automatically confirm reservations after payments even if the user closes the browser before being redirected to the Booking Calendar. In the Notification URL text box just put your WP site address.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_SUBLABEL3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_ACCOUNT' as label, 'Insert your paypal email address') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_ACCOUNT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_CURRENCY' as label, 'Select your currency') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_CURRENCY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_LOCALE' as label, 'Select your country') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_LOCALE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_LOCALE_CHOOSE' as label, 'choose') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_LOCALE_CHOOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_CURRENCY_CHOOSE' as label, 'choose') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_CURRENCY_CHOOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_PAYPAL_DISPLAY_PRICE' as label, 'Display prices in booking page') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_PAYPAL_DISPLAY_PRICE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_FORM_TEXT_LABEL' as label, 'Additional text for booking page') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_FORM_TEXT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_FORM_TEXT_SUBLABEL' as label, 'It will be displayed under the date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_FORM_TEXT_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_CANCEL' as label, 'CANCEL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_CANCEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SAVE' as label, 'SAVE') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_SLOTS_SEATS_LABEL' as label, 'Show available slots seats instead of available slots number') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_SLOTS_SEATS_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_SLOTS_SEATS_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_SLOTS_SEATS_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_SLOTS_SEATS_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_SLOTS_SEATS_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_FIRST_FILLED_MONTH_LABEL' as label, 'Show the first not empty month by default') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_FIRST_FILLED_MONTH_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_FIRST_FILLED_MONTH_SUBLABEL' as label, 'Choose whether to start the calendar from the first month which have slots. If Set to \"NO\" the first visible month will be the current month.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_FIRST_FILLED_MONTH_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_FIRST_FILLED_MONTH_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_FIRST_FILLED_MONTH_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_SHOW_FIRST_FILLED_MONTH_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_SHOW_FIRST_FILLED_MONTH_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_EMPTY_CELLS_TITLE' as label, 'Calendar empty cells') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_EMPTY_CELLS_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_EMPTY_CELLS_BACKGROUND' as label, 'Empty cell background (no day):') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_EMPTY_CELLS_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_AVAILABLE_CELLS_TITLE' as label, 'Calendar available cells, NOT today') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_AVAILABLE_CELLS_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_AVAILABLE_CELLS_BACKGROUND' as label, 'Available day background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_AVAILABLE_CELLS_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_AVAILABLE_CELLS_BACKGROUND_OVER' as label, 'Available day background on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_AVAILABLE_CELLS_BACKGROUND_OVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_AVAILABLE_CELLS_LINE_1_COLOR' as label, 'Available day first line label color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_AVAILABLE_CELLS_LINE_1_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_AVAILABLE_CELLS_LINE_1_COLOR_OVER' as label, 'Available day first line label color on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_AVAILABLE_CELLS_LINE_1_COLOR_OVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_AVAILABLE_CELLS_LINE_2_COLOR' as label, 'Available day second line label color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_AVAILABLE_CELLS_LINE_2_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_AVAILABLE_CELLS_LINE_2_COLOR_OVER' as label, 'Available day second line label color on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_AVAILABLE_CELLS_LINE_2_COLOR_OVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_TODAY_CELLS_TITLE' as label, 'Calendar today cell') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_TODAY_CELLS_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_TODAY_CELLS_BACKGROUND' as label, 'Today\'s background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_TODAY_CELLS_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_TODAY_CELLS_BACKGROUND_OVER' as label, 'Today\'s background on mouse over (with available slots):') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_TODAY_CELLS_BACKGROUND_OVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_TODAY_CELLS_LINE_1_COLOR' as label, 'Today\'s first line color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_TODAY_CELLS_LINE_1_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_TODAY_CELLS_LINE_1_COLOR_OVER' as label, 'Today\'s first line color on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_TODAY_CELLS_LINE_1_COLOR_OVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_TODAY_CELLS_LINE_2_COLOR' as label, 'Today\'s second line color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_TODAY_CELLS_LINE_2_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_TODAY_CELLS_LINE_2_COLOR_OVER' as label, 'Today\'s second line color on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_TODAY_CELLS_LINE_2_COLOR_OVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_SOLDOUT_CELLS_TITLE' as label, 'Calendar sold out cells') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_SOLDOUT_CELLS_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_SOLDOUT_CELLS_BACKGROUND' as label, 'Sold out background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_SOLDOUT_CELLS_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_SOLDOUT_CELLS_LINE_1_COLOR' as label, 'Sold out day first line label color (not today):') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_SOLDOUT_CELLS_LINE_1_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_SOLDOUT_CELLS_LINE_2_COLOR' as label, 'Sold out day second line label color (not today):') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_SOLDOUT_CELLS_LINE_2_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_NOTAVAILABLE_CELLS_TITLE' as label, 'Calendar not available cells, NOT today') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_NOTAVAILABLE_CELLS_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_NOTAVAILABLE_CELLS_BACKGROUND' as label, 'Not available day background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_NOTAVAILABLE_CELLS_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_NOTAVAILABLE_CELLS_LINE_1_COLOR' as label, 'Not available day first line label color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_NOTAVAILABLE_CELLS_LINE_1_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_NOTAVAILABLE_CELLS_LINE_2_COLOR' as label, 'Not available day second line label color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_NOTAVAILABLE_CELLS_LINE_2_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_TITLE' as label, 'Booking form style') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_BACKGROUND' as label, 'Booking form background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_LABELS_COLOR' as label, 'Booking form labels color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_LABELS_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_RECAPTCHA' as label, 'Recaptcha style:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_RECAPTCHA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_RECAPTCHA_WHITE' as label, 'white') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_RECAPTCHA_WHITE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_RECAPTCHA_RED' as label, 'red') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_RECAPTCHA_RED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_RECAPTCHA_BLACK' as label, 'black') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_RECAPTCHA_BLACK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_MONTH_CONTAINER_TITLE' as label, 'Month box style') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_MONTH_CONTAINER_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_MONTH_CONTAINER_BACKGROUND' as label, 'Month box background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_MONTH_CONTAINER_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_MONTH_NAME_COLOR' as label, 'Month name label color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_MONTH_NAME_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_YEAR_NAME_COLOR' as label, 'Year label color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_YEAR_NAME_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_DAY_NAMES_TITLE' as label, 'Weekdays style') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_DAY_NAMES_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_DAY_NAMES_COLOR' as label, 'Weekdays label color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_DAY_NAMES_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_FIELD_INPUT_BACKGROUND' as label, 'Fields background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_FIELD_INPUT_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_FIELD_INPUT_COLOR' as label, 'Fields text color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_FIELD_INPUT_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_MONTH_NAVIGATION_BUTTONS_TITLE' as label, 'Month navigation buttons style') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_MONTH_NAVIGATION_BUTTONS_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_MONTH_NAVIGATION_BUTTONS_BACKGROUND' as label, 'Buttons background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_MONTH_NAVIGATION_BUTTONS_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_MONTH_NAVIGATION_BUTTONS_BACKGROUND_HOVER' as label, 'Buttons background on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_MONTH_NAVIGATION_BUTTONS_BACKGROUND_HOVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_BOOK_NOW_BUTTON_BACKGROUND' as label, '\"Book now\" button background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_BOOK_NOW_BUTTON_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_BOOK_NOW_BUTTON_BACKGROUND_HOVER' as label, '\"Book now\" background on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_BOOK_NOW_BUTTON_BACKGROUND_HOVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_BOOK_NOW_BUTTON_COLOR' as label, '\"Book now\" button text color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_BOOK_NOW_BUTTON_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_BOOK_NOW_BUTTON_COLOR_HOVER' as label, '\"Book now\" button text color on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_BOOK_NOW_BUTTON_COLOR_HOVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_CLEAR_BUTTON_BACKGROUND' as label, '\"Clear\" button background:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_CLEAR_BUTTON_BACKGROUND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_CLEAR_BUTTON_BACKGROUND_HOVER' as label, '\"Clear\" button background on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_CLEAR_BUTTON_BACKGROUND_HOVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_CLEAR_BUTTON_COLOR' as label, '\"Clear\" button text color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_CLEAR_BUTTON_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_CLEAR_BUTTON_COLOR_HOVER' as label, '\"Clear\" button text color on mouse over:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_CLEAR_BUTTON_COLOR_HOVER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_FORM_CALENDAR_NAME_COLOR' as label, 'Calendar name color:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_FORM_CALENDAR_NAME_COLOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_CANCEL' as label, 'CANCEL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_CANCEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '3','STYLES_SAVE' as label, 'SAVE') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 3 AND text_label = 'STYLES_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_NAME_LABEL' as label, 'Name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_NAME_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_SHORTCODE_LABEL' as label, 'Shortcode') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_SHORTCODE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_PUBLISHED_LABEL' as label, 'Published') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_PUBLISHED_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_SET_AS_DEFAULT' as label, 'Set as default') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_SET_AS_DEFAULT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_MODIFY_NAME' as label, 'Modify name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_MODIFY_NAME'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_DELETE' as label, 'Delete') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_DELETE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_DELETE_CONFIRM_SINGLE' as label, 'Are you sure you want to delete this category? All calendars, slots, holidays and reservations related to it will be deleted too') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_DELETE_CONFIRM_SINGLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_PUBLISH_CONFIRM_SINGLE' as label, 'Are you sure you want to publish this category?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_PUBLISH_CONFIRM_SINGLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_UNPUBLISH_CONFIRM_SINGLE' as label, 'Are you sure you want to unpublish this category?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_UNPUBLISH_CONFIRM_SINGLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_NAME_ALERT' as label, 'Insert a name for the category') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_NAME_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CREATE_NEW_CATEGORY' as label, 'Create new category') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CREATE_NEW_CATEGORY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','TYPE_THE_NAME' as label, 'Type the name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'TYPE_THE_NAME'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_ADD' as label, 'Add') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_ADD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_SELECTED_ITEMS' as label, 'Selected items') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_SELECTED_ITEMS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_PUBLISH_CONFIRM_MULTIPLE' as label, 'Are you sure you want to publish the selected items?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_PUBLISH_CONFIRM_MULTIPLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_NO_ITEMS_SELECTED' as label, 'No items selected') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_NO_ITEMS_SELECTED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_PUBLISH' as label, 'Publish') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_PUBLISH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_UNPUBLISH_CONFIRM_MULTIPLE' as label, 'Are you sure you want to unpublish the selected items?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_UNPUBLISH_CONFIRM_MULTIPLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_UNPUBLISH' as label, 'Unpublish') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_UNPUBLISH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_DELETE_CONFIRM_MULTIPLE' as label, 'Are you sure you want to delete the selected items? All calendars, slots, holidays and reservations related to them will be deleted too') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_DELETE_CONFIRM_MULTIPLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORIES_DELETE' as label, 'Delete') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORIES_DELETE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '4','CATEGORY_SAVE' as label, 'Save') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 4 AND text_label = 'CATEGORY_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDAR_TITLE_LABEL' as label, 'Title') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDAR_TITLE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDAR_CATEGORY_LABEL' as label, 'Category') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDAR_CATEGORY_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDAR_SHORTCODE_LABEL' as label, 'Shortcode') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDAR_SHORTCODE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDAR_PUBLISHED_LABEL' as label, 'Published') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDAR_PUBLISHED_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_SET_AS_DEFAULT' as label, 'Set as default') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_SET_AS_DEFAULT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_MODIFY' as label, 'Modify') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_MODIFY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_MANAGE' as label, 'Manage') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_MANAGE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_DELETE' as label, 'Delete') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_DELETE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','MODIFY_SLOTS_ALERT' as label, 'There are reservation for one or more of the selected slots. Modify them anyway?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'MODIFY_SLOTS_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','DUPLICATE_SLOTS_ALERT' as label, 'Duplicate slots. Cannot make these changes') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'DUPLICATE_SLOTS_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAY_DATE_LABEL' as label, 'Date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAY_DATE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAY_DELETE' as label, 'Delete') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAY_DELETE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_PAGINATION_FIRST' as label, 'First') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_PAGINATION_FIRST'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_PAGINATION_PREV' as label, 'Prev') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_PAGINATION_PREV'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_PAGINATION_NEXT' as label, 'Next') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_PAGINATION_NEXT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_PAGINATION_LAST' as label, 'Last') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_PAGINATION_LAST'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DATE_LABEL' as label, 'Date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DATE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_TIME_FROM_LABEL' as label, 'Time From') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_TIME_FROM_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_TIME_TO_LABEL' as label, 'Time To') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_TIME_TO_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_SPECIAL_TEXT_LABEL' as label, 'Special Text') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_SPECIAL_TEXT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_PRICE_LABEL' as label, 'Price') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_PRICE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_AV_LABEL' as label, 'Seats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_AV_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_RESERVATION_LABEL' as label, 'Reserved') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_RESERVATION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_HOUR' as label, 'hour') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_HOUR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_MINUTE' as label, 'minute') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_MINUTE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_MODIFY' as label, 'Modify') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_MODIFY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DELETE' as label, 'Delete') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DELETE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_PAGES' as label, 'Pages') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_PAGES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','DELETED_SLOTS_ALERT' as label, 'slots deleted') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'DELETED_SLOTS_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','MODIFIED_SLOTS_ALERT' as label, 'slots modified') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'MODIFIED_SLOTS_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','ADDED_SLOTS_ALERT' as label, 'slots added') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'ADDED_SLOTS_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SELECTED_DAYS_HOLIDAY_ALERT' as label, 'Days selected are holidays. Cannot make these changes') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SELECTED_DAYS_HOLIDAY_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDAR_YOU_ARE_IN' as label, 'You are in') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDAR_YOU_ARE_IN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS' as label, 'Calendars') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','STATUS_PUBLISHED' as label, 'Published') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'STATUS_PUBLISHED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','STATUS_UNPUBLISHED' as label, 'Unpublished') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'STATUS_UNPUBLISHED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','ACTUAL_CALENDAR_STATUS' as label, 'The Actual Status of this calendar is') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'ACTUAL_CALENDAR_STATUS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','MANAGE_TIME_SLOTS' as label, 'MANAGE TIME SLOTS') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'MANAGE_TIME_SLOTS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CLOSING_DAYS' as label, 'CLOSING DAYS') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CLOSING_DAYS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_DELETE_CONFIRM_SINGLE' as label, 'Are you sure you want to delete this item? All holidays, slots and reservations will be deleted') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_DELETE_CONFIRM_SINGLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_PUBLISH_CONFIRM_SINGLE' as label, 'Are you sure you want to publish this calendar?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_PUBLISH_CONFIRM_SINGLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_UNPUBLISH_CONFIRM_SINGLE' as label, 'Are you sure you want to unpublish this calendar?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_UNPUBLISH_CONFIRM_SINGLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_ADD' as label, 'Add') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_ADD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','NEW_CALENDAR_CHOOSE_CATEGORY' as label, 'choose a category') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'NEW_CALENDAR_CHOOSE_CATEGORY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_SELECTED_ITEMS' as label, 'Selected items') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_SELECTED_ITEMS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_PUBLISH_CONFIRM_MULTIPLE' as label, 'Are you sure to publish the selected items?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_PUBLISH_CONFIRM_MULTIPLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_NO_ITEMS_SELECTED' as label, 'No items selected') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_NO_ITEMS_SELECTED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_PUBLISH' as label, 'Publish') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_PUBLISH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_UNPUBLISH_CONFIRM_MULTIPLE' as label, 'Are you sure to unpublish the selected items?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_UNPUBLISH_CONFIRM_MULTIPLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_UNPUBLISH' as label, 'Unpublish') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_UNPUBLISH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_DELETE_CONFIRM_MULTIPLE' as label, 'Are you sure to delete the selected items? Slots and reservations of these calendars will be deleted too') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_DELETE_CONFIRM_MULTIPLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_DUPLICATE_CONFIRM_MULTIPLE' as label, 'Are you sure to duplicate the selected items?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_DUPLICATE_CONFIRM_MULTIPLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDARS_DUPLICATE' as label, 'Duplicate') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDARS_DUPLICATE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CREATE_CLOSING_DAY_TITLE' as label, 'Create Closing Days') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CREATE_CLOSING_DAY_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CREATE_CLOSING_DAY_SUBTITLE' as label, 'These days will not be available for booking. If you created time slots in these days, they will be deleted.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CREATE_CLOSING_DAY_SUBTITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CREATE_CLOSING_DAY_HOW_MANY' as label, 'How many closing days do you want to set?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CREATE_CLOSING_DAY_HOW_MANY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CREATE_CLOSING_DAY_CHOOSE' as label, 'choose') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CREATE_CLOSING_DAY_CHOOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CREATE_CLOSING_DAY_SINGLE_DAY' as label, 'A single day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CREATE_CLOSING_DAY_SINGLE_DAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CREATE_CLOSING_DAY_PERIOD' as label, 'Period of time') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CREATE_CLOSING_DAY_PERIOD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_FROM' as label, 'From') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_FROM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_TO' as label, 'To') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_TO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_SET' as label, 'SET') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_SET'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_DAY' as label, 'Day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_DAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_DELETE_MULTIPLE_ALERT' as label, 'Are you sure to delete the selected items?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_DELETE_MULTIPLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_NO_ITEMS_SELECTED' as label, 'No items selected') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_NO_ITEMS_SELECTED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_RESERVATION_SINGLE_ALERT' as label, 'No items selected') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_RESERVATION_SINGLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_RESERVATION_MULTIPLE_ALERT' as label, 'There are reservations for one or more dates, are you sure you want to set these days as holidays?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_RESERVATION_MULTIPLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_DATE_ALERT' as label, 'Select a date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_DATE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','HOLIDAYS_DELETE_SINGLE_ALERT' as label, 'Are you sure you want to delete this item?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'HOLIDAYS_DELETE_SINGLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','NEW_CALENDAR_CATEGORY_ALERT' as label, 'Select a category for the calendar') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'NEW_CALENDAR_CATEGORY_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','NEW_CALENDAR_TITLE_ALERT' as label, 'Insert a name for the calendar') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'NEW_CALENDAR_TITLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','NEW_CALENDAR_CATEGORY_LABEL' as label, 'Select calendar category') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'NEW_CALENDAR_CATEGORY_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','NEW_CALENDAR_NAME_LABEL' as label, 'Calendar name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'NEW_CALENDAR_NAME_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','NEW_CALENDAR_EMAIL_LABEL' as label, 'Calendar admin email address') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'NEW_CALENDAR_EMAIL_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDAR_CANCEL' as label, 'CANCEL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDAR_CANCEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CALENDAR_SAVE' as label, 'SAVE') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CALENDAR_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TITLE' as label, 'Insert your preferences to create the time slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DATE_LABEL' as label, 'Date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DATE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_FROM' as label, 'From') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_FROM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TO' as label, 'To') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DATE_FROM_ALERT' as label, 'Select a date from') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DATE_FROM_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_INTERVAL_CHOOSE_ALERT' as label, 'Choose slot interval') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_INTERVAL_CHOOSE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_INTERVAL_ALERT' as label, 'Insert a valid value for slot interval') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_INTERVAL_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_CUSTOM_SLOT_ALERT' as label, 'Insert at least a custom slot') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_CUSTOM_SLOT_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SLOT_DURATION_ALERT' as label, 'Slot duration values are not correct') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SLOT_DURATION_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SLOT_PAUSE_ALERT' as label, 'Insert a valid value for slot pause') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SLOT_PAUSE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TIME_FROM_TIME_TO_ALERT' as label, 'Select at least time from and a time to') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TIME_FROM_TIME_TO_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TIME_PERIOD_ALERT' as label, 'Time periods for slots are not correct') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TIME_PERIOD_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DATE_TO_SUBLABEL' as label, 'Leave this field empty if you want to set a single day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DATE_TO_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DELETE' as label, 'Delete') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DELETE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_LABEL' as label, 'Days') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_ALL' as label, 'All') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_ALL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_MON' as label, 'Mondays') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_MON'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_TUE' as label, 'Tuesdays') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_TUE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_WED' as label, 'Wednesdays') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_WED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_THU' as label, 'Thursdays') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_THU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_FRI' as label, 'Fridays') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_FRI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_SAT' as label, 'Saturdays') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_SAT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_WEEKDAY_SUN' as label, 'Sundays') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_WEEKDAY_SUN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DURATION_LABEL' as label, 'Slot duration') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DURATION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DURATION_SUBLABEL' as label, 'Select the length each time slot will have') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DURATION_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DURATION_CHOOSE' as label, 'choose duration') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DURATION_CHOOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DURATION_MINUTES' as label, 'in minutes') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DURATION_MINUTES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_DURATION_FROM_TO' as label, 'from, to') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_DURATION_FROM_TO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SPECIAL_LABEL' as label, 'Description text (optional)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SPECIAL_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SPECIAL_MODE_BOTH' as label, 'Show both times and special text') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SPECIAL_MODE_BOTH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SPECIAL_MODE_TEXT' as label, 'Show just special text') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SPECIAL_MODE_TEXT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_INTERVAL_LABEL' as label, 'Type here the minutes') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_INTERVAL_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_PAUSE_LABEL' as label, 'Pause between time slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_PAUSE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_PAUSE_SUBLABEL' as label, 'If you like set an interval  between the time slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_PAUSE_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TIME_LABEL' as label, 'Time') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TIME_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TIME_SUBLABEL' as label, 'Set the period of time in which time slots will be available') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TIME_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_PRICE_LABEL' as label, 'Price') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_PRICE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_PRICE_SUBLABEL' as label, 'Insert price for the slots your are creating') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_PRICE_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_AV_LABEL' as label, 'Slot seats number') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_AV_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_AV_SUBLABEL' as label, 'choose availability for every slot') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_AV_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_AV_MAX_LABEL' as label, 'Maximum number of bookable seats at once') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_AV_MAX_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_AV_MAX_SUBLABEL' as label, 'Choose the maximum number of bookable seats at once by a customer
') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_AV_MAX_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_NEW_AV_MAX' as label, 'New maximum bookable slot seats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_NEW_AV_MAX'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_AV_MAX_LABEL' as label, 'Max bookable') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_AV_MAX_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_CANCEL' as label, 'CANCEL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_CANCEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SAVE' as label, 'SAVE') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','CREATE_TIME_SLOTS' as label, 'Create Time Slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'CREATE_TIME_SLOTS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_SELECT_DATE_ALERT' as label, 'Select a date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_SELECT_DATE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DATE_RANGE_ALERT' as label, 'Select date range') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DATE_RANGE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_SELECT_RANGE_ALERT' as label, 'Select date range') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_SELECT_RANGE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DAY' as label, 'Day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_FROM' as label, 'From') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_FROM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DELETE_CONFIRM_SINGLE' as label, 'Are you sure you want to delete this slot?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DELETE_CONFIRM_SINGLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_SAVE' as label, 'Save') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DUPLICATE_SLOT_ALERT' as label, 'There\'s another slot for the same date and time. Change values') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DUPLICATE_SLOT_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_TIME_ALERT' as label, 'Slot times values are not correct') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_TIME_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DATE_FROM_ALERT' as label, 'Select a date from') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DATE_FROM_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DATE_TO_ALERT' as label, 'Select a date to') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DATE_TO_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_NEW_TIME_RANGE_ALERT' as label, 'New time range values are not correct') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_NEW_TIME_RANGE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SEARCH_TIME_SLOTS_LABEL' as label, 'Search Time Slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SEARCH_TIME_SLOTS_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SEARCH_TIME_SLOTS_SUBLABEL' as label, 'Use the following filters to search created time slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SEARCH_TIME_SLOTS_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SEARCH_FILTER_LABEL' as label, 'Filter by date:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SEARCH_FILTER_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SEARCH_FILTER_CHOOSE' as label, 'choose a date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SEARCH_FILTER_CHOOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SEARCH_FILTER_SINGLE' as label, 'Single day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SEARCH_FILTER_SINGLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SEARCH_FILTER_PERIOD' as label, 'Period of time') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SEARCH_FILTER_PERIOD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_TO' as label, 'To') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_TO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TIME_FROM_LABEL' as label, 'Time From') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TIME_FROM_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TIME_TO_LABEL' as label, 'Time To') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TIME_TO_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_TIME_TO_SUBLABEL' as label, 'Leave empty if you don\'t want a range period of time') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_TIME_TO_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_SEARCH' as label, 'Search') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_SEARCH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_LABEL' as label, 'Modify Time Slots') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_ACTION' as label, 'Action:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_ACTION'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_CHOOSE' as label, 'choose') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_CHOOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_MODIFY' as label, 'modify') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_MODIFY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_DELETE' as label, 'delete') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_DELETE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_SLOT' as label, 'Slot:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_SLOT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_WEEKDAYS' as label, 'Weekdays:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_WEEKDAYS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_NEW_TIME_FROM' as label, 'New Time From') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_NEW_TIME_FROM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_SLOTS_NEW_TIME_TO' as label, 'New Time To') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_SLOTS_NEW_TIME_TO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_NEW_PRICE' as label, 'New Price') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_NEW_PRICE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_NEW_AV' as label, 'New slot seats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_NEW_AV'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_DELETE_MULTIPLE_ALERT' as label, 'Are you sure to delete the selected items?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_DELETE_MULTIPLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOTS_NO_ITEMS_SELECTED' as label, 'No items selected') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOTS_NO_ITEMS_SELECTED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_MODIFY_NEW_TEXT' as label, 'New text') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_MODIFY_NEW_TEXT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_DATE_LABEL' as label, 'Date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_DATE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_TIME_LABEL' as label, 'Time') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_TIME_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEATS_LABEL' as label, 'Seats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEATS_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_PRICE_LABEL' as label, 'Price') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_PRICE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SURNAME_NAME_LABEL' as label, 'Surname, name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SURNAME_NAME_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_EMAIL_LABEL' as label, 'Email') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_EMAIL_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_CONFIRMED_LABEL' as label, 'Confirmed') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_CONFIRMED_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_CANCELLED' as label, 'Cancelled') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_CANCELLED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_DELETE' as label, 'Delete') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_DELETE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_DETAIL' as label, 'Detail') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_DETAIL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_YOU_ARE_IN' as label, 'You are in') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_YOU_ARE_IN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATIONS' as label, 'Reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATIONS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','CALENDAR' as label, 'Calendar') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'CALENDAR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATIONS_LIST' as label, 'Reservations List') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATIONS_LIST'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SELECT_DATE_ALERT' as label, 'Select a date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SELECT_DATE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SELECT_DATE_RANGE_ALERT' as label, 'Select date range') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SELECT_DATE_RANGE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_DELETE_SINGLE_ALERT' as label, 'Are you sure you want to delete this reservation?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_DELETE_SINGLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_PAYPAL_CONFIRM_SINGLE_ALERT' as label, 'Are you sure you want to confirm this reservation? It could not have been paid yet, check your Paypal account before confirmation') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_PAYPAL_CONFIRM_SINGLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_CONFIRM_SINGLE_ALERT' as label, 'Are you sure you want to confirm this reservation?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_CONFIRM_SINGLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_UNCONFIRM_SINGLE_ALERT' as label, 'Are you sure you want to unconfirm this reservation?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_UNCONFIRM_SINGLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_DAY' as label, 'Day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_DAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_FROM' as label, 'From') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_FROM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH_RESERVATION_LABEL' as label, 'Search Reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH_RESERVATION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH_RESERVATION_SUBLABEL' as label, 'Use the following filters to search reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH_RESERVATION_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH_FILTER_DATE_LABEL' as label, 'Filter by date:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH_FILTER_DATE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH_FILTER_DATE_CHOOSE' as label, 'choose') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH_FILTER_DATE_CHOOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH_FILTER_DATE_ONE_DAY' as label, 'One day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH_FILTER_DATE_ONE_DAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH_FILTER_DATE_PERIOD' as label, 'Period of time') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH_FILTER_DATE_PERIOD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_TO' as label, 'To') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_TO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH' as label, 'Search') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_RED_LABEL' as label, 'In red lines you\'ll find those reservations whose slots have been deleted') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_RED_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_DELETE_MULTIPLE_ALERT' as label, 'Are you sure to delete the selected items?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_DELETE_MULTIPLE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_NO_ITEMS_SELECTED' as label, 'No items selected') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_NO_ITEMS_SELECTED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','CSV_EXPORT' as label, 'CSV Export') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'CSV_EXPORT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_RESET_LABEL' as label, 'Show today\'s reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_RESET_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_CLOSE' as label, 'Close') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_CLOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_PRINT' as label, 'Print') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_PRINT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SURNAME_LABEL' as label, 'Surname') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SURNAME_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_NAME_LABEL' as label, 'Name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_NAME_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_PHONE_LABEL' as label, 'Phone') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_PHONE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_MESSAGE_LABEL' as label, 'Message') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_MESSAGE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_ADDITIONAL_FIELD1' as label, 'Additional field 1') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_ADDITIONAL_FIELD1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_ADDITIONAL_FIELD2' as label, 'Additional field 2') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_ADDITIONAL_FIELD2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_ADDITIONAL_FIELD3' as label, 'Additional field 3') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_ADDITIONAL_FIELD3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_ADDITIONAL_FIELD4' as label, 'Additional field 4') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_ADDITIONAL_FIELD4'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_CONFIRMED_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_CONFIRMED_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_CONFIRMED_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_CONFIRMED_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATIONS_PUBLISHED_TITLE' as label, 'Published') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATIONS_PUBLISHED_TITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_LIST' as label, 'List') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_LIST'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_DESCRIPTION_LABEL' as label, 'Description') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_DESCRIPTION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_MODIFY' as label, 'Modify') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_MODIFY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_SUBJECT_ALERT' as label, 'Insert mail subject') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_SUBJECT_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_ALERT' as label, 'Insert mail text') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_SUBJECT_LABEL' as label, 'Email subject') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_SUBJECT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_LABEL' as label, 'Email text') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL1' as label, 'The commands in square brackets are necessary for dynamically inserting the data. If you modify or delete them, data will not be inserted.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL2' as label, '[customer-name]') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL3' as label, 'it inserts the user name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL4' as label, '[reservation-details]') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL4'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL5' as label, 'it inserts reservation details') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL5'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL6' as label, '[confirmation-link]') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL6'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL7' as label, 'it inserts the confirmation link') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL7'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL8' as label, '[confirmation-link-url]') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL8'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_TEXT_SUBLABEL9' as label, 'it inserts the extended link to be copied and pasted into the URL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_TEXT_SUBLABEL9'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_CANCEL_TEXT_LABEL' as label, 'Email cancellation text.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_CANCEL_TEXT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_CANCEL_TEXT_SUBLABEL1' as label, 'Status:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_CANCEL_TEXT_SUBLABEL1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_ENABLED' as label, 'ENABLED') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_ENABLED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_DISABLED' as label, 'DISABLED') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_DISABLED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_CANCEL_TEXT_SUBLABEL2' as label, 'The commands in square brackets are necessary for dynamically inserting the data. If you modify or delete them, data will not be inserted.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_CANCEL_TEXT_SUBLABEL2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_CANCEL_TEXT_SUBLABEL3' as label, '[cancellation-link]') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_CANCEL_TEXT_SUBLABEL3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_CANCEL_TEXT_SUBLABEL4' as label, 'it inserts the cancellation link') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_CANCEL_TEXT_SUBLABEL4'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_CANCEL_TEXT_SUBLABEL5' as label, '[cancellation-link-url]') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_CANCEL_TEXT_SUBLABEL5'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_CANCEL_TEXT_SUBLABEL6' as label, 'it inserts the extended link to be copied and pasted into the URL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_CANCEL_TEXT_SUBLABEL6'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_SIGNATURE_LABEL' as label, 'Email signature') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_SIGNATURE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_CANCEL' as label, 'CANCEL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_CANCEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '7','MAIL_SAVE' as label, 'SAVE') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 7 AND text_label = 'MAIL_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_VISIBLE_FIELDS_LABEL' as label, 'Choose the visible fields in the reservation form') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_VISIBLE_FIELDS_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_VISIBLE_FIELDS_SUBLABEL' as label, '(multiple selection)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_VISIBLE_FIELDS_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_MANDATORY_FIELDS_LABEL' as label, 'Choose the mandatory fields in the reservation form') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_MANDATORY_FIELDS_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_MANDATORY_FIELDS_SUBLABEL' as label, '(multiple selection)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_MANDATORY_FIELDS_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_FIELDS_TYPE_LABEL' as label, 'Fields type') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_FIELDS_TYPE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_FIELDS_TYPE_SUBLABEL' as label, 'choose the type of every form field') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_FIELDS_TYPE_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_FIELDS_TYPE_TEXT' as label, 'Text') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_FIELDS_TYPE_TEXT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_FIELDS_TYPE_AREA' as label, 'TextArea') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_FIELDS_TYPE_AREA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_CANCEL' as label, 'CANCEL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_CANCEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '8','FORM_SAVE' as label, 'SAVE') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 8 AND text_label = 'FORM_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '9','TEXTS_CANCEL' as label, 'CANCEL') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 9 AND text_label = 'TEXTS_CANCEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '9','TEXTS_SAVE' as label, 'SAVE') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 9 AND text_label = 'TEXTS_SAVE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_SETTINGS' as label, 'Settings') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_SETTINGS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_BG_AND_COLORS' as label, 'Bg and Colors') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_BG_AND_COLORS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_MANAGE_CATEGORIES' as label, 'Manage Categories') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_MANAGE_CATEGORIES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_MANAGE_CALENDARS' as label, 'Manage Calendars') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_MANAGE_CALENDARS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_RESERVATIONS' as label, 'Reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_RESERVATIONS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_MANAGE_MAIL' as label, 'Manage Mail') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_MANAGE_MAIL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_FORM_MANAGEMENT' as label, 'Form management') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_FORM_MANAGEMENT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_TEXT_MANAGEMENT' as label, 'Text management') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_TEXT_MANAGEMENT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_PUBLIC_SECTION' as label, 'Public section') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_PUBLIC_SECTION'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_ADMIN_LEFT_MENU' as label, 'Admin left menu') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_ADMIN_LEFT_MENU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','SELECT_CALENDAR' as label, 'Select the calendar:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'SELECT_CALENDAR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','SELECT_CATEGORY' as label, 'Select the category:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'SELECT_CATEGORY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','BACK_TODAY' as label, 'Back to today') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'BACK_TODAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','JANUARY' as label, 'January') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'JANUARY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','FEBRUARY' as label, 'February') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'FEBRUARY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','MARCH' as label, 'March') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'MARCH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','APRIL' as label, 'April') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'APRIL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','MAY' as label, 'May') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'MAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','JUNE' as label, 'June') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'JUNE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','JULY' as label, 'July') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'JULY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','AUGUST' as label, 'August') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'AUGUST'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','SEPTEMBER' as label, 'September') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'SEPTEMBER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','OCTOBER' as label, 'October') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'OCTOBER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','NOVEMBER' as label, 'November') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'NOVEMBER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DECEMBER' as label, 'December') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DECEMBER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','SUNDAY' as label, 'Sunday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'SUNDAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','MONDAY' as label, 'Monday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'MONDAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','TUESDAY' as label, 'Tuesday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'TUESDAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','WEDNESDAY' as label, 'Wednesday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'WEDNESDAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','THURSDAY' as label, 'Thursday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'THURSDAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','FRIDAY' as label, 'Friday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'FRIDAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','SATURDAY' as label, 'Saturday') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'SATURDAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_SUBJECT' as label, 'New reservation') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_SUBJECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE1' as label, 'Reservation data below.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE2' as label, 'Name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE3' as label, 'Surname') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE4' as label, 'Email') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE4'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE5' as label, 'Phone') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE5'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE6' as label, 'Message') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE6'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE7' as label, 'Slots reserved') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE7'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_CALENDAR' as label, 'Calendar') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_CALENDAR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_DATE' as label, 'Date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_DATE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_TIME' as label, 'Time') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_TIME'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE8' as label, 'All reservations must be confirmed in ') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE8'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE9' as label, 'admin panel') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE9'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_USER_MESSAGE2' as label, 'Slots reserved') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_USER_MESSAGE2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_USER_VENUE' as label, 'Venue') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_USER_VENUE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_USER_DATE' as label, 'Date') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_USER_DATE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_USER_TIME' as label, 'Time') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_USER_TIME'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_USER_MESSAGE3' as label, 'Click here to confirm your reservation') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_USER_MESSAGE3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_USER_MESSAGE4' as label, 'Click here to cancel your reservation') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_USER_MESSAGE4'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_SEATS' as label, 'Seats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_SEATS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_USER_SEATS' as label, 'Seats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_USER_SEATS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE10' as label, 'Additional field 1') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE10'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE11' as label, 'Additional field 2') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE11'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE12' as label, 'Additional field 3') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE12'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_MESSAGE13' as label, 'Additional field 4') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_MESSAGE13'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETBOOKINGFORM_PREV_DAY' as label, 'Prev day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETBOOKINGFORM_PREV_DAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETBOOKINGFORM_NEXT_DAY' as label, 'Next day') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETBOOKINGFORM_NEXT_DAY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETBOOKINGFORM_CLOSE' as label, 'CLOSE') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETBOOKINGFORM_CLOSE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETBOOKINGFORM_SLOT_ALERT' as label, 'Select at least one time slot') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETBOOKINGFORM_SLOT_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETBOOKINGFORM_CAPTCHA_ALERT' as label, 'Insert valid verification code') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETBOOKINGFORM_CAPTCHA_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','FREE' as label, 'Free') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'FREE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','SELECT_SEATS' as label, 'Select seats') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'SELECT_SEATS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETMONTHCALENDAR_SLOTS_AVAILABLE' as label, 'Available') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETMONTHCALENDAR_SLOTS_AVAILABLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETMONTHCALENDAR_NO_SLOTS_AVAILABLE' as label, 'Not available') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETMONTHCALENDAR_NO_SLOTS_AVAILABLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETMONTHCALENDAR_BOOK_NOW' as label, 'BOOK NOW') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETMONTHCALENDAR_BOOK_NOW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','GETMONTHCALENDAR_SOLDOUT' as label, 'SOLDOUT') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'GETMONTHCALENDAR_SOLDOUT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CONFIRM_RESERVATION_CONFIRMED' as label, 'Well done!') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CONFIRM_RESERVATION_CONFIRMED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CONFIRM_RESERVATION_CONFIRMED_2' as label, 'Your reservation is successfully confirmed.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CONFIRM_RESERVATION_CONFIRMED_2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CONFIRM_REDIRECT' as label, 'Ok, thanks.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CONFIRM_REDIRECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CANCEL_RESERVATION_CONFIRMED' as label, 'Well done!') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CANCEL_RESERVATION_CONFIRMED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CANCEL_RESERVATION_CONFIRMED_2' as label, 'Your reservation is successfully cancelled.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CANCEL_RESERVATION_CONFIRMED_2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CANCEL_REDIRECT' as label, 'Ok, thanks.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CANCEL_REDIRECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CANCEL_MAIL_ADMIN_SUBJECT' as label, 'A user has cancelled his reservation') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CANCEL_MAIL_ADMIN_SUBJECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CANCEL_MAIL_ADMIN_MESSAGE1' as label, 'A user has cancelled his reservation. Check it in the admin panel: ') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CANCEL_MAIL_ADMIN_MESSAGE1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','CANCEL_MAIL_ADMIN_MESSAGE2' as label, 'click here') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'CANCEL_MAIL_ADMIN_MESSAGE2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_NAME' as label, 'Name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_NAME'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_NAME_ALERT' as label, 'Insert your name') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_NAME_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_SURNAME' as label, 'Surname') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_SURNAME'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_SURNAME_ALERT' as label, 'Insert your surname') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_SURNAME_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_EMAIL' as label, 'Email') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_EMAIL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_EMAIL_ALERT' as label, 'Insert a valid email address') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_EMAIL_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_PHONE' as label, 'Phone') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_PHONE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_PHONE_ALERT' as label, 'Insert your phone') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_PHONE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_MESSAGE' as label, 'Message') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_MESSAGE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_MESSAGE_ALERT' as label, 'Insert a message') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_MESSAGE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_TERMS_AND_CONDITIONS_ALERT' as label, 'You have to accept terms and conditions') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_TERMS_AND_CONDITIONS_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_INVALID_CODE' as label, 'Invalid code') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_INVALID_CODE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_BOOK_NOW' as label, 'BOOK NOW') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_BOOK_NOW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_CLEAR' as label, 'clear') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_CLEAR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_CONFIRM1' as label, 'Thank you for booking online. You\'ll receive an email confirmation at your email address') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_CONFIRM1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_CONFIRM2' as label, 'Thank you for booking online. Check your email box to confirm the reservation.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_CONFIRM2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_CONFIRM3' as label, 'Thank you for booking online. Your reservation will be confirmed by e-mail.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_CONFIRM3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESERVATION_ADDITIONAL_FIELD1' as label, 'Additional field 1') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESERVATION_ADDITIONAL_FIELD1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESERVATION_ADDITIONAL_FIELD1_ALERT' as label, 'Insert additional field 1') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESERVATION_ADDITIONAL_FIELD1_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESERVATION_ADDITIONAL_FIELD2' as label, 'Additional field 2') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESERVATION_ADDITIONAL_FIELD2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESERVATION_ADDITIONAL_FIELD2_ALERT' as label, 'Insert additional field 2') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESERVATION_ADDITIONAL_FIELD2_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESERVATION_ADDITIONAL_FIELD3' as label, 'Additional field 3') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESERVATION_ADDITIONAL_FIELD3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESERVATION_ADDITIONAL_FIELD3_ALERT' as label, 'Insert additional field 3') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESERVATION_ADDITIONAL_FIELD3_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESERVATION_ADDITIONAL_FIELD4' as label, 'Additional field 4') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESERVATION_ADDITIONAL_FIELD4'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESERVATION_ADDITIONAL_FIELD4_ALERT' as label, 'Insert additional field 4') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESERVATION_ADDITIONAL_FIELD4_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','PAYPAL_CONFIRM_CONFIRMED_1' as label, 'Well done!') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'PAYPAL_CONFIRM_CONFIRMED_1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','PAYPAL_CONFIRM_CONFIRMED_2' as label, 'Your reservation is successfully confirmed.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'PAYPAL_CONFIRM_CONFIRMED_2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','PAYPAL_CONFIRM_REDIRECT' as label, 'Ok, thanks.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'PAYPAL_CONFIRM_REDIRECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','EXPIRED_LINK' as label, 'Expired link') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'EXPIRED_LINK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '12','USER_RESERVATION_CANCEL' as label, 'Cancel') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 12 AND text_label = 'USER_RESERVATION_CANCEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '12','USER_RESERVATION_CANCEL_PAID_ALERT' as label, 'You cannot cancel this reservation as the payment was successfull. Contact the administrator for its cancellation.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 12 AND text_label = 'USER_RESERVATION_CANCEL_PAID_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '12','USER_RESERVATION_CANCEL_CONFIRM' as label, 'Are you sure you want to cancel this reservation?') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 12 AND text_label = 'USER_RESERVATION_CANCEL_CONFIRM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '12','USER_RESERVATION_CONFIRM_ALERT' as label, 'You can\'t confirm this reservation, only administrator is able to do it as he has to check your payment first') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 12 AND text_label = 'USER_RESERVATION_CONFIRM_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_WORDPRESS_REGISTRATION_LABEL' as label, 'Allow booking to WP registered users only and allow WP registration through this plugin.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_WORDPRESS_REGISTRATION_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_WORDPRESS_REGISTRATION_SUBLABEL' as label, 'Activating this option people will be able to register to your WP site and only WP registered users will be able to book from your Booking Calendar. You can choose the role for these users when registrating through this plugin.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_WORDPRESS_REGISTRATION_SUBLABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_WORDPRESS_REGISTRATION_NO' as label, 'NO') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_WORDPRESS_REGISTRATION_NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_WORDPRESS_REGISTRATION_YES' as label, 'YES') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_WORDPRESS_REGISTRATION_YES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_USERS_ROLE_LABEL' as label, 'Select the role for users who register to your site through the plugin') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_USERS_ROLE_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '2','CONFIGURATION_REGISTRATION_TEXT_LABEL' as label, 'Choose the text to show in the registration and login form') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 2 AND text_label = 'CONFIGURATION_REGISTRATION_TEXT_LABEL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '13','ADMIN_CONTACT_SUBJECT' as label, 'Subject') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 13 AND text_label = 'ADMIN_CONTACT_SUBJECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '13','ADMIN_CONTACT_MESSAGE' as label, 'Message') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 13 AND text_label = 'ADMIN_CONTACT_MESSAGE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '13','ADMIN_CONTACT_SEND' as label, 'Send') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 13 AND text_label = 'ADMIN_CONTACT_SEND'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '13','ADMIN_CONTACT_SUBJECT_ALERT' as label, 'Insert a subject for the message') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 13 AND text_label = 'ADMIN_CONTACT_SUBJECT_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '13','ADMIN_CONTACT_MESSAGE_ALERT' as label, 'Write a message for the administrator') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 13 AND text_label = 'ADMIN_CONTACT_MESSAGE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_CONTACT_ADMINISTRATOR' as label, 'Contact Administrator') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_CONTACT_ADMINISTRATOR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '10','LEFT_MENU_USER_RESERVATIONS' as label, 'Your reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 10 AND text_label = 'LEFT_MENU_USER_RESERVATIONS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_LOGIN_TAB' as label, 'Login') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_LOGIN_TAB'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_TAB' as label, 'Register') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_TAB'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_LOGIN_USERNAME' as label, 'Username') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_LOGIN_USERNAME'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_LOGIN_PASSWORD' as label, 'Password') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_LOGIN_PASSWORD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_LOGIN_BUTTON' as label, 'Login') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_LOGIN_BUTTON'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_MANDATORY' as label, 'All fields are mandatory') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_MANDATORY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_USERNAME' as label, 'Username') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_USERNAME'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_EMAIL' as label, 'Your email') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_EMAIL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_PASSWORD' as label, 'Your password') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_PASSWORD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_CONFIRM_PASSWORD' as label, 'Confirm password') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_CONFIRM_PASSWORD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_BUTTON' as label, 'Sign up') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_BUTTON'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_RESPONSE_OK_BUTTON' as label, 'OK') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_RESPONSE_OK_BUTTON'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_LOGIN_ERROR_DATA_ALERT' as label, 'Invalid username or password') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_LOGIN_ERROR_DATA_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_LOGIN_EMPTY_DATA_ALERT' as label, 'Insert a valid username and password') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_LOGIN_EMPTY_DATA_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_USERNAME_ALERT' as label, 'Insert a username') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_USERNAME_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_EMAIL_ALERT' as label, 'Insert a valid email address') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_EMAIL_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_PASSWORD_ALERT' as label, 'Insert a password') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_PASSWORD_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','INDEX_REGISTER_CONFIRM_PASSWORD_ALERT' as label, 'Confirm password must match password') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'INDEX_REGISTER_CONFIRM_PASSWORD_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','REGISTERUSER_USER_REGISTERED_ALERT' as label, 'You\'ve been successfully registered') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'REGISTERUSER_USER_REGISTERED_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','REGISTERUSER_USER_EXISTING_ALERT' as label, 'Existing user, please login') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'REGISTERUSER_USER_EXISTING_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_SUBJECT' as label, 'Subject') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_SUBJECT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_MESSAGE' as label, 'Message') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_MESSAGE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_BUTTON' as label, 'Send') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_BUTTON'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_SUBJECT_ALERT' as label, 'Insert a subject for the message') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_SUBJECT_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_MESSAGE_ALERT' as label, 'Insert a message for the user') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_MESSAGE_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_WORDPRESS_USER' as label, 'Wordpress user') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_WORDPRESS_USER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH_FILTER_WP_USER_ALL' as label, 'all') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH_FILTER_WP_USER_ALL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','PAYPAL_CONFIRM_NOT_CONFIRMED_1' as label, 'We\'re sorry') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'PAYPAL_CONFIRM_NOT_CONFIRMED_1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','PAYPAL_CONFIRM_NOT_CONFIRMED_2' as label, 'There\'s been a problem with your payment and your reservation has been cancelled.') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'PAYPAL_CONFIRM_NOT_CONFIRMED_2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_SEARCH_FILTER_WP_USER_NOT_REGISTERED' as label, 'not registered') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_SEARCH_FILTER_WP_USER_NOT_REGISTERED'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '13','ADMIN_CONTACT_TEXT' as label, 'Please use this form to contact the administrator for any need about your reservations') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 13 AND text_label = 'ADMIN_CONTACT_TEXT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_MODAL_TEXT1' as label, 'Message to') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_MODAL_TEXT1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_MODAL_TEXT2' as label, 'Reservation info:') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_MODAL_TEXT2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_TO' as label, 'To (multiple addresses must be separated by comma)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_TO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_CC' as label, 'Cc (multiple addresses must be separated by comma)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_CC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_BCC' as label, 'Bcc (multiple addresses must be separated by comma)') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_BCC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_TO_ALERT' as label, 'You must add at least an email address to send the email') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_TO_ALERT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_MESSAGE_SENT' as label, 'Message successfully sent!') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_MESSAGE_SENT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '6','RESERVATION_USER_CONTACT_MESSAGE_ERROR' as label, 'An error has occurred. Retry') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 6 AND text_label = 'RESERVATION_USER_CONTACT_MESSAGE_ERROR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '13','ADMIN_CONTACT_MESSAGE_SENT' as label, 'Message successfully sent!') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 13 AND text_label = 'ADMIN_CONTACT_MESSAGE_SENT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '13','ADMIN_CONTACT_MESSAGE_ERROR' as label, 'An error has occurred. Retry') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 13 AND text_label = 'ADMIN_CONTACT_MESSAGE_ERROR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_USER_PRICE' as label, 'Price') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_USER_PRICE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_MAIL_ADMIN_PRICE' as label, 'Price') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_MAIL_ADMIN_PRICE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '11','DORESERVATION_ERROR' as label, 'An error occurred. This time slot may be already reserved. Please try again') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 11 AND text_label = 'DORESERVATION_ERROR'
	) LIMIT 1;

	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_SUBTITLE' as label, 'Remember to limit the time period to a maximum of 3 months at once if you have many slots in a day as there is a limit which prevent to insert more than 2000 slots at once to avoid your WP site to crash or block during slots creation') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_SUBTITLE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_texts (page_id, text_label, text_value)
	SELECT * FROM (SELECT '5','SLOT_CUSTOM_TIME_LABEL' as label, 'Even if you want to set a fixed hour (i.e. 6:00), please remember to select minutes too (00) or you\'ll get the error \"Duplicated slots\"') AS tmp
	WHERE NOT EXISTS (
		SELECT text_label FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id = 5 AND text_label = 'SLOT_CUSTOM_TIME_LABEL'
	) LIMIT 1;
	";
	
	
	dbDelta($sql17);
	
	$sql9="
	CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_reservation (
	  reservation_id int(11) NOT NULL AUTO_INCREMENT,
	  slot_id int(11) NOT NULL,
	  reservation_name varchar(255) NOT NULL,
	  reservation_surname varchar(255) NOT NULL,
	  reservation_email varchar(255) NOT NULL,
	  reservation_phone varchar(255) NOT NULL,
	  reservation_message text NOT NULL,
	  reservation_seats int(11) NOT NULL,
	  reservation_field1 text NOT NULL,
	  reservation_field2 text NOT NULL,
	  reservation_field3 text NOT NULL,
	  reservation_field4 text NOT NULL,
	  reservation_confirmed int(11) NOT NULL DEFAULT '0',
	  reservation_cancelled int(11) NOT NULL DEFAULT '0',
	  calendar_id int(11) NOT NULL,
	  post_id int(11) NOT NULL,
	  admin_confirmed_cancelled int(11) NOT NULL DEFAULT '0',
	  wordpress_user_id int(11) NOT NULL,
	  PRIMARY KEY  (reservation_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
	";
	dbDelta($sql9);
	$sql10="
	CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_slots (
	  slot_id int(11) NOT NULL AUTO_INCREMENT,
	  slot_special_text varchar(700) NOT NULL,
	  slot_special_mode int(11) NOT NULL,
	  slot_date date NOT NULL,
	  slot_time_from time NOT NULL,
	  slot_time_to time NOT NULL,
	  slot_price double NOT NULL,
	  slot_av INT NOT NULL,
	  slot_av_max INT NOT NULL,
	  slot_active int(11) NOT NULL,
	  calendar_id int(11) NOT NULL,
	  PRIMARY KEY  (slot_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
	";
	dbDelta($sql10);
	$sql11="
	CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_timezones (
	  timezone_id int(11) NOT NULL AUTO_INCREMENT,
	  timezone_name varchar(255) NOT NULL,
	  timezone_value varchar(255) NOT NULL,
	  PRIMARY KEY  (timezone_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8  ;
	";
	dbDelta($sql11);
	$sql12="
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Kwajalein GMT -12.00', 'Kwajalein') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Kwajalein GMT -12.00' AND timezone_value = 'Kwajalein'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Pacific/Midway GMT -11.00', 'Pacific/Midway') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Pacific/Midway GMT -11.00' AND timezone_value = 'Pacific/Midway'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Pacific/Honolulu GMT -10.00', 'Pacific/Honolulu') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Pacific/Honolulu GMT -10.00' AND timezone_value = 'Pacific/Honolulu'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/Anchorage GMT -9.00', 'America/Anchorage') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/Anchorage GMT -9.00' AND timezone_value = 'America/Anchorage'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/Los Angeles GMT -8.00', 'America/Los_Angeles') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/Los Angeles GMT -8.00' AND timezone_value = 'America/Los_Angeles'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/Denver GMT -7.00', 'America/Denver') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/Denver GMT -7.00' AND timezone_value = 'America/Denver'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/Tegucigalpa GMT -6.00', 'America/Tegucigalpa') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/Tegucigalpa GMT -6.00' AND timezone_value = 'America/Tegucigalpa'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/New York GMT -5.00', 'America/New_York') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/New York GMT -5.00' AND timezone_value = 'America/New_York'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/Caracas GMT -4.30', 'America/Caracas') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/Caracas GMT -4.30' AND timezone_value = 'America/Caracas'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/Halifax GMT -4.00', 'America/Halifax') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/Halifax GMT -4.00' AND timezone_value = 'America/Halifax'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/St Johns GMT -3.30', 'America/St_Johns') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/St Johns GMT -3.30' AND timezone_value = 'America/St_Johns'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/Argentina/Buenos Aires GMT -3.00', 'America/Argentina/Buenos_Aires') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/Argentina/Buenos Aires GMT -3.00' AND timezone_value = 'America/Argentina/Buenos_Aires'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'America/Sao Paulo GMT -3.00', 'America/Sao_Paulo') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'America/Sao Paulo GMT -3.00' AND timezone_value = 'America/Sao_Paulo'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Atlantic/South_Georgia GMT -2.00', 'Atlantic/South Georgia') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Atlantic/South_Georgia GMT -2.00' AND timezone_value = 'Atlantic/South Georgia'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Atlantic/Azores GMT -1.00', 'Atlantic/Azores') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Atlantic/Azores GMT -1.00' AND timezone_value = 'Atlantic/Azores'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Europe/Dublin GMT 0', 'Europe/Dublin') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Europe/Dublin GMT 0' AND timezone_value = 'Europe/Dublin'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Europe/Belgrade GMT 1.00', 'Europe/Belgrade') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Europe/Belgrade GMT 1.00' AND timezone_value = 'Europe/Belgrade'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Europe/Athens GMT 2.00', 'Europe/Athens') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Europe/Athens GMT 2.00' AND timezone_value = 'Europe/Athens'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Kuwait GMT 3.00', 'Asia/Kuwait') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Kuwait GMT 3.00' AND timezone_value = 'Asia/Kuwait'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Tehran GMT 3.30', 'Asia/Tehran') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Tehran GMT 3.30' AND timezone_value = 'Asia/Tehran'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Muscat GMT 4.00', 'Asia/Muscat') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Muscat GMT 4.00' AND timezone_value = 'Asia/Muscat'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Yekaterinburg GMT 5.00', 'Asia/Yekaterinburg') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Yekaterinburg GMT 5.00' AND timezone_value = 'Asia/Yekaterinburg'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Kolkata GMT 5.30', 'Asia/Kolkata') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Kolkata GMT 5.30' AND timezone_value = 'Asia/Kolkata'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Katmandu GMT 5.45', 'Asia/Katmandu') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Katmandu GMT 5.45' AND timezone_value = 'Asia/Katmandu'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Dhaka GMT 6.00', 'Asia/Dhaka') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Dhaka GMT 6.00' AND timezone_value = 'Asia/Dhaka'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Rangoon GMT 6.30', 'Asia/Rangoon') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Rangoon GMT 6.30' AND timezone_value = 'Asia/Rangoon'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Krasnoyarsk GMT 7.00', 'Asia/Krasnoyarsk') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Krasnoyarsk GMT 7.00' AND timezone_value = 'Asia/Krasnoyarsk'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Brunei GMT 8.00', 'Asia/Brunei') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Brunei GMT 8.00' AND timezone_value = 'Asia/Brunei'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Seoul GMT 9.00', 'Asia/Seoul') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Seoul GMT 9.00' AND timezone_value = 'Asia/Seoul'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Australia/Darwin GMT 9.30', 'Australia/Darwin') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Australia/Darwin GMT 9.30' AND timezone_value = 'Australia/Darwin'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Australia/Canberra GMT 10.00', 'Australia/Canberra') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Australia/Canberra GMT 10.00' AND timezone_value = 'Australia/Canberra'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Asia/Magadan GMT 11.00', 'Asia/Magadan') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Asia/Magadan GMT 11.00' AND timezone_value = 'Asia/Magadan'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Pacific/Fiji GMT 12.00', 'Pacific/Fiji') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Pacific/Fiji GMT 12.00' AND timezone_value = 'Pacific/Fiji'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_timezones (timezone_name, timezone_value)
	SELECT * FROM (SELECT  'Pacific/Tongatapu GMT 13.00', 'Pacific/Tongatapu') AS tmp
	WHERE NOT EXISTS (
		SELECT timezone_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones WHERE timezone_name = 'Pacific/Tongatapu GMT 13.00' AND timezone_value = 'Pacific/Tongatapu'
	) LIMIT 1;
	
	";
	
	dbDelta($sql12);
	
	$sql13="
	CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (
	  currency_id int(11) unsigned NOT NULL AUTO_INCREMENT,
	  currency_name varchar(255) NOT NULL DEFAULT '',
	  currency_code char(3) NOT NULL DEFAULT '',
	  PRIMARY KEY  (currency_id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	";
	
	dbDelta($sql13);
	$sql14="
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Australian Dollar','AUD') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Australian Dollar' AND currency_code = 'AUD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Canadian Dollar','CAD') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Canadian Dollar' AND currency_code = 'CAD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Czech Koruna','CZK') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Czech Koruna' AND currency_code = 'CZK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Danish Krone','DKK') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Danish Krone' AND currency_code = 'DKK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Euro','EUR') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Euro' AND currency_code = 'EUR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Hong Kong Dollar','HKD') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Hong Kong Dollar' AND currency_code = 'HKD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Hungarian Forint','HUF') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Hungarian Forint' AND currency_code = 'HUF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Israeli New Sheqel','ILS') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Israeli New Sheqel' AND currency_code = 'ILS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Japanese Yen','JPY') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Japanese Yen' AND currency_code = 'JPY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Mexican Peso','MXN') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Mexican Peso' AND currency_code = 'MXN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT 'Norwegian Krone','NOK') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Norwegian Krone' AND currency_code = 'NOK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'New Zealand Dollar','NZD') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'New Zealand Dollar' AND currency_code = 'NZD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Polish Zloty','PLN') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Polish Zloty' AND currency_code = 'PLN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Pound Sterling','GBP') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Pound Sterling' AND currency_code = 'GBP'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Singapore Dollar','SGD') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Singapore Dollar' AND currency_code = 'SGD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Swedish Krona','SEK') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Swedish Krona' AND currency_code = 'SEK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Swiss Franc','CHF') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Swiss Franc' AND currency_code = 'CHF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'U.S. Dollar','USD') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'U.S. Dollar' AND currency_code = 'USD'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency (currency_name, currency_code)
	SELECT * FROM (SELECT  'Brazilian Real', 'BRL') AS tmp
	WHERE NOT EXISTS (
		SELECT currency_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency WHERE currency_name = 'Brazilian Real' AND currency_code = 'BRL'
	) LIMIT 1; 
		
		
		
	";
	dbDelta($sql14);
	
	$sql15="
	CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (
	  locale_id int(11) unsigned NOT NULL AUTO_INCREMENT,
	  locale_country varchar(255) NOT NULL DEFAULT '',
	  locale_code char(3) NOT NULL DEFAULT '',
	  PRIMARY KEY  (locale_id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	";
	dbDelta($sql15);
	
	$sql16="
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'AFGHANISTAN','AF') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'AFGHANISTAN' AND locale_code = 'AF'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ALAND ISLANDS','AX') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ALAND ISLANDS' AND locale_code = 'AX'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ALBANIA','AL') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ALBANIA' AND locale_code = 'AL'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ALGERIA','DZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ALGERIA' AND locale_code = 'DZ'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'AMERICAN SAMOA','AS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'AMERICAN SAMOA' AND locale_code = 'AS'
	) LIMIT 1; 
	
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ANDORRA','AD') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ANDORRA' AND locale_code = 'AD'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ANGOLA','AO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ANGOLA' AND locale_code = 'AO'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ANGUILLA','AI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ANGUILLA' AND locale_code = 'AI'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ANTARCTICA','AQ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ANTARCTICA' AND locale_code = 'AQ'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ANTIGUA AND BARBUDA','AG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ANTIGUA AND BARBUDA' AND locale_code = 'AG'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ARGENTINA','AR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ARGENTINA' AND locale_code = 'AR'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ARMENIA','AM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ARMENIA' AND locale_code = 'AM'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ARUBA','AW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ARUBA' AND locale_code = 'AW'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'AUSTRALIA','AU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'AUSTRALIA' AND locale_code = 'AU'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'AUSTRIA','AT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'AUSTRIA' AND locale_code = 'AT'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'AZERBAIJAN','AZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'AZERBAIJAN' AND locale_code = 'AZ'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BAHAMAS','BS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BAHAMAS' AND locale_code = 'BS'
	) LIMIT 1; 
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BAHRAIN','BH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BAHRAIN' AND locale_code = 'BH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BANGLADESH','BD') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BANGLADESH' AND locale_code = 'BD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BARBADOS','BB') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BARBADOS' AND locale_code = 'BB'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BELARUS','BY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BELARUS' AND locale_code = 'BY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BELGIUM','BE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BELGIUM' AND locale_code = 'BE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BELIZE','BZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BELIZE' AND locale_code = 'BZ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BENIN','BJ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BENIN' AND locale_code = 'BJ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BERMUDA','BM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BERMUDA' AND locale_code = 'BM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BHUTAN','BT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BHUTAN' AND locale_code = 'BT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BOLIVIA','BO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BOLIVIA' AND locale_code = 'BO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BOSNIA AND HERZEGOVINA','BA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BOSNIA AND HERZEGOVINA' AND locale_code = 'BA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BOTSWANA','BW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BOTSWANA' AND locale_code = 'BW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BOUVET ISLAND','BV') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BOUVET ISLAND' AND locale_code = 'BV'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BRAZIL','BR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BRAZIL' AND locale_code = 'BR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BRITISH INDIAN OCEAN TERRITORY','IO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BRITISH INDIAN OCEAN TERRITORY' AND locale_code = 'IO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BRUNEI DARUSSALAM','BN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BRUNEI DARUSSALAM' AND locale_code = 'BN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BULGARIA','BG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BULGARIA' AND locale_code = 'BG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BURKINA FASO','BF') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BURKINA FASO' AND locale_code = 'BF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'BURUNDI','BI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'BURUNDI' AND locale_code = 'BI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CAMBODIA','KH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CAMBODIA' AND locale_code = 'KH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CAMEROON','CM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CAMEROON' AND locale_code = 'CM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CANADA','CA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CANADA' AND locale_code = 'CA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CAPE VERDE','CV') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CAPE VERDE' AND locale_code = 'CV'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CAYMAN ISLANDS','KY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CAYMAN ISLANDS' AND locale_code = 'KY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CENTRAL AFRICAN REPUBLIC','CF') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CENTRAL AFRICAN REPUBLIC' AND locale_code = 'CF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CHAD','TD') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CHAD' AND locale_code = 'TD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CHILE','CL') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CHILE' AND locale_code = 'CL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CHINA','CN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CHINA' AND locale_code = 'CN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CHRISTMAS ISLAND','CX') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CHRISTMAS ISLAND' AND locale_code = 'CX'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'COCOS (KEELING) ISLANDS','CC') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'COCOS (KEELING) ISLANDS' AND locale_code = 'CC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'COLOMBIA','CO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'COLOMBIA' AND locale_code = 'CO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'COMOROS','KM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'COMOROS' AND locale_code = 'KM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CONGO','CG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CONGO' AND locale_code = 'CG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CONGO, THE DEMOCRATIC REPUBLIC OF THE','CD') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CONGO, THE DEMOCRATIC REPUBLIC OF THE' AND locale_code = 'CD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'COOK ISLANDS','CK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'COOK ISLANDS' AND locale_code = 'CK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'COSTA RICA','CR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'COSTA RICA' AND locale_code = 'CR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'COTE D\'IVOIRE','CI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'COTE D\'IVOIRE' AND locale_code = 'CI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CROATIA','HR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CROATIA' AND locale_code = 'HR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CUBA','CU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CUBA' AND locale_code = 'CU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CYPRUS','CY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CYPRUS' AND locale_code = 'CY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'CZECH REPUBLIC','CZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'CZECH REPUBLIC' AND locale_code = 'CZ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'DENMARK','DK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'DENMARK' AND locale_code = 'DK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'DJIBOUTI','DJ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'DJIBOUTI' AND locale_code = 'DJ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'DOMINICA','DM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'DOMINICA' AND locale_code = 'DM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'DOMINICAN REPUBLIC','DO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'DOMINICAN REPUBLIC' AND locale_code = 'DO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ECUADOR','EC') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ECUADOR' AND locale_code = 'EC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'EGYPT','EG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'EGYPT' AND locale_code = 'EG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'EL SALVADOR','SV') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'EL SALVADOR' AND locale_code = 'SV'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'EQUATORIAL GUINEA','GQ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'EQUATORIAL GUINEA' AND locale_code = 'GQ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ERITREA','ER') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ERITREA' AND locale_code = 'ER'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ESTONIA','EE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ESTONIA' AND locale_code = 'EE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ETHIOPIA','ET') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ETHIOPIA' AND locale_code = 'ET'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'FALKLAND ISLANDS (MALVINAS)','FK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'FALKLAND ISLANDS (MALVINAS)' AND locale_code = 'FK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'FAROE ISLANDS','FO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'FAROE ISLANDS' AND locale_code = 'FO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'FIJI','FJ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'FIJI' AND locale_code = 'FJ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'FINLAND','FI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'FINLAND' AND locale_code = 'FI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'FRANCE','FR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'FRANCE' AND locale_code = 'FR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'FRENCH GUIANA','GF') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'FRENCH GUIANA' AND locale_code = 'GF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'FRENCH POLYNESIA','PF') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'FRENCH POLYNESIA' AND locale_code = 'PF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'FRENCH SOUTHERN TERRITORIES','TF') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'FRENCH SOUTHERN TERRITORIES' AND locale_code = 'TF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GABON','GA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GABON' AND locale_code = 'GA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GAMBIA','GM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GAMBIA' AND locale_code = 'GM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GEORGIA','GE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GEORGIA' AND locale_code = 'GE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GERMANY','DE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GERMANY' AND locale_code = 'DE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GHANA','GH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GHANA' AND locale_code = 'GH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GIBRALTAR','GI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GIBRALTAR' AND locale_code = 'GI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GREECE','GR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GREECE' AND locale_code = 'GR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GREENLAND','GL') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GREENLAND' AND locale_code = 'GL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GRENADA','GD') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GRENADA' AND locale_code = 'GD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GUADELOUPE','GP') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GUADELOUPE' AND locale_code = 'GP'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GUAM','GU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GUAM' AND locale_code = 'GU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GUATEMALA','GT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GUATEMALA' AND locale_code = 'GT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GUERNSEY','GG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GUERNSEY' AND locale_code = 'GG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GUINEA','GN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GUINEA' AND locale_code = 'GN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GUINEA-BISSAU','GW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GUINEA-BISSAU' AND locale_code = 'GW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'GUYANA','GY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'GUYANA' AND locale_code = 'GY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'HAITI','HT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'HAITI' AND locale_code = 'HT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'HEARD ISLAND AND MCDONALD ISLANDS','HM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'HEARD ISLAND AND MCDONALD ISLANDS' AND locale_code = 'HM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'HOLY SEE (VATICAN CITY STATE)','VA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'HOLY SEE (VATICAN CITY STATE)' AND locale_code = 'VA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'HONDURAS','HN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'HONDURAS' AND locale_code = 'HN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'HONG KONG','HK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'HONG KONG' AND locale_code = 'HK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'HUNGARY','HU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'HUNGARY' AND locale_code = 'HU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ICELAND','IS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ICELAND' AND locale_code = 'IS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'INDIA','IN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'INDIA' AND locale_code = 'IN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'INDONESIA','ID') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'INDONESIA' AND locale_code = 'ID'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'IRAN, ISLAMIC REPUBLIC OF','IR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'IRAN, ISLAMIC REPUBLIC OF' AND locale_code = 'IR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'IRAQ','IQ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'IRAQ' AND locale_code = 'IQ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'IRELAND','IE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'IRELAND' AND locale_code = 'IE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ISLE OF MAN','IM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ISLE OF MAN' AND locale_code = 'IM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ISRAEL','IL') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ISRAEL' AND locale_code = 'IL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ITALY','IT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ITALY' AND locale_code = 'IT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'JAMAICA','JM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'JAMAICA' AND locale_code = 'JM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'JAPAN','JP') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'JAPAN' AND locale_code = 'JP'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'JERSEY','JE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'JERSEY' AND locale_code = 'JE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'JORDAN','JO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'JORDAN' AND locale_code = 'JO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'KAZAKHSTAN','KZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'KAZAKHSTAN' AND locale_code = 'KZ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'KENYA','KE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'KENYA' AND locale_code = 'KE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'KIRIBATI','KI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'KIRIBATI' AND locale_code = 'KI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','KP') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF' AND locale_code = 'KP'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'KOREA, REPUBLIC OF','KR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'KOREA, REPUBLIC OF' AND locale_code = 'KR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'KUWAIT','KW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'KUWAIT' AND locale_code = 'KW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'KYRGYZSTAN','KG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'KYRGYZSTAN' AND locale_code = 'KG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LAO PEOPLE\'S DEMOCRATIC REPUBLIC','LA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC' AND locale_code = 'LA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LATVIA','LV') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LATVIA' AND locale_code = 'LV'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LEBANON','LB') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LEBANON' AND locale_code = 'LB'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LESOTHO','LS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LESOTHO' AND locale_code = 'LS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LIBERIA','LR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LIBERIA' AND locale_code = 'LR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LIBYAN ARAB JAMAHIRIYA','LY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LIBYAN ARAB JAMAHIRIYA' AND locale_code = 'LY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LIECHTENSTEIN','LI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LIECHTENSTEIN' AND locale_code = 'LI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LITHUANIA','LT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LITHUANIA' AND locale_code = 'LT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'LUXEMBOURG','LU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'LUXEMBOURG' AND locale_code = 'LU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MACAO','MO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MACAO' AND locale_code = 'MO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','MK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF' AND locale_code = 'MK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MADAGASCAR','MG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MADAGASCAR' AND locale_code = 'MG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MALAWI','MW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MALAWI' AND locale_code = 'MW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MALAYSIA','MY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MALAYSIA' AND locale_code = 'MY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MALDIVES','MV') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MALDIVES' AND locale_code = 'MV'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MALI','ML') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MALI' AND locale_code = 'ML'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MALTA','MT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MALTA' AND locale_code = 'MT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MARSHALL ISLANDS','MH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MARSHALL ISLANDS' AND locale_code = 'MH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MARTINIQUE','MQ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MARTINIQUE' AND locale_code = 'MQ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MAURITANIA','MR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MAURITANIA' AND locale_code = 'MR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MAURITIUS','MU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MAURITIUS' AND locale_code = 'MU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MAYOTTE','YT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MAYOTTE' AND locale_code = 'YT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MEXICO','MX') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MEXICO' AND locale_code = 'MX'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MICRONESIA, FEDERATED STATES OF','FM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MICRONESIA, FEDERATED STATES OF' AND locale_code = 'FM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MOLDOVA, REPUBLIC OF','MD') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MOLDOVA, REPUBLIC OF' AND locale_code = 'MD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MONACO','MC') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MONACO' AND locale_code = 'MC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MONGOLIA','MN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MONGOLIA' AND locale_code = 'MN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MONTSERRAT','MS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MONTSERRAT' AND locale_code = 'MS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MOROCCO','MA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MOROCCO' AND locale_code = 'MA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MOZAMBIQUE','MZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MOZAMBIQUE' AND locale_code = 'MZ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'MYANMAR','MM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'MYANMAR' AND locale_code = 'MM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NAMIBIA','NA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NAMIBIA' AND locale_code = 'NA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NAURU','NR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NAURU' AND locale_code = 'NR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NEPAL','NP') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NEPAL' AND locale_code = 'NP'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NETHERLANDS','NL') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NETHERLANDS' AND locale_code = 'NL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NETHERLANDS ANTILLES','AN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NETHERLANDS ANTILLES' AND locale_code = 'AN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NEW CALEDONIA','NC') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NEW CALEDONIA' AND locale_code = 'NC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NEW ZEALAND','NZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NEW ZEALAND' AND locale_code = 'NZ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NICARAGUA','NI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NICARAGUA' AND locale_code = 'NI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NIGER','NE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NIGER' AND locale_code = 'NE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NIGERIA','NG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NIGERIA' AND locale_code = 'NG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NIUE','NU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NIUE' AND locale_code = 'NU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NORFOLK ISLAND','NF') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NORFOLK ISLAND' AND locale_code = 'NF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NORTHERN MARIANA ISLANDS','MP') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NORTHERN MARIANA ISLANDS' AND locale_code = 'MP'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'NORWAY','NO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'NORWAY' AND locale_code = 'NO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'OMAN','OM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'OMAN' AND locale_code = 'OM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PAKISTAN','PK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PAKISTAN' AND locale_code = 'PK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PALAU','PW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PALAU' AND locale_code = 'PW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PALESTINIAN TERRITORY, OCCUPIED','PS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PALESTINIAN TERRITORY, OCCUPIED' AND locale_code = 'PS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PANAMA','PA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PANAMA' AND locale_code = 'PA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PAPUA NEW GUINEA','PG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PAPUA NEW GUINEA' AND locale_code = 'PG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PARAGUAY','PY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PARAGUAY' AND locale_code = 'PY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PERU','PE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PERU' AND locale_code = 'PE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PHILIPPINES','PH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PHILIPPINES' AND locale_code = 'PH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PITCAIRN','PN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PITCAIRN' AND locale_code = 'PN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'POLAND','PL') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'POLAND' AND locale_code = 'PL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PORTUGAL','PT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PORTUGAL' AND locale_code = 'PT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'PUERTO RICO','PR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'PUERTO RICO' AND locale_code = 'PR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'QATAR','QA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'QATAR' AND locale_code = 'QA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'REUNION','RE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'REUNION' AND locale_code = 'RE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ROMANIA','RO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ROMANIA' AND locale_code = 'RO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'RUSSIAN FEDERATION','RU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'RUSSIAN FEDERATION' AND locale_code = 'RU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'RWANDA','RW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'RWANDA' AND locale_code = 'RW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAINT HELENA','SH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAINT HELENA' AND locale_code = 'SH'
	) LIMIT 1;
		
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAINT KITTS AND NEVIS','KN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAINT KITTS AND NEVIS' AND locale_code = 'KN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAINT LUCIA','LC') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAINT LUCIA' AND locale_code = 'LC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAINT PIERRE AND MIQUELON','PM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAINT PIERRE AND MIQUELON' AND locale_code = 'PM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAINT VINCENT AND THE GRENADINES','VC') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAINT VINCENT AND THE GRENADINES' AND locale_code = 'VC'
	) LIMIT 1;
		
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAMOA','WS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAMOA' AND locale_code = 'WS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAN MARINO','SM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAN MARINO' AND locale_code = 'SM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAO TOME AND PRINCIPE','ST') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAO TOME AND PRINCIPE' AND locale_code = 'ST'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SAUDI ARABIA','SA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SAUDI ARABIA' AND locale_code = 'SA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SENEGAL','SN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SENEGAL' AND locale_code = 'SN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SERBIA AND MONTENEGRO','CS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SERBIA AND MONTENEGRO' AND locale_code = 'CS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SEYCHELLES','SC') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SEYCHELLES' AND locale_code = 'SC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SIERRA LEONE','SL') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SIERRA LEONE' AND locale_code = 'SL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SINGAPORE','SG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SINGAPORE' AND locale_code = 'SG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SLOVAKIA','SK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SLOVAKIA' AND locale_code = 'SK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SLOVENIA','SI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SLOVENIA' AND locale_code = 'SI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SOLOMON ISLANDS','SB') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SOLOMON ISLANDS' AND locale_code = 'SB'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SOMALIA','SO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SOMALIA' AND locale_code = 'SO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SOUTH AFRICA','ZA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SOUTH AFRICA' AND locale_code = 'ZA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','GS') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS' AND locale_code = 'GS'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SPAIN','ES') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SPAIN' AND locale_code = 'ES'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SRI LANKA','LK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SRI LANKA' AND locale_code = 'LK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SUDAN','SD') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SUDAN' AND locale_code = 'SD'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SURINAME','SR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SURINAME' AND locale_code = 'SR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SVALBARD AND JAN MAYEN','SJ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SVALBARD AND JAN MAYEN' AND locale_code = 'SJ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SWAZILAND','SZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SWAZILAND' AND locale_code = 'SZ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SWEDEN','SE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SWEDEN' AND locale_code = 'SE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SWITZERLAND','CH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SWITZERLAND' AND locale_code = 'CH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'SYRIAN ARAB REPUBLIC','SY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'SYRIAN ARAB REPUBLIC' AND locale_code = 'SY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TAIWAN, PROVINCE OF CHINA','TW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TAIWAN, PROVINCE OF CHINA' AND locale_code = 'TW'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TAJIKISTAN','TJ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TAJIKISTAN' AND locale_code = 'TJ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TANZANIA, UNITED REPUBLIC OF','TZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TANZANIA, UNITED REPUBLIC OF' AND locale_code = 'TZ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'THAILAND','TH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'THAILAND' AND locale_code = 'TH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TIMOR-LESTE','TL') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TIMOR-LESTE' AND locale_code = 'TL'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TOGO','TG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TOGO' AND locale_code = 'TG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TOKELAU','TK') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TOKELAU' AND locale_code = 'TK'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TONGA','TO') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TONGA' AND locale_code = 'TO'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TRINIDAD AND TOBAGO','TT') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TRINIDAD AND TOBAGO' AND locale_code = 'TT'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TUNISIA','TN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TUNISIA' AND locale_code = 'TN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TURKEY','TR') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TURKEY' AND locale_code = 'TR'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TURKMENISTAN','TM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TURKMENISTAN' AND locale_code = 'TM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TURKS AND CAICOS ISLANDS','TC') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TURKS AND CAICOS ISLANDS' AND locale_code = 'TC'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'TUVALU','TV') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'TUVALU' AND locale_code = 'TV'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'UGANDA','UG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'UGANDA' AND locale_code = 'UG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'UKRAINE','UA') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'UKRAINE' AND locale_code = 'UA'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'UNITED ARAB EMIRATES','AE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'UNITED ARAB EMIRATES' AND locale_code = 'AE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'UNITED KINGDOM','GB') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'UNITED KINGDOM' AND locale_code = 'GB'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'UNITED STATES','US') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'UNITED STATES' AND locale_code = 'US'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'UNITED STATES MINOR OUTLYING ISLANDS','UM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'UNITED STATES MINOR OUTLYING ISLANDS' AND locale_code = 'UM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'URUGUAY','UY') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'URUGUAY' AND locale_code = 'UY'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'UZBEKISTAN','UZ') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'UZBEKISTAN' AND locale_code = 'UZ'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'VANUATU','VU') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'VANUATU' AND locale_code = 'VU'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'VENEZUELA','VE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'VENEZUELA' AND locale_code = 'VE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'VIET NAM','VN') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'VIET NAM' AND locale_code = 'VN'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'VIRGIN ISLANDS, BRITISH','VG') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'VIRGIN ISLANDS, BRITISH' AND locale_code = 'VG'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'VIRGIN ISLANDS, U.S.','VI') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'VIRGIN ISLANDS, U.S.' AND locale_code = 'VI'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'WALLIS AND FUTUNA','WF') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'WALLIS AND FUTUNA' AND locale_code = 'WF'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'WESTERN SAHARA','EH') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'WESTERN SAHARA' AND locale_code = 'EH'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'YEMEN','YE') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'YEMEN' AND locale_code = 'YE'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ZAMBIA','ZM') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ZAMBIA' AND locale_code = 'ZM'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale (locale_country, locale_code)
	SELECT * FROM (SELECT  'ZIMBABWE','ZW') AS tmp
	WHERE NOT EXISTS (
		SELECT locale_country FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale WHERE locale_country = 'ZIMBABWE' AND locale_code = 'ZW'
	) LIMIT 1;
	
	";
	dbDelta($sql16);
	
	$sql17="CREATE TABLE ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (
	  type_id int(11) unsigned NOT NULL AUTO_INCREMENT,
	  reservation_field_name varchar(255) NOT NULL DEFAULT '',
	  reservation_field_type varchar(255) NOT NULL DEFAULT '',
	  PRIMARY KEY  (type_id)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	dbDelta($sql17);
	
	$sql18="
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_name', 'text') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_name'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_surname', 'text') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_surname'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_email', 'text') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_email'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_phone', 'text') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_phone'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_message', 'textarea') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_message'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_field1', 'text') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_field1'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_field2', 'text') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_field2'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_field3', 'text') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_field3'
	) LIMIT 1;
	
	INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_fields_types (reservation_field_name, reservation_field_type)
	SELECT * FROM (SELECT 'reservation_field4', 'text') AS tmp
	WHERE NOT EXISTS (
		SELECT reservation_field_name FROM ".$wpdb->base_prefix.$blog_prefix."booking_fields_types WHERE reservation_field_name = 'reservation_field4'
	) LIMIT 1;

	";
	dbDelta($sql18);
}
//delete plugin

function booking_calendar_on_uninstall()
{
	global $wpdb;
	global $blog_id;
	$current_blog = $blog_id;
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    check_admin_referer( 'bulk-plugins' );

    // Important: Check if the file is the one
    // that was registered during the uninstall hook.
    if ( __FILE__ != WP_UNINSTALL_PLUGIN )
		
		if (function_exists('is_multisite') && is_multisite()) {
			$blogsQry =  $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."blogs");
			for($i=0;$i<count($blogsQry);$i++) {
				$blog_id = $blogsQry[$i]->blog_id;
				$blog_prefix=$blog_id."_";
				if($blog_id==1) {
					$blog_prefix = '';
				}
				
				$sql1="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_calendars;";
				$sql2="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_config;";
				$sql3="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_emails;";
				$sql4="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_fields_types;";
				$sql5="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_holidays;";
				$sql6="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency;";
				$sql7="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale;";
				$sql8="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_reservation;";
				$sql9="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_slots;";
				$sql10="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_timezones;";
				$sql11="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_categories;";
				$sql12="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_texts;";
				$sql13="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_pages;";
				$wpdb->query($sql1);
				$wpdb->query($sql2);
				$wpdb->query($sql3);
				$wpdb->query($sql4);
				$wpdb->query($sql5);
				$wpdb->query($sql6);
				$wpdb->query($sql7);
				$wpdb->query($sql8);
				$wpdb->query($sql9);
				$wpdb->query($sql10);
				$wpdb->query($sql11);
				$wpdb->query($sql12);
				$wpdb->query($sql13);
				switch_to_blog($blog_id);
            	delete_option('wbc_version');
				delete_option('wbc_show_text_update_admin');
				delete_option('wbc_show_text_update_public');
			}
			
			switch_to_blog($current_blog);
			//restore_current_blog();
		} else {
			$sql1="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_calendars;";
			$sql2="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_config;";
			$sql3="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_emails;";
			$sql4="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_fields_types;";
			$sql5="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_holidays;";
			$sql6="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_paypal_currency;";
			$sql7="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_paypal_locale;";
			$sql8="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_reservation;";
			$sql9="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_slots;";
			$sql10="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_timezones;";
			$sql11="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_categories;";
			$sql12="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_texts;";
			$sql13="DROP TABLE IF EXISTS ".$wpdb->base_prefix."booking_pages;";
			$wpdb->query($sql1);
			$wpdb->query($sql2);
			$wpdb->query($sql3);
			$wpdb->query($sql4);
			$wpdb->query($sql5);
			$wpdb->query($sql6);
			$wpdb->query($sql7);
			$wpdb->query($sql8);
			$wpdb->query($sql9);
			$wpdb->query($sql10);
			$wpdb->query($sql11);
			$wpdb->query($sql12);
			$wpdb->query($sql13);
			delete_option('wbc_version');
			delete_option('wbc_show_text_update_admin');
			delete_option('wbc_show_text_update_public');
		}
		delete_option('wbc_version');
		delete_option('wbc_show_text_update_admin');
		delete_option('wbc_show_text_update_public');
        return;
		

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
}



function booking_calendar_on_activation($networkwide) {
	global $wpdb;
	global $blog_id;
	$current_blog = $blog_id;
	
	
	
	
	//cycle on blogs table
	if (function_exists('is_multisite') && is_multisite()) {
		
		if($networkwide) {
			$blogsQry =  $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."blogs");
		} else {
			$blogsQry =  $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."blogs WHERE blog_id=".$blog_id);
		}
		for($i=0;$i<count($blogsQry);$i++) {
			$blog_id=$blogsQry[$i]->blog_id;
			$blog_prefix = $blogsQry[$i]->blog_id."_";
			if($blog_id==1) {
				$blog_prefix='';
			}
			switch_to_blog($blog_id);
			$current_version = get_option('wbc_version');
			if($current_version == '') {
				$current_version = "1.0.0";
			}
			$flag = 0;
			if($current_version != '3.0.0' && $current_version != '3.0.1' && $current_version != '3.0.2' && $current_version != '3.0.3' && $current_version != '3.0.4' && $current_version != '3.0.5' && $current_version != '3.0.6' && $current_version != '3.0.7' && $current_version != '4.0.0' && $current_version != '4.0.1' && $current_version != '4.0.2' && $current_version != '4.0.3' && $current_version != '4.0.4' && $current_version != '4.0.5' && $current_version != '4.0.6' && $current_version != '4.0.7' && $current_version != '4.0.8' && $current_version != '4.0.9' && $current_version != '4.1.0' && $current_version != '4.1.1' && $current_version != '4.1.2') {
			   $flag = 1;
			}
			//creates record in wp-option table
			add_option('wbc_version','4.1.2');
			$wbc_show_text_update_admin = get_option('wbc_show_text_update_admin');
			if($wbc_show_text_update_admin == '') {
				add_option('wbc_show_text_update_admin',$flag);
			} else {
				update_option('wbc_show_text_update_admin',$flag);
			}
			
			$wbc_show_text_update_public = get_option('wbc_show_text_update_public');
			if($wbc_show_text_update_public == '') {
				add_option('wbc_show_text_update_public',$flag);
			} else {
				update_option('wbc_show_text_update_public',$flag);
			}
			booking_calendar_install_db($blog_prefix);
		}
		
		switch_to_blog($current_blog);
			
	} else {
		$blog_prefix='';
		//creates record in wp-option table
		$flag = 0;
		if($current_version != '3.0.0' && $current_version != '3.0.1' && $current_version != '3.0.2' && $current_version != '3.0.3' && $current_version != '3.0.4' && $current_version != '3.0.5' && $current_version != '3.0.6' && $current_version != '3.0.7' && $current_version != '4.0.1' && $current_version != '4.0.2' && $current_version != '4.0.3' && $current_version != '4.0.4' && $current_version != '4.0.5' && $current_version != '4.0.6' && $current_version != '4.0.7' && $current_version != '4.0.8' && $current_version != '4.0.9' && $current_version != '4.1.0' && $current_version != '4.1.1' && $current_version != '4.1.2') {
		   $flag = 1;
		}
		add_option('wbc_version','4.1.2');
		$wbc_show_text_update_admin = get_option('wbc_show_text_update_admin');
		if($wbc_show_text_update_admin == '') {
			add_option('wbc_show_text_update_admin',$flag);
		} else {
			update_option('wbc_show_text_update_admin',$flag);
		}
		
		$wbc_show_text_update_public = get_option('wbc_show_text_update_public');
		if($wbc_show_text_update_public == '') {
			add_option('wbc_show_text_update_public',$flag);
		} else {
			update_option('wbc_show_text_update_public',$flag);
		}
		booking_calendar_install_db($blog_prefix);
		//echo "on activation";
		
	}
	
}
add_action('plugins_loaded', 'wp_booking_calendar_process_update',1);

//echo BOOKING_CALENDAR_PLUGIN_PATH;
register_uninstall_hook(BOOKING_CALENDAR_PLUGIN_PATH.'wp-booking-calendar.php', 'booking_calendar_on_uninstall' );
register_activation_hook(BOOKING_CALENDAR_PLUGIN_PATH.'wp-booking-calendar.php', 'booking_calendar_on_activation' );

function wp_booking_calendar_process_update(){
	/*******ADD CODE TO IMPORT FROM lang.php******/
	global $wpdb;
	
	
	$current_version = get_option('wbc_version');
	if($current_version == '') {
		$current_version = "1.0.0";
	}
	switch($current_version) {
		case '1.0.0':
			update_option('wbc_show_text_update_admin','1');
			update_option('wbc_show_text_update_public','1');
			wp_booking_multisite_update();
			
			update_option('wbc_version','4.1.2');
			
			break;
		case '2.0.0':
			update_option('wbc_show_text_update_admin','1');
			update_option('wbc_show_text_update_public','1');
			wp_booking_multisite_update();
			update_option('wbc_version','4.1.2');
			
			break;
		case '2.0.1':
			update_option('wbc_show_text_update_admin','1');
			update_option('wbc_show_text_update_public','1');
			wp_booking_multisite_update();
			update_option('wbc_version','4.1.2');
			
			break;
		case '2.0.2':
			update_option('wbc_show_text_update_admin','1');
			update_option('wbc_show_text_update_public','1');
			wp_booking_multisite_update();
			update_option('wbc_version','4.1.2');
			
			break;
		case '2.0.3':
			update_option('wbc_show_text_update_admin','1');
			update_option('wbc_show_text_update_public','1');
			wp_booking_multisite_update();
			update_option('wbc_version','4.1.2');
			
			break;
		case '2.0.4':
			update_option('wbc_show_text_update_admin','1');
			update_option('wbc_show_text_update_public','1');
			wp_booking_multisite_update();
			update_option('wbc_version','4.1.2');
			
			break;
		case '2.0.5':
			update_option('wbc_show_text_update_admin','1');
			update_option('wbc_show_text_update_public','1');
			wp_booking_multisite_update();
			update_option('wbc_version','4.1.2');
			
			break;
		case '2.0.6':
			
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '2.0.7':
			
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '3.0.0':
			
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			
			break;
		case '3.0.1':
			
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '3.0.2':
			
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '3.0.3':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '3.0.4':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '3.0.5':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '3.0.6':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '3.0.7':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.0':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.1':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.2':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.3':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.4':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.5':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.6':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.7':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.8':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.0.9':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.1.0':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		case '4.1.1':
			update_option('wbc_version','4.1.2');
			wp_booking_multisite_update();
			break;
		
		
		
			
		
	}
	//wp_booking_multisite_update(); ///FOR TESTING PURPOSE; REMOVE
	
	
	
	
}
function wp_booking_multisite_update() {
	global $wpdb;
	global $blog_id;
	$current_blog = $blog_id;
	
	if (function_exists('is_multisite') && is_multisite()) {
		
		$blogsQry =  $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."blogs");
		for($i=0;$i<count($blogsQry);$i++) {
			$blog_id = $blogsQry[$i]->blog_id;
			$blog_prefix=$blog_id."_";
			if($blog_id==1) {
				$blog_prefix="";
			}
			switch_to_blog($blog_id);
			//deactivate_plugins( '/wp-booking-calendar/wp-booking-calendar.php' );
			

			booking_calendar_install_db($blog_prefix);
			
			$sql5="INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_categories (category_id,category_name,category_order,category_active)
			SELECT * FROM (SELECT '1','default category','0','1' as category_active) AS tmp
			WHERE NOT EXISTS (
				SELECT category_id,category_name,category_order,category_active FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories WHERE category_id = 1
			) LIMIT 1;";
			dbDelta($sql5);
			$sql6="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_calendars SET category_id = 1 WHERE category_id = 0";
			dbDelta($sql6);
			$sql7="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts SET text_value = 'Description text (optional)' WHERE text_label='SLOT_SPECIAL_LABEL' AND text_value='Only one slot per day, you can set special text for it:'";
			dbDelta($sql7);
			
			$sql8="DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE text_label='CONFIGURATION_PAYPAL_SUBLABEL' AND page_id=2";
			dbDelta($sql8);
			$sql7="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_slots SET slot_av_max = slot_av WHERE slot_av > 0 AND slot_av_max = 0";
			dbDelta($sql7);
			$sql7="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts SET text_value = 'Price' WHERE text_label='DORESERVATION_MAIL_USER_PRICE' AND text_value='An error has occurred. Retry'";
			dbDelta($sql7);
			$sql7="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts SET text_value = 'Price' WHERE text_label='DORESERVATION_MAIL_ADMIN_PRICE' AND text_value='An error has occurred. Retry'";
			dbDelta($sql7);
			//activate_plugin( '/wp-booking-calendar/wp-booking-calendar.php' );
		}
		
		switch_to_blog($current_blog);
			//restore_current_blog();
	} else {
		$blog_prefix = '';
		booking_calendar_install_db($blog_prefix);
		$sql5="INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_categories (category_id,category_name,category_order,category_active)
		SELECT * FROM (SELECT '1','default category','0','1' as category_active) AS tmp
		WHERE NOT EXISTS (
			SELECT category_id,category_name,category_order,category_active FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories WHERE category_id = 1
		) LIMIT 1;";
		dbDelta($sql5);
		$sql6="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_calendars SET category_id = 1 WHERE category_id = 0";
		dbDelta($sql6);
		$sql7="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts SET text_value = 'Description text (optional)' WHERE text_label='SLOT_SPECIAL_LABEL' AND text_value='Only one slot per day, you can set special text for it:'";
		dbDelta($sql7);
		
		$sql8="DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE text_label='CONFIGURATION_PAYPAL_SUBLABEL' AND page_id=2";
			dbDelta($sql8);
		$sql7="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_slots SET slot_av_max = slot_av WHERE slot_av > 0 AND slot_av_max = 0";
			dbDelta($sql7);
		$sql7="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts SET text_value = 'Price' WHERE text_label='DORESERVATION_MAIL_USER_PRICE' AND text_value='An error has occurred. Retry'";
		dbDelta($sql7);
		$sql7="UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts SET text_value = 'Price' WHERE text_label='DORESERVATION_MAIL_ADMIN_PRICE' AND text_value='An error has occurred. Retry'";
		dbDelta($sql7);
	}
	
	//get registered users role from db
	if (function_exists('is_multisite') && is_multisite()) {
		$blogsQry =  $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix."blogs");
		for($i=0;$i<count($blogsQry);$i++) {
			$blog_id = $blogsQry[$i]->blog_id;
			$blog_prefix=$blog_id."_";
			if($blog_id==1) {
				$blog_prefix="";
			}
			switch_to_blog($blog_id);
			//deactivate_plugins( '/wp-booking-calendar/wp-booking-calendar.php' );
			
			$query = "SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name='users_role'";
			
			if($wpdb->query($query)>0 && $wpdb->get_var($query) != '') {
				$role = get_role(strtolower($wpdb->get_var($query)));
				$role->add_cap('wbc_user_orders');
			}
			/*if(mysql_num_rows($roleQry)>0 && mysql_result($roleQry,0,'config_value') != '') { 
				$role = get_role(strtolower(mysql_result($roleQry,0,'config_value')));
				$role->add_cap('wbc_user_orders');
			}*/
		}
		
		switch_to_blog($current_blog);
			
	} else {
		$blog_prefix = '';
		$query = "SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name='users_role'";
		
		if($wpdb->query($query)>0 && $wpdb->get_var($query) != '') {
			$role = get_role(strtolower($wpdb->get_var($query)));
			$role->add_cap('wbc_user_orders');
		}
		/*$roleQry =mysql_query("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name='users_role'");
		if(mysql_num_rows($roleQry)>0 && mysql_result($roleQry,0,'config_value') != '') { 
			$role = get_role(strtolower(mysql_result($roleQry,0,'config_value')));
			$role->add_cap('wbc_user_orders');
		}*/
	}


	

}

$role = get_role( 'administrator' );
$role->add_cap( 'wbc_view_slots' );
$role->add_cap( 'wbc_view_settings' );
$role->add_cap( 'wbc_view_reservations' );
$role->add_cap( 'wbc_add_slots' );
$role->add_cap( 'wbc_approve_reservations' );
$role->add_cap( 'wbc_user_orders' );



?>
