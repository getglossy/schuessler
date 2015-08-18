<?php
$show_title = true;
$reviewsBlock = '';
?>
<article class="columns1_<?php echo esc_attr($opt['posts_visible']); ?> column_item_<?php echo esc_attr($opt['number']); ?>">
<div class="wrap<?php echo esc_attr($post_data['post_thumb'] ? ' thumb' : ' no_thumb');  ?>">
	<?php if ($post_data['post_thumb']) {
			if(get_custom_option("post_related_style") == 'no' || in_shortcode_blogger(true)) { ?>
				<div class="thumb"><?php echo balanceTags($post_data['post_thumb']); ?></div>
			<?php } else { ?>
			<div class="thumb">
				<?php echo balanceTags($post_data['post_thumb']); ?>
			</div>
	<?php }	} ?>
		<div class="relatedInfo">
			<?php if (get_custom_option("post_related_style") == 'no' || in_shortcode_blogger(true)) { ?>

				<?php if (!isset($opt['info']) || $opt['info']) { ?>
					<span class="likePost"><a class="icon-heart" title="<?php echo sprintf(__('Likes - %s', 'themerex'), $post_data['post_likes']); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_likes']); ?></a></span>
					<span class="commentPost"><a class="icon-comment-1" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo esc_url($post_data['post_comments_link']); ?>"><?php echo esc_html($post_data['post_comments']); ?></a></span>
				<?php } ?>

				<?php if(in_shortcode_blogger(true)){ ?>
				<div class="wrap_bottom_info">
					<div class="title_wrap">
						<?php
						if ($category = get_the_category()) { ?>
							<span class="cat_info">
								<?php
									echo '<a href="'.esc_url(get_category_link($category[0]->cat_ID)).'">'.esc_html($category[0]->cat_name).'</a>'
										.($category[1]->cat_name ? ', <a href="'.esc_url(get_category_link($category[1]->cat_ID)).'">'.esc_html($category[1]->cat_name).'</a>' : '').''
										.($category[2]->cat_name ? ', <a href="'.esc_url(get_category_link($category[2]->cat_ID)).'">'.esc_html($category[2]->cat_name).'</a>' : '');
								?>
							</span>
						<?php } ?>

						<?php
							if (!isset($opt['links']) || $opt['links']) {
								?><h4><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_title']); ?></a></h4><?php
							} else {
								?><h4><?php echo ($post_data['post_title']); ?></h4><?php
							}
						?>
					</div>

					<?php if ($post_data['post_excerpt']) {	?>
						<div class="post_format_wrap">
							<?php
								echo getShortString($post_data['post_excerpt'], $opt['descr'], $opt['readmore'] ? '' : '...');
							?>
						</div>
					<?php
					}

					if($opt['readmore'] != ''){ ?>
						<a class="readmore_blogger" href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($opt['readmore']); ?></a>
					<?php
					}
					?>
				</div>

				<?php } else {?>

				<?php
				if ($show_title) {
					if (!isset($opt['links']) || $opt['links']) {
						?><h5><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_title']); ?></a></h5><?php
					} else {
						?><h5><?php echo esc_html($post_data['post_title']); ?></h5><?php
					}
				} ?>

			<?php } ?>

			<?php } else {
				if ($show_title) {
					if (!isset($opt['links']) || $opt['links']) {
						?><h5><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_title']); ?></a></h5><?php
					} else {
						?><h5><?php echo esc_html($post_data['post_title']); ?></h5><?php
					}
				}
				if (!isset($opt['info']) || $opt['info']) {
					if (!empty($post_data['post_tags_links']) and get_custom_option("post_related_style") == 'yes') { ?>
						<span class="infoTags"><?php echo balanceTags($post_data['post_tags_links']); ?></span>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>
</div>
</article>
