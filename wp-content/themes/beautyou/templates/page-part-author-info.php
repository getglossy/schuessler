<?php
//===================================== Post author info =====================================
if (get_custom_option("show_post_author") == 'yes') {
	$post_author_email = get_the_author_meta('user_email', $post_data['post_author_id']);
	$post_author_avatar = get_avatar($post_author_email, 70*min(2, max(1, get_theme_option("retina_ready"))));
	$post_author_descr = do_shortcode(nl2br(get_the_author_meta('description', $post_data['post_author_id'])));
	$post_author_socials = showUserSocialLinks(array('author_id'=>$post_data['post_author_id'], 'style'=>'bg', 'before'=>'<li>', 'after'=>'</li>', 'echo' => false));
?>
	<section class="author vcard<?php echo get_custom_option("show_post_related") == 'yes' || get_custom_option("show_post_comments") == 'yes' ? ' hrShadow' : ''; ?>" itemprop="author" itemscope itemtype="http://schema.org/Person">
		<div class="wrap">
			<div class="avatar"><a href="<?php echo esc_url($post_data['post_author_url']); ?>" itemprop="image"><?php echo balanceTags($post_author_avatar); ?></a></div>
			<div class="authorInfo" itemprop="description">
				<h5 class="post_author_title"><span itemprop="name"><a href="<?php echo esc_url($post_data['post_author_url']); ?>" class="fn"><?php echo balanceTags($post_data['post_author']); ?></a></span></h5>
				<p><?php echo balanceTags($post_author_descr); ?></p>
			</div>
			<?php if ($post_author_socials!='') { ?><div class="socPage"><ul><?php echo balanceTags($post_author_socials); ?></ul></div><?php } ?>
		</div>
	</section>
<?php
}
?>
