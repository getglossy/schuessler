<?php 
$arraySlotsHour = $bookingListObj->getSlotsHoursList($_GET["calendar_id"]);
?>


<?php
/***if there are slots I show the management to delete/modify them***/
if(count($arraySlotsHour)>0) {
?>
	<script>
		var $wbc = jQuery;
		$wbc(function() {
			
			<?php
			if($bookingSettingObj->getDateFormat() == "UK") {
				?>
				$wbc.datepicker.setDefaults( $wbc.datepicker.regional[ "en-GB" ] );
				<?php
			} else if($bookingSettingObj->getDateFormat() == "EU") {
				?>
				$wbc.datepicker.setDefaults( $wbc.datepicker.regional[ "eu-EU" ] );
				<?php
			} else {
				?>
				$wbc.datepicker.setDefaults( $wbc.datepicker.regional[ "us-US" ] );
				<?php
			}
			?>
			$wbc( "#date_to_delete").datepicker({
				altField: "#second_date_delete",
				altFormat: "yy,mm,dd",
				onClose: function( selectedDate ) {
					$wbc( "#date_from_delete" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
			$wbc( "#date_from_delete").datepicker({
				altField: "#first_date_delete",
				altFormat: "yy,mm,dd",
				minDate: new Date(),
				
				
				onClose: function( selectedDate ) {
					$wbc( "#date_to_delete" ).datepicker( "option", "minDate", selectedDate );
					$wbc( "#date_to_delete").datepicker({
						altField: "#second_date_delete",
						altFormat: "yy,mm,dd",
						//minDate: selectedDate,
						onClose: function( selectedDate ) {
							$wbc( "#date_from_delete" ).datepicker( "option", "maxDate", selectedDate );
						}
					});
					
				}
	
			});
			
			$wbc( "#date_to_edit").datepicker({
				altField: "#second_date_edit",
				altFormat: "yy,mm,dd",
				onClose: function( selectedDate ) {
					$wbc( "#date_from_edit" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
			$wbc( "#date_from_edit").datepicker({
				altField: "#first_date_edit",
				altFormat: "yy,mm,dd",
				minDate: new Date(),
				onClose: function(selectedDate) { 
					$wbc( "#date_to_edit" ).datepicker( "option", "minDate", selectedDate );
					$wbc( "#date_to_edit").datepicker({
						altField: "#second_date_edit",
						altFormat: "yy,mm,dd",
						//minDate: selectedDate,
						onClose: function( selectedDate ) {
							$wbc( "#date_from_edit" ).datepicker( "option", "maxDate", selectedDate );
						}
					});
				}
	
			});
			
			
			
			
			
			
			
			
		});
		function openSection(div) {
			if(document.getElementById(div).style.display=="none") {
				$wbc('#'+div).slideDown();
			} else {
				$wbc('#'+div).slideUp();
			}
		}
	</script>
    
   
<?php
}
?>

<!-- 
============================================================================================
=== management slots buttons ==
============================================================================================
-->

<!-- 
=======================
=== create slots ==
=======================
-->

<a href="javascript:showPage('new_slot');" class="booking_manage_slot_box_title booking_border_1 booking_border_solid booking_border_ccc"><?php echo $bookingLangObj->getLabel("CREATE_TIME_SLOTS"); ?></a>

<!-- 
=======================
=== search slots ==
=======================
-->
<script>
	$wbc(function() {
		
		<?php
		if($bookingSettingObj->getDateFormat() == "UK") {
			?>
			$wbc.datepicker.setDefaults( $wbc.datepicker.regional[ "en-GB" ] );
			<?php
		} else if($bookingSettingObj->getDateFormat() == "EU") {
			?>
			$wbc.datepicker.setDefaults( $wbc.datepicker.regional[ "eu-EU" ] );
			<?php
		} else {
			?>
			$wbc.datepicker.setDefaults( $wbc.datepicker.regional[ "us-US" ] );
			<?php
		}
		?>
		$wbc( "#date_to").datepicker({
			altField: "#second_date",
			altFormat: "yy,mm,dd",
			onClose: function( selectedDate ) {
				$wbc( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
		$wbc( "#date_from").datepicker({
			altField: "#first_date",
			altFormat: "yy,mm,dd",
			minDate: new Date(),
			onClose: function(selectedDate) { 
				$wbc( "#date_to" ).datepicker( "option", "minDate", selectedDate );
				$wbc( "#date_to").datepicker({
					altField: "#second_date",
					altFormat: "yy,mm,dd",
					//minDate: selectedDate,
					onClose: function( selectedDate ) {
						$wbc( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
					}
				});
			}
		});
		
		
		
	});
	function filterSlots() {
		if($wbc("#search_date option:selected").val()==1) {
			
			if(Trim($wbc('#first_date').val()) != '') {
				$wbc('#result_search').html('<img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.gif">');
				$wbc.ajax({
				  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/filterSlots.php?search_date=1&date_from='+$wbc('#first_date').val()+"&time_from="+$wbc('#time_from_hour').val()+":"+$wbc('#time_from_minute').val()+":"+$wbc('#time_from_ampm').val()+"&time_to="+$wbc('#time_to_hour').val()+":"+$wbc('#time_to_minute').val()+":"+$wbc('#time_to_ampm').val()+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>&pag=1",
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
			  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/filterSlots.php?search_date=2&date_from='+$wbc('#first_date').val()+"&weekday="+$wbc('#slot_week_day').val()+"&date_to="+$wbc('#second_date').val()+"&time_from="+$wbc('#time_from_hour').val()+":"+$wbc('#time_from_minute').val()+":"+$wbc('#time_from_ampm').val()+"&time_to="+$wbc('#time_to_hour').val()+":"+$wbc('#time_to_minute').val()+":"+$wbc('#time_to_ampm').val()+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>&pag=1",
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
			alert("<?php echo $bookingLangObj->getLabel("SLOTS_SELECT_RANGE_ALERT"); ?>");
		}
	}
	
	function showFilters(value) {
		if(value==1) {
			$wbc('#filters').slideDown();
			$wbc('#label_from').html("<?php echo $bookingLangObj->getLabel("SLOTS_DAY"); ?>");
			$wbc('#date_to_filter').slideUp();
			$wbc('#weekdays_filter').slideUp();
		} else if(value==2) {
			$wbc('#filters').slideDown();
			$wbc('#label_from').html("<?php echo $bookingLangObj->getLabel("SLOTS_FROM"); ?>");
			$wbc('#date_to_filter').slideDown();
			$wbc('#weekdays_filter').slideDown();
		} else {
			$wbc('#filters').slideUp();
		}
	}
		
		////end search
	
	function showForm(value) {
		if(value==1) {
			$wbc('#delete_form').fadeOut(0);
			$wbc('#modify_form').slideDown();
			
		} else if(value==2) {
			$wbc('#modify_form').fadeOut(0);
			$wbc('#delete_form').slideDown();
		} else {
			$wbc('#delete_form').slideUp();
			$wbc('#modify_form').slideUp();
		}
	}
	
	function orderby(column,type) {
	
		$wbc.ajax({
		  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/setSlotsOrderby.php?order_by='+column+'&type='+type+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>",
		  success: function(data) {
			  $wbc('#table').hide().html(data).fadeIn(2000);						 
			
		  }
		});
		
	}
	
	
	function delItem(itemId,reservation) {
		if(confirm("<?php echo $bookingLangObj->getLabel("SLOTS_DELETE_CONFIRM_SINGLE"); ?>")) {
			$wbc('body').prepend('<div id="sfondo" class="booking_modal_sfondo"><div id="modal_loading" class="booking_modal_loading"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.png" border=0 /></div></div>');
			$wbc.ajax({
			  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/delSlotsItem.php?item_id='+itemId+"&reservation="+reservation+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>",
			  success: function(data) {
				  $wbc('#sfondo').remove();
				  $wbc('#table').hide().html(data).fadeIn(2000);
				 goToByScroll("results");
				
			  }
			});
		} 
	}
	function editItem(slot) {
		$wbc('#modify_'+slot).html('<a href="javascript:saveItem('+slot+');"><?php echo $bookingLangObj->getLabel("SLOTS_SAVE"); ?></a>');
		$wbc('#text_display_'+slot).fadeOut(0);
		$wbc('#price_display_'+slot).fadeOut(0);
		$wbc('#av_display_'+slot).fadeOut(0);
		$wbc('#av_max_display_'+slot).fadeOut(0);
		$wbc('#time_from_display_'+slot).fadeOut(0);
		$wbc('#time_to_display_'+slot).fadeOut(0);
		$wbc('#date_display_'+slot).fadeOut(0);
		
		$wbc('#text_input_'+slot).fadeIn(0);
		$wbc('#price_input_'+slot).fadeIn(0);
		$wbc('#av_input_'+slot).fadeIn(0);
		$wbc('#av_max_input_'+slot).fadeIn(0);
		$wbc('#time_from_input_'+slot).fadeIn(0);
		$wbc('#time_to_input_'+slot).fadeIn(0);
		$wbc('#date_input_'+slot).fadeIn(0);
		
		
		$wbc('#slot_date_'+slot).datepicker({
			altField: "#date_value_"+slot,
			altFormat: "yy-mm-dd",
			minDate: new Date(),
		});
		
		
			
		
		
		
	}
	function checkEditInLineTimes() {
		var error = 0;
		var len = document.getElementsByName('slot_time_from_hour[]').length;
		
		for(i=0;i<len;i++) {
			tempMinuteFrom = document.getElementsByName("slot_time_from_minute[]").item(i).value;
			if(document.getElementsByName("slot_time_from_minute[]").item(i).value.length == 1) {
				tempMinuteFrom = '0'+document.getElementsByName("slot_time_from_minute[]").item(i).value;
			}
			tempMinuteTo = document.getElementsByName("slot_time_to_minute[]").item(i).value;
			if(document.getElementsByName("slot_time_to_minute[]").item(i).value.length == 1) {
				tempMinuteTo = '0'+document.getElementsByName("slot_time_to_minute[]").item(i).value;
				
			}
			
			var from_value =document.getElementsByName("slot_time_from_hour[]").item(i).value+""+tempMinuteFrom;
			var to_value =document.getElementsByName("slot_time_to_hour[]").item(i).value+""+tempMinuteTo;
			if(document.getElementsByName("slot_time_from_ampm[]").item(i) && document.getElementsByName("slot_time_from_ampm[]").item(i).value=='am') {
				switch(document.getElementsByName("slot_time_from_hour[]").item(i).value) {
					case '12':
						from_value = '00'+tempMinuteFrom;
						break;
				}
			} else if(document.getElementsByName("slot_time_from_ampm[]").item(i) && document.getElementsByName("slot_time_from_ampm[]").item(i).value=='pm') {
				switch(document.getElementsByName("slot_time_from_hour[]").item(i).value) {
					case '1':
						from_value = '13'+tempMinuteFrom;
						break;
					case '2':
						from_value = '14'+tempMinuteFrom;
						break;
					case '3':
						from_value = '15'+tempMinuteFrom;
						break;
					case '4':
						from_value = '16'+tempMinuteFrom;
						break;
					case '5':
						from_value = '17'+tempMinuteFrom;
						break;
					case '6':
						from_value = '18'+tempMinuteFrom;
						break;
					case '7':
						from_value = '19'+tempMinuteFrom;
						break;
					case '8':
						from_value = '20'+tempMinuteFrom;
						break;
					case '9':
						from_value = '21'+tempMinuteFrom;
						break;
					case '10':
						from_value = '22'+tempMinuteFrom;
						break;
					case '11':
						from_value = '23'+tempMinuteFrom;
						break;
				}
			}
			if(document.getElementsByName("slot_time_to_ampm[]").item(i) && document.getElementsByName("slot_time_to_ampm[]").item(i).value=='am') {
				switch(document.getElementsByName("slot_time_to_hour[]").item(i).value) {
					case '12':
						to_value = '00'+tempMinuteTo;
						break;
				}
			} else if(document.getElementsByName("slot_time_to_ampm[]").item(i) && document.getElementsByName("slot_time_to_ampm[]").item(i).value=='pm') {
				switch(document.getElementsByName("slot_time_to_hour[]").item(i).value) {
					case '1':
						to_value = '13'+tempMinuteTo;
						break;
					case '2':
						to_value = '14'+tempMinuteTo;
						break;
					case '3':
						to_value = '15'+tempMinuteTo;
						break;
					case '4':
						to_value = '16'+tempMinuteTo;
						break;
					case '5':
						to_value = '17'+tempMinuteTo;
						break;
					case '6':
						to_value = '18'+tempMinuteTo;
						break;
					case '7':
						to_value = '19'+tempMinuteTo;
						break;
					case '8':
						to_value = '20'+tempMinuteTo;
						break;
					case '9':
						to_value = '21'+tempMinuteTo;
						break;
					case '10':
						to_value = '22'+tempMinuteTo;
						break;
					case '11':
						to_value = '23'+tempMinuteTo;
						break;
				}
			}
			
			/*if(from_value.substring(0,1) == "0") {
				from_value = parseInt(from_value.substring(1,4));
			}
			if(to_value.substring(0,1) == "0") {
				to_value = parseInt(to_value.substring(1,4));
			}*/
			
			if(parseInt(to_value)<parseInt(from_value)) {
				
				error = 1;
			}
			
			
		}
		
		return error;
	}
	function saveItem(slot) {
		if(Trim($wbc('#slot_date_'+slot).val()) != '' && Trim($wbc('#slot_time_from_hour_'+slot).val()) != '' && Trim($wbc('#slot_time_from_minute_'+slot).val()) != '' && Trim($wbc('#slot_time_to_hour_'+slot).val()) != '' && Trim($wbc('#slot_time_to_minute_'+slot).val()) != '') {
			if($wbc('#slot_special_text_'+slot).val()!=undefined) {
				new_text = $wbc('#slot_special_text_'+slot).val();
			} else {
				new_text = "";
			}
			if($wbc('#slot_price_'+slot).val()!=undefined) {
				newprice = $wbc('#slot_price_'+slot).val();
			} else {
				newprice = "";
			}
			if($wbc('#slot_av_'+slot).val()!=undefined) {
				newav = $wbc('#slot_av_'+slot).val();
			} else {
				newav = "";
			}
			if($wbc('#slot_av_max_'+slot).val()!=undefined) {
				newavmax = $wbc('#slot_av_max_'+slot).val();
			} else {
				newavmax = "";
			}
			$wbc.ajax({
			  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveSlot.php?item_id='+slot+"&date="+$wbc('#date_value_'+slot).val()+"&time_from="+$wbc('#slot_time_from_hour_'+slot).val()+":"+$wbc('#slot_time_from_minute_'+slot).val()+":"+$wbc('#slot_time_from_ampm_'+slot).val()+"&time_to="+$wbc('#slot_time_to_hour_'+slot).val()+":"+$wbc('#slot_time_to_minute_'+slot).val()+":"+$wbc('#slot_time_to_ampm_'+slot).val()+"&text="+new_text+"&price="+newprice+"&av="+newav+"&avmax="+newavmax,
			  success: function(data) {
				  if(data == 0) {
					  alert("<?php echo $bookingLangObj->getLabel("SLOTS_DUPLICATE_SLOT_ALERT"); ?>");
				  } else {
					  $wbc('#time_from_display_'+slot).fadeIn(0);
					  $wbc('#time_to_display_'+slot).fadeIn(0);
					  $wbc('#date_display_'+slot).fadeIn(0);
					  $wbc('#text_display_'+slot).fadeIn(0);
					  $wbc('#price_display_'+slot).fadeIn(0);
					  $wbc('#av_display_'+slot).fadeIn(0);
					   $wbc('#av_max_display_'+slot).fadeIn(0);
					  
					  $wbc('#time_from_input_'+slot).fadeOut(0);
					  $wbc('#time_to_input_'+slot).fadeOut(0);
					  $wbc('#date_input_'+slot).fadeOut(0);
					  $wbc('#text_input_'+slot).fadeOut(0);
					  $wbc('#price_input_'+slot).fadeOut(0);
					  $wbc('#av_input_'+slot).fadeOut(0);
					  $wbc('#av_max_input_'+slot).fadeOut(0);		
					  			  
					  $wbc('#date_display_'+slot).html(data);
					  from_hour = $wbc('#slot_time_from_hour_'+slot).val();
					  if(from_hour.length==1) {
						  from_hour='0'+from_hour;
					  }
					  from_minute = $wbc('#slot_time_from_minute_'+slot).val();
					  if(from_minute.length==1) {
						  from_minute='0'+from_minute;
					  }
					  to_hour = $wbc('#slot_time_to_hour_'+slot).val();
					  if(to_hour.length==1) {
						  to_hour='0'+to_hour;
					  }
					  to_minute = $wbc('#slot_time_to_minute_'+slot).val();
					  if(to_minute.length==1) {
						  to_minute='0'+to_minute;
					  }
					  ampm = '';
					  if($wbc('#slot_time_from_ampm_'+slot).val() != undefined) {
						  ampm = $wbc('#slot_time_from_ampm_'+slot).val();
					  }
					  
					  $wbc('#time_from_display_'+slot).html(from_hour+":"+from_minute+" "+ampm);
					  ampm = '';
					  if($wbc('#slot_time_to_ampm_'+slot).val() != undefined) {
						  ampm = $wbc('#slot_time_to_ampm_'+slot).val();
					  }
					  $wbc('#time_to_display_'+slot).html(to_hour+":"+to_minute+" "+ampm);
					  $wbc('#text_display_'+slot).html($wbc('#slot_special_text_'+slot).val());
					  if($wbc('#slot_price_'+slot).val()!='') {
						  var newprice = $wbc('#slot_price_'+slot).val();
					  	  $wbc('#price_display_'+slot).html(parseFloat(newprice).toFixed(2)+' <?php echo $bookingSettingObj->getPaypalCurrency(); ?>');
					  } else {
						  $wbc('#price_display_'+slot).html('0.00 <?php echo $bookingSettingObj->getPaypalCurrency(); ?>');
					  }
					  if($wbc('#slot_av_'+slot).val()!='') {
						  var newav = $wbc('#slot_av_'+slot).val();
					  	  $wbc('#av_display_'+slot).html(newav);
					  } else {
						  $wbc('#av_display_'+slot).html('');
					  }
					   if($wbc('#slot_av_max_'+slot).val()!='') {
						  var newavmax = $wbc('#slot_av_max_'+slot).val();
					  	  $wbc('#av_max_display_'+slot).html(newavmax);
					  } else {
						  $wbc('#av_max_display_'+slot).html('');
					  }
					  $wbc('#modify_'+slot).html('<a href="javascript:editItem('+slot+');"><?php echo $bookingLangObj->getLabel("SLOTS_MODIFY"); ?></a>');
					  $wbc('#row_'+slot).hide().fadeIn(2000);
				  }
				 
				
			  }
			});
		} else {
			alert("<?php echo $bookingLangObj->getLabel("SLOTS_TIME_ALERT"); ?>");
		}
	}
	
	function goToByScroll(id){
	      $wbc('html,body').animate({scrollTop: $wbc("#"+id).offset().top},'slow');
	}

	function checkEditTimes() {
		
		var error = 0;
		var len = document.getElementsByName('time_from_edit_hour[]').length;
		
		for(i=0;i<len;i++) {
			tempMinuteFrom = document.getElementsByName("time_from_edit_minute[]").item(i).value;
			if(document.getElementsByName("time_from_edit_minute[]").item(i).value.length == 1) {
				tempMinuteFrom = '0'+document.getElementsByName("time_from_edit_minute[]").item(i).value;
			}
			tempMinuteTo = document.getElementsByName("time_to_edit_minute[]").item(i).value;
			if(document.getElementsByName("time_to_edit_minute[]").item(i).value.length == 1) {
				tempMinuteTo = '0'+document.getElementsByName("time_to_edit_minute[]").item(i).value;
				
			}
			
			var from_value =document.getElementsByName("time_from_edit_hour[]").item(i).value+""+tempMinuteFrom;
			var to_value =document.getElementsByName("time_to_edit_hour[]").item(i).value+""+tempMinuteTo;
			if(document.getElementsByName("time_from_edit_ampm[]").item(i) && document.getElementsByName("time_from_edit_ampm[]").item(i).value=='am') {
				switch(document.getElementsByName("time_from_edit_hour[]").item(i).value) {
					case '12':
						from_value = '00'+tempMinuteFrom;
						break;
				}
			} else if(document.getElementsByName("time_from_edit_ampm[]").item(i) && document.getElementsByName("time_from_edit_ampm[]").item(i).value=='pm') {
				switch(document.getElementsByName("time_from_edit_hour[]").item(i).value) {
					case '1':
						from_value = '13'+tempMinuteFrom;
						break;
					case '2':
						from_value = '14'+tempMinuteFrom;
						break;
					case '3':
						from_value = '15'+tempMinuteFrom;
						break;
					case '4':
						from_value = '16'+tempMinuteFrom;
						break;
					case '5':
						from_value = '17'+tempMinuteFrom;
						break;
					case '6':
						from_value = '18'+tempMinuteFrom;
						break;
					case '7':
						from_value = '19'+tempMinuteFrom;
						break;
					case '8':
						from_value = '20'+tempMinuteFrom;
						break;
					case '9':
						from_value = '21'+tempMinuteFrom;
						break;
					case '10':
						from_value = '22'+tempMinuteFrom;
						break;
					case '11':
						from_value = '23'+tempMinuteFrom;
						break;
				}
			}
			if(document.getElementsByName("time_to_edit_ampm[]").item(i) && document.getElementsByName("time_to_edit_ampm[]").item(i).value=='am') {
				switch(document.getElementsByName("time_to_edit_hour[]").item(i).value) {
					case '12':
						to_value = '00'+tempMinuteTo;
						break;
				}
			} else if(document.getElementsByName("time_to_edit_ampm[]").item(i) && document.getElementsByName("time_to_edit_ampm[]").item(i).value=='pm') {
				switch(document.getElementsByName("time_to_edit_hour[]").item(i).value) {
					case '1':
						to_value = '13'+tempMinuteTo;
						break;
					case '2':
						to_value = '14'+tempMinuteTo;
						break;
					case '3':
						to_value = '15'+tempMinuteTo;
						break;
					case '4':
						to_value = '16'+tempMinuteTo;
						break;
					case '5':
						to_value = '17'+tempMinuteTo;
						break;
					case '6':
						to_value = '18'+tempMinuteTo;
						break;
					case '7':
						to_value = '19'+tempMinuteTo;
						break;
					case '8':
						to_value = '20'+tempMinuteTo;
						break;
					case '9':
						to_value = '21'+tempMinuteTo;
						break;
					case '10':
						to_value = '22'+tempMinuteTo;
						break;
					case '11':
						to_value = '23'+tempMinuteTo;
						break;
				}
			}
			
			/*if(from_value.substring(0,1) == "0") {
				from_value = parseInt(from_value.substring(1,4));
			}
			if(to_value.substring(0,1) == "0") {
				to_value = parseInt(to_value.substring(1,4));
			}*/
			
			if(parseInt(to_value)<parseInt(from_value)) {
				error = 1;
			}
			
			
		}
		
		return error;
	}
	function checkModifyData(frm) {
		
		with(frm) {
			if(date_from_edit.value == '') {
				alert("<?php echo $bookingLangObj->getLabel("SLOTS_DATE_FROM_ALERT"); ?>");
				return false;
			} else if(date_to_edit.value== '' ) {
				alert("<?php echo $bookingLangObj->getLabel("SLOTS_DATE_TO_ALERT"); ?>"); 
				return false;
			} else if(checkEditTimes() == 1) {
				alert("<?php echo $bookingLangObj->getLabel("SLOTS_NEW_TIME_RANGE_ALERT"); ?>");
				return false;
			} else {
				return true;
			}
		}
	}
	
</script>


<?php
if(count($arraySlotsHour)>0) {
?>


<a href="javascript:openSection('search_div');" class="booking_manage_slot_box_title booking_border_1 booking_border_solid booking_border_ccc booking_margin_t_20"><?php echo $bookingLangObj->getLabel("SLOT_SEARCH_TIME_SLOTS_LABEL"); ?></a>

<div class="booking_padding_5 booking_width_60p booking_bg_f6f" id="search_div" style="display:none !important">
    <div class="booking_font_14 booking_margin_t_20"><?php echo $bookingLangObj->getLabel("SLOT_SEARCH_TIME_SLOTS_SUBLABEL"); ?></div>
    
    <!-- select filter by date -->
    <div class="booking_margin_t_20 booking_font_14">
        <div class="booking_float_left booking_height_30 booking_line_30"><label for="search_date"><?php echo $bookingLangObj->getLabel("SLOT_SEARCH_FILTER_LABEL"); ?></label></div>
        <div class="booking_float_left booking_margin_l_10">
            <select name="search_date" id="search_date" onchange="javascript:showFilters(this.options[this.selectedIndex].value);">
                <option value="0"><?php echo $bookingLangObj->getLabel("SLOT_SEARCH_FILTER_CHOOSE"); ?></option>
                <option value="1"><?php echo $bookingLangObj->getLabel("SLOT_SEARCH_FILTER_SINGLE"); ?></option>
                <option value="2"><?php echo $bookingLangObj->getLabel("SLOT_SEARCH_FILTER_PERIOD"); ?></option>
            </select>
        </div>
        <div class="booking_cleardiv"></div>
    </div>
    
    <div id="filters" style="display:none !important">
        
        <!-- filter by period of time -->
        
        <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20"><label for="date_from" id="label_from"><?php echo $bookingLangObj->getLabel("SLOTS_FROM"); ?></label></div>
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
            <input type="text" class="booking_width_100 booking_margin_t_5" name="date_from" id="date_from" readonly="readonly" style="background-color: #fff;" >
            <input type="hidden" name="first_date" id="first_date">
        </div>
        <div id="date_to_filter" style="display:none !important">
            <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_l_10 booking_margin_t_20"><label for="date_to"><?php echo $bookingLangObj->getLabel("SLOTS_TO"); ?></label></div>
            <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
                <input type="text" class="booking_width_100 booking_margin_t_5" name="date_to" id="date_to"  readonly="readonly" style="background-color: #fff;">
                <input type="hidden" name="second_date" id="second_date">
            </div>
        </div>
        <div class="booking_cleardiv"></div>
        
        
        <!-- select weekdays -->
        <div class="booking_margin_t_20" style="display:none !important" id="weekdays_filter" >
            <div class="booking_float_left booking_height_30 booking_line_30"><label for="slot_week_day"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_LABEL"); ?></label></div>
            <div class="booking_float_left booking_margin_l_10">
                <select name="slot_week_day" id="slot_week_day">
                    <option value="0"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_ALL"); ?></option>
                    <option value="1"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_MON"); ?></option>
                    <option value="2"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_TUE"); ?></option>
                    <option value="3"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_WED"); ?></option>
                    <option value="4"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_THU"); ?></option>
                    <option value="5"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_FRI"); ?></option>
                    <option value="6"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_SAT"); ?></option>
                    <option value="7"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_SUN"); ?></option>
                </select>
            </div>
        </div>
        <div class="booking_cleardiv"></div>
        
        
        <!-- filter by range time -->
        
        <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20"><label for="time_from"><?php echo $bookingLangObj->getLabel("SLOT_TIME_FROM_LABEL"); ?></label></div>
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
        	<select name="time_from_hour" id="time_from_hour">
                <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_HOUR"); ?></option>
                <?php
                if($bookingSettingObj->getTimeFormat() == '24') {
					$start=0;
					$to = 23;
					$ampm=0;
				} else {
					$start=1;
					$to = 12;
					$ampm = 1;
				}
                for($i=$start;$i<=$to;$i++) {
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                }
                ?>
            </select>
            <select name="time_from_minute" id="time_from_minute">
                <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_MINUTE"); ?></option>
                <?php						
                for($i=0;$i<=59;$i++) {
					$num = $i;
					if(strlen($num) == 1) {
						$num = '0'.$num;
					}
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $num; ?></option>
                    <?php
                }
                ?>
            </select>
            <?php
            if($ampm == 1) {
                ?>
                <select name="time_from_ampm" id="time_from_ampm">
                    <option value="am">am</option>
                    <option value="pm">pm</option>
                </select>
                <?php
            }
            ?>
        	
        </div>
        
        <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20 booking_margin_l_10"><label for="time_to"><?php echo $bookingLangObj->getLabel("SLOT_TIME_TO_LABEL"); ?></label></div>
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
            <div>
            	<select name="time_to_hour" id="time_to_hour">
                    <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_HOUR"); ?></option>
                    <?php
                    if($bookingSettingObj->getTimeFormat() == '24') {
						$start=0;
                        $to = 23;
                        $ampm=0;
                    } else {
						$start=1;
                        $to = 12;
                        $ampm = 1;
                    }
                    for($i=$start;$i<=$to;$i++) {
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="time_to_minute" id="time_to_minute">
                    <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_MINUTE"); ?></option>
                    <?php						
                    for($i=0;$i<=59;$i++) {
						$num = $i;
						if(strlen($num) == 1) {
							$num = '0'.$num;
						}
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $num; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
                if($ampm == 1) {
                    ?>
                    <select name="time_to_ampm" id="time_to_ampm">
                        <option value="am">am</option>
                        <option value="pm">pm</option>
                    </select>
                    <?php
                }
                ?>
            </div>
            <div class="booking_font_12 booking_float_right booking_mark_666 booking_margin_t_5"><?php echo $bookingLangObj->getLabel("SLOT_TIME_TO_SUBLABEL"); ?></div>
        </div>
        
        <div class="booking_cleardiv"></div>
        
        <!-- search -->
        <div class="booking_margin_t_20">
        	<input type="button" name="saveunpublish" onclick="javascript:filterSlots();" value="<?php echo $bookingLangObj->getLabel("SLOTS_SEARCH"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff">
        	<div id="result_search" style="float:left;margin-top:20px"></div>
        </div>
        
        
    </div>
    
    <div class="booking_cleardiv"></div>
    
</div>

<div class="booking_cleardiv"></div>





<!-- 
=======================
=== modify slots ==
=======================
-->

<a href="javascript:openSection('modify_div');" class="booking_manage_slot_box_title booking_border_1 booking_border_solid booking_border_ccc booking_margin_t_20"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_LABEL"); ?></a>

<div class="booking_padding_5 booking_width_60p booking_bg_f6f" id="modify_div" style="display:none !important">

    <div class="booking_float_left booking_margin_t_20 booking_height_30 booking_line_30"><label for="form_action"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_ACTION"); ?></label></div>
    <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
        <select name="form_action" id="form_action" onchange="javascript:showForm(this.options[this.selectedIndex].value);">
            <option value="0"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_CHOOSE"); ?></option>
            <option value="1"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_MODIFY"); ?></option>
            <option value="2"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_DELETE"); ?></option>
        </select>
    </div>
    <div class="booking_cleardiv"></div>
    
    
    <form style="display:none !important" name="modify_slots" method="post" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/checkEditSlots.php" target="frame_submit" id="modify_form" onsubmit="return checkModifyData(this);">
        <input type="hidden" name="calendar_id" value="<?php echo $_GET["calendar_id"]; ?>" />
        
        <div class="booking_float_left booking_margin_t_20 booking_height_30 booking_line_30"><label for="slot_hour_edit"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_SLOT"); ?></label></div>
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
                <select name="slot_hour_edit" id="slot_hour_edit">
                    <?php
					
                    for($i=0;$i<count($arraySlotsHour);$i++) {
						
						if($bookingSettingObj->getTimeFormat() == "12") {
							$slotTime = date('h:i a',strtotime(substr($arraySlotsHour[$i],0,5)));
							
						} else {
							$slotTime = substr($arraySlotsHour[$i],0,5);
							
						}
						
                        ?>
                        <option value="<?php echo $arraySlotsHour[$i];?>"><?php echo $slotTime; ?></option>
                        <?php
                    }
                    ?>
                </select>
        </div>
        <div class="booking_cleardiv"></div>
        
        
        <!-- select weekdays -->
        <div class="booking_float_left booking_margin_t_20 booking_height_30 booking_line_30"><label for="slot_week_day_edit"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_WEEKDAYS"); ?></label></div>
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
            <select name="slot_week_day_edit" id="slot_week_day_edit">
                <option value="0"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_ALL"); ?></option>
                <option value="1"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_MON"); ?></option>
                <option value="2"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_TUE"); ?></option>
                <option value="3"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_WED"); ?></option>
                <option value="4"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_THU"); ?></option>
                <option value="5"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_FRI"); ?></option>
                <option value="6"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_SAT"); ?></option>
                <option value="7"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_SUN"); ?></option>
            </select>
        </div>
       
        <div class="booking_cleardiv"></div>
        
        
        <!-- from to -->
        <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20"><label for="date_from_edit"><?php echo $bookingLangObj->getLabel("SLOT_FROM"); ?></label></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10">
            <input type="text" class="booking_width_100 booking_margin_t_5" name="date_from_edit" id="date_from_edit" readonly="readonly" style="background-color: #fff;">
            <input type="hidden" name="first_date_edit" id="first_date_edit">
        </div>
       
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20"><label for="date_to_edit"><?php echo $bookingLangObj->getLabel("SLOT_TO"); ?></label></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10">
            <input type="text" class="booking_width_100 booking_margin_t_5" name="date_to_edit" id="date_to_edit"  readonly="readonly" style="background-color: #fff;">
            <input type="hidden" name="second_date_edit" id="second_date_edit">
        </div>
        <div class="booking_cleardiv"></div>
            
        
         <!-- filter by range time -->
         <div class="booking_float_left booking_margin_t_20 booking_height_30 booking_line_30"><label for="time_from"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_NEW_TIME_FROM"); ?></label></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10">
        	<select name="time_from_edit_hour[]">
                <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_HOUR"); ?></option>
                <?php
                if($bookingSettingObj->getTimeFormat() == '24') {
					$start=0;
					$to = 23;
					$ampm=0;
				} else {
					$start=1;
					$to = 12;
					$ampm = 1;
				}
                for($i=$start;$i<=$to;$i++) {
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                }
                ?>
            </select>
            <select name="time_from_edit_minute[]">
                <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_MINUTE"); ?></option>
                <?php						
                for($i=0;$i<=59;$i++) {
					$num = $i;
					if(strlen($num) == 1) {
						$num = '0'.$num;
					}
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $num; ?></option>
                    <?php
                }
                ?>
            </select>
            <?php
            if($ampm == 1) {
                ?>
                <select name="time_from_edit_ampm[]">
                    <option value="am">am</option>
                    <option value="pm">pm</option>
                </select>
                <?php
            }
            ?>
        	
        </div>
        
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20 booking_height_30 booking_line_30"><label for="time_to"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_NEW_TIME_TO"); ?></label></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_10">
        	<select name="time_to_edit_hour[]">
                <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_HOUR"); ?></option>
                <?php
                if($bookingSettingObj->getTimeFormat() == '24') {
					$start=0;
					$to = 23;
					$ampm=0;
				} else {
					$start=1;
					$to = 12;
					$ampm = 1;
				}
                for($i=$start;$i<=$to;$i++) {
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php
                }
                ?>
            </select>
            <select name="time_to_edit_minute[]">
                <option value=""><?php echo $bookingLangObj->getLabel("SLOTS_MINUTE"); ?></option>
                <?php						
                for($i=0;$i<=59;$i++) {
					$num = $i;
					if(strlen($num) == 1) {
						$num = '0'.$num;
					}
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $num; ?></option>
                    <?php
                }
                ?>
            </select>
            <?php
            if($ampm == 1) {
                ?>
                <select name="time_to_edit_ampm[]">
                    <option value="am">am</option>
                    <option value="pm">pm</option>
                </select>
                <?php
            }
            ?>
        	
        </div>
        <div class="booking_cleardiv"></div>            
            
            
        
        
        
		<?php
        if($bookingSettingObj->getPaypalDisplayPrice() == 1) {
            ?>
            <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20"><label for="slot_price_edit"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_NEW_PRICE"); ?></label></div>
            <div class="booking_float_left booking_margin_t_20 booking_margin_l_10"><input type="text" class="booking_width_100 booking_margin_t_5" name="slot_price_edit" id="slot_price_edit" style="background-color: #fff;"></div>
            <div class="booking_cleardiv"></div>
            <?php
        }
        ?>
      
        
        
        
       
		<?php
        if($bookingSettingObj->getSlotsUnlimited() == 2) {
            ?>
            <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20"><label for="slot_price_edit"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_NEW_AV"); ?></label></div>
            <div class="booking_float_left booking_margin_t_20 booking_margin_l_10"><input type="text" class="booking_width_100 booking_margin_t_5" name="slot_av_edit" id="slot_av_edit" style="background-color: #fff;"></div>
            <div class="booking_cleardiv"></div>
            <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20"><label for="slot_price_edit"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_NEW_AV_MAX"); ?></label></div>
            <div class="booking_float_left booking_margin_t_20 booking_margin_l_10"><input type="text" class="booking_width_100 booking_margin_t_5" name="slot_av_max_edit" id="slot_av_max_edit" style="background-color: #fff;"></div>
            <div class="booking_cleardiv"></div>
            <?php
        }
        ?>
	<div class="input_boxes_container">
            	
                <div class="input_title" style="margin-right: 66px;"><label for="slot_price_edit"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_NEW_TEXT"); ?></label></div>
                <div class="input_input">
                    <input type="text" class="short_input_box" name="slot_special_text_edit" id="slot_special_text_edit">
                </div>
                
            </div>
            <div id="empty"></div>
       
       
        
        
        <!-- search -->
        <div class="booking_margin_t_20"><input type="submit" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff" id="edit_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("SLOTS_MODIFY"); ?>"></div>
        <!-- loader -->
        <div id="result_modify"></div> 
        
        
    </form> 
    
    
    <form style="display:none !important" name="delete_slots" method="post" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/checkSlots.php" target="frame_submit" tmt:validate="true" id="delete_form">
        <input type="hidden" name="calendar_id" value="<?php echo $_GET["calendar_id"]; ?>" />
        <div class="booking_margin_t_20 booking_float_left booking_height_30 booking_line_30"><label for="slot_hour_delete"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_SLOT"); ?></label></div>
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
            <select name="slot_hour_delete" id="slot_hour_delete">
                <?php
                for($i=0;$i<count($arraySlotsHour);$i++) {
					if($bookingSettingObj->getTimeFormat() == "12") {
						$slotTime = date('h:i a',strtotime(substr($arraySlotsHour[$i],0,5)));
						
					} else {
						$slotTime = substr($arraySlotsHour[$i],0,5);
						
					}
                    ?>
                    <option value="<?php echo $arraySlotsHour[$i];?>"><?php echo $slotTime; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="booking_cleardiv"></div>
        
        
        <!-- select weekdays -->
        <div class="booking_margin_t_20 booking_float_left booking_height_30 booking_line_30"><label for="slot_week_day_delete"><?php echo $bookingLangObj->getLabel("SLOT_MODIFY_SLOTS_WEEKDAYS"); ?></label></div>
        <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
            <select name="slot_week_day_delete" id="slot_week_day_delete">
                <option value="0"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_ALL"); ?></option>
                <option value="1"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_MON"); ?></option>
                <option value="2"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_TUE"); ?></option>
                <option value="3"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_WED"); ?></option>
                <option value="4"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_THU"); ?></option>
                <option value="5"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_FRI"); ?></option>
                <option value="6"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_SAT"); ?></option>
                <option value="7"><?php echo $bookingLangObj->getLabel("SLOT_WEEKDAY_SUN"); ?></option>
            </select>
        </div>
        <div class="booking_cleardiv"></div>
        
        
        <div class="booking_float_left booking_margin_t_20 booking_height_30 booking_line_30"><label for="date_from_delete"><?php echo $bookingLangObj->getLabel("SLOT_FROM"); ?></label></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_20">
            <input type="text" class="booking_width_100 booking_margin_t_5" name="date_from_delete" id="date_from_delete" readonly="readonly"  tmt:required="true" tmt:message="Select a date from" style="background-color: #fff;">
            <input type="hidden" name="first_date_delete" id="first_date_delete">
        </div>
       
        <div class="booking_float_left booking_margin_t_20 booking_height_30 booking_line_30 booking_margin_l_10"><label for="date_to_edit"><?php echo $bookingLangObj->getLabel("SLOT_TO"); ?></label></div>
        <div class="booking_float_left booking_margin_t_20 booking_margin_l_20  booking_margin_l_10">
            <div><input type="text" class="booking_width_100 booking_margin_t_5" name="date_to_delete" id="date_to_delete"  readonly="readonly" tmt:required="true" tmt:message="Select a date to" style="background-color: #fff;"><input type="hidden" name="second_date_delete" id="second_date_delete"></div>
            <div class="booking_font_12 booking_margin_t_5 booking_float_right"><?php echo $bookingLangObj->getLabel("SLOT_TIME_TO_SUBLABEL"); ?></div>
        </div>
            
        <div class="booking_cleardiv"></div>
        
        
        <div class="booking_margin_t_20"><input type="submit" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff" id="del_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("SLOTS_DELETE"); ?>"></div>
        <div id="result_delete"></div>
    
    </form>
    
</div>
<div class="booking_cleardiv"></div>

<?php
}
?>

<!-- 
============================================================================================
===  ==
============================================================================================
-->

<a name="results" id="results"></a>

<div class="booking_margin_t_20 booking_bg_f6f booking_border_1 booking_border_solid booking_border_ccc">
	<a onclick="javascript:delItems('manage_slots','slots[]','delSlots','<?php echo $bookingLangObj->getLabel("SLOTS_DELETE_MULTIPLE_ALERT");?>','<?php echo $bookingLangObj->getLabel("SLOTS_NO_ITEMS_SELECTED"); ?>')" class="booking_float_right booking_pointer booking_padding_10"><?php echo $bookingLangObj->getLabel("SLOTS_DELETE");?></a>
    <div class="booking_cleardiv"></div>
</div>
<div class="booking_cleardiv"></div>



<form name="manage_slots" action="" method="post" style="display:inline;">
	<input type="hidden" name="operation" />
	<input type="hidden" name="slots[]" value=0 />
	
	<div id="table" class="booking_margin_t_20">
    
    	<div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">
        
			<div class="booking_float_left booking_width_5p">#</div>
			
			<div class="booking_float_left booking_width_5p"><input type="checkbox" name="selectAll" onclick="javascript:selectCheckbox('manage_slots','slots[]');" /></div>
			
			<div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("SLOTS_DATE_LABEL");?>&nbsp;<a href="javascript:orderby('<?php echo $_SESSION["orderbySlotsDate"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbySlotsDate"];?>.gif" border=0 /></a></div>
			
			<div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("SLOTS_TIME_FROM_LABEL");?>&nbsp;<a href="javascript:orderby('<?php echo $_SESSION["orderbySlotsTime"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbySlotsTime"];?>.gif" border=0 /></a></div>
			
            <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("SLOTS_TIME_TO_LABEL");?></div>
			
			<div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("SLOTS_SPECIAL_TEXT_LABEL");?></div>
			
            <div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("SLOTS_PRICE_LABEL");?></div>
			
			<div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("SLOTS_AV_LABEL");?></div>
			
			<div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("SLOTS_RESERVATION_LABEL");?></div>
			
			<div class="booking_float_left booking_width_10p"></div>
			
			<div class="booking_float_left booking_width_5p"></div>
			
			<div class="booking_cleardiv"></div>
			
		</div>
    </div>
</form>
<div class="booking_cleardiv"></div>
<div id="rowspace"></div>
<iframe name="frame_submit" id="frame_submit"  style="width:0px;height:0px;border:0px;"></iframe>
