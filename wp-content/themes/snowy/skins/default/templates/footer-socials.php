<?php
/**
 * The template to display the socials in the footer
 *
 * @package SNOWY
 * @since SNOWY 1.0.10
 */


// Socials
if ( snowy_is_on( snowy_get_theme_option( 'socials_in_footer' ) ) ) {
	$snowy_output = snowy_get_socials_links();
	if ( '' != $snowy_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php snowy_show_layout( $snowy_output ); ?>
			</div>
		</div>
		<?php
	}
}
