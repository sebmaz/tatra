<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

$snowy_args = get_query_var( 'snowy_logo_args' );

// Site logo
$snowy_logo_type   = isset( $snowy_args['type'] ) ? $snowy_args['type'] : '';
$snowy_logo_image  = snowy_get_logo_image( $snowy_logo_type );
$snowy_logo_text   = snowy_is_on( snowy_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$snowy_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $snowy_logo_image['logo'] ) || ! empty( $snowy_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $snowy_logo_image['logo'] ) ) {
			if ( empty( $snowy_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($snowy_logo_image['logo']) && (int) $snowy_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$snowy_attr = snowy_getimagesize( $snowy_logo_image['logo'] );
				echo '<img src="' . esc_url( $snowy_logo_image['logo'] ) . '"'
						. ( ! empty( $snowy_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $snowy_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $snowy_logo_text ) . '"'
						. ( ! empty( $snowy_attr[3] ) ? ' ' . wp_kses_data( $snowy_attr[3] ) : '' )
						. '>';
			}
		} else {
			snowy_show_layout( snowy_prepare_macros( $snowy_logo_text ), '<span class="logo_text">', '</span>' );
			snowy_show_layout( snowy_prepare_macros( $snowy_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
