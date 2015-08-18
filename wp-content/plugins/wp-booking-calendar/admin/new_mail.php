<?php
include 'common.php';


$mail_id=$_GET["mail_id"];

$bookingMailObj->setMail($mail_id);
if(isset($_POST["mail_text"])) {	
	$bookingMailObj->updateMail();	
}
$bookingMailObj->setMail($mail_id);
?>
<script type="text/javascript" src="<?php echo plugins_url('wp-booking-calendar/admin/js/tiny_mce/tiny_mce.js');?>"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "exact",
		elements : "mail_text, mail_signature, mail_cancel_text",
		theme : "advanced",
		plugins:"paste",
		theme_advanced_buttons1 : "pastetext,|,bold,italic,underline,strikethrough,|,bullist,numlist,|,indent,outdent,|,undo,redo,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,charmap",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 :"",
		theme_advanced_disable : "image,anchor,cleanup,help,code,hr,removeformat,sub,sup",
		paste_text_use_dialog : true,
		relative_urls : false,
		remove_script_host : false

	});
	
	function checkData(frm) {
		with(frm) {
			if(mail_subject.value=='') {
				alert("<?php echo $bookingLangObj->getLabel("MAIL_SUBJECT_ALERT"); ?>");
				return false;
			} else if(mail_text.value=='') {
				alert("<?php echo $bookingLangObj->getLabel("MAIL_TEXT_ALERT"); ?>");
				return false;
			} else {
				return true;
			}
		}
	}
</script>

<div class="booking_padding_20 booking_font_14 booking_line_percent booking_bg_fff">
        

      <div class="booking_font_bold"><?php echo $bookingMailObj->getMailName(); ?></div>
     
      <form name="editsettings" action="" method="post" onsubmit="return checkData(this);" tmt:validate="true" style="display:inline;">           
      		
            <!-- email subject -->
            <div class="booking_font_bold booking_margin_t_20"><label for="mail_subject"><?php echo $bookingLangObj->getLabel("MAIL_SUBJECT_LABEL"); ?></label></div>
          
            <div class="booking_margin_t_10"><input type="text" class="booking_width_100p" id="mail_subject" name="mail_subject" value="<?php echo $bookingMailObj->getMailSubject(); ?>" tmt:required="true" tmt:message="<?php echo $bookingLangObj->getLabel("MAIL_SUBJECT_ALERT"); ?>"></div>
          
            <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
      		
            
            <!-- email text -->
            <div class="booking_font_bold"><label for="mail_text"><?php echo $bookingLangObj->getLabel("MAIL_TEXT_LABEL"); ?></label></div>
            <div class="booking_font_12 booking_margin_t_10">
				<?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL1"); ?><br />
                <strong><?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL2"); ?></strong>:<?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL3"); ?><br />
                <strong><?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL4"); ?></strong>:<?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL5"); ?><br />
                <?php
                if($mail_id==2) {
					?>
                    <strong><?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL6"); ?></strong>:<?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL7"); ?><br />
                    <strong><?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL8"); ?></strong>:<?php echo $bookingLangObj->getLabel("MAIL_TEXT_SUBLABEL9"); ?>
                    <?php
                   
                }
                ?>
            </div>
      		<div class="booking_margin_t_10"><textarea class="booking_width_100p booking_height_150 booking_bg_f6f" id="mail_text" name="mail_text"><?php echo $bookingMailObj->getMailText(); ?></textarea></div>
      
      		<div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
      
      
      		<!-- email text -->
			<?php
            if($bookingMailObj->getMailId() == 1 || $bookingMailObj->getMailId() == 4) {
            ?>
            
            <div class="booking_font_bold"><label for="mail_text"><?php echo $bookingLangObj->getLabel("MAIL_CANCEL_TEXT_LABEL"); ?></label> <?php echo $bookingLangObj->getLabel("MAIL_CANCEL_TEXT_SUBLABEL1"); ?> <?php if($bookingSettingObj->getReservationCancel() == "1") { echo "<span style='color:#669900'>".$bookingLangObj->getLabel("MAIL_ENABLED")."</span>"; } else { echo "<span style='color:#990000'>".$bookingLangObj->getLabel("MAIL_DISABLED")."</span>"; }?></div>
            <div class="booking_font_12 booking_margin_t_10" style="padding: 10px 0; font-size: 13px;">
				<?php echo $bookingLangObj->getLabel("MAIL_CANCEL_TEXT_SUBLABEL2"); ?><br />
                <strong><?php echo $bookingLangObj->getLabel("MAIL_CANCEL_TEXT_SUBLABEL3"); ?></strong>:<?php echo $bookingLangObj->getLabel("MAIL_CANCEL_TEXT_SUBLABEL4"); ?><br />
                <strong><?php echo $bookingLangObj->getLabel("MAIL_CANCEL_TEXT_SUBLABEL5"); ?></strong>:<?php echo $bookingLangObj->getLabel("MAIL_CANCEL_TEXT_SUBLABEL6"); ?><br />
            </div>
            <div class="booking_margin_t_10"><textarea class="booking_width_100p booking_height_150 booking_bg_f6f" id="mail_cancel_text" name="mail_cancel_text"><?php echo $bookingMailObj->getMailCancelText(); ?></textarea></div>
            
            <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
            
            
            
			<?php
            } 
            ?>
            
            <!-- email signature -->
      		<div class="booking_font_bold"><label for="mail_signature"><?php echo $bookingLangObj->getLabel("MAIL_SIGNATURE_LABEL"); ?></label></div>
      		<div class="booking_margin_t_10"><textarea class="booking_width_100p booking_bg_f6f" id="mail_signature" name="mail_signature"><?php echo $bookingMailObj->getMailSignature(); ?></textarea></div>
    
      
            <!-- 
            =======================
            === control buttons ==
            =======================
            -->
            <div class="booking_bg_333 booking_padding_10 booking_margin_t_20">
                <!-- cancel -->
                <div class="booking_float_left"><a href="javascript:document.location.href='?page=wp-booking-calendar-mails';" class="booking_bg_ccc booking_admin_button booking_grey_button booking_mark_fff"><?php echo $bookingLangObj->getLabel("MAIL_CANCEL"); ?></a></div>
                <div class="booking_float_left booking_margin_l_20"><input type="submit" name="saveunpublish" value="<?php echo $bookingLangObj->getLabel("MAIL_SAVE"); ?>" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
                <div class="booking_cleardiv"></div>
                
            </div>
            
            
         </form>
          
        
        
</div>
