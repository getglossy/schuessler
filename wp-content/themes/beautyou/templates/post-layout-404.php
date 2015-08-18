<?php
/*
 * The template for displaying "Page 404"
*/
?>
<section class="post no_margin">
	<article class="post_content">
		<div class="page404">
			<div class="titleError"><span><?php _e('Oops!', 'themerex'); ?></span><?php _e( '404', 'themerex' ); ?></div>
			<div class="h4 sc_title_underline"><?php _e('Sorry! page not found!', 'themerex'); ?></div>
			<p><?php echo sprintf(__('You can also go back to the <a href="%s">%s</a>', 'themerex'), esc_url(home_url()), get_bloginfo()); ?>
			<br><?php _e('and start browsing from here', 'themerex'); ?></p>
		</div>
	</article>
</section>