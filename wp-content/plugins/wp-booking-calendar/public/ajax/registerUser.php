<?php
include '../common.php';
if(isset($_POST["user_email"])) {
	$valid = 1;
	if($bookingSettingObj->getRecaptchaEnabled() == "1") {
		require_once('../include/recaptchalib.php');
		$privatekey = $bookingSettingObj->getRecaptchaPrivateKey();
		$resp = recaptcha_check_answer ($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_POST["recaptcha_challenge_field"],
									$_POST["recaptcha_response_field"]);
		
		if (!$resp->is_valid) {
			$valid = 0;
			// What happens when the CAPTCHA was entered incorrectly
			?>
			<script>
				window.parent.showCaptchaError();
				window.parent.$wbc('#booking_sfondo').remove();
			   window.parent.$wbc('#booking_modal_loading').fadeOut();
			</script>
			<?php
		} 
			
			
		
	}
	if($valid == 1) {
		$email_address = $_POST["user_email"];
		if( null == email_exists( $email_address ) ) {
	
		  // Generate the password and create the user
		  //$password = wp_generate_password( 12, false );
		  $password=$_POST["user_password"];
		  $user_id = wp_create_user( $_POST["user_login"], $password, $email_address );
		
		  // Set the nickname
		  wp_update_user(
			array(
			  'ID'          =>    $user_id,
			  'nickname'    =>    $_POST["user_login"]
			)
		  );
		
		  // Set the role
		  $user = new WP_User( $user_id );
		  $user->set_role( strtolower($bookingSettingObj->getUsersRole()) );
		
		  // Email the user
		  //wp_mail( $email_address, 'Welcome!', 'Your Password: ' . $password );
		  wp_set_auth_cookie( $user_id, false, is_ssl() );
		  ?>
			<script>
				window.parent.$wbc('#booking_sfondo').remove();
			  window.parent.$wbc('#booking_modal_loading').fadeOut();
			   window.parent.alert("<?php echo $bookingLangObj->getLabel("REGISTERUSER_USER_REGISTERED_ALERT"); ?>");
			   window.parent.$wbc('#login-register-password-container').removeAttr('style');
			  window.parent.$wbc('#login-register-password-container').css('display','none !important');
			  window.parent.$wbc('#reservation_email').val('<?php echo $email_address; ?>');
			  window.parent.$wbc('#wordpress_user_id').val('<?php echo $user_id; ?>');
			  window.parent.$wbc('#form_container_all').removeAttr('style');
			  window.parent.$wbc('#form_container_all').css('display','block !important');
			  
			</script>
			<?php
		
		} else {
			?>
			<script>
			   window.parent.$wbc('#booking_sfondo').remove();
			   window.parent.$wbc('#booking_modal_loading').fadeOut();
			   window.parent.alert("<?php echo $bookingLangObj->getLabel("REGISTERUSER_USER_EXISTING_ALERT"); ?>");
			   window.parent.$wbc('#reg_button').removeAttr("disabled");
			   
			</script>
			<?php
		}
	}
	
	

}
?>
	
	