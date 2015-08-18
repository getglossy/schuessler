<?php
// Portfolio info
?>

<div class="portfolBlock">
	<h5><?php _e('More Information', 'themerex'); ?></h5>
	<ul>

		<li>
			<span><?php _e('Customer:', 'themerex'); ?></span>
			<?php
			if (get_custom_option('portfol_customer')!='') {
				 echo balanceTags(get_custom_option('portfol_customer'));
			} else{
				echo balanceTags($post_data['post_author']);
			}
			?>
		</li>

		<?php if ($post_data['post_categories_links']!='') { ?>
			<li>
				<span><?php _e('Categories:', 'themerex'); ?></span>
				<?php echo balanceTags($post_data['post_categories_links']); ?>
			</li>
		<?php } ?>

		<?php if ($post_data['post_tags_links'] != '') { ?>
			<li>
				<span><?php _e('Tags:', 'themerex'); ?></span>
				<?php echo balanceTags($post_data['post_tags_links']); ?>
			</li>
		<?php } ?>

		<li>
			<span><?php _e('Date post:', 'themerex'); ?></span>
			<?php
			if (get_custom_option('portfol_date')!='') {
				echo balanceTags(get_custom_option('portfol_date'));
			} else{
				echo balanceTags($post_data['post_date']);
			}
			?>
		</li>

	</ul>
</div>
<?php
?>