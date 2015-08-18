<?php

class wp_booking_calendar_public_holiday {
	private static $holiday_id;
	private static $holidayQry;
	
	public function setHoliday($id) {
		
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$holidayQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE holiday_id=%d",$id));
		
		
		wp_booking_calendar_public_holiday::$holidayQry = $holidayQry;
		wp_booking_calendar_public_holiday::$holiday_id=$holidayRow[0]->holiday_id;
		
	}
	
	public function getHolidayId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_holiday::$holiday_id;
	}
		
	public function getHolidayDate() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_holiday::$holidayQry[0]->holiday_date;
	}
	
	
	
	public function getHolidayRecordcount($calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		return $wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE calendar_id = %d",$calendar_id));
	}
	
	

}

?>