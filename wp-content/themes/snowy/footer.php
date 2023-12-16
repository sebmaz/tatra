<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

							do_action( 'snowy_action_page_content_end_text' );
							
							// Widgets area below the content
							snowy_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'snowy_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'snowy_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'snowy_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'snowy_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$snowy_body_style = snowy_get_theme_option( 'body_style' );
					$snowy_widgets_name = snowy_get_theme_option( 'widgets_below_page' );
					$snowy_show_widgets = ! snowy_is_off( $snowy_widgets_name ) && is_active_sidebar( $snowy_widgets_name );
					$snowy_show_related = snowy_is_single() && snowy_get_theme_option( 'related_position' ) == 'below_page';
					if ( $snowy_show_widgets || $snowy_show_related ) {
						if ( 'fullscreen' != $snowy_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $snowy_show_related ) {
							do_action( 'snowy_action_related_posts' );
						}

						// Widgets area below page content
						if ( $snowy_show_widgets ) {
							snowy_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $snowy_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'snowy_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'snowy_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! snowy_is_singular( 'post' ) && ! snowy_is_singular( 'attachment' ) ) || ! in_array ( snowy_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="snowy_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'snowy_action_before_footer' );

				// Footer
				$snowy_footer_type = snowy_get_theme_option( 'footer_type' );
				if ( 'custom' == $snowy_footer_type && ! snowy_is_layouts_available() ) {
					$snowy_footer_type = 'default';
				}
				get_template_part( apply_filters( 'snowy_filter_get_template_part', "templates/footer-" . sanitize_file_name( $snowy_footer_type ) ) );

				do_action( 'snowy_action_after_footer' );

			}
			?>

			<?php do_action( 'snowy_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'snowy_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'snowy_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>