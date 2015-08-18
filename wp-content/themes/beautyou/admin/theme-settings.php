<?php
// Prepare arrays
if (is_themerex_options_used()) {
	$fonts 			= getThemeFontsList();
	$fonts_styles   = getThemeFontsStylesList();
	$themes 		= getThemesList();
	$socials 		= getIconsList();
	$icons 			= getIconsList();
	$posts_types 	= getPostsTypesList();
	$categories 	= getCategoriesList();
	$menus	 		= getMenusList(true);
	$sidebars 		= getSidebarsList();
	$positions 		= getSidebarsPositions();
	$skins			= getSkinsList();
	$headers		= getHeaderStylesList();
	$body_styles	= getBodyStylesList();
	$blog_styles	= getBlogStylesList();
	$single_styles	= getSingleStylesList();
	$sliders 		= getSlidersList();
	$popups 		= getPopupEnginesList();
	$gmap_styles 	= getGooglemapStylesList();
	$dir 			= getDirectionList();
	$yes_no 		= getYesNoList();
	$on_off 		= getOnOffList();
	$show_hide 		= getShowHideList();
	$sorting 		= getSortingList();
	$ordering 		= getOrderingList();
	$locations 		= getDedicatedLocationsList();
	$portfolio_image_style  = getImagesStylesList();
} else {
	$headers = $skins = $fonts = $fonts_styles = $themes = $socials = $icons = $categories = $posts_types = $menus = $sidebars = $positions = $body_styles = $blog_styles = $single_styles = $sliders = $popups = $gmap_styles = $dir = $yes_no = $on_off = $show_hide = $sorting = $ordering = $locations = $portfolio_image_style = array();
}
// Theme options arrays
$THEMEREX_options = array();
$THEMEREX_options_hash = array();



//###############################
//#### Customization         #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Customization', 'themerex'),
			"id" => "partition_customization",
			"start" => "partitions",
			"override" => "category,page,post",
			"icon" => "iconadmin-cog-alt",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('General', 'themerex'),
			"id" => 'customization_general',
			"override" => "category,page,post",
			"icon" => 'iconadmin-cog',
			"start" => "customization_tabs",
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Theme customization general parameters', 'themerex'),
			"desc" => __('Select main theme skin, customize colors and enable responsive layouts for the small screens', 'themerex'),
			"override" => "category,page,post",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Select theme skin', 'themerex'),
			"desc" => __('Select skin for the theme decoration', 'themerex'),
			"id" => "theme_skin",
			"divider" => false,
			"override" => "category,post,page",
			"std" => "general",
			"options" => $skins,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Theme color',  'themerex'),
			"desc" => __('Select main theme color. It already used as Accent color in the classes: "theme_accent", "theme_accent_bg" and "theme_accent_bgc"', 'themerex'),
			"id" => "theme_color",
			"override" => "category,post,page",
			"std" => "",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Theme Accent color (1)',  'themerex'),
			"desc" => __('Select accent theme color. It already used as Accent color in the classes: "theme_accent_1", "theme_accent_1_bg" and "theme_accent_1_bgc"', 'themerex'),
			"id" => "theme_color_1",
			"override" => "category,post,page",
			"std" => "",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Theme Accent color (2)',  'themerex'),
			"desc" => __('Select accent theme color. It already used as Accent color in the classes: "theme_accent_2", "theme_accent_2_bg" and "theme_accent_2_bgc"', 'themerex'),
			"id" => "theme_color_2",
			"override" => "category,post,page",
			"std" => "",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Theme Accent color (3)',  'themerex'),
			"desc" => __('Select accent theme color. It already used as Accent color in the classes: "theme_accent_3", "theme_accent_3_bg" and "theme_accent_3_bgc"', 'themerex'),
			"id" => "theme_color_3",
			"override" => "category,post,page",
			"std" => "",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Show Theme customizer', 'themerex'),
			"desc" => __('Do you want to show theme customizer in the right panel? Your website visitors will be able to customise it yourself.', 'themerex'),
			"id" => "show_theme_customizer",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Extended CSS animations', 'themerex'),
		"desc" => __('Do you want use extended animations effects on your site?', 'themerex'),
		"id" => "css_animation",
		"std" => "yes",
		"options" => $yes_no,
		"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Remember visitor\'s settings', 'themerex'),
			"desc" => __('To remember the settings that were made by the visitor, when navigating to other pages or to limit their effect only within the current page', 'themerex'),
			"id" => "remember_visitors_settings",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Responsive Layouts', 'themerex'),
			"desc" => __('Do you want use responsive layouts on small screen or still use main layout?', 'themerex'),
			"id" => "responsive_layouts",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Favicon', 'themerex'),
			"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>', 'themerex'),
			"id" => "favicon",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Additional CSS and HTML/JS code', 'themerex'),
			"desc" => __('Put here your custom CSS and JS code', 'themerex'),
			"override" => "category,page,post",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Your CSS code',  'themerex'),
			"desc" => __('Put here your css code to correct main theme styles',  'themerex'),
			"id" => "custom_css",
			"override" => "category,post,page",
			"divider" => false,
			"cols" => 80,
			"rows" => 20,
			"std" => "",
			"type" => "textarea");

$THEMEREX_options[] = array( "title" => __('Your HTML/JS code',  'themerex'),
			"desc" => __('Put here your invisible html/js code: Google analitics, counters, etc',  'themerex'),
			"id" => "custom_code",
			"override" => "category,post,page",
			"cols" => 80,
			"rows" => 20,
			"std" => "",
			"type" => "textarea");

$THEMEREX_options[] = array( "title" => __('Body style', 'themerex'),
			"id" => 'customization_body',
			"override" => "category,post,page",
			"icon" => 'iconadmin-picture-1',
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Body parameters', 'themerex'),
			"desc" => __('Background color, pattern and image used only for fixed body style.', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");
			
$THEMEREX_options[] = array( "title" => __('Body style', 'themerex'),
			"desc" => __('Select body style:<br><b>boxed</b> - if you want use background color and/or image,<br><b>wide</b> - page fill whole window with centered content,<br><b>fullwide</b> - page content stretched on the full width of the window (with few left and right paddings),<br><b>fullscreen</b> - page content fill whole window without any paddings', 'themerex'),
			"id" => "body_style",
			"divider" => false,
			"override" => "category,post,page",
			"std" => "wide",
			"options" => $body_styles,
			"dir" => "horizontal",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Load background image', 'themerex'),
			"desc" => __('Always load background images or only for boxed body style', 'themerex'),
			"id" => "load_bg_image",
			"override" => "category,post,page",
			"std" => "boxed",
			"size" => "medium",
			"options" => array(
				'boxed' => __('Boxed', 'themerex'),
				'always' => __('Always', 'themerex')
			),
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Transparency content area', 'themerex'),
	"desc" => __('Make the area of the content transparent if you have set a picture or a pattern as a background?', 'themerex'),
	"id" => "transparent_bg_image",
	"override" => "category,post,page",
	"std" => "no",
	"size" => "medium",
	"options" => array(
		'no' => __('No', 'themerex'),
		'yes' => __('Yes', 'themerex')
	),
	"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Background color',  'themerex'),
			"desc" => __('Body background color',  'themerex'),
			"id" => "bg_color",
			"override" => "category,post,page",
			"std" => "#bfbfbf",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Background predefined pattern',  'themerex'),
			"desc" => __('Select theme background pattern (first case - without pattern)',  'themerex'),
			"id" => "bg_pattern",
			"override" => "category,post,page",
			"std" => "",
			"options" => array(
				0 => themerex_get_file_url('/images/spacer.png'),
				1 => themerex_get_file_url('/images/bg/pattern_1.png'),
				2 => themerex_get_file_url('/images/bg/pattern_2.png'),
				3 => themerex_get_file_url('/images/bg/pattern_3.png')
			),
			"style" => "list",
			"type" => "images");

$THEMEREX_options[] = array( "title" => __('Background custom pattern',  'themerex'),
			"desc" => __('Select or upload background custom pattern. If selected - use it instead the theme predefined pattern (selected in the field above)',  'themerex'),
			"id" => "bg_custom_pattern",
			"override" => "category,post,page",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Background predefined image',  'themerex'),
			"desc" => __('Select theme background image (first case - without image)',  'themerex'),
			"id" => "bg_image",
			"override" => "category,post,page",
			"std" => "",
			"options" => array(
				0 => themerex_get_file_url('/images/spacer.png'),
				1 => themerex_get_file_url('/images/bg/image_1_thumb.jpg'),
				2 => themerex_get_file_url('/images/bg/image_2_thumb.jpg'),
				3 => themerex_get_file_url('/images/bg/image_3_thumb.jpg'),
				4 => themerex_get_file_url('/images/bg/image_4_thumb.jpg'),
				5 => themerex_get_file_url('/images/bg/image_5_thumb.jpg'),
				6 => themerex_get_file_url('/images/bg/image_6_thumb.jpg')
			),
			"style" => "list",
			"type" => "images");

$THEMEREX_options[] = array( "title" => __('Background custom image',  'themerex'),
			"desc" => __('Select or upload background custom image. If selected - use it instead the theme predefined image (selected in the field above)',  'themerex'),
			"id" => "bg_custom_image",
			"override" => "category,post,page",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Background custom image position',  'themerex'),
			"desc" => __('Select custom image position',  'themerex'),
			"id" => "bg_custom_image_position",
			"override" => "category,post,page",
			"std" => "left_top",
			"options" => array(
				'left_top' => "Left Top",
				'center_top' => "Center Top",
				'right_top' => "Right Top",
				'left_center' => "Left Center",
				'center_center' => "Center Center",
				'right_center' => "Right Center",
				'left_bottom' => "Left Bottom",
				'center_bottom' => "Center Bottom",
				'right_bottom' => "Right Bottom",
			),
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Show video background',  'themerex'),
			"desc" => __("Show video on the site background (only for Fullscreen body style)", 'themerex'),
			"id" => "show_video_bg",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Youtube code for video bg',  'themerex'),
			"desc" => __("Youtube code of video", 'themerex'),
			"id" => "video_bg_youtube_code",
			"override" => "category,post,page",
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Local video for video bg',  'themerex'),
			"desc" => __("URL to video-file (uploaded on your site)", 'themerex'),
			"id" => "video_bg_url",
			"readonly" =>false,
			"override" => "category,post,page",
			"before" => array(	'title' => __('Choose video', 'themerex'),
								'action' => 'media_upload',
								'multiple' => false,
								'linked_field' => '',
								'type' => 'video',
								'captions' => array('choose' => __( 'Choose Video', 'themerex'),
													'update' => __( 'Select Video', 'themerex')
												)
						),
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Use overlay for video bg', 'themerex'),
			"desc" => __('Use overlay texture for the video background', 'themerex'),
			"id" => "video_bg_overlay",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Logo', 'themerex'),
			"id" => 'customization_logo',
			"override" => "category,post,page",
			"icon" => 'iconadmin-heart-1',
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Main logo', 'themerex'),
			"desc" => __('Select or upload logos for the site\'s header and select it position', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Logo image (main)', 'themerex'),
			"desc" => __('Main logo image for the header', 'themerex'),
			"id" => "logo_image",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Logo image (fixed)', 'themerex'),
			"desc" => __('Logo image for the header (if menu is fixed after the page is scrolled)', 'themerex'),
			"id" => "logo_fixed",
			"override" => "category,post,page",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Logo image (side)', 'themerex'),
			"desc" => __('Logo image for the side menu', 'themerex'),
			"id" => "logo_side",
			"override" => "category,post,page",
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Logo text', 'themerex'),
			"desc" => __('Logo text - display it before logo image', 'themerex'),
			"id" => "logo_text",
			"override" => "category,post,page",
			"std" => '',
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Logo height', 'themerex'),
			"desc" => __('Height for the logo in the header area', 'themerex'),
			"id" => "logo_height",
			"override" => "category,post,page",
			"increment" => 1,
			"std" => '',
			"min" => 10,
			"max" => 300,
			"mask" => "?999",
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Logo top offset', 'themerex'),
			"desc" => __('Top offset for the logo in the header area', 'themerex'),
			"id" => "logo_offset",
			"override" => "category,post,page",
			"increment" => 1,
			"std" => '',
			"min" => 0,
			"max" => 99,
			"mask" => "?99",
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Logo for footer', 'themerex'),
			"desc" => __('Select or upload logos for the site\'s footer and set it height', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Logo image for footer', 'themerex'),
			"desc" => __('Logo image for the footer', 'themerex'),
			"id" => "logo_image_footer",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "",
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Logo height', 'themerex'),
			"desc" => __('Height for the logo in the footer area (in contacts)', 'themerex'),
			"id" => "logo_image_footer_height",
			"override" => "category,post,page",
			"increment" => 1,
			"std" => 62,
			"min" => 10,
			"max" => 300,
			"mask" => "?999",
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Menus', 'themerex'),
			"id" => 'customization_mainmenu',
			"override" => "category,post,page",
			"icon" => 'iconadmin-menu',
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Top panel', 'themerex'),
			"desc" => __('Top panel settings. It include user menu area (with contact info, cart button, language selector, login/logout menu and user menu) and main menu area (with logo and main menu).', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show Top panel', 'themerex'),
			"desc" => __('Select position for the top panel with logo and main menu', 'themerex'),
			"id" => "show_top_panel",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "above",
			"options" => array(
				'above' => __('Above slider', 'themerex'),
				'below' => __('Below slider', 'themerex'),
				'hide'  => __('Hide', 'themerex'),
			),
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => __('Show contact info', 'themerex'),
			"desc" => __("Show the contact details for the owner of the site at the right and left corner of the page", 'themerex'),
			"id" => "show_contact_info",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Main menu style and position', 'themerex'),
			"desc" => __('Select the Main menu style and position', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Select main menu',  'themerex'),
			"desc" => __('Select main menu for the current page',  'themerex'),
			"id" => "menu_main",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "default",
			"options" => $menus,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Main menu position', 'themerex'),
			"desc" => __('Attach main menu to top of window then page scroll down', 'themerex'),
			"id" => "menu_position",
			"override" => "category,post,page",
			"std" => "fixed",
			"options" => array("fixed"=>__("Fix menu position", 'themerex'), "none"=>__("Don't fix menu position", 'themerex')),
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Main menu responsive', 'themerex'),
			"desc" => __('Allow responsive version for the main menu if window width less then this value', 'themerex'),
			"id" => "menu_responsive",
			"std" => 1023,
			"min" => 320,
			"max" => 1167,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Open responsive submenus', 'themerex'),
			"desc" => __('How to open a submenu in the responsive version of the main menu', 'themerex'),
			"id" => "menu_responsive_open",
			"std" => "click",
			"size" => "medium",
			"options" => array(
				'click' => __('onClick',  'themerex'),
				'hover' => __('onHover',  'themerex')
			),
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Submenu width', 'themerex'),
			"desc" => __('Width for dropdown menus in main menu', 'themerex'),
			"id" => "menu_width",
			"override" => "category,post,page",
			"increment" => 5,
			"std" => "",
			"min" => 180,
			"max" => 300,
			"mask" => "?999",
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Item description', 'themerex'),
			"desc" => __("How display menu item's description", 'themerex'),
			"id" => "menu_description",
			"std" => "below",
			"size" => "medium",
			"override" => "category,post,page",
			"options" => array(
				'below' => __("Below the item's caption",  'themerex'),
				'title' => __("As item's title (in popup)",  'themerex')
			),
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __("User's menu area components", 'themerex'),
			"desc" => __("Select parts for the user's menu area", 'themerex'),
			"override" => "category,page,post",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show user menu area', 'themerex'),
			"desc" => __('Show user menu area on top of page', 'themerex'),
			"id" => "show_user_menu",
			"divider" => false,
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show cart button', 'themerex'),
	"desc" => __('Show cart button in the top panel', 'themerex'),
	"id" => "show_cart",
	"override" => "category,post,page",
	"std" => "shop",
	"options" => array(
		'always' => __('Always', 'themerex'),
		'shop' => __('Only on shop pages', 'themerex'),
		'no' =>  __('Hide', 'themerex'),
	),
	"type" => "checklist");

$THEMEREX_options[] = array( "title" => __('Show social networks list', 'themerex'),
			"desc" => __("Show social networks list at the top right corner of the page", 'themerex'),
			"id" => "show_social_info",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show currency selector', 'themerex'),
			"desc" => __('Show currency selector in the user menu', 'themerex'),
			"id" => "show_currency",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show language selector', 'themerex'),
			"desc" => __('Show language selector in the user menu (if WPML plugin installed and current page/post has multilanguage version)', 'themerex'),
			"id" => "show_languages",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show Login/Logout buttons', 'themerex'),
			"desc" => __('Show Login and Logout buttons in the user menu area', 'themerex'),
			"id" => "show_login",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __("Left and Right Panels", 'themerex'),
			"desc" => __("Left panel (with sidemenu) and Right panel (with customizer, widgets, right menu and favorites) settings", 'themerex'),
			"override" => "category,page,post",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Panels demo time', 'themerex'),
			"desc" => __('Timer for demo mode for the right panel (in milliseconds: 1000ms = 1s). If 0 - no demo.', 'themerex'),
			"id" => "right_panel_demo",
			"divider" => false,
			"std" => "0",
			"min" => 0,
			"max" => 10000,
			"increment" => 500,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Show Left panel', 'themerex'),
			"desc" => __('Show left panel with sidemenu', 'themerex'),
			"id" => "show_left_panel",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Select sidemenu',  'themerex'),
			"desc" => __('Select sidemenu in the left panel for the current page',  'themerex'),
			"id" => "menu_side",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "default",
			"options" => $menus,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Show Right panel', 'themerex'),
			"desc" => __('Show right panel with theme customizer, widgets area, menu and bookmarks list', 'themerex'),
			"id" => "show_right_panel",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Select Right panel menu',  'themerex'),
			"desc" => __('Select menu in the right panel for the current page',  'themerex'),
			"id" => "menu_panel",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "default",
			"options" => $menus,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Right panel default tab', 'themerex'),
			"desc" => __('Select default tab for the right panel', 'themerex'),
			"id" => "right_panel_tab",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "3",
			"options" => array(
				'0' => __('Customization', 'themerex'),
				'1' => __('Menu', 'themerex'),
				'2' => __('Bookmarks', 'themerex')
			),
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => __("Table of Contents (TOC)", 'themerex'),
			"desc" => __("Table of Contents for the current page. Automatically created if the page contains objects with id starting with 'toc_'", 'themerex'),
			"override" => "category,page,post",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show TOC', 'themerex'),
			"desc" => __('Show TOC for the current page', 'themerex'),
			"id" => "menu_toc",
			"override" => "category,post,page",
			"std" => "fixed",
			"options" => array(
				'no' => __('Hide', 'themerex'),
				'fixed' => __('Fixed', 'themerex'),
				'float' => __('Float', 'themerex')
			),
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => __('Add "Home" into TOC', 'themerex'),
			"desc" => __('Automatically add "Home" item into table of contents - return to home page of the site', 'themerex'),
			"id" => "menu_toc_home",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Add "To Top" into TOC', 'themerex'),
			"desc" => __('Automatically add "To Top" item into table of contents - scroll to top of the page', 'themerex'),
			"id" => "menu_toc_top",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Sidebars', 'themerex'),
			"id" => "customization_sidebars",
			"icon" => "iconadmin-indent-right",
			"override" => "category,post,page",
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Custom sidebars', 'themerex'),
			"desc" => __('In this section you can create unlimited sidebars. You can fill them with widgets in the menu Appearance - Widgets', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Custom sidebars',  'themerex'),
			"desc" => __('Manage custom sidebars. You can use it with each category (page, post) independently',  'themerex'),
			"id" => "custom_sidebars",
			"divider" => false,
			"std" => "",
			"cloneable" => true,
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Sidebars settings', 'themerex'),
			"desc" => __('Show / Hide and Select sidebar in each location', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show main sidebar',  'themerex'),
			"desc" => __('Select main sidebar position on blog page',  'themerex'),
			"id" => 'show_sidebar_main',
			"override" => "category,post,page",
			"std" => "right",
			"options" => $positions,
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Main sidebar style', 'themerex'),
	"desc" => __('Select color style for the main sidebar', 'themerex'),
	"id" => "sidebar_main_style",
	"override" => "category,post,page",
	"divider" => false,
	"std" => "light",
	"size" => "medium",
	"options" => array(
		'light' => __('Light', 'themerex'),
		'dark' => __('Dark', 'themerex')
	),
	"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Select main sidebar',  'themerex'),
			"desc" => __('Select main sidebar for the blog page',  'themerex'),
			"id" => "sidebar_main",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "sidebar-main",
			"options" => $sidebars,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Show footer sidebar', 'themerex'),
			"desc" => __('Show footer sidebar', 'themerex'),
			"id" => "show_sidebar_footer",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Footer sidebar style', 'themerex'),
			"desc" => __('Select color style for the footer sidebar', 'themerex'),
			"id" => "sidebar_footer_style",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "dark",
			"size" => "medium",
			"options" => array(
				'light' => __('Light', 'themerex'),
				'dark' => __('Dark', 'themerex')
			),
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Select footer sidebar',  'themerex'),
			"desc" => __('Select footer sidebar for the blog page',  'themerex'),
			"id" => "sidebar_footer",
			"override" => "category,post,page",
			"divider" => false,
			"std" => "sidebar-footer",
			"options" => $sidebars,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Slider', 'themerex'),
			"id" => "customization_slider",
			"icon" => "iconadmin-picture",
			"override" => "category,page",
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Main slider parameters', 'themerex'),
			"desc" => __('Select parameters for main slider (you can override it in each category and page)', 'themerex'),
			"override" => "category,page",
			"type" => "info");
			
$THEMEREX_options[] = array( "title" => __('Show Slider', 'themerex'),
			"desc" => __('Do you want to show slider on each page (post)', 'themerex'),
			"id" => "slider_show",
			"divider" => false,
			"override" => "category,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Slider display', 'themerex'),
			"desc" => __('How display slider: fixed height or fullscreen height', 'themerex'),
			"id" => "slider_display",
			"override" => "category,page",
			"std" => "none",
			"options" => array(
				"fixed"=>__("Fixed height", 'themerex'),
				"fullscreen"=>__("Fullscreen", 'themerex')
			),
			"size" => "big",
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __("Height (in pixels)", 'themerex'),
			"desc" => __("Slider height (in pixels) - only if slider display with fixed height (May contain an 'auto' value).", 'themerex'),
			"id" => "slider_height",
			"override" => "category,page",
			"std" => 500,
			"min" => 100,
			"increment" => 10,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Slider engine', 'themerex'),
			"desc" => __('What engine use to show slider?', 'themerex'),
			"id" => "slider_engine",
			"override" => "category,page",
			"std" => "flex",
			"options" => $sliders,
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Layer Slider: Alias (for Revolution)',  'themerex'),
			"desc" => __("Revolution Slider alias (see in slider settings on plugin page)", 'themerex'),
			"id" => "slider_alias",
			"override" => "category,page",
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Posts Slider: Category to show', 'themerex'),
			"desc" => __('Select category to show in Flexslider (ignored for Revolution and Royal sliders)', 'themerex'),
			"id" => "slider_category",
			"override" => "category,page",
			"std" => "",
			"options" => themerex_array_merge(array(0 => __('- Any category -', 'themerex')), $categories),
			"type" => "select",
			"multiple" => true,
			"style" => "list");

$THEMEREX_options[] = array( "title" => __('Posts Slider: Number posts or comma separated posts list',  'themerex'),
			"desc" => __("How many recent posts display in slider or comma separated list of posts ID (in this case selected category ignored)", 'themerex'),
			"override" => "category,page",
			"id" => "slider_posts",
			"std" => "5",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __("Posts Slider: Posts order by",  'themerex'),
			"desc" => __("Posts in slider ordered by date (default), comments, views, author rating, users rating, random or alphabetically", 'themerex'),
			"override" => "category,page",
			"id" => "slider_orderby",
			"std" => "date",
			"options" => $sorting,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __("Posts Slider: Posts order", 'themerex'),
			"desc" => __('Select the desired ordering method for posts', 'themerex'),
			"id" => "slider_order",
			"override" => "category,page",
			"std" => "desc",
			"options" => $ordering,
			"size" => "big",
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __("Posts Slider: Slide change interval", 'themerex'),
			"desc" => __("Interval (in ms) for slides change in flex-slider", 'themerex'),
			"id" => "slider_interval",
			"override" => "category,page",
			"std" => 7000,
			"min" => 100,
			"increment" => 100,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __("Posts Slider: Pagination", 'themerex'),
			"desc" => __("Choose pagination style for the slider", 'themerex'),
			"id" => "slider_pagination",
			"override" => "category,page",
			"std" => "no",
			"options" => array(
				'no'   => __('None', 'themerex'),
				'yes'  => __('Dots', 'themerex'), 
				'over' => __('Titles', 'themerex')
			),
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => __("Posts Slider: Show infobox", 'themerex'),
			"desc" => __("Do you want to show post's title, reviews rating and description on slides in flex-slider", 'themerex'),
			"id" => "slider_info_box",
			"override" => "category,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __("Posts Slider: Infobox fixed", 'themerex'),
			"desc" => __("Do you want to fix infobox on slides in flex-slider or hide it in hover", 'themerex'),
			"id" => "slider_info_fixed",
			"override" => "category,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __("Posts Slider: Show post's category", 'themerex'),
			"desc" => __("Do you want to show post's category on slides in flex-slider", 'themerex'),
			"id" => "slider_info_category",
			"override" => "category,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __("Posts Slider: Show post's descriptions", 'themerex'),
			"desc" => __("Do you want to show post's description on slides in flex-slider", 'themerex'),
			"id" => "slider_descriptions",
			"override" => "category,page",
			"std" => 0,
			"min" => 0,
			"increment" => 10,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __("Header &amp; Footer", 'themerex'),
			"id" => 'customization_header_footer',
			"override" => "category,post,page",
			"icon" => 'iconadmin-window',
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __("Header settings", 'themerex'),
			"desc" => __("Select components of the page header, set style and put the content for the user's header area", 'themerex'),
			"override" => "category,page,post",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __("Show user's header", 'themerex'),
			"desc" => __("Select display options for the user's header area. 'Grey' - theme styled variants, 'Custom' - you must put all style properties in the inserted html-code and shortcodes", 'themerex'),
			"id" => "show_user_header",
			"divider" => false,
			"override" => "category,page,post",
			"std" => "none",
			"options" => $headers,
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __("User's header content", 'themerex'),
			"desc" => __('Put header html-code and/or shortcodes here. You can use any html-tags and shortcodes', 'themerex'),
			"id" => "user_header_content",
			"override" => "category,page,post",
			"std" => "",
			"rows" => "10",
			"type" => "editor");

$THEMEREX_options[] = array( "title" => __('Show Top of page section', 'themerex'),
			"desc" => __('Show top section with post/page/category title and breadcrumbs', 'themerex'),
			"id" => "show_top_page",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show Page title', 'themerex'),
			"desc" => __('Show post/page/category title', 'themerex'),
			"id" => "show_page_title",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show Breadcrumbs', 'themerex'),
			"desc" => __('Show path to current category (post, page)', 'themerex'),
			"id" => "show_breadcrumbs",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Breadcrumbs max nesting', 'themerex'),
			"desc" => __("Max number of the nested categories in the breadcrumbs (0 - unlimited)", 'themerex'),
			"id" => "breadcrumbs_max_level",
			"std" => "0",
			"min" => 0,
			"max" => 100,
			"increment" => 1,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __("Footer settings", 'themerex'),
			"desc" => __("Select components of the footer, set style and put the content for the user's footer area", 'themerex'),
			"override" => "category,page,post",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __("Show user's footer", 'themerex'),
			"desc" => __("Select desired style for user's footer area", 'themerex'),
			"id" => "show_user_footer",
			"divider" => false,
			"override" => "category,page,post",
			"std" => "none",
			"options" => $headers,
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __("User's footer content", 'themerex'),
			"desc" => __('Put footer html-code and/or shortcodes here. You can use any html-tags and shortcodes', 'themerex'),
			"id" => "user_footer_content",
			"override" => "category,page,post",
			"std" => "",
			"rows" => "10",
			"type" => "editor");

$THEMEREX_options[] = array( "title" => __('Show Contacts in footer', 'themerex'),
			"desc" => __('Show contact information area in footer: site logo, contact info and large social icons', 'themerex'),
			"id" => "show_contacts_in_footer",
			"override" => "category,post,page",
			"std" => "no",
			"options" => array(
				'no'    => __('Hide', 'themerex'),
				'light' => __('Light', 'themerex'),
				'dark'  => __('Dark', 'themerex')
			),
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => __('Show Twitter in footer', 'themerex'),
			"desc" => __('Show Twitter slider in footer. For correct operation of the slider (and shortcode twitter) you must fill out the Twitter API keys on the menu "Appearance - Theme Options - Socials"', 'themerex'),
			"id" => "show_twitter_in_footer",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show Copyright area in footer', 'themerex'),
			"desc" => __('Show area with copyright information and small social icons in footer', 'themerex'),
			"id" => "show_copyright_area_in_footer",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Footer copyright text',  'themerex'),
			"desc" => __("Copyright text to show in footer area (bottom of site)", 'themerex'),
			"id" => "footer_copyright",
			"std" => "AxiomThemes &copy; 2014 All Rights Reserved ",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Terms of use text',  'themerex'),
			"desc" => __("Text to show in footer area (bottom of site)", 'themerex'),
			"id" => "footer_terms_text",
			"std" => "Terms of Use",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Terms of use link',  'themerex'),
			"desc" => __("Link for Terms of Use", 'themerex'),
			"id" => "footer_terms_link",
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Privacy policy text',  'themerex'),
			"desc" => __("Text to show in footer area (bottom of site)", 'themerex'),
			"id" => "footer_policy_text",
			"std" => "Privacy Policy",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Privacy policy link',  'themerex'),
			"desc" => __("Link for Privacy policy", 'themerex'),
			"id" => "footer_policy_link",
			"std" => "",
			"type" => "text");


$THEMEREX_options[] = array( "title" => __('Google map parameters', 'themerex'),
			"desc" => __('Select parameters for Google map (you can override it in each category and page)', 'themerex'),
			"override" => "category,page,post",
			"type" => "info");
			
$THEMEREX_options[] = array( "title" => __('Show Google Map', 'themerex'),
			"desc" => __('Do you want to show Google map on each page (post)', 'themerex'),
			"id" => "googlemap_show",
			"divider" => false,
			"override" => "category,page,post",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");
$THEMEREX_options[] = array( "title" => __('Show button for Google Map', 'themerex'),
			"desc" => __('Do you want to show Google map minimize button', 'themerex'),
			"id" => "googlemap_button_show",
			"override" => "category,page,post",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __("Map height (in pixels)", 'themerex'),
			"desc" => __("Map height (in pixels)", 'themerex'),
			"id" => "googlemap_height",
			"override" => "category,page",
			"std" => 360,
			"min" => 100,
			"increment" => 10,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Address to show on map',  'themerex'),
			"desc" => __("Enter address to show on map center", 'themerex'),
			"id" => "googlemap_address",
			"override" => "category,page,post",
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Latitude and Longtitude to show on map',  'themerex'),
			"desc" => __("Enter coordinates (separated by comma) to show on map center (instead of address)", 'themerex'),
			"id" => "googlemap_latlng",
			"override" => "category,page,post",
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Google map initial zoom',  'themerex'),
			"desc" => __("Enter desired initial zoom for Google map", 'themerex'),
			"id" => "googlemap_zoom",
			"override" => "category,page,post",
			"std" => 16,
			"min" => 1,
			"max" => 20,
			"increment" => 1,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Google map style',  'themerex'),
			"desc" => __("Select style to show Google map", 'themerex'),
			"id" => "googlemap_style",
			"override" => "category,page,post",
			"std" => 'style1',
			"options" => $gmap_styles,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Google map marker',  'themerex'),
			"desc" => __("Select or upload png-image with Google map marker", 'themerex'),
			"id" => "googlemap_marker",
			"std" => '',
			"type" => "media");

$THEMEREX_options[] = array( "title" => __('Media', 'themerex'),
			"id" => 'customization_media',
			"override" => "category,post,page",
			"icon" => 'iconadmin-picture',
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Retina ready', 'themerex'),
			"desc" => __("Additional parameters for the Retina displays", 'themerex'),
			"type" => "info");
			
$THEMEREX_options[] = array( "title" => __('Image dimensions', 'themerex'),
			"desc" => __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'themerex'),
			"id" => "retina_ready",
			"divider" => false,
			"std" => "1",
			"size" => "medium",
			"options" => array("1"=>__("Original", 'themerex'), "2"=>__("Retina", 'themerex')),
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Media Substitution parameters', 'themerex'),
			"desc" => __("Set up the media substitution parameters and slider's options", 'themerex'),
			"override" => "category,page,post",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Substitute standard Wordpress gallery', 'themerex'),
			"desc" => __('Substitute standard Wordpress gallery with our slider on the single pages', 'themerex'),
			"id" => "substitute_gallery",
			"divider" => false,
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Substitution Slider engine', 'themerex'),
			"desc" => __('What engine use to show slider instead standard gallery?', 'themerex'),
			"id" => "substitute_slider_engine",
			"override" => "category,post,page",
			"std" => "swiper",
			"options" => array(
				"flex" => __("Flex slider", 'themerex'),
				"swiper" => __("Swiper slider", 'themerex')
			),
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Show gallery instead featured image', 'themerex'),
			"desc" => __('Show slider with gallery instead featured image on blog streampage for the gallery posts', 'themerex'),
			"id" => "gallery_instead_image",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Max images number in the slider', 'themerex'),
			"desc" => __('Maximum images number from gallery into slider', 'themerex'),
			"id" => "gallery_max_slides",
			"override" => "category,post,page",
			"std" => "5",
			"min" => 2,
			"max" => 10,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Gallery popup engine', 'themerex'),
			"desc" => __('Select engine to show popup windows with galleries', 'themerex'),
			"id" => "popup_engine",
			"std" => "magnific",
			"options" => $popups,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Enable Gallery mode in the popup', 'themerex'),
			"desc" => __('Enable Gallery mode in the popup or show only single image', 'themerex'),
			"id" => "popup_gallery",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Theme-styled Standard Wordpress gallery', 'themerex'),
			"desc" => __('Substitute standard Wordpress gallery with our theme-styled gallery', 'themerex'),
			"id" => "substitute_gallery_layout",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Substitute audio tags', 'themerex'),
			"desc" => __('Substitute audio tag with source from soundcloud to embed player', 'themerex'),
			"id" => "substitute_audio",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Substitute video tags', 'themerex'),
			"desc" => __('Substitute video tags with embed players or leave video tags unchanged (if you use third party plugins for the video tags)', 'themerex'),
			"id" => "substitute_video",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Use Media Element script for audio and video tags', 'themerex'),
			"desc" => __('Do you want use the Media Element script for all audio and video tags on your site or leave standard HTML5 behaviour?', 'themerex'),
			"id" => "use_mediaelement",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __("Typography", 'themerex'),
			"id" => 'customization_typography',
			"icon" => 'iconadmin-font',
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Typography settings', 'themerex'),
			"desc" => __('Select fonts, sizes and styles for the headings and paragraphs. You can use Google fonts and custom fonts.<br><br>How to install custom @font-face fonts into the theme?<br>All @font-face fonts are located in "theme_name/css/font-face/" folder in the separate subfolders for the each font. Subfolder name is a font-family name!<br>Place full set of the font files (for each font style and weight) and css-file named stylesheet.css in the each subfolder.<br>Create your @font-face kit by using <a href="http://www.fontsquirrel.com/fontface/generator">Fontsquirrel @font-face Generator</a> and then extract the font kit (with folder in the kit) into the "theme_name/css/font-face" folder to install.', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Use custom typography', 'themerex'),
			"desc" => __('Use custom font settings or leave theme-styled fonts', 'themerex'),
			"id" => "typography_custom",
			"divider" => false,
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Heading 1', 'themerex'),
			"desc" => '',
			"id" => "typography_h1_font",
			"divider" => false,
			"columns" => "3_8 first",
			"std" => "Open Sans",
			"options" => $fonts,
			"type" => "fonts");

$THEMEREX_options[] = array( "title" => __('Size', 'themerex'),
			"desc" => '',
			"id" => "typography_h1_size",
			"divider" => false,
			"columns" => "1_8",
			"std" => "48",
			"step" => 1,
			"from" => 12,
			"to" => 60,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Line height', 'themerex'),
			"desc" => '',
			"id" => "typography_h1_lineheight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "60",
			"step" => 1,
			"from" => 12,
			"to" => 100,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Weight', 'themerex'),
			"desc" => '',
			"id" => "typography_h1_weight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "400",
			"step" => 100,
			"from" => 100,
			"to" => 900,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Style', 'themerex'),
			"desc" => '',
			"id" => "typography_h1_style",
			"divider" => false,
			"columns" => "1_8",
			"std" => "",
			"multiple" => true,
			"options" => $fonts_styles,
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => __('Color', 'themerex'),
			"desc" => '',
			"id" => "typography_h1_color",
			"divider" => false,
			"columns" => "1_8",
			"std" => "#222222",
			"style" => "custom",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Heading 2', 'themerex'),
			"desc" => '',
			"id" => "typography_h2_font",
			"divider" => false,
			"columns" => "3_8 first",
			"std" => "Open Sans",
			"options" => $fonts,
			"type" => "fonts");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h2_size",
			"divider" => false,
			"columns" => "1_8",
			"std" => "36",
			"step" => 1,
			"from" => 12,
			"to" => 60,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h2_lineheight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "43",
			"step" => 1,
			"from" => 12,
			"to" => 100,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h2_weight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "400",
			"step" => 100,
			"from" => 100,
			"to" => 900,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h2_style",
			"divider" => false,
			"columns" => "1_8",
			"std" => "",
			"multiple" => true,
			"options" => $fonts_styles,
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h2_color",
			"divider" => false,
			"columns" => "1_8",
			"std" => "#222222",
			"style" => "custom",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Heading 3', 'themerex'),
			"desc" => '',
			"id" => "typography_h3_font",
			"divider" => false,
			"columns" => "3_8 first",
			"std" => "Open Sans",
			"options" => $fonts,
			"type" => "fonts");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h3_size",
			"divider" => false,
			"columns" => "1_8",
			"std" => "24",
			"step" => 1,
			"from" => 12,
			"to" => 60,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h3_lineheight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "28",
			"step" => 1,
			"from" => 12,
			"to" => 100,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h3_weight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "400",
			"step" => 100,
			"from" => 100,
			"to" => 900,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h3_style",
			"divider" => false,
			"columns" => "1_8",
			"std" => "",
			"multiple" => true,
			"options" => $fonts_styles,
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h3_color",
			"divider" => false,
			"columns" => "1_8",
			"std" => "#222222",
			"style" => "custom",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Heading 4', 'themerex'),
			"desc" => '',
			"id" => "typography_h4_font",
			"divider" => false,
			"columns" => "3_8 first",
			"std" => "Open Sans",
			"options" => $fonts,
			"type" => "fonts");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h4_size",
			"divider" => false,
			"columns" => "1_8",
			"std" => "20",
			"step" => 1,
			"from" => 12,
			"to" => 60,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h4_lineheight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "24",
			"step" => 1,
			"from" => 12,
			"to" => 100,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h4_weight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "400",
			"step" => 100,
			"from" => 100,
			"to" => 900,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h4_style",
			"divider" => false,
			"columns" => "1_8",
			"std" => "",
			"multiple" => true,
			"options" => $fonts_styles,
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h4_color",
			"divider" => false,
			"columns" => "1_8",
			"std" => "#222222",
			"style" => "custom",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Heading 5', 'themerex'),
			"desc" => '',
			"id" => "typography_h5_font",
			"divider" => false,
			"columns" => "3_8 first",
			"std" => "Open Sans",
			"options" => $fonts,
			"type" => "fonts");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h5_size",
			"divider" => false,
			"columns" => "1_8",
			"std" => "18",
			"step" => 1,
			"from" => 12,
			"to" => 60,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h5_lineheight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "20",
			"step" => 1,
			"from" => 12,
			"to" => 100,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h5_weight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "400",
			"step" => 100,
			"from" => 100,
			"to" => 900,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h5_style",
			"divider" => false,
			"columns" => "1_8",
			"std" => "",
			"multiple" => true,
			"options" => $fonts_styles,
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h5_color",
			"divider" => false,
			"columns" => "1_8",
			"std" => "#222222",
			"style" => "custom",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Heading 6', 'themerex'),
			"desc" => '',
			"id" => "typography_h6_font",
			"divider" => false,
			"columns" => "3_8 first",
			"std" => "Open Sans",
			"options" => $fonts,
			"type" => "fonts");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h6_size",
			"divider" => false,
			"columns" => "1_8",
			"std" => "16",
			"step" => 1,
			"from" => 12,
			"to" => 60,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h6_lineheight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "18",
			"step" => 1,
			"from" => 12,
			"to" => 100,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h6_weight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "400",
			"step" => 100,
			"from" => 100,
			"to" => 900,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h6_style",
			"divider" => false,
			"columns" => "1_8",
			"std" => "",
			"multiple" => true,
			"options" => $fonts_styles,
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_h6_color",
			"divider" => false,
			"columns" => "1_8",
			"std" => "#222222",
			"style" => "custom",
			"type" => "color");

$THEMEREX_options[] = array( "title" => __('Paragraph text', 'themerex'),
			"desc" => '',
			"id" => "typography_p_font",
			"divider" => false,
			"columns" => "3_8 first",
			"std" => "Source Sans Pro",
			"options" => $fonts,
			"type" => "fonts");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_p_size",
			"divider" => false,
			"columns" => "1_8",
			"std" => "14",
			"step" => 1,
			"from" => 12,
			"to" => 60,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_p_lineheight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "21",
			"step" => 1,
			"from" => 12,
			"to" => 100,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_p_weight",
			"divider" => false,
			"columns" => "1_8",
			"std" => "300",
			"step" => 100,
			"from" => 100,
			"to" => 900,
			"type" => "select");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_p_style",
			"divider" => false,
			"columns" => "1_8",
			"std" => "",
			"multiple" => true,
			"options" => $fonts_styles,
			"type" => "checklist");

$THEMEREX_options[] = array( "title" => '',
			"desc" => '',
			"id" => "typography_p_color",
			"divider" => false,
			"columns" => "1_8 last",
			"std" => "#222222",
			"style" => "custom",
			"type" => "color");


//###############################
//#### Blog and Single pages #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Blog &amp; Single', 'themerex'),
			"id" => "partition_blog",
			"icon" => "iconadmin-docs",
			"override" => "category,post,page",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Stream page', 'themerex'),
			"id" => 'blog_tab_stream',
			"start" => 'blog_tabs',
			"icon" => "iconadmin-docs",
			"override" => "category,post,page",
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Blog streampage parameters', 'themerex'),
			"desc" => __('Select desired blog streampage parameters (you can override it in each category)', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Blog style', 'themerex'),
			"desc" => __('Select desired blog style', 'themerex'),
			"divider" => false,
			"id" => "blog_style",
			"override" => "category,page",
			"std" => "excerpt",
			"options" => $blog_styles,
			"type" => "select");


$THEMEREX_options[] = array( "title" => __('Show spacing', 'themerex'),
	"desc" => __('Show the spacing between columns (only for Blog style = Portfolio(2-4 columns))', 'themerex'),
	"id" => "show_portfolio_spacing",
	"override" => "category,page",
	"std" => "yes",
	"options" => $yes_no,
	"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show filters', 'themerex'),
			"desc" => __('Show filter buttons (only for Blog style = Portfolio, Masonry, Classic)', 'themerex'),
			"id" => "show_filters",
			"override" => "category,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Use as filter keywords', 'themerex'),
			"desc" => __('Select taxonomy that will be used as a filter for portfolio elements', 'themerex'),
			"id" => "filter_taxonomy",
			"override" => "category,page",
			"std" => "tags",
			"options" => array(
				'tags' => __('Tags', 'themerex'),
				'categories' => __('Categories', 'themerex')
			),
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Blog posts sorted by', 'themerex'),
			"desc" => __('Select the desired sorting method for posts', 'themerex'),
			"id" => "blog_sort",
			"override" => "category,page",
			"std" => "date",
			"options" => $sorting,
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Blog posts order', 'themerex'),
			"desc" => __('Select the desired ordering method for posts', 'themerex'),
			"id" => "blog_order",
			"override" => "category,page",
			"std" => "desc",
			"options" => $ordering,
			"size" => "big",
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Blog posts per page',  'themerex'),
			"desc" => __('How many posts display on blog pages for selected style. If empty or 0 - inherit system wordpress settings',  'themerex'),
			"id" => "posts_per_page",
			"override" => "category,page",
			"std" => "12",
			"mask" => "?99",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Excerpt maxlength for streampage',  'themerex'),
			"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Excerpt). 0 - do not trim excerpt.',  'themerex'),
			"id" => "post_excerpt_maxlength",
			"override" => "category,page",
			"std" => "250",
			"mask" => "?9999",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Excerpt maxlength for classic and masonry',  'themerex'),
			"desc" => __('How many characters from post excerpt are display in blog streampage (only for Blog style = Classic or Masonry). 0 - do not trim excerpt.',  'themerex'),
			"id" => "post_excerpt_maxlength_masonry",
			"override" => "category,page",
			"std" => "150",
			"mask" => "?9999",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Single page', 'themerex'),
			"id" => 'blog_tab_single',
			"icon" => "iconadmin-doc",
			"override" => "category,post,page",
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Your CSS code', 'themerex'),
			"desc" => __('Select desired parameters for single (detail) pages (you can override it in each category and single post (page))', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Single page style', 'themerex'),
			"desc" => __('Select desired style for single page', 'themerex'),
			"id" => "single_style",
			"divider" => false,
			"override" => "category,page,post",
			"std" => "single-standard",
			"options" => $single_styles,
			"dir" => "horizontal",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Style display images in a portfolio', 'themerex'),
			"desc" => __('Select style of the images in the portfolio (only for Blog style = Grid (alternative))', 'themerex'),
			"id" => "portfolio_image_style",
			"divider" => true,
			"override" => "category,post",
			"std" => "image-square-1",
			"options" => $portfolio_image_style,
			"dir" => "horizontal",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Frontend editor',  'themerex'),
			"desc" => __("Allow authors to edit their posts in frontend area)", 'themerex'),
			"id" => "allow_editor",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show featured image before post',  'themerex'),
			"desc" => __("Show featured image (if selected) before post content on single pages", 'themerex'),
			"id" => "show_featured_image",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show post title', 'themerex'),
			"desc" => __('Show area with post title on single pages', 'themerex'),
			"id" => "show_post_title",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show post title on links, chat, quote, status', 'themerex'),
			"desc" => __('Show area with post title on single and blog pages in specific post formats: links, chat, quote, status', 'themerex'),
			"id" => "show_post_title_on_quotes",
			"override" => "category,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show post info', 'themerex'),
			"desc" => __('Show area with post info on single pages', 'themerex'),
			"id" => "show_post_info",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show text before "Read more" tag', 'themerex'),
			"desc" => __('Show text before "Read more" tag on single pages', 'themerex'),
			"id" => "show_text_before_readmore",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Show post author details',  'themerex'),
			"desc" => __("Show post author information block on single post page", 'themerex'),
			"id" => "show_post_author",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show post tags and categories',  'themerex'),
			"desc" => __("Show tags and categories blocks on single post page", 'themerex'),
			"id" => "show_post_tags",
			"override" => "category,post",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show post counters',  'themerex'),
			"desc" => __("Show counters block on single post page", 'themerex'),
			"id" => "show_post_counters",
			"override" => "category,page,post",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show related posts',  'themerex'),
			"desc" => __("Show related posts block on single post page", 'themerex'),
			"id" => "show_post_related",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Related posts style',  'themerex'),
			"desc" => __("Select Yes to display the posts in the style of indentation", 'themerex'),
			"id" => "post_related_style",
			"override" => "category,post,page",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Related posts number',  'themerex'),
			"desc" => __("How many related posts showed on single post page", 'themerex'),
			"id" => "post_related_count",
			"override" => "category,post,page",
			"std" => "4",
			"increment" => 1,
			"min" => 2,
			"max" => 8,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Related posts sorted by', 'themerex'),
			"desc" => __('Select the desired sorting method for related posts', 'themerex'),
			"id" => "post_related_sort",
//			"override" => "category,page",
			"std" => "date",
			"options" => $sorting,
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Related posts order', 'themerex'),
			"desc" => __('Select the desired ordering method for related posts', 'themerex'),
			"id" => "post_related_order",
//			"override" => "category,page",
			"std" => "desc",
			"options" => $ordering,
			"size" => "big",
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show comments',  'themerex'),
			"desc" => __("Show comments block on single post page", 'themerex'),
			"id" => "show_post_comments",
			"override" => "category,post,page",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Portfolio single page', 'themerex'),
	"desc" => __('This block contains settings of portfolio single post\'s info block', 'themerex'),
	"override" => "category,post",
	"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show portfolio info block',  'themerex'),
	"desc" => __("Show portfolio info block on single portfolio post page", 'themerex'),
	"id" => "show_portfol_info",
	"override" => "category,post",
	"std" => "yes",
	"options" => $yes_no,
	"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Customer portfolio info',  'themerex'),
	"desc" => __('Add your customer here',  'themerex'),
	"id" => "portfol_customer",
	"override" => "category,post",
	"divider" => false,
	"cols" => 80,
	"rows" => 10,
	"std" => "",
	"type" => "textarea");

$THEMEREX_options[] = array( "title" => __('Portfolio info post date',  'themerex'),
	"desc" => __('Add your date here',  'themerex'),
	"id" => "portfol_date",
	"override" => "category,post",
	"divider" => false,
	"cols" => 80,
	"rows" => 10,
	"std" => "",
	"type" => "textarea");

$THEMEREX_options[] = array( "title" => __('Other parameters', 'themerex'),
			"id" => 'blog_tab_general',
			"icon" => "iconadmin-newspaper",
			"override" => "category,page",
			"type" => "tab");

$THEMEREX_options[] = array( "title" => __('Other Blog parameters', 'themerex'),
			"desc" => __('Select excluded categories, substitute parameters, etc.', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Exclude categories', 'themerex'),
			"desc" => __('Select categories, which posts are exclude from blog page', 'themerex'),
			"id" => "exclude_cats",
			"divider" => false,
			"std" => "",
			"options" => $categories,
			"multiple" => true,
			"style" => "list",
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Blog pagination', 'themerex'),
			"desc" => __('Select type of the pagination on blog streampages', 'themerex'),
			"id" => "blog_pagination",
			"std" => "pages",
			"override" => "category,page",
			"options" => array(
				'pages'    => __('Standard page numbers', 'themerex'),
				'viewmore' => __('"View more" button', 'themerex'),
				'infinite' => __('Infinite scroll', 'themerex')
			),
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Blog counters', 'themerex'),
			"desc" => __('Select counters, displayed near the post title', 'themerex'),
			"id" => "blog_counters",
			"std" => "views",
			"override" => "category,page",
			"options" => array(
				'none' => __("Don't show any counters", 'themerex'),
				'views' => __('Show views number', 'themerex'),
				'likes' => __('Show likes number', 'themerex'),
				'comments' => __('Show comments number', 'themerex')
			),
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __("Post's category announce", 'themerex'),
			"desc" => __('What category display in announce block (over posts thumb) - original or nearest parental', 'themerex'),
			"id" => "close_category",
			"std" => "parental",
			"override" => "category,page",
			"options" => array(
				'parental' => __('Nearest parental category', 'themerex'),
				'original' => __("Original post's category", 'themerex')
			),
			"dir" => "vertical",
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Show post date after', 'themerex'),
			"desc" => __('Show post date after N days (before - show post age)', 'themerex'),
			"id" => "show_date_after",
			"override" => "category,page",
			"std" => "30",
			"mask" => "?99",
			"type" => "text");



if (function_exists('is_woocommerce')) {

//###############################
//#### WooCommerce           #### 
//###############################
$THEMEREX_options[] = array( "title" => __('WooCommerce', 'themerex'),
			"id" => "partition_woocommerce",
			"icon" => "iconadmin-basket-1",
			"override" => "category",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('WooCommerce products list parameters', 'themerex'),
			"desc" => __("Select WooCommerce products list's style and crop parameters", 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Crop product thumbnail',  'themerex'),
			"desc" => __("Crop product's thumbnails on search results page", 'themerex'),
			"id" => "crop_product_thumb",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Show images in the cart',  'themerex'),
		"desc" => __("Show images in the cart (top)", 'themerex'),
		"id" => "show_img_cart",
		"std" => "no",
		"options" => $yes_no,
		"type" => "switch");

}



//###############################
//#### Contact info          #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Contact info', 'themerex'),
			"id" => "partition_contacts",
			"icon" => "iconadmin-mail-1",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Contact information', 'themerex'),
			"desc" => __('Company address, phones and e-mail', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Contact form email', 'themerex'),
			"desc" => __('E-mail for send contact form and user registration data', 'themerex'),
			"id" => "contact_email",
			"divider" => false,
			"std" => "",
			"before" => array('icon'=>'iconadmin-mail-1'),
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Company address (part 1)', 'themerex'),
			"desc" => __('Company country, post code and city', 'themerex'),
			"id" => "contact_address_1",
			"std" => "",
			"before" => array('icon'=>'iconadmin-home'),
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Company address (part 2)', 'themerex'),
			"desc" => __('Street and house number', 'themerex'),
			"id" => "contact_address_2",
			"std" => "",
			"before" => array('icon'=>'iconadmin-home'),
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Phone', 'themerex'),
			"desc" => __('Phone number', 'themerex'),
			"id" => "contact_phone",
			"std" => "",
			"before" => array('icon'=>'iconadmin-phone'),
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Fax', 'themerex'),
			"desc" => __('Fax number', 'themerex'),
			"id" => "contact_fax",
			"std" => "",
			"before" => array('icon'=>'iconadmin-phone'),
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Contacts in header (Time)', 'themerex'),
			"desc" => __('String with contact info in the site header', 'themerex'),
			"id" => "contact_info_time",
			"std" => "",
			"before" => array('icon'=>'iconadmin-mail-1'),
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Contacts in header (Phone number)', 'themerex'),
			"desc" => __('String with contact info in the site header', 'themerex'),
			"id" => "contact_info_phone",
			"std" => "",
			"before" => array('icon'=>'iconadmin-phone'),
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Contact and Comments form', 'themerex'),
			"desc" => __('Maximum length of the messages in the contact form shortcode and in the comments form', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Contact form message', 'themerex'),
			"desc" => __("Message's maxlength in the contact form shortcode", 'themerex'),
			"id" => "message_maxlength_contacts",
			"std" => "1000",
			"min" => 0,
			"max" => 10000,
			"increment" => 100,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Comments form message', 'themerex'),
			"desc" => __("Message's maxlength in the comments form", 'themerex'),
			"id" => "message_maxlength_comments",
			"std" => "1000",
			"min" => 0,
			"max" => 10000,
			"increment" => 100,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Default mail function', 'themerex'),
			"desc" => __('What function you want to use for sending mail: the built-in Wordpress wp_mail() or standard PHP mail() function? Attention! Some plugins may not work with one of them and you always have the ability to switch to alternative.', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __("Mail function", 'themerex'),
			"desc" => __("What function you want to use for sending mail?", 'themerex'),
			"id" => "mail_function",
			"std" => "wp_mail",
			"size" => "medium",
			"options" => array(
				'wp_mail' => __('WP mail', 'themerex'),
				'mail' => __('PHP mail', 'themerex')
			),
			"type" => "switch");



//###############################
//#### Socials               #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Socials', 'themerex'),
			"id" => "partition_socials",
			"icon" => "iconadmin-users-1",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Social networks', 'themerex'),
			"desc" => __("Social networks list for site on top of page and Social widget", 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Social networks',  'themerex'),
	"desc" => __('Select icon and write URL to your profile in desired social networks.',  'themerex'),
	"id" => "social_icons",
	"divider" => false,
	"std" => array(array('url'=>'', 'icon'=>'')),
	"options" => $socials,
	"cloneable" => true,
	"size" => "small",
	"style" => 'icons',
	"type" => "socials");

$THEMEREX_options[] = array( "title" => __('Share buttons', 'themerex'),
			"desc" => __("Add button's code for each social share network.<br>
			In share url you can use next macro:<br>
			<b>{url}</b> - share post (page) URL,<br>
			<b>{title}</b> - post title,<br>
			<b>{image}</b> - post image,<br>
			<b>{descr}</b> - post description (if supported)<br>
			For example:<br>
			<b>Facebook</b> share string: <em>http://www.facebook.com/sharer.php?u={link}&amp;t={title}</em><br>
			<b>Delicious</b> share string: <em>http://delicious.com/save?url={link}&amp;title={title}&amp;note={descr}</em>", 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show social share buttons',  'themerex'),
			"desc" => __("Show social share buttons block", 'themerex'),
			"id" => "show_share",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Share buttons',  'themerex'),
			"desc" => __('Select icon and write share URL for desired social networks.<br><b>Important!</b> If you leave text field empty - internal theme link will be used (if present).',  'themerex'),
			"id" => "share_buttons",
			"std" => array(array('url'=>'', 'icon'=>'')),
			"options" => $socials,
			"cloneable" => true,
			"size" => "small",
			"style" => 'icons',
			"type" => "socials");

$THEMEREX_options[] = array( "title" => __('Twitter API keys', 'themerex'),
			"desc" => __("Put to this section Twitter API 1.1 keys.<br>
			You can take them after registration your application in <strong>https://apps.twitter.com/</strong>", 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Twitter username',  'themerex'),
			"desc" => __('Your login (username) in Twitter',  'themerex'),
			"divider" => false,
			"id" => "twitter_username",
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Consumer Key',  'themerex'),
			"desc" => __('Twitter API Consumer key',  'themerex'),
			"id" => "twitter_consumer_key",
			"divider" => false,
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Consumer Secret',  'themerex'),
			"desc" => __('Twitter API Consumer secret',  'themerex'),
			"id" => "twitter_consumer_secret",
			"divider" => false,
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Token Key',  'themerex'),
			"desc" => __('Twitter API Token key',  'themerex'),
			"id" => "twitter_token_key",
			"divider" => false,
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Token Secret',  'themerex'),
			"desc" => __('Twitter API Token secret',  'themerex'),
			"id" => "twitter_token_secret",
			"divider" => false,
			"std" => "",
			"type" => "text");

$THEMEREX_options[] = array( "title" => __('Tweets to show',  'themerex'),
			"desc" => __('Number of the tweets to show in widget / footer slider',  'themerex'),
			"id" => "twitter_count",
			"divider" => false,
			"std" => 5,
			"min" => 1,
			"max" => 10,
			"type" => "spinner");



//###############################
//#### Search parameters     #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Search', 'themerex'),
			"id" => "partition_search",
			"icon" => "iconadmin-search-1",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Search parameters', 'themerex'),
			"desc" => __('Enable/disable AJAX search and output settings for it', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Show search field', 'themerex'),
			"desc" => __('Show search field in top area and sidemenus', 'themerex'),
			"id" => "show_search",
			"divider" => false,
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Enable AJAX search', 'themerex'),
			"desc" => __('Use incremental AJAX search for the search field in top of page', 'themerex'),
			"id" => "use_ajax_search",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Min search string length',  'themerex'),
			"desc" => __('The minimum length of the search string',  'themerex'),
			"id" => "ajax_search_min_length",
			"std" => 4,
			"min" => 3,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Delay before search (in ms)',  'themerex'),
			"desc" => __('How much time (in milliseconds, 1000 ms = 1 second) must pass after the last character before the start search',  'themerex'),
			"id" => "ajax_search_delay",
			"std" => 500,
			"min" => 300,
			"max" => 1000,
			"increment" => 100,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __('Search area', 'themerex'),
			"desc" => __('Select post types, what will be include in search results. If not selected - use all types.', 'themerex'),
			"id" => "ajax_search_types",
			"std" => "",
			"options" => $posts_types,
			"multiple" => true,
			"style" => "list",
			"type" => "select");

$THEMEREX_options[] = array( "title" => __('Posts number in output',  'themerex'),
			"desc" => __('Number of the posts to show in search results',  'themerex'),
			"id" => "ajax_search_posts_count",
			"std" => 5,
			"min" => 1,
			"max" => 10,
			"type" => "spinner");

$THEMEREX_options[] = array( "title" => __("Show post's image", 'themerex'),
			"desc" => __("Show post's thumbnail in the search results", 'themerex'),
			"id" => "ajax_search_posts_image",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __("Show post's date", 'themerex'),
			"desc" => __("Show post's publish date in the search results", 'themerex'),
			"id" => "ajax_search_posts_date",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __("Show post's author", 'themerex'),
			"desc" => __("Show post's author in the search results", 'themerex'),
			"id" => "ajax_search_posts_author",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __("Show post's counters", 'themerex'),
			"desc" => __("Show post's counters (views, comments, likes) in the search results", 'themerex'),
			"id" => "ajax_search_posts_counters",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");



//###############################
//#### Service               #### 
//###############################
$THEMEREX_options[] = array( "title" => __('Service', 'themerex'),
			"id" => "partition_service",
			"icon" => "iconadmin-wrench",
			"type" => "partition");

$THEMEREX_options[] = array( "title" => __('Theme functionality', 'themerex'),
			"desc" => __('Basic theme functionality settings', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Notify about new registration', 'themerex'),
			"desc" => __('Send E-mail with new registration data to the contact email or to site admin e-mail (if contact email is empty)', 'themerex'),
			"id" => "notify_about_new_registration",
			"divider" => false,
			"std" => "no",
			"dir" => "horizontal",
			"options" => array(
				'no'    => __('No', 'themerex'),
				'both'  => __('Both', 'themerex'),
				'admin' => __('Admin', 'themerex'),
				'user'  => __('User', 'themerex')
			),
			"type" => "radio");

$THEMEREX_options[] = array( "title" => __('Use AJAX post views counter', 'themerex'),
			"desc" => __('Use javascript for post views count (if site work under the caching plugin) or increment views count in single page template', 'themerex'),
			"id" => "use_ajax_views_counter",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Additional filters in the admin panel', 'themerex'),
			"desc" => __('Show additional filters (on post formats, tags and categories) in admin panel page "Posts". <br>Attention! If you have more than 2.000-3.000 posts, enabling this option may cause slow load of the "Posts" page! If you encounter such slow down, simply open Appearance - Theme Options - Service and set "No" for this option.', 'themerex'),
			"id" => "admin_add_filters",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Enable Dummy Data Installer', 'themerex'),
			"desc" => __('Show "Install Dummy Data" in the menu "Appearance". <b>Attention!</b> When you install dummy data all content of your site will be replaced!', 'themerex'),
			"id" => "admin_dummy_data",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Enable Update Notifier', 'themerex'),
			"desc" => __('Show update notifier in admin panel. <b>Attention!</b> When this option is enabled, the theme periodically (every few hours) will communicate with our server, to check the current version. When the connection is slow, it may slow down Dashboard.', 'themerex'),
			"id" => "admin_update_notifier",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Enable Custom Menu Builder', 'themerex'),
			"desc" => __('Allow to use "AxiomThemes Custom Menu" for create Unique menu style. When this option is enabled, in "Appearance - Menus" the menu items of the first level will be an additional setting for selecting the style of each menu item', 'themerex'),
			"id" => "custom_menu",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Enable Emailer in the admin panel', 'themerex'),
			"desc" => __('Allow to use AxiomThemes Emailer for mass-volume e-mail distribution and management of mailing lists in "Appearance - Emailer"', 'themerex'),
			"id" => "admin_emailer",
			"std" => "yes",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Enable PO Composer in the admin panel', 'themerex'),
			"desc" => __('Allow to use "PO Composer" for edit language files in this theme (in the "Appearance - PO Composer")', 'themerex'),
			"id" => "admin_po_composer",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");
			
$THEMEREX_options[] = array( "title" => __('Remove line breaks around shortcodes', 'themerex'),
			"desc" => __('Do you want remove spaces and line breaks around shortcodes? <b>Be attentive!</b> This option thoroughly tested on our theme, but may affect third party plugins.', 'themerex'),
			"id" => "clear_shortcodes",
			"std" => "no",
			"options" => $yes_no,
			"type" => "switch");

$THEMEREX_options[] = array( "title" => __('Google tags manager or Google analitics code',  'themerex'),
			"desc" => __('Put here Google Tags Manager (GTM) code from your account: Google analitics, remarketing, etc. This code will be placed after open body tag.',  'themerex'),
			"id" => "gtm_code",
			"cols" => 80,
			"rows" => 20,
			"std" => "",
			"type" => "textarea");

$THEMEREX_options[] = array( "title" => __('Google remarketing code',  'themerex'),
			"desc" => __('Put here Google Remarketing code from your account. This code will be placed before close body tag.',  'themerex'),
			"id" => "gtm_code2",
			"divider" => false,
			"cols" => 80,
			"rows" => 20,
			"std" => "",
			"type" => "textarea");

$THEMEREX_options[] = array( "title" => __('Clear Wordpress cache', 'themerex'),
			"desc" => __('For example, it recommended after activating the WPML plugin - in the cache are incorrect data about the structure of categories and your site may display "white screen". After clearing the cache usually the performance of the site is restored.', 'themerex'),
			"type" => "info");

$THEMEREX_options[] = array( "title" => __('Clear cache', 'themerex'),
			"desc" => __('Clear Wordpress cache data', 'themerex'),
			"id" => "clear_cache",
			"divider" => false,
			"icon" => "iconadmin-trash-1",
			"action" => "clear_cache",
			"type" => "button");



// Load current values for all theme options
load_theme_options();

//----------------------------------------------------------------------------------
// Load all theme options
//----------------------------------------------------------------------------------
function load_theme_options() {
	global $THEMEREX_options, $THEMEREX_options_hash;
	$options = get_option('themerex_options', array());
	foreach ($THEMEREX_options as $k => $item) {
		if (isset($item['std'])) {
			$THEMEREX_options_hash[$item['id']] = $k;
			if (isset($options[$item['id']]))
				$THEMEREX_options[$k]['val'] = $options[$item['id']];
			else
				$THEMEREX_options[$k]['val'] = $item['std'];
		}
	}
}


//----------------------------------------------------------------------------------
// Get custom options arrays (from current category, post, page, shop)
//----------------------------------------------------------------------------------
function load_custom_options() {
	// Theme custom settings from current post and category
	global $THEMEREX_cat_options, $THEMEREX_post_options, $THEMEREX_custom_options, $THEMEREX_shop_options, $THEMEREX_tribe_options, $wp_query;
	// Current post & category custom options
	$THEMEREX_post_options = $THEMEREX_cat_options = $THEMEREX_custom_options = $THEMEREX_shop_options = $THEMEREX_tribe_options = array();
	if (is_woocommerce_page() && ($page_id=get_option('woocommerce_shop_page_id'))>0)
		$THEMEREX_shop_options = get_post_meta($page_id, 'post_custom_options', true);
	if (is_tribe_events_page() && ($page_id=getTemplatePageId('tribe-events/default-template'))>0) {
		$THEMEREX_tribe_options = get_post_meta($page_id, 'post_custom_options', true);
	}

	if (is_category()) {
		$cat = (int) get_query_var( 'cat' );
		if (empty($cat)) $cat = get_query_var( 'category_name' );
		$THEMEREX_cat_options = get_category_inherited_properties($cat);
	} else if ((is_day() || is_month() || is_year()) && ($page_id=getTemplatePageId('archive'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (is_search() && ($page_id=getTemplatePageId('search'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (is_404() && ($page_id=getTemplatePageId('404'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (function_exists('is_bbpress') && is_bbpress() && ($page_id=getTemplatePageId('bbpress'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (function_exists('is_buddypress') && is_buddypress() && ($page_id=getTemplatePageId('buddypress'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (is_attachment() && ($page_id=getTemplatePageId('attachment'))>0) {
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	} else if (is_single() || is_page() || is_singular() || $wp_query->is_posts_page==1) {
		// Current post custom options
		$page_id = is_single() || is_page() ? get_the_ID() : (isset($wp_query->queried_object_id) ? $wp_query->queried_object_id : getTemplatePageId('blog'));
		$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
		$THEMEREX_cat_options = get_categories_inherited_properties(getCategoriesByPostId($page_id));
	}

}


//==========================================================================================
// Check option for inherit value
//==========================================================================================
function is_inherit_option($value) {
	while (is_array($value)) {
		foreach ($value as $val) {
			$value = $val;
			break;
		}
	}
	return themerex_strtolower($value)=='inherit';	//in_array(themerex_strtolower($value), array('default', 'inherit'));
}


//==========================================================================================
// Get theme option. If not exists - try get site option. If not exist - return default
//==========================================================================================
function get_theme_option($option_name, $default = false, $options = null) {
	global $THEMEREX_options, $THEMEREX_options_hash;
	$val = false;
	if (is_array($options)) {
		if (isset($THEMEREX_options_hash[$option_name])) {
			$val = $options[$THEMEREX_options_hash[$option_name]]['val'];
		} else {
			foreach($options as $option) {
				if (isset($option['id']) && $option['id'] == $option_name) {
					$val = $option['val'];
					break;
				}
			}
		}
	} else if (isset($THEMEREX_options)) {
		if (isset($THEMEREX_options_hash[$option_name])) {
			$val = $THEMEREX_options[$THEMEREX_options_hash[$option_name]]['val'];
		} else {
			foreach($THEMEREX_options as $option) {
				if (isset($option['id']) && $option['id'] == $option_name) {
					$val = $option['val'];
					break;
				}
			}
		}
	} else {
		$options = get_option('themerex_options', array());
		if (isset($options[$option_name])) {
			$val = $options[$option_name];
		}
	}
	if ($val === false) {
		if (($val = get_option($option_name, false)) !== false) {
			return $val;
		} else {
			return $default;
		}
	} else {
		return $val;
	}
}


//================================================================================================
// Return property value from request parameters < post options < category options < theme options
//================================================================================================
function get_custom_option($name, $defa=null, $post_id=0, $cat_id=0) {
	if (isset($_GET[$name]))
		$rez = $_GET[$name];
	else {
		global $THEMEREX_custom_options, $THEMEREX_post_options, $THEMEREX_cat_options, $THEMEREX_shop_options, $THEMEREX_tribe_options;
		$hash_name = $name.'_'.$cat_id.'_'.$post_id;
		if (isset($THEMEREX_custom_options[$hash_name])) {
			$rez = $THEMEREX_custom_options[$hash_name];
		} else {
			if ($cat_id > 0) {
				$rez = get_category_inherited_property($cat_id, $name);
				if ($rez=='') $rez = get_theme_option($name, $defa);
			} else if ($post_id > 0) {
				$rez = get_theme_option($name, $defa);
				$custom_options = get_post_meta($post_id, 'post_custom_options', true);
				if (isset($custom_options[$name]) && !is_inherit_option($custom_options[$name]))
					$rez = $custom_options[$name];
				else {
					if (is_category()) {
						$categories = array();
						$categories[] = get_queried_object();
					} else
						$categories =  getCategoriesByPostId($post_id);
					$tmp = '';
					for ($cc = 0; $cc < count($categories) && (empty($tmp) || is_inherit_option($tmp)); $cc++) {
						$tmp = get_category_inherited_property(is_object($categories[$cc]) ? $categories[$cc]->term_id : $categories[$cc]['term_id'], $name);
					}
					if ($tmp!='') $rez = $tmp;
				}
			} else {
				$rez = get_theme_option($name, $defa);
				if (get_theme_option('show_theme_customizer') == 'yes') {
					$tmp = getValueGPC($name, $rez);
					if (!is_inherit_option($tmp)) {
						$rez = $tmp;
					}
				}
				if (is_woocommerce_page() && isset($THEMEREX_shop_options[$name]) && !is_inherit_option($THEMEREX_shop_options[$name])) {
					$rez = is_array($THEMEREX_shop_options[$name]) ? $THEMEREX_shop_options[$name][0] : $THEMEREX_shop_options[$name];
				}
				if (is_tribe_events_page() && isset($THEMEREX_tribe_options[$name]) && !is_inherit_option($THEMEREX_tribe_options[$name])) {
					$rez = is_array($THEMEREX_tribe_options[$name]) ? $THEMEREX_tribe_options[$name][0] : $THEMEREX_tribe_options[$name];
				}
				if (!is_single() && isset($THEMEREX_post_options[$name]) && !is_inherit_option($THEMEREX_post_options[$name])) {
					$rez = is_array($THEMEREX_post_options[$name]) ? $THEMEREX_post_options[$name][0] : $THEMEREX_post_options[$name];
				}
				if (isset($THEMEREX_cat_options[$name]) && !is_inherit_option($THEMEREX_cat_options[$name])) {
					$rez = $THEMEREX_cat_options[$name];
				}
				if (is_single() && isset($THEMEREX_post_options[$name]) && !is_inherit_option($THEMEREX_post_options[$name])) {
					$rez = is_array($THEMEREX_post_options[$name]) ? $THEMEREX_post_options[$name][0] : $THEMEREX_post_options[$name];
				}
			}
			$THEMEREX_custom_options[$hash_name] = $rez;
		}
	}
	return $rez;
}



//==========================================================================================
// Check if theme options are now used
//==========================================================================================
function is_themerex_options_used() {
	return
		(is_admin() && 
			(
			(isset($_REQUEST['action']) && ($_REQUEST['action']=='themerex_options_save' || $_REQUEST['action']=='themerex_options_import')) ||
			(themerex_strpos($_SERVER['REQUEST_URI'], 'themerex_options')!==false) ||
			(themerex_strpos($_SERVER['REQUEST_URI'], 'post-new.php')!==false) ||
			(themerex_strpos($_SERVER['REQUEST_URI'], 'post.php')!==false) ||
			(themerex_strpos($_SERVER['REQUEST_URI'], 'edit-tags.php')!==false && themerex_strpos($_SERVER['REQUEST_URI'], 'taxonomy=category')!==false) ||
			(isset($_POST['meta_box_category_nonce'])) ||
			(isset($_REQUEST['action']) && $_REQUEST['action']=='add-tag' && isset($_REQUEST['_wp_http_referer']) && themerex_strpos($_REQUEST['_wp_http_referer'], 'edit-tags.php')!==false && themerex_strpos($_REQUEST['_wp_http_referer'], 'taxonomy=category')!==false)
			)
		) 
		||
		(!is_admin() && 
			(get_theme_option("allow_editor")=='yes' && 
				(
				(is_single() && current_user_can('edit_posts', get_the_ID())) 
				|| 
				(is_page() && current_user_can('edit_pages', get_the_ID()))
				)
			)
		);
}


//-----------------------------------------------------------------------------------
// Add 'Theme options' in Admin Interface
//-----------------------------------------------------------------------------------
function themerex_options_admin_menu_item() {
	// In this case menu item "Theme Options" add in admin menu 'Appearance'
	add_theme_page(__('Theme Options', 'themerex'), __('Theme Options', 'themerex'), 'edit_theme_options', 'themerex_options', 'themerex_options_page');

	// In this case menu item "Theme Options" add in root admin menu level
	//add_menu_page(__('AxiomThemes Options', 'themerex'), __('AxiomThemes Options', 'themerex'), 'manage_options', 'themerex_options', 'themerex_options_page');

	// In this case menu item "Theme Options" add in admin menu 'Settings'
	//add_options_page(__('AxiomThemes Options', 'themerex'), __('AxiomThemes Options', 'themerex'), 'manage_options', 'themerex_options', 'themerex_options_page');
}
?>