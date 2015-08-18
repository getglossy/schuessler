<?php
include '../common.php';

global $wpdb;
global $blog_id;
$blog_prefix=$blog_id."_";
if($blog_id==1) {
	$blog_prefix="";
}
$item_id = $_REQUEST["calendar_id"];	

$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_calendars SET calendar_active = 1 WHERE calendar_id = %d",$item_id));



?>