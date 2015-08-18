<?php

class wp_booking_calendar_public_category {
	private static $category_id;
	private static $categoryQry;
	
	public function setCategory($id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$categoryQry = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories WHERE category_id = %d",$id));
		
		wp_booking_calendar_public_category::$categoryQry = $categoryQry;
		wp_booking_calendar_public_category::$category_id=$categoryQry[0]->category_id;
	}
	
	public function getCategoryId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_category::$category_id;
	}
	
	public function getCategoryName() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_public_category::$categoryQry[0]->category_name);
	}
	
	public function getCategoryActive() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_public_category::$categoryQry[0]->category_active;
	}
	
	public function getCategoryRecordcount() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		return $wpdb->query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories");
	}
	
	public function getDefaultCategory() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$categoryQry = $wpdb->prepare("SELECT category_id FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories WHERE category_order = %d AND category_active = %d",0,1);
		
		$numrows = $wpdb->query($categoryQry);
		
		if($numrows > 0) {
			$categoryRow = $wpdb->get_var($categoryQry);
			$this->setCategory($categoryRow);
			
			return true;
		} else {
			return false;
		}
	}
	


}

?>