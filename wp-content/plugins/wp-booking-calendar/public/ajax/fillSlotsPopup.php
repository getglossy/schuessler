<?php
include '../common.php';
$bookingCalendarObj->setCalendar($_GET["calendar_id"]);
$arraySlots = $bookingListObj->getSlotsPerDayList($_GET["year"],$_GET["month"],$_GET["day"],$_GET["calendar_id"],$bookingSettingObj);
//calculate how many columns we need
$columns=ceil(count($arraySlots)/6);
//max number columns is 9, so if there are too many slots, have to add lines instead of columns
if($bookingSettingObj->getTimeFormat() == "12") {
	$maxColumn = 7;
} else {
	$maxColumn = 9;
}
$lines=6;
if($columns>$maxColumn) {
	$columns=$maxColumn;
	$lines=7;
	do {
		$lines++;
	} while(ceil(count($arraySlots)/$lines)>$maxColumn);
}
$styleAttr = 'style="margin-left: 20px;"';
$totCols=0;
?>
<div class="booking_box_preview_column" <?php echo $styleAttr; ?>>
	<?php
	$z=1;
	if(count($arraySlots) == 1) {
		?>
        <div class="booking_slot_special_container">
        <?php
		foreach($arraySlots as $slotId => $slot) {
			if($slot["booked"] == 1) {
				echo '<span class="booking_booked_slot">';
			}
			
			if($slot["slot_special_mode"] == 1) {
				if($bookingSettingObj->getTimeFormat() == "12") {
					echo date('h:i a',strtotime(substr($slot["slot_time_from"],0,5)))." - ".date('h:i a',strtotime(substr($slot["slot_time_to"],0,5)));
				} else {
					echo substr($slot["slot_time_from"],0,5)." - ".substr($slot["slot_time_to"],0,5);
				}
				if($slot["slot_special_text"] != '') {
					echo " - ".$slot["slot_special_text"]; 
				}
			} else if($slot["slot_special_mode"] == 0 && $slot["slot_special_text"] != '') {
				echo $slot["slot_special_text"]; 
			} else {
				if($bookingSettingObj->getTimeFormat() == "12") {
					echo date('h:i a',strtotime(substr($slot["slot_time_from"],0,5)))." - ".date('h:i a',strtotime(substr($slot["slot_time_to"],0,5)));
				} else {
					echo substr($slot["slot_time_from"],0,5)." - ".substr($slot["slot_time_to"],0,5);
				}
			}
			
			if($slot["booked"] == 1) {
				echo '</span>';
			}
			
		}
		?>
        </div>
        <?php
		
	} else {
		foreach($arraySlots as $slotId => $slot) {
		  ?>
		  <div class="booking_box_preview_row">
			<?php 
			if($slot["booked"] == 1) {
				echo '<span class="booking_booked_slot">';
			}
			if($slot["slot_special_mode"] == 1) {	
				if($bookingSettingObj->getTimeFormat() == "12") {
					echo date('h:i a',strtotime(substr($slot["slot_time_from"],0,5)))." - ".date('h:i a',strtotime(substr($slot["slot_time_to"],0,5)))." ".$slot["slot_special_text"];
				} else {
					echo substr($slot["slot_time_from"],0,5)." - ".substr($slot["slot_time_to"],0,5)." ".$slot["slot_special_text"];
				}
			} else if($slot["slot_special_mode"] == 0 && $slot["slot_special_text"] != '') {
					
					echo $slot["slot_special_text"]; 
			} else {
				
				if($bookingSettingObj->getTimeFormat() == "12") {
					echo date('h:i a',strtotime(substr($slot["slot_time_from"],0,5)))." - ".date('h:i a',strtotime(substr($slot["slot_time_to"],0,5)));
				} else {
					echo substr($slot["slot_time_from"],0,5)." - ".substr($slot["slot_time_to"],0,5);
				}
				
			}
			/*if($bookingSettingObj->getTimeFormat() == "12") {
				echo date('h:i a',strtotime(substr($slot["slot_time_from"],0,5)))." - ".date('h:i a',strtotime(substr($slot["slot_time_to"],0,5)));
			} else {
				echo substr($slot["slot_time_from"],0,5)." - ".substr($slot["slot_time_to"],0,5);
			}*/
			if($slot["booked"] == 1) {
				echo '</span>';
			}
			
			?>
		  </div>
		  <?php
		  if($z % $lines == 0) {
			  $totCols++;
			  if($totCols == $columns-1) {
				  $styleAttr='style="margin-right: 20px;"';
			  }
			  ?>
			  </div>
			  <div class="booking_box_preview_column" <?php echo $styleAttr; ?>>
			  <?php
		  }
		  $z++;
		}
	}
    ?>
</div>
|
<?php echo $bookingCalendarObj->getCalendarTitle(); ?>
