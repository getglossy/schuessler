<?php

class wp_booking_calendar_public_email {
	private static $mail_id;
	private static $mailQry;
	
	public function setMail($id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$mailQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_emails WHERE email_id = %d",$id));
		
		
		wp_booking_calendar_public_email::$mailQry = $mailQry;
		wp_booking_calendar_public_email::$mail_id=$mailQry[0]->email_id;
	}
	
	public function getMailId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_email::$mail_id;
	}
	
	public function getMailName() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_email::$mailQry[0]->email_name);
	}
	
	public function getMailSubject() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_email::$mailQry[0]->email_subject);
	}
	
	public function getMailText() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_email::$mailQry[0]->email_text);
	}
	
	public function getMailCancelText() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_email::$mailQry[0]->email_cancel_text);
	}
	
	public function getMailSignature() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_email::$mailQry[0]->email_signature);
	}
	
	

}

?>