<?php
$show_title = true;
$columns = (int)$opt['col'];
$cust = get_post_custom($post_data['post_id']);
$event_date_temp = strtotime($cust['_EventStartDate'][0]);
$event_date = date('j/', $event_date_temp);
$event_date_temp_end = strtotime($cust['_EventEndDate'][0]);
$event_date_end = date('j', $event_date_temp_end);
$event_date .= $event_date_end;
?>
<article class="isotopeElement <?php
echo 'post_format_'.esc_attr($post_data['post_format'])
	. ($opt['number']%2==0 ? ' even' : ' odd')
	. ($opt['number']==0 ? ' first' : '')
	. ($opt['number']==$opt['posts_on_page'] ? ' last' : '');
?>">
	<div class="isotopePadding">
		<?php
		if ($post_data['post_thumb']) { ?>
			<div class="thumb hoverIncreaseIn">
				<span class="hoverShadow"></span>
				<div class="wrap_hover">
					<span class="sc_button sc_button_style_border_1 sc_button_size_big squareButton border_1 big hoverLink">
						<a href="<?php echo esc_url($post_data['post_link']); ?><?php echo ($post_data['post_url_target'] ? ' data-target="'.esc_url($post_data['post_url_target']).'"' : ''); ?>">
							<?php echo __('View', 'themerex'); ?>
						</a>
					</span>
				</div>
				<?php echo balanceTags($post_data['post_thumb']); ?>
			</div>
		<?php
		}
		?>

		<div class="post_wrap">
			<div class="startDate">
				<?php echo esc_html($event_date); ?>
			</div>
			<?php if ($show_title) { ?>
				<h5><?php echo esc_html($post_data['post_title']); ?></h5>
			<?php } ?>

			<span class="sc_button sc_button_style_accent_1 sc_button_size_big squareButton accent_1 big"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo __('learn more', 'themerex'); ?></a></span>

		</div>
	</div>

</article>