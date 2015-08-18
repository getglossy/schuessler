<?php
include '../common.php';

global $wpdb;
global $blog_id;
$blog_prefix=$blog_id."_";
if($blog_id==1) {
	$blog_prefix="";
}
$item_id = $_REQUEST["reservation_id"];	

$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_reservation SET reservation_confirmed = %d,admin_confirmed_cancelled = %d WHERE reservation_id = %d",0,1,$item_id));



?>