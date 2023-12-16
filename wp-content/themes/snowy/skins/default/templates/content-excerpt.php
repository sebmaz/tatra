<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

$snowy_template_args = get_query_var( 'snowy_template_args' );
$snowy_columns = 1;
if ( is_array( $snowy_template_args ) ) {
	$snowy_columns    = empty( $snowy_template_args['columns'] ) ? 1 : max( 1, $snowy_template_args['columns'] );
	$snowy_blog_style = array( $snowy_template_args['type'], $snowy_columns );
	if ( ! empty( $snowy_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $snowy_columns > 1 ) {
	    $snowy_columns_class = snowy_get_column_class( 1, $snowy_columns, ! empty( $snowy_template_args['columns_tablet']) ? $snowy_template_args['columns_tablet'] : '', ! empty($snowy_template_args['columns_mobile']) ? $snowy_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $snowy_columns_class ); ?>">
		<?php
	}
}
$snowy_expanded    = ! snowy_sidebar_present() && snowy_get_theme_option( 'expand_content' ) == 'expand';
$snowy_post_format = get_post_format();
$snowy_post_format = empty( $snowy_post_format ) ? 'standard' : str_replace( 'post-format-', '', $snowy_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $snowy_post_format ) );
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
			'thumb_size' => ! empty( $snowy_template_args['thumb_size'] )
							? $snowy_template_args['thumb_size']
							: snowy_get_thumb_size( strpos( snowy_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $snowy_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$snowy_template_args
	) );

	// Title and post meta
	$snowy_show_title = get_the_title() != '';
	$snowy_show_meta  = count( $snowy_components ) > 0 && ! in_array( $snowy_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $snowy_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'snowy_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'snowy_action_before_post_title' );
				if ( empty( $snowy_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'snowy_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'snowy_filter_show_blog_excerpt', empty( $snowy_template_args['hide_excerpt'] ) && snowy_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'snowy_filter_show_blog_meta', $snowy_show_meta, $snowy_components, 'excerpt' ) ) {
				if ( count( $snowy_components ) > 0 ) {
					do_action( 'snowy_action_before_post_meta' );
					snowy_show_post_meta(
						apply_filters(
							'snowy_filter_post_meta_args', array(
								'components' => join( ',', $snowy_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'snowy_action_after_post_meta' );
				}
			}

			if ( snowy_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'snowy_action_before_full_post_content' );
					the_content( '' );
					do_action( 'snowy_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'snowy' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'snowy' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				snowy_show_post_content( $snowy_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'snowy_filter_show_blog_readmore',  ! isset( $snowy_template_args['more_button'] ) || ! empty( $snowy_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $snowy_template_args['no_links'] ) ) {
					do_action( 'snowy_action_before_post_readmore' );
					if ( snowy_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						snowy_show_post_more_link( $snowy_template_args, '<p>', '</p>' );
					} else {
						snowy_show_post_comments_link( $snowy_template_args, '<p>', '</p>' );
					}
					do_action( 'snowy_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $snowy_template_args ) ) {
	if ( ! empty( $snowy_template_args['slider'] ) || $snowy_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
