<?php
/**
 * The template to display the background video in the header
 *
 * @package SNOWY
 * @since SNOWY 1.0.14
 */
$snowy_header_video = snowy_get_header_video();
$snowy_embed_video  = '';
if ( ! empty( $snowy_header_video ) && ! snowy_is_from_uploads( $snowy_header_video ) ) {
	if ( snowy_is_youtube_url( $snowy_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $snowy_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php snowy_show_layout( snowy_get_embed_video( $snowy_header_video ) ); ?></div>
		<?php
	}
}
