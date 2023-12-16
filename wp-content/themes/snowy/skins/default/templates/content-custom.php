<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package SNOWY
 * @since SNOWY 1.0.50
 */

$snowy_template_args = get_query_var( 'snowy_template_args' );
if ( is_array( $snowy_template_args ) ) {
	$snowy_columns    = empty( $snowy_template_args['columns'] ) ? 2 : max( 1, $snowy_template_args['columns'] );
	$snowy_blog_style = array( $snowy_template_args['type'], $snowy_columns );
} else {
	$snowy_blog_style = explode( '_', snowy_get_theme_option( 'blog_style' ) );
	$snowy_columns    = empty( $snowy_blog_style[1] ) ? 2 : max( 1, $snowy_blog_style[1] );
}
$snowy_blog_id       = snowy_get_custom_blog_id( join( '_', $snowy_blog_style ) );
$snowy_blog_style[0] = str_replace( 'blog-custom-', '', $snowy_blog_style[0] );
$snowy_expanded      = ! snowy_sidebar_present() && snowy_get_theme_option( 'expand_content' ) == 'expand';
$snowy_components    = ! empty( $snowy_template_args['meta_parts'] )
							? ( is_array( $snowy_template_args['meta_parts'] )
								? join( ',', $snowy_template_args['meta_parts'] )
								: $snowy_template_args['meta_parts']
								)
							: snowy_array_get_keys_by_value( snowy_get_theme_option( 'meta_parts' ) );
$snowy_post_format   = get_post_format();
$snowy_post_format   = empty( $snowy_post_format ) ? 'standard' : str_replace( 'post-format-', '', $snowy_post_format );

$snowy_blog_meta     = snowy_get_custom_layout_meta( $snowy_blog_id );
$snowy_custom_style  = ! empty( $snowy_blog_meta['scripts_required'] ) ? $snowy_blog_meta['scripts_required'] : 'none';

if ( ! empty( $snowy_template_args['slider'] ) || $snowy_columns > 1 || ! snowy_is_off( $snowy_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $snowy_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( snowy_is_off( $snowy_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $snowy_custom_style ) ) . "-1_{$snowy_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $snowy_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $snowy_columns )
					. ' post_layout_' . esc_attr( $snowy_blog_style[0] )
					. ' post_layout_' . esc_attr( $snowy_blog_style[0] ) . '_' . esc_attr( $snowy_columns )
					. ( ! snowy_is_off( $snowy_custom_style )
						? ' post_layout_' . esc_attr( $snowy_custom_style )
							. ' post_layout_' . esc_attr( $snowy_custom_style ) . '_' . esc_attr( $snowy_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'snowy_action_show_layout', $snowy_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $snowy_template_args['slider'] ) || $snowy_columns > 1 || ! snowy_is_off( $snowy_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
