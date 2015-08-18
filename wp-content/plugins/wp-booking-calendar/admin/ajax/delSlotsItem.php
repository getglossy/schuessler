<?php
include '../common.php';
global $wpdb;
global $blog_id;
$blog_prefix=$blog_id."_";
if($blog_id==1) {
	$blog_prefix="";
}
$item_id = $_REQUEST["item_id"];	
if($_REQUEST["reservation"] == "NO") {
	$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE slot_id = %d",$item_id));
} else {
	$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_slots SET slot_active = 0 WHERE slot_id = %d",$item_id));
}


include 'slots.php';
?>
