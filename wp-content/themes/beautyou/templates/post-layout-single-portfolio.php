<?php
$post_data['post_views']++;
$avg_author = 0;
$avg_users  = 0;
$show_title = get_custom_option('show_post_title')=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));

startWrapper(array(
'<div class="itemscope" itemscope itemtype="http://schema.org/Article">',
'	<section class="' . join(' ', get_post_class('itemPage post post_format_'.$post_data['post_format'].' post'.$opt['post_class'] . (get_custom_option("show_post_author") == 'yes' || get_custom_option("show_post_related") == 'yes' || get_custom_option("show_post_comments") == 'yes' ? ' hrShadow' : ' no_margin'))) . '">',
'		<article class="post_content">'
));
			require(themerex_get_file_dir('/templates/page-part-prev-next-posts.php'));

			if ($show_title) {
				?>
				<h1 itemprop="<?php echo esc_attr('name'); ?>" class="post_title entry-title"><?php echo esc_html($post_data['post_title']); ?></h1>
				<?php
			}

			if ( get_custom_option('show_post_info')=='yes') {
				?>
				<div class="post_info infoPost">
					<?php if ($post_data['post_edit_enable'] || $post_data['post_delete_enable']) { ?>
						<span class="frontend_editor_buttons">
												<?php if ($post_data['post_edit_enable']) { ?>
													<span class="squareButton sc_button_style_global global medium"><a id="frontend_editor_icon_edit" title="<?php _e('Edit post', 'themerex'); ?>" href="#"><?php _e('Edit', 'themerex'); ?></a></span>
												<?php } ?>
							<?php if ($post_data['post_delete_enable']) { ?>
								<span class="squareButton sc_button_style_global global medium"><a id="frontend_editor_icon_delete" title="<?php _e('Delete post', 'themerex'); ?>" href="#"><?php _e('Delete', 'themerex'); ?></a></span>
							<?php } ?>
								</span>
					<?php } ?>
					<span class="authorPost" itemprop="author"><a href="<?php echo esc_url($post_data['post_author_url']); ?>" class="post_author fn" rel="author"><?php echo esc_html($post_data['post_author']); ?></a></span>

					<span class="datePost"><a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_date" itemprop="datePublished" content="<?php echo get_the_date('Y-m-d'); ?>"><?php echo esc_html($post_data['post_date']); ?></a></span>

					<span class="likePost icon-heart"><?php echo balanceTags($post_data['post_likes']); ?></span>

					<span class="commentPost"><a class="icon-comment-1" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo esc_url($post_data['post_comments_link']); ?>"><?php echo esc_html($post_data['post_comments']); ?></a></span>

				</div>
			<?php
			}

			if (get_custom_option('show_portfol_info')=='yes') {
				require(themerex_get_file_dir('/templates/page-part-portfol-info-block.php'));
			}
			startWrapper('<div class="post_text_area" itemprop="articleBody">');

			// Post content
			if ($post_data['post_protected']) {
				echo balanceTags($post_data['post_excerpt']);
			} else {
				echo sc_gap_wrapper($post_data['post_content']);
				wp_link_pages( array(
					'before' => '<div class="nav_pages_parts"><span class="pages">' . __( 'Pages:', 'themerex' ) . '</span>',
					'after' => '</div>',
					'link_before' => '<span class="page_num">',
					'link_after' => '</span>'
				) );
				?>

				<div class="tagsWrap">
					<?php if ($post_data['post_categories_links']!='' && get_custom_option('show_post_tags')=='yes') { ?>
						<span class="post_cats"><?php _e('Categories:', 'themerex'); ?> <?php echo balanceTags($post_data['post_categories_links']); ?></span>
					<?php } ?>

					<?php if ( get_custom_option('show_post_counters')=='yes') { ?>
						<div class="postSharing">
							<?php
							$postinfo_buttons = array('comments', 'views', 'likes', 'share', 'markup');
							require(themerex_get_file_dir('/templates/page-part-postinfo.php'));
							?>
						</div>
					<?php } ?>
					<?php if ( get_custom_option('show_post_tags')=='yes' && $post_data['post_tags_links'] != '') { ?>
						<div class="post_tags">
							<?php _e('Tags:', 'themerex'); ?>
							<?php echo balanceTags($post_data['post_tags_links']); ?>
						</div>
					<?php } ?>
				</div>

			<?php }
			stopWrapper(3);
			?>

	<?php
	if (!$post_data['post_protected']) {
		require(themerex_get_file_dir('/templates/page-part-author-info.php'));
		require(themerex_get_file_dir('/templates/page-part-related-posts.php'));
		get_template_part('templates/page-part-comments');
	}
	?>

<?php stopWrapper(); ?>

<?php require(themerex_get_file_dir('/templates/page-part-views-counter.php')); ?>
