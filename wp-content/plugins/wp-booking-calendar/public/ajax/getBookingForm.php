<?php
include '../common.php';
$bookingCalendarObj->setCalendar($_GET["calendar_id"]);

//preparing week days
$weekdays=Array();
$weekdays[0] = $bookingLangObj->getLabel("SUNDAY");
$weekdays[1] = $bookingLangObj->getLabel("MONDAY");
$weekdays[2] = $bookingLangObj->getLabel("TUESDAY");
$weekdays[3] = $bookingLangObj->getLabel("WEDNESDAY");
$weekdays[4] = $bookingLangObj->getLabel("THURSDAY");
$weekdays[5] = $bookingLangObj->getLabel("FRIDAY");
$weekdays[6] = $bookingLangObj->getLabel("SATURDAY");

$maxColumn = 0;
$arraySlots = $bookingListObj->getSlotsPerDayList($_GET["year"],$_GET["month"],$_GET["day"],$_GET["calendar_id"],$bookingSettingObj);
foreach($arraySlots as $slotId => $slot) {
	if($slot["slot_special_text"]!='') {
		$maxColumn = 1;
	}
}//calculate how many columns we need
$columns=ceil(count($arraySlots)/6);
//max number columns is 9, so if there are too many slots, have to add lines instead of columns
if($bookingSettingObj->getPaypalDisplayPrice() == 1 && $bookingSettingObj->getSlotsUnlimited() != 2 && $maxColumn == 0) {
	$maxColumn = 2;
	
} else if($bookingSettingObj->getSlotsUnlimited() == 2 && $maxColumn == 0) {
	$maxColumn=1;
} else if($maxColumn == 0) {
	if($bookingSettingObj->getTimeFormat() == "12") {
		$maxColumn = 3;
	} else {
		$maxColumn = 4;
	}
}
$lines=6;
if($columns>$maxColumn) {
	$columns=$maxColumn;
	$lines=7;
	do {
		$lines++;
	} while(ceil(count($arraySlots)/$lines)>$maxColumn && $lines < 13);
}

$totCols=0;
$page=1;

//get the next and prev dates with available slots
//first I check if there are slots in the future
if($bookingSlotsObj->checkFutureSlots($_GET["year"],$_GET["month"],$_GET["day"],$_GET["calendar_id"])) {
	$next =strtotime(date("Y-m-d",mktime(0,0,0,$_GET["month"],$_GET["day"],$_GET["year"])) . "+ 1 day");
	$nextDay = date("d",$next);
	$nextMonth = date("m",$next);
	$nextYear = date("Y",$next);
	$arraySlotsNext = $bookingListObj->getSlotsPerDayList($nextYear,$nextMonth,$nextDay,$_GET["calendar_id"],$bookingSettingObj);
	if(count($arraySlotsNext)==0) {
		do {
			$next =strtotime(date("Y-m-d",mktime(0,0,0,$nextMonth,$nextDay,$nextYear)) . "+ 1 day");
			$nextDay = date("d",$next);
			$nextMonth = date("m",$next);
			$nextYear = date("Y",$next);
			$arraySlotsNext = $bookingListObj->getSlotsPerDayList($nextYear,$nextMonth,$nextDay,$_GET["calendar_id"],$bookingSettingObj);
		} while(count($arraySlotsNext) == 0);
	}
} else {
	$next = '';
}
if($bookingSlotsObj->checkPastSlots($_GET["year"],$_GET["month"],$_GET["day"],$_GET["calendar_id"])) {
	$prev =strtotime(date("Y-m-d",mktime(0,0,0,$_GET["month"],$_GET["day"],$_GET["year"])) . "- 1 day");
	$prevDay = date("d",$prev);
	$prevMonth = date("m",$prev);
	$prevYear = date("Y",$prev);
	$arraySlotsPrev = $bookingListObj->getSlotsPerDayList($prevYear,$prevMonth,$prevDay,$_GET["calendar_id"],$bookingSettingObj);
	if(count($arraySlotsPrev)==0) {
		do {
			$prev =strtotime(date("Y-m-d",mktime(0,0,0,$prevMonth,$prevDay,$prevYear)) . "- 1 day");
			$prevDay = date("d",$prev);
			$prevMonth = date("m",$prev);
			$prevYear = date("Y",$prev);
			$arraySlotsPrev = $bookingListObj->getSlotsPerDayList($prevYear,$prevMonth,$prevDay,$_GET["calendar_id"],$bookingSettingObj);
		} while(count($arraySlotsPrev) == 0);
	}
} else {
	$prev = '';
}
$date = date_create(date('Y-m-d'));
if(function_exists("date_add")) {
	date_add($date, date_interval_create_from_date_string($bookingSettingObj->getBookFrom().' days'));
} else {
	date_modify($date, '+'.$bookingSettingObj->getBookFrom().' day');
}

//date_add($date, date_interval_create_from_date_string($bookingSettingObj->getBookFrom().' days'));
$bookfromdate = date_format($date, 'Ymd');

$date = date_create(date('Y-m-d'));
if(function_exists("date_add")) {
	date_add($date, date_interval_create_from_date_string($bookingSettingObj->getBookTo().' days'));
} else {
	date_modify($date, '+'.$bookingSettingObj->getBookTo().' day');
}

//date_add($date, date_interval_create_from_date_string($bookingSettingObj->getBookFrom().' days'));
$booktodate = date_format($date, 'Ymd');
//only current month is navigable, so I stop navigation at the start of month or if the date is lower than today
if($prev == '' || $_GET["month"] > $prevMonth || date("Ymd",$prev) < $bookfromdate) {
	?>
    <div class="booking_float_left booking_height_20 booking_line_20 booking_mark_ccc booking_font_16"><?php echo $bookingLangObj->getLabel("GETBOOKINGFORM_PREV_DAY"); ?></div>
    <?php
} else {
	?>
	<div class="booking_float_left booking_height_20 booking_line_20"><a href="javascript:getBookingForm(<?php echo $prevYear; ?>,<?php echo $prevMonth; ?>,<?php echo $prevDay; ?>, <?php echo $_GET["calendar_id"]; ?>,'<?php echo $bookingSettingObj->getRecaptchaPublicKey(); ?>');" class="booking_mark_333 booking_no_decoration booking_hover_567 booking_font_16"><?php echo $bookingLangObj->getLabel("GETBOOKINGFORM_PREV_DAY"); ?></a></div>
	
	<?php
}

//only current month is navigable, so I stop navigation at the end of month
if($next == '' || $_GET["month"] < $nextMonth || date("Ymd",$next) > $booktodate) {
	?>
    <div class="booking_float_left booking_height_20 booking_line_20 booking_mark_ccc booking_margin_l_2p booking_font_16"><?php echo $bookingLangObj->getLabel("GETBOOKINGFORM_NEXT_DAY"); ?></div>
    <?php
} else {
	?>
	<div class="booking_float_left booking_height_20 booking_line_20 booking_margin_l_2p"><a href="javascript:getBookingForm(<?php echo $nextYear; ?>,<?php echo $nextMonth; ?>,<?php echo $nextDay; ?>, <?php echo $_GET["calendar_id"]; ?>,'<?php echo $bookingSettingObj->getRecaptchaPublicKey(); ?>');" class="booking_mark_333 booking_no_decoration booking_hover_567 booking_font_16"><?php echo $bookingLangObj->getLabel("GETBOOKINGFORM_NEXT_DAY"); ?></a></div>
	<?php
}
?>

<!-- close -->
<div class="booking_font_custom booking_float_right text_right"><a href="javascript:closeBookingPage(<?php echo $bookingCalendarObj->getCalendarId(); ?>,'<?php echo $bookingSettingObj->getRecaptchaPublicKey(); ?>',<?php echo $_GET["year"]; ?>,<?php echo $_GET["month"]; ?>);" class="booking_mark_666 close_booking booking_no_decoration"><?php echo $bookingLangObj->getLabel("GETBOOKINGFORM_CLOSE"); ?>&nbsp; X</a></div>
<div class="booking_cleardiv"></div>

<script type="text/javascript">
	var $wbc = jQuery;
	<?php if($bookingSettingObj->getSlotSelection() == "1") {
		?>
		
		$wbc(function() {
			$wbc('#booking_slots').find('input').each(function() {
				 
				  $wbc(this).click(function() {
					  $wbc('#booking_slots').find('input').removeAttr('checked');
					  $wbc(this).attr("checked","checked");
				  });
			  });
		});
		<?php 
	} 
	?>
	
</script>

<!-- leftside -->
<div class="booking_width_100p booking_margin_t_10 booking_border_dotted booking_border_t_1 booking_border_ccc">

    <!-- title -->
    <div class="booking_font_custom booking_font_22 booking_word_space">
    	<span id="booking_day"><?php echo $_GET["day"]." ".$weekdays[intval(date('w',mktime(0,0,0,$_GET["month"],$_GET["day"],$_GET["year"])))]; ?></span> - <span style="color:<?php echo $bookingSettingObj->getFormCalendarNameColor(); ?>;" id="calendar_name"><?php echo $bookingCalendarObj->getCalendarTitle(); ?></span><span style="float:right;width:30px;cursor:pointer" id="booking_next">&nbsp;</span><span style="float:right;width:30px;cursor:pointer" id="booking_prev">&nbsp;</span></div>
    <div class="booking_cleardiv"></div>
    <?php
	if($bookingSettingObj->getFormText()!='') {
		?>
        <div class="booking_form_text"><?php echo $bookingSettingObj->getFormText(); ?></div>
        <?php
	}
	?>
    <!-- slots available -->
    <div class="booking_width_100p booking_margin_t_20 booking_font_14" id="booking_slots">
        <div id="slideshow">
            <div id="page<?php echo $page; ?>">
            	<?php
				$onclick="";
				if($bookingSettingObj->getPaypal() == 1 && $bookingSettingObj->getPaypalAccount()!='' && $bookingSettingObj->getPaypalCurrency()!='' && $bookingSettingObj->getPaypalLocale() != '') {
					$onclick="javascript:addToPaypalForm();";
				}
	
				?>
                <div class="booking_float_left">
                    <?php
					
                    $z=1;
                    foreach($arraySlots as $slotId => $slot) {
						
						$disabled = "";
						if(isset($slot["slot_av"]) && $slot["slot_av"] == 0 && $bookingSettingObj->getSlotsUnlimited() == 2) {
							$disabled = "disabled";
						}
						if($slot["booked"] == 1) {
							
							$disabled="disabled";
						}
                      ?>
                      <div class="booking_height_30 booking_border_dotted booking_border_b_1 booking_border_666 booking_font_cuprum">
                      <?php
					  if($slot["booked"] == 1) {
							echo '<div class="booking_booked_slot">';
							
						}
					  ?>
                      	<!-- checkbox -->
                        <div class="booking_float_left booking_margin_t_5"><input type="checkbox" name="reservation_slot[]" value="<?php echo $slotId; ?>" tmt:minchecked="1" tmt:message="<?php echo $bookingLangObj->getLabel("GETBOOKINGFORM_SLOT_ALERT"); ?>" <?php echo $disabled; ?> onclick="<?php echo $onclick; ?>" style="-webkit-appearance: checkbox !important;display:block !important;width:14px !important"/></div>
                        
                        <!-- time -->
                        <div class="booking_float_left booking_margin_l_2 booking_height_30 booking_line_30">
						<?php 
						if($slot["slot_special_mode"] == 1) {	
							if($bookingSettingObj->getTimeFormat() == "12") {
								echo date('h:i a',strtotime(substr($slot["slot_time_from"],0,5)))." - ".date('h:i a',strtotime(substr($slot["slot_time_to"],0,5)));
							} else {
								echo substr($slot["slot_time_from"],0,5)." - ".substr($slot["slot_time_to"],0,5);
							}
						} else if($slot["slot_special_mode"] == 0 && $slot["slot_special_text"] != '') {
								
								//echo $slot["slot_special_text"]; 
						} else {
							
							if($bookingSettingObj->getTimeFormat() == "12") {
								echo date('h:i a',strtotime(substr($slot["slot_time_from"],0,5)))." - ".date('h:i a',strtotime(substr($slot["slot_time_to"],0,5)));
							} else {
								echo substr($slot["slot_time_from"],0,5)." - ".substr($slot["slot_time_to"],0,5);
							}
							
						}
						?>
                        </div>
                        
                        <!-- seats -->
                        <?php
                        //add seats num if set
						if($bookingSettingObj->getSlotsUnlimited() == 2) {
							?>
                            <div class="booking_float_left booking_margin_l_15 booking_height_30 booking_line_30">
                            	<?php echo $bookingLangObj->getLabel("SELECT_SEATS"); ?>:&nbsp;
                                <select name="reservation_seats_<?php echo $slotId; ?>" id="seats_<?php echo $slotId; ?>" onchange="<?php echo $onclick; ?>" <?php echo $disabled; ?>>
                                	<?php
									
									for($u=1;$u<=$slot["slot_av_max"];$u++) {
										?>
                                        <option value="<?php echo $u; ?>"><?php echo $u; ?></option>
                                        <?php
									}
									?>
                                    
                                </select>
                            </div>
                            
                        
                        <!-- paypal -->    
                        <?php
						}
                        
						if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
							?>
                            <div class="booking_float_left booking_margin_l_10 booking_height_30 booking_line_30">
                            	<?php
								if($slot["slot_price"]>0) {
									echo money_format('%!.2n',$slot["slot_price"]); ?>&nbsp;<?php echo $bookingSettingObj->getPaypalCurrency();
								} else {
									echo $bookingLangObj->getLabel("FREE");
								}
								?>
                            	
                            </div>
                            <?php
						}
						
						if($slot["slot_special_text"] != '' && ($slot["slot_special_mode"] == 1 || $slot["slot_special_mode"] == 0)) {
							?>
                            <div class="booking_float_left booking_margin_l_10 booking_height_30 booking_line_30">
                            <?php echo $slot["slot_special_text"]; ?>
                            </div>
                            <?php
						}
						
						if($slot["booked"] == 1) {
							echo '</div>';
						}
						?>
                        <div class="booking_cleardiv"></div>
                      </div>
                      <div class="booking_cleardiv"></div>
                      <?php
                      if($z % $lines == 0) {
                          $totCols++;
                          ?>
                          </div>
                          <?php
                          $display="";
                          if($totCols % $maxColumn == 0 && $z < count($arraySlots)) {
                              $page++;
                              
                              ?>
                              </div>
                              <div id="page<?php echo $page; ?>">
                              <?php
                          }
                          ?>
                          <div class="booking_float_left booking_margin_l_20">
                          <?php
                      }
                      $z++;
                    }
                    ?>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="booking_cleardiv"></div>

<script>
	var $wbc = jQuery;
	$wbc(function() {
		$wbc('#calendar_id').val(<?php echo $bookingCalendarObj->getCalendarId(); ?>);
		<?php
		if($page > 1) {
		?>
		  var slider = $wbc('#slideshow').bxSlider({
			infiniteLoop: false,
			controls: false,
			onAfterSlide: function(currentSlideNumber, totalSlideQty, currentSlideHtmlObject){
							$wbc('#booking_prev').html('<a href="#"></a>');
							 $wbc('#booking_next').html('<a href="#"></a>');
						  if(currentSlideNumber+1 == totalSlideQty) {
							  $wbc('#booking_next').html("");
							  $wbc('#booking_prev').html('<a href="#"></a>');
						  }
						  if(currentSlideNumber == 0) {
							  $wbc('#booking_prev').html('');
							  $wbc('#booking_next').html('<a href="#"></a>');
						  }
						}
		  });
		  $wbc('#booking_prev').click(function(){
			slider.goToPreviousSlide();
			return false;
		  });
		
		  $wbc('#booking_next').click(function(){
			slider.goToNextSlide();
			return false;
		  });
		<?php
		}
		?>
		 
	});
</script>

|
<?php
if($page>1) {
	echo "1";
} else {
	echo "0";
}
?>
|<?php echo $bookingLangObj->getLabel("GETBOOKINGFORM_CAPTCHA_ALERT"); ?>

