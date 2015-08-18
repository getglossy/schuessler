<?php
$show_all = !isset($postinfo_buttons) || !is_array($postinfo_buttons);
// Social share buttons
if (is_singular() && get_theme_option('show_share')=='yes') {
	themerex_enqueue_script( 'social-share', themerex_get_file_url('/js/social/social-share.js'), array(), null, true );
}
?>
<ul>
<?php
if ($show_all || in_array('more', $postinfo_buttons)) { ?>
	<li class="squareButton light ico"><a class="icon-link" title="<?php _e('More', 'themerex'); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><?php _e('More', 'themerex'); ?></a></li>
<?php
}
 
if ($show_all || in_array('likes', $postinfo_buttons)) { ?>
	<?php
	$likes = isset($_COOKIE['themerex_likes']) ? $_COOKIE['themerex_likes'] : '';
	$allow = themerex_strpos($likes, ','.$post_data['post_id'].',')===false;
	?>
	<li class="likeButton like<?php echo ($allow ? '' : 'Active'); ?>" data-postid="<?php echo esc_attr($post_data['post_id']); ?>" data-likes="<?php echo esc_attr($post_data['post_likes']); ?>" data-title-like="<?php _e('Like', 'themerex'); ?>" data-title-dislike="<?php _e('Dislike', 'themerex'); ?>"><a class="icon-heart" title="<?php echo sprintf($allow ? __('Like - %s', 'themerex') : __('Dislike', 'themerex'), $post_data['post_likes']); ?>" href="#"><span class="likePost"><?php echo /*$post_data['post_likes']*/__('Like', 'themerex'); ?></span></a></li>
<?php
}

	if ($show_all || in_array('share', $postinfo_buttons)) {
		// Social sharing
		$rez = showShareButtons(array(
		'post_id'    => $post_data['post_id'],
		'post_link'  => $post_data['post_link'],
		'post_title' => $post_data['post_title'],
		'post_descr' => strip_tags($post_data['post_excerpt']),
		'post_thumb' => $post_data['post_attachment'],
		'style'		 => 'drop',
		'echo'		 => false
		));
		if ($rez) {
			?>
			<li class="share"><a class="icon-share shareDrop" title="<?php _e('Share', 'themerex'); ?>" href="#"><?php _e('Share', 'themerex'); ?></a><?php echo balanceTags($rez); ?></li>
			<?php
		}
	}
	?>

</ul>
<?php
if (is_single() && in_array('markup', $postinfo_buttons)) {
?>
<meta itemprop="interactionCount" content="User<?php echo (esc_attr($opt['counters'])=='comments' ? 'Comments' : 'PageVisits'); ?>:<?php echo ($opt['counters']=='comments' ? esc_attr($post_data['post_comments']) : esc_attr($post_data['post_views'])); ?>" />
<?php
}
?>