<script>
	function filterPagSlots(pag) {
		if($wbc("#search_date option:selected").val()==1) {
			
			if(Trim($wbc('#first_date').val()) != '') {
				$wbc('#result_search').html('<img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.gif">');
				$wbc.ajax({
				  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/filterSlots.php?search_date=1&date_from='+$wbc('#first_date').val()+"&time_from="+$wbc('#time_from').val()+"&time_to="+$wbc('#time_to').val()+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>&pag="+pag,
				  success: function(data) {
					 // $wbc('#date_from').val('');
					  //$wbc('#time_from').val('');
					  //$wbc('#time_to').val('');
					  //$wbc('#first_date').val('');
					 $wbc('#table').hide().html(data).fadeIn(2000);
					 $wbc('#result_search').html('');
					 goToByScroll("results");
				  }
				});
			} else {
			  alert("<?php echo $bookingLangObj->getLabel("SLOTS_SELECT_DATE_ALERT"); ?>");
			}
		} else if($wbc("#search_date option:selected").val()==2 && Trim($wbc('#first_date').val()) != '' && Trim($wbc('#second_date').val()) != '') {
			$wbc('#result_search').html('<img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.gif">');
			$wbc.ajax({
			  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/filterSlots.php?search_date=2&date_from='+$wbc('#first_date').val()+"&weekday="+$wbc('#slot_week_day').val()+"&date_to="+$wbc('#second_date').val()+"&time_from="+$wbc('#time_from').val()+"&time_to="+$wbc('#time_to').val()+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>&pag="+pag,
			  success: function(data) {
				  //$wbc('#date_from').val('');
				  //$wbc('#date_to').val('');
				  //$wbc('#first_date').val('');
				  //$wbc('#second_date').val('');
				  //$wbc('#slot_week_day').val("0");
				  //$wbc('#time_from').val('');
				  //$wbc('#time_to').val('');
				 $wbc('#table').hide().html(data).fadeIn(2000);
				 $wbc('#result_search').html('');
				 goToByScroll("results");
			  }
			});
		} else {
			alert("<?php echo $bookingLangObj->getLabel("SLOTS_DATE_RANGE_ALERT"); ?>");
		}
	}
</script>
<?php
$arrayTotSlots = $bookingListObj->getSlotsList($_SESSION["qrySlotsFilterString"],"",$_GET["calendar_id"]);
$slotPerPag=100;
$totPages=ceil(count($arrayTotSlots)/$slotPerPag);
if(!isset($_GET["pag"])) {
	$_GET["pag"] = 1;
}

$pag = $_GET["pag"];
//pagination
if($totPages>1) {
	echo $bookingLangObj->getLabel("SLOTS_PAGES").":&nbsp;";
	if($_GET["pag"]>1) {
		?>
		<a href="javascript:filterPagSlots(1);"><?php echo $bookingLangObj->getLabel("SLOTS_PAGINATION_FIRST"); ?></a>
		
		<a href="javascript:filterPagSlots(<?php echo ($_GET["pag"]-1);?>);"><?php echo $bookingLangObj->getLabel("SLOTS_PAGINATION_PREV"); ?></a>
		<?php
	}
	
	for($j=1;$j<=$totPages;$j++) {
		if($j==$_GET["pag"]) {
			echo $j;
		} else {
		?>
		<a href="javascript:filterPagSlots(<?php echo $j; ?>);"><?php echo $j; ?></a>
		<?php
		}
	}
	if($_GET["pag"]<$totPages) {
		?>
		<a href="javascript:filterPagSlots(<?php echo ($_GET["pag"]+1);?>);"><?php echo $bookingLangObj->getLabel("SLOTS_PAGINATION_NEXT"); ?></a>
		<a href="javascript:filterPagSlots(<?php echo $totPages; ?>);"><?php echo $bookingLangObj->getLabel("SLOTS_PAGINATION_LAST"); ?></a>    
		<?php
	}
}
?>
<div id="table" class="booking_margin_t_20 booking_font_12">
	<!-- head -->
	<div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">
    
    	<div class="booking_float_left booking_width_3p">#</div>
			
        <div class="booking_float_left booking_width_3p"><input type="checkbox" name="selectAll" onclick="javascript:selectCheckbox('manage_slots','slots[]');" /></div>
        
        <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("SLOTS_DATE_LABEL")?>&nbsp;<a href="javascript:orderby('date','<?php echo $_SESSION["orderbySlotsDate"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbySlotsDate"];?>.gif" border=0 /></a></div>
        
        <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("SLOTS_TIME_FROM_LABEL")?>&nbsp;<a href="javascript:orderby('time','<?php echo $_SESSION["orderbySlotsTime"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbySlotsTime"];?>.gif" border=0 /></a></div>
        
        <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("SLOTS_TIME_TO_LABEL")?></div>
        
        <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("SLOTS_SPECIAL_TEXT_LABEL")?></div>
        
        <div class="booking_float_left booking_width_7p"><?php echo $bookingLangObj->getLabel("SLOTS_PRICE_LABEL")?></div>
        
        <div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("SLOTS_AV_LABEL");?></div>
        
        <div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("SLOTS_AV_MAX_LABEL");?></div>
        
        <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("SLOTS_RESERVATION_LABEL");?></div>
        
        <div class="booking_float_left booking_width_5p"></div>
        
        <div class="booking_float_left booking_width_5p"></div>
        
        <div class="booking_cleardiv"></div>
        
    </div>
    
    <!-- row -->
    <?php      
    if($bookingSettingObj->getDateFormat() == "UK") {
        $date_format = "d/m/Y";
	} else if($bookingSettingObj->getDateFormat() == "EU") {
		$date_format = "Y/m/d";
    } else {
        $date_format = "m/d/Y";
    }                   
	
    $arraySlots = $bookingListObj->getSlotsList($_SESSION["qrySlotsFilterString"],$_SESSION["qrySlotsOrderString"],$_GET["calendar_id"],$slotPerPag,$_GET["pag"]);                    
    $j=1;
    foreach($arraySlots as $slotId => $slot) {							
        if($j % 2) {
            $class="booking_alternate_table_row_white";
        } else {
            $class="booking_alternate_table_row_grey";
        }
    ?>
    
    <div id="row_<?php echo $slotId; ?>">
    	<!-- row number -->
        <div class="booking_float_left booking_width_3p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $j; ?></div>
        </div>
        
        <!-- check slot -->
        <div class="booking_float_left booking_width_3p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><input type="checkbox" name="slots[]" value="<?php echo $slotId; ?>" onclick="javascript:disableSelectAll('manage_slots',this.checked);" /></div>
        </div>   
        
        <!-- date -->               
        <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                <span id="date_display_<?php echo $slotId; ?>">
                	<?php
					if($bookingSettingObj->getDateFormat() == "UK") {
						$dateToSend = strftime('%d/%m/%Y',strtotime($slot["slot_date"]));
					} else if($bookingSettingObj->getDateFormat() == "EU") {
						$dateToSend = strftime('%Y/%m/%d',strtotime($slot["slot_date"]));
					} else {
						$dateToSend = strftime('%m/%d/%Y',strtotime($slot["slot_date"]));
					}
                    ?>
					<?php echo $dateToSend; ?>
                </span>
                <span id="date_input_<?php echo $slotId; ?>" style="display:none !important"><input type="text" name="slot_date" id="slot_date_<?php echo $slotId; ?>" class="date_input" style="width:75px" value="<?php echo date($date_format,strtotime($slot["slot_date"])); ?>" readonly="readonly"><input type="hidden" name="date_input_<?php echo $slotId; ?>" id="date_value_<?php echo $slotId; ?>" value="<?php echo $slot["slot_date"]; ?>"></span>
            </div>
        </div>
        
        <!-- time from -->
        <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                <span id="time_from_display_<?php echo $slotId; ?>">
                	<?php
					if($bookingSettingObj->getTimeFormat() == "12") {
						$slotTimeFrom = date('h:i a',strtotime(substr($slot["slot_time_from"],0,5)));
						
					} else {
						$slotTimeFrom = substr($slot["slot_time_from"],0,5);
						
					}
					echo $slotTimeFrom;
					?>
					
                </span>
                <span id="time_from_input_<?php echo $slotId; ?>" style="display:none !important">
                	
                	<select name="slot_time_from_hour[]" id="slot_time_from_hour_<?php echo $slotId; ?>">
                        <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_HOUR"); ?></option>
                        
                        <?php
						if($bookingSettingObj->getTimeFormat() == '24') {
							$start=0;
							$to = 24;
							$ampm=0;
						} else {
							$start=1;
							$to = 12;
							$ampm = 1;
						}
                        for($i=$start;$i<=$to;$i++) {
							$temp = $i;
							if(strlen($i) == 1) {
								$temp = '0'.$i; 
							}
                            ?>
                            <option value="<?php echo $i; ?>" <?php if($temp==substr($slotTimeFrom,0,2)) { echo "selected"; }?>><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select name="slot_time_from_minute[]" id="slot_time_from_minute_<?php echo $slotId; ?>">
                        <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_MINUTE"); ?></option>
                        <?php						
                        for($i=0;$i<=59;$i++) {
							$temp = $i;
							if(strlen($i) == 1) {
								$temp = '0'.$i; 
							}
                            ?>
                            <option value="<?php echo $i; ?>" <?php if($temp==substr($slotTimeFrom,3,2)) { echo "selected"; }?>><?php echo $temp; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                    if($ampm == 1) {
                        ?>
                        <select name="slot_time_from_ampm[]" id="slot_time_from_ampm_<?php echo $slotId; ?>">
                            <option value="am" <?php if('am'==substr($slotTimeFrom,-2)) { echo "selected"; }?>>am</option>
                            <option value="pm" <?php if('pm'==substr($slotTimeFrom,-2)) { echo "selected"; }?>>pm</option>
                        </select>
                        <?php
                    }
                    ?>
                    
                </span>
            </div>
        </div>
        
        <!-- time to -->
        <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                <span id="time_to_display_<?php echo $slotId; ?>">
                	<?php
					if($bookingSettingObj->getTimeFormat() == "12") {
						$slotTimeTo = date('h:i a',strtotime(substr($slot["slot_time_to"],0,5)));
						
					} else {
						$slotTimeTo = substr($slot["slot_time_to"],0,5);
						
					}
					echo $slotTimeTo;
					?>
					
                </span>
                <span id="time_to_input_<?php echo $slotId; ?>" style="display:none !important">
                	<select name="slot_time_to_hour[]" id="slot_time_to_hour_<?php echo $slotId; ?>">
                        <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_HOUR"); ?></option>
                        <?php
                        if($bookingSettingObj->getTimeFormat() == '24') {
							$start=0;
							$to = 24;
							$ampm=0;
						} else {
							$start=1;
							$to = 12;
							$ampm = 1;
						}
                        for($i=$start;$i<=$to;$i++) {
							$temp = $i;
							if(strlen($i) == 1) {
								$temp = '0'.$i; 
							}
                            ?>
                            <option value="<?php echo $i; ?>" <?php if($temp==substr($slotTimeTo,0,2)) { echo "selected"; }?>><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select name="slot_time_to_minute[]" id="slot_time_to_minute_<?php echo $slotId; ?>">
                        <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_MINUTE"); ?></option>
                        <?php						
                        for($i=0;$i<=59;$i++) {
							$temp = $i;
							if(strlen($i) == 1) {
								$temp = '0'.$i; 
							}
                            ?>
                            <option value="<?php echo $i; ?>" <?php if($temp==substr($slotTimeTo,3,2)) { echo "selected"; }?>><?php echo $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                    if($ampm == 1) {
                        ?>
                        <select name="slot_time_to_ampm[]" id="slot_time_to_ampm_<?php echo $slotId; ?>">
                            <option value="am" <?php if('am'==substr($slotTimeTo,-2)) { echo "selected"; }?>>am</option>
                            <option value="pm" <?php if('pm'==substr($slotTimeTo,-2)) { echo "selected"; }?>>pm</option>
                        </select>
                        <?php
                    }
                    ?>
                	
                </span>
            </div>
        </div>
        
        <!-- special text -->
        <div class="booking_float_left booking_width_20p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                
                <span id="text_display_<?php echo $slotId; ?>" style="overflow:hidden;"><?php echo substr($slot["slot_special_text"],0,20); ?></span>
                <span id="text_input_<?php echo $slotId; ?>" style="display:none !important"><input type="text" name="slot_special_text" id="slot_special_text_<?php echo $slotId; ?>" class="time_input" style="width:140px"  value="<?php echo $slot["slot_special_text"]; ?>"></span>
               
            </div>
        </div>
        
        
    	<!-- price -->
        <div class="booking_float_left booking_width_7p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                <?php
                if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
                ?>
                <span id="price_display_<?php echo $slotId; ?>"><?php echo money_format('%!.2n',$slot["slot_price"])."&nbsp;".$bookingSettingObj->getPaypalCurrency(); ?></span>
                <span id="price_input_<?php echo $slotId; ?>" style="display:none !important"><input type="text" name="slot_price" id="slot_price_<?php echo $slotId; ?>" class="time_input" style="width:40px"  value="<?php echo $slot["slot_price"]; ?>"></span>
                <?php
                }
                ?>
            </div>
        </div>
        
        
    	<!-- seats -->
        <div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                <?php
                if($bookingSettingObj->getSlotsUnlimited() == 2) {
                ?>
                <span id="av_display_<?php echo $slotId; ?>"><?php echo $slot["slot_av"]; ?></span>
                <span id="av_input_<?php echo $slotId; ?>" style="display:none !important"><input type="text" name="slot_av" id="slot_av_<?php echo $slotId; ?>" class="time_input" style="width:90px"  value="<?php echo $slot["slot_av"]; ?>"></span>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- seats -->
        <div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                <?php
                if($bookingSettingObj->getSlotsUnlimited() == 2) {
                ?>
                <span id="av_max_display_<?php echo $slotId; ?>"><?php echo $slot["slot_av_max"]; ?></span>
                <span id="av_max_input_<?php echo $slotId; ?>" style="display:none !important"><input type="text" name="slot_av_max" id="slot_av_max_<?php echo $slotId; ?>" class="time_input" style="width:90px"  value="<?php echo $slot["slot_av_max"]; ?>"></span>
                <?php
                }
                ?>
            </div>
        </div>
        
        
        <!-- reservation -->
        <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
           <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $slot["slot_reservation"]; ?></div>
        </div>
        
        
        <div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><span id="modify_<?php echo $slotId; ?>"><a href="javascript:editItem(<?php echo $slotId; ?>,'<?php echo $slot["slot_reservation"]; ?>');"><?php echo $bookingLangObj->getLabel("SLOTS_MODIFY")?></a></span></div>
        </div>
        
        
        <div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
            <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:delItem(<?php echo $slotId; ?>,'<?php echo $slot["slot_reservation"]; ?>');"><?php echo $bookingLangObj->getLabel("SLOTS_DELETE")?></a></div>
        </div>
        <div class="booking_cleardiv"></div>
    </div>
    
<?php 
$j++;
} 
?>
</div>
<?php
//pagination
if($totPages>1) {
	echo $bookingLangObj->getLabel("SLOTS_PAGES").":&nbsp;";
	if($_GET["pag"]>1) {
		?>
		<a href="javascript:filterPagSlots(1);"><?php echo $bookingLangObj->getLabel("SLOTS_PAGINATION_FIRST"); ?></a>
		
		<a href="javascript:filterPagSlots(<?php echo ($_GET["pag"]-1);?>);"><?php echo $bookingLangObj->getLabel("SLOTS_PAGINATION_PREV"); ?></a>
		<?php
	}
	
	for($j=1;$j<=$totPages;$j++) {
		if($j==$_GET["pag"]) {
			echo $j;
		} else {
		?>
		<a href="javascript:filterPagSlots(<?php echo $j; ?>);"><?php echo $j; ?></a>
		<?php
		}
	}
	if($_GET["pag"]<$totPages) {
		?>
		<a href="javascript:filterPagSlots(<?php echo ($_GET["pag"]+1);?>);"><?php echo $bookingLangObj->getLabel("SLOTS_PAGINATION_NEXT"); ?></a>
		<a href="javascript:filterPagSlots(<?php echo $totPages; ?>);"><?php echo $bookingLangObj->getLabel("SLOTS_PAGINATION_LAST"); ?></a>    
		<?php
	}
}
?>
