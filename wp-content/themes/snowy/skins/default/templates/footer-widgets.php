<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package SNOWY
 * @since SNOWY 1.0.10
 */

// Footer sidebar
$snowy_footer_name    = snowy_get_theme_option( 'footer_widgets' );
$snowy_footer_present = ! snowy_is_off( $snowy_footer_name ) && is_active_sidebar( $snowy_footer_name );
if ( $snowy_footer_present ) {
	snowy_storage_set( 'current_sidebar', 'footer' );
	$snowy_footer_wide = snowy_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $snowy_footer_name ) ) {
		dynamic_sidebar( $snowy_footer_name );
	}
	$snowy_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $snowy_out ) ) {
		$snowy_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $snowy_out );
		$snowy_need_columns = true;   //or check: strpos($snowy_out, 'columns_wrap')===false;
		if ( $snowy_need_columns ) {
			$snowy_columns = max( 0, (int) snowy_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $snowy_columns ) {
				$snowy_columns = min( 4, max( 1, snowy_tags_count( $snowy_out, 'aside' ) ) );
			}
			if ( $snowy_columns > 1 ) {
				$snowy_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $snowy_columns ) . ' widget', $snowy_out );
			} else {
				$snowy_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $snowy_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'snowy_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $snowy_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $snowy_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'snowy_action_before_sidebar', 'footer' );
				snowy_show_layout( $snowy_out );
				do_action( 'snowy_action_after_sidebar', 'footer' );
				if ( $snowy_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $snowy_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'snowy_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
