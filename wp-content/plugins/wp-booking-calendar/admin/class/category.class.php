<?php

class wp_booking_calendar_category {
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
		
		
		wp_booking_calendar_category::$categoryQry = $categoryQry;
		wp_booking_calendar_category::$category_id=$categoryQry[0]->category_id;
	}
	
	public function getCategoryId() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_category::$category_id;
	}
	
	public function getCategoryName() {
		global $wpdb;
		global $blog_id;
		return stripslashes(wp_booking_calendar_category::$categoryQry[0]->category_name);
	}
	
	public function getCategoryActive() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_category::$categoryQry[0]->category_active;
	}
	
	public function getCategoryOrder() {
		global $wpdb;
		global $blog_id;
		return wp_booking_calendar_category::$categoryQry[0]->category_order;
	}
	
	public function publishCategories($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_categories SET category_active = %d WHERE category_id IN (".$listIds.")",1));
	}
	
	public function unpublishCategories($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_categories SET category_active = %d WHERE category_id IN (".$listIds.")",0));
	}
	
	public function delCategories($listIds) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories WHERE category_id IN (".$listIds.")");
		$calendarsQry = $wpdb->get_results("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE category_id IN (".$listIds.")");
		for($i=0;$i<count($calendarsQry);$i++) {
			$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE calendar_id = %d",$calendarsQry[0]->calendar_id));
			//delete holidays
			$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE calendar_id =%d",$calendarsQry[0]->calendar_id));
			//check for reservations, if any disable slots, otherwise del slots
			$slotsQry=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE calendar_id = %d",$calendarsQry[0]->calendar_id));
			for($i=0;$i<count($slotsQry);$i++) {
				$query = $wpdb->prepare("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id = %d",$slotsQry[$i]->slot_id);
				$numRes = $wpdb->query($query);
				
				//$numRes=mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE slot_id =".$slotRow["slot_id"]));
				if($numRes>0) {
					$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_slots SET slot_active = %d WHERE slot_id  = %d",0,$slotsQry[$i]->slot_id));
				} else {
					$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots  WHERE slot_id = %d",$slotsQry[$i]->slot_id));
				}
			}
			
		}
		
		
	}
	
	public function addCategory($name) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$newOrder = 0;
		//check order of last calendar
		$catQuery = "SELECT category_order as max FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories ORDER BY category_order DESC LIMIT 1";
		$numrows = $wpdb->query($catQuery);
		if($numrows>0) {
			$newOrder = $wpdb->get_var($catQuery)+1;
		}
		/*$calOrderQry = mysql_query("SELECT category_order as max FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories ORDER BY category_order DESC LIMIT 1");
		if(mysql_num_rows($calOrderQry)>0) {
			$newOrder=mysql_result($calOrderQry,0,'max')+1;
		}*/
		$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->base_prefix.$blog_prefix."booking_categories (category_name,category_order,category_active) VALUES(%s,%d,%d)",$name,$newOrder,0));
		$category_id=$wpdb->insert_id;
		return $category_id;
	}
	
	
	public function getCategoryRecordcount() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		return $wpdb->query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories");
		//return mysql_num_rows(mysql_query("SELECT * FROM ".$wpdb->base_prefix.$blog_prefix."booking_categories"));
	}
	
	public function setDefaultCategory($category_id) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_categories SET category_order = %d, category_active = %d WHERE category_id= %d",0,1,$category_id));
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_categories SET category_order = category_order +1 WHERE category_id <> %d",$category_id));
	}
	
	

}

?>