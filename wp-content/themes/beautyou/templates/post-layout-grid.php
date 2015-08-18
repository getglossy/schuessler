<?php
$show_title = true;
$columns = max(1, min(4, (int) themerex_substr($opt['style'], -1)));

$style_image = get_custom_option('portfolio_image_style', null, $post_data['post_id']);
$thumb_sizes = getPortfolioThumbSizes(array(
	'thumb_crop' => true,
	'thumb_size' => $style_image
));

$post_data['post_thumb'] = getResizedImageTag($post_data['post_id'], $thumb_sizes['w'], $thumb_sizes['h']); //for new image

$isotopeWidth = 1;
$isotopeHeight = 1;

switch ($style_image) {
	case 'image-square-2':
		$isotopeWidth = 2;
		$isotopeHeight = 2;
	break;
	case 'image-rectangle':
		$isotopeWidth = 2;
		$isotopeHeight = 1;
	break;
}
?>

<article data-width="<?php echo esc_attr($isotopeWidth); ?>" data-height="<?php echo esc_attr($isotopeHeight); ?>" class="ellNOspacing isotopeElement <?php
echo 'post_format_'.$post_data['post_format']
	. ($opt['number']%2==0 ? ' even' : ' odd')
	. ($opt['number']==0 ? ' first' : '')
	. ($opt['number']==$opt['posts_on_page'] ? ' last' : '')
	. ($opt['add_view_more'] ? ' viewmore' : '')
	. ($opt['filters']!=''
		? ' flt_'.join(' flt_', $opt['filters']=='categories' ? $post_data['post_categories_ids'] : $post_data['post_tags_ids'])
		: '');
?>">

	<div class="isotopePadding<?php echo esc_attr(get_custom_option('show_portfolio_spacing')=='no' ? ' ellNOspacing' :  ''); ?>">
		<?php

		if ($post_data['post_thumb'] || $post_data['post_gallery'] || $post_data['post_video']) { ?>

		<?php if ($post_data['post_video'] || $post_data['post_gallery']) { ?>
		<div class="sc_section">
			<?php } else { ?>
			<div class="thumb hoverIncreaseOut">
				<span class="hoverShadow"></span>
				<div class="wrap_hover">
					<div class="portfolioInfo">
						<span class="hoverIcon">
							<a class="icon-camera" title="<?php echo esc_attr($post_data['post_title']); ?>" href="<?php echo esc_url($post_data['post_attachment']); ?>">
							</a>
						</span>
						<?php
						if ($show_title) {
							if (!isset($opt['links']) || $opt['links']) {
								?><h4><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo esc_html($post_data['post_title']); ?></a></h4><?php
							} else {
								?><h4><?php echo esc_html($post_data['post_title']); ?></h4><?php
							}
						}
						?>
						<?php if (!$post_data['post_video'] && !$post_data['post_gallery'] && $columns != 4) {  ?>
							<span class="datePost">
										<a href="<?php echo esc_url($post_data['post_link']); ?>" class="post_date" itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
											<?php echo esc_html($post_data['post_date']); ?>
										</a>
									</span>
						<?php } ?>
					</div>
				</div>
				<?php }
				if ($post_data['post_video']) {
					echo getVideoFrame($post_data['post_video'], $post_data['post_thumb'], false);
				} else if ($post_data['post_thumb'] && ($post_data['post_format']!='gallery' || !$post_data['post_gallery'] || get_custom_option('gallery_instead_image')=='no')) {
					echo balanceTags($post_data['post_thumb']);
				} else if ($post_data['post_gallery']) {
					echo balanceTags($post_data['post_gallery']);
				}
				?>
			</div>
			<?php
			}
			?>

		</div>

</article>
