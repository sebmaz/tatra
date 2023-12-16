<?php
/**
 * The Portfolio template to display the content
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

$snowy_post_format = get_post_format();
$snowy_post_format = empty( $snowy_post_format ) ? 'standard' : str_replace( 'post-format-', '', $snowy_post_format );

?><div class="
<?php
if ( ! empty( $snowy_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( snowy_is_blog_style_use_masonry( $snowy_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $snowy_columns ) : esc_attr( $snowy_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $snowy_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $snowy_columns )
		. ( 'portfolio' != $snowy_blog_style[0] ? ' ' . esc_attr( $snowy_blog_style[0] )  . '_' . esc_attr( $snowy_columns ) : '' )
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

	$snowy_hover   = ! empty( $snowy_template_args['hover'] ) && ! snowy_is_inherit( $snowy_template_args['hover'] )
								? $snowy_template_args['hover']
								: snowy_get_theme_option( 'image_hover' );

	if ( 'dots' == $snowy_hover ) {
		$snowy_post_link = empty( $snowy_template_args['no_links'] )
								? ( ! empty( $snowy_template_args['link'] )
									? $snowy_template_args['link']
									: get_permalink()
									)
								: '';
		$snowy_target    = ! empty( $snowy_post_link ) && false === strpos( $snowy_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$snowy_components = ! empty( $snowy_template_args['meta_parts'] )
							? ( is_array( $snowy_template_args['meta_parts'] )
								? $snowy_template_args['meta_parts']
								: explode( ',', $snowy_template_args['meta_parts'] )
								)
							: snowy_array_get_keys_by_value( snowy_get_theme_option( 'meta_parts' ) );

	// Featured image
	snowy_show_post_featured( apply_filters( 'snowy_filter_args_featured',
        array(
			'hover'         => $snowy_hover,
			'no_links'      => ! empty( $snowy_template_args['no_links'] ),
			'thumb_size'    => ! empty( $snowy_template_args['thumb_size'] )
								? $snowy_template_args['thumb_size']
								: snowy_get_thumb_size(
									snowy_is_blog_style_use_masonry( $snowy_blog_style[0] )
										? (	strpos( snowy_get_theme_option( 'body_style' ), 'full' ) !== false || $snowy_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( snowy_get_theme_option( 'body_style' ), 'full' ) !== false || $snowy_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => snowy_is_blog_style_use_masonry( $snowy_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $snowy_components,
			'class'         => 'dots' == $snowy_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $snowy_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $snowy_post_link )
												? '<a href="' . esc_url( $snowy_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $snowy_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $snowy_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $snowy_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!