<?php 
include_once dirname(__FILE__)."/../../../../wp-load.php";
@set_time_limit(0);

//include dirname(__FILE__)."/../public/include/lang.php";
//include_once dirname(__FILE__).'/include/lang.php';
include_once dirname(__FILE__).'/class/settings.class.php';
$bookingSettingObj = new wp_booking_calendar_setting();
date_default_timezone_set($bookingSettingObj->getTimezone());

include_once dirname(__FILE__).'/class/list.class.php';
include_once dirname(__FILE__).'/class/holiday.class.php';
include_once dirname(__FILE__).'/class/slot.class.php';
include_once dirname(__FILE__).'/class/reservation.class.php';
include_once dirname(__FILE__).'/class/calendar.class.php';
include_once dirname(__FILE__).'/class/mail.class.php';
include_once dirname(__FILE__).'/class/category.class.php';
include_once dirname(__FILE__).'/class/lang.class.php';

$bookingListObj = new wp_booking_calendar_lists();

$bookingHolidayObj = new wp_booking_calendar_holiday();
$bookingSlotsObj = new wp_booking_calendar_slot();
$bookingReservationObj = new wp_booking_calendar_reservation();
$bookingCalendarObj = new wp_booking_calendar_calendar();
$bookingMailObj = new wp_booking_calendar_email();
$bookingCategoryObj = new wp_booking_calendar_category();
$bookingLangObj = new wp_booking_calendar_lang();


?>
