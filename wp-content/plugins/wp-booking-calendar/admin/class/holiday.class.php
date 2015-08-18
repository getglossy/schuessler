<?php

class wp_booking_calendar_holiday {
	private static $holiday_id;
	private static $holidayQry;
	
	public function setHoliday($id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$holidayQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE holiday_id= %d",$id));
		
		
		wp_booking_calendar_holiday::$holidayQry = $holidayQry;
		wp_booking_calendar_holiday::$holiday_id=$holidayQry[0]->holiday_id;
		
	}
	
	public function getHolidayId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_holiday::$holiday_id;
	}
		
	public function getHolidayDate() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_holiday::$holidayQry[0]->holiday_date;
	}
	
	public function addHoliday($date_from,$date_to='',$calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		if($date_to=='') {
			//check if this day already exists
			$numrows = $wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE holiday_date =%s AND calendar_id= %d",$date_from,$calendar_id));
			if($numrows>0) {
				return 0;
			} else {
				$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_holidays (holiday_date,calendar_id) VALUES(%s,%d)",$date_from,$calendar_id));
				$lastId = $wpdb->insert_id;
				//check if there are reservation for that date
				$checkQry = $wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id = r.slot_id WHERE s.slot_date = %s AND r.calendar_id = %d",$date_from,$calendar_id);
				$checkRows = $wpdb->query($checkQry);
				if($checkRows>0) {
					$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_slots SET slot_active = %d WHERE slot_date=%s AND calendar_id = %d",0,$date_from,$calendar_id));
				} else {
					$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_date = %s AND calendar_id= %d",$date_from,$calendar_id));
				}
				
				return $lastId;
			}
			
		} else {
			$arrNewIds = Array();
			$datefromnum=str_replace("-","",$date_from);
			$datetonum=str_replace("-","",$date_to);
			$date=date_create($date_from);
			
			while($datefromnum<=$datetonum) {
				
				$dateformat=date_format($date, 'Y-m-d');
				//check if this day already exists
				$holidayCheck = $wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE holiday_date =%s AND calendar_id= %d",$dateformat,$calendar_id));
				if($holidayCheck==0) {				
					$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_holidays (holiday_date,calendar_id) VALUES(%s,%d)",$dateformat,$calendar_id));
					array_push($arrNewIds,$wpdb->insert_id);
					//check if there are reservation for that date
					$check=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id = r.slot_id WHERE s.slot_date = %s AND r.calendar_id = %d",$dateformat,$calendar_id));
					if($check>0) {
						$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_slots SET slot_active = %d WHERE slot_date=%s AND calendar_id = %d",0,$dateformat,$calendar_id));
					} else {
						$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_date = %s AND calendar_id=%d",$dateformat,$calendar_id));
					}
				}
				if(function_exists("date_add")) {
					date_add($date, date_interval_create_from_date_string('1 days'));
				} else {
					date_modify($date, '+1 day');
				}
				//date_modify($date, '+1 day');	
				
				$datefromnum = date_format($date,'Ymd');
			}
			return $arrNewIds;
		}
	}
	
	public function getHolidayRecordcount($calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		return $wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE calendar_id = %d",$calendar_id));
		//return mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE calendar_id = ".$calendar_id));
	}
	
	public function delHolidays($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE holiday_id IN (".$listIds.")");
	}
	
	public function checkHolidayDate($date_from,$date_to='',$calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		if($date_to=='') {
			$check=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id = r.slot_id WHERE s.slot_date = %s AND r.calendar_id = %d",$date_from,$calendar_id));
		} else {
			$check=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id = r.slot_id WHERE s.slot_date >= %s AND s.slot_date <= %s AND r.calendar_id = %d",$date_from,$date_to,$calendar_id));
		}
		return $check;
	}

}

?>