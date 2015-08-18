<div class="swpRightPos">

	<a href="#" class="swpRightPosButton"><span class="icon-flower134 animate-spin"></span></a>

	<?php
	// raggable
	themerex_enqueue_script( 'jquery-ui-draggable', false, array('jquery','jquery-ui-core'), null, true );
	themerex_enqueue_script( 'jquery-ui-sortable', false, array('jquery','jquery-ui-core'), null, true );

	// customizer
	if (get_custom_option('show_theme_customizer') == 'yes'){
		themerex_enqueue_script( '_customizer', themerex_get_file_url('/js/_customizer.js'), array(), null, true );
	}

	// scrollbar
	themerex_enqueue_style(  'swiperslider-style',  themerex_get_file_url('/js/swiper/idangerous.swiper.css'), array(), null );
	themerex_enqueue_style(  'swiperslider-scrollbar-style',  themerex_get_file_url('/js/swiper/idangerous.swiper.scrollbar.css'), array(), null );

	themerex_enqueue_script( 'swiperslider', themerex_get_file_url('/js/swiper/idangerous.swiper-2.7.js'), array('jquery'), null, true );
	themerex_enqueue_script( 'swiperslider-scrollbar', themerex_get_file_url('/js/swiper/idangerous.swiper.scrollbar-2.4.js'), array('jquery'), null, true );

	global $THEMEREX_panelmenu;
	$tab = (int) get_custom_option('right_panel_tab');
	$shift = 0;
	if (get_theme_option('show_theme_customizer') != 'yes' && $tab > 0) $shift++;
	if (!$THEMEREX_panelmenu && $tab > 2) $shift++;
	$tab = max(0, $tab - $shift);
	?>
	<div class="sc_tabs" data-active="<?php echo esc_attr($tab); ?>">
		<ul class="tabsMenuHead">
			<?php if (get_theme_option('show_theme_customizer') == 'yes') { ?>
			<li class="right_tab_custom"><a class="tabsCustom" href="#tabsCustom" title="<?php _e('Custom panel', 'themerex'); ?>"></a></li>
			<?php } ?>
			<?php
			if ($THEMEREX_panelmenu) {
			?>
			<li class="right_tab_menu"><a class="tabsMenu" href="#tabsMenu" title="<?php _e('Custom menu', 'themerex'); ?>"></a></li>
			<?php } ?>
			<li class="right_tab_favorites"><a class="tabsFavorite" href="#tabsFavorite" title="<?php _e('Bookmarks', 'themerex'); ?>"></a></li>
		</ul>

		<?php
		if (get_theme_option('show_theme_customizer') == 'yes') {
			$theme_color = apply_filters('theme_skin_get_theme_color', get_custom_option('theme_color'));
			$theme_color_1 = apply_filters('theme_skin_get_theme_color_1', get_custom_option('theme_color_1'));
			$theme_color_2 = apply_filters('theme_skin_get_theme_color_2', get_custom_option('theme_color_2'));
			$theme_color_3 = apply_filters('theme_skin_get_theme_color_3', get_custom_option('theme_color_3'));
			$body_style = get_custom_option('body_style');
			$bg_pattern = get_custom_option('bg_pattern');
			$bg_image = get_custom_option('bg_image');
			?>
			<div id="tabsCustom" class="tabsMenuBody">
				<div id="custom_options">
					<div id="custom_options_scroll" class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container">
						<div class="sc_scroll_wrapper swiper-wrapper">
							<div class="sc_scroll_slide swiper-slide">
								<div class="co_header">
									<h4 class="co_title"><?php _e('Choose Your Style', 'themerex'); ?></h4>
									<a href="#" class="co_reset_to_default icon-arrows-ccw" title="<?php _e('Reset to default', 'themerex'); ?>"></a>
								</div>
								<div class="co_options">
									<form name="co_form">
										<input type="hidden" id="co_site_url" name="co_site_url" value="<?php echo esc_attr('http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>" />
										<div class="co_form_row">
											<input type="hidden" name="co_body_style" value="<?php echo esc_attr($body_style); ?>" />
											<span class="co_label"><?php _e('Body style:', 'themerex'); ?></span>
											<div class="co_switch_box">
												<a href="#" class="co_switch_label wide"><?php _e('Wide', 'themerex'); ?></a>
												<div class="switcher"><a href="#"></a></div>
												<a href="#" class="co_switch_label boxed"><?php _e('Boxed', 'themerex'); ?></a>
											</div>
											<?php if ($body_style == 'boxed') { ?>
											<script type="text/javascript">
												jQuery(document).ready(function() {
													// Background switcher
													var box = jQuery('#custom_options .switcher');
													var switcher = box.find('a').eq(0);
													var right = box.width() - switcher.width() - 7;
													switcher.css({left: right});
												});
											</script>
											<?php } ?>
										</div>
										<div class="co_form_row">
											<span class="co_label"><?php _e('Theme colors:', 'themerex'); ?></span>
											<div class="co_form_subrow">

												<input type="hidden" name="co_theme_color" value="<?php echo esc_attr($theme_color); ?>" />
												<div id="co_theme_color" class="iColorPicker"></div>

												<input type="hidden" name="co_theme_color_1" value="<?php echo esc_attr($theme_color_1); ?>" />
												<div id="co_theme_color_1" class="iColorPicker"></div>

												<input type="hidden" name="co_theme_color_2" value="<?php echo esc_attr($theme_color_2); ?>" />
												<div id="co_theme_color_2" class="iColorPicker"></div>

												<input type="hidden" name="co_theme_color_3" value="<?php echo esc_attr($theme_color_3); ?>" />
												<div id="co_theme_color_3" class="iColorPicker" style="margin-right:0;"></div>

											</div>
										</div>
										<div class="co_form_row">
											<input type="hidden" name="co_bg_pattern" value="<?php echo esc_attr($bg_pattern); ?>" />
											<span class="co_label"><?php _e('Theme pattern:', 'themerex'); ?></span>
											<div id="co_bg_pattern_list">
												<?php for ($i=1; $i<=3; $i++) { ?>
												<a href="#" id="pattern_<?php echo esc_attr($i); ?>" class="<?php echo ($i==3 || $i==6 ? 'no_margin ' : ''); ?>co_pattern_wrapper<?php echo ($bg_pattern==$i ? ' current' : ''); ?>"><img src="<?php echo themerex_get_file_url('/images/bg/pattern_'.esc_attr($i).'_thumb2.png'); ?>" alt="" /></a>
												<?php } ?>
											</div>
										</div>
										<div class="co_form_row">
											<input type="hidden" name="co_bg_image" value="<?php echo esc_attr($bg_image); ?>" />
											<span class="co_label"><?php _e('Backgroud images:', 'themerex'); ?></span>
											<div id="co_bg_images_list">
												<?php for ($i=1; $i<=3; $i++) { ?>
												<a href="#" id="image_<?php echo esc_attr($i); ?>" class="<?php echo ($i==3 || $i==6 ? 'no_margin ' : ''); ?>co_image_wrapper<?php echo ($bg_image==$i ? ' current' : ''); ?>"><img src="<?php echo themerex_get_file_url('/images/bg/image_'.esc_attr($i).'_thumb2.jpg'); ?>" alt="" /></a>
												<?php } ?>
											</div>
											<div id="co_bg_images"></div>
										</div>
									</form>
									<script type="text/javascript">
										jQuery(document).ready(function(){
											// Theme & Background color
											jQuery('#co_theme_color').css('backgroundColor', '<?php echo esc_attr($theme_color); ?>');
											jQuery('#co_theme_color_1').css('backgroundColor', '<?php echo esc_attr($theme_color_1); ?>');
											jQuery('#co_theme_color_2').css('backgroundColor', '<?php echo esc_attr($theme_color_2); ?>');
											jQuery('#co_theme_color_3').css('backgroundColor', '<?php echo esc_attr($theme_color_3); ?>');
										});
									</script>
								</div>
							</div>
						</div>
						<div id="custom_options_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical custom_options_scroll_bar"></div>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if ($THEMEREX_panelmenu) { ?>
		<div id="tabsMenu" class="tabsMenuBody">
			<div class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container" id="panelmenu_scroll">
				<div class="sc_scroll_wrapper swiper-wrapper">
					<div class="sc_scroll_slide swiper-slide">
						<nav role="navigation" class="panelmenu_area widget_area">
							<?php echo balanceTags($THEMEREX_panelmenu); ?>
						</nav>

						<?php if (get_custom_option('show_search')=='yes') { ?>
						<div class="searchBlock">
							<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="text" class="searchField" placeholder="<?php _e('Search', 'themerex'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" title="<?php _e('Search for:', 'themerex'); ?>" />
								<button type="submit" class="searchSubmit"></button>
							</form>
						</div>
						<?php } ?>
					</div>
				</div>
				<div id="panelmenu_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical panelmenu_scroll_bar"></div>
			</div>
		</div>
		<?php } ?>

		<div id="tabsFavorite" class="tabsMenuBody">
			<div class="addBookmarkArea"><a href="#" class="addBookmark"><?php _e('add bookmark', 'themerex'); ?></a></div>
			<div class="sc_scroll sc_scroll_vertical swiper-slider-container scroll-container scroll-no-swiping" id="bookmarks_scroll">
				<div class="sc_scroll_wrapper swiper-wrapper">
					<div class="sc_scroll_slide swiper-slide swiper-no-swiping">
						<?php
						$list = getValueGPC('themerex_bookmarks', '');
						if (!empty($list)) $list = json_decode($list, true);
						?>
						<ol class="listBookmarks">
							<?php
							if (!empty($list)) {
								foreach ($list as $bm) {
									echo ('<li><a href="'.esc_url($bm['url']).'">'.balanceTags($bm['title']).'</a><a href="#" class="delBookmark icon-cancel"></a></li>');
								}
							}
							?>
						</ol>
					</div>
				</div>
				<div id="bookmarks_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical bookmarks_scroll_bar"></div>
			</div>
		</div>

	</div>

</div>
