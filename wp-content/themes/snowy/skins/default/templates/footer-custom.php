<?php
/**
 * The template to display default site footer
 *
 * @package SNOWY
 * @since SNOWY 1.0.10
 */

$snowy_footer_id = snowy_get_custom_footer_id();
$snowy_footer_meta = get_post_meta( $snowy_footer_id, 'trx_addons_options', true );
if ( ! empty( $snowy_footer_meta['margin'] ) ) {
	snowy_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( snowy_prepare_css_value( $snowy_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $snowy_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $snowy_footer_id ) ) ); ?>
						<?php
						$snowy_footer_scheme = snowy_get_theme_option( 'footer_scheme' );
						if ( ! empty( $snowy_footer_scheme ) && ! snowy_is_inherit( $snowy_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $snowy_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'snowy_action_show_layout', $snowy_footer_id );
	?>
</footer><!-- /.footer_wrap -->
