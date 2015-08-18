<?php
/*
Plugin Name: Booking Calendar WP Plugin
Description: Accessible WordPress booking calendar plugin.
Author: Wachipi Srl
Author URI: http://www.wachipi.com
Version: 4.1.2
*/

include(dirname(__FILE__).'/wp-booking-calendar-install.php' );
//var_dump($wpdb->base_prefix);
//check if there are new sites
//cycle on blogs table

global $blog_id;
add_action('delete_blog', 'wp_booking_calendar_on_blog_deletion');
if(!function_exists('money_format')) {
	function money_format($format, $number)
	{
		$regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
				  '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
		if (setlocale(LC_MONETARY, 0) == 'C') {
			setlocale(LC_MONETARY, '');
		}
		$locale = localeconv();
		preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
		foreach ($matches as $fmatch) {
			$value = floatval($number);
			$flags = array(
				'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
							   $match[1] : ' ',
				'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
				'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
							   $match[0] : '+',
				'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
				'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
			);
			$width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
			$left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
			$right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
			$conversion = $fmatch[5];
	
			$positive = true;
			if ($value < 0) {
				$positive = false;
				$value  *= -1;
			}
			$letter = $positive ? 'p' : 'n';
	
			$prefix = $suffix = $cprefix = $csuffix = $signal = '';
	
			$signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
			switch (true) {
				case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
					$prefix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
					$suffix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
					$cprefix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
					$csuffix = $signal;
					break;
				case $flags['usesignal'] == '(':
				case $locale["{$letter}_sign_posn"] == 0:
					$prefix = '(';
					$suffix = ')';
					break;
			}
			if (!$flags['nosimbol']) {
				$currency = $cprefix .
							($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
							$csuffix;
			} else {
				$currency = '';
			}
			$space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';
	
			$value = number_format($value, $right, $locale['mon_decimal_point'],
					 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
			$value = @explode($locale['mon_decimal_point'], $value);
	
			$n = strlen($prefix) + strlen($currency) + strlen($value[0]);
			if ($left > 0 && $left > $n) {
				$value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
			}
			$value = implode($locale['mon_decimal_point'], $value);
			if ($locale["{$letter}_cs_precedes"]) {
				$value = $prefix . $currency . $space . $value . $suffix;
			} else {
				$value = $prefix . $value . $space . $currency . $suffix;
			}
			if ($width > 0) {
				$value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
						 STR_PAD_RIGHT : STR_PAD_LEFT);
			}
	
			$format = str_replace($fmatch[0], $value, $format);
		}
		return $format;
	} 
}
function wp_booking_calendar_on_blog_deletion($blog_id) {
	global $wpdb;
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
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
	$sql12="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_pages;";
	$sql13="DROP TABLE IF EXISTS ".$wpdb->base_prefix.$blog_prefix."booking_texts;";
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
	
}

$wp_booking_api_url = 'http://www.wachipi.com/wp_plugin_updater/api';
$wp_booking_plugin_slug_update ="wp-booking-calendar-3";
$wp_booking_plugin_slug ="wp-booking-calendar";

// Take over the update check
add_filter('pre_set_site_transient_update_plugins', 'wp_booking_calendar_check_for_plugin_update');

function wp_booking_calendar_check_for_plugin_update($checked_data) {
	global $wp_booking_api_url, $wp_booking_plugin_slug, $wp_version, $wp_booking_plugin_slug_update;
	
	//Comment out these two lines during testing.
	if (empty($checked_data->checked))
		return $checked_data;
	
	$args = array(
		'slug' => $wp_booking_plugin_slug_update,
		'version' => $checked_data->checked[$wp_booking_plugin_slug .'/'. $wp_booking_plugin_slug .'.php'],
	);
	$request_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	// Start checking for an update
	$raw_response = wp_remote_post($wp_booking_api_url, $request_string);
	
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);
		
	if (is_object($response) && !empty($response)) // Feed the update data into WP updater
		$checked_data->response[$wp_booking_plugin_slug .'/'. $wp_booking_plugin_slug .'.php'] = $response;
	return $checked_data;
}


// Take over the Plugin info screen
add_filter('plugins_api', 'wp_booking_calendar_plugin_api_call', 10, 3);

function wp_booking_calendar_plugin_api_call($def, $action, $args) {
	global $wp_booking_plugin_slug, $wp_booking_api_url, $wp_version;
	if (!isset($args->slug) || ($args->slug != $wp_booking_plugin_slug))
		return false;
	
	// Get the current version
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[$wp_booking_plugin_slug .'/'. $wp_booking_plugin_slug .'.php'];
	$args->version = $current_version;
	
	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	$request = wp_remote_post($wp_booking_api_url, $request_string);
	
	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
	}
	
	return $res;
}

add_action('init', 'wp_booking_start_session', 1);
function wp_booking_start_session() {
	global $wpdb;
	global $blog_id;
    if(!isset($_SESSION["qryHolidaysOrderString"]) || !isset($_SESSION["orderbyHolidayDate"]) || !isset($_SESSION["qrySlotsOrderString"]) || !isset($_SESSION["orderbySlotsDate"]) || !isset($_SESSION["orderbySlotsTime"]) || !isset($_SESSION["qrySlotsFilterString"]) || !isset($_SESSION["orderbyReservationDate"]) || !isset($_SESSION["orderbyReservationTime"]) || !isset($_SESSION["qryReservationsFilterString"]) || !isset($_SESSION["qryUsersReservationsFilterString"]) || !isset($_SESSION["qryUsersReservationsOrderString"]) || !isset($_SESSION["orderbyUserReservationDate"]) || !isset($_SESSION["orderbyUserReservationTime"]) || !isset($_SESSION["qryReservationsOrderString"]) ) {
        @session_start();
		
		
		//default order_by holidays
		if(!isset($_SESSION["qryHolidaysOrderString"]) || $_SESSION["qryHolidaysOrderString"] == '') {
			$_SESSION["qryHolidaysOrderString"] = "ORDER BY holiday_date ASC";
		}
		if(!isset($_SESSION["orderbyHolidayDate"]) || $_SESSION["orderbyHolidayDate"]=='') {
			$_SESSION["orderbyHolidayDate"] = "desc";
		}
		//default order_by slots
		if(!isset($_SESSION["qrySlotsOrderString"]) || $_SESSION["qrySlotsOrderString"]=='') {
			$_SESSION["qrySlotsOrderString"] = "ORDER BY slot_date ASC,slot_time_from ASC";
		}
		if(!isset($_SESSION["orderbySlotsDate"]) || $_SESSION["orderbySlotsDate"]=='') {
			$_SESSION["orderbySlotsDate"] = "desc";
		}
		if(!isset($_SESSION["orderbySlotsTime"]) || $_SESSION["orderbySlotsTime"]=='') {
			$_SESSION["orderbySlotsTime"] = "desc";
		}
		if(!isset($_SESSION["qrySlotsFilterString"]) || $_SESSION["qrySlotsFilterString"]=='') {
			$_SESSION["qrySlotsFilterString"] = "";
		}
		//default order_by reservations
		
		if(!isset($_SESSION["orderbyReservationDate"]) || $_SESSION["orderbyReservationDate"] == '') {
			$_SESSION["orderbyReservationDate"] = "desc";
		}
		if(!isset($_SESSION["orderbyReservationTime"]) || $_SESSION["orderbyReservationTime"] == '') {
			$_SESSION["orderbyReservationTime"] = "desc";
		}
		if(!isset($_SESSION["qryReservationsFilterString"]) || $_SESSION["qryReservationsFilterString"] == '') {
			$_SESSION["qryReservationsFilterString"] = " AND slot_date = DATE_FORMAT(NOW(),'%Y-%m-%d') ";
		}
		if(!isset($_SESSION["qryReservationsOrderString"]) || $_SESSION["qryReservationsOrderString"] == '') {
			$_SESSION["qryReservationsOrderString"] = "ORDER BY slot_date ASC,slot_time_from ASC";
		}
		
		//default order_by reservations for user
		
		if(!isset($_SESSION["orderbyUserReservationDate"]) || $_SESSION["orderbyUserReservationDate"]=='') {
			$_SESSION["orderbyUserReservationDate"] = "desc";
		}
		if(!isset($_SESSION["orderbyUserReservationTime"]) || $_SESSION["orderbyUserReservationTime"]=='') {
			$_SESSION["orderbyUserReservationTime"] = "desc";
		}
		if(!isset($_SESSION["qryUsersReservationsFilterString"]) || $_SESSION["qryUsersReservationsFilterString"]=='') {
			$_SESSION["qryUsersReservationsFilterString"] = " AND slot_date = DATE_FORMAT(NOW(),'%Y-%m-%d') ";
		}
		if(!isset($_SESSION["qryUsersReservationsOrderString"]) || $_SESSION["qryUsersReservationsOrderString"] == '') {
			$_SESSION["qryUsersReservationsOrderString"] = "ORDER BY slot_date ASC,slot_time_from ASC";
		}
		

    }
	
	
}


function booking_calendar_admin_scripts() {
	if (wp_booking_calendar_is_my_plugin_screen()) {  
		
       wp_enqueue_script('jquery');
		wp_enqueue_style('wp-booking-admin-style-css',plugins_url('wp-booking-calendar/admin/css/style.css'));
		wp_enqueue_style('wp-booking-admin-jquery-lightbox-css',plugins_url('wp-booking-calendar/admin/css/jquery.lightbox-0.5.css'));
		wp_enqueue_style('wp-booking-admin-jquery-ui-css',plugins_url('wp-booking-calendar/admin/css/jquery-ui.css'));
		wp_enqueue_script('wp-booking-admin-lib-js',plugins_url('wp-booking-calendar/admin/js/lib.js'));
		wp_enqueue_script('wp-booking-admin-jquery-lightbox-js',plugins_url('wp-booking-calendar/admin/js/jquery.lightbox-0.5.js'),array('jquery'));
		wp_enqueue_script('wp-booking-admin-tmt_core-js',plugins_url('wp-booking-calendar/admin/js/tmt_libs/tmt_core.js'));
		wp_enqueue_script('wp-booking-admin-tmt_form-js',plugins_url('wp-booking-calendar/admin/js/tmt_libs/tmt_form.js'));
		wp_enqueue_script('wp-booking-admin-tmt_validator-js',plugins_url('wp-booking-calendar/admin/js/tmt_libs/tmt_validator.js'));
		wp_enqueue_script('wp-booking-admin-jquery-ui-custom-js',plugins_url('wp-booking-calendar/admin/js/jquery-ui-1.10.3.custom.js'),array('jquery','wp-booking-admin-jquery-ui-js'));
		wp_enqueue_script('wp-booking-admin-jquery-ui-js',plugins_url('wp-booking-calendar/admin/js/jquery-ui-i18n.js'),array('jquery'));
		wp_enqueue_script('wp-booking-admin-jquery-simple-color-js',plugins_url('wp-booking-calendar/admin/js/jquery.simple-color.js'),array('jquery'));
    } 
    
}



function booking_calendar_public_scripts() {
	global $wpdb;
	
    wp_enqueue_script('jquery');
	wp_enqueue_style('wp-booking-calendar-public-mainStyle-css',plugins_url('wp-booking-calendar/public/css/mainstyle.css'));
	
	wp_enqueue_style('wp-booking-calendar-public-ie-style', plugins_url('wp-booking-calendar/public/css/ie.css'));
	global $wp_styles;
	$wp_styles->add_data( 'wp-booking-calendar-public-ie-style', 'conditional', 'lte IE 7' );
	$wp_styles->add_data( 'wp-booking-calendar-public-ie-style', 'conditional', 'lte IE 8' );
	
	include 'public/class/settings.class.php';
	$bookingSettingObj = new wp_booking_calendar_public_setting();
	if($bookingSettingObj->getRecaptchaEnabled() == "1") {
		wp_enqueue_script('wp-booking-calendar-public-recaptcha','http://www.google.com/recaptcha/api/js/recaptcha_ajax.js');
	}
	
	wp_enqueue_script('wp-booking-calendar-public-bxslider-js',plugins_url('wp-booking-calendar/public/js/jquery.bxSlider.min.js'),array('jquery'));
	wp_enqueue_script('wp-booking-calendar-public-tmt_core-js',plugins_url('wp-booking-calendar/public/js/tmt_libs/tmt_core.js'));
	wp_enqueue_script('wp-booking-calendar-public-tmt_form-js',plugins_url('wp-booking-calendar/public/js/tmt_libs/tmt_form.js'));
	wp_enqueue_script('wp-booking-calendar-public-tmt_validator-js',plugins_url('wp-booking-calendar/public/js/tmt_libs/tmt_validator.js'));
	wp_enqueue_script('wp-booking-calendar-public-lib-js',plugins_url('wp-booking-calendar/public/js/lib.js'));
	wp_enqueue_script('wp-booking-calendar-public-calendar_js',plugins_url('wp-booking-calendar/public/js/wach.calendar.js'),array('jquery'));
	
	wp_localize_script( 'wp-booking-calendar-public-calendar_js', 'WPBookingCalendarSettings', array(
	  	'path' => plugins_url('wp-booking-calendar/public'),
		'day_white_bg' => $bookingSettingObj->getDayWhiteBg(),
		'day_white_bg_hover' => $bookingSettingObj->getDayWhiteBgHover(),
		'day_black_bg' => $bookingSettingObj->getDayBlackBg(),
		'day_black_bg_hover' => $bookingSettingObj->getDayBlackBgHover(),
		'day_white_line1_color' => $bookingSettingObj->getDayWhiteLine1Color(),
		'day_white_line1_color_hover' => $bookingSettingObj->getDayWhiteLine1ColorHover(),
		'day_white_line2_color' => $bookingSettingObj->getDayWhiteLine2Color(),
		'day_white_line2_color_hover' => $bookingSettingObj->getDayWhiteLine2ColorHover(),
		'day_black_line1_color' => $bookingSettingObj->getDayBlackLine1Color(),
		'day_black_line1_color_hover' => $bookingSettingObj->getDayBlackLine1ColorHover(),
		'day_black_line2_color' => $bookingSettingObj->getDayBlackLine2Color(),
		'day_black_line2_color_hover' => $bookingSettingObj->getDayBlackLine2ColorHover(),
		'recaptcha_style' => $bookingSettingObj->getRecaptchaStyle()
		));
		
}

function wp_booking_calendar_is_my_plugin_screen() {  
    $screen = get_current_screen();
	$arrScreens = array('toplevel_page_wp-booking-calendar-welcome','booking-calendar_page_wp-booking-calendar-welcome','booking-calendar_page_wp-booking-calendar-settings','booking-calendar_page_wp-booking-calendar','booking-calendar_page_wp-booking-calendar-reservations','booking-calendar_page_wp-booking-calendar-mails','booking-calendar_page_wp-booking-calendar-form','booking-calendar_page_wp-booking-calendar-style','booking-calendar_page_wp-booking-calendar-categories','booking-calendar_page_wp-booking-calendar-texts','booking-calendar_page_wp-booking-calendar-orders','booking-calendar_page_wp-booking-calendar-contact-admin'); 
    if (is_object($screen) && in_array($screen->id,$arrScreens)) {  
        return true;  
    } else {  
        return false;  
    }  
}  
function wp_booking_calendar_admin_menu() {
	global $wpdb;
	include(dirname(__FILE__).'/admin/class/lang.class.php');
	$bookingLangObj = new wp_booking_calendar_lang();
	
	if ( function_exists('add_object_page') ) {
		add_object_page(__('Booking Calendar','wp-booking-calendar'), __('Booking Calendar','wp-booking-calendar'), 'wbc_user_orders', 'wp-booking-calendar-welcome', 'wp_booking_calendar_admin_view_welcome_page',plugins_url('wp-booking-calendar/admin/images/icon.png') );
	} else {
		add_menu_page(__('Booking Calendar','wp-booking-calendar'), __('Booking Calendar','wp-booking-calendar'), 'wbc_user_orders', 'wp-booking-calendar-welcome', 'wp_booking_calendar_admin_view_welcome_page',plugins_url('wp-booking-calendar/admin/images/icon.png') );
	}
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_SETTINGS"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_SETTINGS"),'wp-booking-calendar'), 'wbc_view_slots', 'wp-booking-calendar-settings', 'wp_booking_calendar_admin_view_settings');	
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_BG_AND_COLORS"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_BG_AND_COLORS"),'wp-booking-calendar'), 'wbc_view_slots', 'wp-booking-calendar-style', 'wp_booking_calendar_admin_view_styles');	
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_MANAGE_CATEGORIES"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_MANAGE_CATEGORIES"),'wp-booking-calendar'), 'wbc_view_slots', 'wp-booking-calendar-categories', 'wp_booking_calendar_admin_view_categories_list');
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_MANAGE_CALENDARS"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_MANAGE_CALENDARS"),'wp-booking-calendar'), 'wbc_view_slots', 'wp-booking-calendar', 'wp_booking_calendar_admin_view_calendars_list');	
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_RESERVATIONS"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_RESERVATIONS"),'wp-booking-calendar'), 'wbc_view_slots', 'wp-booking-calendar-reservations', 'wp_booking_calendar_admin_view_reservations_list');
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_MANAGE_MAIL"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_MANAGE_MAIL"),'wp-booking-calendar'), 'wbc_view_slots', 'wp-booking-calendar-mails', 'wp_booking_calendar_admin_view_mails_list');
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_FORM_MANAGEMENT"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_FORM_MANAGEMENT"),'wp-booking-calendar'), 'wbc_view_slots', 'wp-booking-calendar-form', 'wp_booking_calendar_admin_view_form');	
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_TEXT_MANAGEMENT"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_TEXT_MANAGEMENT"),'wp-booking-calendar'), 'wbc_view_slots', 'wp-booking-calendar-texts', 'wp_booking_calendar_admin_view_texts');	
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_USER_RESERVATIONS"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_USER_RESERVATIONS"),'wp-booking-calendar'), 'wbc_user_orders', 'wp-booking-calendar-orders', 'wp_booking_calendar_admin_view_orders');	
	@add_submenu_page('wp-booking-calendar-welcome', __($bookingLangObj->getLabel("LEFT_MENU_CONTACT_ADMINISTRATOR"),'wp-booking-calendar'), __($bookingLangObj->getLabel("LEFT_MENU_CONTACT_ADMINISTRATOR"),'wp-booking-calendar'), 'wbc_user_orders', 'wp-booking-calendar-contact-admin', 'wp_booking_calendar_admin_contact_admin');	
	
}
function get_current_user_role() {
	require_once(ABSPATH . 'wp-includes/functions.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	global $wp_roles;
	global $current_user;
	get_currentuserinfo();
	$roles = $current_user->roles;
	$role = array_shift($roles);
	return isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role] ) : false;
}
$linkToUpload='';
if((get_option('wbc_show_text_update_admin')=='1' || get_option('wbc_show_text_update_public')=='1') && get_current_user_role() == 'administrator') {
	$linkToUpload = '<div class="updated"><div><strong>Booking Calendar WP Plugin</strong></div><div class="booking_float_left">Update your texts from previous version using the automatic import for your old "lang.php" files <a href="admin.php?page=wp-booking-calendar-texts&upload=1">clicking here</a>!</div><div class="booking_float_right"><a href="admin.php?page=wp-booking-calendar-texts&upload=0">Don\'t show it again</a></div><div class="booking_cleardiv"></div></div>';
}

function wp_booking_calendar_admin_contact_admin() {
	global $wpdb;
	$bookingLangObj = new wp_booking_calendar_lang();
	include(dirname(__FILE__).'/admin/user_contact.php' );
}

function wp_booking_calendar_admin_view_orders() {
	global $current_user;
	get_currentuserinfo();
	global $wpdb;
	$bookingLangObj = new wp_booking_calendar_lang();
	$reservation_user_id = $current_user->ID;
	include(dirname(__FILE__).'/admin/users_reservation.php' );
}
function wp_booking_calendar_admin_view_welcome_page() {
	global $wpdb;
	global $linkToUpload;
	echo $linkToUpload;
	$bookingLangObj = new wp_booking_calendar_lang();
	if(get_current_user_role() == 'administrator') {
		include(dirname(__FILE__).'/admin/welcome.php' );
	} else {
		include(dirname(__FILE__).'/admin/user_welcome.php' );
	}
}
function wp_booking_calendar_admin_view_categories_list() {
	global $wpdb;
	global $blog_id;
	$bookingLangObj = new wp_booking_calendar_lang();
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
	}
	if($wpdb->get_var( $wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = %s", "reservation_confirmation_mode") )>0) {
		global $linkToUpload;
		echo $linkToUpload;
		include(dirname(__FILE__).'/admin/categories.php' );
	} else {
		
	
		?>
        <div class="booking_padding_20 booking_font_20 booking_line_percent">
            
            <div class="booking_padding_20 booking_bg_f00 booking_mark_fff">
                <p>
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT3"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT4"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT5"); ?><strong><?php echo $bookingLangObj->getLabel("WELCOME_TEXT6"); ?></strong><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT7"); ?>
                </p>
            </div>
            
                       
        </div>
        <?php
		//echo "unavailable";
	}
}
function wp_booking_calendar_admin_view_calendars_list() {
	global $wpdb;
	global $blog_id;
	$bookingLangObj = new wp_booking_calendar_lang();
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
	}
	if($wpdb->get_var( $wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = %s", "reservation_confirmation_mode") )>0) {
		global $linkToUpload;
		echo $linkToUpload;
		include(dirname(__FILE__).'/admin/wp_booking_calendars.php' );
	} else {
		?>
        <div class="booking_padding_20 booking_font_20 booking_line_percent">
            
           <div class="booking_padding_20 booking_bg_f00 booking_mark_fff">
                <p>
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT3"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT4"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT5"); ?><strong><?php echo $bookingLangObj->getLabel("WELCOME_TEXT6"); ?></strong><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT7"); ?>
                </p>
            </div>
            
                       
        </div>
        <?php
		//echo "unavailable";
	}
}
function wp_booking_calendar_admin_view_settings() {
	global $wpdb;
	global $linkToUpload;
	echo $linkToUpload;
	$bookingLangObj = new wp_booking_calendar_lang();
	include(dirname(__FILE__).'/admin/configuration.php' );
	
}

function wp_booking_calendar_admin_view_styles() {
	global $wpdb;
	global $blog_id;
	$bookingLangObj = new wp_booking_calendar_lang();
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
	}
	if($wpdb->get_var( $wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = %s", "reservation_confirmation_mode") )>0) {
		global $linkToUpload;
		echo $linkToUpload;
		include(dirname(__FILE__).'/admin/styles.php' );
	} else {
		?>
        <div class="booking_padding_20 booking_font_20 booking_line_percent">
            
            <div class="booking_padding_20 booking_bg_f00 booking_mark_fff">
                <p>
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT3"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT4"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT5"); ?><strong><?php echo $bookingLangObj->getLabel("WELCOME_TEXT6"); ?></strong><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT7"); ?>
                </p>
            </div>
            
                       
        </div>
        <?php
	}
	
}
function wp_booking_calendar_admin_view_form() {
	global $wpdb;
	global $blog_id;
	$bookingLangObj = new wp_booking_calendar_lang();
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
	}
	if($wpdb->get_var( $wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = %s", "reservation_confirmation_mode") )>0) {
		global $linkToUpload;
		echo $linkToUpload;
		include(dirname(__FILE__).'/admin/form_management.php' );
	} else {
		?>
        <div class="booking_padding_20 booking_font_20 booking_line_percent">
            
            <div class="booking_padding_20 booking_bg_f00 booking_mark_fff">
                <p>
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT3"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT4"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT5"); ?><strong><?php echo $bookingLangObj->getLabel("WELCOME_TEXT6"); ?></strong><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT7"); ?>
                </p>
            </div>
            
                       
        </div>
        <?php
	}
	
	
}

function wp_booking_calendar_admin_view_texts() {
	global $wpdb;
	global $blog_id;
	$bookingLangObj = new wp_booking_calendar_lang();
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
	}
	if($wpdb->get_var( $wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = %s", "reservation_confirmation_mode") )>0) {
		global $linkToUpload;
		echo $linkToUpload;
		include(dirname(__FILE__).'/admin/texts.php' );
	} else {
		?>
        <div class="booking_padding_20 booking_font_20 booking_line_percent">
            
            <div class="booking_padding_20 booking_bg_f00 booking_mark_fff">
                <p>
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT3"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT4"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT5"); ?><strong><?php echo $bookingLangObj->getLabel("WELCOME_TEXT6"); ?></strong><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT7"); ?>
                </p>
            </div>
            
                       
        </div>
        <?php
	}
	
	
}
function wp_booking_calendar_admin_view_reservations_list() {
	global $wpdb;
	global $blog_id;
	$bookingLangObj = new wp_booking_calendar_lang();
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
	}
	if($wpdb->get_var( $wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = %s", "reservation_confirmation_mode") )>0) {
		global $linkToUpload;
		echo $linkToUpload;
		include(dirname(__FILE__).'/admin/reservations.php' );
	} else {
		?>
        <div class="booking_padding_20 booking_font_20 booking_line_percent">
            
            <div class="booking_padding_20 booking_bg_f00 booking_mark_fff">
                <p>
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT3"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT4"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT5"); ?><strong><?php echo $bookingLangObj->getLabel("WELCOME_TEXT6"); ?></strong><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT7"); ?>
                </p>
            </div>
            
                       
        </div>
        <?php
	}
}
function wp_booking_calendar_admin_view_mails_list() {
	global $wpdb;
	global $blog_id;
	$bookingLangObj = new wp_booking_calendar_lang();
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
	}
	if($wpdb->get_var( $wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = %s", "reservation_confirmation_mode") )>0) {
		global $linkToUpload;
		echo $linkToUpload;
		include(dirname(__FILE__).'/admin/mails.php' );
	} else {
		?>
        <div class="booking_padding_20 booking_font_20 booking_line_percent">
            
           <div class="booking_padding_20 booking_bg_f00 booking_mark_fff">
                <p>
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT3"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT4"); ?><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT5"); ?><strong><?php echo $bookingLangObj->getLabel("WELCOME_TEXT6"); ?></strong><br />
                    <?php echo $bookingLangObj->getLabel("WELCOME_TEXT7"); ?>
                </p>
            </div>
            
                       
        </div>
        <?php
	}
}
function wp_booking_calendar_public_show_calendar($calendar_id = 0,$category_id = 0) {
	global $wpdb;
	global $post;
	global $blog_id;
	$blog_prefix=$blog_id."_";
	if($blog_id==1) {
		$blog_prefix="";
	}
	//var_dump($_REQUEST);
	if($wpdb->get_var( $wpdb->prepare("SELECT config_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_config WHERE config_name = %s", "reservation_confirmation_mode") )>0) {
		if (isset($_GET['confirm'])) {
			include(dirname(__FILE__).'/public/confirm.php');
		  } else if (isset($_GET['cancel'])) {
			include(dirname(__FILE__).'/public/cancel.php');
		  } else if(isset($_GET["paypal_confirm"])) {
			  include(dirname(__FILE__).'/public/paypal_confirm.php');
		  } else if(isset($_GET["paypal_ipn_notice"])) {
			  include(dirname(__FILE__).'/public/paypal_ipn_notice.php');
		  } else if(isset($_GET["paypal_cancel"])) {
			  include(dirname(__FILE__).'/public/paypal_cancel.php');
		  } else {		
		  	if($calendar_id>0) {	  
		  		$_GET["calendar_id"] = $calendar_id;
			}
			if($category_id>0) {	  
		  		$_GET["category_id"] = $category_id;
			}
			include(dirname(__FILE__).'/public/index.php' );			
		  }
	}
}

function wp_booking_calendar_shortcode_calendar($atts) {
	
	if(isset($atts["calendar_id"])) {	
		extract( shortcode_atts( array( 
			'calendar_id'  => $atts["calendar_id"]
			
		), $atts ));
	} else {
		$calendar_id=0;
	}
	if(isset($atts["category_id"])) {	
		extract( shortcode_atts( array( 
			'category_id'  => $atts["category_id"]
			
		), $atts ));
	} else {
		$category_id=0;
	}
	ob_start();
	wp_booking_calendar_public_show_calendar( $calendar_id,$category_id );
	$output_string=ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_action('admin_menu', 'wp_booking_calendar_admin_menu');
add_action('admin_enqueue_scripts', 'booking_calendar_admin_scripts');
add_action('wp_enqueue_scripts', 'booking_calendar_public_scripts');
add_action( 'plugins_loaded', 'wp_booking_shortcode_add',2 );

function wp_booking_shortcode_add() {
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
			
			//make a query on all calendars and create shortcodes
			$wpBookingCalendarsQry = $wpdb->get_results("SELECT calendar_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars");
		
			for($j=0;$j<count($wpBookingCalendarsQry);$j++) {
				add_shortcode('wp_booking_calendar','wp_booking_calendar_shortcode_calendar');
			}
			
			
			$wpBookingCategoriesQry = $wpdb->get_results("SELECT category_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories");
			for($j=0;$j<count($wpBookingCategoriesQry);$j++) {
				add_shortcode('wp_booking_calendar','wp_booking_calendar_shortcode_calendar');
			}
			
			add_shortcode('wp_booking_calendar','wp_booking_calendar_shortcode_calendar');//general shortcode
		}
		
		switch_to_blog($current_blog);
			
	} else {
		$blog_prefix="";
		
		//make a query on all calendars and create shortcodes
		$wpBookingCalendarsQry = $wpdb->get_results("SELECT calendar_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars");
		
		for($i=0;$i<count($wpBookingCalendarsQry);$i++) {
			add_shortcode('wp_booking_calendar','wp_booking_calendar_shortcode_calendar');
		}
		
		
		$wpBookingCategoriesQry = $wpdb->get_results("SELECT category_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories");
		for($i=0;$i<count($wpBookingCategoriesQry);$i++) {
			add_shortcode('wp_booking_calendar','wp_booking_calendar_shortcode_calendar');
		}
		
		add_shortcode('wp_booking_calendar','wp_booking_calendar_shortcode_calendar');//general shortcode
	}
	
	
	
}
add_action('activated_plugin','booking_save_error');
function booking_save_error(){
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
			
			//$tableExists = mysql_num_rows($result);
			switch_to_blog($blog_id);
			
			
			update_option('plugin_error',  ob_get_contents());
		}
		
	} else {
		update_option('plugin_error',  ob_get_contents());
	}
    
}


?>
