<?php
$post_data['post_views']++;
$avg_author = 0;
$avg_users  = 0;
$show_title = get_custom_option('show_post_title')=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));
?>

<div class="itemscope itemPageFullWrapper" itemscope itemtype="http://schema.org/<?php echo esc_attr('Article'); ?>">

	<?php if (!empty($opt['dedicated']) || $post_data['post_thumb']) { ?>
		<section class="itemPageFull post_format_<?php echo esc_attr($post_data['post_format']); ?>">
	
			<?php require(themerex_get_file_dir('/templates/page-part-prev-next-posts.php')); ?>
			
			<div class="itemDescriptionWrap">
				<div class="main">
					<a href="#" class="toggleButton"></a>
					<a href="#" class="backClose"></a>
	
					<?php if ($show_title) { ?>
					<h1 itemprop="<?php echo esc_attr('name'); ?>" class="post_title entry-title"><?php echo esc_html($post_data['post_title']); ?></h1>
					<?php } ?>
	
					<div class="post_text_area toggleDescription">
						<?php
						echo balanceTags($post_data['post_excerpt']);
						?>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>

	<?php
	if (!$post_data['post_protected']) {
		startWrapper('<div class="main">');
		?>
        <div class="withMargin"></div>

		<?php
		if (get_custom_option('show_portfol_info')=='yes') {
			require(themerex_get_file_dir('/templates/page-part-portfol-info-block.php'));
		}
		?>

        <?php
		if (!$post_data['post_protected'] && !empty($post_data['post_content'])) { 
			startWrapper('<div class="post_text_area hrShadow withMargin" itemprop="articleBody">');
			// Post content
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

		<?php
			stopWrapper();
		}
		require(themerex_get_file_dir('/templates/page-part-author-info.php'));
		require(themerex_get_file_dir('/templates/page-part-related-posts.php'));
		get_template_part('templates/page-part-comments');
		stopWrapper();
	}
	?>
	
</div><!-- .itemscope -->

<?php require(themerex_get_file_dir('/templates/page-part-views-counter.php')); ?>
