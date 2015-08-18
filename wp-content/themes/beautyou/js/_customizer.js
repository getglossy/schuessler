// Customization panel

jQuery(document).ready(function() {
	"use strict";

	if (jQuery("#custom_options").length===1) {

		// Reset custom settings to default
		jQuery("#custom_options .co_reset_to_default" ).click(function(e) {
			"use strict";
			clearCustomCookies();
			window.location = jQuery("#custom_options #co_site_url").val();
			e.preventDefault();
			return false;
		});

		// Body and Main menu style
		jQuery("#custom_options .switcher a,#custom_options .switcher2 a" ).draggable({
			axis: 'x',
			containment: 'parent',
			stop: function() {
				var left = parseInt(jQuery(this).css('left'), 10);
				var curStyle = left < 25 ? (jQuery(this).parent().hasClass('switcher') ? 'wide' : 'right') : (jQuery(this).parent().hasClass('switcher') ? 'boxed' : 'center');
				switchBox(jQuery(this).parent(), curStyle, true);
			}
		});
		jQuery("#custom_options .switcher, #custom_options .switcher2" ).click(function(e) {
			"use strict";
			switchBox(jQuery(this));
			e.preventDefault();
			return false;
		});
		jQuery("#custom_options .co_switch_box .co_switch_label").click(function(e) {
			"use strict";
			var state = jQuery(this).hasClass('boxed') ? 'boxed' : (jQuery(this).hasClass('wide') ? 'wide' : (jQuery(this).hasClass('right') ? 'right' : 'center'));
			switchBox(jQuery(this).siblings('div'), state);
			e.preventDefault();
			return false;
		});

		// Main theme color and Background color
		iColorPicker();
		jQuery('#custom_options .iColorPicker').click(function (e) {
			"use strict";
            jQuery(this).addClass('active');
			iColorShow(null, jQuery(this), changeThemeColor);
		});

		// Background patterns
		jQuery('#custom_options #co_bg_pattern_list a').click(function(e) {
			"use strict";
			jQuery("#custom_options .co_switch_box .boxed").trigger('click');
			jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper,#custom_options #co_bg_images_list .co_image_wrapper').removeClass('current');
			var obj = jQuery(this).addClass('current');
			var val = obj.attr('id').substr(-1);
			if (THEMEREX_remember_visitors_settings) {
				jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
				jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
				jQuery.cookie('bg_pattern', val, {expires: 1, path: '/'});
			}
			jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_image_1 bg_image_2 bg_image_3 bg_image_4 bg_image_5 bg_image_6').addClass('bg_pattern_' + val);
			e.preventDefault();
			return false;
		});
		// Background images
		jQuery('#custom_options #co_bg_images_list a').click(function(e) {
			"use strict";
			jQuery("#custom_options .co_switch_box .boxed").trigger('click');
			jQuery('#custom_options #co_bg_images_list .co_image_wrapper,#custom_options #co_bg_pattern_list .co_pattern_wrapper').removeClass('current');
			var obj = jQuery(this).addClass('current');
			var val = obj.attr('id').substr(-1);
			if (THEMEREX_remember_visitors_settings) {
				jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
				jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
				jQuery.cookie('bg_image', val, {expires: 1, path: '/'});
			}
			jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_image_1 bg_image_2 bg_image_3 bg_image_4 bg_image_5 bg_image_6').addClass('bg_image_' + val);
			e.preventDefault();
			return false;
		});
		jQuery('#custom_options #co_bg_pattern_list a').hover(
			function() {
				"use strict";
				var pattern = jQuery(this).parent().attr('id')=='co_bg_pattern_list';
				jQuery(this).parent().parent().css({
					'backgroundImage': 'url('+jQuery(this).find('img').attr('src').replace('_thumb2', '_thumb')+')',
					'backgroundRepeat': pattern ? 'repeat' : 'no-repeat'
				});
			},
			function() {
				"use strict";
				jQuery(this).parent().parent().css('backgroundImage', 'none');
			}
		);

        jQuery('#custom_options #co_bg_images_list a').hover(
            function() {
                "use strict";
                var pattern = jQuery(this).parent().attr('id')=='co_bg_pattern_list';
                jQuery(this).parent().next().css({
                    'backgroundImage': 'url('+jQuery(this).find('img').attr('src').replace('_thumb2', '_thumb')+')',
                    'backgroundRepeat': 'no-repeat'
                });
            },
            function() {
                "use strict";
                jQuery(this).parent().next().css('backgroundImage', 'none');
            }
        );
	}
});


function clearCustomCookies() {
	jQuery.cookie('theme_color', null, {expires: -1, path: '/'});
	jQuery.cookie('theme_color_1', null, {expires: -1, path: '/'});
	jQuery.cookie('theme_color_2', null, {expires: -1, path: '/'});
	jQuery.cookie('theme_color_3', null, {expires: -1, path: '/'});
	jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
	jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
	jQuery.cookie('body_style', null, {expires: -1, path: '/'});
}


function switchBox(box) {
	"use strict";
	var toStyle = arguments[1] ? arguments[1] : '';
	var important = arguments[2] ? arguments[2] : false;
	var switcher = box.find('a').eq(0);
	var left = parseInt(switcher.css('left'), 10);
	var newStyle = left < 5 ? (box.hasClass('switcher') ? 'boxed' : 'center') : (box.hasClass('switcher') ? 'wide' : 'right');
	if (toStyle==='' || important || newStyle === toStyle) {
		if (toStyle==='') {toStyle = newStyle;}
		var right = box.width() - switcher.width() - 7;
		if (toStyle === 'wide' || toStyle === 'right')
			switcher.animate({left: 0}, 200);
		else
			switcher.animate({left: right}, 200);
		if (box.hasClass('switcher')) {
			if (THEMEREX_remember_visitors_settings) jQuery.cookie('body_style', toStyle, {expires: 1, path: '/'});
			jQuery(document).find('body').removeClass(toStyle==='boxed' ? 'wide' : 'boxed').addClass(toStyle);
			jQuery(window).trigger('resize');

		}
	}
	return newStyle;
}


function changeThemeColor(fld, clr) {
	"use strict";
	fld.css('backgroundColor', clr);
	fld.siblings('input').attr('value', clr);

	if (fld.attr('id')==='co_bg_color') {
		jQuery("#custom_options .co_switch_box .boxed").trigger('click');
		jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper,#custom_options #co_bg_images_list .co_image_wrapper').removeClass('current');
		if (THEMEREX_remember_visitors_settings) {
			jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_color', clr, {expires: 1, path: '/'});
		}
		jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3').css('backgroundColor', clr);
		return;
	}

	if (THEMEREX_remember_visitors_settings) {
		if (fld.attr('id')==='co_theme_color')
			jQuery.cookie('theme_color', clr, {expires: 1, path: '/'});
        else if (fld.attr('id')==='co_theme_color_1')
            jQuery.cookie('theme_color_1', clr, {expires: 1, path: '/'});
        else if (fld.attr('id')==='co_theme_color_2')
            jQuery.cookie('theme_color_2', clr, {expires: 1, path: '/'});
        else if (fld.attr('id')==='co_theme_color_3')
            jQuery.cookie('theme_color_3', clr, {expires: 1, path: '/'});
	}

	// This way - with page reload
	//window.location = jQuery("#custom_options #co_site_url").val();
	var styles = jQuery('#theme-skin-css').length > 0 ? jQuery('#theme-skin-css').next() : '';
	if (styles.length == 0 || styles.attr('type')!='text/css') styles = jQuery('#packed-styles-css').length > 0 ? jQuery('#packed-styles-css').next() : '';
	if (styles.length == 0 || styles.attr('type')!='text/css') styles = jQuery('#shortcodes-css').length > 0 ? jQuery('#shortcodes-css').next() : '';
	if (styles.length > 0 && styles.attr('type')=='text/css') {

        // Apply skin filters

        clr = rgb2hex(jQuery('#co_theme_color').css('backgroundColor'));
		var rgb = hex2rgb(clr);
		var css_text =
			    // Main color for site
                'a:hover, .theme_accent, .theme_accent:before, .openResponsiveMenu:hover > span:before, .topTabsWrap .speedBar a:hover, .topWrap .topMenuStyleLine > ul > li ul li a:hover, .topWrap .topMenuStyleLine .current-menu-item > a, .topWrap .topMenuStyleLine .current-menu-ancestor > a, .topWrap .topMenuStyleLine > ul li a:hover, .topWrap .topMenuStyleLine > ul li.sfHover > a, .infoPost a:hover, .tabsButton ul li a:hover, .popularFiltr ul li a:hover, .isotopeFiltr ul li a:hover, .widget_popular_posts article h3:before, .widgetTabs .widget_popular_posts article .post_info .post_date a:hover, .sidebar .widget_popular_posts article .post_info .post_date a:hover, .sidebar .widget_recent_posts article .post_info .post_date a:hover, .main .widgetWrap a:hover, .main .widgetWrap a:hover span, .widgetWrap a:hover span, .roundButton:hover a, input[type="submit"]:hover, input[type="button"]:hover, .squareButton > a:hover, .nav_pages_parts > a:hover, .nav_comments > a:hover, .comments_list a.comment-edit-link:hover, .wp-calendar tbody td.today a:hover, blockquote.sc_quote_style_2 a:hover, .postLink a, .masonry article .masonryInfo a:hover, .masonry article .masonryInfo span.infoTags a:hover, .relatedPostWrap article .relatedInfo a:hover, .relatedPostWrap article .relatedInfo span.infoTags a:hover, .infoPost span.infoTags a:hover, .page404 p a, .page404 .searchAnimation.sFocus .searchIcon, .copyWrap a, .comments .commBody li.commItem .replyWrap .posted a:hover, .comments .commBody li.commItem h4 a:hover, .ratingItem span:before, .reviewBlock .totalRating, .widget_area .contactInfo .fContact:before, .footerStyleLight .widget_area article .post_title:before, .footerStyleLight .widget_area article .post_info a:hover, .footerStyleLight .widget_area article .post_info .post_date a:hover, .sc_list_style_arrows li:before, .sc_list_style_arrows li a:hover, .sc_list_style_iconed li a:hover, .sc_toggles.sc_toggles_style_2 .sc_toggles_item.sc_active .sc_toggles_title, .sc_toggles.sc_toggles_style_2 .sc_toggles_item.sc_active .sc_toggles_title:before, .sc_tabs .sc_tabs_titles li a:hover, .sc_highlight.sc_highlight_style_2, .sc_pricing_table .sc_pricing_columns ul li .sc_icon, .sc_title_icon, .sc_scroll_controls .flex-direction-nav a:hover:before, .sc_testimonials_style_1 .flex-direction-nav a:hover:before, .sc_testimonials_style_3 .flex-direction-nav a:hover:before, .sc_testimonials_style_3 .flex-direction-nav a:active:before, .pagination .pageLibrary > li.libPage > .pageFocusBlock .flex-direction-nav a:hover:before, .topWrap .usermenu_area ul.usermenu_list li.usermenu_currency > a:hover, .topWrap .usermenu_area ul.usermenu_list li.usermenu_currency.sfHover > a, .topWrap .usermenu_area ul.usermenu_list li ul li a:hover, .topWrap .usermenu_area ul.usermenu_list li.usermenu_cart .widget_area ul li a:hover, .topWrap .usermenu_area a:hover, .topWrap .usermenu_area .sfHover a, .sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_currency > a:hover, .sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_currency.sfHover > a, .sidemenu_wrap .usermenu_area ul.usermenu_list li ul li a:hover, .sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_cart .widget_area ul li a:hover, .sc_blogger a:hover, .sc_blogger.style_date .load_more:before, .sc_blogger.style_accordion .sc_blogger_info .comments_number, .widgetTabs .widgetTop ul > li:not(.tabs):before, .widgetTabs .widgetTop ul > li:not(.tabs) > a:hover, .widgetTabs .widgetTop ul > li:not(.tabs) > a:hover span, .widgetTabs .widgetTop.widget_popular_posts article .post_title:before, .swpRightPos .tabsMenuBody a:hover, .swpRightPos .tabsMenuBody a:hover:before, .swpRightPos .panelmenu_area .current-menu-item > a, .swpRightPos .panelmenu_area .current-menu-ancestor > a, .swpRightPos .panelmenu_area > ul li a:hover, .swpRightPos .panelmenu_area > ul li.sfHover > a, .swpRightPos .panelmenu_area .current-menu-item.dropMenu:before, .swpRightPos .panelmenu_area .current-menu-ancestor.dropMenu:before, .swpRightPos .panelmenu_area li.liHover.dropMenu:before, .topWrap .search:not(.searchOpen):hover:before, .topWrap .search .searchSubmit:hover .icoSearch:before, .user-popUp .formItems.loginFormBody .remember .forgotPwd, .user-popUp .formItems.loginFormBody .loginProblem, .user-popUp .formItems.registerFormBody .i-agree a, .sc_slider_pagination_area .flex-control-nav.manual .slide_info .slide_title, #toc .toc_item.current .toc_icon, #toc .toc_item:hover .toc_icon, .openResponsiveMenu:hover, .openResponsiveMenu:hover:before, .postLink a, .widgetWrap ul li.liHover:before, .widgetWrap  a:hover, .widgetWrap  a:active, .widget_area .widgetWrap ul > li > a:hover, .widget_area .widgetWrap ul > li > a:hover span, .widget_area ul.tabs > li.ui-state-active > a, .widget_area article span:before, .sc_team .sc_team_item .sc_team_item_position, .sidebarStyleLight .widgetWrap ul li.liHover:before, .sidebarStyleLight .widgetWrap  a:hover, .sidebarStyleLight .widgetWrap  a:active, .sidebarStyleLight.widget_area .widgetWrap a:hover span, .sidebarStyleLight.widget_area .widgetWrap a:hover, .sidebarStyleLight.widget_area .widgetWrap ul > li > a:hover, .sidebarStyleLight.widget_area .widgetWrap ul > li > a:hover span, .sidebarStyleLight.widget_area ul.tabs > li.ui-state-active > a, .sidebarStyleLight.widget_area a:hover, .sidebarStyleLight.widget_area a:hover span, .sidebarStyleLight.widget_area .ui-state-active a, .sidebarStyleLight.widget_area .widgetWrap ul li a:hover, .sidebarStyleLight.widget_area .widget_twitter ul li:before, .sidebarStyleLight .wp-calendar tfoot th a:before, .sidebarStyleLight.widget_area table.wp-calendar tfoot a:hover, .sidebarStyleLight.widget_area article span:before, .sidebarStyleLight.widget_area .widgetWrap ul > li.dropMenu:hover:before, .sidebarStyleLight.widget_area .widgetWrap ul > li.dropMenu.dropOpen:before, .sc_pricing_dark .sc_pricing_columns:hover ul.columnsAnimate .sc_pricing_data > span, .sidebarStyleDark.widget_area a:hover, .sidebarStyleDark.widget_area a:hover span, .sidebarStyleDark.widget_area a:hover, .sidebarStyleDark.widget_area .ui-state-active a, .sidebarStyleDark.widget_area .widgetWrap ul li a:hover, .sidebarStyleDark.widget_area .widget_twitter ul li:before, .sidebarStyleDark .wp-calendar tfoot th a:before, .sidebarStyleDark.widget_area table.wp-calendar tfoot a:hover, .sidebarStyleDark.widget_area .widgetWrap ul > li.dropMenu:hover:before, .sidebarStyleDark.widget_area .widgetWrap ul > li.dropMenu.dropOpen:before, .sidebarStyleDark.widget_area .widgetWrap a:hover, .sidebarStyleDark.widget_area .widgetWrap .post_info a:hover, #sidebar_main.sidebarStyleDark .widget_layered_nav ul li.chosen a:before, #sidebar_main.sidebarStyleDark .widget_layered_nav ul li a:hover:before, #sidebar_main.sidebarStyleDark .widget_layered_nav_filters ul li a:hover:before, #sidebar_main.sidebarStyleDark .widget_layered_nav_filters ul li.chosen a:before, .postSharing > ul > li> a:before, .post .tagsWrap .post_cats a:hover, .post .tagsWrap .post_tags a:hover, .post_text_area .tagsWrap .post_cats a:hover, .post_text_area .tagsWrap .post_tags a:hover, .infoPost > span:before, .infoPost > span a:before, .comments .commBody li.commItem .replyWrap a:hover, .relatedPostWrap .no_indent_style article .wrap a:hover, .portfolBlock ul li a:hover, .swpRightPos .searchBlock .searchSubmit:hover:before, .twitBlock .sc_slider .swiper-slide a:hover, .twitBlockWrap .twitterAuthor a:hover, .relatedPostWrap.sc_blogger article .relatedInfo a:hover, .sc_blogger.style_date .sc_blogger_item .sc_blogger_info a:hover, .sc_tabs ul.sc_tabs_titles li.ui-tabs-active a, .sc_tabs ul.sc_tabs_titles li a:hover, .copyWrap .copy .copyright > a:hover, ul#mainmenu .menu-panel.thumb_title > li > ul > li > ul li a:before, .topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button:hover, .topWrap .sidebar_cart ul.cart_list li > a:hover, .topWrap .cart .cart_button:hover:before, .topWrap .usermenu_area ul.usermenu_list li.usermenu_controlPanel.sfHover > a:before, .topWrap .usermenu_area ul.usermenu_list li.usermenu_controlPanel > a:hover:before, .topWrap .cart .cart_button:hover, .topWrap .usermenu_area .search .ajaxSearchResults a:hover, .topWrap .usermenu_area ul.usermenu_list li.usermenu_socials > a:hover, .tribe-events-calendar div[id*="tribe-events-daynum-"], .tribe-events-calendar div[id*="tribe-events-daynum-"] a, .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"], .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a, .menuSearch .searchSubmit:hover:before, .sidemenu_wrap .sidemenu_area .current-menu-item > a, .sidemenu_wrap .sidemenu_area .current-menu-ancestor > a, .sidemenu_wrap .sidemenu_area > ul li a:hover, .sidemenu_wrap .sidemenu_area > ul li.sfHover > a, .sidemenu_wrap .sidemenu_area .current-menu-item.dropMenu:before, .sidemenu_wrap .sidemenu_area .current-menu-ancestor.dropMenu:before, .sidemenu_wrap .sidemenu_area li.liHover.dropMenu:before'
                // Main color for WooC
                +',.woocommerce ul.products li.product .added_to_cart, .woocommerce-page ul.products li.product .added_to_cart, .woocommerce .woocommerce-breadcrumb a:hover, .woocommerce-page .woocommerce-breadcrumb a:hover, .woocommerce .star-rating span:before, .woocommerce-page .star-rating span:before, .woocommerce a.reset_variations, .woocommerce-page a.reset_variations, .woocommerce .sidebarStyleDark.widget_area .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .sidebarStyleDark.widget_area .widget_price_filter .price_slider_amount .button:hover, .woocommerce .sidebarStyleDark.widget_area.widget_area aside.widgetWrap.woocommerce .button:hover, .woocommerce-page .sidebarStyleDark.widget_area.widget_area aside.widgetWrap.woocommerce .button:hover, .woocommerce .sidebarStyleDark.widget_area .widget_layered_nav ul li.chosen a, .woocommerce-page .sidebarStyleDark.widget_area .widget_layered_nav ul li.chosen a, .woocommerce div.product span.price, .woocommerce div.product p.price, .woocommerce #content div.product span.price, .woocommerce #content div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce ul.cart_list li > .amount, .woocommerce ul.product_list_widget li > .amount, .woocommerce-page ul.cart_list li > .amount, .woocommerce-page ul.product_list_widget li > .amount, .woocommerce ul.cart_list li span .amount, .woocommerce ul.product_list_widget li span .amount, .woocommerce-page ul.cart_list li span .amount, .woocommerce-page ul.product_list_widget li span .amount, .woocommerce ul.cart_list li ins .amount, .woocommerce ul.product_list_widget li ins .amount, .woocommerce-page ul.cart_list li ins .amount, .woocommerce-page ul.product_list_widget li ins .amount, .woocommerce.widget_shopping_cart .total .amount, .woocommerce .widget_shopping_cart .total .amount, .woocommerce-page.widget_shopping_cart .total .amount, .woocommerce-page .widget_shopping_cart .total .amount, .woocommerce ul.products li.product .price > .amount, .woocommerce ul.products li.product .price ins .amount, .woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price'
                +' { color: '+clr+'; }'

				// Main color for site !important
                +'.footerContentWrap .googlemap_button:after, .days_container_all .booking_day_slots, .sidebarStyleDark.widget_area a:hover span, .topWrap .topMenuStyleLine > ul > li ul li a:hover, .flip-clock-wrapper ul li a div div.inn'
                // Main color for WooC
                +',.woocommerce .woocommerce-info a:after, .woocommerce-page .woocommerce-info a:after, .woocommerce .woocommerce-info a, .woocommerce-page .woocommerce-info a, .woocommerce p.stars a:hover.star-1:after, .woocommerce p.stars a:hover.star-1.active:after, .woocommerce-page p.stars a:hover.star-1:after, .woocommerce-page p.stars a.star-1.active:after, .woocommerce p.stars a:hover.star-2:after, .woocommerce p.stars a.star-2.active:after, .woocommerce-page p.stars a:hover.star-2:after, .woocommerce-page p.stars a.star-2.active:after, .woocommerce p.stars a:hover.star-3:after, .woocommerce p.stars a.star-3.active:after, .woocommerce-page p.stars a:hover.star-3:after, .woocommerce-page p.stars a.star-3.active:after, .woocommerce p.stars a:hover.star-4:after, .woocommerce p.stars a.star-4.active:after, .woocommerce-page p.stars a:hover.star-4:after, .woocommerce-page p.stars a.star-4.active:after, .woocommerce p.stars a.star-5:hover:after, .woocommerce p.stars a.star-5.active:after, .woocommerce-page p.stars a:hover.star-5:after, .woocommerce-page p.stars a.star-5.active:after, .woocommerce .widget_shopping_cart .cart_list li a.remove:hover, .woocommerce.widget_shopping_cart .cart_list li a.remove:hover, .topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button:hover, .topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button.checkout:hover'
                +' { color: '+clr+' !important; }'

				// Background color for site
				+'.theme_accent_bgc, .theme_accent_bgc:before, .sc_video_player:active .sc_video_play_button:after, input[type="submit"]:active, input[type="button"]:active, .squareButton.active > span, .squareButton.active > a, .squareButton.ui-state-active > a, .roundButton > a:active, .squareButton > a:active, .squareButton.global > a, .nav_pages_parts > span.page_num, .nav_comments > span.current, ul > li.likeActive:active > a, .masonry article .status, .portfolio .isotopeElement .folioShowBlock:before, .itemPageFull .itemDescriptionWrap .toggleButton:active, .footerWrap .footerWidget .sc_video_player:active .sc_video_play_button:after, .topMenuStyleLine > ul .menu-panel, .sliderLogo .elastislide-wrapper nav span:active:before, .sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap, .sc_highlight.sc_highlight_style_1, .sc_title_bg, .sc_testimonials_style_1 .flex-direction-nav a:active, .sc_testimonials_style_3 .sc_testimonials_items, .sc_testimonials_style_3 .flex-direction-nav li, .sc_testimonials_style_3 .flex-direction-nav a, .pagination .pageLibrary > li.libPage > .pageFocusBlock .flex-direction-nav a:active, .sc_popup_light:before, .global_bg, .widgetTabs .widgetTop .tagcloud a:hover, .widgetTabs .widgetTop .tagcloud a:active, .fullScreenSlider.globalColor .sliderHomeBullets .rsContent:before, .fullScreenSlider .sliderHomeBullets .rsContent .slide-3 .order p span, ul.sc_list_style_disk li:before, .sc_slider_pagination_area .flex-control-nav.manual .slide_date, .sc_contact_form_custom .bubble label:hover, .sc_contact_form_custom .bubble label.selected, .sc_quote_style_1, .sc_team .sc_team_item .team_item_link > a:hover, .sidebarStyleLight.widget_area .instagram-pics li a:after, .sidebarStyleLight.widget_area .flickr_images .flickr_badge_image a:after, .sidebarStyleLight .wp-calendar tbody td a:hover, .sidebarStyleLight .wp-calendar tbody td a:hover, .sidebarStyleLight .wp-calendar tbody td.today > span, .sidebarStyleLight .wp-calendar tbody td.today a, .footerStyleLight .contactFooter .contactShare ul li a:hover, .page404 .titleError > span, .isotopeFiltr ul a .data_count, .squareButton.border > a:hover, .squareButton.border > a:active, .widget_area .instagram-pics li a:after, .widget_area .flickr_images .flickr_badge_image a:after, .wp-calendar tbody td a:hover, .wp-calendar tbody td a:hover, .wp-calendar tbody td.today > span, .widgetWrap .tagcloud a:hover, .widgetWrap .tagcloud a:active, .widget_socials .socPage ul li a, .footerStyleDark .contactFooter .contactShare ul li a, .postAside, #pagination .squareButton.active span, #pagination .squareButton a:hover, #pagination .squareButton a:active, #viewmore_link:hover, #viewmore_link:active, ul > li.share > ul.shareDrop > li > a, .author .socPage ul li a, .sc_pricing_dark .sc_pricing_columns .sc_pricing_title, .sc_pricing_dark .sc_pricing_columns:hover ul.columnsAnimate li.sc_pricing_title, .sc_pricing_dark .sc_pricing_columns ul li.sc_pricing_price, .sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title:before, #tribe-bar-form .tribe-bar-submit input[type="submit"], #tribe-events .tribe-events-button, #tribe-events .tribe-events-button:hover, #tribe_events_filters_wrapper input[type="submit"], .tribe-events-button, .tribe-events-button.tribe-active:hover, .tribe-events-button.tribe-inactive, .tribe-events-button:hover, .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"], .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a, .footerContentWrap .googlemap_button'
				// Background color for WooC
                +',.woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button.checkout'
				+' { background-color: '+clr+'; }'

                // Background color for site !important
                +'.booking_day_container.booking_day_black a, #booking_submit_button.booking_book_now_custom'
                // Background color for WooC
                +',.woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce .woocommerce-message a.button, .woocommerce .woocommerce-error a.button, .woocommerce .woocommerce-info a.button, .woocommerce-page .woocommerce-message a.button, .woocommerce-page .woocommerce-error a.button, .woocommerce-page .woocommerce-info a.button'
                +' { background-color: '+clr+' !important; }'

                // Border color for site
                +'.theme_accent_border, .sidebarStyleLight .widgetWrap .tagcloud a:hover, .sidebarStyleLight .widgetWrap .tagcloud a:active, .sidebarStyleLight.widget_area .tabs_area ul.tabs > li > a:hover, .sidebarStyleLight.widget_area .tagcloud a:hover, .sidebarStyleLight.widget_area .tagcloud a:active, .sidebarStyleLight.widget_area ul.tabs > li.ui-state-active > a, .sidebarStyleLight.widget_area .wp-calendar tbody a:hover, #toc .toc_item.current, #toc .toc_item:hover, .topWrap .search:not(.searchOpen):hover, .upToScroll > a:hover, .sc_scroll_controls .flex-direction-nav a:active, .sc_scroll_controls .flex-direction-nav a:hover, .sc_testimonials_style_1 .flex-direction-nav a:active, .pagination .flex-direction-nav a:active .topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button:hover, .openResponsiveMenu:hover, blockquote.sc_quote_style_2, .squareButton.border > a:hover, .squareButton.border > a:active, #pagination .squareButton.active span, #pagination .squareButton a:hover, #pagination .squareButton a:active, #viewmore_link:hover, #viewmore_link:active, .sc_pricing_dark .sc_pricing_columns:hover ul.columnsAnimate, .topWrap .usermenu_area ul.usermenu_list li.usermenu_socials > a:hover, .topWrap .usermenu_area ul.usermenu_list li.usermenu_controlPanel > a:hover:before, .topWrap .usermenu_area ul.usermenu_list li.usermenu_controlPanel.sfHover > a:before, .sidebarStyleDark.widget_area .tagcloud a:hover, .sidebarStyleDark.widget_area .tagcloud a:active'
                // Border color for WooC
                +',.topWrap .cart .cart_button:hover:before, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce .sidebarStyleDark.widget_area .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .sidebarStyleDark.widget_area .widget_price_filter .price_slider_amount .button:hover, .woocommerce .sidebarStyleDark.widget_area aside.widgetWrap.woocommerce .button:hover, .woocommerce-page .sidebarStyleDark.widget_area aside.widgetWrap.woocommerce .button:hover, #sidebar_main.sidebarStyleDark.widget_area .widget_layered_nav ul li a:hover:before, .woocommerce #sidebar_main .sidebarStyleDark.widget_area .widget_layered_nav ul li.chosen a:before, .woocommerce-page #sidebar_main.sidebarStyleDark.widget_area .widget_layered_nav ul li.chosen a:before, #sidebar_main.sidebarStyleDark .widget_layered_nav_filters ul li.chosen a:before, #sidebar_main.sidebarStyleDark .widget_layered_nav_filters ul li a:hover:before'
                +' {border-color: '+clr+'; }'

                // Border color for site !important
                +'.topWrap .sidebar_cart .widget_shopping_cart_content .buttons > a:hover'
                +' {border-color: '+clr+' !important; }'

                // Background
                +'.theme_accent_bg, .theme_accent_bg:before'
                +' { background:'+clr+'; }'

				// Transparent background color for site
                +'.sc_table table tr:hover'
                +' { background-color: rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.15); }'

                +'::selection'
                +' { background-color: '+clr+'; }'

                +'::-moz-selection'
                +' { background-color: '+clr+'; }';

		if (window.theme_skin_set_theme_color)
			css_text = theme_skin_set_theme_color(css_text, clr);

        // theme color 1
        clr = rgb2hex(jQuery('#co_theme_color_1').css('backgroundColor'));
        rgb = hex2rgb(clr);

        css_text +=
            // Color 1 for site
            '.theme_accent_1, .sc_events .startDate, .theme_accent_1:before, .twitBlock .sc_slider .swiper-slide a, .twitBlock .sc_slider .swiper-slide .twitterIco:before, .twitBlock .sc_slider .swiper-slide a, .twitBlockWrap .twitterAuthor a'
            +' { color: '+clr+'; }'

            // Background color 1 for site
            +'.sc_dropcaps.sc_dropcaps_style_4 .sc_dropcap, .squareButton.accent_1 > a, .theme_accent_1_bgc, .theme_accent_1_bgc:before, .postStatus, .hoverIncreaseOut .hoverShadow, .hoverIncreaseIn .hoverShadow, .hoverIncrease .hoverShadow, .sc_team .sc_team_item .sc_team_item_avatar:after, .woocommerce ul.products li.product:hover .button, .woocommerce-page ul.products li.product:hover .button'
            +' { background-color: '+clr+'; }'

            // Background color 1 for site !important
            +'#booking_calendar_container .booking_day_white a:hover, #form_container_all .booking_clear_custom'
            // Background color 1 for WooC
            +',.woocommerce form .button, .woocommerce-page form .button'
            +' { background-color: '+clr+' !important; }'

            // Background
            +'.theme_accent_1_bg, .theme_accent_1_bg:before, .woocommerce span.new, .woocommerce-page span.new, .woocommerce span.onsale, .woocommerce-page span.onsale'
            +' { background:'+clr+'; }'

            // Background for WooC !important
            +'.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #content table.cart td.actions .button:hover, .woocommerce table.cart td.actions .button:hover, .woocommerce #content table.cart td.actions .button:active, .woocommerce table.cart td.actions .button:active, .woocommerce #content table.cart td.actions .button.checkout-button, .woocommerce table.cart td.actions .button.checkout-button, .woocommerce .shipping-calculator-form .button:hover, .woocommerce .shipping-calculator-form .button:active, .return-to-shop .button:hover, .return-to-shop .button:active, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:hover, .woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover, .woocommerce .woocommerce-message a.button:hover, .woocommerce .woocommerce-error a.button:hover, .woocommerce .woocommerce-info a.button:hover, .woocommerce-page .woocommerce-message a.button:hover, .woocommerce-page .woocommerce-error a.button:hover, .woocommerce-page .woocommerce-info a.button:hover, .woocommerce #content table.cart td.actions .button.checkout-button:hover, .woocommerce table.cart td.actions .button.checkout-button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover, .woocommerce form .button:hover, .woocommerce-page form .button:hover'
            +' { background: '+clr+' !important; }';

        if (window.theme_skin_set_theme_color_1)
            css_text = theme_skin_set_theme_color_1(css_text, clr);

        // theme color 2
        clr = rgb2hex(jQuery('#co_theme_color_2').css('backgroundColor'));
        rgb = hex2rgb(clr);

        css_text +=
            // Color 2 for site
            '.theme_accent_2, .theme_accent_2:before, .sc_tooltip_parent, .hoverIncrease .hoverIcon:hover:before, .sc_video_player .sc_video_play_button:hover:after, .sc_video_player:active .sc_video_play_button:hover:after, .sc_accordion.sc_accordion_style_1 .sc_accordion_item.sc_active .sc_accordion_title, .sc_toggles.sc_toggles_style_1 .sc_toggles_item.sc_active .sc_toggles_title, .sc_team .sc_team_item .sc_team_item_avatar .sc_team_item_socials li a:hover, .hoverIncrease .hoverIcon:hover:before, .hoverIncrease .hoverLink:hover:before, .sc_accordion.sc_accordion_style_2 .sc_accordion_item.sc_active .sc_accordion_title, blockquote.sc_quote_title a:hover, blockquote.sc_quote_style_1 a:hover, .wrap_hover h4 a:hover, .wrap_hover .post_date:hover, .wrap_hover .hoverIcon > a:hover:before'
            +' { color: '+clr+'; }'

            // Color 2 for site !important
            +'.relatedPostWrap.sc_blogger article a.readmore_blogger:hover'
            +' { color: '+clr+' !important; }'

            // Background color 2 for site
            +'.theme_accent_2_bgc, .theme_accent_2_bgc:before, .sc_tooltip_parent .sc_tooltip, .sc_tooltip_parent .sc_tooltip:before, .sc_dropcaps.sc_dropcaps_style_3 .sc_dropcap, .sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title:before, .sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title:before, .squareButton.accent_2 > a, .sc_skills_bar .sc_skills_item .sc_skills_count, .sc_skills_counter .sc_skills_item.sc_skills_style_3 .sc_skills_count, .sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_count, .sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_info, .relatedPostWrap .wrap:before, .relatedPostWrap.sc_blogger .wrap:hover:before, .portfolioWrap .isotopePadding:before, .user-popUp .formItems .formList li .sendEnter, .user-popUp ul.loginHeadTab li.ui-tabs-active:before, .sc_blogger.style_date .sc_blogger_item .sc_blogger_date, .sc_scroll_bar .swiper-scrollbar-drag:before, .sc_blogger.sc_blogger_vertical.style_date.sc_scroll_controls ul.flex-direction-nav li a:hover, .audio_container, .copyWrap, .sidebarStyleDark, .footerWrap.footerStyleDark, .sidebarStyleLight .widget_socials .socPage ul li a:hover, .postLink, ul > li.share > ul.shareDrop > li > a:hover, .author .socPage ul li a:hover, .sc_team .sc_team_item .team_item_link > a, .sc_pricing_dark .sc_pricing_columns ul li, .sc_pricing_table .sc_pricing_columns ul, .topWrap .usermenu_area'
            // Background color 2 for WooC
            +',.woocommerce .widget_area aside.widgetWrap.woocommerce .button, .woocommerce-page .widget_area aside.widgetWrap.woocommerce  .button'
            +' { background-color: '+clr+'; }'

            // Background color 2 for site !important
            +'a.sc_icon.bg_icon.sc_icon_round:hover, a.sc_icon.no_bg_icon.sc_icon_round:hover'
            +' { background-color: '+clr+' !important; }'

            // Background
            +'.theme_accent_2_bg, .theme_accent_2_bg:before'
            +' { background:'+clr+'; }'

            // Border color 2 for site
            +'.postSharing > ul > li > a:active, .postSharing > ul > li > span:active, .roundButton > a:active, .nav_pages_parts > span.page_num, .nav_comments > span.current, .itemPageFull .itemDescriptionWrap .toggleButton:active, .footerWidget .sc_video_player:active .sc_video_play_button:after, .sliderLogo .elastislide-wrapper nav span:active:before, pre.code, .sc_tooltip_parent, .sc_googlemap'
            +' {border-color: '+clr+'; }'

            // Background color 2 for WooC
            +'.woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button:hover, .woocommerce .widget_area aside.widgetWrap.woocommerce .button:hover, .woocommerce-page .widget_area aside.widgetWrap.woocommerce  .button:hover, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce-page .widget_price_filter .price_slider_amount .button'
            +' { background: '+clr+' !important; }'

            // Transparent background color 2 for site
            +'.sc_slider_flex .sc_slider_info, .sc_slider_swiper .sc_slider_info, .user-popUp .formItems .formList li .sendEnter:hover, .user-popUp .formItems .formList li .sendEnter:active'
            +' { background-color: rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.7) !important; }'

            // Shape
            +'.sc_image_shape_round:hover figcaption, .post .sc_image_shape_round:hover figcaption, .mejs-controls .mejs-volume-button .mejs-volume-slider'
            +' { background: rgba('+rgb.r+','+rgb.g+','+rgb.b+',0.6) !important; }';

        if (window.theme_skin_set_theme_color_2)
            css_text = theme_skin_set_theme_color_2(css_text, clr);

        // theme color 3
        clr = rgb2hex(jQuery('#co_theme_color_3').css('backgroundColor'));
        rgb = hex2rgb(clr);

        css_text +=
            // Color 3 for site
            '.theme_accent_3, .theme_accent_3:before'
            +' { color: '+clr+'; }'

            // Background color 3 for site
            +'.theme_accent_3_bgc, .theme_accent_3_bgc:before, .sc_dropcaps.sc_dropcaps_style_2 .sc_dropcap, .squareButton.accent_3 > a'
            +' { background-color: '+clr+'; }'

            // Background
            +'.theme_accent_3_bg, .theme_accent_3_bg:before'
            +' { background:'+clr+'; }';

        if (window.theme_skin_set_theme_color_3)
            css_text = theme_skin_set_theme_color_3(css_text, clr);

		// Apply styles
		styles.html(css_text);

	}
}