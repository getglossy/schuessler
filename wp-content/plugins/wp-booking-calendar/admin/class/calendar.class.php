<?php

class wp_booking_calendar_calendar {
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
		
		wp_booking_calendar_calendar::$calendarQry = $calendarQry;
		wp_booking_calendar_calendar::$calendar_id=$calendarQry[0]->calendar_id;
	}
	
	public function getCalendarId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_calendar::$calendar_id;
	}
	
	public function getCalendarCategoryId() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_calendar::$calendarQry[0]->category_id);
	}
	
	public function getCalendarTitle() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_calendar::$calendarQry[0]->calendar_title);
	}
	
	public function getCalendarEmail() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_calendar::$calendarQry[0]->calendar_email);
	}
	
	public function getCalendarActive() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_calendar::$calendarQry[0]->calendar_active;
	}
	
	public function getCalendarOrder() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_calendar::$calendarQry[0]->calendar_order;
	}
	
	public function publishCalendars($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_calendars SET calendar_active = %d WHERE calendar_id IN (".$listIds.")",1));
	}
	
	public function unpublishCalendars($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_calendars SET calendar_active = %d WHERE calendar_id IN (".$listIds.")",0));
	}
	
	public function delCalendars($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE calendar_id IN (".$listIds.")");
		//delete holidays
		$wpdb->query("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE calendar_id IN (".$listIds.")");
		//check for reservations, if any disable slots, otherwise del slots
		$slotsQry=$wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE calendar_id IN (".$listIds.")");
		for($i=0;$i<count($slotsQry);$i++) {
			$queryRes = $wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id =%d",$slotsQry[$i]->slot_id);
			$numRes = $wpdb->query($queryRes);
			if($numRes>0) {
				$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_slots SET slot_active = 0 WHERE slot_id  = %d",$slotsQry[$i]->slot_id));
			} else {
				$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots  WHERE slot_id =%d",$slotsQry[$i]->slot_id));
			}
			/*$numRes=mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id =".$slotRow["slot_id"]));
			if($numRes>0) {
				mysql_query("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_slots SET slot_active = 0 WHERE slot_id  =".$slotRow["slot_id"]);
			} else {
				mysql_query("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots  WHERE slot_id =".$slotRow["slot_id"]);
			}*/
		}
		
		
	}
	
	public function addCalendar() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$newOrder = 0;
		//check order of last calendar
		$calQuery = $wpdb->prepare("SELECT calendar_order as max FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE category_id=%d ORDER BY calendar_order DESC LIMIT 1",$_POST["category_id"]);
		$numrows = $wpdb->query($calQuery);
		if($numrows>0) {
			$newOrder = $wpdb->get_var($calQuery)+1;
		}
		/*$calOrderQry = mysql_query("SELECT calendar_order as max FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE category_id=".$_POST["category_id"]." ORDER BY calendar_order DESC LIMIT 1");
		if(mysql_num_rows($calOrderQry)>0) {
			$newOrder=mysql_result($calOrderQry,0,'max')+1;
		}*/
		$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_calendars (category_id,calendar_title,calendar_email,calendar_order,calendar_active) VALUES(%d,%s,%s,%d,%d)",$_POST["category_id"],$_POST["calendar_title"],$_POST["calendar_email"],$newOrder,0));
		$calendar_id=$wpdb->insert_id;
		return $calendar_id;
	}
	
	public function updateCalendar() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_calendars SET calendar_title=%s,calendar_email=%s, category_id=%d WHERE calendar_id=%d",$_POST["calendar_title"],$_POST["calendar_email"],$_POST["category_id"],$_POST["calendar_id"]));
	}
	
	public function getCalendarRecordcount() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$query = "SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars";
		return $wpdb->query($query);
		//return mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars"));
	}
	
	public function setDefaultCalendar($calendar_id,$category_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_calendars SET calendar_order = %d, calendar_active = %d WHERE calendar_id=%d AND category_id=%d",0,1,$calendar_id,$category_id));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_calendars SET calendar_order = calendar_order +1 WHERE calendar_id <> %d AND category_id= %d",$calendar_id,$category_id));
	}
	
	public function duplicateCalendars($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$newOrder = 0;
		//check order of last calendar
		$calQuery = "SELECT calendar_order as max FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars ORDER BY calendar_order DESC LIMIT 1";
		$numrows = $wpdb->query($calQuery);
		if($numrows>0) {
			$newOrder = $wpdb->get_var($calQuery)+1;
		}
		/*$calOrderQry = mysql_query("SELECT calendar_order as max FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars ORDER BY calendar_order DESC LIMIT 1");
		if(mysql_num_rows($calOrderQry)>0) {
			$newOrder=mysql_result($calOrderQry,0,'max')+1;
		}*/
		$calendarsQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE calendar_id IN (".$listIds.")");
		for($i=0;$i<count($calendarsQry);$i++) {
			$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_calendars (category_id,calendar_title,calendar_order,calendar_active) VALUES(%d,%s,%d,%d)",$calendarsQry[$i]->category_id,'duplicate of '.$calendarsQry[$i]->calendar_title,$newOrder,0));
			$last_id = $wpdb->insert_id;
			//duplicate slots
			$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_slots(slot_special_text,slot_special_mode,slot_date,slot_time_from,slot_time_to,slot_active,calendar_id) SELECT slot_special_text,slot_special_mode,slot_date,slot_time_from,slot_time_to,slot_active, '".$last_id."' FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE calendar_id = %d ORDER BY slot_date,slot_time_from",$calendarsQry[$i]->calendar_id));
			//duplicate holidays
			$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_holidays(holiday_date,calendar_id) SELECT holiday_date, '".$last_id."' FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE calendar_id = %d ORDER BY holiday_date",$calendarsQry[$i]->calendar_id));
		}
		
	}

}

?>