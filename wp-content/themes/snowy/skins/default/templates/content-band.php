<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package SNOWY
 * @since SNOWY 1.71.0
 */

$snowy_template_args = get_query_var( 'snowy_template_args' );

$snowy_columns       = 1;

$snowy_expanded      = ! snowy_sidebar_present() && snowy_get_theme_option( 'expand_content' ) == 'expand';

$snowy_post_format   = get_post_format();
$snowy_post_format   = empty( $snowy_post_format ) ? 'standard' : str_replace( 'post-format-', '', $snowy_post_format );

if ( is_array( $snowy_template_args ) ) {
	$snowy_columns    = empty( $snowy_template_args['columns'] ) ? 1 : max( 1, $snowy_template_args['columns'] );
	$snowy_blog_style = array( $snowy_template_args['type'], $snowy_columns );
	if ( ! empty( $snowy_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $snowy_columns > 1 ) {
	    $snowy_columns_class = snowy_get_column_class( 1, $snowy_columns, ! empty( $snowy_template_args['columns_tablet']) ? $snowy_template_args['columns_tablet'] : '', ! empty($snowy_template_args['columns_mobile']) ? $snowy_template_args['columns_mobile'] : '' );
				?><div class="<?php echo esc_attr( $snowy_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $snowy_post_format ) );
	snowy_add_blog_animation( $snowy_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$snowy_hover      = ! empty( $snowy_template_args['hover'] ) && ! snowy_is_inherit( $snowy_template_args['hover'] )
							? $snowy_template_args['hover']
							: snowy_get_theme_option( 'image_hover' );
	$snowy_components = ! empty( $snowy_template_args['meta_parts'] )
							? ( is_array( $snowy_template_args['meta_parts'] )
								? $snowy_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $snowy_template_args['meta_parts'] ) )
								)
							: snowy_array_get_keys_by_value( snowy_get_theme_option( 'meta_parts' ) );
	snowy_show_post_featured( apply_filters( 'snowy_filter_args_featured',
		array(
			'no_links'   => ! empty( $snowy_template_args['no_links'] ),
			'hover'      => $snowy_hover,
			'meta_parts' => $snowy_components,
			'thumb_bg'   => true,
			'thumb_ratio'   => '1:1',
			'thumb_size' => ! empty( $snowy_template_args['thumb_size'] )
								? $snowy_template_args['thumb_size']
								: snowy_get_thumb_size( 
								in_array( $snowy_post_format, array( 'gallery', 'audio', 'video' ) )
									? ( strpos( snowy_get_theme_option( 'body_style' ), 'full' ) !== false
										? 'full'
										: ( $snowy_expanded 
											? 'big' 
											: 'medium-square'
											)
										)
									: 'masonry-big'
								)
		),
		'content-band',
		$snowy_template_args
	) );

	?><div class="post_content_wrap"><?php

		// Title and post meta
		$snowy_show_title = get_the_title() != '';
		$snowy_show_meta  = count( $snowy_components ) > 0 && ! in_array( $snowy_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );
		if ( $snowy_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'snowy_filter_show_blog_categories', $snowy_show_meta && in_array( 'categories', $snowy_components ), array( 'categories' ), 'band' ) ) {
					do_action( 'snowy_action_before_post_category' );
					?>
					<div class="post_category">
						<?php
						snowy_show_post_meta( apply_filters(
															'snowy_filter_post_meta_args',
															array(
																'components' => 'categories',
																'seo'        => false,
																'echo'       => true,
																'cat_sep'    => false,
																),
															'hover_' . $snowy_hover, 1
															)
											);
						?>
					</div>
					<?php
					$snowy_components = snowy_array_delete_by_value( $snowy_components, 'categories' );
					do_action( 'snowy_action_after_post_category' );
				}
				// Post title
				if ( apply_filters( 'snowy_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'snowy_action_before_post_title' );
					if ( empty( $snowy_template_args['no_links'] ) ) {
						the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
					} else {
						the_title( '<h4 class="post_title entry-title">', '</h4>' );
					}
					do_action( 'snowy_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $snowy_template_args['excerpt_length'] ) && ! in_array( $snowy_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$snowy_template_args['excerpt_length'] = 13;
		}
		if ( apply_filters( 'snowy_filter_show_blog_excerpt', empty( $snowy_template_args['hide_excerpt'] ) && snowy_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				snowy_show_post_content( $snowy_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( apply_filters( 'snowy_filter_show_blog_meta', $snowy_show_meta, $snowy_components, 'band' ) ) {
			if ( count( $snowy_components ) > 0 ) {
				do_action( 'snowy_action_before_post_meta' );
				snowy_show_post_meta(
					apply_filters(
						'snowy_filter_post_meta_args', array(
							'components' => join( ',', $snowy_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'snowy_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'snowy_filter_show_blog_readmore', ! $snowy_show_title || ! empty( $snowy_template_args['more_button'] ), 'band' ) ) {
			if ( empty( $snowy_template_args['no_links'] ) ) {
				do_action( 'snowy_action_before_post_readmore' );
				snowy_show_post_more_link( $snowy_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'snowy_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $snowy_template_args ) ) {
	if ( ! empty( $snowy_template_args['slider'] ) || $snowy_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
