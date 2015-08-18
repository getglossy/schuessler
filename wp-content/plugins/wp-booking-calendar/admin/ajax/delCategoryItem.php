<?php
include '../common.php';

global $wpdb;
$item_id = $_REQUEST["item_id"];	

$bookingCategoryObj->delCategories($item_id);

include 'categories.php';
?>

