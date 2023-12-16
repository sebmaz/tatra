<?php
/**
 * The template to display single post
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

// Full post loading
$full_post_loading          = snowy_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = snowy_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = snowy_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$snowy_related_position   = snowy_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$snowy_posts_navigation   = snowy_get_theme_option( 'posts_navigation' );
$snowy_prev_post          = false;
$snowy_prev_post_same_cat = snowy_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( snowy_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	snowy_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'snowy_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $snowy_posts_navigation ) {
		$snowy_prev_post = get_previous_post( $snowy_prev_post_same_cat );  // Get post from same category
		if ( ! $snowy_prev_post && $snowy_prev_post_same_cat ) {
			$snowy_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $snowy_prev_post ) {
			$snowy_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $snowy_prev_post ) ) {
		snowy_sc_layouts_showed( 'featured', false );
		snowy_sc_layouts_showed( 'title', false );
		snowy_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $snowy_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/content', 'single-' . snowy_get_theme_option( 'single_style' ) ), 'single-' . snowy_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $snowy_related_position, 'inside' ) === 0 ) {
		$snowy_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'snowy_action_related_posts' );
		$snowy_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $snowy_related_content ) ) {
			$snowy_related_position_inside = max( 0, min( 9, snowy_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $snowy_related_position_inside ) {
				$snowy_related_position_inside = mt_rand( 1, 9 );
			}

			$snowy_p_number         = 0;
			$snowy_related_inserted = false;
			$snowy_in_block         = false;
			$snowy_content_start    = strpos( $snowy_content, '<div class="post_content' );
			$snowy_content_end      = strrpos( $snowy_content, '</div>' );

			for ( $i = max( 0, $snowy_content_start ); $i < min( strlen( $snowy_content ) - 3, $snowy_content_end ); $i++ ) {
				if ( $snowy_content[ $i ] != '<' ) {
					continue;
				}
				if ( $snowy_in_block ) {
					if ( strtolower( substr( $snowy_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$snowy_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $snowy_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $snowy_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$snowy_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $snowy_content[ $i + 1 ] && in_array( $snowy_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$snowy_p_number++;
					if ( $snowy_related_position_inside == $snowy_p_number ) {
						$snowy_related_inserted = true;
						$snowy_content = ( $i > 0 ? substr( $snowy_content, 0, $i ) : '' )
											. $snowy_related_content
											. substr( $snowy_content, $i );
					}
				}
			}
			if ( ! $snowy_related_inserted ) {
				if ( $snowy_content_end > 0 ) {
					$snowy_content = substr( $snowy_content, 0, $snowy_content_end ) . $snowy_related_content . substr( $snowy_content, $snowy_content_end );
				} else {
					$snowy_content .= $snowy_related_content;
				}
			}
		}

		snowy_show_layout( $snowy_content );
	}

	// Comments
	do_action( 'snowy_action_before_comments' );
	comments_template();
	do_action( 'snowy_action_after_comments' );

	// Related posts
	if ( 'below_content' == $snowy_related_position
		&& ( 'scroll' != $snowy_posts_navigation || snowy_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || snowy_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'snowy_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $snowy_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $snowy_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $snowy_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $snowy_prev_post ) ); ?>"
			<?php do_action( 'snowy_action_nav_links_single_scroll_data', $snowy_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
