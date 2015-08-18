<?php
/* Tribe Events (TE) support functions
------------------------------------------------------------------------------- */


// Return true, if current page is any TE page
if ( !function_exists( 'is_tribe_events_page' ) ) {
	function is_tribe_events_page() {
		return class_exists('TribeEvents') ? tribe_is_event() || tribe_is_event_query() : false;
	}
}

// Before main content
//add_filter('tribe_events_before_html', 'themerex_tribe_events_wrapper_start');
if ( !function_exists( 'themerex_tribe_events_wrapper_start' ) ) {
	function themerex_tribe_events_wrapper_start($html) {
		return '
		<section class="post tribe_events_wrapper">
			<article class="post_content">
		' . $html;
	}
}

// After main content
//add_filter('tribe_events_after_html', 'themerex_tribe_events_wrapper_end');
if ( !function_exists( 'themerex_tribe_events_wrapper_end' ) ) {
	function themerex_tribe_events_wrapper_end($html) {
		return $html . '
			</article><!-- .post_content -->
		</section>
		';
	}
}
?>