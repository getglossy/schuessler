<?php
include '../common.php';
global $wpdb;
global $blog_id;
$blog_prefix=$blog_id."_";
if($blog_id==1) {
	$blog_prefix="";
}
$item_id = $_REQUEST["item_id"];	

$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_reservation SET reservation_cancelled = 1 WHERE reservation_id = %d",$item_id));




include 'users_reservation.php';
?>
