<?php
include 'common.php';
/*if(!isset($_SESSION["admin_id"]) || $_SESSION["admin_id"] == 20000) {
	header('Location: login.php');
}*/
if(isset($_GET["upload"]) && $_GET["upload"] == 1) {
	include 'lang_import.php';
} else if(isset($_GET["upload"]) && $_GET["upload"] == 0) {
	update_option('wbc_show_text_update_admin','0');
	update_option('wbc_show_text_update_public','0');
	?>
    <script>
        document.location.href="<?php echo $_SERVER['HTTP_REFERER']; ?>";
    </script>
    <?php
	
} else {
	if(isset($_POST["text_label"])) {	
		$bookingLangObj->updateTexts();
		//header('Location: welcome.php');	
		?>
		<script>
			document.location.href="";
		</script>
		<?php
	
	}
	
	
	?>
	
	<!-- 
	=======================
	=== js ==
	=======================
	-->
	<script language="javascript" type="text/javascript">
		var $wbc = jQuery;
		function showTexts(num) {
			if($wbc('#texts_'+num).css("display") == "none") {
				$wbc('#texts_'+num).fadeIn();
			} else {
				$wbc('#texts_'+num).fadeOut();
			}
		}
		
		
		function showLoader() {
			$wbc('body').prepend('<div id="sfondo" class="booking_modal_sfondo"><div id="modal_loading" class="booking_modal_loading"><img src="<?php echo plugins_url('wp-booking-calendar/admin/');?>images/loading.png" border=0 /></div></div>');
			return true;
		}
		
		function hideLoader() {
			$wbc('#sfondo').remove();
		}
	</script>
	
	<!-- 
	=======================
	=== main content ==
	=======================
	-->
	
	<div class="booking_padding_20 booking_font_18 booking_line_percent booking_bg_fff">
			
			<!-- 
			=======================
			=== form ==
			=======================
			-->
			
					
					
				  
					
			<!-- 
			=======================
			=== Events calendar ==
			=======================
			-->
		   
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(1);">Booking Calendar</div>
			
			<div id="texts_1" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">   
				<?php
				$arrayTexts = $bookingListObj->getTextsList(1);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff" ></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(2);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_SETTINGS"); ?></div>
			<div id="texts_2" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">   
				<?php
				$arrayTexts = $bookingListObj->getTextsList(2);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(3);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_BG_AND_COLORS"); ?></div>
			<div id="texts_3" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(3);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(4);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_MANAGE_CATEGORIES"); ?></div>
			<div id="texts_4" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(4);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(5);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_MANAGE_CALENDARS"); ?></div>
			<div id="texts_5" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(5);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff" ></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(6);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_RESERVATIONS"); ?></div>
			<div id="texts_6" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(6);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?><!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(7);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_MANAGE_MAIL"); ?></div>
			<div id="texts_7" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(7);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(8);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_FORM_MANAGEMENT"); ?></div>
			<div id="texts_8" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(8);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(9);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_TEXT_MANAGEMENT"); ?></div>
			<div id="texts_9" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(9);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(12);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_USER_RESERVATIONS"); ?></div>
			<div id="texts_12" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(12);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(13);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_CONTACT_ADMINISTRATOR"); ?></div>
			<div id="texts_13" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(13);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(10);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_ADMIN_LEFT_MENU"); ?></div>
			<div id="texts_10" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(10);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff" ></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			<div class="booking_font_bold booking_pointer" onclick="javascript:showTexts(11);"><?php echo $bookingLangObj->getLabel("LEFT_MENU_PUBLIC_SECTION"); ?></div>
			<div id="texts_11" style="display:none !important">
				<form name="edittexts" action="<?php echo plugins_url('wp-booking-calendar/admin/');?>ajax/saveTexts.php" method="post" tmt:validate="true" enctype="multipart/form-data" onsubmit="return showLoader();" target="iframe_submit">  
				<?php
				$arrayTexts = $bookingListObj->getTextsList(11);
				foreach($arrayTexts as $textId => $text) {
					?>
					<div class="booking_float_left booking_margin_t_24 booking_font_12 booking_width_50p"><?php echo $text["text_label"]; ?>:</div>
					<div class="booking_float_left booking_margin_t_20 booking_margin_l_10 booking_font_12 booking_width_40p">
						<input type="hidden" name="text_label[]" value="<?php echo $text["text_label"]; ?>" />
						<textarea name="text_value[]" class="booking_width_100p"><?php echo $text["text_value"]; ?></textarea>
					</div>
					
					<div class="booking_cleardiv"></div>
					<?php
				}
				?>
				<!-- 
				=======================
				=== control buttons ==
				=======================
				-->
				<div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
					<!-- cancel -->                    
					<div class="booking_float_right"><input type="submit" id="apply_button" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("TEXTS_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
					<div class="booking_cleardiv"></div>
					
				</div>
				</form>
			</div>
			<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
			
			
		   
			 
			
	
	</div>
	<iframe style="border:none;width:0px;height:0px" id="iframe_submit" name="iframe_submit"></iframe>
	<?php
}
?>
