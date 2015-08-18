<?php

class wp_booking_calendar_lang {
	
	private function doLanguageQuery($label) {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$languageQry = $wpdb->get_var($wpdb->prepare("SELECT text_value FROM ".$wpdb->base_prefix.$blog_prefix."booking_texts WHERE text_label=%s",$label));
		return $languageQry;
		//return stripslashes(mysql_result($languageQry,0,'text_value'));
	}
	
	public function getLabel($label) {
		global $wpdb;
		return wp_booking_calendar_lang::doLanguageQuery($label);
	}
	
	public function updateTexts() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayLabels=$_POST["text_label"];
		$arrayTexts=$_POST["text_value"];
		for($i=0;$i<count($arrayLabels);$i++) {
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts
						 SET text_value=%s
						 WHERE text_label=%s",$arrayTexts[$i],$arrayLabels[$i]));
		}
	
	}
	
	public function saveTexts() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		$arrayLabels=$_POST["text_label"];
		$arrayTexts=$_POST["text_value"];
		for($i=0;$i<count($arrayLabels);$i++) {
			$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts
						 SET text_value=%s
						 WHERE text_label=%s",$arrayTexts[$i],$arrayLabels[$i]));
		}
	
	}
	
	public function importLang() {
		global $wpdb;
		global $blog_id;
		$blog_prefix=$blog_id."_";
		if($blog_id==1) {
			$blog_prefix="";
		}
		
		$upload_dir = wp_upload_dir();
		if(isset($_FILES["admin_file"]["tmp_name"]) && $_FILES["admin_file"]["tmp_name"] != '') {
			if(move_uploaded_file($_FILES["admin_file"]["tmp_name"], $upload_dir['basedir'] . "/".str_replace(" ","",$_FILES["admin_file"]["name"]))) {
				//include the file
				$arrlang = Array();
				include $upload_dir['basedir'] . "/".str_replace(" ","",$_FILES["admin_file"]["name"]);
				$arrlang = $lang;
				foreach($arrlang as $key => $val) {
					$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts SET text_value = %s WHERE text_label = %s",$val,$key)); 
				}
				update_option('wbc_show_text_update_admin','0');
				//delete file
				unlink($upload_dir['basedir'] . "/".str_replace(" ","",$_FILES["admin_file"]["name"]));
			}
			
		}
		if(isset($_FILES["public_file"]["tmp_name"]) && $_FILES["public_file"]["tmp_name"] != '') {
			if(move_uploaded_file($_FILES["public_file"]["tmp_name"], $upload_dir['basedir'] . "/".str_replace(" ","",$_FILES["public_file"]["name"]))) {
				//include the file
				$arrlang = Array();
				include $upload_dir['basedir'] . "/".str_replace(" ","",$_FILES["public_file"]["name"]);
				$arrlang = $lang;
				foreach($arrlang as $key => $val) {
					$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->base_prefix.$blog_prefix."booking_texts SET text_value = %s WHERE text_label = %s"),$val,$key); 
				}
				update_option('wbc_show_text_update_public','0');
				//delete file
				unlink($upload_dir['basedir'] . "/".str_replace(" ","",$_FILES["public_file"]["name"]));
			}
			
		}
	}
	

}

?>
