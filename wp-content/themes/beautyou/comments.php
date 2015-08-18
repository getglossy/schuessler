<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. 
 */
?>

<?php

	// todo: Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		themerex_enqueue_script( 'comment-reply', false, array(), null, true );
		themerex_enqueue_script( 'form-comments', themerex_get_file_url('/js/_form_comments.js'), array(), null, true );
	}

	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;

	if ( have_comments() ) {
?>

	<section id="comments" class="comments hrShadow">
		<h3 class="comments_title"><?php echo ($post_comments = get_comments_number()); ?> <?php echo ( (int)$post_comments==1 ? __('Comment', 'themerex') : __('Comments', 'themerex')); ?></h3>
		<ul class="comments_list commBody">
		<?php
			/* Loop through and list the comments. Tell wp_list_comments()
			 * to use vc_theme_comment() to format the comments.
			 */
			wp_list_comments( array( 'callback' => 'single_comment_output') );
		?>
		</ul><!-- .comments_list -->
		<?php if ( !comments_open() && get_comments_number()!=0 && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p class="no_comments"><?php _e( 'Comments are closed.', 'themerex' ); ?></p>
		<?php }	?>
	</section><!-- .comments -->
<?php 
	}

	if ( comments_open() ) {

	themerex_enqueue_script( 'jquery-autosize', themerex_get_file_url('/js/jquery.autosize.js'), array('jquery'), null, true );
?>

	<section class="formValid">
		<h3><?php _e('Leave a Reply', 'themerex'); ?></h3>
		<div class="commForm commentsForm">
	
			<?php
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? ' aria-required="true"' : '' );
			$comments_args = array(
					// change the id of send button 
					'id_submit'=>'send_comment',
					// change the title of send button 
					'label_submit'=>__('Post Comment', 'themerex'),
					// change the title of the reply section
					'title_reply'=>'',
					// remove "Logged in as"
					'logged_in_as' => '',
					// remove text before textarea
					'comment_notes_before' => '',
					// remove text after textarea
					'comment_notes_after' => '',
					// redefine your own textarea (the comment body)
					'comment_field' => '<div class="message">'
										. '<textarea placeholder="'. __('Message', 'themerex') .'" id="comment" name="comment" class="textAreaSize" aria-required="true"></textarea>'
										. '</div>'
										. '<div class="enterBlock clr">'
										. '<div class="squareButton comm sc_button_size_big global big"><a class="enter" href="#">' . __('Post comment', 'themerex') . '</a></div>'
										. '</div>',
					'fields' => apply_filters( 'comment_form_default_fields', array(
						'author' => '<div class="columnsWrap"><div class="columns1_2">'
								. '<input placeholder="'. __('Name', 'themerex') .'" id="author" name="author" type="text" value="' . esc_attr( isset($commenter['comment_author']) ? $commenter['comment_author'] : '' ) . '" size="30"' . esc_attr($aria_req) . ' />'
								. '</div>',
						'email' => '<div class="columns1_2">'
								. '<input placeholder="'. __('Email', 'themerex') .'" id="email" name="email" type="text" value="' . esc_attr(  isset($commenter['comment_author_email']) ? $commenter['comment_author_email'] : '' ) . '" size="30"' . esc_attr($aria_req) . ' />'
								. '</div></div>'
					) )
			);
		
			comment_form($comments_args);
			?>
			<div class="nav_comments"><?php paginate_comments_links(); ?></div>
		</div>
	</section><!-- .formValid -->
<?php 
	}
	
function single_comment_output( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback' :
			?>
			<li class="trackback">
				<p><?php _e( 'Trackback:', 'themerex' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'themerex' ), '<span class="edit-link">', '<span>' ); ?></p>
			<?php
			break;
		case 'trackback' :
			?>
			<li class="pingback">
				<p><?php _e( 'Pingback:', 'themerex' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'themerex' ), '<span class="edit-link">', '<span>' ); ?></p>
			<?php
			break;
		default :
			$author_id = $comment->user_id;
			$author_link = get_author_posts_url( $author_id );
			?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class('commItem'); ?>>

			<div class="comment_author_avatar avatar"><?php echo get_avatar( $comment, 70 ); ?></div>
			<div class="wrap_comment">
				<h5 class="comment_title">
					<?php 
					if ($author_id) echo '<a href="' . $author_link . '">';
					comment_author(); 
					if ($author_id) echo '</a>';
					?>
				</h5>
				<div class="posted"><span class="comment_date"><?php echo getDateOrDifference(get_comment_date('Y-m-d H:i:s')); ?></span></div>

				<div class="authorInfo">
					<?php if ( $comment->comment_approved == 0 ) { ?>
					<div class="comment_not_approved"><?php _e( 'Your comment is awaiting moderation.', 'themerex' ); ?></div>
					<?php } ?>
	
					<div class="comment_content">
						<?php 
						comment_text();
						?>
					</div>
				</div>

				<div class="replyWrap">
					<?php if ($depth < $args['max_depth']) { ?>
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php } ?>
				</div>

			</div>

			<?php
			break;
	}
}
?>
