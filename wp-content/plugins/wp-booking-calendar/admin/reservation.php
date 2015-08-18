<?php 
include 'common.php';

//manage reservation operations
if(isset($_POST["operation"]) && $_POST["operation"] != '' && isset($_POST["reservations"])) {
	$arrReservation=$_POST["reservations"];
	$qryString = "0";
	for($i=0;$i<count($arrReservation); $i++) {
		$qryString .= ",".$arrReservation[$i];
	}
		
	switch($_POST["operation"]) {
		case "delReservations":
			$bookingReservationObj->delReservations($qryString);
			break;
	}                
	//header('Location: reservation.php?calendar_id='.$_GET["calendar_id"]);
}




$bookingCalendarObj->setCalendar($_GET["calendar_id"]);


?>

<div class="booking_padding_20 booking_font_14 booking_line_percent booking_bg_fff">

       
    <div class="booking_font_12"><strong><?php echo $bookingLangObj->getLabel("RESERVATION_YOU_ARE_IN");?></strong>: <a href="?page=wp-booking-calendar-reservations"><?php echo $bookingLangObj->getLabel("RESERVATIONS");?></a> > <?php echo $bookingLangObj->getLabel("CALENDAR");?>: <?php echo $bookingCalendarObj->getCalendarTitle(); ?> > <?php echo $bookingLangObj->getLabel("RESERVATIONS_LIST");?></div>
    <div class="booking_cleardiv"></div>
            
            
            
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
                
                onClose: function(selectedDate) { 
                    $wbc( "#date_to" ).datepicker( "option", "minDate", selectedDate );
                    $wbc( "#date_to").datepicker({
                        altField: "#second_date",
                        altFormat: "yy,mm,dd",
                       // minDate: selectedDate,
                        onClose: function( selectedDate ) {
                            $wbc( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
                        }
                    });
                }
            });
            
            
        });
        
        function orderby(column,type) {
        
            $wbc.ajax({
              url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/setReservationOrderby.php?order_by='+column+'&type='+type+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>",
              success: function(data) {
                  $wbc('#table').hide().html(data).fadeIn(2000);						 
                
              }
            });
            
        }
        function filterReservations() {
            if($wbc('#search_date option:selected').val() == 1) {
                if(Trim($wbc('#first_date').val()) != '') {
                    $wbc('#result_search').html('<img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.gif">');
                    $wbc.ajax({
                      url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/filterReservations.php?date_from='+$wbc('#first_date').val()+"&wordpress_user_id="+$wbc('#wordpress_user_id option:selected').val()+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>",
                      success: function(data) {
						  $wbc('#wordpress_user_id').val('');
                          $wbc('#date_from').val('');
                          $wbc('#first_date').val('');
                          $wbc('#table').hide().html(data).fadeIn(2000);
                          $wbc('#result_search').html('');
                          goToByScroll("results");
                          $wbc('.action_reset').fadeIn(0);
                      }
                    });
                } else {
                    alert("<?php echo $bookingLangObj->getLabel("RESERVATION_SELECT_DATE_ALERT");?>");
                }
            } else if($wbc('#search_date option:selected').val() == 2) {
                if(Trim($wbc('#first_date').val()) != '' && Trim($wbc('#second_date').val()) != '') {
                    $wbc('#result_search').html('<img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.gif">');
                    $wbc.ajax({
                      url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/filterReservations.php?date_from='+$wbc('#first_date').val()+"&date_to="+$wbc('#second_date').val()+"&wordpress_user_id="+$wbc('#wordpress_user_id option:selected').val()+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>",
                      success: function(data) {
						  $wbc('#wordpress_user_id').val('');
                          $wbc('#date_from').val('');
                          $wbc('#date_to').val('');
                          $wbc('#first_date').val('');
                          $wbc('#second_date').val('');
                          $wbc('#table').hide().html(data).fadeIn(2000);
                          $wbc('#result_search').html('');
                          goToByScroll("results");
                          $wbc('.action_reset').fadeIn(0);
                      }
                    });
                } else {
                    alert("<?php echo $bookingLangObj->getLabel("RESERVATION_SELECT_DATE_RANGE_ALERT");?>");
                }
            }
        }
        function delItem(itemId) {
            if(confirm("<?php echo $bookingLangObj->getLabel("RESERVATION_DELETE_SINGLE_ALERT");?>")) {
                $wbc.ajax({
                  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/delReservationItem.php?item_id='+itemId+"&calendar_id=<?php echo $_GET["calendar_id"]; ?>",
                  success: function(data) {
                      $wbc('#table').hide().html(data).fadeIn(2000);
                     
                    
                  }
                });
            } 
        }
        function confirmReservation(itemId) {
            //have to check if paypal is active and this reservation has a price, if it has, warn the admin that it could not be payed
            <?php
            if($bookingSettingObj->getPaypal()==1 && $bookingSettingObj->getPaypalAccount() != '' && $bookingSettingObj->getPaypalLocale() != '' && $bookingSettingObj->getPaypalCurrency() != '') {
                ?>
                $wbc.ajax({
                  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/checkSlotPrice.php?reservation_id='+itemId,
                  success: function(data) {
                      if(data>0) {
                          //there's a price
                          if(confirm("<?php echo $bookingLangObj->getLabel("RESERVATION_PAYPAL_CONFIRM_SINGLE_ALERT");?>")) {
                                $wbc.ajax({
                                  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/confirmReservation.php?reservation_id='+itemId,
                                  success: function(data) {
                                      $wbc('#conferma_'+itemId).html('<a href="javascript:unconfirmReservation('+itemId+');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /></a>');								 							 
                                    
                                  }
                                });
                            } 
                      } else {
                          if(confirm("<?php echo $bookingLangObj->getLabel("RESERVATION_CONFIRM_SINGLE_ALERT");?>")) {
                                $wbc.ajax({
                                  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/confirmReservation.php?reservation_id='+itemId,
                                  success: function(data) {
                                      $wbc('#conferma_'+itemId).html('<a href="javascript:unconfirmReservation('+itemId+');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /></a>');								 							 
                                    
                                  }
                                });
                            } 
                      }
                    
                  }
                });
                <?php
            } else {
                ?>
                            if(confirm("<?php echo $bookingLangObj->getLabel("RESERVATION_CONFIRM_SINGLE_ALERT");?>")) {
                                $wbc.ajax({
                                    url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/confirmReservation.php?reservation_id='+itemId,
                                    success: function(data) {
                                          $wbc('#conferma_'+itemId).html('<a href="javascript:unconfirmReservation('+itemId+');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /></a>');								 							 
                    
                                    }
                                });
                            } 
            <?php
            }
            ?>
        }
        function unconfirmReservation(itemId) {
            if(confirm("<?php echo $bookingLangObj->getLabel("RESERVATION_UNCONFIRM_SINGLE_ALERT");?>")) {
                $wbc.ajax({
                  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/unconfirmReservation.php?reservation_id='+itemId,
                  success: function(data) {
                      $wbc('#conferma_'+itemId).html('<a href="javascript:confirmReservation('+itemId+');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /></a>');								 							 
                    
                  }
                });
            } 
        }
        
        function showForm(value) {
            if(value==1) {
                $wbc('#form_add').slideDown();
                $wbc('#date_to_field').slideUp();
                $wbc('#from_date_label').html('<?php echo $bookingLangObj->getLabel("RESERVATION_DAY");?>');
            } else if(value==2) {
                $wbc('#form_add').slideDown();
                $wbc('#date_to_field').slideDown();
                $wbc('#from_date_label').html('<?php echo $bookingLangObj->getLabel("RESERVATION_FROM");?>');
            } else {
                $wbc('#form_add').slideUp();
            }
        }
        
        function openSection(div) {
            if(document.getElementById(div).style.display=="none") {
                $wbc('#'+div).slideDown();
            } else {
                $wbc('#'+div).slideUp();
            }
        }
        
        function goToByScroll(id){
              $wbc('html,body').animate({scrollTop: $wbc("#"+id).offset().top},'slow');
        }
        
        function resetSearch() {
             $wbc.ajax({
                  url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/resetReservationSearch.php?&calendar_id=<?php echo $_GET["calendar_id"]; ?>',
                  success: function(data) {
                      $wbc('#table').hide().html(data).fadeIn(2000);
                      goToByScroll("results");
                      $wbc('.action_reset').fadeOut(0);
                  }
                });
        }
        
        function CSVexport() {
             $wbc.ajax({
              url: '<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/csvExport.php?calendar_id=<?php echo $_GET["calendar_id"]; ?>',
              success: function(data) {
                  document.location.href = "<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/reservation.csv";
              }
            });
        }
		
		function contactUser(email,user_info,reservation_info) {
			$wbc('body').prepend('<div id="sfondo" class="booking_modal_sfondo" onclick="hideModal()"></div>');
			$wbc('#contact_modal').fadeIn();
			$wbc('#user_contact_email').val(email);
			$wbc('#user_contact_info').html(user_info);
			$wbc('#reservation_contact_info').html(reservation_info);
		}
		
		function hideModal() {
			$wbc('#sfondo').remove();
			$wbc('#contact_modal').fadeOut();
		}
		
		function checkContactData(frm) {
			with(frm) {
				if(Trim(user_contact_email.value) == '' || !isEmailAddr(user_contact_email,true,'')) {
					alert("<?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_TO_ALERT");?>");
					return false;
				} else if(Trim(user_contact_subject.value) == '') {
					alert("<?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_SUBJECT_ALERT");?>");
					return false;
				} else if(Trim(user_contact_message.value) == '') {
					alert("<?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_MESSAGE_ALERT");?>");
					return false;
				} else {
					return true;
				}
			}
		}
        
    </script>
    
    <div id="contact_modal" class="booking_modal_contact" style="display:none !important">
    	<div class="booking_margin_b_10"><?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_MODAL_TEXT1");?> <span id="user_contact_info" class="booking_font_bold"></span><br /><br /><?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_MODAL_TEXT2");?><br /><span id="reservation_contact_info"></span></div>
    	<form style="display:inline !important" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/sendUserEmail.php" method="post" target="iframe_submit" onsubmit="return checkContactData(this);">
        	<div><?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_TO");?></div>
            <div class="booking_margin_t_5"><input type="text" name="user_contact_email" id="user_contact_email" class="booking_width_70p" value="" /></div>
            <div class="booking_bold booking_margin_t_20"><?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_CC");?></div>
            <div class="booking_margin_t_5"><input type="text" name="user_contact_cc" class="booking_width_70p" value="" /></div>
            <div class="booking_bold booking_margin_t_20"><?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_BCC");?></div>
            <div class="booking_margin_t_5"><input type="text" name="user_contact_bcc" class="booking_width_70p" value="" /></div>
            <div class="booking_bold booking_margin_t_20"><?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_SUBJECT");?></div>
            <div class="booking_margin_t_5"><input type="text" name="user_contact_subject" class="booking_width_70p" /></div>
            <div class="booking_bold booking_margin_t_20"><?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_MESSAGE");?></div>
            <div class="booking_margin_t_10"><textarea name="user_contact_message" class="booking_width_70p" ></textarea></div>
            <div class="booking_margin_t_10"><input type="submit" value="<?php echo $bookingLangObj->getLabel("RESERVATION_USER_CONTACT_BUTTON");?>" class="booking_send_btn" /></div>
        </form>
    </div>
    <a href="javascript:openSection('create_div');"  class="booking_manage_slot_box_title booking_border_1 booking_border_solid booking_border_ccc booking_margin_t_20"><?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH_RESERVATION_LABEL");?></a>
    
    <div class="booking_padding_5 booking_width_60p booking_bg_f6f" id="create_div" style="display:none !important">
        <div class="booking_font_14 booking_margin_t_20"><?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH_RESERVATION_SUBLABEL");?></div>
        
        <!-- select create closing days -->
        <div class="booking_margin_t_20 booking_font_14">
            <div class="booking_float_left booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH_FILTER_DATE_LABEL");?></div>
            <div class="booking_float_left booking_margin_l_10">
                <select name="search_date" id="search_date" onchange="javascript:showForm(this.options[this.selectedIndex].value);">
                    <option value="0"><?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH_FILTER_DATE_CHOOSE");?></option>
                    <option value="1"><?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH_FILTER_DATE_ONE_DAY");?></option>
                    <option value="2"><?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH_FILTER_DATE_PERIOD");?></option>
                </select>
            </div>
            <div class="booking_cleardiv"></div>
        </div>
        
        
        <div id="form_add" style="display:none !important">
            <!-- filter by period of time -->
            <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20" id="from_date_label"><?php echo $bookingLangObj->getLabel("RESERVATION_FROM");?></div>
            <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
                <input type="text" class="booking_width_100 booking_margin_t_5" name="date_from" id="date_from" readonly="readonly" style="background-color: #fff;">
                <input type="hidden" name="first_date" id="first_date">
            </div>
            <div id="date_to_field" style="display:none !important">
                <div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20 booking_margin_l_10"><?php echo $bookingLangObj->getLabel("RESERVATION_TO");?></div>
                <div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
                    <input type="text" class="booking_width_100 booking_margin_t_5" name="date_to" id="date_to"  readonly="readonly" style="background-color: #fff;">
                    <input type="hidden" name="second_date" id="second_date">
                </div>
                <div class="booking_cleardiv"></div>        
            </div>
            <div class="booking_cleardiv"></div> 
            <?php
			if($bookingSettingObj->getWordpressRegistration() == 1) {
				?>
				<!--filter by user too-->
				<div class="booking_float_left booking_height_30 booking_line_30 booking_margin_t_20" id="from_date_label"><?php echo $bookingLangObj->getLabel("RESERVATION_WORDPRESS_USER");?></div>
				<div class="booking_float_left booking_margin_l_10 booking_margin_t_20">
					<select name="wordpress_user_id" id="wordpress_user_id">
                        <option value=""><?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH_FILTER_WP_USER_ALL");?></option>
                        <option value="0"><?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH_FILTER_WP_USER_NOT_REGISTERED");?></option>
                        <?php
						$wp_users = get_users();
						foreach ($wp_users as $user) {
							?>
                            <option value="<?php echo $user->ID; ?>"><?php echo $user->user_login;?></option>
                            <?php
						}
						?>
                    </select>
				</div>
				<?php
			}
			?>
            
            <div class="booking_cleardiv"></div>     
            <!-- search -->
            <div class="booking_margin_t_20">
                <input type="button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("RESERVATION_SEARCH"); ?>" onclick="javascript:filterReservations();" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff booking_float_left">
                <div id="result_search" class="booking_float_left booking_margin_l_20"></div>
                <div class="booking_cleardiv"></div>
            </div>
        
        </div>
            
    </div>


        
    <a id="results" name="results"></a>
    
    <div id="action_bar" class="booking_margin_t_20 booking_bg_f6f booking_border_1 booking_border_solid booking_border_ccc booking_padding_10">
    	<div class="booking_float_left"><?php echo $bookingLangObj->getLabel("RESERVATION_RED_LABEL");?></div> 
    	<div class="booking_float_right">          
            <a onclick="javascript:delItems('manage_reservations','reservations[]','delReservations','<?php echo $bookingLangObj->getLabel("RESERVATION_DELETE_MULTIPLE_ALERT");?>','<?php echo $bookingLangObj->getLabel("RESERVATION_NO_ITEMS_SELECTED"); ?>')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("RESERVATION_DELETE");?></a>
            <a onclick="javascript:CSVexport();" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("CSV_EXPORT");?></a>
            <a style="display:none !important" onclick="javascript:resetSearch();" class="action_reset booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("RESERVATION_RESET_LABEL");?></a>
        </div>
        <div class="booking_cleardiv"></div>
    </div>



    <form name="manage_reservations" action="" method="post">
        <input type="hidden" name="operation" />
        <input type="hidden" name="reservations[]" value=0 />
        
        <div class="booking_margin_t_20">
            <div id="table" class="booking_font_12">
            
                <!-- 
                =======================
                === table header ==
                =======================
                -->
                <div class="booking_border_b_1 booking_border_solid booking_border_ccc booking_bg_f6f booking_height_30 booking_line_30">
                	<!-- number -->
                    <div class="booking_float_left booking_width_3p">#</div>
                    
                    <!-- check -->
                    <div class="booking_float_left booking_width_3p"><input type="checkbox" name="selectAll" onclick="javascript:selectCheckbox('manage_reservations','reservations[]');" /></div>            
                    
                    <!-- date -->
                    <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("RESERVATION_DATE_LABEL");?>&nbsp;<a href="javascript:orderby('date','<?php echo $_SESSION["orderbyReservationDate"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbyReservationDate"];?>.gif" border=0 /></a></div>            
                    
                    <!-- time -->
                    <div class="booking_float_left booking_width_10p"><?php echo $bookingLangObj->getLabel("RESERVATION_TIME_LABEL");?>&nbsp;<a href="javascript:orderby('time','<?php echo $_SESSION["orderbyReservationTime"]; ?>');"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/orderby_<?php echo $_SESSION["orderbyReservationTime"];?>.gif" border=0 /></a></div>
                    
                    <!-- seats -->          
                    <div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("RESERVATION_SEATS_LABEL");?></div>
                    
                    <!-- surname -->
                    <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("RESERVATION_SURNAME_NAME_LABEL");?></div>            
                    
                    <!-- email -->
                    <div class="booking_float_left booking_width_20p"><?php echo $bookingLangObj->getLabel("RESERVATION_EMAIL_LABEL");?></div>        
                    
                    <!-- confirmed -->
                    <div class="booking_float_left booking_width_5p"><?php echo $bookingLangObj->getLabel("RESERVATION_CONFIRMED_LABEL");?></div>
                    
                    <!-- delete -->
                    <div class="booking_float_left booking_width_10p"></div>
                    
                    <!-- detail -->
                    <div class="booking_float_left booking_width_14p"></div>            
                    
                    <div class="booking_cleardiv"></div>
                    
                </div>
                    
                    
                    
                <?php                         
                $arrayReservations = $bookingListObj->getReservationsList($_SESSION["qryReservationsFilterString"],$_SESSION["qryReservationsOrderString"],$_GET["calendar_id"]);                        
                $i=1;
                foreach($arrayReservations as $reservationId => $reservation) {		
                    if($reservation["slot_active"] == 0) {
                        $class="booking_table_row_red";
                    } else {													
                        if($i % 2) {
                            $class="booking_alternate_table_row_white";
                        } else {
                            $class="booking_alternate_table_row_grey";
                        }
                    }
                ?>
                
                
                <div id="row_<?php echo $reservationId; ?>" class="booking_border_b_1 booking_border_solid booking_border_ccc">
                
                	<!-- number -->
                    <div class="booking_float_left booking_width_3p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $i; ?></div>
                    </div>
                    
                    <!-- check -->
                    <div class="booking_float_left booking_width_3p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><input type="checkbox" name="reservations[]" value="<?php echo $reservationId; ?>" onclick="javascript:disableSelectAll('manage_reservations',this.checked);" /></div>
                    </div> 
                    
                    <!-- date -->                 
                    <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                        	<?php
							if($bookingSettingObj->getDateFormat() == "UK") {
								$dateToSend = strftime('%d/%m/%Y',strtotime($reservation["reservation_date"]));
							} else if($bookingSettingObj->getDateFormat() == "EU") {
								$dateToSend = strftime('%Y/%m/%d',strtotime($reservation["reservation_date"]));
							} else {
								$dateToSend = strftime('%m/%d/%Y',strtotime($reservation["reservation_date"]));
							}
							?>
							<?php echo $dateToSend; ?>
                        </div>
                    </div>
                    
                    <!-- time -->
                    <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle">
                        	<?php
							$reservation_time = substr($reservation["reservation_time"],0,5);
							if($bookingSettingObj->getTimeFormat() == "12") {
								$reservation_time =date('h:i a',strtotime(substr($reservation["reservation_time"],0,5)));
								
							} 
							echo $reservation_time;
							?>
                        </div>
                    </div>
                    
                    <!-- seats -->
                    <div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $reservation["reservation_seats"]; ?></div>
                    </div>
                    
                    <!-- surname -->
                    <div class="booking_float_left booking_width_20p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><?php echo $reservation["reservation_surname"].", ".$reservation["reservation_name"]; ?></div>
                    </div>
                    
                    <!-- email -->
                    <div class="booking_float_left booking_width_20p booking_height_50 <?php echo $class; ?>">
                    	<?php
						$user_info = $reservation["reservation_surname"].", ".$reservation["reservation_name"];
						if($bookingSettingObj->getDateFormat() == "UK") {
							$dateToSend = strftime('%d/%m/%Y',strtotime($reservation["reservation_date"]));
						} else if($bookingSettingObj->getDateFormat() == "EU") {
							$dateToSend = strftime('%Y/%m/%d',strtotime($reservation["reservation_date"]));
						} else {
							$dateToSend = strftime('%m/%d/%Y',strtotime($reservation["reservation_date"]));
						}
						$reservation_info = '<strong>'.$bookingLangObj->getLabel("RESERVATION_DATE_LABEL").'</strong>: '.$dateToSend.'<br/><strong>'.$bookingLangObj->getLabel("RESERVATION_TIME_LABEL").'</strong>: '.$reservation_time.'<br /><strong>'.$bookingLangObj->getLabel("RESERVATION_SEATS_LABEL").'</strong>: '.$reservation["reservation_seats"];
						?>
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:contactUser('<?php echo $reservation["reservation_email"]; ?>','<?php echo $user_info; ?>','<?php echo $reservation_info; ?>');"><?php echo $reservation["reservation_email"]; ?></a></div>
                    </div>
                    
                    <!-- status -->
                    <div class="booking_float_left booking_width_5p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><span id="conferma_<?php echo $reservationId; ?>"><?php if($reservation["reservation_confirmed"]=='1' && $reservation["reservation_cancelled"] == 0) { ?><a href="javascript:unconfirmReservation(<?php echo $reservationId; ?>);"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/published.png" border=0 /></a><?php } else if($reservation["reservation_cancelled"] == 0){ ?><a href="javascript:confirmReservation(<?php echo $reservationId; ?>);"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/icons/unpublished.png" border=0 /></a><?php } else { ?><?php echo $bookingLangObj->getLabel("RESERVATION_CANCELLED"); ?><?php } ?></span></div>
                    </div>
                    
                    <!-- delete -->
                    <div class="booking_float_left booking_width_10p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="javascript:delItem(<?php echo $reservationId; ?>,'reservations','reservation_id');"><?php echo $bookingLangObj->getLabel("RESERVATION_DELETE");?></a></div>
                    </div>    
                    
                    <!-- detail -->                     
                    <div class="booking_float_left booking_width_14p booking_height_50 <?php echo $class; ?>">
                        <div class="booking_wh_inherit booking_table_cell booking_vertical_middle"><a href="?page=wp-booking-calendar-reservations&reservation_id=<?php echo $reservationId; ?>"><?php echo $bookingLangObj->getLabel("RESERVATION_DETAIL");?></a></div>
                    </div>
                    
                    
                    <div class="booking_cleardiv"></div>
                </div>
                <?php 
                $i++;
                } ?>
            
            
            </div>
        </div>
        </form>
     <iframe name="iframe_submit" id="iframe_submit" style="border:none;display:none;height:0;width:0"></iframe>
