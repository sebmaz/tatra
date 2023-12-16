<?php
/**
 * The template to display the widgets area in the header
 *
 * @package SNOWY
 * @since SNOWY 1.0
 */

// Header sidebar
$snowy_header_name    = snowy_get_theme_option( 'header_widgets' );
$snowy_header_present = ! snowy_is_off( $snowy_header_name ) && is_active_sidebar( $snowy_header_name );
if ( $snowy_header_present ) {
	snowy_storage_set( 'current_sidebar', 'header' );
	$snowy_header_wide = snowy_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $snowy_header_name ) ) {
		dynamic_sidebar( $snowy_header_name );
	}
	$snowy_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $snowy_widgets_output ) ) {
		$snowy_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $snowy_widgets_output );
		$snowy_need_columns   = strpos( $snowy_widgets_output, 'columns_wrap' ) === false;
		if ( $snowy_need_columns ) {
			$snowy_columns = max( 0, (int) snowy_get_theme_option( 'header_columns' ) );
			if ( 0 == $snowy_columns ) {
				$snowy_columns = min( 6, max( 1, snowy_tags_count( $snowy_widgets_output, 'aside' ) ) );
			}
			if ( $snowy_columns > 1 ) {
				$snowy_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $snowy_columns ) . ' widget', $snowy_widgets_output );
			} else {
				$snowy_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $snowy_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'snowy_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $snowy_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $snowy_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'snowy_action_before_sidebar', 'header' );
				snowy_show_layout( $snowy_widgets_output );
				do_action( 'snowy_action_after_sidebar', 'header' );
				if ( $snowy_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $snowy_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'snowy_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
