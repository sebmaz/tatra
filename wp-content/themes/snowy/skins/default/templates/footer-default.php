<?php
/**
 * The template to display default site footer
 *
 * @package SNOWY
 * @since SNOWY 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$snowy_footer_scheme = snowy_get_theme_option( 'footer_scheme' );
if ( ! empty( $snowy_footer_scheme ) && ! snowy_is_inherit( $snowy_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $snowy_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'snowy_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
