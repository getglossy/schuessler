<?php
/**
 * The template for displaying the footer.
 */
global $logo_footer, $logo_text;

					stopWrapper(); //<!-- </div.content> -->

					// Show main sidebar
					if (function_exists('is_woocommerce') ? is_product() : false){
						// todo: magnific & pretty
						themerex_enqueue_script('magnific', themerex_get_file_url('/js/magnific-popup/jquery.magnific-popup.min.js'), array('jquery'), null, true);
						if (get_theme_option('popup_engine') == 'pretty') {
							themerex_enqueue_style('prettyphoto-style', themerex_get_file_url('/js/prettyphoto/css/prettyPhoto.css'), array(), null);
							themerex_enqueue_script('prettyphoto', themerex_get_file_url('/js/prettyphoto/jquery.prettyPhoto.min.js'), array('jquery'), 'no-compose', true);
						}
					} else {
						get_sidebar();
					}
					if (get_custom_option('body_style')!='fullscreen' && (!is_singular() || get_custom_option('single_style')!='single-portfolio-fullscreen')) {
						stopWrapper();	//<!-- </div.main> -->
					}
				?>
				</div> <!-- /.mainWrap -->

			<?php
			// ---------------- Footer Twitter stream ----------------
			if (get_custom_option('show_twitter_in_footer') == 'yes'  ) {
				$twitter = do_shortcode('[trx_twitter show_user="off"]');
				if ($twitter) {	?>
					<div class="twitBlockWrap"><span class="twitterTitle"><?php echo __('Latest Tweet Update', 'themerex'); ?></span><?php echo balanceTags($twitter); ?>
						<span class="twitterAuthor"><?php echo __('Follow us on', 'themerex').' <a href="https://twitter.com/' . get_theme_option('twitter_username') . '" target="_blank">' . __('Twitter', 'themerex') . '</a> '.__('for our latest updates', 'themerex'); ?></span>
					</div>
					<?php
				}
			}
			?>

			<div class="footerContentWrap">
				<?php
				// ---------------- Footer contacts ----------------------
				if (($contact_style = get_custom_option('show_contacts_in_footer')) != 'no'  ) {
					$address_1 = get_theme_option('contact_address_1');
					$address_2 = get_theme_option('contact_address_2');
					$phone = get_theme_option('contact_phone');
					$fax = get_theme_option('contact_fax');
					if ($contact_style=='yes') $contact_style = 'dark';
				?>
				<footer class="footerWrap footerStyle<?php echo themerex_strtoproper($contact_style); ?> contactFooterWrap">
					<div class="main contactFooter">
						<section>
							<div class="logo">
								<a href="<?php echo esc_url(home_url()); ?>"><?php echo (esc_attr($logo_text) ? '<span class="logo_text">'.apply_filters('theme_logo_text', $logo_text, 'footer').'</span>' : ''); ?><?php echo (esc_attr($logo_footer) ? '<img src="'.esc_url($logo_footer).'" alt="">' : ''); ?></a>
							</div>
							<div class="contactAddress">
								<address class="addressRight">
									<?php echo __('Phone:', 'themerex') . ' ' . esc_attr($phone); ?><br>
									<?php echo __('Fax:', 'themerex') . ' ' . esc_attr($fax); ?>
								</address>
								<address class="addressLeft">
									<?php echo esc_attr($address_2); ?><br>
									<?php echo esc_attr($address_1); ?>
								</address>
							</div>
							<div class="contactShare">
								<ul>
									<?php
										$socials = get_theme_option('social_icons');
										foreach ($socials as $s) {
											if (empty($s['url'])) continue;
											$name = basename($s['icon']);
											?><li><a class="social_icons <?php echo esc_attr($name); ?>" href="<?php echo esc_url($s['url']); ?>" target="_blank"></a></li><?php
										}
									?>
								</ul>
							</div>
						</section>
					</div>
				</footer>
				<?php } ?>

				<?php
				// ----------------- Google map -----------------------
				if ( get_custom_option('googlemap_show')=='yes' ) {
					if ( get_custom_option('googlemap_button_show')=='yes' ) { ?>
						<div class="googlemap_button"><?php echo __('Locate Us on Map', 'themerex'); ?></div>
					<?php }
					$map_address = get_custom_option('googlemap_address');
					$map_latlng = get_custom_option('googlemap_latlng');
					$map_zoom = get_custom_option('googlemap_zoom');
					$map_style = get_custom_option('googlemap_style');
					$map_height = get_custom_option('googlemap_height');
					$map_class_show = get_custom_option('googlemap_button_show')=='yes' ? 'hide' : '';
					if (!empty($map_address) || !empty($map_latlng)) {
						echo do_shortcode('[trx_googlemap'
							. (!empty($map_address) ? ' address="'.$map_address.'"' : '')
							. (!empty($map_latlng) ? ' latlng="'.$map_latlng.'"' : '')
							. (!empty($map_style) ? ' style="'.$map_style.'"' : '')
							. (!empty($map_zoom) ? ' zoom="'.$map_zoom.'"' : '')
							. (!empty($map_height) ? ' height="'.$map_height.'"' : '')
							. (!empty($map_class_show) ? ' class="'.$map_class_show.'"' : '')
							. ']');
					}
				}
				?>

				<?php
				$show_user_footer = get_custom_option('show_user_footer');
				if (!empty($show_user_footer) && $show_user_footer != 'none') {
					$user_footer = themerex_strclear(get_custom_option('user_footer_content'), 'p');
					if (!empty($user_footer)) {
						$user_footer = substituteAll($user_footer);
						?>
						<div class="userFooterSection <?php echo esc_attr($show_user_footer); ?>">
							<?php echo balanceTags($user_footer); ?>
						</div>
					<?php
					}
				}
				?>

				<?php
				// ---------------- Footer sidebar ----------------------
				if (get_custom_option('show_sidebar_footer') == 'yes'  ) {
					global $THEMEREX_CURRENT_SIDEBAR;
					$THEMEREX_CURRENT_SIDEBAR = 'footer';
					$style = get_custom_option('sidebar_footer_style');
				?>
				<footer class="footerWrap footerStyle<?php echo themerex_strtoproper($style); ?>">
					<div class="main footerWidget widget_area sidebarStyle<?php echo themerex_strtoproper($style); ?>">
						<?php
						do_action( 'before_sidebar' );
						if ( ! dynamic_sidebar( get_custom_option('sidebar_footer') ) ) {
							// Put here html if user no set widgets in sidebar
						}
						?>
					</div>
				</footer>
				<?php } ?>

				<?php if (get_custom_option('show_copyright_area_in_footer')=='yes') { ?>
				<div class="copyWrap">
					<div class="copy main">
						<div class="copyright"><?php echo get_theme_option('footer_copyright'); ?>
						<?php
						$terms_link = get_theme_option('footer_terms_link');
						$terms_text = get_theme_option('footer_terms_text');
						if ($terms_link) {
							?>
							<a href="<?php echo esc_url($terms_link); ?>"><?php echo esc_html($terms_text); ?></a>
							<?php
						}
						$policy_link = get_theme_option('footer_policy_link');
						$policy_text = get_theme_option('footer_policy_text');
						if ($terms_link && $policy_link) {
							_e('and', 'themerex');
						}
						if ($policy_link) {
							?>
							<a href="<?php echo esc_url($policy_link); ?>"><?php echo esc_html($policy_text); ?></a>
							<?php
						}
						?>
						</div>
					</div>
				</div>
				<?php } ?>

			</div><!-- /.footerContentWrap -->

			<?php
			if (get_custom_option('show_video_bg')=='yes' && (get_custom_option('video_bg_youtube_code')!='' || get_custom_option('video_bg_url')!='')) { ?>
				</div><!-- /.videoBackgroundOverlay -->
			<?php }	?>
		</div><!-- ./boxedWrap -->
	</div><!-- ./main_content -->
<?php

if (!is_user_logged_in() && get_custom_option('show_login')=='yes' && (get_custom_option('show_user_menu') == 'yes' || get_custom_option('show_left_panel') == 'yes')) {
	get_template_part('templates/page-part-login');
}

get_template_part('templates/page-part-js-messages');

if (get_custom_option('show_right_panel')=='yes') {
	get_template_part('templates/page-part-customizer');
}
?>

<div class="upToScroll">
	<?php if (get_custom_option('show_right_panel')=='yes') { ?>
	<a href="#" class="addBookmark icon-star" title="<?php _e('Add the current page into bookmarks', 'themerex'); ?>"></a>
	<?php } ?>
	<a href="#" class="scrollToTop icon-up-open" title="<?php _e('Back to top', 'themerex'); ?>"></a>
</div>

<div class="customHtmlSection">
	<?php echo get_custom_option('custom_code'); ?>
</div>

<?php echo get_custom_option('gtm_code2'); ?>

<?php wp_footer(); ?>

</body>
</html>