<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package SNOWY
 * @since SNOWY 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$snowy_copyright_scheme = snowy_get_theme_option( 'copyright_scheme' );
if ( ! empty( $snowy_copyright_scheme ) && ! snowy_is_inherit( $snowy_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $snowy_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$snowy_copyright = snowy_get_theme_option( 'copyright' );
			if ( ! empty( $snowy_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$snowy_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $snowy_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$snowy_copyright = snowy_prepare_macros( $snowy_copyright );
				// Display copyright
				echo wp_kses( nl2br( $snowy_copyright ), 'snowy_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
