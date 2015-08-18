<?php
class wp_booking_calendar_public_lists {	
	public function getTimezonesList() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayTimezones = Array();
		$timezonesQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_timezones ORDER BY timezone_name");
		
		for($i=0;$i<count($timezonesQry);$i++) {
			$arrayTimezones[$timezonesQry[$i]->timezone_id] = Array();
			$arrayTimezones[$timezonesQry[$i]->timezone_id]["timezone_name"] = $timezonesQry[$i]->timezone_name;
			$arrayTimezones[$timezonesQry[$i]->timezone_id]["timezone_value"] = $timezonesQry[$i]->timezone_value;
		}
		
		return $arrayTimezones;
	}	
	
	public function getHolidaysList($order_by,$calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayHolidays = Array();
		$holidaysQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE calendar_id = %d ".$order_by,$calendar_id));
		
		for($i=0;$i<count($holidaysQry);$i++) {
			$arrayHolidays[$holidaysQry[$i]->holiday_id] = Array();
			$arrayHolidays[$holidaysQry[$i]->holiday_id]["holiday_date"] = $holidaysQry[$i]->holiday_date;
		}
		
		return $arrayHolidays;
	}	
	
	public function getSlotsHoursList($calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arraySlots = Array();
		$slotsQry = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT slot_time_from FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_date >= NOW() AND slot_active = %d AND calendar_id = %d ORDER BY slot_time_from",1,$calendar_id));
		
		for($i=0;$i<count($slotsQry);$i++) {
			array_push($arraySlots,$slotsQry[$i]->slot_time_from);
		}
		
		return $arraySlots;
	}	
	
	public function getSlotsList($filter,$order_by,$calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arraySlots = Array();
		$slotsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_active = %d AND calendar_id = %d ".$filter." ".$order_by,1,$calendar_id));
		
		for($i=0;$i<count($slotsQry);$i++) {
			$arraySlots[$slotsQry[$i]->slot_id] = Array();
			$arraySlots[$slotsQry[$i]->slot_id]["slot_date"] = $slotsQry[$i]->slot_date;
			$arraySlots[$slotsQry[$i]->slot_id]["slot_time_from"] = $slotsQry[$i]->slot_time_from;
			$arraySlots[$slotsQry[$i]->slot_id]["slot_special_text"] = stripslashes($slotsQry[$i]->slot_special_text);
			$arraySlots[$slotsQry[$i]->slot_id]["slot_special_mode"] = $slotsQry[$i]->slot_special_mode;
			
			$reservation=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id = %d AND reservation_cancelled = %d",$slotsQry[$i]->slot_id,0));
			if($reservation == 0) {
				$reservation = "NO";
			} else {
				$reservation = "YES";
			}
			$arraySlots[$slotsQry[$i]->slot_id]["slot_reservation"] = $reservation;
		}
		
		return $arraySlots;
	}	
	
	public function getReservationsList($filter,$order_by,$calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = Array();
		$reservationsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id=r.slot_id WHERE r.calendar_id = %d AND s.calendar_id = %d ".$filter." ".$order_by,$calendar_id,$calendar_id));
		
		for($i=0;$i<count($reservationsQry);$i++) {
			$arrayReservations[$reservationsQry[$i]->reservation_id] = Array();
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_date"] = $reservationsQry[$i]->slot_date;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_time"] = $reservationsQry[$i]->slot_time_from;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_surname"] = stripslashes($reservationsQry[$i]->reservation_surname);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_name"] = stripslashes($reservationsQry[$i]->reservation_name);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_email"] = $reservationsQry[$i]->reservation_email;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_confirmed"] = $reservationsQry[$i]->reservation_confirmed;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_cancelled"] = $reservationsQry[$i]->reservation_cancelled;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["slot_active"] = $reservationsQry[$i]->slot_active;
		}
		
		return $arrayReservations;
	}	
	
	public function getCalendarsList($order_by,$category_id = 0) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayCalendars = Array();
		$calendarsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE calendar_active = %d  AND category_id=%d ".$order_by,1,$category_id));
		
		for($i=0;$i<count($calendarsQry);$i++) {
			$arrayCalendars[$calendarsQry[$i]->calendar_id] = Array();
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_title"] = stripslashes($calendarsQry[$i]->calendar_title);
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_active"] = $calendarsQry[$i]->calendar_active;
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_order"] = $calendarsQry[$i]->calendar_order;
		}
		
		
		return $arrayCalendars;
	}
	
	public function getMonthCalendar($month,$year,$weekday_format="N") {
		global $wpdb;
		global $blog_id;
		$arrayMonth=Array();
		$date = mktime(0,0,0,$month,1,$year); 
		for($n=1;$n <= date('t',$date);$n++){
			$arrayMonth[$n] = Array();
			$arrayMonth[$n]["dayofweek"] = date($weekday_format,mktime(0,0,0,$month,$n,$year));
			$arrayMonth[$n]["daynum"] = date('d',mktime(0,0,0,$month,$n,$year));
			$arrayMonth[$n]["monthnum"] = date('m',mktime(0,0,0,$month,$n,$year));
			$arrayMonth[$n]["yearnum"] = date('Y',mktime(0,0,0,$month,$n,$year));
		}
		return $arrayMonth;
	}
	
	public function getSlotsPerDay($year,$month,$daynum, $calendar_id,$bookingSettingObj) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		if(strlen($month) == 1) {
			$month="0".$month;
		}
		if(strlen($daynum) == 1) {
			$daynum="0".$daynum;
		}
		if($year."-".$month."-".$daynum == date('Y-m-d')) {
			$slotsQry = $wpdb->get_results("SELECT SUM(s.slot_av) AS av_seats,s.* FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots s WHERE s.slot_active=1 AND s.slot_date = '".$year."-".$month."-".$daynum."'  AND REPLACE(s.slot_time_from,':','') >= DATE_FORMAT(NOW(),'%H%i%s') AND s.calendar_id=".$calendar_id." GROUP BY s.slot_id");

		} else {
			$slotsQry = $wpdb->get_results($wpdb->prepare("SELECT SUM(s.slot_av) AS av_seats,s.* FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots s WHERE s.slot_active = %d AND s.slot_date = %s  AND s.calendar_id=%d GROUP BY s.slot_id",1,$year."-".$month."-".$daynum,$calendar_id));

		}
		
		$tot = count($slotsQry);
		if($tot == 0) {
			//it's not soldout
			return -1;
		} else {
			if($bookingSettingObj->getSlotsUnlimited() != 1 && $bookingSettingObj->getShowSlotsSeats() == 0) {
				for($i=0;$i<count($slotsQry);$i++) {
					$reservationQry = $wpdb->prepare("SELECT SUM(reservation_seats) as res FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id=%d AND reservation_cancelled = %d GROUP BY slot_id",$slotsQry[$i]->slot_id,0);
					$numrows=$wpdb->query($reservationQry);
					if(($numrows>0 && $wpdb->get_var($reservationQry) == $slotsQry[$i]->slot_av) || ($numrows>0 && $bookingSettingObj->getSlotsUnlimited() == 0)) {
						//$tot = $tot-mysql_result($reservationQry,0,'res');
						$tot--;
					}
				}
				
			} else if($bookingSettingObj->getSlotsUnlimited() == 2 && $bookingSettingObj->getShowSlotsSeats() == 1) {
				$tot=0;
				for($i=0;$i<count($slotsQry);$i++) {
					if($slotsQry[$i]->av_seats == 0) {
						$tot++;
					} else {
						$tot = $tot+$slotsQry[$i]->av_seats;
					}
					$reservationQry = $wpdb->prepare("SELECT SUM(reservation_seats) as res FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id=%d AND reservation_cancelled = %d GROUP BY slot_id",$slotsQry[$i]->slot_id,0);
					$numrows=$wpdb->query($reservationQry);
					if($numrows>0) {
						//$tot = $tot-mysql_result($reservationQry,0,'res');
						$tot = $tot-$wpdb->get_var($reservationQry);
					}
				}
							
				
			}
			return $tot;
		}
	}
	
	public function getSlotsPerDayList($year,$month,$day,$calendar_id,$bookingSettingObj) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arraySlots=Array();
		if(strlen($month) == 1) {
			$month="0".$month;
		}
		if(strlen($day) == 1) {
			$day="0".$day;
		}
		if($year."-".$month."-".$day == date('Y-m-d')) {
		
			$slotsQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_active=1 AND slot_date = '".$year."-".$month."-".$day."'  AND REPLACE(slot_time_from,':','') >= DATE_FORMAT(NOW(),'%H%i%s') AND calendar_id=".$calendar_id." ORDER BY slot_time_from");

		} else {
			$slotsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_active = %d AND slot_date = %s AND calendar_id=%d ORDER BY slot_time_from",1,$year."-".$month."-".$day,$calendar_id));
		}
		
		for($i=0;$i<count($slotsQry);$i++) {
			
			if($bookingSettingObj->getSlotsUnlimited() == 0 && $bookingSettingObj->getShowBookedSlots() == 0) {
				$reservationQry=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id=%d AND reservation_cancelled = %d",$slotsQry[$i]->slot_id,0));
				if($reservationQry==0) {
					$arraySlots[$slotsQry[$i]->slot_id] = Array();
					$arraySlots[$slotsQry[$i]->slot_id]["slot_time_from"] = $slotsQry[$i]->slot_time_from;
					$arraySlots[$slotsQry[$i]->slot_id]["slot_time_to"] = $slotsQry[$i]->slot_time_to;
					$arraySlots[$slotsQry[$i]->slot_id]["slot_special_text"] = stripslashes($slotsQry[$i]->slot_special_text);
					$arraySlots[$slotsQry[$i]->slot_id]["slot_special_mode"] = $slotsQry[$i]->slot_special_mode;
					$arraySlots[$slotsQry[$i]->slot_id]["slot_price"] = $slotsQry[$i]->slot_price;
					$arraySlots[$slotsQry[$i]->slot_id]["booked"] = 0;
				}
			} else if($bookingSettingObj->getSlotsUnlimited() == 1) {
				$arraySlots[$slotsQry[$i]->slot_id] = Array();
				$arraySlots[$slotsQry[$i]->slot_id]["slot_time_from"] = $slotsQry[$i]->slot_time_from;
				$arraySlots[$slotsQry[$i]->slot_id]["slot_time_to"] = $slotsQry[$i]->slot_time_to;
				$arraySlots[$slotsQry[$i]->slot_id]["slot_special_text"] = stripslashes($slotsQry[$i]->slot_special_text);
				$arraySlots[$slotsQry[$i]->slot_id]["slot_special_mode"] = $slotsQry[$i]->slot_special_mode;
				$arraySlots[$slotsQry[$i]->slot_id]["slot_price"] = $slotsQry[$i]->slot_price;
				$arraySlots[$slotsQry[$i]->slot_id]["booked"] = 0;
			} else if($bookingSettingObj->getSlotsUnlimited() == 0 && $bookingSettingObj->getShowBookedSlots() == 1) {
				$reservationQry=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id=%d AND reservation_cancelled = %d",$slotsQry[$i]->slot_id,0));
				if($reservationQry>0) {
					$booked=1;
				} else {
					$booked = 0;
				}
				$arraySlots[$slotsQry[$i]->slot_id] = Array();
				$arraySlots[$slotsQry[$i]->slot_id]["slot_time_from"] = $slotsQry[$i]->slot_time_from;
				$arraySlots[$slotsQry[$i]->slot_id]["slot_time_to"] = $slotsQry[$i]->slot_time_to;
				$arraySlots[$slotsQry[$i]->slot_id]["slot_special_text"] = stripslashes($slotsQry[$i]->slot_special_text);
				$arraySlots[$slotsQry[$i]->slot_id]["slot_special_mode"] = $slotsQry[$i]->slot_special_mode;
				$arraySlots[$slotsQry[$i]->slot_id]["slot_price"] = $slotsQry[$i]->slot_price;
				$arraySlots[$slotsQry[$i]->slot_id]["booked"] = $booked;
			} else if($bookingSettingObj->getSlotsUnlimited() == 2) {
				$booked = 0;
				$reservationQry = $wpdb->prepare("SELECT SUM(reservation_seats) as seats FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id=%d AND reservation_cancelled = %d GROUP BY slot_id",$slotsQry[$i]->slot_id,0);
				$numrows=$wpdb->query($reservationQry);
				
				if($bookingSettingObj->getShowBookedSlots() == 1 && $numrows>0 && $wpdb->get_var($reservationQry) == $slotsQry[$i]->slot_av) {
					
					
				
					$booked=1;
					$slot_av = 0;
					$arraySlots[$slotsQry[$i]->slot_id] = Array();
					$arraySlots[$slotsQry[$i]->slot_id]["slot_time_from"] = $slotsQry[$i]->slot_time_from;
					$arraySlots[$slotsQry[$i]->slot_id]["slot_time_to"] = $slotsQry[$i]->slot_time_to;
					$arraySlots[$slotsQry[$i]->slot_id]["slot_special_text"] = stripslashes($slotsQry[$i]->slot_special_text);
					$arraySlots[$slotsQry[$i]->slot_id]["slot_special_mode"] = $slotsQry[$i]->slot_special_mode;
					$arraySlots[$slotsQry[$i]->slot_id]["slot_price"] = $slotsQry[$i]->slot_price;
					$arraySlots[$slotsQry[$i]->slot_id]["slot_av"] = $slot_av;
					$arraySlots[$slotsQry[$i]->slot_id]["slot_av_max"] = $slot_av;
					$arraySlots[$slotsQry[$i]->slot_id]["booked"] = $booked;
					
				} else {
					$booked=0;
					if($numrows>0 && $wpdb->get_var($reservationQry) == $slotsQry[$i]->slot_av) {
					} else if($numrows>0) {
						$slot_av = $slotsQry[$i]->slot_av-$wpdb->get_var($reservationQry);
						$slot_av_max=$slotsQry[$i]->slot_av_max;
						if($slot_av_max>$slot_av) {
							$slot_av_max = $slot_av;	
						}
						$arraySlots[$slotsQry[$i]->slot_id] = Array();
						$arraySlots[$slotsQry[$i]->slot_id]["slot_time_from"] = $slotsQry[$i]->slot_time_from;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_time_to"] = $slotsQry[$i]->slot_time_to;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_special_text"] = stripslashes($slotsQry[$i]->slot_special_text);
						$arraySlots[$slotsQry[$i]->slot_id]["slot_special_mode"] = $slotsQry[$i]->slot_special_mode;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_price"] = $slotsQry[$i]->slot_price;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_av"] = $slot_av;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_av_max"] = $slot_av_max;
						$arraySlots[$slotsQry[$i]->slot_id]["booked"] = $booked;
					} else {							
						$slot_av = $slotsQry[$i]->slot_av;	
						$slot_av_max=$slotsQry[$i]->slot_av_max;
						if($slot_av_max>$slot_av) {
							$slot_av_max = $slot_av;	
						}	
						$arraySlots[$slotsQry[$i]->slot_id] = Array();
						$arraySlots[$slotsQry[$i]->slot_id]["slot_time_from"] = $slotsQry[$i]->slot_time_from;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_time_to"] = $slotsQry[$i]->slot_time_to;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_special_text"] = stripslashes($slotsQry[$i]->slot_special_text);
						$arraySlots[$slotsQry[$i]->slot_id]["slot_special_mode"] = $slotsQry[$i]->slot_special_mode;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_price"] = $slotsQry[$i]->slot_price;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_av"] = $slot_av;
						$arraySlots[$slotsQry[$i]->slot_id]["slot_av_max"] = $slot_av_max;
						$arraySlots[$slotsQry[$i]->slot_id]["booked"] = $booked;					
					}
					
					
					
						
					
					
				}
			}
		}
		
		return $arraySlots;
	}
	
	public function getSlotsByReservationsList($reservations) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arraySlots = Array();
		$arrayReservations = explode(",",$reservations);
		$listReservations = "";
		for($i=0;$i<count($arrayReservations);$i++) {
			if($listReservations=="") {
				$listReservations.="'".$arrayReservations[$i]."'";
			} else {
				$listReservations.=",'".$arrayReservations[$i]."'";
			}
		}
		
		$slotsQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE MD5(reservation_id) IN (".$listReservations.")");
		
		for($i=0;$i<count($slotsQry);$i++) {
			array_push($arraySlots,$slotsQry[$i]->slot_id);
		}
		
		return $arraySlots;
	}	
	
	public function getCustomerDataList($reservations) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = explode(",",$reservations);
		$listReservations = "";
		for($i=0;$i<count($arrayReservations);$i++) {
			if($listReservations=="") {
				$listReservations.="'".$arrayReservations[$i]."'";
			} else {
				$listReservations.=",'".$arrayReservations[$i]."'";
			}
		}
		$slotsQry = $wpdb->get_var("SELECT reservation_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE MD5(reservation_id) IN (".$listReservations.") LIMIT 1");
		
		
		return $slotsQry;
	}	
	
	public function getCategoriesList($order_by) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayCategories = Array();
		$categoriesQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories WHERE category_active = %d ".$order_by,1));
		
		for($i=0;$i<count($categoriesQry);$i++) {
			$arrayCategories[$categoriesQry[$i]->category_id] = Array();
			$arrayCategories[$categoriesQry[$i]->category_id]["category_name"] = stripslashes($categoriesQry[$i]->category_name);
			$arrayCategories[$categoriesQry[$i]->category_id]["category_active"] = $categoriesQry[$i]->category_active;
		}
		
		return $arrayCategories;
	}

}

?>
