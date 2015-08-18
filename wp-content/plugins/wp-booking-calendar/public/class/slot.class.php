<?php

class wp_booking_calendar_public_slot {
	private static $slot_id;
	private static $slotQry;
	
	public function setSlot($id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$slotQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_id = %d",$id));
		
		wp_booking_calendar_public_slot::$slotQry = $slotQry;
		wp_booking_calendar_public_slot::$slot_id=$slotQry[0]->slot_id;
	}
	
	public function getSlotId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_slot::$slot_id;
	}
	
	public function getSlotCalendarId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_slot::$slotQry[0]->calendar_id;
	}
	
	public function getSlotDate() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_slot::$slotQry[0]->slot_date;
	}
	
	public function getSlotTimeFrom() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_slot::$slotQry[0]->slot_time_from;
	}
	
	public function getSlotTimeTo() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_slot::$slotQry[0]->slot_time_to;
	}
	
	public function getSlotTimeFromAMPM() {
		global $wpdb;
		global $blog_id;
		return date('h:i a',strtotime(wp_booking_calendar_public_slot::$slotQry[0]->slot_time_from));
	}
	
	public function getSlotTimeToAMPM() {
		global $wpdb;
		global $blog_id;
		return date('h:i a',strtotime(wp_booking_calendar_public_slot::$slotQry[0]->slot_time_to));
	}
	
	public function getSlotSpecialText() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_slot::$slotQry[0]->slot_special_text);
	}
	
	public function getSlotSpecialMode() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_slot::$slotQry[0]->slot_special_mode;
	}
	
	public function getSlotPrice() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_slot::$slotQry[0]->slot_price;
	}
	
	public function checkFutureSlots($year,$month,$day,$calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$slotsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_date > %s AND slot_active = %d AND calendar_id=%d",$year."-".$month."-".$day,1,$calendar_id));
		$totRighe = 0;
		if(count($slotsQry)>0) {
			for($i=0;$i<count($slotsQry);$i++) {
				//check reservations
				$reservationQry=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id=%d AND reservation_cancelled = %d",$slotsQry[$i]->slot_id,0));
				if($reservationQry>0) {
					
				} else {
					$totRighe++;
				}
			}
			
			if($totRighe>0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
		
		
	}
	
	public function checkPastSlots($year,$month,$day,$calendar_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$slotsQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_date < %s AND slot_active = %d AND calendar_id=%d",$year."-".$month."-".$day,1,$calendar_id));
		$totRighe = 0;
		if(count($slotsQry)>0) {
			for($i=0;$i<count($slotsQry);$i++) {
				//check reservations
				$reservationQry=$wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id=%d AND reservation_cancelled = %d",$slotsQry[$i]->slot_id,0));
				if(($slotsQry[$i]->slot_date == date('Y-m-d') && str_replace(":","",$slotsQry[0]->slot_time_from)<date('His')) || $reservationQry>0) {
					
				} else {
					$totRighe++;
				}
			}
			
			if($totRighe>0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
		
	}

}

?>
