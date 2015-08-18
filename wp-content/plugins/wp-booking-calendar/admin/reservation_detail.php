<?php 
include 'common.php';


$bookingReservationObj->setReservation($_GET["reservation_id"]);
$bookingSlotsObj->setSlot($bookingReservationObj->getReservationSlotId());
?>

<div class="booking_padding_20 booking_font_14 booking_line_percent booking_bg_fff">
       
    <div class="booking_margin_t_20">
			
            <script language="javascript" type="text/javascript">
				var $wbc = jQuery;
				function printDiv() {
					var docprint = window.open("about:blank", "_blank"); 
					var oTable = document.getElementById("detail_page");
					docprint.document.open(); 
					docprint.document.write('<html><head><title>Reservation detail</title><style>#detail_page {margin:auto;width:920px;background-color:#F6F6F5;border: 1px solid #CCCCCC;margin-top:15px;margin-bottom:0px;height:auto;}#title_row_detail {padding-left: 10px;width: 350px;height: 35px;float: left;line-height: 35px;font-weight:bold;}#row_detail {width:560px;height:35px;line-height: 35px;float: left;}.booking_cleardiv { clear: both; }</style>'); 
					docprint.document.write('</head><body>');
					docprint.document.write(oTable.parentNode.innerHTML);
					docprint.document.write('</body></html>'); 
					docprint.document.close(); 
					docprint.print();
					docprint.close();
				}
                
            </script>
            
            
            <div class="booking_margin_t_20 booking_bg_f6f booking_border_1 booking_border_solid booking_border_ccc booking_padding_10">
                <div class="booking_float_right">
                    <div class="booking_float_left"><a href="?page=wp-booking-calendar-reservations&calendar_id=<?php echo $bookingReservationObj->getReservationCalendarId(); ?>" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("RESERVATION_CLOSE"); ?></a></div>
                    <div class="booking_float_left"><a onclick="printDiv('detail_page')" class="booking_float_left booking_margin_l_20 booking_mark_333 booking_pointer booking_font_bold"><?php echo $bookingLangObj->getLabel("RESERVATION_PRINT"); ?></a></div>
                </div>
                <div class="booking_cleardiv"></div>
            </div>

            
            
            <div>
            <div class="booking_bg_f6f booking_border_1 booking_border_solid booking_border_ccc booking_margin_t_20" id="detail_page">
            	<?php
				
				if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div class="booking_bg_fff booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p" id="title_row_detail"><?php echo $bookingLangObj->getLabel("RESERVATION_SURNAME_LABEL"); ?></div>
					<div class="booking_bg_fff booking_float_left booking_width_69p booking_height_30 booking_line_30" id="row_detail"><?php echo $bookingReservationObj->getReservationSurname(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				
				
				if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div class="booking_bg_f6f booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p" id="title_row_detail"><?php echo $bookingLangObj->getLabel("RESERVATION_NAME_LABEL"); ?></div>
					<div class="booking_bg_f6f booking_float_left booking_width_69p booking_height_30 booking_line_30" id="row_detail"><?php echo $bookingReservationObj->getReservationName(); ?></div>
					<div class="booking_cleardiv"></div>
                    <?php
				}
				
				
				if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div class="booking_bg_fff booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p" id="title_row_detail"><?php echo $bookingLangObj->getLabel("RESERVATION_EMAIL_LABEL"); ?></div>
					<div class="booking_bg_fff booking_float_left booking_width_69p booking_height_30 booking_line_30" id="row_detail"><a href="mailto:<?php echo $bookingReservationObj->getReservationEmail(); ?>"><?php echo $bookingReservationObj->getReservationEmail(); ?></a></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				
				
				if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div id="title_row_detail" class="booking_bg_f6f booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_PHONE_LABEL"); ?></div>
					<div id="row_detail" class="booking_bg_f6f booking_float_left booking_width_69p booking_height_30 booking_line_30"><?php echo $bookingReservationObj->getReservationPhone(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				
				
				if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div id="title_row_detail" class="booking_bg_fff booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_MESSAGE_LABEL"); ?></div>
					<div id="row_detail" class="booking_bg_fff booking_float_left booking_width_69p booking_height_30 booking_line_30"><?php echo $bookingReservationObj->getReservationMessage(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				
				
				if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div id="title_row_detail" class="booking_bg_f6f booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD1"); ?></div>
					<div id="row_detail" class="booking_bg_f6f booking_float_left booking_width_69p booking_height_30 booking_line_30"><?php echo $bookingReservationObj->getReservationField1(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				
				
				if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div id="title_row_detail" class="booking_bg_fff booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"> <?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD2"); ?></div>
					<div id="row_detail" class="booking_bg_fff booking_float_left booking_width_69p booking_height_30 booking_line_30"><?php echo $bookingReservationObj->getReservationField2(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				
				
				if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div id="title_row_detail" class="booking_bg_f6f booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD3"); ?></div>
					<div id="row_detail" class="booking_bg_f6f booking_float_left booking_width_69p booking_height_30 booking_line_30"><?php echo $bookingReservationObj->getReservationField3(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				
				
				if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) { 
					?>
					<div id="title_row_detail" class="booking_bg_fff booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD4"); ?></div>
					<div id="row_detail" class="booking_bg_fff booking_float_left booking_width_69p booking_height_30 booking_line_30"><?php echo $bookingReservationObj->getReservationField4(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
                
                
                <div id="title_row_detail" class="booking_bg_f6f booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_DATE_LABEL"); ?></div>
                
                <div id="row_detail" class="booking_bg_f6f booking_float_left booking_width_69p booking_height_30 booking_line_30">
                	<?php
					if($bookingSettingObj->getDateFormat() == "UK") {
						$dateToSend = strftime('%d/%m/%Y',strtotime($bookingSlotsObj->getSlotDate()));
					} else if($bookingSettingObj->getDateFormat() == "EU") {
						$dateToSend = strftime('%Y/%m/%d',strtotime($bookingSlotsObj->getSlotDate()));
					} else {
						$dateToSend = strftime('%m/%d/%Y',strtotime($bookingSlotsObj->getSlotDate()));
					}
					?>
					<?php echo $dateToSend; ?>
                </div>
                <div class="booking_cleardiv"></div>
                
                
                <div id="title_row_detail" class="booking_bg_fff booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_TIME_LABEL"); ?></div>
                <div id="row_detail"class="booking_bg_fff booking_float_left booking_width_69p booking_height_30 booking_line_30 ">
                	<?php
					if($bookingSettingObj->getTimeFormat() == "12") {
						$slotTimeFrom = date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeFrom(),0,5)));
						
					} else {
						$slotTimeFrom = substr($bookingSlotsObj->getSlotTimeFrom(),0,5);
						
					}
					if($bookingSettingObj->getTimeFormat() == "12") {
						$slotTimeTo = date('h:i a',strtotime(substr($bookingSlotsObj->getSlotTimeTo(),0,5)));
						
					} else {
						$slotTimeTo = substr($bookingSlotsObj->getSlotTimeTo(),0,5);
						
					}
					echo $slotTimeFrom." - ".$slotTimeTo;
					?>
					
                </div>
                <div class="booking_cleardiv"></div>
                
                
                <?php
				if($bookingSettingObj->getSlotsUnlimited() == 2) {
					?>
					<div id="title_row_detail" class="booking_bg_f6f booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_SEATS_LABEL"); ?></div>
					<div id="row_detail" class="booking_bg_f6f booking_float_left booking_width_69p booking_height_30 booking_line_30"><?php echo $bookingReservationObj->getReservationSeats(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
                
                 <?php
				if($bookingSlotsObj->getSlotPrice() >0) {
					?>
					<div id="title_row_detail" class="booking_bg_f6f booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_PRICE_LABEL"); ?></div>
					<div id="row_detail" class="booking_bg_f6f booking_float_left booking_width_69p booking_height_30 booking_line_30"><?php echo money_format('%!.2n',$bookingSlotsObj->getSlotPrice()); ?>&nbsp;<?php echo $bookingSettingObj->getPaypalCurrency(); ?></div>
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
                
                
                <div id="title_row_detail" class="booking_bg_fff booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p" ><?php echo $bookingLangObj->getLabel("RESERVATION_CONFIRMED_LABEL"); ?></div>
                <div id="row_detail" class="booking_bg_fff booking_float_left booking_width_69p booking_height_30 booking_line_30">
                    <?php 
					if($bookingReservationObj->getReservationConfirmed() == 1) {
						echo $bookingLangObj->getLabel("RESERVATION_CONFIRMED_YES");
					} else {
						echo $bookingLangObj->getLabel("RESERVATION_CONFIRMED_NO");
					}
					?>
                </div>
                
                
                <div class="booking_cleardiv"></div>
                <div id="title_row_detail" class="booking_bg_f6f booking_float_left booking_width_30p booking_height_30 booking_line_30 booking_padding_l_1p"><?php echo $bookingLangObj->getLabel("RESERVATION_CANCELLED"); ?></div>
                <div id="row_detail" class="booking_bg_f6f booking_float_left booking_width_69p booking_height_30 booking_line_30">
                    <?php 
					if($bookingReservationObj->getReservationCancelled() == 1) {
						echo $bookingLangObj->getLabel("RESERVATION_CONFIRMED_YES");
					} else {
						echo $bookingLangObj->getLabel("RESERVATION_CONFIRMED_NO");
					}
					?>
                </div>
                
                <div class="booking_cleardiv"></div>
                
                </div>
        	
        </div>
    </div>
</div>
