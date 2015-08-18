<?php

class wp_booking_calendar_public_calendar {
	private static $calendar_id;
	private static $calendarQry;
	
	public function setCalendar($id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$calendarQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE calendar_id = %d",$id));
		
		
		wp_booking_calendar_public_calendar::$calendarQry = $calendarQry;
		wp_booking_calendar_public_calendar::$calendar_id=$calendarQry[0]->calendar_id;
	}
	
	public function getCalendarId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_calendar::$calendar_id;
	}
	
	public function getCalendarCategoryId() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_calendar::$calendarQry[0]->category_id);
	}
	
	public function getCalendarTitle() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_calendar::$calendarQry[0]->calendar_title);
	}
	
	public function getCalendarEmail() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_calendar::$calendarQry[0]->calendar_email);
	}
	
	public function getCalendarActive() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_calendar::$calendarQry[0]->calendar_active;
	}
	
	public function getCalendarRecordcount() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		return $wpdb->query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars");
	}
	
	public function getDefaultCalendar($category_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$calendarQry = $wpdb->prepare("SELECT calendar_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE calendar_order = %d AND calendar_active = %d AND category_id=%d",0,1,$category_id);
		$numrows=$wpdb->query($calendarQry);
		
		//$calendarQry = mysql_query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE calendar_order = 0 AND calendar_active = 1 AND category_id=".$category_id);
		if($numrows > 0) {
			$calendarRow = $wpdb->get_var($calendarQry);
			$this->setCalendar($calendarRow);
			return true;
		} else {
			return false;
		}
	}
	
	public function getFirstFilledMonth($calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$returnvalue=date("Y,m,d");
		$arrDate = explode(",",$returnvalue);
		$month = (intval($arrDate[1])-1);
		$returnvalue = $arrDate[0].",".$month.",".$arrDate[2];
		$slotsQry = $wpdb->prepare("SELECT slot_date FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_date >= NOW() AND calendar_id = %d AND slot_active = %d ORDER BY slot_date ASC LIMIT 1",$calendar_id,1);
		$numrows = $wpdb->query($slotsQry);
		
		if($numrows>0) {
			$rowSlot = $wpdb->get_var($slotsQry);
			$arrDate = explode("-",$rowSlot);
			$month = (intval($arrDate[1])-1);
			$returnvalue = $arrDate[0].",".$month.",".$arrDate[2];
			
		}
		return $returnvalue;
	}


}

?>
