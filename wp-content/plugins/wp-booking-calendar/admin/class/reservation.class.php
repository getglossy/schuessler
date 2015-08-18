<?php

class wp_booking_calendar_reservation {
	private static $reservation_id;
	private static $reservationQry;
	
	public function setReservation($id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$reservationQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE reservation_id = %d",$id));
		
		
		wp_booking_calendar_reservation::$reservationQry = $reservationQry;
		wp_booking_calendar_reservation::$reservation_id=$reservationQry[0]->reservation_id;
	}
	
	public function getReservationId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_reservation::$reservation_id;
	}
	
	public function getReservationSlotId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_reservation::$reservationQry[0]->slot_id;
	}
	
	public function getReservationCalendarId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_reservation::$reservationQry[0]->calendar_id;
	}
	
	public function getReservationName() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_reservation::$reservationQry[0]->reservation_name);
	}
	
	public function getReservationSurname() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_reservation::$reservationQry[0]->reservation_surname);
	}
	
	public function getReservationEmail() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_reservation::$reservationQry[0]->reservation_email;
	}
	
	public function getReservationPhone() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_reservation::$reservationQry[0]->reservation_phone);
	}
	
	public function getReservationMessage() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_reservation::$reservationQry[0]->reservation_message);
	}
	
	public function getReservationSeats() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_reservation::$reservationQry[0]->reservation_seats;
	}
	
	public function getReservationField1() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_reservation::$reservationQry[0]->reservation_field1);
	}
	
	public function getReservationField2() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_reservation::$reservationQry[0]->reservation_field2);
	}
	
	public function getReservationField3() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_reservation::$reservationQry[0]->reservation_field3);
	}
	
	public function getReservationField4() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_reservation::$reservationQry[0]->reservation_field4);
	}
	public function getReservationConfirmed() {
		global $wpdb;
		return wp_booking_calendar_reservation::$reservationQry[0]->reservation_confirmed;
	}
	
	public function getReservationCancelled() {
		global $wpdb;
		return wp_booking_calendar_reservation::$reservationQry[0]->reservation_cancelled;
	}
	
	public function getReservationPostId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_reservation::$reservationQry[0]->post_id;
	}
	
	public function delReservations($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE reservation_id IN (".$listIds.")");
	}
	
	public function isPassed($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = explode(",",$listIds);
		$result = false;
		$listReservations = "";
		for($i=0;$i<count($arrayReservations);$i++) {
			$reservationQry = $wpdb->get_results($wpdb->prepare("SELECT s.* FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id = r.slot_id WHERE MD5(r.reservation_id) = %s",$arrayReservations[$i]));
			$reservationRow = $reservationQry[0];
			$resDate = str_replace("-","",$reservationRow->slot_date).str_replace(":","",$reservationRow->slot_time_from);
			if($resDate<date('YmdHis')) {
				$result = true;
			} 
		}
		return $result;
		
	}
	
	

}

?>
