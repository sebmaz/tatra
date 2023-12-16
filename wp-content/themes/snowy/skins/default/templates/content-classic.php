<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

$snowy_template_args = get_query_var( 'snowy_template_args' );

if ( is_array( $snowy_template_args ) ) {
	$snowy_columns    = empty( $snowy_template_args['columns'] ) ? 2 : max( 1, $snowy_template_args['columns'] );
	$snowy_blog_style = array( $snowy_template_args['type'], $snowy_columns );
    $snowy_columns_class = snowy_get_column_class( 1, $snowy_columns, ! empty( $snowy_template_args['columns_tablet']) ? $snowy_template_args['columns_tablet'] : '', ! empty($snowy_template_args['columns_mobile']) ? $snowy_template_args['columns_mobile'] : '' );
} else {
	$snowy_blog_style = explode( '_', snowy_get_theme_option( 'blog_style' ) );
	$snowy_columns    = empty( $snowy_blog_style[1] ) ? 2 : max( 1, $snowy_blog_style[1] );
    $snowy_columns_class = snowy_get_column_class( 1, $snowy_columns );
}
$snowy_expanded   = ! snowy_sidebar_present() && snowy_get_theme_option( 'expand_content' ) == 'expand';

$snowy_post_format = get_post_format();
$snowy_post_format = empty( $snowy_post_format ) ? 'standard' : str_replace( 'post-format-', '', $snowy_post_format );

?><div class="<?php
	if ( ! empty( $snowy_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( snowy_is_blog_style_use_masonry( $snowy_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $snowy_columns ) : esc_attr( $snowy_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $snowy_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $snowy_columns )
				. ' post_layout_' . esc_attr( $snowy_blog_style[0] )
				. ' post_layout_' . esc_attr( $snowy_blog_style[0] ) . '_' . esc_attr( $snowy_columns )
	);
	snowy_add_blog_animation( $snowy_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$snowy_hover      = ! empty( $snowy_template_args['hover'] ) && ! snowy_is_inherit( $snowy_template_args['hover'] )
							? $snowy_template_args['hover']
							: snowy_get_theme_option( 'image_hover' );

	$snowy_components = ! empty( $snowy_template_args['meta_parts'] )
							? ( is_array( $snowy_template_args['meta_parts'] )
								? $snowy_template_args['meta_parts']
								: explode( ',', $snowy_template_args['meta_parts'] )
								)
							: snowy_array_get_keys_by_value( snowy_get_theme_option( 'meta_parts' ) );

	snowy_show_post_featured( apply_filters( 'snowy_filter_args_featured',
		array(
			'thumb_size' => ! empty( $snowy_template_args['thumb_size'] )
				? $snowy_template_args['thumb_size']
				: snowy_get_thumb_size(
					'classic' == $snowy_blog_style[0]
						? ( strpos( snowy_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $snowy_columns > 2 ? 'big' : 'huge' )
								: ( $snowy_columns > 2
									? ( $snowy_expanded ? 'square' : 'square' )
									: ($snowy_columns > 1 ? 'square' : ( $snowy_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( snowy_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $snowy_columns > 2 ? 'masonry-big' : 'full' )
								: ($snowy_columns === 1 ? ( $snowy_expanded ? 'huge' : 'big' ) : ( $snowy_columns <= 2 && $snowy_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $snowy_hover,
			'meta_parts' => $snowy_components,
			'no_links'   => ! empty( $snowy_template_args['no_links'] ),
        ),
        'content-classic',
        $snowy_template_args
    ) );

	// Title and post meta
	$snowy_show_title = get_the_title() != '';
	$snowy_show_meta  = count( $snowy_components ) > 0 && ! in_array( $snowy_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $snowy_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'snowy_filter_show_blog_meta', $snowy_show_meta, $snowy_components, 'classic' ) ) {
				if ( count( $snowy_components ) > 0 ) {
					do_action( 'snowy_action_before_post_meta' );
					snowy_show_post_meta(
						apply_filters(
							'snowy_filter_post_meta_args', array(
							'components' => join( ',', $snowy_components ),
							'seo'        => false,
							'echo'       => true,
						), $snowy_blog_style[0], $snowy_columns
						)
					);
					do_action( 'snowy_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'snowy_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'snowy_action_before_post_title' );
				if ( empty( $snowy_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'snowy_action_after_post_title' );
			}

			if( !in_array( $snowy_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'snowy_filter_show_blog_readmore', ! $snowy_show_title || ! empty( $snowy_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $snowy_template_args['no_links'] ) ) {
						do_action( 'snowy_action_before_post_readmore' );
						snowy_show_post_more_link( $snowy_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'snowy_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $snowy_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('snowy_filter_show_blog_excerpt', empty($snowy_template_args['hide_excerpt']) && snowy_get_theme_option('excerpt_length') > 0, 'classic')) {
			snowy_show_post_content($snowy_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $snowy_template_args['more_button'] )) {
			if ( empty( $snowy_template_args['no_links'] ) ) {
				do_action( 'snowy_action_before_post_readmore' );
				snowy_show_post_more_link( $snowy_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'snowy_action_after_post_readmore' );
			}
		}
		$snowy_content = ob_get_contents();
		ob_end_clean();
		snowy_show_layout($snowy_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
