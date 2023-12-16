<?php
/**
 * The template to display default site header
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

$snowy_header_css   = '';
$snowy_header_image = get_header_image();
$snowy_header_video = snowy_get_header_video();
if ( ! empty( $snowy_header_image ) && snowy_trx_addons_featured_image_override( is_singular() || snowy_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$snowy_header_image = snowy_get_current_mode_image( $snowy_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $snowy_header_image ) || ! empty( $snowy_header_video ) ? ' with_bg_image' : ' without_bg_image';
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

	// Main menu
	get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( snowy_is_on( snowy_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
