<?php
if(isset($_POST["lang_import"])) {
	
	$bookingLangObj->importLang();
	?>
    <script>
		alert("Successfull import");
		document.location.href="?page=wp-booking-calendar-texts";
	</script>
    <?php
}

?>


<div class="booking_margin_t_30 booking_font_18 booking_bg_fff">

<form name="addcalendar" action="" method="post" onsubmit="return checkData(this);" style="display:inline;" enctype="multipart/form-data">
    <input type="hidden" name="lang_import" value="1" />
    
    <!-- 
    =======================
    === Admin file ==
    =======================
    -->
    <div class="booking_font_bold booking_margin_t_20"><label for="admin_file">File lang.php for admin panel</label></div>
    <div class="booking_font_12">WARNING: admin panel structure has been changed a bit and some texts will have to be checked in "Texts Management" section after the import of this file</div>
   
    <div class="booking_font_12 booking_margin_t_10">
        <input type="file" name="admin_file" />
        
        <div class="booking_cleardiv"></div>
    
    </div>
    
    <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
    
     <!-- 
    =======================
    === Public file ==
    =======================
    -->
    <div class="booking_font_bold booking_margin_t_20"><label for="public_file">File lang.php for public calendar</label></div>
   
    <div class="booking_font_12 booking_margin_t_10">
        <input type="file" name="public_file" />
        
        <div class="booking_cleardiv"></div>
    
    </div>
    
    <div class="booking_margin_tb_20 booking_border_dotted booking_border_t_1 booking_border_666 booking_height_1"></div>
    
    
    <!-- bridge buttons -->
    <div class="booking_bg_333 booking_padding_10">
        <!-- cancel -->
        <div class="booking_float_left"><a href="javascript:document.location.href='?page=wp-booking-calendar-welcome';" class="booking_bg_ccc booking_admin_button booking_grey_button booking_mark_fff">CANCEL</a></div>
        <div class="booking_float_left booking_margin_l_20"><input type="submit" id="apply_button" value="IMPORT!" class="booking_bg_693 booking_admin_button booking_green_button booking_mark_fff"></div>
        <div id="loading" style="float:left;margin-top:30px;margin-left:10px"></div>
        <div class="booking_cleardiv"></div>
        
    </div>
    
    
    </form>
    
 </div>

        
      
