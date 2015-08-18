<?php

class wp_booking_calendar_public_lang {
	
	private function doLanguageQuery($label) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$languageQry = $wpdb->get_var($wpdb->prepare("SELECT text_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE text_label=%s",$label));
		return $languageQry;
	}
	
	public function getLabel($label) {
		global $wpdb;
		return stripslashes(wp_booking_calendar_public_lang::doLanguageQuery($label));
	}
	
	
	

}

?>
