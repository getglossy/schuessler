<?php
include '../common.php';

$name = $_REQUEST["category_name"];

$newid=$bookingCategoryObj->addCategory($name);

include 'categories.php';
?>

<script>
	window.parent.showActionBar();
</script>

