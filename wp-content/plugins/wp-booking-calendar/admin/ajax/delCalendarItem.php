<?php
include '../common.php';

global $wpdb;
global $blog_id;
$blog_prefix=$blog_id."_";
if($blog_id==1) {
	$blog_prefix="";
}
$item_id = $_REQUEST["item_id"];	

$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_calendars WHERE calendar_id = %d",$item_id));

//delete, holidays, slots and reservations
$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_holidays WHERE calendar_id = %d",$item_id));
$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_slots WHERE calendar_id = %d",$item_id));
$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->base_prefix.$blog_prefix."booking_reservation WHERE calendar_id = %d",$item_id));



include 'wp_booking_calendars.php';
?>

