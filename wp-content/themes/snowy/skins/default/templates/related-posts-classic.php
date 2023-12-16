<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

$snowy_link        = get_permalink();
$snowy_post_format = get_post_format();
$snowy_post_format = empty( $snowy_post_format ) ? 'standard' : str_replace( 'post-format-', '', $snowy_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $snowy_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	snowy_show_post_featured(
		array(
			'thumb_ratio'   => '300:223',
			'thumb_size'    => apply_filters( 'snowy_filter_related_thumb_size', snowy_get_thumb_size( (int) snowy_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'square' ) ),
		)
	);
	?>
	<div class="post_header entry-header">
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {

			snowy_show_post_meta(
				array(
					'components' => 'categories',
					'class'      => 'post_meta_categories',
				)
			);

		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $snowy_link ); ?>"><?php
			if ( '' == get_the_title() ) {
				esc_html_e( '- No title -', 'snowy' );
			} else {
				the_title();
			}
		?></a></h6>
	</div>
</div>
