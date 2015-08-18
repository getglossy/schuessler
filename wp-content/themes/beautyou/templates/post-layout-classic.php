<?php
$show_title = !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
$columns = max(1, min(4, (int) themerex_substr($opt['style'], -1)));
?>
<article class="isotopeElement <?php
	echo 'post_format_'.esc_attr($post_data['post_format'])
		. ($opt['number']%2==0 ? ' even' : ' odd')
		. ($opt['number']==0 ? ' first' : '')
		. ($opt['number']==$opt['posts_on_page'] ? ' last' : '')
		. ($opt['add_view_more'] ? ' viewmore' : '')
		. ($opt['filters']!=''
			? ' flt_'.join(' flt_', $opt['filters']=='categories' ? $post_data['post_categories_ids'] : $post_data['post_tags_ids'])
			: '');
	?>">
	<div class="isotopePadding bg_post">
		<?php

		if ($post_data['post_audio']){
			echo balanceTags($post_data['post_audio']);
		}
		else if ($post_data['post_thumb'] || $post_data['post_gallery'] || $post_data['post_video']) { ?>

		<?php if ($post_data['post_video'] || $post_data['post_gallery']) { ?>
			<div class="sc_section post_thumb thumb">
		<?php } else { ?>
				<div class="thumb hoverIncreaseIn">
					<span class="hoverShadow"></span>
					<div class="wrap_hover">
							<span class="sc_button sc_button_style_border_1 sc_button_size_big squareButton border_1 big hoverLink">
								<a href="<?php echo esc_url($post_data['post_link']); ?><?php echo ($post_data['post_url_target'] ? ' data-target="'.esc_url($post_data['post_url_target']).'"' : ''); ?>">
									<?php echo __('View', 'themerex'); ?>
								</a>
							</span>
					</div>
				<?php }
				if ($post_data['post_video']) {
					echo getVideoFrame($post_data['post_video'], $post_data['post_thumb'], false);
				} else if ($post_data['post_thumb'] && ($post_data['post_format']!='gallery' || !$post_data['post_gallery'] || get_custom_option('gallery_instead_image')=='no')) {
					if ($post_data['post_format']=='link' && $post_data['post_url']!='')
						echo '<a href="'.esc_url($post_data['post_url']).'"'.($post_data['post_url_target'] ? ' target="'.esc_attr($post_data['post_url_target']).'"' : '').'>'.balanceTags($post_data['post_thumb']).'</a>';
					else if ($post_data['post_link']!='')
						echo balanceTags($post_data['post_thumb']);
					else
						echo balanceTags($post_data['post_thumb']);
				} else if ($post_data['post_gallery']) {
					echo balanceTags($post_data['post_gallery']);
				}
				?>
			</div>
		<?php
		}

		if(in_array($post_data['post_format'], array('quote', 'link', 'chat', 'status', 'aside'))){ ?>
			<div class="post_wrap_part">
		<?php
		} else { ?>
			<div class="post_wrap">
		<?php }

			if ($show_title) {
				if (!isset($opt['links']) || $opt['links']) {
					?><h4><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_title']); ?></a></h4><?php
				} else {
					?><h4><?php echo esc_html($post_data['post_title']); ?></h4><?php
				}
			}

			if ($post_data['post_excerpt']) {
				?>
				<div class="post_format_wrap post<?php echo esc_attr(themerex_strtoproper($post_data['post_format'])); ?>">
					<?php echo in_array($post_data['post_format'], array('quote', 'link', 'chat')) ? balanceTags($post_data['post_excerpt']) : getShortString($post_data['post_excerpt'], isset($opt['descr']) ? $opt['descr'] : get_custom_option('post_excerpt_maxlength'.($columns>1 ? '_masonry' : ''))); ?>
				</div>
			<?php
			}
			?>

			<?php if (!isset($opt['info']) || $opt['info']) {
				if (get_custom_option('show_post_info')=='yes' || in_shortcode_blogger(true)) { ?>
					<div class="bog_post_info infoPost">
						<span class="datePost"><a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_date" itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>"><?php echo esc_html($post_data['post_date']); ?></a></span>
						<?php if(!in_array($post_data['post_format'], array('status', 'link'))){ ?>
							<span class="commentPost"><a class="icon-comment-1" title="<?php echo sprintf(__('Comments - %s', 'themerex'), $post_data['post_comments']); ?>" href="<?php echo esc_url($post_data['post_comments_link']); ?>"><?php echo esc_html($post_data['post_comments']); ?></a></span>
							<span class="likePost"><a class="icon-heart" title="<?php echo sprintf(__('Likes - %s', 'themerex'), $post_data['post_likes']); ?>" href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_likes']); ?></a></span>
						<?php } ?>
					</div>
				<?php
				}
			} ?>

		</div>

	</div>

</article>
