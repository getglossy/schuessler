<?php 

@set_time_limit(0);
include_once dirname(__FILE__)."/../../../../wp-load.php";
//include_once dirname(__FILE__).'/admin/include/db_conn.php';
//include_once dirname(__FILE__).'/include/lang.php';
global $wpdb;
include_once dirname(__FILE__).'/class/settings.class.php';
$bookingSettingObj = new wp_booking_calendar_public_setting();
//handling timezone in php and mysql
date_default_timezone_set($bookingSettingObj->getTimezone());
$now = new DateTime();
$mins = $now->getOffset() / 60;
$sgn = ($mins < 0 ? -1 : 1);
$mins = abs($mins);
$hrs = floor($mins / 60);
$mins -= $hrs * 60;
$offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);
$wpdb->query("SET time_zone='$offset';");

include_once dirname(__FILE__).'/class/list.class.php';
include_once dirname(__FILE__).'/class/holiday.class.php';
include_once dirname(__FILE__).'/class/slot.class.php';
include_once dirname(__FILE__).'/class/reservation.class.php';
include_once dirname(__FILE__).'/class/calendar.class.php';
include_once dirname(__FILE__).'/class/mail.class.php';
include_once dirname(__FILE__).'/class/category.class.php';
include_once dirname(__FILE__).'/class/lang.class.php';

$bookingListObj = new wp_booking_calendar_public_lists();
$bookingHolidayObj = new wp_booking_calendar_public_holiday();
$bookingSlotsObj = new wp_booking_calendar_public_slot();
$bookingReservationObj = new wp_booking_calendar_public_reservation();
$bookingCalendarObj = new wp_booking_calendar_public_calendar();
$bookingMailObj = new wp_booking_calendar_public_email();
$bookingCategoryObj = new wp_booking_calendar_public_category();
$bookingLangObj = new wp_booking_calendar_public_lang();


@session_start();

?>
