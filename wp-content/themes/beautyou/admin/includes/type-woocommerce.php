<?php
/* Woocommerce support functions
------------------------------------------------------------------------------- */

// Return true, if current page is any woocommerce page
if ( !function_exists( 'is_woocommerce_page' ) ) {
	function is_woocommerce_page() {
		return function_exists('is_woocommerce') ? is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() : false;
	}
}

// Remove WOOC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Before main content
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content', 'themerex_wrapper_start', 10);
if ( !function_exists( 'themerex_wrapper_start' ) ) {
	function themerex_wrapper_start() {
		?>
		<section class="post shop_mode_thumbs">
			<article class="post_content">
		<?php
	}
}

// After main content
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'themerex_wrapper_end', 10);
if ( !function_exists( 'themerex_wrapper_end' ) ) {
	function themerex_wrapper_end() {
	?>
			</article><!-- .post_content -->
		</section>
	<?php
	}
}

// Check to show page title
add_action('woocommerce_show_page_title', 'themerex_show_wooc_page_title', 10);
if ( !function_exists( 'themerex_show_wooc_page_title' ) ) {
	function themerex_show_wooc_page_title($defa=true) {
		return get_custom_option('show_post_title')=='yes' || get_custom_option('show_page_title')=='no' || get_custom_option('show_top_page')=='no';
	}
}

// Check to show product title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action( 'woocommerce_single_product_summary', 'themerex_show_wooc_product_title', 5 );
if ( !function_exists( 'themerex_show_wooc_product_title' ) ) {
	function themerex_show_wooc_product_title() {
		wc_get_template( 'single-product/title.php' );
	}
}

// Wrap thumbs for categories in thumb mode
add_action( 'woocommerce_before_subcategory_title', 'themerex_woocommerce_open_cat_thumb_wrapper', 9 );
if ( !function_exists( 'themerex_woocommerce_open_cat_thumb_wrapper' ) ) {
	function themerex_woocommerce_open_cat_thumb_wrapper($cat='') {
			echo '<div class="thumb_wrapper">';
	}
}
add_action( 'woocommerce_before_subcategory_title', 'themerex_woocommerce_close_cat_thumb_wrapper', 11 );
if ( !function_exists( 'themerex_woocommerce_close_cat_thumb_wrapper' ) ) {
	function themerex_woocommerce_close_cat_thumb_wrapper($cat='') {
			echo '</div>';
	}
}

// Add Product ID for single product
add_action( 'woocommerce_product_meta_end', 'themerex_woocommerce_show_product_id', 10);
if ( !function_exists( 'themerex_woocommerce_show_product_id' ) ) {
	function themerex_woocommerce_show_product_id() {
		global $post, $product;
		echo '<span class="product_id">'.__('Product ID: ', 'themerex') . '<span>' . $post->ID.'</span></span>';
	}
}

// Redefine number of related products
add_filter( 'woocommerce_output_related_products_args', 'themerex_woocommerce_output_related_products_args' );
if ( !function_exists( 'themerex_woocommerce_output_related_products_args' ) ) {
	function themerex_woocommerce_output_related_products_args($args) {
		$ppp = get_custom_option('post_related_count');
		$ppp = $ppp > 0 ? $ppp : 3;
		$args['posts_per_page'] = $ppp;
		$args['columns'] = min(get_custom_option('show_sidebar_main')=='fullwidth' ? 4 : 3, $ppp);
		return $args;
	}
}

// Number columns for product thumbnails
add_filter( 'woocommerce_product_thumbnails_columns', 'themerex_woocommerce_product_thumbnails_columns' );
if ( !function_exists( 'themerex_woocommerce_product_thumbnails_columns' ) ) {
	function themerex_woocommerce_product_thumbnails_columns($cols) {
		return 5;
	}
}

// Number columns for shop streampage
add_filter( 'loop_shop_columns', 'themerex_woocommerce_loop_shop_columns' );
if ( !function_exists( 'themerex_woocommerce_loop_shop_columns' ) ) {
	function themerex_woocommerce_loop_shop_columns($cols) {
		return get_custom_option('show_sidebar_main')=='fullwidth' ? 4 : 3;
	}
}

// Search form
add_filter( 'get_product_search_form', 'themerex_woocommerce_get_product_search_form' );
if ( !function_exists( 'themerex_woocommerce_get_product_search_form' ) ) {
	function themerex_woocommerce_get_product_search_form($form) {
		return '
		<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/'  ) ) . '">
			<input type="text" class="search-field" placeholder="' . __('Search for products &hellip;', 'themerex') . '" value="' . get_search_query() . '" name="s" title="' . __('Search for products:', 'themerex') . '" /><span class="search-button squareButton light ico"><a class="search-field icon-search" href="#"></a></span>
			<input type="hidden" name="post_type" value="product" />
		</form>
		';
	}
}

// Nav fon single (Prev/Next)
add_action( 'woocommerce_before_main_content', 'themerex_woocommerce_get_next_prev_products_links', 60);
function themerex_woocommerce_get_next_prev_products_links() {
	if(is_product()) {
		echo "<div class='woocommerce-top-navigation'>";
		previous_post_link('%link', __('Prev', 'themerex'));
		if(get_previous_post_link() && get_next_post_link()) {
			echo "&nbsp/&nbsp";
		}
		next_post_link('%link', __('Next', 'themerex'));
		echo "</div>";
	}
}

add_action('woocommerce_before_shop_loop_item_title', 'themerex_woocommerce_product_cats');
function themerex_woocommerce_product_cats() {
	global $post;
	$post_id = $post->ID;
	$post_cats = wp_get_post_terms($post_id, 'product_cat');
	$cats_out = '';
	$i = 0;
	if(!empty($post_cats)) {
		foreach ($post_cats as $term) {
			$i++;
			$term_link = get_term_link($term, 'product_cat');
			$cats_out .= !empty($term_link) ? '<a href="'.$term_link.'">'.$term->name.'</a>' : '';
			$cats_out .= count($post_cats) > 1 && $i < count($post_cats) ? ',&nbsp;' : '';
		}
	}
	echo "</a>".(!empty($cats_out) ? '<div class="product_cats">'.$cats_out.'</div>' : '');
}

// Open item wrapper for categories and proiducts in list mode
//remove_action( 'woocommerce_before_subcategory_title', 'themerex_woocommerce_open_item_wrapper', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'themerex_woocommerce_open_item_wrapper', 20 );
if ( !function_exists( 'themerex_woocommerce_open_item_wrapper' ) ) {
	function themerex_woocommerce_open_item_wrapper($cat='') {
		global $post;
		$post_id = $post->ID;
		$post_link = get_permalink($post_id);
			echo '<div class="item_wrapper"><a href="'.$post_link.'">';
	}
}

// Close item wrapper for categories and proiducts in list mode
//remove_action( 'woocommerce_after_subcategory', 'themerex_woocommerce_close_item_wrapper', 20 );
add_action( 'woocommerce_after_shop_loop_item', 'themerex_woocommerce_close_item_wrapper', 20 );
if ( !function_exists( 'themerex_woocommerce_close_item_wrapper' ) ) {
	function themerex_woocommerce_close_item_wrapper($cat='') {
			echo '</div>';
	}
}

?>