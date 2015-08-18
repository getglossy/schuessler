<?php
include '../common.php';

/********check if there are reservation and if there are slots with same time/date***********/
$result=$bookingSlotsObj->checkEditSlotsReservation();
if($result > 0) {
?>
	<script>
		if(confirm("<?php echo $bookingLangObj->getLabel("MODIFY_SLOTS_ALERT"); ?>")) {
			window.parent.document.forms["modify_slots"].action="";
			window.parent.document.forms["modify_slots"].target="_self";
			window.parent.document.forms["modify_slots"].submit();
		} else {
			window.parent.document.getElementById('edit_button').disabled=false;
		}
	</script>
<?php
} else if($result == 0) {
?>
	<script>            
		window.parent.document.getElementById('result_modify').innerHTML = "<img src='<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.gif'>";
		setTimeout("submitForm()",3000);
		function submitForm() {
			window.parent.document.forms["modify_slots"].action="";
			window.parent.document.forms["modify_slots"].target="_self";
			window.parent.document.forms["modify_slots"].submit();            
		}
	</script>
<?php
} else if($result == -1) {
?>
<script>            
	alert("<?php echo $bookingLangObj->getLabel("DUPLICATE_SLOTS_ALERT"); ?>");
	window.parent.document.getElementById('edit_button').disabled=false;
</script>
<?php
}


?>
