<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

// Page (category, tag, archive, author) title

if ( snowy_need_page_title() ) {
	snowy_sc_layouts_showed( 'title', true );
	snowy_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								snowy_show_post_meta(
									apply_filters(
										'snowy_filter_post_meta_args', array(
											'components' => join( ',', snowy_array_get_keys_by_value( snowy_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', snowy_array_get_keys_by_value( snowy_get_theme_option( 'counters' ) ) ),
											'seo'        => snowy_is_on( snowy_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$snowy_blog_title           = snowy_get_blog_title();
							$snowy_blog_title_text      = '';
							$snowy_blog_title_class     = '';
							$snowy_blog_title_link      = '';
							$snowy_blog_title_link_text = '';
							if ( is_array( $snowy_blog_title ) ) {
								$snowy_blog_title_text      = $snowy_blog_title['text'];
								$snowy_blog_title_class     = ! empty( $snowy_blog_title['class'] ) ? ' ' . $snowy_blog_title['class'] : '';
								$snowy_blog_title_link      = ! empty( $snowy_blog_title['link'] ) ? $snowy_blog_title['link'] : '';
								$snowy_blog_title_link_text = ! empty( $snowy_blog_title['link_text'] ) ? $snowy_blog_title['link_text'] : '';
							} else {
								$snowy_blog_title_text = $snowy_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $snowy_blog_title_class ); ?>">
								<?php
								$snowy_top_icon = snowy_get_term_image_small();
								if ( ! empty( $snowy_top_icon ) ) {
									$snowy_attr = snowy_getimagesize( $snowy_top_icon );
									?>
									<img src="<?php echo esc_url( $snowy_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'snowy' ); ?>"
										<?php
										if ( ! empty( $snowy_attr[3] ) ) {
											snowy_show_layout( $snowy_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $snowy_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $snowy_blog_title_link ) && ! empty( $snowy_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $snowy_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $snowy_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'snowy_action_breadcrumbs' );
						$snowy_breadcrumbs = ob_get_contents();
						ob_end_clean();
						snowy_show_layout( $snowy_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
