<?php
class wp_booking_calendar_lists {	
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
		$slotsQry = $wpdb->get_results("SELECT DISTINCT slot_time_from FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_date >= DATE_FORMAT(NOW(),'%Y-%m-%d') AND slot_active = 1 AND calendar_id = '".$calendar_id."' ORDER BY slot_time_from");
		
		for($i=0;$i<count($slotsQry);$i++) {
			array_push($arraySlots,$slotsQry[$i]->slot_time_from);
		}
		return $arraySlots;
	}	
	
	public function getSlotsList($filter,$order_by,$calendar_id,$num = 0,$pag = 0) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arraySlots = Array();
		if($pag == 0) {
			$slotsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_active = %d AND calendar_id = %d ".$filter." ".$order_by,1,$calendar_id));
		} else {
			if($pag == 1) {
				$start = 0;
			} else {
				$start=(($pag-1)*$num)+1;
			}
			$slotsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_active = %d AND calendar_id = %d ".$filter." ".$order_by." LIMIT ".$start.",".$num,1,$calendar_id));
		}
		for($i=0;$i<count($slotsQry);$i++) {
			$arraySlots[$slotsQry[$i]->slot_id] = Array();
			$arraySlots[$slotsQry[$i]->slot_id]["slot_date"] = $slotsQry[$i]->slot_date;
			$arraySlots[$slotsQry[$i]->slot_id]["slot_time_from"] = $slotsQry[$i]->slot_time_from;
			$arraySlots[$slotsQry[$i]->slot_id]["slot_time_to"] = $slotsQry[$i]->slot_time_to;
			$arraySlots[$slotsQry[$i]->slot_id]["slot_special_text"] = stripslashes($slotsQry[$i]->slot_special_text);
			$arraySlots[$slotsQry[$i]->slot_id]["slot_price"] = $slotsQry[$i]->slot_price;
			$arraySlots[$slotsQry[$i]->slot_id]["slot_av"] = $slotsQry[$i]->slot_av;
			$arraySlots[$slotsQry[$i]->slot_id]["slot_av_max"] = $slotsQry[$i]->slot_av_max;
			
			$reservationQry = $wpdb->prepare("SELECT SUM(reservation_seats) as res FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id = %d AND reservation_cancelled = %d GROUP BY slot_id",$slotsQry[$i]->slot_id,0);
			$reservationCount=$wpdb->query($reservationQry);
			
			$reservation = 0;
			if($reservationCount>0) {
				$reservation=$wpdb->get_var($reservationQry);
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
		$reservationsQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id=r.slot_id WHERE r.calendar_id = '".$calendar_id."' AND s.calendar_id = '".$calendar_id."' ".$filter." ".$order_by);
		
		for($i=0;$i<count($reservationsQry);$i++) {
			$arrayReservations[$reservationsQry[$i]->reservation_id] = Array();
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_date"] = $reservationsQry[$i]->slot_date;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_time"] = $reservationsQry[$i]->slot_time_from;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_surname"] = stripslashes($reservationsQry[$i]->reservation_surname);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_name"] = stripslashes($reservationsQry[$i]->reservation_name);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_phone"] = stripslashes($reservationsQry[$i]->reservation_phone);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_message"] = stripslashes($reservationsQry[$i]->reservation_message);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_field1"] = stripslashes($reservationsQry[$i]->reservation_field1);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_field2"] = stripslashes($reservationsQry[$i]->reservation_field2);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_field3"] = stripslashes($reservationsQry[$i]->reservation_field3);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_field4"] = stripslashes($reservationsQry[$i]->reservation_field4);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_email"] = $reservationsQry[$i]->reservation_email;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_seats"] = $reservationsQry[$i]->reservation_seats;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_confirmed"] = $reservationsQry[$i]->reservation_confirmed;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_cancelled"] = $reservationsQry[$i]->reservation_cancelled;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["slot_active"] = $reservationsQry[$i]->slot_active;
		}
		
		return $arrayReservations;
	}	
	
	public function getUsersReservationsList($filter,$order_by,$user_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = Array();
		$reservationsQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id=r.slot_id WHERE r.wordpress_user_id = '".$user_id."'  ".$filter." ".$order_by);
		
		for($i=0;$i<count($reservationsQry);$i++) {
			$arrayReservations[$reservationsQry[$i]->reservation_id] = Array();
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_date"] = $reservationsQry[$i]->slot_date;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_time"] = $reservationsQry[$i]->slot_time_from;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_surname"] = stripslashes($reservationsQry[$i]->reservation_surname);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_name"] = stripslashes($reservationsQry[$i]->reservation_name);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_phone"] = stripslashes($reservationsQry[$i]->reservation_phone);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_message"] = stripslashes($reservationsQry[$i]->reservation_message);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_email"] = $reservationsQry[$i]->reservation_email;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_seats"] = $reservationsQry[$i]->reservation_seats;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_confirmed"] = $reservationsQry[$i]->reservation_confirmed;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_cancelled"] = $reservationsQry[$i]->reservation_cancelled;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["slot_active"] = $reservationsQry[$i]->slot_active;
		}
		
		return $arrayReservations;
	}	
	
	public function getCalendarsList($filter = '') {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayCalendars = Array();
		$calendarsQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE 0=0 ".$filter." ORDER BY calendar_order");
		
		for($i=0;$i<count($calendarsQry);$i++) {
			$arrayCalendars[$calendarsQry[$i]->calendar_id] = Array();
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_title"] = stripslashes($calendarsQry[$i]->calendar_title);
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_order"] = $calendarsQry[$i]->calendar_order;
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_active"] = $calendarsQry[$i]->calendar_active;
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["category_id"] = $calendarsQry[$i]->category_id;
		}
		
		return $arrayCalendars;
	}
	
	public function getCalendarsResList() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayCalendars = Array();
		$calendarsQry = $wpdb->get_results("SELECT c.*, COUNT(r.reservation_id) as tot_reservation FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars c LEFT JOIN ".$wpdb->base_prefix.$blog_prefix."booking_reservation r ON r.calendar_id = c.calendar_id  GROUP BY c.calendar_id ORDER BY c.calendar_order");
		
		for($i=0;$i<count($calendarsQry);$i++) {
			$arrayCalendars[$calendarsQry[$i]->calendar_id] = Array();
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_title"] = $calendarsQry[$i]->calendar_title;
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_order"] = $calendarsQry[$i]->calendar_order;
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["calendar_active"] = $calendarsQry[$i]->calendar_active;
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["category_id"] = $calendarsQry[$i]->category_id;
			$arrayCalendars[$calendarsQry[$i]->calendar_id]["tot_reservation"] = $calendarsQry[$i]->tot_reservation;
		}
		
		return $arrayCalendars;
	}
	
	public function getMailsList() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayMails = Array();
		$mailsQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_emails");
		
		for($i=0;$i<count($mailsQry);$i++) {
			$arrayMails[$mailsQry[$i]->email_id] = Array();
			$arrayMails[$mailsQry[$i]->email_id]["email_name"] = $mailsQry[$i]->email_name;
		}
		
		return $arrayMails;
	}
	
	public function getPaypalLocaleList() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayLocales = Array();
		$localesQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_locale ORDER BY locale_country");
		
		for($i=0;$i<count($localesQry);$i++) {
			$arrayLocales[$localesQry[$i]->locale_id] = Array();
			$arrayLocales[$localesQry[$i]->locale_id]["locale_country"] = $localesQry[$i]->locale_country;
			$arrayLocales[$localesQry[$i]->locale_id]["locale_code"] = $localesQry[$i]->locale_code;
		}
		
		return $arrayLocales;
	}
	
	public function getPaypalCurrencyList() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayCurrencies = Array();
		$currenciesQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_paypal_currency ORDER BY currency_name");
		
		for($i=0;$i<count($currenciesQry);$i++) {
			$arrayCurrencies[$currenciesQry[$i]->currency_id] = Array();
			$arrayCurrencies[$currenciesQry[$i]->currency_id]["currency_name"] = $currenciesQry[$i]->currency_name;
			$arrayCurrencies[$currenciesQry[$i]->currency_id]["currency_code"] = $currenciesQry[$i]->currency_code;
		}
		
		return $arrayCurrencies;
	}
	
	public function getCategoriesList() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayCategories = Array();
		$categoriesQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories ORDER BY category_order");
		
		for($i=0;$i<count($categoriesQry);$i++) {
			$arrayCategories[$categoriesQry[$i]->category_id] = Array();
			$arrayCategories[$categoriesQry[$i]->category_id]["category_name"] = stripslashes($categoriesQry[$i]->category_name);
			$arrayCategories[$categoriesQry[$i]->category_id]["category_order"] = $categoriesQry[$i]->category_order;
			$arrayCategories[$categoriesQry[$i]->category_id]["category_active"] = $categoriesQry[$i]->category_active;
		}
		
		return $arrayCategories;
	}
	
	public function getTextsList($page_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayTexts = Array();
		$textsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE page_id= %d",$page_id));
		
		for($i=0;$i<count($textsQry);$i++) {
			$arrayTexts[$textsQry[$i]->text_id] = Array();
			$arrayTexts[$textsQry[$i]->text_id]["text_value"] = stripslashes($textsQry[$i]->text_value);
			$arrayTexts[$textsQry[$i]->text_id]["text_label"] = $textsQry[$i]->text_label;
			$arrayTexts[$textsQry[$i]->text_id]["page_id"] = $textsQry[$i]->page_id;
		}
		
		return $arrayTexts;
	}
}

?>
