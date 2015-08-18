<?php

class wp_booking_calendar_public_reservation {
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
		
		
		wp_booking_calendar_public_reservation::$reservationQry = $reservationQry;
		wp_booking_calendar_public_reservation::$reservation_id=$reservationQry[0]->reservation_id;
	}
	
	public function getReservationId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_reservation::$reservation_id;
	}
	
	public function getReservationSlotId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_reservation::$reservationQry[0]->slot_id;
	}
	
	public function getReservationName() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_name);
	}
	
	public function getReservationSurname() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_surname);
	}
	
	public function getReservationEmail() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_email;
	}
	
	public function getReservationPhone() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_phone);
	}
	
	public function getReservationMessage() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_message);
	}
	public function getReservationField1() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_field1);
	}
	
	public function getReservationField2() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_field2);
	}
	
	public function getReservationField3() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_field3);
	}
	
	public function getReservationField4() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_field4);
	}
	
	public function getReservationSeats() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_seats;
	}
	
	public function getReservationConfirmed() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_confirmed;
	}
	
	public function getReservationCancelled() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_reservation::$reservationQry[0]->reservation_cancelled;
	}
	
	public function getReservationPostId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_reservation::$reservationQry[0]->post_id;
	}
	
	
	public function insertReservation($bookingSettingObj) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$listReservations="";
		for($i=0;$i<count($_POST["reservation_slot"]);$i++) {
			$seats=1;
			if(isset($_POST["reservation_seats_".$_POST["reservation_slot"][$i]])) {
				$seats=$_POST["reservation_seats_".$_POST["reservation_slot"][$i]];
			}
			//check if there are available spots for this slot only if configuration is not infinite
			if($bookingSettingObj->getSlotsUnlimited() != 1) {
				$rsSlot = $wpdb->get_var($wpdb->prepare("SELECT slot_av FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_id=%d",$_POST["reservation_slot"][$i]));
				
				$avSeats = $rsSlot;
				$ok = 0;
				$rsRes = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id = %d AND reservation_cancelled=%d",$_POST["reservation_slot"][$i],0));
				if(count($rsRes)==0) {
					$ok = 1;
				} else {
					$totSeats = 0;
					for($z=0;$z<count($rsRes);$z++) {
						$totSeats += $rsRes[$z]->reservation_seats;
					}
					if(($totSeats+$seats)<=$avSeats) {
						$ok = 1;
					}
					
				}
			} else {
				$ok = 1;
			}
			if($ok == 1) {
				$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_reservation(slot_id,reservation_name,reservation_surname,reservation_email,reservation_phone,reservation_message,reservation_seats,reservation_field1,reservation_field2,reservation_field3,reservation_field4,calendar_id,post_id,wordpress_user_id)
							 VALUES(%d,%s,%s,%s,%s,%s,%d,%s,%s,%s,%s,%d,%d,%d)",$_POST["reservation_slot"][$i],$_POST["reservation_name"],$_POST["reservation_surname"],$_POST["reservation_email"],$_POST["reservation_phone"],$_POST["reservation_message"],$seats,$_POST["reservation_field1"],$_POST["reservation_field2"],$_POST["reservation_field3"],$_POST["reservation_field4"],$_POST["calendar_id"],$_POST["post_id"],$_POST["wordpress_user_id"]));
		
				if($listReservations == "") {
					$listReservations.="".md5($wpdb->insert_id)."";
				} else {
					$listReservations.=",".md5($wpdb->insert_id)."";				
				}
			}
		}
		
		return $listReservations;
		
		
	}
	
	public function confirmReservations($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = explode(",",$listIds);
		$listReservations = "";
		for($i=0;$i<count($arrayReservations);$i++) {
			if($listReservations=="") {
				$listReservations.="'".$arrayReservations[$i]."'";
			} else {
				$listReservations.=",'".$arrayReservations[$i]."'";
			}
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_reservation SET reservation_confirmed = %d WHERE MD5(reservation_id) IN (".$listReservations.")",1));
	}
	
	
	public function cancelReservations($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = explode(",",$listIds);
		$listReservations = "";
		for($i=0;$i<count($arrayReservations);$i++) {
			if($listReservations=="") {
				$listReservations.="'".$arrayReservations[$i]."'";
			} else {
				$listReservations.=",'".$arrayReservations[$i]."'";
			}
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_reservation SET reservation_cancelled = %d, reservation_confirmed = %d WHERE MD5(reservation_id) IN (".$listReservations.")",1,0));
		$checkCalendar = "SELECT calendar_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE MD5(reservation_id) IN (".$listReservations.")";
		
		$calendar_id = 0;
		if($wpdb->query($checkCalendar)>0) {
			$calendar_id=$wpdb->get_var($checkCalendar);
		}
		return $calendar_id;
	}
	
	public function deleteReservations($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = explode(",",$listIds);
		$listReservations = "";
		for($i=0;$i<count($arrayReservations);$i++) {
			if($listReservations=="") {
				$listReservations.="'".$arrayReservations[$i]."'";
			} else {
				$listReservations.=",'".$arrayReservations[$i]."'";
			}
		}
		$wpdb->query("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE MD5(reservation_id) IN (".$listReservations.")");
	}
	
	public function checkReservationPaypalPaid($listIds) {
		global $wpdb;
		global $blog_id;
		$result = 0;
		$count = 0;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = explode(",",$listIds);
		for($i=0;$i<count($arrayReservations);$i++) {
			$checkQry=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE MD5(reservation_id) = %s AND reservation_confirmed = %d",$arrayReservations[$i],1));
			if($checkQry>0) {
				$count++;
			}
		}
		
		if($count == count($arrayReservations)) {
			$result = 1;
		}
		return $result; 
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
			
			$resDate = str_replace("-","",$reservationQry[0]->slot_date).str_replace(":","",$reservationQry[0]->slot_time_from);
			if($resDate<date('YmdHis')) {
				$result = true;
			} 
		}
		return $result;
		
	}
	
	public function isAdminConfirmed($listIds) {
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
			$reservationQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE MD5(reservation_id) = %s",$arrayReservations[$i]));
			
			if($reservationQry[0]->admin_confirmed_cancelled == 1) {
				$result = true;
			}
		}
		return $result;
		
	}
	
	public function getReservationsDetails($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayReservations = explode(",",$listIds);
		$listReservations = "";
		for($i=0;$i<count($arrayReservations);$i++) {
			if($listReservations=="") {
				$listReservations.="'".$arrayReservations[$i]."'";
			} else {
				$listReservations.=",'".$arrayReservations[$i]."'";
			}
		}
		$arrayReservations = Array();
		$reservationsQry =$wpdb->get_results("SELECT r.*,s.*,s.calendar_id as res_calendar, DATE_FORMAT(slot_time_from,'%I:%i %p') as slot_time_from_ampm, DATE_FORMAT(slot_time_to,'%I:%i %p') as slot_time_to_ampm FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation r INNER JOIN ".$wpdb->base_prefix.$blog_prefix."booking_slots s ON s.slot_id=r.slot_id WHERE MD5(r.reservation_id) IN (".$listReservations.") ORDER BY s.slot_date, s.slot_time_from");
		for($i=0;$i<count($reservationsQry);$i++) {
			$arrayReservations[$reservationsQry[$i]->reservation_id] = Array();
			$arrayReservations[$reservationsQry[$i]->reservation_id]["calendar_id"] = $reservationsQry[$i]->res_calendar;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_date"] = $reservationsQry[$i]->slot_date;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_time_from"] = $reservationsQry[$i]->slot_time_from;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_time_to"] = $reservationsQry[$i]->slot_time_to;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_time_from_ampm"] = $reservationsQry[$i]->slot_time_from_ampm;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_time_to_ampm"] = $reservationsQry[$i]->slot_time_to_ampm;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_seats"] = $reservationsQry[$i]->reservation_seats;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_price"] = $reservationsQry[$i]->slot_price;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_surname"] = stripslashes($reservationsQry[$i]->reservation_surname);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_name"] = stripslashes($reservationsQry[$i]->reservation_name);
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_email"] = $reservationsQry[$i]->reservation_email;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_message"] = $reservationsQry[$i]->reservation_message;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_phone"] = $reservationsQry[$i]->reservation_phone;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_field1"] = $reservationsQry[$i]->reservation_field1;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_field2"] = $reservationsQry[$i]->reservation_field2;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_field3"] = $reservationsQry[$i]->reservation_field3;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_field4"] = $reservationsQry[$i]->reservation_field4;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_confirmed"] = $reservationsQry[$i]->reservation_confirmed;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["reservation_cancelled"] = $reservationsQry[$i]->reservation_cancelled;
			$arrayReservations[$reservationsQry[$i]->reservation_id]["slot_active"] = $reservationsQry[$i]->slot_active;
		}
		
		return $arrayReservations;
		
	}
	

}

?>
