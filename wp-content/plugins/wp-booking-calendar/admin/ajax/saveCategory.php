<?php
include '../common.php';
global $wpdb;
global $blog_id;
$blog_prefix=$blog_id."_";
if($blog_id==1) {
	$blog_prefix="";
}
$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_categories SET category_name= %s WHERE category_id = %d",$_REQUEST["name"],$_REQUEST["item_id"]));
		
	

?>
