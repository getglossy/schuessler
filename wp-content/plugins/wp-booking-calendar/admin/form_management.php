<?php
include 'common.php';

if(isset($_POST["mandatory_fields"])) {	
	$bookingSettingObj->updateFormSettings();
	//header('Location: welcome.php');	
}


?>

<!-- 
=======================
=== js ==
=======================
-->
<script language="javascript" type="text/javascript">
	var $wbc = jQuery;
	$wbc(function() {
		showHideMandatory();
	});
	function showHideMandatory() {
		var data = '';
		$wbc('.field_types').fadeOut(0);
		$wbc('#visible_fields option:not(:selected)').each(function() {
			
			$wbc('#mandatory_fields option[value="'+$wbc(this).val()+'"]').fadeOut(0);
			$wbc('#mandatory_fields option[value="'+$wbc(this).val()+'"]').removeAttr("selected");
			
			
		}); 
		$wbc('#visible_fields option:selected').each(function() {
			$wbc('#mandatory_fields option[value="'+$wbc(this).val()+'"]').fadeIn(0);
			$wbc('#field_type_'+$wbc(this).val()).fadeIn(0);
		});
		
		
	}
</script>

 <!-- 
=======================
=== main content ==
=======================
-->

<div class="booking_padding_20 booking_font_14 booking_line_percent booking_bg_fff">      
        
        <!-- 
        =======================
        === form ==
        =======================
        -->
        <div class="booking_margin_t_20">
        	<form name="editsettings" action="" method="post" tmt:validate="true" enctype="multipart/form-data" style="display:inline;">           
                
                <!-- 
                =======================
                === visible fields ==
                =======================
                -->
                <div class="booking_font_bold"><label for="visible_fields"><?php echo $bookingLangObj->getLabel("FORM_VISIBLE_FIELDS_LABEL"); ?></label></div>
                <div class="booking_font_12 booking_margin_t_10"><?php echo $bookingLangObj->getLabel("FORM_VISIBLE_FIELDS_SUBLABEL"); ?></div>
                
                <div class="booking_margin_t_10">
                    <select name="visible_fields[]" id="visible_fields" multiple="multiple" class="booking_width_400 booking_height_200" onchange="javascript:showHideMandatory();">
                    	<option value="reservation_name" <?php if(in_array("reservation_name",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_NAME_LABEL"); ?></option>
                        <option value="reservation_surname" <?php if(in_array("reservation_surname",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_SURNAME_LABEL"); ?></option>
                        <option value="reservation_email" <?php if(in_array("reservation_email",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_EMAIL_LABEL"); ?></option>
                        <option value="reservation_phone" <?php if(in_array("reservation_phone",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_PHONE_LABEL"); ?></option>
                        <option value="reservation_message" <?php if(in_array("reservation_message",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_MESSAGE_LABEL"); ?></option>
                        <option value="reservation_field1" <?php if(in_array("reservation_field1",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD1"); ?> </option>
                        <option value="reservation_field2" <?php if(in_array("reservation_field2",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD2"); ?></option>
                         <option value="reservation_field3" <?php if(in_array("reservation_field3",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD3"); ?></option>
                         <option value="reservation_field4" <?php if(in_array("reservation_field4",$bookingSettingObj->getVisibleFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD4"); ?></option>
                    </select>
                </div>
                
                <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
                
                <!-- 
                =======================
                === mandatory fields ==
                =======================
                -->
                <div class="booking_font_bold"><label for="mandatory_fields"><?php echo $bookingLangObj->getLabel("FORM_MANDATORY_FIELDS_LABEL"); ?></label></div>
                <div class="booking_font_12 booking_margin_t_10"><?php echo $bookingLangObj->getLabel("FORM_MANDATORY_FIELDS_SUBLABEL"); ?></div>
                <div class="booking_margin_t_10">
                    <select name="mandatory_fields[]" id="mandatory_fields" multiple="multiple" class="booking_width_400 booking_height_200">
                    	<option value="reservation_name" <?php if(in_array("reservation_name",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_NAME_LABEL"); ?></option>
                        <option value="reservation_surname" <?php if(in_array("reservation_surname",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_SURNAME_LABEL"); ?></option>
                        <option value="reservation_email" <?php if(in_array("reservation_email",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_EMAIL_LABEL"); ?></option>
                        <option value="reservation_phone" <?php if(in_array("reservation_phone",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_PHONE_LABEL"); ?></option>
                        <option value="reservation_message" <?php if(in_array("reservation_message",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_MESSAGE_LABEL"); ?></option>
                        <option value="reservation_field1" <?php if(in_array("reservation_field1",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD1"); ?></option>
                        <option value="reservation_field2" <?php if(in_array("reservation_field2",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD2"); ?><option> 
						<option value="reservation_field3" <?php if(in_array("reservation_field3",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD3"); ?></option>
                        <option value="reservation_field4" <?php if(in_array("reservation_field4",$bookingSettingObj->getMandatoryFields())) { echo 'selected'; }?>><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD4"); ?></option>
                    </select>
                </div>
                
                <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
                
                <!-- 
                =======================
                === fields type ==
                =======================
                -->
                
                <div class="booking_font_bold"><label for="field_type"><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_LABEL"); ?></label></div>
                <div class="booking_font_12 booking_margin_t_10"><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_SUBLABEL"); ?></div>
                <div class="booking_margin_t_20">
                	<div id="field_type_reservation_name" class="field_types">
                        <!-- name -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_NAME_LABEL"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                            <input type="hidden" name="reservation_field_name[]" value="reservation_name" />
                            <select name="field_type[]">
                                <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_name')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_name')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                            </select>
                        </div>
                        <div class="booking_cleardiv"></div>
                    </div>
                    
                    <div id="field_type_reservation_surname" class="field_types">
                    	<!-- surname -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_SURNAME_LABEL"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                            <input type="hidden" name="reservation_field_name[]" value="reservation_surname" />
                            <select name="field_type[]">
                                <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_surname')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_surname')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                            </select>
                        </div>
                        <div class="booking_cleardiv"></div>
                    </div>
                                    
                    <div id="field_type_reservation_email" class="field_types">                 
                        <!-- email -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_EMAIL_LABEL"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                            <input type="hidden" name="reservation_field_name[]" value="reservation_email" />
                            <select name="field_type[]">
                                <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_email')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_email')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                            </select>
                        </div>
                        <div class="booking_cleardiv"></div>
                    </div>
                    
                    <div id="field_type_reservation_phone" class="field_types">
                        <!-- phone -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_PHONE_LABEL"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                            <input type="hidden" name="reservation_field_name[]" value="reservation_phone" />
                            <select name="field_type[]">
                                <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_phone')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_phone')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                            </select>
                        </div>
                        <div class="booking_cleardiv"></div>
                    </div>
                    
                    
                    <div id="field_type_reservation_message" class="field_types">
                        <!-- message -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_MESSAGE_LABEL"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                                <input type="hidden" name="reservation_field_name[]" value="reservation_message" />
                                <select name="field_type[]">
                                    <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_message')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                    <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_message')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                                </select>
                        </div>
                        <div class="booking_cleardiv"></div>
                    </div>
                    
                    <div id="field_type_reservation_field1" class="field_types">
                        <!-- additional 1 -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD1"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                            <input type="hidden" name="reservation_field_name[]" value="reservation_field1" />
                            <select name="field_type[]">
                                <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_field1')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_field1')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                            </select>
                        </div>
                        <div class="booking_cleardiv"></div>
                    </div>
                    
                    <div id="field_type_reservation_field2" class="field_types">
                        <!-- additional 2 -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD2"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                                <input type="hidden" name="reservation_field_name[]" value="reservation_field2" />
                                <select name="field_type[]">
                                    <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_field2')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                    <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_field2')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                                </select>
                        </div>
                        <div class="booking_cleardiv"></div>
                    </div>
                    
                    <div id="field_type_reservation_field3" class="field_types">
                        <!-- additional 3 -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD3"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                            <input type="hidden" name="reservation_field_name[]" value="reservation_field3" />
                            <select name="field_type[]">
                                <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_field3')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_field3')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                            </select>
                        </div>
                        <div class="booking_cleardiv"></div>
                    </div>
                    
                    <div id="field_type_reservation_field4" class="field_types">
                        <!-- additional 4 -->
                        <div class="booking_float_left booking_width_20p booking_height_30 booking_line_30"><?php echo $bookingLangObj->getLabel("RESERVATION_ADDITIONAL_FIELD4"); ?>:</div>
                        <div class="booking_float_left booking_margin_l_10">
                            <input type="hidden" name="reservation_field_name[]" value="reservation_field4" />
                            <select name="field_type[]">
                                <option value="text" <?php if($bookingSettingObj->getReservationFieldType('reservation_field4')== 'text') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_TEXT"); ?></option>
                                <option value="textarea" <?php if($bookingSettingObj->getReservationFieldType('reservation_field4')== 'textarea') { echo 'selected'; } ?>><?php echo $bookingLangObj->getLabel("FORM_FIELDS_TYPE_AREA"); ?></option>
                            </select>
                        </div>
                        <div class="booking_cleardiv"></div>       
                    </div>
                </div>
                
                <div class="booking_cleardiv"></div>
                
                
                <!-- 
                =======================
                === control buttons ==
                =======================
                -->
                <div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
                    <!-- cancel -->
                    <div class="booking_float_left"><a href="javascript:document.location.href='?page=wp-booking-calendar-welcome';" class="booking_bg_ccc booking_admin_button booking_grey_button booking_mark_fff"><?php echo $bookingLangObj->getLabel("FORM_CANCEL"); ?></a></div>
                    <div class="booking_float_left booking_margin_l_20"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("FORM_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
                    <div class="booking_cleardiv"></div>
                    
                </div>
                    
            
            </form>
         </div>
        
        
</div>
