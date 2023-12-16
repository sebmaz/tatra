<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package SNOWY
 * @since SNOWY 1.0.06
 */

$snowy_header_css   = '';
$snowy_header_image = get_header_image();
$snowy_header_video = snowy_get_header_video();
if ( ! empty( $snowy_header_image ) && snowy_trx_addons_featured_image_override( is_singular() || snowy_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$snowy_header_image = snowy_get_current_mode_image( $snowy_header_image );
}

$snowy_header_id = snowy_get_custom_header_id();
$snowy_header_meta = get_post_meta( $snowy_header_id, 'trx_addons_options', true );
if ( ! empty( $snowy_header_meta['margin'] ) ) {
	snowy_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( snowy_prepare_css_value( $snowy_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $snowy_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $snowy_header_id ) ) ); ?>
				<?php
				echo ! empty( $snowy_header_image ) || ! empty( $snowy_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $snowy_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $snowy_header_image ) {
					echo ' ' . esc_attr( snowy_add_inline_css_class( 'background-image: url(' . esc_url( $snowy_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( snowy_is_on( snowy_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight snowy-full-height';
				}
				$snowy_header_scheme = snowy_get_theme_option( 'header_scheme' );
				if ( ! empty( $snowy_header_scheme ) && ! snowy_is_inherit( $snowy_header_scheme  ) ) {
					echo ' scheme_' . esc_attr( $snowy_header_scheme );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $snowy_header_video ) ) {
		get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'snowy_action_show_layout', $snowy_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
