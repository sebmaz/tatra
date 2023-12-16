<?php
/**
 * The template to display the site logo in the footer
 *
 * @package SNOWY
 * @since SNOWY 1.0.10
 */

// Logo
if ( snowy_is_on( snowy_get_theme_option( 'logo_in_footer' ) ) ) {
	$snowy_logo_image = snowy_get_logo_image( 'footer' );
	$snowy_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $snowy_logo_image['logo'] ) || ! empty( $snowy_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $snowy_logo_image['logo'] ) ) {
					$snowy_attr = snowy_getimagesize( $snowy_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $snowy_logo_image['logo'] ) . '"'
								. ( ! empty( $snowy_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $snowy_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'snowy' ) . '"'
								. ( ! empty( $snowy_attr[3] ) ? ' ' . wp_kses_data( $snowy_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $snowy_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $snowy_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
